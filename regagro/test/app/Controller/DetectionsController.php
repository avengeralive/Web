<?php
// app/Controller/DetectionsController.php

class DetectionsController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	public function beforeRender() {
		if ($this->Auth->user('role') === 'Администратор') {
			$this->userActions[] = array('title'=>'Справочники','url'=>Router::url(array('controller'=>'pages','action'=>'lists')));
			$this->userActions[] = array('title'=>'Выявления (отчет)','url'=>Router::url(array('controller'=>'report_detections','action'=>'index')));
			$this->userActions[] = array('title'=>'Виды выявлений','url'=>Router::url(array('controller'=>'detection_types','action'=>'index')));
		}
		parent::beforeRender();
	}
	
	public function add() {
		$this->set('title_for_layout', 'Добавление нового выявления');
        if ($this->request->is('post')) {
			$reportDetection = $this->Detection->ReportDetection->findById($this->request->data['Detection']['report_detection_id']);
			if ($reportDetection['ReportDetection']['detection_type_id']!=$this->request->data['Detection']['detection_type_id'])
			{
				$this->Session->setFlash('Выбранный вид выявления не соответствует выбранному названию выявления для отчета.', 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					), 'danger');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Detection->create();
				if ($this->Detection->save($this->request->data)) {
					$this->Session->setFlash('Запись добавлена.', 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-success'
					), 'success');
					$this->redirect(array('action' => 'index'));
				}
			}
		}
		
		$productionTypes = $this->Detection->ProductionType->find('list');
		$this->set(compact('productionTypes'));
		$detectionTypes = $this->Detection->DetectionType->find('list');
		$this->set(compact('detectionTypes'));
		//$reportDetections = $this->Detection->ReportDetection->find('list');
		//$this->set(compact('reportDetections'));
		$this->render('edit');
	}
	
	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование выявления');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$detection = $this->Detection->findById($id);
		if (!$detection) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		if (!$this->request->data) {
			$this->request->data = $detection;
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$reportDetection = $this->Detection->ReportDetection->findById($this->request->data['Detection']['report_detection_id']);
			if ($reportDetection['ReportDetection']['detection_type_id']!=$this->request->data['Detection']['detection_type_id'])
			{
				$this->Session->setFlash('Выбранный вид выявления не соответствует выбранному названию выявления для отчета.', 'alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					), 'danger');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Detection->id = $id;
				if ($this->Detection->save($this->request->data)) {
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
		}
		$productionTypes = $this->Detection->ProductionType->find('list');
		$this->set(compact('productionTypes'));
		$detectionTypes = $this->Detection->DetectionType->find('list');
		$this->set(compact('detectionTypes'));
		$reportDetections = $this->Detection->ReportDetection->find('list', array('conditons'=>array('detection_type_id'=>$this->request->data['Detection']['detection_type_id'])));
		$this->set(compact('reportDetections'));
		$this->set('detection', $detection);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('Detection.name'=>'asc')
		);
		$productionTypes = $this->Detection->ProductionType->find('list');
		$this->set(compact('productionTypes'));
		$detectionTypes = $this->Detection->DetectionType->find('list');
		$this->set(compact('detectionTypes'));
		//$reportDetections = $this->Detection->ReportDetection->find('list');
		//$this->set(compact('reportDetections'));
		$detections = $this->Paginator->paginate('Detection');
		$this->set('detections', $detections);
	}
	
	public function delete($id) {
		if ($this->Detection->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>