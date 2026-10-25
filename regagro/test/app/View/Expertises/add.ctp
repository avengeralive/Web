<?php 
/**
 * app/View/Expertises/edit.ctp
 *
 * Добавление экспертизы.
 * Доступен для добавления и редактирования - Сотрудник
 *
 * Совместно с журналом, сохраняется 
 * в отдельной БД региона.
 *
 * Файл создан 31 марта 2019
 * 
 */

$this->Html->addCrumb('Журнал', '/registrations'); 
$this->Html->addCrumb('Добавление экспертизы', ''); 

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
	echo $this->Form->input('production_id', array('label' => 'Продукция ('.$registration['ProductionType']['name'].')','empty' => '- Не указано -'));
	echo $this->Form->input('manufacturer', array('label' => 'Изготовитель/маркировка','placeholder' => 'Не указано'));
	echo $this->Form->input('count', array('label' => 'Количество экспертиз','placeholder' => '0'));
	echo $this->Form->input('viscera', array('label' => 'Наличие внутренних органов','div' => 'checkbox', 'class' => 'checkbox'));
	echo $this->Form->input('thermal_state', array(
		'label' 				=> 'Термическое состояние', 
		'type' 				=> 'select', 
		'empty' 				=> '- Не указано -', 
		'options'			=>	array(
			'парное' 				=> 'парное', 
			'охлажденное' 			=> 'охлажденное', 
			'замороженное' 		=> 'замороженное', 
			'остывшее' 				=> 'остывшее'
		)
	));
	echo $this->Form->input('domestic_weight', array('label' => 'Общий вес отечественной продукции в кг (объем в л, яйцо в шт.)', 'step' => 0.01, 'placeholder' => 0));
	echo $this->Form->input('foreign_weight', array('label' => 'Общий вес зарубежной продукции в кг (объем в л, яйцо в шт.)', 'step' => 0.01, 'placeholder' => 0));
	echo $this->Form->input('samples_weight', array('label' => 'Количество отработанного лабораторного материала', 'step' => 0.01, 'placeholder' => 0));
	echo $this->Form->input('Detection', array('label' => 'Выявления (болезни)','empty' => '- Не указано -'));
	echo '<div class="row"><div class="col-md-6">';
	echo $this->Form->input('price', array('label' => 'Оказано платных услуг на сумму (руб.)','step' => 0.01, 'placeholder' => 0));
	echo '</div><div class="col-md-6">';
	echo $this->Form->input('check_number', array('label' => '№ чека (квитанции)','placeholder' => '0'));
	echo '</div></div>';
	echo $this->Form->input('state_price', array('label' => 'Оказано услуг по госзаданию на сумму (руб.)', 'step' => 0.01, 'placeholder' => 0));
?>

<div class="panel panel-info">
	<div class="panel-heading" role="tab" id="conclusionHeadinng">
		<h4 class="panel-title">
			<a class="collapsed" data-toggle="collapse" href="#collapseConclusion">Отбор проб и отправка на исследование для подтверждения</a>
		</h4>
	</div>
	<div id="collapseConclusion" class="panel-collapse collapse" role="tabpanel" aria-labelledby="conclusionHeadinng">
		<div class="panel-body">
			<?php 
				echo $this->Form->input('samples_count', array('label' => 'Количество проб','placeholder' => 'Не указано'));
				echo $this->Form->input('conclusion_date', array(
					'label' 					=> 'Дата заключения', 
					'id'						=> 'datetimepicker_conclusion_date',
					'type' 					=> 'text',
					'placeholder' 			=> '0000-00-00',
					'data-date-format' 	=> 'YYYY-MM-DD',
					'beforeInput' 			=> '<div class="input-group">',
					'afterInput' 			=> '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>'
				));
				echo $this->Form->input('conclusion_number', array('label' => 'Номер заключения','placeholder' => '0'));
				echo $this->Form->input('conclusion', array(
					'type' 		=> 'radio',
					'legend' 	=> 'Заключение',
					'options' 	=> array(
						' ' 						=> 'не указано',
						'Соответствует' 		=> 'Соответствует', 
						'Не соттветствует' 	=> 'Не соттветствует'
					),
					'default' => ' '
				));
				//echo $this->Form->input('conclusion_weight', array('label' => 'Выпущено без ограничений', 'step'=>0.01));
			?>
		</div>
	</div>
</div>

<?php
	echo $this->Form->input('note', array(
		'label' 				=> 'Примечание',
		'type' 				=> 'textarea', 
		'escape' 			=> false,
		'rows' 				=> '4', 
		'cols' 				=> '100',
		'placeholder' 		=> 'Не указано'
	));
	echo $this->Form->submit('Сохранить', array(
		'formnovalidate' 	=> true,
		'div' 				=> 'form-group',
		'class' 				=> 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>


<script type="text/javascript">
$(function () {

	$('form#ExpertiseEditForm').submit(function(event){
		if (!$('#DetectionDetection').val()) {
        	if (!confirm('Вы не заполнили поле "Выявлено". Если при проведении ВСЭ Вами все же были выявлены болезни или несоответствия, то эти случаи не будут отражены в отчетных данных. Продолжить сохранение?')) { return false; }
    	}
    });

	$('#datetimepicker_conclusion_date').datetimepicker({
		language: 'ru',
		pickTime: false
		//defaultDate: new Date()
	});
	
	$('#ExpertiseProductionId').selectize({
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
	
// 	$('#DetectionDetection').selectize({
// 		//plugins: ['restore_on_backspace'],
// 		create: false,
// 		persist: false,
// 		selectOnTab: true,
// 		/*onInitialize: function() {this.selected_value = this.getValue();},
// 		onChange: function(value) {value=value==0?this.selected_value:value;this.selected_value=value;},
// 		onDropdownClose: function($dropdown) { 
// 			if(!this.getValue()) {
// 				this.setValue(0); 
// 			}
// 		}*/
// 	});

	$('#DetectionDetection').selectize({
		//plugins: ['restore_on_backspace'],
		create: false,
		persist: false,
		selectOnTab: true,
		/*onInitialize: function() {
		    if (<?=($canOnlyEditSamples ? 'true' : 'false')?>) {
                this.lock();
            }
		}*/
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
