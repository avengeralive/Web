<ul class="nav flex-column">
  <li class="nav-item">
    <a class="nav-header nav-link" href="./cabinet.php"><img src="./templates/<?php echo $template; ?>/img/logo-m.png" alt="logo"></a>
  </li>
  <li class="nav-item">
    <a class="nav-link  <?php if (curr_file()=='settings.php') {echo 'active';} ?>" href="./settings.php"><i class="fa fa-cogs" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t23']; ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link  <?php if (curr_file()=='domains.php') {echo 'active';} ?>" href="./domains.php"><i class="fa fa-link" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t26']; ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link  <?php if (curr_file()=='cat_offers.php') {echo 'active';} ?>" href="./cat_offers.php"><i class="fa fa-star" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t27']; ?></a>
  </li>

  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='stats.php') {echo 'active';} ?>" href="./stats.php"><i class="fa fa-pie-chart" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t02']; ?></a>
  </li>

  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='zakaz.php') {echo 'active';} ?>" href="./zakaz.php"><i class="fa fa-bar-chart" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t19']; ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='export_zakaz.php') {echo 'active';} ?>" href="./export_zakaz.php"><i class="fa fa-file-archive-o" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t34']; ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='traffic.php') {echo 'active';} ?>" href="./traffic.php"><i class="fa fa-exchange" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t04']; ?></a>
  </li>
  <!--
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='news.php') {echo 'active';} ?>" href="./news.php"><i class="fa fa-newspaper-o" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['news-link-text']; ?></a>
  </li>
  -->
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='mailing.php') {echo 'active';} ?>" href="./mailing.php"><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['delivery-link-text']; ?></a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='offers.php') {echo 'active';} ?>" href="./offers.php"><i class="fa fa-star" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t03']; ?></a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='landings.php') {echo 'active';} ?>" href="./landings.php"><i class="fa fa-star" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t18']; ?></a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='prelandings.php') {echo 'active';} ?>" href="./prelandings.php"><i class="fa fa-star" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t35']; ?></a>
  </li>
  
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='users.php') {echo 'active';} ?>" href="./users.php"><i class="fa fa-users" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t24']; ?></a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='users_log.php') {echo 'active';} ?>" href="./users_log.php"><i class="fa fa-history" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t29']; ?></a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='multiacc.php') {echo 'active';} ?>" href="./multiacc.php"><i class="fa fa-users" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t30']; ?></a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='tickets.php') {echo 'active';} ?>" href="./tickets.php"><i class="fa fa-ticket" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t14']; ?></a>
  </li>
  <!--
 <li class="nav-item">
     <a class="nav-link <?php if (curr_file()=='messages.php') {echo 'active';} ?>" href="./messages.php"><i class="fa fa-commenting-o" aria-hidden="true"></i> Мессенджер <?php if($count_mess > 0) { ?>&nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-primary"><?=$count_mess; ?></span><?php } ?></a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='chat.php') {echo 'active';} ?>" href="./chat.php"><i class="fa fa-comments" aria-hidden="true"></i> Онлайн-Чат</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='stream.php') {echo 'active';} ?>" href="./stream.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Онлайн-обучение</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='roulette.php') {echo 'active';} ?>" href="./roulette.php"><i class="fa fa-gamepad" aria-hidden="true"></i> Лид-рулетка</a>
  </li>
    <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='store.php') {echo 'active';} ?>" href="./store.php"><i class="fa fa-gamepad" aria-hidden="true"></i> Магазин подарков</a>
  </li>
  -->
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='antifrod.php') {echo 'active';} ?>" href="./antifrod.php"><i class="fa fa-ban" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t36']; ?></a>
  </li>
  <!--
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='utms.php') {echo 'active';} ?>" href="./utms.php"><i class="fa fa-star" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t41']; ?></a>
  </li>
-->
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='finances.php') {echo 'active';} ?>" href="./finances.php"><i class="fa fa-bank" aria-hidden="true"></i> Заказы выплат</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='finances_log.php') {echo 'active';} ?>" href="./finances_log.php"><i class="fa fa-bank" aria-hidden="true"></i> Бухгалтерия</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t09']; ?></a>
  </li>  
</ul>