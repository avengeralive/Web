<?php
// app/Model/Research.php
App::uses('AppModel', 'Model');

class Research extends AppModel {

   public $name = 'Research';
	public $dynamicDb = false;
   
	public $useTable = 'researches';
	public $belongsTo = array('Registration', 'Expertise', 'Production', 'ResearchType');
	public $validate = array(
		'count' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Количество не указано'
            )
		),
		'expertise_id' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Экспертиза не указана'
            )
		),
		'research_type_id' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Не указано'
            )
		)
	);
	
	// public function beforeValidate($options = array()) {
		// return true;
	// }
	
	public function beforeSave($options = array()) {
		$expertise = $this->Expertise->findById($this->data['Research']['expertise_id']);
		$this->data['Research']['production_id'] = $expertise['Expertise']['production_id'];
		return true;
	}
}
?>