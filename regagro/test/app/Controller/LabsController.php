<?php
// app/Controller/LabsController.php

class LabsController extends AppController {

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
				$labs = $this->Lab->find('all');
				$labs = array_merge(array(array('Lab'=>array('id'=>'all','name'=>'все'))), $labs);
			} else if ($this->Auth->user('organ_id')&&$this->Auth->user('organ_id')!=0) {
				$labs = $this->Lab->find('all', 
									array('conditions'=>array('Lab.institution_id IN (SELECT id FROM institutions WHERE organ_id='.$this->Auth->user('organ_id').')'))
								);
				$labs = array_merge(array(array('Lab'=>array('id'=>'all','name'=>'все'))), $labs);
			} else if ($this->Auth->user('institution_id')&&$this->Auth->user('institution_id')!=0) {
				$labs = $this->Lab->find('all', 
									array('conditions'=>array('Lab.institution_id'=>$this->Auth->user('institution_id')))
								);
				$labs = array_merge(array(array('Lab'=>array('id'=>'all','name'=>'все'))), $labs);
			} else {
				$lab_id = $this->Auth->user('lab_id');
				$labs = $this->Lab->find('all', array('conditions'=>array('Lab.id'=>$lab_id)));
			}
		} else 
		{
			if($this->request->params['ext']=='json'){
				$labs = $this->Lab->find('all', array(
					'conditions' => array('Lab.institution_id' => $institution_id)
					));
				$labs = array_merge(array(array('Lab'=>array('id'=>'all','name'=>'все'))), $labs);
			} else {
				$labs = $this->Lab->find('list', array(
					'conditions' => array('Lab.institution_id' => $institution_id),
					'recursive' => -1
					));
				//$labs = array('all'=>'все') + $labs;
				$labs = array_merge(array('all'=>'все'), $labs);
			}
		}
		$this->set('labs', $labs);
		$this->layout = 'ajax';
	}
	
	public function add() {
		$this->set('title_for_layout', 'Добавление новой лаборатории');
        if ($this->request->is('post')) {
            $this->Lab->create();
            if ($this->Lab->save($this->request->data)) {
				$this->Session->setFlash('Запись добавлена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
		$regions = $this->Lab->Region->find('list');
		$this->set(compact('regions'));
		/*$districts = $this->Lab->District->find('list');
		$this->set(compact('districts'));
		$organs = $this->Lab->Organ->find('list');
		$this->set(compact('organs'));
		$institutions = $this->Lab->Institution->find('list');
		$this->set(compact('institutions'));*/
		$this->render('edit');
	}
	
	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование лаборатории');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$lab = $this->Lab->findById($id);
		if (!$lab) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		if (!$this->request->data) {
			$this->request->data = $lab;
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Lab->id = $id;
            if ($this->Lab->save($this->request->data)) {
				$this->Session->setFlash('Запись изменена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Не удалось сохранить изменения.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				), 'danger');
			}
		}
		
		$regions = $this->Lab->Region->find('list');
		$this->set(compact('regions'));
		$districts = $this->Lab->District->find('list', array(
			'conditions' => array('District.region_id' => $this->request->data['Lab']['region_id']),
			'recursive' => -1
		));
		$this->set(compact('districts'));
		$organs = $this->Lab->Organ->find('list', array(
			'conditions' => array('Organ.region_id' => $this->request->data['Lab']['region_id']),
			'recursive' => -1
		));
		$this->set(compact('organs'));
		$institutions = $this->Lab->Institution->find('list', array(
			'conditions' => array('Institution.organ_id' => $this->request->data['Lab']['organ_id']),
			'recursive' => -1
		));
		$this->set(compact('institutions'));
		$this->set('lab', $lab);
	}
	
	public function index() {
		if (isset($this->request->data['Lab']['institution_id']) && $this->request->data['Lab']['institution_id'] != 0) {
			if (isset($this->request->data['Lab']['district_id']) && $this->request->data['Lab']['district_id'] != 0) {
				$this->Paginator->settings = array(
					'limit' => 30,
					'conditions' => array('Lab.institution_id' => $this->request->data['Lab']['institution_id'], 'Lab.district_id' => $this->request->data['Lab']['district_id']),
					'order' => array('Lab.name'=>'asc')
				);
			}
			else {
				$this->Paginator->settings = array(
					'limit' => 30,
					'conditions' => array('Lab.institution_id' => $this->request->data['Lab']['institution_id']),
					'order' => array('Lab.name'=>'asc')
				);
			}
		}
		else if (isset($this->request->data['Lab']['organ_id']) && $this->request->data['Lab']['organ_id'] != 0) {
			if (isset($this->request->data['Lab']['district_id']) && $this->request->data['Lab']['district_id'] != 0) {
				$this->Paginator->settings = array(
					'limit' => 30,
					'conditions' => array('Lab.organ_id' => $this->request->data['Lab']['organ_id'], 'Lab.district_id' => $this->request->data['Lab']['district_id']),
					'order' => array('Lab.name'=>'asc')
				);
			}
			else {
				$this->Paginator->settings = array(
					'limit' => 30,
					'conditions' => array('Lab.organ_id' => $this->request->data['Lab']['organ_id']),
					'order' => array('Lab.name'=>'asc')
				);
			}
		}
		else if (isset($this->request->data['Lab']['district_id']) && $this->request->data['Lab']['district_id'] != 0) {
			$this->Paginator->settings = array(
				'limit' => 30,
				'conditions' => array('Lab.district_id' => $this->request->data['Lab']['district_id']),
				'order' => array('Lab.name'=>'asc')
			);
		}
		else if (isset($this->request->data['Lab']['region_id']) && $this->request->data['Lab']['region_id'] != 0) {
			$this->Paginator->settings = array(
				'limit' => 30,
				'conditions' => array('Lab.region_id' => $this->request->data['Lab']['region_id']),
				'order' => array('Lab.name'=>'asc')
			);
		}
		else {
			$this->Paginator->settings = array(
				'limit' => 30,
				'order' => array('Lab.name'=>'asc')
			);
		}
		
		$regions = $this->Lab->Region->find('list');
		$this->set(compact('regions'));
		if (isset($this->request->data['Lab'])) {
			$districts = $this->Lab->District->find('list', array(
				'conditions' => array('District.region_id' => $this->request->data['Lab']['region_id']),
				'recursive' => -1
			));
			$this->set(compact('districts'));
			$organs = $this->Lab->Organ->find('list', array(
				'conditions' => array('Organ.region_id' => $this->request->data['Lab']['region_id']),
				'recursive' => -1
			));
			$this->set(compact('organs'));
			$institutions = $this->Lab->Institution->find('list', array(
				'conditions' => array('Institution.organ_id' => $this->request->data['Lab']['organ_id']),
				'recursive' => -1
			));
			$this->set(compact('institutions'));
		}
		/*$districts = $this->Lab->District->find('list');
		$this->set(compact('districts'));
		$organs = $this->Lab->Organ->find('list');
		$this->set(compact('organs'));
		$institutions = $this->Lab->Institution->find('list');
		$this->set(compact('institutions'));*/
		
		
		
		
		
		
		//var_dump($organ);

		$labs = $this->Paginator->paginate('Lab');
		$this->set('labs', $labs);
	}
	
	public function delete($id) {
		if ($this->Lab->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}


	public function getByRegion() {
		$region_id = $this->request->data['Lab']['region_id'];
		
		$districts = $this->Lab->District->find('list', array(
			'conditions' => array('District.region_id' => $region_id),
			'recursive' => -1
		));
		$this->set('districts', $districts);
		$this->layout = 'ajax';
	}

	public function getOrganByRegion() {
		$region_id = $this->request->data['Lab']['region_id'];
		
		$organs = $this->Lab->Organ->find('list', array(
			'conditions' => array('Organ.region_id' => $region_id),
			'recursive' => -1
		));
		$this->set('organs', $organs);
		$this->layout = 'ajax';
	}

	public function getByOrgan() {
		$organ_id = $this->request->data['Lab']['organ_id'];
		
		$institutions = $this->Lab->Institution->find('list', array(
			'conditions' => array('Institution.organ_id' => $organ_id),
			'recursive' => -1
		));
		$this->set('institutions', $institutions);
		$this->layout = 'ajax';
	}
}
?>