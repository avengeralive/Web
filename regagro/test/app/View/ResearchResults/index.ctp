<div class="row">
	<div class="col-md-12">
		<h2>Результаты исследований</h2>
	</div>
	<div class="col-md-12">
		<?php echo $this->Form->create('ResearchResult', array(
			'action'=> 'add',
			'inputDefaults' => array(
				'div' => 'form-group',
				'label' => false,
				'wrapInput' => false,
				'class' => 'form-control'
			),
			'class' => 'well'
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
		<th></th>
	</tr>
	<?php
	foreach ($researchResults as $researchResult) {
		echo '
		<tr>
			<td>'.$this->Html->link($researchResult['ResearchResult']['name'], array(
					'action' => 'edit', $researchResult['ResearchResult']['id'])).'
			</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $researchResult['ResearchResult']['id']),
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