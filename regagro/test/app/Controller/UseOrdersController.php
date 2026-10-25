<?php
// app/Controller/UseOrdersController.php

class UseOrdersController extends AppController {

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
		$this->set('title_for_layout', 'Добавление нового порядка использования');
        if ($this->request->is('post')) {
            $this->UseOrder->create();
            if ($this->UseOrder->save($this->request->data)) {
				$this->Session->setFlash('Запись добавлена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
		
		$this->render('edit');
	}
	
	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование порядка использования');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$useOrder = $this->UseOrder->findById($id);
		if (!$useOrder) {
			throw new NotFoundException("Несуществующая запись");
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->UseOrder->id = $id;
            if ($this->UseOrder->save($this->request->data)) {
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
		
		if (!$this->request->data) {
			$this->request->data = $useOrder;
		}
		
		$this->set('useOrder', $useOrder);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('UseOrder.name'=>'asc')
		);
		$useOrders = $this->Paginator->paginate('UseOrder');
		$this->set('useOrders', $useOrders);
	}
	
	public function delete($id) {
		if ($this->UseOrder->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>