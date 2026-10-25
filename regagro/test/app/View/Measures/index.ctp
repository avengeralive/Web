<div class="row">
	<div class="col-md-4">
		<h4>Единицы измерения</h4>
	</div>
	<div class="col-md-8">
		<?php echo $this->Form->create('Measure', array(
			'action'=> 'add',
			'inputDefaults' => array(
				'div' => 'form-group',
				'label' => false,
				'wrapInput' => false,
				'class' => 'form-control'
			),
			'class' => 'form-inline text-right'
		)); ?>
				<?php 
				echo $this->Form->input('name', array(
					'placeholder' => 'Ед. измерения...',
					'div' => 'form-group'
				));?>
				
				<?php
				echo $this->Form->submit('Добавить', array(
					'div' => 'form-group',
					'class' => 'btn btn-primary'
				));?>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
<?php echo $this->Paginator->pagination(array(
	'ul' => 'pagination pagination-sm'
)); ?>
<table class="table">
	<tr>
		<th>Название</th>
		<th>Удалить</th>
	</tr>
	<?php
	foreach ($measures as $measure)
	{
		echo '
		<tr>
			<td>'.$this->Html->link($measure['Measure']['name'], array(
					'action' => 'edit', $measure['Measure']['id'])).'
			</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $measure['Measure']['id']),
					array(
						'escape'=>false
					)).'
			</td>
		</tr>';
	}
	?>
</table>
<?php echo $this->Paginator->pagination(array(
	'ul' => 'pagination pagination-sm'
)); ?>