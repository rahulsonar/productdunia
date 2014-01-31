<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct(){
	    parent::__construct();
		$this->load->model('system_model');
	}

	public function index()
	{
		if($this->system_model->logoutSystemUser()){
			redirect(site_url($this->config->item('controlPanel') . '/login'));
		}
	}
}
/* End of file */