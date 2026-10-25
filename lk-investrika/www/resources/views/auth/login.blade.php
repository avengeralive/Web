@extends('layouts.insideapp')


@section('content')

        <section class="authorization" >
      <div class="container-fluid container-lg">
        <div class="row">
          <div class="col-md-12">
            <div class="authorization__title">
              Авторизация
            </div>
            <div class="authorization__subtitle">
              Войдите используя свой логин и пароль
            </div>
            <form action="{{ route('login') }}" method="post" aria-label="{{ __('Login') }}" class="main-form">
                @csrf
              <div class="input-row {{ $errors->has('email') ? 'error' : '' }}">
                <label for="email">Email</label>
                <input id="email" type="text" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                <div class="error-msg">
                  {{ $errors->first('email') }}
                </div>
                @endif
              </div>
              <div class="input-row {{ $errors->has('password') ? 'error' : '' }}">
                <label for="password">Пароль</label>
                <input id="password" type="password" placeholder="Пароль" name="password" required>
                @if ($errors->has('password'))
                <div class="error-msg">
                  {{ $errors->first('password') }}
                </div>
                @endif
              </div>
              <div class="btn__send">
                <input type="submit" class="btn" value="Вход">
              </div>
              <div class="btn__recovery">
                <a href="{{ route('password.request') }}" class="btn">Востановление пароля</a>
              </div>
              
              <div class="btn__recovery">
                У Вас нет аккаунта? <a href="/#signup" class="btn">Зарегистрируйтесь!</a>
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </section>
@endsection