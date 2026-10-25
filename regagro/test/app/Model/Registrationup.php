<?php
// app/Model/Registrationup.php
class Registrationup extends AppModel {
   public $name = 'Registrationup';
	//public $dynamicDb = true;
	public $actsAs = array('Subsequenced' => array('field' => 'code', 'foreign_key' => 'lab_id'));
	public $belongsTo = array('ProductionType', 'User', 'Region', 'District', 'Lab');
	public $hasMany = array(
		'Expertise'=>array(
			'order'=>'Expertise.id ASC',
            'dependent' => true
			),
		'Research', 'Ban', 'Distribution', 'Sample');
	
	public $validate = array(
		'region_id' => array(
			'rule' => 'numeric',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Не указан регион'
		),
		'district_id' => array(
			'rule' => 'numeric',
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Не указан район'
		)
	);
	public $order = array('Registrationup.code' => 'DESC', 'Expertise.id' => 'ASC');
	
}

?>