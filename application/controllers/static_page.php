<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_page extends MY_Controller {

        function __construct(){
		parent::__construct();
                $this->xajax->processRequest();
	}
        
	public function index()
	{
		$this->about_us();
	}
	
	public function about_us()
	{
		$aboutUs = '1';
		$staticContent  = $this->common_model->getStaticContent($aboutUs);
		$data['pageHeading'] = $staticContent['page_heading'];
		$data['pageContent'] = $staticContent['page_content'];		
                $data['activePage'] = "static";
		$data['template'] = "static_view";
		$temp['data'] = $data;	
		$this->load->view($this->config->item('themeCode')."/common_view",$temp);
	}
        
        public function sales_purchase()
	{
		$aboutUs = '2';
		$staticContent  = $this->common_model->getStaticContent($aboutUs);
		$data['pageHeading'] = $staticContent['page_heading'];
		$data['pageContent'] = $staticContent['page_content'];		
                $data['activePage'] = "static";
		$data['template'] = "static_view";
		$temp['data'] = $data;	
		$this->load->view($this->config->item('themeCode')."/common_view",$temp);
	}
        
        public function terms_conditions()
	{
		$aboutUs = '3';
		$staticContent  = $this->common_model->getStaticContent($aboutUs);
		$data['pageHeading'] = $staticContent['page_heading'];
		$data['pageContent'] = $staticContent['page_content'];		
                $data['activePage'] = "static";
		$data['template'] = "static_view";
		$temp['data'] = $data;	
		$this->load->view($this->config->item('themeCode')."/common_view",$temp);
	}
        
        public function return_policy()
	{
		$aboutUs = '4';
		$staticContent  = $this->common_model->getStaticContent($aboutUs);
		$data['pageHeading'] = $staticContent['page_heading'];
		$data['pageContent'] = $staticContent['page_content'];		
                $data['activePage'] = "static";
		$data['template'] = "static_view";
		$temp['data'] = $data;	
		$this->load->view($this->config->item('themeCode')."/common_view",$temp);
	}
        
        public function contact_us()
	{
		$aboutUs = '5';
		$staticContent  = $this->common_model->getStaticContent($aboutUs);
		$data['pageHeading'] = $staticContent['page_heading'];
		$data['pageContent'] = $staticContent['page_content'];		
                $data['activePage'] = "static";
		$data['template'] = "static_view";
		$temp['data'] = $data;	
		$this->load->view($this->config->item('themeCode')."/common_view",$temp);
	}
        
        public function privacy_policy()
	{
		$aboutUs = '6';
		$staticContent  = $this->common_model->getStaticContent($aboutUs);
		$data['pageHeading'] = $staticContent['page_heading'];
		$data['pageContent'] = $staticContent['page_content'];		
                $data['activePage'] = "static";
		$data['template'] = "static_view";
		$temp['data'] = $data;	
		$this->load->view($this->config->item('themeCode')."/common_view",$temp);
	}
	
	public function faq()
	{
		$faqList  = $this->common_model->getFAQList();
                //print_debug($faqList, __FILE__, __LINE__, 1);
		$data['pageHeading'] = 'FAQ';
		$data['faqList'] = $faqList;
                $data['activePage'] = "static";
		$data['template'] = "faq_view";
                $data['cust'] = "active";
		$temp['data'] = $data;	
		$this->load->view($this->config->item('themeCode')."/common_view",$temp);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */