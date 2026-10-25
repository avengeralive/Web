<?php 

/**
 * app/View/Districts/add.ctp
 *
 * Справочник Регионов.
 * Доступен для добавления и редактирования - Администратор
 *
 * Совместно с журналом, сохраняется 
 * в отдельной БД региона.
 *
 * Файл создан 31 марта 2019
 * 
 */


$this->Html->addCrumb('Справочники', '/pages/lists');
$this->Html->addCrumb('Регионы', '/regions');

echo $this->Form->create('District', array(
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
	echo $this->Form->input('name', array(
		'label' => 'Название'
	));
	echo $this->Form->input('region_id', array(
		'label' => 'Регион'
	));
	echo $this->Form->submit('Сохранить', array(
		'div' => 'form-group',
		'class' => 'btn btn-primary'
	));
	echo $this->Form->end(); 
?>