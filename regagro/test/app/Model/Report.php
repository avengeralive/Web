<?php
// app/Model/Report.php
//отчет
class Report extends AppModel {

   public $name = 'Report';
	//public $dynamicDb = true;
	public $useTable = false;
	public $_schema = array(
		'date_from' => array(
			'type' => 'date'
		),
		'date_to' => array(
			'type' => 'date'
		),
		'institution_id' => array(
			'type' => 'string',
			'length' => 10
		),
		'lab_id' => array(
			'type' => 'string',
			'length' => 10
		)
	);
	public $belongsTo = array('Lab');
	
	public $validate = array(
        /*'institution_id' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Учреждение не указано.'
            )
		),
		'lab_id' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Лаборатория не указана.'
            )
		),*/
		'date_from' => array(
            'date' => array(
                'rule' => 'date',
                'message' => 'Не корректная дата.'
            ),
			'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Дата от не указана.'
            )
		),
		'date_to' => array(
            'date' => array(
                'rule' => 'date',
                'message' => 'Не корректная дата.'
            ),
			'required' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Дата до не указана.'
            )
		)
	);
}

?>