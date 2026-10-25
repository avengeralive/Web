<ul class="nav flex-column">
  <li class="nav-item">
    <a class="nav-header nav-link" href="./cabinet.php"><img src="./templates/<?php echo $template; ?>/img/logo-m.png" alt="logo"></a>
  </li>
  <li class="nav-item">
    <a class="nav-link  <?php if (curr_file()=='cat_offers.php') {echo 'active';} ?>" href="#"><i class="fa fa-star" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t27']; ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if (curr_file()=='news.php') {echo 'active';} ?>" href="#"><i class="fa fa-newspaper-o" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['news-link-text']; ?></a>
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
    <a class="nav-link" href="./logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t09']; ?></a>
  </li>  
</ul>