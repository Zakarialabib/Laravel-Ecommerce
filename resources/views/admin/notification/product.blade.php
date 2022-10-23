		<a class="clear">{{ __('Product(s) in Low Quantity.') }}</a>
		@if(count($datas) > 0)
		<a id="product-notf-clear" data-href="{{ route('product-notf-clear') }}" class="clear" href="javascript:;">
			{{ __('Clear All') }}
		</a>
		<ul>
		@foreach($datas as $data)
			<li>
				<a href="{{ route('admin-prod-edit',$data->product->id) }}"> <i class="icofont-cart"></i> {{mb_strlen($data->product->name,'UTF-8') > 30 ? mb_substr($data->product->name,0,30,'UTF-8') : $data->product->name}}</a>
				<a class="clear">{{ __('Stock') }} : {{$data->product->stock}}</a>
			</li>
		@endforeach

		</ul>

		@else 

		<a class="clear" href="javascript:;">
			{{ __('No New Notifications.') }}
		</a>

		@endif