<?php $this->Html->addCrumb('Пользователи', '/users'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>Пользователи<span class="pull-right">
			<a class="collapsed btn btn-primary" data-toggle="collapse" href="#findusers" aria-expanded="false" aria-controls="findusers">Поиск пользователя</a>
			<a class="btn btn-primary" href="/users/add">Добавить</a></span>
		</h2>
		<!-- Поиск пользователя -->
		<div id="findusers" class="panel-collapse collapse" role="tabpanel">
			<?php echo $this->Form->create('User', array(
				'inputDefaults' => array(
					'div' => 'form-group',
					'wrapInput' => false,
					'class' => 'form-control'
				),
				'class' => 'well'
			));
			echo $this->Form->input('displayname', array(
				'label' => 'ФИО',
				'placeholder' => 'Введите имя',
				'div' => 'form-group',
				'required'=>false
			));
			
			
		echo $this->Form->input('region_id', array(
			'label' => 'Регион',
				'div' => 'form-group',
			'empty' => array(0 => '- Не выбрано -')
		));
		echo $this->Form->input('district_id', array(
			'label' => 'Район',
				'div' => 'form-group',
			'empty' => array(0 => '- Не выбрано -')
		));
		echo $this->Form->input('organ_id', array(
			'label' => 'Орган управления ветеринарии',
				'div' => 'form-group',
			'empty' => array(0 => '- Не выбрано -')
		));
		echo $this->Form->input('institution_id', array(
			'label' => 'Учреждение ветеринарии',
				'div' => 'form-group',
			'empty' => array(0 => '- Не выбрано -')
		));
		echo $this->Form->input('lab_id', array(
			'label' => 'Лаборатория',
				'div' => 'form-group',
			'empty' => array(0 => '- Не выбрано -')
		));
			
			
			
			
			echo $this->Form->input('job', array(
				'label' => 'Должность',
				'empty' => array('' => '- Не выбрано -'),
				'options' => array('Заведующий ЛВСЭ'=>'Заведующий ЛВСЭ', 
						'Ветеринарный врач ЛВСЭ'=>'Ветеринарный врач ЛВСЭ', 
							   'Сотрудник УП'=>'Сотрудник УП', 
					   'Ветеринарный лаборант ЛВСЭ'=>'Ветеринарный лаборант ЛВСЭ'),
				'default' => ' ',
				'required'=>false
			));
			echo $this->Form->input('role', array(
				'label' => 'Роль',
				'empty' => array('' => '- Не выбрано -'),
				'options' => array('Администратор'=>'Администратор', 
						'Сотрудник'=>'Сотрудник',
					   'Администратор учреждения'=>'Администратор учреждения'), 
				'default' => ' ',
				'required'=>false
			));
			//добавил до сюда	
			
			echo $this->Form->submit('Найти', array(
				'div' => 'form-group',
				'class' => 'btn btn-primary'
			));
			echo $this->Form->end(); ?>
		</div>
	</div>
</div>

<table class="table super">
	<tr>
		<th>Имя</th>
		<th>Роль</th>
		<th>Учреждение</th>
		<th></th>
	</tr>
	<?php foreach ($users as $user) {
		echo '
		<tr>
			<td>'.$this->Html->link($user['User']['displayname'], array('controller' => 'users',
					'action' => 'edit', $user['User']['id'])).'
			</td>
			<td>'.$user['User']['role'].'</td>
			<td>'.$user['Institution']['name'].'</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array('controller' => 'users',
					'action' => 'delete', $user['User']['id']),
					array(
						'escape'=>false
					)).'
			</td>
		</tr>';
	} ?>
</table>

<?php echo $this->Paginator->pagination(array(
	'ul' => 'pagination pagination-sm'
)); ?>
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