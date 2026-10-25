<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Ветеринарные лаборатории', '/vetlabs'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>Ветеринарные лаборатории
			<span class="pull-right">
				<a class="collapsed btn btn-primary" data-toggle="collapse" href="#adds" aria-expanded="false" aria-controls="adds">Добавить</a>
			</span>
		</h2>
		<div id="adds" class="panel-collapse collapse" role="tabpanel">
			<?php echo $this->Form->create('Vetlab', array(
				'action'=> 'add',
				'inputDefaults' => array(
					'div' => 'form-group',
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
				'placeholder' => 'Не указано',
				'div' => 'form-group'
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
	<?php foreach ($vetlabs as $vetlab) {
		echo '<tr>
			<td>'.$this->Html->link($vetlab['Vetlab']['name'], array(
					'action' => 'edit', $vetlab['Vetlab']['id'])).'
			</td>
			<td>'.$vetlab['Organ']['name'].'</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $vetlab['Vetlab']['id']),
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

		$this->Js->get('#VetlabRegionId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Vetlabs',
 				'action' =>'getByRegion',
 			), array(
 				'update' =>'#VetlabDistrictId',
 				'async' => true,
 				'method' => 'Post',
 				'dataExpression'=>true,
 				'data'=> $this->Js->serializeForm(array(
 					'isForm' => true,
 					'inline' => true
 				))
 			))
		);

		$this->Js->get('#VetlabRegionId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Vetlabs',
 				'action' =>'getOrganByRegion',
 			), array(
 				'update' =>'#VetlabOrganId',
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