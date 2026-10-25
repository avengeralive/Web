<?php

class UsersController extends AppController {

	public $components = array('RequestHandler', 'Paginator');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Js',
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny('*');
	}

	public function beforeRender() {
		if ($this->Auth->user('role') === 'Администратор') {
			$this->userActions[] = array('title'=>'Все пользователи','url'=>Router::url(array('action'=>'index')));
			$this->userActions[] = array('title'=>'Добавить пользователя','url'=>Router::url(array('action'=>'add')));
		}
		parent::beforeRender();
	}

	public function isAuthorized($user) {
		if ($user['blocked'] == 1) {
			$this->setFlash('Ваш логин заблокирован администратором системы.','alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				), 'danger');
			$this->redirect($this->Auth->logout());
			return false;
		}

		if (in_array($this->action, array('logout'))) {
			return true;
		}

		if (!isset($user['role']) || !in_array($user['role'], array('Администратор'))) {
			if (in_array($this->action, array('add', 'edit', 'delete', 'index'))) {
				$this->Session->setFlash('Недостаточно прав.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				), 'danger');
				return false;
			}
		}

// 		if (in_array($this->action, array('edit'))) {
// 			if ($user['id'] != $this->request->params['pass'][0]) {
// 				return false;
// 			}
// 		}

		return parent::isAuthorized($user);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('Пользователь добавлен.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
				$this->redirect(array('action' => 'index'));
			}
		}
		$regions = $this->User->Region->find('list');
		$this->set(compact('regions'));

		/*$labs = $this->User->Lab->find('list');
		$this->set(compact('labs'));
		$institutions = $this->User->Institution->find('list');
		$this->set(compact('institutions'));
		$organs = $this->User->Organ->find('list');
		$this->set(compact('organs'));*/
	}

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException("Несуществующий пользователь");
		}

		$user = $this->User->findById($id);
		if (!$user) {
			throw new NotFoundException("Несуществующий пользователь");
		}

		if (!$this->request->data) {
			$this->request->data = $user;
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->User->id = $id;
			if ($this->request->data['User']['changepass'] == false) {
				unset($this->request->data['User']['password']); //пароль не меняем
			}
		 if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('Пользователь изменен.', 'alert', array(
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

		$regions = $this->User->Region->find('list');
		$this->set(compact('regions'));
		$districts = $this->User->District->find('list', array(
			'conditions' => array('District.region_id' => $this->request->data['User']['region_id']),
			'recursive' => -1
		));
		$this->set(compact('districts'));

		$labs = $this->User->Lab->find('list');
		$this->set(compact('labs'));
		$institutions = $this->User->Institution->find('list');
		$this->set(compact('institutions'));
		$organs = $this->User->Organ->find('list');
		$this->set(compact('organs'));
	}

	public function index() {
		$conditions = array();
		//if ($this->request->is('post')) {
			//var_dump($this->request->data['User']);
		if (isset($this->request->data['User'])) {
			$conditions = array("User.displayname LIKE '%".$this->request->data['User']['displayname']."%'");
			if (isset($this->request->data['User']['lab_id']) && $this->request->data['User']['lab_id'] != 0) $conditions['User.lab_id'] = $this->request->data['User']['lab_id'];
			else if (isset($this->request->data['User']['institution_id']) && $this->request->data['User']['institution_id'] != 0) $conditions['User.institution_id'] = $this->request->data['User']['institution_id'];
			else if (isset($this->request->data['User']['organ_id']) && $this->request->data['User']['organ_id'] != 0) $conditions['User.organ_id'] = $this->request->data['User']['organ_id'];
			if (isset($this->request->data['User']['district_id']) && $this->request->data['User']['district_id'] != 0) $conditions['User.district_id'] = $this->request->data['User']['district_id'];
			if (isset($this->request->data['User']['region_id']) && $this->request->data['User']['region_id'] != 0) $conditions['User.region_id'] = $this->request->data['User']['region_id'];
			if (isset($this->request->data['User']['job']) && $this->request->data['User']['job'] != "") $conditions['User.job'] = $this->request->data['User']['job'];
			if (isset($this->request->data['User']['role']) && $this->request->data['User']['role'] != "") $conditions['User.role'] = $this->request->data['User']['role'];

			//$conditions = array("User.displayname LIKE '%".$this->request->data['User']['displayname']."%'");
		}
		//var_dump($conditions);
		$this->Paginator->settings = array(
			'limit' => 30,
			'conditions' => $conditions,
			'order' => array('User.displayname'=>'asc')
		);
		$users = $this->Paginator->paginate('User');
		$this->set('users', $users);

		$regions = $this->User->Region->find('list');
		$this->set(compact('regions'));
		if (isset($this->request->data['User']['region_id'])) {
			$districts = $this->User->District->find('list', array(
				'conditions' => array('District.region_id' => $this->request->data['User']['region_id']),
				'recursive' => -1
			));
			$this->set(compact('districts'));
			$organs = $this->User->Organ->find('list', array(
				'conditions' => array('Organ.region_id' => $this->request->data['User']['region_id']),
				'recursive' => -1
			));
			$this->set(compact('organs'));
		}
		if (isset($this->request->data['User']['organ_id'])) {
			$institutions = $this->User->Institution->find('list', array(
				'conditions' => array('Institution.organ_id' => $this->request->data['User']['organ_id']),
				'recursive' => -1
			));
			$this->set(compact('institutions'));
		}
		if (isset($this->request->data['User']['institution_id'])) {
			$labs = $this->User->Lab->find('list', array(
				'conditions' => array('Lab.institution_id' => $this->request->data['User']['institution_id']),
				'recursive' => -1
			));
			$this->set(compact('labs'));
		}
	}

	public function delete($id) {
		if ($this->User->delete($id)) {
			$this->Session->setFlash('Пользователь '.$id.' удален', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-success'
				), 'success');
			return $this->redirect(array('action' => 'index'));
		}
	}
	
// 	public function edit_profile() {
// 		if ($this->request->is('get')) {
// 			$this->request->data = $this->User->findById($this->Auth->user('id'));
// 		} else {
// 			if ($this->User->save($this->request->data)) {
// 				$this->Session->setFlash('Данные профиля обновлены');
// 			}
// 		}
// 	}
	//$this->Session->write('Auth.User.username') = $this->request->data['User']['username']; - обновит имя пользователя в том же сеансе.
	
	public function login() {
		if ($this->request->is('post')) {
			$user = $this->User->findByUsername($this->request->data['User']['username']);
			if ($this->Auth->login()) {
				$this->Session->write('Auth.User.labs', $this->User->GetUserLabs($user));
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				if ($user && $user['User']['blocked']) {
					$this->Session->setFlash('Вы не авторизовались<br /><span>Ваш логин заблокирован администратором системы</span>','alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					), 'danger');
				} else {
					$this->Session->setFlash('Вы не авторизовались<br /><span>имя пользователя или пароль указаны неверно</span>','alert', array(
						'plugin' => 'BoostCake',
						'class' => 'alert-danger'
					), 'danger');
				}
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	public function getByRegion() {
		$region_id = $this->request->data['User']['region_id'];
		
		$districts = $this->User->District->find('list', array(
			'conditions' => array('District.region_id' => $region_id),
			'recursive' => -1
		));
		$this->set('districts', $districts);
		$this->layout = 'ajax';
	}


	public function getOrganByRegion() {
		$region_id = $this->request->data['User']['region_id'];
		
		$organs = $this->User->Organ->find('list', array(
			'conditions' => array('Organ.region_id' => $region_id),
			'recursive' => -1
		));
		$this->set('organs', $organs);
		$this->layout = 'ajax';
	}

	public function getByOrgan() {
		$organ_id = $this->request->data['User']['organ_id'];
		
		$institutions = $this->User->Institution->find('list', array(
			'conditions' => array('Institution.organ_id' => $organ_id),
			'recursive' => -1
		));
		$this->set('institutions', $institutions);
		$this->layout = 'ajax';
	}
	public function getByInstitution() {
		$institution_id = $this->request->data['User']['institution_id'];
		
		$labs = $this->User->Lab->find('list', array(
			'conditions' => array('Lab.institution_id' => $institution_id),
			'recursive' => -1
		));
		$this->set('labs', $labs);
		$this->layout = 'ajax';
	}
}
?>
