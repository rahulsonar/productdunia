<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System extends CI_Controller {
	
	function __construct(){
	    parent::__construct();
	    $this->load->model('system_model');
	    $this->lang->load('system_user', $this->config->item('language'));
	    $this->xajax->register(XAJAX_FUNCTION, array('toggle_status', &$this, 'toggle_status'));
	    $this->xajax->register(XAJAX_FUNCTION, array('toggleProfileStatus', &$this, 'toggleProfileStatus'));
	    $this->xajax->register(XAJAX_FUNCTION, array('isUsernameAvailable', &$this, 'isUsernameAvailable'));
	    $this->xajax->register(XAJAX_FUNCTION, array('systemUserSignupSubmit', &$this, 'systemUserSignupSubmit'));
	    $this->xajax->register(XAJAX_FUNCTION, array('systemUserProfileSubmit', &$this, 'systemUserProfileSubmit'));
	    $this->xajax->register(XAJAX_FUNCTION, array('systemProfileSubmit', &$this, 'systemProfileSubmit'));
	    
	    $this->xajax->processRequest();	
	}
	
	function index()
	{
		/* Breadcrumb Start */
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		/* Breadcrumb End */
		$this->systemUsersListShow();
	}

	public function systemUsersListShow(){
		$this->access_control_model->check_access('List System Users',__CLASS__,__FUNCTION__,'functional');
		/* Breadcrumb Start */
		$this->breadcrumb->append_crumb('System users',site_url($this->config->item('controlPanel') . '/system'));
		/* Breadcrumb End */
		$systemUserslist = $this->system_model->systemUserslist();
		$data['systemUserslist'] = $systemUserslist;		
		$data['template'] = $this->config->item('controlPanel') . "/system_users_list_view";
		$data['page_title'] = 'System users';
		$temp['data'] = $data;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
	}
	
	public function systemUserSignup(){
		$this->access_control_model->check_access('Add System User',__CLASS__,__FUNCTION__,'functional');
		/* Breadcrumb Start */		
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		$this->breadcrumb->append_crumb('System users',site_url($this->config->item('controlPanel') . '/system'));
		$this->breadcrumb->append_crumb('Add user',site_url($this->config->item('controlPanel') . '/system/systemUserSignup'));
		/* Breadcrumb End */
		$data = $this->systemUserFormElement();
		$data['action'] = site_url($this->config->item('controlPanel') . '/system/systemUserSignupSubmit');
		$data['attributes'] = array('name' => 'frmsystemUserSignup', 'id' => 'frmsystemUserSignup', 'class' => 'form-horizontal');
		$data['template'] = $this->config->item('controlPanel') . "/systemUserSignup_view";
		$data['page_title'] = 'Add system user';
		$temp['data'] = $data;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
	}
	
	public function systemUserEdit($userId){
		$this->access_control_model->check_access('Edit System User',__CLASS__,__FUNCTION__,'functional');
		/* Breadcrumb Start */		
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		$this->breadcrumb->append_crumb('System users',site_url($this->config->item('controlPanel') . '/system'));
		$this->breadcrumb->append_crumb('Edit user',site_url($this->config->item('controlPanel') . '/system/systemUserEdit'));
		/* Breadcrumb End */
		$data = $this->systemUserFormElement($userId);
		$data['action'] = site_url($this->config->item('controlPanel') . '/system/systemUserSignupSubmit');
		$data['attributes'] = array('name' => 'frmsystemUserSignup', 'id' => 'frmsystemUserSignup', 'class' => 'form-horizontal');
		$data['template'] = $this->config->item('controlPanel') . "/systemUserSignup_view";
		$data['page_title'] = 'Edit system user';
		$temp['data'] = $data;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
	}
	
	public function myProfile($userId){
		$this->access_control_model->check_access('Edit My Info',__CLASS__,__FUNCTION__,'basic');
		if($this->session->userdata('sysuser_loggedin_user_id')!=$userId){
			$this->access_control_model->access_deny();
		}
		/* Breadcrumb Start */		
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		$this->breadcrumb->append_crumb('My profile',site_url($this->config->item('controlPanel') . '/system/myProfile'));
		/* Breadcrumb End */				
		$data = $this->systemUserFormElement($userId);
		$data['action'] = site_url($this->config->item('controlPanel') . '/system/systemUserSignupSubmit');
		$data['attributes'] = array('name' => 'frmsystemUserSignup', 'id' => 'frmsystemUserSignup', 'class' => 'form-horizontal');
		$data['template'] = $this->config->item('controlPanel') . "/systemUserSignup_view";
		$data['page_title'] = 'My Profile';
		$temp['data'] = $data;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
	}
	
	public function systemUserSignupSubmit($formData){
		$this->access_control_model->check_access('systemUserSignupSubmit',__CLASS__,__FUNCTION__,'basic');
		foreach($formData as $id => $field)
	    {
	        $_POST[$id] = $field;
	    }
		$objResponse = new xajaxResponse();
		if($_POST['userid']!=''){
			$response = $this->system_model->update_system_user();
		}else{
			$response = $this->system_model->insert_system_user();
		}
		if($response){
			$objResponse->redirect(site_url($this->config->item('controlPanel') . '/system'));
		}else{
			$objResponse->Assign("errorMsg","innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->lang->line('systemUserFail').'</div>');
		}
		return $objResponse;
	}
	
	public function systemUserDelete($userId){
		$this->access_control_model->check_access('Delete System User',__CLASS__,__FUNCTION__,'functional');
		$this->system_model->deleteSystemUser($userId);
		$this->systemUsersListShow();
	}
	
	public function systemUserProfile($userId){
		$this->access_control_model->check_access('Edit System User Profile',__CLASS__,__FUNCTION__,'functional');
		/* Breadcrumb Start */		
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		$this->breadcrumb->append_crumb('System users',site_url($this->config->item('controlPanel') . '/system'));
		$this->breadcrumb->append_crumb('Edit user role',site_url($this->config->item('controlPanel') . '/system/systemUserProfile'));
		/* Breadcrumb End */
		$data = $this->systemUserProfileFormElement($userId);
		$data['action'] = site_url($this->config->item('controlPanel') . '/system/systemUserProfileSubmit');
		$data['attributes'] = array('name' => 'frmsystemUserProfile', 'id' => 'frmsystemUserProfile', 'class' => 'form-horizontal');
		$data['template'] = $this->config->item('controlPanel') . "/systemUserProfile_view";
		$data['page_title'] = 'Edit system user profile';
		$temp['data'] = $data;
		//print_r($data);exit;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
	}
	
	public function systemUserProfileSubmit($formData){
		$this->access_control_model->check_access('systemUserProfileSubmit',__CLASS__,__FUNCTION__,'basic');
		foreach($formData as $id => $field)
	    {
	        $_POST[$id] = $field;
	    }
		$objResponse = new xajaxResponse();
		$response = $this->system_model->updateSystemUserProfile();		
		if($response){
			$objResponse->redirect(site_url($this->config->item('controlPanel') . '/system'));
		}else{
			$objResponse->Assign("errorMsg","innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->lang->line('operationFail').'</div>');
		}
		return $objResponse;
	}
	
	public function isUsernameAvailable($username) {
		$this->access_control_model->check_access('isUsernameAvailable',__CLASS__,__FUNCTION__,'basic');
		$objResponse = new xajaxResponse();
		$isAvailable = $this->system_model->isUsernameAvailable($username);
		if(!$isAvailable){
			$objResponse->Script("messageBox();");
			$objResponse->Assign("errorMessage","innerHTML", $this->lang->line('systemUserAlreadyInUse'));
			$objResponse->Assign("username","value", '');
			$objResponse->Script("$('#username').focus();");
		}
		//$objResponse->setReturnValue($isAvailable);		
		return $objResponse;
	}
	
	public function toggle_status($userid,$status){
		$this->access_control_model->check_access('toggle_status',__CLASS__,__FUNCTION__,'basic');
		$statusToUpdate = $this->system_model->toggle_status($userid,$status);
		$objResponse = new xajaxResponse();
		$objResponse->redirect(site_url($this->config->item('controlPanel') . '/system'));
		return $objResponse;
	}
	
	public function toggleProfileStatus($profileId,$status){
		$this->access_control_model->check_access('toggleProfileStatus',__CLASS__,__FUNCTION__,'basic');
		$objResponse = new xajaxResponse();
		if($profileId!=$this->config->item('adminProfileId')){
			$statusToUpdate = $this->system_model->toggleProfileStatus($profileId,$status);
			$objResponse->redirect(site_url($this->config->item('controlPanel') . '/system/systemProfiles'));
		}else{
			$objResponse->Assign("errorMsg","innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->lang->line('adminProfileInactive').'</div>');	
		}
		
		
		return $objResponse;
	}
	
	public function systemProfiles(){
		$this->access_control_model->check_access('List System Profiles',__CLASS__,__FUNCTION__,'functional');
		/* Breadcrumb Start */		
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		$this->breadcrumb->append_crumb('System profiles',site_url($this->config->item('controlPanel') . '/system/systemProfiles'));
		/* Breadcrumb End */
		$systemProfilelist = $this->system_model->getSystemProfiles();
		$data['systemProfilelist'] = $systemProfilelist;		
		$data['template'] = $this->config->item('controlPanel') . "/systemProfileList_view";
		$data['page_title'] = 'System Profiles';
		$temp['data'] = $data;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
	}
	
	public function systemProfileDelete($profileId){
		$this->access_control_model->check_access('Delete System Profile',__CLASS__,__FUNCTION__,'functional');
		$this->system_model->deleteSystemProfile($profileId);
		redirect(site_url($this->config->item('controlPanel') . '/system/systemProfiles'));
	}
	
	public function addSystemProfile(){
		$this->access_control_model->check_access('Add System Profile',__CLASS__,__FUNCTION__,'functional');
		/* Breadcrumb Start */		
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		$this->breadcrumb->append_crumb('System profiles',site_url($this->config->item('controlPanel') . '/system/systemProfiles'));
		$this->breadcrumb->append_crumb('Add profiles',site_url($this->config->item('controlPanel') . '/system/addSystemProfile'));
		/* Breadcrumb End */
		$data = $this->systemProfileFormElement();
		$data['action'] = site_url($this->config->item('controlPanel') . '/system/systemProfileSubmit');
		$data['attributes'] = array('name' => 'frmsystemProfile', 'id' => 'frmsystemProfile', 'class' => 'form-horizontal');
		$data['template'] = $this->config->item('controlPanel') . "/addSystemProfile_view";
		$data['page_title'] = 'Add system profile';
		$temp['data'] = $data;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
	}
	
	public function systemProfileEdit($profileId){
		$this->access_control_model->check_access('Edit System Profile',__CLASS__,__FUNCTION__,'functional');
		/* Breadcrumb Start */		
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		$this->breadcrumb->append_crumb('System profiles',site_url($this->config->item('controlPanel') . '/system/systemProfiles'));
		$this->breadcrumb->append_crumb('Edit profiles',site_url($this->config->item('controlPanel') . '/system/systemProfileEdit'));
		/* Breadcrumb End */
		$data = $this->systemProfileFormElement($profileId);
		$data['action'] = site_url($this->config->item('controlPanel') . '/system/systemProfileSubmit');
		$data['attributes'] = array('name' => 'frmsystemProfile', 'id' => 'frmsystemProfile', 'class' => 'form-horizontal');
		$data['template'] = $this->config->item('controlPanel') . "/addSystemProfile_view";
		$data['page_title'] = 'Edit system profile';
		$temp['data'] = $data;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
	}
	
	public function systemProfileSubmit($formData){
		$this->access_control_model->check_access('systemProfileSubmit',__CLASS__,__FUNCTION__,'basic');
		foreach($formData as $id => $field)
	    {
	        $_POST[$id] = $field;
	    }
	    //print_r($_POST);exit;
		$objResponse = new xajaxResponse();
		if($_POST['profileId']!=''){
			$response = $this->system_model->updateSystemProfile();
		}else{
			$response = $this->system_model->insertSystemProfile();
		}
		if($response){
			$objResponse->redirect(site_url($this->config->item('controlPanel') . '/system/systemProfiles'));
		}else{
			$objResponse->Assign("errorMsg","innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->lang->line('operationFail').'</div>');
		}
		return $objResponse;
	}
	
	/**
	 * Form Element functions.
	 * 
	 */
	
	public function systemProfileFormElement($profileId='')
	{
		$accessPermissions =  array();
		$accessPermissionsAssigned =  array();
		$systemProfile = array();
		$accessPermissions = $this->system_model->getAccessPermissions();
		if($profileId!=''){
			$systemProfile = $this->system_model->getSystemProfile($profileId);			
			$accessPermissionsAssigned = $this->system_model->getAccessPermissionsAssigned($systemProfile['profile_id']);
			$data['profileId'] = $systemProfile['profile_id'];
		}else{
			$data['profileId'] = '';
		}
		$data['profile_name'] = array(
				'name'        => 'profile_name',
				'id'          => 'profile_name',
				'value'       => (isset($systemProfile['profile_name']))?($systemProfile['profile_name']):(set_value('profile_name')),
				'maxlength'   => '100',
				'size'        => '20',
				'class'		  => 'input-xlarge focused'
            	);
        $data['sel_status']['name'] = 'status';
		$data['sel_status']['attribute'] = 'id = "status" data-rel="chosen"';
		$data['sel_status']['options'] = array(
			  'Active' => 'Active',
			  'Inactive' => 'Inactive'
			  );
		$data['sel_status']['selected_status'] = (isset($systemProfile['status']))?($systemProfile['status']):('Active');
        $data['accessPermissions'] = $accessPermissions;
        $data['accessPermissionsAssigned'] = $accessPermissionsAssigned;
        return $data;
	}
	
	public function systemUserProfileFormElement($userId='')
	{
		$systemUserProfiles =  array();
		$systemUserAssignedProfiles =  array();
		$systemUser = $this->system_model->getSystemUser($userId);
		$systemUserProfiles = $this->system_model->getSystemUserProfiles();
		$systemUserAssignedProfiles = $this->system_model->getSystemUserAssignedProfiles($systemUser['username']);
		$data['userid'] = $systemUser['id'];
		$data['username_txt'] = array(
				'name'        => 'username',
				'id'          => 'username',
				'value'       => (isset($systemUser['username']))?($systemUser['username']):(set_value('username')),
				'maxlength'   => '10',
				'size'        => '20',
				'class'		  => 'input-xlarge focused',
            	'readonly' => 'readonly'
            	);
        $data['systemUserProfiles'] = $systemUserProfiles;
        $data['systemUserAssignedProfiles'] = $systemUserAssignedProfiles;
        return $data;
	}
	
	public function systemUserFormElement($userId='')
	{
		$brachArr = $this->common_model->get_branches();
		$timezonesArr = $this->common_model->get_timezones();
		$systemUser = array();
		if($userId!=''){
			$systemUser = $this->system_model->getSystemUser($userId);
			$systemUser['password'] = $this->encrypt->decode($systemUser['password']);
			$data['userid'] = $systemUser['id'];
		}else{
			$data['userid'] = '';
		}
		//print_debug($systemUser,__FILE__,__LINE__,1);
		$data['first_name_txt'] = array(
			'name'        => 'first_name',
			'id'          => 'first_name',
			'value'       => (isset($systemUser['first_name']))?($systemUser['first_name']):(set_value('first_name')),
			'maxlength'   => '50',
			'size'        => '20',
			'class'        => 'input-xlarge focused'
            );
		$data['last_name_txt'] = array(
			'name'        => 'last_name',
			'id'          => 'last_name',
			'value'       => (isset($systemUser['last_name']))?($systemUser['last_name']):(set_value('last_name')),
			'maxlength'   => '50',
			'size'        => '20',
			'class'        => 'input-xlarge focused'
            );
		$data['email_txt'] = array(
			'name'        => 'email',
			'id'          => 'email',
			'value'       => (isset($systemUser['email']))?($systemUser['email']):(set_value('email')),
			'maxlength'   => '50',
			'size'        => '20',
			'class'        => 'input-xlarge focused'
            );
            if(isset($systemUser['id'])){
            	$data['username_txt'] = array(
				'name'        => 'username',
				'id'          => 'username',
				'value'       => (isset($systemUser['username']))?($systemUser['username']):(set_value('username')),
				'maxlength'   => '10',
				'size'        => '20',
				'class'		  => 'input-xlarge focused',
            	'readonly' => 'readonly'
            	);
            	
            }else{
            	$data['username_txt'] = array(
				'name'        => 'username',
				'id'          => 'username',
				'value'       => (isset($systemUser['username']))?($systemUser['username']):(set_value('username')),
				'maxlength'   => '10',
				'size'        => '20',
				'class'		  => 'input-xlarge focused',
            	'onBlur' => 'xajax_isUsernameAvailable(this.value)'
            	);            	
            }			
		$data['password_txt'] = array(
			'name'        => 'password',
			'id'          => 'password',
			'value'       => (isset($systemUser['password']))?($systemUser['password']):(set_value('password')),
			'maxlength'   => '10',
			'class'		  => 'input-xlarge focused',
			'size'        => '20'
			);
		$data['cnf_password_txt'] = array(
			'name'        => 'cnf_password',
			'id'          => 'cnf_password',
			'value'       => (isset($systemUser['password']))?($systemUser['password']):(set_value('cnf_password')),
			'maxlength'   => '10',
			'class'		  => 'input-xlarge focused',
			'size'        => '20'
			);

		$data['sel_branch']['name'] = 'branch';
		$data['sel_branch']['attribute'] = 'id = "branch" data-rel="chosen"';
		$data['sel_branch']['options'] = $brachArr;
		$data['sel_branch']['selected_branch'] = (isset($systemUser['branch_id']))?($systemUser['branch_id']):('');

		$data['sel_timezone']['name'] = 'timezone';
		$data['sel_timezone']['attribute'] = 'id = "timezone" data-rel="chosen"';
		$data['sel_timezone']['options'] = $timezonesArr;
		$data['sel_timezone']['selected_timezone'] = (isset($systemUser['time_zone']))?($systemUser['time_zone']):('5.5');
			
		$data['sel_status']['name'] = 'status';
		$data['sel_status']['attribute'] = 'id = "status" data-rel="chosen"';
		$data['sel_status']['options'] = array(
			  'Active' => 'Active',
			  'Inactive' => 'Inactive'
			  );
		$data['sel_status']['selected_status'] = (isset($systemUser['status']))?($systemUser['status']):('Inactive');
		$data['frm_submit'] = array(
			'name'        => 'submit',
			'id'          => 'submit',
			'value'       => 'Login'
            );
       return $data;		
	}
}
?>
