<?php
// app/Controller/OrgansController.php

class OrgansController extends AppController {

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
		$this->set('title_for_layout', 'Добавление нового органа управления ветеринарии');
        if ($this->request->is('post')) {
            $this->Organ->create();
            if ($this->Organ->save($this->request->data)) {
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
		$this->set('title_for_layout', 'Редактирование органа управления ветеринарии');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$organ = $this->Organ->findById($id);
		if (!$organ) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		if (!$this->request->data) {
			$this->request->data = $organ;
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Organ->id = $id;
            if ($this->Organ->save($this->request->data)) {
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

		$regions = $this->Organ->Region->find('list');
		$this->set(compact('regions'));
		
		$this->set('organ', $organ);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('Organ.name'=>'asc')
		);
		$regions = $this->Organ->Region->find('list');
		$this->set(compact('regions'));

		$organs = $this->Paginator->paginate('Organ');
		$this->set('organs', $organs);
	}
	
	public function delete($id) {
		if ($this->Organ->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>