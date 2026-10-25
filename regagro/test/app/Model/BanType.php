<?php
// app/Model/BanType.php
App::uses('AppModel', 'Model');
class BanType extends AppModel {
   public $name = 'BanType';
	public $dynamicDb = false;
	public $belongsTo = array('ReportBanType');
	public $hasAndBelongsToMany  = array('ProductionType');
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