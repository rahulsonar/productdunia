<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Geo extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('product_model');

        $this->xajax->register(XAJAX_FUNCTION, array('toggleCityStatus', &$this, 'toggleCityStatus'));
        $this->xajax->register(XAJAX_FUNCTION, array('toggleAreaStatus', &$this, 'toggleAreaStatus'));
        $this->xajax->register(XAJAX_FUNCTION, array('toggleAreaMajor', &$this, 'toggleAreaMajor'));
        
        $this->xajax->register(XAJAX_FUNCTION, array('citySubmit', &$this, 'citySubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('areaSubmit', &$this, 'areaSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('subAreaAssociationSubmit', &$this, 'subAreaAssociationSubmit'));
        
        $this->xajax->processRequest();
    }

    function index() {
        $this->cityListShow();
    }

    /* city Start */
    public function cityListShow() {
        $this->access_control_model->check_access('List cities', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('City', site_url($this->config->item('controlPanel') . '/geo/cityListShow'));
        /* Breadcrumb End */

        $cities = $this->product_model->getCityList();
        $data['citiesList'] = $cities;
        $data['template'] = $this->config->item('controlPanel') . "/citiesList_view";
        $data['page_title'] = 'Cities';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function addCity() {
        $this->access_control_model->check_access('Add City', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('City', site_url($this->config->item('controlPanel') . '/geo/cityListShow'));
        $this->breadcrumb->append_crumb('Add City', site_url($this->config->item('controlPanel') . '/geo/addCity'));
        /* Breadcrumb End */
        $data = $this->cityFormElement();

        $data['action'] = site_url($this->config->item('controlPanel') . '/geo/citySubmit');
        $data['attributes'] = array('name' => 'frmCity', 'id' => 'frmCity', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addCity_view";
        $data['page_title'] = 'Add City';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function cityEdit($city_id) {
        $this->access_control_model->check_access('Edit City', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('City', site_url($this->config->item('controlPanel') . '/geo/cityListShow'));
        $this->breadcrumb->append_crumb('Edit City', site_url($this->config->item('controlPanel') . '/geo/cityEdit'));
        /* Breadcrumb End */

        $data = $this->cityFormElement($city_id);
        $data['action'] = site_url($this->config->item('controlPanel') . '/geo/citySubmit');
        $data['attributes'] = array('name' => 'frmCity', 'id' => 'frmCity', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addCity_view";
        $data['page_title'] = 'Edit City';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function citySubmit($formData) {
        $this->access_control_model->check_access('citySubmit', __CLASS__, __FUNCTION__, 'basic');
        foreach ($formData as $id => $field) {
            $_POST[$id] = $field;
        }
        $objResponse = new xajaxResponse();
        if ($_POST['cityId'] != '') {
            $response = $this->product_model->updateCity();
        } else {
            $response = $this->product_model->insertCity();
        }
        if ($response) {
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationSuccess') . '</div>');
            $objResponse->redirect(site_url($this->config->item('controlPanel') . '/geo/cityListShow'));
        } else {
            $objResponse->Assign("errorMsg", "innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
        }
        return $objResponse;
    }
    
    public function toggleCityStatus($cityId, $status) {
        $this->access_control_model->check_access('toggleCityStatus', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $statusToUpdate = $this->product_model->toggleCityStatus($cityId, $status);
        $statusMsg = ($status == 'Active') ? ($this->lang->line('cityInactivated')) : ($this->lang->line('cityActivated'));
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $statusMsg . '</div>');
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/geo/cityListShow'));
        return $objResponse;
    }

    public function cityDelete($city_id) {
        $this->access_control_model->check_access('Delete city', __CLASS__, __FUNCTION__, 'functional');
        $this->product_model->cityDelete($city_id);
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('cityDeleted') . '</div>');
        redirect(site_url($this->config->item('controlPanel') . '/geo/cityListShow'));
    }
    /* city End */
    
    /* area Start */
        public function areaListShow() {
        $this->access_control_model->check_access('List areas', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Area', site_url($this->config->item('controlPanel') . '/geo/areaListShow'));
        /* Breadcrumb End */

        $cities = $this->product_model->getAreaList();
        $data['areasList'] = $cities;
        $data['template'] = $this->config->item('controlPanel') . "/areasList_view";
        $data['page_title'] = 'Area';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }
    
    public function addArea() {
        $this->access_control_model->check_access('Add Area', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Area', site_url($this->config->item('controlPanel') . '/geo/areaListShow'));
        $this->breadcrumb->append_crumb('Add Area', site_url($this->config->item('controlPanel') . '/geo/addArea'));
        /* Breadcrumb End */
        $data = $this->areaFormElement();

        $data['action'] = site_url($this->config->item('controlPanel') . '/geo/areaSubmit');
        $data['attributes'] = array('name' => 'frmArea', 'id' => 'frmArea', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addArea_view";
        $data['page_title'] = 'Add Area';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }
    
    public function areaEdit($areaId) {
        $this->access_control_model->check_access('Edit Area', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Area', site_url($this->config->item('controlPanel') . '/geo/areaListShow'));
        $this->breadcrumb->append_crumb('Edit Area', site_url($this->config->item('controlPanel') . '/geo/areaEdit'));
        /* Breadcrumb End */
        $data = $this->areaFormElement($areaId);

        $data['action'] = site_url($this->config->item('controlPanel') . '/geo/areaSubmit');
        $data['attributes'] = array('name' => 'frmArea', 'id' => 'frmArea', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addArea_view";
        $data['page_title'] = 'Edit Area';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }
    
    public function areaSubmit($formData) {
        $this->access_control_model->check_access('areaSubmit', __CLASS__, __FUNCTION__, 'basic');
        foreach ($formData as $id => $field) {
            $_POST[$id] = $field;
        }
        $objResponse = new xajaxResponse();
        if ($_POST['areaId'] != '') {
            $response = $this->product_model->updateArea();
        } else {
            $response = $this->product_model->insertArea();
        }
        if ($response) {
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationSuccess') . '</div>');
            $objResponse->redirect(site_url($this->config->item('controlPanel') . '/geo/areaListShow'));
        } else {
            $objResponse->Assign("errorMsg", "innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
        }
        return $objResponse;
    }


    
    public function toggleAreaStatus($areaId, $status) {
        $this->access_control_model->check_access('toggleAreaStatus', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $statusToUpdate = $this->product_model->toggleAreaStatus($areaId, $status);
        $statusMsg = ($status == 'Active') ? ($this->lang->line('areaInactivated')) : ($this->lang->line('areaActivated'));
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $statusMsg . '</div>');
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/geo/areaListShow'));
        return $objResponse;
    }

    public function areaDelete($areaId) {
        $this->access_control_model->check_access('Delete area', __CLASS__, __FUNCTION__, 'functional');
        $this->product_model->areaDelete($areaId);
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('areaDeleted') . '</div>');
        redirect(site_url($this->config->item('controlPanel') . '/geo/areaListShow'));
    }
    
    public function toggleAreaMajor($areaId, $status) {
        $this->access_control_model->check_access('toggleAreaMajor', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $statusToUpdate = $this->product_model->toggleAreaMajor($areaId, $status);
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/geo/areaListShow'));
        return $objResponse;
    }
    
    public function subAreaAssociation($areaId){
        $this->access_control_model->check_access('Associate sub-area with major area',__CLASS__,__FUNCTION__,'functional');

        /* Breadcrumb Start */		
        $this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Area', site_url($this->config->item('controlPanel') . '/geo/areaListShow'));
        $this->breadcrumb->append_crumb('Edit Area Association',site_url($this->config->item('controlPanel') . '/geo/subAreaAssociation'));
        /* Breadcrumb End */

        $data = $this->associateSubareaFormElement($areaId);
        $data['action'] = site_url($this->config->item('controlPanel') . '/geo/subAreaAssociationSubmit');
        $data['attributes'] = array('name' => 'frmAssociateSubarea', 'id' => 'frmAssociateSubarea', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/associateSubarea_view";
        $data['page_title'] = 'Sub-area Association';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
    }
    
    public function subAreaAssociationSubmit($formData){
        $response = false;
        $this->access_control_model->check_access('subAreaAssociationSubmit',__CLASS__,__FUNCTION__,'basic');
        foreach($formData as $id => $field)
        {
            $_POST[$id] = $field;
        }

        $objResponse = new xajaxResponse();
        if ($_POST['areaId'] != '') {
            $response = $this->product_model->updateAssociatedSubAreas();
        }

        if($response){
                $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationSuccess') . '</div>');
                $objResponse->redirect(site_url($this->config->item('controlPanel') . '/geo/areaListShow'));
        }else{
                $objResponse->Assign("errorMsg","innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>'.$this->lang->line('operationFail').'</div>');
        }
        return $objResponse;
    }

    /* area End */
    
    /* Form Element Start */
    public function cityFormElement($cityId = '') {
        $countryArr = $this->common_model->getCountries(1);
        $city = array();
        if ($cityId != '') {
            $city = $this->product_model->getCity($cityId);
            $data['cityId'] = $city['cityId'];
        } else {
            $data['cityId'] = '';
        }

        $data['cityName'] = array(
            'name' => 'cityName',
            'id' => 'cityName',
            'value' => (isset($city['cityName'])) ? ($city['cityName']) : (set_value('cityName')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['latitude'] = array(
            'name' => 'latitude',
            'id' => 'latitude',
            'value' => (isset($city['latitude'])) ? ($city['latitude']) : (set_value('latitude')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['longitude'] = array(
            'name' => 'longitude',
            'id' => 'longitude',
            'value' => (isset($city['longitude'])) ? ($city['longitude']) : (set_value('longitude')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['sel_countryName']['name'] = 'countryName';
        $data['sel_countryName']['attribute'] = 'id = "countryName" data-rel="chosen"';
        $data['sel_countryName']['options'] = $countryArr;
        $data['sel_countryName']['selected_countryId'] = (isset($city['countryId'])) ? ($city['countryId']) : ('');

        $data['sel_status']['name'] = 'status';
        $data['sel_status']['attribute'] = 'id = "status" data-rel="chosen"';
        $data['sel_status']['options'] = array(
            'Active' => 'Active',
            'Inactive' => 'Inactive'
        );
        $data['sel_status']['selected_status'] = (isset($city['status'])) ? ($city['status']) : ('Active');
        return $data;
    }
    
    
    public function areaFormElement($areaId = '') {
        $cityArr = $this->product_model->getCities(1);
        $area = array();
        if ($areaId != '') {
            $area = $this->product_model->getArea($areaId);
            $data['areaId'] = $area['areaId'];
        } else {
            $data['areaId'] = '';
        }

        $data['areaName'] = array(
            'name' => 'areaName',
            'id' => 'areaName',
            'value' => (isset($area['areaName'])) ? ($area['areaName']) : (set_value('areaName')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
                
        $data['sel_cityName']['name'] = 'cityName';
        $data['sel_cityName']['attribute'] = 'id = "cityName" data-rel="chosen"';
        $data['sel_cityName']['options'] = $cityArr;
        $data['sel_cityName']['selected_cityName'] = (isset($area['cityId'])) ? ($area['cityId']) : ('');
        
        $data['latitude'] = array(
            'name' => 'latitude',
            'id' => 'latitude',
            'value' => (isset($area['latitude'])) ? ($area['latitude']) : (set_value('latitude')),
            'maxlength' => '45',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['longitude'] = array(
            'name' => 'longitude',
            'id' => 'longitude',
            'value' => (isset($area['longitude'])) ? ($area['longitude']) : (set_value('longitude')),
            'maxlength' => '45',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['sel_status']['name'] = 'status';
        $data['sel_status']['attribute'] = 'id = "status" data-rel="chosen"';
        $data['sel_status']['options'] = array(
            'Active' => 'Active',
            'Inactive' => 'Inactive'
        );
        $data['sel_status']['selected_status'] = (isset($area['status'])) ? ($area['status']) : ('Active');
        return $data;
    }
    
    public function associateSubareaFormElement($areaId='')
    {
            $subAreas =  array();
            $associatedAreas =  array();
            $area = $this->product_model->getArea($areaId);
            $subAreas = $this->product_model->getMinorAreas($area['cityId']);
            $associatedAreas = $this->product_model->getAssociatedAreas($areaId);

            $data['areaId'] = $area['areaId'];
            $data['areaName'] = array(
                            'name'        => 'areaName',
                            'id'          => 'areaName',
                            'value'       => (isset($area['areaName']))?($area['areaName']):(set_value('areaName')),
                            'maxlength'   => '100',
                            'size'        => '20',
                            'class'       => 'input-xlarge focused',
                            'readonly'    => 'readonly'
            );
            $data['subAreas'] = $subAreas;
            $data['associatedAreas'] = $associatedAreas;
            return $data;
    }
    
    /* Form element End */

}

?>
