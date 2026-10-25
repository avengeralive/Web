<?php
// app/Model/ResearchType.php
App::uses('AppModel', 'Model');

class ResearchType extends AppModel {

   public $name = 'ResearchType';
	public $dynamicDb = false;
	public $belongsTo = 'ReportResearch';
	public $hasAndBelongsToMany  = array('ProductionType' => array(
		'joinTable' => 'research_types_production_types',
		'foreignKey' => 'research_type_id',
		'associationForeignKey' => 'production_type_id'
	));
	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Название не указано'
			)
		)
	);
}
?>