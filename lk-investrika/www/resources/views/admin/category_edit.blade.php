@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редактирование категории</div>

                <div class="card-body">
					<form method="post" enctype="multipart/form-data" onsubmit="$('#myButton').prop('disabled', true); return true;" action="{{route('admin.categories.submit')}}">
						@csrf
						<input type="hidden" name="id" value="{{$category->id}}">
						<input type="hidden" name="action" value="edit">
						<div class="form-group">
							<label for="name">Название</label>
							<input type="text" class="form-control" name="name" value="{{ $category->name }}" placeholder="Название" required>
						</div>
						<div class="form-group">
							<label for="exampleFormControlSelect1">Родительская категория</label>
							<select class="form-control" name="parentCategory" id="exampleFormControlSelect1">
								<option value="0">Не выбрана</option>
								@foreach (App\Category::all() as $category1)
									<option
									@if ($category->parentCategory)
										@if ($category->parentCategory->id==$category1->id) selected @endif
									@endif
									 value="{{$category1->id}}" >{{$category1->name}}</option>
								@endforeach
							</select>
						</div>
						
						<div class="form-group">
							<label for="description">Описание</label>
							<textarea class="form-control" name="description" rows="5" placeholder="Описание" required>{{$category->description}}</textarea>
						</div>
					
						<div id="oldpics">
							@isset ($category->images)
							@foreach ($category->images as $image)
								<div class="form-group" id="oldimg{{$image->id}}">
									<img class="img-fluid" src="/images/{{$image->id}}">
										<button type="button" class="btn btn-primary" onclick="removePicture({{$image->id}});">- Удалить изображение</button>
								</div>
							@endforeach
							@endisset
						</div>
						<div id="removedpics">
						</div>
						<div id="pics">
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-primary" onclick="addPicture();">+ Добавить изображение</button>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" id="myButton">Сохранить</button>
						</div>
					</form>
				
					<script type="text/javascript">
						function removePicture(id) {
							$('#oldimg'+id).remove();
							$('#removedpics').append('<input type="hidden" name="images[]" value="'+id+'">');
							if (!$('#oldpics').children().length && !$('#pics').children().length)  {
								addPicture();
							}
						};
						
						function addPicture() {
							$('#pics').append('<div class="form-group"><label for="image">Изображение</label><input type="file" class="form-control-file" name="image[]"></div>');
						};
					</script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection