
<span id="menus"></span><div id="category_slider">
      <ul class="jcarousel-skin-opencart jcarousel-list">
      <?php $act=1; $i=0; foreach ($categories as $category) { $i++;?>
      <li class="element-<?=$i?>">
        <?php if ($category['category_id'] == $category_id) { $act = $i;?>
        <a href="<?php echo $category['href']; ?>" class="active"><?php echo $category['name']; ?></a>
        <?php } else { ?>
        <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
        <?php } ?>
      </li>
      <?php } ?>
    </ul>

</div>
<script type="text/javascript"><!--
  console.log($(window).width());
  if ($(window).width() > 768) {
    $('#category_slider ul').jcarousel({
      vertical: false,
      visible: 7,
      list: '.jcarousel-list',
      animation:200,
      wrap: 'circular',
      scroll: 1,
      start: <?= $act - 3 ?>
    });
  }
  else {
    $('#category_slider ul').jcarousel({
      vertical: false,
      visible: 1,
      list: '.jcarousel-list',
      animation:200,
      wrap: 'circular',
      scroll: 1,
      start: <?= $act - 3 ?>
    });
  }


preventSelection(document.getElementById('category_slider'));
var ElementsLi = $('.jcarousel-list li');
for(var i = 0; i <= ElementsLi.length; i++) {

  console.log(ElementsLi.eq(i))
  preventSelection(ElementsLi.eq(i));
}
//--></script>