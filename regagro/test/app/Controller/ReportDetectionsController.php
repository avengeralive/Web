<?php
// app/Controller/ReportDetectionsController.php

class ReportDetectionsController extends AppController {

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
			$this->userActions[] = array('title'=>'Виды выявлений','url'=>Router::url(array('controller'=>'detection_types','action'=>'index')));
		}
		parent::beforeRender();
	}
	
	public function getByDetectionType() {
		$detection_type_id = $this->request->data['detection_type_id'];
 
		$reportDetections = $this->ReportDetection->find('list', array(
			'conditions' => array('ReportDetection.detection_type_id' => $detection_type_id),
			'recursive' => -1
			));
 
		$this->set('reportDetections',$reportDetections);
		$this->layout = 'ajax';
	}
	
	public function add() {
		$this->set('title_for_layout', 'Добавление нового выявления (отчет)');
        if ($this->request->is('post')) {
            $this->ReportDetection->create();
            if ($this->ReportDetection->save($this->request->data)) {
				$this->Session->setFlash('Запись добавлена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
		
		$detectionTypes = $this->ReportDetection->DetectionType->find('list');
		$this->set(compact('detectionTypes'));
		$this->render('edit');
	}
	
	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование выявления (отчет)');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$reportDetection = $this->ReportDetection->findById($id);
		if (!$reportDetection) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		if (!$this->request->data) {
			$this->request->data = $reportDetection;
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->ReportDetection->id = $id;
            if ($this->ReportDetection->save($this->request->data)) {
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
		
		$detectionTypes = $this->ReportDetection->DetectionType->find('list');
		$this->set(compact('detectionTypes'));
		$this->set('reportDetection', $reportDetection);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('ReportDetection.name'=>'asc')
		);
		$detectionTypes = $this->ReportDetection->DetectionType->find('list');
		$this->set(compact('detectionTypes'));
		$reportDetections = $this->Paginator->paginate('ReportDetection');
		$this->set('reportDetections', $reportDetections);
	}
	
	public function delete($id) {
		if ($this->ReportDetection->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>