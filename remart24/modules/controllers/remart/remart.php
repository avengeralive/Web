<?php

/**
 * @package    MVC
 *
 * Module Remart by Ali S. Veliyev
 */
class cRemart extends controller
{
    public function setPermissions($user_id, $role_id)
    {
	$permissions = array();
	$permissions['objects'] = new \stdClass;
	$permissions['project_managers'] = new \stdClass;
	$permissions['realtors'] = new \stdClass;
	$permissions['credit_specialists'] = new \stdClass;
	$permissions['realtor_companies'] = new \stdClass;
	$permissions['appraisers'] = new \stdClass;
	$permissions['buyers'] = new \stdClass;
	$permissions['bids'] = new \stdClass;
	$permissions['banks'] = new \stdClass;
	$permissions['parameters'] = new \stdClass;
	if ($role_id == 2)
	{
	    $permissions['objects']->show = true;
	    $permissions['project_managers']->show = true;
	    $permissions['realtors']->show = true;
	    $permissions['credit_specialists']->show = true;
	    $permissions['realtor_companies']->show = true;
	    $permissions['appraisers']->show = true;
	    $permissions['buyers']->show = true;
	    $permissions['bids']->show = true;
	    $permissions['banks']->show = true;
	    
	    $permissions['objects']->create = true;
	    $permissions['project_managers']->create = true;
	    $permissions['realtors']->create = true;
	    $permissions['credit_specialists']->create = true;
	    $permissions['realtor_companies']->create = true;
	    $permissions['appraisers']->create = true;
	    $permissions['buyers']->create = true;
	    $permissions['bids']->create = true;
	    $permissions['banks']->create = true;
	    
	    $permissions['parameters']->pm = '%';
	    $permissions['parameters']->credit_specialist = '%';
	    $permissions['parameters']->realtor = '%';
	}
	if ($role_id == 4)
	{
	    $permissions['objects']->show = true;
	    $permissions['project_managers']->show = false;
	    $permissions['realtors']->show = true;
	    $permissions['credit_specialists']->show = true;
	    $permissions['realtor_companies']->show = true;
	    $permissions['appraisers']->show = true;
	    $permissions['buyers']->show = true;
	    $permissions['bids']->show = true;
	    $permissions['banks']->show = true;
	    
	    $permissions['objects']->create = true;
	    $permissions['project_managers']->create = false;
	    $permissions['realtors']->create = true;
	    $permissions['credit_specialists']->create = true;
	    $permissions['realtor_companies']->create = true;
	    $permissions['appraisers']->create = true;
	    $permissions['buyers']->create = false;
	    $permissions['bids']->create = true;
	    $permissions['banks']->create = true;
	    
	    $permissions['parameters']->pm = $user_id;
	    $permissions['parameters']->credit_specialist = '%';
	    $permissions['parameters']->realtor = '%';
	}
	if ($role_id == 5)
	{
	    $permissions['objects']->show = true;
	    $permissions['project_managers']->show = false;
	    $permissions['realtors']->show = false;
	    $permissions['credit_specialists']->show = false;
	    $permissions['realtor_companies']->show = false;
	    $permissions['appraisers']->show = false;
	    $permissions['buyers']->show = false;
	    $permissions['bids']->show = true;
	    
	    $permissions['objects']->create = true;
	    $permissions['project_managers']->create = false;
	    $permissions['realtors']->create = false;
	    $permissions['credit_specialists']->create = false;
	    $permissions['realtor_companies']->create = false;
	    $permissions['appraisers']->create = false;
	    $permissions['buyers']->create = false;
	    
	    $permissions['parameters']->pm = '%';
	    $permissions['parameters']->credit_specialist = '%';
	    $permissions['parameters']->realtor = $user_id;
	}
	if ($role_id == 6)
	{
	    $permissions['objects']->show = false;
	    $permissions['project_managers']->show = false;
	    $permissions['realtors']->show = false;
	    $permissions['credit_specialists']->show = false;
	    $permissions['realtor_companies']->show = false;
	    $permissions['appraisers']->show = false;
	    $permissions['buyers']->show = true;
	    $permissions['bids']->show = false;
	    
	    $permissions['objects']->create = false;
	    $permissions['project_managers']->create = false;
	    $permissions['realtors']->create = false;
	    $permissions['credit_specialists']->create = false;
	    $permissions['realtor_companies']->create = false;
	    $permissions['appraisers']->create = false;
	    $permissions['buyers']->create = true;
	    
	    $permissions['parameters']->pm = $user_id;
	    $permissions['parameters']->credit_specialist = $user_id;
	    $permissions['parameters']->realtor = '%';
	}
	if ($role_id == 7)
	{
	    $permissions['objects']->show = true;
	    $permissions['project_managers']->show = false;
	    $permissions['realtors']->show = false;
	    $permissions['credit_specialists']->show = false;
	    $permissions['realtor_companies']->show = false;
	    $permissions['appraisers']->show = false;
	    $permissions['buyers']->show = false;
	    $permissions['bids']->show = false;
	    
	    $permissions['objects']->create = false;
	    $permissions['project_managers']->create = false;
	    $permissions['realtors']->create = false;
	    $permissions['credit_specialists']->create = false;
	    $permissions['realtor_companies']->create = false;
	    $permissions['appraisers']->create = false;
	    $permissions['buyers']->create = false;
	    
	    $permissions['parameters']->pm = $user_id;
	    $permissions['parameters']->credit_specialist = $user_id;
	    $permissions['parameters']->realtor = '%';
	}
	return $permissions;
    }
    
    public function get_users()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
    }
	
    public function user()
    {
        $this->data = Loader::gi()->getModel($this->data);
        $this->data['body'] = json_encode($this->data['result']);
        return $this->data;
    }
    
    public function save_user()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = $this->data['result'];
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
    
    public function create_realtor()
    {
	$this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4) $this->data['view_name'] = 'create_realtor'; 
	$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function create_realtor_company()
    {
	$this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4) $this->data['view_name'] = 'create_realtor_company'; 
	$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function project_manager_card()
    {
        $this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2) { $this->data['view_name'] = 'project_manager_card'; }
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function realtor_company_card()
    {
        $this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4) { $this->data['view_name'] = 'realtor_company_card'; }
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function realtor_card()
    {
        $this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4) { $this->data['view_name'] = 'realtor_card'; }
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function create_credit_specialist()
    {
	$this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4) $this->data['view_name'] = 'create_credit_specialist'; 
	$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function credit_specialist_card()
    {
        $this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4) { $this->data['view_name'] = 'credit_specialist_card'; }
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function appraiser_card()
    {
        $this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4) { $this->data['view_name'] = 'appraiser_card'; }
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function buyer_card()
    {
        $this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4 || $this->data['item']->role_id == 6) { $this->data['view_name'] = 'buyer_card'; }
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function dashboard()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['permissions'] = $this->setPermissions($this->data['item']->id, $this->data['item']->role_id);
	if ($this->data['item']->role_id == 2) $this->data['view_name'] = 'dashboard'; 
	if ($this->data['item']->role_id == 4) $this->data['view_name'] = 'dashboard'; 
	if ($this->data['item']->role_id == 5) $this->data['view_name'] = 'dashboard'; 
	if ($this->data['item']->role_id == 6) $this->data['view_name'] = 'dashboard'; 
	if ($this->data['item']->role_id == 7) $this->data['view_name'] = 'dashboard'; 
	if ($this->data['item']->role_id == 8) echo '<meta http-equiv="refresh" content="0;URL=/objects" />'; 
	$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function get_objects()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
    }
    
    public function get_favorites()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
    }
    
    public function object_card()
    {
        $this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4 || $this->data['item']->role_id == 5 || $this->data['item']->role_id == 7) { $this->data['view_name'] = 'object_card'; }
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function object()
    {
        $this->data = Loader::gi()->getModel($this->data);
        $this->data['body'] = json_encode($this->data['result']);
        return $this->data;
    }
    
    public function change_object_status()
    {
        $this->data = Loader::gi()->getModel($this->data);
        $this->data['body'] = json_encode($this->data['result']);
        return $this->data;
    }
    
    public function create_object()
    {
	$this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 5 || $this->data['item']->role_id == 4) $this->data['view_name'] = 'create_object'; 
	$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function save_object()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = $this->data['result'];
        return $this->data;
    }
    
    public function send_to_appraiser()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = $this->data['result'];
        return $this->data;
    }
    
    public function add_to_favorites()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = $this->data['result'];
        return $this->data;
    }
    
    public function view()
    {
	$this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id != 1) {
	    $ap[1] = Translations::gi()->new_build;
	    $ap[2] = Translations::gi()->old_build;
	    $type[1] = Translations::gi()->apartment.' / '.$ap[$this->data['result']['data']->ap_type];
	    $type[2] = Translations::gi()->private_home;
	    $this->data['title'] = $this->data['result']['data']->room.' '.Translations::gi()->rmn.' '.$type[$this->data['result']['data']->type];
	    if ($this->data['result']['data']->city == 6) $this->data['subtitle'] = $this->data['cities']->name.', '.$this->data['regions']->name.', '.$this->data['result']['data']->address;
	    else $this->data['subtitle'] = $this->data['cities']->name.', '.$this->data['result']['data']->address;
	    $this->data['view_name'] = 'view';
	}
	$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function getMapLoc()
    {
	$ch = curl_init();
	$url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$this->data['request']->parameters['lat'].",".$this->data['request']->parameters['lng']."&radius=1000&type=".$this->data['request']->parameters['type']."&key=AIzaSyDh7I4dBLAZ_60MHEWazSczSsVCgKX9wFc";
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$result = curl_exec($ch);  
	curl_close($ch);
	$this->data['body'] = '';
        return $this->data;
    }
    
    public function valuate_object()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = $this->data['result'];
        return $this->data;
    }
    
    public function add_to_fav()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = $this->data['result'];
        return $this->data;
    }
    
    public function saveImage()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = $this->data['id'];
        return $this->data;
    }
    
    public function getImage()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = $this->data['image'];
        return $this->data;
    }
    
    public function getImages()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = $this->data['images'];
        return $this->data;
    }
    
    public function objects_view()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['view_name'] = 'list';
	$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function create_appraiser()
    {
	$this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4) $this->data['view_name'] = 'create_appraiser'; 
	$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function create_buyer()
    {
	$this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 6) $this->data['view_name'] = 'create_buyer'; 
	$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
	
    public function favorites()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['view_name'] = 'favorites'; 
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
    
    public function create_bid()
    {
	$this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4) $this->data['view_name'] = 'create_bid'; 
	$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function save_bid()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = $this->data['result'];
        return $this->data;
    }
    
    public function bid()
    {
        $this->data = Loader::gi()->getModel($this->data);
        $this->data['body'] = json_encode($this->data['result']);
        return $this->data;
    }
    
    public function bid_card()
    {
        $this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4 || $this->data['item']->role_id == 5) { $this->data['view_name'] = 'bid_card'; }
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function get_bids()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = json_encode($this->data['result'], JSON_UNESCAPED_UNICODE);
        return $this->data;
    }
    
    public function send_to_realtor()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = $this->data['result'];
        return $this->data;
    }
    
    public function change_bid_status()
    {
        $this->data = Loader::gi()->getModel($this->data);
        $this->data['body'] = json_encode($this->data['result']);
        return $this->data;
    }
    
    public function changepass()
    {
	$this->data = Loader::gi()->getModel($this->data);
	if (!$this->data['status']) $this->data['body'] = 'false';
	else $this->data['body'] = 'true';
        return $this->data;
    }
    
    public function create_bank()
    {
	$this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4) $this->data['view_name'] = 'create_bank'; 
	$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function save_bank()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = $this->data['result'];
        return $this->data;
    }
    
    public function bank()
    {
        $this->data = Loader::gi()->getModel($this->data);
        $this->data['body'] = json_encode($this->data['result']);
        return $this->data;
    }
    
    public function bank_card()
    {
        $this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2 || $this->data['item']->role_id == 4 || $this->data['item']->role_id == 5) { $this->data['view_name'] = 'bank_card'; }
        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function get_banks()
    {
	$this->data = Loader::gi()->getModel($this->data);
	$this->data['body'] = json_encode($this->data['result']);
        return $this->data;
    }
    
    public function create_project_manager()
    {
	$this->data = Loader::gi()->getModel($this->data);
	if ($this->data['item']->role_id == 2) $this->data['view_name'] = 'create_project_manager'; 
	$this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }
    
    public function change_bank_status()
    {
        $this->data = Loader::gi()->getModel($this->data);
        $this->data['body'] = json_encode($this->data['result']);
        return $this->data;
    }
    
    public function resetPassword()
	{
		$this->data = Loader::gi()->getModel($this->data);
		if ($this->data['result']) $this->data['body'] = 'true';
		else $this->data['body'] = 'false';
        return $this->data;
	}
    
    
    
	
	
	
	/*
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
	
	
	
	public function get_bank()
	{
		$this->data = Loader::gi()->getModel($this->data);
		$this->data['body'] = $this->data['result'];
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
	}*/
}