@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Смена пароля</div>
                
                <div class="card-body">
                    <p class="text-center">{{ $message }}</p>
                    <form method="POST" action="/account/change" aria-label="{{ __('Reset Password') }}">

                        <div class="form-group row">
                            <label for="old_password" class="col-md-4 col-form-label text-md-right">Старый пароль</label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control" name="old_password" required>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Новый пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirm" class="col-md-4 col-form-label text-md-right">Повторите пароль</label>

                            <div class="col-md-6">
                                <input id="confirm" type="password" class="form-control" name="confirm" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Сменить пароль
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
