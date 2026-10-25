<?php
// app/Controller/ResearchResultsController.php

class ResearchResultsController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	public function beforeRender() {
		if ($this->Auth->user('role') === 'Администратор') {
			$this->userActions[] = array('title'=>'Справочники','url'=>Router::url(array('controller'=>'pages','action'=>'lists')));
			$this->userActions[] = array('title'=>'Исследования','url'=>Router::url(array('controller'=>'research_types','action'=>'index')));
			$this->userActions[] = array('title'=>'Исследования (отчет)','url'=>Router::url(array('controller'=>'report_researches','action'=>'index')));
		}
		parent::beforeRender();
	}
	
	public function add() {
		$this->set('title_for_layout', 'Добавление нового вида результата исследований');
        if ($this->request->is('post')) {
            $this->ResearchResult->create();
            if ($this->ResearchResult->save($this->request->data)) {
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
		$this->set('title_for_layout', 'Редактирование результата исследований');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$researchResult = $this->ResearchResult->findById($id);
		if (!$researchResult) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		if (!$this->request->data) {
			$this->request->data = $researchResult;
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->ResearchResult->id = $id;
            if ($this->ResearchResult->save($this->request->data)) {
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
		
		$this->set('researchResult', $researchResult);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('ResearchResult.name'=>'asc')
		);
		$researchResults = $this->Paginator->paginate('ResearchResult');
		$this->set('researchResults', $researchResults);
	}
	
	public function delete($id) {
		if ($this->ResearchResult->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>