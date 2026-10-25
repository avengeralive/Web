@extends('layouts.insideapp')

@section('content')

    <section class="registration-investor-inner">
      <div class="container-fluid container-lg">
        <div class="row">
          <div class="col-md-12">
            <div class="registration-investor-inner__title">
              Регистрация <span class="blue-text">инвестора</span>
            </div>
            <div class="registration-investor-inner__subtitle">
              Создайте свой личный кабинет Инвестора
            </div>
            <form action="#" method="post" class="main-form">
                
                @csrf
<!--
              <div class="input-row flex-btn">
                <label for="phone-number">Номер телефона</label>
                <input class="width-65" id="phone-number" type="text" placeholder="+380(99)99-49-99">
                <div class="btn-edit-number width-35">Изменить</div>
              </div>
-->

              <div class="input-row__group">
                <div class="input-row {{ $errors->has('first_name') ? 'error' : '' }}">
                  <label for="first-name">Имя</label>
                  <input id="first-name" type="text"  required autofocus placeholder="Введите ваше имя" name="first_name" value="{{ old('first_name') }}">
                  <div class="error-msg">
                    Введите имя
                  </div>
                  
                </div>
                <div class="input-row {{ $errors->has('second_name') ? 'error' : '' }}">
                  <label for="surname">Фамилия</label>
                  <input id="surname" type="text" required placeholder="Введите вашу фамилию" name="second_name" value="{{ old('second_name') }}">
                  <div class="error-msg">
                    Введите фамилию
                  </div>
                </div>
                <div class="input-row {{ $errors->has('middle_name') ? 'error' : '' }}">
                  <label for="middle-name">Отчество</label>
                  <input id="middle-name" type="text" required placeholder="Введите ваше Отчество" name="middle_name" value="{{ old('middle_name') }}">
                  <div class="error-msg">
                    Введите отчество
                  </div>
                </div>
                
                <div class="input-row {{ $errors->has('city') ? 'error' : '' }}">
                  <label for="city">Ваш город</label>
                  <input id="city" type="text" required placeholder="Ваш город" name="city" value="{{ old('city') }}">
                  <div class="error-msg">
                    @if ($errors->has('city'))
                        {{ $errors->first('city') }}
                    @endif
                  </div>
                </div>
                
              </div>

              <div class="input-row__group">
                <div class="input-row {{ $errors->has('middle_name') ? 'error' : '' }}">
                  <label for="investment-area">Сфера для инвестирования</label>
                  <input id="investment-area" type="text" required placeholder="Укажите сферу инвестирования" name="work" value="{{ old('work') }}">
                  <div class="error-msg">
                    Укажите сферу инвестирования
                  </div>
                </div>
                <div class="input-row {{ $errors->has('before') ? 'error' : '' }}">
                  <label for="invested-earlier">Инвестировали ранее?</label>
                  <input id="invested-earlier" type="text" required placeholder="Инвестировали ранее?" name="before" value="{{ old('before') }}">
                  <div class="error-msg">
                    @if ($errors->has('before'))
                        {{ $errors->first('before') }}
                    @endif
                  </div>
                  
                </div>
                
                <div class="input-row {{ $errors->has('investmentto') ? 'error' : '' }}">
                  <div class="slidecontainer">
                    <label for="range-invested">Обьем инвестиций</label>
                    <input type="range" min="0" max="100000000" value="0" step="100000" class="range-slider" id="range-invested" name="investmentto" value="{{ old('investmentto') }}">
                    <div class="range-slider-width" id="range-slider-width"></div>
                    <div class="range-value">
                      до
                      <div id="range-value"></div> руб.
                    </div>
                  </div>
                </div>
              </div>

              <div class="input-row__group">
                <div class="input-row {{ $errors->has('email') ? 'error' : '' }}">
                  <label for="email">Email</label>
                  <input id="email" type="text" placeholder="Укажите свой Email" required name="email" value="{{ old('email') }}">
                  <div class="error-msg">
                    Ошибка. Email некорректен
                  </div>
                </div>
                <div class="input-row {{ $errors->has('password') ? 'error' : '' }}">
                  <label for="password">Пароль</label>
                  <input id="password" type="password" name="password" required  value="{{ old('password') }}" placeholder="Латинские буквы, миним 7 символов">
                  <div class="error-msg">
                    @if ($errors->has('password'))
                        {{ $errors->first('password') }}
                    @endif
                  </div>
                </div>
                <div class="input-row {{ $errors->has('password_confirmation') ? 'error' : '' }}">
                  <label for="password-repeat">Подтвердите пароль</label>
                  <input id="password-repeat" type="password" name="password_confirmation"  value="{{ old('password_confirmation') }}" required placeholder="Пароли должны совпадать">
                  <div class="error-msg">
                    @if ($errors->has('password_confirmation'))
                        {{ $errors->first('password_confirmation') }}
                    @endif
                  </div>
                </div>
              </div>
              <div class="check_terms-and-conditions">
                <div class="checkboxFour">
                  <input type="checkbox" value="1" id="terms-and-conditions" name="check_terms" />
                  <label for="terms-and-conditions"></label>
                </div>
                <span>подтвердите согласия на обработку <a href="#">персональных данных</a></span>
                
                @if ($errors->has('check_terms'))
                    <div>
                    	{{ $errors->first('check_terms') }}
                    </div>
                @endif
                
              </div>
              <div class="btn__send">
                <input type="submit" class="btn" value="Отправить">
              </div>


            </form>
          </div>
        </div>
      </div>
    </section>@endsection
