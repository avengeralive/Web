<?php
// app/Controller/ResearchTypesController.php

class ResearchTypesController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	public function beforeRender() {
		if ($this->Auth->user('role') === 'Администратор') {
			$this->userActions[] = array('title'=>'Справочники','url'=>Router::url(array('controller'=>'pages','action'=>'lists')));
			$this->userActions[] = array('title'=>'Исследования (отчет)','url'=>Router::url(array('controller'=>'report_researches','action'=>'index')));
		}
		parent::beforeRender();
	}
	
	public function add() {
		$this->set('title_for_layout', 'Добавление нового вида результата исследований');
        if ($this->request->is('post')) {
            $this->ResearchType->create();
            if ($this->ResearchType->save($this->request->data)) {
				$this->Session->setFlash('Запись добавлена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
		$productionTypes = $this->ResearchType->ProductionType->find('list');
		$this->set(compact('productionTypes'));
		$reportResearches = $this->ResearchType->ReportResearch->find('list');
		$this->set(compact('reportResearches'));
		$this->render('edit');
	}
	
	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование результата исследований');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$researchType = $this->ResearchType->findById($id);
		if (!$researchType) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		if (!$this->request->data) {
			$this->request->data = $researchType;
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->ResearchType->id = $id;
            if ($this->ResearchType->save($this->request->data)) {
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
		$productionTypes = $this->ResearchType->ProductionType->find('list');
		$this->set(compact('productionTypes'));
		$reportResearches = $this->ResearchType->ReportResearch->find('list');
		$this->set(compact('reportResearches'));
		$this->set('researchType', $researchType);
	}
	
	public function index() {
		$productionTypes = $this->ResearchType->ProductionType->find('list');
		$this->set(compact('productionTypes'));
		$reportResearches = $this->ResearchType->ReportResearch->find('list');
		$this->set(compact('reportResearches'));
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('ResearchType.name'=>'asc')
		);
		$researchTypes = $this->Paginator->paginate('ResearchType');
		$this->set('researchTypes', $researchTypes);
	}
	
	public function delete($id) {
		if ($this->ResearchType->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>