@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редактирование продукта</div>

                <div class="card-body">
					<form method="post" enctype="multipart/form-data" onsubmit="$('#myButton').prop('disabled', true); return true;" action="{{route('admin.products.submit')}}">
						@csrf
						<input type="hidden" name="id" value="{{$product->id}}">
						<input type="hidden" name="action" value="edit">
						<div class="form-group">
							<label for="name">Название</label>
							<input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Название" required>
						</div>
						<div class="form-group">
							<label for="description">Описание</label>
							<textarea class="form-control" name="description" rows="5" placeholder="Описание" required>{{ $product->description }}</textarea>
						</div>
						<div class="form-group">
							<label for="price">Процент</label>
							
							<div class="form-check">
                                  <input class="form-check-input" type="radio" name="percent_type" id="bet" value="bet" 
                                  @if($product->percent_type == 'bet') 
                                  checked 
                                  @endif
                                  >
                                  <label class="form-check-label" for="bet">
                                    Ставка
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="percent_type" id="share" value="share"
                                   @if($product->percent_type == 'share') 
                                  checked 
                                  @endif>
                                  <label class="form-check-label" for="share">
                                    Доля
                                  </label>
                                </div>

							<p><input type="number" class="form-control" name="percent" value="{{ $product->percent }}" placeholder="Процент" required></p>
						</div>
						<div class="form-group">
							<label for="summ">Сумма</label>
							<input type="number" class="form-control" name="summ" value="{{ $product->summ }}" placeholder="Сумма" required>
						</div>
						<div class="form-group">
							<label for="time">Срок</label>
							<input type="number" class="form-control" name="time" value="{{ $product->time }}" placeholder="Срок" required>
						</div>
						<div class="form-group">
							<label for="minsumm">Минимальная сумма</label>
							<input type="number" class="form-control" name="minsumm" value="{{ $product->minsumm }}" placeholder="Минимальная сумма" required>
						</div>
						{{--<div class="form-group" id="app">
							<label>Аттрибуты</label>
							<div class="form-group border p-3">
								<div id="attributes">
									<div class="form-group" v-for="(todo, index) in todos">
										<label for="attribute">@{{todo.name}}</label>
										<div class="input-group">
											<input type="text" class="form-control" :name="'attribute['+todo.id+']'" placeholder="Значение аттрибута" :value="todo.value" required>
											<div class="input-group-append">
												<button type="button" v-on:click="$delete(todos, index)" class="btn btn-primary rounded-right">-</button>
											</div>
										</div>
									</div>
								</div>
								<div class="input-group">
									<select class="form-control" id="attrSelect">
									@foreach (App\Attribute::all() as $attribute)
										<option value="{{$attribute->id}}" >{{$attribute->name}}</option>
									@endforeach
									</select>
									<div class="input-group-append">
										<button type="button" class="btn btn-primary" v-on:click="addAttr">+ Добавить аттрибут</button>
									</div>
								</div>
							</div>
						</div>--}}
						
						<div class="form-group">
							@foreach (App\Category::all() as $category)
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="inlineCheckbox{{$category->id}}" name="category[]" value="{{$category->id}}"
										@if ($product->categories()->find($category->id)) checked @endif
									>
									<label class="form-check-label" for="inlineCheckbox{{$category->id}}">{{$category->name}}</label>
								</div>
							@endforeach
						</div>
						
						<div class="form-group">
							<label for="image">Лого</label>
							<div>
								<img class="img-fluid" src="/images/{{$product->logo->id}}">
							</div>
							<input type="file" class="form-control-file" name="logo">
						</div>
						
						<div id="oldpics">
							@foreach ($product->images as $image)
							<div class="form-group" id="oldimg{{$image->id}}">
								<img class="img-fluid" src="/images/{{$image->id}}">
								<button type="button" class="btn btn-primary" onclick="removePicture({{$image->id}});">- Удалить изображение</button>
							</div>
							@endforeach
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
					
						$(document).ready(function(){
							
				
							new Vue({
								el: '#app',
								data: {
									todos: [
										@foreach ($product->attributes as $index => $attribute)
										{
											id: {{$attribute->id}},
											name: '{{$attribute->name}}',
											value: {{$attribute->pivot->value}}
										}
										@if ($index < count($product->attributes)-1)
											,
										@endif
										@endforeach
									]
								},
								methods: {
									addAttr: function () {
										var id = $('#attrSelect option:selected').val();
										var name = $('#attrSelect option:selected').text();
										this.todos.push({ name: name, id: id });
									}
								}
							});
						});
					
					
						function removePicture(id) {
							$('#oldimg'+id).remove();
							$('#removedpics').append('<input type="hidden" name="images[]" value="'+id+'">');
							if (!$('#oldpics').children().length && !$('#pics').children().length) {
								addPicture();
							}
						};
						
						/*function removeAttr(id) {
							$('#oldattribute'+id).remove();
							$('#removedattributes').append('<input type="hidden" name="attributes[]" value="'+id+'">');
						};*/
						
						function addPicture() {
							$('#pics').append('<div class="form-group"><label for="image">Изображение</label><input type="file" class="form-control-file" name="image[]" required></div>');
						};
					</script>


                    <a href="{{ route('admin.products') }}">назад к списку компаний</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection