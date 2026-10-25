@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
	
		@isset ($products)
		<div class="col-md-8" id="msg">
				<div class="alert alert-danger" role="alert">Аттрибут не может быть удален, т.к используется следующими объектами:<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<br>
					@isset ($products)
						Продукты
							<ul>
							@foreach ($products as $product)
								<li><a href="{{route('admin.products.id', ['product_id' => $product->id])}}">{{$product->name}}</a></li>
							@endforeach
							</ul>
					@endisset
				</div>
			</div>
		@endisset
	
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Аттрибуты</div>

                <div class="card-body">
					<ul style="list-style: none;">
						@foreach ($attributes as $attribute)
							<li>
								<a href="{{ route('admin.attributes.id', ['attribute_id' => $attribute->id]) }}">{{ $attribute->name }}</a>
								<span style="cursor: pointer; color: #c00;" onclick="if (confirm('Remove attribute?')) $('#remove_form{{$attribute->id}}').submit();">x</span>
								<form method="post" id="remove_form{{$attribute->id}}" action="{{route('admin.attributes.submit')}}">
									@csrf
									<input type="hidden" name="id" value="{{$attribute->id}}"><input type="hidden" name="action" value="delete">
								</form>
							</li>
						@endforeach
						<li>
							<a href="{{route('admin.attributes.add')}}">+ Добавить аттрибут</a>
						</li>
					</ul>
                    <a href="{{ route('admin.dashboard') }}">назад в админпанель</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection