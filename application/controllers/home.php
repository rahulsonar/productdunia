<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	/**
	 * Product controller.
	 */
	function __construct(){
		parent::__construct();
                $this->xajax->processRequest();
	}
	
	public function index()
	{	
		$this->home();
	}
	
	public function home()
	{
		$data['products'] = $this->common_model->getHomeProducts();                
                $data['storeProdStats'] = $this->common_model->getStoreProdStats();

		$data['template'] = "home_view";
		$data['activePage'] = "home";
		$temp['data'] = $data;	
		$this->load->view($this->config->item('themeCode')."/common_view",$temp);
	}
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */