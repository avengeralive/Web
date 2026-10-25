<?php
// app/Controller/UpController.php

class UpController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	public function beforeRender() {
		if ($this->Auth->user('role') === 'Администратор') {
			$this->userActions[] = array('title'=>'Справочники','url'=>Router::url(array('controller'=>'pages','action'=>'lists')));
		}
		
		parent::beforeRender();
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		if (in_array($this->Auth->user('role'),  array('Сотрудник','Администратор'))) {
			$this->Auth->allow('getByInstitution');
		}
	}
    
    public function getByInstitution() {
		$institution_id = $this->request->data['institution_id'];
		
		if ($institution_id=='all')
		{
			if (in_array($this->Auth->user('role'), array('Администратор'))) {
				$up = $this->Up->find('all');
				$up = array_merge(array(array('Ups'=>array('id'=>'all','name'=>'все'))), $up);
			} else if ($this->Auth->user('organ_id')&&$this->Auth->user('organ_id')!=0) {
				$up = $this->Up->find('all', 
									array('conditions'=>array('Ups.institution_id IN (SELECT id FROM institutions WHERE organ_id='.$this->Auth->user('organ_id').')'))
								);
				$up = array_merge(array(array('Ups'=>array('id'=>'all','name'=>'все'))), $up);
			} else if ($this->Auth->user('institution_id')&&$this->Auth->user('institution_id')!=0) {
				$up = $this->Up->find('all', 
									array('conditions'=>array('Ups.institution_id'=>$this->Auth->user('institution_id')))
								);
				$up = array_merge(array(array('Ups'=>array('id'=>'all','name'=>'все'))), $up);
			} else {
				$lab_id = $this->Auth->user('lab_id');
				$up = $this->Up->find('all', array('conditions'=>array('Up.id'=>$lab_id)));
			}
		} else 
		{
			if($this->request->params['ext']=='json'){
				$up = $this->Up->find('all', array(
					'conditions' => array('Ups.institution_id' => $institution_id)
					));
				$up = array_merge(array(array('Ups'=>array('id'=>'all','name'=>'все'))), $up);
			} else {
				$up = $this->Up->find('list', array(
					'conditions' => array('Ups.institution_id' => $institution_id),
					'recursive' => -1
					));
				//$up = array('all'=>'все') + $up;
				$up = array_merge(array('all'=>'все'), $up);
			}
		}
		$this->set('ups', $up);
		$this->layout = 'ajax';
	}
	
	public function add() {
		$this->set('title_for_layout', 'Добавление убойного пункта');
        if ($this->request->is('post')) {
            $this->Up->create();
            if ($this->Up->save($this->request->data)) {
				$this->Session->setFlash('Запись добавлена', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
		$regions = $this->Up->Region->find('list');
		$this->set(compact('regions'));
		/*$districts = $this->Up->District->find('list');
		$this->set(compact('districts'));
		$organs = $this->Up->Organ->find('list');
		$this->set(compact('organs'));
		$institutions = $this->Up->Institution->find('list');
		$this->set(compact('institutions'));*/
		//$this->render('edit');
	}
	
	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование убойного пункта');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$up = $this->Up->findById($id);
		if (!$up) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		if (!$this->request->data) {
			$this->request->data = $up;
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Up->id = $id;
            if ($this->Up->save($this->request->data)) {
				$this->Session->setFlash('Запись изменена', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Не удалось сохранить изменения', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				), 'danger');
			}
		}
		
		$regions = $this->Up->Region->find('list');
		$this->set(compact('regions'));
		$districts = $this->Up->District->find('list', array(
			'conditions' => array('District.region_id' => $this->request->data['Up']['region_id']),
			'recursive' => -1
		));
		$this->set(compact('districts'));
		$organs = $this->Up->Organ->find('list', array(
			'conditions' => array('Organ.region_id' => $this->request->data['Up']['region_id']),
			'recursive' => -1
		));
		$this->set(compact('organs'));
		$institutions = $this->Up->Institution->find('list', array(
			'conditions' => array('Institution.organ_id' => $this->request->data['Up']['organ_id']),
			'recursive' => -1
		));
		$this->set(compact('institutions'));
		$this->set('ups', $up);
	}
	
	public function index() {
		if (isset($this->request->data['Up']['institution_id']) && $this->request->data['Up']['institution_id'] != 0) {
			if (isset($this->request->data['Up']['district_id']) && $this->request->data['Up']['district_id'] != 0) {
				$this->Paginator->settings = array(
					'limit' => 30,
					'conditions' => array('Up.institution_id' => $this->request->data['Up']['institution_id'], 'Up.district_id' => $this->request->data['Up']['district_id']),
					'order' => array('Up.name'=>'asc')
				);
			}
			else {
				$this->Paginator->settings = array(
					'limit' => 30,
					'conditions' => array('Up.institution_id' => $this->request->data['Up']['institution_id']),
					'order' => array('Up.name'=>'asc')
				);
			}
		}
		else if (isset($this->request->data['Up']['organ_id']) && $this->request->data['Up']['organ_id'] != 0) {
			if (isset($this->request->data['Up']['district_id']) && $this->request->data['Up']['district_id'] != 0) {
				$this->Paginator->settings = array(
					'limit' => 30,
					'conditions' => array('Up.organ_id' => $this->request->data['Up']['organ_id'], 'Up.district_id' => $this->request->data['Up']['district_id']),
					'order' => array('Up.name'=>'asc')
				);
			}
			else {
				$this->Paginator->settings = array(
					'limit' => 30,
					'conditions' => array('Up.organ_id' => $this->request->data['Up']['organ_id']),
					'order' => array('Up.name'=>'asc')
				);
			}
		}
		else if (isset($this->request->data['Up']['district_id']) && $this->request->data['Up']['district_id'] != 0) {
			$this->Paginator->settings = array(
				'limit' => 30,
				'conditions' => array('Up.district_id' => $this->request->data['Up']['district_id']),
				'order' => array('Up.name'=>'asc')
			);
		}
		else if (isset($this->request->data['Up']['region_id']) && $this->request->data['Up']['region_id'] != 0) {
			$this->Paginator->settings = array(
				'limit' => 30,
				'conditions' => array('Up.region_id' => $this->request->data['Up']['region_id']),
				'order' => array('Up.name'=>'asc')
			);
		}
		else {
			$this->Paginator->settings = array(
				'limit' => 30,
				'order' => array('Up.name'=>'asc')
			);
		}
		
		$regions = $this->Up->Region->find('list');
		$this->set(compact('regions'));
		if (isset($this->request->data['Up'])) {
			$districts = $this->Up->District->find('list', array(
				'conditions' => array('District.region_id' => $this->request->data['Up']['region_id']),
				'recursive' => -1
			));
			$this->set(compact('districts'));
			$organs = $this->Up->Organ->find('list', array(
				'conditions' => array('Organ.region_id' => $this->request->data['Up']['region_id']),
				'recursive' => -1
			));
			$this->set(compact('organs'));
			$institutions = $this->Up->Institution->find('list', array(
				'conditions' => array('Institution.organ_id' => $this->request->data['Up']['organ_id']),
				'recursive' => -1
			));
			$this->set(compact('institutions'));
		}
		
		
		
		
		
		
		//var_dump($organ);

		$up = $this->Paginator->paginate('Up');
		$this->set('ups', $up);
	}
	
	public function delete($id) {
		if ($this->Up->delete($id)) {
			$this->Session->setFlash('Запись '.$id.' удалена', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}


	public function getByRegion() {
		$region_id = $this->request->data['Up']['region_id'];
		
		$districts = $this->Up->District->find('list', array(
			'conditions' => array('District.region_id' => $region_id),
			'recursive' => -1
		));
		$this->set('districts', $districts);
		$this->layout = 'ajax';
	}

	public function getOrganByRegion() {
		$region_id = $this->request->data['Up']['region_id'];
		
		$organs = $this->Up->Organ->find('list', array(
			'conditions' => array('Organ.region_id' => $region_id),
			'recursive' => -1
		));
		$this->set('organs', $organs);
		$this->layout = 'ajax';
	}

	public function getByOrgan() {
		$organ_id = $this->request->data['Up']['organ_id'];
		
		$institutions = $this->Up->Institution->find('list', array(
			'conditions' => array('Institution.organ_id' => $organ_id),
			'recursive' => -1
		));
		$this->set('institutions', $institutions);
		$this->layout = 'ajax';
	}
}
?>