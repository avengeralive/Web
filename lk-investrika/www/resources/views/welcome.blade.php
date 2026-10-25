@extends('layouts.app')


@section('content')

  <section class="main-registration">
    <div class="container-fluid container-lg">
      <div class="row">
        <div class="col-md-12 col-lg-7">
          <div class="main-registration__title">
            Инвестиции и вклады
            в проверенные компании и в прорывные стартапы.
          </div>
          <div class="main-registration__subtitle">
            Мы даем возможность диверсифицировать риски и иметь стабильный доход.

          </div>
        <a  name="signup" id="signup"></a>
          <form action="{{route('register')}}" method="post" class="registration-form mrg-t-100">
              {{ csrf_field() }}
            <div class="registration-form_title">
              Пройти Регистрацию
            </div>
            <div class="registration-form__radio-title">
              Кем вы являетесь
            </div>
            
            <div class="registration-form__radio-container">
              <label class="registration-form__radio">Я инвестор
                <input type="radio" checked="checked" name="role" value="investor">
                <span class="checkmark"></span>
              </label>
              <label class="registration-form__radio mrg-l-15">Я компания
                <input type="radio" name="role" value="company">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="registration-form__input">
              <input type="text" placeholder="Ваше Имя" name="name" class="name">
            </div>
            <div class="registration-form__input">
              <input type="text" name="phone" placeholder="Номер телефона" class="phone">
            </div>
            <div class="btn-send">
              <input type="submit" class="btn" value="Зарегистрироваться">
            </div>

          </form>
        </div>
        <div class="col-md-12 col-lg-5">
          <div class="steps-registration">

            <div class="step-progress">
              <span style="height: 20%;"></span>
            </div>

            <div class="step__registration-on-system">
              <div class="step-icon registration-on-system__img">
                <img src="./img/registration-on-system__icon.png" alt="">
              </div>
              <div class="step-registration__title active">
                Регистрация в системе
              </div>
              <div class="step-registration__description">
                Пройдите регистрацию как инвестор/компания для того чтобы познакомиться с нами и начать получать доход.
              </div>
            </div>

            <div class="step__registration-on-system">
              <div class="step-icon filling-information__img">
                <img src="./img/filling-information__icon.png" alt="">
              </div>
              <div class="step-registration__title">
                Заполнение информации
              </div>
              <div class="step-registration__description">
                Нам необходима будет основная информация как инвестора или компании для дальнейшей плодотворной работы с вами.
                </div>
            </div>

            <div class="step__registration-on-system">
              <div class="step-icon directory-access__img">
                <img src="./img/directory-access__icon.png" alt="">
              </div>
              <div class="step-registration__title">
                Доступ к каталогу
              </div>
              <div class="step-registration__description">
                Вы получаете полный доступ ко всем инвестиционным сделкам, где можете выбрать подходящую и начать зарабатывать.
              </div>
            </div>

            <div class="step__registration-on-system">
              <div class="step-icon receiving-profit__img">
                <img src="./img/receiving-profit__icon.png" alt="">
              </div>
              <div class="step-registration__title none-border-after">
                Получение прибыли
              </div>
              <div class="step-registration__description">
                Инвестируйте в понравившиеся проекты и получайте доход.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  </header>

  <!--<main id="main">

    <section class="project-presentation" id="presentation">
      <div class="container-fluid padding-0">
        <div class="row margin-0">
          <div class="col-md-12 padding-0">
            <div class="project-presentation__title">
              Основные инвестиционные направления
            </div>
            <div class="project-presentation__description">
              Максимально понятные и прибыльные сферы бизнеса.             </div>
          </div>
        </div>
        <div class="row margin-0">
          <div class="col-md-12 padding-0">
            <div class="project-presentation__container">
              <div class="project-presentation__img">
                <img src="./img/aaron-barnaby.jpg" alt="">
              </div>
              <div class="project-presentation__text-content">
                <div class="project-presentation__title-text">
                  Промышленность
                </div>
                <div class="project-presentation__description-text">
                  Выбирая промышленность, вы инвестируете в реальный сектор экономики. Вы вкладываете в производство товаров, востребованных на рынке, которые можно увидеть и потрогать, тем самым гарантируете себе доход.

                </div>
                <div class="btn_open">
                  <a href="{{route('catalog')}}" class="btn">Смотреть в каталоге</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 padding-0">
            <div class="project-presentation__container even">
              <div class="project-presentation__text-content">
                <div class="project-presentation__title-text">
                  Торговая сеть
                </div>
                <div class="project-presentation__description-text">
                  Инвестиции в торговую сеть стимулируют ее рост и торговый оборот.
                  Этот сектор экономики ближе всего соприкасается
                  с потребностями людей. Товары народного потребления пользуются спросом ежедневно,
                  поэтому ваши вложения начнут работать
                  с первых дней.
                </div>
                <div class="btn_open">
                  <a href="{{route('catalog')}}" class="btn">Смотреть в каталоге</a>
                </div>
              </div>
              <div class="project-presentation__img">
                <img src="./img/central-embassy.jpg" alt="">
              </div>
            </div>
          </div>

          <div class="col-md-12 padding-0">
            <div class="project-presentation__container no-borders">
              <div class="project-presentation__img">
                <img src="./img/clement-h.jpg" alt="">
              </div>
              <div class="project-presentation__text-content">
                <div class="project-presentation__title-text">
                  IT Компания
                </div>
                <div class="project-presentation__description-text">
                  Инвестиции в ай-ти компании считаются рисковыми, но риски
                  оправданы высокими процентными ставками. Ай-ти сектор — самое
                  быстрорастущее и популярное направление в бизнесе.
                  Мы проводим жесткий отбор среди компаний, представленных на рынке,
                  поэтому в наш список попадают только надежные проекты.
                </div>
                <div class="btn_open">
                  <a href="{{route('catalog')}}" class="btn">Смотреть в каталоге</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="questions" id="faq">
      <div class="container-fluid container-lg">
        <div class="row">
          <div class="col-md-12">
            <div class="questions__title-text">
              Часто задаваемые
              вопросы
            </div>
            <div class="questions__subtitle">
              Инвестируйте в проверенные компании, мы даем возможность
              диверсифицировать риски и иметь стабильный доход.
            </div>
          </div>
         
            <div class="col-md-12">
              <div class="questions__items accordion">
                <div class="questions__item">
                  <div class="questions__title toggle">
                    Почему компании не кредитуются в банке?
                  </div>
                  <div class="questions__description inner">
                    Первый фактор, банки очень долго проверяют бизнес, а деньги нужны очень быстро. Второй фактор, большинство банков требуют залоговое движимое или недвижимое имущество, у бизнесов зачастую его нет, для нас достаточно личного поручительства, конечно же мы проверяем активы физ лиц.                  </div>
                </div>

                <div class="questions__item">
                  <div class="questions__title toggle">
                    Какие гарантии?
                  </div>
                  <div class="questions__description inner">
                    По кредитной модели, документально заключаются два договора, договор займа на юр лицо и договор личного поручительства. Также команда компании Инвестрика очень тщательно проверяют каждую компанию, которая обращается за помощью в привлечении инвестиций и тем самым старается минимизировать риски. 

                  </div>
                </div>

                <div class="questions__item">
                  <div class="questions__title toggle">
                    Какая у Вас минимальная сумма инвестиций? 
                  </div>
                  <div class="questions__description inner">
                    По кредитной модели от 500.000 рублей. По долевому участию в среднем от 3.000.000 рублей.                  </div>
                </div>

                <div class="questions__item">
                  <div class="questions__title toggle">
                    Могут ли инвестировать физические лица?
                  </div>
                  <div class="questions__description inner">
                    Конечно могут. За вас компания заемщик будет уплачивать НДФЛ.
                  </div>
                </div>

                <div class="questions__item">
                  <div class="questions__title toggle">
                    Как вы проверяете компании?
                  </div>
                  <div class="questions__description inner">
                    По кредитной модели у нас 4 ступени проверки компаний: 1. Первоначальный скоринг по телефону и заполнение анкеты. 2. Интервью с владельцами бизнеса. 3. Скоринг фин отчетности, физ лиц и юр лиц. 4. Инвестиционный комитет. По стартапам, это в первую очередь проверка актуальности бизнес-идеи и отбор команды проекта.
                  </div>
                </div>

                <div class="questions__item">
                  <div class="questions__title toggle">
                    Как выглядит структура сделки? 
                  </div>
                  <div class="questions__description inner">
                    Инвестору предоставляется всея документация и презентационные материалы. Далее происходит знакомство с владельцами бизнеса (по желанию). Принятие решения и составление договора займа и договора личного поручительства. Далее перечисление денежных средств и в последующем получение прибыли. 

                  </div>
                </div>
              </div>
        </div>
      </div>
    </section>

    <section class="about-us" id="about-us">
      <div class="container-fluid container-lg">
          
          <div class="col-md-12">
            <div class="about-us__title">Отзывы наших клиентов</div>
          </div>
          
        <div class="row owl-carousel owl-theme">
          
          <div>
            <div class="about-us__comment-container">
              <div class="about-us__comment-text">
                Добрый день. Меня зовут Павел. Я являюсь инвестором и со-инвестором во множествах проектах. Первые свои инвестиционные шаги я начинал с Николаем и его компанией Инвестрика. Николай за всё время нашего общения и ряда успешных проектов показал себя с наилучшей стороны как по предоставляемой информации, так и в помощи принятия решений требующих детальных проработок. 
С уважением, Павел Б.

              </div>
              <div class="about-us__comment-author">
                Безенков Павел, инвестор
              </div>
            </div>
          </div>
          
          <div>
            <div class="about-us__comment-container">
              <div class="about-us__comment-text">
                Работаю с ребятами с осени 2018 года, всем доволен. Стояла задача разместить высвободившуюся часть капитала. Для начала попробовал займовую модель на небольшой сумме. Дождался завершения срока займа, получил назад % и тело займа. Все было вовремя и в полном объёме. После увеличил лимиты по займам, заходя в новые сделки. Неплохо зарабатываю вместе с ними на коротких историях. Также, помимо займов, с основателями интересно общаться, как с людьми, предпринимателями. 
На текущий момент у меня впечатление, что для ребят слово репутация - не пустой звук.

              </div>
              <div class="about-us__comment-author">
                Позин Дмитрий , инвестор
              </div>
            </div>
          </div>
          
          
          <div>
            <div class="about-us__comment-container">
              <div class="about-us__comment-text">
                Приветствую! На протяжении последних двух лет активно сотрудничаю с компанией Инвестрика. Выражаю благодарность за финансовую компетенцию всей компании. Приоритетным параметром для меня является безопасность инвестиций и исполнения всех принятых на себя обязательств компании в целом. Отдельно отмечаю ведущего консультанта и аналитика инвест рынка  Евгения за грамотно выстроенные отношения с инвестором. Губанов М.

              </div>
              <div class="about-us__comment-author">
                Губанов Максим, инвестор
              </div>
            </div>
          </div>
          
          <div>
            <div class="about-us__comment-container">
              <div class="about-us__comment-text">
                Выражаю свою благодарность команде Инвестрика, а так же Евгению, который проявил интерес и доверие к нам. Он поверил в нашу компанию, помог ей вырасти и достичь поставленных целей! Сотрудничать с Инвестрикой очень комфортно, они всегда относятся с пониманием к ситуации и компетентно помогают решить любые финансовые вопросы. Сотрудничаем мы с лета 2018 года (уже 6 месяцев) и привлекли за это время инвестиций на сумму 50 млн рублей: за счет этих денег моя компания в цифрах выросла в 8 раз, у меня наконец то появился свой собственный склад, а моя команда из 5 человек теперь состоит из 12! По гибкости и быстроте сбора средств ребята опережают любые банки и МКК и МФО в Москве! Надеюсь и в будущем на наши взаимовыгодные отношения!
              </div>
              <div class="about-us__comment-author">
                ООО "Профи", компания
              </div>
            </div>
          </div>
          
          
          <div>
            <div class="about-us__comment-container">
              <div class="about-us__comment-text">
                Знакомство произошло 2 года назад. Ребята пригласили сразу в офис к себе, чтобы рассказать и познакомить меня с их деятельностью. Было ощущение, что я попал куда нужно. Атмосфера в офисе уютная и располагает к взаимному сотрудничеству. За все время пребывания на площадке, я получил множество полезных знакомств и даже друзей. Ребята постоянно проводят различные мероприятия по видам инвестиций и помогают с выбором, исходя из вашей ситуации по инвестиционным целям и возможностям. Всегда на связи и ответят в любое время суток)) Ну и в конце добавлю, что за все время, я ни разу не разочаровался в компании  Инвестрика, и остаётся только позитив и настрой двигаться вперёд! Кто хочет, чтобы ваши заработанные деньги, которые вы ещё не успели потратить или копите, приносили вам пассивный доход, то вам в Инвестрику!

              </div>
              <div class="about-us__comment-author">
               Калиткин Кирилл, инвестор
              </div>
            </div>
          </div>
          
          <div>
            <div class="about-us__comment-container">
              <div class="about-us__comment-text">
                В данный момент становится все сложнее  искать хорошие проекты для инвестиций, да и времени свобного на это особо нет. Сотрудники  Инвестрики уже второй год оказывают мне хорошую помощь в этом вопросе. Очень радует оперативность ребят, вовлеченность в процесс, и главное способность договариваться с проектами о хороших условиях для инвестора( залоги, ставки) Короче рекомендую.
              </div>
              <div class="about-us__comment-author">
                Свиридов Сергей, инвестор
              </div>
            </div>
          </div>

<div>
            <div class="about-us__comment-container">
              <div class="about-us__comment-text">
                Делаю вклады с ребятами из компании Инвестрика с момента ее появления. В Инвестрике, ребята в любое время на связи и оперативно связываются с заемщиками по всем текущим вопросам. На данный момент с командой Инвестрики мы успешно закончили 5 проектов длительностью от двух недель до 1 года, по которым не было проблем ни с выплатой процентов, ни с возвратом основной суммы долга (несмотря на то, что инвестиции под высокие проценты предполагают известную долю риска). С учетом имеющегося опыта, а также всех «за» и «против», МОГУ СКАЗАТЬ, ЧТО инвестиции в бизнес выглядят очень неплохой альтернативой банковским вкладам.            
              </div>
              <div class="about-us__comment-author">
                Старцева Ксения, инвестор
              </div>
            </div>
          </div>
         
         
        </div>
      </div>
    </section>

  </main>-->

  <footer class="footer-bg">
    <!--<section class="footer-registration" id="registration">
      <div class="container-fluid container-lg">
        <div class="row">
          <div class="col-md-12 col-lg-7">
            <form action="{{route('register')}}" method="post" class="registration-form mrg-t-100">
                {{ csrf_field() }}
              <div class="registration-form_title">
                Пройти Регистрацию
              </div>
              <div class="registration-form__radio-title">
                Кем вы являетесь
              </div>
              <div class="registration-form__radio-container">
                <label class="registration-form__radio">Я инвестор
                  <input type="radio" checked="checked" name="radio">
                  <span class="checkmark"></span>
                </label>
                <label class="registration-form__radio mrg-l-15">Я компания
                  <input type="radio" name="radio">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="registration-form__input">
                <input type="text" class="name" name="name" placeholder="Ваше Имя">
              </div>
              <div class="registration-form__input">
                <input type="text" class="phone" name="phone" placeholder="Номер телефона">
              </div>
              <div class="btn-send">
                <input type="submit" class="btn" value="Отправить">
              </div>

            </form>
          </div>
          <div class="col-md-12 col-lg-5">
            <div class="footer-contact mrg-t-100">
              <div class="footer-contact__title">
                Контакты
              </div>
              <div class="footer-contact__content">
                <div class="footer-contact__content-title">
                  Поддержка пользователей
                </div>
                <div class="footer-contact__content-value">
                  <a href="mailto:support@investrika.com">support@investrika.com</a>
                </div>
              </div>

              <div class="footer-contact__content">
                <div class="footer-contact__content-title">
                  Финансовый департамент
                </div>
                <div class="footer-contact__content-value">
                  <a href="mailto:contact@investrika.com">contact@investrika.com</a>
                </div>
              </div>

              <div class="footer-contact__content">
                <div class="footer-contact__content-title">
                  Телефон
                </div>
                <div class="footer-contact__content-value">
                  <a href="tel:+74952554055">+7 495 255 40 55</a>
                </div>
              </div>

              <div class="footer-contact__content">
                <div class="footer-contact__content-title">
                  Адрес
                </div>
                <div class="footer-contact__content-value">
                 Москва, улица Бауманская дом 7, строение 1
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>-->
  

@endsection