<?php
// app/Model/Ban.php
App::uses('AppModel', 'Model');
class Ban extends AppModel {
   public $name = 'Ban';
	public $dynamicDb = false;
	public $belongsTo = array('Production', 'Expertise', 'Registration', 'BanType', 'BanReason');
	public $validate = array(
		'ban_type_id' => array(
			'required' => array(
					'rule' => 'notEmpty',
					'required' => true,
					'message' => 'Тип снятой продукции не указан.'
			)
		),
		// 'ban_reason_id' => array(
			// 'required' => array(
					// 'rule' => 'notEmpty',
					// 'required' => true,
					// 'message' => 'Причина не указана.'
			// )
		// ),
		'use_order' => array(
			'required' => array(
					'rule' => 'notEmpty',
					'required' => true,
					'message' => 'Порядок использования не указан.'
			)
		),
		'weight' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Вес не указан.'
            ),
			'numeric' => array(
				'rule'=>'numeric',
				'message'=>'Укажите число'
			)
		)
	);
	
	
	public function beforeValidate($options = array()) {
		$this->data['Ban']['weight'] = str_replace(',','.',$this->data['Ban']['weight']);
		return true;
	}
	
	public function beforeSave($options = array()) {
		$expertise = $this->Expertise->findById($this->data['Ban']['expertise_id']);
		$this->data['Ban']['production_id'] = $expertise['Expertise']['production_id'];
		return true;
	}
}
?>