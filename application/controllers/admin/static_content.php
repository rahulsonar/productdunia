<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_content extends CI_Controller {
	
	function __construct(){
	    parent::__construct();
            $this->load->helper('text');
            $this->xajax->register(XAJAX_FUNCTION, array('toggleFAQStatus', &$this, 'toggleFAQStatus'));	       
	    $this->xajax->register(XAJAX_FUNCTION, array('staticContentSubmit', &$this, 'staticContentSubmit'));
	    $this->xajax->register(XAJAX_FUNCTION, array('faqSubmit', &$this, 'faqSubmit'));
	    
	    $this->xajax->processRequest();	
	}
	
	function index()
	{
		$page = 'aboutus';
		$this->editStaticContent($page);
	}
	
	public function editStaticContent($page)
	{
		$this->access_control_model->check_access('Edit Static Content',__CLASS__,__FUNCTION__,'functional');
		
		/* Breadcrumb Start */ 
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		$this->breadcrumb->append_crumb('Static Content',site_url($this->config->item('controlPanel') . '/static_content/editStaticContent'));
		/* Breadcrumb End */
		
		switch ($page) {
			case 'about-us':
				$contentId = 1;
			break;
                    case 'sales-purchase':
				$contentId = 2;
			break;
                    case 'terms-conditions':
				$contentId = 3;
			break;
                    case 'return-policy':
				$contentId = 4;
			break;
                    case 'contact-us':
				$contentId = 5;
			break;
                    case 'privacy-policy':
				$contentId = 6;
			break;
			default:
				$contentId = 1;
			break;
		}
		
		$data = $this->staticContentFormElement($contentId);
		$data['action'] = site_url($this->config->item('controlPanel') . '/static_content/staticContentSubmit');
		$data['attributes'] = array('name' => 'frmStaticContent', 'id' => 'frmStaticContent', 'class' => 'form-horizontal');
		$data['template'] = $this->config->item('controlPanel') . "/addStaticContent_view";
		$data['page_title'] = 'Edit Static Content';
		$temp['data'] = $data;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);	
	}
	
	public function staticContentSubmit($formData)
	{
		$this->access_control_model->check_access('staticContentSubmit',__CLASS__,__FUNCTION__,'basic');
		foreach($formData as $id => $field)
                {
                    $_POST[$id] = $field;
                }
		$response = false;
                $objResponse = new xajaxResponse();
		if($_POST['contentId']!=''){
			$response = $this->common_model->updateStaticContent();
		}		
		if($response){
			$objResponse->Assign("errorMsg","innerHTML", '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->lang->line('staticContentSaved').'</div>');
		}else{
			$objResponse->Assign("errorMsg","innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->lang->line('operationFail').'</div>');
		}
		return $objResponse;		
	}
	
	public function faq(){
		$this->access_control_model->check_access('List FQA',__CLASS__,__FUNCTION__,'functional');
		/* Breadcrumb Start */
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		$this->breadcrumb->append_crumb('FAQ',site_url($this->config->item('controlPanel') . '/static_content/faq'));
		/* Breadcrumb End */

		$faqList = $this->common_model->getFAQList();
		$data['faqList'] = $faqList;		
		$data['template'] = $this->config->item('controlPanel') . "/faqList_view";
		$data['page_title'] = 'FAQ';
		$temp['data'] = $data;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
	}
	
	public function toggleFAQStatus($faqid,$status)
	{
		$this->access_control_model->check_access('toggle_status',__CLASS__,__FUNCTION__,'basic');
		$statusToUpdate = $this->common_model->toggleFAQStatus($faqid,$status);
		$objResponse = new xajaxResponse();
		$objResponse->redirect(site_url($this->config->item('controlPanel') . '/static_content/faq'));
		return $objResponse;
	}
	
	public function faqDelete($faqid)
	{
		$this->access_control_model->check_access('Delete FAQ',__CLASS__,__FUNCTION__,'functional');
		$this->common_model->faqDelete($faqid);
		redirect(site_url($this->config->item('controlPanel') . '/static_content/faq'));
	}
	
	public function addFAQ(){
		$this->access_control_model->check_access('Add FAQ',__CLASS__,__FUNCTION__,'functional');
		/* Breadcrumb Start */		
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		$this->breadcrumb->append_crumb('FAQ',site_url($this->config->item('controlPanel') . '/static_content/faq'));
		$this->breadcrumb->append_crumb('Add FAQ',site_url($this->config->item('controlPanel') . '/static_content/addFAQ'));

		/* Breadcrumb End */
		$data = $this->faqFormElement();
		$data['action'] = site_url($this->config->item('controlPanel') . '/static_content/faqSubmit');
		$data['attributes'] = array('name' => 'frmFAQ', 'id' => 'frmFAQ', 'class' => 'form-horizontal');
		$data['template'] = $this->config->item('controlPanel') . "/addFAQ_view";
		$data['page_title'] = 'Add FAQ';
		$temp['data'] = $data;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
	}
	
	public function faqEdit($faqId){
		$this->access_control_model->check_access('Edit FAQ',__CLASS__,__FUNCTION__,'functional');
		/* Breadcrumb Start */		
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		$this->breadcrumb->append_crumb('FAQ',site_url($this->config->item('controlPanel') . '/static_content/faq'));
		$this->breadcrumb->append_crumb('Edit FAQ',site_url($this->config->item('controlPanel') . '/static_content/editFAQ'));

		/* Breadcrumb End */
		$data = $this->faqFormElement($faqId);
		$data['faqId'] = $faqId;
		$data['action'] = site_url($this->config->item('controlPanel') . '/static_content/faqSubmit');
		$data['attributes'] = array('name' => 'frmFAQ', 'id' => 'frmFAQ', 'class' => 'form-horizontal');
		$data['template'] = $this->config->item('controlPanel') . "/addFAQ_view";
		$data['page_title'] = 'Edit FAQ';
		$temp['data'] = $data;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
	}
	
	
	public function faqSubmit($formData)
	{
		$this->access_control_model->check_access('faqSubmit',__CLASS__,__FUNCTION__,'basic');
		foreach($formData as $id => $field)
                {
                    $_POST[$id] = $field;
                }
		//print_r($_POST);
		$response = false;
                $objResponse = new xajaxResponse();
		if($_POST['faqId']!=''){
			$response = $this->common_model->updateFAQ();
		}else{
			$response = $this->common_model->insertFAQ();
		}
		$response = true;
		if($response){
                        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationSuccess') . '</div>');
			$objResponse->redirect(site_url($this->config->item('controlPanel') . '/static_content/faq'));
		}else{
			$objResponse->Assign("errorMsg","innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->lang->line('operationFail').'</div>');
		}
		return $objResponse;		
	}
	
	
	/**
	 * Form Element functions.
	 * 
	 */
	
	public function staticContentFormElement($contentId='')
	{
		$content = array();
		$content = $this->common_model->getStaticContent($contentId);			
		$data['contentId'] = $content['id'];
		$data['page_heading'] = array(
				'name'        => 'page_heading',
				'id'          => 'page_heading',
				'value'       => (isset($content['page_heading']))?($content['page_heading']):(set_value('page_heading')),
				'maxlength'   => '255',
				'size'        => '20',
				'class'		  => 'input-xlarge focused'
            	);
        $data['page_content'] = array(
				'name'        => 'page_content',
				'id'          => 'page_content',
				'value'       => (isset($content['page_content']))?($content['page_content']):(set_value('page_content')),
				'maxlength'   => '100',
				'size'        => '20',
				'class'		  => 'cleditor'
            	);
            	
        $data['sel_status']['name'] = 'status';
		$data['sel_status']['attribute'] = 'id = "status" data-rel="chosen"';
		$data['sel_status']['options'] = array(
			  'Active' => 'Active',
			  'Inactive' => 'Inactive'
			  );
		$data['sel_status']['selected_status'] = (isset($content['status']))?($content['status']):('Active');
        return $data;
	}
	
	public function faqFormElement($faqId='')
	{
                $questionCategoryArr = $this->common_model->getQuestionCategory(1);
		$content = array();
		if($faqId!=''){
			$content = $this->common_model->getFAQ($faqId);
			$data['faqId'] = $content['faq_id'];
		}else{
			$data['faqId'] = '';
		}
                
                $data['questionCategoryTxt'] = array(
                    'name' => 'questionCategoryTxt',
                    'id' => 'questionCategoryTxt',
                    'value' => set_value('questionCategoryTxt'),
                    'maxlength' => '100',
                    'size' => '20',
                    'class' => 'input-xlarge focused'
                );
        
		$data['faq_ques'] = array(
				'name'        => 'faq_ques',
				'id'          => 'faq_ques',
				'value'       => (isset($content['faq_ques']))?($content['faq_ques']):(set_value('faq_ques')),
				'maxlength'   => '255',
				'size'        => '20',
				'class'		  => 'input-xlarge focused'
            	);
                $data['faq_ans'] = array(
				'name'        => 'faq_ans',
				'id'          => 'faq_ans',
				'value'       => (isset($content['faq_ans']))?($content['faq_ans']):(set_value('faq_ans')),
				'maxlength'   => '100',
				'size'        => '20',
				'class'		  => 'cleditor'
            	);
                
                $data['sel_questionCategory']['name'] = 'questionCategory';
                $data['sel_questionCategory']['attribute'] = 'id = "questionCategory" data-rel="chosen"';
                $data['sel_questionCategory']['options'] = $questionCategoryArr;
                $data['sel_questionCategory']['selected_status'] = (isset($content['faq_category'])) ? ($content['faq_category']) : ('');
            	
                $data['sel_status']['name'] = 'status';
		$data['sel_status']['attribute'] = 'id = "status" data-rel="chosen"';
		$data['sel_status']['options'] = array(
			  'Active' => 'Active',
			  'Inactive' => 'Inactive'
			  );
		$data['sel_status']['selected_status'] = (isset($content['status']))?($content['status']):('Active');
                return $data;
	}
}
?>
