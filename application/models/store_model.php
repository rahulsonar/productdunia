<?php

class Store_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function storeUserslist($agencyId = '') {
        $this->db->where('su.status != ', 'Delete');
        $this->db->where('su.type', 'store');
        if ($agencyId != '') {
            $this->db->where('sud.agencyId', $agencyId);
        }
        $this->db->select('su.id,su.first_name,su.last_name,su.username,su.email,sud.agencyId,ag.agencyName,mb.branch_name,tz.timezone_name,su.status,su.type');
        $this->db->from('system_users as su');
        $this->db->join('store_user_detail as sud', 'sud.store_user_id = su.id', 'left');
        $this->db->join('agencies as ag', 'ag.agencyId = sud.agencyId', 'left');
        $this->db->join('master_branch as mb', 'mb.branch_id = su.branch_id');
        $this->db->join('master_timezone as tz', 'tz.timezone = su.time_zone');
        $this->db->order_by('su.create_date', 'DESC');
        $query = $this->db->get();
        $systemUserslist = $query->result();
        return $systemUserslist;
    }

    function toggle_status($userid, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
            'modify_date' => date("Y-m-d H:i:s"),
            'modify_by' => $this->session->userdata('sysuser_loggedin_user')
        );
        $this->db->where('id', $userid);
        $this->db->update('system_users', $data);
        return $statusToUpdate;
    }
    function toggle_statusBanner($id, $status) {
    	$statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
    	$data = array(
    			'status' => $statusToUpdate,
    			'modify_date' => date("Y-m-d H:i:s"),
    			'modify_by' => $this->session->userdata('sysuser_loggedin_user')
    	);
    	$this->db->where('id', $id);
    	$this->db->update('banners', $data);
    	return $statusToUpdate;
    }

    function deleteStoreUser($userid) {
        $data = array(
            'status' => 'Delete',
            'modify_date' => date("Y-m-d H:i:s"),
            'modify_by' => $this->session->userdata('sysuser_loggedin_user')
        );
        $this->db->where('id', $userid);
        $this->db->update('system_users', $data);
        return true;
    }

    public function getStoreUser($userid, $agencyId = '') {
        $table_name = "system_users as su";
        $this->db->where('su.id', $userid);
        $this->db->where('su.status != ', 'Delete');
        $this->db->where('su.type', 'store');
        if ($agencyId != '') {
            $this->db->where('sud.agencyId', $agencyId);
        }
        $this->db->select('su.id,su.first_name,su.last_name,su.username,su.password,su.email,su.branch_id,su.time_zone,su.status,su.type,sud.agencyId,ag.agencyName');
        $this->db->from('system_users as su');
        $this->db->join('store_user_detail as sud', 'sud.store_user_id = su.id');
        $this->db->join('agencies as ag', 'ag.agencyId = sud.agencyId', 'left');
        $query = $this->db->get();
        return ($query->row_array());
    }

    public function isUsernameAvailable($username) {
        $data['username'] = $username;
        $querySysemUser = $this->db->get_where('system_users', $data);
        if ($querySysemUser->num_rows > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function insert_store_user() {
        $userData['branch_id'] = $this->input->post('branch');
        $userData['username'] = $this->input->post('username');
        $userData['password'] = $this->encrypt->encode($this->input->post('password'));
        $userData['email'] = $this->input->post('email');
        $userData['time_zone'] = $this->input->post('timezone');
        $userData['status'] = $this->input->post('status');
        $userData['type'] = 'store';
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        $userData['first_name'] = $this->input->post('first_name');
        $userData['last_name'] = $this->input->post('last_name');

        if ($this->db->insert('system_users', $userData)) {
            $storeUserId = $this->db->insert_id();
            $this->insert_store_user_detail($storeUserId);
			$user_profile=array();
			$user_profile['profile_id']=2;
			$user_profile['username']=$userData['username'];
			$this->db->insert('user_profile',$user_profile);
			
            return true;
        } else {
            return false;
        }
    }

    function update_store_user() {
        $userid = $this->input->post('userid');
        $userData['branch_id'] = $this->input->post('branch');
        $userData['password'] = $this->encrypt->encode($this->input->post('password'));
        $userData['email'] = $this->input->post('email');
        $userData['time_zone'] = $this->input->post('timezone');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $userData['first_name'] = $this->input->post('first_name');
        $userData['last_name'] = $this->input->post('last_name');

        $this->db->where('id', $userid);
        $this->db->update('system_users', $userData);
        $this->update_store_user_detail($userid);
        return true;
    }

    function insert_store_user_detail($storeUserId) {
        $userData['agencyId'] = $this->input->post('agency');
        $userData['store_user_id'] = $storeUserId;
        if ($this->db->insert('store_user_detail', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function update_store_user_detail($storeUserId) {
        $userData['agencyId'] = $this->input->post('agency');
        $this->db->where('store_user_id', $storeUserId);
        $this->db->update('store_user_detail', $userData);
        return true;
    }

    function storeList($agencyId = '') {
        $this->db->where('s.status != ', 'Delete');
        if ($agencyId != '') {
            $this->db->where('s.agencyId', $agencyId);
        }
        $this->db->select('s.*,ag.agencyName,ct.cityName,ar.areaName');
        $this->db->from('stores as s');
        $this->db->join('agencies as ag', 'ag.agencyId = s.agencyId', 'left');
        $this->db->join('cities as ct', 'ct.cityId = s.cityId', 'left');
        $this->db->join('areas as ar', 'ar.areaId = s.areaId', 'left');
        $this->db->order_by('s.create_date', 'DESC');
        $query = $this->db->get();
        $systemUserslist = $query->result();
        return $systemUserslist;
    }

    public function getStore($storeId, $agencyId = '') {
        $this->db->where('s.status != ', 'Delete');
        $this->db->where('s.storeId', $storeId);
        if ($agencyId != '') {
            $this->db->where('s.agencyId', $agencyId);
        }
        $this->db->select('s.*,ag.agencyName,ct.cityName,ar.areaName');
        $this->db->from('stores as s');
        $this->db->join('agencies as ag', 'ag.agencyId = s.agencyId', 'left');
        $this->db->join('cities as ct', 'ct.cityId = s.cityId', 'left');
        $this->db->join('areas as ar', 'ar.areaId = s.areaId', 'left');
        $this->db->order_by('s.create_date', 'DESC');
        $query = $this->db->get();
        return ($query->row_array());
    }

    function insert_store($fileName,$agencyId,$storeUserId='') {
        //$userData['agencyId'] = $this->input->post('agency');
        $userData['agencyId'] = $agencyId;
        $userData['countryId'] = $this->input->post('country');
        $userData['cityId'] = $this->input->post('city');
        $userData['areaId'] = $this->input->post('area');
        $userData['storeName'] = $this->input->post('storeName');
        $userData['latitude'] = $this->input->post('latitude');
        $userData['longitude'] = $this->input->post('longitude');
        $userData['storeLogo'] = $fileName;
        $userData['address'] = $this->input->post('address');
        $userData['pincode'] = $this->input->post('pincode');
        $userData['contactPerson'] = $this->input->post('contactPerson');
        $userData['mobile'] = $this->input->post('mobile');
        $userData['phone'] = $this->input->post('phone');
        $userData['alternatPhone'] = $this->input->post('alternatPhone');        
        $userData['storeTimings'] = $this->input->post('storeTimings');
        $userData['isParking'] = $this->input->post('isParking');
        $userData['paymentMethods'] = implode(",", $this->input->post('paymentMethods'));
        $userData['storeEmail'] = $this->input->post('storeEmail');
        
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('stores', $userData)) {
			$storeId=$this->db->insert_id();
			if(!empty($storeUserId)) {
				$this->assignStoreToUserFront($storeUserId,$storeId);
			}
            return true;
        } else {
			
            return false;
        }
    }

    function update_store($fileName,$agencyId) {
        $storeId = $this->input->post('storeId');
        //$userData['agencyId'] = $this->input->post('agency');
        $userData['agencyId'] = $agencyId;
        $userData['countryId'] = $this->input->post('country');
        $userData['cityId'] = $this->input->post('city');
        $userData['areaId'] = $this->input->post('area');
        $userData['storeName'] = $this->input->post('storeName');
        $userData['latitude'] = $this->input->post('latitude');
        $userData['longitude'] = $this->input->post('longitude');
        $userData['storeLogo'] = $fileName;
        $userData['address'] = $this->input->post('address');
        $userData['pincode'] = $this->input->post('pincode');
        $userData['contactPerson'] = $this->input->post('contactPerson');
        $userData['mobile'] = $this->input->post('mobile');
        $userData['phone'] = $this->input->post('phone');
        $userData['alternatPhone'] = $this->input->post('alternatPhone');        
        $userData['storeTimings'] = $this->input->post('storeTimings');
        $userData['isParking'] = $this->input->post('isParking');
        $userData['paymentMethods'] = implode(",", $this->input->post('paymentMethods'));
        $userData['storeEmail'] = $this->input->post('storeEmail');
        
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('storeId', $storeId);
        $this->db->update('stores', $userData);
        return true;
    }
    
    function deleteStoreLogoImage($storeId, $storeLogoImg) {
        
        $file_name = $brandImg;
        $file_path = getcwd() . $this->config->item('storeLogoPath') . $file_name;
        @unlink($file_path);
        
        $data = array(
            'storeLogo' => '',
        );
        $this->db->where('storeId', $storeId);
        $this->db->update('stores', $data);
        return TRUE;
    }
    function deleteBannerImage($bannerId, $imageName) {
    
    	$file_name = $imageName;
    	$file_path = getcwd() . $this->config->item('bannerUploadPath') . $file_name;
    	@unlink($file_path);
    
    	$data = array(
    			'image' => '',
    	);
    	$this->db->where('id', $bannerId);
    	$this->db->update('banners', $data);
    	return TRUE;
    }

    function toggleStoreStatus($storeId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
            'modify_date' => date("Y-m-d H:i:s"),
            'modify_by' => $this->session->userdata('sysuser_loggedin_user')
        );
        $this->db->where('storeId', $storeId);
        $this->db->update('stores', $data);
        return $statusToUpdate;
    }

    function deleteStore($storeId) {
        $data = array(
            'status' => 'Delete',
            'modify_date' => date("Y-m-d H:i:s"),
            'modify_by' => $this->session->userdata('sysuser_loggedin_user')
        );
        $this->db->where('storeId', $storeId);
        $this->db->update('stores', $data);
        return true;
    }

    public function getStoreProfiles($agencyId) {
        $this->db->where('status != ', 'Delete');
        $this->db->where('type', 'store');

        if ($agencyId != '') {
            $this->db->where('sap.agencyId', $agencyId);
        }

        $this->db->select('sp.*,sap.agencyId,ag.agencyName');
        $this->db->join('agency_has_profile as sap', 'sap.profile_id = sp.profile_id', 'left');
        $this->db->join('agencies as ag', 'ag.agencyId = sap.agencyId', 'left');
        $this->db->from('master_profile as sp');


        $this->db->order_by('agencyId', 'DESC');
        $query = $this->db->get();
        $storeProfileslist = $query->result();
        return $storeProfileslist;
    }

    function toggleStoreProfileStatus($profileId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('profile_id', $profileId);
        $this->db->update('master_profile', $data);
        return $statusToUpdate;
    }

    function deleteStoreProfile($profileId) {
        $this->db->where('profile_id', $profileId);
        $this->db->delete('module_access_control');

        $this->db->where('profile_id', $profileId);
        $this->db->delete('agency_has_profile');

        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('profile_id', $profileId);
        $this->db->update('master_profile', $data);
        return true;
    }

    function insertStoreProfile() {
        $userData['profile_id'] = $this->input->post('profileId');
        $userData['profile_name'] = $this->input->post('profile_name');
        $userData['type'] = 'store';
        $accessPermissions = $this->input->post('accessPermissions');
        $userData['status'] = $this->input->post('status');
        if ($this->db->insert('master_profile', $userData)) {
            $profileId = $this->db->insert_id();
            for ($i = 0; $i < count($accessPermissions); $i++) {
                $userPermissionData['profile_id'] = $profileId;
                $userPermissionData['module_code'] = $accessPermissions[$i];
                $this->db->insert('module_access_control', $userPermissionData);
            }

            $userAgencyData['profile_id'] = $profileId;
            $userAgencyData['agencyId'] = $this->input->post('agency');
            $this->db->insert('agency_has_profile', $userAgencyData);

            return true;
        } else {
            return false;
        }
    }

    function updateStoreProfile() {

        $profileId = $this->input->post('profileId');
        $userData['profile_name'] = $this->input->post('profile_name');
        $userData['status'] = $this->input->post('status');
        $this->db->where('profile_id', $profileId);
        $this->db->update('master_profile', $userData);


        $accessPermissions = $this->input->post('accessPermissions');
        $this->db->where('profile_id', $profileId);
        $this->db->delete('module_access_control');
        for ($i = 0; $i < count($accessPermissions); $i++) {
            $userPermissionData['profile_id'] = $profileId;
            $userPermissionData['module_code'] = $accessPermissions[$i];
            $this->db->insert('module_access_control', $userPermissionData);
        }

        $userAgencyData['agencyId'] = $this->input->post('agency');
        $this->db->where('profile_id', $profileId);
        $this->db->update('agency_has_profile', $userAgencyData);

        return true;
    }

    public function getStoreAccessPermissions() {
        $data = array();
        $this->db->where('module_type', 'functional');
        $this->db->where('profile_id', $this->config->item('storeOwnerProfileId'));
        $this->db->select('m.*');
        $this->db->join('module_access_control as mac', 'mac.module_code = m.module_code', 'left');
        $this->db->from('master_module as m');
        $this->db->order_by('module_name', 'ASC');
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $data[$row->module_code] = $row->module_name;
        }
        return $data;
    }

    public function getStoreAccessPermissionsAssigned($profileId) {
        $data = array();
        $this->db->select('*');
        $this->db->where('profile_id', $profileId);
        $query = $this->db->get('module_access_control');
        foreach ($query->result() as $row) {
            $data[] = $row->module_code;
        }
        return $data;
    }

    public function getStoreProfile($profileId, $agencyId) {
        $this->db->where('sp.status != ', 'Delete');
        $this->db->where('sp.type', 'store');
        $this->db->where('sp.profile_id', $profileId);

        if ($agencyId != '') {
            $this->db->where('sap.agencyId', $agencyId);
        }

        $this->db->select('sp.*,sap.agencyId,ag.agencyName');
        $this->db->join('agency_has_profile as sap', 'sap.profile_id = sp.profile_id', 'left');
        $this->db->join('agencies as ag', 'ag.agencyId = sap.agencyId', 'left');
        $this->db->from('master_profile as sp');
        $this->db->order_by('agencyId', 'DESC');
        $query = $this->db->get();
        return ($query->row_array());
    }
    
    public function getStoreUserProfiles($agencyId)
    {
            $data = array();
            
            $this->db->select('*');
            $this->db->where('status != ', 'Delete');
            $this->db->where('profile_id', $this->config->item('storeOwnerProfileId'));
            $this->db->from('master_profile');
            $subQuery1 = $this->db->_compile_select();
            $this->db->_reset_select();
            
            
            $this->db->select('sp.*',false);
            $this->db->where('sp.status != ', 'Delete');
            $this->db->where('sp.type', 'store');
            $this->db->where('sap.agencyId', $agencyId);
            $this->db->join('agency_has_profile as sap', 'sap.profile_id = sp.profile_id', 'left');
            $this->db->from('master_profile as sp');
            $subQuery2 = $this->db->_compile_select();
            $query = $this->db->get();
            $isProfileExist = $query->num_rows();
            $this->db->_reset_select();
            
            if($isProfileExist){
                //$this->db->from("(($subQuery1) UNION ALL ($subQuery2)) as c");
                //$query = $this->db->get();
                
                $str = "SELECT * FROM (((SELECT * FROM master_profile WHERE status != 'Delete' AND profile_id = '".$this->config->item('storeOwnerProfileId')."') UNION ALL (SELECT sp.* FROM master_profile as sp LEFT JOIN agency_has_profile as sap ON sap.profile_id = sp.profile_id WHERE sp.status != 'Delete' AND sp.type = 'store' AND sap.agencyId = '".$agencyId."')) as c)";
                $query = $this->db->query($str);
        
            }else{
                $this->db->select('*');
                $this->db->where('status != ', 'Delete');
                $this->db->where('profile_id', $this->config->item('storeOwnerProfileId'));
                $this->db->from('master_profile');
                $query = $this->db->get();
            }

            foreach ($query->result() as $row){
                    $data[$row->profile_id] = $row->profile_name;
            }
            return $data;
    }

    public function getStoreUserAssignedProfiles($username)
    {
            $data = array();
            $this->db->select('*');
            $this->db->where('username', $username);
            $query = $this->db->get('user_profile');
            foreach ($query->result() as $row){
                    $data[] = $row->profile_id;
            }
            return $data;
    }
    
    function updateStoreUserProfile(){
		$username = $this->input->post('username');
		$userProfiles = $this->input->post('user_profile');
		$this->db->where('username', $username);
		$this->db->delete('user_profile');
		for($i=0;$i < count($userProfiles); $i++){
			$userProfileData['username'] = $username;
			$userProfileData['profile_id'] = $userProfiles[$i];
			$this->db->insert('user_profile', $userProfileData);
		}
		return true;
	}
        
    public function getStores($agencyId)
    {
            $data = array();
            $this->db->select('sp.*');
            $this->db->where('sp.status != ', 'Delete');
            $this->db->where('sp.agencyId', $agencyId);
            $this->db->from('stores as sp');
            $query = $this->db->get();
            foreach ($query->result() as $row){
                    $data[$row->storeId] = $row->storeName;
            }
            return $data;
    }
    
    public function getAssignedStores($userId)
    {
            $data = array();
            $this->db->select('*');
            $this->db->where('userId', $userId);
            $query = $this->db->get('user_has_stores');
            foreach ($query->result() as $row){
                    $data[] = $row->storeId;
            }
            return $data;
    }
    
    public function getUserStores($userId)
    {
            $data = array();
            $this->db->select('s.storeId,s.storeName');
            $this->db->join('stores as s', 's.storeId = us.storeId', 'left');        
            $this->db->where('us.userId', $userId);
            $query = $this->db->get('user_has_stores as us');
            foreach ($query->result() as $row){
                $data[$row->storeId] = $row->storeName;
            }
            return $data;
    }
    
    function updateUserAssignedStores(){
            $userId = $this->input->post('userId');
            $userStores = $this->input->post('user_stores');
            $this->db->where('userId', $userId);
            $this->db->delete('user_has_stores');
            for($i=0;$i < count($userStores); $i++){
                    $userStoreData['userId'] = $userId;
                    $userStoreData['storeId'] = $userStores[$i];
                    $this->db->insert('user_has_stores', $userStoreData);
            }
            return true;
    }
	function assignStoreToUserFront($userId, $storeId) {
		$userStoreData['userId'] = $userId;
                    $userStoreData['storeId'] = $storeId;
					
                    $this->db->insert('user_has_stores', $userStoreData);
	}
    
    public function getBannerList() {
    	$data = array();
    	$this->db->select('b.*');
    	$this->db->where('b.status != ', 'Delete');
    	$this->db->from('banners b');
    	$query = $this->db->get();
    	foreach ($query->result() as $row){
    		$data[$row->id] = $row;
    	}
    	return $data;
    }
    public function getBanner($id) {
    	$data = array();
    	$this->db->select('b.*');
    	$this->db->where('b.status != ', 'Delete');
    	$this->db->where('b.id  ', $id);
    	$this->db->from('banners b');
    	$query = $this->db->get();
    	foreach ($query->result() as $row){
    		$data = $row;
    	}
    	return $data;
    }
    
    public function chkUniquePosition($position,$bannerId=0) {
    		$sql="select * from banners where 1 AND position='".$position."' AND status='Active' ";
    		if(!empty($bannerId))
    			$sql.=" AND id!=".$bannerId;
    		
    	$query= $this->db->query($sql);
    	if ($query->num_rows() > 0) {
    		$chk=false;
    	}
    	else {
    		$chk=true;
    	}
    	return $chk;
    }
    
    public function saveBanner($filename='') {
    	
    	
    	$bannerId=$this->input->post('bannerId');
    	
    	if($filename!='')
    	$data['image']=$filename;
    
    	$data['url']=$this->input->post('url');
    	$data['position']=$this->input->post('position');
    	$data['status']='Active';
    	$data['modify_date']=date('Y-m-d H:i:s');
    	$data['modify_by']=$this->session->userdata('sysuser_loggedin_user');
    	
    	// check unique active position
    	$chk=$this->chkUniquePosition($data['position'],$bannerId);
    	if(!$chk) {
    			
    		return array('error'=>'banner_already_exists');
    	}
    	if(!empty($bannerId)) {
    			$this->db->where('id',$bannerId);
    		$this->db->update('banners',$data);
    		
    	}
    	else 
    	$this->db->insert('banners',$data);
    	
    	return array('msg'=>'Banner Added Successfully');
    }
	
	public function getAgencyIdByName($Name) {
		
		$this->db->where('agencyName',$Name);
		$this->db->from('agencies');
		$query=$this->db->get();
		$row = $query->result();
		
		if($query->num_rows==0) {
			$data=array('agencyName'=>$Name);
			$query1=$this->db->insert('agencies',$data);
			$agency_id=$this->db->insert_id();
			
		}
		else {
			$agency_id=$row[0]->agencyId;
		}
		return $agency_id;
		
	}

}

?>