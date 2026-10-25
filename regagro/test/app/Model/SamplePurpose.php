<?php
// app/Model/SamplePurpose.php
App::uses('AppModel', 'Model');
class SamplePurpose extends AppModel {
	public $name = 'SamplePurpose';
	public $dynamicDb = false;
	public $hasMany = array('SampleSamplePurpose');
}
