<?php
// app/Controller/MeasuresController.php

class MeasuresController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	public function beforeRender() {
		if ($this->Auth->user('role') === 'Администратор') {
			$this->userActions[] = array('title'=>'Справочники','url'=>Router::url(array('controller'=>'pages','action'=>'lists')));
		}
		parent::beforeRender();
	}
	
	public function add() {
		$this->set('title_for_layout', 'Добавление новой единицы измерения');
        if ($this->request->is('post')) {
            $this->Measure->create();
            if ($this->Measure->save($this->request->data)) {
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
		$this->set('title_for_layout', 'Редактирование единицы измерения');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$measure = $this->Measure->findById($id);
		if (!$measure) {
			throw new NotFoundException("Несуществующая запись");
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Measure->id = $id;
            if ($this->Measure->save($this->request->data)) {
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
			$this->request->data = $measure;
		}
		
		$this->set('measure', $measure);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('Measure.name'=>'asc')
		);
		$measures = $this->Paginator->paginate('Measure');
		$this->set('measures', $measures);
	}
	
	public function delete($id) {
		if ($this->Measure->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>