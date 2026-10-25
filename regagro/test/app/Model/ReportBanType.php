<?php
// app/Model/ReportBanType.php

App::uses('AppModel', 'Model');

class ReportBanType extends AppModel {

   public $name = 'ReportBanType';
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