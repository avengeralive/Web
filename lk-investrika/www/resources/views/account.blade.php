@extends('layouts.insideapp')

@section('content')

    <section class="personal-area">
      <div class="container-fluid container-lg">
        <div class="row">
          <div class="col-md-3">
            <div class="nav-title">
              Личный кабинет
            </div>
            <ul class="nav flex-column">
              <!--<li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#list-investments">Перечень инвестиций</a>
              </li>-->
              <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#investment-calculator">Инвестиционный калькулятор</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#investment-myinvestitions">Мои портфель</a>
              </li>
              <!--<li class="nav-item">
                <a class="nav-link " data-toggle="pill" href="#investment-mydocs">Мои документы</a>
              </li>-->
              <li class="nav-item">
                <a class="nav-link" onclick="$('.childnav').toggleClass('active');">Новые проекты</a>
                <style>.childnav { height: 0px; overflow: hidden; transition: .3s ease; } .childnav.active { height: auto; }</style>
                <ul class="nav flex-column childnav">
                  <li class="nav-item" style="padding-right: 0px; font-size: 14px; line-height: 12px;">
                    <a class="nav-link " data-toggle="pill" href="#investment-zaym">Долевое участие</a>
                  </li>
                  <li class="nav-item" style="padding-right: 0px; font-size: 14px; line-height: 12px;">
                    <a class="nav-link " data-toggle="pill" href="#investment-cred">Кредитование</a>
                  </li>
                  <li class="nav-item" style="padding-right: 0px; font-size: 14px; line-height: 12px;">
                    <a class="nav-link " data-toggle="pill" href="#investment-startups">Стартапы</a>
                  </li>
                </ul>
              </li>
              <!--<li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#investor-school">Шкала инвестора</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#personal-manager">Личный менеджер</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#profile-settings">Настройки профиля</a>
              </li>-->
            </ul>
          </div>


          <div class="col-md-9 bg-grey">
            <div class="tab-content">
              <!-- Перечень инвестиций -->
              <!--<div class="tab-pane" id="list-investments">
                <div class="row">
                  <div class="col-md-12">
                    <div class="item-title">Перечень инвестиций</div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="list-investments__container">
                      <div class="list-empty">В данном разделе будут отображаться компании в которые вы проинвестировали.
                      </div>
                    </div>
                  </div>
                </div>
              </div>-->

              <!-- Инвестиционный калькулятор -->
              <div class="tab-pane active" id="investment-calculator">
                <div class="row">
                  <div class="col-md-12">
                    <div class="item-title">Инвестиционный калькулятор</div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="calculator__top-container">
                      <div class="calculator__subtitle">
                        Выберите компании для расчета прибыли:
                      </div>
                      <div class="calculator__select-container">
                        <div class="calculator__select-block">
                          Наименование компании
                        </div>
                        <div class="calculator__select-items">
                          <ul>
                            @foreach (App\Product::all() as $index => $product)
                            <li data-id="{{$product->id}}" data-percent="{{$product->percent}}">{{$product->name}}</li>
                           @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="calculator-inputs">
                      <div class="calculator-inputs__input">
                        <div class="input-group mrg-r-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Сумма (руб.)</span>
                          </div>
                          <input class="form-control" type="number" id="calc_sum" value="100000" />
                        </div>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Срок (мес.):</span>
                          </div>
                          <input class="form-control" type="number" id="calc_month" value="12" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="color-info_container">
                      <div class="color-info_block">
                        <span class="color dark-blue"></span> Сумма вложений
                      </div>
                      <div class="color-info_block">
                        <span class="color blue"></span> Заработок
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="calculator-chart">
                      <div id="chartdiv3"></div>
                      <!--<canvas id="chart" width="400" height="400"></canvas>-->
                    </div>
                  </div>
                </div>
              </div>


              <div class="tab-pane fade" id="investment-myinvestitions">
                <div class="row">
                  <div class="col-md-12">
                    <div class="item-title">Мой портфель</div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="list-investments__container">
                      <table class="table">
                        <tr>
                          <th>Название компании</th>
                          <th>Сумма</th>
                          <th>Процент</th>
                          <th>Платеж</th>
                          <th>День выплат</th>
                          <th>Дата подписания договора</th>
                          <th>Дата окончания договора</th>
                          <th>Договор</th>
                        </tr>
                        @foreach ($user->investments as $index => $investment)
                          <tr>
                            <td>{{ $investment->product->name }}</td>
                            <td>{{ $investment->summ }}</td>
                            <td>{{ $investment->product->percent }}%</td>
                            <td>{{ $investment->summ * $investment->product->percent * 87 / 10000 / 12 }}</td>
                            <td>{{ date('d', strtotime($investment->created_at)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($investment->created_at)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($investment->created_at->addYear())) }}</td>
                            <td>@isset ($investment->docs)
                                @foreach ($investment->docs as $doc)
                                  <p><a href="/docs/{{$doc->id}}">Документ&nbsp;{{$doc->id}}</a></p>
                                @endforeach
                                @endisset
                            </td>
                          </tr>
                        @endforeach
                      </table>
                    </div>
                  </div>
                  <div class="col-md-12 text-center">
                    <h2>Инвестиции</h2>
                    <div id="chartdiv"></div>
                    <h2>Выплаты</h2>
                    <div id="chartdiv2"></div>
                  </div>
                  <script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.PieChart);

// Add data
chart.data = [ @foreach ($user->investments as $index => $investment) {
  "country": "{{ $investment->product->name }}",
  "litres": {{ $investment->summ }}
}, @endforeach ];

// Set inner radius
chart.innerRadius = am4core.percent(50);

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;


var chart2 = am4core.create("chartdiv2", am4charts.PieChart);

// Add data
chart2.data = [ @foreach ($user->investments as $index => $investment) {
  "country": "{{ $investment->product->name }}",
  "litres": {{ $investment->summ * $investment->product->percent * 87 / 10000 }}
}, @endforeach ];

// Set inner radius
chart2.innerRadius = am4core.percent(50);

// Add and configure Series
var pieSeries2 = chart2.series.push(new am4charts.PieSeries());
pieSeries2.dataFields.value = "litres";
pieSeries2.dataFields.category = "country";
pieSeries2.slices.template.stroke = am4core.color("#fff");
pieSeries2.slices.template.strokeWidth = 2;
pieSeries2.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries2.hiddenState.properties.opacity = 1;
pieSeries2.hiddenState.properties.endAngle = -90;
pieSeries2.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script>
<style>
#chartdiv, #chartdiv2, #chartdiv3 {
  width: 100%;
  height: 500px;
}
</style>
                </div>
              </div>

              <!-- Кредитования -->
              <div class="tab-pane fade" id="investment-cred">
                <div class="row">
                  <div class="col-md-12">
                    <div class="item-title">Кредитование</div>
                  </div>
                </div>

                <div class="row">
                  @foreach ($creds as $index => $product)
          <div class="product col-md-6 col-lg-6">
            <div class="company-content">
              <div class="company-content__img-container">
                <div class="company-content__img">
                  <img src="/img/logo_bg.png" alt="">
                </div>
                <div class="company-content__absolute-content">
                  <div class="upper-block">
                    @if($product->percent_type == 'bet') 
                    Ставка {{ $product->percent }}%
                    @endif
                    
                    @if($product->percent_type == 'share') 
                    Доля {{ $product->percent }}%
                    @endif
                  </div>
                  <div class="left-block">
                    {{ $product->name }}
                  </div>
                  <div class="right-block">
                    Порог входа
                    <span class="min-cost">{{ number_format($product->minsumm) }} руб.</span>
                  </div>
                </div>
              </div>
              <div class="company-content__text-container">
                <div class="company-content__description">{{ $product->description }}</div>
                <a href="#" class="detailed-target">
                Подробнее
              </a>
              </div>
              <div class="company-content__footer">
                <div class="investment-size">
                  Объем инвестиций: <span class="value">{{ number_format($product->summ) }} руб.</span>
                  <span class="collected">{{ round($product->currentSumm() / $product->summ * 100, 2) }}%</span>
                </div>
                
                <div class="investment-size">
                  Проинвестировано: <span class="value">{{ number_format($product->currentSumm()) }} руб.</span>
                </div>
                
                <div class="progress-bar">
                  <span style="width: {{ round($product->currentSumm() / $product->summ * 100, 2) }}%"></span>
                </div>
                <div class="btn-send">
                  <div class="btn" onclick="invest({{ $product->id }})">Проинвестировать</div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
                </div>
              </div>

              <div class="tab-pane fade" id="investment-zaym">
                <div class="row">
                  <div class="col-md-12">
                    <div class="item-title">Долевое участие</div>
                  </div>
                </div>

                <div class="row">
                  @foreach ($zays as $index => $product)
          <div class="product col-md-6 col-lg-6">
            <div class="company-content">
              <div class="company-content__img-container">
                <div class="company-content__img">
                  <img src="/img/logo_bg.png" alt="">
                </div>
                <div class="company-content__absolute-content">
                  <div class="upper-block">
                    @if($product->percent_type == 'bet') 
                    Ставка {{ $product->percent }}%
                    @endif
                    
                    @if($product->percent_type == 'share') 
                    Доля {{ $product->percent }}%
                    @endif
                  </div>
                  <div class="left-block">
                    {{ $product->name }}
                  </div>
                  <div class="right-block">
                    Порог входа
                    <span class="min-cost">{{ number_format($product->minsumm) }} руб.</span>
                  </div>
                </div>
              </div>
              <div class="company-content__text-container">
                <div class="company-content__description">{{ $product->description }}</div>
                <a href="#" class="detailed-target">
                Подробнее
              </a>
              </div>
              <div class="company-content__footer">
                <div class="investment-size">
                  Объем инвестиций: <span class="value">{{ number_format($product->summ) }} руб.</span>
                  <span class="collected">{{ round($product->currentSumm() / $product->summ * 100, 2) }}%</span>
                </div>
                
                <div class="investment-size">
                  Проинвестировано: <span class="value">{{ number_format($product->currentSumm()) }} руб.</span>
                </div>
                
                <div class="progress-bar">
                  <span style="width: {{ round($product->currentSumm() / $product->summ * 100, 2) }}%"></span>
                </div>
                <div class="btn-send">
                  <div class="btn" onclick="invest({{ $product->id }})">Проинвестировать</div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
                </div>
              </div>

              <div class="tab-pane fade" id="investment-startups">
                <div class="row">
                  <div class="col-md-12">
                    <div class="item-title">Стартапы</div>
                  </div>
                </div>


                <div class="row">
                  @foreach ($startups as $index => $product)
          <div class="product col-md-6 col-lg-6">
            <div class="company-content">
              <div class="company-content__img-container">
                <div class="company-content__img">
                  <img src="/img/logo_bg.png" alt="">
                </div>
                <div class="company-content__absolute-content">
                  <div class="upper-block">
                    @if($product->percent_type == 'bet') 
                    Ставка {{ $product->percent }}%
                    @endif
                    
                    @if($product->percent_type == 'share') 
                    Доля {{ $product->percent }}%
                    @endif
                  </div>
                  <div class="left-block">
                    {{ $product->name }}
                  </div>
                  <div class="right-block">
                    Порог входа
                    <span class="min-cost">{{ number_format($product->minsumm) }} руб.</span>
                  </div>
                </div>
              </div>
              <div class="company-content__text-container">
                <div class="company-content__description">{{ $product->description }}</div>
                <a href="#" class="detailed-target">
                Подробнее
              </a>
              </div>
              <div class="company-content__footer">
                <div class="investment-size">
                  Объем инвестиций: <span class="value">{{ number_format($product->summ) }} руб.</span>
                  <span class="collected">{{ round($product->currentSumm() / $product->summ * 100, 2) }}%</span>
                </div>
                
                <div class="investment-size">
                  Проинвестировано: <span class="value">{{ number_format($product->currentSumm()) }} руб.</span>
                </div>
                
                <div class="progress-bar">
                  <span style="width: {{ round($product->currentSumm() / $product->summ * 100, 2) }}%"></span>
                </div>
                <div class="btn-send">
                  <div class="btn" onclick="invest({{ $product->id }})">Проинвестировать</div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
                </div>

                
              </div>


              <!-- Школа инвестора -->
              <!--<div class="tab-pane fade" id="investor-school">
                <div class="row">
                  <div class="col-md-12">
                    <div class="item-title">Школа инвестора</div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-lg-6">
                    <div class="investor-school__item">
                      <div class="investor-school__icon">
                        <div class="icon icon_1"></div>
                      </div>

                      <div class="investor-school__item-title">
                        Новичок
                      </div>
                      <div class="investor-school__amount-investment">
                        Сумма инвестиции: 500 000
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-lg-6">
                    <div class="investor-school__item">
                      <div class="investor-school__icon">
                        <div class="icon icon_2"></div>
                      </div>

                      <div class="investor-school__item-title">
                        Любитель
                      </div>
                      <div class="investor-school__amount-investment">
                        Сумма инвестиции: 1 000 000
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-lg-6">
                    <div class="investor-school__item">
                      <div class="investor-school__icon">
                        <div class="icon icon_3"></div>
                      </div>

                      <div class="investor-school__item-title">
                        Любитель+
                      </div>
                      <div class="investor-school__amount-investment">
                        Сумма инвестиции: 2 500 000
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-lg-6">
                    <div class="investor-school__item">
                      <div class="investor-school__icon">
                        <div class="icon icon_4"></div>
                      </div>

                      <div class="investor-school__item-title">
                        Инвестор
                      </div>
                      <div class="investor-school__amount-investment">
                        Сумма инвестиции: 5 000 000
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-lg-6">
                    <div class="investor-school__item">
                      <div class="investor-school__icon">
                        <div class="icon icon_5"></div>
                      </div>

                      <div class="investor-school__item-title">
                        Крутой инвестор
                      </div>
                      <div class="investor-school__amount-investment">
                        Сумма инвестиции: 10 000 000
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-lg-6">
                    <div class="investor-school__item">
                      <div class="investor-school__icon">
                        <div class="icon icon_6"></div>
                      </div>
                      <div class="investor-school__item-title">
                        Самый заряженный
                      </div>
                      <div class="investor-school__amount-investment">
                        Сумма инвестиции: 30 000 000
                      </div>
                    </div>
                  </div>
                </div>
              </div>-->

              <!-- Личный менеджер -->
              <!--<div class="tab-pane fade" id="personal-manager">
                <div class="row">
                  <div class="col-md-12">
                    <div class="item-title">Личный менеджер</div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                      
                    @if ($manager)
                    <div class="personal-manager__container">
                      <div class="personal-manager__header">
                        Ваш личный менеджер: {{$manager->name}}
                      </div>
                      <div class="personal-manager__contacts pad-t-2">
                        <div class="personal-manager__contacts_header">
                          Телефон:
                        </div>
                        <div class="personal-manager__contacts_text">
                          {{$manager->phone}}
                        </div>
                      </div>

                      <div class="personal-manager__contacts pad-t-1 pad-b-2">
                        <div class="personal-manager__contacts_header">
                          E-mail:
                        </div>
                        <div class="personal-manager__contacts_text">
                          <a href="{{$manager->email}}">{{$manager->email}}</a>
                        </div>
                      </div>
                    </div>
                    @else
					    Личный менеджер не присвоен
                    @endif
				
                  </div>
                </div>
              </div>-->

              <!-- Настройки профиля -->
              <!--<div class="tab-pane fade" id="profile-settings">
                <div class="row">
                  <div class="col-md-12">
                    <div class="item-title">Настройки профиля</div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="profile-settings__container">
                      <div class="row">
                        <div class="col-md-12 col-lg-4">

                          <div class="container-img">
                            
                            <img src="{{Auth::user()->gravatar(250)}}" class="upload-img" alt=" " id="uploadImg">
                              
                            <div class="input">
                              <input name="input" id="file" class="file" type="file">
                            </div>
                          </div>

                        </div>
                        <div class="col-md-12 col-lg-8">
                          <div class="row">
                            <div class="col-md-12 border-b-contacts">
                              <div class="personal-manager__contacts inline-contacts">
                                <div class="personal-manager__contacts_header">
                                  Телефон:
                                </div>
                                <div class="personal-manager__contacts_text">
                                  {{$user->phone}}
                                </div>
                              </div>

                              <div class="personal-manager__contacts inline-contacts">
                                <div class="personal-manager__contacts_header">
                                  E-mail:
                                </div>
                                <div class="personal-manager__contacts_text">
                                  <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="profile__change-password">
                                <div class="profile__change-password_title">
                                  Изменить пароль
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <form action="#" method="post" class="main-form change-password_form">
                                  
                                  @csrf
                                <div class="input-row">
                                  <input id="password" type="password" name="new_password" value="" placeholder="Введите новый пароль">
                                  <div class="error-msg">
                                    Введите новый пароль
                                  </div>
                                </div>
                                <div class="input-row">
                                  <input id="password-repeat" type="password" name="repeat_password" value="" placeholder="Повторите новый пароль">
                                  <div class="error-msg">
                                    Пароли должны совпадать
                                  </div>
                                </div>
                                <div class="btn__send">
                                  <button type="submit" class="btn">Сохранить</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>-->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- The Modal -->
     <div id="js-invest_modal">
              <div class="modal" id="invest_modal">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <div class="modal-header__img-container">
                        <div class="modal-header__img">
                          <img src="/img/logo_bg.png" alt="">
                        </div>
                        <div class="modal-header__absolute-content">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <div class="left-block"  v-text="product.name"></div>
                          <div class="right-block">
                            Порог входа
                            <span class="min-cost">@{{product.minsumm.toLocaleString()}} руб.</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" v-if="product">
                      <div class="modal-body__progress-container">
                        <div class="progress__left-content">
                          <div class="investment-size">
                            Объем инвестиций: <span class="value">@{{product.summ.toLocaleString()}} руб.</span>
                            <span class="collected">@{{(product.currentsumm/product.summ*100 < 100) ? parseFloat((product.currentsumm/product.summ*100).toFixed(2))+'%' : '100%'}}</span>
                          </div>
                          <div class="progress-bar">
                            <span  v-bind:style="{ width: (product.currentsumm/product.summ*100)+'%', backgroundColor: '#ccc', color: '#000', fontSize: '1rem' }" :aria-valuenow="product.currentsumm" aria-valuemin="0" :aria-valuemax="product.summ"></span>
                          </div>
                        </div>
                        <div class="progress__right-content">
                          <span class="bet" v-if="product.percent_type == 'bet'">Ставка <span v-text="product.percent"></span>%</span>
                          <span class="bet" v-if="product.percent_type == 'share'">Доля <span v-text="product.percent"></span>%</span>
                        </div>
                      </div>
                      <div class="modal-body__text-content" v-text="product.description"></div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <div class="modal-footer__input">
                        <div class="input-group mrg-r-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Сумма (руб.)</span>
                          </div>
                          <input class="form-control" type="number" v-model="price"  />
                        </div>
                        <div class="input-group" v-show="product.percent_type == 'bet'">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Срок (мес.):</span>
                          </div>
                          <input class="form-control" type="number" v-model="time" />
                        </div>
                      </div>
                      <div class="modal-footer__btn">
                        <div class="btn" @click="send">Проинвестировать</div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

              <div class="modal" id="completeModal">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-complete-header">
                      <div class="modal-complete-header__text">
                        Заявка принята
                      </div>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-complete-body">
                      <p>Спасибо за Вашу заявку. Наш менеджер свяжется</p>
                      <p>с Вами и расскажет условия вложений.</p>
                    </div>


                  </div>
                </div>
              </div>
              
              <div class="modal" id="errorInvest">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-complete-header">
                      <div class="modal-complete-header__text">
                        Заявка не принята
                      </div>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-complete-body">
                      <p>Заявка не обработана, проверьте правильность данных.</p>
                    </div>


                  </div>
                </div>
              </div>
              
<script>
  var product_url = '{{ route('getProduct.ajax') }}';
  var csrf = '{{ csrf_token() }}';
</script>
@endsection
