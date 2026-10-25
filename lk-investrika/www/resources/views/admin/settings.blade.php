@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
	
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Настройки</div>

                <div class="card-body">
					<form method="post" enctype="multipart/form-data" onsubmit="$('#myButton').prop('disabled', true); return true;" action="{{route('admin.settings.submit')}}">
						@csrf				
						<div class="form-group">
							<label for="companiescount">Количество компаний</label>
							<input type="number" name="companiescount" class="form-control" placeholder="Количество компаний" required value="{{$settings->companiescount}}">
						</div>
						<div class="form-group">
							<label for="investorscount">Количество инвесторов</label>
							<input type="number" name="investorscount" class="form-control" placeholder="Количество инвесторов" required value="{{$settings->investorscount}}">
						</div>
						<div class="form-group">
							<label for="percents">Проценты</label>
							<div class="input-group" id="percents">
								<input type="number" name="percentfrom" class="form-control" placeholder="ОТ" required value="{{$settings->percentfrom}}">
								<input type="number" name="percentto" class="form-control" placeholder="ДО" required value="{{$settings->percentto}}">
							</div>
						</div>
						<div class="form-group">
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" name="manual" value="manual" id="defaultCheck2"
								@if ($settings->manual)
									checked
								@endif
							  >
							  <label class="form-check-label" for="defaultCheck2">
								Ввод статистики вручную
							  </label>
							</div>
						</div>
						<div class="form-group">
							<label for="termsofuse">Пользовательское соглашение</label>
							<textarea name="termsofuse" rows="5" class="form-control" placeholder="Текст">{{$settings->termsofuse}}</textarea>
						</div>
						<div class="form-group">
							<label for="termsofuse">Согласие на обработку персональных данных</label>
							<textarea name="personaldata" rows="5" class="form-control" placeholder="Текст">{{$settings->personaldata}}</textarea>
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