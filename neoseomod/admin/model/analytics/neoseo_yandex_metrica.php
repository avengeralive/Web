<?php

require_once(DIR_SYSTEM . 'engine/neoseo_model.php');

class ModelAnalyticsNeoSeoYandexMetrica extends NeoSeoModel
{

    public function __construct($registry) {
        parent::__construct($registry);
        $this->_moduleSysName = 'neoseo_yandex_metrica';
        $this->_logFile = $this->_moduleSysName . '.log';
        $this->debug = $this->config->get($this->_moduleSysName . '_debug') == 1;
    }

    public function install() {

		// Значения параметров по умолчанию
        $this->initParamsDefaults(array(
            'status' => 1,
            'debug' => 0,
            'code' => $this->getParamForAllStores($this->getLanguages()),
            'ecommerce' => $this->getParamForAllStores(0),
            'webvisor' => $this->getParamForAllStores(0),
        ));

        // Пермишены
        $this->load->model('user/user_group');
        $this->model_user_user_group->addPermission($this->user->getId(), 'access', $this->_route . '/' . $this->_moduleSysName);
        $this->model_user_user_group->addPermission($this->user->getId(), 'modify', $this->_route . '/' . $this->_moduleSysName);
        $this->model_user_user_group->addPermission($this->user->getId(), 'access', 'tool/' . $this->_moduleSysName);
        $this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'tool/' . $this->_moduleSysName);

        return TRUE;
    }

    public function uninstall()
    {

        return TRUE;
    }

}
