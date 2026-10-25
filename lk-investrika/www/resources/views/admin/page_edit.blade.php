@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редактирование данных страницы '{{$page->name}}'</div>

                <div class="card-body">
					<form method="post" enctype="multipart/form-data" onsubmit="$('#myButton').prop('disabled', true); return true;" action="{{route('admin.pages.submit')}}">
						@csrf
						<input type="hidden" name="id" value="{{$page->id}}">
						<input type="hidden" name="action" value="edit">
						
						<div class="form-group">
							<label for="description">Текст (до 292 символов)</label>
							<textarea name="description" rows="5" class="form-control" placeholder="Текст" maxlength="292">{{$page->description}}</textarea>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" id="myButton">Сохранить</button>
						</div>
					</form>
                    <a href="{{ route('admin.pages') }}">назад к страницам</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection