<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\OTPVerificationController;
use App\Http\Resources\V2\PurchaseHistoryMiniCollection;
use App\Http\Resources\V2\DeliveryBoyPurchaseHistoryMiniCollection;
use Illuminate\Http\Request;
// use App\Http\Resources\V2\DeliveryBoyCollection;
use App\Http\Resources\V2\DeliveryHistoryCollection;
use App\Http\Resources\V2\DeliveryBoyPaymentCollection;
use App\Http\Resources\V2\DeliveryBoyCollectioCollection;
use Auth;
use App\DeliveryBoy;
use App\DeliveryHistory;
use App\DeliveryBoyPayment;
use App\DeliveryBoyCollection;
use App\Order;
use App\User;
use Carbon\Carbon;

class DeliveryBoyController extends Controller
{

    /**
     * Show the list of assigned delivery by the admin.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function dashboard_summary($id)
    {
        $order_query = Order::query();
        $order_query->where('assign_delivery_boy', $id);


        $delivery_boy = DeliveryBoy::where('user_id', $id)->first();


        //dummy
        /*  return response()->json([
              'completed_delivery' => 123,
              'pending_delivery' => 0,
              'total_collection' => format_price(154126.00),
              'total_earning' => format_price(365.00),
              'cancelled' => 5,
              'on_the_way' => 123,
              'picked' => 24,
              'assigned' => 55,

          ]);*/

        $collection_received_total= DeliveryBoyCollection::sum('collection_amount');
         $earning_paid_total=DeliveryBoyPayment::sum('payment');

        return response()->json([
            'completed_delivery' => Order::where('assign_delivery_boy', $id)->where('delivery_status', 'delivered')->count(),
            'pending_delivery' => Order::where('assign_delivery_boy', $id)->where('delivery_status', '!=', 'delivered')->where('delivery_status', '!=', 'cancelled')->where('cancel_request', '0')->count(),
            'total_collection' => format_price($delivery_boy->total_collection),
            'total_earning' => format_price($delivery_boy->total_earning),
            'collection_received_total'=>format_price($collection_received_total),
            'earning_paid_total'=>format_price($earning_paid_total),
            'cancelled' => Order::where('assign_delivery_boy', $id)->where('delivery_status', 'cancelled')->count(),
            'on_the_way' => Order::where('assign_delivery_boy', $id)->where('delivery_status', 'on_the_way')->where('cancel_request', '0')->count(),
            'picked' => Order::where('assign_delivery_boy', $id)->where('delivery_status', 'picked_up')->where('cancel_request', '0')->count(),
            'assigned' => Order::where('assign_delivery_boy', $id)->where('delivery_status', 'pending')->where('cancel_request', '0')->count(),

        ]);
    }

    public function assigned_delivery($id)
    {
//        $order_query = Order::query();
//        $order_query->where('delivery_status', 'pending');
//        $order_query->where('cancel_request', '0');

        $order_query = Order::query();
        $order_query->where('assign_delivery_boy', $id);
        $order_query->where(function ($order_query) {
            $order_query->where('delivery_status', 'pending')
                    ->where('cancel_request', '0');
        })->orWhere(function ($order_query) {
            $order_query->where('delivery_status', 'confirmed')
                    ->where('cancel_request', '0');
        });

        return new DeliveryBoyPurchaseHistoryMiniCollection($order_query->latest('delivery_history_date')->paginate(10));
//        return new DeliveryBoyPurchaseHistoryMiniCollection($order_query->where('assign_delivery_boy', $id)->latest('delivery_history_date')->paginate(10));
    }

    /**
     * Show the list of pickup delivery by the delivery boy.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function picked_up_delivery($id)
    {
        $order_query = Order::query();
        $order_query->where('delivery_status', 'picked_up');
        $order_query->where('cancel_request', '0');

        return new DeliveryBoyPurchaseHistoryMiniCollection($order_query->where('assign_delivery_boy', $id)->latest('delivery_history_date')->paginate(10));
    }

    /**
     * Show the list of pickup delivery by the delivery boy.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function on_the_way_delivery($id)
    {
        $order_query = Order::query();
        $order_query->where('delivery_status', 'on_the_way');
        $order_query->where('cancel_request', '0');

        return new DeliveryBoyPurchaseHistoryMiniCollection($order_query->where('assign_delivery_boy', $id)->latest('delivery_history_date')->paginate(10));
    }
    public function non_delivered_delivery($id){
        $order_query = Order::query();
        $order_query->where('delivery_status', 'non_delivered');
        $order_query->where('cancel_request', '0');

        return new DeliveryBoyPurchaseHistoryMiniCollection($order_query->where('assign_delivery_boy', $id)->latest('delivery_history_date')->paginate(10));
    }

    /**
     * Show the list of completed delivery by the delivery boy.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function completed_delivery($id)
    {


        $order_query = Order::query();
        $order_query->where('delivery_status', 'delivered');

        //dd(request()->date_range);

        if (request()->has('date_range') && request()->date_range != null &&  request()->date_range != "") {
            $max_date = date('Y-m-d H:i:s');
            $min_date = date('Y-m-d 00:00:00');
            if (request()->date_range == "today") {
                $min_date = date('Y-m-d 00:00:00');
            } else if (request()->date_range == "this_week") {
                //dd("hello");
                $min_date = date('Y-m-d 00:00:00', strtotime("-7 days"));
            } else if (request()->date_range == "this_month") {
                $min_date = date('Y-m-d 00:00:00', strtotime("-30 days"));
            }

            $order_query->where('delivery_history_date','>=',$min_date)->where('delivery_history_date','<=',$max_date);

        }

        if (request()->has('payment_type') && request()->payment_type != null &&  request()->payment_type != "") {

            if (request()->payment_type == "cod") {
                $order_query->where('payment_type','=','cash_on_delivery');
            } else if (request()->payment_type == "non-cod") {
                $order_query->where('payment_type','!=','cash_on_delivery');
            }

        }
        // dd($order_query->where('assign_delivery_boy', $id)->latest('delivery_history_date')->paginate(10));

        return new DeliveryBoyPurchaseHistoryMiniCollection($order_query->where('assign_delivery_boy', $id)->latest('delivery_history_date')->paginate(10));
    }

    /**
     * Show the list of pending delivery by the delivery boy.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function pending_delivery($id)
    {
        $order_query = Order::query();
        $order_query->where('delivery_status', '!=', 'delivered');
        $order_query->where('delivery_status', '!=', 'cancelled');
        $order_query->where('cancel_request', '0');

        return new DeliveryBoyPurchaseHistoryMiniCollection($order_query->where('assign_delivery_boy', $id)->latest('delivery_history_date')->paginate(10));
    }

    /**
     * Show the list of cancelled delivery by the delivery boy.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function cancelled_delivery($id)
    {

        $res=\App\DeliveryBoyCancel::where('user_id', $id)->get();
        $ids=[];
        foreach($res as $r){
            array_push($ids,$r->order_id);
        }
        // $completed_deliveries = Order::whereIn('id',$ids)
        //         ->latest()
        //         ->paginate(10);
        $order_query = Order::query();
        $order_query->whereIn('id',$ids);
        // $order_query->where('delivery_status', 'cancelled');

        if (request()->has('date_range') && request()->date_range != null &&  request()->date_range != "") {
            $max_date = date('Y-m-d H:i:s');
            $min_date = date('Y-m-d 00:00:00');
            if (request()->date_range == "today") {
                $min_date = date('Y-m-d 00:00:00');
            } else if (request()->date_range == "this_week") {
                //dd("hello");
                $min_date = date('Y-m-d 00:00:00', strtotime("-7 days"));
            } else if (request()->date_range == "this_month") {
                $min_date = date('Y-m-d 00:00:00', strtotime("-30 days"));
            }

            $order_query->where('delivery_history_date','>=',$min_date)->where('delivery_history_date','<=',$max_date);

        }

        if (request()->has('payment_type') && request()->payment_type != null &&  request()->payment_type != "") {

            if (request()->payment_type == "cod") {
                $order_query->where('payment_type','=','cash_on_delivery');
            } else if (request()->payment_type == "non-cod") {
                $order_query->where('payment_type','!=','cash_on_delivery');
            }

        }
        // dd($order_query->where('assign_delivery_boy', $id)->latest()->paginate(10));

        return new PurchaseHistoryMiniCollection($order_query->paginate(10));
    }

    /**
     * Show the list of today's collection by the delivery boy.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function collection(Request $request, $id)
    {
        $collection_query = DeliveryHistory::query();
        $collection_query->where('delivery_status', 'delivered');
        $collection_query->where('payment_type', 'cash_on_delivery');
        $from=$request->from_date;
        $to=$request->to_date;
        if($from && $to){
            // dd(Carbon::createFromFormat('Y-m-d',$from)->addDays(-1));
           if($from == $to){
            $collection_query->where('created_at','like',"%$from%");
           }else{
            //    dd(Carbon::createFromFormat('Y-m-d',$from));
            $collection_query->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=',  $to);
            //  $collection_query->whereBetween('created_at',[$from,$to]);
           }
        }

        return new DeliveryHistoryCollection($collection_query->where('delivery_boy_id', $id)->latest()->paginate(10));
    }





    public function colleection_received(Request $request,$id){
        $total=DeliveryBoyCollection::where('user_id',$id);
        $from=$request->from_date;
        $to=$request->to_date;
        if($from && $to){
            // dd(Carbon::createFromFormat('Y-m-d',$from)->addDays(-1));
           if($from == $to){
            $collection_query->where('created_at','like',"%$from%");
           }else{
            //    dd(Carbon::createFromFormat('Y-m-d',$from));
            $collection_query->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=',  $to);
            //  $collection_query->whereBetween('created_at',[$from,$to]);
           }
        }

        return new DeliveryBoyCollectioCollection($total->latest()->paginate(10));
    }


    public function earning(Request $request, $id)
    {
        $collection_query = DeliveryHistory::query();
        $collection_query->where('delivery_status', 'delivered');
        $collection_query->where('payment_type', 'cash_on_delivery');
        $from=$request->from_date;
        $to=$request->to_date;
        if($from && $to){
            // dd(Carbon::createFromFormat('Y-m-d',$from)->addDays(-1));
           if($from == $to){
            $collection_query->where('created_at','like',"%$from%");
           }else{
            //    dd(Carbon::createFromFormat('Y-m-d',$from));
            $collection_query->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=',  $to);
            //  $collection_query->whereBetween('created_at',[$from,$to]);
           }
        }

        return new DeliveryHistoryCollection($collection_query->where('delivery_boy_id', $id)->latest()->paginate(10));
    }



    public function earning_summary(Request $request,$id)
    {
        $total=0;
        $from=$request->from_date;
        $to=$request->to_date;
        $collection_query = DeliveryHistory::query();
        $collection_query->where('delivery_status', 'delivered');
        $collection_query->where('payment_type', 'cash_on_delivery')->where('delivery_boy_id', $id);


        $today_date = date('Y-m-d');
        $yesterday_date = date('Y-m-d', strtotime("-1 day"));
        $last_week= date('Y-m-d', strtotime("-7 day"));
        $last_month= date('Y-m-d', strtotime("-30 day"));
        $today_date_formatted = date('d M, Y');
        $yesterday_date_formatted = date('d M,Y', strtotime("-1 day"));


        $today_collection = DeliveryHistory::where('delivery_status', 'delivered')
            ->where('payment_type', 'cash_on_delivery')
            ->where('delivery_boy_id', $id)
            ->where('created_at','like',"%$today_date%")
            ->sum('earning');
        $this_week_collection = DeliveryHistory::where('delivery_status', 'delivered')
            ->where('payment_type', 'cash_on_delivery')
            ->where('delivery_boy_id', $id)
            ->where('created_at','>=',"$last_week")
            ->where('created_at', '<=', "$today_date")
            ->sum('earning');
            $this_month_collection = DeliveryHistory::where('delivery_status', 'delivered')
            ->where('payment_type', 'cash_on_delivery')
            ->where('delivery_boy_id', $id)
            ->where('created_at','>=',"$last_month")
            ->where('created_at', '<=', "$today_date")
            ->sum('earning');


        $yesterday_collection = DeliveryHistory::where('delivery_status', 'delivered')
            ->where('payment_type', 'cash_on_delivery')
            ->where('delivery_boy_id', $id)
            ->where('created_at','like',"%$yesterday_date%")
            ->sum('earning');

            if($from && $to){
                // dd(Carbon::createFromFormat('Y-m-d',$from)->addDays(-1));
               if($from == $to){
                $collection_query->where('created_at','like',"%$from%");
               }else{
                //    dd(Carbon::createFromFormat('Y-m-d',$from));
                $collection_query->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=',  $to);
                //  $collection_query->whereBetween('created_at',[$from,$to]);
               }
            }
            $total= $collection_query->sum('earning');
            return response()->json([
            'today_date' => $today_date_formatted,
            'today_earning' => format_price($today_collection) ,
            'yesterday_date' => $yesterday_date_formatted,
            'yesterday_earning' => format_price($yesterday_collection) ,
            'this_week_earning'=>$this_week_collection,
            'this_month_earning'=>$this_month_collection,
            'total_earning' =>$total,
            'from_date'=>$from,
            'to_date'=>$to,

        ]);
    }

    public function earning_paid_summary(Request $request,$id){
        $total=0;
        $from=$request->from_date;
        $to=$request->to_date;

        $today_date = date('Y-m-d');
        $yesterday_date = date('Y-m-d', strtotime("-1 day"));
        $today_date_formatted = date('d M, Y');
        $yesterday_date_formatted = date('d M,Y', strtotime("-1 day"));
          $last_week= date('Y-m-d', strtotime("-7 day"));
        $last_month= date('Y-m-d', strtotime("-30 day"));


        $today_collection = DeliveryBoyPayment::
            where('user_id',$id)
            ->where('created_at','like',"%$today_date%")
            ->sum('payment');

        $yesterday_collection = DeliveryBoyPayment::
            where('user_id',$id)
            ->where('created_at','like',"%$yesterday_date%")
            ->sum('payment');


            $this_week_collection = DeliveryBoyPayment::where('user_id',$id)
            ->where('created_at','>=',"$last_week")
            ->where('created_at', '<=', "$today_date")
             ->sum('payment');

            $this_month_collection = DeliveryBoyPayment::where('user_id',$id)
            ->where('created_at','>=',"$last_month")
            ->where('created_at', '<=', "$today_date")
             ->sum('payment');


            $collection_query=DeliveryBoyPayment::query();
            if($from && $to){
                // dd(Carbon::createFromFormat('Y-m-d',$from)->addDays(-1));
               if($from == $to){
                $collection_query->where('created_at','like',"%$from%");
               }else{
                //    dd(Carbon::createFromFormat('Y-m-d',$from));
                $collection_query->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=',  $to);
                //  $collection_query->whereBetween('created_at',[$from,$to]);
               }
            }
        $total=$collection_query->where('user_id',$id)->sum('payment');
        return response()->json([
            'today_date' => $today_date_formatted,
            'today_earning' => format_price($today_collection) ,
            'yesterday_date' => $yesterday_date_formatted,
            'yesterday_' => format_price($yesterday_collection) ,
            'this_week_earning'=>$this_week_collection,
            'this_month_earning'=>$this_month_collection,
            'total_earning'=>$total,
            'from_date'=>$from,
            'to_date'=>$to,
        ]);


    }
    public function colleection_received_summary(Request $request,$id){
        $total=0;
        $from=$request->from_date;
        $to=$request->to_date;

        $today_date = date('Y-m-d');
        $yesterday_date = date('Y-m-d', strtotime("-1 day"));
        $today_date_formatted = date('d M, Y');
        $yesterday_date_formatted = date('d M,Y', strtotime("-1 day"));
        $last_week= date('Y-m-d', strtotime("-7 day"));
        $last_month= date('Y-m-d', strtotime("-30 day"));


        $today_collection = DeliveryBoyCollection::
            where('user_id',$id)
            ->where('created_at','like',"%$today_date%")
            ->sum('collection_amount');

        $yesterday_collection = DeliveryBoyCollection::
            where('user_id',$id)
            ->where('created_at','like',"%$yesterday_date%")
            ->sum('collection_amount');



            $this_week_collection = DeliveryBoyCollection::where('user_id',$id)
            ->where('created_at','>=',"$last_week")
            ->where('created_at', '<=', "$today_date")
             ->sum('collection_amount');

            $this_month_collection = DeliveryBoyCollection::where('user_id',$id)
            ->where('created_at','>=',"$last_month")
            ->where('created_at', '<=', "$today_date")
             ->sum('collection_amount');


            $collection_query=DeliveryBoyCollection::query();
            if($from && $to){
                // dd(Carbon::createFromFormat('Y-m-d',$from)->addDays(-1));
               if($from == $to){
                $collection_query->where('created_at','like',"%$from%");
               }else{
                //    dd(Carbon::createFromFormat('Y-m-d',$from));
                $collection_query->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=',  $to);
                //  $collection_query->whereBetween('created_at',[$from,$to]);
               }
            }
        $total=$collection_query->where('user_id',$id)->sum('collection_amount');
        return response()->json([
            'today_date' => $today_date_formatted,
            'today_collection' => format_price($today_collection) ,
            'yesterday_date' => $yesterday_date_formatted,
            'yesterday_collection' => format_price($yesterday_collection) ,
            'this_week_collection'=>$this_week_collection,
            'this_month_collection'=>$this_month_collection,
            'total_collection' =>$total,
            'from_date'=>$from,
            'to_date'=>$to,
        ]);
    }
    public function collection_summary(Request $request,$id)
    {
        $total=0;
        $from=$request->from_date;
        $to=$request->to_date;
        $collection_query = DeliveryHistory::query();
        $collection_query->where('delivery_status', 'delivered');
        $collection_query->where('payment_type', 'cash_on_delivery');


        $today_date = date('Y-m-d');
        $yesterday_date = date('Y-m-d', strtotime("-1 day"));
        $today_date_formatted = date('d M, Y');
        $yesterday_date_formatted = date('d M,Y', strtotime("-1 day"));
        $last_week= date('Y-m-d', strtotime("-7 day"));
        $last_month= date('Y-m-d', strtotime("-30 day"));


        $today_collection = DeliveryHistory::where('delivery_status', 'delivered')
            ->where('payment_type', 'cash_on_delivery')
            ->where('delivery_boy_id', $id)
            ->where('created_at','like',"%$today_date%")
            ->sum('collection');

        $yesterday_collection = DeliveryHistory::where('delivery_status', 'delivered')
            ->where('payment_type', 'cash_on_delivery')
            ->where('delivery_boy_id', $id)
            ->where('created_at','like',"%$yesterday_date%")
            ->sum('collection');
            $this_week_collection = DeliveryHistory::where('delivery_status', 'delivered')
            ->where('payment_type', 'cash_on_delivery')
            ->where('delivery_boy_id', $id)
            ->where('created_at','>=',"$last_week")
            ->where('created_at', '<=', "$today_date")
            ->sum('collection');
            $this_month_collection = DeliveryHistory::where('delivery_status', 'delivered')
            ->where('payment_type', 'cash_on_delivery')
            ->where('delivery_boy_id', $id)
            ->where('created_at','>=',"$last_month")
            ->where('created_at', '<=', "$today_date")
            ->sum('collection');
            if($from && $to){
                // dd(Carbon::createFromFormat('Y-m-d',$from)->addDays(-1));
               if($from == $to){
                $collection_query->where('created_at','like',"%$from%");
               }else{
                //    dd(Carbon::createFromFormat('Y-m-d',$from));
                $collection_query->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=',  $to);
                //  $collection_query->whereBetween('created_at',[$from,$to]);
               }
            }
            $total= $collection_query->where('delivery_boy_id', $id)->sum('collection');

            return response()->json([
            'today_date' => $today_date_formatted,
            'today_collection' => format_price($today_collection) ,
            'yesterday_date' => $yesterday_date_formatted,
            'yesterday_collection' => format_price($yesterday_collection) ,
            'this_week_collection'=>$this_week_collection,
            'this_month_collection'=>$this_month_collection,
            'total_collection' =>$total,
            'from_date'=>$from,
            'to_date'=>$to,

        ]);
    }
    public function earning_paid(Request $request,$id){

        $total=DeliveryBoyPayment::where('user_id',$id);
        $from=$request->from_date;
        $to=$request->to_date;
        if($from && $to){
            // dd(Carbon::createFromFormat('Y-m-d',$from)->addDays(-1));
           if($from == $to){
            $collection_query->where('created_at','like',"%$from%");
           }else{
            //    dd(Carbon::createFromFormat('Y-m-d',$from));
            $collection_query->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=',  $to);
            //  $collection_query->whereBetween('created_at',[$from,$to]);
           }
        }
        return new DeliveryBoyPaymentCollection($total->latest()->paginate(10));


    }



    /**
     * For only delivery boy while changing delivery status.
     * Call from order controller
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function change_delivery_status(Request $request) {
        $order = Order::find($request->order_id);
        $order->delivery_viewed = '0';
        $order->delivery_status = $request->status;
        $order->save();

        $delivery_history = new DeliveryHistory;

        $delivery_history->order_id         = $order->id;
        $delivery_history->delivery_boy_id  = $request->delivery_boy_id;
        $delivery_history->delivery_status  = $order->delivery_status;
        $delivery_history->payment_type     = $order->payment_type;

        if(($order->delivery_status == 'delivered') || ($order->delivery_status == 'delivery_cancel') ) {
            foreach ($order->orderDetails as $key => $orderDetail) {
                if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                    if ($orderDetail->product_referral_code) {
                        $no_of_delivered = 0;
                        $no_of_canceled = 0;

                        if($request->status == 'delivered') {
                            $no_of_delivered = $orderDetail->quantity;
                        }
                        if($request->status == 'cancelled') {
                            $no_of_canceled = $orderDetail->quantity;
                        }

                        $referred_by_user = User::where('referral_code', $orderDetail->product_referral_code)->first();

                        $affiliateController = new AffiliateController;
                        $affiliateController->processAffiliateStats($referred_by_user->id, 0, 0, $no_of_delivered, $no_of_canceled);
                    }
                }
            }
            $delivery_boy = DeliveryBoy::where('user_id', $request->delivery_boy_id)->first();

            if (get_setting('delivery_boy_payment_type') == 'commission') {
                $delivery_history->earning = get_setting('delivery_boy_commission');
                $delivery_boy->total_earning += get_setting('delivery_boy_commission');
            }
            if ($order->payment_type == 'cash_on_delivery') {
                $delivery_history->collection = $order->grand_total;
                $delivery_boy->total_collection += $order->grand_total;

                $order->payment_status = 'paid';
                if ($order->commission_calculated == 0) {
                    commission_calculation($order);
                    $order->commission_calculated = 1;
                }

            }

            $delivery_boy->save();
        }
        $order->delivery_history_date = date("Y-m-d H:i:s");

        $order->save();
        $delivery_history->save();

        if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_delivery_status')->first()->value){
            try {
                $otpController = new OTPVerificationController;
                $otpController->send_delivery_status($order);
            } catch (\Exception $e) {
            }
        }

        return response()->json([
            'result' => true,
            'message' => 'Delivery status changed to '.ucwords(str_replace('_',' ',$request->status))
        ]);
    }

    public function cancel_request($id)
    {
        $order =  Order::find($id);

        $order->cancel_request = 1;
        $order->cancel_request_at = date('Y-m-d H:i:s');
        $order->save();

        return response()->json([
            'result' => true,
            'message' => 'Requested for cancellation'
        ]);
    }
    public function earning_summary_between(Request $request, $id){
        $collection_query = DeliveryHistory::query();
        $collection_query->where('delivery_status', 'delivered');
        $collection_query->where('payment_type', 'cash_on_delivery');
        $from=$request->from_date;
        $to=$request->to_date;
        // ('2018-01-01');

        // $today_date = date('Y-m-d');
        // $yesterday_date = date('Y-m-d', strtotime("-1 day"));
        // $today_date_formatted = date('d M, Y');
        // $yesterday_date_formatted = date('d M,Y', strtotime("-1 day"));
        return new DeliveryHistoryCollection($collection_query->where('delivery_boy_id', $id)->whereBetween('created_at', [$from, $to])->latest()->paginate(10));
    }
    public function collection_summary_between(Request $request,$id){
        $collection_query = DeliveryHistory::query();
        $collection_query->where('delivery_status', 'delivered');
        $collection_query->where('payment_type', 'cash_on_delivery');
        $from=$request->from_date;
        $to=$request->to_date;


        // $today_date = date('Y-m-d');
        // $yesterday_date = date('Y-m-d', strtotime("-1 day"));
        // $today_date_formatted = date('d M, Y');
        // $yesterday_date_formatted = date('d M,Y', strtotime("-1 day"));
        return new DeliveryHistoryCollection($collection_query->where('delivery_boy_id', $id)->whereBetween('created_at', [$from, $to])->latest()->paginate(10));


    }
    public function colleection_received_between(Request $request,$id){
        $total=DeliveryBoyCollection::where('user_id',$id);
        $from=$request->from_date;
        $to=$request->to_date;
        return new DeliveryBoyCollectioCollection($total->whereBetween('created_at', [$from, $to])->latest()->paginate(10));
    }
}
