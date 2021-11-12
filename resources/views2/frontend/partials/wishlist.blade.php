<a href="{{ route('wishlists.index') }}" class="position-relative text-dark btn bg-sm btn-circle btn-icon">
    <i class="la la-heart-o opacity-80 fs-20"></i>
    <span class="absolute-top-right" style="top: -3px;right: -3px;">
        @if(Auth::check())
            <span class="badge badge-primary badge-inline badge-pill text-white shadow-md" style="width: 16px;height: 16px;font-size: 8px;">{{ count(Auth::user()->wishlists)}}</span>
        @else
            <span class="badge badge-primary badge-inline badge-pill text-white shadow-md" style="width: 16px;height: 16px;font-size: 8px;">0</span>
        @endif
    </span>
</a>