<?php include 'main_menu_tickets.php'; ?>

<ul class="nav flex-column">
  <li class="nav-item">
    <a class="nav-header nav-link" href="./cabinet.php"><img src="./templates/<?php echo $template; ?>/img/logo-m.png" alt="logo"></a>
  </li>
  <li class="nav-item">
    <a class="nav-link  <?php if (curr_file()=='cabinet.php' || curr_file()=='profile.php') {echo 'active';} ?>" href="./cabinet.php"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t01']; ?></a>
  </li>
    
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='news.php') {echo 'active';} ?>" href="./news.php"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Новости</a>
  </li>
    
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='zakaz.php') {echo 'active';} ?>" href="./zakaz.php"><i class="fa fa-bar-chart" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t38']; ?></a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='stats.php') {echo 'active';} ?>" href="./stats.php"><i class="fa fa-pie-chart" aria-hidden="true"></i> Статистика</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='streams.php') {echo 'active';} ?>" href="./streams.php"><i class="fa fa-eercast" aria-hidden="true"></i> Потоки</a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='offers.php') {echo 'active';} ?>" href="./offers.php"><i class="fa fa-star" aria-hidden="true"></i> Офферы</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='finances.php') {echo 'active';} ?>" href="./finances.php"><i class="fa fa-bank" aria-hidden="true"></i> Финансы</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='referals.php') {echo 'active';} ?>" href="./referals.php"><i class="fa fa-bank" aria-hidden="true"></i> Реферальная система</a>
  </li>
   <!--
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='bonus.php') {echo 'active';} ?>" href="./bonus.php"><i class="fa fa-percent" aria-hidden="true"></i> Скидки</a>
  </li>
   -->
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='tools.php' || curr_file()=='parking.php' || curr_file()=='postback.php' || curr_file()=='buydomain.php') {echo 'active';} ?>" href="./tools.php"><i class="fa fa-wrench" aria-hidden="true"></i> Инструменты</a>
  </li>
  <!--
  <li class="nav-item">
    <a class="nav-link" href="#"><i class="fa fa-gift" aria-hidden="true"></i> Гарант призы</a>
  </li>
  -->
  <!--
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='competition.php') {echo 'active';} ?>" href="./competition.php"><i class="fa fa-trophy" aria-hidden="true"></i> Конкурсы</a>
  </li>
<li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='referals.php') {echo 'active';} ?>" href="./referals.php"><i class="fa fa-users" aria-hidden="true"></i> Рефералы</a>
  </li>
   -->
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='tickets.php') {echo 'active';} ?>" href="./tickets.php"><i class="fa fa-headphones" aria-hidden="true"></i> Поддержка <?php if($found_ticket > 0) { ?>&nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-primary"><?=$found_ticket; ?></span><?php } ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='help.php') {echo 'active';} ?>" href="./help.php"><i class="fa fa-question-circle" aria-hidden="true"></i> FAQ</a>
  </li>
  
<!--  
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='parking.php') {echo 'active';} ?>" href="./parking.php"><i class="fa fa-link" aria-hidden="true"></i> Мои домены</a>
  </li>
-->
  <!--
 <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='messages.php') {echo 'active';} ?>" href="./messages.php"><i class="fa fa-commenting-o" aria-hidden="true"></i> Мессенджер <?php if($count_mess > 0) { ?>&nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-primary"><?=$count_mess; ?></span><?php } ?></a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='chat.php') {echo 'active';} ?>" href="./chat.php"><i class="fa fa-comments" aria-hidden="true"></i> Онлайн-Чат</a>
  </li>
  -->
  <!--
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='stream.php') {echo 'active';} ?>" href="./stream.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Видео-чат</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='roulette.php') {echo 'active';} ?>" href="./roulette.php"><i class="fa fa-gamepad" aria-hidden="true"></i> Лид-рулетка</a>
  </li>
  -->
  <li class="nav-item">
    <a class="nav-link" href="./logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t09']; ?></a>
  </li>  
</ul>