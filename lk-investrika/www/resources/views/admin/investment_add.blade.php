@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Добавление инвестиции</div>

                <div class="card-body">
					<form method="post" enctype="multipart/form-data" onsubmit="$('#myButton').prop('disabled', true); return true;" action="{{route('admin.investments.submit')}}">
						@csrf
						<input type="hidden" name="id" value="{{$user->id}}">
						<input type="hidden" name="action" value="add">
						<div class="form-group">
							<label for="product">Компания</label>
							
							<select name="product" class="form-control">
							@foreach (App\Product::all() as $product)
								<option value="{{$product->id}}">{{$product->name}}</option>
							@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="name">Сумма</label>
							<input type="number" class="form-control" name="summ" value="" placeholder="Сумма" required>
						</div>
						<div class="form-group">
							<label for="phone">Время (месяцев)</label>
							<input type="number" class="form-control" name="time" value="" placeholder="Время (месяцев)" required>
						</div>
						<div id="docs">
							<div class="form-group">
								<label for="doc">Документ</label>
								<input type="file" class="form-control-file" name="doc[]">
							</div>
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
					function addPicture() {
						$('#docs').append('<div class="form-group"><label for="doc">Документ</label><input type="file" class="form-control-file" name="doc[]" required></div>');
					};
					</script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection