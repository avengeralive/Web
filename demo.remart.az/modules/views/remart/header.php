<header>
<nav class="navbar navbar-expand-lg navbar-light bg-custom">
<!--<a class="navbar-brand" href="/dashboard">REMART</a>-->
<button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button"></button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav mr-auto">
<? if (Backstage::gi()->login != '') { ?>
<? if ($item->role_id != 8) { ?>
    <li class="nav-item"><a class="nav-link" href="/dashboard">REMART</a></li>
<? } else { ?>
    <li class="nav-item"><a class="nav-link" href="/dashboard"><? echo Translations::gi()->objects; ?></a></li>
<? } ?>
<? } ?>
	<li class="nav-item active"><a class="nav-link" href="/"><? echo Translations::gi()->main_page; ?></a></li>
	<li class="nav-item"><a class="nav-link" href="/about"><? echo Translations::gi()->about_project; ?></a></li>
	<li class="nav-item"><a class="nav-link" href="/partners"><? echo Translations::gi()->partners; ?></a></li>
<? if (Backstage::gi()->login != '' && $item->role_id != 8) { ?>
	<li class="nav-item"><a class="nav-link" href="/siteView"><? echo Translations::gi()->objects; ?></a></li>
<? } ?>
	<? if (Backstage::gi()->login == '') { ?><li class="nav-item"><a class="nav-link" href="/login"><? echo Translations::gi()->login; ?></a></li><? } else { ?>
	<li class="nav-item"><a class="nav-link" href="/auth/logout"><? echo Translations::gi()->logout; ?></a></li><? } ?>
	<li class="nav-item"><a class="nav-link" href="/favorites">Favorites</a></li>
</ul>
<? if (Backstage::gi()->login != '') { ?>
<ul class="navbar-nav mr-auto">
	<li class="nav-item"><? echo Translations::gi()->logged_as; ?> <? echo Backstage::gi()->login ?></li>
	<li class="nav-item"><? echo Translations::gi()->your_role; ?> <? echo $role; ?></li>
	<li class="nav-item"><a data-toggle="modal" data-target="#change">Change password</a></li>
</ul>
<div class="modal fade" id="change" tabindex="-1" role="dialog" aria-labelledby="changeLabel" aria-hidden="true">		
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="changeLabel">Изменение пароля</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>							
			<div class="modal-body">
				<div class="container-fluid">
					<form id="changeform">
						<div class="row">
							<div class="form-group col-12 col-sm-12">
								<label for="old">Старый пароль</label>
								<input type="password" class="form-control" name="old" id="old" placeholder="Старый пароль" required="">
							</div>
							<div class="form-group col-12 col-sm-12">
								<label for="new">Новый пароль</label>
								<input type="password" class="form-control" name="new" id="new" placeholder="Новый пароль" required="">
							</div>
							<div class="form-group col-12 col-sm-12">
								<label for="confirm">Повторите пароль</label>
								<input type="password" class="form-control" name="confirm" id="confirm" placeholder="Повторите пароль" required="">
							</div>
							<div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<button class="btn btn-primary">Изменить пароль</button>
							</div>
						</div>
					</form>
					<script type="text/javascript">
						$(function(){
							$("#changeform").on('submit', function() {
								$.ajax({
									url: '/remart/changepass',
									method: 'post',
									dataType: 'json',
									data: {
										old: $("#old").val(),
										new: $("#new").val(),
										confirm: $("#confirm").val()
									},
									success: function(data) {
										if (data == true) alert('Пароль успешно изменён');
										else alert('Ошибка');
									}
								});
								return false;
							});
						});
					</script>
				</div>
			</div>	
		</div>
	</div>					
</div>
<? } ?>
</div>
</nav>
</header>