<?php
// app/Controller/ConclusionsController.php

class ConclusionsController extends AppController {

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
		$this->set('title_for_layout', 'Добавление нового заключения');
        if ($this->request->is('post')) {
            $this->Conclusion->create();
            if ($this->Conclusion->save($this->request->data)) {
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
		$this->set('title_for_layout', 'Редактирование заключения');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$conclusion = $this->Conclusion->findById($id);
		if (!$conclusion) {
			throw new NotFoundException("Несуществующая запись");
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Conclusion->id = $id;
            if ($this->Conclusion->save($this->request->data)) {
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
			$this->request->data = $conclusion;
		}
		
		$this->set('conclusion', $conclusion);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('Conclusion.name'=>'asc')
		);
		$conclusions = $this->Paginator->paginate('Conclusion');
		$this->set('conclusions', $conclusions);
	}
	
	public function delete($id) {
		if ($this->Conclusion->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>