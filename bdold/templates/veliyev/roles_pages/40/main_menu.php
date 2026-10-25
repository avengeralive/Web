<ul class="nav flex-column">
  <li class="nav-item">
    <a class="nav-header nav-link" href="./"><img src="./templates/<?php echo $template; ?>/img/logo-m.png" alt="logo"></a>
  </li>
  <li class="nav-item">
    <a class="nav-link  <?php if (curr_file()=='cabinet.php' || curr_file()=='profile.php') {echo 'active';} ?>" href="./cabinet.php"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t07']; ?></a>
  </li>
  <!--
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='news.php') {echo 'active';} ?>" href="./news.php"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Новости</a>
  </li> 
  -->
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='stats.php') {echo 'active';} ?>" href="./stats.php"><i class="fa fa-pie-chart" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t02']; ?></a>
  </li>                                
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='zakaz.php') {echo 'active';} ?>" href="./zakaz.php"><i class="fa fa-bar-chart" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t38']; ?></a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='export_zakaz.php') {echo 'active';} ?>" href="./export_zakaz.php"><i class="fa fa-file-archive-o" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t34']; ?></a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='offers.php') {echo 'active';} ?>" href="./offers.php"><i class="fa fa-star" aria-hidden="true"></i> Офферы</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='finances.php') {echo 'active';} ?>" href="./finances.php"><i class="fa fa-bank" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t06']; ?></a>
  </li>
  <!--
 <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='messages.php') {echo 'active';} ?>" href="./messages.php"><i class="fa fa-commenting-o" aria-hidden="true"></i> Мессенджер</a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='chat.php') {echo 'active';} ?>" href="./chat.php"><i class="fa fa-comments" aria-hidden="true"></i> Онлайн-Чат</a>
  </li>
  -->
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='tickets.php') {echo 'active';} ?>" href="./tickets.php"><i class="fa fa-question-circle" aria-hidden="true"></i> Поддержка</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t09']; ?></a>
  </li>  
</ul>