<?php
// app/Controller/BanReasonsController.php

class BanReasonsController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	public function beforeRender() {
		if ($this->Auth->user('role') === 'Администратор') {
			$this->userActions[] = array('title'=>'Справочники','url'=>Router::url(array('controller'=>'pages','action'=>'lists')));
			$this->userActions[] = array('title'=>'Причины обезвреживания (отчет)','url'=>Router::url(array('controller'=>'report_ban_reasons','action'=>'index')));
		}
		parent::beforeRender();
	}
	
	public function add() {
		$this->set('title_for_layout', 'Добавление новой причины обезвреживания');
        if ($this->request->is('post')) {
            $this->BanReason->create();
            if ($this->BanReason->save($this->request->data)) {
				$this->Session->setFlash('Запись добавлена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
		$productionTypes = $this->BanReason->ProductionType->find('list');
		$this->set(compact('productionTypes'));
		$reportBanReasons = $this->BanReason->ReportBanReason->find('list');
		$this->set(compact('reportBanReasons'));
		
		$this->render('edit');
	}
	
	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование причины обезвреживания');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$banReason = $this->BanReason->findById($id);
		if (!$banReason) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		if (!$this->request->data) {
			$this->request->data = $banReason;
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->BanReason->id = $id;
            if ($this->BanReason->save($this->request->data)) {
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
		$productionTypes = $this->BanReason->ProductionType->find('list');
		$this->set(compact('productionTypes'));
		$reportBanReasons = $this->BanReason->ReportBanReason->find('list');
		$this->set(compact('reportBanReasons'));
	}
	
	public function index() {
		$productionTypes = $this->BanReason->ProductionType->find('list');
		$this->set(compact('productionTypes'));
		$reportBanReasons = $this->BanReason->ReportBanReason->find('list');
		$this->set(compact('reportBanReasons'));
		
		$banReasons = $this->Paginator->paginate('BanReason');
		$this->set('banReasons', $banReasons);
	}
	
	public function delete($id) {
		if ($this->BanReason->delete($id)) {
			$this->Session->setFlash('Район с ИД '.$id.' удален.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			$this->redirect($this->referer());
		}
	}
}
?>