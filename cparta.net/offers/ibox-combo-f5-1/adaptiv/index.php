<?php 
   $offer = 50;
   include_once $_SERVER['DOCUMENT_ROOT'].'/../includes/landingsData/index2.php';
?> 

<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Содержимое HEAD индексного файла -->
 <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>iBOX Combo F5</title>

  <link rel="stylesheet" href="index_files/reset.css">
  <link rel="stylesheet" href="index_files/Montserrat.css">
  <link rel="stylesheet" href="index_files/slick.css">
  <link rel="stylesheet" href="index_files/settings.css">
  <link rel="stylesheet" href="index_files/style.css">   


</head>
<body>
  <section class="offer">
    <div class="wrap">
      <h1><span>Видеорегистратор </span></h1>
      <h2><span>iBOX Combo F5</span></h2>
      <div class="sale">акция! <b>65%</b> скидка</div>
      <!--bullet-->
      <div class="bullet">
        <ul>
          <li>Запись видео 1920×1080</li>
          <li>Датчик удара (G-сенсор)</li>
          <li>GPS, ГЛОНАСС</li>
          <li>Функция радар-детектора</li>
          <li>Угол обзора 170°</li>
        </ul>
      </div>
      <!--/bullet-->
      <!--price-->
      <div class="price">
        <div class="item">
          <p>Обычная цена:</p>
          <div class="value"><span>5980</span><i>Руб</i></div>
        </div>
        <div class="item">
          <p>Цена сегодня:</p>
          <div class="value"><span><?php echo $price['real_price']; ?></span></div>
        </div>
      </div>
      <!--/price-->
      <a href="#order" class="button-m">Заказать сейчас</a>
      <div class="stock">*осталось <b>5</b> товаров по акции</div>
    </div>
  </section>
  <!--/offer-->

  <!--b1-->
  <section class="b1">
    <div class="wrap">
      <h3>iBOX Combo F5 - комбо-видеорегистартор с высоким качеством записи!</h3>
      <div class="desc">
        <img src="index_files/b1-im.jpg" alt="">
        Видеорегистратор iBOX Combo F5 укомплектован мощным процессором, многослойной стеклянной оптикой и
        светочувствительной матрицей, за счёт чего он создаёт очень чёткое и детализованное изображение в любых
        условиях – в том числе в сумерках и при плохой погоде.
      </div>
      <!--list-v1-->
      <ul class="list-v1">
        <li>
          <img src="img/photo3.png" alt="">
          <p>Мощный процессор Ambarella <span>Позволяет записывать видео в высоком качестве в любое время
              суток</span></p>
        </li>
        <li>
          <img src="img/photo4.png" alt="">
          <p>Широкий угол обзора <span>Позволяет "захватить" в кадр значительную часть пространства на дороге</span></p>
        </li>
        <li>
          <img src="img/photo5.png" alt="">
          <p>"Гейгер" эффект <span>При приближении к камере звуковые и визуальные сигналы будут усиливаться</span>
          </p>
        </li>
        <li>
          <img src="img/photo6.png" alt="">
          <p>Регулировка громкости <span>Возможность регулировать громкость звуковых сигналов</span></p>
        </li>
      </ul>
      <!--/list-v1-->
    </div>
  </section>
  <!--/b1-->
  <style>

    .thumb-wrap {
  position: relative;
  padding-bottom: 56.25%; /* задаёт высоту контейнера для 16:9 (если 4:3 — поставьте 75%) */
  padding-top: 30px;
  height: 0;
  overflow: hidden;
}
.thumb-wrap iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.video__cont{
    display: flex;
    justify-content: space-between;
    margin-bottom: 40px;

}
.video__muy{
    width: 47%;
}

@media screen and (max-width: 639px) {
  .video__cont{
  flex-direction: column;

}
  .video__muy{
    width: 100%;
    margin-bottom: 20px;
}
}
</style>
  <!--b2-->
  <section class="b2">
    <div class="wrap">
      <h2 class="title">Видеообзор комбо-видеорегистартора iBOX Combo F5</h2>
      <!--box-->
      <div class="thumb-wrap">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/TNaacGLGzjs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
      </div>
      <h2 class="title" style="margin-top: 20px;">Примеры съемки днем и ночью</h2>

      <div class="video__cont">


        <div class="video__muy">
          <div class="thumb-wrap">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/fODgRBHWjQU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
          </div>
        </div>

        <div class="video__muy">
          <div class="thumb-wrap">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/DWF8Umlrv5Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
          </div>
        </div>
      </div>
      <a href="#order" class="button-m">Заказать сейчас</a>
    </div>
  </section>
  <!--/b2-->

  <!--b3-->
  <section class="b3">
    <div class="wrap">
      <h2 class="title">Почему автомобилисты выбирают iBOX Combo F5?</h2>
      <!--why_list-->
      <ul class="why_list">
        <li>
          <div class="item">
            <img src="img/photo7.jpg" alt="">
            <div class="txt">
              <h4>Full HD видео</h4>
              <p>Снимает видео повышенной четкости с разрешением 1920*1080p. Более высокое разрешение
                видео обеспечивает более четкую и детальную картинку видеозаписи, но занимает больше
                места на карте памяти</p>
            </div>
          </div>
        </li>
        <li>
          <div class="item">
            <img src="img/photo8.jpg" alt="">
            <div class="txt">
              <h4>Автокоррекция качества записи</h4>
              <p>Технология WDR обеспечивает сбалансированное изображение по цвету и свету в сложных
                условиях - при подсветке сзади и интенсивном изменяющемся освещении</p>
            </div>
          </div>
        </li>
        <li>
          <div class="item">
            <img src="img/photo9.jpg" alt="">
            <div class="txt">
              <h4>Защита важных записей от удаления</h4>
              <p>При срабатывании датчика удара видеорегистратор мгновенно начинает запись нестираемого
                видео для последующего анализа события и помещает его в нестираемый буфер памяти</p>
            </div>
          </div>
        </li>
        <li>
          <div class="item">
            <img src="img/photo10.jpg" alt="">
            <div class="txt">
              <h4>GPS база координат радаров</h4>
              <p>Радар-детектор с GPS может предупреждать водителя о приближении к стационарным радарам с
                камерами, используя их координаты, сохраненные в памяти</p>
            </div>
          </div>
        </li>
        <li>
          <div class="item">
            <img src="img/photo11.jpg" alt="">
            <div class="txt">
              <h4>Голосовое оповещение</h4>
              <p>При приближении к радару устройство информирует об этом с помощью голоса. При этом может
                сообщаться расширенная информация о приближающемся радаре. Например, тип радара или
                частотный диапазон</p>
            </div>
          </div>
        </li>
        <li>
          <div class="item">
            <img src="img/photo12.jpg" alt="">
            <div class="txt">
              <h4>Сообщение о превышении скорости</h4>
              <p>Встроенная функция "Моя максимальная скорость" предупреждает о превышении выбранного
                лимита скорости, который пользователь устанавливает самостоятельно</p>
            </div>
          </div>
        </li>
        <li>
          <div class="item">
            <img src="img/photo13.jpg" alt="">
            <div class="txt">
              <h4>АнтиСон</h4>
              <p>"АнтиСон" используется, если появляется вероятность засыпания за рулем. При включении
                этой функции аппарат через заданные промежутки времени издает звуковой сигнал</p>
            </div>
          </div>
        </li>
        <li>
          <div class="item">
            <img src="img/photo14.jpg" alt="">
            <div class="txt">
              <h4>Радар-детектор</h4>
              <p>iBOX Combo F5 имеет встроенный радар детектор, который существенно сохранит ваши
                средства обнаружив и предупредив о модернизированных камерах (Робот, Стрелка, Кречет,
                Кордон, Крис-П, X, Ka, Ku,) и постах ДПС.</p>
            </div>
          </div>
        </li>

      </ul>
      <!--/why_list-->
    </div>
  </section>
  <!--/b3-->

  <!--b4-->
  <section class="b4">
    <div class="wrap">
      <h2 class="title">Характеристики iBOX Combo F5</h2>

      <table cellspacing="0" cellpadding="15" width="100%" height="130">
        <tbody>
          <tr>
            <td>Процессор </td>
            <td>Ambarella A12A20 </td>

          </tr>
          <tr>
            <td>ГЛОНАСС-модуль </td>
            <td>есть</td>

          </tr>
          <tr>
            <td>GPS-модуль</td>
            <td>есть </td>

          </tr>
          <tr>
            <td>Голосовое оповещение</td>
            <td>есть</td>

          </tr>
          <tr>
            <td>Угол обзора лазерного детектора</td>
            <td>360°</td>

          </tr>
          <tr>
            <td>Обнаружение радаров</td>
            <td>Кречет; Robot; Визир; Крис; Беркут; Радис; Арена; Сокол; MESTA; Кордон; Поток-С; Автодория;</td>

          </tr>
          <tr>
            <td>Обнаружение "Стрелки"</td>
            <td>есть</td>

          </tr>
          <tr>
            <td>Поддержка HD</td>
            <td>1080p</td>

          </tr>
          <tr>
            <td>Запись видео</td>
            <td>1920x1080 при 30 к/с;</td>

          </tr>
          <tr>
            <td>Угол обзора</td>
            <td>170°</td>

          </tr>

          <tr>
            <td>Размер экрана (диагональ)</td>
            <td>2.7"

            </td>

          </tr>
          <tr>
            <td>Режимы</td>
            <td>автостарт записи;</td>

          </tr>
          <tr>
            <td>Запись видеороликов</td>
            <td>циклическая;</td>

          </tr>
          <tr>
            <td>Размер матрицы</td>
            <td> 1/3"</td>

          </tr>

          <tr>
            <td>Длительность ролика</td>
            <td> 1 мин; 3 мин; 5 мин;</td>

          </tr>
          <tr>
            <td>Формат записи/видеокодек</td>
            <td> MOV / H.264

            </td>

          </tr>

          <tr>
            <td>Поддержка карт памяти</td>
            <td>microSD (microSDHC);</td>

          </tr>

          <tr>
            <td>GPS-трекер</td>
            <td>есть</td>

          </tr>


          <tr>
            <td>G-сенсор (датчик удара)</td>
            <td>есть</td>

          </tr>

          <tr>
            <td>Датчик движения</td>
            <td>есть</td>

          </tr>


          <tr>
            <td>Ночной режим</td>
            <td>есть</td>

          </tr>


          <tr>
            <td>Стабилизатор изображения</td>
            <td>есть</td>

          </tr>

          <tr>
            <td>Оптимизация качества видео WDR</td>
            <td>есть</td>

          </tr>

          <tr>
            <td>Рабочая температура</td>
            <td>-30 ~ 70°C</td>

          </tr>


        </tbody>
      </table>


    </div>
  </section>
  <!--/b4-->
  <section>
    <div class="wrap">
      <h2 class="title">Комплектация</h2>


      <style>
        .featurewrap{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .featureleft{
            width: 47%; 
        }
        .featureleft p{
            font-size: 18px;
            font-weight: 700;
          margin-bottom: 10px;   
        }
        .featureright{
          width: 47%;
        }
        @media (max-width:659px ){
         .featurewrap{
         flex-wrap: wrap;
        }
       .featureleft{
         width: 100%;
         }
          .featureright{
          width: 100%;
         }
       }
      </style>
      <div class="featurewrap">
        <style>
          .aaaaaaa ul li {
                       font-size: 21px;
           margin: 0 0 15px;
           padding: 0 0 2px;
           border-bottom: 1px dashed #c1c1c1;
           text-align: left;
           position: relative;
           
       }
       TD, TH {
                  padding: 10px;
                  border: 1px solid black;
                  width: 30%;
              }
        </style>
        <div class="text featureleft aaaaaaa">
          <ul>











            <li><b> видеорегистратор; </b> </li>
            <li><b> автомобильный адаптер питания от прикуривателя; </b></li>
            <li><b> картовод для карт формата microSD; </b></li>
            <li><b>крепление на лобовое стекло типа «присоска»; </b></li>
            <li><b> кабель HDMI—Mini-HDMI;</b> </li>
            <li><b> кабель USB—Mini-USB;</b> </li>

            <li><b> 2 плавких предохранителя на 5 А;</b> </li>
            <li><b> матерчатый мешочек для переноски устройства;</b> </li>
            <li><b> инструкцию, руководство по установке и гарантийный талон.</b> </li>


          </ul>
        </div>
        <div class="featureright">
          <div class="your-class">
            <img src="img/photo15.jpg" alt="">

          </div>
        </div>
      </div>
    </div>


  </section>
  <!--b5-->
  <section class="b5">
    <h2 class="title">Более 2000 счастливых автомобилистов уже получили видеорегистратор из нашего магазина!</h2>
    <img src="img/photo16.jpg" alt="">
  </section>
  <!--/b5-->

  <!--order_info-->
  <section class="order_info">
    <h2><span>Доставка и оплата</span></h2>
    <div class="wrap">
      <ul>
        <li>
          <p>Доставка почтой в течение 3-7 рабочих дней по всей России</p>
        </li>
        <li>
          <p>Оплата заказов <span>осуществляется по факту</span> получения товара</p>
        </li>
        <li>
          <p>Мы всегда проверяем товар перед отправкой и гарантируем 100% качество</p>
        </li>
      </ul>
      <img src="img/photo17.png" alt="">
    </div>
  </section>
  <!--/order_info-->

  <!--warranty-->
  <section class="warranty">
    <div class="wrap">
      <div class="desc">
        <h2>Гарантия качества</h2>
        <p>
          Регистратор iBOX Combo F5 соответствует всем стандартам качества и безопасности, при возникновении претензий
          со стороны покупателя, мы решим проблему в кратчайшие сроки
        </p>
      </div>
    </div>
  </section>
  <!--/warranty-->

  <!--reviews-->
  <section class="reviews">
    <div class="wrap">
      <h2 class="title">Реальные отзывы наших покупателей</h2>
      <!--slider-->
      <div class="slider ">
        <!--item-->

        <div class="item ">
          <div class="bg">
            <div class="photo">
              <img src="img/photo18.png" alt="">
            </div>
            <div class="info">
              <img src="img/photo21.jpg" alt="">
              <h4>Александр У.

                <span>34 года</span></h4>
            </div>
            <p>
              Понравился видеорегистратор с радар-детектором iBOX Combo F5. Эксплуатирую не так давно, (3 месяца), нет
              нареканий. Приятная моделька. Компактный, легко настраиваемый. Ловит и предупреждает обо всех камерах. На
              записи хорошая видимость в любое время суток и тоннелях. Уже обновил базу камер. Тоже без особых усилий.
              Советую к покупке.
            </p>
          </div>
        </div>
        <div class="item ">
          <div class="bg">
            <div class="photo">
              <img src="img/photo19.png" alt="">
            </div>
            <div class="info">
              <img src="img/photo22.jpg" alt="">
              <h4>Карина И.

                <span> 31 год</span></h4>
            </div>
            <p>
              Отличный видеорегистратор, оповещает о камерах за 630 - 1000м. Очень мало ложных срабатываний.
              Видеорегистратор снимает очень хорошо, угол обзора великолепен - 170 градусов. Надежный, не навязчивый, с
              меню еще до конца не разобралась. Нравится пока. Не подводил. Рекомендую.
            </p>
          </div>
        </div>
        <div class="item ">
          <div class="bg">
            <div class="photo">
              <img src="img/photo20.png" alt="">
            </div>
            <div class="info">
              <img src="img/photo23.jpg" alt="">
              <h4>Олег Б.

                <span> 33 года</span></h4>
            </div>
            <p>
              Full HD качество- снимает четко, можно просмотреть записанный файл, как с самого устройства, так и с
              компьютера, видны все номера и каждую деталь; обзор сверхширокий - 170 градус угол камеры, берет все что
              видно глазами; всегда заблаговременно предупреждает о камерах, штрафы перестали приходить. Очень
              миниатюрный, не мешает на лобовом стекле обзору.
            </p>
          </div>
        </div>
      </div>
    </div>
    <!--/item-->
    <!--item-->

    <!--/item-->
    <!--item-->

    <!--/item-->
    
    <!--/slider-->
    
  </section>
  <!--/reviews-->

  <!--offer-->
  <section class="offer bottom">
    <div class="wrap">
      <div class="sale">акция! <b>65%</b> скидка</div>
      <div class="title">
        <h1><span>Видеорегистратор </span></h1>
        <h2><span>iBOX Combo F5</span></h2>
      </div>
      <!--order_form-->
      <div class="order_form">
        <div class="title_form">Закажите сегодня <span>со скидкой 65%</span></div>
        <!--price-->
        <div class="price">
          <div class="item">
            <p>Обычная цена:</p>
            <div class="value"><span>5980</span><i>Руб</i></div>
          </div>
          <div class="item">
            <p>Цена сегодня:</p>
            <div class="value"><span><?php echo $price['real_price']; ?></span></div>
          </div>
        </div>
        <!--/price-->
        <div class="last_day">*последний день акции</div>
        <!--m1-form-->
        <form class="m1-form" id="order" action="./_success_/" method="post">
          <input type='hidden' name='referer' value="<?php echo isset($_GET['referer']) ? $_GET['referer'] : $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;?>">
<input type="hidden" name="subid1"  value="<?php echo isset($_GET['subid1']) ? $_GET['subid1'] : '' ;?>" />
<input type="hidden" name="subid2"  value="<?php echo isset($_GET['subid2']) ? $_GET['subid2'] : '' ;?>" />
<input type="hidden" name="subid3"  value="<?php echo isset($_GET['subid3']) ? $_GET['subid3'] : '' ;?>" />
<input type="hidden" name="subid4"  value="<?php echo isset($_GET['subid4']) ? $_GET['subid4'] : '' ;?>" />  
<input type="hidden" name="subid5"  value="<?php echo isset($_GET['subid5']) ? $_GET['subid5'] : '' ;?>" />
          <input class="field" type="text" name="name" placeholder="Введите Ваше имя" required>
          <input class="field" type="tel" name="phone" placeholder="Введите телефон" required>
          <button class="button-m">Заказать сейчас</button>
          
        </form>
        <!--/m1-form-->
        <div class="stock">*осталось <b>5</b> товаров по акции</div>
      </div>
      <!--/order_form-->
    </div>
  </section>
  <!--/offer-->

  <!--footer-->
  <footer class="footer">
    <div class="wrap">
      ООО «Рефарм», ИНН 7701185521 ОГРН 1037739403558 <br>
      Юридический адрес 107076, город Москва, Колодезный переулок, дом 2а строение 2, пом XXIII ком 3 <br>
      Все права защищены. Использование материалов разрешено только с согласия правообладателя. <br>

      <p>
        <a href="politika.pdf" target="_blank">Политика&nbsp;конфиденциальности</a>

      </p>
    </div>
  </footer>

  <link rel="stylesheet" type="text/css" href="index_files/roboto.css">
  <script src="index_files/jquery.js" type="text/javascript"></script>

  <script src="index_files/slick.js"></script>
  <script src="index_files/panorama.js"></script>
  <script src="index_files/init.js"></script>

</body>

</html>