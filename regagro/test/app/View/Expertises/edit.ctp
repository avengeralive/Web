<?php

/**
 * app/View/Expertises/edit.ctp
 *
 * Редактирование экспертизы.
 * Доступен для добавления - Сотрудник
 * Доступен для просмотра - Администратор учреждения
 *
 * Совместно с журналом, сохраняется 
 * в отдельной БД региона.
 *
 * Файл создан 31 марта 2019
 * 
 */

$this->Html->addCrumb('Журнал', '/registrations');
$this->Html->addCrumb('Редактирование экспертизы', ''); 

echo $this->Form->create('Expertise', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); 

?>

<legend><?php echo $title_for_layout ?></legend>

<?php
	echo $this->Form->input('registration_id', array('type' => 'hidden'));
	echo $this->Form->input('production_id', array('label' => 'Продукция', 'readonly' => $canOnlyEditSamples));
	echo $this->Form->input('manufacturer', array('label' => 'Изготовитель/маркировка', 'readonly' => $canOnlyEditSamples));
	echo $this->Form->input('count', array('label' => 'Количество экспертиз', 'readonly' => $canOnlyEditSamples));
	echo $this->Form->input('viscera', array(
		'label' 		=> 'Наличие внутренних органов', 
		'class' 		=> 'checkbox',
		'onclick' 	=> $canOnlyEditSamples ? 'return false;' : ''
	));
	echo $this->Form->input('thermal_state', array(
		'label'		=> 'Термическое состояние', 
		'type'		=> 'select', 
		'empty'		=> 'Не указано',
		'disabled'	=> $canOnlyEditSamples,
		'options' 	=> array(
			'парное' 		=> 'парное',
			'охлажденное' 	=> 'охлажденное',
			'замороженное' => 'замороженное',
			'остывшее' 		=> 'остывшее'
		)
	));
	echo $this->Form->input('domestic_weight', array(
		'label' 		=> 'Общий вес отечественной продукции в кг (объем в л, яйцо в шт.)',
		'readonly' 	=> $canOnlyEditSamples,
		'step' 		=> 0.01,
		'value' 		=> $this->Number->precision($expertise['Expertise']['domestic_weight'], 2),
		'default' 	=> 0
	));
	echo $this->Form->input('foreign_weight', array(
		'label' 		=> 'Общий вес зарубежной продукции в кг (объем в л, яйцо в шт.)',
		'readonly' 	=> $canOnlyEditSamples,
		'step' 		=> 0.01,
		'value' 		=> $this->Number->precision($expertise['Expertise']['foreign_weight'], 2),
		'default' 	=> 0
	));
	echo $this->Form->input('samples_weight', array(
		'label' 		=> 'Количество отработанного лабораторного материала',
		'readonly' 	=> $canOnlyEditSamples,
		'step' 		=> 0.01,
		'value' 		=> $this->Number->precision($expertise['Expertise']['samples_weight'], 2),
		'default' 	=> 0
	));
	echo $this->Form->input('Detection', array('label' => 'Выявления (болезни)','readonly' => $canOnlyEditSamples,'empty' => 'Не указано'));
	echo '<div class="row"><div class="col-md-6">';
	echo $this->Form->input('price', array(
		'label' 		=> 'Оказано платных услуг на сумму (руб.)',
		'readonly' 	=> $canOnlyEditSamples,
		'step' 		=> 0.01,
		'value' 		=> $this->Number->precision($expertise['Expertise']['price'], 2),
		'default' 	=> 0
	));
	echo '</div><div class="col-md-6">';
	echo $this->Form->input('check_number', array('label' => '№ чека (квитанции)', 'readonly' => $canOnlyEditSamples));
	echo '</div></div>';
	echo $this->Form->input('state_price', array(
		'label' 		=> 'Оказано услуг по госзаданию на сумму (руб.)',
		'readonly' 	=> $canOnlyEditSamples,
		'step' 		=> 0.01,
		'value' 		=> $this->Number->precision($expertise['Expertise']['state_price'], 2),
		'default' 	=> 0
	));
?>
		
<div class="panel panel-info">
	<div class="panel-heading" role="tab" id="conclusionHeadinng">
		<h4 class="panel-title">
			<a class="collapsed" data-toggle="collapse" href="#collapseConclusion" aria-expanded="false" aria-controls="collapseConclusion">
				Отбор проб и отправка на исследование для подтверждения
			</a>
		</h4>
	</div>
	<div id="collapseConclusion" class="panel-collapse collapse" role="tabpanel" aria-labelledby="conclusionHeadinng">
		<div class="panel-body">
			<?php
			echo $this->Form->input('samples_count', array('label' => 'Количество проб', 'placeholder' => '0'));
			echo $this->Form->input('conclusion_date', array(
				'label' 					=> 'Дата заключения',
				'id'						=> 'datetimepicker_conclusion_date',
				'type' 					=> 'text',
				'placeholder' 			=> '0000-00-00',
				'data-date-format' 	=> 'YYYY-MM-DD',
				'beforeInput' 			=> '<div class="input-group">',
				'afterInput' 			=> '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>'	
			));
			echo $this->Form->input('conclusion_number', array('label' => 'Номер заключения', 'placeholder' => '0'));
			echo $this->Form->input('conclusion', array('type' => 'radio',
				'legend'		=> 'Заключение',
				'options'	=> array(
						' ' 						=> 'Не указано',
						'Соответствует' 		=> 'Соответствует',
						'Не соттветствует' 	=> 'Не соттветствует'
				),
				'default'	=> ' '
			));
// 			echo $this->Form->input('conclusion_weight', array(
// 				'label' 			=> 'Выпущено без ограничений', 
// 				'step'			=> 0.01, 
// 				'value'			=> $this->Number->precision($expertise['Expertise']['conclusion_weight'], 2)
// 			));
			?>
		</div>
	</div>
</div>
		
<?php
	echo $this->Form->input('note', array(
		'label' => 'Примечание',
		'readonly'=>$canOnlyEditSamples,
		'type' => 'textarea',
		'placeholder' => 'Не указано',
		'escape' => false,
		'rows' => '4', 'cols' => '100'
	));
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>

<script type="text/javascript">
$(function() {

	$('form#ExpertiseEditForm').submit(function(event){
		if (!$('#DetectionDetection').val()) {
			if (!confirm('Вы не заполнили поле "Выявлено". Если при проведении ВСЭ Вами все же были выявлены болезни или несоответствия, то эти случаи не будут отражены в отчетных данных. Продолжить сохранение?')) { return false; }
		}
	});

	$('#datetimepicker_conclusion_date').datetimepicker({
		language: 'ru',
		pickTime: false,
		defaultDate: '<?php echo $expertise['Expertise']['conclusion_date']?>'
	});

	$('#ExpertiseProductionId').selectize({
		plugins: ['restore_on_backspace'],
		create: false,
		selectOnTab: true,
		onInitialize: function() {
			this.selected_value = this.getValue();
			if (<?=($canOnlyEditSamples ? 'true' : 'false')?>) {
				this.disable();
			}
		},
		onChange: function(value) {value=value==0?this.selected_value:value;this.selected_value=value;},
		onDropdownClose: function($dropdown) {
			if(this.getValue()==0) {
				this.setValue(this.selected_value );
			}
		}
	});

	$('#DetectionDetection').selectize({
		//plugins: ['restore_on_backspace'],
		create: false,
		persist: false,
		selectOnTab: true,
		onInitialize: function() {
			if (<?=($canOnlyEditSamples ? 'true' : 'false')?>) {
				this.lock();
			}
		}
		/*onInitialize: function() {this.selected_value = this.getValue();},
		onChange: function(value) {value=value==0?this.selected_value:value;this.selected_value=value;},
		onDropdownClose: function($dropdown) {
			if(!this.getValue()) {
				this.setValue(0);
			}
		}*/
	});
});
</script>
