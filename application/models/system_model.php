<?php
class System_model extends CI_Model {
	function __construct()
    {
        parent::__construct();
        $this->load->library('encrypt');
    }
 	
    function loginSystemUser($loginData)
    {
    	$data['username'] = $loginData['username'];
		$data['status'] = 'Active';
		$query = $this->db->get_where('system_users', $data);
		if ($query->num_rows != 1) {
			return FALSE;
		} else {
			$row = $query->row();
			if($loginData['password'] != $this->encrypt->decode($row->password)){
				return FALSE;
			}
			unset($data);
			$data['username'] = $row->username;
			
			$this->db->select('group_concat(profile_id) as profileIds');
			$query_profile = $this->db->get_where('user_profile', $data);
			$profile_row = $query_profile->row();

			$session_data['sysuser_loggedin_user_id'] = $row->id;
			$session_data['sysuser_loggedin_user'] = $row->username;
			$session_data['sysuser_loggedin_first_name'] = $row->first_name;			
			$session_data['sysuser_loggedin_last_name'] = $row->last_name;
			$session_data['sysuser_loggedin_email'] = $row->email;
			$session_data['sysuser_loggedin_user_profiles'] = $profile_row->profileIds;
			$session_data['sysuser_home_branch_id'] = $row->branch_id;
			$session_data['sysuser_time_zone'] = $row->time_zone;
			$session_data['sysuser_last_login'] = $row->last_login;
			$session_data['sysuser_user_ip'] = $this->input->ip_address();
                        $session_data['sysuser_type'] = $row->type;
                        
                        if($row->type=='store'){
                            $storeUserDetail = $this->getStoreUserDetail($row->id);
                            $session_data['storeUserId'] = $storeUserDetail['store_user_id'];
                            $session_data['storeAgencyId'] = $storeUserDetail['agencyId'];
                            $session_data['storeAgencyName'] = $storeUserDetail['agencyName'];
                        }else{
                            $session_data['storeUserId'] = '';
                            $session_data['storeAgencyId'] = '';
                            $session_data['storeAgencyName'] = '';
                        }

			$this->session->set_userdata($session_data);
			$log_action = 'Login';
			$this->system_log_model->system_user_login_log_insert($log_action);
			$this->set_last_login();
			return TRUE;
		}

    }
    
	function logoutSystemUser(){
		 $log_action = 'Logout';
		 $this->system_log_model->system_user_login_log_insert($log_action);
		 $this->session->sess_destroy();
		 return TRUE;
	}
	
	function set_last_login(){
		$last_login_data = array(
		   'last_login' => date("Y-m-d H:i:s")
		);
		$this->db->where('username', $this->session->userdata('sysuser_loggedin_user'));
		$this->db->update('system_users', $last_login_data);
	}
	
	function systemUserslist()
	{
		$this->db->where('su.status != ', 'Delete');
                $this->db->where('su.type', 'system');
		$this->db->select('su.id,su.first_name,su.last_name,su.username,su.email,mb.branch_name,tz.timezone_name,su.status');
		$this->db->from('system_users as su');
		$this->db->join('master_branch as mb', 'mb.branch_id = su.branch_id');
		$this->db->join('master_timezone as tz', 'tz.timezone = su.time_zone');
		$this->db->order_by('su.create_date','DESC');
		$query = $this->db->get();
		$systemUserslist = $query->result();
		return $systemUserslist;
	}
	
	public function getSystemUser($userid)
	{
		$table_name = "system_users as su";
		$this->db->where('su.id', $userid);
		$this->db->where('su.status != ', 'Delete');
		$this->db->select('su.id,su.first_name,su.last_name,su.username,su.password,su.email,su.branch_id,su.time_zone,su.status')->from($table_name);
		$query = $this->db->get();
		return ($query->row_array());
	}
	
	public function getSystemProfile($profileId)
	{
		$table_name = "master_profile";
		$this->db->where('profile_id', $profileId);
		$this->db->where('status != ', 'Delete');
		$this->db->select('profile_id,profile_name,status')->from($table_name);
		$query = $this->db->get();
		return ($query->row_array());
	}
	
	public function getAccessPermissions()
	{
		$data = array();
		$this->db->select('*');
		$this->db->where('module_type', 'functional');
		$this->db->order_by('module_name','ASC');
		$query = $this->db->get('master_module');
		foreach ($query->result() as $row){
			$data[$row->module_code] = $row->module_name;
		}
		return $data;
	}
	
	public function getAccessPermissionsAssigned($profileId)
	{
		$data = array();
		$this->db->select('*');
		$this->db->where('profile_id', $profileId);
		$query = $this->db->get('module_access_control');
		foreach ($query->result() as $row){
			$data[] = $row->module_code;
		}
		return $data;
	}
	
	public function getSystemProfiles()
	{
		$data = array();
		$this->db->select('*');
		$this->db->where('status != ', 'Delete');
                $this->db->where('type', 'System');
		$this->db->order_by('profile_id','DESC');
		$query = $this->db->get('master_profile');
		$systemProfileslist = $query->result();
		return $systemProfileslist;
	}
	
	public function getSystemUserProfiles()
	{
		$data = array();
		$this->db->select('*');
		$this->db->where('status != ', 'Delete');
		$query = $this->db->get('master_profile');
		foreach ($query->result() as $row){
			$data[$row->profile_id] = $row->profile_name;
		}
		return $data;
	}
	
	public function getSystemUserAssignedProfiles($username)
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
	
	function insert_system_user()
    {
		$userData['branch_id'] = $this->input->post('branch');
		$userData['username'] = $this->input->post('username');
		$userData['password'] = $this->encrypt->encode($this->input->post('password'));
		$userData['email'] = $this->input->post('email');
		$userData['time_zone'] = $this->input->post('timezone');

		$userData['status'] = $this->input->post('status');
		$userData['create_date'] = date("Y-m-d H:i:s");
		$userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
		$userData['first_name'] = $this->input->post('first_name');
		$userData['last_name'] = $this->input->post('last_name');

		if($this->db->insert('system_users', $userData))
		{
			return true;		
		}else{
			return false;
		}
    }
    
	function update_system_user()
    {
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
		return true;
    }
    
	function deleteSystemUser($userid)
    {
		 $data = array(
				'status' => 'Delete',
				'modify_date' => date("Y-m-d H:i:s"),
				'modify_by' => $this->session->userdata('sysuser_loggedin_user')
		);
		$this->db->where('id', $userid);
		$this->db->update('system_users', $data);
		return true;
    }
    
	function deleteSystemProfile($profileId)
    {
		$this->db->where('profile_id', $profileId);
		$this->db->delete('module_access_control');		
                
                $data = array(
				'status' => 'Delete',
		);
		$this->db->where('profile_id', $profileId);
		$this->db->update('master_profile', $data);
		return true;
    }
    
	function updateSystemUserProfile(){
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

	function toggle_status($userid,$status)
    {
    	 $statusToUpdate = ($status=='Active')?('Inactive'):('Active');
		 $data = array(
				'status' => $statusToUpdate,
				'modify_date' => date("Y-m-d H:i:s"),
				'modify_by' => $this->session->userdata('sysuser_loggedin_user')
		);
		$this->db->where('id', $userid);
		$this->db->update('system_users', $data);
		return $statusToUpdate;
    }
    
	function toggleProfileStatus($profileId,$status)
    {
    	 $statusToUpdate = ($status=='Active')?('Inactive'):('Active');
		 $data = array(
				'status' => $statusToUpdate,
		);
		$this->db->where('profile_id', $profileId);
		$this->db->update('master_profile', $data);
		return $statusToUpdate;
    }
	
    public function isUsernameAvailable($username)
	{
		$data['username'] = $username;
		$querySysemUser = $this->db->get_where('system_users', $data);
		if ($querySysemUser->num_rows > 0) {
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	function insertSystemProfile()
    {
		$userData['profile_id'] = $this->input->post('profileId');
		$userData['profile_name'] = $this->input->post('profile_name');		
		$accessPermissions = $this->input->post('accessPermissions');
		$userData['status'] = $this->input->post('status');
		if($this->db->insert('master_profile', $userData))
		{
			$profileId = $this->db->insert_id();
			for($i=0;$i < count($accessPermissions); $i++){
				$userPermissionData['profile_id'] = $profileId;
				$userPermissionData['module_code'] = $accessPermissions[$i];
				$this->db->insert('module_access_control', $userPermissionData);
			}
			return true;		
		}else{
			return false;
		}
    }
    
	function updateSystemProfile()
    {
            
                $profileId = $this->input->post('profileId');
                $userData['profile_name'] = $this->input->post('profile_name');		
                $userData['status'] = $this->input->post('status');
                $this->db->where('profile_id', $profileId);
		$this->db->update('master_profile', $userData);
            
		
		$accessPermissions = $this->input->post('accessPermissions');
		$this->db->where('profile_id', $profileId);
		$this->db->delete('module_access_control');
		for($i=0;$i < count($accessPermissions); $i++){
			$userPermissionData['profile_id'] = $profileId;
			$userPermissionData['module_code'] = $accessPermissions[$i];
			$this->db->insert('module_access_control', $userPermissionData);
		}
		return true;
    }
    
    	public function getStoreUserDetail($userid)
	{
		$this->db->where('store_user_id', $userid);
		$this->db->select('sud.*,ag.agencyName');
                $this->db->from('store_user_detail as sud');
                $this->db->join('agencies as ag', 'ag.agencyId = sud.agencyId','left');
		$query = $this->db->get();
		return ($query->row_array());
	}

}
?>