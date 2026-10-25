<?php $this->Html->addCrumb('Справочники', '/pages/lists'); ?>
<?php $this->Html->addCrumb('Органы управления ветеринарии', '/organs'); ?>

<?php echo $this->Form->create('Organ', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>

<legend><?php echo $title_for_layout ?><a class="btn btn-default" href="/organs"style="float: right;">Назад</a></legend>

<?php 
		echo $this->Form->input('region_id', array(
			'label' => 'Регион',
			'empty' => array(0 => '- Не выбрано -')
		));
	echo $this->Form->input('name', array('label'=>'Название'));
	echo $this->Form->input('order_type', array('label'=>'Распорядительный документ','options'=>array('приказ'=>'приказ','распоряжение'=>'распоряжение')));
	echo $this->Form->input('order_date', array('label'=>'Дата распорядительного документа',
		'id'=> 'datetimepicker_order_date',
		'type'=>'text',
		'data-date-format'=>'YYYY-MM-DD',
		'readonly'=>false,
		'beforeInput' => '<div class="input-group">',
		'afterInput' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>'));
	echo $this->Form->input('order_num', array('label'=>'Номер распорядительного документа'));
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>


<script type="text/javascript">
$(function () {
	$('#datetimepicker_order_date').datetimepicker({
		language: 'ru',
		pickTime: false,
		defaultDate: '<?php echo $organ['Organ']['order_date']?>'
	});
});
</script>