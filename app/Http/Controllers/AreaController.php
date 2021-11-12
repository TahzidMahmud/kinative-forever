<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\City;
use App\Country;
use App\CityTranslation;

class AreaController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::paginate(30);
        $cities = City::get();
        return view('backend.setup_configurations.area.index', compact('cities', 'areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $area = new Area;
        $area->name = $request->name;
        $area->city_id = $request->city_id;
        $area->save();

        flash(translate('Area has been inserted successfully'))->success();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit(Request $request, $id)
     {
	     $area  = Area::findOrFail($id);
	     $cities = City::get();
	     return view('backend.setup_configurations.area.edit', compact('area', 'cities'));
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
        $area = Area::findOrFail($id);
        $area->name = $request->name;
        $area->city_id = $request->city_id;
        $area->save();

        flash(translate('Area has been updated successfully'))->success();
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
        Area::destroy($id);

        flash(translate('Area has been deleted successfully'))->success();
        return redirect()->route('areas.index');
    }
    public function get_area(Request $request) {
        $city_info = City::where('name', $request->city_name)->first();
        
        $areas = Area::where('city_id', $city_info->id)->get();
        $html = '';
        
        foreach ($areas as $row) {
            $html .= '<option value="' . $row->name . '">' . $row->name . '</option>';
        }
        
        echo json_encode($html);
    }
}