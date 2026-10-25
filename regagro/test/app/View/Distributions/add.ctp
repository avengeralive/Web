<?php $this->Html->addCrumb('Журнал', '/registrations'); ?>
<?php $this->Html->addCrumb('Добавление распределения продукции по точкам', ''); ?>

<div class="alert alert-warning alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
	<strong>Внимание!</strong> Не привысьте допустимый вес по выбранным экспертизам
	<table class="table table-condensed table-hover">
		<tr>
			<th>Экспертиза</th>
			<th>Макс. вес</th>
			<th>Распределено</th>
		</tr>
		<?php foreach ($expertises as $id=>$name) {
			echo '<tr>
				<td>'.$name.'</td>
				<td>'.$totals[$id]['conclusion_weight'].'</td>
				<td>'.(isset($distributed[$id])?$distributed[$id]['weight']:0).'</td>
			</tr>';
		} ?>
	</table>
</div>

<?php echo $this->Form->create('Distribution', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control',
		'label'=>false
	),
	'class' => 'well'
)); ?>

<legend><?php echo $title_for_layout ?></legend>
<?php echo $this->Form->input('distributor', array('label'=>'Торгующему','placeholder' => 'Не указано')); ?>
	
<div class="row">
	<div class="col-xs-1"></div>
	<div class="col-xs-2"><label>Экспертиза</label></div>
	<!--div class="col-xs-2">Продукция</div-->
	<div class="col-xs-3"><label>Количество туш (тушек, партий, т/мест)</label></div>
	<div class="col-xs-2"><label>Вес в кг (объем в л, яйцо в шт.)</label></div>
	<div class="col-xs-2"><label>Количество мест</label></div>
	<div class="col-xs-2"><label>Примечание</label></div>
</div>
	
<div class="row" id="formRow0">
	<?php echo $this->Form->input('0.distributor', array('type'=>'hidden'));?>
	<?php echo $this->Form->input('0.registration_id', array('type'=>'hidden', 'value'=>$registration['Registration']['id']));?>		
	<div class="col-xs-1">
		<button type="button" id="removeBtnRow0" class="btn btn-primary btn"><span class="glyphicon glyphicon-minus"></span></button>
	</div>	
	<div class="col-xs-2">
		<?php echo $this->Form->input('0.expertise_id', array());?>
	</div>
	<!--div class="col-xs-2">
		<?php //echo $this->Form->input('0.production_id', array());?>
	</div-->
	<div class="col-xs-3">
		<?php echo $this->Form->input('0.count', array('placeholder' => '0'));?>
	</div>
	<div class="col-xs-2">
		<?php echo $this->Form->input('0.weight', array('step' => 0.01, 'placeholder' => '0'));?>
	</div>
	<div class="col-xs-2">
		<?php echo $this->Form->input('0.places', array('placeholder' => '0'));?>
	</div>
	<div class="col-xs-2">
		<?php echo $this->Form->input('0.note', array('placeholder' => 'Не указано'));?>
	</div>
</div>
	
<div class="row" id="addRowRow">
	<div class="col-xs-12 text-center">
		<button type="button" id="addRow" class="btn btn-primary">Добавить</button>
	</div>
</div>

<?php echo $this->Form->submit('Сохранить', array(
	'div' => 'form-group',
	'class' => 'btn btn-primary'
));
echo $this->Form->end(); ?>

<script type="text/javascript">
	var currentRowsCount = 1;
	var formRowHtml = $('#formRow0').html();
	var notes = {
		<?php foreach ($expertises_notes as $id => $note):?>
		<?php echo $id?>:'<?php echo $note?>',
		<?php endforeach;?>
	}
	
	$(function () {
		$('#Distribution0ExpertiseId').change(function() {
			$('#Distribution0Note').val(notes[$(this).val()]);
		});
		$('#Distribution0ExpertiseId').change();
		$('#removeBtnRow0').click(function() {
			$('#formRow0').remove();
		});
		$('#addRow').unbind('click').click(function(evt){
			var rowHtml = formRowHtml.replace(/data\[Distribution\]\[0\]/g,'data[Distribution]['+currentRowsCount+']')
					.replace(/Distribution0/g,'Distribution'+currentRowsCount)
					.replace(/removeBtnRow0/g,'removeBtnRow'+currentRowsCount);
			var html = '<div class="row" id="formRow'+currentRowsCount+'">'+rowHtml+'</div>';
			$('#addRowRow').before(html);
			
			$('input[id$=Distributor]').val($('#DistributionDistributor').val());
			
			$('#removeBtnRow'+currentRowsCount).click(function() {
				$(this).parent().parent().remove();
			});
			var note = $('#Distribution'+currentRowsCount+'Note');
			$('#Distribution'+currentRowsCount+'ExpertiseId').change(function() {
				note.val(notes[$(this).val()]);
			});
			$('#Distribution'+currentRowsCount+'ExpertiseId').change();
			currentRowsCount++;
		});
		
		$('#DistributionDistributor').change(function(){
			$('input[id$=Distributor]').val($('#DistributionDistributor').val());
		});
	});
</script>
