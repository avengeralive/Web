@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редактирование данных инвестиции</div>

                <div class="card-body">
					<form method="post" enctype="multipart/form-data" onsubmit="$('#myButton').prop('disabled', true); return true;" action="{{route('admin.investments.submit')}}">
						@csrf
						<input type="hidden" name="id" value="{{$investment->id}}">
						<input type="hidden" name="action" value="edit">
						
						<div class="form-group">
							<label for="product">Компания</label>
							<select name="product" class="form-control">
							@foreach (App\Product::all() as $product)
								<option value="{{$product->id}}"
								@if($product->id==$investment->product->id)
									selected
								@endif
								>{{$product->name}}</option>
							@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="name">Сумма</label>
							<input type="number" class="form-control" name="summ" value="{{ $investment->summ }}" placeholder="Сумма" required>
						</div>
						<div class="form-group">
							<label for="phone">Время (месяцев)</label>
							<input type="number" class="form-control" name="time" value="{{ $investment->time }}" placeholder="Время (месяцев)" required>
						</div>
						<div id="olddocs">
							@isset ($investment->docs)
							@foreach ($investment->docs as $doc)
								<div class="form-group" id="olddoc{{$doc->id}}">
									<a href="/docs/{{$doc->id}}">Документ {{$doc->id}}</a>
										<button type="button" class="btn btn-primary" onclick="removePicture({{$doc->id}});">- Удалить документ</button>
								</div>
							@endforeach
							@endisset
						</div>
						<div id="removeddocs">
						</div>
						<div id="docs">
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-primary" onclick="addPicture();">+ Добавить документы</button>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" id="myButton">Сохранить</button>
						</div>
					</form>
                    <a href="{{ route('admin.users') }}">назад к списку инвесторов</a>
                    <script type="text/javascript">
						function removePicture(id) {
							$('#olddoc'+id).remove();
							$('#removeddocs').append('<input type="hidden" name="docs[]" value="'+id+'">');
							if (!$('#olddocs').children().length && !$('#docs').children().length)  {
								addPicture();
							}
						};
						
						function addPicture() {
							$('#docs').append('<div class="form-group"><label for="doc">Документ</label><input type="file" class="form-control-file" name="doc[]"></div>');
						};
					</script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection