<?php
// app/Controller/RegistrationsupController.php
class RegistrationsupController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array('Js', 'Number', 'Doc',
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);

	public function beforeFilter() {
		$this->set('title_for_layout', 'Журнал');
		parent::beforeFilter();
		if (in_array($this->Auth->user('role'),  array('Сотрудник','Администратор','Администратор учреждения'))) {
			$this->Auth->allow('*');
		}

		if (!$this->Auth->user()) {
			$this->Session->setFlash('Вы не авторизовались в системе.', 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-danger'
			), 'danger');
			$this->redirect(array('controller'=>'users', 'action'=>'login'));
		}

		$lab_actions = array('overview','edit','delete','copy');
		$lab_id = null;
		if(in_array($this->action, $lab_actions)) {
			$this->Registrationsup->id = $this->request->params['pass'][0];
			$lab_id = $this->Registrationsup->field('lab_id');
		}
		if (isset($this->request->query['lab_id'])){
			$lab_id = $this->request->query['lab_id'];
            $lab_actions[] = 'index';
		}

		//$hasLab = ($this->Auth->user('lab_id') || $this->Auth->user('lab_id')!=0);
		$hasInstitution = ($this->Auth->user('institution_id') || $this->Auth->user('institution_id')!=0);
		$hasOrgan = ($this->Auth->user('organ_id') || $this->Auth->user('organ_id')!=0);
		$lookingReports = !(strpos($this->action,'i_index')===false)
						||!(strpos($this->action,'vet5')===false)
						||!(strpos($this->action,'check')===false)
						||($this->action=='reports')||($this->action=='expertises_prices');

		//сотрудники учреждений и органов могут смотреть вссякого рода отчеты
		$additionalCheck = $lookingReports&&($hasInstitution||$hasOrgan);
		$this->LabAccessChecks($lab_id, $lab_actions, $additionalCheck);

		if (in_array($this->action, ['edit', 'delete']))
		{
    		$registration_id = $this->request->params['pass'][0];
    		$this->reg_date = $this->Registrationsup->field('date', array('id'=>$registration_id));
            $this->BlockActionsIfDateIsLessThanToday($this->reg_date, ['edit', 'delete']);
		}
	}

	public function isAuthorized($user) {
		if (isset($user['role']) && in_array($user['role'], array('Администратор','Сотрудник УП','Администратор учреждения'))) {
            return true;
        }

        return parent::isAuthorized($user);
    }

	public function beforeRender() {

		if ($this->Auth->user('role') === 'Администратор') {
			$this->userActions[] = array('title'=>'Справочники','url'=>Router::url(array('controller'=>'pages','action'=>'lists')));
		}
		if (in_array($this->Auth->user('role'),  array('Сотрудник УП','Администратор','Администратор учреждения'))) {
			$this->userActions[] = array('title'=>'Журнал','url'=>Router::url(array('controller'=>'registrationsup','action'=>'index')));
            $this->userActions[] = array('title'=>'Отчеты','url'=>Router::url(array('controller'=>'registrationsup','action'=>'reports')));
			$this->userActions[] = array('title'=>'План','url'=>Router::url(array('controller'=>'plans','action'=>'index')));
		}

		parent::beforeRender();
	}

	public function overview($id=null) {

		$this->userActions[] = array('title'=>'Редактировать запись','url'=>Router::url(array('controller'=>'registrationsup','action'=>'edit', $id)));

		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		$this->Registrationsup->unbindModel(array('belongsTo' => array('ProductionType', 'Lab'/*, 'Region', 'District'*/)));
		//$this->Registrationsup->unbindModel(array('hasMany' => array('Expertise','Research', 'Ban', 'Sample', 'Distribution')));
		$this->Registrationsup->recursive=2;
		$registration = $this->Registrationsup->findById($id);
		if (!$registration) {
			throw new NotFoundException("Несуществующая запись");
		}


		$this->set('registration', $registration);
	}

	public function overviewByCode() {
		$this->Registrationsup->recursive=-1;
		$registration = $this->Registrationsup->find('first', array('conditions'=>array('code'=>$this->request->query['code'],'lab_id'=>$this->Auth->user('lab_id'))));
		$this->redirect(array('action' => 'overview',$registration['Registrationsup']['id']));
	}

	public function add() {
		$this->set('title_for_layout', 'Добавление новой записи в журнал');

        if ($this->request->is('post')) {
            $this->Registrationsup->create();
            if (in_array($this->request->data['Registrationsup']['production_type_id'], array("7","5","23")))
			{
				$this->request->data['Registrationsup']['industrial'] = 0;
			}
			$this->request->data['Registrationsup']['date'] = date('Y-m-d H:i:s',time()-(1*60*60));
            if ($this->Registrationsup->save($this->request->data)) {
				$this->Session->setFlash('Запись добавлена.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}

		$productionTypes = $this->Registrationsup->ProductionType->find('list');
		$this->set(compact('productionTypes'));

		$users = $this->Registrationsup->User->find('list', array('conditions'=>array('id'=>$this->Auth->user('id'))));
		$this->set(compact('users'));

		$labs = $this->Registrationsup->Lab->find('list', array('conditions'=>array('id'=>$this->Auth->user('lab_id'))));
		$this->set(compact('labs'));

		$regions = $this->Registrationsup->Region->find('list');
		$this->set(compact('regions'));

		//$districts = $this->Registrationsup->District->find('list');
		//$this->set(compact('districts'));
	}

	public function edit($id=null) {
		$this->set('title_for_layout', 'Редактирование записи в журнале');
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}

		$registration = $this->Registrationsup->findById($id);
		if (!$registration) {
			throw new NotFoundException("Несуществующая запись");
		}

		if (!$this->request->data) {
			$this->request->data = $registration;
		}

		if ($this->request->is('post') || $this->request->is('put'))
		{
			$this->Registrationsup->id = $id;
			if (in_array($this->request->data['Registrationsup']['production_type_id'], array("7","5","23")))
			{
				$this->request->data['Registrationsup']['industrial'] = 0;
			}
            if ($this->Registrationsup->save($this->request->data)) {
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

		$productionTypes = $this->Registrationsup->ProductionType->find('list');
		$this->set(compact('productionTypes'));

		$users = $this->Registrationsup->User->find('list', array('conditions'=>array('id'=>$this->Auth->user('id'))));
		$this->set(compact('users'));

		$labs = $this->Registrationsup->Lab->find('list', array('conditions'=>array('id'=>$this->Auth->user('lab_id'))));
		$this->set(compact('labs'));

		$regions = $this->Registrationsup->Region->find('list');
		$this->set(compact('regions'));

		$districts = $this->Registrationsup->District->find('list', array('conditions'=>array('region_id'=>$this->request->data['Registrationsup']['region_id'])));
		$this->set(compact('districts'));

		$this->set('registration', $registration);
	}

	public function copy($id=null) {
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}

		$reg = $this->Registrationsup->findById($id);
		$reg['Registrationsup']['id'] = null;
		$reg['Registrationsup']['date'] = date('Y-m-d H:i:s',time()-(1*60*60));
		$this->Registrationsup->create();
		if ($this->Registrationsup->save($reg))
		{
			//$this->Registrationsup->Expertise->recursive = -1;
			$expertises = $this->Registrationsup->Expertise->find('all', array('conditions'=>array('registration_id'=>$id)));
			foreach ($expertises as $exp) {

				$this->Registrationsup->Expertise->create();
				$exp['Expertise']['registration_id'] = $this->Registrationsup->id;
				$exp['Expertise']['id'] = null;
				foreach ($exp['Detection'] as $key=>$det) {
					$exp['Detection'][$key]['ExpertisesDetection']['id'] = null;
				}
				if ($this->Registrationsup->Expertise->save($exp))
				{
					foreach ($exp['Research'] as $res) {
						$this->Registrationsup->Research->create();
						$research['Research'] = $res;
						$research['Research']['registration_id'] = $this->Registrationsup->id;
						$research['Research']['expertise_id'] = $this->Registrationsup->Expertise->id;
						$research['Research']['id'] = null;
						$this->Registrationsup->Research->save($research);
					}
				}
			}

			$this->redirect(array('controller'=>'registrationsup', 'action'=>'index'));
		}
	}

	public function index() {
		if ($this->Auth->user('lab_id')) {
			$lab_id = $this->Auth->user('lab_id');
			$this->userActions[] = array('title'=>'Добавить запись','url'=>Router::url(array('controller'=>'registrationsup','action'=>'add')));
			
			$conditions = array('Registrationsup.lab_id'=>$lab_id,
							'Registrationsup.owner LIKE \'%'.nvl($this->request->query['owner']).'%\'',
							'Registrationsup.doc_num LIKE \'%'.nvl($this->request->query['doc_num']).'%\'');
		} else {
			$conditions = array(//'Registrationsup.lab_id'=>$lab_id,
							'Registrationsup.owner LIKE \'%'.nvl($this->request->query['owner']).'%\'',
							'Registrationsup.doc_num LIKE \'%'.nvl($this->request->query['doc_num']).'%\'');
		}

		//$conditions = array('Registrationsup.lab_id'=>$lab_id,
		//					'Registrationsup.owner LIKE \'%'.nvl($this->request->query['owner']).'%\'',
		//					'Registrationsup.doc_num LIKE \'%'.nvl($this->request->query['doc_num']).'%\'');
		
		if(isset($this->request->query['production_type_id']) && !empty($this->request->query['production_type_id'])) {
			$conditions[]=array('Registrationsup.production_type_id'=>$this->request->query['production_type_id']);
		}
		
		if(isset($this->request->query['region_id']) && !empty($this->request->query['region_id'])) {
			$conditions[]=array('Registrationsup.region_id'=>$this->request->query['region_id']);
		}

		//$this->Registrationsup->unbindModel(array('belongsTo' => array('ProductionType', 'Region', 'District')));
		$this->Registrationsup->unbindModel(array('hasMany' => array('Expertise','Research', 'Ban', 'Sample', 'Distribution')));

		$productionTypes = $this->Registrationup->ProductionType->find('list');
		$this->set(compact('productionTypes'));

		$regions = $this->Registrationup->Region->find('list');
		$this->set(compact('regions'));

		$institutions = $this->Registrationup->Lab->Institution->find('list');
		$this->set(compact('institutions'));

		//$labs = $this->Registrationsup->Labs->find('list');
		//$this->set(compact('labs'));

		$this->Paginator->settings = array(
			'conditions' => $conditions,
			'limit' => 30,
			'order' =>  array('Registrationsup.code'=>'DESC')
		);
		$registrationsup = $this->Paginator->paginate('Registrationsup');
		//var_dump($registrationsup);
		$this->set('registrationsup', $registrationsup);
	}

	public function delete($id=null) {
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}
		if ($this->Registrationsup->delete($id)) {
			$this->Session->setFlash('Запись №'.$id.' удалена', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			$this->redirect($this->referer());
		}
	}

	public function ban_doc($id = null)	{
		Configure::write('debug', 0);
		$this->layout = null;
		$this->Registrationsup->recursive=3;
		if (!$id) {
			throw new NotFoundException("Несуществующая запись");
		}

		$registration = $this->Registrationsup->findById($id);
		if (!$registration) {
			throw new NotFoundException("Несуществующая запись");
		}

		//$date = date_format(date_create($registration['Registrationsup']['date']),'Y-m-d 00:00:00');
		$date = date('Y-m-d 00:00:00');
		$bans = $this->Registrationsup->Ban->find('all', array('conditions'=>array('Registrationsup.id'=>$id,
																				'Ban.modified > \''.$date.'\'',
																				'Ban.modified < \''.date_format(date_create($date),'Y-m-d 23:59:59').'\'')));
		if (!$bans) {
			throw new NotFoundException("За сегодня нет снятой с реализации продукции в этой экспертизе (между: " . $date . " и " . date_format(date_create($date),'Y-m-d 23:59:59') . ")");
		}
		$this->set(compact('registration'));
		$this->set(compact('bans'));
	}

	public function daily_registrations_doc($date = null) {
		$date = $date?$date:date('Y-m-d');
		Configure::write('debug', 0);
		$this->layout = null;
		$this->Registrationsup->recursive=3;
		$registrationsup = $this->Registrationsup->find('all', array('conditions'=>
																array(
																	'date'=>$date,
																	'Registrationsup.lab_id'=>$this->Auth->user('lab_id')
																),
																'order'=>'Registrationsup.production_type_id'
																));
		if (!$registrationsup) {
			throw new NotFoundException('Не найдены записи за текущую дату.');
		}

		$this->set(compact('registrationsup'));
		$this->set(compact('date'));
	}
	//$production_type: 'meat_fish' - это 'мясо, рыба'; 'other' - это пищевые продукты
	public function denaturation_doc($production_type = 'meat_fish', $date = null)	{
		$production_type = in_array($production_type, array('meat_fish','other'))?$production_type:'meat_fish';
		$date = $date?$date:date('Y-m-d');
		//Configure::write('debug', 0);
		$this->Registrationsup->Expertise->recursive=2;
		$this->layout = null;
		$this->Registrationsup->unbindModel(array('belongsTo' => array('ProductionType', 'Region', 'District')));
		$this->Registrationsup->unbindModel(array('hasMany' => array('Expertise','Research', 'Ban', 'Sample', 'Distribution')));
		$this->Registrationsup->Expertise->unbindModel(array('hasAndBelongsToMany' => array('Detection')));
		$this->Registrationsup->Expertise->unbindModel(array('hasMany' => array('Research', 'Ban', 'Sample', 'Distribution')));
		//Мясо и мясопродукты production_type_id=1
		//Рыба морская production_type_id=5
		//Рыба речная production_type_id=23
		$prod_type_condition = 'Expertise.production_id '.($production_type=='meat_fish'?'IN':'NOT IN').' (SELECT id FROM productions WHERE production_type_id IN (1,5,23))';
		$expertises = $this->Registrationsup->Expertise->find('all', array('conditions'=>array(
																		$prod_type_condition,
																		'DATE(Registrationsup.date)'=>$date,
																		'Registrationsup.lab_id'=>$this->Auth->user('lab_id')
																	),
																	'order'=>'Production.production_type_id'
																)
															);
		$this->set(compact('expertises'));
		$this->set('user',$this->Auth->user());
		$lab = $this->Registrationsup->Lab->findById($this->Auth->user('lab_id'));
		$this->set(compact('lab'));
		$this->set(compact('date'));
		$this->set('denaturation_action', $production_type=='meat_fish'?'уничтожению':'утилизации');
		$this->set('production_type', $production_type=='meat_fish'?'мясо, рыба':'пищевые продукты');
	}

	public function daily_registrations_xml($date = null, $small_font = 0) {
		$date = $date?$date:date('Y-m-d');
		Configure::write('debug', 0);
		$this->layout = null;
		$this->Registrationsup->recursive=3;
		$this->Registrationsup->unbindModel(array('hasMany' => array('Distribution','Sample')));
		$this->Registrationsup->User->unbindModel(array('belongsTo' => array('Lab','Institution','Organ')));
		$this->Registrationsup->Region->unbindModel(array('hasMany' => array('District')));
		$this->Registrationsup->District->unbindModel(array('belongsTo' => array('Region')));
		$this->Registrationsup->Lab->unbindModel(array('belongsTo' => array('Region')));
		$this->Registrationsup->Expertise->unbindModel(array('belongsTo' => array('Registrationsup')));
		$this->Registrationsup->Expertise->unbindModel(array('hasMany' => array('Research','Ban', 'Distribution', 'Sample')));
		$this->Registrationsup->Expertise->unbindModel(array('hasAndBelongsToMany' => array('Detection')));
		$this->Registrationsup->Research->unbindModel(array('belongsTo' => array('Registrationsup', 'Expertise')));
		$this->Registrationsup->Ban->unbindModel(array('belongsTo' => array('Expertise', 'Registrationsup')));
		$registrationsup = $this->Registrationsup->find('all', array('conditions'=>
																array(
																	'DATE(Registrationsup.date)'=>$date,
																	'Registrationsup.lab_id'=>$this->Auth->user('lab_id')
																),
																'order'=>'Registrationsup.production_type_id'
																));
		if (!$registrationsup) {
			throw new NotFoundException('Не найдены записи за текущую дату.');
		}
		$this->Registrationsup->Ban->unbindModel(array('belongsTo' => array('Expertise')));
		$modified_bans = $this->Registrationsup->Ban->find('all', array('conditions'=>array('Ban.modified > \''.$date.'\'',
																						 'Ban.modified < \''.date_format(date_create($date),'Y-m-d 23:59:59').'\'',
																						 'Registrationsup.date < \''.date_format(date_create($date),'Y-m-d 00:00:00').'\'',
																						 'Registrationsup.lab_id'=>$this->Auth->user('lab_id'))));
		$this->set(compact('modified_bans'));
		$this->set(compact('registrationsup'));
		$this->set(compact('date'));
		$this->set(compact('small_font'));
	}

	public function distributor_doc($id=null, $name = null, $type = 0) {
		if (!$name) {
			throw new NotFoundException("Не указано имя торгующего");
		}
		if (!$id) {
			throw new NotFoundException("Несуществующая запись в журнале");
		}

		Configure::write('debug', 0);
		$this->layout = null;
		$this->Registrationsup->recursive=2;
		$this->Registrationsup->bindModel(
			array('hasMany' => array(
						'Distribution' => array(
							'className' => 'Distribution',
							'conditions' => array('Distribution.distributor'=>$name)
						)
					)
				)
			);
		$this->Registrationsup->unbindModel(array('belongsTo' => array('ProductionType', 'Region', 'District')));
		$this->Registrationsup->unbindModel(array('hasMany' => array('Expertise','Research', 'Ban', 'Sample')));
		$registration = $this->Registrationsup->findById($id);
		if (!$registration) {
			throw new NotFoundException('Не найдены записи c указанным торгующим.');
		}

		$this->set(compact('registration'));
		$this->set('name',$name);
		$this->set('type',$type);
	}

	public function sample_doc($id=null, $sample_id = null) {
        if (!$sample_id) {
            throw new NotFoundException("Не указан отбор пробы");
        }
        if (!$id) {
            throw new NotFoundException("Несуществующая запись в журнале");
        }
        $this->layout = null;

        $this->Registrationsup->Sample->unbindModel(['belongsTo' => ['Registrationsup', 'Lab']]);
        $sample = $this->Registrationsup->Sample->findById($sample_id);
        if (!$sample) {
            throw new NotFoundException("Указанный отбор пробы не найден.");
        }

        $this->Registrationsup->unbindModel(['hasMany' => ['Expertise', 'Research', 'Ban', 'Distribution', 'Sample']]);
        $registration = $this->Registrationsup->findById($id);
        if (!$registration) {
            throw new NotFoundException('Не найдены записи c указанным торгующим.');
        }

        $institution = $this->Registrationsup->Lab->Institution->findById($registration['Lab']['institution_id']);

        $this->set(compact('sample','institution','registration'));
	}

	public function sample_act_doc($id=null, $sample_id = null) {
		if (!$sample_id) {
			throw new NotFoundException("Не указан отбор пробы");
		}
		if (!$id) {
			throw new NotFoundException("Несуществующая запись в журнале");
		}
        $this->layout = null;

        $this->Registrationsup->Sample->unbindModel(['belongsTo' => ['Expertise', 'Registrationsup', 'Vetlab', 'Lab']]);
        $sample = $this->Registrationsup->Sample->findById($sample_id);
		if (!$sample) {
			throw new NotFoundException("Указанный отбор пробы не найден.");
		}

        $this->Registrationsup->unbindModel(['hasMany' => ['Expertise', 'Research', 'Ban', 'Distribution', 'Sample']]);
        $registration = $this->Registrationsup->findById($id);
        if (!$registration) {
			throw new NotFoundException('Не найдены записи c указанным торгующим.');
		}

        $institution = $this->Registrationsup->Lab->Institution->findById($registration['Lab']['institution_id']);

		$this->set(compact('sample','institution','registration'));
	}

	public function reports() {
		$this->set('title_for_layout', 'Отчеты');
		$this->LoadModel('Report');

		if ($this->request->is('post') || $this->request->is('put')) {
			if (!isset($this->request->data['Report']['lab_id']))
			{
				$this->request->data['Report']['lab_id'] = $this->Auth->user('lab_id');
			}
			if(isset($this->request->data['Report']['institution_id'])) {
				$selectedInstitutionId = $this->request->data['Report']['institution_id'];
			}
			$this->Report->set($this->request->data);
			if($this->Report->validates())
			{
				$this->set('data', $this->request->data);
			} else {
				$this->Session->setFlash('Ошибки заполнения формы.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				), 'danger');
			}
		}

		if (in_array($this->Auth->user('role'), array('Администратор'))) {
            $institutions = $this->Registrationsup->Lab->Institution->find('list');
            $institutions = array('all'=>'все') + $institutions;
			if (!isset($selectedInstitutionId)||$selectedInstitutionId=='all')
			{
				$labs = $this->Registrationsup->Lab->find('list');
			} else
			{
				$labs = $this->Registrationsup->Lab->find('list', array('conditions'=>array('Lab.institution_id'=>$selectedInstitutionId)));
			}
			$labs = array('all'=>'все') + $labs;
		} else if ($this->Auth->user('organ_id')&&$this->Auth->user('organ_id')!=0) {
            $institutions = $this->Registrationsup->Lab->Institution->find('list',
								array('conditions'=>array('organ_id'=>$this->Auth->user('organ_id')))
							);
            $institutions = array('all'=>'все') + $institutions;
			if (!isset($selectedInstitutionId)||$selectedInstitutionId=='all')
			{
				$labs = $this->Registrationsup->Lab->find('list',
								array('conditions'=>array('Lab.institution_id IN (SELECT id FROM institutions WHERE organ_id='.$this->Auth->user('organ_id').')'))
							);
			} else {
				$labs = $this->Registrationsup->Lab->find('list',
								array('conditions'=>array('Lab.institution_id=\''.$selectedInstitutionId.'\'
															AND Lab.institution_id IN (SELECT id FROM institutions
															WHERE organ_id='.$this->Auth->user('organ_id').')'))
							);
			}
			$labs = array('all'=>'все') + $labs;
			//$labs = array_merge(array('all'=>'все'), $labs);
		} else if ($this->Auth->user('institution_id')&&$this->Auth->user('institution_id')!=0) {
			$institutions = $this->Registrationsup->Lab->Institution->find('list',
								array('conditions'=>array('Institution.id'=>$this->Auth->user('institution_id')))
							);
			$labs = $this->Registrationsup->Lab->find('list',
								array('conditions'=>array('Lab.institution_id'=>$this->Auth->user('institution_id')))
							);
			$labs = array('all'=>'все') + $labs;
		} else {
			$lab_id = $this->Auth->user('lab_id');
			$labs = $this->Registrationsup->Lab->find('list', array('conditions'=>array('Lab.id'=>$lab_id)));
			$institutions = $this->Registrationsup->Lab->Institution->find('list',
								array('conditions'=>array('Institution.id'=>$this->Auth->user('institution_id')))
							);
		}
		$this->set(compact('labs'));
		$this->set(compact('institutions'));
	}

	public function expertises_prices($institution_id=null, $lab_id=null, $date_from=null, $date_to=null){
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		$this->Registrationsup->Expertise->virtualFields['count'] = 0;
		$this->Registrationsup->Expertise->virtualFields['price'] = 0;
		$data = $this->Registrationsup->query('
		SELECT ProductionType.name, Production.name, Production.measure, SUM(Expertise.count) AS Expertise__count, SUM(Expertise.price) AS Expertise__price
		FROM production_types AS ProductionType,
			 expertises AS Expertise,
			 productions AS Production,
			 registrationsup AS Registrationsup
		WHERE ProductionType.id = Production.production_type_id
			AND Production.id = Expertise.production_id
			AND Registrationsup.id = Expertise.registration_id
			AND DATE(Registrationsup.date) between \''.$date_from.'\' AND \''.$date_to.'\'
			AND Registrationsup.lab_id IN ('.$lab_ids.')
		GROUP BY ProductionType.name, Production.name, Production.measure');

		$this->set(compact('data'));
	}

	// получаем id доступныx пользователю лабораторий
	// в зависимости от выбранных id учреждения и лаборатории
	public function _getLabIds($institution_id=null, $lab_id=null) {
		if ($lab_id && $lab_id!=0 && $lab_id!='all')
		{
			//если кто угодно выбрал свою лабораторию, то её и возвращаем
			if ($lab_id==$this->Auth->user('lab_id')) {
				return $lab_id;
			}

			//админ может выбрать любую лабораторию
			if ($this->Auth->user('role')=='Администратор') {
				return $lab_id;
			}

			//сотрудник учреждения
			if ($this->Auth->user('institution_id')&&$this->Auth->user('institution_id')!=0) {
				$labs = $this->Registrationsup->Lab->find('all', array('conditions'=>array('Lab.institution_id'=>$this->Auth->user('institution_id'))) );
				if (in_array($lab_id, Set::extract('/Lab/id',$labs))) {
					return $lab_id;
				} else {
					return 0;
				}
			}

			//сотрудник органа управления
			if ($this->Auth->user('organ_id')&&$this->Auth->user('organ_id')!=0) {
				$labs = $this->Registrationsup->Lab->find('all', array('conditions'=>array('Lab.institution_id IN (SELECT id FROM institutions WHERE organ_id='.$this->Auth->user('organ_id').')')) );
				if (in_array($lab_id, Set::extract('/Lab/id',$labs))) {
					return $lab_id;
				} else {
					return 0;
				}
			}
		}

		if ($institution_id == 'all' && $lab_id == 'all')//все учреждения
		{
			if ($this->Auth->user('role')=='Администратор') {
				$labs = $this->Registrationsup->Lab->find('all');
				return implode(",",Set::extract('/Lab/id',$labs));
			}

			if ($this->Auth->user('organ_id')&&$this->Auth->user('organ_id')!=0) {
				$labs = $this->Registrationsup->Lab->find('all', array('conditions'=>array('Lab.institution_id IN (SELECT id FROM institutions WHERE organ_id='.$this->Auth->user('organ_id').')')) );
				return implode(",",Set::extract('/Lab/id',$labs));
			}

			return 0;
		}

		if ($institution_id && $institution_id!=0 && $lab_id == 'all')//все лаборатории
		{
			if ($this->Auth->user('role')=='Администратор') {
				$labs = $this->Registrationsup->Lab->find('all', array('conditions'=>array('Lab.institution_id'=>$institution_id)));
				return implode(",",Set::extract('/Lab/id',$labs));
			}

			if ($this->Auth->user('organ_id') && $this->Auth->user('organ_id')!=0) {
				$institutions = $this->Registrationsup->Lab->Institution->find('all', array('conditions'=>array('organ_id'=>$this->Auth->user('organ_id'))) );
				if (in_array($institution_id, Set::extract('/Institution/id',$institutions))) {
					$labs = $this->Registrationsup->Lab->find('all', array('conditions'=>array('Lab.institution_id'=>$institution_id)) );
					return implode(",",Set::extract('/Lab/id',$labs));
				} else {
					return 0;
				}
			}

			if ($this->Auth->user('institution_id') && $this->Auth->user('institution_id')!=0) {
				if ($institution_id == $this->Auth->user('institution_id')) {
					$labs = $this->Registrationsup->Lab->find('all', array('conditions'=>array('Lab.institution_id'=>$institution_id)) );
					return implode(",",Set::extract('/Lab/id',$labs));
				} else {
					return 0;
				}
			}
			return 0;
		}
		return 0;
	}

	public function _setReportCommonData($institution_id=null, $lab_id=null) {
		if ($institution_id=='all' && $lab_id=='all') {
			$org_type = 'Органа управления ветеринарии';
			$organ = $this->Registrationsup->Lab->Institution->Organ->findById($this->Auth->user('organ_id'));
			$org_name = isset($organ['Organ']['name'])?$organ['Organ']['name']:'';
			$institution_name = '';
			$signer_job = '';
			$signer_name = '';
		} else if ($institution_id && $institution_id!=0 && $lab_id=='all') {
			$org_type = 'Учреждения ветеринарии';
			//$institution = $this->Registrationsup->Lab->Institution->findById($this->Auth->user('institution_id'));
			$institution = $this->Registrationsup->Lab->Institution->findById($institution_id);
			$org_name = $institution['Institution']['name'];
			$institution_name = '';
			$signer_job = '';
			$signer_name = '';
		} else if ($lab_id && $lab_id!=0 && $lab_id!='all') {
			$org_type = 'Лаборатории ветеринарно-санитарной экспертизы';
			$lab = $this->Registrationsup->Lab->findById($lab_id);
			$org_name = $lab['Lab']['name'];
			$institution_name = $lab['Institution']['name'];
			$signer_job = 'Заведующий ЛВСЭ';
			$signer_name = $this->Registrationsup->query("SELECT displayname FROM users WHERE job='Заведующий ЛВСЭ' AND lab_id = ".$lab_id." AND inactive=0 LIMIT 1");
			$signer_name = $signer_name ? $signer_name[0]['users']['displayname']:'Нет заведующего';
		}
		$this->set(compact('institution_name'));
		$this->set(compact('org_type'));
		$this->set(compact('org_name'));
		$this->set(compact('signer_job'));
		$this->set(compact('signer_name'));

	}

	public function check_1($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		$this->set('title_for_layout','ПРОВЕРОЧНЫЙ ОТЧЕТ ПО КОЛИЧЕСТВУ ЭКСПЕРТИЗ И СУММЕ');

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$curPage = isset($this->request->query['page'])?$this->request->query['page']:0;
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		$this->set(compact('curPage'));
		$this->Registrationsup->Expertise->Research->virtualFields['count'] = 0;
		//$this->Registrationsup->query("SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED ;");
		$this->Registrationsup->query("SET SESSION tx_isolation='READ-UNCOMMITTED';");
		$data = $this->Registrationsup->query("
			SELECT Registrationsup.id, Registrationsup.code, Registrationsup.date, Production.name, Expertise.count, Expertise.price, SUM(Research.count) as Research__count
			FROM registrationsup AS Registrationsup, expertises AS Expertise LEFT JOIN researches AS Research ON Research.expertise_id = Expertise.id, productions AS Production
			WHERE Registrationsup.id = Expertise.registration_id
			AND Production.id = Expertise.production_id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			GROUP BY Registrationsup.date, Registrationsup.id, Registrationsup.code, Production.name, Expertise.count, Expertise.price
			ORDER BY Registrationsup.date DESC
			LIMIT ".($curPage*100).",100;");
		$this->Registrationsup->query("SET SESSION tx_isolation='REPEATABLE-READ';");
		//$this->Registrationsup->query("COMMIT;");

		$this->set(compact('data'));
	}

	public function check_2($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		$this->set('title_for_layout','ПРОВЕРОЧНЫЙ ОТЧЕТ ПО СЛУЧАЯМ ВЫЯВЛЕНИЯ');

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$curPage = isset($this->request->query['page'])?$this->request->query['page']:0;
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		$this->set(compact('curPage'));
		$this->Registrationsup->Expertise->virtualFields['detections'] = '';
		$data = $this->Registrationsup->query("
			SELECT Registrationsup.id, Registrationsup.code, Registrationsup.date, Production.name, Expertise.count,
				(SELECT group_concat(d.name ORDER BY d.name SEPARATOR ', ')
				FROM detections d, expertises_detections ed
				WHERE d.id=ed.detection_id
				AND ed.expertise_id = Expertise.id
				GROUP BY ed.expertise_id) AS Expertise__detections
			FROM registrationsup AS Registrationsup, expertises AS Expertise, productions AS Production
			WHERE Registrationsup.id = Expertise.registration_id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND Production.id = Expertise.production_id
			ORDER BY Registrationsup.date DESC
			LIMIT ".($curPage*100).",100");

		$this->set(compact('data'));
	}

	public function check_3($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		$this->set('title_for_layout','ПРОВЕРОЧНЫЙ ОТЧЕТ ПО РЕЗУЛЬТАТАМ ИССЛЕДОВАНИЙ');
		$curPage = isset($this->request->query['page'])?$this->request->query['page']:0;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		$this->set(compact('curPage'));
		$this->Registrationsup->Expertise->virtualFields['detections'] = '';
		$data = $this->Registrationsup->query("
			SELECT Registrationsup.id, Registrationsup.code, Registrationsup.date, Production.name, ResearchType.name, Research.count, Research.research_result
			FROM registrationsup AS Registrationsup, expertises AS Expertise, productions AS Production, researches AS Research,
				 research_types AS ResearchType
			WHERE Registrationsup.id = Expertise.registration_id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND Production.id = Expertise.production_id
			AND Research.expertise_id = Expertise.id
			AND ResearchType.id = Research.research_type_id
			ORDER BY Registrationsup.date DESC
			LIMIT ".($curPage*100).",100");

		$this->set(compact('data'));
	}

	public function check_4($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		$this->set('title_for_layout','ПРОВЕРОЧНЫЙ ОТЧЕТ ПО СНЯТОЙ ПРОДУКЦИИ');

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$curPage = isset($this->request->query['page'])?$this->request->query['page']:0;
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		$this->set(compact('curPage'));
		$this->Registrationsup->Expertise->virtualFields['detections'] = '';
		$data = $this->Registrationsup->query("
			SELECT Registrationsup.id, Registrationsup.code, Registrationsup.date, Production.name, Ban.weight, BanReason.name
			FROM registrationsup AS Registrationsup, expertises AS Expertise, productions AS Production, bans AS Ban,
				 ban_reasons AS BanReason
			WHERE Registrationsup.id = Expertise.registration_id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND Production.id = Expertise.production_id
			AND Ban.expertise_id = Expertise.id
			AND BanReason.id = Ban.ban_reason_id
			ORDER BY Registrationsup.date DESC
			LIMIT ".($curPage*100).",100");

		$this->set(compact('data'));
	}

	public function check_5($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		$this->set('title_for_layout','ПРОВЕРОЧНЫЙ ОТЧЕТ ПО ОТБОРУ ПРОБ');

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$curPage = isset($this->request->query['page'])?$this->request->query['page']:0;
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		$this->set(compact('curPage'));
        $this->Registrationsup->Expertise->virtualFields['detections'] = '';
		$this->Registrationsup->Expertise->Sample->SamplePurpose->virtualFields['name'] = '';
		$data = $this->Registrationsup->query("
            SELECT Sample.id, Registrationsup.id, Registrationsup.code, Registrationsup.date, Production.name, Sample.count,
                   GROUP_CONCAT(SamplePurpose.name SEPARATOR ', ') as SamplePurpose__name
            FROM registrationsup AS Registrationsup, expertises AS Expertise, productions AS Production, samples AS Sample,
             sample_purposes AS SamplePurpose, samples_sample_purposes as SampleSamplePurpose
            WHERE Registrationsup.id = Expertise.registration_id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
            AND Production.id = Expertise.production_id
            AND Sample.expertise_id = Expertise.id
            AND SampleSamplePurpose.sample_id = Sample.id
            AND SampleSamplePurpose.sample_purpose_id = SamplePurpose.id
            GROUP BY Sample.id, Registrationsup.id, Registrationsup.code, Registrationsup.date, Production.name, Sample.count
            ORDER BY Registrationsup.date DESC
			LIMIT ".($curPage*100).",100");

		$this->set(compact('data'));
	}

	public function i_index_1_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		$this->Registrationsup->Expertise->Production->ReportProduction->virtualFields['name'] = '';
		$data = $this->Registrationsup->query("
		SELECT (CASE WHEN Registrationsup.industrial=1 THEN 'Другие пищевые продукты' ELSE ReportProduction.name END) AS ReportProduction__name,
				ProductionType.name, ReportDetection.name, Detection.name, SUM(Expertise.count) as count
		FROM expertises AS Expertise, registrationsup AS Registrationsup,
			 productions as Production, detections AS Detection, production_types AS ProductionType,
			 report_detections AS ReportDetection, report_productions AS ReportProduction, expertises_detections
		WHERE
			    Expertise.registration_id=Registrationsup.id
			AND Production.id = Expertise.production_id
            AND ProductionType.id = Production.production_type_id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND expertises_detections.expertise_id = Expertise.id
			AND Detection.id = expertises_detections.detection_id
			AND ReportDetection.id = Detection.report_detection_id
			AND ReportProduction.id = Production.report_production_id
		GROUP BY ReportProduction__name, ProductionType.name, ReportDetection.name, Detection.name
		ORDER BY ReportProduction__name, ProductionType.name, ReportDetection.name, Detection.name;");

		$this->set(compact('data'));
	}

	public function i_index_2_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		$this->Registrationsup->Expertise->Production->ReportProduction->virtualFields['name'] = '';
		$this->Registrationsup->Research->virtualFields['count'] = 0;
		$data = $this->Registrationsup->query("
		SELECT (CASE WHEN Registrationsup.industrial=1 THEN 'Другие пищевые продукты' ELSE ReportProduction.name END) AS ReportProduction__name,
				ProductionType.name, ReportResearch.name, ResearchType.name, Research.research_result, SUM(Research.count) AS Research__count
		FROM researches AS Research,
			 research_types AS ResearchType,
			 registrationsup AS Registrationsup,
			 productions AS Production,
             production_types AS ProductionType,
			 report_productions AS ReportProduction,
			 report_researches AS ReportResearch
		WHERE   Research.registration_id=Registrationsup.id
			AND Production.id = Research.production_id
            AND ProductionType.id = Production.production_type_id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND ReportProduction.id = Production.report_production_id
			AND ResearchType.id = Research.research_type_id
			AND ReportResearch.id = ResearchType.report_research_id
		GROUP BY ReportProduction__name, ProductionType.name, ReportResearch.name, ResearchType.name, Research.research_result
		ORDER BY ReportProduction__name, ProductionType.name, ReportResearch.name, ResearchType.name, Research.research_result;");

		$this->set(compact('data'));
	}

	public function i_index_3_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		$this->Registrationsup->Expertise->Production->ReportProduction->virtualFields['name'] = '';

		$domestic_data = $this->Registrationsup->query("
		SELECT (CASE WHEN Registrationsup.industrial=1 THEN 'Другие пищевые продукты' ELSE ReportProduction.name END) AS ReportProduction__name, ProductionType.name,
			   Ban.use_order, BanReason.name, ReportBanType.name, ROUND(SUM(Ban.weight),2) AS weight
		FROM bans AS Ban, report_productions AS ReportProduction, productions AS Production, production_types AS ProductionType,
			 registrationsup as Registrationsup, ban_reasons AS BanReason,
			 report_ban_types as ReportBanType, ban_types AS BanType
		WHERE   Ban.registration_id=Registrationsup.id
			AND Production.id = Ban.production_id
            AND ProductionType.id = Production.production_type_id
			#AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND ReportProduction.id = Production.report_production_id
			AND BanReason.id = Ban.ban_reason_id
			AND BanType.id = Ban.ban_type_id
			AND ReportBanType.id = BanType.report_ban_type_id
			AND Ban.is_foreign = 0
		GROUP BY ReportProduction__name, ProductionType.name, Ban.use_order, BanReason.name, ReportBanType.name
		ORDER BY ReportProduction__name, ProductionType.name, Ban.use_order, BanReason.name, ReportBanType.name");

		$foreign_data = $this->Registrationsup->query("
		SELECT (CASE WHEN Registrationsup.industrial=1 THEN 'Другие пищевые продукты' ELSE ReportProduction.name END) AS ReportProduction__name, ProductionType.name,
			   Ban.use_order, BanReason.name, ReportBanType.name, ROUND(SUM(Ban.weight),2) AS weight
		FROM bans AS Ban, report_productions AS ReportProduction, productions AS Production, production_types AS ProductionType,
			 registrationsup as Registrationsup,  ban_reasons AS BanReason,
			 report_ban_types as ReportBanType, ban_types AS BanType
		WHERE   Ban.registration_id=Registrationsup.id
			AND Production.id = Ban.production_id
            AND ProductionType.id = Production.production_type_id
			#AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND ReportProduction.id = Production.report_production_id
			AND BanReason.id = Ban.ban_reason_id
			AND BanType.id = Ban.ban_type_id
			AND ReportBanType.id = BanType.report_ban_type_id
			AND Ban.is_foreign = 1
		GROUP BY ReportProduction__name, ProductionType.name, Ban.use_order, BanReason.name, ReportBanType.name
		ORDER BY ReportProduction__name, ProductionType.name, Ban.use_order, BanReason.name, ReportBanType.name");

		$this->set(compact('domestic_data'));
		$this->set(compact('foreign_data'));
	}

	public function i_index_4_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		$this->Registrationsup->Expertise->virtualFields['weight'] = 0;
		$data = $this->Registrationsup->query("
		SELECT Region.name, District.name, ProductionType.name, ReportProduction.name, ROUND(SUM(Expertise.domestic_weight+Expertise.foreign_weight),2) AS Expertise__weight
		FROM regions AS Region, districts AS District, production_types AS ProductionType, registrationsup AS Registrationsup,
			 productions AS Production, report_productions as ReportProduction, expertises as Expertise
		WHERE Registrationsup.id = Expertise.registration_id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND Registrationsup.region_id = Region.id
			AND Registrationsup.district_id = District.id
			AND Expertise.production_id = Production.id
			AND Production.production_type_id = ProductionType.id
			AND Production.report_production_id = ReportProduction.id
			AND (Expertise.domestic_weight>0 OR Expertise.foreign_weight>0)
		GROUP BY Region.name, District.name, ReportProduction.name, ProductionType.name
		ORDER BY Region.name, District.name, ReportProduction.name, ProductionType.name");

		$this->set(compact('data'));
	}

	public function i_index_5_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		$this->Registrationsup->Sample->virtualFields['act_code'] = '0/0';
		$this->Registrationsup->Sample->virtualFields['count'] = 0;
		// $data = $this->Registrationsup->query("
		// SELECT SamplePurpose.name, ProductionType.name, Registrationsup.date, CONCAT(Registrationsup.code,'/', Sample.code) as Sample__act_code, Registrationsup.owner,
		// 	   Production.name, SUM(Sample.count) AS Sample__count
		// FROM samples AS Sample LEFT JOIN sample_purposes AS SamplePurpose ON Sample.sample_purpose_id = SamplePurpose.id,
		// 	 registrationsup AS Registrationsup, productions AS Production, production_types AS ProductionType
		// WHERE Sample.registration_id = Registrationsup.id
		// 	AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
		// 	AND Registrationsup.lab_id IN (".$lab_ids.")
		// 	AND Production.id = Sample.production_id
        //     AND ProductionType.id = Production.production_type_id
		// GROUP BY SamplePurpose.name, ProductionType.name, Registrationsup.date, Sample.code, Registrationsup.owner, Production.name
		// ORDER BY SamplePurpose.name, ProductionType.name, Registrationsup.date, Sample.code, Registrationsup.owner, Production.name");

        $data = $this->Registrationsup->query("
        SELECT SamplePurpose.name, ProductionType.name, Registrationsup.date, CONCAT(Registrationsup.code,'/', Sample.code) as Sample__act_code, Registrationsup.owner,
        	   Production.name, SUM(Sample.count) AS Sample__count
        FROM samples AS Sample LEFT JOIN samples_sample_purposes as SampleSamplePurpose ON SampleSamplePurpose.sample_id = Sample.id
        					   LEFT JOIN sample_purposes AS SamplePurpose ON SampleSamplePurpose.sample_purpose_id = SamplePurpose.id,
        	 registrationsup AS Registrationsup, productions AS Production, production_types AS ProductionType
        WHERE Sample.registration_id = Registrationsup.id
        	AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
    		AND Registrationsup.lab_id IN (".$lab_ids.")
        	AND Production.id = Sample.production_id
        	AND ProductionType.id = Production.production_type_id
        GROUP BY SamplePurpose.name, ProductionType.name, Registrationsup.date, Sample.code, Registrationsup.owner, Production.name
        ORDER BY SamplePurpose.name, ProductionType.name, Registrationsup.date, Sample.code, Registrationsup.owner, Production.name");
//var_dump($data);
		$this->set(compact('data'));
	}

	public function i_index_6_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		$this->Registrationsup->Expertise->Detection->DetectionType->virtualFields['name'] = '';
        $this->Registrationsup->Expertise->virtualFields['count'] = 0;
        $this->Registrationsup->Expertise->virtualFields['count_sum'] = 0;
        $this->Registrationsup->Expertise->Production->ReportProduction->virtualFields['name'] = '';
        $this->Registrationsup->Expertise->Production->ProductionType->virtualFields['name'] = '';
        $this->Registrationsup->User->virtualFields['displayname'] = '';
		$data = $this->Registrationsup->query("
		SELECT * FROM
		(SELECT DetectionType.name AS DetectionType__name, SUM(Expertise.count) AS Expertise__count_sum
		FROM expertises AS Expertise, detections AS Detection, detection_types AS DetectionType, registrationsup AS Registrationsup
		WHERE Detection.id IN (SELECT detection_id FROM expertises_detections WHERE expertise_id = Expertise.id)
		AND DetectionType.id = Detection.detection_type_id
		AND Registrationsup.id = Expertise.registration_id
		AND Expertise.count>0
		AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
		AND Registrationsup.lab_id IN (".$lab_ids.")
		GROUP BY DetectionType.name
		ORDER BY DetectionType.name) AS a
		RIGHT JOIN
		(SELECT DetectionType.name AS DetectionType__name, ReportProduction.name AS ReportProduction__name, ProductionType.name AS ProductionType__name,
				User.displayname AS User__displayname, SUM(Expertise.count) AS Expertise__count
		FROM expertises AS Expertise, detections AS Detection, detection_types AS DetectionType, productions AS Production,
			 production_types AS ProductionType, report_productions AS ReportProduction, users AS User, registrationsup AS Registrationsup
		WHERE Registrationsup.id = Expertise.registration_id
		AND Detection.id IN (SELECT detection_id FROM expertises_detections WHERE expertise_id = Expertise.id)
		AND DetectionType.id = Detection.detection_type_id
		AND Production.id = Expertise.production_id
		AND ReportProduction.id = Production.report_production_id
		AND ProductionType.id = Production.production_type_id
		AND User.id = Registrationsup.user_id
		AND Expertise.count>0
		AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
		AND Registrationsup.lab_id IN (".$lab_ids.")
		GROUP BY DetectionType.name, ReportProduction.name, ProductionType.name, User.displayname
		ORDER BY DetectionType.name, ReportProduction.name, ProductionType.name, User.displayname) AS b
		ON a.DetectionType__name=b.DetectionType__name");

		$this->set(compact('data'));
	}

	public function i_index_7_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		$this->Registrationsup->Research->virtualFields['count'] = '0';
		$this->Registrationsup->Research->virtualFields['positive_count'] = '0';
		$data = $this->Registrationsup->query("
		SELECT ResearchType.name, ReportProduction.name, ProductionType.name, User.displayname,
			   SUM(Research.count) AS Research__count, SUM(CASE WHEN Research.research_result IN ('\"Положительный\"','Неудовлетворительный') THEN Research.count ELSE 0 END) AS Research__positive_count
		FROM research_types AS ResearchType, report_productions AS ReportProduction, production_types AS ProductionType,
			 researches AS Research, users AS User, productions AS Production, registrationsup AS Registrationsup
		WHERE Research.research_type_id = ResearchType.id
		AND Research.count>0
		AND Production.id = Research.production_id
        AND ProductionType.id = Production.production_type_id
		AND ReportProduction.id = Production.report_production_id
		AND Research.registration_id = Registrationsup.id
		AND User.id = Registrationsup.user_id
		AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
		AND Registrationsup.lab_id IN (".$lab_ids.")
		GROUP BY ResearchType.name, ReportProduction.name, ProductionType.name, User.displayname
        ORDER BY ResearchType.name, ReportProduction.name, ProductionType.name, User.displayname");

		$this->set(compact('data'));
	}

	public function i_index_8_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		$this->Registrationsup->Expertise->virtualFields['weight'] = '0';
		$this->Registrationsup->Ban->virtualFields['weight'] = '0';
		// $data = $this->Registrationsup->query("
		// SELECT ReportProduction.name, ProductionType.name, User.displayname,
	 //    	   ROUND(SUM(Expertise.domestic_weight+Expertise.foreign_weight),2) AS Expertise__weight,
  //       	   ROUND(SUM(IFNULL((SELECT SUM(b.weight) FROM bans AS b WHERE b.expertise_id=Expertise.id),0)),2) AS Ban__weight
		// FROM report_productions AS ReportProduction,
		// 	 users AS User, productions AS Production, production_types AS ProductionType,
		//      registrationsup AS Registrationsup, expertises AS Expertise
		// WHERE User.id = Registrationsup.user_id
		// AND Registrationsup.id = Expertise.registration_id
		// AND Production.id = Expertise.production_id
  //       AND ProductionType.id = Production.production_type_id
		// AND ReportProduction.id = Production.report_production_id
		// AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
		// #AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
		// AND Registrationsup.lab_id IN (".$lab_ids.")
		// GROUP BY ReportProduction.name, ProductionType.name, User.displayname
		// ORDER BY ReportProduction.name, ProductionType.name, User.displayname");

		$data = $this->Registrationsup->query("
		SELECT ReportProduction.name, ProductionType.name, User.displayname,
	    	   ROUND(SUM(Expertise.domestic_weight+Expertise.foreign_weight),2) AS Expertise__weight,
        	   ROUND(IFNULL(SUM(Ban.weight),0),2) AS Ban__weight
		FROM report_productions AS ReportProduction,
			 users AS User, productions AS Production, production_types AS ProductionType,
		     registrationsup AS Registrationsup, expertises AS Expertise LEFT JOIN bans AS Ban ON Ban.expertise_id=Expertise.id AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
		WHERE User.id = Registrationsup.user_id
		AND Registrationsup.id = Expertise.registration_id
		AND Production.id = Expertise.production_id
        AND ProductionType.id = Production.production_type_id
		AND ReportProduction.id = Production.report_production_id
		AND Registrationsup.lab_id IN (".$lab_ids.")
		GROUP BY ReportProduction.name, ProductionType.name, User.displayname
		ORDER BY ReportProduction.name, ProductionType.name, User.displayname");

		$this->set(compact('data'));
	}

	public function i_index_9_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		//$this->Registrationsup->Expertise->Production->ReportProduction->virtualFields['name'] = '';
		$this->Registrationsup->Expertise->virtualFields['weight'] = '0';
		$domestic_data = $this->Registrationsup->query("
		SELECT ProductionType.name, Production.name,
			   ROUND(SUM(Expertise.domestic_weight),2) AS Expertise__weight
		FROM productions AS Production,
		     registrationsup AS Registrationsup, expertises AS Expertise, production_types AS ProductionType
		WHERE Expertise.registration_id = Registrationsup.id
			AND Expertise.production_id = Production.id
			AND ProductionType.id = Production.production_type_id
			AND Expertise.domestic_weight <> 0
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
		GROUP BY ProductionType.name, Production.name
		ORDER BY ProductionType.name, Production.name");

		$foreign_data = $this->Registrationsup->query("
		SELECT ProductionType.name, Production.name,
			   ROUND(SUM(Expertise.foreign_weight),2) AS Expertise__weight
		FROM productions AS Production,
		     registrationsup AS Registrationsup, expertises AS Expertise, production_types AS ProductionType
		WHERE Expertise.registration_id = Registrationsup.id
			AND Expertise.production_id = Production.id
			AND ProductionType.id = Production.production_type_id
			AND Expertise.foreign_weight <> 0
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
		GROUP BY ProductionType.name, Production.name
		ORDER BY ProductionType.name, Production.name");

		$this->set(compact('domestic_data'));
		$this->set(compact('foreign_data'));
	}

	public function i_index_10_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));

		$this->Registrationsup->Sample->virtualFields['count'] = '0';
		$this->Registrationsup->Sample->virtualFields['positives'] = '0';

		$planned_data = $this->Registrationsup->query("
        SELECT Vetlab.name, ProductionType.name, Production.name, Organ.order_type, Organ.order_date, Organ.order_num,
        	   SamplePurpose.name, COUNT(Sample.id) AS Sample__count, SUM(SampleSamplePurpose.positive) AS Sample__positives
        FROM samples AS Sample, vetlabs as Vetlab, production_types AS ProductionType, productions AS Production, organs AS Organ,
        	 registrationsup AS Registrationsup, sample_purposes as SamplePurpose, samples_sample_purposes as SampleSamplePurpose
        WHERE Registrationsup.id = Sample.registration_id
        AND Vetlab.id = Sample.vetlab_id
        AND Production.id = Sample.production_id
        AND ProductionType.id = Production.production_type_id
        AND Organ.id = (SELECT organ_id FROM institutions WHERE id = (SELECT institution_id FROM labs WHERE id = Registrationsup.lab_id))
        AND SampleSamplePurpose.sample_id = Sample.id
        AND SamplePurpose.id = SampleSamplePurpose.sample_purpose_id
		AND SamplePurpose.category = 'Госуслуга'
		AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
		AND Registrationsup.lab_id IN (".$lab_ids.")
		GROUP BY Vetlab.name, ProductionType.name, Production.name, Organ.order_type, Organ.order_date, Organ.order_num, SamplePurpose.name
		ORDER BY Vetlab.name, ProductionType.name, Production.name, Organ.order_type, Organ.order_date, Organ.order_num, SamplePurpose.name;");

		$extra_data = $this->Registrationsup->query("
        SELECT Vetlab.name, ProductionType.name, Production.name, Organ.order_type, Organ.order_date, Organ.order_num,
        	   SamplePurpose.name, COUNT(Sample.id) AS Sample__count, SUM(SampleSamplePurpose.positive) AS Sample__positives
        FROM samples AS Sample, vetlabs as Vetlab, production_types AS ProductionType, productions AS Production, organs AS Organ,
        	 registrationsup AS Registrationsup, sample_purposes as SamplePurpose, samples_sample_purposes as SampleSamplePurpose
        WHERE Registrationsup.id = Sample.registration_id
        AND Vetlab.id = Sample.vetlab_id
        AND Production.id = Sample.production_id
        AND ProductionType.id = Production.production_type_id
        AND Organ.id = (SELECT organ_id FROM institutions WHERE id = (SELECT institution_id FROM labs WHERE id = Registrationsup.lab_id))
        AND SampleSamplePurpose.sample_id = Sample.id
        AND SamplePurpose.id = SampleSamplePurpose.sample_purpose_id
		AND SamplePurpose.category <> 'Госуслуга'
		AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
		AND Registrationsup.lab_id IN (".$lab_ids.")
		GROUP BY Vetlab.name, ProductionType.name, Production.name, Organ.order_type, Organ.order_date, Organ.order_num, SamplePurpose.name
		ORDER BY Vetlab.name, ProductionType.name, Production.name, Organ.order_type, Organ.order_date, Organ.order_num, SamplePurpose.name;");

		$this->set(compact('planned_data'));
		$this->set(compact('extra_data'));
	}

	public function i_index_11_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->Registrationsup->Expertise->virtualFields['weight'] = '0';

		$data = $this->Registrationsup->query("
			SELECT ReportProduction.name, SUM(Expertise.samples_weight) AS Expertise__weight
			FROM report_productions AS ReportProduction, productions AS Production, registrationsup AS Registrationsup, expertises AS Expertise
			WHERE Registrationsup.id = Expertise.registration_id
				AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_ids.")
				AND Production.id = Expertise.production_id
				AND ReportProduction.id = Production.report_production_id
			GROUP BY ReportProduction.name
			ORDER BY ReportProduction.name;");

		$this->set(compact('data'));
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
	}

	public function i_index_12_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->Registrationsup->Expertise->virtualFields['count'] = '0';
		$this->Registrationsup->Expertise->virtualFields['weight'] = '0';

		$data = $this->Registrationsup->query("
			SELECT ProductionType.name, ReportProduction.name, Region.name, District.name, SUM(Expertise.count) AS Expertise__count,
				   SUM(Expertise.domestic_weight+Expertise.foreign_weight) AS Expertise__weight
			FROM production_types AS ProductionType, report_productions AS ReportProduction, productions AS Production,
				 regions AS Region, districts AS District, registrationsup AS Registrationsup, expertises AS Expertise
			WHERE Registrationsup.id = Expertise.registration_id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND Production.id = Expertise.production_id
			AND ProductionType.id = Production.production_type_id
			AND ReportProduction.id = Production.report_production_id
			AND Region.id = Registrationsup.region_id
			AND District.id = Registrationsup.district_id
			GROUP BY ProductionType.name, ReportProduction.name, Region.name, District.name");

		$this->set(compact('data'));
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
	}

    public function i_index_13_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));

		$this->Registrationsup->Sample->virtualFields['repeated'] = '0';

		$planned_data = $this->Registrationsup->query("
        SELECT Vetlab.name, ProductionType.name, Production.name, Organ.order_type, Organ.order_date, Organ.order_num,
        	   SamplePurpose.name, COUNT(Sample.id) AS Sample__repeated
        FROM samples AS Sample, vetlabs as Vetlab, production_types AS ProductionType, productions AS Production, organs AS Organ,
        	 registrationsup AS Registrationsup, sample_purposes as SamplePurpose, samples_sample_purposes as SampleSamplePurpose
        WHERE Registrationsup.id = Sample.registration_id
        AND Vetlab.id = Sample.vetlab_id
        AND Production.id = Sample.production_id
        AND ProductionType.id = Production.production_type_id
        AND Organ.id = (SELECT organ_id FROM institutions WHERE id = (SELECT institution_id FROM labs WHERE id = Registrationsup.lab_id))
        AND SampleSamplePurpose.sample_id = Sample.id
        AND SamplePurpose.id = SampleSamplePurpose.sample_purpose_id
        AND Sample.repeated = 1
		AND SamplePurpose.category = 'Госуслуга'
		AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
		AND Registrationsup.lab_id IN (".$lab_ids.")
		GROUP BY Vetlab.name, ProductionType.name, Production.name, Organ.order_type, Organ.order_date, Organ.order_num, SamplePurpose.name
		ORDER BY Vetlab.name, ProductionType.name, Production.name, Organ.order_type, Organ.order_date, Organ.order_num, SamplePurpose.name;");

		$extra_data = $this->Registrationsup->query("
        SELECT Vetlab.name, ProductionType.name, Production.name, Organ.order_type, Organ.order_date, Organ.order_num,
        	   SamplePurpose.name, COUNT(Sample.id) AS Sample__repeated
        FROM samples AS Sample, vetlabs as Vetlab, production_types AS ProductionType, productions AS Production, organs AS Organ,
        	 registrationsup AS Registrationsup, sample_purposes as SamplePurpose, samples_sample_purposes as SampleSamplePurpose
        WHERE Registrationsup.id = Sample.registration_id
        AND Vetlab.id = Sample.vetlab_id
        AND Production.id = Sample.production_id
        AND ProductionType.id = Production.production_type_id
        AND Organ.id = (SELECT organ_id FROM institutions WHERE id = (SELECT institution_id FROM labs WHERE id = Registrationsup.lab_id))
        AND SampleSamplePurpose.sample_id = Sample.id
        AND SamplePurpose.id = SampleSamplePurpose.sample_purpose_id
        AND Sample.repeated = 1
		AND SamplePurpose.category <> 'Госуслуга'
		AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
		AND Registrationsup.lab_id IN (".$lab_ids.")
		GROUP BY Vetlab.name, ProductionType.name, Production.name, Organ.order_type, Organ.order_date, Organ.order_num, SamplePurpose.name
		ORDER BY Vetlab.name, ProductionType.name, Production.name, Organ.order_type, Organ.order_date, Organ.order_num, SamplePurpose.name;");

		$this->set(compact('planned_data'));
		$this->set(compact('extra_data'));
	}

	public function i_index_14_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));

		$this->Registrationsup->Expertise->Detection->virtualFields['count'] = '0';
		//Organ.id = (SELECT organ_id FROM institutions WHERE id = (SELECT institution_id FROM labs WHERE id = Registrationsup.lab_id))
		$data = $this->Registrationsup->query("
		SELECT DetectionType.name, Detection.name, Region.name, District.name, ReportProduction.name,
			ProductionType.name, Registrationsup.doc_form, Registrationsup.doc_num, Registrationsup.doc_date,
			Registrationsup.owner, SUM(Expertise.count) AS Detection__count, Lab.name, Registrationsup.code
		FROM detections as Detection
			JOIN expertises_detections ON expertises_detections.detection_id = Detection.id
			JOIN expertises AS Expertise ON Expertise.id = expertises_detections.expertise_id
			JOIN registrationsup AS Registrationsup ON Registrationsup.id = Expertise.registration_id
			JOIN detection_types AS DetectionType ON DetectionType.id = Detection.detection_type_id
			JOIN regions AS Region ON Region.id = Registrationsup.region_id
			JOIN districts AS District ON District.id = Registrationsup.district_id
			JOIN productions AS Production ON Production.id = Expertise.production_id
			JOIN report_productions AS ReportProduction ON ReportProduction.id = Production.report_production_id
			JOIN production_types AS ProductionType ON ProductionType.id = Production.production_type_id
			JOIN labs AS Lab ON Lab.id = Registrationsup.lab_id
		WHERE
			DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
		GROUP BY DetectionType.name, Detection.name, Region.name, District.name, ReportProduction.name,
			ProductionType.name, Registrationsup.doc_form, Registrationsup.doc_num, Registrationsup.doc_date,
			Registrationsup.owner, Lab.name, Registrationsup.code
		ORDER BY DetectionType.name, Detection.name, Region.name, District.name, ReportProduction.name,
			ProductionType.name, Registrationsup.doc_form, Registrationsup.doc_num, Registrationsup.doc_date,
			Registrationsup.owner;");

		$this->set(compact('data'));
	}

	public function vet5_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		$lab_id = $this->_getLabIds($institution_id, $lab_id);

		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		//Configure::write('debug', 0);
		$this->layout = null;

		$data3_1_query = "
			SELECT ReportProduction.name, ReportResearch.name, SUM(Research.count) as count
			FROM researches as Research,
				 research_types as ResearchType,
				 report_researches as ReportResearch,
				 registrationsup as Registrationsup,
				 report_productions as ReportProduction,
				 productions as Production
			WHERE Research.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
				AND Production.id = Research.production_id
				AND ResearchType.id = Research.research_type_id
				AND ReportResearch.id = ResearchType.report_research_id
				AND ReportProduction.id = Production.report_production_id
				AND Research.registration_id=Registrationsup.id
				AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
				#AND Registrationsup.industrial = 0
				AND (Registrationsup.industrial = 0 OR Research.production_id IN (SELECT id FROM productions WHERE production_type_id IN (5,23)))
			Group BY ReportProduction.name, ReportResearch.name";
		$data3_1 = $this->Registrationsup->query($data3_1_query);
		$flat = array();
 	    foreach ($data3_1 as $key => $value) {
	 	    $flat[mb_strtolower($data3_1[$key]['ReportResearch']['name'])][mb_strtolower($data3_1[$key]['ReportProduction']['name'])] = $data3_1[$key][0]['count'];
	    }
		$data3_1 = $flat;
		$this->set(compact('data3_1'));

		// $totals3_1_query = "
			// SELECT ReportProduction.name, SUM(Research.count) as count
			// FROM researches as Research,
				 // research_types as ResearchType,
				 // report_researches as ReportResearch,
				 // registrationsup as Registrationsup,
				 // report_productions as ReportProduction,
				 // productions as Production
			// WHERE Research.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
				// AND Production.id = Research.production_id
				// AND ResearchType.id = Research.research_type_id
				// AND ReportResearch.id = ResearchType.report_research_id
				// AND ReportProduction.id = Production.report_production_id
				// AND Research.registration_id=Registrationsup.id
				// AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				// AND Registrationsup.lab_id IN (".$lab_id.")
				// AND Registrationsup.industrial = 0
			// Group BY ReportProduction.name";
		$totals3_1_query = "
			SELECT ReportProduction.name, SUM(Expertise.count) as count
			FROM expertises as Expertise,
				 registrationsup as Registrationsup,
				 report_productions as ReportProduction,
				 productions as Production
			WHERE Expertise.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
				AND Production.id = Expertise.production_id
				AND ReportProduction.id = Production.report_production_id
				AND Expertise.registration_id=Registrationsup.id
				AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
				#AND Registrationsup.industrial = 0
				AND (Registrationsup.industrial = 0 OR Expertise.production_id IN (SELECT id FROM productions WHERE production_type_id IN (5,23)))
			Group BY ReportProduction.name";
		$totals3_1 = $this->Registrationsup->query($totals3_1_query);
		$flat = array();
 	    foreach ($totals3_1 as $key => $value) {
	 	    $flat[mb_strtolower($totals3_1[$key]['ReportProduction']['name'])]=$totals3_1[$key][0]['count'];
	    }
		$totals3_1 = $flat;
		$this->set(compact('totals3_1'));

		$totals3_2_query = "
			SELECT ReportProduction.name, SUM(Sample.count) as count
			FROM samples as Sample,
                 samples_sample_purposes as SampleSamplePurpose,
				 sample_purposes as SamplePurpose,
				 registrationsup as Registrationsup,
				 report_productions as ReportProduction,
				 productions as Production
			WHERE Sample.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
				AND Production.id = Sample.production_id
				AND ReportProduction.id = Production.report_production_id
				AND Sample.registration_id = Registrationsup.id
                AND SampleSamplePurpose.sample_id = Sample.id
                AND SampleSamplePurpose.sample_purpose_id = SamplePurpose.id
			    AND SamplePurpose.category = 'Показания'
				AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
				AND (Registrationsup.industrial = 0 OR Sample.production_id IN (SELECT id FROM productions WHERE production_type_id IN (5,23)))
			Group BY ReportProduction.name";
		$totals3_2 = $this->Registrationsup->query($totals3_2_query);
		$flat = array();
 	    foreach ($totals3_2 as $key => $value) {
	 	    $flat[mb_strtolower($totals3_2[$key]['ReportProduction']['name'])]=$totals3_2[$key][0]['count'];
	    }
		$totals3_2 = $flat;
		$this->set(compact('totals3_2'));

		$data3_3_query = "
		SELECT ReportProduction.name, ReportDetection.name, SUM(Expertise.count) as count #COUNT(Detection.id) as count
		FROM
			registrationsup as Registrationsup,
			report_productions as ReportProduction,
			productions as Production,
			detections as Detection,
			expertises_detections,
			report_detections as ReportDetection,
			expertises as Expertise
		WHERE Expertise.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
			AND Production.id = Expertise.production_id
			AND ReportProduction.id = Production.report_production_id
			AND Expertise.registration_id=Registrationsup.id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_id.")
			AND expertises_detections.expertise_id = Expertise.id
			AND Detection.id = expertises_detections.detection_id
			AND ReportDetection.id = Detection.report_detection_id
			#AND Registrationsup.industrial = 0
			AND (Registrationsup.industrial = 0 OR Expertise.production_id IN (SELECT id FROM productions WHERE production_type_id IN (5,23)))
		Group BY ReportProduction.name, ReportDetection.name";
		$data3_3 = $this->Registrationsup->query($data3_3_query);
		$flat = array();
 	    foreach ($data3_3 as $key => $value) {
	 	    $flat[mb_strtolower($data3_3[$key]['ReportDetection']['name'])][mb_strtolower($data3_3[$key]['ReportProduction']['name'])] = $data3_3[$key][0]['count'];
	    }
		$data3_3 = $flat;
		$this->set(compact('data3_3'));

		$totals3_3_query = "
		SELECT ReportProduction.name, SUM(Expertise.count) as count #COUNT(Detection.id) as count
		FROM
			registrationsup as Registrationsup,
			report_productions as ReportProduction,
			productions as Production,
			expertises as Expertise,
			detections as Detection,
			expertises_detections
		WHERE Expertise.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
			AND Production.id = Expertise.production_id
			AND ReportProduction.id = Production.report_production_id
			AND Expertise.registration_id=Registrationsup.id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_id.")
			AND Registrationsup.industrial = 0
			#AND (Registrationsup.industrial = 0 OR Expertise.production_id IN (SELECT id FROM productions WHERE production_type_id IN (5,23)))
			AND expertises_detections.expertise_id = Expertise.id
			AND Detection.id = expertises_detections.detection_id
		Group BY ReportProduction.name";
		$totals3_3 = $this->Registrationsup->query($totals3_3_query);
		$flat = array();
 	    foreach ($totals3_3 as $key => $value) {
	 	    $flat[mb_strtolower($totals3_3[$key]['ReportProduction']['name'])]=$totals3_3[$key][0]['count'];
	    }
		$totals3_3 = $flat;
		$this->set(compact('totals3_3'));

		$data3_4_query="
			SELECT ReportProduction.name, ReportBanReason.name, ROUND(SUM(Ban.weight)/1000,4) count
			FROM
				registrationsup as Registrationsup,
				report_productions as ReportProduction,
				productions as Production,
				ban_reasons as BanReason,
				report_ban_reasons as ReportBanReason,
				bans as Ban
			WHERE Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
				AND Production.id = Ban.production_id
				AND ReportProduction.id = Production.report_production_id
				AND Ban.registration_id=Registrationsup.id
				#AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
				#AND Registrationsup.industrial = 0
				AND (Registrationsup.industrial = 0 OR Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (5,23)))
				AND BanReason.id = Ban.ban_reason_id
				AND ReportBanReason.id = BanReason.report_ban_reason_id
				AND Ban.use_order = 'Обезвреживание'
				AND Ban.ban_type_id in (SELECT id from ban_types where report_ban_type_id=4)
			Group BY ReportProduction.name, ReportBanReason.name;";
		$data3_4 = $this->Registrationsup->query($data3_4_query);
		$flat = array();
 	    foreach ($data3_4 as $key => $value) {
	 	    $flat[mb_strtolower($data3_4[$key]['ReportBanReason']['name'])][mb_strtolower($data3_4[$key]['ReportProduction']['name'])] = $data3_4[$key][0]['count'];
	    }
		$data3_4 = $flat;
		$this->set(compact('data3_4'));

		$totals3_4_query="
			SELECT ReportProduction.name, ROUND(SUM(Ban.weight)/1000,4) count
			FROM
				registrationsup as Registrationsup,
				report_productions as ReportProduction,
				productions as Production,
				bans as Ban
			WHERE Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
				AND Production.id = Ban.production_id
				AND ReportProduction.id = Production.report_production_id
				AND Ban.registration_id=Registrationsup.id
				#AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
				#AND Registrationsup.industrial = 0
				AND (Registrationsup.industrial = 0 OR Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (5,23)))
				AND Ban.use_order = 'Обезвреживание'
				AND Ban.ban_type_id in (SELECT id from ban_types where report_ban_type_id=4)
			Group BY ReportProduction.name;";
		$totals3_4 = $this->Registrationsup->query($totals3_4_query);
		$flat = array();
 	    foreach ($totals3_4 as $key => $value) {
	 	    $flat[mb_strtolower($totals3_4[$key]['ReportProduction']['name'])]=$totals3_4[$key][0]['count'];
	    }
		$totals3_4 = $flat;
		$this->set(compact('totals3_4'));

		$data3_5_query="
			SELECT ReportProduction.name, ReportBanReason.name, ROUND(SUM(Ban.weight)/1000,4) count
			FROM
				registrationsup as Registrationsup,
				report_productions as ReportProduction,
				productions as Production,
				ban_reasons as BanReason,
				report_ban_reasons as ReportBanReason,
				bans as Ban
			WHERE Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
				AND Production.id = Ban.production_id
				AND ReportProduction.id = Production.report_production_id
				AND Ban.registration_id=Registrationsup.id
				#AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
				#AND Registrationsup.industrial = 0
				AND (Registrationsup.industrial = 0 OR Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (5,23)))
				AND BanReason.id = Ban.ban_reason_id
				AND ReportBanReason.id = BanReason.report_ban_reason_id
				AND Ban.use_order = 'Обезвреживание'
				AND Ban.ban_type_id in (SELECT id from ban_types where report_ban_type_id=5)
			Group BY ReportProduction.name, ReportBanReason.name;";
		$data3_5 = $this->Registrationsup->query($data3_5_query);
		$flat = array();
 	    foreach ($data3_5 as $key => $value) {
	 	    $flat[mb_strtolower($data3_5[$key]['ReportBanReason']['name'])][mb_strtolower($data3_5[$key]['ReportProduction']['name'])] = $data3_5[$key][0]['count'];
	    }
		$data3_5 = $flat;
		$this->set(compact('data3_5'));

		$totals3_5_query="
			SELECT ReportProduction.name, ROUND(SUM(Ban.weight)/1000,4) count
			FROM
				registrationsup as Registrationsup,
				report_productions as ReportProduction,
				productions as Production,
				bans as Ban
			WHERE Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
				AND Production.id = Ban.production_id
				AND ReportProduction.id = Production.report_production_id
				AND Ban.registration_id=Registrationsup.id
				#AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
				#AND Registrationsup.industrial = 0
				AND (Registrationsup.industrial = 0 OR Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (5,23)))
				AND Ban.use_order = 'Обезвреживание'
				AND Ban.ban_type_id in (SELECT id from ban_types where report_ban_type_id=5)
			Group BY ReportProduction.name;";
		$totals3_5 = $this->Registrationsup->query($totals3_5_query);
		$flat = array();
 	    foreach ($totals3_5 as $key => $value) {
	 	    $flat[mb_strtolower($totals3_5[$key]['ReportProduction']['name'])]=$totals3_5[$key][0]['count'];
	    }
		$totals3_5 = $flat;
		$this->set(compact('totals3_5'));

		//6. Направлено на утилизацию  мяса (тонн
		$data3_6_query="
			SELECT ReportProduction.name, ReportBanReason.name, ROUND(SUM(Ban.weight)/1000,4) count
			FROM
				registrationsup as Registrationsup,
				report_productions as ReportProduction,
				productions as Production,
				ban_reasons as BanReason,
				report_ban_reasons as ReportBanReason,
				bans as Ban
			WHERE Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
				AND Production.id = Ban.production_id
				AND ReportProduction.id = Production.report_production_id
				AND Ban.registration_id=Registrationsup.id
				#AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
				#AND Registrationsup.industrial = 0
				AND (Registrationsup.industrial = 0 OR Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (5,23)))
				AND BanReason.id = Ban.ban_reason_id
				AND ReportBanReason.id = BanReason.report_ban_reason_id
				AND Ban.use_order IN ('Возвращено владельцу','Утилизация','В корм животным')
				AND Ban.ban_type_id in (SELECT id from ban_types where report_ban_type_id=4)
			Group BY ReportProduction.name, ReportBanReason.name;";
		$data3_6 = $this->Registrationsup->query($data3_6_query);
		$flat = array();
 	    foreach ($data3_6 as $key => $value) {
	 	    $flat[mb_strtolower($data3_6[$key]['ReportBanReason']['name'])][mb_strtolower($data3_6[$key]['ReportProduction']['name'])] = $data3_6[$key][0]['count'];
	    }
		$data3_6 = $flat;
		$this->set(compact('data3_6'));

		$totals3_6_query="
			SELECT ReportProduction.name, ROUND(SUM(Ban.weight)/1000,4) count
			FROM
				registrationsup as Registrationsup,
				report_productions as ReportProduction,
				productions as Production,
				bans as Ban
			WHERE Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
				AND Production.id = Ban.production_id
				AND ReportProduction.id = Production.report_production_id
				AND Ban.registration_id=Registrationsup.id
				#AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
				#AND Registrationsup.industrial = 0
				AND (Registrationsup.industrial = 0 OR Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (5,23)))
				AND Ban.use_order IN ('Возвращено владельцу','Утилизация','В корм животным')
				AND Ban.ban_type_id in (SELECT id from ban_types where report_ban_type_id=4)
			Group BY ReportProduction.name;";
		$totals3_6 = $this->Registrationsup->query($totals3_6_query);
		$flat = array();
 	    foreach ($totals3_6 as $key => $value) {
	 	    $flat[mb_strtolower($totals3_6[$key]['ReportProduction']['name'])]=$totals3_6[$key][0]['count'];
	    }
		$totals3_6 = $flat;
		$this->set(compact('totals3_6'));

		$this->Registrationsup->Ban->BanType->ReportBanType->virtualFields['name'] = '';

		$data3_7_query="
			SELECT ReportProduction.name, (CASE ReportProduction.name WHEN \"Рыба\" THEN \"Мясо\" ELSE ReportBanType.name END) AS ReportBanType__name, ROUND(SUM(Ban.weight)/1000,4) count
			FROM
				registrationsup as Registrationsup,
				report_productions as ReportProduction,
				productions as Production,
				ban_types as BanType,
				report_ban_types as ReportBanType,
				bans as Ban
			WHERE Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
				AND Production.id = Ban.production_id
				AND ReportProduction.id = Production.report_production_id
				AND Ban.registration_id=Registrationsup.id
				#AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
				#AND Registrationsup.industrial = 0
				AND (Registrationsup.industrial = 0 OR Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (5,23)))
				AND BanType.id = Ban.ban_type_id
				AND ReportBanType.id = BanType.report_ban_type_id
				AND Ban.use_order = 'Уничтожение'
			Group BY ReportProduction.name, ReportBanType.name;";
		$data3_7 = $this->Registrationsup->query($data3_7_query);
		$flat = array();
 	    foreach ($data3_7 as $key => $value) {
	 	    $flat[mb_strtolower($data3_7[$key]['ReportBanType']['name'])][mb_strtolower($data3_7[$key]['ReportProduction']['name'])] = $data3_7[$key][0]['count'];
	    }
		$data3_7 = $flat;
		$this->set(compact('data3_7'));

		$totals3_7_query="
			SELECT ReportProduction.name, ROUND(SUM(Ban.weight)/1000,4) count
			FROM
				registrationsup as Registrationsup,
				report_productions as ReportProduction,
				productions as Production,
				bans as Ban
			WHERE Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
				AND Production.id = Ban.production_id
				AND ReportProduction.id = Production.report_production_id
				AND Ban.registration_id=Registrationsup.id
				#AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
				#AND Registrationsup.industrial = 0
				AND (Registrationsup.industrial = 0 OR Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (5,23)))
				AND Ban.use_order = 'Уничтожение'
			Group BY ReportProduction.name;";
		$totals3_7 = $this->Registrationsup->query($totals3_7_query);
		$flat = array();
 	    foreach ($totals3_7 as $key => $value) {
	 	    $flat[mb_strtolower($totals3_7[$key]['ReportProduction']['name'])]=$totals3_7[$key][0]['count'];
	    }
		$totals3_7 = $flat;
		$this->set(compact('totals3_7'));

		// $totals4_1_query = "
			// SELECT (CASE WHEN Registrationsup.industrial=1 THEN 'Другие пищевые продукты' ELSE ReportProduction.name END) production_name, SUM(Research.count) as count
			// FROM researches as Research,
				 // research_types as ResearchType,
				 // report_researches as ReportResearch,
				 // registrationsup as Registrationsup,
				 // report_productions as ReportProduction,
				 // productions as Production
			// WHERE (Research.production_id IN (SELECT id FROM productions WHERE production_type_id NOT IN (1,5,23))
				// OR Registrationsup.industrial=1)
				// AND Production.id = Research.production_id
				// AND ResearchType.id = Research.research_type_id
				// AND ReportResearch.id = ResearchType.report_research_id
				// AND ReportProduction.id = Production.report_production_id
				// AND Research.registration_id=Registrationsup.id
				// AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				// AND Registrationsup.lab_id IN (".$lab_id.")
			// Group BY production_name";

		$totals4_1_query = "SELECT (CASE WHEN Registrationsup.industrial=1 THEN 'Другие пищевые продукты' ELSE ReportProduction.name END) production_name, SUM(Expertise.count) as count
			FROM expertises as Expertise,
				 registrationsup as Registrationsup,
				 report_productions as ReportProduction,
				 productions as Production
			WHERE Expertise.production_id IN (SELECT id FROM productions WHERE production_type_id NOT IN (1,5,23))
				AND Production.id = Expertise.production_id
				AND ReportProduction.id = Production.report_production_id
				AND Expertise.registration_id=Registrationsup.id
				AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
			Group BY production_name";
		$totals4_1 = $this->Registrationsup->query($totals4_1_query);
		$flat = array();
 	    foreach ($totals4_1 as $key => $value) {
	 	    $flat[mb_strtolower($totals4_1[$key][0]['production_name'])]=$totals4_1[$key][0]['count'];
	    }
		$totals4_1 = $flat;
		$this->set(compact('totals4_1'));

		$totals4_2_query = "
			SELECT (CASE WHEN Registrationsup.industrial=1 THEN 'Другие пищевые продукты' ELSE ReportProduction.name END) production_name, SUM(Research.count) as count
			FROM researches as Research,
				 research_types as ResearchType,
				 report_researches as ReportResearch,
				 registrationsup as Registrationsup,
				 report_productions as ReportProduction,
				 productions as Production
			WHERE (Research.production_id IN (SELECT id FROM productions WHERE production_type_id NOT IN (1,5,23))
				OR Registrationsup.industrial=1)
				AND Production.id = Research.production_id
				AND ResearchType.id = Research.research_type_id
				AND ReportResearch.id = ResearchType.report_research_id
				AND ReportProduction.id = Production.report_production_id
				AND Research.registration_id=Registrationsup.id
				AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
			Group BY production_name";
		$totals4_2 = $this->Registrationsup->query($totals4_2_query);
		$flat = array();
 	    foreach ($totals4_2 as $key => $value) {
	 	    $flat[mb_strtolower($totals4_2[$key][0]['production_name'])]=$totals4_2[$key][0]['count'];
	    }
		$totals4_2 = $flat;
		$this->set(compact('totals4_2'));

		$totals4_3_query="
			SELECT (CASE WHEN Registrationsup.industrial=1 THEN 'Другие пищевые продукты' ELSE ReportProduction.name END) production_name, ROUND(SUM(Ban.weight)/1000,4) count
			FROM
				registrationsup as Registrationsup,
				report_productions as ReportProduction,
				productions as Production,
				bans as Ban
			WHERE (Ban.production_id IN (SELECT id FROM productions WHERE production_type_id NOT IN (1,5,23))
				OR Registrationsup.industrial=1)
				AND Production.id = Ban.production_id
				AND ReportProduction.id = Production.report_production_id
				AND Ban.registration_id=Registrationsup.id
				#AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
				AND Ban.use_order = 'Уничтожение'
			Group BY production_name";
		$totals4_3 = $this->Registrationsup->query($totals4_3_query);
		$flat = array();
 	    foreach ($totals4_3 as $key => $value) {
	 	    $flat[mb_strtolower($totals4_3[$key][0]['production_name'])]=$totals4_3[$key][0]['count'];
	    }
		$totals4_3 = $flat;
		$this->set(compact('totals4_3'));

		$totals4_4_query="
			SELECT (CASE WHEN Registrationsup.industrial=1 THEN 'Другие пищевые продукты' ELSE ReportProduction.name END) production_name, ROUND(SUM(Ban.weight)/1000,4) count
			FROM
				registrationsup as Registrationsup,
				report_productions as ReportProduction,
				productions as Production,
				bans as Ban
			WHERE (Ban.production_id IN (SELECT id FROM productions WHERE production_type_id NOT IN (1,5,23))
				OR Registrationsup.industrial=1)
				AND Production.id = Ban.production_id
				AND ReportProduction.id = Production.report_production_id
				AND Ban.registration_id=Registrationsup.id
				#AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
				AND Ban.use_order IN ('Возвращено владельцу','Утилизация')
			Group BY production_name";
		$totals4_4 = $this->Registrationsup->query($totals4_4_query);
		$flat = array();
 	    foreach ($totals4_4 as $key => $value) {
	 	    $flat[mb_strtolower($totals4_4[$key][0]['production_name'])]=$totals4_4[$key][0]['count'];
	    }
		$totals4_4 = $flat;
		$this->set(compact('totals4_4'));

		$totals4_5_query="
			SELECT (CASE WHEN Registrationsup.industrial=1 THEN 'Другие пищевые продукты' ELSE ReportProduction.name END) production_name, ROUND(SUM(Ban.weight)/1000,4) count
			FROM
				registrationsup as Registrationsup,
				report_productions as ReportProduction,
				productions as Production,
				bans as Ban
			WHERE (Ban.production_id IN (SELECT id FROM productions WHERE production_type_id NOT IN (1,5,23))
				OR Registrationsup.industrial=1)
				AND Production.id = Ban.production_id
				AND ReportProduction.id = Production.report_production_id
				AND Ban.registration_id=Registrationsup.id
				#AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
				AND Ban.use_order = 'Уничтожение'
			Group BY production_name";
		$totals4_5 = $this->Registrationsup->query($totals4_5_query);
		$flat = array();
 	    foreach ($totals4_5 as $key => $value) {
	 	    $flat[mb_strtolower($totals4_5[$key][0]['production_name'])]=$totals4_5[$key][0]['count'];
	    }
		$totals4_5 = $flat;
		$this->set(compact('totals4_5'));

		$data4_6_query = "
		SELECT (CASE WHEN Registrationsup.industrial=1 THEN 'Другие пищевые продукты' ELSE ReportProduction.name END) production_name,
			(CASE
				WHEN ReportResearch.name NOT IN ('Радиометрических','Исследований на нитраты','Исследований на кислотность','Определений жирности','Определений фальсификации','Исследований на содержание соли','Органолептических и прочих исследований')
				THEN 'Органолептических и прочих исследований'
				ELSE ReportResearch.name END) research_name,
				SUM(Research.count) as count
			FROM researches as Research,
				 research_types as ResearchType,
				 report_researches as ReportResearch,
				 registrationsup as Registrationsup,
				 report_productions as ReportProduction,
				 productions as Production
			WHERE (Research.production_id IN (SELECT id FROM productions WHERE production_type_id NOT IN (1,5,23))
				OR Registrationsup.industrial=1)
				AND Production.id = Research.production_id
				AND ResearchType.id = Research.research_type_id
				AND ReportResearch.id = ResearchType.report_research_id
				AND ReportProduction.id = Production.report_production_id
				AND Research.registration_id=Registrationsup.id
				AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
				AND Registrationsup.lab_id IN (".$lab_id.")
			Group BY production_name, research_name";
		$data4_6 = $this->Registrationsup->query($data4_6_query);
		$flat = array();
 	    foreach ($data4_6 as $key => $value) {
	 	    $flat[mb_strtolower($data4_6[$key][0]['research_name'])][mb_strtolower($data4_6[$key][0]['production_name'])] = $data4_6[$key][0]['count'];
	    }
		$data4_6 = $flat;
		$this->set(compact('data4_6'));
	}

	public function vet5_1_doc($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));
		//Другие виды животных report_production_id=6
		//Другие виды птицы report_production_id=8
		$other_animals_query = "
			SELECT Production.name, SUM(Expertise.count) as count
			FROM expertises AS Expertise, registrationsup AS Registrationsup, productions as Production
			WHERE production_id IN (SELECT id FROM productions WHERE report_production_id=6)
			AND Expertise.registration_id=Registrationsup.id
			AND Expertise.production_id=Production.id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			GROUP BY Production.name";
		$other_birds_query = "
			SELECT Production.name, SUM(Expertise.count) as count
			FROM expertises AS Expertise, registrationsup AS Registrationsup, productions as Production
			WHERE production_id IN (SELECT id FROM productions WHERE report_production_id=8)
			AND Expertise.registration_id=Registrationsup.id
			AND Expertise.production_id=Production.id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND Registrationsup.industrial = 0
			GROUP BY Production.name";
		$other_animals = $this->Registrationsup->query($other_animals_query);
		$other_birds = $this->Registrationsup->query($other_birds_query);
		$this->set(compact('other_animals'));
		$this->set(compact('other_birds'));
	}

	public function vet5_2_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));

		$this->Registrationsup->Research->virtualFields['count'] = 0;
		//Мясо и мясопродукты production_type_id=1
		//Рыба морская production_type_id=5
		//Рыба речная production_type_id=23
		$data = $this->Registrationsup->query("
		SELECT ReportProduction.name, ReportResearch.name, ResearchType.name, Research.research_result, SUM(Research.count) AS Research__count
		FROM researches as Research,
			 research_types as ResearchType,
			 registrationsup as Registrationsup,
			 productions as Production,
			 report_productions as ReportProduction,
			 report_researches as ReportResearch
		WHERE Research.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
			AND Research.registration_id=Registrationsup.id
			AND Production.id = Research.production_id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND ReportProduction.id = Production.report_production_id
			AND ResearchType.id = Research.research_type_id
			AND ReportResearch.id = ResearchType.report_research_id
			AND Registrationsup.industrial = 0
		GROUP BY ReportProduction.name, ReportResearch.name, ResearchType.name, Research.research_result
		ORDER BY ReportProduction.name, ReportResearch.name, ResearchType.name, Research.research_result;");

		$this->set(compact('data'));
	}

	public function vet5_3_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));

		//Мясо и мясопродукты production_type_id=1
		//Рыба морская production_type_id=5
		//Рыба речная production_type_id=23
		$data = $this->Registrationsup->query("
		SELECT ReportProduction.name, ReportDetection.name, Detection.name, SUM(Expertise.count) as count
		FROM expertises AS Expertise, registrationsup AS Registrationsup,
			 productions as Production, detections AS Detection,
			 report_detections AS ReportDetection, report_productions AS ReportProduction, expertises_detections
		WHERE Expertise.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
			AND Expertise.registration_id=Registrationsup.id
			AND Production.id = Expertise.production_id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND expertises_detections.expertise_id = Expertise.id
			AND Detection.id = expertises_detections.detection_id
			AND ReportDetection.id = Detection.report_detection_id
			AND ReportProduction.id = Production.report_production_id
			AND Registrationsup.industrial = 0
		GROUP BY ReportProduction.name, ReportDetection.name, Detection.name
		ORDER BY ReportProduction.name, ReportDetection.name, Detection.name;");

		$this->set(compact('data'));
	}

	public function vet5_4_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));

		//Мясо и мясопродукты production_type_id=1
		//Рыба морская production_type_id=5
		//Рыба речная production_type_id=23
		$data = $this->Registrationsup->query("
		SELECT ReportProduction.name, Ban.use_order, BanReason.name, ReportBanType.name, ROUND(SUM(Ban.weight),2) AS weight
		FROM bans AS Ban, report_productions AS ReportProduction, productions AS Production,
			 registrationsup as Registrationsup, ban_reasons AS BanReason,
			 report_ban_types as ReportBanType, ban_types AS BanType
		WHERE Ban.production_id IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
			AND Ban.registration_id=Registrationsup.id
			AND Production.id = Ban.production_id
			#AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND ReportProduction.id = Production.report_production_id
			AND BanReason.id = Ban.ban_reason_id
			AND BanType.id = Ban.ban_type_id
			AND ReportBanType.id = BanType.report_ban_type_id
			AND Registrationsup.industrial = 0
		GROUP BY ReportProduction.name, Ban.use_order, BanReason.name, ReportBanType.name
		ORDER BY ReportProduction.name, Ban.use_order, BanReason.name, ReportBanType.name");

		$this->set(compact('data'));
	}

	public function vet5_5_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));

		//Мясо и мясопродукты production_type_id=1
		//Рыба морская production_type_id=5
		//Рыба речная production_type_id=23
		//Другие пищевые продукты ReportProduction.id = 16
		$data = $this->Registrationsup->query("
		SELECT (CASE WHEN Registrationsup.industrial=1 THEN 'Другие пищевые продукты' ELSE ReportProduction.name END) AS production_name, Production.name, SUM(Expertise.count) as count
		FROM expertises AS Expertise, registrationsup AS Registrationsup,
			 productions as Production, report_productions AS ReportProduction
		WHERE (Expertise.production_id NOT IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
			OR Registrationsup.industrial=1)
		AND Expertise.registration_id=Registrationsup.id
		AND Production.id = Expertise.production_id
		AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
		AND Registrationsup.lab_id IN (".$lab_ids.")
		AND ReportProduction.id = Production.report_production_id
		AND (ReportProduction.id = 16 OR Registrationsup.industrial=1)
		GROUP BY production_name, Production.name
		ORDER BY production_name, Production.name;");

		$this->set(compact('data'));
	}

	public function vet5_6_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));

		$this->Registrationsup->Research->virtualFields['count'] = 0;
		//Мясо и мясопродукты production_type_id=1
		//Рыба production_type_id=5
		$data = $this->Registrationsup->query("
		SELECT (CASE WHEN Registrationsup.industrial=1 THEN 'Другие пищевые продукты' ELSE ReportProduction.name END) AS production_name, ReportResearch.name, ResearchType.name, Research.research_result, SUM(Research.count) AS Research__count
		FROM researches as Research,
			 research_types as ResearchType,
			 registrationsup as Registrationsup,
			 productions as Production,
			 report_productions as ReportProduction,
			 report_researches as ReportResearch
		WHERE (Research.production_id NOT IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
			OR Registrationsup.industrial=1)
			AND Research.registration_id=Registrationsup.id
			AND Production.id = Research.production_id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND ReportProduction.id = Production.report_production_id
			AND ResearchType.id = Research.research_type_id
			AND ReportResearch.id = ResearchType.report_research_id
		GROUP BY production_name, ReportResearch.name, ResearchType.name, Research.research_result
		ORDER BY production_name, ReportResearch.name, ResearchType.name, Research.research_result;");

		$this->set(compact('data'));
	}

	public function vet5_7_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));

		//Мясо и мясопродукты production_type_id=1
		//Рыба production_type_id=5
		$data = $this->Registrationsup->query("
		SELECT (CASE WHEN Registrationsup.industrial=1 THEN 'Другие пищевые продукты' ELSE ReportProduction.name END) AS production_name, ReportDetection.name, Detection.name, SUM(Expertise.count) as count
		FROM expertises AS Expertise, registrationsup AS Registrationsup,
			 productions as Production, detections AS Detection,
			 report_detections AS ReportDetection, report_productions AS ReportProduction, expertises_detections
		WHERE (Expertise.production_id NOT IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
			OR Registrationsup.industrial=1)
			AND Expertise.registration_id=Registrationsup.id
			AND Production.id = Expertise.production_id
			AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND expertises_detections.expertise_id = Expertise.id
			AND Detection.id = expertises_detections.detection_id
			AND ReportDetection.id = Detection.report_detection_id
			AND ReportProduction.id = Production.report_production_id
		GROUP BY production_name, ReportDetection.name, Detection.name
		ORDER BY production_name, ReportDetection.name, Detection.name;");

		$this->set(compact('data'));
	}

	public function vet5_8_xml($institution_id=null, $lab_id=null, $date_from=null, $date_to=null) {
		if (!$date_from||!$date_to) {
			throw new NotFoundException("Не указан период выборки для документа.");
		}
		Configure::write('debug', 0);
		$this->layout = null;

		$lab_ids = $this->_getLabIds($institution_id, $lab_id);
		$this->_setReportCommonData($institution_id, $lab_id);
		$this->set(compact('date_from'));
		$this->set(compact('date_to'));

		//Мясо и мясопродукты production_type_id=1
		//Рыба production_type_id=5
		$data = $this->Registrationsup->query("
		SELECT (CASE WHEN Registrationsup.industrial=1 THEN 'Другие пищевые продукты' ELSE ReportProduction.name END) AS production_name, Ban.use_order, BanReason.name, BanType.name, ROUND(SUM(Ban.weight),2) AS weight
		FROM bans AS Ban, report_productions AS ReportProduction, productions AS Production,
			 registrationsup as Registrationsup, ban_reasons AS BanReason,
			 ban_types AS BanType
		WHERE (Ban.production_id NOT IN (SELECT id FROM productions WHERE production_type_id IN (1,5,23))
			OR Registrationsup.industrial=1)
			AND Ban.registration_id=Registrationsup.id
			AND Production.id = Ban.production_id
			#AND DATE(Registrationsup.date) between '".$date_from."' AND '".$date_to."'
			AND DATE(Ban.modified) between '".$date_from."' AND '".$date_to."'
			AND Registrationsup.lab_id IN (".$lab_ids.")
			AND ReportProduction.id = Production.report_production_id
			AND BanReason.id = Ban.ban_reason_id
			AND BanType.id = Ban.ban_type_id
		GROUP BY production_name, Ban.use_order, BanReason.name, BanType.name
		ORDER BY production_name, Ban.use_order, BanReason.name, BanType.name");

		$this->set(compact('data'));
	}

}
?>
