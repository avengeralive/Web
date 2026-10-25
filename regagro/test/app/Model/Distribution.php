<?php
// app/Model/Distribution.php
App::uses('AppModel', 'Model');

class Distribution extends AppModel {

   public $name = 'Distribution';
	public $dynamicDb = false;
	public $belongsTo = array('Production', 'Expertise', 'Registration');
	public $validate = array(
		'distributor' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Торгующий не указан'
			)
		),
		'count' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Количество не указано'
			),
			'numeric' => array(
				'rule'=>'numeric',
				'message'=>'Укажите число'
			)
		),
		'weight' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Общий вес не указан'
			),
			'numeric' => array(
				'rule'=>'numeric',
				'message'=>'Укажите число'
			)
		),
		'places' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Количество мест не указано'
			),
			'numeric' => array(
				'rule'=>'numeric',
				'message'=>'Укажите число'
			)
		)
	);
	
	public function beforeValidate($options = array()) {
		if (isset($this->data['Distribution'])&&isset($this->data['Distribution']['weight']))
		$this->data['Distribution']['weight'] = str_replace(',','.',$this->data['Distribution']['weight']);
		return true;
	}
	
	public function beforeSave($options = array()) {
		$expertise = $this->Expertise->findById($this->data['Distribution']['expertise_id']);
		$this->data['Distribution']['production_id'] = $expertise['Expertise']['production_id'];
		return true;
	}
}
?>