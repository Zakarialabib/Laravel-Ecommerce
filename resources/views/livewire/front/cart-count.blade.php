<div>
    @if (count((array) session('cart')) == 0)
        <a class="nav-link" href="#">
            <span class="cart-badge-wrap">
                <span class="cart-badge">{{ count((array) session('cart')) }}</span>
                <i class="flaticon-shopping-cart flat-mini"></i>
            </span>
            Cart
        </a>
    @else
        <a class="nav-link" href="{{ route('front.cart') }}">
            <span class="cart-badge-wrap">
                <span class="cart-badge">{{ count((array) session('cart')) }}</span>
                <i class="flaticon-shopping-cart flat-mini"></i>
            </span>
            Cart
        </a>
    @endif
</div>
