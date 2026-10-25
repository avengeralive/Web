<?php

/**
 * app/Controller/ResearchesController.php
 *
 * Исследования.
 * Доступен для добавления - Сотрудник
 * Доступен для просмотра - Администратор учреждения
 *
 * Совместно с журналом, сохраняется 
 * в отдельной БД региона.
 *
 * Файл создан 31 марта 2019
 * 
 */
 
class ResearchesController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);

	public function beforeFilter() {
		//выбираем базу данных для журнала с выборкой по региону.
		$this->Research->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->Expertise->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->Production->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->Expertise->Detection->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->ResearchType->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->setDataSource('region'. $this->Auth->user('region_id'));
		
		parent::beforeFilter();
		if (in_array($this->Auth->user('role'),  array('Сотрудник','Администратор', 'Администратор учреждения'))) {
			$this->Auth->allow('*');
		}

		$registration_id = 0;
		$registration_id = $this->action=='add' ? $this->request->params['pass'][0] : $this->Research->field('registration_id', array('id' => $this->request->params['pass'][0]));
					
		//редактирование/удаление		
		if (in_array($this->action, ['edit','delete'])) {
			$this->Research->id = $this->request->params['pass'][0];
			$research = $this->Research->read();
			$lab_id = $research['Registration']['lab_id'];
			
		//добавление
		} else if ($this->action == 'add'){
			$this->Research->Registration->id = $registration_id;
			$registration = $this->Research->Registration->read();
			$lab_id = $registration['Registration']['lab_id'];
		}	
		$this->LabAccessChecks($lab_id, array('add', 'edit', 'delete'));
		
		//проверка даты, во избежании редактирования данных за прошедшие дни
		$reg_date = $this->Research->Registration->field('date', array('id' => $registration_id));
		$this->BlockActionsIfDateIsLessThanToday($reg_date, array('add', 'edit', 'delete'));
	}

	public function isAuthorized($user) {
		if (isset($user['role']) && in_array($user['role'], array('Администратор','Сотрудник','Администратор учреждения'))) {
			return true;
		}
		return parent::isAuthorized($user);
	}

	public function beforeRender() {
		parent::beforeRender();
	}

	public function add($registration_id = null) {
	
		//выбираем базу данных для журнала с выборкой по региону.
		$this->Research->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->Expertise->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->Production->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->Expertise->Detection->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->ResearchType->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->setDataSource('region'. $this->Auth->user('region_id'));
		
		//заголовок
		$this->set('title_for_layout', 'Добавление исследования');
		if (in_array($this->Auth->user('role'),  array('Сотрудник','Администратор'))) {
			$this->userActions[] = array('title' => 'Запись в журнале','url' => Router::url(array('controller' => 'registrations','action' => 'overview', $registration_id)));
		}

		if (!$registration_id) {
			throw new NotFoundException("Несуществующая запись в журнале");
		}

		$registration = $this->Research->Registration->findById($registration_id);
		if (!$registration) {
			throw new NotFoundException("Несуществующая запись журнале");
		}

		//$this->request->data['Research']['registration_id'] = $registration_id;
		if ($this->request->is('post')) { var_dump($this->request->data);
			//unset($this->request->data['Research']['production_id']);
			unset($this->request->data['Research']['expertise_id']);
			//$this->request->data = $this->request->data['Research'];
			//$this->Research->create();
			
			if ($this->Research->saveMany($this->request->data['Research'])) {
				$this->Session->setFlash('Запись добавлена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('controller' => 'registrations', 'action' => 'overview', $registration_id));
			} else {
				$this->Session->setFlash('Ошибка'.print_r($this->Research->validationErrors, true), 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				), 'success');
			}
		}
		
		//продукция
		$productions = $this->Research->Production->find('list', array('conditions' => array(
			'production_type_id'=>$registration['Registration']['production_type_id'],
			'id IN (SELECT production_id FROM expertises WHERE registration_id='. $registration['Registration']['id'] .')'
		)));
		$this->set(compact('productions'));
		
		//типы исследований
		$researchTypes = $this->Research->ResearchType->find('list', array(
			'order' => 'ResearchType.Name',
			'conditions' => array('ResearchTypesProductionTypes.production_type_id' => $registration['Registration']['production_type_id']),
			'joins' => array(
				array(
					'type' => 'inner',
					'table' => 'research_types_production_types',
					'alias' => 'ResearchTypesProductionTypes',
					'conditions' => array(
						'ResearchTypesProductionTypes.research_type_id = ResearchType.id'
					)
				)
			)
		));
		$this->set(compact('researchTypes'));
		$this->set(compact('registration'));
		
		//экспертизы
		$expertises = $this->Research->Expertise->find('list', array('conditions' => array('Expertise.registration_id' => $registration_id)));
		$this->set(compact('expertises'));
	}

	public function edit($id = null) {
	
		//выбираем базу данных для журнала с выборкой по региону.

		$this->Research->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->Expertise->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->Production->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->Expertise->Detection->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->ResearchType->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->setDataSource('region'. $this->Auth->user('region_id'));

		//заголовок
		$this->set('title_for_layout', 'Редактирование исследования');
		
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}

		$research = $this->Research->findById($id);
		if (!$research) {
			throw new NotFoundException("Несуществующая запись");
		}

		if (!$this->request->data) {
			$this->request->data = $research;
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Research->id = $id;
         if ($this->Research->save($this->request->data)) {
				$this->Session->setFlash('Запись изменена', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('controller' => 'registrations', 'action' => 'overview', $research['Research']['registration_id']));
			} else {
				$this->Session->setFlash('Не удалось сохранить изменения', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				), 'danger');
			}
		}
		
		//продукция
		$productions = $this->Research->Production->find('list', array('conditions' => array(
			'production_type_id' => $research['Registration']['production_type_id'],
			'id IN (SELECT production_id FROM expertises WHERE registration_id='. $research['Registration']['id'] .')'
		)));
		$this->set(compact('productions'));
		
		//типы исследований
		$researchTypes = $this->Research->ResearchType->find('list', array(
			'order' => 'ResearchType.Name',
			'conditions' => array('ResearchTypesProductionTypes.production_type_id' => $research['Registration']['production_type_id']),
			'joins' => array(
				array(
					'type' => 'inner',
					'table' => 'research_types_production_types',
					'alias' => 'ResearchTypesProductionTypes',
					'conditions'=>array(
						'ResearchTypesProductionTypes.research_type_id = ResearchType.id'
					)
				)
			)
		));
		$this->set(compact('researchTypes'));
		
		//экспертизы
		$expertises = $this->Research->Expertise->find('list', array('conditions'=>array('Expertise.registration_id' => $research['Registration']['id'])));
		$this->set(compact('expertises'));
		$this->set('research', $research);
	}
	
	//пагинация
	public function index() {//var_dump("TEST");
	
		//выбираем базу данных для журнала с выборкой по региону.
		$this->Research->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->Expertise->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->Production->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->Expertise->Detection->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->ResearchType->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Research->setDataSource('region'. $this->Auth->user('region_id'));
		
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('Research.id' => 'asc')
		);
		$researches = $this->Paginator->paginate('Research');
		$this->set('researches', $researches);
	}

	//удаление исследования
	public function delete($id) {
	
		//выбираем базу данных для журнала с выборкой по региону.
		$this->Research->Registration->useDbConfig = 'region'. $this->Auth->user('region_id');
		
		if ($this->Research->delete($id)) {
			$this->Session->setFlash('Запись #'.$id.' удалена', 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-success'
			), 'success');
			return $this->redirect('/registrations');
		}
	}
}
?>
