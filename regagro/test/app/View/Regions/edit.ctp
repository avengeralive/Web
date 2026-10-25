<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Регионы', '/regions'); ?>

<?php echo $this->Form->create('Region', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>

<legend><?php echo $title_for_layout ?>
	<span class="pull-right">
		<a class="collapsed btn btn-primary" data-toggle="collapse" href="#adds" aria-expanded="false" aria-controls="adds">Добавить район</a>
	</span>
</legend>

<?php 
	echo $this->Form->input('name', array(
	'label' => 'Название',
	));
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>

<div id="adds" class="panel-collapse collapse" role="tabpanel">
<?php 
	echo $this->Form->create('District', array(
		'action'=> 'add',
		'inputDefaults' => array(
			'div' => 'form-group',
			'label' => false,
			'wrapInput' => false,
			'class' => 'form-control'
		),
		'class' => 'well'
	));
	echo $this->Form->input('name', array(
		'label' => 'Название района',
		'placeholder' => 'Введите название',
		'div' => 'form-group'
	));
	echo $this->Form->input('region_id', array('value'=>$region['Region']['id'], 'type'=>'hidden'));
	echo $this->Form->submit('Добавить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>
</div>
<table class="table super">
	<tr>
		<th>Название</th>
		<th></th>
	</tr>
	<?php
		foreach ($region['District'] as $district) {
			echo '
			<tr>
				<td>'.$this->Html->link($district['name'], array('controller' => 'districts',
						'action' => 'edit', $district['id'])).'
				</td>
				<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array('controller' => 'districts',
						'action' => 'delete', $district['id']),
						array(
							'escape'=>false
						)).'
				</td>
			</tr>';
		}
	?>
</table>