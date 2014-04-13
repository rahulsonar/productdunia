<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
	    parent::__construct();
		$this->load->model('system_model');
		$this->lang->load('login', $this->config->item('language'));
		$this->xajax->register(XAJAX_FUNCTION, array('loginSystemUser', &$this, 'loginSystemUser'));
		$this->xajax->processRequest();
	}

	public function index()
	{
		$this->loginFormShow();
	}
	
	public function loginFormShow()
	{
		if($this->session->userdata('sysuser_loggedin_user')!=''){
			redirect($this->config->item('controlPanel') . '/dashboard');		
		}else{
			$data['action'] = site_url($this->config->item('controlPanel') . '/login');
			$data['action_type'] = 'loginFormSubmit';
	    	$data['attributes'] = array('name' => 'frmLogin', 'id' => 'frmLogin', 'class' => 'form-horizontal');
			$data['username_txt'] = array(
				'name'        => 'username',
				'id'          => 'username',
				'value'       => set_value('username'),
				
				'class'       => 'input-large'
				);
			$data['password_txt'] = array(
				'name'        => 'password',
				'id'          => 'password',
				'value'       => '',
				'maxlength'   => '10',
				'class'       => 'input-large'
				);
						
			$data['template'] = $this->config->item('controlPanel') . "/login_view";
			$temp['data'] = $data;
			$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
		}
	}

	public function loginSystemUser($username,$password) {
		$objResponse = new xajaxResponse();
		$loginData['username'] = $username;
		$loginData['password'] = $password;
		if($this->system_model->loginSystemUser($loginData)){
			$objResponse->redirect(site_url($this->config->item('controlPanel') . '/dashboard'));
		}else{
			$objResponse->Assign("errorMsg","innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->lang->line('invalidLogin').'</div>');
		}
		return $objResponse;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/login.php */