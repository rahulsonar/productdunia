<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access_deny extends CI_Controller {

	public function index()
	{
		/* Breadcrumb Start */
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		/* Breadcrumb End */
		$data['template'] = $this->config->item('controlPanel') . "/access_deny_view";
		$data['page_title'] = 'Access Restricted';
		$temp['data'] = $data;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
	}
}