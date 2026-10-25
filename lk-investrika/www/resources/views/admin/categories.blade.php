@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">

		@isset ($categories_fail)
		<div class="col-md-8" id="msg">
			<div class="alert alert-danger" role="alert">Категория не может быть удалена, т.к используется следующими объектами:<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<br>
				@isset ($categories_fail)
					Категории
						<ul>
						@foreach ($categories_fail as $category)
							<li><a href="{{route('admin.categories.id', ['category_id' => $category->id])}}">{{$category->name}}</a></li>
						@endforeach
						</ul>
				@endisset
			</div>
		</div>
		@endisset
	
	
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Категории</div>

                <div class="card-body">
                    
                    <p><a href="{{route('admin.categories.add')}}" class="btn btn-primary btn-sm">+ Добавить категорию</a></p>
                    
					<ul class="list-group">
						@foreach ($categories as $category)
							<li class="list-group-item d-flex justify-content-between">
								<a href="{{ route('admin.categories.id', ['category_id' => $category->id]) }}">{{ $category->name }}</a>
								<span style="cursor: pointer;" class="btn btn-sm btn-danger " onclick="if (confirm('Remove category?')) $('#remove_form{{$category->id}}').submit();">x <form method="post" id="remove_form{{$category->id}}" action="{{route('admin.categories.submit')}}">
									@csrf
									<input type="hidden" name="id" value="{{$category->id}}"><input type="hidden" name="action" value="delete">
								</form></span>
								
							</li>
						@endforeach
					</ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection