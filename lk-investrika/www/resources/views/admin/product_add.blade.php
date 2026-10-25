@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Добавление продукта</div>

                <div class="card-body">
					<form method="post" enctype="multipart/form-data" onsubmit="$('#myButton').prop('disabled', true); return true;" action="{{route('admin.products.submit')}}">
						@csrf
						<input type="hidden" name="action" value="add">
						<div class="form-group">
							<label for="name">Название</label>
							<input type="text" class="form-control" name="name" placeholder="Название" required>
						</div>
						<div class="form-group">
							<label for="description">Описание</label>
							<textarea class="form-control" name="description" rows="5" placeholder="Описание" required></textarea>
						</div>
						<div class="form-group">
							<label for="price">Процент</label>
							
							<div class="form-check">
                                  <input class="form-check-input" type="radio" name="percent_type" id="bet" value="bet"  checked>
                                  <label class="form-check-label" for="bet">
                                    Ставка
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="percent_type" id="share" value="share">
                                  <label class="form-check-label" for="share">
                                    Доля
                                  </label>
                                </div>

							<p><input type="number" class="form-control" name="percent" placeholder="Процент" required></p>
						</div>
						<div class="form-group">
							<label for="summ">Сумма</label>
							<input type="number" class="form-control" name="summ" placeholder="Сумма" required>
						</div>
						<div class="form-group">
							<label for="time">Срок</label>
							<input type="number" class="form-control" name="time" placeholder="Срок" required>
						</div>
						<div class="form-group">
							<label for="minsumm">Минимальная сумма</label>
							<input type="number" class="form-control" name="minsumm" placeholder="Минимальная сумма" required>
						</div>
						{{--<div class="form-group">
							<label>Аттрибуты</label>
							<div class="form-group border p-3">
								<div id="attributes">
								</div>
								<div class="input-group">
									<select class="form-control" id="attrSelect">
									@foreach (App\Attribute::all() as $attribute)
										<option value="{{$attribute->id}}" >{{$attribute->name}}</option>
									@endforeach
									</select>
									<div class="input-group-append">
										<button type="button" class="btn btn-primary" onclick="addAttr();">+ Добавить аттрибут</button>
									</div>
								</div>
							</div>
						</div>--}}
						
						<div class="form-group">
							@foreach (App\Category::all() as $category)
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="inlineCheckbox{{$category->id}}" name="category[]" value="{{$category->id}}">
									<label class="form-check-label" for="inlineCheckbox{{$category->id}}">{{$category->name}}</label>
								</div>
							@endforeach
						</div>
						
						<div class="form-group">
							<label for="image">Лого</label>
							<input type="file" class="form-control-file" name="logo" required>
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
							<button type="submit" class="btn btn-primary" id="myButton">Добавить продукт</button>
						</div>
					</form>
					<script type="text/javascript">
					function addPicture() {
						$('#pics').append('<div class="form-group"><label for="image">Изображение</label><input type="file" class="form-control-file" name="image[]" required></div>');
					};
					function addAttr(name, id) {
						var id = $('#attrSelect option:selected').val();
						var name = $('#attrSelect option:selected').text();
						$('#attributes').append('<div class="form-group"><label for="attribute">'+name+
							'</label><div class="input-group"><input type="text" class="form-control" name="attribute['+id+']" placeholder="'+name+
							'" required><div class="input-group-append"><button type="button" onclick="$(this).parent().parent().parent().remove();" class="btn btn-primary rounded-right">-</button></div></div></div>');
					};
					</script>

                    <a href="{{ route('admin.products') }}">назад к списку компаний</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection