<?php
// app/Model/DetectionType.php
App::uses('AppModel', 'Model');
class DetectionType extends AppModel {
   public $name = 'DetectionType';
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