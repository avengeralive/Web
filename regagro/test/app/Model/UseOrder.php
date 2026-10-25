<?php
// app/Model/UseOrder.php
App::uses('AppModel', 'Model');
class UseOrder extends AppModel {
   public $name = 'UseOrder';
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