@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Добавление менеджера</div>

                <div class="card-body">
					<form method="post" enctype="multipart/form-data" onsubmit="$('#myButton').prop('disabled', true); return true;" action="{{route('admin.users.submit')}}">
						@csrf
						<input type="hidden" name="action" value="add">
						<div class="form-group">
							<label for="name">ФИО</label>
							<input type="text" class="form-control" name="name" placeholder="ФИО" required>
						</div>
						<div class="form-group">
							<label for="phone">Телефон</label>
							<input type="text" class="form-control" name="phone" placeholder="Телефон" required>
						</div>
						<div class="form-group">
							<label for="work">Вид деятельности / Среда для инвестирования</label>
							<input type="text" class="form-control" name="work" placeholder="Вид деятельности / Среда для инвестирования">
						</div>
						<div class="form-group">
							<label for="email">Инвестировали ранее</label>
							<input type="text" class="form-control" name="before" placeholder="Инвестировали ранее">
						</div>
						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="text" class="form-control" name="email" placeholder="E-mail" required>
						</div>
						<div class="form-group">
							<label for="post">Должность</label>
							<input type="text" class="form-control" name="post" placeholder="Должность">
						</div>
						<div class="form-group">
							<label for="city">Город</label>
							<input type="text" class="form-control" name="city" placeholder="Город">
						</div>
						<div class="form-group">
							<label for="experience">Сколько лет на рынке</label>
							<input type="number" class="form-control" name="experience" placeholder="Сколько лет на рынке">
						</div>
						<div class="form-group">
							<label for="companyname">Название компании</label>
							<input type="text" class="form-control" name="companyname" placeholder="Название компании">
						</div>
						<div class="form-group">
							<label for="investment">Объем инвестиций ОТ</label>
							<input type="text" class="form-control" name="investmentfrom" placeholder="Объем инвестиций ОТ">
						</div>
						<div class="form-group">
							<label for="investment">Объем инвестиций ДО</label>
							<input type="text" class="form-control" name="investmentto" placeholder="Объем инвестиций ДО">
						</div>
						
						<div class="form-group">
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" name="fool" value="fool" id="defaultCheck1">
							  <label class="form-check-label" for="defaultCheck1">
								Не отправлять данные в CRM
							  </label>
							</div>
						</div>
						
						<div class="form-group">
							<label for="manager">Личный менеджер</label>
							<select class="form-control" name="manager">
								<option value="0">Личный менеджер</option>
								@foreach (App\User::all() as $user1)
									@if ($user1->hasRole('manager'))
										<option value="{{$user1->id}}">{{$user1->name}}</option>
									@endif
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" id="myButton">Добавить менеджера</button>
						</div>
					</form>
                    <a href="{{ route('admin.dashboard') }}">назад в админпанель</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection