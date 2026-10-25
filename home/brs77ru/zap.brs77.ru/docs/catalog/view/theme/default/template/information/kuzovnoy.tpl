<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <li><a href="/"><i class="fa fa-home"></i></a></li>
    <li><a href="/zapis-na-kuzovnoy-remnont">Записаться на кузовной ремонт</a></li>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <style>.form-group { margin: 0px !important; }</style>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1>Записаться на кузовной ремонт</h1>
      <form action="index.php?route=information/form" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="row">
          <div class="col-xs-12 col-sm-6 form-group">
            <label for="name">Ваше имя</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="col-xs-12 col-sm-6 form-group">
            <label for="phone">Ваш телефон</label>
            <input type="text" name="phone" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-6 form-group">
            <label for="email">Ваш email для обратной связи</label>
            <input type="email" name="email" class="form-control">
          </div>
          <div class="col-xs-12 col-sm-6 form-group">
            <label for="car_model">Марка и модель автомобиля</label>
            <input type="text" name="car_model" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-6 form-group">
            <label for="description">Краткое описание повреждения</label>
            <textarea name="description" class="form-control"></textarea>
          </div>
          <div class="col-xs-12 col-sm-6 form-group">
            <label for="photo">Вы можете загрузить фотографии</label>
            <input type="file" name="photo">
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 form-group">
            <button type="submit" class="btn btn-success">Отправить</button>
          </div>
        </div>
        
        
      </form>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
