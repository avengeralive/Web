<?php
// app/Model/Lab.php
class Lab extends AppModel {
   public $name = 'Lab';
	public $dynamicDb = false;
	public $belongsTo = array('Region','Organ','District','Institution');
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