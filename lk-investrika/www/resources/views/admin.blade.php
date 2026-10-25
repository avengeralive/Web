@extends('layouts.adminapp')

@section('content')

		@isset ($users)
		<div class="col-md-8" id="msg">
				<div class="alert alert-danger" role="alert">Пользователь не может быть удален, т.к используется следующими объектами:<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<br>
					@isset ($users)
						Пользователи
							<ul>
							@foreach ($users as $user)
								<li><a href="{{route('admin.users.id', ['user_id' => $user->id])}}">{{$user->name}}</a></li>
							@endforeach
							</ul>
					@endisset
				</div>
			</div>
		@endisset
		
		
		@isset ($investments)
		<div class="col-md-8" id="msg">
				<div class="alert alert-danger" role="alert">Компания не может быть удалена, т.к используется следующими объектами:<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<br>
					@isset ($investments)
						@if ($investments->count())
						Инвестиции
							<ul>
								@foreach ($investments as $investment)
								<li>
									<a href="{{route('admin.users.id', ['user_id' => $investment->user->id])}}">{{$investment->user->name}}</a> 
									<a href="{{route('admin.investments.id', ['investment_id' => $investment->id])}}">{{$investment->summ}} рублей {{$investment->time}} мес</a>
								</li>
								@endforeach
							</ul>
						@endif
					@endisset
					
					@isset ($bids)
						@if ($bids->count())
						Заявки на инвестирование
							<ul>
								@foreach ($bids as $bid)
								<li>
									<a href="{{ route('admin.users.id', ['user_id' => $bid->user->id]) }}">{{ $bid->user->name }}</a> <a href="{{ route('admin.products.id', ['product_id' => $bid->product->id]) }}">{{ $bid->product->name }}</a> <span><strong>Cумма</strong>: {{$bid->summ}} &#8381;</span> <span><strong>Срок</strong>: {{$bid->time}} мес.</span>
								</li>
								@endforeach
							</ul>
						@endif
					@endisset
				</div>
			</div>
		@endisset
		
	
        <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Админпанель</h3>
            </div>
           
            <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

					{{--<div>
						<a href="{{ route('admin.attributes') }}">Аттрибуты</a>
					</div>--}}
					<div>
						<a href="{{ route('admin.categories') }}">Категории</a>
					</div>
					<div>
						<a href="{{ route('admin.managers') }}">Менеджеры</a>
					</div>
					<div>
						<a href="{{ route('admin.products') }}">Компании</a>
					</div>
					<div>
						<a href="{{ route('admin.users') }}">Инвесторы</a> [ <a href="{{route('admin.userSearch')}}"><i class="fas fa-search"></i> поиск</a> ]
					</div>
					<div>
						<a href="{{ route('admin.companies') }}">Зарегистрировавшиеся компании</a>
					</div>
					<div>
						<a href="{{ route('admin.bids') }}">Заявки на инвестирование</a>
					</div>
					<div>
						<a href="{{ route('admin.pages') }}">Страницы</a>
					</div>
					<div>
						<a href="{{ route('admin.levels') }}">Уровни инвестора</a>
					</div>
					<div>
						<a href="{{ route('admin.settings') }}"><i class="fas fa-cog"></i> Настройки</a>
					</div>
                </div>
            </div>
        </div>
@endsection