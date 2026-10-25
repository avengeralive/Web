<?php
// app/Model/Registration.php

class Registration extends AppModel {

   public $name = 'Registration';
	//public $dynamicDb = true;
	public $actsAs = array('Subsequenced' => array('field' => 'code', 'foreign_key' => 'lab_id'));
	public $belongsTo = array('ProductionType', 'User', 'Region', 'District', 'Lab');
	public $hasMany = array(
		'Expertise'=>array(
			'order'=>'Expertise.id ASC',
            'dependent' => true
			),
		'Research'=>array(
			'order'=>'Research.id ASC',
            'dependent' => true
			), 
		'Ban'=>array(
			'order'=>'Ban.id ASC',
            'dependent' => true
			), 
		'Distribution'=>array(
			'order'=>'Distribution.id ASC',
            'dependent' => true
			), 
		'Sample'=>array(
			'order'=>'Sample.id ASC',
            'dependent' => true
			));
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
	public $order = array('Registration.code'=>'DESC', 'Expertise.id'=>'ASC');
	
}

?>