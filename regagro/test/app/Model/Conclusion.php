<?php
// app/Model/Conclusion.php
App::uses('AppModel', 'Model');
class Conclusion extends AppModel {
   public $name = 'Conclusion';
	public $dynamicDb = false;
	public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Название не указано'
            )
	));
}
?>