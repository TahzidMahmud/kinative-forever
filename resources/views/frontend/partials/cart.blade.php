@php
if(auth()->user() != null) {
    $user_id = Auth::user()->id;
    $cart = \App\Cart::where('user_id', $user_id)->get();
} else {
    $temp_user_id = Session()->get('temp_user_id');
    if($temp_user_id) {
        $cart = \App\Cart::where('temp_user_id', $temp_user_id)->get();
    }
}
@endphp
<a href="javascript:void(0)" class="d-flex align-items-center text-alter h-100 cart-trigger" data-toggle="class-toggle" data-target=".cart-sidebar">
    <span class="position-relative">
        {{-- <i class="la la-shopping-cart fs-23 opacity-60 text-dark"></i> --}}
        <img src="{{ static_asset("assets/img/cart.png") }}" alt="">
        <span class="absolute-top-right " style="right: -10px;top: -9px;">
            @if(isset($cart) && count($cart) > 0)
                <span class="badge bg-alter-6 fs-4 text-light badge-inline badge-pill  cart-count badge-circle badge-sm">{{ count($cart) }}</span>
            @else
                <span class="badge bg-alter-6 fs-4 text-light badge-inline badge-pill cart-count badge-circle badge-sm">0</span>
            @endif
        </span>
    </span>
</a>
