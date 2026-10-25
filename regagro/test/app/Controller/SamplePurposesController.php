<?php
// app/Controller/SamplePurposesController.php

class SamplePurposesController extends AppController {

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
		$this->set('title_for_layout', 'Добавление новой цели исследования');
        if ($this->request->is('post')) {
            $this->SamplePurpose->create();
            if ($this->SamplePurpose->save($this->request->data)) {
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
		$this->set('title_for_layout', 'Редактирование цели исследования');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$samplePurpose = $this->SamplePurpose->findById($id);
		if (!$samplePurpose) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		if (!$this->request->data) {
			$this->request->data = $samplePurpose;
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->SamplePurpose->id = $id;
            if ($this->SamplePurpose->save($this->request->data)) {
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
		
		$this->set('samplePurpose', $samplePurpose);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('SamplePurpose.name'=>'asc')
		);
		$samplePurposes = $this->Paginator->paginate('SamplePurpose');
		$this->set('samplePurposes', $samplePurposes);
	}
	
	public function delete($id) {
		if ($this->SamplePurpose->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>