<?php
// app/Model/User.php

class User extends AppModel {

	public $name = 'User';
	public $dynamicDb = false;
	public $belongsTo = array('Lab','Institution','Organ', 'Region', 'District');
	public $displayField = 'displayname';
	public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Имя пользователя не указано'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'required' => true,
				'message' => 'Такое имя пользователя уже используется'
			)
		),
		'displayname' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Представьтесь пожалуйста, что бы мы знали как к вам обращаться'
			)
		),
		'password' => array(
			array(
			'rule' => 'notEmpty',
			'message' => 'Пароль не может быть пустым'
			),
			array(
			'rule' => array('minLength', 6),
			'message' => 'Пароль должен содержать минимум 6 символов'
			),
			array(
			'rule' => array('passCompare'),
			'message' => 'Пароль не совпадает.'
			)
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList',
							array('Администратор', 'Сотрудник', 'Администратор учреждения')
						  ),
				'message' => 'Пожалуста укажите существующую роль',
				'allowEmpty' => false
			)
		)
	);

	public function passCompare() {
		return ($this->data[$this->alias]['password'] === $this->data[$this->alias]['password_confirm']);
	}

	public function beforeSave($options = array()) {
		if (isset($this->data['User']['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		return true;
	}

	public function GetUserLabs($user) {
		$labs = array();
		if ($user['User']['role']=='Администратор') {
			$labs = $this->Lab->find('list');
		} else {
			if ($user['User']['lab_id'] != 0) {
				$labs = $this->Lab->find('list', ['conditions'=> array('Lab.id' => $user['User']['lab_id'])]);
			}
			if ($user['User']['institution_id']!=0 && $user['User']['role']=='Администратор учреждения') {
				$labsInInstitution = $this->Lab->find('list', array(
					'conditions'=> array('Lab.institution_id' => $user['User']['institution_id']),
				));
				$labs = $labsInInstitution;
			}
		}
		return $labs;
	}
}
?>
