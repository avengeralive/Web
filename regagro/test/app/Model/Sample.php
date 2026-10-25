<?php

/**
 * app/Model/Sample.php
 *
 * Отбор проб.
 * Доступен для добавления - Сотрудник
 * Доступен для просмотра - Администратор учреждения
 *
 * Совместно с журналом, сохраняется 
 * в отдельной БД региона.
 *
 * Файл создан 31 марта 2019
 * 
 */
 
App::uses('AppModel', 'Model');

class Sample extends AppModel {

   public $name = 'Sample';
	public $actsAs = array('Subsequenced' => array('field' => 'code', 'foreign_key' => 'lab_id'));
   public $belongsTo = array('Production', 'Expertise', 'Registration', 'Vetlab', 'Lab'/*, 'SamplePurpose'*/);
   //public $hasMany = ['SampleSamplePurpose'];
   public $hasAndBelongsToMany = array(
        'SamplePurpose' =>
            array(
                'with' => 'SampleSamplePurpose'
            )
   );
	public $validate = array(
        'count' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Количество проб не указано.'
            )
		),
		'samples_weight' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Вес проб не указан.'
            )
		),
		'total_weight' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Вес не указан.'
            )
		),
		'receipt_date' => array(
            'rule' => array('date','ymd'),
            'message' => 'Введите корректную дату'//,
            //'allowEmpty' => false
        )
	);

	public function beforeValidate($options = array()) {
		$this->data['Sample']['samples_weight'] = str_replace(',','.',$this->data['Sample']['samples_weight']);
		return true;
	}

	public function beforeSave($options = array()) {
		$expertise = $this->Expertise->findById($this->data['Sample']['expertise_id']);
		$this->data['Sample']['production_id'] = $expertise['Expertise']['production_id'];
		return true;
	}
	


}
?>
