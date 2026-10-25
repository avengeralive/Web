<?php
// app/Controller/ReportResearchesController.php
class ReportResearchesController extends AppController {

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
		}
		parent::beforeRender();
	}
	
	public function add() {
		$this->set('title_for_layout', 'Добавление нового исследования (отчет)');
        if ($this->request->is('post')) {
            $this->ReportResearch->create();
            if ($this->ReportResearch->save($this->request->data)) {
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
		$this->set('title_for_layout', 'Редактирование исследования (отчет)');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$reportResearch = $this->ReportResearch->findById($id);
		if (!$reportResearch) {
			throw new NotFoundException("Несуществующая запись");
		}

		if (!$this->request->data) {
			$this->request->data = $reportResearch;
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->ReportResearch->id = $id;
            if ($this->ReportResearch->save($this->request->data)) {
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
		
		$this->set('reportResearch', $reportResearch);
	}
	
	public function index() {
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('ReportResearch.name'=>'asc')
		);
		$reportResearches = $this->Paginator->paginate('ReportResearch');
		$this->set('reportResearches', $reportResearches);
	}
	
	public function delete($id) {
		if ($this->ReportResearch->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>