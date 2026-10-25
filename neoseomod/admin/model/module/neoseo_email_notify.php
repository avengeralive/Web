<?php
require_once( DIR_SYSTEM . "/engine/neoseo_model.php");

class ModelModuleNeoSeoEmailNotify extends NeoSeoModel {

	public $defaultTemplates = array();

	public function __construct($registry) {
		parent::__construct($registry);
		$this->_moduleSysName = "neoseo_email_notify";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get( $this->_moduleSysName . "_debug");

		$this->defaultTemplates = array(
			1 => array(
				0 => array(
					"status" => 1,
					"subject" => "У вас новый заказ №{order_id}",
					"filename" => "new_admin",
				),
				1 => array(
					"status" => 1,
					"subject" => "We've get your order #{order_id}",
					"filename" => "new_en",
				),
				2 => array(
					"status" => 1,
					"subject" => "Мы получили ваш заказ №{order_id}",
					"filename" => "new_ru",
				),
				3 => array(
					"status" => 1,
					"subject" => "Ми отримали ваш заказ №{order_id}",
					"filename" => "new_uk",
				),
			),
			2 => array(
				0 => array(
					"status" => 0,
					"subject" => "Заказ №{order_id} отправлен в обработку",
					"filename" => "process_admin",
				),
				1 => array(
					"status" => 1,
					"subject" => "We've process your order #{order_id}",
					"filename" => "process_en",
				),
				2 => array(
					"status" => 1,
					"subject" => "Мы обрабатываем ваш заказ №{order_id}",
					"filename" => "process_ru",
				),
				3 => array(
					"status" => 1,
					"subject" => "Ми обрабатываем ваш заказ №{order_id}",
					"filename" => "process_uk",
				),
			),
			3 => array(
				0 => array(
					"status" => 0,
					"subject" => "Заказ №{order_id} отправлен новой почтой",
					"filename" => "novaposhta_admin",
				),
				1 => array(
					"status" => 1,
					"subject" => "We've sent your order #{order_id} via Nova Poshta",
					"filename" => "novaposhta_en",
				),
				2 => array(
					"status" => 1,
					"subject" => "Мы отправили ваш заказ №{order_id} Новой Почтой",
					"filename" => "novaposhta_ru",
				),
				3 => array(
					"status" => 1,
					"subject" => "Ми вiдправили ваш заказ №{order_id} Новою Поштою",
					"filename" => "novaposhta_uk",
				),
			),
			4 => array(
				0 => array(
					"status" => 0,
					"subject" => "Заказ №{order_id} отправлен укр почтой",
					"filename" => "ukrposhta_admin",
				),
				1 => array(
					"status" => 1,
					"subject" => "We've sent your order #{order_id} via UkrPoshta",
					"filename" => "ukrposhta_en",
				),
				2 => array(
					"status" => 1,
					"subject" => "Мы отправили ваш заказ №{order_id} УкрПочтой",
					"filename" => "ukrposhta_ru",
				),
				3 => array(
					"status" => 1,
					"subject" => "Ми вiдправили ваш заказ №{order_id} УкрПоштою",
					"filename" => "ukrposhta_uk",
				),
			),
			5 => array(
				0 => array(
					"status" => 0,
					"subject" => "Заказ №{order_id} отправлен курьером",
					"filename" => "courier_admin",
				),
				1 => array(
					"status" => 1,
					"subject" => "We've sent your order #{order_id} via currier",
					"filename" => "courier_en",
				),
				2 => array(
					"status" => 1,
					"subject" => "Мы отправили ваш заказ №{order_id} курьером",
					"filename" => "courier_ru",
				),
				3 => array(
					"status" => 1,
					"subject" => "Ми вiдправили ваш заказ №{order_id} курьером",
					"filename" => "courier_uk",
				),
			),
			6 => array(
				0 => array(
					"status" => 0,
					"subject" => "Заказ №{order_id} готов к самовывозу",
					"filename" => "pickup_admin",
				),
				1 => array(
					"status" => 1,
					"subject" => "We've prepared your order #{order_id} for pickuo",
					"filename" => "pickup_en",
				),
				2 => array(
					"status" => 1,
					"subject" => "Ваш заказ №{order_id} ожидает самовывоза",
					"filename" => "pickup_ru",
				),
				3 => array(
					"status" => 1,
					"subject" => "Ваш заказ №{order_id} очiкуе самовивiзу",
					"filename" => "pickup_uk",
				),
			),
			7 => array(
				0 => array(
					"status" => 0,
					"subject" => "Заказ №{order_id} завершен",
					"filename" => "complete_admin",
				),
				1 => array(
					"status" => 1,
					"subject" => "We've complete your order #{order_id}",
					"filename" => "complete_en",
				),
				2 => array(
					"status" => 1,
					"subject" => "Ваш заказ №{order_id} завершен",
					"filename" => "complete_ru",
				),
				3 => array(
					"status" => 1,
					"subject" => "Ваш заказ №{order_id} виконаний",
					"filename" => "complete_uk",
				),
			),
		);

	}

	public function install() {
		//Работает только в ocStore, да еще и не меньше 2.1, а потому не годится
		//$this->load->model('extension/event');
		//$this->model_extension_event->addEvent($this->_moduleSysName, 'pre.order.history.add', 'module/' . $this->_moduleSysName . '/handler_order_history_add');

		$this->initParamsDefaults(array(
			"status" => 1,
			"templates" => $this->defaultTemplates
		));
	}

	public function uninstall() {
		//Работает только в ocStore, да еще и не меньше 2.1, а потому не годится
		//$this->load->model('extension/event');
		//$this->model_extension_event->deleteEvent($this->_moduleSysName);
	}

	public function upgrade() {
		return true;
	}
}
