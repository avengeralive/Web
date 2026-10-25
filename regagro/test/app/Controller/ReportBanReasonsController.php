<?php
// app/Controller/ReportBanReasonsController.php

class ReportBanReasonsController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	public function beforeRender() {
		if ($this->Auth->user('role') === 'Администратор') {
			$this->userActions[] = array('title'=>'Справочники','url'=>Router::url(array('controller'=>'pages','action'=>'lists')));
			$this->userActions[] = array('title'=>'Причины обезвреживания','url'=>Router::url(array('controller'=>'ban_reasons','action'=>'index')));
		}
		parent::beforeRender();
	}
	
	public function add() {
		$this->set('title_for_layout', 'Добавление новой причины обезвреживания (отчет)');
        if ($this->request->is('post')) {
            $this->ReportBanReason->create();
            if ($this->ReportBanReason->save($this->request->data)) {
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
		$this->set('title_for_layout', 'Редактирование причины обезвреживания (отчет)');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$reportBanReason = $this->ReportBanReason->findById($id);
		if (!$reportBanReason) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		if (!$this->request->data) {
			$this->request->data = $reportBanReason;
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->ReportBanReason->id = $id;
            if ($this->ReportBanReason->save($this->request->data)) {
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
		
		$this->set('reportBanReason', $reportBanReason);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('ReportBanReason.name'=>'asc')
		);
		$reportBanReasons = $this->Paginator->paginate('ReportBanReason');
		$this->set('reportBanReasons', $reportBanReasons);
	}
	
	public function delete($id) {
		if ($this->ReportBanReason->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>