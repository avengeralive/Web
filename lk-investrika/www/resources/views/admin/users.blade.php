@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">

	
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$header}}</div>

                <div class="card-body">
					<ul style="list-style: none;">
						@foreach ($users as $user)
							<li>
								<a href="{{ route('admin.users.id', ['user_id' => $user->id]) }}">{{ $user->name }}</a>
								@isset ($delete)
									<span style="cursor: pointer; color: #c00;" onclick="if (confirm('Удалить {{$delete}}?')) $('#remove_user_form{{$user->id}}').submit();">x</span>
									<form method="post" id="remove_user_form{{$user->id}}" action="{{route('admin.users.submit')}}">
										@csrf
										<input type="hidden" name="id" value="{{$user->id}}"><input type="hidden" name="action" value="delete">
									</form>
								@endisset
								
								<ul style="list-style: none;">
								@foreach ($user->investments as $investment)
									<li><a href="{{route('admin.investments.id', ['investment_id' => $investment->id])}}">{{$investment->summ}} рублей {{$investment->time}} мес</a>
										<span style="cursor: pointer; color: #c00;" onclick="if (confirm('Удалить инвестицию?')) $('#remove_form{{$investment->id}}').submit();">x</span>
										<form method="post" id="remove_form{{$investment->id}}" action="{{route('admin.investments.submit')}}">
											@csrf
											<input type="hidden" name="id" value="{{$investment->id}}"><input type="hidden" name="action" value="delete">
										</form>
									</li>
								@endforeach
								</ul>
							</li>
							
							<li>
								<a href="{{route('admin.investments.add', ['user_id' => $user->id])}}">+ Добавить инвестицию</a>
							</li>
						@endforeach
						@isset ($add)
							<li>
								<a href="{{route('admin.users.add')}}">+ Добавить {{$add}}</a>
							</li>
						@endisset
					</ul>
                    <a href="{{ route('admin.dashboard') }}">назад в админпанель</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection