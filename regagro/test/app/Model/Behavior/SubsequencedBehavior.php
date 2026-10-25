<?php
class SubsequencedBehavior extends ModelBehavior {
	public $name = 'Subsequenced';
	
	public $_defaults = array('field' => 'code', 'foreign_key' => 'order_id');
	
	public function setup(Model $Model, $config = array()) {
		if (!is_array($config)) {
			$config = array();
		}
		$this->settings[$Model->alias] = array_merge($this->_defaults, $config);
		$Model->order = $Model->alias . '.' . $this->settings[$Model->alias]['field'] . ' ASC';
	}
	
	public function beforeSave(Model $Model, $options = array()) {
		//	Пересчет для поля code делаем если:
		// 	1) неуказан primaryKey или id, т.е. запись не изменяется а добавляется
		// 	2) указан primaryKey или id, т.е. запись не изменяется, но при этом сейчас код у нее стоит 0, т.е. раньш видимо небыло лаборатории или еще какие-то проблемы были
		// 	3) в данных есть значение для поля code и оно не числовое
		if (
			(!isset($Model->data[$Model->alias][$Model->primaryKey]) && !$Model->id) 
				|| 
			((isset($Model->data[$Model->alias][$Model->primaryKey])||$Model->id) && (isset($Model->data[$Model->alias][$this->settings[$Model->alias]['field']]) && $Model->data[$Model->alias][$this->settings[$Model->alias]['field']]==0)) 
				||
			(
				isset($Model->data[$Model->alias][$this->settings[$Model->alias]['field']]) 
					&& 
				!is_numeric($Model->data[$Model->alias][$this->settings[$Model->alias]['field']]) 
			) 
		) {
			$fk = null;
			if ($this->settings[$Model->alias]['foreign_key']) {
				if (!isset($Model->data[$Model->alias][$this->settings[$Model->alias]['foreign_key']])) {
					trigger_error('SubsequencedBehavior : New rows must be saved with foreign key field present.', E_USER_WARNING);
					return false;					
				}
				$fk = $Model->data[$Model->alias][$this->settings[$Model->alias]['foreign_key']];
			}
			$Model->data[$Model->alias][$this->settings[$Model->alias]['field']] = $this->_newWeight($Model,$fk);
		}
		return true;
	}
	
	private function _highest(&$Model, $foreignKey = null) {
		$options = array(
				'order' => $this->settings[$Model->alias]['field'] . ' DESC', 
				'fields' => array($Model->primaryKey, $this->settings[$Model->alias]['field']), 
				'recursive' => -1);
		if ($this->settings[$Model->alias]['foreign_key']) {
			if (!$foreignKey) {
				if ( !empty($Model->data) && isset($Model->data[$Model->alias][$this->settings[$Model->alias]['foreign_key']]) ) {
					$foreignKey = $Model->data[$Model->alias][$this->settings[$Model->alias]['foreign_key']];
				} else {
					$foreignKey = $Model->field($this->settings[$Model->alias]['foreign_key']);
				}		
			}	
			$options['conditions'] = array($Model->alias .'.'. $this->settings[$Model->alias]['foreign_key'] => $foreignKey);
			$options['fields'][] = $this->settings[$Model->alias]['foreign_key'];
		}
		$temp_model_id = $Model->id;
		$Model->id = null;
		$last = $Model->find('first', $options);
		$Model->id = $temp_model_id;
		return $last;
	}
	
	private function _newWeight($Model, $foreignKey = null) {
		if ( $this->settings[$Model->alias]['foreign_key'] && !$foreignKey ) {			
			return false;
		}
		$highest = $this->_highest($Model, $foreignKey);
		$res = count($highest)>0?$highest[$Model->alias][$this->settings[$Model->alias]['field']] + 1:1;
		return $res;		
	}
}
?>