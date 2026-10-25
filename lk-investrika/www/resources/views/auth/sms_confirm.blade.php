@extends('layouts.insideapp')
@section('content')
    <section class="registration-investor">
      <div class="container-fluid container-lg">
        <div class="row">
          <div class="col-md-12">
            <div class="registration-investor__title">
              Регистрация <!-- <span class="blue-text">инвестор</span> -->
            </div>
            <div class="registration-investor__subtitle">
              Введите 5-значный код, который мы отправили на номер Вашего телефона
            </div>
            <form action="" method="post" class="main-form">
              {{ csrf_field() }}
              <div class="input-row inline-inputs">
                <input class="inputs-number" name="code[]" type="text" maxlength="1" />
                <input class="inputs-number" name="code[]" type="text" maxlength="1" />
                <input class="inputs-number" name="code[]" type="text" maxlength="1" />
                <input class="inputs-number" name="code[]" type="text" maxlength="1" />
                <input class="inputs-number" name="code[]" type="text" maxlength="1" />
              </div>
              
              <div class="inline-btns">
                <div class="btn__send">
                  <input type="submit" class="btn" value="Проверить код">
                </div>
                
                <div class="btn__edit">
                  <a class="btn" href="/">Изменить номер телефона</a>
                </div>
              </div>

              <div class="message-sand">Мы отправили SMS-сообщение на номер <span>{{ $phone }}</span></div>
            </form>
          </div>
        </div>
      </div>
    </section>
@endsection