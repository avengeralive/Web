<?php
// app/Controller/DetectionTypesController.php

class DetectionTypesController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	public function beforeRender() {
		if ($this->Auth->user('role') === 'Администратор') {
			$this->userActions[] = array('title'=>'Справочники','url'=>Router::url(array('controller'=>'pages','action'=>'lists')));
			$this->userActions[] = array('title'=>'Выявления','url'=>Router::url(array('controller'=>'detections','action'=>'index')));
			$this->userActions[] = array('title'=>'Выявления (отчет)','url'=>Router::url(array('controller'=>'report_detections','action'=>'index')));
		}
		parent::beforeRender();
	}

	public function add() {
		$this->set('title_for_layout', 'Добавление нового вида выявления');
        if ($this->request->is('post')) {
            $this->DetectionType->create();
            if ($this->DetectionType->save($this->request->data)) {
				$this->Session->setFlash('Запись добавлена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование вида выявления');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$detectionType = $this->DetectionType->findById($id);
		if (!$detectionType) {
			throw new NotFoundException("Несуществующая запись");
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->DetectionType->id = $id;
            if ($this->DetectionType->save($this->request->data)) {
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
			$this->request->data = $detectionType;
		}
		
		$this->set('detectionType', $detectionType);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('DetectionType.name'=>'asc')
		);
		$detectionTypes = $this->Paginator->paginate('DetectionType');
		$this->set('detectionTypes', $detectionTypes);
	}
	
	public function delete($id) {
		if ($this->DetectionType->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>