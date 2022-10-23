<div class="dropdown-menu">
    @if (Session::has('cart'))
        <ul>
            @foreach (Session::get('cart')->items as $product)
                <li>
                    <a href="{{ route('front.product', $product['item']['slug']) }}">
                        <figure> <img
                                src="{{ $product['item']['photo'] ? (filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ? $product['item']['photo'] : asset('assets/images/products/' . $product['item']['photo'])) : asset('assets/images/noimage.png') }}"
                                alt="" class="lazy" width="50" height="50"></figure>
                        <strong>{{ mb_strlen($product['item']['name'], 'UTF-8') > 45 ? mb_substr($product['item']['name'], 0, 45, 'UTF-8') . '...' : $product['item']['name'] }}</strong>
                    </a>

                    <a data-class="cremove{{ $product['item']['id'] . $product['size'] . $product['color'] . str_replace(str_split(' ,'), '', $product['values']) }}"
                        data-href="{{ route('product.cart.remove', $product['item']['id'] . $product['size'] . $product['color'] . str_replace(str_split(' ,'), '', $product['values'])) }}"
                        class="action"><i class="ti-trash"></i></a>

                </li>
            @endforeach
        </ul>
    @else
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">{{ __('Cart is Empty!! Add some products in your Cart') }}</h4>
            </div>
        </div>
    @endif
    <div class="total_drop">
        <div class="clearfix">
            <strong>{{ __('Total') }}</strong><span>{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}</span>
        </div>
        <a href="{{ route('front.cart') }}" class="btn_1 outline">{{ __('View cart') }}</a>
        <a href="{{ route('front.checkout') }}" class="btn_1">{{ __('Check out') }}</a>
    </div>
</div>
