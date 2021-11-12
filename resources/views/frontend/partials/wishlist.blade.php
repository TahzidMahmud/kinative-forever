<a href="{{ route('wishlists.index') }}" class="position-relative  d-inline-block ">
    {{-- <i class="la la-heart-o fs-20 opacity-60 text-dark"></i> --}}
    <img src="{{ static_asset("assets/img/wishlist.png") }}" alt="">
    <span class="absolute-top-right" style="right: -10px;top: -10px;">
        @if(Auth::check())
            <span class="badge bg-alter-6 text-light badge-inline badge-pill badge-circle badge-sm ">{{ count(Auth::user()->wishlists)}}</span>
        @else
            <span class="badge bg-alter-6 text-light badge-inline badge-pill badge-circle badge-sm ">0</span>
        @endif
    </span>
</a>
