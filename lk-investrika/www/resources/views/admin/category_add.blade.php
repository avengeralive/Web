@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Добавление категории</div>

                <div class="card-body">
					<form method="post" enctype="multipart/form-data" onsubmit="$('#myButton').prop('disabled', true); return true;" action="{{route('admin.categories.submit')}}">
						@csrf
						<input type="hidden" name="action" value="add">
						<div class="form-group">
							<label for="name">Название</label>
							<input type="text" class="form-control" name="name" placeholder="Название" required>
						</div>
						
						<div class="form-group">
							<label for="exampleFormControlSelect1">Родительская категория</label>
							<select class="form-control" name="parentCategory" id="exampleFormControlSelect1">
								<option value="0">Не выбрана</option>
								@foreach (App\Category::all() as $category1)
									<option value="{{$category1->id}}">{{$category1->name}}</option>
								@endforeach
							</select>
						</div>
						
						<div class="form-group">
							<label for="description">Описание</label>
							<textarea class="form-control" name="description" rows="5" placeholder="Описание" required></textarea>
						</div>
												
						<div id="pics">
							<div class="form-group">
								<label for="image">Изображение</label>
								<input type="file" class="form-control-file" name="image[]">
							</div>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-primary" onclick="addPicture();">+ Добавить изображение</button>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" id="myButton">Добавить категорию</button>
						</div>
					</form>
					<script type="text/javascript">
					function addPicture() {
						$('#pics').append('<div class="form-group"><label for="image">Изображение</label><input type="file" class="form-control-file" name="image[]" required></div>');
					};
					</script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection