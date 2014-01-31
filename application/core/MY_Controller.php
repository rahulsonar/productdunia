<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $fb_config = array(
            'appId' => $this->config->item('appId'),
            'secret' => $this->config->item('secret')
        );
        $this->load->library('facebook', $fb_config);
        
        $google_config = array('host' => base_url());
        $this->load->library('openid', $google_config);
        
        $this->xajax->register(XAJAX_FUNCTION, array('changeCity', &$this, 'changeCity'));
        $this->xajax->register(XAJAX_FUNCTION, array('signupSubmit', &$this, 'signupSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('loginSubmit', &$this, 'loginSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('isUsernameAvailable', &$this, 'isUsernameAvailable'));
        //$this->xajax->processRequest();
        $this->_setDefaultCity();
        //$this->_googleLoginUrl();
        //$this->_facebookLoginUrl();
    }
    
    public function changeCity($cityId='')
    {
        if($cityId==''){
            $cityId = $this->config->item("defaultCity");
        }
        $cityData = $this->product_model->getCity($cityId);
        $session_data['citySelected'] = $cityId;
        $session_data['citySelectedName'] = $cityData['cityName'];        
        $this->session->set_userdata($session_data);
        $objResponse = new xajaxResponse();        
        $objResponse->script("$('#inpselsearch').val('');");        
        $objResponse->Assign("topCity", "innerHTML", $cityData['cityName']);
        $objResponse->script("window.location.reload();");
        return $objResponse;
    }
    
    public function _setDefaultCity()
    {
        if($this->session->userdata('citySelected')==''){
            $cityId = $this->config->item("defaultCity");
            $cityData = $this->product_model->getCity($cityId);
            $session_data['citySelected'] = $cityId;
            $session_data['citySelectedName'] = $cityData['cityName'];        
            $this->session->set_userdata($session_data);
        }
    }
    
    public function signupSubmit($formData)
    {
        foreach ($formData as $id => $field) {
            $_POST[$id] = $field;
        }
        $objResponse = new xajaxResponse();        
        $response = $this->user_model->signupSubmit();
        $redirectTo = ($this->session->userdata('redirectTo') != '') ? ($this->session->userdata('redirectTo')) : ('');
        $this->session->unset_userdata('redirectTo');
        $objResponse->redirect(site_url($redirectTo));
        return $objResponse;
    }
    
    public function isUsernameAvailable($username) {
        $objResponse = new xajaxResponse();
        $response = $this->user_model->isUsernameAvailable($username);
        if (!$response) {
            $objResponse->Alert("Username/Email is already in use.");
            $objResponse->Assign("signupEmail", "value", '');
            $objResponse->Script("$('#signupEmail').focus();");
        }
        return $objResponse;
    }
    
    
    public function loginSubmit($formData) {
        
        foreach ($formData as $id => $field) {
            $_POST[$id] = $field;
        }
        $objResponse = new xajaxResponse();
        $loginData['username'] = $this->input->post('signupEmail');
        $loginData['password'] = $this->input->post('password');
        $response = $this->user_model->login($loginData);

        if ($response) {
            $redirectTo = ($this->session->userdata('redirectTo') != '') ? ($this->session->userdata('redirectTo')) : ('');
            $this->session->unset_userdata('redirectTo');
            $objResponse->redirect(site_url($redirectTo));
        } else {
            $objResponse->Alert("Invalid login credentials.");
        }
        return $objResponse;
    }
    
    function _googleLoginUrl(){
        if($this->session->userdata('interfaceUsername')==''){
            /* googl login */
            $this->openid->identity = 'https://www.google.com/accounts/o8/id';
            $this->openid->required = array(
              'namePerson/friendly',
              'namePerson/first',
              'namePerson/last',
              'contact/email',
            );
            $this->openid->returnUrl = site_url('customer/loginGoogleSubmit');
            $googleLoginUrl = $this->openid->authUrl();
            $session_data['googleLoginUrl'] = $googleLoginUrl;
            $this->session->set_userdata($session_data);
        }
    }
    
    function _facebookLoginUrl(){
        if($this->session->userdata('interfaceUsername')==''){
            /* facebook login */
            $user = $this->facebook->getUser();
            $params = array(
                'scope' => 'email,publish_actions',
                'redirect_uri' => site_url('customer/loginFacebookSubmit'),
            );
            $facebookLoginUrl = $this->facebook->getLoginUrl($params);
            /* */
            $session_data['facebookLoginUrl'] = $facebookLoginUrl;
            $this->session->set_userdata($session_data);
        }
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */