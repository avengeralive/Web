<?php

/**
 * @package    MVC
 *
 * Module Remart by Ali S. Veliyev
 */
class cRemart extends controller
{
	public function changepass()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if (!$this->data['status']) $this->data['body'] = 'false';
		else $this->data['body'] = 'true';
        return $this->data;
	}
	
	public function addfav()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if (!$this->data['status']) $this->data['body'] = 'false';
		else $this->data['body'] = 'true';
        return $this->data;
	}
	
	
	public function delfav()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if (!$this->data['status']) $this->data['body'] = 'false';
		else $this->data['body'] = 'true';
        return $this->data;
	}
	
	public function favorites()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['view_name'] = 'favorites'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
    
	public function dashboard()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2) $this->data['view_name'] = 'dashboard_superadmin'; 
		if ($this->data['item']->role_id == 3) $this->data['view_name'] = 'dashboard_project_manager'; 
		if ($this->data['item']->role_id == 5) $this->data['view_name'] = 'dashboard_credit_specialist'; 
		if ($this->data['item']->role_id == 6) $this->data['view_name'] = 'dashboard_realtor'; 
		if ($this->data['item']->role_id == 7) $this->data['view_name'] = 'dashboard_appraiser'; 
		if ($this->data['item']->role_id == 8) $this->data['view_name'] = 'dashboard_buyer'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function objects()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2) $this->data['view_name'] = 'dashboard_buyer'; 
		if ($this->data['item']->role_id == 3) $this->data['view_name'] = 'dashboard_buyer'; 
		if ($this->data['item']->role_id == 4) $this->data['view_name'] = 'dashboard_buyer'; 
		if ($this->data['item']->role_id == 5) $this->data['view_name'] = 'dashboard_buyer'; 
		if ($this->data['item']->role_id == 6) $this->data['view_name'] = 'dashboard_buyer'; 
		if ($this->data['item']->role_id == 7) $this->data['view_name'] = 'dashboard_buyer'; 
		if ($this->data['item']->role_id == 8) $this->data['view_name'] = 'dashboard_buyer'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function header()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2) $this->data['role'] = 'Суперадмин';
		if ($this->data['item']->role_id == 3) $this->data['role'] = 'Проектный менеджер';
		if ($this->data['item']->role_id == 5) $this->data['role'] = 'Кредитный специалист';
		if ($this->data['item']->role_id == 6) $this->data['role'] = 'Риелтор';
		if ($this->data['item']->role_id == 7) $this->data['role'] = 'Оценщик';
		if ($this->data['item']->role_id == 8) $this->data['role'] = 'Покупатель';
		if ($this->data['item']->role_id != 1) $this->data['view_name'] = 'header'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function resetPassword()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['result']) $this->data['body'] = 'true';
		else $this->data['body'] = 'false';
        return $this->data;
	}
	
	public function send_invite()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['result']) $this->data['body'] = 'true';
		else $this->data['body'] = 'false';
        return $this->data;
	}
	
	public function view()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if (($this->data['item']->role_id == 8 && $this->data['object']->status == 7) || $this->data['item']->role_id == 2 || $this->data['item']->role_id == 3 || $this->data['item']->role_id == 7 || ($this->data['item']->role_id == 6 && $this->data['object']->realtor_id == $this->data['item']->id)) $this->data['view_name'] = 'view'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}

	public function create_project_manager()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2) $this->data['view_name'] = 'create_project_manager'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function edit_project_manager()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2) $this->data['view_name'] = 'edit_project_manager'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function create_credit_specialist()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3) $this->data['view_name'] = 'create_credit_specialist'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function edit_credit_specialist()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 2) $this->data['view_name'] = 'edit_credit_specialist'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function edit_bank()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3) $this->data['view_name'] = 'edit_bank'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function create_realtor()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3) $this->data['view_name'] = 'create_realtor'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function create_buyer()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 5) $this->data['view_name'] = 'create_buyer'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function edit_buyer()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 5 || $this->data['item']->role_id == 3) $this->data['view_name'] = 'edit_buyer'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function create_bank()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 2 || $this->data['item']->role_id == 3) $this->data['view_name'] = 'create_bank'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function create_appraiser()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3) $this->data['view_name'] = 'create_appraiser'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function edit_realtor()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3) $this->data['view_name'] = 'edit_realtor'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function edit_appraiser()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 3) $this->data['view_name'] = 'edit_appraiser'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function create_object()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 6) $this->data['view_name'] = 'create_object'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function edit_object()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 6 || $this->data['item']->role_id == 3) $this->data['view_name'] = 'edit_object'; 
		$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
	}
	
	public function save_project_manager()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = $this->data['result'];
        return $this->data;
	}
	
	public function save_credit_specialist()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = $this->data['result'];
        return $this->data;
	}
	
	public function save_realtor()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = $this->data['result'];
        return $this->data;
	}
	
	public function save_appraiser()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = $this->data['result'];
        return $this->data;
	}
	
	public function save_buyer()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = $this->data['result'];
        return $this->data;
	}
	
	public function save_bank()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = $this->data['result'];
        return $this->data;
	}
	
	public function save_object()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = $this->data['result'];
        return $this->data;
	}
	
	public function get_bank()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = $this->data['result'];
        return $this->data;
	}
	
	public function get_project_managers()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_project_managers_count()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_realtors_count()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_credit_specialists_count()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_realtors()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_credit_specialists()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_appraisers()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_appraisers_count()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_buyers()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_my_buyers()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_buyers_count()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_my_buyers_count()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_banks()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_banks_count()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_objects()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_my_objects()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_val_objects()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_valuates()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function approve_value()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function decline_value()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function pending_value()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function save_object_extra()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function getInfo()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_object()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_objects_for_app()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function make_pending()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function make_reject()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function make_correct()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function make_valuation()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function make_approval()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function make_approved()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function make_sold()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function make_created()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function deactivate()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function activate()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function deactivatebank()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function activatebank()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_valuate()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function save_act()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function search()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
	}
	
	public function get_approved_objects_count()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['objects']);
        return $this->data;
	}
	
	public function get_approved_objects()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = json_encode($this->data['objects']);
        return $this->data;
	}
}