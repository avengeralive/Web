@extends('layouts.adminapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
	
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Уровни инвестора</div>

                <div class="card-body">
					<ul style="list-style: none;">
						@foreach ($levels as $index => $level)
							<li>
								<a href="{{ route('admin.levels.id', ['level_id' => $level->id]) }}">Уровень {{$index+1}}: {{ $level->name }}</a>
							</li>
						@endforeach
					</ul>
                    <a href="{{ route('admin.dashboard') }}">назад в админпанель</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection