
<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Виды выявлений', '/detection_types'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>Виды выявлений
			<span class="pull-right">
				<a class="collapsed btn btn-primary" data-toggle="collapse" href="#adds" aria-expanded="false" aria-controls="adds">Добавить</a>
			</span>
		</h2>
		<div id="adds" class="panel-collapse collapse" role="tabpanel">
			<?php echo $this->Form->create('DetectionType', array(
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
				'label' => 'Вид выявления',
				'placeholder' => 'Вид выявления',
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
		<th></th>
	</tr>
	<?php foreach ($detectionTypes as $detectionType) {
		echo '<tr>
			<td>'.$this->Html->link($detectionType['DetectionType']['name'], array(
					'action' => 'edit', $detectionType['DetectionType']['id'])).'
			</td>
			<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array(
					'action' => 'delete', $detectionType['DetectionType']['id']),
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