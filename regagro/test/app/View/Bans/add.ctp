<?php $this->Html->addCrumb('Журнал', '/registrations'); ?>
<?php $this->Html->addCrumb('Добавление снятия с реализации', ''); ?>

<?php echo $this->Form->create('Ban', array(
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
	echo $this->Form->input('is_foreign', array('label'=>'Импортная продукция', 'div'=>'checkbox', 'class'=>'checkbox'));
	//echo $this->Form->input('production_id', array('label'=>'Продукция ('.$registration['ProductionType']['name'].')'));
	echo $this->Form->input('ban_type_id', array('type'=>'radio','legend'=>'Снятая продукция','required'=>false));
	echo $this->Form->input('weight', array('label'=>'Вес снятой продукции в кг (объем в л, яйцо в шт.)', 'step'=>0.01,'placeholder'=>'0'));
	echo $this->Form->input('ban_reason_id', array('label'=>'Причины', 'empty' => '- Не указано -'));
	echo $this->Form->input('note', array('label'=>'Примечание','placeholder'=>'Не указано'));
	echo $this->Form->input('use_order', array('type'=>'radio', 'legend'=>'Порядок использования', 'required'=>false, 'options' => array(
		'Возвращено владельцу'=>'Возвращено владельцу',
		'Обезвреживание'=>'Обезвреживание',
		'Утилизация'=>'Утилизация',
		'Уничтожение'=>'Уничтожение',
		'В корм животным'=>'В корм животным',
		'Денатурировано'=>'Денатурировано')
	));
	echo $this->Form->input('rules_item', array('label'=>'Пункт правил ВСЭ','placeholder'=>'Не указано'));
	echo $this->Form->submit('Сохранить', array('formnovalidate' => true,
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>


<script type="text/javascript">
	$(function () {
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

