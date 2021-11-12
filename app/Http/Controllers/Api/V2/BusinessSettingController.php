<?php

namespace App\Http\Controllers\Api\V2;
use Illuminate\Http\Request;
use App\Http\Resources\V2\BusinessSettingCollection;
use App\Http\Resources\V2\ProductDetailCollection;
use App\Models\Product;
use App\Models\BusinessSetting;
use App\Models\Category;
use App\Page;
use App\Http\Resources\V2\CategoryCollection;

class BusinessSettingController extends Controller
{
    public function index()
    {
        return new BusinessSettingCollection(BusinessSetting::all());
    }
    public function home_about($lang){
        // $res=BusinessSetting::whereIn('type',['home_about_title','home_about','home_about_icons'])->get();
        $about=BusinessSetting::where('type','home_about')->where('lang',$lang)->first();
        $about_text=$about->value;
        $about=BusinessSetting::where('type','home_about_title')->where('lang',$lang)->first();
        $about_title=$about->value;
        $home_icons=BusinessSetting::where('type','home_about_icons')->first();
        $icons_title=BusinessSetting::where('type','home_about_titles')->where('lang',$lang)->first();
        $icons=[];
        foreach(json_decode($home_icons->value) as $key=>$val){
            $temp=[];

            $temp["text"]=json_decode($icons_title->value)[$key];
            $temp["image"]=api_asset($val);
            array_push($icons,$temp);
        }

        return response()->json([
            "about_text"=>$about_text,
            "about_title"=>$about_title,
            "about_icons"=>$icons
        ]);

    }
    public function home_ready_to($lang){

        $ready_to_images=BusinessSetting::where('type','home_banner1_images')->first();
        $ready_to_links=BusinessSetting::where('type','home_banner1_links')->first();

        $ready_to_titles=BusinessSetting::where('type','home_banner1_titles')->where('lang',$lang)->first();
        if(!$ready_to_titles){
            $ready_to_titles=BusinessSetting::where('type','home_banner1_titles')->first();
        }


        $ready_to_sub_titles=BusinessSetting::where('type','home_banner1_subtitle')->where('lang',$lang)->first();
        if(!$ready_to_sub_titles){
            $ready_to_sub_titles=BusinessSetting::where('type','home_banner1_subtitle')->first();
        }



        $data=[];
        foreach(json_decode($ready_to_images->value) as $key => $val){
            $temp=[];
           $temp["image"] = api_asset($val);
           $temp["link"] = json_decode($ready_to_links->value)[$key];
           $temp["title"] = json_decode($ready_to_titles->value)[$key];
           $temp["sub_title"]= json_decode($ready_to_sub_titles->value)[$key];
           array_push($data,$temp);
        }

        return response()->json([
            "data"=>$data
        ]);
    }
    public function farm_to_plate($lang){
        $farm_to_images=BusinessSetting::where('type','home_steps_images')->first();
        $farm_to_titles=BusinessSetting::where('type','home_steps_titles')->where('lang',$lang)->first();
        if(!$farm_to_titles){
            $farm_to_titles=BusinessSetting::where('type','home_steps_titles')->first();
        }

       $images=$farm_to_images->value;
       $data=[];
       foreach(json_decode($images) as $key=>$val){
           $temp=[];
           $temp["image"]=api_asset($val);
           $temp["tile"]= json_decode($farm_to_titles->value)[$key];
            array_push($data,$temp);
       }
       return response()->json([
        "data"=>$data
         ]);
    }

    public function home_banner_2(){
        $data=[];
        $banners=BusinessSetting::where('type','home_banner2_images')->first();
        $links=BusinessSetting::where('type','home_banner2_links')->first();

        foreach(json_decode($banners->value) as $key => $val){
         $temp=[];
         $temp["image"]=api_asset($val);
         $temp["link"]= json_decode($links->value)[$key];
         array_push($data,$temp);
        }
        return response()->json([
            "data"=>$data
             ]);

    }
    public function corporate_clients($lang){
        $corporate_client_title=BusinessSetting::where('type','corporate_client_title')->where('lang',$lang)->first();
        if(!$corporate_client_title){
            $corporate_client_title=BusinessSetting::where('type','corporate_client_title')->first();
        }
        $corporate_sub_titles=BusinessSetting::where('type','corporate_client_subtitle')->where('lang',$lang)->first();
        if(!$corporate_sub_titles){
            $corporate_sub_titles=BusinessSetting::where('type','corporate_client_subtitle')->first();
        }
        $corporate_client_images=BusinessSetting::where('type','corporate_clients')->first();
        $corporate_client_images=explode(',',$corporate_client_images->value);
        $images=[];
        foreach($corporate_client_images as $img){
            array_push($images,api_asset($img));
        }

         return response()->json([
            "title"=>$corporate_client_title->value,
            "sub_title"=>$corporate_sub_titles->value,
            "images"=>$images

        ]);



    }
    public function filter_categories(){
        $filter_categories=BusinessSetting::where('type','filter_categories')->first();
        return new CategoryCollection(Category::whereIn('id', json_decode($filter_categories->value))->get());
        // dd($filter_categories);
    }

    public function featured_page($slug,$lang){
        $page = Page::where('slug', $slug)->first();
        $banner=get_page_setting('banner',$page->id);
        $banner=api_asset($banner);
        $title=$page->getTranslation('title',$lang);
        $sub_title=get_page_setting('subtitle',$page->id,null,$lang);
        $shop_link=get_page_setting('shop_link',$page->id);
        $description=get_page_setting('description',$page->id,$lang);
        $main_content=[];
        $banner_images=json_decode(get_page_setting('banner_text_images',$page->id), true);
        foreach($banner_images as $key=>$value){
            $temp["image"]=api_asset($value);
            $link=explode("/",json_decode(get_page_setting('banner_text_links',$page->id),true)[$key]);
            $slug=end($link);
            $temp["shop_now_button_product"] = new ProductDetailCollection(Product::where('slug', $slug)->get());
            $temp["title"]=json_decode(get_page_setting('banner_text_titles',$page->id,null,$lang),true)[$key] ;
            $temp["banner_details"]=json_decode(get_page_setting('banner_text_details',$page->id,null,$lang),true)[$key];
            array_push($main_content,$temp);
        }
        $products=json_decode(get_page_setting('products',$page->id));

        return response()->json([
            "page_banner"=>$banner,
            "page_title"=>$title,
            "sub_title"=>$sub_title,
            "shop_link"=>$shop_link,
            "page_description"=>$description,
            "main_content"=>$main_content,
            "products"=>$products
        ]);
    }
}
