<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Catalog extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('store_model');
        $this->load->library('UploadHandler');

        $this->xajax->register(XAJAX_FUNCTION, array('toggleBrandStatus', &$this, 'toggleBrandStatus'));
        $this->xajax->register(XAJAX_FUNCTION, array('brandSubmit', &$this, 'brandSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('productCategorySubmit', &$this, 'productCategorySubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('toggleProductCategoryStatus', &$this, 'toggleProductCategoryStatus'));
        $this->xajax->register(XAJAX_FUNCTION, array('manageProductCategoriesSubmit', &$this, 'manageProductCategoriesSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('toggleBrandPublish', &$this, 'toggleBrandPublish'));
        $this->xajax->register(XAJAX_FUNCTION, array('deleteBrandImage', &$this, 'deleteBrandImage'));
        $this->xajax->register(XAJAX_FUNCTION, array('prodAttributeSubmit', &$this, 'prodAttributeSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('toggleProdAttributeStatus', &$this, 'toggleProdAttributeStatus'));
        $this->xajax->register(XAJAX_FUNCTION, array('productSubmit', &$this, 'productSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('isProductSKUAvailable', &$this, 'isProductSKUAvailable'));
        $this->xajax->register(XAJAX_FUNCTION, array('toggleProductStatus', &$this, 'toggleProductStatus'));
        $this->xajax->register(XAJAX_FUNCTION, array('productMetadataSubmit', &$this, 'productMetadataSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('setMainImg', &$this, 'setMainImg'));
        $this->xajax->register(XAJAX_FUNCTION, array('deleteImg', &$this, 'deleteImg'));
        $this->xajax->register(XAJAX_FUNCTION, array('prodSpecificationSubmit', &$this, 'prodSpecificationSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('getProductFilterType', &$this, 'getProductFilterType'));
        $this->xajax->register(XAJAX_FUNCTION, array('prodFilterSubmit', &$this, 'prodFilterSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('toggleProdFilterStatus', &$this, 'toggleProdFilterStatus'));
        $this->xajax->register(XAJAX_FUNCTION, array('productFilterAssociateSubmit', &$this, 'productFilterAssociateSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('selectStoreProducts', &$this, 'selectStoreProducts'));
        $this->xajax->register(XAJAX_FUNCTION, array('addStoreProductsSubmit', &$this, 'addStoreProductsSubmit'));
        $this->xajax->register(XAJAX_FUNCTION, array('getAgencyStores', &$this, 'getAgencyStores'));
        $this->xajax->register(XAJAX_FUNCTION, array('toggleHomePublish', &$this, 'toggleHomePublish'));
        $this->xajax->register(XAJAX_FUNCTION, array('toggleProductReviewStatus', &$this, 'toggleProductReviewStatus'));
        $this->xajax->register(XAJAX_FUNCTION, array('prodReviewSubmit', &$this, 'prodReviewSubmit'));
        
        
        
        
        
        $this->xajax->processRequest();
    }

    function index() {
        $this->brandListShow();
    }

    /* brand Start */

    public function brandListShow() {
        $this->access_control_model->check_access('List brands', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Brand', site_url($this->config->item('controlPanel') . '/catalog/brandListShow'));
        /* Breadcrumb End */

        $cities = $this->product_model->getBrandList();
        $data['brandsList'] = $cities;
        $data['template'] = $this->config->item('controlPanel') . "/brandsList_view";
        $data['page_title'] = 'Brand';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function addBrand() {
        $this->access_control_model->check_access('Add Brand', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Brand', site_url($this->config->item('controlPanel') . '/catalog/brandListShow'));
        $this->breadcrumb->append_crumb('Add Brand', site_url($this->config->item('controlPanel') . '/catalog/addBrand'));
        /* Breadcrumb End */
        $data = $this->brandFormElement();

        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/brandSubmit');
        $data['attributes'] = array('name' => 'frmBrand', 'id' => 'frmBrand', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addBrand_view";
        $data['page_title'] = 'Add Brand';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function brandEdit($brandId) {
        $this->access_control_model->check_access('Edit Brand', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Brand', site_url($this->config->item('controlPanel') . '/catalog/brandListShow'));
        $this->breadcrumb->append_crumb('Edit Brand', site_url($this->config->item('controlPanel') . '/catalog/brandEdit'));
        /* Breadcrumb End */
        $data = $this->brandFormElement($brandId);

        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/brandSubmit');
        $data['attributes'] = array('name' => 'frmBrand', 'id' => 'frmBrand', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addBrand_view";
        $data['page_title'] = 'Edit Brand';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    function _uploadBrandImg() {
        $this->load->helper('string');
        $config['upload_path'] = $this->config->item('brandImgPath');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '150';
        $config['max_height'] = '36';
        $config['file_name'] = random_string('unique');
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('brandImg')) {
            $uploadStatus = array('error' => $this->upload->display_errors());
        } else {
            $uploadStatus = array('upload_data' => $this->upload->data());
        }
        return $uploadStatus;
    }

    public function brandSubmit() {
        $this->access_control_model->check_access('brandSubmit', __CLASS__, __FUNCTION__, 'basic');

        if($_FILES['brandImg']['name']!=""){
            $uploadStatus = $this->_uploadBrandImg();
            if (isset($uploadStatus['error'])) {
                $error = $uploadStatus['error'];
                $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $error . '</div>');
                redirect(site_url($this->config->item('controlPanel') . '/catalog/brandListShow'));
            }
            $fileName = $uploadStatus['upload_data']['file_name'];
        }else{
            $fileName = $this->input->post('brandLogo');
        }
        if ($_POST['brandId'] != '') {
            $response = $this->product_model->updateBrand($fileName);
        } else {
            $response = $this->product_model->insertBrand($fileName);
        }
        if ($response) {
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationSuccess') . '</div>');
            redirect(site_url($this->config->item('controlPanel') . '/catalog/brandListShow'));
        } else {
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
            redirect(site_url($this->config->item('controlPanel') . '/catalog/brandListShow'));
        }
    }

    public function toggleBrandStatus($brandId, $status) {
        $this->access_control_model->check_access('toggleBrandStatus', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $statusToUpdate = $this->product_model->toggleBrandStatus($brandId, $status);
        $statusMsg = ($status == 'Active') ? ($this->lang->line('brandInactivated')) : ($this->lang->line('brandActivated'));
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $statusMsg . '</div>');
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/brandListShow'));
        return $objResponse;
    }

    public function brandDelete($brandId) {
        $this->access_control_model->check_access('Delete brand', __CLASS__, __FUNCTION__, 'functional');
        $this->product_model->brandDelete($brandId);
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('brandDeleted') . '</div>');
        redirect(site_url($this->config->item('controlPanel') . '/catalog/brandListShow'));
    }

    public function toggleBrandPublish($brandId, $status) {
        $this->access_control_model->check_access('toggleBrandPublish', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $statusToUpdate = $this->product_model->toggleBrandPublish($brandId, $status);
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/brandListShow'));
        return $objResponse;
    }

    public function deleteBrandImage($brandId, $brandImg) {
        $this->access_control_model->check_access('deleteBrandImage', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $statusToUpdate = $this->product_model->deleteBrandImage($brandId, $brandImg);
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/brandEdit/' . $brandId));
        return $objResponse;
    }

    /* brand End */

    /* Category Start */

    public function productCategoryListShow() {
        $this->access_control_model->check_access('List product category', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Product categories', site_url($this->config->item('controlPanel') . '/catalog/productCategoryListShow'));
        /* Breadcrumb End */

        $productCategories = $this->product_model->getProductCategoryList();
        $data['productCategories'] = $productCategories;
        $data['template'] = $this->config->item('controlPanel') . "/productCategoryList_view";
        $data['page_title'] = 'Product categories';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function addProductCategory() {
        $this->access_control_model->check_access('Add Product Category', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Product categories', site_url($this->config->item('controlPanel') . '/catalog/productCategoryListShow'));
        $this->breadcrumb->append_crumb('Add Category', site_url($this->config->item('controlPanel') . '/catalog/addProductCategory'));
        /* Breadcrumb End */
        $data = $this->productCategoryFormElement();

        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/productCategorySubmit');
        $data['attributes'] = array('name' => 'frmProductCategory', 'id' => 'frmProductCategory', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addProductCategory_view";
        $data['page_title'] = 'Add Product Category';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function productCategoryEdit($categoryId) {
        $this->access_control_model->check_access('Edit Product Category', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Product categories', site_url($this->config->item('controlPanel') . '/catalog/productCategoryListShow'));
        $this->breadcrumb->append_crumb('Edit Category', site_url($this->config->item('controlPanel') . '/catalog/productCategoryEdit'));
        /* Breadcrumb End */
        $data = $this->productCategoryFormElement($categoryId);

        $data['action'] = site_url($this->config->item('controlPanel') . '/product/productCategorySubmit');
        $data['attributes'] = array('name' => 'frmProductCategory', 'id' => 'frmProductCategory', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addProductCategory_view";
        $data['page_title'] = 'Edit Product Category';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function productCategorySubmit($formData) {
        $this->access_control_model->check_access('productCategorySubmit', __CLASS__, __FUNCTION__, 'basic');
        foreach ($formData as $id => $field) {
            $_POST[$id] = $field;
        }
        $objResponse = new xajaxResponse();
        if ($_POST['categoryId'] != '') {
            $response = $this->product_model->updateProductCategory();
        } else {
            $response = $this->product_model->insertProductCategory();
        }
        if ($response) {
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationSuccess') . '</div>');
            $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/productCategoryListShow'));
        } else {
            $objResponse->Assign("errorMsg", "innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
        }
        return $objResponse;
    }

    public function toggleProductCategoryStatus($categoryId, $status) {
        $this->access_control_model->check_access('toggleProductCategoryStatus', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $statusToUpdate = $this->product_model->toggleProductCategoryStatus($categoryId, $status);
        $statusMsg = ($status == 'Active') ? ($this->lang->line('productCategoryInactivated')) : ($this->lang->line('productCategoryActivated'));
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $statusMsg . '</div>');
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/productCategoryListShow'));
        return $objResponse;
    }

    public function productCategoryDelete($categoryId) {
        $this->access_control_model->check_access('Delete Product Category', __CLASS__, __FUNCTION__, 'functional');
        $response = $this->product_model->deleteProductCategory($categoryId);
        if ($response) {
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('productCategoryDeleted') . '</div>');
        } else {
            $this->session->set_flashdata('Msg', '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('productCategoryNotDeleted') . '</div>');
        }
        redirect(site_url($this->config->item('controlPanel') . '/catalog/productCategoryListShow'));        
    }

    public function manageProductCategories() {
        $this->access_control_model->check_access('Manage product category', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Product categories', site_url($this->config->item('controlPanel') . '/catalog/productCategoryListShow'));
        $this->breadcrumb->append_crumb('Category order', site_url($this->config->item('controlPanel') . '/catalog/manageProductCategories'));
        /* Breadcrumb End */

        $productCategories = $this->product_model->getProductCategoryTree();
        $data['productCategories'] = $productCategories;
        $data['template'] = $this->config->item('controlPanel') . "/manageProductCategories_view";
        $data['page_title'] = 'Manage category order';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function manageProductCategoriesSubmit($orderData) {
        $this->access_control_model->check_access('manageProductCategoriesSubmit', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $statusToUpdate = $this->product_model->updateProductCategoryOrder($orderData);
        $objResponse->Assign("errorMsg", "innerHTML", '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('productCategoryOrderSaved') . '</div>');
        return $objResponse;
    }

    /* Category End */
    
    /* Product Filter Start */

    public function prodFilterListShow($categoryId="") {
        $this->access_control_model->check_access('List Product Filters', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Product Filters', site_url($this->config->item('controlPanel') . '/catalog/prodFilterListShow'));
        /* Breadcrumb End */

        $prodFilters = $this->product_model->getProdFilterList($categoryId);
        //print_debug($prodFilters,__FILE__,__LINE__,1);
        $data['prodFiltersList'] = $prodFilters;
        $data['template'] = $this->config->item('controlPanel') . "/prodFiltersList_view";
        $data['page_title'] = 'Product Filters';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }
    
    public function addProdFilter() {
        $this->access_control_model->check_access('Add Product Filter', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Product Filter', site_url($this->config->item('controlPanel') . '/catalog/prodFilterListShow'));
        $this->breadcrumb->append_crumb('Add Product Filter', site_url($this->config->item('controlPanel') . '/catalog/addProdFilter'));
        /* Breadcrumb End */
        $data = $this->prodFilterFormElement();

        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/prodFilterSubmit');
        $data['attributes'] = array('name' => 'frmProdFilter', 'id' => 'frmProdFilter', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addProdFilter_view";
        $data['page_title'] = 'Add Product Filter';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }
    
    public function prodFilterEdit($filterId) {
        $this->access_control_model->check_access('Edit Product Filter', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Product Filter', site_url($this->config->item('controlPanel') . '/catalog/prodFilterListShow'));
        $this->breadcrumb->append_crumb('Edit Product Filter', site_url($this->config->item('controlPanel') . '/catalog/prodFilterEdit'));
        /* Breadcrumb End */
        $data = $this->prodFilterFormElement($filterId);

        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/prodFilterSubmit');
        $data['attributes'] = array('name' => 'frmProdFilter', 'id' => 'frmProdFilter', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addProdFilter_view";
        $data['page_title'] = 'Edit Product Filter';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }
    
    public function prodFilterSubmit($formData) {
        $this->access_control_model->check_access('prodFilterSubmit', __CLASS__, __FUNCTION__, 'basic');
        foreach ($formData as $id => $field) {
            $_POST[$id] = $field;
        }
        $objResponse = new xajaxResponse();
        if ($_POST['filterId'] != '') {
            $response = $this->product_model->updateProdFilter();
        } else {
            $response = $this->product_model->insertProdFilter();
        }
        if ($response) {
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationSuccess') . '</div>');
            $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/prodFilterListShow'));
        } else {
            $objResponse->Assign("errorMsg", "innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
        }
        return $objResponse;
    }
    
    public function toggleProdFilterStatus($filterId, $status) {
        $this->access_control_model->check_access('toggleProdFilterStatus', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $statusMsg = ($status == 'Active') ? ($this->lang->line('prodFilterInactivated')) : ($this->lang->line('prodFilterActivated'));
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $statusMsg . '</div>');
        $statusToUpdate = $this->product_model->toggleProdFilterStatus($filterId, $status);
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/prodFilterListShow'));
        return $objResponse;
    }
    
    public function prodFilterDelete($filterId) {
        $this->access_control_model->check_access('Delete Product Filter', __CLASS__, __FUNCTION__, 'functional');
        $this->product_model->prodFilterDelete($filterId);
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('prodFilterDeleted') . '</div>');
        redirect(site_url($this->config->item('controlPanel') . '/catalog/prodFilterListShow'));
    }
    
    public function getProductFilterType($categoryId,$extraOption) {
        $this->access_control_model->check_access('getProductFilterType', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $productFilterTypeArr = $this->common_model->getProductFilterType($categoryId,$extraOption);
        
        $sel_filterType['name'] = 'filterType';
        $sel_filterType['attribute'] = 'id = "filterType" data-rel="chosen"';
        $sel_filterType['options'] = $productFilterTypeArr;
        $sel_filterType['selected_filterType'] = (isset($prodFilterData['filterType'])) ? ($prodFilterData['filterType']) : ('');
        
        $filterTypeTxt = array(
            'name' => 'filterTypeTxt',
            'id' => 'filterTypeTxt',
            'value' => set_value('filterTypeTxt'),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $filterTypeSelect = form_dropdown($sel_filterType['name'],$sel_filterType['options'],$sel_filterType['selected_filterType'],$sel_filterType['attribute']);
        $filterTypeSelect .= "<br />".form_input($filterTypeTxt);
        $filterTypeSelect .= "<p class='help-block'>If filter type does not exist in select box, you can add new one using above text box.</p>";
        $objResponse->Script("$.uniform.update();");
        $objResponse->Assign("filterTypeHolder", "innerHTML", $filterTypeSelect);
        $objResponse->Script("$('#filterType').chosen();");
        return $objResponse;
    }
    
    
    public function productFilterAssociate($productId) {

        $this->access_control_model->check_access('Product Filter Associate', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Products', site_url($this->config->item('controlPanel') . '/catalog/productListShow'));
        $this->breadcrumb->append_crumb('Filters Associate', site_url($this->config->item('controlPanel') . '/catalog/productFilterAssociate'));
        /* Breadcrumb End */

        $data = $this->productFilterAssociateFormElement($productId);
        //print_debug($productCategories,__FILE__,__LINE__,1);
        $productFilters = $this->product_model->getProductFilters($productId);
        $assignedProductFilters = $this->product_model->getAssignedProductFilters($productId);

        $data['productFilters'] = $productFilters;
        $data['assignedProductFilters'] = $assignedProductFilters;

        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/productFilterAssociateSubmit');
        $data['attributes'] = array('name' => 'frmProductFilterAssociate', 'id' => 'frmProductFilterAssociate', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/productFilterAssociate_view";
        $data['page_title'] = 'Product Filter Associate';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function productFilterAssociateSubmit($formData) {
        $this->access_control_model->check_access('productFilterAssociateSubmit', __CLASS__, __FUNCTION__, 'basic');
        foreach ($formData as $id => $field) {
            $_POST[$id] = $field;
        }
        $objResponse = new xajaxResponse();
        $response = $this->product_model->updateProductFilterAssociate();
        if ($response) {
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationSuccess') . '</div>');
            $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/productListShow'));
        } else {
            $objResponse->Assign("errorMsg", "innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
        }
        return $objResponse;
    }
    
    /* */

    /* Product Filter Start */

    public function prodAttributeListShow() {
        $this->access_control_model->check_access('List Product Attributes', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Product Attribute', site_url($this->config->item('controlPanel') . '/catalog/prodAttributeListShow'));
        /* Breadcrumb End */

        $prodAttributes = $this->product_model->getProdAttributeList();
        //print_debug($prodAttributes,__FILE__,__LINE__,0);
        $data['prodAttributesList'] = $prodAttributes;
        $data['template'] = $this->config->item('controlPanel') . "/prodAttributesList_view";
        $data['page_title'] = 'Product Attributes';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function addProdAttribute() {
        $this->access_control_model->check_access('Add Product Attribute', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Product Attribute', site_url($this->config->item('controlPanel') . '/catalog/prodAttributeListShow'));
        $this->breadcrumb->append_crumb('Add Product Attribute', site_url($this->config->item('controlPanel') . '/catalog/addProdAttribute'));
        /* Breadcrumb End */
        $data = $this->prodAttributeFormElement();

        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/prodAttributeSubmit');
        $data['attributes'] = array('name' => 'frmProdAttribute', 'id' => 'frmProdAttribute', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addProdAttribute_view";
        $data['page_title'] = 'Add Product Attribute';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function prodAttributeEdit($attributeId) {
        $this->access_control_model->check_access('Edit Product Attribute', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Product Attribute', site_url($this->config->item('controlPanel') . '/catalog/prodAttributeListShow'));
        $this->breadcrumb->append_crumb('Edit Product Attribute', site_url($this->config->item('controlPanel') . '/catalog/prodAttributeEdit'));
        /* Breadcrumb End */
        $data = $this->prodAttributeFormElement($attributeId);

        $data['action'] = site_url($this->config->item('controlPanel') . '/product/prodAttributeSubmit');
        $data['attributes'] = array('name' => 'frmProdAttribute', 'id' => 'frmProdAttribute', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addProdAttribute_view";
        $data['page_title'] = 'Edit Product Attribute';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function prodAttributeSubmit($formData) {
        $this->access_control_model->check_access('prodAttributeSubmit', __CLASS__, __FUNCTION__, 'basic');
        foreach ($formData as $id => $field) {
            $_POST[$id] = $field;
        }
        $objResponse = new xajaxResponse();
        if ($_POST['attributeId'] != '') {
            $response = $this->product_model->updateProdAttribute();
        } else {
            $response = $this->product_model->insertProdAttribute();
        }
        if ($response) {
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationSuccess') . '</div>');
            $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/prodAttributeListShow'));
        } else {
            $objResponse->Assign("errorMsg", "innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
        }
        return $objResponse;
    }

    public function toggleProdAttributeStatus($attributeId, $status) {
        $this->access_control_model->check_access('toggleProdAttributeStatus', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $statusMsg = ($status == 'Active') ? ($this->lang->line('prodAttributeInactivated')) : ($this->lang->line('prodAttributeActivated'));
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $statusMsg . '</div>');
        $statusToUpdate = $this->product_model->toggleProdAttributeStatus($attributeId, $status);
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/prodAttributeListShow'));
        return $objResponse;
    }

    public function prodAttributeDelete($attributeId) {
        $this->access_control_model->check_access('Delete Product Attribute', __CLASS__, __FUNCTION__, 'functional');
        $this->product_model->prodAttributeDelete($attributeId);
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('prodAttributeDeleted') . '</div>');
        redirect(site_url($this->config->item('controlPanel') . '/catalog/prodAttributeListShow'));
    }

    /* Product Attribute End */
    
    /* Product Reviews Start */
    public function productReviewsListShow($productId) {
        $this->access_control_model->check_access('List Product Reviews', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Products', site_url($this->config->item('controlPanel') . '/catalog/productListShow'));
        $this->breadcrumb->append_crumb('Product Reviews', site_url($this->config->item('controlPanel') . '/catalog/productReviewsListShow'));
        /* Breadcrumb End */

        $productData = $this->product_model->getProduct($productId);
        if (count($productData) <= 0) {
            $this->access_control_model->access_deny();
        }

        $prodReviews = $this->product_model->getProductReviewsList($productId);
        //print_debug($prodReviews, __FILE__, __LINE__, 1);
        $data['productId'] = $productId;
        $data['prodReviewsList'] = $prodReviews;
        $data['template'] = $this->config->item('controlPanel') . "/prodReviewsList_view";
        $data['page_title'] = 'Product Reviews for <i><u>' . $productData['productName'] . '</u></i>';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }
    
    public function addProdReview($productId) {
        $this->access_control_model->check_access('Add Product Review', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Products', site_url($this->config->item('controlPanel') . '/catalog/productListShow'));
        $this->breadcrumb->append_crumb('Product Review', site_url($this->config->item('controlPanel') . '/catalog/productReviewsListShow/' . $productId));
        $this->breadcrumb->append_crumb('Add Product Review', site_url($this->config->item('controlPanel') . '/catalog/addProdReview'));
        /* Breadcrumb End */
        $productData = $this->product_model->getProduct($productId);
        if (count($productData) <= 0) {
            $this->access_control_model->access_deny();
        }

        $data = $this->prodReviewFormElement($productId);

        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/prodReviewSubmit');
        $data['attributes'] = array('name' => 'frmProdReview', 'id' => 'frmProdReview', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addProdReview_view";
        $data['page_title'] = 'Add Product Review for <i><u>' . $productData['productName'] . '</u></i>';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }
    
    public function prodReviewEdit($productId, $reviewId) {
        $this->access_control_model->check_access('Edit Product Review', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Products', site_url($this->config->item('controlPanel') . '/catalog/productListShow'));
        $this->breadcrumb->append_crumb('Product Review', site_url($this->config->item('controlPanel') . '/catalog/productReviewsListShow/' . $productId));
        $this->breadcrumb->append_crumb('Edit Product Review', site_url($this->config->item('controlPanel') . '/catalog/prodReviewEdit'));
        /* Breadcrumb End */
        $productData = $this->product_model->getProduct($productId);
        if (count($productData) <= 0) {
            $this->access_control_model->access_deny();
        }

        $data = $this->prodReviewFormElement($productId, $reviewId);

        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/prodReviewSubmit');
        $data['attributes'] = array('name' => 'frmProdReview', 'id' => 'frmProdReview', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addProdReview_view";
        $data['page_title'] = 'Edit Product Review for <i><u>' . $productData['productName'] . '</u></i>';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }
    
    public function prodReviewSubmit($formData) {
        $this->access_control_model->check_access('prodReviewSubmit', __CLASS__, __FUNCTION__, 'basic');
        foreach ($formData as $id => $field) {
            $_POST[$id] = $field;
        }
        $objResponse = new xajaxResponse();
        $productId = $_POST['productId'];
        if ($_POST['reviewId'] != '') {
            $response = $this->product_model->updateProdReview();
        } else {
            $response = $this->product_model->insertProdReview();
        }
        $response = true;
        if ($response) {
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationSuccess') . '</div>');
            $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/productReviewsListShow/' . $productId));
        } else {
            $objResponse->Assign("errorMsg", "innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
        }
        return $objResponse;
    }
    
    public function getCustomerByEmailAutoComplete(){
        if (isset($_GET['term'])){
                $term = $_GET['term'];
        }

        $customers = $this->product_model->getCustomerByEmailAutoComplete($term);
        $customers = json_encode($customers);
        print_r($customers); // print response to populate in drop down.
    }
    
    public function toggleProductReviewStatus($productId, $reviewId, $status) {
        $this->access_control_model->check_access('toggleProductReviewStatus', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $statusToUpdate = $this->product_model->toggleProductReviewStatus($reviewId, $status);
        $statusMsg = ($status == 'Active') ? ($this->lang->line('productReviewInactivated')) : ($this->lang->line('productReviewActivated'));
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $statusMsg . '</div>');
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/productReviewsListShow/' . $productId));
        return $objResponse;
    }
    
    public function prodReviewDelete($productId, $reviewId) {
        $this->access_control_model->check_access('Delete Product Review', __CLASS__, __FUNCTION__, 'functional');
        $this->product_model->prodReviewDelete($reviewId);
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('productReviewDeleted') . '</div>');
        redirect(site_url($this->config->item('controlPanel') . '/catalog/productReviewsListShow/' . $productId));
    }
    
    
    /* Product Reviews Start */

    /* Product Specification Start */
    public function productSpecificationListShow($productId) {
        $this->access_control_model->check_access('List Product Specification', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Product Specification', site_url($this->config->item('controlPanel') . '/catalog/productSpecificationListShow'));
        /* Breadcrumb End */

        $productData = $this->product_model->getProduct($productId);
        if (count($productData) <= 0) {
            $this->access_control_model->access_deny();
        }

        $prodSpecifications = $this->product_model->getProductSpecificationList($productId);

        $data['productId'] = $productId;
        $data['prodSpecificationsList'] = $prodSpecifications;
        $data['template'] = $this->config->item('controlPanel') . "/prodSpecificationsList_view";
        $data['page_title'] = 'Product Specifications for <i><u>' . $productData['productName'] . '</u></i>';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function addProdSpecification($productId) {
        $this->access_control_model->check_access('Add Product Specification', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Product Specification', site_url($this->config->item('controlPanel') . '/catalog/productSpecificationListShow/' . $productId));
        $this->breadcrumb->append_crumb('Add Product Specification', site_url($this->config->item('controlPanel') . '/catalog/addProdSpecification'));
        /* Breadcrumb End */
        $productData = $this->product_model->getProduct($productId);
        if (count($productData) <= 0) {
            $this->access_control_model->access_deny();
        }

        $data = $this->prodSpecificationFormElement($productId);

        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/prodSpecificationSubmit');
        $data['attributes'] = array('name' => 'frmProdSpecification', 'id' => 'frmProdSpecification', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addProdSpecification_view";
        $data['page_title'] = 'Add Product Specification for <i><u>' . $productData['productName'] . '</u></i>';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function prodSpecificationEdit($productId, $specificationId = '') {
        $this->access_control_model->check_access('Edit Product Specification', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Product Specification', site_url($this->config->item('controlPanel') . '/catalog/productSpecificationListShow/' . $productId));
        $this->breadcrumb->append_crumb('Edit Product Specification', site_url($this->config->item('controlPanel') . '/catalog/prodSpecificationEdit'));
        /* Breadcrumb End */

        $productData = $this->product_model->getProduct($productId);
        if (count($productData) <= 0) {
            $this->access_control_model->access_deny();
        }

        $data = $this->prodSpecificationFormElement($productId, $specificationId);

        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/prodSpecificationSubmit');
        $data['attributes'] = array('name' => 'frmProdSpecification', 'id' => 'frmProdSpecification', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addProdSpecification_view";
        $data['page_title'] = 'Edit Product Specification for <i><u>' . $productData['productName'] . '</u></i>';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function prodSpecificationSubmit($formData) {
        $this->access_control_model->check_access('prodSpecificationSubmit', __CLASS__, __FUNCTION__, 'basic');
        foreach ($formData as $id => $field) {
            $_POST[$id] = $field;
        }

        $objResponse = new xajaxResponse();
        $productId = $_POST['productId'];
        if ($_POST['specificationId'] != '') {
            $response = $this->product_model->updateProdSpecification();
        } else {
            $response = $this->product_model->insertProdSpecification();
        }
        if ($response) {
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationSuccess') . '</div>');
            $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/productSpecificationListShow/' . $productId));
        } else {
            $objResponse->Assign("errorMsg", "innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
        }
        return $objResponse;
    }

    public function prodSpecificationDelete($productId, $specificationId) {
        $this->access_control_model->check_access('Delete Product Specification', __CLASS__, __FUNCTION__, 'functional');
        $this->product_model->prodSpecificationDelete($specificationId);
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('prodSpecificationDeleted') . '</div>');
        redirect(site_url($this->config->item('controlPanel') . '/catalog/productSpecificationListShow/' . $productId));
    }

    public function getSpecLabelAutoComplete() {
        if (isset($_GET['term'])) {
            $term = $_GET['term'];
        }
        $customers = $this->product_model->getSpecLabelAutoComplete($term);
        $customers = json_encode($customers);
        print_r($customers); // print response to populate in drop down.
    }
    
public function uploadProdSpecXLS(){
        $userData = array();
        $indexArr = array();
        $fields = array();
                
        $productId = $this->input->post("productId");
        
        $xlsCongif = $this->config->item('xlsCongif');
              
        $fileData = $this->common_model->_uploadXLS();
             
        if(array_key_exists('product-specification.xls', $xlsCongif))
        {
        	$functionName = $xlsCongif['product-specification.xls']['function'];
        	//$functionName = $xlsCongif[$fileData['upload_data']['client_name']]['function'];
        	
            if($functionName == __FUNCTION__)
            {
                //$fields = $xlsCongif[$fileData['upload_data']['client_name']]['fields'];
                $fields = $xlsCongif['product-specification.xls']['fields'];
                $sheetData = $this->common_model->_readXlsFile($fileData['upload_data']['file_name']);
					
                //array_shift($sheetData);//TO REMOVE FIRST ELEMENT OF ARRAY
                //echo "<br>%%%%%%%%%%%%	In Con	%%%%%%%%%%%%";
                //var_dump($sheetData);
                //ToDo:Delete array null elements without loop
                //ToDo:get respective Category id
                $catId=1;      
                $errorMsg = $this->product_model->uploadProdSpecXLS($sheetData,$fields,$catId);
                
        
            }else{
                $errorMsg = $this->lang->line('invalidXlsFunctionName');
            }
        }else{
       
            $errorMsg = $this->lang->line('invalidXlsFileName');
        }       

        //die();
        
        $this->common_model->_deleteTempXlsFile($fileData['upload_data']['file_name']);
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">�</button>' . $errorMsg . '</div>');
        redirect(site_url($this->config->item('controlPanel') . '/catalog/productSpecificationListShow/' . $productId));
    }
    
    
 /* End By Sandy  */
    
    
    
    
    public function uploadProdMasterXLS(){
        $userData = array();
        $indexArr = array();
        $fields = array();
        $xlsCongif = $this->config->item('xlsCongif');
		//echo "<br>*********************XLSCONFIG***********************";
        //var_dump($xlsCongif);
         
        $fileData = $this->common_model->_uploadXLS();
        //echo "<br>*********************filedata***********************";
        //var_dump($fileData);
        
        
        if(array_key_exists('products-master.xls', $xlsCongif))
        {
            $functionName = $xlsCongif['products-master.xls']['function'];            
            if($functionName == __FUNCTION__){
                $fields = $xlsCongif['products-master.xls']['fields'];
                //echo "<br>*********************fields***********************";
                //var_dump($fields);
                $sheetData = $this->common_model->_readXlsFile($fileData['upload_data']['file_name']);
                
                
                
                $errorMsg = $this->product_model->uploadProdMasterXLS($sheetData,$fields);
                //echo "<br>********************* Msg ***********************";
                //var_dump($errorMsg);
            }else{
                $errorMsg = $this->lang->line('invalidXlsFunctionName');
            }            
        }else{
            $errorMsg = $this->lang->line('invalidXlsFileName');
        }
        //DIE();
        $this->common_model->_deleteTempXlsFile($fileData['upload_data']['file_name']);
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">�</button>' . $errorMsg . '</div>');
        redirect(site_url($this->config->item('controlPanel') . '/catalog/productListShow/'));
    }
    
    /* Product Specification End */

    /* Product Start */

    public function productListShow() {
        $this->access_control_model->check_access('List products', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Products', site_url($this->config->item('controlPanel') . '/catalog/productListShow'));
        /* Breadcrumb End */

        $products = $this->product_model->getProductList();
        //print_debug($products, __FILE__, __LINE__, 1);
        $data['productList'] = $products;
        $data['template'] = $this->config->item('controlPanel') . "/productList_view";
        $data['page_title'] = 'Product';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function addProduct() {
        $this->access_control_model->check_access('Add Product', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Products', site_url($this->config->item('controlPanel') . '/catalog/productListShow'));
        $this->breadcrumb->append_crumb('Add Product', site_url($this->config->item('controlPanel') . '/catalog/addProduct'));
        /* Breadcrumb End */
        $data = $this->productFormElement();
        $productCategories = $this->product_model->getProductCategoryTree();
        $data['assignedCategories'] = array();
        $data['productCategories'] = $productCategories;

        $data['action'] = site_url($this->config->item('controlPanel') . '/product/productSubmit');
        $data['attributes'] = array('name' => 'frmProduct', 'id' => 'frmProduct', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addProduct_view";
        $data['page_title'] = 'Add Product';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function productEdit($productId) {
        $this->access_control_model->check_access('Edit Product', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Products', site_url($this->config->item('controlPanel') . '/catalog/productListShow'));
        $this->breadcrumb->append_crumb('Edit Product', site_url($this->config->item('controlPanel') . '/catalog/addProduct'));
        /* Breadcrumb End */
        $data = $this->productFormElement($productId);
        $productCategories = $this->product_model->getProductCategoryTree();
        $assignedCategories = $this->product_model->getAssignedCategories($productId);

        $data['assignedCategories'] = $assignedCategories;
        $data['productCategories'] = $productCategories;


        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/productSubmit');
        $data['attributes'] = array('name' => 'frmProduct', 'id' => 'frmProduct', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addProduct_view";
        $data['page_title'] = 'Edit Product';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function productSubmit($formData) {
        $this->access_control_model->check_access('productSubmit', __CLASS__, __FUNCTION__, 'basic');
        foreach ($formData as $id => $field) {
            $_POST[$id] = $field;
        }
        $objResponse = new xajaxResponse();
        if ($_POST['productId'] != '') {
            $response = $this->product_model->updateProduct();
        } else {
            $response = $this->product_model->insertProduct();
        }
        if ($response) {
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationSuccess') . '</div>');
            $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/productListShow'));
        } else {
            $objResponse->Assign("errorMsg", "innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
        }
        return $objResponse;
    }

    public function isProductSKUAvailable($productCode) {
        $this->access_control_model->check_access('isProductCodeAvailable', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $isAvailable = $this->product_model->isProductSKUAvailable($productCode);
        if (!$isAvailable) {
            $objResponse->Script("messageBox();");
            $objResponse->Assign("errorMessage", "innerHTML", $this->lang->line('productSKUAlreadyInUse'));
            $objResponse->Assign("productSKU", "value", '');
            $objResponse->Script("$('#productSKU').focus();");
        }
        return $objResponse;
    }

    public function toggleProductStatus($productId, $status) {
        $this->access_control_model->check_access('toggleProductStatus', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $statusToUpdate = $this->product_model->toggleProductStatus($productId, $status);
        $statusMsg = ($status == 'Active') ? ($this->lang->line('productInactivated')) : ($this->lang->line('productActivated'));
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $statusMsg . '</div>');
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/productListShow'));
        return $objResponse;
    }

    public function deleteProduct($productId) {
        $this->access_control_model->check_access('Delete Product', __CLASS__, __FUNCTION__, 'functional');
        $this->product_model->deleteProduct($productId);
        $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('productDeleted') . '</div>');
        redirect(site_url($this->config->item('controlPanel') . '/catalog/productListShow'));
    }

    public function productMetadata($productId) {
        $this->access_control_model->check_access('Product Metadata', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Products', site_url($this->config->item('controlPanel') . '/catalog/productListShow'));
        $this->breadcrumb->append_crumb('Product Metadata', site_url($this->config->item('controlPanel') . '/catalog/productMetadata'));
        /* Breadcrumb End */
        $data = $this->productMetadataFormElement($productId);

        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/productMetadataSubmit');
        $data['attributes'] = array('name' => 'frmProductMetadata', 'id' => 'frmProductMetadata', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addProductMetadata_view";
        $data['page_title'] = 'Product Metadata';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function productMetadataSubmit($formData) {
        $this->access_control_model->check_access('productMetadataSubmit', __CLASS__, __FUNCTION__, 'basic');
        foreach ($formData as $id => $field) {
            $_POST[$id] = $field;
        }
        $objResponse = new xajaxResponse();
        if ($_POST['productId'] != '') {
            $response = $this->product_model->updateProductMetadata();
        }
        if ($response) {
            $this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationSuccess') . '</div>');
            $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/productListShow'));
        } else {
            $objResponse->Assign("errorMsg", "innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
        }
        return $objResponse;
    }

    public function photoGallery($productId) {
        $this->access_control_model->check_access('Product Photo gallery', __CLASS__, __FUNCTION__, 'functional');

        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Products', site_url($this->config->item('controlPanel') . '/catalog/productListShow'));
        $this->breadcrumb->append_crumb('Gallery', site_url($this->config->item('controlPanel') . '/catalog/photoGallery'));
        /* Breadcrumb End */

        $productData = $this->product_model->getProduct($productId);
        $data['productId'] = $productId;
        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/photoGallerySubmit/' . $productId);
        $data['attributes'] = array('name' => 'frmProduct', 'id' => 'frmProduct', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/productGallery_view";
        $data['page_title'] = 'Image gallery';
        $data['product_name'] = $productData['productName'];
        //print_r($data);
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }

    public function photoGallerySubmit($target_code = '') {
        $upload_dir = getcwd() . "/uploads/";
        $upload_url = base_url() . "uploads/";
        $uploadTarget = 'products';

        $upload_handler = new UploadHandler('', $upload_dir, $upload_url, $uploadTarget, $target_code);

        header('Pragma: no-cache');
        header('Cache-Control: private, no-cache');
        header('Content-Disposition: inline; filename="files.json"');

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'HEAD':
            case 'GET':
                $upload_handler->get();
                break;
            case 'POST':
                $upload_handler->post();
                break;
            case 'DELETE':
                $upload_handler->delete();
                break;
            case 'MAINIMG':
                $upload_handler->mainImg();
                break;
            default:
                header('HTTP/1.0 405 Method Not Allowed');
        }
    }

    public function setMainImg($productId, $image) {
        $this->access_control_model->check_access('setMainImg', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $this->product_model->setMainImg($productId, $image);
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/photoGallery/' . $productId));
        return $objResponse;
    }

    public function deleteImg($productId, $image) {
        $this->access_control_model->check_access('deleteImg', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $this->product_model->deleteImg($productId, $image);
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/photoGallery/' . $productId));
        return $objResponse;
    }
    
    public function getProdColorAutoComplete() {
        if (isset($_GET['term'])) {
            $term = $_GET['term'];
        }
        $prodColors = $this->product_model->getProdColorAutoComplete($term);
        $prodColors = json_encode($prodColors);
        print_r($prodColors); // print response to populate in drop down.
    }
    
    public function getProdVariantAutoComplete() {
        if (isset($_GET['term'])) {
            $term = $_GET['term'];
        }
        $variants = $this->product_model->getProdVariantAutoComplete($term);
        $variants = json_encode($variants);
        print_r($variants); // print response to populate in drop down.
    }
    
    public function toggleHomePublish($productId, $status) {
        $this->access_control_model->check_access('toggleHomePublish', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $statusToUpdate = $this->product_model->toggleHomePublish($productId, $status);
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/catalog/productListShow'));
        return $objResponse;
    }
    /* Product End */
    
    /* Store products Start */
    public function searchStoreProducts()
    {
        $this->access_control_model->check_access('Search Store Products', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Search Result', site_url($this->config->item('controlPanel') . '/catalog/searchStoreProducts'));
        /* Breadcrumb End */
        //$data = $this->brandFormElement();

        $products = $this->product_model->getSearchProductsBy();
        
        $data['searchProducts'] = $products;
        $data['selectedStoreProducts'] = $this->session->userdata('selectedStoreProducts');
        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/addStoreProducts');
        $data['attributes'] = array('name' => 'frmStoreProducts', 'id' => 'frmStoreProducts', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/searchStoreProducts_view";
        $data['page_title'] = 'Search Results';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }
    
    public function selectStoreProducts($productId, $targetAction) {
        $this->access_control_model->check_access('selectStoreProducts', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        
        $selectedStoreProducts = $this->session->userdata('selectedStoreProducts');
        if($targetAction=="push"){
            $selectedStoreProducts[$productId] = $productId;
            $msg = "Product pushed in basket.";
            $type = 'success';
        }elseif($targetAction=="pop"){
            unset($selectedStoreProducts[$productId]);
            $msg = "Product removed from basket.";
            $type = 'error';
        }
        $session_data['selectedStoreProducts'] = $selectedStoreProducts;
        $this->session->set_userdata($session_data);
        $sJS = "noty({text: '".$msg."',layout:'bottomRight',type:'".$type."', animateOpen: {'opacity': 'show'}});";
        $objResponse->script($sJS);
        
        if(count($selectedStoreProducts) > 0){
            $objResponse->script("$(btnSubmit).show();");
        }else{
            $objResponse->script("$(btnSubmit).hide();");
        }
        
        return $objResponse;
    }
    
    public function addStoreProducts()
    {
        $this->access_control_model->check_access('Search Store Products', __CLASS__, __FUNCTION__, 'functional');
        /* Breadcrumb Start */
        $this->breadcrumb->append_crumb('Dashboard', site_url($this->config->item('controlPanel') . '/dashboard'));
        $this->breadcrumb->append_crumb('Add Store Products', site_url($this->config->item('controlPanel') . '/catalog/addStoreProducts'));
        /* Breadcrumb End */
        //$data = $this->brandFormElement();
        
        if($this->session->userdata('sysuser_type')=='system'){
            $agencyArr = $this->common_model->get_agencies(1);
            $data['agencyArr'] = $agencyArr;
            $stores = array();
            //$this->store_model->getStores($storeUser['agencyId']);
        }else{
            $storeAgencyId = $this->session->userdata('storeAgencyId');
            $storeUserId = $this->session->userdata('storeUserId');
            $stores = $this->store_model->getUserStores($storeUserId);
            $data['storesArr'] = $stores;
            $data['agency'] = $storeAgencyId;            
        }
        
        //print_debug($agencyArr, __FILE__, __LINE__, 1);
        $productSelection = $this->session->userdata('selectedStoreProducts');
        $selectedStoreProducts = $this->product_model->getSelectedProducts($productSelection);
        //print_debug($agencyArr, __FILE__, __LINE__, 0);
        $data['selectedStoreProducts'] = $selectedStoreProducts;
        
        $data['action'] = site_url($this->config->item('controlPanel') . '/catalog/addStoreProductsSubmit');
        $data['attributes'] = array('name' => 'frmAddStoreProducts', 'id' => 'frmAddStoreProducts', 'class' => 'form-horizontal');
        $data['template'] = $this->config->item('controlPanel') . "/addStoreProducts_view";
        $data['page_title'] = 'Add Store Products';
        $temp['data'] = $data;
        $this->load->view($this->config->item('controlPanel') . "/common_view", $temp);
    }
    
    public function addStoreProductsSubmit($formData)
    {
        $this->access_control_model->check_access('addStoreProductsSubmit', __CLASS__, __FUNCTION__, 'basic');
        $response = false;
        foreach ($formData as $id => $field) {
            $_POST[$id] = $field;
        }
        $objResponse = new xajaxResponse();
        $response = $this->product_model->insertStoreProducts();
        if ($response) {
            $msg = $this->lang->line('operationSuccess');
            $sJS = "noty({text: '".$msg."',layout:'top',type:'success', animateOpen: {'opacity': 'show'}});";
        } else {
            $msg = $this->lang->line('operationFail');
            $sJS = "noty({text: '".$msg."',layout:'top',type:'error', animateOpen: {'opacity': 'show'}});";
        }
        $objResponse->script($sJS);
        $objResponse->redirect(site_url($this->config->item('controlPanel') . '/store/'));
        return $objResponse;
    }
    
    public function getAgencyStores($agencyId) {
        $this->access_control_model->check_access('getAgencyStores', __CLASS__, __FUNCTION__, 'basic');
        $objResponse = new xajaxResponse();
        $storeArr = $this->store_model->getStores($agencyId);
        
        $areaSelect = '<select id = "storeIds" class="multiselect" multiple="multiple" name = "storeIds[]">';
        foreach ($storeArr as $storeId => $storeName){
            $areaSelect .= '<option value="'.$storeId.'">'.$storeName.'</option>';
        }
        $areaSelect .= '</select>';
        $objResponse->Script("$('#storeSelect').show();");
        $objResponse->Script("$.uniform.update();");
        $objResponse->Assign("storeHolder", "innerHTML", $areaSelect);
        $objResponse->Script("$('#storeIds').chosen();");
        
        
        return $objResponse;
    }


    /* Store products Ends*/

    /* Form Element Start */

    public function brandFormElement($brandId = '') {
        $brand = array();
        if ($brandId != '') {
            $brand = $this->product_model->getBrand($brandId);
            $data['brandId'] = $brand['brandId'];
            $data['brandLogo'] = $brand['brandImg'];
        } else {
            $data['brandId'] = '';
            $data['brandLogo'] = '';
        }

        $data['brandName'] = array(
            'name' => 'brandName',
            'id' => 'brandName',
            'value' => (isset($brand['brandName'])) ? ($brand['brandName']) : (set_value('brandName')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );

        $data['brandImg'] = array(
            'name' => 'brandImg',
            'id' => 'brandImg',
            'value' => (isset($brand['brandImg'])) ? ($brand['brandImg']) : (set_value('brandImg')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-file uniform_on focused'
        );

        $data['sel_status']['name'] = 'status';
        $data['sel_status']['attribute'] = 'id = "status" data-rel="chosen"';
        $data['sel_status']['options'] = array(
            'Active' => 'Active',
            'Inactive' => 'Inactive'
        );
        $data['sel_status']['selected_status'] = (isset($brand['status'])) ? ($brand['status']) : ('Active');
        return $data;
    }

    public function productCategoryFormElement($categoryId = '') {
        $productCategories = array();
        $productCategory = array();
        $productCategories = $this->product_model->getProductCategoryTree();
        if ($categoryId != '') {
            $productCategory = $this->product_model->getProductCategory($categoryId);
            $data['categoryId'] = $productCategory['categoryId'];
            $data['parentId'] = $productCategory['parentId'];
        } else {
            $data['categoryId'] = '';
            $data['parentId'] = '0';
        }
        $data['categoryName'] = array(
            'name' => 'categoryName',
            'id' => 'categoryName',
            'value' => (isset($productCategory['categoryName'])) ? ($productCategory['categoryName']) : (set_value('categoryName')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['sel_status']['name'] = 'status';
        $data['sel_status']['attribute'] = 'id = "status" data-rel="chosen"';
        $data['sel_status']['options'] = array(
            'Active' => 'Active',
            'Inactive' => 'Inactive'
        );
        $data['sel_status']['selected_status'] = (isset($productCategory['status'])) ? ($productCategory['status']) : ('Active');
        $data['productCategories'] = $productCategories;
        return $data;
    }

    public function prodAttributeFormElement($attributeId = '') {
        $productAttributeType = $this->common_model->getProductAttributeType(1);

        $prodAttributeData = array();
        if ($attributeId != '') {
            $prodAttributeData = $this->product_model->getProdAttribute($attributeId);
            $data['attributeId'] = $prodAttributeData['attributeId'];
        } else {
            $data['attributeId'] = '';
        }

        $data['attributeTypeTxt'] = array(
            'name' => 'attributeTypeTxt',
            'id' => 'attributeTypeTxt',
            'value' => set_value('attributeTypeTxt'),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );

        $data['attributeValue'] = array(
            'name' => 'attributeValue',
            'id' => 'attributeValue',
            'value' => (isset($prodAttributeData['attributeValue'])) ? ($prodAttributeData['attributeValue']) : (set_value('attributeValue')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );

        $data['sel_attributeType']['name'] = 'attributeType';
        $data['sel_attributeType']['attribute'] = 'id = "attributeType" data-rel="chosen"';
        $data['sel_attributeType']['options'] = $productAttributeType;
        $data['sel_attributeType']['selected_status'] = (isset($prodAttributeData['attributeType'])) ? ($prodAttributeData['attributeType']) : ('');

        $data['sel_status']['name'] = 'status';
        $data['sel_status']['attribute'] = 'id = "status" data-rel="chosen"';
        $data['sel_status']['options'] = array(
            'Active' => 'Active',
            'Inactive' => 'Inactive'
        );
        $data['sel_status']['selected_status'] = (isset($prodAttributeData['status'])) ? ($prodAttributeData['status']) : ('Active');
        return $data;
    }

    public function prodSpecificationFormElement($productId, $specificationId = '') {
        $productSpecificationGroup = $this->common_model->getProductSpecificationGroup(1);
        $data['productId'] = $productId;
        $prodSpecificationData = array();
        if ($specificationId != '') {
            $prodSpecificationData = $this->product_model->getProdSpecification($specificationId);
            if ($productId != $prodSpecificationData['productId']) {
                $this->access_control_model->access_deny();
            }
            $data['specificationId'] = $prodSpecificationData['specificationId'];
        } else {
            $data['specificationId'] = '';
        }

        $data['editSpecGroup'] = array(
            'name' => 'editSpecGroup',
            'id' => 'editSpecGroup',
            'value' => '1',
            'checked' => FALSE,
            'class' => 'input-xlarge focused'
        );

        $data['specificationGroupTxt'] = array(
            'name' => 'specificationGroupTxt',
            'id' => 'specificationGroupTxt',
            'value' => set_value('specificationGroupTxt'),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );

        $data['specLabel'] = array(
            'name' => 'specLabel',
            'id' => 'specLabel',
            'value' => (isset($prodSpecificationData['specLabel'])) ? ($prodSpecificationData['specLabel']) : (set_value('specLabel')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );

        $data['specValue'] = array(
            'name' => 'specValue',
            'id' => 'specValue',
            'value' => (isset($prodSpecificationData['specValue'])) ? ($prodSpecificationData['specValue']) : (set_value('specValue')),
            'maxlength' => '255',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );

        $data['sel_specificationGroup']['name'] = 'specificationGroup';
        $data['sel_specificationGroup']['attribute'] = 'id = "specificationGroup" data-rel="chosen"';
        $data['sel_specificationGroup']['options'] = $productSpecificationGroup;
        $data['sel_specificationGroup']['selected_status'] = (isset($prodSpecificationData['groupId'])) ? ($prodSpecificationData['groupId']) : ('');
        return $data;
    }

    public function productFormElement($productId = '') {

        $brandArr = $this->common_model->getBrands(1);

        $productCategories = array();
        $product = array();
        if ($productId != '') {
            $product = $this->product_model->getProduct($productId);
            //print_debug($product);exit;
            $data['productId'] = $product['productId'];
            $data['productImg'] = (isset($product['productImg'])) ? ($product['productImg']) : ('');
        } else {
            $data['productId'] = '';
            $data['productImg'] = '';
        }
        if ($productId != '') {
            $data['productSKU'] = array(
                'name' => 'productSKU',
                'id' => 'productSKU',
                'value' => (isset($product['productSKU'])) ? ($product['productSKU']) : (set_value('productSKU')),
                'maxlength' => '25',
                'size' => '20',
                'class' => 'input-xlarge focused',
                'readonly' => 'readonly'
            );
        } else {
            $data['productSKU'] = array(
                'name' => 'productSKU',
                'id' => 'productSKU',
                'value' => (isset($product['productSKU'])) ? ($product['productSKU']) : (set_value('productSKU')),
                'maxlength' => '25',
                'size' => '20',
                'class' => 'input-xlarge focused',
                'onBlur' => 'xajax_isProductSKUAvailable(this.value)'
            );
        }

        $data['productName'] = array(
            'name' => 'productName',
            'id' => 'productName',
            'value' => (isset($product['productName'])) ? ($product['productName']) : (set_value('productName')),
            'maxlength' => '255',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['productMRP'] = array(
            'name' => 'productMRP',
            'id' => 'productMRP',
            'value' => (isset($product['productMRP'])) ? ($product['productMRP']) : (set_value('productMRP')),
            'maxlength' => '10',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['productDP'] = array(
            'name' => 'productDP',
            'id' => 'productDP',
            'value' => (isset($product['productDP'])) ? ($product['productDP']) : (set_value('productDP')),
            'maxlength' => '3',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['productModel'] = array(
            'name' => 'productModel',
            'id' => 'productModel',
            'value' => (isset($product['productModel'])) ? ($product['productModel']) : (set_value('productModel')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['productVariant'] = array(
            'name' => 'productVariant',
            'id' => 'productVariant',
            'value' => (isset($product['productVariant'])) ? ($product['productVariant']) : (set_value('productVariant')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['productColor'] = array(
            'name' => 'productColor',
            'id' => 'productColor',
            'value' => (isset($product['productColor'])) ? ($product['productColor']) : (set_value('productColor')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['productDesc'] = array(
            'name' => 'productDesc',
            'id' => 'productDesc',
            'value' => (isset($product['productDesc'])) ? ($product['productDesc']) : (set_value('productDesc')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'cleditor'
        );
        
        $data['productFeatures'] = array(
            'name' => 'productFeatures',
            'id' => 'productFeatures',
            'value' => (isset($product['productFeatures'])) ? ($product['productFeatures']) : (set_value('productFeatures')),
            'class' => 'input-xxlarge autogrow'
        );

        $data['sel_brand']['name'] = 'brand';
        $data['sel_brand']['attribute'] = 'id = "brand" data-rel="chosen"';
        $data['sel_brand']['options'] = $brandArr;
        $data['sel_brand']['selected_brand'] = (isset($product['brandId'])) ? ($product['brandId']) : ('');

        $data['sel_status']['name'] = 'status';
        $data['sel_status']['attribute'] = 'id = "status" data-rel="chosen"';
        $data['sel_status']['options'] = array(
            'Active' => 'Active',
            'Inactive' => 'Inactive'
        );
        $data['sel_status']['selected_status'] = (isset($product['status'])) ? ($product['status']) : ('Active');
        return $data;
    }

    public function productMetadataFormElement($productId) {

        $product = array();
        if ($productId != '') {
            $product = $this->product_model->getProduct($productId);
            $productMeta = $this->product_model->getProductMeta($productId);
            $data['productId'] = $product['productId'];
        }

        $data['productName'] = array(
            'name' => 'productName',
            'id' => 'productName',
            'value' => (isset($product['productName'])) ? ($product['productName']) : (set_value('productName')),
            'maxlength' => '255',
            'size' => '20',
            'class' => 'input-xlarge focused',
            'readonly' => 'readonly'
        );
        $data['pageTitle'] = array(
            'name' => 'pageTitle',
            'id' => 'pageTitle',
            'value' => (isset($productMeta['pageTitle'])) ? ($productMeta['pageTitle']) : (set_value('productModel')),
            'maxlength' => '255',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        $data['metaKeyword'] = array(
            'name' => 'metaKeyword',
            'id' => 'metaKeyword',
            'value' => (isset($productMeta['metaKeyword'])) ? ($productMeta['metaKeyword']) : (set_value('metaKeyword')),
            'class' => 'input-xxlarge autogrow'
        );
        $data['metaDesc'] = array(
            'name' => 'metaDesc',
            'id' => 'metaDesc',
            'value' => (isset($productMeta['metaDesc'])) ? ($productMeta['metaDesc']) : (set_value('metaDesc')),
            'class' => 'input-xxlarge autogrow'
        );
        return $data;
    }
    
    public function prodFilterFormElement($filterId = '') {
        
        $productFilterType = array();
        $productCategories = array();
        $productCategories = $this->product_model->getProductCategoryTree();

        $prodFilterData = array();
        if ($filterId != '') {
            $prodFilterData = $this->product_model->getProdFilter($filterId);
            $categoryId = $prodFilterData['categoryId'];
            $productFilterType = $this->common_model->getProductFilterType($categoryId,1);
            $data['filterId'] = $prodFilterData['filterId'];
            $data['categoryId'] = $categoryId;
        } else {
            $data['filterId'] = '';
            $data['categoryId'] = '';
        }
        
        $data['editFilterType'] = array(
            'name' => 'editFilterType',
            'id' => 'editFilterType',
            'value' => '1',
            'checked' => FALSE,
            'class' => 'input-xlarge focused'
        );

        $data['productCategories'] = $productCategories;
        $data['filterTypeTxt'] = array(
            'name' => 'filterTypeTxt',
            'id' => 'filterTypeTxt',
            'value' => set_value('filterTypeTxt'),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );

        $data['filterValue'] = array(
            'name' => 'filterValue',
            'id' => 'filterValue',
            'value' => (isset($prodFilterData['filterValue'])) ? ($prodFilterData['filterValue']) : (set_value('filterValue')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );

        $data['sel_filterType']['name'] = 'filterType';
        $data['sel_filterType']['filter'] = 'id = "filterType" data-rel="chosen"';
        $data['sel_filterType']['options'] = $productFilterType;
        $data['sel_filterType']['selected_status'] = (isset($prodFilterData['filterType'])) ? ($prodFilterData['filterType']) : ('');

        $data['sel_status']['name'] = 'status';
        $data['sel_status']['filter'] = 'id = "status" data-rel="chosen"';
        $data['sel_status']['options'] = array(
            'Active' => 'Active',
            'Inactive' => 'Inactive'
        );
        $data['sel_status']['selected_status'] = (isset($prodFilterData['status'])) ? ($prodFilterData['status']) : ('Active');
        return $data;
    }
    
    public function productFilterAssociateFormElement($productId = '') {
        $product = array();
        $product = $this->product_model->getProduct($productId);
        //print_r($product);exit;
        $data['productId'] = $product['productId'];

        $data['productName'] = array(
            'name' => 'productName',
            'id' => 'productName',
            'value' => (isset($product['productName'])) ? ($product['productName']) : (set_value('productName')),
            'maxlength' => '255',
            'size' => '20',
            'class' => 'input-xlarge focused',
            'readonly' => 'readonly'
        );
        return $data;
    }
    
    public function prodReviewFormElement($productId, $reviewId = '') {

        $prodReview = array();
        if ($reviewId != '') {
            $prodReview = $this->product_model->getProdReview($reviewId);
            $data['productId'] = $prodReview['productId'];        
            $data['reviewId'] = $reviewId;            
            $data['customerId'] = $prodReview['customerId'];
            $data['rating'] = $prodReview['rating'];
        } else {
            $data['productId'] = $productId;
            $data['reviewId'] = '';
            $data['rating'] = '1';
            $data['customerId'] = set_value('customerId');
        }
        
        $data['reviewTitle'] = array(
            'name' => 'reviewTitle',
            'id' => 'reviewTitle',
            'value' => (isset($prodReview['reviewTitle'])) ? ($prodReview['reviewTitle']) : (set_value('reviewTitle')),
            'maxlength' => '255',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['custEmail'] = array(
            'name' => 'custEmail',
            'id' => 'custEmail',
            'value' => (isset($prodReview['custEmail'])) ? ($prodReview['custEmail']) : (set_value('custEmail')),
            'maxlength' => '100',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['usefull'] = array(
            'name' => 'usefull',
            'id' => 'usefull',
            'value' => (isset($prodReview['usefull'])) ? ($prodReview['usefull']) : (set_value('usefull')),
            'maxlength' => '5',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['notUsefull'] = array(
            'name' => 'notUsefull',
            'id' => 'notUsefull',
            'value' => (isset($prodReview['notUsefull'])) ? ($prodReview['notUsefull']) : (set_value('notUsefull')),
            'maxlength' => '5',
            'size' => '20',
            'class' => 'input-xlarge focused'
        );
        
        $data['reviewDesc'] = array(
            'name' => 'reviewDesc',
            'id' => 'reviewDesc',
            'value' => (isset($prodReview['reviewDesc'])) ? ($prodReview['reviewDesc']) : (set_value('reviewDesc')),
            'size' => '20',
            'class' => 'cleditor'
        );
        
        $data['sel_status']['name'] = 'status';
        $data['sel_status']['attribute'] = 'id = "status" data-rel="chosen"';
        $data['sel_status']['options'] = array(
            'Active' => 'Active',
            'Inactive' => 'Inactive'
        );
        $data['sel_status']['selected_status'] = (isset($prodReview['status'])) ? ($prodReview['status']) : ('Active');
        return $data;
    }

    /* Form element End */
}

?>
