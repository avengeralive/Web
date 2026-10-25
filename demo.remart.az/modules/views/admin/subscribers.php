<?php 
require_once(Backstage::gi()->ADMIN_TEMPLATE_DIR.'views/header.php');
require_once('navigation.php');
?>
<script type="text/javascript" charset="utf-8" src="<?php echo Backstage::gi()->EXTERNAL_URL; ?>jquery/jquery.form.min.js"></script>	
<?php
echo '<h1>'.Translations::gi()->subscribers.'</h1>';
echo '<hr/>';
?>
<div>
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li class="active"><a href="#mailing_form" data-toggle="tab"><?php echo Translations::gi()->mailing_form; ?></a></li>
		<li><a href="#crud_subscribers" data-toggle="tab"><?php echo Translations::gi()->subscribers; ?></a></li>
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="mailing_form" style="background-color: #FFF; padding: 15px">
			<?php echo $mailing_form; ?>
		</div>
		<div role="tabpanel" class="tab-pane" id="crud_subscribers" style="background-color: #FFF; padding: 15px">
			<?php echo $crud_subscribers; ?>
		</div>
	</div>
</div>

<?php
require_once(Backstage::gi()->ADMIN_TEMPLATE_DIR.'views/footer.php');
?>