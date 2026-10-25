<div class="row">
	<div class="col-md-12">
		<h2>Заключения</h2>
	</div>
	<div class="col-md-12">
		<?php echo $this->Form->create('Conclusion', array(
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
		<th></th>
	</tr>
	<?php
	foreach ($conclusions as $conclusion) {
		echo '
		<tr>
			<td>'.$this->Html->link($conclusion['Conclusion']['name'], array(
					'action' => 'edit', $conclusion['Conclusion']['id'])).'
			</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $conclusion['Conclusion']['id']),
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