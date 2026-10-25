@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редактирование данных уровня инвестора</div>

                <div class="card-body">
					<form method="post" enctype="multipart/form-data" onsubmit="$('#myButton').prop('disabled', true); return true;" action="{{route('admin.levels.submit')}}">
						@csrf
						<input type="hidden" name="id" value="{{$level->id}}">
						<input type="hidden" name="action" value="edit">
						
						<div class="form-group">
							<label for="description">Название уровня</label>
							<input type="text" name="name" class="form-control" placeholder="Название уровня" required value="{{$level->name}}">
						</div>
						<div class="form-group">
							<label for="description">Сумма</label>
							<input type="text" name="summ" class="form-control" placeholder="Сумма" required value="{{$level->summ}}">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" id="myButton">Сохранить</button>
						</div>
					</form>
                    <a href="{{ route('admin.levels') }}">назад к уровням инвестора</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection