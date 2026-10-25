
<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Лаборатории ЛВСЭ', '/labs'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>Лаборатории ЛВСЭ
			<span class="pull-right">
				<a class="collapsed btn btn-primary" data-toggle="collapse" href="#adds" aria-expanded="false" aria-controls="adds">Поиск</a>
				<?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Добавить',
						array('controller'=>'labs', 'action'=>'add'),
						array('escape'=>false, 'class'=>'btn btn-primary'))?>
			</span>
		</h2>
		<div id="adds" class="panel-collapse collapse" role="tabpanel">
		<?php echo $this->Form->create('Lab', array(
				'inputDefaults' => array(
				'div' => 'form-group',
				'wrapInput' => false,
				'class' => 'form-control'
			),
			'class' => 'well'
		));
		echo $this->Form->input('region_id', array(
			'label' => 'Регион',
			'empty' => array(0 => '- Не выбрано -'),
			'required'=>false
		));
		echo $this->Form->input('district_id', array(
			'label' => 'Район',
			'empty' => array(0 => '- Не выбрано -')
		));
		echo $this->Form->input('organ_id', array(
			'label' => 'Орган управления ветеринарии',
			'empty' => array(0 => '- Не выбрано -'),
			'required'=>false
		));
		echo $this->Form->input('institution_id', array(
			'label' => 'Учреждение ветеринарии',
			'empty' => array(0 => '- Не выбрано -'),
			'required'=>false
		));
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
		<th>Название</th>
		<th>Рынок</th>
		<th>Адрес</th>
		<th>Телефон</th>
		<th></th>
	</tr>
	<?php foreach ($labs as $lab) {
		echo '<tr>
			<td>'.$this->Html->link($lab['Lab']['name'], array(
					'action' => 'edit', $lab['Lab']['id'])).'
			</td>
			<td>'.$lab['Lab']['market_name'].'</td>
			<td>'.$lab['Lab']['market_address'].'</td>
			<td>'.$lab['Lab']['phone'].'</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $lab['Lab']['id']),
					array(
						'escape'=>false
					)).'
			</td>
		</tr>';
	}?>
</table>

<?php echo $this->Paginator->pagination(array(
	'ul' => 'pagination pagination-sm'
)); ?>


<?php $this->start('script');?>
<?php

		$this->Js->get('#LabRegionId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Labs',
 				'action' =>'getByRegion',
 			), array(
 				'update' =>'#LabDistrictId',
 				'async' => true,
 				'method' => 'Post',
 				'dataExpression'=>true,
 				'data'=> $this->Js->serializeForm(array(
 					'isForm' => true,
 					'inline' => true
 				))
 			))
		);

		$this->Js->get('#LabRegionId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Labs',
 				'action' =>'getOrganByRegion',
 			), array(
 				'update' =>'#LabOrganId',
 				'async' => true,
 				'method' => 'Post',
 				'dataExpression'=>true,
 				'data'=> $this->Js->serializeForm(array(
 					'isForm' => true,
 					'inline' => true
 				))
 			))
		);

		$this->Js->get('#LabOrganId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Labs',
 				'action' =>'getByOrgan',
 			), array(
 				'update' =>'#LabInstitutionId',
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