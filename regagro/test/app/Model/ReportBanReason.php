<?php
// app/Model/ReportBanReason.php
App::uses('AppModel', 'Model');

class ReportBanReason extends AppModel {

   public $name = 'ReportBanReason';
	public $dynamicDb = false;
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