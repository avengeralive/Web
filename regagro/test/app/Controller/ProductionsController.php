<?php
// app/Controller/ProductionsController.php

class ProductionsController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	
	public function beforeFilter() {
	
		//выбираем базу данных для журнала с выборкой по региону.
		//$this->Sample->Registration->useDbConfig = 'region'. $this->Auth->user('region_id');
		$this->Production->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		parent::beforeFilter();
		
	}
	
	public function beforeRender() {
// 		if ($this->Auth->user('role') === 'Администратор') {
// 			$this->userActions[] = array('title'=>'Справочники','url'=>Router::url(array('controller'=>'pages','action'=>'lists')));
// 			$this->userActions[] = array('title'=>'Виды продукции','url'=>Router::url(array('controller'=>'production_types','action'=>'index')));
// 			$this->userActions[] = array('title'=>'Продукция (отчет)','url'=>Router::url(array('controller'=>'report_productions','action'=>'index')));
// 		}
		parent::beforeRender();
	}
	
	public function add() {
	
		//выбираем базу данных для журнала с выборкой по региону.
		//$this->Expertise->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Production->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		
		$this->set('title_for_layout', 'Добавление новой продукции');
        
		if ($this->request->is('post')) {
			$reportProduction = $this->Production->ReportProduction->findById($this->request->data['Production']['report_production_id']);
			$valid = false;
			foreach($reportProduction['ProductionType'] as $productionType) {
				if ($productionType['id']==$this->request->data['Production']['production_type_id']) {
					$valid = true;
					break;
				}
			}
			
			if (!$valid){
				$this->Session->setFlash('Выбранный вид продукции не соответствует выбранному названию продукции для отчета', 'alert',
						array(
							'plugin' => 'BoostCake',
							'class' => 'alert-danger'
						), 'danger');
				$this->render('edit');		
				return;
			}
			
			$this->Production->create();
			if ($this->Production->save($this->request->data)) {
				$this->Session->setFlash('Вид продукции добавлен', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
		
		$productionTypes = $this->Production->ProductionType->find('list');
		$this->set(compact('productionTypes'));
		$reportProductions = $this->Production->ReportProduction->find('list');
		$this->set(compact('reportProductions'));
		$this->render('edit');
	}
	
	public function edit($id = null) {
	
		//выбираем базу данных для журнала с выборкой по региону.
		//$this->Expertise->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Production->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		
		$this->set('title_for_layout', 'Редактирование продукции');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		$production = $this->Production->findById($id);
		if (!$production) {
			throw new NotFoundException("Несуществующая запись");
		}
		
		if (!$this->request->data) {
			$this->request->data = $production;
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
		
			$reportProduction = $this->Production->ReportProduction->findById($this->request->data['Production']['report_production_id']);
			$valid = false;
			foreach($reportProduction['ProductionType'] as $productionType)
			{
				if ($productionType['id']==$this->request->data['Production']['production_type_id'])
				{
					$valid = true;
					break;
				}
			}
			if(!$valid){
				$this->Session->setFlash('Выбранный вид продукции не соответствует выбранному названию продукции для отчета.', 'alert',
						array(
							'plugin' => 'BoostCake',
							'class' => 'alert-danger'
						), 'danger');
				return;
			}
			$this->Production->id = $id;
			if ($this->Production->save($this->request->data)) {
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
		
		
		$productionTypes = $this->Production->ProductionType->find('list');
		$this->set(compact('productionTypes'));
		$reportProductions = $this->Production->ReportProduction->find('list');
		$this->set(compact('reportProductions'));
		
		$this->set('production', $production);
	}
	
	public function index() {
	
	
		//выбираем базу данных для журнала с выборкой по региону.
		//$this->Expertise->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Production->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		
		$this->Paginator->settings = array(
			'limit' => 30,
			'order' => array('Production.name'=>'asc')
		);
		$productions = $this->Paginator->paginate('Production');
		$this->set('productions', $productions);
		
		$productionTypes = $this->Production->ProductionType->find('list');
		$this->set(compact('productionTypes'));
		$reportProductions = $this->Production->ReportProduction->find('list');
		$this->set(compact('reportProductions'));
		
	}
	
	public function delete($id) {
	
	
		//выбираем базу данных для журнала с выборкой по региону.
		//$this->Expertise->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		$this->Production->Registration->setDataSource('region'. $this->Auth->user('region_id'));
		
		if ($this->Production->delete($id)) {
			$this->Session->setFlash('Запись с ИД '.$id.' удалена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>