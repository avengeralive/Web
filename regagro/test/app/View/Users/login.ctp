<div class="row">
	<div class="col-md-6 col-md-offset-3">
	<?php echo $this->Form->create('User', array(
		'inputDefaults' => array(
			'div' => 'form-group',
			'wrapInput' => false,
			'class' => 'form-control'
		),
		'class' => 'well'
	)); ?>
	<fieldset>
		<legend>Вход в систему</legend>
		<?php echo $this->Form->input('username', array(
			'label' => 'Имя пользователя',
			'placeholder' => 'Логин'
		));
		echo $this->Form->input('password', array(
			'label' => 'Пароль',
			'placeholder' => '******'
		));
		echo $this->Form->submit('Войти', array(
			'div' => 'form-group',
			'class' => 'btn btn-primary'
		)); ?>
	</fieldset>
	<?php echo $this->Form->end(); ?>
	</div>
</div>