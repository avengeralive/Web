<?php
// app/Controller/BanTypesController.php

class BanTypesController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	public function beforeRender() {
		if ($this->Auth->user('role') === 'Администратор') {
			$this->userActions[] = array('title'=>'Справочники','url'=>Router::url(array('controller'=>'pages','action'=>'lists')));
			$this->userActions[] = array('title'=>'Снято с реализации (отчет)','url'=>Router::url(array('controller'=>'report_ban_types','action'=>'index')));
		}
		parent::beforeRender();
	}
	
	public function add() {
		$this->set('title_for_layout', 'Добавление новой записи в справочник Снято с реализации');
        if ($this->request->is('post')) {
            $this->BanType->create();
            if ($this->BanType->save($this->request->data)) {
				$this->Session->setFlash('Запись добавлена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
		$reportBanTypes = $this->BanType->ReportBanType->find('list');
		$this->set(compact('reportBanTypes'));
		$productionTypes = $this->BanType->ProductionType->find('list');
		$this->set(compact('productionTypes'));
		$this->render('edit');
	}
	
	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование записи Снято с реализации');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$banType = $this->BanType->findById($id);
		if (!$banType) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		if (!$this->request->data) {
			$this->request->data = $banType;
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->BanType->id = $id;
            if ($this->BanType->save($this->request->data)) {
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
		
		$productionTypes = $this->BanType->ProductionType->find('list');
		$this->set(compact('productionTypes'));
		$reportBanTypes = $this->BanType->ReportBanType->find('list');
		$this->set(compact('reportBanTypes'));
	}
	
	public function index() {
		$reportBanTypes = $this->BanType->ReportBanType->find('list');
		$this->set(compact('reportBanTypes'));
		$productionTypes = $this->BanType->ProductionType->find('list');
		$this->set(compact('productionTypes'));
		$banTypes = $this->Paginator->paginate('BanType');
		$this->set('banTypes', $banTypes);
	}
	
	public function delete($id) {
		if ($this->BanType->delete($id)) {
			$this->Session->setFlash('Район с ИД '.$id.' удален.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			$this->redirect($this->referer());
		}
	}
}
?>