<?php
// app/Model/Vetlab.php

class Vetlab extends AppModel {

   public $name = 'Vetlab';
	public $order = 'Vetlab.name';
	public $dynamicDb = false;
	public $belongsTo = array('Region','Organ','District');
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