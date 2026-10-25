<?php echo $header; ?>
<div class="container">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>">
		<?php echo $content_top; ?>
		<?php echo $content_bottom; ?>
		<? $manufacturer_count = count($manufacturers); 
			$column_count = $manufacturer_count % 4 ? intval($manufacturer_count / 4 + 1) : $manufacturer_count / 4;
		?>
		<span class="h4 pull-left" style="color:#04448f;margin-top:14px;">Поиск по производителю</span>
		<div class="well pull-right col-md-12 col-xs-12">
			<div class="tab-content firms-list">
				<div class="tab-pane active" id="lightCars">
					<div class="row">
						<div class="col-md-6 col-xs-6">
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<?php foreach ($manufacturers as $key => $manufacturer) { 
								if ($key < $column_count) { ?>
								<div class="itm"><a href="/index.php?route=product/manufacturer/info&manufacturer_id=<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></a></div>
							<?php } } ?>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<?php foreach ($manufacturers as $key => $manufacturer) { 
								if ($key >= $column_count && $key < 2 * $column_count) { ?>
								<div class="itm"><a href="/index.php?route=product/manufacturer/info&manufacturer_id=<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></a></div>
							<?php } } ?>
							</div>
						</div>
						<div class="col-md-6 col-xs-6">
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<?php foreach ($manufacturers as $key => $manufacturer) { 
								if ($key >= 2 * $column_count && $key < 3 * $column_count) { ?>
								<div class="itm"><a href="/index.php?route=product/manufacturer/info&manufacturer_id=<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></a></div>
							<?php } } ?>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<?php foreach ($manufacturers as $key => $manufacturer) { 
								if ($key >= 3 * $column_count) { ?>
								<div class="itm"><a href="/index.php?route=product/manufacturer/info&manufacturer_id=<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></a></div>
							<?php } } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>