<?php
// app/Model/Production.php

class Production extends AppModel {

   public $name = 'Production';
	public $dynamicDb = false;
	public $belongsTo = array('ProductionType', 'ReportProduction');
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