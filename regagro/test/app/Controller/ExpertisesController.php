<?php

/**
 * app/Controller/ExpertisesController.php
 *
 * Экспертизы.
 * Доступен для добавления - Сотрудник
 * Доступен для просмотра - Администратор учреждения
 *
 * Совместно с журналом, сохраняется 
 * в отдельной БД региона.
 *
 * Файл создан 31 марта 2019
 * 
 */
 
class ExpertisesController extends AppController {

	public $reg_date;
	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);

	public function beforeFilter() {
	
		//выбираем базу данных для журнала с выборкой по региону.
		$this->Expertise->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		
		parent::beforeFilter();
		if (in_array($this->Auth->user('role'),  array('Сотрудник','Администратор','Администратор учреждения'))) {
			$this->Auth->allow('*');
		}

		$registration_id = 0;
		$registration_id = $this->action == 'add' ? $this->request->params['pass'][0] : $this->Expertise->field('registration_id', array('id' => $this->request->params['pass'][0]));

		//если правка/удаление
		if (in_array($this->action, ['edit','delete'])) {
			$this->Expertise->id = $this->request->params['pass'][0];
			$expertise = $this->Expertise->read();
			$lab_id = $expertise['Registration']['lab_id'];
		//если добавление
		} else if ($this->action=='add') {
			$this->Expertise->Registration->id = $registration_id;
			$registration = $this->Expertise->Registration->read();
			$lab_id = $registration['Registration']['lab_id'];
		}
      $this->LabAccessChecks($lab_id, array('add', 'edit', 'delete'));

		//проверка даты, во избежании редактирования данных за прошедшие дни
		$this->reg_date = $this->Expertise->Registration->field('date', array('id' => $registration_id));
		$this->BlockActionsIfDateIsLessThanToday($this->reg_date, array('add', 'delete'));
	}

	//дублируется в функции выше
	public function isAuthorized($user) {
		if (isset($user['role']) && in_array($user['role'], array('Администратор','Сотрудник','Администратор учреждения'))) {
			return true;
		}
		return parent::isAuthorized($user);
	}

	public function beforeRender() {
		parent::beforeRender();
	}

	//добавление экспертизы
	public function add($registration_id = null) {
		
		//выбираем базу данных для журнала с выборкой по региону.
		$this->Expertise->Registration->setDataSource('region'. $this->Auth->user('region_id'));	
	
		//заголовок
		$this->set('title_for_layout', 'Добавление экспертизы');

		if (in_array($this->Auth->user('role'),  array('Сотрудник','Администратор'))) {
			$this->userActions[] = array('title' => 'Запись в журнале','url' => Router::url(array('controller' => 'registrations','action' => 'overview', $registration_id)));
		}

		if (!$registration_id) {
			throw new NotFoundException("Несуществующая запись в журнале");
		}

		$registration = $this->Expertise->Registration->findById($registration_id);
		if (!$registration) {
			throw new NotFoundException("Несуществующая запись журнале");
		}

		$this->request->data['Expertise']['registration_id'] = $registration_id;
        if ($this->request->is('post')) {
            $this->Expertise->create();
            if ($this->Expertise->save($this->request->data)) {
				$this->Session->setFlash('Запись добавлена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('controller' => 'registrations', 'action' => 'overview', $registration_id));
			} else {
				$this->Session->setFlash('Ошибки заполнения формы.'/*.print_r($this->Expertise->validationErrors,true)*/, 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				), 'success');
			}
		}
		
		$productions = $this->Expertise->Production->find('list', array('conditions' => array('production_type_id' => $registration['Registration']['production_type_id'])));
		$this->set(compact('productions'));
		$detections = $this->Expertise->Detection->find('list', array(
			'conditions' => array('DetectionsProductionTypes.production_type_id' => $registration['Registration']['production_type_id']),
			'joins' => array(
				array(
					'type' => 'inner',
					'table' => 'detections_production_types',
					'alias' => 'DetectionsProductionTypes',
					'conditions' => array(
						'DetectionsProductionTypes.detection_id = Detection.id'
					)
				)
			)
		));
		$this->set(compact('detections'));
		$this->set(compact('registration'));
	}

	//редактирование экспертизы
	public function edit($id = null) {
	
		//выбираем базу данных для журнала с выборкой по региону.
		$this->Expertise->Registration->setDataSource('region'. $this->Auth->user('region_id'));
	
		//заголовок
		$this->set('title_for_layout', 'Редактирование экспертизы');
		
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}

		$expertise = $this->Expertise->findById($id);
		if (!$expertise) {
			throw new NotFoundException("Несуществующая запись");
		}

		if (!$this->request->data) {
			$this->request->data = $expertise;
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Expertise->id = $id;
            if ($this->Expertise->save($this->request->data)) {
				$this->Session->setFlash('Запись изменена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('controller' => 'registrations', 'action' => 'overview', $expertise['Expertise']['registration_id']));
			} else {
				$this->Session->setFlash('Не удалось сохранить изменения.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				), 'danger');
			}
		}

		$productions = $this->Expertise->Production->find('list', array('conditions' => array('production_type_id' => $expertise['Registration']['production_type_id'])));
		$this->set(compact('productions'));
		$detections = $this->Expertise->Detection->find('list', array(
			'conditions' => array('DetectionsProductionTypes.production_type_id' => $expertise['Registration']['production_type_id']),
			'joins' => array(
				array(
					'type' => 'inner',
					'table' => 'detections_production_types',
					'alias' => 'DetectionsProductionTypes',
					'conditions' => array(
						'DetectionsProductionTypes.detection_id = Detection.id'
					)
				)
			)
		));
		$this->set(compact('detections'));
		$this->set('expertise', $expertise);
		$this->set('canOnlyEditSamples', !$this->ActionsAvailableIfDateIsLessThanToday($this->reg_date, ['edit']));
	}

	//пагинация
	public function index() {
	
		//выбираем базу данных для журнала с выборкой по региону.
		$this->Expertise->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('Expertise.id' => 'asc')
		);
		$expertises = $this->Paginator->paginate('Expertise');
		$this->set('expertises', $expertises);
	}
	
	//удаление экспертизы
	public function delete($id) {
	
		//выбираем базу данных для журнала с выборкой по региону.
		$this->Expertise->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		
		if ($this->Expertise->delete($id, true)) {
			$this->Session->setFlash('Запись #'.$id.' удалена', 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-success'
			), 'success');
			return $this->redirect('/registrations');
		}
	}
}
?>
