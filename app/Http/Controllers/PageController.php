<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\PageTranslation;
use App\BusinessSetting;
use Artisan;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.website_settings.pages.create');
    }
    public function featured_create()
    {
        return view('backend.website_settings.pages.featured_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $page = new Page;
        $page->title = $request->title;
        if (Page::where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            $page->slug             = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $page->type             = ($request->has('type')) ? $request->type :"custom_page";
            $page->content          = $request->content;
            $page->meta_title       = $request->meta_title;
            $page->meta_description = $request->meta_description;
            $page->keywords         = $request->keywords;
            $page->meta_image       = $request->meta_image;
            $page->save();

            $page_translation           = PageTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'page_id' => $page->id]);
            $page_translation->title    = $request->title;
            $page_translation->content  = $request->content;
            $page_translation->save();

            if($request->has('type') && $request->type == 'featured_page'){

                foreach ($request->types as $key => $type) {
                    $business_settings = new BusinessSetting;
                    $business_settings->type = $type;
                    if(gettype($request[$type]) == 'array'){
                        $business_settings->value = json_encode($request[$type]);
                    }
                    else {
                        $business_settings->value = $request[$type];
                    }
                    $business_settings->page_id = $page->id;
                    $business_settings->save();
                }

            }

            flash(translate('New page has been created successfully'))->success();
            return redirect()->route('website.pages');
        }

        flash(translate('Slug has been used already'))->warning();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit(Request $request, $id, $type = '')
   {

        $lang = $request->lang;
        $page_name = $request->page;
        $page = Page::where('slug', $id)->first();

        if($page != null){
          if ($page_name == 'home') {
            return view('backend.website_settings.pages.home_page_edit', compact('page','lang'));
          }
          elseif ($page->type == 'about_us' || $page_name == 'about_us') {
            return view('backend.website_settings.pages.about_edit', compact('page','lang'));
          }
          elseif ($page->type == 'contact_us' || $page_name == 'contact_us') {
            return view('backend.website_settings.pages.contact_edit', compact('page','lang'));
          }
          elseif ($page->type == 'gallery_archive' || $page_name == 'gallery_archive') {

            return view('backend.website_settings.pages.gallery_edit', compact('page','lang'));
          }
          elseif ($page->type == 'featured_page' || $page_name == 'featured_page') {
            return view('backend.website_settings.pages.featured_edit', compact('page','lang'));
          }elseif ($page->type == 'farm_to_plate' || $page_name == 'farm_to_plate') {
            return view('backend.website_settings.pages.farm_to_plate_edit', compact('page','lang'));
          }elseif ($page->type == 'ensure-safe-food' || $page_name == 'ensure-safe-food') {
            return view('backend.website_settings.pages.ensure-safe-food_edit', compact('page','lang'));
          }
          elseif ($page->type == 'history' ) {

            return view('backend.website_settings.pages.history_edit', compact('page','lang'));
          }
          else{
            return view('backend.website_settings.pages.edit', compact('page','lang'));
          }
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $page = Page::findOrFail($id);
        if (Page::where('id','!=', $id)->where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            if($page->type == 'custom_page'){
              $page->slug           = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            }
            if($request->lang == env("DEFAULT_LANGUAGE")){
              $page->title          = $request->title;
              $page->content        = $request->content;
            }
            $page->title          = $request->title;
            $page->content        = $request->content;
            $page->meta_title       = $request->meta_title;
            $page->meta_description = $request->meta_description;
            $page->keywords         = $request->keywords;
            $page->meta_image       = $request->meta_image;
            $page->save();

            $page_translation           = PageTranslation::firstOrNew(['lang' => $request->lang, 'page_id' => $page->id]);
            $page_translation->title    = $request->title;
            $page_translation->content  = $request->content;
            $page_translation->save();

            if($request->has('type') && $request->type == 'featured_page' || $request->type == 'about_us' || $request->type == 'contact_us' || $request->type == 'gallery_archive'){

                foreach ($request->types as $key => $type) {
                    $lang = null;
                    if(gettype($type) == 'array'){
                        $lang = array_key_first($type);
                        $type = $type[$lang];
                        $business_settings = BusinessSetting::where('type', $type)->where('page_id',$page->id)->where('lang',$lang)->first();
                    }else{
                        $business_settings = BusinessSetting::where('type', $type)->where('page_id',$page->id)->first();
                    }

                    if($business_settings!=null){
                        if(gettype($request[$type]) == 'array'){
                            $business_settings->value = json_encode($request[$type]);
                        }
                        else {
                            $business_settings->value = $request[$type];
                        }
                    }
                    else{
                        $business_settings = new BusinessSetting;
                        $business_settings->type = $type;
                        if(gettype($request[$type]) == 'array'){
                            $business_settings->value = json_encode($request[$type]);
                        }
                        else {
                            $business_settings->value = $request[$type];
                        }
                    }
                    $business_settings->lang = $lang;
                    $business_settings->page_id = $page->id;
                    $business_settings->save();
                }

            }

            Artisan::call('cache:clear');

            flash(translate('Page has been updated successfully'))->success();
            return redirect()->route('website.pages');
        }

      flash(translate('Slug has been used already'))->warning();
      return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        foreach ($page->page_translations as $key => $page_translation) {
            $page_translation->delete();
        }
        if(Page::destroy($id)){
            flash(translate('Page has been deleted successfully'))->success();
            return redirect()->back();
        }
        return back();
    }

    public function show_custom_page($slug, $type = ''){

        $page = Page::where('slug', $slug)->first();
        if($page != null){
            if($page->type == 'featured_page' || $type == 'featured_page'){
                // dd('hit');
                return view('frontend.custom_featured_page', compact('page'));
            }
            elseif ($page->type == 'about_us' || $type == 'about_us') {
                return view('frontend.custom_about_page', compact('page'));
            }
            elseif ($page->type == 'contact_us' || $type == 'contact_us') {
                return view('frontend.custom_contact_page', compact('page'));
            }
            elseif ($page->type == 'gallery_archive' || $type == 'gallery_archive') {
                return view('frontend.custom_gallery_page', compact('page'));
            }
            elseif ($page->type == 'history' ) {

                return view('frontend.custom_history_page', compact('page'));
            }elseif ($page->type == 'farm_to_plate' ) {
                return view('frontend.farm_to_plate', compact('page'));
              }elseif ($page->type == 'ensure-safe-food' ) {
                return view('frontend.ensure-safe-food', compact('page'));
              }
            else{
                return view('frontend.custom_page', compact('page'));
            }
        }
        abort(404);
    }
    public function mobile_custom_page($slug){
        $page = Page::where('slug', $slug)->first();
        if($page != null){
            return view('frontend.m_custom_page', compact('page'));
        }
        abort(404);
    }
}
