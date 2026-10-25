@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
	
		@isset ($products)
		<div class="col-md-12" id="msg">
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
	
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Заяки на инвестирование</div>

                <div class="card-body">
                    
                    <table class="table table-hover">
                        <tr>
                            
                        </tr>
                    </table>
                    
					<ul style="list-style: none;">
						@foreach ($bids as $bid)
							<li>
								<a href="{{ route('admin.users.id', ['user_id' => $bid->user->id]) }}">{{ $bid->user->name }}</a> <a href="{{ route('admin.products.id', ['product_id' => $bid->product->id]) }}">{{ $bid->product->name }}</a> <span><strong>Cумма</strong>: {{$bid->summ}} &#8381;</span> <span><strong>Срок</strong>: {{$bid->time}} мес.</span>
								<span style="cursor: pointer; color: #c00;" onclick="if (confirm('Удалить заявку?')) $('#remove_form{{$bid->id}}').submit();">x</span>
								<form method="post" id="remove_form{{$bid->id}}" action="{{route('admin.bids.submit')}}">
									@csrf
									<input type="hidden" name="id" value="{{$bid->id}}"><input type="hidden" name="action" value="delete">
								</form>
							</li>
						@endforeach
					</ul>
                    <a href="{{ route('admin.dashboard') }}">назад в админпанель</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection