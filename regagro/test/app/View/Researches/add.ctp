<?php $this->Html->addCrumb('Журнал', '/registrations'); ?>
<?php $this->Html->addCrumb('Добавление исследования', ''); ?>

<?php
 echo $this->Form->create('Research', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'label' => false,
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>

<legend><?php echo $title_for_layout ?></legend>

<?php echo $this->Form->input('expertise_id', array('label'=>'Экспертиза'));?>
<?php //echo $this->Form->input('production_id', array('label'=>'Продукция ('.$registration['ProductionType']['name'].')'));?>

<div class="row">
	<div class="col-xs-1"></div>
	<div class="col-xs-3"><label>Вид исследования</label></div>
	<div class="col-xs-2"><label>Количество исследований</label></div>
	<div class="col-xs-2"><label>Результат исследований</label></div>
	<div class="col-xs-2"><label>Показатели/Примечание</label></div>
	<div class="col-xs-2"><label>Подтверждение лаборатории</label></div>
</div>

<div class="row" id="formRow0">
	<?php echo $this->Form->input('0.expertise_id', array('type'=>'hidden'));?>
	<?php echo $this->Form->input('0.production_id', array('type'=>'hidden'));?>
	<?php echo $this->Form->input('0.registration_id', array('type'=>'hidden', 'value'=>$registration['Registration']['id']));?>
	
	<div class="col-xs-1"><button type="button" id="removeBtnRow0" class="btn btn-primary btn"><span class="glyphicon glyphicon-minus"></span></button></div>	
	<div class="col-xs-3"><?php echo $this->Form->input('0.research_type_id', array('empty'=>'Выберите вид исследования'));?></div>
	<div class="col-xs-2"><?php echo $this->Form->input('0.count', array('placeholder'=>'0'));?></div>
	<div class="col-xs-2"><?php echo $this->Form->input('0.research_result', array(
			'options' => array(/*'"Отрицательный"'=>'"Отрицательный"', 
			'"Положительный"'=>'"Положительный"', */
			'Удовлетворительный'=>'Удовлетворительный',
			'Неудовлетворительный'=>'Неудовлетворительный')
		));?>
	</div>
	<div class="col-xs-2"><?php echo $this->Form->input('0.indicators', array('placeholder'=>'Не указано'));?></div>
	<div class="col-xs-2"><?php echo $this->Form->input('0.confirmed', array('div'=>'checkbox', 'class'=>'checkbox', 'style' => 'margin: auto;'));?></div>
</div>

<div class="row" id="addRowRow">
	<div class="col-xs-12 text-center">
		<button type="button" id="addRow" class="btn btn-primary">Добавить исследование</button>
	</div>
</div>

<?php echo $this->Form->submit('Сохранить', array(
	'div' => 'form-group',
	'class' => 'btn btn-primary'
));
echo $this->Form->end();?>

<script type="text/javascript">
	var currentRowsCount = 1;
	var formRowHtml = $('#formRow0').html();
	$(function () {
		$('#ResearchProductionId').selectize({
			plugins: ['restore_on_backspace'],
			create: false,
			selectOnTab: true,
			onInitialize: function() {
				this.selected_value = this.getValue();
				$('input[id$=ProductionId]').val(this.selected_value);
			},
			onChange: function(value) {
				value=value==0?this.selected_value:value;
				this.selected_value=value;
				$('input[id$=ProductionId]').val(value);
			},
			onDropdownClose: function($dropdown) { 
				if(this.getValue()==0) {
					this.setValue(this.selected_value ); 
				}
			}
		});	
		
		$('#ResearchExpertiseId').selectize({
			plugins: ['restore_on_backspace'],
			create: false,
			selectOnTab: true,
			onInitialize: function() {
				this.selected_value = this.getValue();
				$('input[id$=ExpertiseId]').val(this.selected_value);
			},
			onChange: function(value) {
				value=value==0?this.selected_value:value;
				this.selected_value=value;
				$('input[id$=ExpertiseId]').val(value);
			},
			onDropdownClose: function($dropdown) { 
				if(this.getValue()==0) {
					this.setValue(this.selected_value ); 
				}
			}
		});	
		
		$('#Research0ResearchTypeId').selectize({
			plugins: ['restore_on_backspace'],
			create: false,
			selectOnTab: true,
			onInitialize: function() {this.selected_value = this.getValue();},
			onChange: function(value) {value=value==0?this.selected_value:value;this.selected_value=value;},
			onDropdownClose: function($dropdown) { 
				if(this.getValue()==0) {
					this.setValue(this.selected_value ); 
				}
			}
		});	
	
		$('#removeBtnRow0').click(function() {
			$('#formRow0').remove();
		});
	
		$('#addRow').unbind('click').click(function(evt){
			var rowHtml = formRowHtml.replace(/data\[Research\]\[0\]/g,'data[Research]['+currentRowsCount+']')
									 .replace(/Research0/g,'Research'+currentRowsCount)
									 .replace(/removeBtnRow0/g,'removeBtnRow'+currentRowsCount);
			var html = '<div class="row" id="formRow'+currentRowsCount+'">'+rowHtml+'</div>';
			$('#addRowRow').before(html);
			
			$('#Research'+currentRowsCount+'ResearchTypeId').selectize({
				plugins: ['restore_on_backspace'],
				create: false,
				selectOnTab: true,
				onInitialize: function() {this.selected_value = this.getValue();},
				onChange: function(value) {value=value==0?this.selected_value:value;this.selected_value=value;},
				onDropdownClose: function($dropdown) { 
					if(this.getValue()==0) {
						this.setValue(this.selected_value ); 
					}
				}
			});
			$('input[id$=ProductionId]').val($('#ResearchProductionId').val());
			$('input[id$=ExpertiseId]').val($('#ResearchExpertiseId').val());
			$('#removeBtnRow'+currentRowsCount).click(function() {
				$(this).parent().parent().remove();
			});
			currentRowsCount++;
		});		
	});
</script>
