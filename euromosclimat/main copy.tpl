<?php echo $this->docType()."\r\n";?>
<html xmlns="http://www.w3.org/1999/xhtml" class="mainhtml">
<head>
<?php
    echo $this->MyHeadTitle();
    echo $this->MyHeadMeta();
    echo $this->MyHeadLink();
    echo $this->MyHeadScript();
    ?>
</head>
<body>
<div id="overlay"></div>
<div id="hoverdiv"></div>
<div id="loader"></div>
<div id="dialog-confirm" style="display:none;" title="title">
  <p>message</p>
</div>
<div id="topline"></div>
<div id="wrapper">
  <div id="header">
    <div id="logo"><a href="/"></a></div>
    <div id="bplace"><?php echo $this->ShowBlock('bannerplace');?></div>
    <div id="rblock">
      <div id="cart">
        <div id="carthead"><!--Корзина:-->
          <a href="/catalog/cart" class="-opencart"><div id="cartbox">
            <script type="text/javascript">
              $(document).ready(function(){
                $('#cartbox').load('/catalog/cart/getcartcontent');
              });
            </script>
          </div></a>
        </div>
      </div>
      <div id="phones"><?php echo $this->ShowBlock('headphones');?></div>
      <div id="email"><?php echo $this->ShowBlock('heademail');?></div>
    </div>
  </div>
  <div id="menuline">
    <div id="loginbox">
      <?php if($this->user['role']=='guest'): ?>
      <form action="/login.html" method="post">
        <table>
          <tr>
            <td><input type="text" name="username" id="login" placeholder="Логин" size="10"/></td>
            <td><input type="password" name="password" id="password" placeholder="Пароль" size="10" /></td>
          </tr>
          <tr>
            <td><a href="/register.html" class="register2">регистрация</a></td>
            <td><input type="submit" value="Вход" id="submit" /></td>
          </tr>
        </table>
      </form>
      <?php else:?>
      <table>
        <?php if($this->user['role']!='user'): ?>
        <tr>
          <td><a href="/admin" class="register">Админпанель</a></td>
        </tr>
        <?php endif;?>
        <tr>
          <td><a href="/user" class="register">Аккаунт</a></td>
        </tr>
        <tr>
          <td><a href="/logout.html" class="register">Выйти</a></td>
        </tr>
      </table>
      <?php endif?>
    </div>
    <div id="menuwrapper">
      <div id="mainmenubg"></div>
      <div id="mainmenu"> <?php echo $this->ShowMenu('topmenu');?> </div>
      <div id="breadcumbs"><?php echo $this->ShowBreadcrumbs();?></div>
    </div>
  </div>
  <div id="centerwrapper">
    <div id="leftcol">
      <div id="searchblock">
        <form action="/catalog/" method="POST">
          <table>
            <tr>
              <td><input type="text" name="filter[search]" value="<?php if(isset($this->params['filter']['search']))echo $this->params['filter']['search']; ?>" id="searchfield" /></td>
              <td><input type="submit" value="Искать" id="searchbtn" /></td>
            </tr>
          </table>
        </form>
      </div>
      <div id="catalogbox">
        <div id="catalogboxhead"><a href="/catalog">Каталог</a></div>
        <?php 
            $cats=new Catalog_ProductsModel();$n=null;
            $catlist=$cats->getCatsMenu($n,$this->category,0,'index');
            echo $this->ShowMenu($catlist[0]['pages']);
            ?>
      </div>
      <?php /*echo '<div id="filter">'.$this->ShowFilter().'</div>';*/?>
      <div id="votebox"> <?php echo $this->ShowBlock('counters');?> 
        <!--<div id="voteboxhead">Голосование</div>
            <div id="votequestion">Ваш статус</div>
            <ul>
              <li><input type="radio" name="vote" id="vote1" /><label for="vote1">Бригадир</label></li>
              <li><input type="radio" name="vote" id="vote2" /><label for="vote2">Бригадир</label></li>
              <li><input type="radio" name="vote" id="vote3" /><label for="vote3">Бригадир</label></li>
            </ul>
            <input id="submit" type="submit" value="Голосовать" />--> 
      </div>
      <div class="clear"></div>
    </div>
    <div id="contentw"> <?php echo $this->ShowMessage();?>
      <?php 
            if(!($this->module=='catalog' && $this->action!='index') &&  !($this->module=='default' && $this->action=='index')):?>
      <h1 class="headline"><?php 
      if(isset($this->params['filter']['search']))
        echo 'Результат поиска "'.$this->params['filter']['search'].'"';
      else
        echo $this->title;?></h1>
      <?php endif;
            if($this->module=='catalog' && $this->action=='index')
              echo $this->PartialEx('catalog/filter.tpl');
            ?>
      <div id="content"> <?php echo $this->layout()->content;?> </div>
    </div>
  </div>
</div>
<div id="footer">
  <div id="footerwrapper">
    <div id="footerlogo"><a href="/"></a></div>
    <div class="footerblock">
      <div class="footerhead"><?php echo $this->ShowBlock('footerhead1');?></div>
      <?php echo $this->ShowMenu('footermenu1');?> </div>
    <div class="footerblock">
      <div class="footerhead"><?php echo $this->ShowBlock('footerhead2');?></div>
      <?php echo $this->ShowMenu('footermenu2');?> </div>
    <div class="footerblock">
      <div class="footerhead"><?php echo $this->ShowBlock('footerhead3');?></div>
      <?php echo $this->ShowBlock('footerblock');?> </div>
  </div>
  <div class="footerlinks"><?php echo $this->ShowBlock('footerlinks');?> </div>
</div>


<link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
<script>
$(function(){
  /*setTimeout(function() {
    $(".marquiz__container__holder").css('display', 'flex');;
    $(".marquiz__container").show();
  }, 5000);
  $(".marquiz__button").on('click', function(){
    $(".marquiz__container__holder").css('display', 'none');;
    $(".marquiz__container").hide();
  });*/
});
</script>

<div class="marquiz__container__holder">
  <div class="marquiz__container" style="font-family: Oswald;">
    <h3>Хотите получить скидку - закажите обратный звонок</h3>
    <ul>
      <li>Заказать бесплатный осмотр объекта</li>
      <li>Оставить заявку на подбор оборудования</li>
      <li>Обратный звонок</li>
    </ul>
    <h3>Поможем в выборе кондиционера</h3>
  </div>
</div>

<style>
  .marquiz__container__holder {
    position: absolute;
      width: 100%;
      height: 100vh;
      display: flex;
      background: rgba(0,0,0,.8);
      top: 0;
      left: 0;
      justify-content: center;
      flex-direction: column;
      display: none;
  }
  .marquiz__container {
    background: url('./bg.png');
    background-size: cover;
      width: 640px;
      height: 200px;
      margin: 0 auto;
      padding: 50px;
      box-shadow: 2px 2px 2px #000;
      display: none;
  }
  .marquiz__button {
      color: #00a2e6 !important;
      background: none !important;
      border: 3px solid #00a2e6 !important;
      font-size: 11px !important;
      border-radius: 0px !important;
      box-shadow: 0 0 1px 2px #00a2e6 !important;
      text-transform: uppercase !important;
      padding: 15px !important;
      float: right;
  }
  .marquiz__button:hover {
      color: #00a2e6 !important;
  }
</style>

</body>
</html>
