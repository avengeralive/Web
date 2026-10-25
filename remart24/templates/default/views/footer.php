<? if (Backstage::gi()->login != '') { ?>
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
</body>
</html>