<?php
// app/Model/BanReason.php
App::uses('AppModel', 'Model');
class BanReason extends AppModel {
   public $name = 'BanReason';
	public $dynamicDb = false;
	public $belongsTo = array('ReportBanReason');
	public $hasAndBelongsToMany  = array('ProductionType');
	public $order = 'BanReason.name';
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