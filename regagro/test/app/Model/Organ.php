<?php
// app/Model/Organ.php
class Organ extends AppModel {
   public $name = 'Organ';
	public $dynamicDb = false;
   public $belongsTo = array('Region');
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