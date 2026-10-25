<?php
// app/Controller/VetlabsController.php

class VetlabsController extends AppController {

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
		$this->set('title_for_layout', 'Добавление ветеринарной лаборатории');
        if ($this->request->is('post')) {
            $this->Vetlab->create();
            if ($this->Vetlab->save($this->request->data)) {
				$this->Session->setFlash('Запись добавлена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
		$organs = $this->Vetlab->Organ->find('list');
		$this->set(compact('organs'));
		$this->render('edit');
	}
	
	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование ветеринарной лаборатории');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$vetlab = $this->Vetlab->findById($id);
		if (!$vetlab) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		if (!$this->request->data) {
			$this->request->data = $vetlab;
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Vetlab->id = $id;
            if ($this->Vetlab->save($this->request->data)) {
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
		$regions = $this->Vetlab->Region->find('list');
		$this->set(compact('regions'));

		$districts = $this->Vetlab->District->find('list', array(
			'conditions' => array('District.region_id' => $this->request->data['Vetlab']['region_id']),
			'recursive' => -1
		));

		$this->set(compact('districts'));

		$organs = $this->Vetlab->Organ->find('list', array(
			'conditions' => array('Organ.region_id' => $this->request->data['Vetlab']['region_id']),
			'recursive' => -1
		));
		$this->set(compact('organs'));
		
		$this->set('vetlab', $vetlab);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('Vetlab.name'=>'asc')
		);
		$vetlabs = $this->Paginator->paginate('Vetlab');
		//$organs = $this->Vetlab->Organ->find('list');
		//$this->set(compact('organs'));
		$this->set('vetlabs', $vetlabs);
		
		$regions = $this->Vetlab->Region->find('list');
		$this->set(compact('regions'));
		
		//$districts = $this->Vetlab->District->find('list');
		//$this->set(compact('districts'));
	}
	
	public function delete($id) {
		if ($this->Vetlab->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function getByRegion() {
		$region_id = $this->request->data['Vetlab']['region_id'];
		
		$districts = $this->Vetlab->District->find('list', array(
			'conditions' => array('District.region_id' => $region_id),
			'recursive' => -1
		));
		$this->set('districts', $districts);
		$this->layout = 'ajax';
	}

	public function getOrganByRegion() {
		$region_id = $this->request->data['Vetlab']['region_id'];
		
		$organs = $this->Vetlab->Organ->find('list', array(
			'conditions' => array('Organ.region_id' => $region_id),
			'recursive' => -1
		));
		$this->set('organs', $organs);
		$this->layout = 'ajax';
	}
}
?>