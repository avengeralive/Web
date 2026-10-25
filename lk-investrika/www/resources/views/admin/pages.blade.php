@extends('layouts.adminapp')

@section('content')

            <div class="card shadow col-md-4">
                <div class="card-header">Страницы</div>

                <div class="card-body">
					<div class="list-group">
						@foreach ($pages as $page)
								<a href="{{ route('admin.pages.id', ['page_id' => $page->id]) }}" class="list-group-item list-group-item-action">{{ $page->name }}</a>
								{{--<span style="cursor: pointer; color: #c00;" onclick="if (confirm('Remove user?')) $('#remove_form{{$user->id}}').submit();">x</span>
								<form method="post" id="remove_form{{$user->id}}" action="{{route('admin.users.submit')}}">
									@csrf
									<input type="hidden" name="id" value="{{$user->id}}"><input type="hidden" name="action" value="delete">
								</form>--}}
						@endforeach
					</div>
                </div>
            </div>
@endsection