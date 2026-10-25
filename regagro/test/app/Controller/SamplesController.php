<?php

/**
 * app/Controller/SamplesController.php
 *
 * Отбор проб.
 * Доступен для добавления - Сотрудник
 * Доступен для просмотра - Администратор учреждения
 *
 * Совместно с журналом, сохраняется 
 * в отдельной БД региона.
 *
 * Файл создан 31 марта 2019
 * 
 */
 
class SamplesController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);

	public function beforeFilter() {
	
		//выбираем базу данных для журнала с выборкой по региону.
		$this->Sample->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Sample->Expertise->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Sample->Production->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Sample->Expertise->Detection->setDataSource('region'. $this->Auth->user('region_id'));
		//$this->Sample->Vetlab->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Sample->setDataSource('region'. $this->Auth->user('region_id'));
		
		parent::beforeFilter();
		if (in_array($this->Auth->user('role'),  array('Сотрудник', 'Администратор', 'Администратор учреждения'))) {
			$this->Auth->allow('index', 'add', 'edit', 'delete');
		}

		$registration_id = 0;
		$registration_id = $this->action=='add' ? $this->request->params['pass'][0] : $this->Sample->field('registration_id', array('id' => $this->request->params['pass'][0]));

		//если правка/удаление
		if (in_array($this->action, ['edit','delete'])) {
			$this->Sample->id = $this->request->params['pass'][0];
			$sample = $this->Sample->read();
			$lab_id = $sample['Registration']['lab_id'];
			
		//если добавление
		} else if ($this->action == 'add') {
			$this->Sample->Registration->id = $registration_id;
			$registration = $this->Sample->Registration->read();
			$lab_id = $registration['Registration']['lab_id'];
		}
		$this->LabAccessChecks($lab_id, array('add', 'edit', 'delete'));

		//проверка даты, во избежании редактирования данных за прошедшие дни
      $reg_date = $this->Sample->Registration->field('date', array('id' => $registration_id));
      $this->BlockActionsIfDateIsLessThanToday($reg_date, array('add', 'edit', 'delete'));
	}

	public function isAuthorized($user) {
		if (isset($user['role']) && in_array($user['role'], array('Администратор','Сотрудник'))) {
			return true;
		}
		return parent::isAuthorized($user);
	}

	public function beforeRender() {
		parent::beforeRender();
	}

	public function add($registration_id = null) {
		$this->Sample->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Sample->Expertise->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Sample->Production->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Sample->Expertise->Detection->setDataSource('region'. $this->Auth->user('region_id'));
		//$this->Sample->Vetlab->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Sample->setDataSource('region'. $this->Auth->user('region_id'));
		//заголовок
		$this->set('title_for_layout', 'Добавление отбора проб');
		
		if (in_array($this->Auth->user('role'),  array('Сотрудник','Администратор'))) {
			$this->userActions[] = array('title' => 'Запись в журнале','url' => Router::url(array('controller' => 'registrations','action' => 'overview', $registration_id)));
		}

		if (!$registration_id) {
			throw new NotFoundException("Несуществующая запись в журнале");
		}

		$registration = $this->Sample->Registration->findById($registration_id);
		if (!$registration) {
			throw new NotFoundException("Несуществующая запись в журнале");
		}

		$this->request->data['Sample']['registration_id'] = $registration_id;
		$this->request->data['Sample']['lab_id'] = $registration['Registration']['lab_id'];
        if ($this->request->is('post')) {
            $this->Sample->create();
            if ($this->Sample->save($this->request->data)) {
					if (is_array($this->request->data['SampleSamplePurpose']['sample_purpose_id']) && count($this->request->data['SampleSamplePurpose']['sample_purpose_id']) != 0) {
						foreach ($this->request->data['SampleSamplePurpose']['sample_purpose_id'] as $sample_purpose_id) {
							$this->Sample->SampleSamplePurpose->create();
							$this->Sample->SampleSamplePurpose->set([
								'sample_purpose_id' => $sample_purpose_id,
								'sample_id' => $this->Sample->id,
								'positive' => false]);
							$this->Sample->SampleSamplePurpose->save();
						}
					} else {
						$this->Session->setFlash('Ошибка: Не указаны цели отбора проб', 'alert', array(
    						'plugin' => 'BoostCake',
    						'class' => 'alert-danger'
    					), 'success');
            	}
					$this->Session->setFlash('Запись добавлена', 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
					), 'success');
					$this->redirect(array('controller' => 'registrations', 'action' => 'overview', $registration_id));
				} else {
					$this->Session->setFlash('Ошибка:'.print_r($this->Sample->validationErrors, true), 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					), 'success');
				}
			} /*else {
			$this->request->data['Sample']['production_id']= $this->Sample->Expertise->field('production_id',array('registration_id' => $registration['Registration']['id']));
		}*/
		
		//продукция
		$productions = $this->Sample->Expertise->Production->find('list', array('conditions' => array(
			'production_type_id' => $registration['Registration']['production_type_id']/*,
			'id IN (SELECT production_id FROM expertises WHERE registration_id='.$registration['Registration']['id'].')'*/
		)));
		$this->set(compact('productions'));

		//ветеринарные лаборатории
		$vetlabs = $this->Sample->Vetlab->find('list', array('conditions' => array(
			'Vetlab.organ_id = (SELECT organ_id FROM institutions WHERE id='.$registration['Lab']['institution_id'].')'
		)));
		$this->set(compact('vetlabs'));
		
		//экспертизы
		$expertises = $this->Sample->Expertise->find('list', array('conditions'=>array('Expertise.registration_id' => $registration_id)));
		$samplePurposes = $this->Sample->SampleSamplePurpose->SamplePurpose->find('list');
		$this->set(compact('samplePurposes'));
		$this->set(compact('expertises'));
		$this->set(compact('registration'));
	}

	public function edit($id = null) {
		$this->Sample->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Sample->Expertise->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Sample->Production->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Sample->Expertise->Detection->setDataSource('region'. $this->Auth->user('region_id'));
		//$this->Sample->Vetlab->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Sample->setDataSource('region'. $this->Auth->user('region_id'));
		//заголовок
		$this->set('title_for_layout', 'Редактирование отбора проб');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}

		$sample = $this->Sample->findById($id);
		if (!$sample) {
			throw new NotFoundException("Несуществующая запись");
		}

		if (!$this->request->data) {
			$this->request->data = $sample;
		}

		if ($this->request->data['Sample']['lab_id'] == 0) {
			$this->request->data['Sample']['lab_id'] = $sample['Registration']['lab_id'];
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->Sample->id = $id;
         $this->request->data['Sample']['id'] = $id;

         if (array_key_exists('SamplePurpose', $this->request->data) && is_array($this->request->data['SamplePurpose'])) {
         	if ($this->Sample->saveAll($this->request->data)) {
    				$this->Session->setFlash('Запись изменена', 'alert', array(
    					'plugin' => 'BoostCake',
    					'class' => 'alert-success'
    				), 'success');
    				$this->redirect(array('controller' => 'registrations', 'action' => 'overview', $sample['Sample']['registration_id']));
    			} else {
    				$this->Session->setFlash('Не удалось сохранить изменения', 'alert', array(
    					'plugin' => 'BoostCake',
    					'class' => 'alert-danger'
    				), 'danger');
    			}
         } else {
            $this->Session->setFlash('Ошибка: Не указано ниодной цели отбора проб', 'alert', array(
               'plugin' => 'BoostCake',
               'class' => 'alert-danger'
            ), 'success');
      	}
		}

		//продукция
		$productions = $this->Sample->Expertise->Production->find('list', array('conditions' => array(
			'production_type_id'=>$sample['Registration']['production_type_id']/*,
			'id IN (SELECT production_id FROM expertises WHERE registration_id='.$sample['Registration']['id'].')'*/
		)));
		$this->set(compact('productions'));

		//ветеринарные лаборатории
		$vetlabs = $this->Sample->Vetlab->find('list', array('conditions' => array(
			'Vetlab.organ_id = (SELECT organ_id FROM institutions WHERE id='.$sample['Lab']['institution_id'].')'
		)));
		$this->set(compact('vetlabs'));
		
		//экспертизы
		$expertises = $this->Sample->Expertise->find('list', array('conditions'=>array('Expertise.registration_id'=>$sample['Registration']['id'])));
		$samplePurposes = $this->Sample->SampleSamplePurpose->SamplePurpose->find('list');
		$this->set(compact('samplePurposes'));
		$this->set(compact('expertises'));
		$this->set('sample', $sample);
	}
	
	//пагинация
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('Sample.id' => 'asc')
		);
		$samples = $this->Paginator->paginate('Sample');
		$this->set('samples', $samples);
	}

	//удалить запись
	public function delete($id) {
		if ($this->Sample->delete($id)) {
			$this->Session->setFlash('Запись #'.$id.' удалена', 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-success'
			), 'success');
			return $this->redirect('/registrations');
		}
	}
}
?>
