<?php
// app/Controller/RegionsController.php

class RegionsController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	public function beforeRender() {
		if ($this->Auth->user('role') === 'Администратор') {
			$this->userActions[] = array('title'=>'Пользователи','url'=>Router::url(array('controller'=>'users','action'=>'index')));
			$this->userActions[] = array('title'=>'Справочники','url'=>Router::url(array('controller'=>'pages','action'=>'lists')));
		}
		parent::beforeRender();
	}

	public function add() {
		$this->set('title_for_layout', 'Добавление нового региона');
        if ($this->request->is('post')) {
            $this->Region->create();
            if ($this->Region->save($this->request->data)) {
				$this->Session->setFlash('Регион добавлен.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование региона');
		if (!$id) {
			throw new NotFoundException("Несуществующий регион");
		}
		
		$region = $this->Region->findById($id);
		if (!$region) {
			throw new NotFoundException("Несуществующий регион");
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Region->id = $id;
            if ($this->Region->save($this->request->data)) {
				$this->Session->setFlash('Регион изменен.', 'alert', array(
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
		
		if (!$this->request->data) {
			$this->request->data = $region;
		}
		
		$this->set('region', $region);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('Region.name'=>'asc')
		);
		$regions = $this->Paginator->paginate('Region');
		$this->set('regions', $regions);
	}
	
	public function delete($id) {
		if ($this->Region->delete($id)) {
			$this->Session->setFlash('Регион с ИД '.$id.' удален.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>