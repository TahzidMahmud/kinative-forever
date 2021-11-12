<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OTPVerificationController;
use App\Http\Controllers\ClubPointController;
use App\Http\Controllers\AffiliateController;
use App\Order;
use App\Cart;
use App\Address;
use App\Product;
use App\ProductStock;
use App\CommissionHistory;
use App\Color;
use App\OrderDetail;
use App\CouponUsage;
use App\Coupon;
use App\OtpConfiguration;
use App\User;
use App\BusinessSetting;
use Auth;
use Session;
use DB;
use Mail;
use App\Mail\InvoiceEmailManager;
use CoreComponentRepository;
use App\Utility\SmsUtility;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource to seller.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
//                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('seller_id', Auth::user()->id)
                    ->select('orders.id')
                    ->distinct();

        if ($request->payment_status != null){
            $orders = $orders->where('payment_status', $request->payment_status);
            $payment_status = $request->payment_status;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')){
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
        }

        $orders = $orders->paginate(15);

        foreach ($orders as $key => $value) {
            $order = \App\Order::find($value->id);
            $order->viewed = 1;
            $order->save();
        }

        return view('frontend.user.seller.orders', compact('orders','payment_status','delivery_status', 'sort_search'));
    }

    // All Orders
    public function all_orders(Request $request)
    {
         CoreComponentRepository::instantiateShopRepository();

         $date = $request->date;
         $sort_search = null;
         $delivery_status = null;

         $orders = Order::orderBy('code', 'desc');
         if ($request->has('search')){
             $sort_search = $request->search;
             $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
         }
         if ($request->delivery_status != null) {
            $orders = $orders->where('delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
         if ($date != null) {
             $orders = $orders->where('created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
         }
         $orders = $orders->paginate(17);

         return view('backend.sales.all_orders.index', compact('orders', 'sort_search', 'delivery_status', 'date'));
    }

    public function all_orders_show($id)
    {
         $order = Order::findOrFail(decrypt($id));
         $order_shipping_address = json_decode($order->shipping_address);
         $delivery_boys = User::where('city', $order_shipping_address->city)
                ->where('user_type', 'delivery_boy')
                ->get();

         return view('backend.sales.all_orders.show', compact('order', 'delivery_boys'));
    }

    // Inhouse Orders
    public function admin_orders(Request $request)
    {
        CoreComponentRepository::instantiateShopRepository();

        $date = $request->date;
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $admin_user_id = User::where('user_type', 'admin')->first()->id;
        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
//                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('seller_id', $admin_user_id)
                    ->select('orders.id')
                    ->distinct();

        if ($request->payment_type != null){
            $orders = $orders->where('payment_status', $request->payment_type);
            $payment_status = $request->payment_type;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')){
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
        }
        if ($date != null) {
            $orders = $orders->whereDate('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
        }

        $orders = $orders->paginate(15);
        return view('backend.sales.inhouse_orders.index', compact('orders','payment_status','delivery_status', 'sort_search', 'admin_user_id', 'date'));
    }

    public function show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        $order->viewed = 1;
        $order->save();
        return view('backend.sales.inhouse_orders.show', compact('order'));
    }

    // Seller Orders
    public function seller_orders(Request $request)
    {
        CoreComponentRepository::instantiateShopRepository();

        $date = $request->date;
        $seller_id = $request->seller_id;
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $admin_user_id = User::where('user_type', 'admin')->first()->id;
        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
//                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('orders.seller_id', '!=' ,$admin_user_id)
                    ->select('orders.id')
                    ->distinct();

        if ($request->payment_type != null){
            $orders = $orders->where('orders.payment_status', $request->payment_type);
            $payment_status = $request->payment_type;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')){
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
        }
        if ($date != null) {
            $orders = $orders->whereDate('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
        }
        if ($seller_id) {
            $orders = $orders->where('seller_id', $seller_id);
        }

        $orders = $orders->paginate(15);
        return view('backend.sales.seller_orders.index', compact('orders', 'payment_status', 'delivery_status', 'sort_search', 'admin_user_id', 'seller_id', 'date'));
    }

    public function seller_orders_show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        $order->viewed = 1;
        $order->save();
        return view('backend.sales.seller_orders.show', compact('order'));
    }


    // Pickup point orders
    public function pickup_point_order_index(Request $request)
    {
        $date = $request->date;
        $sort_search = null;

        if (Auth::user()->user_type == 'staff' && Auth::user()->staff->pick_up_point != null) {
            //$orders = Order::where('pickup_point_id', Auth::user()->staff->pick_up_point->id)->get();
            $orders = DB::table('orders')
                        ->orderBy('code', 'desc')
                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->where('order_details.pickup_point_id', Auth::user()->staff->pick_up_point->id)
                        ->select('orders.id')
                        ->distinct();

            if ($request->has('search')){
                $sort_search = $request->search;
                $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
            }
            if ($date != null) {
                $orders = $orders->whereDate('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
            }

            $orders = $orders->paginate(15);

            return view('backend.sales.pickup_point_orders.index', compact('orders', 'sort_search', 'date'));
        }
        else{
            //$orders = Order::where('shipping_type', 'Pick-up Point')->get();
            $orders = DB::table('orders')
                        ->orderBy('code', 'desc')
                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->where('order_details.shipping_type', 'pickup_point')
                        ->select('orders.id')
                        ->distinct();

            if ($request->has('search')){
                $sort_search = $request->search;
                $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
            }
            if ($date != null) {
                $orders = $orders->whereDate('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
            }

            $orders = $orders->paginate(15);

            return view('backend.sales.pickup_point_orders.index', compact('orders', 'sort_search', 'date'));
        }
    }

    public function pickup_point_order_sales_show($id)
    {
        if (Auth::user()->user_type == 'staff') {
            $order = Order::findOrFail(decrypt($id));
            return view('backend.sales.pickup_point_orders.show', compact('order'));
        }
        else{
            $order = Order::findOrFail(decrypt($id));
            return view('backend.sales.pickup_point_orders.show', compact('order'));
        }
    }

    /**
     * Display a single sale to admin.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $order = new Order;
        $carts = array();
        if(Auth::check()){
            $order->user_id = Auth::user()->id;
            $carts = Cart::where('user_id', Auth::user()->id)->get();

            $shipping_info = Address::where('id', $carts[0]['address_id'])->first();
            $shipping_info->email = Auth::user()->email;
            if($shipping_info->latitude || $shipping_info->longitude) {
                $shipping_info->lat_lang = $shipping_info->latitude.','.$shipping_info->longitude;
            }

            $billing_info = Address::where('id', $carts[0]['billing_address_id'])->first();
            $shipping_info->email = Auth::user()->email;

            $order->shipping_address = json_encode($shipping_info);
            $order->billing_address = json_encode($billing_info);
        }
        else{
            $temp_user_id = Session()->get('temp_user_id');
            if($temp_user_id) {
                $carts = Cart::where('temp_user_id', $temp_user_id)->get();
                if (count($carts) > 0) {
                    $order->shipping_address = $carts[0]->shipping_address;
                    $order->billing_address = $carts[0]->billing_address;
                }
            }
            $order->guest_id = mt_rand(100000, 999999);
        }
        if (count($carts) == 0) {
            $order->delete();
            flash(translate('Your cart is empty'))->warning();
            return redirect()->route('home');
        }

        $order->delivery_date=$carts[0]->delivery_date;
        $order->seller_id = $request->owner_id;

        $order->payment_type = $request->payment_option;
        $order->delivery_viewed = '0';
        $order->payment_status_viewed = '0';
        $order->note=$carts[0]["note"];


        // $order->code = date('Ymd-His').rand(10,99);
        $order->date = strtotime('now');

        if($order->save()){
            $subtotal = 0;
            $tax = 0;
            $shipping = 0;

            //calculate shipping is to get shipping costs of different types
            $admin_products = array();
            $seller_products = array();

            //Order Details Storing
            foreach ($carts as $key => $cartItem){
                $product = Product::find($cartItem['product_id']);

                if($product->added_by == 'admin') {
                    array_push($admin_products, $cartItem['product_id']);
                }
                else {
                    $product_ids = array();
                    if(array_key_exists($product->user_id, $seller_products)){
                        $product_ids = $seller_products[$product->user_id];
                    }
                    array_push($product_ids, $cartItem['product_id']);
                    $seller_products[$product->user_id] = $product_ids;
                }

                $subtotal += $cartItem['price']*$cartItem['quantity'];
                $tax += $cartItem['tax']*$cartItem['quantity'];

                $product_variation = $cartItem['variation'];

                $product_stock = $product->stocks->where('variant', $product_variation)->first();
                if($product->digital != 1 &&  $cartItem['quantity'] > $product_stock->qty) {
                    flash(translate('The requested quantity is not available for ').$product->getTranslation('name'))->warning();
                    $order->delete();
                    return redirect()->route('cart')->send();
                }
                elseif ($product->digital != 1) {
                    $product_stock->qty -= $cartItem['quantity'];
                    $product_stock->save();
                }

                $order_detail = new OrderDetail;
                $order_detail->order_id  = $order->id;
                $order_detail->seller_id = $product->user_id;
                $order_detail->product_id = $product->id;
                $order_detail->variation = $product_variation;
                $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
                $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                $order_detail->shipping_type = $cartItem['shipping_type'];
                $order_detail->product_referral_code = $cartItem['product_referral_code'];
                $order_detail->shipping_cost = $cartItem['shipping_cost'];

                $shipping += $order_detail->shipping_cost;

                if ($cartItem['shipping_type'] == 'pickup_point') {
                    $order_detail->time_slot=$cartItem['time_slot'];
                    $order_detail->pickup_point_id = $cartItem['pickup_point'];
                }
                //End of storing shipping cost

                $order_detail->quantity = $cartItem['quantity'];
                $order_detail->save();

                $product->num_of_sale++;
                $product->save();

                if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null &&
                        \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                    if($order_detail->product_referral_code) {
                        $referred_by_user = User::where('referral_code', $order_detail->product_referral_code)->first();

                        $affiliateController = new AffiliateController;
                        $affiliateController->processAffiliateStats($referred_by_user->id, 0, $order_detail->quantity, 0, 0);
                    }
                }
            }

            $order->grand_total = $subtotal + $tax + $shipping;

            if ($carts->first()->coupon_code != '') {
                $order->grand_total -= $carts->sum('discount');
                if(Session::has('club_point')){
                    $order->club_point = Session::get('club_point');
                }
                $order->coupon_discount = $carts->sum('discount');

//                $clubpointController = new ClubPointController;
//                $clubpointController->deductClubPoints($order->user_id, Session::get('club_point'));

                $coupon_usage = new CouponUsage;
                $coupon_usage->user_id = Auth::user()->id;
                $coupon_usage->coupon_id = Coupon::where('code', $carts->first()->coupon_code)->first()->id;
                $coupon_usage->save();
            }

            $order->save();

            $array['view'] = 'emails.invoice';
            $array['subject'] = translate('Your order has been placed').' - '.$order->code;
            $array['from'] = env('MAIL_FROM_ADDRESS');
            $array['order'] = $order;

            foreach($seller_products as $key => $seller_product){
                try {
                    Mail::to(\App\User::find($key)->email)->queue(new InvoiceEmailManager($array));
                } catch (\Exception $e) {

                }
            }

            if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_order')->first()->value){
                try {
                    $otpController = new OTPVerificationController;
                    $otpController->send_order_code($order);
                } catch (\Exception $e) {

                }
            }

            //sends Notifications to user
            send_notification($order, 'placed');

            //sends email to customer with the invoice pdf attached
            if(env('MAIL_USERNAME') != null){
                try {
                    Mail::to(Auth::user()->email)->queue(new InvoiceEmailManager($array));
                    Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
                } catch (\Exception $e) {

                }
            }

            $request->session()->put('order_id', $order->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        $subtotal = 0;
        $tax = 0;
        $shipping = 0;
        $pos_cart = $order->orderDetails;
        $data = array();
        $cart = collect();
        foreach ($pos_cart as $key => $cartItem){
            $data['detail_id'] = $cartItem->id;
            $data['id'] = $cartItem->product_id;
            if($cartItem->product->variant_product){
                $data['stock_id'] = ProductStock::where('product_id',$cartItem->product_id)->where('variant',$cartItem->variation)->first()->id;
            }else{
                $data['stock_id'] = ProductStock::where('product_id',$cartItem->product_id)->first()->id;
            }
            $data['variant'] = $cartItem->variation;
            $data['quantity'] = $cartItem->quantity;
            $data['price'] = $cartItem->price/$cartItem->quantity;
            $data['tax'] = $cartItem->tax;
            $data['shipping'] = $cartItem->shipping_cost;

            $cart->push($data);

            $subtotal += $cartItem['price'] * $cartItem['quantity'];
            $tax += $cartItem['tax'] * $cartItem['quantity'];
            $shipping += $cartItem['shipping_cost'];
        }
        Session::put('order_edit.cart', $cart);
        Session::put('order_edit.discount', $order->coupon_discount);
        Session::put('order_edit.shipping', round($shipping));


        $shipping_data = array();
        if ($order->user_id != null) {
            $shipping_data['customer_id'] = $order->user_id;
        }else{
            $shipping_data['customer_id'] = null;
        }
        $shipping_data['address_id'] = optional(json_decode($order->shipping_address))->address_id;
        $shipping_data['name'] = optional(json_decode($order->shipping_address))->name;
        $shipping_data['address'] = optional(json_decode($order->shipping_address))->address;
        $shipping_data['country'] = optional(json_decode($order->shipping_address))->country;
        $shipping_data['city'] = optional(json_decode($order->shipping_address))->city;
        $shipping_data['area'] = optional(json_decode($order->shipping_address))->area;
        $shipping_data['postal_code'] = optional(json_decode($order->shipping_address))->postal_code;
        $shipping_data['phone'] = optional(json_decode($order->shipping_address))->phone;


        Session::put('order_edit.shipping_info',$shipping_data);

        return view('backend.sales.all_orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(Session::has('order_edit.cart') && count(Session::get('order_edit.cart')) > 0){
            $order = Order::findOrFail($request->order_id);
            $name = '';
            $email = '';
            $address = '';
            $country = '';
            $city = '';
            $postal_code = '';
            $phone = '';

            if ($request->user_id == null) {
                $order->guest_id    = mt_rand(100000, 999999);
                $name               = $request->name;
                $email              = $request->email;
                $address            = $request->address;
                $country            = $request->country;
                $city               = $request->city;
                $postal_code        = $request->postal_code;
                $phone              = $request->phone;
            }
            else {
                $order->user_id = $request->user_id;
                $user           = User::findOrFail($request->user_id);
                $name   = $user->name;
                $email  = $user->email;

                if($request->address_id != null){
                    $address_data   = Address::findOrFail($request->address_id);
                    $address        = $address_data->address;
                    $country        = $address_data->country;
                    $city           = $address_data->city;
                    $postal_code    = $address_data->postal_code;
                    $phone          = $address_data->phone;
                }
            }

            $data['address_id']     = $request->address_id;
            $data['name']           = $name;
            $data['email']          = $email;
            $data['address']        = $address;
            $data['country']        = $country;
            $data['city']           = $city;
            $data['postal_code']    = $postal_code;
            $data['phone']          = $phone;

            $order->shipping_address = json_encode($data);

            $order->payment_type = $request->payment_type;
            $order->delivery_viewed = '0';
            $order->payment_status_viewed = '0';
            // $order->code = date('Ymd-His').rand(10,99);
            $order->date = strtotime('now');
            // $order->payment_status = 'paid';
            $order->payment_details = $request->payment_type;
            if($order->save()){
                $subtotal = 0;
                $tax = 0;
                $shipping = 0;
                $new_array = array();
                foreach (Session::get('order_edit.cart') as $key => $cartItem){
                    $product_stock = ProductStock::find($cartItem['stock_id']);
                    $product = $product_stock->product;
                    if($product_stock->variant == null){
                        $order_detail = OrderDetail::where('order_id',$order->id)->where('product_id',$cartItem['id'])->first();
                    }else{
                        $order_detail = OrderDetail::where('order_id',$order->id)->where('product_id',$cartItem['id'])->where('variation',$product_stock->variant)->first();
                    }


                    $product_variation = $product_stock->variant;
                    $subtotal += $cartItem['price']*$cartItem['quantity'];
                    $tax += $cartItem['tax']*$cartItem['quantity'];

                    if($order_detail == null){
                        $order_detail = new OrderDetail;
                        if($cartItem['quantity'] > $product_stock->qty){
                            return array('success' => 0, 'message' => $product->name.' ('.$product_variation.') '.translate(" just stock outs."));
                        }else{
                            $product_stock->qty -= $cartItem['quantity'];
                            $product_stock->save();
                        }
                    }elseif($order_detail->quantity > $cartItem['quantity']){
                        $product_stock->qty += ($order_detail->quantity - $cartItem['quantity']);
                        $product_stock->save();
                    }elseif($order_detail->quantity < $cartItem['quantity']){
                        if($cartItem['quantity'] > ($product_stock->qty + $order_detail->quantity) ){
                            return array('success' => 0, 'message' => $product->name.' ('.$product_variation.') '.translate(" just stock outs."));
                        }else{
                            $product_stock->qty -= $cartItem['quantity'];
                            $product_stock->save();
                        }
                    }


                    $order_detail->order_id = $order->id;
                    $order_detail->seller_id = $product->user_id;
                    $order_detail->product_id = $product->id;
                    // $order_detail->payment_status = 'paid';
                    $order_detail->variation = $product_variation;
                    $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
                    $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                    $order_detail->shipping_type = null;
                    $order_detail->shipping_cost = Session::get('order_edit.shipping', 0)/count(Session::get('order_edit.cart'));
                    $order_detail->quantity = $cartItem['quantity'];
                    $order_detail->save();

                    array_push($new_array, $order_detail->id);

                    $product->num_of_sale++;
                    $product->save();
                }

                // dd($order->orderDetails,$new_array);
                foreach ($order->orderDetails as $key => $row) {
                    if(!in_array($row->id, $new_array, true)) {
                        // dd($new_array,$row->id);
                        if($order_detail->variation == null || $order_detail->variation == ''){
                            $product_stock = ProductStock::where('product_id',$row->product_id)->first();
                        }else{
                            $product_stock = ProductStock::where('product_id',$row->product_id)->where('variant',$row->variation)->first();
                        }
                        $product_stock->qty += $order_detail->quantity;
                        $product_stock->save();
                        $orr = OrderDetail::find($row->id);
                        $orr->delete();
                        // dd($row->delete());
                    }
                }

                // dd($order->orderDetails);


                $order->grand_total = $subtotal + $tax + Session::get('order_edit.shipping',0);

                if(Session::has('order_edit.discount')){
                    $order->grand_total -= Session::get('order_edit.discount');
                    $order->coupon_discount = Session::get('order_edit.discount');
                }

                $order->save();

                $array['view'] = 'emails.invoice';
                $array['subject'] = 'Your order has been placed - '.$order->code;
                $array['from'] = env('MAIL_USERNAME');
                $array['order'] = $order;

                if($request->user_id != NULL){
                    if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
                        $clubpointController = new ClubPointController;
                        $clubpointController->processClubPoints($order);
                    }
                }

                if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                    $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                    foreach ($order->orderDetails as $key => $orderDetail) {
                        // $orderDetail->payment_status = 'paid';
                        $orderDetail->save();
                        if($orderDetail->product->user->user_type == 'seller'){
                            $seller = $orderDetail->product->user->seller;
                            $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price*$commission_percentage)/100;
                            $seller->save();
                        }
                    }
                }
                else{
                    foreach ($order->orderDetails as $key => $orderDetail) {
                        // $orderDetail->payment_status = 'paid';
                        $orderDetail->save();
                        if($orderDetail->product->user->user_type == 'seller'){
                            $commission_percentage = $orderDetail->product->category->commision_rate;
                            $seller = $orderDetail->product->user->seller;
                            $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price*$commission_percentage)/100;
                            $seller->save();
                        }
                    }
                }

                $order->commission_calculated = 1;
                $order->save();

                $request->session()->put('order_id', $order->id);

                Session::forget('order_edit.shipping');
                Session::forget('order_edit.discount');
                Session::forget('order_edit.cart');
                Session::forget('order_edit.shipping_info');
                return array('success' => 1, 'message' => translate('Order Completed Successfully.'));
            }
            else {
                return array('success' => 0, 'message' => translate('Please input customer information.'));
            }
        }
        return array('success' => 0, 'message' => translate("Please select a product."));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        if($order != null){
            foreach($order->orderDetails as $key => $orderDetail){
                try {

                    $product_stock = ProductStock::where('product_id', $orderDetail->product_id)->where('variant', $orderDetail->variation)->first();
                    if($product_stock != null){
                        $product_stock->qty += $orderDetail->quantity;
                        $product_stock->save();
                    }

                } catch (\Exception $e) {

                }

                $orderDetail->delete();
            }
            $order->delete();
            flash(translate('Order has been deleted successfully'))->success();
        }
        else{
            flash(translate('Something went wrong'))->error();
        }
        return back();
    }

    public function bulk_order_delete(Request $request) {
        if($request->id) {
            foreach ($request->id as $order_id) {
                $this->destroy($order_id);
            }
        }

        return 1;
    }

    public function order_details(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->save();
        return view('frontend.user.seller.order_details_seller', compact('order'));
    }

    public function update_delivery_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delivery_viewed = '0';
        $order->delivery_status = $request->status;
        $order->save();

        if($request->status == 'cancelled' && $order->payment_type == 'wallet') {
            $user = User::where('id', $order->user_id)->first();
            $user->balance += $order->grand_total;
            $user->save();
        }

        if(Auth::user()->user_type == 'seller') {
            foreach($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail){
                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();

                if($request->status == 'cancelled') {
                    $product_stock = ProductStock::where('product_id', $orderDetail->product_id)
                            ->where('variant', $orderDetail->variation)
                            ->first();
                    if($product_stock != null){
                        $product_stock->qty += $orderDetail->quantity;
                        $product_stock->save();
                    }
                }
            }
        }
        else {
            foreach ($order->orderDetails as $key => $orderDetail) {

                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();

                if ($request->status == 'cancelled') {
//
                    $product_stock = ProductStock::where('product_id', $orderDetail->product_id)
                            ->where('variant', $orderDetail->variation)
                            ->first();

                    if ($product_stock != null) {
                        $product_stock->qty += $orderDetail->quantity;
                        $product_stock->save();
                    }
                }

                if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                    if (($request->status == 'delivered' || $request->status == 'cancelled') &&
                            $orderDetail->product_referral_code) {

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
        }

        //sends Notifications to user
        send_notification($order, $request->status);
//        if(send_notification($order, $request->status) && get_setting('google_firebase') == 1) {
//            send_firebase_notification();
//        }

        if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_delivery_status')->first()->value){
            try {
                $otpController = new OTPVerificationController;
                $otpController->send_delivery_status($order);
            } catch (\Exception $e) {
            }
        }

        if (\App\Addon::where('unique_identifier', 'delivery_boy')->first() != null &&
                \App\Addon::where('unique_identifier', 'delivery_boy')->first()->activated) {

            if(Auth::user()->user_type == 'delivery_boy') {
                $deliveryBoyController = new DeliveryBoyController;
                $deliveryBoyController->store_delivery_history($order);
            }
        }

        return 1;
    }

//    public function bulk_order_status(Request $request) {
////        dd($request->all());
//        if($request->id) {
//            foreach ($request->id as $order_id) {
//                $order = Order::findOrFail($order_id);
//                $order->delivery_viewed = '0';
//                $order->save();
//
//                $this->change_status($order, $request);
//            }
//        }
//
//        return 1;
//    }

    public function update_payment_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->payment_status_viewed = '0';
        $order->save();

        if(Auth::user()->user_type == 'seller'){
            foreach($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail){
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        }
        else{
            foreach($order->orderDetails as $key => $orderDetail){
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        }

        $status = 'paid';
        foreach($order->orderDetails as $key => $orderDetail){
            if($orderDetail->payment_status != 'paid'){
                $status = 'unpaid';
            }
        }
        $order->payment_status = $status;
        $order->save();


        if($order->payment_status == 'paid' && $order->commission_calculated == 0){
            commission_calculation($order);

            $order->commission_calculated = 1;
            $order->save();
        }

        //sends Notifications to user
        send_notification($order, $request->status);
//        if(send_notification($order, $request->status) && get_setting('google_firebase') == 1) {
//            send_firebase_notification();
//        }

        if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_paid_status')->first()->value){
            try {
                $otpController = new OTPVerificationController;
                $otpController->send_payment_status($order);
            } catch (\Exception $e) {
            }
        }
        return 1;
    }

    public function assign_delivery_boy(Request $request) {
        if (\App\Addon::where('unique_identifier', 'delivery_boy')->first() != null &&
                \App\Addon::where('unique_identifier', 'delivery_boy')->first()->activated) {

            $order = Order::findOrFail($request->order_id);
            $order->assign_delivery_boy = $request->delivery_boy;
            $order->delivery_history_date = date("Y-m-d H:i:s");
            $order->save();

            $delivery_history = \App\DeliveryHistory::where('order_id', $order->id)
                    ->where('delivery_status', $order->delivery_status)
                    ->first();

            if(empty($delivery_history)){
                $delivery_history = new \App\DeliveryHistory;

                $delivery_history->order_id         = $order->id;
                $delivery_history->delivery_status  = $order->delivery_status;
                $delivery_history->payment_type     = $order->payment_type;
            }
            $delivery_history->delivery_boy_id  = $request->delivery_boy;

            $delivery_history->save();

            if(env('MAIL_USERNAME') != null && get_setting('delivery_boy_mail_notification') == '1') {
                $array['view'] = 'emails.invoice';
                $array['subject'] = translate('You are assigned to delivery an order. Order code').' - '.$order->code;
                $array['from'] = env('MAIL_FROM_ADDRESS');
                $array['order'] = $order;

                try {
                    Mail::to($order->delivery_boy->email)->queue(new InvoiceEmailManager($array));
                } catch (\Exception $e) {

                }
            }

            if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null &&
                    \App\Addon::where('unique_identifier', 'otp_system')->first()->activated &&
                    get_setting('delivery_boy_otp_notification') == '1') {
                try {
                    SmsUtility::assign_delivery_boy($order->delivery_boy->phone, $order->code);
                } catch (\Exception $e) {

                }
            }
        }

        return 1;
    }



    public function addToCart(Request $request)
    {
        $stock = ProductStock::find($request->stock_id);
        $product = $stock->product;

        $data = array();
        $data['stock_id'] = $request->stock_id;
        $data['id'] = $product->id;
        $data['variant'] = $stock->variant;
        $tax = 0;

        if($stock->qty < $product->min_qty){
            return array('success' => 0, 'message' => translate("This product doesn't have enough stock for minimum purchase quantity ").$product->min_qty, 'view' => view('backend.sales.all_orders.cart')->render());
        }
        $price = $stock->price;
        $quantity = $stock->qty;

        //discount calculation  discount
        if($product->discount_type == 'percent'){
            $price -= ($price*$product->discount)/100;
        }
        elseif($product->discount_type == 'amount'){
            $price -= $product->discount;
        }

        if($product->tax_type == 'percent'){
            $tax = ($price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $tax = $product->tax;
        }

        $data['quantity'] = $product->min_qty;
        $data['price'] = $price;
        $data['tax'] = $tax;

        if($request->session()->has('order_edit.cart')){
            $foundInCart = false;
            $cart = collect();

            foreach ($request->session()->get('order_edit.cart') as $key => $cartItem){
                if($cartItem['id'] == $product->id && $cartItem['stock_id'] == $stock->id){
                    $foundInCart = true;
                    $loop_product = \App\Product::find($cartItem['id']);
                    $product_stock = $loop_product->stocks->where('variant', $cartItem['variant'])->first();
                    if(isset($cartItem['detail_id'])){
                        $order_quantity = \App\OrderDetail::find($cartItem['detail_id'])->quantity;
                    }else{
                        $order_quantity = 0;
                    }

                    if( ($product_stock->qty + $order_quantity) >= ($cartItem['quantity'] + 1)){
                        $cartItem['quantity'] += 1;
                    }else{
                        return array('success' => 0, 'message' => translate("This product doesn't have more stock."), 'view' => view('backend.sales.all_orders.cart')->render());
                    }
                }
                $cart->push($cartItem);
            }

            if (!$foundInCart) {
                $cart->push($data);
            }
            $request->session()->put('order_edit.cart', $cart);
        }
        else{
            $cart = collect([$data]);
            $request->session()->put('order_edit.cart', $cart);
        }
        return array('success' => 1, 'message' => '', 'view' => view('backend.sales.all_orders.cart')->render());
    }

    public function removeFromCart(Request $request)
    {
        if(Session::has('order_edit.cart')){
            $cart = Session::get('order_edit.cart', collect([]));
            $cart->forget($request->key);
            Session::put('order_edit.cart', $cart);
        }

        return view('backend.sales.all_orders.cart');
    }
    public function updateQuantity(Request $request)
    {
        $cart = $request->session()->get('order_edit.cart', collect([]));
        $cart = $cart->map(function ($object, $key) use ($request) {
            if($key == $request->key){
                $product = \App\Product::find($object['id']);
                $product_stock = $product->stocks->where('id', $object['stock_id'])->first();
                if(isset($object['detail_id'])){
                    $order_quantity = \App\OrderDetail::find($object['detail_id'])->quantity;
                }else{
                    $order_quantity = 0;
                }

                if( ($product_stock->qty + $order_quantity) >= $request->quantity){
                    $object['quantity'] = $request->quantity;
                }else{
                    return array('success' => 0, 'message' => translate("This product doesn't have more stock."), 'view' => view('backend.sales.all_orders.cart')->render());
                }
            }
            return $object;
        });
        $request->session()->put('order_edit.cart', $cart);

        return array('success' => 1, 'message' => '', 'view' => view('backend.sales.all_orders.cart')->render());
    }
    //Shipping Address for admin
    public function getShippingAddress(Request $request){
        $user_id = $request->id;
        // if($user_id == ''){
            return view('backend.sales.all_orders.guest_shipping_address');
        // }
        // else{
        //     return view('backend.sales.all_orders.shipping_address', compact('user_id'));
        // }
    }
    public function get_order_summary(Request $request){
        return view('backend.sales.all_orders.order_summary');
    }
    public function setDiscount(Request $request){

        // dd($request->all());
        if($request->discount >= 0){
            Session::put('pos.discount', $request->discount);
        }
        if($request->discount_type == 'percent'){
            Session::put('pos.discount_type', 'percent');
        }else{
            Session::put('pos.discount_type', 'amount');
        }
        return view('backend.sales.all_orders.cart');
    }
    public function setShipping(Request $request){
        if($request->shipping >= 0){
            Session::put('pos.shipping', $request->shipping);
        }
        return view('backend.sales.all_orders.cart');
    }
}
