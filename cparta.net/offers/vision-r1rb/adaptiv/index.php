<?php 
   $offer = 97;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 
<!DOCTYPE html>
<html lang="ru">

<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script src="http://vision.xfastcart.com/shared/form.validate.js?10"></script>
<script src="http://vision.xfastcart.com/shared/form.incomplete.js?10"></script>
<script src="http://vision.xfastcart.com/shared/main2.js?12"></script>



    <meta charset="utf-8">
    <title>VisionPlus - гарантия восстановления зрения за 28 дней!</title>
    <meta property="og:title" content="Vision +"/>
    <meta property="og:description" content="Vision+ с лютеином и Омега-3 активизирует процесс регенерации всех тканей глаз"/>
    <meta name="keywords" content="Vision+, восстановление зрения, восстановить глаза, хорошее зрение">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700|Tinos:400,700" rel="stylesheet">
    <link rel="shortcut icon" href="http://vision.xfastcart.com/r1rb/img/favicon/favicon.png" type="image/png">
    <!-- Load CSS Compiled without JS-->
    <link rel="stylesheet" href="http://vision.xfastcart.com/r1rb/css/main.min.css">
    <link rel="stylesheet" href="http://vision.xfastcart.com/r1rb/css/owl.carousel.min.css">
    <link rel="stylesheet" href="http://vision.xfastcart.com/r1rb/css/owl.theme.default.min.css">

    
    
    
  </head>
  <body>
      
    
      

    <div class="section1">
      <div class="inner2">
        <div class="section1_blocks">
          <div class="section1_blocks_left">
            <div class="section1_blocks_left_top">
              <div class="section_b_1">SäD-PF</div>
              <div class="section_b_2">National <br>Pharmaceutical <br>Pflanze</div>
              <div class="section_b_3">-1938-</div>
            </div>
            <div class="section1_blocks_left_bottom">MADE IN GERMANY</div>
          </div>
          <div class="section1_blocks_center">
            <div class="section_blocks_center">
              <div class="section_blocks_center_content"><span class="section_blocks_center_title">
                   100%</span>
                <div class="section_blocks_center_text">натуральный <br>состав</div>
              </div>
              <div class="section_blocks_center_content"><span class="section_blocks_center_title">
                   Рекомендовано</span>
                <div class="section_blocks_center_text">НИИ глазных<br>болезней</div>
              </div>
              <div class="section_blocks_center_content"><span class="section_blocks_center_title">
                   100%</span>
                <div class="section_blocks_center_text">гарантия<br>эффективности</div>
              </div>
            </div>
            <div class="section1_center_center">Гарантия<br>восстановления<br>остроТЫ зрения<br>за <span class="count_day">28 </span>дней!</div>
            <div class="section1_center_center2">с <span class="bold_text">лютеином </span>и <span class="bold_text">Омега-3 </span>активизирует процесс регенерации всех тканей глаз</div>
            <div class="logo_vision"><img src="http://vision.xfastcart.com/r1rb/img/logo_vision.png" alt="Vision"></div>
            <div class="vision_special">Оформите заказ сегодня и Вы заметите результат уже через 7 дней!</div>
            <div class="vision_special_date">до <span class="before_date"></span> со скидкой</div>
          </div>
          <div class="section1_blocks_right">
            <div class="section1_blocks_right_top">
              <div class="section_blocks_right_top_inner">
                <div class="section1_text_left"><img src="http://vision.xfastcart.com/r1rb/img/blr_flag.png" alt="Беларусь"></div>
                <div class="section1_text_right">Стартовали продажи <br>в Республике Беларусь</div>
              </div>
            </div>
            <div class="section_top_price">
              <div class="section_top_price_inner">
                <div class="section_top_old_price"><span class="line-through"><span class="old-amount"><x-oldprice>990</x-oldprice></span> <span class="init_price-txt currency"></span></span></div>
                <div class="section_top_new_price">
                  <div class="section_top_new_price_inner"><span class="tot-amount"><x-newprice><?php echo $price['real_price']; ?></x-newprice></span></div>
                </div>
                <div class="section_percent">
                  <div class="section_percent_inner"></div>
                </div>
              </div>
            </div>
            <div class="section1_button">
                <form class="section8_form_inputs main_form" action="./_success_/" method="post">
                <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
                      <input name="csrf_token" type="hidden" value="56fbee90bc270299d55e7532821234d1:1585571657" />
    <select name="offer" class="form-control country_chang">
                <option 
            data-country-code="BY"
                        value="7290"
        >
            Беларусь        </option>
                <option 
            data-country-code="KZ"
                        value="7291"
        >
            Казахстан        </option>
                <option 
            data-country-code="RU"
                        selected="selected"
                        value="7289"
        >
            Россия        </option>
            </select>
                        <input type="text" name="name" required=""  placeholder="Ваше имя">
                    <input type="tel" name="phone"  required="" title="Более 7 символов"  placeholder="Ваш телефон">
                    <button class='section1_button_inner new_btn' type="submit">Оформить заказ</button>
                  </form>
              <!--<div class="section1_button_inner" data-href="#form">Заказать</div>-->
              <div class="section1_button_bottom">Количество акционных товаров <br>ограничено: <span class="section1_button_bottom_text">18 </span>упаковок</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section2">
      <div class="inner2">
        <div class="section2_top">
          <div class="section2_top_left"><img src="http://vision.xfastcart.com/r1rb/img/logo.png" alt="Vision"></div>
          <div class="section2_top_right">
            <ul class="section2_top_right_punct">
              <li>
                <div class="section2_top_img"><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да" width="34"></div>
                <div class="section2_top_text"><span class="section2_bold">Исключает </span>риск серьезных<br>глазных заболеваний</div>
              </li>
              <li>
                <div class="section2_top_img"><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да" width="34"></div>
                <div class="section2_top_text"><span class="section2_bold">Нормализует </span>внутриглазное<br>давление через 3 часа<br>после первого применения </div>
              </li>
              <li>
                <div class="section2_top_img"><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да" width="34"></div>
                <div class="section2_top_text"><span class="section2_bold">Повышает </span>зоркость<br>и снимает усталость глаз</div>
              </li>
              <li>
                <div class="section2_top_img"><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да" width="34"></div>
                <div class="section2_top_text"><span class="section2_bold">Прекращает </span>процесс<br>отслоения сетчатки</div>
              </li>
              <li>
                <div class="section2_top_img"><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да" width="34"></div>
                <div class="section2_top_text"><span class="section2_bold">Устраняет </span>сухость<br>и резь в глазах</div>
              </li>
              <li>
                <div class="section2_top_img"><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да" width="34"></div>
                <div class="section2_top_text"><span class="section2_bold">Снимает </span>воспаление<br>и покраснение после<br>1 применения</div>
              </li>
            </ul>
          </div>
        </div>
        <div class="section2_bottom">
          <h2 class="section2_title">В каких случаях Вам<br><span>необходим </span>курс Vision+?</h2>
          <div class="section2_blocks">
            <div class="section2_blocks_top">
              <div class="section2_blocks_block">
                <div class="section2_blocks_block_title">УСТАЛОСТЬ</div>
                <div class="section2_blocks_block_text">Регулярная усталость глаз,<br>ощущение сухости или<br>песка в глазах</div>
              </div>
              <div class="section2_blocks_block">
                <div class="section2_blocks_block_title">Покраснение</div>
                <div class="section2_blocks_block_text">К вечеру ваши глаза
<br>краснеют и приобретают
<br>нездоровый блеск</div>
              </div>
              <div class="section2_blocks_block">
                <div class="section2_blocks_block_title">Размытость</div>
                <div class="section2_blocks_block_text">С близкого расстояния
<br>вы видите предметы
<br>расплывчато </div>
              </div>
            </div>
            <div class="section2_blocks_center">
              <div class="section2_blocks_block">
                <div class="section2_blocks_block_title">Работа за смартфоном</div>
                <div class="section2_blocks_block_text">Вы часто переписываетесь
<br>в мессенджерах,
<br>читаете с телефона</div>
              </div>
              <div class="section2_blocks_block">
                <div class="section2_blocks_block_title">Работа за
<br>компьютером</div>
                <div class="section2_blocks_block_text">Вы проводите перед
<br>экраном компьютера
<br>более 3-х часов в день</div>
              </div>
            </div>
            <div class="section2_blocks_bottom">
              <div class="section2_blocks_block">
                <div class="section2_blocks_block_title">Близорукость</div>
                <div class="section2_blocks_block_text">Вам тяжело разглядеть
<br>предметы и надписи
<br>с дальнего расстояния</div>
              </div>
              <div class="section2_blocks_block">
                <div class="section2_blocks_block_title">Наследственность</div>
                <div class="section2_blocks_block_text">Кто-то из ваших родственников
<br>имеет пониженное зрение,
<br>заболевания глаз</div>
              </div>
              <div class="section2_blocks_block">
                <div class="section2_blocks_block_title">Напряжение</div>
                <div class="section2_blocks_block_text">Вы много времени
<br>проводите за рулем</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section3">
      <div class="section2_bottom_2">
        <h2 class="section2_bottom_2_title">Даже минимальное снижение зрения<br>приводит к развитию опасных<br>глазных болезней</h2>
        <div class="section2_bottom_3">
          <div class="section2_bottom_3_inner">
            <div class="section2_bottom_3_inner_center">
              <div class="section2_bottom_3_inner_center_inner">Защитите свои глаза<br>от необратимых<br>изменений!</div>
            </div>
            <div class="section2_bottom_3_inner_right"><img src="http://vision.xfastcart.com/r1rb/img/pack_glass.png" alt="Vision"></div>
          </div>
        </div>
        <div class="section3_button">
          <a class="section1_button_inner" href="index.html?off=mdbkUpm#form">Начать профилактику</a>
        </div>
      </div>
    </div>
    <div class="section4">
      <div class="inner">
        <h2 class="section4_title">У всех проблем<br>с глазами — общая<br>первопричина</h2>
        <div class="section4_blocks">
          <div class="section4_block_left"><img src="http://vision.xfastcart.com/r1rb/img/section4_woman.jpg" alt="Женщина"></div>
          <div class="section4_block_right">
            <div class="section4_blocks_right_top">Первопричина</div>
            <div class="section4_blocks_right_center">Сужение просвета<br>сосудов</div>
            <div class="section4_blocks_right_bottom">и образование на них атеросклеротических бляшек. Это значит, что какие бы витамины вы не принимали, они попросту <span class="section4_bold">не попадут по назначению. </span>Ткани глаза остаются без питания, <span class="section4_bold">глазная мышца атрофируется и деформирует хрусталик.</span>
              <p>Даже самые дорогие разрекламированные лекарственные средства <span class="section4_bold">не помогают </span>решить эту проблему.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section5">
      <div class="inner">
        <div class="section5_title">
          <div class="section5_top_title">Новейшая разработка</div>
          <div class="section5_bottom_title">международной группы ученых<br>поможет восстановить зрение</div>
        </div>
        <div class="section5_blocks">
          <div class="section5_blocks_left"><img src="http://vision.xfastcart.com/r1rb/img/section5_left_img.png" alt="SAD-PF"></div>
          <div class="section5_blocks_right">
            <div class="section5_blocks_right_block">
              <div class="section4_blocks_right_top">Решение</div>
              <div class="section4_blocks_right_center">КОМПЛЕКС Омега-3+Лютеин</div>
              <div class="section4_blocks_right_bottom">который лежит в основе формулы <span class="section4_bold">Vision+, </span>предупреждает атеросклеротические процессы в кровеносных сосудах и очищает их. В то же время ткани глаза в короткий срок насыщаются лютеином, что запускает процесс их регенерации.</div>
            </div>
            <div class="section5_blocks_right_block">
              <div class="section4_blocks_right_top">РЕЗУЛЬТАТ</div>
              <div class="section4_blocks_right_center">3-5 дней</div>
              <div class="section4_blocks_right_bottom">Уже через 3-5 дней приема препарата обеспечивается беспрепятственный доступ кислорода и питательных веществ к тканям глаз и выведение из них продуктов метаболизма.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section6">
      <div class="inner">
        <h2 class="section6_title">Разработка прошла многоступенчатое<br>тестирование в <span class="section6_title_bold">России, Германии и Израиле,</span><br>получила лицензии и сертификаты качества</h2>
        <div class="section6_blocks">
          <div class="section6_blocks_block">
            <div class="section6_blocks_left_img"><img src="http://vision.xfastcart.com/r1rb/img/sert1.jpg" alt="Германия"></div>
            <div class="section6_blocks_left_text">Германия</div>
          </div>
          <div class="section6_blocks_block">
            <div class="section6_blocks_left_img"><img src="http://vision.xfastcart.com/r1rb/img/sert2.jpg" alt="Израиль"></div>
            <div class="section6_blocks_left_text">Израиль</div>
          </div>
          <div class="section6_blocks_block">
            <div class="section6_blocks_left_img"><img src="http://vision.xfastcart.com/r1rb/img/sert3.jpg" alt="Россия"></div>
            <div class="section6_blocks_left_text">Россия</div>
          </div>
        </div>
      </div>
      <div class="section6_bottom">
        <div class="section6_bottom_left"></div>
        <div class="section6_bottom_center">
          <div class="section6_bottom_center_left">World Health<br>Organization</div>
          <div class="section6_bottom_center_center"><img src="http://vision.xfastcart.com/r1rb/img/voz.png" alt="Всемирная организация здравоохранения"></div>
          <div class="section6_bottom_center_right">Все этапы тестирования<br>подтверждены специалистами<span class="section6_bottom_bold">всемирной организации<br>здравоохранения</span></div>
        </div>
        <div class="section6_bottom_right"></div>
      </div>
    </div>
    <div class="section7">
      <div class="inner">
        <h2 class="section7_title">ЗАПАТЕНТОВАННАЯ ФОРМУЛА!</h2>
      </div>
      <div class="section7_bg">
        <div class="section7_bg_inner inner">
          <div class="section7_bg_inner_left"><img src="http://vision.xfastcart.com/r1rb/img/pack_glass.png" alt="Vision"></div>
          <div class="section7_bg_inner_right">
            <div class="section7_bg_inner_right_title">В чем секрет<br>100% эффективности<br>VISION+</div>
            <div class="section7_bg_inner_right_text">Запатентованная формула препарата состоит из природных экстрактов, оказывающих узконаправленное действие при снижении зрения любой этиологии.
              <p>Эффект достигается уже в первые 3-5 дней применения за счет ускоренной доставки действующих веществ непосредственно к тканям глаз.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="inner">
        <div class="section7_blocks_bottom">
          <div class="section7_blocks_block">
            <div class="section7_blocks_block_img"><img src="http://vision.xfastcart.com/r1rb/img/section7_img1.jpg" alt="Комплекс Омега-3+Лютеин"></div>
            <div class="section7_blocks_block_text">
              <div class="section7_blocks_block_title">Комплекс Омега-3+Лютеин </div>
              <div class="section7_blocks_block_content">Связанная молекула одновременно очищает глазные сосуды и насыщает ткани лютеином — важнейшим компонентом системы защиты сетчатки глаза. Лютеин не синтезируется в организме человека, а его недостаток приводит к  необратимой слепоте</div>
            </div>
          </div>
          <div class="section7_blocks_block">
            <div class="section7_blocks_block_img"><img src="http://vision.xfastcart.com/r1rb/img/section7_img2.jpg" alt="Полифенолы лекарственной очанки"></div>
            <div class="section7_blocks_block_text">
              <div class="section7_blocks_block_title">Полифенолы лекарственной очанки</div>
              <div class="section7_blocks_block_content">Запускают процесс регенерации всех тканей глаз. Оказывают выраженное увлажняющее и противовоспалительное действие; регулируют содержание жидкости в тканях органа зрения, предупреждают развитие синдрома "сухого" глаза</div>
            </div>
          </div>
          <div class="section7_blocks_block">
            <div class="section7_blocks_block_img"><img src="http://vision.xfastcart.com/r1rb/img/section7_img3.jpg" alt="Ретинол+Цинк"></div>
            <div class="section7_blocks_block_text">
              <div class="section7_blocks_block_title">Ретинол+Цинк</div>
              <div class="section7_blocks_block_content">Ретинол входит в состав зрительного пигмента сетчатки глаза – родопсина, благодаря которому мы можем разглядеть предметы при тусклом освещении. Нехватка ретинола вызывает коньюнктивит, глаукому, преобразование роговицы глаза в бельмо. Цинк обеспечивает усвоение и удержание ретинола в тканях глаза.</div>
            </div>
          </div>
          <div class="section7_blocks_block">
            <div class="section7_blocks_block_img"><img src="http://vision.xfastcart.com/r1rb/img/section7_img4.jpg" alt="Антоцианы ягод черники"></div>
            <div class="section7_blocks_block_text">
              <div class="section7_blocks_block_title">Антоцианы ягод черники</div>
              <div class="section7_blocks_block_content">Активируют в тканях глаз восстановительные процессы, стимулируют регенерацию поврежденной сетчатки глаза, препятствуют ее отслоению. Защищают глаза при работе за компьютером и других зрительных нагрузках. Предупреждают развитие катаракты, глаукомы и кератита</div>
            </div>
          </div>
          <div class="section7_blocks_block">
            <div class="section7_blocks_block_img"><img src="http://vision.xfastcart.com/r1rb/img/section7_img5.jpg" alt="Вытяжка из Родимении"></div>
            <div class="section7_blocks_block_text">
              <div class="section7_blocks_block_title">Вытяжка из Родимении</div>
              <div class="section7_blocks_block_content">Красная водоросль родимения — источник аминокислоты таурин, которая предупреждает развитие катаракты и глаукомы. Сетчатка теряет таурин на свету, ночью он накапливается. Потеря 50% от нормы таурина – необратимый процесс, который приводит к полной слепоте</div>
            </div>
          </div>
          <div class="section7_blocks_block">
            <div class="section7_blocks_block_img"><img src="http://vision.xfastcart.com/r1rb/img/section7_img6.jpg" alt="Экстракт косточки Лонгана"></div>
            <div class="section7_blocks_block_text">
              <div class="section7_blocks_block_title">Экстракт косточки Лонгана</div>
              <div class="section7_blocks_block_content">Лонган, или Драконий глаз, улучшает питание сетчатки, стимулирует микроциркуляцию крови в капиллярах глазного яблока. Быстро успокаивает глаза, снимает покраснение, устраняет жжение и резь. Стимулирует нервные синапсы, которые обеспечивают фокусировку хрусталика и четкое зрение.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section8">
      <div class="section8_inner">
        <div class="section8_inner_left"></div>
        <div class="section8_inner_center">
          <div class="section8_inner_center_left">
            <h2 class="section8_inner_center_title">Заключение<br>практикующего<br>офтальмолога</h2>
          </div>
          <div class="section8_inner_center_right">VISION+ способен восстановить зрение до 92%</div>
        </div>
        <div class="section8_inner_right"></div>
      </div>
      <div class="inner">
        <div class="section8_block2">
          <div class="section8_block2_left">“Глазные болезни молодеют с каждым годом. 65% белорусов до 30 лет уже страдают от снижения зрения. При прогрессировании заболеваний <span class="section8_bold">в течение 10-15 лет их ожидает полная слепота. </span>
            <p>Многие мои пациенты в отчаянии хотели записаться на операцию или просили выписать им очки. Но на сегодняшний день появилась возможность <span class="section8_bold">медикаментозного лечения </span>почти всех патологий органа зрения.</p>
            <p>Это препарат <span class="section8_bold">Vision+, </span>в 2016 получивший лицензию Минздрава Беларуси. Он на 100% натуральный, не имеет противопоказаний и <span class="section8_bold">способен восстановить зрение до 92% </span>в среднем за 1-2 курса приема. </p>
            <p>На ранних этапах развития болезни <span class="section8_bold">Vision+ позволяет полностью вернуть зрение </span>к здоровым значениям, а при запоздалом лечении — <span class="section8_bold">тормозит развитие патологии </span>и улучшает зрение на 2-3 диоптрии.” </p>
          </div>
          <div class="section8_block2_right"><img src="http://vision.xfastcart.com/r1rb/img/section8_doc.jpg" alt="Доктор"></div>
        </div>
        <div class="section8_stamp">
          <div class="section8_stamp_left">Гернака Юлианна Емельяновна
            <div class="section8_stamp_left_bottom">Врач-офтальмолог высшей категории</div>
          </div>
        </div>
        <div class="section8_block3">
          <h2 class="section8_block3_title">Результаты<br>клинических испытаний</h2>
          <h3 class="section8_block3_title2">Препарат был апробирован крупнейшими <br>исследовательскими центрами и клиниками <span class="section8_block2_bold">России, Германии, <br>Израиля и Беларуси.</span></h3>
        </div>
        <div class="section8_block4">
          <div class="section8_block4_left"><img src="http://vision.xfastcart.com/r1rb/img/glass.png" alt="Стакан"></div>
          <div class="section8_block4_center">
            <div class="section8_block4_center_top">2570</div>
            <div class="section8_block4_center_bottom">человек</div>
          </div>
          <div class="section8_block4_right">В исследовании приняли участие<br>2570 человек от 18 до 80 лет, страдающие<br>снижением зрения и различными<br>заболеваниями глаз.</div>
        </div>
        <div class="section8_block5">Все они принимали <span class="section8_block5_strong">по 1 шипучей таблетке Vision+ </span>в течение <span class="section8_block5_strong">28 дней.</span></div>
        <div class="section8_block_percent">
          <div class="section8_block_percent_inner">
            <div class="section8_block_header">
              <div class="section8_block_percent_inner_top">100%</div>
            </div>
            <div class="section8_block_percent_inner_bottom">Исчезновение покраснений, жжения и рези в глазах</div>
          </div>
          <div class="section8_block_percent_inner">
            <div class="section8_block_header">
              <div class="section8_block_percent_inner_top top_2">99.5%</div>
            </div>
            <div class="section8_block_percent_inner_bottom">Отсутствие усталости глаз после 8 и более часов за монитором</div>
          </div>
          <div class="section8_block_percent_inner">
            <div class="section8_block_header">
              <div class="section8_block_percent_inner_top top_3">92%</div>
            </div>
            <div class="section8_block_percent_inner_bottom">Прекращение отслоения сетчатки глаза</div>
          </div>
          <div class="section8_block_percent_inner">
            <div class="section8_block_header">
              <div class="section8_block_percent_inner_top top_4">74%</div>
            </div>
            <div class="section8_block_percent_inner_bottom">Восстановление зрения при глаукоме и катаракте на 1-2 диоптрии</div>
          </div>
          <div class="section8_block_percent_inner">
            <div class="section8_block_header">
              <div class="section8_block_percent_inner_top top_5">92.5%</div>
            </div>
            <div class="section8_block_percent_inner_bottom">Восстановление роговицы глаза при кератозе</div>
          </div>
          <div class="section8_block_percent_inner">
            <div class="section8_block_header">
              <div class="section8_block_percent_inner_top">100%</div>
            </div>
            <div class="section8_block_percent_inner_bottom">Повышение концентрации таурина и лютеина до здоровых значений</div>
          </div>
        </div>
        <div class="section8_block_text_wrapper">
          <div class="section8_block_text">Действующие вещества <span class="section8_block_text_bold">Vision+ </span>накапливаются в тканях,<br>обеспечивая пролонгированное действие, которое сохраняется<br>до 6 месяцев после окончания курса приема.</div>
        </div>
        <div class="section8_block_bottom_titles">
          <div class="section8_block_bottom_title">Альтернативные методы коррекции зрения</div>
          <div class="sesction8_block_bottom_subtitle">Сравнительная таблица</div>
        </div>
        <div class="section8_table">
          <table class="section8_table_inner">
            <tr>
              <td> </td>
              <td>Поливитамины для глаз</td>
              <td>Глазные капли</td>
              <td>Упражнения<br>для глаз</td>
              <td>Лазерная коррекция</td>
              <td>Народные средства</td>
              <td><span class="table_bold">VISION+</span></td>
            </tr>
            <tr>
              <td>Устраняет причину заболевания</td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да"></td>
            </tr>
            <tr>
              <td>Безопасность</td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да"></td>
            </tr>
            <tr>
              <td>Подходит для профилактики</td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да"></td>
            </tr>
            <tr>
              <td>Долгосрочный результат</td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/no_icon.png" alt="Нет"></td>
              <td><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да"></td>
            </tr>
            <tr>
              <td></td>
              <td>
                <div class="section8_table_stars"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_yellow.png" alt="Плюс"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"></div>
              </td>
              <td>
                <div class="section8_table_stars"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"></div>
              </td>
              <td>
                <div class="section8_table_stars"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_yellow.png" alt="Плюс"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"></div>
              </td>
              <td>
                <div class="section8_table_stars"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_yellow.png" alt="Плюс"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"></div>
              </td>
              <td>
                <div class="section8_table_stars"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_gray.png" alt="Минус"></div>
              </td>
              <td>
                <div class="section8_table_stars"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_yellow.png" alt="Плюс"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_yellow.png" alt="Плюс"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_yellow.png" alt="Плюс"><img src="http://vision.xfastcart.com/r1rb/img/star_rating_yellow.png" alt="Плюс"></div>
              </td>
            </tr>
          </table>
        </div>
        <div class="section8_form" id="section8_form">
          <div class="section8_form_title">Забронировать по акции</div>
          <div class="section8_form_wrapper">
            <div class="section8_form_inner">
              <div class="section8_form_inner_left">
                <div class="section8_form_inner_left_top"><span class="line_through"><span class="old-amount"><x-oldprice>990</x-oldprice></span> <span class="init_price-txt currency"></span></span></div>
                <div class="section8_form_inner_left_bottom"><span class="tot-amount"><x-newprice><?php echo $price['real_price']; ?></x-newprice></span> <span class="init_price-txt currency"></span></div>
              </div>
              <div class="section8_form_inner_right">
                <div class="section8_form_inner_right_inner">
                  <div class="section8_form_text">
                       <span class="vision_center">
                           до <span class="before_date"></span> со скидкой
                       </span>
                       </div>
                  <form class="section8_form_inputs" action="./_success_/" method="post">
                  <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
                        <input name="csrf_token" type="hidden" value="56fbee90bc270299d55e7532821234d1:1585571657" />
    <select name="offer" class="form-control country_chang">
                <option 
            data-country-code="BY"
                        value="7290"
        >
            Беларусь        </option>
                <option 
            data-country-code="KZ"
                        value="7291"
        >
            Казахстан        </option>
                <option 
            data-country-code="RU"
                        selected="selected"
                        value="7289"
        >
            Россия        </option>
            </select>
                        <input type="text" name="name" required=""  placeholder="Ваше имя">
                    <input type="tel" name="phone"  required="" title="Более 7 символов"  placeholder="Ваш телефон">
                    <button type="submit">Оформить заказ</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="section8_form_bottom_text">Количество акционных товаров ограничено: 18 упаковок</div>
        </div>
      </div>
    </div>
    <div class="section9">
      <div class="inner">
        <div class="section9_titles">
          <h2 class="section9_title">Эти люди могли лишиться зрения!</h2>
          <h3 class="section9_subtitle">Некоторые из 3250 отзывов пациентов о Vision+</h3>
        </div>
        <div class="owl-carousel">
          <div class="section9_blocks">
            <div class="section9_blocks_left"><img src="http://vision.xfastcart.com/r1rb/img/nikolay.jpg" alt="Отзыв"></div>
            <div class="section9_blocks_right">
              <div class="section9_blocks_right_title">“Глаза не устают, стал различать надписи на билбордах”</div>
              <div class="section9_blocks_right_text"> Никогда не мог похвастаться  орлиным зрением. В детстве еще обходился, хотя всегда сидел за первой партой, иначе сложно было разобрать то, что на доске. К 30 годам стал замечать, что ситуация ухудшается, пришлось даже пойти к офтальмологу, который сказал, что это от постоянного сидения у монитора и прописал мне капли и поливитамины. Но толку не было никакого: глаза постоянно чесались и краснели, часто начинали слезиться или наоборот, казались сухими. По совету коллеги- бывшего “очкарика” заказал Вижн Плюс. Принимаю пока около трех недель, но результат уже налицо: глаза не устают, стал различать надписи на билбордах и вижу издалека номер своего автобуса!</div>
              <div class="section9_blocks_right_author">Николай, 33 года, Минск</div>
            </div>
          </div>
          <div class="section9_blocks">
            <div class="section9_blocks_left"><img src="http://vision.xfastcart.com/r1rb/img/elizaveta.jpg" alt="Отзыв"></div>
            <div class="section9_blocks_right">
              <div class="section9_blocks_right_title">“Ни разу не вспомнила о коньюнктивите”</div>
              <div class="section9_blocks_right_text">Я всю жизнь маюсь коньюнктивитом – стоит только немножко простыть и все! Дикая боль, красные глаза, зуд, гной. Чего только не пробовала – капли, мази, таблетки. Даже ложилась в больницу капать витамины. И все равно – чуть-чуть замерзла и сразу он. Обратилась к частному доктору в глазную клинику. Он посоветовал мне шипучки Vision. Я принимала их 2 месяца. С тех пор прошел почти год, и за это время я ни разу не вспомнила о коньюнктивите (тьфу-тьфу-тьфу). Думаю повторить курс к зиме.</div>
              <div class="section9_blocks_right_author">Елизавета, 25, Новополоцк</div>
            </div>
          </div>
          <div class="section9_blocks">
            <div class="section9_blocks_left"><img src="http://vision.xfastcart.com/r1rb/img/natalia.jpg" alt="Отзыв"></div>
            <div class="section9_blocks_right">
              <div class="section9_blocks_right_title">“Сходила к врачу — читаю третью строчку!”</div>
              <div class="section9_blocks_right_text">Во время беременности многие девочки сталкиваются с проблемами со зрением, я не стала исключением. Думала, что все это пройдет, но, когда стала мамочкой полтора года назад, оказалось, ситуация только усугубилась. Я стала замечать, что зрение ухудшается. Врачи подтвердили: -2 на одном глазу и -2,4 на втором. Советовали капать капли, а я с детства панически боюсь, когда мне что-то в глаз попадает. Узнала от подруги про Vision. Пью около месяца – не нарадуюсь на результат! Глаза, как в юности! Не болят, не устают, сходила к врачу — читаю третью строчку! К тому же это средство натуральное, поэтому моему сыночку, который на ГВ, оно не навредит.</div>
              <div class="section9_blocks_right_author">Наталья, 28, Могилев</div>
            </div>
          </div>
          <div class="section9_blocks">
            <div class="section9_blocks_left"><img src="http://vision.xfastcart.com/r1rb/img/olga.jpg" alt="Отзыв"></div>
            <div class="section9_blocks_right">
              <div class="section9_blocks_right_title">“Это средство спасло маму от катаракты!”</div>
              <div class="section9_blocks_right_text">У моей мамы несколько лет назад диагностировали катаракту. Это у нас наследственное, бабушка к старости от нее почти ослепла, видит только очертания. Чего мы только ни перепробовали, к каким только специалистам ни обращались — болезнь прогрессировала. А недавно я познакомилась с парнем, он учится в Германии на врача, и рассказал, что там при катаракте рекомендуют препарат Vision +. Он прислал мне его для мамы. Она пропила 2 курса — и случилось чудо! Болезнь начала отступать! Мама стала лучше видеть, все показатели улучшились. Это средство спасло маму от катаракты! Заказали теперь и для бабушки, может, и ей поможет на старости лет разглядеть лица правнуков.</div>
              <div class="section9_blocks_right_author">Ольга, 31 год, Брест</div>
            </div>
          </div>
          <div class="section9_blocks">
            <div class="section9_blocks_left"><img src="http://vision.xfastcart.com/r1rb/img/vladimir.jpg" alt="Отзыв"></div>
            <div class="section9_blocks_right">
              <div class="section9_blocks_right_title">“Стал лучше видеть, глаза не устают и не краснеют”</div>
              <div class="section9_blocks_right_text">По работе я вынужден проводить много времени за компьютером и за рулем. Отдых тоже — или перед телевизором, или путешествуем с семьей на машине. Зрение у меня и так не ахти: приходится носить очки. А на приеме у врача услышал страшное: зрение еще немного упало, и он подозревает риск развития глаукомы. А это — неминуемая слепота! Жена купила мне растворимые таблетки Вижн Плюс, принимал их почти месяц. На следующем приеме врач был в шоке! Зрение улучшилось, на глаукому и намека нет! Да и сам чувствую, что стал лучше видеть, глаза не устают и не краснеют.</div>
              <div class="section9_blocks_right_author">Владимир, 51 год, Мозырь</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section10">
      <div class="inner">
        <h2 class="section10_title">Как принимать <span class="section10_bold">Vision+, </span><br>чтобы восстановить зрение <br>за 28 дней?</h2>
        <div class="section10_blocks">
          <div class="section10_blocks_inner">
            <div class="section10_blocks_left">
              <div class="section10_blocks_left_block_left"><span>1</span></div>
              <div class="section10_blocks_left_block_right">Шипучую таблетку растворите <br>в стакане воды</div>
            </div>
            <div class="section10_blocks_left">
              <div class="section10_blocks_left_block_left"><span>2</span></div>
              <div class="section10_blocks_left_block_right">Выпейте раствор вечером<br>перед ужином</div>
            </div>
            <div class="section10_blocks_left">
              <div class="section10_blocks_left_block_left"><span>3</span></div>
              <div class="section10_blocks_left_block_right">Полный курс приема — 28 дней</div>
            </div>
            <div class="section10_blocks_left">
              <div class="section10_blocks_left_block_left"><span>4</span></div>
              <div class="section10_blocks_left_block_right">Наслаждайтесь острым зрением<br>и яркими красками жизни!</div>
            </div>
          </div>
          <div class="section10_blocks_right"><img src="http://vision.xfastcart.com/r1rb/img/pack_glass.png" alt="Vision+"></div>
        </div>
      </div>
    </div>
    <div class="section11">
      <div class="inner">
        <h2 class="section11_title">Что произойдет,<br>когда вы начнете<br>принимать Vision+?</h2>
        <div class="section11_blocks">
          <div class="section11_blocks_block"><img src="http://vision.xfastcart.com/r1rb/img/pack.jpg" alt="Vision"></div>
          <div class="section11_blocks_block2">
            <div class="section11_blocks_block_top">проходит воспаление и покраснение глаз,покраснение нормализуется внутриглазное давление</div>
            <div class="section11_blocks_block_bottom">1 день</div>
          </div>
          <div class="section11_blocks_block2">
            <div class="section11_blocks_block_top">глаза перестают уставать даже после напряженного дня, резь и ощущение “песка” больше не беспокоят вас</div>
            <div class="section11_blocks_block_bottom">7 день</div>
          </div>
          <div class="section11_blocks_block2">
            <div class="section11_blocks_block_top">повышается зоркость, вы видите надписи с дальнего расстояния и не щуритесь</div>
            <div class="section11_blocks_block_bottom">21 день</div>
          </div>
          <div class="section11_blocks_block2">
            <div class="section11_blocks_block_top">Запущенные препаратом процессы регенерации останавливают развитие и устраняют последствия опасных глазных заболеваний</div>
            <div class="section11_blocks_block_bottom">28 день</div>
          </div>
          <div class="section11_blocks_block2">
            <div class="section11_blocks_block_top"> действующие вещества <span class="section11_bold">VISION+, </span>накопившиеся в тканях глаза продолжают защищать ваше зрение</div>
            <div class="section11_blocks_block_bottom">6 месяцев</div>
          </div>
        </div>
        <div class="section11_vision"><img src="http://vision.xfastcart.com/r1rb/img/section11_vision.jpg" alt="До и После" draggable="false"></div>
        <div class="section11_block_bottom">
          <div class="section11_block_bottom_left"><img src="http://vision.xfastcart.com/r1rb/img/pack_glass.png" alt="Vision"></div>
          <div class="section11_block_bottom_right">
            <h3 class="section11_block_bottom_right_title">Восстановите зрение и защититесь<br>от прогрессирующих болезней глаз!</h3>
            <h4 class="section11_block_bottom_right_subtitle">Всего 1 таблетка в день — и снижение зрения вам не грозит!</h4>
            <ul class="section11_block_list">
              <li><span class="sction11_list_inner"><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да" width="43"><span class="section11_blocks_list_bottom"><span class="section11_block_list_bold">Снимает воспаление, </span>напряжение, сухость и раздражение</span></span></li>
              <li><span class="sction11_list_inner"><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да" width="43"><span class="section11_blocks_list_bottom"><span class="section11_block_list_bold">Усиливает </span>остроту зрения, укрепляет сетчатку глаза</span></span></li>
              <li><span class="sction11_list_inner"><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да" width="43"><span class="section11_blocks_list_bottom"><span class="section11_block_list_bold">Обеспечивает </span>правильную фокусировку хрусталика</span></span></li>
              <li><span class="sction11_list_inner"><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да" width="43"><span class="section11_blocks_list_bottom"><span class="section11_block_list_bold">100% натурально, </span>не имеет противопоказаний</span></span></li>
              <li><span class="sction11_list_inner"><img src="http://vision.xfastcart.com/r1rb/img/yes_icon.png" alt="Да" width="43"><span class="section11_blocks_list_bottom"><span class="section11_block_list_bold">Рекомендовано </span>Белорусским НИИ глазных болезней</span></span></li>
            </ul>
          </div>
        </div>
        <div class="section11_form" id="form">
          <div class="section8_form_inner_left">
            <div class="section11_form_wrapper">
              <div class="section8_form_inner_left_top"><span class="line_through"><span class="old-amount"><x-oldprice>990</x-oldprice></span> <span class="init_price-txt currency"></span></span></div>
              <div class="section8_form_inner_left_bottom"><span class="tot-amount"><x-newprice><?php echo $price['real_price']; ?></x-newprice></span> <span class="init_price-txt currency"></span></div>
            </div>
          </div>
          <div class="section8_form_inner_right">
            <div class="section8_form_inner_right_inner">
              <div class="section8_form_text"><span class="vision_center">
                           до <span class="before_date"></span> со скидкой
                       </span></div>
              <form class="section8_form_inputs" action="./_success_/" method="post">
              <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
                    <input name="csrf_token" type="hidden" value="56fbee90bc270299d55e7532821234d1:1585571657" />
    <select name="offer" class="form-control country_chang">
                <option 
            data-country-code="BY"
                        value="7290"
        >
            Беларусь        </option>
                <option 
            data-country-code="KZ"
                        value="7291"
        >
            Казахстан        </option>
                <option 
            data-country-code="RU"
                        selected="selected"
                        value="7289"
        >
            Россия        </option>
            </select>
                    <input type="text" name="name" required=""  placeholder="Ваше имя">
                <input type="tel" name="phone"  required="" title="Более 7 символов"  placeholder="Ваш телефон">
                <button type="submit">Оформить заказ</button>
              </form>
            </div>
          </div>
          <div class="section8_form_bottom_text">Количество акционных товаров ограничено: 18 упаковок	</div>
        </div>
      </div>
    </div>
    <div class="block footer">
      <p>ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ "ИНТЕРНЕТ ТОРГ"  ОГРН 1157847251781  ИНН 7814262128 КПП 781401001</p>
<p>197342, ГОРОД САНКТ-ПЕТЕРБУРГ, УЛИЦА ТОРЖКОВСКАЯ, ДОМ 16А, офис 9</p> 

  
              <p class="tlight-link">
<!--        <a class="nav-link" target="_blank" href="--><?//= $default_main_site ?><!--">Партнёрская программа TLight </a>-->
      </p>
    
    
            <p class="conf-link doclinks">
        <a class="nav-link"  href="index.html?off=mdbkUpm" onclick="window.open('/policy2.php'); return false;">Политика конфиденциальности </a>
      </p>
      
<!--       <p class="policy-link doclinks"> -->
<!--         <a class="nav-link"  href="" onclick="window.open('/policy2.php'); return false;">Условия оформления заказа</a> -->
<!--       </p> -->

    
    </div>
    <!-- Load Scripts-->
    <script src="http://vision.xfastcart.com/r1rb/js/scripts.min.js"></script>
    <script src="http://vision.xfastcart.com/r1rb/js/owl.carousel.min.js"></script>


    
  </body>

</html>