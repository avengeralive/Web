<ul class="nav flex-column">
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