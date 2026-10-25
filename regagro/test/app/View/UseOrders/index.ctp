<div class="row">
	<div class="col-md-12">
		<h2>Порядок использования</h2>
	</div>
	<div class="col-md-12">
		<?php echo $this->Form->create('UseOrder', array(
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
				'label' => 'Название',
					'placeholder' => 'Название...',
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

<table class="table super">
	<tr>
		<th>Название</th>
		<th>Удалить</th>
	</tr>
	<?php 
	foreach ($useOrders as $useOrder) {
		echo '
		<tr>
			<td>'.$this->Html->link($useOrder['UseOrder']['name'], array(
					'action' => 'edit', $useOrder['UseOrder']['id'])).'
			</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $useOrder['UseOrder']['id']),
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