@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Компании</div>

                <div class="card-body">
					<ul style="list-style: none;">
						@foreach ($products as $product)
							<li>
								<a href="{{ route('admin.products.id', ['product_id' => $product->id]) }}">{{ $product->name }}</a>
								<span style="cursor: pointer; color: #c00;" onclick="if (confirm('Удалить компанию?')) $('#remove_form{{$product->id}}').submit();">x</span>
								<form method="post" id="remove_form{{$product->id}}" action="{{route('admin.products.submit')}}">
									@csrf
									<input type="hidden" name="id" value="{{$product->id}}"><input type="hidden" name="action" value="delete">
								</form>
								<ul style="list-style: none;">
									@foreach ($product->investments as $investment)
									<li>
									<a href="{{route('admin.users.id', ['user_id' => $investment->user->id])}}">{{$investment->user->name}}</a> 
									<a href="{{route('admin.investments.id', ['investment_id' => $investment->id])}}">{{$investment->summ}} рублей {{$investment->time}} мес</a>
										<span style="cursor: pointer; color: #c00;" onclick="if (confirm('Удалить инвестицию?')) $('#remove_form_investment{{$investment->id}}').submit();">x</span>
										<form method="post" id="remove_form_investment{{$investment->id}}" action="{{route('admin.investments.submit')}}">
											@csrf
											<input type="hidden" name="id" value="{{$investment->id}}"><input type="hidden" name="action" value="delete">
										</form>
									</li>
									@endforeach
								</ul>
							</li>
						@endforeach
						<li>
							<a href="{{route('admin.products.add')}}">+ Добавить компанию</a>
						</li>
					</ul>
                    <a href="{{ route('admin.dashboard') }}">назад в админпанель</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection