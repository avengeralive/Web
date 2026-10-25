<?php $this->Html->addCrumb('Пользователи', '/users'); ?>
<?php $this->Html->addCrumb('Добавление нового пользователя', '/users/add'); ?>



	<?php 
		echo $this->Form->create('User', array(
			'inputDefaults' => array(
				'div' => 'form-group',
				'wrapInput' => false,
				'class' => 'form-control'
			),
			'class' => 'well'
		));?>
			<legend>Добавление нового пользователя<a class="btn btn-default" href="/users"style="float: right;">Назад</a></legend>
<?php
		echo $this->Form->input('username', array(
			'label' => 'Имя пользователя',
			'placeholder' => 'Логин'
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
			'empty' => array(0 => '- Не выбрано -'),
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
		echo $this->Form->submit('Добавить', array(
			'div' => 'form-group',
			'class' => 'btn btn-primary'
		)); 
		echo $this->Form->end(); 
	?>
<?php $this->start('script');?>
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

		$this->Js->get('#UserRegionId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Users',
 				'action' =>'getOrganByRegion',
 			), array(
 				'update' =>'#UserOrganId',
 				'async' => true,
 				'method' => 'Post',
 				'dataExpression'=>true,
 				'data'=> $this->Js->serializeForm(array(
 					'isForm' => true,
 					'inline' => true
 				))
 			))
		);

		$this->Js->get('#UserOrganId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Users',
 				'action' =>'getByOrgan',
 			), array(
 				'update' =>'#UserInstitutionId',
 				'async' => true,
 				'method' => 'Post',
 				'dataExpression'=>true,
 				'data'=> $this->Js->serializeForm(array(
 					'isForm' => true,
 					'inline' => true
 				))
 			))
		);

		$this->Js->get('#UserInstitutionId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Users',
 				'action' =>'getByInstitution',
 			), array(
 				'update' =>'#UserLabId',
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
<?php $this->end(); ?>