<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Регионы', '/regions'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>Регионы
			<span class="pull-right">
				<a class="collapsed btn btn-primary" data-toggle="collapse" href="#adds" aria-expanded="false" aria-controls="adds">Добавить</a>
			</span>
		</h2>
		<div id="adds" class="panel-collapse collapse" role="tabpanel">
			<?php echo $this->Form->create('Region', array(
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
				'label' => 'Название региона',
				'placeholder' => 'Введите название'
			));
			echo $this->Form->submit('Добавить', array(
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
	<?php
		foreach ($regions as $region) {
			echo '<tr>
				<td>'.$this->Html->link($region['Region']['name'], array('controller' => 'regions',
						'action' => 'edit', $region['Region']['id'])).'
				</td>
				<td>'.$this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array('controller' => 'regions',
						'action' => 'delete', $region['Region']['id']),
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