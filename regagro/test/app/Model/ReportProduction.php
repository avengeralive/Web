<?php
// app/Model/ReportProduction.php
//продукция - отчет
class ReportProduction extends AppModel {

   public $name = 'ReportProduction';
	//public $belongsTo = 'ProductionType';
	public $dynamicDb = false;
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