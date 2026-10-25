<?php
// app/Controller/ReportBanTypesController.php
class ReportBanTypesController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	public function beforeRender() {
		if ($this->Auth->user('role') === 'Администратор') {
			$this->userActions[] = array('title'=>'Справочники','url'=>Router::url(array('controller'=>'pages','action'=>'lists')));
			$this->userActions[] = array('title'=>'Снято с реализации','url'=>Router::url(array('controller'=>'ban_types','action'=>'index')));
		}
		parent::beforeRender();
	}
	
	public function add() {
		$this->set('title_for_layout', 'Добавление новой записи в справочник Снято с реализации (отчет)');
        if ($this->request->is('post')) {
            $this->ReportBanType->create();
            if ($this->ReportBanType->save($this->request->data)) {
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
		$this->set('title_for_layout', 'Редактирование записи в справочнике Снято с реализации (отчет)');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$reportBanType = $this->ReportBanType->findById($id);
		if (!$reportBanType) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		if (!$this->request->data) {
			$this->request->data = $reportBanType;
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->ReportBanType->id = $id;
            if ($this->ReportBanType->save($this->request->data)) {
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
		
		$this->set('reportBanType', $reportBanType);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('ReportBanType.name'=>'asc')
		);
		$reportBanTypes = $this->Paginator->paginate('ReportBanType');
		$this->set('reportBanTypes', $reportBanTypes);
	}
	
	public function delete($id) {
		if ($this->ReportBanType->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>