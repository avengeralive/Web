<?php

require_once( DIR_SYSTEM . "/engine/neoseo_model.php");

class ModelModuleNeoseoOptimizer extends NeoseoModel {

    public function __construct($registry) {
        parent::__construct($registry);
        $this->_moduleSysName = "neoseo_optimizer";
        $this->_logFile = $this->_moduleSysName . ".log";
        $this->debug = $this->config->get($this->_moduleSysName . "_debug") == 1;
    }

    // Install/Uninstall
    public function install() {

        $this->initParamsDefaults(array(
            'status' => 0,
            'debug' => 0,
            'image_dir_list' => '/image/cache/',
            "compress_level" => 85,
			"page_to_cache" => 0,
			"cache_url_limit" => "#checkout/#\n#product/compare#\n#register/country#\n#/wishlist/#\n#/compare/#\n#/captcha#",
			"expire_cache" => 14400,
        ));
    }

    public function upgrade() {

    }

    public function uninstall() {

    }
    
    public function saveSettings($data) {
		$result = true;
		
		if ($data[$this->_moduleSysName . '_profile']) {
			$result = file_put_contents(DIR_SYSTEM . 'storage/neoseo_profiler_enabled', '1');
		} elseif (is_file(DIR_SYSTEM . 'storage/neoseo_profiler_enabled')) {
			$result = unlink(DIR_SYSTEM . 'storage/neoseo_profiler_enabled');
		}

		if ($result !== false) {
			if ($data[$this->_moduleSysName . '_minify_html']) {
				$result = file_put_contents(DIR_SYSTEM . 'storage/neoseo_html_minifier_enabled', '1');
			} elseif (is_file(DIR_SYSTEM . 'storage/neoseo_html_minifier_enabled')) {
				$result = unlink(DIR_SYSTEM . 'storage/neoseo_html_minifier_enabled');
			}
		}
		
		if ($result !== false) {
			if ($data[$this->_moduleSysName . '_minify_css']) {
				$result = file_put_contents(DIR_SYSTEM . 'storage/neoseo_css_minifier_enabled', '1');
			} elseif (is_file(DIR_SYSTEM . 'storage/neoseo_css_minifier_enabled')) {
				$result = unlink(DIR_SYSTEM . 'storage/neoseo_css_minifier_enabled');
			}
		}
		
		if ($result !== false) {
			if ($data[$this->_moduleSysName . '_minify_js']) {
				$result = file_put_contents(DIR_SYSTEM . 'storage/neoseo_js_minifier_enabled', '1');
			} elseif (is_file(DIR_SYSTEM . 'storage/neoseo_js_minifier_enabled')) {
				$result = unlink(DIR_SYSTEM . 'storage/neoseo_js_minifier_enabled');
			}
		}
		
		return $result;
    }

}
