<ul class="nav flex-column">
<li class="nav-item">
    <a class="nav-header nav-link" href="./cabinet.php"><img src="./templates/<?php echo $template; ?>/img/logo-m.png" alt="logo"></a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php if (curr_file()=='utms.php') {echo 'active';} ?>" href="./utms.php"><i class="fa fa-star" aria-hidden="true"></i> <?php echo $loc['in_header_top_menu']['t41']; ?></a>
  </li>
</ul>