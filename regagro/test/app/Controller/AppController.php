<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array('Session', 'Auth');
	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm')
	);
	public $userActions = array();

    public function beforeFilter() {
        $this->Auth->authorize = array('Controller');
        $this->Auth->authenticate = array(
            'all'=> array (
                'scope' => array('User.blocked' => 0, 'User.inactive' => 0)
            ),
            'Form'
        );
        $this->Auth->allow('changeLab');

        //запрет на правку архивной базы
        if (Configure::read('archive_db')) {
            $isActionProtected = in_array($this->action, array('edit', 'add', 'delete', 'autofill', 'copy'));
			if($this->Auth->user('role')!='Администратор' && $isActionProtected) {
				$this->Session->setFlash('Вы не можете добавлять, править или удалять данные в архивной базе.', 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-danger'
				), 'danger');
				$this->redirect($this->referer());
			}
		}
    }

	function beforeRender() {
		$this->set('userActions', $this->userActions);
	}
	
    public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && in_array($user['role'], array('Администратор'))) {
            return true;
        }

		$this->Session->setFlash('Недостаточно прав.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
				), 'danger');
        // Default deny
        return false;
    }

	public function changeLab()	{
		if (isset($this->request->query['lab_id'])) {
			$lab_id = $this->request->query['lab_id'];
			$user = $this->Auth->user();
			if (array_key_exists($lab_id, $user['labs'])) {
				$user['lab_id'] = $lab_id;
				$this->renewUserSession($user);
				$this->redirect($this->referer());
			}
		}
	}

    protected function BlockActionsIfDateIsLessThanToday($dateToCheck, $actions) {
		if (!$this->ActionsAvailableIfDateIsLessThanToday($dateToCheck, $actions)) {
		    $this->Session->setFlash('Вы не можете править или удалять данные за прошедшие дни.', 'alert', array(
				'plugin' => 'BoostCake',
				'class' => 'alert-danger'
				), 'danger');
				$this->redirect($this->referer());
		}
    }

    protected function ActionsAvailableIfDateIsLessThanToday($dateToCheck, $actions) {
        if (Configure::read('block_old_edit') && $dateToCheck < date('Y-m-d'))
        {
            $canEditOldData = $this->Auth->user('role') == 'Администратор';
            $canEditOldData = $canEditOldData || $this->Auth->user('role') == 'Администратор учреждения';

			//запрет на правку данных за прошедшие дни
			if (!$canEditOldData && in_array($this->action, $actions)) {
				return false;
			}
		}
		return true;
    }

    protected function LabAccessChecks($lab_id, $lab_actions, $additionalCheck = false) {
        if ($this->Auth->user('role') != 'Администратор') {
            $hasLab = $this->Auth->user('lab_id') && $this->Auth->user('lab_id')!=0;
            $isInstitutionAdmin = $this->Auth->user('role') == 'Администратор учреждения'
								  && $this->Auth->user('institution_id')
								  && $this->Auth->user('institution_id')!=0;

			//нет доступа ни к одной лаборатории
			if (!$hasLab && !$isInstitutionAdmin && !$additionalCheck) {
    			$this->Session->setFlash('Вы не можете заполнять журнал, т.к. не числитесь в лаборатории и не являетесь администратором от учреждения.',
                    'alert', array(
        				'plugin' => 'BoostCake',
        				'class' => 'alert-danger'
        			),
                    'danger'
                );
    			$this->redirect('/');
    		}

    		if(in_array($this->action, $lab_actions)) {

				//попали в несуществующую лабораторию
				if(!$lab_id) {
					$this->Session->setFlash('Несуществующая запись.', 'alert', array(
					'plugin' => 'BoostCake',
					'class' => 'alert-danger'
					), 'danger');
					$this->redirect('/');
				}

				//попали в чужую лабораторию
    			if ($this->Auth->user('lab_id') != $lab_id && !($isInstitutionAdmin && in_array($lab_id, $this->Auth->user('labs')))) {
    				$this->Session->setFlash('Вы не можете работать с чужим журналом.' , 'alert', array(
    				'plugin' => 'BoostCake',
    				'class' => 'alert-danger'
    				), 'danger');
    				$this->redirect('/');
    			} 
//    			if ($this->Auth->user('lab_id') != $lab_id && !($isInstitutionAdmin && in_array($lab_id, $this->Auth->user('labs'))))
//     			{
//     				$this->Session->setFlash('Вы не можете работать с чужим журналом. Userlabid:'.$this->Auth->user('lab_id').'; lab_id:'.$lab_id.'; isInstitutionAdmin:'.$isInstitutionAdmin.
// 						'in_array($lab_id, $this->Auth->user(labs)):'.in_array($lab_id, $this->Auth->user('labs')), 'alert', array(
//     				'plugin' => 'BoostCake',
//     				'class' => 'alert-danger'
//     				), 'danger');
//     				$this->redirect('/');
//     			}
    		}
        }
    }

	/**
 * Renews current user data, e.g. in case of an email address change while being logged in.
 *
 * @param array $newUserData
 * @return void
 */
    protected function renewUserSession($newUserData){
            if(!isset($newUserData) || empty($newUserData)) {
                    return;
            }

            // We need to fetch the current user data so custom indexes are copied
            $currentUserData = $this->Auth->user();
            if(!isset($currentUserData) || empty($currentUserData)) {
                    return;
            }

            // Merge old with new data
            $newUserData = array_merge($currentUserData, $newUserData);

            // Login with new data
            $this->Auth->login($newUserData);
    }

}
