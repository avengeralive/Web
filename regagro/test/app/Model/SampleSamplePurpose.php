<?php
// app/Model/SampleSamplePurpose.php
App::uses('AppModel', 'Model');
class SampleSamplePurpose extends AppModel {
   public $useTable = 'samples_sample_purposes';
	public $name = 'SampleSamplePurpose';
	public $dynamicDb = false;
   public $belongsTo = ['Sample', 'SamplePurpose'];
}
