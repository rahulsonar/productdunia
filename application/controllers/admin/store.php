<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Store extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('store_model');
        $this->xajax->register(XAJAX_FUNCTION, array('toggle_status', &$this, 'toggle_status'));
        $this->xajax->register(XAJAX_FUNCTION, array('toggleStoreStatus', &$this, 'toggleStoreStatus'));
        $this->xajax->register(XAJAX_FUNCTION, array('toggleStoreProfileStatus', &$this, 'toggleStoreProfileStatus'));
        
        $this->xajax->register(XAJAX_FUNCTION, array('isUsernameAvailable', &$this, 'isUsernameAvailable'));
        $this->xajax->register(XAJAX_FUNCTION, array('storeUserSignupSubmit', &$this, 'storeUserSignupSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('storeSubmit', &$this, 'storeSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('storeProfileSubmit', &$this, 'storeProfileSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('storeUserProfileSubmit', &$this, 'storeUserProfileSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('assignStoresSubmit', &$this, 'assignStoresSubmit'));
        
        $this->xajax->register(XAJAX_FUNCTION, array('deleteStoreLogoImage', &$this, 'deleteStoreLogoImage'));
        
        $this->xajax->register(XAJAX_FUNCTION, array('getAreaBy', &$this, 'getAreaBy'));
        $this->xajax->register(XAJAX_FUNCTION, array('getCityBy', &$this, 'getCityBy'));
        
        
        $this->xajax->processRequest();
    }
    
    function index() {
        $this->storeUsersListShow();
    }

    /* Store User Start */
    public function storeUsersListShow() {
        $this->access_control_model->check_access('List Store Users', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Store users', site_url($this->config->item('controlPanel') . '/store'));
        /* Breadcrumb End */
        $agencyId = $this->session->userdata('storeAgencyId');
        $storeUserslist = $this->store_model->storeUserslist($agencyId);
        $data['storeUserslist'] = $storeUserslist;
        $data['template'] = $this->config->item('controlPanel') . "/storeUsersList_view";
        $data['page_title'] = 'Store users';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function storeUserSignup() {
        $this->access_control_model->check_access('Add Store User', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Store users', site_url($this->config->item('controlPanel') . '/store'));
        $this->breadcrumb->append_crumb('Add user', site_url($this->config->item('controlPanel') . '/store/storeUserSignup'));
        /* Breadcrumb End */
        $data = $this->storeUserFormElement();
        $data['action'] = site_url($this->config->item('controlPanel') . '/store/storeUserSignupSubmit');
        $data['attributes'] = array('name' => 'frmstoreUserSignup', 'id' => 'frmstoreUserSignup', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/storeUserSignup_view";
        $data['page_title'] = 'Add store user';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function storeUserEdit($userId) {
        $this->access_control_model->check_access('Edit Store User', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Store users', site_url($this->config->item('controlPanel') . '/store'));
        $this->breadcrumb->append_crumb('Edit user', site_url($this->config->item('controlPanel') . '/store/storeUserEdit'));
        /* Breadcrumb End */

        $data = $this->storeUserFormElement($userId);
        $data['action'] = site_url($this->config->item('controlPanel') . '/store/storeUserSignupSubmit');
        $data['attributes'] = array('name' => 'frmstoreUserSignup', 'id' => 'frmstoreUserSignup', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/storeUserSignup_view";
        $data['page_title'] = 'Edit store user';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function storeUserSignupSubmit($formData) {
        $this->access_control_model->check_access('storeUserSignupSubmit', __CLASS__, __FUNCTION__, 'basic');
        foreach ($formData as $id => $field) {
            $_POST[$id] = $field;
        }
        //print_debug($_POST, __FILE__, __LINE__, 1);
        $objResponse = new xajaxResponse();
        if ($_POST['userid'] != '') {
            $response = $this->store_model->update_store_user();
        } else {
            $response = $this->store_model->insert_store_user();
        }
        if ($response) {
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('storeUserSuccess') . '</div>');
            $objResponse->redirect(site_url($this->config->item('controlPanel') . '/store'));
        } else {
            $objResponse->Assign("errorMsg", "innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
        }
        return $objResponse;
    }

    public function toggle_status($userid, $status) {
        $this->access_control_model->check_access('toggle_status', __CLASS__, __FUNCTION__, 'basic');
        $statusToUpdate = $this->store_model->toggle_status($userid, $status);
        $statusMsg = ($status == 'Active') ? ($this->lang->line('storeUserInactivated')) : ($this->lang->line('storeUserActivated'));
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $statusMsg . '</div>');
        $objResponse = new xajaxResponse();
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/store'));
        return $objResponse;
    }

    public function storeUserDelete($userId) {
        $this->access_control_model->check_access('Store User Delete ', __CLASS__, __FUNCTION__, 'functional');
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('storeUserDeleted') . '</div>');
        $this->store_model->deleteStoreUser($userId);
        redirect(site_url($this->config->item('controlPanel') . '/store'));
    }

    public function isUsernameAvailable($username) {
        $this->access_control_model->check_access('isUsernameAvailable', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $isAvailable = $this->store_model->isUsernameAvailable($username);
        if (!$isAvailable) {
            $objResponse->Script("messageBox();");
            $objResponse->Assign("errorMessage", "innerHTML", $this->lang->line('errMsg_UsernameAlreadyInUse'));
            $objResponse->Assign("username", "value", '');
            $objResponse->Script("$('#username').focus();");
        }
        return $objResponse;
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
            $data = $this->storeUserFormElement($userId);
            $data['action'] = site_url($this->config->item('controlPanel') . '/store/storeUserSignupSubmit');
            $data['attributes'] = array('name' => 'frmstoreUserSignup', 'id' => 'frmstoreUserSignup', 'class' => 'form-horizontal');
            $data['template'] = $this->config->item('controlPanel') . "/storeUserSignup_view";
            
            $data['page_title'] = 'My Profile';
            $temp['data'] = $data;
            $this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
    }    
    /* Store User End */
    
    /* Store Start */
    public function storeListShow() {
        $this->access_control_model->check_access('List Stores', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Stores', site_url($this->config->item('controlPanel') . '/store'));
        /* Breadcrumb End */
        $agencyId = $this->session->userdata('storeAgencyId');
        $storesList = $this->store_model->storeList($agencyId);
        $data['storesList'] = $storesList;
        $data['template'] = $this->config->item('controlPanel') . "/storeList_view";
        $data['page_title'] = 'Stores';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }
    
    public function addStore() {
        $this->access_control_model->check_access('Add Store', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Stores', site_url($this->config->item('controlPanel') . '/store/storeListShow'));
        $this->breadcrumb->append_crumb('Add store', site_url($this->config->item('controlPanel') . '/store/addStore'));
        /* Breadcrumb End */
        $data = $this->storeFormElement();
        $data['action'] = site_url($this->config->item('controlPanel') . '/store/storeSubmit');
        $data['attributes'] = array('name' => 'frmStore', 'id' => 'frmStore', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addStore_view";
        $data['page_title'] = 'Add store';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }
    
    public function storeEdit($storeId) {
        $this->access_control_model->check_access('Edit Store', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Stores', site_url($this->config->item('controlPanel') . '/store/storeListShow'));
        $this->breadcrumb->append_crumb('Edit store', site_url($this->config->item('controlPanel') . '/store/storeEdit'));
        /* Breadcrumb End */
        $data = $this->storeFormElement($storeId);
        $data['action'] = site_url($this->config->item('controlPanel') . '/store/storeSubmit');
        $data['attributes'] = array('name' => 'frmStore', 'id' => 'frmStore', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addStore_view";
        $data['page_title'] = 'Edit store';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }
    
    public function deleteStoreLogoImage($storeId, $storeLogoImg) {
        $this->access_control_model->check_access('deleteStoreLogoImage', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $statusToUpdate = $this->store_model->deleteStoreLogoImage($storeId, $storeLogoImg);
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/store/storeEdit/' . $storeId));
        return $objResponse;
    }
    
    function _uploadStoreLogo() {
        $this->load->helper('string');
        $config['upload_path'] = $this->config->item('storeLogoPath');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '49';
        $config['max_height'] = '49';
        $config['file_name'] = random_string('unique');
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('storeLogo')) {
            $uploadStatus = array('error' => $this->upload->display_errors());
        } else {
            $uploadStatus = array('upload_data' => $this->upload->data());
        }
        return $uploadStatus;
    }
    
    public function storeSubmit($formData) {
        $this->access_control_model->check_access('storeSubmit', __CLASS__, __FUNCTION__, 'basic');
        foreach ($formData as $id => $field) {
            $_POST[$id] = $field;
        }
        //print_debug($_POST, __FILE__, __LINE__, 1);
        //$objResponse = new xajaxResponse();
        
        if($_FILES['storeLogo']['name']!=""){
            $uploadStatus = $this->_uploadStoreLogo();
            if (isset($uploadStatus['error'])) {
                $error = $uploadStatus['error'];
                $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $error . '</div>');
                redirect(site_url($this->config->item('controlPanel') . '/store/storeListShow'));
            }
            $fileName = $uploadStatus['upload_data']['file_name'];
        }else{
            $fileName = $this->input->post('storeLogoImg');
        }
        
        
        if ($_POST['storeId'] != '') {
            $response = $this->store_model->update_store($fileName);
        } else {
            $response = $this->store_model->insert_store($fileName);
        }
        if ($response) {
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('storeSuccess') . '</div>');
            //$objResponse->redirect(site_url($this->config->item('controlPanel') . '/store/storeListShow'));
            redirect(site_url($this->config->item('controlPanel') . '/store/storeListShow'));
        } else {
            //$objResponse->Assign("errorMsg", "innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
            redirect(site_url($this->config->item('controlPanel') . '/store/storeListShow'));
        }
        //return $objResponse;
    }
    
    public function toggleStoreStatus($storeId, $status) {
        $this->access_control_model->check_access('toggleStoreStatus', __CLASS__, __FUNCTION__, 'basic');
        $statusToUpdate = $this->store_model->toggleStoreStatus($storeId, $status);
        $statusMsg = ($status == 'Active') ? ($this->lang->line('storeInactivated')) : ($this->lang->line('storeActivated'));
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $statusMsg . '</div>');
        $objResponse = new xajaxResponse();
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/store/storeListShow'));
        return $objResponse;
    }
    
    public function storeDelete($storeId) {
        $this->access_control_model->check_access('Store Delete ', __CLASS__, __FUNCTION__, 'functional');
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('storeDeleted') . '</div>');
        $this->store_model->deleteStore($storeId);
        redirect(site_url($this->config->item('controlPanel') . '/store/storeListShow'));
    }


    
    public function getAreaBy($target,$targetId,$extraOption) {
        $this->access_control_model->check_access('getAreaBy', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $areaArr = $this->common_model->getAreaBy($target,$targetId,$extraOption);
        
        $sel_area['name'] = 'area';
        $sel_area['attribute'] = 'id = "area" data-rel="chosen"';
        $sel_area['options'] = $areaArr;
        $sel_area['selected_area'] = (isset($store['areaId'])) ? ($store['areaId']) : ('');
        
        $areaSelect = form_dropdown($sel_area['name'],$sel_area['options'],$sel_area['selected_area'],$sel_area['attribute']);
        $objResponse->Assign("areaHolder", "innerHTML", $areaSelect);
        $objResponse->Script("$('#area').chosen();");
        return $objResponse;
    }
    
    public function getCityBy($target,$targetId,$extraOption) {
        $this->access_control_model->check_access('getCityBy', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $cityArr = $this->common_model->getCityBy($target,$targetId,$extraOption);
        
        $sel_city['name'] = 'city';
        $sel_city['attribute'] = 'id = "city" data-rel="chosen" onChange="xajax_getAreaBy(\'cityId\',this.value,1)"';
        $sel_city['options'] = $cityArr;
        $sel_city['selected_city'] = (isset($store['cityId'])) ? ($store['cityId']) : ('');
        
        $areaSelect = form_dropdown($sel_city['name'],$sel_city['options'],$sel_city['selected_city'],$sel_city['attribute']);
        $objResponse->Script("$.uniform.update();");
        $objResponse->Assign("cityHolder", "innerHTML", $areaSelect);
        $objResponse->Script("$('#city').chosen();");
        return $objResponse;
    }
    /* Store End */
    
    /* Store Profile Start */
    public function storeProfiles(){
            $this->access_control_model->check_access('List Store Profiles',__CLASS__,__FUNCTION__,'functional');
            /* Breadcrumb Start */		
            $this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
            $this->breadcrumb->append_crumb('Store profiles',site_url($this->config->item('controlPanel') . '/store/storeProfiles'));
            /* Breadcrumb End */
            $agencyId = $this->session->userdata('storeAgencyId');
            $storeProfilelist = $this->store_model->getStoreProfiles($agencyId);
            $data['storeProfilelist'] = $storeProfilelist;		
            $data['template'] = $this->config->item('controlPanel') . "/storeProfileList_view";
            $data['page_title'] = 'Store Profiles';
            $temp['data'] = $data;
            $this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
    }
    
    public function addStoreProfile(){
            $this->access_control_model->check_access('Add Store Profile',__CLASS__,__FUNCTION__,'functional');
            /* Breadcrumb Start */		
            $this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
            $this->breadcrumb->append_crumb('Store profiles',site_url($this->config->item('controlPanel') . '/store/storeProfiles'));
            $this->breadcrumb->append_crumb('Add profiles',site_url($this->config->item('controlPanel') . '/store/addStoreProfile'));
            /* Breadcrumb End */
            $data = $this->storeProfileFormElement();
            $data['action'] = site_url($this->config->item('controlPanel') . '/store/storeProfileSubmit');
            $data['attributes'] = array('name' => 'frmstoreProfile', 'id' => 'frmstoreProfile', 'class' => 'form-horizontal');
            $data['template'] = $this->config->item('controlPanel') . "/addStoreProfile_view";
            $data['page_title'] = 'Add store profile';
            $temp['data'] = $data;
            $this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
    }
    
    public function storeProfileEdit($profileId){
            $this->access_control_model->check_access('Edit Store Profile',__CLASS__,__FUNCTION__,'functional');
            /* Breadcrumb Start */		
            $this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
            $this->breadcrumb->append_crumb('Store profiles',site_url($this->config->item('controlPanel') . '/store/storeProfiles'));
            $this->breadcrumb->append_crumb('Edit profiles',site_url($this->config->item('controlPanel') . '/store/storeProfileEdit/'.$profileId));
            /* Breadcrumb End */
            $data = $this->storeProfileFormElement($profileId);
            $data['action'] = site_url($this->config->item('controlPanel') . '/store/storeProfileSubmit');
            $data['attributes'] = array('name' => 'frmstoreProfile', 'id' => 'frmstoreProfile', 'class' => 'form-horizontal');
            $data['template'] = $this->config->item('controlPanel') . "/addStoreProfile_view";
            $data['page_title'] = 'Edit store profile';
            $temp['data'] = $data;
            $this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
    }
    
    public function storeProfileSubmit($formData){
		$this->access_control_model->check_access('storeProfileSubmit',__CLASS__,__FUNCTION__,'basic');
		foreach($formData as $id => $field)
                {
                    $_POST[$id] = $field;
                }
                //print_debug($_POST,__FILE__,__LINE__,1);exit;
		$objResponse = new xajaxResponse();
		if($_POST['profileId']!=''){
			$response = $this->store_model->updateStoreProfile();
		}else{
			$response = $this->store_model->insertStoreProfile();
		}
		if($response){
                        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('storeProfileSuccess') . '</div>');
			$objResponse->redirect(site_url($this->config->item('controlPanel') . '/store/storeProfiles'));
		}else{
			$objResponse->Assign("errorMsg","innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->lang->line('operationFail').'</div>');
		}
		return $objResponse;
	}
    
    public function toggleStoreProfileStatus($profileId, $status) {
            $this->access_control_model->check_access('toggleStoreProfileStatus',__CLASS__,__FUNCTION__,'basic');
            $objResponse = new xajaxResponse();
            if((($profileId==$this->config->item('adminProfileId'))) OR (($profileId==$this->config->item('storeOwnerProfileId')))){
                $objResponse->Assign("errorMsg","innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->lang->line('adminProfileInactive').'</div>');				
            }else{
                $statusMsg = ($status == 'Active') ? ($this->lang->line('storeProfileInactivated')) : ($this->lang->line('storeProfileActivated'));
                $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $statusMsg . '</div>');
                $statusToUpdate = $this->store_model->toggleStoreProfileStatus($profileId,$status);
                $objResponse->redirect(site_url($this->config->item('controlPanel') . '/store/storeProfiles'));
            }
            return $objResponse;
    }
    
    public function storeProfileDelete($profileId) {
        $this->access_control_model->check_access('Store Profile Delete ', __CLASS__, __FUNCTION__, 'functional');
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('storeProfileDeleted') . '</div>');
        $this->store_model->deleteStoreProfile($profileId);
        redirect(site_url($this->config->item('controlPanel') . '/store/storeProfiles'));
    }
    
    public function storeUserProfile($userId){
		$this->access_control_model->check_access('Edit Store User Profile',__CLASS__,__FUNCTION__,'functional');
		/* Breadcrumb Start */		
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		$this->breadcrumb->append_crumb('Store users',site_url($this->config->item('controlPanel') . '/store'));
		$this->breadcrumb->append_crumb('Edit user role',site_url($this->config->item('controlPanel') . '/store/storeUserProfile'));
		/* Breadcrumb End */
		$data = $this->storeUserProfileFormElement($userId);
		$data['action'] = site_url($this->config->item('controlPanel') . '/store/storeUserProfileSubmit');
		$data['attributes'] = array('name' => 'frmstoreUserProfile', 'id' => 'frmstoreUserProfile', 'class' => 'form-horizontal');
		$data['template'] = $this->config->item('controlPanel') . "/storeUserProfile_view";
		$data['page_title'] = 'Edit store user profile';
		$temp['data'] = $data;
		//print_r($data);exit;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
	}
        
        public function storeUserProfileSubmit($formData){
		$this->access_control_model->check_access('storeUserProfileSubmit',__CLASS__,__FUNCTION__,'basic');
		foreach($formData as $id => $field)
                {
                    $_POST[$id] = $field;
                }
		$objResponse = new xajaxResponse();
		$response = $this->store_model->updateStoreUserProfile();		
		if($response){
                        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationSuccess') . '</div>');
			$objResponse->redirect(site_url($this->config->item('controlPanel') . '/store/storeUsersListShow'));
		}else{
			$objResponse->Assign("errorMsg","innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->lang->line('operationFail').'</div>');
		}
		return $objResponse;
	}
        
        public function assignStores($userId){
		$this->access_control_model->check_access('Assign Stores to store user',__CLASS__,__FUNCTION__,'functional');
		/* Breadcrumb Start */		
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		$this->breadcrumb->append_crumb('Store users',site_url($this->config->item('controlPanel') . '/store'));
		$this->breadcrumb->append_crumb('Edit store assignment',site_url($this->config->item('controlPanel') . '/store/assignStores'));
		/* Breadcrumb End */
		$data = $this->assignStoresFormElement($userId);
		$data['action'] = site_url($this->config->item('controlPanel') . '/store/assignStoresSubmit');
		$data['attributes'] = array('name' => 'frmAssignStores', 'id' => 'frmAssignStores', 'class' => 'form-horizontal');
		$data['template'] = $this->config->item('controlPanel') . "/assignStores_view";
		$data['page_title'] = 'Edit store assignment';
		$temp['data'] = $data;
		//print_r($data);exit;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
	}
        
        public function assignStoresSubmit($formData){
                $response = false;
		$this->access_control_model->check_access('assignStoresSubmit',__CLASS__,__FUNCTION__,'basic');
		foreach($formData as $id => $field)
                {
                    $_POST[$id] = $field;
                }
                
                $objResponse = new xajaxResponse();
                if ($_POST['userId'] != '') {
                    $response = $this->store_model->updateUserAssignedStores();
                }
				
		if($response){
                        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationSuccess') . '</div>');
			$objResponse->redirect(site_url($this->config->item('controlPanel') . '/store/storeUsersListShow'));
		}else{
			$objResponse->Assign("errorMsg","innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->lang->line('operationFail').'</div>');
		}
		return $objResponse;
	}

    /* Store Profile End */

    /* Form Element Start */

    public function storeUserFormElement($userId = '') {
        $this->access_control_model->check_access('storeUserFormElement', __CLASS__, __FUNCTION__, 'basic');
        $brachArr = $this->common_model->get_branches();
        $timezonesArr = $this->common_model->get_timezones();
        $agencyArr = $this->common_model->get_agencies(1);

        $storeUser = array();
        if ($userId != '') {
            $agencyId = $this->session->userdata('storeAgencyId');
            $storeUser = $this->store_model->getStoreUser($userId,$agencyId);
            if(count($storeUser) == 0){
              redirect($this->config->item('controlPanel') . '/access_deny'); 
            }
            $storeUser['password'] = $this->encrypt->decode($storeUser['password']);
            $data['userid'] = $storeUser['id'];
        } else {
            $data['userid'] = '';
        }
        $data['first_name_txt'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'value' => (isset($storeUser['first_name'])) ? ($storeUser['first_name']) : (set_value('first_name')),
            'maxlength' => '50',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        $data['last_name_txt'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'value' => (isset($storeUser['last_name'])) ? ($storeUser['last_name']) : (set_value('last_name')),
            'maxlength' => '50',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        $data['email_txt'] = array(
            'name' => 'email',
            'id' => 'email',
            'value' => (isset($storeUser['email'])) ? ($storeUser['email']) : (set_value('email')),
            'maxlength' => '50',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        if (isset($storeUser['id'])) {
            $data['username_txt'] = array(
                'name' => 'username',
                'id' => 'username',
                'value' => (isset($storeUser['username'])) ? ($storeUser['username']) : (set_value('username')),
                'maxlength' => '10',
                'size' => '20',
                'class' => 'input-xlarge focused',
                'readonly' => 'readonly'
            );
        } else {
            $data['username_txt'] = array(
                'name' => 'username',
                'id' => 'username',
                'value' => (isset($storeUser['username'])) ? ($storeUser['username']) : (set_value('username')),
                'maxlength' => '10',
                'size' => '20',
                'class' => 'input-xlarge focused',
                'onBlur' => 'xajax_isUsernameAvailable(this.value)'
            );
        }
        $data['password_txt'] = array(
            'name' => 'password',
            'id' => 'password',
            'value' => (isset($storeUser['password'])) ? ($storeUser['password']) : (set_value('password')),
            'maxlength' => '10',
            'class' => 'input-xlarge focused',
            'size' => '20'
        );
        $data['cnf_password_txt'] = array(
            'name' => 'cnf_password',
            'id' => 'cnf_password',
            'value' => (isset($storeUser['password'])) ? ($storeUser['password']) : (set_value('cnf_password')),
            'maxlength' => '10',
            'class' => 'input-xlarge focused',
            'size' => '20'
        );

        $data['sel_branch']['name'] = 'branch';
        $data['sel_branch']['attribute'] = 'id = "branch" data-rel="chosen"';
        $data['sel_branch']['options'] = $brachArr;
        $data['sel_branch']['selected_branch'] = (isset($storeUser['branch_id'])) ? ($storeUser['branch_id']) : ('');
        
        if($this->session->userdata('sysuser_type')=='system'){
            $data['agencyName'] = (isset($storeUser['agency_name'])) ? ($storeUser['agency_name']) : (set_value('agencyName'));
            
            $data['sel_agency']['name'] = 'agency';
            $data['sel_agency']['attribute'] = 'id = "agency" data-rel="chosen"  onChange="callChangeAgency();"';
            $data['sel_agency']['options'] = $agencyArr;
            $data['sel_agency']['selected_agency'] = (isset($storeUser['agencyId'])) ? ($storeUser['agencyId']) : ('');
        }else{
            $storeAgencyId = $this->session->userdata('storeAgencyId');
            $storeAgencyName = $this->session->userdata('storeAgencyName');
            
            $data['agency'] = array(
                'name' => 'agency',
                'id' => 'agency',
                'value' => (isset($storeUser['agencyId'])) ? ($storeUser['agencyId']) : ((isset($storeAgencyId))?($storeAgencyId):(set_value('agency'))),
                'maxlength' => '50',
                'size' => '20',
                'class' => 'input-xlarge focused',
                'readonly' => 'readonly'
            );
            
            $data['agencyName'] = array(
                'name' => 'agencyName',
                'id' => 'agencyName',
                'value' => (isset($storeUser['agency_name'])) ? ($storeUser['agency_name']) : ((isset($storeAgencyName))?($storeAgencyName):(set_value('agencyName'))),
                'maxlength' => '50',
                'size' => '20',
                'class' => 'input-xlarge focused',
                'readonly' => 'readonly'
            );
        }

        $data['sel_timezone']['name'] = 'timezone';
        $data['sel_timezone']['attribute'] = 'id = "timezone" data-rel="chosen"';
        $data['sel_timezone']['options'] = $timezonesArr;
        $data['sel_timezone']['selected_timezone'] = (isset($storeUser['time_zone'])) ? ($storeUser['time_zone']) : ('5.5');

        $data['sel_status']['name'] = 'status';
        $data['sel_status']['attribute'] = 'id = "status" data-rel="chosen"';
        $data['sel_status']['options'] = array(
            'Active' => 'Active',
            'Inactive' => 'Inactive'
        );
        $data['sel_status']['selected_status'] = (isset($storeUser['status'])) ? ($storeUser['status']) : ('Inactive');
        $data['frm_submit'] = array(
            'name' => 'submit',
            'id' => 'submit',
            'value' => 'Login'
        );
        return $data;
    }
    
    
    public function storeFormElement($storeId = '') {
        $this->access_control_model->check_access('storeFormElement', __CLASS__, __FUNCTION__, 'basic');
        $store = array();
        $data['paymentMethods'] = array();
        if ($storeId != '') {
            $agencyId = $this->session->userdata('storeAgencyId');
            $store = $this->store_model->getStore($storeId,$agencyId);
            if(count($store) == 0){
              redirect($this->config->item('controlPanel') . '/access_deny'); 
            }
            $data['storeId'] = $store['storeId'];
            $data['storeLogoImg'] = $store['storeLogo'];
            if($store['paymentMethods']!=''){
                $data['paymentMethods'] = explode(",", $store['paymentMethods']);
            }
        } else {
            $data['storeId'] = '';
            $data['storeLogoImg'] = '';
        }
        
        $countryId = (isset($store['countryId']))?($store['countryId']):('');
        $cityId = (isset($store['cityId']))?($store['cityId']):('');
        $agencyArr = $this->common_model->get_agencies(1);
        $countryArr = $this->common_model->getCountries(1);
        $cityArr = $this->common_model->getCityBy('countryId',$countryId,1);
        $areaArr = $this->common_model->getAreaBy('cityId',$cityId,1);
        $data['storeName'] = array(
            'name' => 'storeName',
            'id' => 'storeName',
            'value' => (isset($store['storeName'])) ? ($store['storeName']) : (set_value('storeName')),
            'maxlength' => '200',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        $data['latitude'] = array(
            'name' => 'latitude',
            'id' => 'latitude',
            'value' => (isset($store['latitude'])) ? ($store['latitude']) : (set_value('latitude')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['longitude'] = array(
            'name' => 'longitude',
            'id' => 'longitude',
            'value' => (isset($store['longitude'])) ? ($store['longitude']) : (set_value('longitude')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['address'] = array(
            'name' => 'address',
            'id' => 'address',
            'value' => (isset($store['address'])) ? ($store['address']) : (set_value('address')),
            'size' => '20',
            'class' => 'input-xlarge focused',
            'style' => 'height:75px;'
        );
        
        $data['pincode'] = array(
            'name' => 'pincode',
            'id' => 'pincode',
            'value' => (isset($store['pincode'])) ? ($store['pincode']) : (set_value('pincode')),
            'maxlength' => '6',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['contactPerson'] = array(
            'name' => 'contactPerson',
            'id' => 'contactPerson',
            'value' => (isset($store['contactPerson'])) ? ($store['contactPerson']) : (set_value('contactPerson')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['mobile'] = array(
            'name' => 'mobile',
            'id' => 'mobile',
            'value' => (isset($store['mobile'])) ? ($store['mobile']) : (set_value('mobile')),
            'maxlength' => '10',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'value' => (isset($store['phone'])) ? ($store['phone']) : (set_value('phone')),
            'maxlength' => '15',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['alternatPhone'] = array(
            'name' => 'alternatPhone',
            'id' => 'alternatPhone',
            'value' => (isset($store['alternatPhone'])) ? ($store['alternatPhone']) : (set_value('alternatPhone')),
            'maxlength' => '15',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['storeTimings'] = array(
            'name' => 'storeTimings',
            'id' => 'storeTimings',
            'value' => (isset($store['storeTimings'])) ? ($store['storeTimings']) : (set_value('storeTimings')),
            'size' => '20',
            'class' => 'input-xlarge focused',
            'style' => 'height:75px;'
        );
        
        $data['storeEmail'] = array(
            'name' => 'storeEmail',
            'id' => 'storeEmail',
            'value' => (isset($store['storeEmail'])) ? ($store['storeEmail']) : (set_value('storeEmail')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['storeLogo'] = array(
            'name' => 'storeLogo',
            'id' => 'storeLogo',
            'value' => (isset($store['storeLogo'])) ? ($store['storeLogo']) : (set_value('storeLogo')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-file uniform_on focused'
        );
        
        $data['sel_country']['name'] = 'country';
        $data['sel_country']['attribute'] = 'id = "country" data-rel="chosen" onChange="xajax_getCityBy(\'countryId\',this.value,1)"';
        $data['sel_country']['options'] = $countryArr;
        $data['sel_country']['selected_country'] = (isset($store['countryId'])) ? ($store['countryId']) : ('');
        
        $data['sel_city']['name'] = 'city';
        $data['sel_city']['attribute'] = 'id = "city" data-rel="chosen" onChange="xajax_getAreaBy(\'cityId\',this.value,1)"';
        $data['sel_city']['options'] = $cityArr;
        $data['sel_city']['selected_city'] = (isset($store['cityId'])) ? ($store['cityId']) : ('');
        
        $data['sel_area']['name'] = 'area';
        $data['sel_area']['attribute'] = 'id = "area" data-rel="chosen"';
        $data['sel_area']['options'] = $areaArr;
        $data['sel_area']['selected_area'] = (isset($store['areaId'])) ? ($store['areaId']) : ('');
        
        if($this->session->userdata('sysuser_type')=='system'){
            $data['agencyName'] = (isset($store['agency_name'])) ? ($store['agency_name']) : (set_value('agencyName'));
            
            $data['sel_agency']['name'] = 'agency';
            $data['sel_agency']['attribute'] = 'id = "agency" data-rel="chosen"  onChange="callChangeAgency();"';
            $data['sel_agency']['options'] = $agencyArr;
            $data['sel_agency']['selected_agency'] = (isset($store['agencyId'])) ? ($store['agencyId']) : ('');
        }else{
            $storeAgencyId = $this->session->userdata('storeAgencyId');
            $storeAgencyName = $this->session->userdata('storeAgencyName');
            
            $data['agency'] = array(
                'name' => 'agency',
                'id' => 'agency',
                'value' => (isset($store['agencyId'])) ? ($store['agencyId']) : ((isset($storeAgencyId))?($storeAgencyId):(set_value('agency'))),
                'maxlength' => '50',
                'size' => '20',
                'class' => 'input-xlarge focused',
                'readonly' => 'readonly'
            );
            
            $data['agencyName'] = array(
                'name' => 'agencyName',
                'id' => 'agencyName',
                'value' => (isset($store['agency_name'])) ? ($store['agency_name']) : ((isset($storeAgencyName))?($storeAgencyName):(set_value('agencyName'))),
                'maxlength' => '50',
                'size' => '20',
                'class' => 'input-xlarge focused',
                'readonly' => 'readonly'
            );
        }
        
        $data['sel_isParking']['name'] = 'isParking';
        $data['sel_isParking']['attribute'] = 'id = "isParking" data-rel="chosen"';
        $data['sel_isParking']['options'] = array(
            '1' => 'Yes',
            '0' => 'No'
        );
        $data['sel_isParking']['selected_isParking'] = (isset($store['isParking'])) ? ($store['isParking']) : ('0');

        $data['sel_status']['name'] = 'status';
        $data['sel_status']['attribute'] = 'id = "status" data-rel="chosen"';
        $data['sel_status']['options'] = array(
            'Active' => 'Active',
            'Inactive' => 'Inactive'
        );
        $data['sel_status']['selected_status'] = (isset($store['status'])) ? ($store['status']) : ('Inactive');
        $data['frm_submit'] = array(
            'name' => 'submit',
            'id' => 'submit',
            'value' => 'Login'
        );
        return $data;
    }
    
    public function storeProfileFormElement($profileId='')
	{
		$accessPermissions =  array();
		$accessPermissionsAssigned =  array();
		$storeProfile = array();
		$accessPermissions = $this->store_model->getStoreAccessPermissions();
		if($profileId!=''){
                        $agencyId = $this->session->userdata('storeAgencyId');
			$storeProfile = $this->store_model->getStoreProfile($profileId,$agencyId);
			$accessPermissionsAssigned = $this->store_model->getStoreAccessPermissionsAssigned($storeProfile['profile_id']);
			$data['profileId'] = $storeProfile['profile_id'];
		}else{
			$data['profileId'] = '';
		}
                $agencyArr = $this->common_model->get_agencies(1);
		$data['profile_name'] = array(
				'name'        => 'profile_name',
				'id'          => 'profile_name',
				'value'       => (isset($storeProfile['profile_name']))?($storeProfile['profile_name']):(set_value('profile_name')),
				'maxlength'   => '100',
				'size'        => '20',
				'class'		  => 'input-xlarge focused'
            	);
                if($this->session->userdata('sysuser_type')=='system'){
                    $data['agencyName'] = (isset($storeProfile['agencyName'])) ? ($storeProfile['agencyName']) : (set_value('agencyName'));

                    $data['sel_agency']['name'] = 'agency';
                    $data['sel_agency']['attribute'] = 'id = "agency" data-rel="chosen"';
                    $data['sel_agency']['options'] = $agencyArr;
                    $data['sel_agency']['selected_agency'] = (isset($storeProfile['agencyId'])) ? ($storeProfile['agencyId']) : ('');
                }else{
                    $storeAgencyId = $this->session->userdata('storeAgencyId');
                    $storeAgencyName = $this->session->userdata('storeAgencyName');

                    $data['agency'] = array(
                        'name' => 'agency',
                        'id' => 'agency',
                        'value' => (isset($store['agencyId'])) ? ($storeProfile['agencyId']) : ((isset($storeAgencyId))?($storeAgencyId):(set_value('agency'))),
                        'maxlength' => '50',
                        'size' => '20',
                        'class' => 'input-xlarge focused',
                        'readonly' => 'readonly'
                    );

                    $data['agencyName'] = array(
                        'name' => 'agencyName',
                        'id' => 'agencyName',
                        'value' => (isset($store['agency_name'])) ? ($store['agency_name']) : ((isset($storeAgencyName))?($storeAgencyName):(set_value('agencyName'))),
                        'maxlength' => '50',
                        'size' => '20',
                        'class' => 'input-xlarge focused',
                        'readonly' => 'readonly'
                    );
                }
                $data['sel_status']['name'] = 'status';
		$data['sel_status']['attribute'] = 'id = "status" data-rel="chosen"';
		$data['sel_status']['options'] = array(
			  'Active' => 'Active',
			  'Inactive' => 'Inactive'
			  );
		$data['sel_status']['selected_status'] = (isset($storeProfile['status']))?($storeProfile['status']):('Active');
                $data['accessPermissions'] = $accessPermissions;
                $data['accessPermissionsAssigned'] = $accessPermissionsAssigned;
                return $data;
	}
        
        public function storeUserProfileFormElement($userId='')
	{
		$storeUserProfiles =  array();
		$storeUserAssignedProfiles =  array();
		$storeUser = $this->store_model->getStoreUser($userId);
		$storeUserProfiles = $this->store_model->getStoreUserProfiles($storeUser['agencyId']);
                //print_debug($storeUserProfiles, __FILE__, __LINE__, 0);
		$storeUserAssignedProfiles = $this->store_model->getStoreUserAssignedProfiles($storeUser['username']);
                
                
		$data['userid'] = $storeUser['id'];
		$data['username_txt'] = array(
				'name'        => 'username',
				'id'          => 'username',
				'value'       => (isset($storeUser['username']))?($storeUser['username']):(set_value('username')),
				'maxlength'   => '10',
				'size'        => '20',
				'class'       => 'input-xlarge focused',
                                'readonly'    => 'readonly'
            	);
                $data['storeUserProfiles'] = $storeUserProfiles;
                $data['storeUserAssignedProfiles'] = $storeUserAssignedProfiles;
                //print_debug($data, __FILE__, __LINE__, 1);
                return $data;
	}
        
        public function assignStoresFormElement($userId='')
	{
		$stores =  array();
		$storeUserAssignedProfiles =  array();
		$storeUser = $this->store_model->getStoreUser($userId);
		$stores = $this->store_model->getStores($storeUser['agencyId']);
		$storeAssigned = $this->store_model->getAssignedStores($storeUser['id']);
                //print_debug($storeAssigned, __FILE__, __LINE__, 0);

                $data['userId'] = $storeUser['id'];
		$data['username_txt'] = array(
				'name'        => 'username',
				'id'          => 'username',
				'value'       => (isset($storeUser['username']))?($storeUser['username']):(set_value('username')),
				'maxlength'   => '10',
				'size'        => '20',
				'class'       => 'input-xlarge focused',
                                'readonly'    => 'readonly'
            	);
                $data['stores'] = $stores;
                $data['storeAssigned'] = $storeAssigned;
                return $data;
	}

    /* Form Element End */
}

?>
