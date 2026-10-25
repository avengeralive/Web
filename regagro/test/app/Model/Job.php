<?php
// app/Model/Job.php
App::uses('AppModel', 'Model');
class Job extends AppModel {
   public $name = 'Job';
	public $dynamicDb = false;
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