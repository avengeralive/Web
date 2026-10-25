<?php

/**
 * app/Controller/DistributionsController.php
 *
 * Распределение продукции по точкам.
 * Доступен для добавления - Сотрудник
 * Доступен для просмотра - Администратор учреждения
 *
 * Совместно с журналом, сохраняется 
 * в отдельной БД региона.
 *
 * Файл создан 31 марта 2019
 * 
 */
 
class DistributionsController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);

	public function beforeFilter() {
	
		//выбираем базу данных для журнала с выборкой по региону.
		//$this->Distribution->Registration->useDbConfig = 'region'. $this->Auth->user('region_id');
		$this->Distribution->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		
		parent::beforeFilter();
		if (in_array($this->Auth->user('role'),  array('Сотрудник','Администратор', 'Администратор учреждения'))) {
			$this->Auth->allow('index', 'add', 'edit', 'delete', 'autofill'); //??? точно ли для всех?
		}

		$registration_id = 0;
		$registration_id = $this->action == 'add' ? $this->request->params['pass'][0] : $this->Distribution->field('registration_id', array('id' => $this->request->params['pass'][0]));
		
		//если правка/удаление
		if (in_array($this->action, ['edit','delete'])) {
			$this->Distribution->id = $this->request->params['pass'][0];
			$distribution = $this->Distribution->read();
			$lab_id = $distribution['Registration']['lab_id'];
			
		//если добавление
		} else if ($this->action == 'add') {
			$this->Distribution->Registration->id = $registration_id;
			$registration = $this->Distribution->Registration->read();
			$lab_id = $registration['Registration']['lab_id'];
		}
		$this->LabAccessChecks($lab_id, array('add', 'edit', 'delete'));
							
			
		//проверка даты, во избежании редактирования данных за прошедшие дни				
		$reg_date = $this->Distribution->Registration->field('date', array('id' => $registration_id));
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
		
		//выбираем базу данных для журнала с выборкой по региону.
		//$this->Distribution->Registration->useDbConfig = 'region'. $this->Auth->user('region_id');

		$this->Distribution->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Distribution->Expertise->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Distribution->Production->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Distribution->Expertise->Detection->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Distribution->setDataSource('region'. $this->Auth->user('region_id'));
		
		//заголовок
		$this->set('title_for_layout', 'Добавление распределения продукции по точкам');

		if (in_array($this->Auth->user('role'),  array('Сотрудник','Администратор'))) {
			$this->userActions[] = array('title' => 'Запись в журнале','url' => Router::url(array('controller' => 'registrations','action' => 'overview', $registration_id)));
		}

		if (!$registration_id) {
			throw new NotFoundException("Несуществующая запись в журнале");
		}

		$registration = $this->Distribution->Registration->findById($registration_id);
		if (!$registration) {
			throw new NotFoundException("Несуществующая запись журнале");
		}

		//общие количество и вес, допустимые в экспертизе к распределению
		$totals_query = "SELECT Expertise.id, Expertise.count,
						 ROUND(
						 	(
						 		Expertise.domestic_weight + 
						 		Expertise.foreign_weight - 
						 		Expertise.samples_weight - 
						 		IFNULL(
						 			(SELECT SUM(b.weight) FROM bans AS b WHERE b.expertise_id = Expertise.id GROUP BY Expertise.id),0
						 		)
						 	),2) as Expertise__conclusion_weight
						 FROM expertises as Expertise
						 WHERE Expertise.registration_id=". $registration_id ."
						 GROUP BY Expertise.id";
		$totals = Hash::combine($this->Distribution->query($totals_query), '{n}.Expertise.id', '{n}.Expertise');
		$this->set(compact('totals'));

		//количество и вес уже распределенные
		$distributed_query = "SELECT Distribution.expertise_id, ROUND(SUM(Distribution.weight),2) AS weight, SUM(Distribution.count) AS count FROM distributions AS Distribution
						WHERE Distribution.registration_id = ". $registration_id ."
						GROUP BY Distribution.expertise_id";
		//$distributed = $this->Distribution->query($distributed_query);
		$distributed = Hash::combine($this->Distribution->query($distributed_query), '{n}.Distribution.expertise_id', '{n}.0');
		$this->set(compact('distributed'));

		//$this->request->data['Distribution']['registration_id'] = $registration_id;
		if ($this->request->is('post')) {
			unset($this->request->data['Distribution']['distributor']);
			//$posted_counts = Hash::reduce($this->request->data, '{n}.Distribution.count', function($v, $w)
																		// {
																			// $v += $w;
																			// return $v;
																		// });
			$this->request->data = $this->request->data['Distribution'];
			$totals_posted = array();
			$key = 0;
			//суммируем вес и количество пришедших с поста данных и группируем по ид экспертизы
			foreach ($this->request->data as $item) {
				$key = $item['expertise_id'];
				if (!array_key_exists($key, $totals_posted)) {
					$totals_posted[$key] = array(
						'count' => $item['count'],
						'weight' => $item['weight'],
					);
				} else {
					$totals_posted[$key]['count'] = $totals_posted[$key]['count'] + $item['count'];
					$totals_posted[$key]['weight'] = $totals_posted[$key]['weight'] + $item['weight'];
				}
				$key++;
			}

			foreach ($totals_posted as $key => $value) {
				$count_to_check = round((isset($distributed[$key])?$distributed[$key]['count']:0) + $value['count'],2);
				$weight_to_check = round((isset($distributed[$key])?$distributed[$key]['weight']:0)+$value['weight'],2);
				
				if(/*$totals[$key]['count'] < $count_to_check||*/ $totals[$key]['conclusion_weight'] < $weight_to_check) {
					$this->Session->setFlash('Общий вес для одной из экспертиз был превышен, данные не сохранены', 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					), 'danger');
					$this->redirect(array('controller' => 'distributions', 'action' => 'add', $registration_id));
				}
			}

			$this->Distribution->create();
            if ($this->Distribution->saveMany($this->request->data)) {
				$this->Session->setFlash('Запись добавлена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('controller' => 'registrations', 'action' => 'overview', $registration_id));
			} else {
				$this->Session->setFlash('Ошибка.'/*.print_r($this->Distribution->validationErrors, true)*/, 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				), 'danger');
			}
		}
		
		//продукция
		$productions = $this->Distribution->Production->find('list', array('conditions' => array(
			'production_type_id'=>$registration['Registration']['production_type_id'],
			'id IN (SELECT production_id FROM expertises WHERE registration_id='. $registration['Registration']['id'] .')'
		)));
		$this->set(compact('productions'));
		
		//экспертизы
		$expertises = $this->Distribution->Expertise->find('list', array('conditions'=>array('Expertise.registration_id' => $registration_id)));
		$this->Distribution->Expertise->unbindModel(array('hasMany' => array('Research', 'Ban', 'Sample', 'Distribution')));
		$this->Distribution->Expertise->unbindModel(array('hasAndBelongsToMany' => array('Detection')));
		$expertises_notes = $this->Distribution->Expertise->find('all', array('fields'=>array('id','note'),'conditions'=>array('Expertise.registration_id' => $registration_id)));
		$expertises_notes = Hash::combine($expertises_notes, '{n}.Expertise.id', array('%s', '{n}.Expertise.note'));
		$this->set(compact('expertises_notes'));
		$this->set(compact('expertises'));
		$this->set(compact('registration'));
	}

	public function edit($id=null) {

		$this->Distribution->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Distribution->Expertise->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Distribution->Production->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Distribution->Expertise->Detection->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Distribution->setDataSource('region'. $this->Auth->user('region_id'));
		
		$this->set('title_for_layout', 'Редактирование распределения продукции по точкам');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}

		$distribution = $this->Distribution->findById($id);
		if (!$distribution) {
			throw new NotFoundException("Несуществующая запись");
		}

		if (!$this->request->data) {
			$this->request->data = $distribution;
		}

		//общие количество и вес допустимые в экспертизе к распределению
		$totals_query = "SELECT Expertise.id, Expertise.count,
						 ROUND((Expertise.domestic_weight + Expertise.foreign_weight - Expertise.samples_weight - IFNULL((SELECT SUM(b.weight) FROM bans AS b WHERE b.expertise_id=Expertise.id GROUP BY Expertise.id),0)),2) as Expertise__conclusion_weight
						 FROM expertises as Expertise
						 WHERE Expertise.id =".$this->request->data['Distribution']['expertise_id']."
						 GROUP BY Expertise.id";
		$totals = Hash::extract($this->Distribution->query($totals_query),'0.Expertise');
		$this->set(compact('totals'));

		//количество и вес уже разпределенные без редактируемого распределения
		$distributed_query = "SELECT Distribution.expertise_id, ROUND(SUM(Distribution.weight),2) AS weight, SUM(Distribution.count) AS count FROM distributions AS Distribution
						WHERE Distribution.expertise_id = ".$this->request->data['Distribution']['expertise_id']."
						AND Distribution.id<>".$id."
						GROUP BY Distribution.expertise_id";
		$distributed = Hash::extract($this->Distribution->query($distributed_query), '0.0');
		$this->set(compact('distributed'));

		if ($this->request->is('post') || $this->request->is('put')) {
			$count_to_check = round((isset($distributed['count'])?$distributed['count']:0) + $this->request->data['Distribution']['count'],2);
			$weight_to_check = round((isset($distributed['weight'])?$distributed['weight']:0) + $this->request->data['Distribution']['weight'],2);
			
			if(/*$totals['count'] < $count_to_check||*/$totals['conclusion_weight'] < $weight_to_check) {
				$this->Session->setFlash('Общий вес или количество для экспертизы были превышены, данные не сохранены', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				), 'danger');
			} else {
				$this->Distribution->id = $id;
				if ($this->Distribution->save($this->request->data)) {
					$this->Session->setFlash('Запись изменена', 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
					), 'success');
					$this->redirect(array('controller' => 'registrations', 'action' => 'overview', $distribution['Distribution']['registration_id']));
				} else {
					$this->Session->setFlash('Не удалось сохранить изменения', 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					), 'danger');
				}
			}
		}
		
		//продукция
		$productions = $this->Distribution->Production->find('list', array('conditions' => array(
			'production_type_id'=>$distribution['Registration']['production_type_id'],
			'id IN (SELECT production_id FROM expertises WHERE registration_id='. $distribution['Registration']['id'] .')'
		)));
		$this->set(compact('productions'));
		
		//экспертизы
		$expertises = $this->Distribution->Expertise->find('list', array('conditions'=>array('Expertise.registration_id' => $distribution['Registration']['id'])));
		$this->set(compact('expertises'));
		$this->set('distribution', $distribution);
	}

	//автоматическое распределение продукции
	public function autofill($registration_id) {
	
		if (!$registration_id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$this->Distribution->Expertise->unbindModel(array('hasMany' => array('Research', 'Ban', 'Sample', 'Distribution')));
		$this->Distribution->Expertise->unbindModel(array('hasAndBelongsToMany' => array('Detection')));
		$expertises = $this->Distribution->Expertise->find('all', array('conditions' => array('Expertise.registration_id' => $registration_id)));

		$distributions = array();
		foreach ($expertises as $expertise) {
			array_push($distributions, array(
				'registration_id' 	=> $registration_id,
				'expertise_id' 		=> $expertise['Expertise']['id'],
				'distributor' 			=> $expertise['Registration']['owner'],
				'production_id' 		=> $expertise['Expertise']['production_id'],
				'count' 					=> $expertise['Expertise']['count'],
				//'weight' 				=> $expertise['Expertise']['domestic_weight'] + $expertise['Expertise']['foreign_weight'],
				'weight' 				=> $expertise['Expertise']['conclusion_weight'],
				'note' 					=> $expertise['Expertise']['note'],
				'places' 				=> '1'
			));
		}

		if ($this->Distribution->saveMany($distributions)) {
			$this->Session->setFlash('Продукция автоматически распределена', 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-success'
			), 'success');
			$this->redirect(array('controller' => 'registrations', 'action' => 'overview', $registration_id));
		} else {
			$this->Session->setFlash('Не удалось автоматически распределить', 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-danger'
			), 'danger');
			$this->redirect(array('controller' => 'registrations', 'action' => 'overview', $registration_id));
		}
	}

	//пагинация
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('Distribution.id' => 'asc')
		);
		$distributions = $this->Paginator->paginate('Distribution');
		$this->set('distributions', $distributions);
	}

	//удаление
	public function delete($id) {
		if ($this->Distribution->delete($id)) {
			$this->Session->setFlash('Запись #'.$id.' удалена', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect('/registrations');
		}
	}
}
?>
