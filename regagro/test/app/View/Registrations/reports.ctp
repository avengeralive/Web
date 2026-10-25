
<?php $this->Html->addCrumb('Отчеты', '/registrations/reports'); ?>

<div class="row">
<div class="col-md-12">
		<h2>Отчеты</h2>
	</div>
<div class="col-md-12">
<?php echo $this->Form->create('Report', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>
	<fieldset>
	<?php if (AuthComponent::user('role') == 'Администратор'
		|| (AuthComponent::user('organ_id') && AuthComponent::user('organ_id') != 0)
		|| (AuthComponent::user('institution_id') && AuthComponent::user('institution_id') != 0)) {
		echo $this->Form->input('institution_id', array('label'=>'Учреждение ветеринарии', 'div'=>'col-sm-5'));
		echo $this->Form->input('lab_id', array('label'=>'Лаборатория', 'div'=>'col-sm-3'));
	}
	echo $this->Form->input('date_from', array( 'label'=>'Дата от',
												'id'=> 'datetimepicker_date_from',
												'type'=>'text',
												'data-date-format'=>'YYYY-MM-DD',
												'div'=>'col-sm-2',
												'beforeInput' => '<div class="input-group">',
												'afterInput' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>'
											));
	echo $this->Form->input('date_to', array(   'label'=>'Дата до',
												'id'=> 'datetimepicker_date_to',
												'type'=>'text',
												'data-date-format'=>'YYYY-MM-DD',
												'div'=>'col-sm-2',
												'beforeInput' => '<div class="input-group">',
												'afterInput' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>'
											));
	echo $this->Form->submit('Сформировать', array(
			'div' => 'form-group col-sm-10',
			'class' => 'btn btn-primary',
			'style' => 'margin: 15px 0 0'
		));
	echo $this->Form->end(); ?>
	</fieldset>

</div>
</div>
<div class="row">
	<?php
	if(isset($data)) {
	?>
	<div class="col-md-12">
		<h3>5-ВЕТ</h3>
	  <div class="well">
	<?php
		$institution_id = isset($data['Report']['institution_id'])?$data['Report']['institution_id']:'all';
		echo $this->Html->link('ОТЧЕТ 5-ВЕТ',
			array('controller'=>'registrations',
				  'action'=>'vet5_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('Приложение 1: РАСШИФРОВКА ГРАФ «ДРУГИЕ ВИДЫ» РАЗДЕЛА III ОТЧЕТА 5-ВЕТ',
			array('controller'=>'registrations',
				  'action'=>'vet5_1_doc',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('Приложение 2: РАСШИФРОВКА ИНФОРМАЦИИ О КОЛИЧЕСТВЕ И РЕЗУЛЬТАТАХ ПРОВЕДЕННЫХ ИССЛЕДОВАНИЙ РАЗДЕЛА III ОТЧЕТА 5-ВЕТ',
			array('controller'=>'registrations',
				  'action'=>'vet5_2_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('Приложение 3: РАСШИФРОВКА ИНФОРМАЦИИ О ВЫЯВЛЕННЫХ БОЛЕЗНЯХ РАЗДЕЛА III ОТЧЕТА 5-ВЕТ',
			array('controller'=>'registrations',
				  'action'=>'vet5_3_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('Приложение 4: РАСШИФРОВКА ИНФОРМАЦИИ О СНЯТОЙ С РЕАЛИЗАЦИИ ПРОДУКЦИИ РАЗДЕЛА III ОТЧЕТА 5-ВЕТ',
			array('controller'=>'registrations',
				  'action'=>'vet5_4_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('Приложение 5: РАСШИФРОВКА ГРАФЫ «ДРУГИЕ ПИЩЕВЫЕ ПРОДУКТЫ» РАЗДЕЛА IV ОТЧЕТА 5-ВЕТ',
			array('controller'=>'registrations',
				  'action'=>'vet5_5_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('Приложение 6: РАСШИФРОВКА ИНФОРМАЦИИ О ПРОВЕДЕННЫХ ИССЛЕДОВАНИЯХ РАЗДЕЛА IV ОТЧЕТА 5-ВЕТ',
			array('controller'=>'registrations',
				  'action'=>'vet5_6_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('Приложение 7: ИНФОРМАЦИЯ О ВЫЯВЛЕННЫХ БОЛЕЗНЯХ И НЕСООТВЕТСТВИЯХ РАЗДЕЛА IV ОТЧЕТА 5-ВЕТ',
			array('controller'=>'registrations',
				  'action'=>'vet5_7_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('Приложение 8: РАСШИФРОВКА ИНФОРМАЦИИ О СНЯТОЙ С РЕАЛИЗАЦИИ ПРОДУКЦИИ РАЗДЕЛА IV ОТЧЕТА 5-ВЕТ',
			array('controller'=>'registrations',
				  'action'=>'vet5_8_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		  ?>
		</div>
	</div>
	<div class="col-md-12">
			<h3>Аналитические отчеты</h3>
	  <div class="well">
		<?php
		echo $this->Html->link('1. ИНФОРМАЦИЯ О ВЫЯВЛЕННЫХ БОЛЕЗНЯХ И НЕСООТВЕТСТВИЯХ ТРЕБОВАНЯМ КАЧЕСТВА И БЕЗОПАСНОСТИ',
			array('controller'=>'registrations',
				  'action'=>'i_index_1_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('2. ИНФОРМАЦИЯ О ПРОВЕДЕННЫХ ИССЛЕДОВАНИЯХ',
			array('controller'=>'registrations',
				  'action'=>'i_index_2_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('3. ИНФОРМАЦИЯ О СНЯТОЙ С РЕАЛИЗАЦИИ ПРОДУКЦИИ',
			array('controller'=>'registrations',
				  'action'=>'i_index_3_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('4. ИНФОРМАЦИЯ О РЕГИОНАХ ПОСТАВЩИКАХ ПРОДУКЦИИ',
			array('controller'=>'registrations',
				  'action'=>'i_index_4_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('5. ИНФОРМАЦИЯ О КОЛИЧЕСТВЕ НАПРАВЛЕННЫХ ПРОБ НА ИССЛЕДОВАНИЯ',
			array('controller'=>'registrations',
				  'action'=>'i_index_5_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('6. СРАВНИТЕЛЬНЫЕ ДАННЫЕ ПО РЕЗУЛЬТАТАМ ПРОВЕДЕНИЯ ЭКСПЕРТИЗЫ СОТРУДНИКАМИ ЛАБОРАТОРИИ',
			array('controller'=>'registrations',
				  'action'=>'i_index_6_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('7. СРАВНИТЕЛЬНЫЕ ДАННЫЕ ПО РЕЗУЛЬТАТАМ ПРОВЕДЕНИЯ ИССЛЕДОВАНИЙ СОТРУДНИКАМИ ЛАБОРАТОРИИ',
			array('controller'=>'registrations',
				  'action'=>'i_index_7_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('8. СРАВНИТЕЛЬНЫЕ ДАННЫЕ ПО КОЛИЧЕСТВУ СНЯТОЙ С РЕАЛИЗАЦИИ ПРОДУКЦИИ СОТРУДНИКАМИ ЛАБОРАТОРИИ',
			array('controller'=>'registrations',
				  'action'=>'i_index_8_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('9. ИНФОРМАЦИЯ о количестве поступившей подконтрольной продукции',
			array('controller'=>'registrations',
				  'action'=>'i_index_9_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('10. ИНФОРМАЦИЯ о количестве и результатах направленных на исследования проб',
			array('controller'=>'registrations',
				  'action'=>'i_index_10_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('11. ИНФОРМАЦИЯ О КОЛИЧЕСТВЕ ДЕНАТУРИРОВАННОЙ ПРОДУКЦИИ',
			array('controller'=>'registrations',
				  'action'=>'i_index_11_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		?><br/><?php
		echo $this->Html->link('12. ИНФОРМАЦИЯ О ПРОДУКЦИИ ПО РЕГИОНАМ ПОСТАВЩИКАМ',
			array('controller'=>'registrations',
				  'action'=>'i_index_12_xml',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
      ?><br/><?php
  		echo $this->Html->link('13. ИНФОРМАЦИЯ о количестве повторных исследований',
  			array('controller'=>'registrations',
  				  'action'=>'i_index_13_xml',
  				  $institution_id,
  				  $data['Report']['lab_id'],
  				  $data['Report']['date_from'],
  				  $data['Report']['date_to']));
  		?><br/><?php
  		echo $this->Html->link('14. РАСШИФРОВКА ВЫЯВЛЕННЫХ СЛУЧАЕВ БОЛЕЗНЕЙ И НЕСООТВЕТСТВИЙ ТРЕБОВАНИЯМ КАЧЕСТВА И БЕЗОПАСНОСТИ',
  			array('controller'=>'registrations',
  				  'action'=>'i_index_14_xml',
  				  $institution_id,
  				  $data['Report']['lab_id'],
  				  $data['Report']['date_from'],
  				  $data['Report']['date_to']));
  		?><br/>
		</div>
	</div>
	<div class="col-md-12">
			<h3>Прочие сводные отчеты</h3>
	  <div class="well">
		<?php
		echo $this->Html->link('СВОДНЫЕ ДАННЫЕ ПО КОЛИЧЕСТВУ ЭКСПЕРТИЗ И СУММЕ ОКАЗАННЫХ УСЛУГ',
			array('controller'=>'registrations',
				  'action'=>'expertises_prices',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		  ?>
		</div>
	</div>
	<div class="col-md-12">
			<h3>Проверочные отчеты</h3>
	  <div class="well">
		<?if ($data['Report']['lab_id']=='all') {?>
			Проверочные отчеты работают только для конкретной лаборатории
		<?} else {?>
		<?php
		echo $this->Html->link('1. ПРОВЕРОЧНЫЙ ОТЧЕТ ПО КОЛИЧЕСТВУ ЭКСПЕРТИЗ И СУММЕ',
			array('controller'=>'registrations',
				  'action'=>'check_1',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		  ?><br/>
		<?php
		echo $this->Html->link('2. ПРОВЕРОЧНЫЙ ОТЧЕТ ПО СЛУЧАЯМ ВЫЯВЛЕНИЯ',
			array('controller'=>'registrations',
				  'action'=>'check_2',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		  ?><br/>
		<?php
		echo $this->Html->link('3. ПРОВЕРОЧНЫЙ ОТЧЕТ ПО РЕЗУЛЬТАТАМ ИССЛЕДОВАНИЙ',
			array('controller'=>'registrations',
				  'action'=>'check_3',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		  ?><br/>
		<?php
		echo $this->Html->link('4. ПРОВЕРОЧНЫЙ ОТЧЕТ ПО СНЯТОЙ ПРОДУКЦИИ',
			array('controller'=>'registrations',
				  'action'=>'check_4',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		  ?><br/>
		<?php
		echo $this->Html->link('5. ПРОВЕРОЧНЫЙ ОТЧЕТ ПО ОТБОРУ ПРОБ',
			array('controller'=>'registrations',
				  'action'=>'check_5',
				  $institution_id,
				  $data['Report']['lab_id'],
				  $data['Report']['date_from'],
				  $data['Report']['date_to']));
		  }?>
		</div>
	</div>
	<?
	}
	?>
</div>

<script type="text/javascript">
$(function () {

	$('#datetimepicker_date_from').datetimepicker({
		language: 'ru',
		pickTime: false,
		//defaultDate: ''
	});
	$('#datetimepicker_date_to').datetimepicker({
		language: 'ru',
		pickTime: false,
		//defaultDate: ''
	});

	var xhr;
	var select_institution, $select_institution;
	var select_lab, $select_lab;

	$select_institution = $('#ReportInstitutionId').selectize({
		plugins: ['restore_on_backspace'],
		create: false,
		selectOnTab: true,
		onInitialize: function() {this.selected_value = this.getValue();},
		onDropdownClose: function($dropdown) {
			if(this.getValue()=='') {
				this.setValue(this.selected_value );
			}
		},
		sortField: [[]],
		onChange: function(value) {
			value=value==''?this.selected_value:value;this.selected_value=value;
			if (!value.length) return;
			select_lab.disable();
			select_lab.clearOptions();
			select_lab.load(function(callback) {
				xhr && xhr.abort();
				xhr = $.ajax({
					type: 'post',
					data: 'data[institution_id]='+select_institution.selected_value,
					url: '<?php echo $this->Html->url(array('controller'=>'labs','action'=>'getByInstitution', 'ext'=>'json'));?>',
					success: function(results) {
						select_lab.enable();
						callback(results);
						select_lab.setValue('all');
					},
					error: function() {
						callback();
					}
				})
			});
		}
	});

	$select_lab = $('#ReportLabId').selectize({
		valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
		plugins: ['restore_on_backspace'],
		create: false,
		selectOnTab: true,
		sortField: [[]],
		onInitialize: function() {this.selected_value = 'all';},//this.getValue();},
		onChange: function(value) {
			value=value==''?'all':value;
			value=value=='all'?this.selected_value:value;
			this.selected_value=value;
		},
		onDropdownClose: function($dropdown) {
			if(this.getValue()=='') {
				this.setValue('all');
			}
		}
	});

	select_lab  = $select_lab[0].selectize;
	select_institution = $select_institution[0].selectize;

	//select_lab.disable();

});
</script>

