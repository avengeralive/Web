<ul class="nav flex-column">
  <li class="nav-item">
    <a class="nav-header nav-link" href="./cabinet.php"><img src="./templates/<?php echo $template; ?>/img/logo-m.png" alt="logo"></a>
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
      <a class="nav-link <?php if (curr_file()=='tickets.php') {echo 'active';} ?>" href="./tickets.php"><i class="fa fa-ticket" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t14']; ?></a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='utms.php') {echo 'active';} ?>" href="./utms.php"><i class="fa fa-star" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t41']; ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t09']; ?></a>
  </li>  
</ul>