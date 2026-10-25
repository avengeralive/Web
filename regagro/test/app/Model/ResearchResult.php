<?php
// app/Model/ResearchResult.php
App::uses('AppModel', 'Model');

class ResearchResult extends AppModel {

   public $name = 'ResearchResult';
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