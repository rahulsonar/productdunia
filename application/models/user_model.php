<?php

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
    }

    /*public function login($loginData, $skipPass = "0") {
        $table_name = "master_customer as mc";
        $this->db->where('mc.username', $loginData['username']);
        $this->db->where('mc.status', 'Active');
        $this->db->select('mc.*')->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows != 1) {
            return FALSE;
        } else {
            $row = $query->row();
            if ($skipPass == '0') {
                if (($loginData['password'] != $this->encrypt->decode($row->password))) {
                    return false;
                }
            }
            $this->setSessionData($row);
            return true;
        }
    }

    public function setSessionData($row) {
        if (count($row) > 0) {
            $session_data['bill_fname'] = $row->firstName;
            $session_data['bill_lname'] = $row->lastName;
            $session_data['bill_email'] = $row->email;
            $session_data['bill_address'] = $row->address;
            $session_data['bill_city'] = $row->city;
            $session_data['bill_state'] = $row->state;
            $session_data['bill_zip'] = $row->zipCode;
            $session_data['bill_country'] = $row->country;
            $session_data['bill_country_code'] = $row->mobileCountryCode;
            $session_data['bill_mobile'] = $row->mobile;
            $session_data['bill_phone'] = $row->phone;

            $session_data['interfaceUserId'] = $row->customerId;
            $session_data['interfaceUsername'] = $row->username;
            
            $session_data['interfaceCustomerType'] = $row->customerType;
            $session_data['interfaceDiscountCoupon'] = $row->discountCoupon;
            
            $session_data['interfaceFirstName'] = $row->firstName;
            $session_data['interfaceLastName'] = $row->lastName;
            $session_data['interfaceEmail'] = $row->email;
            $session_data['interfacePhone'] = $row->mobile;
            $session_data['interfaceUserIp'] = $this->input->ip_address();
            $this->session->set_userdata($session_data);
        }
    }

    public function logout() {
        
        
        
        
        $array_items = array('interfaceUserId' => '', 'interfaceUsername' => '', 'interfaceCustomerType' => '', 'interfaceCommission' => '', 'interfaceFirstName' => '', 'interfaceLastName' => '', 'interfaceEmail' => '', 'interfacePhone' => '', 'interfaceUserIp' => '', 'logoutUrl' => '', 'redirectTo' => '', 'specialInstruction' => '', 'greetinfo' => '', 'sender_name_card' => '');
        $this->session->unset_userdata($array_items);
        return true;
    }

    public function isUsernameAvailable($username) {
        if($username!=''){
            $data['username'] = $username;
            $queryUser = $this->db->get_where('master_customer', $data);
            if ($queryUser->num_rows > 0) {
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }

    function register_fb_user($userFbData) {
        $email = ($userFbData['email'] != '') ? ($userFbData['email']) : ($userFbData['first_name']);
        $fb_id = $userFbData['id'];
        $google_id = '0';
        $firstName = $userFbData['first_name'];
        $lastName = $userFbData['last_name'];
        $email = $email;
        $mobileCountryCode = '';
        $mobile = '';
        $phone = '';
        $companyName = '';
        $username = $email;
        $password = '';
        $password_hash = '';
        $address = '';
        $city = $userFbData['hometown']['name'];
        $state = '';
        $country = '';
        $zipCode = '';
        $status = 'Active';
        $create_date = date("Y-m-d H:i:s");
        $create_by = 'self';


        $sql = "INSERT INTO master_customer (fb_id, google_id, firstName, lastName, email, mobileCountryCode, mobile, phone, companyName, username, password, password_hash, address, city, state, country, zipCode, status, create_date, create_by) VALUES (" . $this->db->escape($fb_id) . ", " . $this->db->escape($google_id) . ", " . $this->db->escape($firstName) . ", " . $this->db->escape($lastName) . ", " . $this->db->escape($email) . ", " . $this->db->escape($mobileCountryCode) . ", " . $this->db->escape($mobile) . ", " . $this->db->escape($phone) . ", " . $this->db->escape($companyName) . ", " . $this->db->escape($username) . ", " . $this->db->escape($password) . ", " . $this->db->escape($password_hash) . ", " . $this->db->escape($address) . ", " . $this->db->escape($city) . ", " . $this->db->escape($state) . ", " . $this->db->escape($country) . ", " . $this->db->escape($zipCode) . ", " . $this->db->escape($status) . ", " . $this->db->escape($create_date) . ", " . $this->db->escape($create_by) . ") ON DUPLICATE KEY UPDATE fb_id=" . $this->db->escape($fb_id);

        if ($this->db->query($sql)) {
            $loginData['username'] = $username;
            $skipPass = '1';
            $response = $this->login($loginData, $skipPass);
            return true;
        } else {
            return false;
        }
    }
    
    function register_google_user($userFbData) {
        $email = ($userFbData['contact/email'] != '') ? ($userFbData['contact/email']) : ($userFbData['namePerson/first']);
        $fb_id = '0';
        $google_id = $userFbData['contact/email'];
        $firstName = $userFbData['namePerson/first'];
        $lastName = $userFbData['namePerson/last'];
        $email = $email;
        $mobileCountryCode = '';
        $mobile = '';
        $phone = '';
        $companyName = '';
        $username = $email;
        $password = '';
        $password_hash = '';
        $address = '';
        $city = '';
        $state = '';
        $country = '';
        $zipCode = '';
        $status = 'Active';
        $create_date = date("Y-m-d H:i:s");
        $create_by = 'self';


        $sql = "INSERT INTO master_customer (fb_id,google_id, firstName, lastName, email, mobileCountryCode, mobile, phone, companyName, username, password, password_hash, address, city, state, country, zipCode, status, create_date, create_by) VALUES (" . $this->db->escape($fb_id) . ", " . $this->db->escape($google_id) . ", " . $this->db->escape($firstName) . ", " . $this->db->escape($lastName) . ", " . $this->db->escape($email) . ", " . $this->db->escape($mobileCountryCode) . ", " . $this->db->escape($mobile) . ", " . $this->db->escape($phone) . ", " . $this->db->escape($companyName) . ", " . $this->db->escape($username) . ", " . $this->db->escape($password) . ", " . $this->db->escape($password_hash) . ", " . $this->db->escape($address) . ", " . $this->db->escape($city) . ", " . $this->db->escape($state) . ", " . $this->db->escape($country) . ", " . $this->db->escape($zipCode) . ", " . $this->db->escape($status) . ", " . $this->db->escape($create_date) . ", " . $this->db->escape($create_by) . ") ON DUPLICATE KEY UPDATE google_id=" . $this->db->escape($google_id);

        if ($this->db->query($sql)) {
            $loginData['username'] = $username;
            $skipPass = '1';
            $response = $this->login($loginData, $skipPass);
            return true;
        } else {
            return false;
        }
    }

    function register_user() {
        $userData['fb_id'] = $this->input->post('fb_id');
        $userData['google_id'] = '0';
        $userData['firstName'] = $this->input->post('fname');
        $userData['lastName'] = $this->input->post('lname');
        $userData['email'] = $this->input->post('email_address');
        $userData['mobileCountryCode'] = $this->input->post('country_code');
        $userData['mobile'] = $this->input->post('mobile');
        $userData['phone'] = $this->input->post('phone');
        $userData['companyName'] = $this->input->post('company_name');
        $userData['username'] = $this->input->post('email_address');
        $userData['password'] = $this->encrypt->encode($this->input->post('password'));
        $userData['address'] = $this->input->post('address');
        $userData['city'] = $this->input->post('city');
        $userData['state'] = $this->input->post('state');
        $userData['country'] = $this->input->post('country');
        $userData['zipCode'] = $this->input->post('zip');
        $userData['status'] = 'Active';
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = 'self';
        if ($this->db->insert('master_customer', $userData)) {
            $loginData['username'] = $this->input->post('email_address');
            $loginData['password'] = $this->input->post('password');
            $response = $this->login($loginData);
            return true;
        } else {
            return false;
        }
    }

    function edit_user_profile() {
        $userData['firstName'] = $this->input->post('fname');
        $userData['lastName'] = $this->input->post('lname');
        $userData['email'] = $this->input->post('email_address');
        $userData['mobileCountryCode'] = $this->input->post('country_code');
        $userData['mobile'] = $this->input->post('mobile');
        $userData['phone'] = $this->input->post('phone');
        $userData['companyName'] = $this->input->post('company_name');
        $userData['password'] = $this->encrypt->encode($this->input->post('password'));
        $userData['address'] = $this->input->post('address');
        $userData['city'] = $this->input->post('city');
        $userData['state'] = $this->input->post('state');
        $userData['country'] = $this->input->post('country');
        $userData['zipCode'] = $this->input->post('zip');
        $userData['status'] = 'Active';
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = 'self';
        $this->db->where('customerId', $this->input->post('customerId'));
        if ($this->db->update('master_customer', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function newsletter_subscription() {
        $userData['email'] = $this->input->post('email_address');
        $userData['subscribed'] = $this->input->post('newsletter');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = 'self';
        if ($this->db->insert('newsletter_subscription', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function custom_user_registration($frmFields) {
        $userData['fb_id'] = $frmFields['fb_id'];
        $userData['firstName'] = $frmFields['firstName'];
        $userData['lastName'] = $frmFields['lastName'];
        $userData['email'] = $frmFields['email'];
        $userData['mobileCountryCode'] = $frmFields['mobileCountryCode'];
        $userData['mobile'] = $frmFields['mobile'];
        $userData['phone'] = $frmFields['phone'];
        $userData['companyName'] = $frmFields['companyName'];
        $userData['username'] = $frmFields['username'];
        $userData['password'] = $this->encrypt->encode($frmFields['password']);
        $userData['address'] = $frmFields['address'];
        $userData['city'] = $frmFields['city'];
        $userData['state'] = $frmFields['state'];
        $userData['country'] = $frmFields['country'];
        $userData['zipCode'] = $frmFields['zipCode'];
        $userData['status'] = 'Active';
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $frmFields['create_by'];
        if ($this->db->insert('master_customer', $userData)) {
            $skipPass = '1';
            $loginData['username'] = $frmFields['username'];
            $response = $this->login($loginData, $skipPass);
            return true;
        } else {
            return false;
        }
    }

    public function getCustomer($customerId) {
        $table_name = "master_customer";
        $this->db->where('customerId', $customerId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        $customerData = $query->row_array();
        $customerData['password'] = $this->encrypt->decode($customerData['password']);
        return $customerData;
    }

    public function getCustomerByUsername($username) {
        $customerData = array();
        $table_name = "master_customer";
        $this->db->where('username', $username);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $customerData = $query->row_array();
        }
        return $customerData;
    }

    public function getCustomerByHash($hash) {
        $customerData = array();
        $table_name = "master_customer";
        $this->db->where('password_hash', $hash);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $customerData = $query->row_array();
        }
        return $customerData;
    }

    function updatePasswordHash($username, $password_hash = '') {
        $userData['password_hash'] = $password_hash;
        $this->db->where('username', $username);
        $this->db->update('master_customer', $userData);
        return true;
    }

    function reset_password($password, $hash) {
        $userData['password'] = $this->encrypt->encode($password);
        $this->db->where('password_hash', $hash);
        $this->db->update('master_customer', $userData);
        return true;
    }*/
    
    function signupSubmit() {
        $userData['fbId'] = '0';
        $userData['googleId'] = '0';
        $userData['email'] = $this->input->post('signupEmail');
        $userData['username'] = $this->input->post('signupEmail');
        $userData['password'] = $this->encrypt->encode($this->input->post('signupPassword'));
        $userData['status'] = 'Active';
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = 'self';
        if ($this->db->insert('customers', $userData)) {
            $loginData['username'] = $this->input->post('signupEmail');
            $loginData['password'] = $this->input->post('signupPassword');
            $response = $this->login($loginData);
            return true;
        } else {
            return false;
        }
    }
    
    public function isUsernameAvailable($username) {
        if($username!=''){
            $data['username'] = $username;
            $queryUser = $this->db->get_where('customers', $data);
            if ($queryUser->num_rows > 0) {
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
    
    function signupGoogleUser($userFbData) {
        $email = ($userFbData['contact/email'] != '') ? ($userFbData['contact/email']) : ($userFbData['namePerson/first']);
        $google_id = $userFbData['contact/email'];
        $firstName = $userFbData['namePerson/first'] . ' ' . $userFbData['namePerson/last'];
        $email = $email;        
        $username = $email;
        $status = 'Active';
        $create_date = date("Y-m-d H:i:s");
        $create_by = 'self';
        $login = FALSE;

        $data['username'] = $username;
        $queryUser = $this->db->get_where('customers', $data);
        if ($queryUser->num_rows > 0) {
            $userData['googleId'] = $google_id;
            $userData['name'] = $firstName;
            $this->db->where('username', $username);
            $this->db->update('customers', $userData);
            $login = true;
        } else {
            $sql = "INSERT INTO customers (googleId, name, email, username, status, create_date, create_by) VALUES (". $this->db->escape($google_id) . ", " . $this->db->escape($firstName) . ", " . $this->db->escape($email) . ", " . $this->db->escape($username) . ", " . $this->db->escape($status) . ", " . $this->db->escape($create_date) . ", " . $this->db->escape($create_by) . ") ON DUPLICATE KEY UPDATE googleId=" . $this->db->escape($google_id);
            $this->db->query($sql);
            $login = true;
        }
            
        if ($login) {
            $loginData['username'] = $username;
            $skipPass = '1';
            $response = $this->login($loginData, $skipPass);
            return true;
        } else {
            return false;
        }
    }
    
    function signupFacebookUser($userFbData) {
        
        $email = ($userFbData['email'] != '') ? ($userFbData['email']) : ($userFbData['first_name']);
        $fb_id = $userFbData['id'];
        $firstName = $userFbData['name'];
        $email = $email;        
        $username = $email;
        $status = 'Active';
        $create_date = date("Y-m-d H:i:s");
        $create_by = 'self';
        $login = FALSE;

        $data['username'] = $username;
        $queryUser = $this->db->get_where('customers', $data);
        if ($queryUser->num_rows > 0) {
            $userData['fbId'] = $fb_id;
            $userData['name'] = $firstName;
            $this->db->where('username', $username);
            $this->db->update('customers', $userData);
            $login = true;
        } else {
            $sql = "INSERT INTO customers (fbId, name, email, username, status, create_date, create_by) VALUES (" . $this->db->escape($fb_id) . ", " . $this->db->escape($firstName) . ", " . $this->db->escape($email) . ", " . $this->db->escape($username) . ", " . $this->db->escape($status) . ", " . $this->db->escape($create_date) . ", " . $this->db->escape($create_by) . ") ON DUPLICATE KEY UPDATE fbId=" . $this->db->escape($fb_id);
            $this->db->query($sql);
            $login = true;
        }
            
        if ($login) {
            $loginData['username'] = $username;
            $skipPass = '1';
            $response = $this->login($loginData, $skipPass);
            return true;
        } else {
            return false;
        }
    }
    
    public function login($loginData, $skipPass = "0") {
        $table_name = "customers as mc";
        $this->db->where('mc.username', $loginData['username']);
        $this->db->where('mc.status', 'Active');
        $this->db->select('mc.*')->from($table_name);
        $query = $this->db->get();
        if ($query->num_rows != 1) {
            return FALSE;
        } else {
            $row = $query->row();
            if ($skipPass == '0') {
                if (($loginData['password'] != $this->encrypt->decode($row->password))) {
                    return false;
                }
            }
            $this->setSessionData($row);
            return true;
        }
    }

    public function setSessionData($row) {
        if (count($row) > 0) {
            $session_data['interfaceUserId'] = $row->customerId;
            $session_data['interfaceUsername'] = $row->username;
            $session_data['interfaceName'] = $row->name;
            $session_data['interfaceEmail'] = $row->email;
            $session_data['interfaceUserIp'] = $this->input->ip_address();
            $this->session->set_userdata($session_data);
        }
    }
    
    public function logout() {
        $array_items = array('interfaceUserId' => '', 'interfaceUsername' => '', 'interfaceName' => '', 'interfaceEmail' => '', 'interfaceUserIp' => '', 'logoutUrl' => '', 'redirectTo' => '');
        $this->session->unset_userdata($array_items);
        $this->session->unset_userdata('interfaceUsername');
        return true;
    }
    
    public function getCustomer($customerId) {
        $table_name = "customers";
        $this->db->where('customerId', $customerId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        $customerData = $query->row_array();
        $customerData['password'] = $this->encrypt->decode($customerData['password']);
        return $customerData;
    }
    
    function personalInfoSubmit() {
        $userData['name'] = $this->input->post('name');
        $userData['email'] = $this->input->post('email');
        $userData['mobile'] = $this->input->post('mobile');
        $userData['gender'] = $this->input->post('gender');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = 'self';
        if ($this->db->update('customers', $userData)) {            
            return true;
        } else {
            return false;
        }
    }
    
    public function shortlogin($data) {
    	// check if user exists
    	$table_name='customers';
    	$ret=array();
    	$this->db->where($data['type'],$data['key']);
    	$this->db->select('*')->from($table_name);
    	$query=$this->db->get();
    	if($query->num_rows() > 0) {
    		$customerData=$query->row_array();
    		$customerData['password']=$this->encrypt->decode($customerData['password']);
    	}
    	else {
    		$newCustomer=array();
    		
    		$newPass=rand(100000,999999);
    		$customerData[$data['type']]=$data['key'];
    		$customerData['status']='Active';
    		$customerData['username']=$data['key'];
    		$customerData['create_date']=date("Y-m-d H:i:s");
    		$customerData['create_by']='self';
    		$customerData['password']=$this->encrypt->encode($newPass);
    		$this->db->insert($table_name,$customerData);
    		$customerData['customerId']=$this->db->insert_id();
    		$customerData['password']=$newPass;
    	}
    	
    	$tmpData=array('userTmpPass'=>$customerData['password'],
    			'customerdata'=>$customerData,'data1'=>$data);
    	$this->session->set_userdata($tmpData);
    	return $customerData; 
		
    	// set session
    	/*
    	*/
    
    }
    public function shortloginConfirm() {
    		$customerData=$this->session->userdata('customerdata');
    		$data=$this->session->userdata('data1');
    	$session_data['interfaceUserId'] = $customerData['customerId'];
    	$session_data['interfaceUsername'] = $data['key'];
    	$session_data['interfaceName'] = '';
    	$session_data['interfaceEmail'] = $data['key'];
    	$session_data['interfaceUserIp'] = $this->input->ip_address();
    	$session_data['interfaceUserMobile'] =$data['key'];
    	$session_data['interfaceUserPassword'] =$customerData['password'];
    	$this->session->set_userdata($session_data);
    	return true;
    }

}

?>
