<div class="container-fluid">
	<div class="row">
		<nav class="nav nav-pills flex-column flex-sm-row col-12">
			<a class="nav-link active" id="v-pills-objects-tab" data-toggle="pill" href="#v-pills-objects" role="tab" aria-controls="v-pills-objects" aria-expanded="true"><? echo Translations::gi()->objects; ?></a>
		</nav>
		<div class="tab-content col-12" id="v-pills-tabContent">
			<div class="tab-pane fade show active" id="v-pills-objects" role="tabpanel" aria-labelledby="v-pills-objects-tab">
				<? include('additional_objects.php'); ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
<? if (!$item->passch) { ?>
alert("Смените пароль!");
<? } ?>
</script>