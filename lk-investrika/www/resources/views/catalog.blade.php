@extends('layouts.insideapp')

@section('content')

    <section class="catalog">
      <div class="container-fluid container-lg">
        <div class="row">
          <div class="col-md-12">
            <div class="catalog__header">
              <div class="catalog__header-title">
                Каталог компаний
              </div>
              <div class="catalog__items">
                  
                @foreach (App\Category::all() as $category)
                    @if ($category->parent_category_id == null)
                        <a href="#{{ $category->id }}" data-id="{{ $category->id }}" class="catalog__item">{{ $category->name }}</a>
                    @endif
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section class="catalog-content">
      <div class="container-fluid container-lg">
        <div class="row">
                    
          @foreach (App\Product::all() as $index => $product)
          <div class="product col-md-6 col-lg-4
              @foreach ($product->categories as $cat) 
                  cat_{{ $cat->id }} 
            @endforeach">
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
