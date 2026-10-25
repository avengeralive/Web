@extends('layouts.insideapp')

@section('content')
<div class="container" style="padding-top: 6.75rem;">

    <div class="row justify-content-center pt-2 pb-5">
		<div class="col-12">
			<h1 class="header">Личный кабинет</h1>
		</div>
	</div>
    <div class="row justify-content-center" id="products">

		@if(Auth::check())

			<div class="col-lg-4 pr-lg-5">
				<ul style="list-style: none; padding-left: 0;">
					<li class="mb-2 rounded">
						<a href="{{route('account')}}" style="text-decoration: none;"><div style="color: #000; font-weight: bold; white-space: nowrap; position: relative" onclick="$('.account-item').removeClass('active'); $(this).addClass('active');" class="rounded account-item pl-3 py-2">Перечень инвестиций</div></a>
					</li>
					<li class="mb-2 rounded">
						<a href="{{route('calc')}}" style="text-decoration: none;"><div style="color: #000; font-weight: bold; white-space: nowrap; position: relative" onclick="$('.account-item').removeClass('active'); $(this).addClass('active');" class="rounded account-item pl-3 py-2">Инвестиционный калькулятор</div></a>
					</li>
					<li class="mb-2 rounded">
						<a href="{{route('level')}}" style="text-decoration: none;"><div style="color: #000; font-weight: bold; white-space: nowrap; position: relative" onclick="$('.account-item').removeClass('active'); $(this).addClass('active');" class="rounded account-item pl-3 py-2">Шкала инвестора</div></a>
					</li>
					<li class="mb-2 rounded">
						<a href="{{route('manager')}}" style="text-decoration: none;"><div style="color: #000; font-weight: bold; white-space: nowrap; position: relative" onclick="$('.account-item').removeClass('active'); $(this).addClass('active');" class="rounded account-item active pl-3 py-2">Личный менеджер</div></a>
					</li>
				</ul>
			</div>
			<div class="col-lg-8 bg-white rounded p-5">
			
				@if ($manager)
				Ваш личный менеджер:<br>
				<div class="pl-2">
						<strong>{{$manager->name}}</strong><br>
						Телефон: {{$manager->phone}}<br>
						E-mail: {{$manager->email}}<br>
				</div>
				@else
					Личный менеджер не присвоен
				@endif
			</div>
	
		@endif

    </div>
</div>

<script>

$(document).ready(function(){
	new Vue({
		el: '#products',
		data: {
			investments: [
				@foreach (App\Product::all() as $index => $product)
				{
					id: {{$product->id}},
					name: '{{$product->name}}',
					description: '{{$product->description}}',
					image: 
					@if (isset($product->images[0]))
						{{$product->images[0]->id}}
					@else
						0
					@endif
					{{--@foreach ($product->attributes as $attribute)
								{{$attribute->name}}: <span style="color: #03849f;">{{ $attribute->pivot->value }}</span>
					@endforeach--}}
				}
				@if ($index < App\Product::all()->count()-1)
					,
				@endif
				@endforeach
			]
		},
		methods: {
			// TODO computed values for cart count and cart total
			getProducts: function (category_id) {
				$.ajax({
					type: 'POST',
					url: '{{route('productsOfCategory.ajax')}}',
					data: {
						categoryId: category_id,
						_token: '{{ csrf_token() }}'
					},
					success:function(data) {
						console.log(data);
						this.products = [];
						for (var i=0; i<data.products.length; i++) {
							this.products.push({id: data.products[i].id, name: data.products[i].name, description: data.products[i].description, image: data.products[i].image});
						}
					}.bind(this)
				});
			}
		}
	});
});
</script>


@endsection
