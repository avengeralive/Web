<?php
// app/Controller/InstitutionsController.php

class InstitutionsController extends AppController {

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
	
	public function add() {
		$this->set('title_for_layout', 'Добавление нового учреждения ветеринарии');
        if ($this->request->is('post')) {
            $this->Institution->create();
            if ($this->Institution->save($this->request->data)) {
				$this->Session->setFlash('Запись добавлена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
		$organs = $this->Institution->Organ->find('list');
		$this->set(compact('organs'));
		//$this->render('edit');
	}
	
	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование учреждения ветеринарии');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$institution = $this->Institution->findById($id);
		if (!$institution) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		if (!$this->request->data) {
			$this->request->data = $institution;
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Institution->id = $id;
            if ($this->Institution->save($this->request->data)) {
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
		
		//$organs = $this->Institution->Organ->find('list');
		//$this->set(compact('organs'));
		$regions = $this->Institution->Region->find('list');
		$this->set(compact('regions'));
		$districts = $this->Institution->District->find('list', array(
				'conditions' => array('District.region_id' => $this->request->data['Institution']['region_id']),
				'recursive' => -1
			));
			$this->set(compact('districts'));
			$organs = $this->Institution->Organ->find('list', array(
				'conditions' => array('Organ.region_id' => $this->request->data['Institution']['region_id']),
				'recursive' => -1
			));
			$this->set(compact('organs'));
		//$districts = $this->Institution->District->find('list');
		//$this->set(compact('districts'));
		$this->set('institution', $institution);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('Institution.name'=>'asc')
		);
		/*$organs = $this->Institution->Organ->find('list');
		$this->set(compact('organs'));*/
		$regions = $this->Institution->Region->find('list');
		$this->set(compact('regions'));
		/*$districts = $this->Institution->District->find('list');
		$this->set(compact('districts'));*/
		$institutions = $this->Paginator->paginate('Institution');
		$this->set('institutions', $institutions);
		
	}
	
	public function delete($id) {
		if ($this->Institution->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function getByRegion() {
		$region_id = $this->request->data['Institution']['region_id'];
		
		$districts = $this->Institution->District->find('list', array(
			'conditions' => array('District.region_id' => $region_id),
			'recursive' => -1
		));
		$this->set('districts', $districts);
		$this->layout = 'ajax';
	}

	public function getOrganByRegion() {
		$region_id = $this->request->data['Institution']['region_id'];
		
		$organs = $this->Institution->Organ->find('list', array(
			'conditions' => array('Organ.region_id' => $region_id),
			'recursive' => -1
		));
		$this->set('organs', $organs);
		$this->layout = 'ajax';
	}
}
?>