@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редактирование данных пользователя</div>

                <div class="card-body">
					<form method="post" enctype="multipart/form-data" onsubmit="$('#myButton').prop('disabled', true); return true;" action="{{route('admin.users.submit')}}">
						@csrf
						<input type="hidden" name="id" value="{{$user->id}}">
						<input type="hidden" name="action" value="edit">
						<div class="form-group">
							<label for="name">ФИО</label>
							<input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="ФИО" required>
						</div>
						<div class="form-group">
							<label for="phone">Телефон</label>
							<input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Телефон" required>
						</div>
						<div class="form-group">
							<label for="work">Вид деятельности / Среда для инвестирования</label>
							<input type="text" class="form-control" name="work" value="{{ $user->work }}" placeholder="Вид деятельности / Среда для инвестирования">
						</div>
						<div class="form-group">
							<label for="email">Инвестировали ранее</label>
							<input type="text" class="form-control" name="before" value="{{ $user->before }}" placeholder="Инвестировали ранее">
						</div>
						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder="E-mail" required>
						</div>
						<div class="form-group">
							<label for="post">Должность</label>
							<input type="text" class="form-control" name="post" value="{{ $user->post }}" placeholder="Должность">
						</div>
						<div class="form-group">
							<label for="city">Город</label>
							<input type="text" class="form-control" name="city" value="{{ $user->city }}" placeholder="Город">
						</div>
						<div class="form-group">
							<label for="experience">Сколько лет на рынке</label>
							<input type="number" class="form-control" name="experience" value="{{ $user->experience }}" placeholder="Сколько лет на рынке">
						</div>
						<div class="form-group">
							<label for="companyname">Название компании</label>
							<input type="text" class="form-control" name="companyname" value="{{ $user->companyname }}" placeholder="Название компании">
						</div>
						<div class="form-group">
							<label for="investment">Объем инвестиций ОТ</label>
							<input type="text" class="form-control" name="investmentfrom" value="{{ $user->investmentfrom }}" placeholder="Объем инвестиций ОТ">
						</div>
						<div class="form-group">
							<label for="investment">Объем инвестиций ДО</label>
							<input type="text" class="form-control" name="investmentto" value="{{ $user->investmentto }}" placeholder="Объем инвестиций ДО">
						</div>
						<div class="form-group">
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" name="fool" value="fool" id="defaultCheck1"
								@if ($user->fool)
									checked
								@endif
							  >
							  <label class="form-check-label" for="defaultCheck1">
								Не отправлять данные в CRM
							  </label>
							</div>
						</div>
						
						@if ($user->hasRole('manager'))
						<div class="form-group">
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" name="active" value="active" id="defaultCheck2"
								@if ($user->active)
									checked
								@endif
							  >
							  <label class="form-check-label" for="defaultCheck2">
								Активен (только для менеджеров)
							  </label>
							</div>
						</div>
						@endif
						
						<div class="form-group">
							<label for="manager">Личный менеджер</label>
							<select class="form-control" name="manager">
								<option value="0">Личный менеджер</option>
								@foreach (App\User::all() as $user1)
									@if ($user1->hasRole('manager'))
										<option value="{{$user1->id}}"
										@if ($user->manager)
											@if ($user->manager->id==$user1->id) selected @endif
										@endif
										>{{$user1->name}}</option>
									@endif
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" id="myButton">Сохранить</button>
						</div>
					</form>
                    <a href="{{ route('admin.dashboard') }}">назад в админпанель</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection