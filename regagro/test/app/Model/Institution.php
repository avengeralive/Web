<?php
// app/Model/Institution.php
class Institution extends AppModel {
   public $name = 'Institution';
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