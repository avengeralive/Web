<?php
// app/Model/Up.php
class Up extends AppModel {
   public $name = 'Up';
	public $dynamicDb = true;
	public $belongsTo = array('Region','Organ','District','Institution');
	public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Название не указано.'
            )
		)
	);
}
?>