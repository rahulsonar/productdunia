<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends MY_Controller {

	/**
	 * Product controller.
	 */
	function __construct(){
		parent::__construct();
                $this->xajax->register(XAJAX_FUNCTION, array('personalInfoSubmit', &$this, 'personalInfoSubmit'));
                $this->xajax->processRequest();
	}
	
	public function index()
	{	
		//$this->home();
	}
	
	public function subscribe(){
            $msg = "Operation failed. Please try again later.";
            $result = $this->common_model->newsletter_subscription();
            if($result){
                   $msg = "Thank you for your interest.";
            }
            echo $msg;
       }
       
        public function logout() {
            //$this->cart->destroy();
            $this->user_model->logout();
            redirect(site_url());
        }
        
        public function loginGoogleSubmit()
        {
            try {
                $user = $this->openid->getAttributes();
            } catch (GoogleApiException $e) {
                $user = '0';
            }

            if ($user == '0') {
                redirect(site_url('/'));
            } else {
                $params = array('next' => site_url('customer/logout'));
                $logoutUrl = $this->openid->getLogoutUrl($params);

                $session_data['logoutUrl'] = $logoutUrl;
                $this->session->set_userdata($session_data);

                $user_profile = $user;
                $response = $this->user_model->signupGoogleUser($user_profile);

                $redirectTo = ($this->session->userdata('redirectTo') != '') ? ($this->session->userdata('redirectTo')) : ('');
                $this->session->unset_userdata('redirectTo');
                redirect(site_url($redirectTo));
            }
        }
        
        public function loginFacebookSubmit()
        {
            try {
                $user = $this->facebook->getUser();
            } catch (FacebookApiException $e) {
                $user = '0';
            }

            if ($user == '0') {
                redirect(site_url('/'));
            } else {                
                $params = array('next' => site_url('customer/logout'));
                $logoutUrl = $this->facebook->getLogoutUrl($params);

                $session_data['logoutUrl'] = $logoutUrl;
                $this->session->set_userdata($session_data);

                $user_profile = $this->facebook->api('/me');
                $response = $this->user_model->signupFacebookUser($user_profile);

                $redirectTo = ($this->session->userdata('redirectTo') != '') ? ($this->session->userdata('redirectTo')) : ('');
                $this->session->unset_userdata('redirectTo');
                redirect(site_url($redirectTo));
            }
        }
        
        public function account($action) {
            $customerId = $this->session->userdata('interfaceUserId');
            if ($customerId != '') {
                switch ($action) {
                case "profile":
                default:
                    $this->session->set_userdata('redirectTo','customer/account/profile');
                    /* Breadcrumbs Start */
                    $this->breadcrumb->append_crumb('Home', site_url());
                    $this->breadcrumb->append_crumb('My Account', site_url());
                    /* Breadcrumbs End */
                    $customerData = $this->user_model->getCustomer($customerId);
                    //print_debug($customerData, __FILE__, __LINE__, 1);
                    $data['customerData'] = $customerData;
                    $data['template'] = "personalInfo_view";                
                    $data['home'] = "active";
                    $temp['data'] = $data;
                    $this->load->view($this->config->item('themeCode')."/common_view", $temp);
                }
            } else {
                redirect(site_url('customer/login'));
            }
        }
        
        public function personalInfoSubmit($formData)
        {
            foreach ($formData as $id => $field) {
                $_POST[$id] = $field;
            }
            $objResponse = new xajaxResponse();        
            $response = $this->user_model->personalInfoSubmit();
            $objResponse->Alert("Personal information updated successfully.");
            $redirectTo = ($this->session->userdata('redirectTo') != '') ? ($this->session->userdata('redirectTo')) : ('');
            $this->session->unset_userdata('redirectTo');
            $objResponse->redirect(site_url($redirectTo));
            return $objResponse;
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */