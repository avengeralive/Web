@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Добавление продукта</div>

                <div class="card-body">
					<form method="post" enctype="multipart/form-data" onsubmit="$('#myButton').prop('disabled', true); return true;" action="{{route('admin.attributes.submit')}}">
						@csrf
						<input type="hidden" name="action" value="add">
						<div class="form-group">
							<label for="name">Название</label>
							<input type="text" class="form-control" name="name" placeholder="Название" required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" id="myButton">Сохранить</button>
						</div>
					</form>
                    <a href="{{ route('admin.attributes') }}">назад к аттрибутам</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection