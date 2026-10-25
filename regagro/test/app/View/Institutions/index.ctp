
<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Учреждения ветеринарии', '/institutions'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>Учреждения ветеринарии
			<span class="pull-right">
				<a class="collapsed btn btn-primary" data-toggle="collapse" href="#adds" aria-expanded="false" aria-controls="adds">Добавить</a>
			</span>
		</h2>
		<div id="adds" class="panel-collapse collapse" role="tabpanel">
			<?php echo $this->Form->create('Institution', array(
				'action'=> 'add',
				'inputDefaults' => array(
					'div' => 'form-group',
					'label' => false,
					'wrapInput' => false,
					'class' => 'form-control'
				),
				'class' => 'well'
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
				'label' => 'Орган управления',
				'div' => 'form-group',
				'empty' => array(0 => '- Не выбрано -')
			));
			echo $this->Form->input('name', array(
				'label' => 'Название',
				'placeholder' => 'Введите название',
				'div' => 'form-group',
			));
			echo $this->Form->submit('Добавить', array(
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
		<th>Орган управления</th>
		<th></th>
	</tr>
	<?php foreach ($institutions as $ins) {
		echo '<tr>
			<td>'.$this->Html->link($ins['Institution']['name'], array(
					'action' => 'edit', $ins['Institution']['id'])).'
			</td>
			<td>'.$ins['Organ']['name'].'</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $ins['Institution']['id']),
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

		$this->Js->get('#InstitutionRegionId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Institutions',
 				'action' =>'getByRegion',
 			), array(
 				'update' =>'#InstitutionDistrictId',
 				'async' => true,
 				'method' => 'Post',
 				'dataExpression'=>true,
 				'data'=> $this->Js->serializeForm(array(
 					'isForm' => true,
 					'inline' => true
 				))
 			))
		);

		$this->Js->get('#InstitutionRegionId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Institutions',
 				'action' =>'getOrganByRegion',
 			), array(
 				'update' =>'#InstitutionOrganId',
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