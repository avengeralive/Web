<?php
// app/Controller/ReportProductionsController.php

class ReportProductionsController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	public function beforeRender() {
		if ($this->Auth->user('role') === 'Администратор') {
			$this->userActions[] = array('title'=>'Справочники','url'=>Router::url(array('controller'=>'pages','action'=>'lists')));
			$this->userActions[] = array('title'=>'Продукция','url'=>Router::url(array('controller'=>'productions','action'=>'index')));
			$this->userActions[] = array('title'=>'Виды продукции','url'=>Router::url(array('controller'=>'production_types','action'=>'index')));
		}
		parent::beforeRender();
	}
	
	public function add() {
		$this->set('title_for_layout', 'Добавление новой продукции (для отчета)');
        if ($this->request->is('post')) {
            $this->ReportProduction->create();
            if ($this->ReportProduction->save($this->request->data)) {
				$this->Session->setFlash('Запись добавлена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
		
		$productionTypes = $this->ReportProduction->ProductionType->find('list');
		$this->set(compact('productionTypes'));

		$this->render('edit');
	}
	
	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование продукции (для отчета)');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$reportProduction = $this->ReportProduction->findById($id);
		if (!$reportProduction) {
			throw new NotFoundException("Несуществующая запись");
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->ReportProduction->id = $id;
            if ($this->ReportProduction->save($this->request->data)) {
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
			$this->request->data = $reportProduction;
		}
		
		$this->set('reportProduction', $reportProduction);
		
		$productionTypes = $this->ReportProduction->ProductionType->find('list');
		$this->set(compact('productionTypes'));
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('ReportProduction.name'=>'asc')
		);
		$reportProductions = $this->Paginator->paginate('ReportProduction');
		$this->set('reportProductions', $reportProductions);
		
		$productionTypes = $this->ReportProduction->ProductionType->find('list');
		$this->set(compact('productionTypes'));

	}
	
	public function delete($id) {
		if ($this->ReportProduction->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			$this->redirect(array('action' => 'index'));
		}
	}
}
?>