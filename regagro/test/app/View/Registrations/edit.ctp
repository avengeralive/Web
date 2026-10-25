<?php $this->Html->addCrumb('Журнал', '/registrations'); ?>
<?php $this->Html->addCrumb('Редактирование записи №'. $registration['Registration']['code'] .' от '. date_format(date_create($registration['Registration']['date']), 'd.m.Y H:i'), ''); ?>

<?php echo $this->Form->create('Registration', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>
		
<legend>Общие данные</legend>

<?php
	echo $this->Form->input('id', array());
	echo $this->Form->input('user_id', array('label'=>'Сотрудник', 'readonly'=>true));
	echo $this->Form->input('lab_id', array('label'=>'Лаборатория', 'readonly'=>true));
	echo $this->Form->input('production_type_id', array('label'=>'Вид продукции'));
	echo $this->Form->input('transport_condition', array('label'=>'Состояние транспорта','options'=>array('не указано'=>'не указано','удовлетворительное'=>'удовлетворительное', 'неудовлетворительное'=>'неудовлетворительное')));
?>

<legend>Сопроводительный документ</legend>
<?php
	echo $this->Form->input('doc_form', array('label'=>'Название','options'=>array('не указано'=>'не указано', 'ВСД ф.№2'=>'ВСД ф.№2', 'ВСД ф.№3'=>'ВСД ф.№3', 'ВСД ф.№4'=>'ВСД ф.№4', 'Накладная'=>'Накладная')));
	echo $this->Form->input('doc_num', array('label'=>'Номер', 'placeholder' => '0'));
	echo '<div class="form-group"><label for="RegistrationDate">Дата</label><div class="input-group">
	<input placeholder="0000-00-00" type="text" id="doc_date" name="data[Registration][doc_date]" class="form-control" data-date-format="YYYY-MM-DD" readonly>
	<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div></div>';
?>

<legend>Данные о происхождении продукции</legend>
<?php
	echo $this->Form->input('owner', array('label'=>'Владелец', 'placeholder' => 'Не указан'));
	echo $this->Form->input('region_id', array('label'=>'Регион'));
	echo $this->Form->input('district_id', array('label'=>'Район', 'placeholder' => 'Не указан'));
	echo $this->Form->input('locality', array('label'=>'Населенный пункт', 'placeholder' => 'Не указан'));
		echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 		
?>



<script type="text/javascript">
$(function () {
	$('#doc_date').datetimepicker({
		language: 'ru',
		pickTime: false,
		defaultDate: '<?php echo $registration['Registration']['doc_date']?>'//new Date()
	});

	var xhr;
	var select_region, $select_region;
	var select_district, $select_district;

	$select_region = $('#RegistrationRegionId').selectize({
		plugins: ['restore_on_backspace'],
		create: false,
		selectOnTab: true,
		onInitialize: function() {this.selected_value = this.getValue();},
		onDropdownClose: function($dropdown) {
			if(this.getValue()==0) {
				this.setValue(this.selected_value );
			}
		},
		onChange: function(value) {
			value=value==0?this.selected_value:value;this.selected_value=value;
			if (!value.length) return;
			select_district.disable();
			select_district.clearOptions();
			select_district.load(function(callback) {
				xhr && xhr.abort();
				xhr = $.ajax({
					type: 'post',
					data: 'data[region_id]='+select_region.selected_value,
					url: '<?php echo $this->Html->url(array('controller'=>'districts','action'=>'getByRegion', 'ext'=>'json'));?>',
					success: function(results) {
						select_district.enable();
						callback(results);
					},
					error: function() {
						callback();
					}
				})
			});
		}
	});

	$select_district = $('#RegistrationDistrictId').selectize({
		valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
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
	
	select_district  = $select_district[0].selectize;
	select_region = $select_region[0].selectize;

	//select_district.disable();
	$('#RegistrationProductionTypeId').change();
});


</script>
