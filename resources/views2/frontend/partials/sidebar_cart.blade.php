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
<div class="d-flex align-items-center justify-content-between border-bottom px-3 py-2 bg-white sticky-top position-sticky">
    <h5 class="mb-0 h6 strong-600">
        <i class="la la-shopping-cart"></i>
        @if(isset($cart) && count($cart) > 0)
        <span class="">{{ count($cart)}} Item(s)</span>
        @else
            <span class="">0 Item(s)</span>
        @endif
    </h5>
    <button class="btn btn-icon" data-toggle="class-toggle" data-target=".cart-sidebar"><i class="la la-times"></i></button>
</div>
@php
    $total = 0;
@endphp
@if(isset($cart) && count($cart) > 0)
    <div class="p-3 flex-grow-1">
        @foreach($cart as $key => $cartItem)
            @php
                $product = \App\Product::find($cartItem['product_id']);
                $total = $total + $cartItem['price']*$cartItem['quantity'];
            @endphp
            <div class="cart-item d-flex align-items-center">
                <div class="flex-shrink-0 mr-3">
                    <img src="{{ uploaded_asset($product->thumbnail_img) }}" class="mw-100 size-60px" width="60">
                </div>
                <div class="flex-grow-1 minw-0">
                    <div class="fs-13 text-truncate fw-600">{{ $product->getTranslation('name') }}</div>
                    <div class="my-1 c-base-1 fw-600">{{ single_price($cartItem['price']) }} x {{ $cartItem['quantity'] }}</div>
                    <div class="d-flex align-items-center">
                        <button class="btn col-auto btn-icon btn-sm border" type="button" data-type="minus" data-quantity='{{ $cartItem['quantity'] }}' data-id="{{ $cartItem['id'] }}" onclick="updateQuantity(this)" @if( $cartItem['quantity'] == 1) disabled @endif style="width: 30px;height: 30px;padding: 5px;">
                            <i class="las la-minus"></i>
                        </button>
                        <span class="mx-3 qty">{{ $cartItem['quantity'] }}</span>
                        <button class="btn col-auto btn-icon btn-sm border" type="button" data-type="plus" data-quantity='{{ $cartItem['quantity'] }}' data-id="{{ $cartItem['id'] }}" onclick="updateQuantity(this)" style="width: 30px;height: 30px;padding: 5px;">
                            <i class="las la-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="ml-3">
                    <button class="btn btn-default btn-icon btn-sm border" onclick="removeFromCart({{ $cartItem['id'] }})"><i class="la la-trash fs-18"></i></button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="bg-white border-top px-3 py-2 sticky-bottom position-sticky">
        @auth
            <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary btn-block">
                <span>Checkout</span>
                <span class="ml-2">({{ single_price($total) }})</span>
            </a>
        @else
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#GuestCheckout">
                <span>Checkout</span>
                <span class="ml-2">({{ single_price($total) }})</span>
            </button>
        @endauth
    </div>
@else
    <div class="p-3 flex-grow-1  text-center">
        <h4>Your shopping bag is empty. Start shopping</h4>
    </div>
@endif