<?php

/**
 * app/Controller/BansController.php
 *
 * Снятие с реализации.
 * Доступен для добавления - Сотрудник
 * Доступен для просмотра - Администратор учреждения
 *
 * Совместно с журналом, сохраняется 
 * в отдельной БД региона.
 *
 * Файл создан 31 марта 2019
 * 
 */
 
class BansController extends AppController {

	//public $dynamicDb = true;
	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);

	public function beforeFilter() {
	
		//выбираем базу данных для журнала с выборкой по региону.
		//$this->Ban->Registration->useDbConfig = 'region'. $this->Auth->user('region_id');
		$this->Ban->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Ban->Expertise->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Ban->Production->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Ban->Expertise->Detection->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Ban->setDataSource('region'. $this->Auth->user('region_id'));
		
		parent::beforeFilter();
		if (in_array($this->Auth->user('role'),  array('Сотрудник', 'Администратор', 'Администратор учреждения'))) {
			$this->Auth->allow('index', 'add', 'edit', 'delete');
		}

		$registration_id = 0;
		$registration_id = $this->action == 'add' ? $this->request->params['pass'][0] : $this->Ban->field('registration_id', array('id' => $this->request->params['pass'][0]));
                            
		//если правка/удаление
		if (in_array($this->action, ['edit','delete'])) {
			$this->Ban->id = $this->request->params['pass'][0];
			$ban = $this->Ban->read();
			$lab_id = $ban['Registration']['lab_id'];
			
		//если добавление
		} else if ($this->action == 'add'){
			$this->Ban->Registration->id = $registration_id;
			$registration = $this->Ban->Registration->read();
			$lab_id = $registration['Registration']['lab_id'];
		}							
		$this->LabAccessChecks($lab_id, array('add', 'edit', 'delete'));
							
		//проверка даты, во избежании редактирования данных за прошедшие дни					
		$reg_date = $this->Ban->Registration->field('date', array('id' => $registration_id));
		$this->BlockActionsIfDateIsLessThanToday($reg_date, array(/*'add', 'edit',*/ 'delete'));
	}

	public function isAuthorized($user) {
		if (isset($user['role']) && in_array($user['role'], array('Администратор', 'Сотрудник', 'Администратор учреждения'))) {
			return true;
		}
		return parent::isAuthorized($user);
    }

	public function beforeRender() {
		parent::beforeRender();
	}

	//добавление
	public function add($registration_id = null) {
		
		//выбираем базу данных для журнала с выборкой по региону.
		//$this->Ban->Registration->useDbConfig = 'region'. $this->Auth->user('region_id');
		$this->Ban->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Ban->Expertise->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Ban->Production->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Ban->Expertise->Detection->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Ban->setDataSource('region'. $this->Auth->user('region_id'));
		
		//заголовок
		$this->set('title_for_layout', 'Добавление снятия с реализации');

		if (in_array($this->Auth->user('role'),  array('Сотрудник','Администратор'))) {
			$this->userActions[] = array('title' => 'Запись в журнале','url' => Router::url(array('controller' => 'registrations','action' => 'overview', $registration_id)));
		}

		if (!$registration_id) {
			throw new NotFoundException("Несуществующая запись в журнале");
		}

		$registration = $this->Ban->Registration->findById($registration_id);
		if (!$registration) {
			throw new NotFoundException("Несуществующая запись журнале");
		}

		$this->request->data['Ban']['registration_id'] = $registration_id;
		if ($this->request->is('post')) {
			$this->Ban->create();
			if ($this->Ban->save($this->request->data)) {
				$this->Session->setFlash('Запись добавлена', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('controller' => 'registrations', 'action' => 'overview', $registration_id));
			} else {
				$this->Session->setFlash('Ошибка заполнения формы'/*.print_r($this->Ban->validationErrors, true)*/, 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				), 'success');
			}
		}
		
		//продукция
		$productions = $this->Ban->Production->find('list', array('conditions' => array(
			'production_type_id' => $registration['Registration']['production_type_id'],
			'id IN (SELECT production_id FROM expertises WHERE registration_id = '. $registration['Registration']['id'] .')'
		)));
		$this->set(compact('productions'));
		
		//причина снятия с реализации
		$banTypes = $this->Ban->BanType->find('list', array(
			'conditions' => array('BanTypesProductionTypes.production_type_id' => $registration['Registration']['production_type_id']),
			'joins' => array(
				array(
					'type' => 'inner',
					'table' => 'ban_types_production_types',
					'alias' => 'BanTypesProductionTypes',
					'conditions' => array(
						'BanTypesProductionTypes.ban_type_id = BanType.id'
					)
				)
			)
		));
		$this->set(compact('banTypes'));
		
		//причины обезвреживания
		$banReasons = $this->Ban->BanReason->find('list', array(
			'conditions' => array('BanReasonsProductionTypes.production_type_id' => $registration['Registration']['production_type_id']),
			'joins' => array(
				array(
					'type' => 'inner',
					'table' => 'ban_reasons_production_types',
					'alias' => 'BanReasonsProductionTypes',
					'conditions' => array(
						'BanReasonsProductionTypes.ban_reason_id = BanReason.id'
					)
				)
			)
		));
		$this->set(compact('banReasons'));
		
		//Экспертизы
		$expertises = $this->Ban->Expertise->find('list', array('conditions' => array('Expertise.registration_id' => $registration['Registration']['id'])));
		$this->set(compact('expertises'));
		$this->set(compact('registration'));
	}

	//редактировать запись
	public function edit($id = null) {
		$this->Ban->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Ban->Expertise->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Ban->Production->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Ban->Expertise->Detection->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Ban->setDataSource('region'. $this->Auth->user('region_id'));
		//заголовок
		$this->set('title_for_layout', 'Редактирование снятия с реализации');
		
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}

		$ban = $this->Ban->findById($id);
		if (!$ban) {
			throw new NotFoundException("Несуществующая запись");
		}

		if (!$this->request->data) {
			$this->request->data = $ban;
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Ban->id = $id;
			if ($this->Ban->save($this->request->data)) {
				$this->Session->setFlash('Запись изменена', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('controller' => 'registrations', 'action' => 'overview', $ban['Ban']['registration_id']));
			} else {
				$this->Session->setFlash('Не удалось сохранить изменения.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				), 'danger');
			}
		}
		
		//продукция
		$productions = $this->Ban->Production->find('list',
			array('conditions' => array(
				'production_type_id'=>$ban['Registration']['production_type_id'],
				'id IN (SELECT production_id FROM expertises WHERE registration_id = '. $ban['Registration']['id'] .')'
		)));
		$this->set(compact('productions'));
		
		//причина снятия с реализации
		$banTypes = $this->Ban->BanType->find('list', array(
			'conditions' => array('BanTypesProductionTypes.production_type_id'=>$ban['Registration']['production_type_id']),
			'joins' => array(
				array(
					'type' => 'inner',
					'table' => 'ban_types_production_types',
					'alias' => 'BanTypesProductionTypes',
					'conditions'=>array(
						'BanTypesProductionTypes.ban_type_id = BanType.id'
					)
				)
			)
		));
		$this->set(compact('banTypes'));
		
		//причины обезвреживания
		$banReasons = $this->Ban->BanReason->find('list', array(
			'conditions'=>array('BanReasonsProductionTypes.production_type_id'=>$ban['Registration']['production_type_id']),
			'joins'=>array(
				array(
					'type' => 'inner',
					'table' => 'ban_reasons_production_types',
					'alias' => 'BanReasonsProductionTypes',
					'conditions'=>array(
						'BanReasonsProductionTypes.ban_reason_id = BanReason.id'
					)
				)
			)
		));
		$this->set(compact('banReasons'));
		
		//экспертизы
		$expertises = $this->Ban->Expertise->find('list', array('conditions'=>array('Expertise.registration_id'=>$ban['Registration']['id'])));
		$this->set(compact('expertises'));
		$this->set('ban', $ban);
	}

	//удаление
	public function delete($id) {
		if ($this->Ban->delete($id)) {
			$this->Session->setFlash('Запись #'.$id.' удалена', 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-success'
			), 'success');
			return $this->redirect('/registrations');
		}
	}
}
?>
