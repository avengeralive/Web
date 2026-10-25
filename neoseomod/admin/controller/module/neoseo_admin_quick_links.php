<?php
class ControllerModuleNeoSeoAdminQuickLinks extends Controller {

	private $error = array();
	private $defaultColor = '547C96';
	private $defaultSize = 20;

	public function index() {
		$user_id = $this->user->getId();
		
		$this->language->load('module/neoseo_admin_quick_links');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('view/javascript/neoseo_admin_quick_links.js');

		$this->document->addStyle('view/javascript/jquery/icon-picker/jquery.iconpicker.css');
		$this->document->addScript('view/javascript/jquery/icon-picker/jquery.iconpicker.min.js');

		$this->document->addScript('view/javascript/jquery/pic-a-color/tinycolor-0.9.15.min.js');
		$this->document->addScript('view/javascript/jquery/pic-a-color/pick-a-color-1.2.3.min.js');
		$this->document->addStyle('view/javascript/jquery/pic-a-color/pick-a-color-1.2.3.min.css');

		$this->load->model('setting/setting');

        //restore defaults 
		if (($this->request->server['REQUEST_METHOD'] == 'GET') && isset($this->request->get['restore']) && $this->request->get['restore']==1) {
			$this->model_setting_setting->deleteSetting('neoseo_admin_quick_links_'.$user_id);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('module/neoseo_admin_quick_links', 'token=' . $this->session->data['token'], 'SSL'));
		}
        //save
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$settings = array(
				'color'=>isset($this->request->post['color'])?$this->request->post['color']:$this->defaultColor,
  				'size'=>isset($this->request->post['size'])?$this->request->post['size']:$this->defaultSize,
  				'quick_links' => array(),
			);
			if (isset($this->request->post['quick_links'])) {
				foreach ($this->request->post['quick_links'] as $key => $value) {
					$settings['quick_links'][$key]['icon']       = isset($value['icon'])?$value['icon']:'';
					$settings['quick_links'][$key]['route']      = isset($value['route'])?$value['route']:'';
					$settings['quick_links'][$key]['title']      = isset($value['title'])?$value['title']:'';
					$settings['quick_links'][$key]['color']      = isset($value['color'])?$value['color']:'';
					$settings['quick_links'][$key]['new_window'] = isset($value['new_window'])?$value['new_window']:'';
					$settings['quick_links'][$key]['sort_order'] = isset($value['sort_order'])?$value['sort_order']:'';
					if (isset($value['manual'])) {
						$settings['quick_links'][$key]['manual'] = 1;
					}
				}
			}

			$this->model_setting_setting->editSetting(
				'neoseo_admin_quick_links_' . $user_id,
				array(
					'neoseo_admin_quick_links_'.$user_id => $settings
				)
			);

			$this->session->data['success'] = $this->language->get('text_success');
			if(isset($this->request->get['apply'])) {
				$this->response->redirect($this->url->link('module/neoseo_admin_quick_links', 'token=' . $this->session->data['token'], 'SSL'));
			} else {
				$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
			}
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['module_description'] = $this->language->get('module_description');

		$data['entry_color'] = $this->language->get('entry_color');
		$data['entry_size'] = $this->language->get('entry_size');

		$data['entry_quick_links'] = $this->language->get('entry_quick_links');
		$data['entry_icon'] = $this->language->get('entry_icon');
		$data['entry_route'] = $this->language->get('entry_route');
        $data['entry_title'] = $this->language->get('entry_title');
		$data['entry_new_window'] = $this->language->get('entry_new_window');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_icons'] = $this->language->get('entry_icons');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_apply'] = $this->language->get('button_apply');
		$data['button_restore'] = $this->language->get('button_restore');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_quick_link_manual'] = $this->language->get('button_add_quick_link_manual');
		$data['button_add_quick_link'] = $this->language->get('button_add_quick_link');
		$data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['color'])) {
			$data['error_color'] = $this->error['color'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/neoseo_admin_quick_links', 'token=' . $this->session->data['token'], 'SSL'),
		);

		$data['action'] = $this->url->link('module/neoseo_admin_quick_links', 'token=' . $this->session->data['token'], 'SSL');
		$data['apply'] = $this->url->link('module/neoseo_admin_quick_links', 'apply=1&token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		$data['restore'] = $this->url->link('module/neoseo_admin_quick_links', 'restore=1&token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];

		$settings = $this->config->get('neoseo_admin_quick_links_'.$user_id);
		if (!$settings) {
			$settings = $this->config->get('neoseo_admin_quick_links');
		}

		$data['quick_links'] = array();

		if (isset($this->request->post['color'])) {
			$data['color'] = $this->request->post['color'];
		} elseif (isset($settings['color'])) {
			$data['color'] = $settings['color'];
		}else{
			$data['color'] = $this->defaultColor;
		}
		if (isset($this->request->post['size'])) {
			$data['size'] = (int)$this->request->post['size'];
		} elseif (isset($settings['size'])) {
			$data['size'] = $settings['size'];
		}else{
			$data['size'] = $this->defaultSize;
		}

		if (isset($this->request->post['quick_links'])) {
			$data['quick_links'] = $this->request->post['quick_links'];
		} elseif (isset($settings['quick_links'])) {
			$data['quick_links'] = $settings['quick_links'];
		}else{
			$data['quick_links'] = array();
		}


		$template = 'module/neoseo_admin_quick_links.tpl';
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view($template, $data));
	}

	protected function validate() {

		if (!$this->user->hasPermission('modify', 'module/neoseo_admin_quick_links')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!isset($this->request->post['color']) || !$this->validate_hex_color($this->request->post['color'])) {
			$this->error['color'] = $this->language->get('error_color');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	public function install() {
		$this->load->model('setting/setting');
		$this->config->load('neoseo_admin_quick_links');
		$settings['neoseo_admin_quick_links'] = $this->config->get('neoseo_admin_quick_links');

		$this->model_setting_setting->editSetting('neoseo_admin_quick_links', $settings);
	}

	public function uninstall() {
		$this->load->model('setting/setting');

		$this->model_setting_setting->deleteSetting('neoseo_admin_quick_links');
        $result = $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` LIKE 'neoseo_admin_quick_links%'");
	}


    private function validate_hex_color($color) {
        if (preg_match('/^[a-f0-9A-F]{6}$/i', $color)) {
            return true;
        }
        return false;
    }

}
