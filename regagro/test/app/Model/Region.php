<?php
// app/Model/Region.php

class Region extends AppModel {

   public $name = 'Region';
	public $dynamicDb = false;
	public $hasMany = 'District';
	public $order = 'name';
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