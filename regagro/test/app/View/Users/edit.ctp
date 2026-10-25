<?php $this->Html->addCrumb('Пользователи', '/users'); ?>

<?php echo $this->Form->create('User', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>
		<legend>Редактирование карточки пользователя<a class="btn btn-primary" href="/users"style="float: right;">Назад</a></legend>
		<?php 
		echo $this->Form->input('username', array(
			'label' => 'Имя пользователя',
			'placeholder' => 'Логин'
		));
		echo $this->Form->input('inactive', array(
			'type' => 'checkbox',
			'label' => 'Не активный',
			'default' => false,
			'class' => false
		));
		echo $this->Form->input('changepass', array(
			'id' => 'changePass',
			'type' => 'checkbox',
			'label' => 'Поменять пароль',
			'default' => true,
			'class' => false
		));
		echo $this->Form->input('password', array(
			'label' => 'Пароль',
			'placeholder' => 'Не меньше 6 символов'
		));
		echo $this->Form->input('password_confirm', array(
			'label' => 'Повторите пароль',
			'type'=> 'password',
			'placeholder' => 'Повторите пароль'
		));
		echo $this->Form->input('displayname', array(
			'label' => 'ФИО',
			'placeholder' => 'Не указано'
		));
		
		echo $this->Form->input('region_id', array(
			'label' => 'Регион',
			'empty' => array(0 => '- Не выбрано -')
		));
		echo $this->Form->input('district_id', array(
			'label' => 'Район',
			'empty' => array(0 => '- Не выбрано -')
		));
		echo $this->Form->input('organ_id', array(
			'label' => 'Орган управления ветеринарии',
			'empty' => array(0 => '- Не выбрано -')
		));
		echo $this->Form->input('institution_id', array(
			'label' => 'Учреждение ветеринарии',
			'empty' => array(0 => '- Не выбрано -')
		));
		echo $this->Form->input('lab_id', array(
			'label' => 'Лаборатория',
			'empty' => array(0 => '- Не выбрано -')
		));
		
		
		
		
		
		echo $this->Form->input('job', array(
			'label' => 'Должность',
			'empty' => array(' ' => '- Не выбрано -'),
			'options' => array('Заведующий ЛВСЭ'=>'Заведующий ЛВСЭ', 
							   'Ветеринарный врач ЛВСЭ'=>'Ветеринарный врач ЛВСЭ', 
							   'Сотрудник УП'=>'Сотрудник УП', 
							   'Ветеринарный лаборант ЛВСЭ'=>'Ветеринарный лаборант ЛВСЭ')
		));
		echo $this->Form->input('role', array(
			'label' => 'Роль',
			'empty' => array(0 => '- Не выбрано -'),
			'options' => array('Администратор'=>'Администратор', 
							   'Сотрудник'=>'Сотрудник',
							   'Администратор учреждения'=>'Администратор учреждения')
		));
		echo $this->Form->submit('Сохранить', array(
			'div' => 'form-group',
			'class' => 'btn btn-primary'
		)); 
		?>

<?php echo $this->Form->end(); 
$this->start('script');?>
<script type="text/javascript">
$('#changePass').click(function() {
	$("[name*='password']").each(function(){
		this.disabled = !this.disabled;
	});
})
$('#changePass').click();
</script>
<?php $this->end(); ?>
<?php
$this->start('script');?>
<script type="text/javascript">
<?php

		$this->Js->get('#UserRegionId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Users',
 				'action' =>'getByRegion',
 			), array(
 				'update' =>'#UserDistrictId',
 				'async' => true,
 				'method' => 'Post',
 				'dataExpression'=>true,
 				'data'=> $this->Js->serializeForm(array(
 					'isForm' => true,
 					'inline' => true
 				))
 			))
		);
?>
</script>
<?php $this->end(); ?>