<?php
// app/Controller/ProductionTypesController.php

class ProductionTypesController extends AppController {

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
			$this->userActions[] = array('title'=>'Продукция (отчет)','url'=>Router::url(array('controller'=>'report_productions','action'=>'index')));

		}
		parent::beforeRender();
	}
	
	public function add() {
		$this->set('title_for_layout', 'Добавление нового вида продукции');
        if ($this->request->is('post')) {
            $this->ProductionType->create();
            if ($this->ProductionType->save($this->request->data)) {
				$this->Session->setFlash('Вид продукции добавлен.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
		
		$this->render('edit');
	}
	
	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование вида продукции');
		if (!$id) {
			throw new NotFoundException("Несуществующий вид продуции");
		}
		
		$productionType = $this->ProductionType->findById($id);
		if (!$productionType) {
			throw new NotFoundException("Несуществующий вид продукции");
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->ProductionType->id = $id;
            if ($this->ProductionType->save($this->request->data)) {
				$this->Session->setFlash('Вид продукции изменен.', 'alert', array(
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
			$this->request->data = $productionType;
		}
		
		$this->set('productionType', $productionType);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('ProductionType.name'=>'asc')
		);
		$productionTypes = $this->Paginator->paginate('ProductionType');
		$this->set('productionTypes', $productionTypes);
	}
	
	public function delete($id) {
		if ($this->ProductionType->delete($id)) {
			$this->Session->setFlash('Вид продукции с ИД '.$id.' удален.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>