<?php
// app/Model/District.php
class District extends AppModel {
   public $name = 'District';
	public $dynamicDb = false;
	public $belongsTo = 'Region';
	public $order = 'District.name';
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