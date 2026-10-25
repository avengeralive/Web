<div class="es2" style="padding-bottom: 30px;">
   <style>
      .s2, .s3, .s4, .s5, .s6, .s7, .s8 { display: none; }
      .sh li { list-style: none; display: inline-block; }
      .st { display: block;
      color: #00bace;
      cursor: pointer;
      text-decoration: none;
      /*background: #ffe710;*/
      font-size: 20px;
      padding: 5px;
      width: 40px;
      height: 40px;
      line-height: 30px;
      font-family: "ALSSchlangesans-Black";
      border-radius: 20px; }
      .st.active {
      background: #ffe710;
      }
      .s1 li {
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 10px;
      flex-direction: column;
      cursor: pointer;
      }
      .s1 li:hover {
      background: #f0f0f0;
      }
      .s1 li.active {
      background: #f0f0f0;
      border: 5px solid #00bfd4;
      }
      .models { display: none; }
      .edge li {
         list-style: none;
         display: inline-flex;
         width: calc(20% - 20px);
         justify-content: center;
         align-items: center;
         height: 100px;
         margin: 10px;
      }
      .calculator__slider-box__slider-width__slider__list6 li {
         list-style: none;
         display: inline-flex;
         width: calc(50% - 20px);
         justify-content: center;
         align-items: center;
         margin: 10px;
      }
      .edge li:hover {
         background: #f0f0f0;
      }
      .edge li.active {
         background: #f0f0f0;
         border: 5px solid #00bfd4;
      }
      .form_types {
         height: auto !important;
      }
      .form_types li {
         display: inline-block;
      }
      .calculator {
         display: flex;
         flex-direction: row;
         justify-content: center;
         align-items: center;
      }
      .yellow-button.active {
         background: #00bdd1;
         color: #fff !important;
      }
      .checkbox {
         width: 30px;
         height: 30px;
         border: 2px solid #00d7ec;
         float: left;
         display: block;
         cursor: pointer;
         margin-right: 10px;
      }
      .checkbox.active {
         background: #00d7ec;
      }
      @media (max-width: 768px) {
         .calculator__list>li:first-child {
            margin-left: 16px !important;
         }
         .calculator__list>li {
            float: none !important;
         }
         .calculator__list {
             padding: 10px 5px !important;
             text-align: center;
             background: none;
         }
         .es2 .es2_block {
            height: auto !important;
         }
         .calculator_models, .models {
            width: 100%;
         }
         .models img {
            width: 100%;
         }
         .edge li {
            width: calc(40% - 20px);
         }
         .view .texture {
            float: left;
         }
         .calculator__slider-box__slider-width__slider__list6 li {
             list-style: none;
             display: inline-flex;
             width: calc(50% - 20px);
             justify-content: center;
             align-items: center;
             margin: 10px;
             float: left;
         }
         .calculator__slider-box__slider-width__slider__list6 {
            display: block !important;
         }
         .s8 .yellow-button {
            margin-bottom: 10px;
         }
      }
   </style>
   <script type="text/javascript">
         var data = {};
         //data.tip = 
   </script>
   <h2>Калькулятор</h2>
   <div class="container">
      <h3>ПРОЙДИТЕ ВСЕ ШАГИ И РАССЧИТАЙТЕ СТОИМОСТЬ ВАШЕГО ИЗДЕЛИЯ ПРЯМО СЕЙЧАС</h3>
   </div>
   <div class="es2_block">
      <h3 class="s1 ss">Выбор формы</h3>
      <h3 class="s2 ss">Выбор размера</h3>
      <h3 class="s3 ss">Выбор текстуры</h3>
      <h3 class="s4 ss">Наличие криволинейных участков</h3>
      <h3 class="s5 ss">Выбор формы кромки</h3>
      <h3 class="s6 ss">Выбор формы бортиков</h3>
      <h3 class="s7 ss">Наличие вырезов под технику</h3>
      <h3 class="s8 ss">Дополнительные опции</h3>
      <div class="sh">
         <ul class="calculator__list">
            <li><a class="st st1 active" onclick="$('.ss').hide(); $('.s1').show(); $('.st').removeClass('active'); $(this).addClass('active');">1</a></li>
            <li><a class="st st2 isDisabled" onclick="$('.ss').hide(); $('.s2').show(); $('.st').removeClass('active'); $(this).addClass('active');">2</a></li>
            <li><a class="st st3 isDisabled" onclick="$('.ss').hide(); $('.s3').show(); $('.st').removeClass('active'); $(this).addClass('active');">3</a></li>
            <li><a class="st st4 isDisabled" onclick="$('.ss').hide(); $('.s4').show(); $('.st').removeClass('active'); $(this).addClass('active');">4</a></li>
            <li><a class="st st5 isDisabled" onclick="$('.ss').hide(); $('.s5').show(); $('.st').removeClass('active'); $(this).addClass('active');">5</a></li>
            <li><a class="st st6 isDisabled" onclick="$('.ss').hide(); $('.s6').show(); $('.st').removeClass('active'); $(this).addClass('active');">6</a></li>
            <li><a class="st st7 isDisabled" onclick="$('.ss').hide(); $('.s7').show(); $('.st').removeClass('active'); $(this).addClass('active');">7</a></li>
            <li><a class="st st8 isDisabled" onclick="$('.ss').hide(); $('.s8').show(); $('.st').removeClass('active'); $(this).addClass('active');">8</a></li>
         </ul>
      </div>
      <div class="s1 ss">
         <h4 style="margin-top: 30px;">Выберите поверхность:</h4>
         <ul class="form_types">
            <li><a href="#" class="yellow-button active" onclick="$('.form_types li a').removeClass('active'); $(this).addClass('active'); $('.s1 .calculator').hide(); $('.calculator.stol').show();  return false;">Столешницы</a></li>
            <li><a href="#" class="yellow-button" onclick="$('.form_types li a').removeClass('active'); $(this).addClass('active'); $('.s1 .calculator').hide(); $('.calculator.podok').show(); return false;">Подоконники</a></li>
            <li><a href="#" class="yellow-button" onclick="$('.form_types li a').removeClass('active'); $(this).addClass('active'); $('.s1 .calculator').hide(); $('.calculator.other').show(); return false;">Другая форма</a></li>
         </ul>     
         <ul class="calculator stol">
            <li onclick="$('.s1 li').removeClass('active'); $(this).addClass('active'); $('.models').hide(); $('.models-0').show(); $('.s1 .yellow-button').removeClass('isDisabled');">
               <img src="<? echo get_template_directory_uri(); ?>/img/calc/calc-form1.png" alt="Прямая"  style="max-width: 100%;">
               <p>Прямая</p>
            </li>
            <li onclick="$('.s1 li').removeClass('active'); $(this).addClass('active'); $('.models').hide(); $('.models-1').show(); $('.s1 .yellow-button').removeClass('isDisabled');">
               <img src="<? echo get_template_directory_uri(); ?>/img/calc/calc-form2.png" alt="Г - образная" style="max-width: 100%;">
               <p>Г-образная</p>
            </li>
            <li onclick="$('.s1 li').removeClass('active'); $(this).addClass('active'); $('.models').hide(); $('.models-2').show(); $('.s1 .yellow-button').removeClass('isDisabled');">
               <img src="<? echo get_template_directory_uri(); ?>/img/calc/calc-form3.png" alt="П - образная" style="max-width: 100%;">
               <p>П-образная</p>
            </li>
         </ul>
         <ul class="calculator podok" style="display: none;">
            <li onclick="$('.s1 li').removeClass('active'); $(this).addClass('active'); $('.models').hide(); $('.models-3').show(); $('.s1 .yellow-button').removeClass('isDisabled');">
               <img src="<? echo get_template_directory_uri(); ?>/img/calc/calc-form4.png" alt="Радуга" style="max-width: 100%;">
               <p>Эркерная</p>
            </li>
            <li onclick="$('.s1 li').removeClass('active'); $(this).addClass('active'); $('.models').hide(); $('.models-4').show(); $('.s1 .yellow-button').removeClass('isDisabled');">
               <img src="<? echo get_template_directory_uri(); ?>/img/calc/calc-form1.png" alt="Прямая"  style="max-width: 100%;">
               <p>Прямая</p>
            </li>
            <li onclick="$('.s1 li').removeClass('active'); $(this).addClass('active'); $('.models').hide(); $('.models-5').show(); $('.s1 .yellow-button').removeClass('isDisabled');">
               <img src="<? echo get_template_directory_uri(); ?>/img/calc/calc-form2.png" alt="Г - образная" style="max-width: 100%;">
               <p>Г-образная</p>
            </li>
         </ul>
         <ul class="calculator other" style="display: none;">
            <li onclick="$('.s1 li').removeClass('active'); $(this).addClass('active'); $('.models').hide(); $('.models-6').show(); $('.s1 .yellow-button').removeClass('isDisabled');">
               <img src="<? echo get_template_directory_uri(); ?>/img/calc/calc-form5.png" alt="Круглая" style="max-width: 100%;">
               <p>Круглая</p>
            </li>
            <li onclick="$('.s1 li').removeClass('active'); $(this).addClass('active'); $('.models').hide(); $('.models-7').show(); $('.s1 .yellow-button').removeClass('isDisabled');">
               <img src="<? echo get_template_directory_uri(); ?>/img/calc/calc-form6.png" alt="Круглая" style="max-width: 100%;">
               <p>Овальная</p>
            </li>
         </ul>
      <a class="yellow-button isDisabled" style="cursor: pointer;" onclick="$('.s1').hide(); $('.s2').show(); $('.st').removeClass('active'); $('.st2').addClass('active'); $('.st2').removeClass('isDisabled');">Далее</a>
   </div>
   <div class="s2 ss">
      <ul class="calculator_models">
         <li class="models-0 models active">
            <input type="text" class="size size-top" alt="Размер Сверху" value="2 500">
            <input type="text" class="size size-left" alt="Размер Слева" value="600">
            <img src="<? echo get_template_directory_uri(); ?>/img/model/model11.png" alt="">
         </li>
         <li class="models-1 models">
            <input type="text" class="size size-top" alt="Размер Сверху" value="2 500">
            <input type="text" class="size size-left" alt="Размер Слева" value="1 200">
            <input type="text" class="size size-right" alt="Размер Справа" value="600">
            <input type="text" class="size size-bottom" alt="Размер Снизу" value="600">
            <img src="<? echo get_template_directory_uri(); ?>/img/model/model44.png" alt="">
         </li>
         <li class="models-2 models">
            <input type="text" class="size size-top" alt="Размер Сверху" value="2 500">
            <input type="text" class="size size-left" alt="Размер Слева" value="1 200">
            <input type="text" class="size size-right" alt="Размер Справа" value="1 200">
            <input type="text" class="size size-left-bottom" alt="Размер Слева Снизу" value="600">
            <input type="text" class="size size-right-bottom" alt="Размер Справа Снизу" value="600">
            <input type="text" class="size size-center" alt="Размер По центру" value="600">
            <img src="<? echo get_template_directory_uri(); ?>/img/model/model33.png" alt="">
         </li>
         <li class="models-3 models">
            <input type="text" class="size size-top" alt="Размер Сверху" value="2 500">
            <input type="text" class="size size-left" alt="Размер Слева" value="300">
            <input type="text" class="size size-left-left" alt="Размер Слева Слева" value="1 200">
            <img src="<? echo get_template_directory_uri(); ?>/img/model/model22.png" alt="">
         </li>
         <li class="models-4 models">
            <input type="text" class="size size-top" alt="Размер Сверху" value="2 500">
            <input type="text" class="size size-left" alt="Размер Слева" value="300">
            <img src="<? echo get_template_directory_uri(); ?>/img/model/model11.png" alt="">
         </li>
         <li class="models-5 models">
            <input type="text" class="size size-top" alt="Размер Сверху" value="2 500">
            <input type="text" class="size size-left" alt="Размер Слева" value="1 200">
            <input type="text" class="size size-right" alt="Размер Справа" value="300">
            <input type="text" class="size size-bottom" alt="Размер Снизу" value="300">
            <img src="<? echo get_template_directory_uri(); ?>/img/model/model44.png" alt="">
         </li>
         <li class="models-6 models">
            <input type="text" class="size size-top" alt="Радиус" value="2 500">
            <img src="<? echo get_template_directory_uri(); ?>/img/model/model55.png" alt="">
         </li>
         <li class="models-7 models">
            <input type="text" class="size size-top" alt="Ширина" value="2 500">
            <input type="text" class="size size-left" alt="Длина" value="900">
            <img src="<? echo get_template_directory_uri(); ?>/img/model/model66.png" alt="">
         </li>
      </ul>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s2').hide(); $('.s1').show(); $('.st').removeClass('active'); $('.st1').addClass('active');">Назад</a>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s2').hide(); $('.s3').show(); $('.st').removeClass('active'); $('.st3').addClass('active'); $('.st3').removeClass('isDisabled');">Далее</a>
   </div>
   <div class="s3 ss">
      <div class="view active" id="grandex_1" style="box-sizing: border-box; height: 350px;">
         <div class="row">
            <script type="text/javascript">
  $(function(){
    var mod = 0;
    $('.pkm').change(function(){
        if ($(this).val() == 0) {
          $('.texture').show();
          $('.subcat').hide();
        } 
        else { 
          $('.texture').hide(); 
          $('.texture' + $(this).val()).show(); 
          $('.subcat').hide(); 
          $('.kat_models' + $(this).val()).show(); 
        }
        mod = $(this).val();
    });
    $('.subcat').change(function(){
        if ($(this).val() == 0) {
          $('.texture').hide(); 
          $('.texture' + mod).show();
        } 
        else { 
          $('.texture').hide(); 
          $('.texture' + $(this).val()).show();
        }
    });
  });
</script>
            <select class="kat_models pkm" onchange="">
        <option value="0">Все</option>
        <?
          $terms = get_terms( array(
            'taxonomy' => 'texture_category',
            'hide_empty' => false,
            'parent' => 0
          ) );
          foreach ($terms as $prod) { 
        ?>
        <option value="<? echo $prod->term_id; ?>"><? echo $prod->name; ?></option>
        <? } ?>
      </select>
      <? foreach ($terms as $prod) { ?>
      <select class="kat_models subcat kat_models<? echo $prod->term_id; ?>" style="display: none;">
        <option value="0" onclick="$('.texture').hide(); $('.texture<? echo $prod->term_id; ?>').show(); $('.kat_models<? echo $prod->term_id; ?> a').removeClass('active'); $(this).addClass('active');" data-filter="">Все</option>
        <?
          $terms2 = get_terms( array(
            'taxonomy' => 'texture_category',
            'hide_empty' => false,
            'parent' => $prod->term_id
          ) );
          foreach ($terms2 as $prod2) { 
        ?>
        <option value="<? echo $prod2->term_id; ?>" onclick="$('.texture').hide(); $('.texture<? echo $prod2->term_id; ?>').show(); $('.kat_models<? echo $prod->term_id; ?> a').removeClass('active'); $(this).addClass('active');" data-filter="<? echo $prod2->term_id; ?>"><? echo $prod2->name; ?></option>
        <? } ?>
      </select>
      <? } ?>
   </div>
   <div class="container" style="padding: 40px 0px;">
    <? $prods = get_posts(array('post_type' => 'textrure', 'posts_per_page' => 1000, 'order' => 'ASC'));
    foreach ($prods as $prod) { 
      $terms = get_the_terms($prod->ID, 'texture_category');
      ?>  
    <div class="col-md-2 texture texture<? echo $terms[0]->term_id; ?> texture<? echo $terms[1]->term_id; ?>" style="margin-bottom: 40px;">
      <img src="<? echo get_the_post_thumbnail_url($prod->ID); ?>" style="width: 100%;">
      <p style="    font-family: 'Roboto', sans-serif; text-align: center; font-size: 15px; margin-top: 10px;"><? echo $prod->post_title; ?></p>
    </div>  
    <? } ?>
         </div>
      </div>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s3').hide(); $('.s2').show(); $('.st').removeClass('active'); $('.st2').addClass('active');">Назад</a>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s3').hide(); $('.s4').show(); $('.st').removeClass('active'); $('.st4').addClass('active'); $('.st4').removeClass('isDisabled');">Далее</a>
      </div>
   <div class="s4 ss">
      <div class="general-width">
      <form action="action" class="for-form clearfix">
      <p style="line-height: 45px; text-align: left;"><span class="checkbox" onclick="$('.s4 .checkbox').removeClass('active'); $(this).addClass('active');"></span>Нет</p>
      <p style="line-height: 45px; text-align: left;"><span class="checkbox" onclick="$('.s4 .checkbox').removeClass('active'); $(this).addClass('active');"></span>Есть, количество: <input class="figure" style="padding: 0 10px; margin: 0 10px; float: none;" value=""></p>
      </form>
      </div>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s4').hide(); $('.s3').show(); $('.st').removeClass('active'); $('.st3').addClass('active');">Назад</a>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s4').hide(); $('.s5').show(); $('.st').removeClass('active'); $('.st5').addClass('active'); $('.st5').removeClass('isDisabled');">Далее</a>
   </div>
   <div class="s5 ss">
      <ul class="calculator__slider-box__slider-width__slider__list edge">
         <li onclick="$('.edge li').removeClass('active'); $(this).addClass('active');">
            <img src="<? echo get_template_directory_uri(); ?>/img/form-img1.png" alt="">
         </li>
         <li onclick="$('.edge li').removeClass('active'); $(this).addClass('active');">
            <img src="<? echo get_template_directory_uri(); ?>/img/form-img2.png" alt="">
         </li>
         <li onclick="$('.edge li').removeClass('active'); $(this).addClass('active');">
            <img src="<? echo get_template_directory_uri(); ?>/img/form-img3.png" alt="">
         </li>
         <li onclick="$('.edge li').removeClass('active'); $(this).addClass('active');">
            <img src="<? echo get_template_directory_uri(); ?>/img/form-img4.png" alt="">
         </li>
         <li onclick="$('.edge li').removeClass('active'); $(this).addClass('active');">
            <img src="<? echo get_template_directory_uri(); ?>/img/form-img5.png" alt="">
         </li>
         <li onclick="$('.edge li').removeClass('active'); $(this).addClass('active');">
            <img src="<? echo get_template_directory_uri(); ?>/img/form-img6.png" alt="">
         </li>
         <li onclick="$('.edge li').removeClass('active'); $(this).addClass('active');">
            <img src="<? echo get_template_directory_uri(); ?>/img/form-img7.png" alt="">
         </li>
         <li onclick="$('.edge li').removeClass('active'); $(this).addClass('active');">
            <img src="<? echo get_template_directory_uri(); ?>/img/form-img8.png" alt="">
         </li>
         <li onclick="$('.edge li').removeClass('active'); $(this).addClass('active');">
            <img src="<? echo get_template_directory_uri(); ?>/img/form-img9.png" alt="">
         </li>
         <li onclick="$('.edge li').removeClass('active'); $(this).addClass('active');">
            <img src="<? echo get_template_directory_uri(); ?>/img/form-img10.png" alt="">
         </li>
         <li onclick="$('.edge li').removeClass('active'); $(this).addClass('active');">
            <img src="<? echo get_template_directory_uri(); ?>/img/form-img11.png" alt="">
         </li>
         <li onclick="$('.edge li').removeClass('active'); $(this).addClass('active');">
            <img src="<? echo get_template_directory_uri(); ?>/img/form-img12.png" alt="">
         </li>
         <li onclick="$('.edge li').removeClass('active'); $(this).addClass('active');">
            <img src="<? echo get_template_directory_uri(); ?>/img/form-img13.png" alt="">
         </li>
         <li onclick="$('.edge li').removeClass('active'); $(this).addClass('active');">
            <img src="<? echo get_template_directory_uri(); ?>/img/form-img14.png" alt="">
         </li>
      </ul>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s5').hide(); $('.s4').show(); $('.st').removeClass('active'); $('.st4').addClass('active');">Назад</a>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s5').hide(); $('.s6').show(); $('.st').removeClass('active'); $('.st6').addClass('active'); $('.st6').removeClass('isDisabled');">Далее</a>
   </div>
   <div class="s6 ss">
      <ul class="calculator__slider-box__slider-width__slider__list6">
         <li onclick="$('.calculator__slider-box__slider-width__slider__list6 li').removeClass('active'); $(this).addClass('active')">
            <div class="calculator__slider-box__slider-width__slider__list__block-form">
               <img src="<? echo get_template_directory_uri(); ?>/img/form2-img1.png" alt="Прямолинейный">
            </div>
            <p class="calculator__slider-box__slider-width__slider__list__description">Прямолинейный</p>
         </li>
         <li onclick="$('.calculator__slider-box__slider-width__slider__list6 li').removeClass('active'); $(this).addClass('active')">
            <div class="calculator__slider-box__slider-width__slider__list__block-form">
               <img src="<? echo get_template_directory_uri(); ?>/img/form2-img2.png" alt="Интегрированный">
            </div>
            <p class="calculator__slider-box__slider-width__slider__list__description">Интегрированный</p>
         </li>
         <li onclick="$('.calculator__slider-box__slider-width__slider__list6 li').removeClass('active'); $(this).addClass('active')">
            <div class="calculator__slider-box__slider-width__slider__list__block-form">
               <img src="<? echo get_template_directory_uri(); ?>/img/form2-img3.png" alt="Интегрированный">
            </div>
            <p class="calculator__slider-box__slider-width__slider__list__description">BACK SPLASH</p>
         </li>
      </ul>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s6').hide(); $('.s5').show(); $('.st').removeClass('active'); $('.st5').addClass('active');">Назад</a>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s6').hide(); $('.s7').show(); $('.st').removeClass('active'); $('.st7').addClass('active'); $('.st7').removeClass('isDisabled');">Далее</a>
   </div>
   <div class="s7 ss">
      <div class="general-width">
         <form action="action" class="for-form clearfix">
            <p style="line-height: 45px; text-align: left;"><span class="checkbox" onclick="$('.s7 .checkbox').removeClass('active'); $(this).toggleClass('active');"></span>Нет</p>
            <p style="line-height: 45px; text-align: left;"><span class="checkbox" onclick="$(this).toggleClass('active');"></span>Под варочную панель</p>
            <p style="line-height: 45px; text-align: left;"><span class="checkbox" onclick="$(this).toggleClass('active');"></span>Под мойку</p>
            <p style="line-height: 45px; text-align: left;"><span class="checkbox" onclick="$(this).toggleClass('active');"></span>Под розетки</p>
         </form>
      </div>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s7').hide(); $('.s6').show(); $('.st').removeClass('active'); $('.st6').addClass('active');">Назад</a>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s7').hide(); $('.s8').show(); $('.st').removeClass('active'); $('.st8').addClass('active'); $('.st8').removeClass('isDisabled');">Далее</a>
      </div>
      <div class="s8 ss">
      <div class="general-width">
      <form action="action" class="for-form clearfix">
      <div class="for-form__buttons--checkbox">
         <p style="line-height: 45px; text-align: left;"><span class="checkbox" onclick="$(this).toggleClass('active');"></span>Замер</p>
         <p style="line-height: 45px; text-align: left;"><span class="checkbox" onclick="$(this).toggleClass('active');"></span>Монтаж</p>
         <p style="line-height: 45px; text-align: left;"><span class="checkbox" onclick="$(this).toggleClass('active');"></span>Доставка</p>
      </div>
      </form>
      </div>
      <a class="yellow-button" style="cursor: pointer;" onclick="$('.s8').hide(); $('.s7').show(); $('.st').removeClass('active'); $('.st7').addClass('active');">Назад</a>
      <a class="yellow-button" style="cursor: pointer;">Рассчитать стоимость</a>
      </div>
      </div>
      </div>