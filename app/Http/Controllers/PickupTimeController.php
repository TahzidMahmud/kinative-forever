<?php

namespace App\Http\Controllers;

use App\PickupTime;
use App\PickupPoint;
use Illuminate\Http\Request;

class PickupTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $times=PickupTime::all();

        return view('backend.setup_configurations.pickup_time.index',compact('times'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.setup_configurations.pickup_time.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $days=json_encode($request->days);
        $new_point=PickupTime::create([
            "days"=>$days,
            "start_time"=>$request->start,
            "end_time"=>$request->end
        ]);
        if($new_point){
            if($request->ajax()){
                return response(["stat"=>1]);
            }else{
                flash(translate('Time Slot has been Created successfully'))->success();
                return redirect()->route('pick_up_times.index');
            }


        }else{
            if($request->ajax()){
                return response(["stat"=>0]);
            }else{
                flash(translate('Something Went Wrong'))->danger();
                return redirect()->back();
            }

        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\PickupTime  $pickupTime
     * @return \Illuminate\Http\Response
     */
    public function show(PickupTime $pickupTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PickupTime  $pickupTime
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $time=PickupTime::findOrFail($id);

        return view('backend.setup_configurations.pickup_time.edit',compact('time'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PickupTime  $pickupTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $time=PickupTime::findOrFail($id);
        $days=json_encode($request->days);
       if( $time->update([
        "days"=>$days,
        "start_time"=>$request->start_time,
        "end_time"=>$request->end_time
    ])){
        flash(translate('Time Slot has been Updated successfully'))->success();
        return redirect()->route('pick_up_times.index');
       }else{
        flash(translate('Something Went Wrong'))->danger();
        return redirect()->back();
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PickupTime  $pickupTime
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $time=PickupTime::findOrFail($id);
        if($time->delete()){
            flash(translate('Time Slot has been deleted successfully'))->success();
            return redirect()->route('pick_up_times.index');
        }else{
            flash(translate('Something Went Wrong'))->danger();
            return redirect()->route('pick_up_times.index');
        }

    }
    public function point_wise_times(Request $request){
        $slots=[];
        $point=PickupPoint::where('id',$request->id)->first();

       if($point->time_slots){
        $times=json_decode($point->time_slots);
        $temp_slots=PickupTime::whereIn('id',$times)->get();
        foreach($temp_slots as $slot){
            $temp=[];
            $temp["id"]=$slot->id;
            $temp["days"]=json_decode($slot->days);
            $temp["start"]=$slot->start_time;
            $temp["end"]=$slot->end_time;
            $temp["str"]='Days:'.implode(",",json_decode($slot->days)).' - Opens: '.$slot->start_time.' Closes: '.$slot->end_time;;
            array_push($slots,$temp);
        }
       }

       return response([
           "slots"=>$slots
       ]);

    }
}
