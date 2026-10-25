<?php
// app/Model/Detection.php
App::uses('AppModel', 'Model');
class Detection extends AppModel {
   public $name = 'Detection';
	public $dynamicDb = true;
	public $order = 'Detection.name';
	public $belongsTo = array('DetectionType','ReportDetection');
	public $hasAndBelongsToMany  = array('ProductionType' =>
            array(
                'joinTable' => 'detections_production_types',
                'foreignKey' => 'detection_id',
                'associationForeignKey' => 'production_type_id'
            ));
	public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Название не указано.'
            )
		),
		'detection_type_id' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Тип не указан.'
            )
		)
	);
}
?>