<?php
// app/Controller/PlansController.php

class PlansController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);

    public function isAuthorized($user) {
		if (isset($user['role']) && in_array($user['role'], ['Администратор', 'Администратор учреждения'])) {
            return true;
        }

        if (isset($user['role']) && $user['role'] == 'Сотрудник' && $this->action != 'store') {
            return true;
        } else {
            throw new Exception("Не удалось внести изменения: недостаточно прав", 1);
            return false;
        }
        return parent::isAuthorized($user);
    }

    public function beforeFilter() {
		$this->set('title_for_layout', 'План');
		// if (in_array($this->Auth->user('role'), array('Администратор','Администратор учреждения'))) {
		// 	$this->Auth->allow('*');
		// }
        // if ($this->Auth->user('role') == 'Сотрудник') {
        //     $this->Auth->deny('store');
        // }
        parent::beforeFilter();
    }

    public function beforeRender() {

		if ($this->Auth->user('role') === 'Администратор') {
			$this->userActions[] = array('title'=>'Справочники','url'=>Router::url(array('controller'=>'pages','action'=>'lists')));
		}
		if (in_array($this->Auth->user('role'),  array('Сотрудник','Администратор','Администратор учреждения'))) {
			$this->userActions[] = array('title'=>'Журнал','url'=>Router::url(array('controller'=>'registrations','action'=>'index')));
            $this->userActions[] = array('title'=>'Отчеты','url'=>Router::url(array('controller'=>'registrations','action'=>'reports')));
			$this->userActions[] = array('title'=>'План','url'=>Router::url(array('controller'=>'plans','action'=>'index')));
		}

		parent::beforeRender();
	}

    function index($id = null) {
        if ($this->Auth->user('role') == 'Администратор') {
            $institutions = $this->Plan->Lab->Institution->find('list');
            $institutions = array('all'=>'все') + $institutions;
			if (!isset($selectedInstitutionId)||$selectedInstitutionId=='all')
			{
				$labs = $this->Plan->Lab->find('list');
			} else
			{
				$labs = $this->Plan->Lab->find('list', array('conditions'=>array('Lab.institution_id'=>$selectedInstitutionId)));
			}
			$labs = array('all'=>'все') + $labs;
		} else if ($this->Auth->user('organ_id') && $this->Auth->user('organ_id') != 0) {
            $institutions = $this->Plan->Lab->Institution->find('list',
								array('conditions'=>array('organ_id'=>$this->Auth->user('organ_id')))
							);
            $institutions = array('all'=>'все') + $institutions;
			if (!isset($selectedInstitutionId) || $selectedInstitutionId=='all')
			{
				$labs = $this->Plan->Lab->find('list',
								array('conditions'=>array('Lab.institution_id IN (SELECT id FROM institutions WHERE organ_id='.$this->Auth->user('organ_id').')'))
							);
			} else {
				$labs = $this->Plan->Lab->find('list',
								array('conditions'=>array('Lab.institution_id=\''.$selectedInstitutionId.'\'
															AND Lab.institution_id IN (SELECT id FROM institutions
															WHERE organ_id='.$this->Auth->user('organ_id').')'))
							);
			}
			$labs = array('all'=>'все') + $labs;
			$labs = array_merge(array('all'=>'все'), $labs);
		} else if ($this->Auth->user('institution_id') && $this->Auth->user('institution_id') != 0) {
			$institutions = $this->Plan->Lab->Institution->find('list',
								array('conditions'=>array('Institution.id'=>$this->Auth->user('institution_id')))
							);
			$labs = $this->Plan->Lab->find('list',
								array('conditions'=>array('Lab.institution_id'=>$this->Auth->user('institution_id')))
							);
			$labs = array('all'=>'все') + $labs;
		} else {
			$lab_id = $this->Auth->user('lab_id');
			$labs = $this->Plan->Lab->find('list', array('conditions'=>array('Lab.id'=>$lab_id)));
			$institutions = $this->Plan->Lab->Institution->find('list',
								array('conditions'=>array('Institution.id'=>$this->Auth->user('institution_id')))
							);
		}
		$this->set(compact('labs'));
		$this->set(compact('institutions'));
    }

    function store() {
        if ($this->request->is('post')) {
            $data['Plan'] = $this->request->data;
            if ($data['Plan']['id']) {
                // $plan = $this->Plan->findById($data['Plan']['id']);
                $this->Plan->id = $data['Plan']['id'];
                if($this->Plan->save($data)) {
                    $this->set('data', $this->Plan->id);
                } else {
                    throw new Exception("Не удалось внести изменения", 1);
                }
            } else {
                $this->Plan->create();
                if ($this->Plan->save($data)) {
                    $this->set('data', $this->Plan->getLastInsertId());
    			} else {
                    throw new Exception("Не удалось внести изменения", 1);
                }
            }
            $this->set('_serialize', array('data'));
		}
    }

    function search($institution_id = null, $lab_id = null) {
        $institution_id = $institution_id? $institution_id: 'all';
        $lab_id = $lab_id? $lab_id: 'all';
        header("Pragma: no-cache");
        header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");
        header('Content-Type: application/json');
        $this->Plan->ProductionType->virtualFields['name'] = '';
        $this->Plan->virtualFields['month'] = '';
        $this->Plan->virtualFields['production_type_id'] = '';
        $this->Plan->virtualFields['institution_id'] = $institution_id;
        $this->Plan->virtualFields['lab_id'] = $lab_id;
        if($lab_id == 'all'){
            $this->Plan->virtualFields['price'] = 0;
            $this->Plan->virtualFields['count'] = 0;
        }
        $query =
        "SELECT $institution_id as Plan__institution_id,
            ".($lab_id!='all'? "Plan.id, $lab_id AS Plan__lab_id, Plan.price, Plan.count" :"SUM(Plan.price) AS Plan__price, SUM(Plan.count) AS Plan__count").",
            A.month AS Plan__month, A.production_type_id AS Plan__production_type_id, production_type_name AS ProductionType__name FROM
            (SELECT months.month, pt.id AS production_type_id, pt.name AS production_type_name FROM
                (
                    SELECT 1  AS month UNION ALL SELECT 2  AS month UNION ALL
                    SELECT 3  AS month UNION ALL SELECT 4  AS month UNION ALL
                    SELECT 5  AS month UNION ALL SELECT 6  AS month UNION ALL
                    SELECT 7  AS month UNION ALL SELECT 8  AS month UNION ALL
                    SELECT 9  AS month UNION ALL SELECT 10 AS month UNION ALL
                    SELECT 11 AS month UNION ALL SELECT 12 AS month
                ) AS months
                LEFT JOIN production_types AS pt ON pt.id IS NOT NULL) AS A
            LEFT JOIN
                (
                    SELECT * FROM plans
                    WHERE
                        institution_id = $institution_id ".
                        ($lab_id!='all'? "AND lab_id = $lab_id" : '')."
                )
                AS Plan ON Plan.production_type_id = A.production_type_id AND Plan.month = A.month
                ".($lab_id=='all'?
                "GROUP BY Plan__institution_id,
                         Plan__month, Plan__production_type_id, ProductionType__name":"")."
                ORDER BY Plan__production_type_id, Plan__month";
        $data = $this->Plan->query($query);
        $this->set('data', $data);
        $this->set('_serialize', array('data'));

    }

	function report() {
        $this->layout = null;
        $request = $this->request->data;
        // $request = ['lab_id'=>3, 'institution_id'=>1, 'month_from'=>1, 'month_to'=>12];
        $lab_id = $request['lab_id'] != null ? $request['lab_id'] : false;
        $institution_id = $request['institution_id'] != null ? $request['institution_id'] : false;
        $monthFrom = $request['month_from'] ? $request['month_from'] : 1;
        $dateFrom = date('Y-'.str_pad($monthFrom, 2, '0', STR_PAD_LEFT).'-01');
        $monthTo = $request['month_to'] ? $request['month_to'] : 1;
        $dateTo = date('Y-'.str_pad($monthTo, 2, '0', STR_PAD_LEFT).'-t');

        //map results as virtualFields for better output
        $this->Plan->ProductionType->virtualFields['name'] = '';
        $this->Plan->virtualFields['count'] = '';
        $this->Plan->virtualFields['count_prc'] = '';
        $this->Plan->virtualFields['price'] = '';
        $this->Plan->virtualFields['price_prc'] = '';
        $this->Plan->virtualFields['nds_price'] = '';
        $this->Plan->virtualFields['nds_price_prc'] = '';
        $this->LoadModel('Expertise');
        $this->Expertise->virtualFields['count'] = '';
        $this->Expertise->virtualFields['price'] = '';
        $this->Expertise->virtualFields['nds_price'] = '';

        $query = "SELECT
                    plan.name AS ProductionType__name,
                    Expertise__count,
                    ROUND(Expertise__count/Plan__count*100) AS Plan__count_prc,
                    Expertise__price,
                    ROUND(Expertise__price/Plan__price*100) AS Plan__price_prc,
                    IF(Plan__count IS NULL, 0, Plan__count) AS Plan__count,
                    IF(Plan__price IS NULL, 0, Plan__price) AS Plan__price,
                    (Expertise__price*100/118) AS Expertise__nds_price,
                    (Plan__price*100/118) AS Plan__nds_price,
                    ROUND(((Expertise__price*100/118)/(Plan__price*100/118))*100) AS Plan__nds_price_prc
                FROM
                  (SELECT ProDuctionType.name, SUM(Expertise.count) AS Expertise__count, SUM(Expertise.price) AS Expertise__price
                  FROM expertises AS Expertise JOIN registrations ON Expertise.registration_id = registrations.id
                  JOIN labs ON registrations.lab_id = labs.id
                  JOIN production_types AS ProDuctionType ON registrations.production_type_id = ProDuctionType.id
                  WHERE registrations.date BETWEEN '".$dateFrom."' AND '".$dateTo."'
                    ".($institution_id ? ' AND labs.institution_id = '.$institution_id: '')."
                    ".($lab_id ? ' AND labs.id = '.$lab_id: '')."
                  GROUP BY ProDuctionType.name) AS fact
                  RIGHT JOIN
                  (SELECT ProDuctionType.name, SUM(Plan.count) AS Plan__count, SUM(Plan.price) AS Plan__price
                  FROM plans AS Plan JOIN production_types AS ProDuctionType ON Plan.production_type_id = ProDuctionType.id
                  WHERE Plan.month >= ".$monthFrom."
                    AND Plan.month <= ".$monthTo."
                    ".($institution_id ? ' AND Plan.institution_id = '.$institution_id: '')."
                    ".($lab_id ? ' AND Plan.lab_id = '.$lab_id: '')."
                  GROUP BY ProDuctionType.name) AS plan
                  ON fact.name = plan.name";

        $data['rows'] = $this->Plan->query($query);
        $data['from'] = $dateFrom;
        $data['to'] = $dateTo;
        $institution = $institution_id ? $this->Plan->Lab->Institution->findById($institution_id) : false;
        $data['institution'] = $institution ? $institution['Institution']['name'] : 'все учреждения';
        $data['organ'] = $institution ? $this->Plan->Lab->Institution->Organ->findById($institution['Institution']['organ_id'])['Organ']['name'] : '';
        $data['lab'] = $lab_id ? $this->Plan->Lab->findById($lab_id)['Lab']['name'] : 'все ЛВСЭ';

        // $data['query'] = $query;
        $this->set('data', $data);
        $this->set('_serialize', array('data'));
	}

}
