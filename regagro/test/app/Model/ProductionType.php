<?php
// app/Model/ProductionType.php
class ProductionType extends AppModel {
   public $name = 'ProductionType';
	public $dynamicDb = false;
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