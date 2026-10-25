<div class="row">
	<div class="col-md-4">
		<h4>Должности</h4>
	</div>
	<div class="col-md-8">
		<?php echo $this->Form->create('Job', array(
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
			'placeholder' => 'Название...',
			'div' => 'form-group'
		));
		echo $this->Form->submit('Добавить', array(
			'div' => 'form-group',
			'class' => 'btn btn-primary'
		));
		echo $this->Form->end(); ?>
	</div>
</div>

<table class="table">
	<tr>
		<th>Название</th>
		<th></th>
	</tr>
	<?php foreach ($jobs as $job) {
		echo '<tr>
			<td>'.$this->Html->link($job['Job']['name'], array(
					'action' => 'edit', $job['Job']['id'])).'
			</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $job['Job']['id']),
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