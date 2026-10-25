<?php
// app/Model/ReportDetection.php
App::uses('AppModel', 'Model');

class ReportDetection extends AppModel {

   public $name = 'ReportDetection';
	public $dynamicDb = false;
	public $belongsTo = 'DetectionType';
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