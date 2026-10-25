
<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Убойные пункты', '/up'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>Убойные пункты
			<span class="pull-right">
				<a class="collapsed btn btn-primary" data-toggle="collapse" href="#adds" aria-expanded="false" aria-controls="adds">Поиск</a>
				<?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Добавить',
						array('controller'=>'up', 'action'=>'add'),
						array('escape'=>false, 'class'=>'btn btn-primary'))?>
			</span>
		</h2>
		<div id="adds" class="panel-collapse collapse" role="tabpanel">
		<?php echo $this->Form->create('Up', array(
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
		<th>Адрес</th>
		<th>Телефон</th>
		<th></th>
	</tr>
	<?php foreach ($ups as $up) {
		echo '<tr>
			<td>'.$this->Html->link($up['Up']['name'], array(
					'action' => 'edit', $up['Up']['id'])).'
			<strong>'.$this->Html->link($up['Institution']['name'], array('controller'=>'institutions',
					'action' => 'edit', $up['Institution']['id'])).'</strong>
			</td>
			<td>'.$up['Up']['address'].'</td>
			<td>'.$up['Up']['phone'].'</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $up['Up']['id']),
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

		$this->Js->get('#UpRegionId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Up',
 				'action' =>'getByRegion',
 			), array(
 				'update' =>'#UpDistrictId',
 				'async' => true,
 				'method' => 'Post',
 				'dataExpression'=>true,
 				'data'=> $this->Js->serializeForm(array(
 					'isForm' => true,
 					'inline' => true
 				))
 			))
		);

		$this->Js->get('#UpRegionId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Up',
 				'action' =>'getOrganByRegion',
 			), array(
 				'update' =>'#UpOrganId',
 				'async' => true,
 				'method' => 'Post',
 				'dataExpression'=>true,
 				'data'=> $this->Js->serializeForm(array(
 					'isForm' => true,
 					'inline' => true
 				))
 			))
		);

		$this->Js->get('#UpOrganId')->event('change',
 			$this->Js->request(array(
 				'controller'=>'Up',
 				'action' =>'getByOrgan',
 			), array(
 				'update' =>'#UpInstitutionId',
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