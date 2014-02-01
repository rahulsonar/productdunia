<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    function __construct(){
        parent::__construct();
    }
	
    public function index()
    {
        $this->access_control_model->check_access('Dashboard',__CLASS__,__FUNCTION__,'basic');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
        /* Breadcrumb End */
        $this->show_deshboard();
    }

    public function show_deshboard()
    {
        $data['template'] = $this->config->item('controlPanel') . "/dashboard_view";
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */