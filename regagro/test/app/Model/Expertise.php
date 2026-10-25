<?php
// app/Model/Expertise.php
App::uses('AppModel', 'Model');

class Expertise extends AppModel {
   public $name = 'Expertise';
	public $dynamicDb = true;
	//public $actsAs = array('Subsequenced' => array('field' => 'code', 'foreign_key' => 'registration_id'));
	
	//связан с 
	public $belongsTo = array('Registration','Production');
	public $hasMany = array(
        'Research' => array(
            'className' => 'Research',
            'foreignKey' => 'expertise_id',
            'dependent' => true
        ),
        'Ban' => array(
            'className' => 'Ban',
            'foreignKey' => 'expertise_id',
            'dependent' => true
        ),
        'Distribution' => array(
            'className' => 'Distribution',
            'foreignKey' => 'expertise_id',
            'dependent' => true
        ),
        'Sample' => array(
            'className' => 'Sample',
            'foreignKey' => 'expertise_id',
            'dependent' => true
        )
    );
	public $hasAndBelongsToMany  = array('Detection' =>
		array(
			'joinTable' => 'expertises_detections',
			'foreignKey' => 'expertise_id',
			'associationForeignKey' => 'detection_id'
		));
	public $order = 'Expertise.id ASC';
	public $virtualFields = array(
		'num' => 'CASE (SELECT count(*) from `expertises` as e1 
							WHERE e1.id<Expertise.id and e1.registration_id=Expertise.registration_id)
						WHEN 0 THEN  
							(CASE WHEN Expertise.count>1
								THEN CONCAT(\'1-\', Expertise.count)
								ELSE \'1\'
							END)
						ELSE 
						    (CASE WHEN Expertise.count>1
								THEN CONCAT((SELECT SUM(e1.count) from `expertises` as e1 
									WHERE e1.id<Expertise.id and e1.registration_id=Expertise.registration_id)+1,\'-\',
									(SELECT SUM(e1.count) from `expertises` as e1 
									WHERE e1.id<Expertise.id and e1.registration_id=Expertise.registration_id)+Expertise.count)
								ELSE (SELECT SUM(e1.count) from `expertises` as e1 
									WHERE e1.id<Expertise.id and e1.registration_id=Expertise.registration_id)+1
							END)
					END',
		'conclusion_weight' => 'ROUND((Expertise.domestic_weight + Expertise.foreign_weight - Expertise.samples_weight - IFNULL((SELECT SUM(b.weight) FROM bans AS b WHERE b.expertise_id=Expertise.id),0)),2)'
	);
	public $validate = array(
		'production_id' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Продукция не выбрана.'
			)
		),
		'count' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Количество не указано.'
			),
			'numeric' => array(
				'rule'=>'numeric',
				'message'=>'Укажите число'
			)
		),
		'samples_weight' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Количество отработанного лабораторного материала не указано.'
			),
			'numeric' => array(
				'rule'=>'numeric',
				'message'=>'Укажите число'
			)
		),
		'domestic_weight' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Значение не указано.'
			),
			'numeric' => array(
				'rule'=>'numeric',
				'message'=>'Укажите число'
			)
		),
		'foreign_weight' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Значение не указано.'
			),
			'numeric' => array(
				'rule'=>'numeric',
				'message'=>'Укажите число'
			)
		),
		'price' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Значение не указано.'
			),
			'numeric' => array(
				'rule'=>'numeric',
				'message'=>'Укажите число'
			)
		),
		'state_price' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Значение не указано.'
			),
			'numeric' => array(
				'rule'=>'numeric',
				'message'=>'Укажите число'
			)
		)
	);
	
	protected function _findList($state, $query, $results = array()) {
		$query['page'] = null;
		$query['order'] = null;
		$query['fields'] = array('Expertise.id', 'Registration.code', 'Expertise.num', 'Production.name');
		$query['callbacks'] = false;
		if ($state == 'after') {
			return Hash::combine($results, '{n}.Expertise.id', array('%s/%s: %s', '{n}.Registration.code', '{n}.Expertise.num', '{n}.Production.name'));
		}
		return parent::_findAll($state, $query, $results);
	}
	
	public function beforeValidate($options = array()) {
		$this->data['Expertise']['domestic_weight'] = str_replace(',','.',$this->data['Expertise']['domestic_weight']);
		$this->data['Expertise']['foreign_weight'] = str_replace(',','.',$this->data['Expertise']['foreign_weight']);
		$this->data['Expertise']['samples_weight'] = str_replace(',','.',$this->data['Expertise']['samples_weight']);
		return true;
	}
}
?>