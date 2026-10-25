<?php
// app/Model/Plan.php
class Plan extends AppModel {
   public $name = 'Plan';
	public $belongsTo = ['Institution', 'Lab', 'ProductionType'];
	public $validate = [
        'institution_id' => [
            'required' => [
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Учреждение не указано'
            ]
		],
        'lab_id' => [
            'required' => [
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Лаборатория не указана'
            ]
		],
        'production_type_id' => [
            'required' => [
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Вид продукции не указан'
            ]
		],
        'month' => [
            'required' => [
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Месяц не указан'
            ]
		]
	];
}
?>
