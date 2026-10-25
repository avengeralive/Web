<?php
// app/Controller/DistrictsController.php

class DistrictsController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	var $helpers = array('Html', 'Js', 'Paginator');
	
	public function beforeFilter() {
		parent::beforeFilter();
		if (in_array($this->Auth->user('role'),  array('Сотрудник','Администратор', 'Администратор учреждения'))) {
			$this->Auth->allow('getByRegion');
		}
	}
	
	public function getByRegion() {
		$region_id = $this->request->data['region_id'];
		
		if($this->request->params['ext']=='json'){
			$districts = $this->District->find('all', array(
				'conditions' => array('District.region_id' => $region_id),
				'recursive' => -1
				));
		} else {
			$districts = $this->District->find('list', array(
				'conditions' => array('District.region_id' => $region_id),
				'recursive' => -1
				));
		}
		$this->set('districts', $districts);
		$this->layout = 'ajax';
	}
	
	public function add() {
		$this->set('title_for_layout', 'Добавление нового района');
        if ($this->request->is('post')) {
            $this->District->create();
            if ($this->District->save($this->request->data)) {
				$this->Session->setFlash('Район добавлен.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('controller'=>'regions','action' => 'edit', $this->request->data['District']['region_id']));
			}
		}
		$regions = $this->District->Region->find('list');
		$this->set(compact('regions'));
	}
	
	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование района');
		if (!$id) {
			throw new NotFoundException("Несуществующий район");
		}
		
		$district = $this->District->findById($id);
		if (!$district) {
			throw new NotFoundException("Несуществующий район");
		}
		
		if (!$this->request->data) {
			$this->request->data = $district;
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->District->id = $id;
            if ($this->District->save($this->request->data)) {
				$this->Session->setFlash('Район изменен.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('controller'=>'regions','action' => 'edit', $this->request->data['District']['region_id']));
			} else {
				$this->Session->setFlash('Не удалось сохранить изменения.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				), 'danger');
			}
		}
		
		$regions = $this->District->Region->find('list');
		$this->set(compact('regions'));
		$this->render('add');
	}
	
	public function index() {
		$districts = $this->Paginator->paginate('District');
		$this->set('districts', $districts);
	}
	
	public function delete($id) {
		if ($this->District->delete($id)) {
			$this->Session->setFlash('Район с ИД '.$id.' удален.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			$this->redirect($this->referer());
		}
	}
}
?>