<?php
// app/Model/ReportResearch.php
App::uses('AppModel', 'Model');

class ReportResearch extends AppModel {

   public $name = 'ReportResearch';
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