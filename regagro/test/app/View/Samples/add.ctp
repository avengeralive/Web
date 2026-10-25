<?php $this->Html->addCrumb('Журнал', '/registrations'); ?>
<?php $this->Html->addCrumb('Добавление отбора проб', ''); ?>


<?php echo $this->Form->create('Sample', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>

<legend><?php echo $title_for_layout ?></legend>

<?php
		echo $this->Form->input('expertise_id', array('label'=>'Экспертиза'));
		//echo $this->Form->input('production_id', array('label'=>'Конкретная продукция ('.$registration['ProductionType']['name'].')'));
		$prod_options = array_combine(array_values($productions), array_values($productions));
		echo $this->Form->input('production', array('label'=>'Конкретная продукция', 'options'=>$prod_options));
		echo $this->Form->input('date', array('label'=>'Дата выработки', 'value'=>date_format(date_create($registration['Registration']['doc_date']),'d.m.Y')));
		echo $this->Form->input('receipt_date', array('label'=>'Дата поступления',
													'id'=> 'datetimepicker_receipt_date',
													'type'=>'text',
													'data-date-format'=>'YYYY-MM-DD',
													'readonly'=>false,
													'beforeInput' => '<div class="input-group">',
													'afterInput' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>'));
		echo $this->Form->input('total_weight', array('label'=>'Вес партии', 'step'=>0.01, 'placeholder'=> '0','required'=> 'required'));
		echo $this->Form->input('vetlab_id', array('label'=>'Проба направляется в'));
		echo $this->Form->input('doc', array('label'=>'Нормативный документ','placeholder' => 'Не указано'));
		echo $this->Form->input('count', array('label'=>'Количество проб','placeholder' => '0','required'=> 'required'));
		echo $this->Form->input('samples_weight', array('label'=>'Вес проб', 'step'=>0.01, 'placeholder'=> '0','required'=> 'required'));
		echo $this->Form->input('packages', array('label'=>'Сейф-пакет','placeholder' => '0'));
		echo $this->Form->input('gloves', array('label'=>'Перчатки одноразовые','placeholder' => '0'));
		echo $this->Form->input('bottles', array('label'=>'Бутылка пластиковая','placeholder' => '0'));
		echo $this->Form->input('containers', array('label'=>'Контейнер пластиковый','placeholder' => '0'));
		echo $this->Form->input('other', array('label'=>'Прочее','placeholder' => 'Не указано'));
		echo $this->Form->input('auto', array('label'=>'Пробег в км с указанием марки и г/н автомобиля','placeholder' => 'Не указано'));
		echo $this->Form->input('SampleSamplePurpose.sample_purpose_id', array('label'=>'Цель отбора проб',
                                                             'type' => 'select',
                                                             'multiple'=>'multiple', 'required'=> 'required', 'div' => 'form-group required'));
		echo $this->Form->input('repeated', array('label'=>'Для повторных исследований','div'=>'checkbox', 'class'=>'checkbox'));
		echo $this->Form->input('result', array('label'=>'Результат',
												'required'=> 'required',
												'div' => 'form-group required',
												'default' => 'отрицательный',
												'options'=>array('положительный'=>'положительный',
																 'отрицательный'=>'отрицательный')
												));
		echo $this->Form->input('mark', array('label'=>'Маркировка','placeholder' => 'Не указано'));
		echo $this->Form->input('control_sample', array('label'=>'Хранение контрольной пробы','placeholder' => 'Не указано'));
		echo $this->Form->input('package_type', array('label'=>'Вид упаковки','placeholder' => 'Не указано'));
		echo $this->Form->input('mark_number', array('label'=>'Номер печати, пломбы','placeholder' => 'Не указано'));
		echo $this->Form->submit('Сохранить', array(
			'div' => 'form-group',
			'class' => 'btn btn-primary'
		));
		echo $this->Form->end(); 

?>


<script type="text/javascript">
$(function () {

	$('#datetimepicker_receipt_date').datetimepicker({
		language: 'ru',
		pickTime: false,
		defaultDate: '<?php echo $registration['Registration']['date']?>',
		minDate:new Date().getFullYear()+'-01-01'
	});

	$('#SampleProduction').selectize({
		plugins: ['restore_on_backspace'],
		selectOnTab: true,
		create: true,
		addPrecedence:true,
		render: {
		    option_create: function(data, escape) {
		      return '<div class="create">Свой вариант: <strong>' + escape(data.input) + '</strong>&hellip;</div>';
		    }
	  	},
		onInitialize: function() {
			console.log(this.selected_value);
			this.selected_value = this.getValue();
		}
	});
	$('select').selectize({
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
});
</script>
