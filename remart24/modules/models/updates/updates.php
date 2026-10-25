<?php

/**
 * @package    MVC
 *
 * @copyright  Copyright (C) 2014  Rinat Gazikhanov, Vusal Khalilov, BITEP LLC. All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 */
class mUpdates extends model
{

	public function form()
    {
    	$table = Backstage::gi()->db_table_prefix . 'qbit_versions';
        $current_version = $this->dbmanager->tables($table)
            ->fields('*')
            ->order('id DESC')
            ->getScalar();

        return $current_version;
    }

    public function updateQbitVersion(){
        //print_r($this->data['request']->parameters);exit;
        $table = Backstage::gi()->db_table_prefix . 'qbit_versions';
        $this->data['status'] = $this->dbmanager->tables($table)->values($this->data['request']->parameters)->insert();

        return $this->data['status'];
    }

    public function alters(){
        $answer = $this->dbmanager->updateDB($this->data['request']->parameters['sql']);
        return $answer;
    }
    public function create()
    {
        //$this->dbmanager->query();

        $answer = $this->dbmanager->updateDB($this->data['sqlQuery']);
        return $answer;
    }
}