<?php

class Product_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
    }

    /**
     * 
     * @return type city array
     */
    function getCityList() {
        $cityList = array();
        $this->db->where('ct.status != ', 'Delete');
        $this->db->select('ct.*,cn.countryName');
        $this->db->from('cities as ct');
        $this->db->join('countries as cn', 'cn.countryId = ct.countryId', 'left');
        $this->db->order_by('cityName', 'ASC');
        $query = $this->db->get();
        $cityList = $query->result();
        return $cityList;
    }

    public function getCity($cityId) {
        $table_name = "cities";
        $this->db->where('cityId', $cityId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }
    
    function getCities($extraOption = '0') {
        $cities = ($extraOption == '1') ? (array('' => 'Select city')) : (array());
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $this->db->order_by('cityName', 'ASC');
        $query = $this->db->get('cities');
        foreach ($query->result() as $row){
                $cities[$row->cityId] = $row->cityName;
        };
        return $cities;
    }
    
    function toggleCityStatus($cityId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('cityId', $cityId);
        $this->db->update('cities', $data);
        return $statusToUpdate;
    }
    
    function cityDelete($cityId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('cityId', $cityId);
        $this->db->update('cities', $data);
        return true;
    }
    
    function insertCity() {
        $userData['cityName'] = $this->input->post('cityName');
        $userData['countryId'] = $this->input->post('countryName');
        $userData['latitude'] = $this->input->post('latitude');
        $userData['longitude'] = $this->input->post('longitude');
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('cities', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateCity() {
        $cityId = $this->input->post('cityId');
        $userData['cityName'] = $this->input->post('cityName');
        $userData['countryId'] = $this->input->post('countryName');
        $userData['latitude'] = $this->input->post('latitude');
        $userData['longitude'] = $this->input->post('longitude');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('cityId', $cityId);
        $this->db->update('cities', $userData);
        return true;
    }
    
    function getAreaList() {
        $areaList = array();
        $this->db->where('a.status != ', 'Delete');
        $this->db->select('a.*,ct.cityName');
        $this->db->from('areas as a');
        $this->db->join('cities as ct', 'ct.cityId = a.cityId','left');
        $this->db->order_by('a.areaName', 'ASC');
        $query = $this->db->get();
        $areaList = $query->result();
        return $areaList;
    }
    
    public function getArea($areaId) {
        $table_name = "areas";
        $this->db->where('areaId', $areaId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }
    
    public function getMinorAreas($cityId) {
        $data = array();
        $table_name = "areas";
        $this->db->where('cityId', $cityId);
        $this->db->where('isMajor', '0');
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        foreach ($query->result() as $row){
             $data[$row->areaId] = $row->areaName;
        }
        return $data;
    }
    
    public function getAssociatedAreas($areaId)
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('areaId', $areaId);
        $query = $this->db->get('area_has_subareas');
        foreach ($query->result() as $row){
                $data[] = $row->subAreaId;
        }
        return $data;
    }
    
    function toggleAreaStatus($areaId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('areaId', $areaId);
        $this->db->update('areas', $data);
        return $statusToUpdate;
    }
    
    function areaDelete($areaId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('areaId', $areaId);
        $this->db->update('areas', $data);
        return true;
    }
    
    function insertArea() {
        $userData['areaName'] = $this->input->post('areaName');
        $userData['cityId'] = $this->input->post('cityName');
        $userData['latitude'] = $this->input->post('latitude');
        $userData['longitude'] = $this->input->post('longitude');
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('areas', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateArea() {
        $areaId = $this->input->post('areaId');
        $userData['areaName'] = $this->input->post('areaName');
        $userData['cityId'] = $this->input->post('cityName');
        $userData['latitude'] = $this->input->post('latitude');
        $userData['longitude'] = $this->input->post('longitude');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('areaId', $areaId);
        $this->db->update('areas', $userData);
        return true;
    }
    
    function toggleAreaMajor($areaId, $status) {
        $statusToUpdate = ($status == '1') ? ('0') : ('1');
        $data = array(
            'isMajor' => $statusToUpdate,
        );
        $this->db->where('areaId', $areaId);
        $this->db->update('areas', $data);
        
        $this->db->where('subAreaId', $areaId);
        $this->db->delete('area_has_subareas');
        
        return $statusToUpdate;
    }
    
    
    function getBrandList() {
        $brandList = array();
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $this->db->from('brands');
        $this->db->order_by('brandName', 'ASC');
        $query = $this->db->get();
        $brandList = $query->result();
        return $brandList;
    }
    
    public function getBrand($brandId) {
        $table_name = "brands";
        $this->db->where('brandId', $brandId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }

    
    function toggleBrandStatus($brandId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('brandId', $brandId);
        $this->db->update('brands', $data);
        return $statusToUpdate;
    }
    
    function brandDelete($brandId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('brandId', $brandId);
        $this->db->update('brands', $data);
        return true;
    }
    
    function insertBrand($fileName) {
        $userData['brandName'] = $this->input->post('brandName');
        $userData['brandImg'] = $fileName;
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('brands', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateBrand($fileName) {
        $brandId = $this->input->post('brandId');
        $userData['brandName'] = $this->input->post('brandName');
        $userData['brandImg'] = $fileName;
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('brandId', $brandId);
        $this->db->update('brands', $userData);
        return true;
    }
    
    function getCategories() {
        $categoryList = array();
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $this->db->from('categories');
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $categoryList[$row->categoryId] = $row->categoryName;
        }
        return $categoryList;
    }
    
    function getProductCategoryList() {
        $categoryList = array();
        $this->db->where('mc.status != ', 'Delete');
        $this->db->select('mc.categoryId,mc.categoryName,mc.parentId,mc.status,mc.catSeq,mpc.categoryName as parentCatName');
        $this->db->from('categories as mc');
        $this->db->join('categories as mpc', 'mpc.categoryId = mc.parentId', 'left');
        $this->db->order_by('mc.catSeq', 'DESC');
        $query = $this->db->get();
        $categoryList = $query->result();
        return $categoryList;
    }
    
    function getProductCategoryTree($parent_menu = '0') {
        error_reporting(0);
        $menu = array();
        $this->db->where('parentId', $parent_menu);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $this->db->order_by('catSeq asc');
        $query = $this->db->get('categories');
        $j = 0;
        foreach ($query->result() as $row) {
            $menu[$j]['categoryId'] = $row->categoryId;
            $menu[$j]['parentId'] = $row->parentId;
            $menu[$j]['name'] = $row->categoryName;
            $menu[$j]['submenus'] = $this->getProductCategoryTree($row->categoryId);
            $j++;
        }
        return $menu;
    }
    
    function insertProductCategory() {
        $userData['categoryName'] = $this->input->post('categoryName');
        $userData['parentId'] = $this->input->post('parentCatId');
        $userData['status'] = $this->input->post('status');
        if ($this->db->insert('categories', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateProductCategory() {
        $categoryId = $this->input->post('categoryId');
        $userData['categoryName'] = $this->input->post('categoryName');
        $userData['parentId'] = $this->input->post('parentCatId');
        $userData['status'] = $this->input->post('status');
        $this->db->where('categoryId', $categoryId);
        $this->db->update('categories', $userData);
        return true;
    }
    
    public function getProductCategory($categoryId) {
        $table_name = "categories";
        $this->db->where('categoryId', $categoryId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }
    
    function toggleProductCategoryStatus($categoryId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('categoryId', $categoryId);
        $this->db->update('categories', $data);
        return $statusToUpdate;
    }
    
    function deleteProductCategory($categoryId) {
        $isParent = $this->isParent($categoryId);
        
        if($isParent==0){
            $data = array(
                'status' => 'Delete',
            );
            $this->db->where('categoryId', $categoryId);
            $this->db->update('categories', $data);
            return true;
        }else{
            return false;
        }        
    }
    
    function isParent($categoryId){
        $table_name = "categories";
        $this->db->where('parentId', $categoryId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return $query->num_rows();
    }


    function updateProductCategoryOrder($orderData) {
        if (is_array($orderData)) {
            $this->saveCategoryOrder($orderData);
            return true;
        } else {
            return false;
        }
    }
    
    function saveCategoryOrder($orderData, $parentId = '0') {
        $userData = array();
        foreach ($orderData as $orderKey => $orderVal) {
            if (isset($orderVal['children'])) {
                $categoryId = $orderVal['id'];
                $userData['parentId'] = $parentId;
                $userData['catSeq'] = $orderKey;
                $this->db->where('categoryId', $categoryId);
                $this->db->update('categories', $userData);
                $this->saveCategoryOrder($orderVal['children'], $orderVal['id']);
            } else {
                $categoryId = $orderVal['id'];
                $userData['parentId'] = $parentId;
                $userData['catSeq'] = $orderKey;
                $this->db->where('categoryId', $categoryId);
                $this->db->update('categories', $userData);
            }
        }
    }
    
    function toggleBrandPublish($brandId, $status) {
        $statusToUpdate = ($status == '1') ? ('0') : ('1');
        $data = array(
            'isHome' => $statusToUpdate,
        );
        $this->db->where('brandId', $brandId);
        $this->db->update('brands', $data);
        return $statusToUpdate;
    }
    
    function deleteBrandImage($brandId,$brandImg) {
        
        $file_name = $brandImg;
        $file_path = getcwd() . $this->config->item('productImgPath') . $file_name;
        @unlink($file_path);
        
        $data = array(
            'brandImg' => '',
        );
        $this->db->where('brandId', $brandId);
        $this->db->update('brands', $data);
        return TRUE;
    }
    
    function getProdAttributeList() {
        $prodAttributeList = array();
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $this->db->from('master_attributes');
        $query = $this->db->get();
        $prodAttributeList = $query->result();
        return $prodAttributeList;
    }
    
    public function getProdAttribute($attributeId) {
        $table_name = "master_attributes";
        $this->db->where('attributeId', $attributeId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }
    
    function insertProdAttribute() {
        $userData['attributeType'] = ($this->input->post('attributeTypeTxt')!='')?($this->input->post('attributeTypeTxt')):($this->input->post('attributeType'));
        $userData['attributeValue'] = $this->input->post('attributeValue');
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('master_attributes', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateProdAttribute() {
        $attributeId = $this->input->post('attributeId');
        $userData['attributeType'] = ($this->input->post('attributeTypeTxt')!='')?($this->input->post('attributeTypeTxt')):($this->input->post('attributeType'));
        $userData['attributeValue'] = $this->input->post('attributeValue');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('attributeId', $attributeId);
        $this->db->update('master_attributes', $userData);
        return true;
    }
    
    function toggleProdAttributeStatus($attributeId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('attributeId', $attributeId);
        $this->db->update('master_attributes', $data);
        return $statusToUpdate;
    }
    
    function prodAttributeDelete($attributeId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('attributeId', $attributeId);
        $this->db->update('master_attributes', $data);
        return true;
    }
    
    function getProductList() {
        $productList = array();
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $this->db->from('products');
        $this->db->order_by('create_date', 'DESC');
        $query = $this->db->get();
        $productList = $query->result();
        return $productList;
    }
    
    function insertProduct() {
        $userData['productSKU'] = $this->input->post('productSKU');
        $userData['productModel'] = $this->input->post('productModel');
        $userData['productName'] = $this->input->post('productName');
        $userData['brandId'] = $this->input->post('brand');
        $userData['productDesc'] = $this->input->post('productDesc');
        $userData['productVariant'] = $this->input->post('productVariant');
        $userData['productColor'] = $this->input->post('productColor');
        $userData['productMRP'] = $this->input->post('productMRP');
        $userData['productDP'] = $this->input->post('productDP');
        $userData['productFeatures'] = $this->input->post('productFeatures');
        $userData['productImg'] = 'noImage.png';
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('products', $userData)) {
            $productId = $this->db->insert_id();
            $this->product_category($productId);
            return true;
        } else {
            return false;
        }
    }

    function updateProduct() {
        $productId = $this->input->post('productId');
        $userData['productSKU'] = $this->input->post('productSKU');
        $userData['productModel'] = $this->input->post('productModel');
        $userData['productName'] = $this->input->post('productName');
        $userData['brandId'] = $this->input->post('brand');
        $userData['productDesc'] = $this->input->post('productDesc');
        $userData['productVariant'] = $this->input->post('productVariant');
        $userData['productColor'] = $this->input->post('productColor');
        $userData['productMRP'] = $this->input->post('productMRP');
        $userData['productDP'] = $this->input->post('productDP');
        $userData['productFeatures'] = $this->input->post('productFeatures');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('productId', $productId);
        $this->db->update('products', $userData);
        $this->product_category($productId);
        return true;
    }
    
    function product_category($productId) {
        $this->db->where('productId', $productId);
        $this->db->delete('product_category');
        $productCategories = $this->input->post('productCategories');
        //for ($i = 0; $i < count($productCategories); $i++) {
        if(is_array($productCategories)){
            foreach ($productCategories as $catKey => $catVal) {
                $productCategoriesData['productId'] = $productId;
                $productCategoriesData['categoryId'] = $catVal;
                $this->db->insert('product_category', $productCategoriesData);
            }
        }
    }
    
    public function isProductSKUAvailable($productCode) {
        $data['productSKU'] = $productCode;
        $querySysemUser = $this->db->get_where('products', $data);
        if ($querySysemUser->num_rows > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function getProduct($productId) {
        $table_name = "products";
        $this->db->where('productId', $productId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }
    
    public function getAssignedCategories($productId) {
        $data = array();
        $this->db->select('*');
        $this->db->where('productId', $productId);
        $query = $this->db->get('product_category');
        foreach ($query->result() as $row) {
            $data[] = $row->categoryId;
        }
        return $data;
    }
    
    function toggleProductStatus($productId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('productId', $productId);
        $this->db->update('products', $data);
        return $statusToUpdate;
    }
    
    function deleteProduct($productId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('productId', $productId);
        $this->db->update('products', $data);
        return true;
    }
    
    public function getProductMeta($productId) {
        $table_name = "meta_data";
        $this->db->where('targetCode', $productId);
        $this->db->where('target', 'Product');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }
    
    function updateProductMetadata() {
        $productId = $this->input->post('productId');
        
        $productMeta = $this->getProductMeta($productId);
        
        if(count($productMeta) > 0){
            $userData['target'] = 'Product';
            $userData['targetCode'] = $productId;
            $userData['pageTitle'] = $this->input->post('pageTitle');
            $userData['metaKeyword'] = $this->input->post('metaKeyword');
            $userData['metaDesc'] = $this->input->post('metaDesc');
            $this->db->where('target', 'Product');
            $this->db->where('targetCode', $productId);
            $this->db->update('meta_data', $userData);
        }else{
            $userData['target'] = 'Product';
            $userData['targetCode'] = $productId;
            $userData['pageTitle'] = $this->input->post('pageTitle');
            $userData['metaKeyword'] = $this->input->post('metaKeyword');
            $userData['metaDesc'] = $this->input->post('metaDesc');
            $this->db->insert('meta_data', $userData);
        }        
        return true;
    }
    
    public function setMainImg($productId, $image) {
        $galleryData['productImg'] = $image;
        $this->db->where('productId', $productId);
        $this->db->update('products', $galleryData);
        return true;
    }

    public function getMainImg($productId) {
        $this->db->where('productId', $productId);
        $this->db->select('productImg');
        $query = $this->db->get('products');
        $res = $query->row_array();
        return $res['productImg'];
    }

    public function deleteImg($productId, $image) {

        $file_name = $image;
        $file_path = getcwd() . $this->config->item('productImgPath') . $file_name;
        $file_path_thumb = getcwd() . $this->config->item('productThumbImgPath') . $file_name;
        $file_path_stamp = getcwd() . $this->config->item('productStampImgPath') . $file_name;
        $file_path_large = getcwd() . $this->config->item('productLargeImgPath') . $file_name;

        @unlink($file_path);
        @unlink($file_path_thumb);
        @unlink($file_path_stamp);
        @unlink($file_path_large);

        $this->db->where('imgName', $file_name);
        $this->db->delete('master_gallery');
        $mainImg = $this->getMainImg($productId);
        if ($mainImg == $file_name) {
            $this->setMainImg($productId, $this->config->item('defaultMainImg'));
        }
        return true;
    }
    
    function getProductSpecificationList($productId) {
        $productSpecificationList = array();
        $this->db->where('productId', $productId);
        $this->db->select('ps.*,sg.groupName');
        $this->db->from('product_specification as ps');
        $this->db->join('specification_group as sg', 'sg.groupId = ps.groupId', 'left');
        $this->db->order_by('ps.groupId', 'ASC');
        $query = $this->db->get();
        $productSpecificationList = $query->result();
        return $productSpecificationList;
    }
    
    public function getProductSpecifications($productId)
    {
        $productSpecifications = array();
        $specArr = $this->getProductSpecificationList($productId);
        foreach ($specArr as $row){
                $productSpecifications[$row->groupName][$row->specificationId]['specLabel'] = $row->specLabel;
                $productSpecifications[$row->groupName][$row->specificationId]['specValue'] = $row->specValue;
        };
        return $productSpecifications;
    }

    public function getProdSpecification($specificationId) {
        $table_name = "product_specification";
        $this->db->where('specificationId', $specificationId);
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }
    function insertSpecificationGroup() {
        $editSpecGroup = $this->input->post('editSpecGroup');
        if($editSpecGroup=='1'){
            $userData['groupName'] = $this->input->post('specificationGroupTxt');
            $this->db->where('groupId', $this->input->post('specificationGroup'));
            $this->db->update('specification_group', $userData);
            $groupId = $this->input->post('specificationGroup');
        }else{
            $specGroup = $this->getSpecificationGroupBy('groupName',$this->input->post('specificationGroupTxt'));
            if(count($specGroup) > 0){
                $groupId = array_search($this->input->post('specificationGroupTxt'),$specGroup);
            }else{
                $userData['groupName'] = $this->input->post('specificationGroupTxt');
                if ($this->db->insert('specification_group', $userData)) {
                    $groupId = $this->db->insert_id();
                } else {
                    $groupId = '';
                }
            }
        }
        return $groupId;
    }
    
    function insertProdSpecification() {
        if($this->input->post('specificationGroupTxt')!=''){
            $specificationGroup = $this->insertSpecificationGroup();    
        }else{
            $specificationGroup = $this->input->post('specificationGroup');
        }
        
        if($specificationGroup=='' OR $this->input->post('productId')==''){
            return false;
        }
        
        $userData['groupId'] = $specificationGroup;
        $userData['productId'] = $this->input->post('productId');
        $userData['specLabel'] = $this->input->post('specLabel');
        $userData['specValue'] = $this->input->post('specValue');        
        if ($this->db->insert('product_specification', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateProdSpecification() {
        $specificationId = $this->input->post('specificationId');
        if($this->input->post('specificationGroupTxt')!=''){
            $specificationGroup = $this->insertSpecificationGroup();    
        }else{
            $specificationGroup = $this->input->post('specificationGroup');
        }
        
        if($specificationGroup=='' OR $this->input->post('productId')==''){
            return false;
        }
        
        $userData['groupId'] = $specificationGroup;
        $userData['productId'] = $this->input->post('productId');
        $userData['specLabel'] = $this->input->post('specLabel');
        $userData['specValue'] = $this->input->post('specValue');
        $this->db->where('specificationId', $specificationId);
        $this->db->update('product_specification', $userData);
        return true;
    }
    
    function prodSpecificationDelete($specificationId) {
        $this->db->where('specificationId', $specificationId);
        $this->db->delete('product_specification');
        return true;
    }
    
    
    public function getSpecLabelAutoComplete($keyword) {
    	$customers = array();
    	$this->db->like('specLabel', $keyword);
    	$this->db->distinct();
    	$this->db->select('specLabel');
    	$query = $this->db->get('product_specification');
    	foreach ($query->result() as $row) {
    		$customer = array();
    		$customer['id'] = $row->specLabel;
    		$customer['label'] = $row->specLabel;
    		$customer['value'] = $row->specLabel;
    		$customers[] = $customer;
    	}
    	return $customers;
    }
    
    
/*  By Sandy */   
    public function getSpecificationGroupBy($target='',$targetId='') {
        $specGroup = array();
        if($target=="groupId"){
            $this->db->where('groupId', $targetId);
        } elseif ($target=="groupName") {
            $this->db->where('groupName', $targetId);
        }
        $this->db->select('*');
        $query = $this->db->get('specification_group');
        foreach ($query->result() as $row){
                $specGroup[$row->groupId] = $row->groupName;
        };
        return $specGroup;
    }
    
    /* Replace with */
    
    
    public function getSpecificationByCat($catId='') 
    {
    	if($catId!="")
    	{
	    	$specGroup = array();
	
	    	$query = $this->db->query('select labelId,labelLevel,labelName from spec_templet where catId='.$catId);
	    	//var_dump($query);
	    	
	    	return $query->result();
    	}
    	else
    	{
    		echo "Error occured while reading Templet";
    	}    	   
    }
   
    public function getExcelLabels($sheetData='')
    {
    	$specStr="";
    	foreach ($sheetData as $row)
    	{
    		foreach ($row as $key=>$rowValue)
    		{
    			if($rowValue=="" )
    				continue;
    			if($key=='B')
    				$specStr.=ucfirst(strtolower($rowValue)).":";
    		}
    	}
    	$specLabels = explode(':', $specStr);
    	array_shift($specLabels);
    	array_pop($specLabels);
    	return $specLabels;
    }
    
    
    public function getSkuList($temp_Brand,$temp_Model,$tsId)
    {
    	$temp_SKU=array();
    	$masterList=$this->getMasterlist();
    	//echo "<br>Brand: ".$temp_Brand."<br>";
    	//echo "<br>Model: ".$temp_Model."<br>";
    	//echo "<br>*******************Master List*******************<br>";
    	//var_dump($masterList);
		
	   	foreach ($masterList as $row)
    	{
    		if( strcmp($temp_Brand,ucfirst(strtolower($row->brandName)))===0   &&  strcmp($temp_Model,ucfirst(strtolower($row->productModel)))===0	)
    		{
    			$temp_SKU[]=array(
    				'skuId'=>$row->productSKU,
    				'tsId'=>$tsId
    			);    		
    		}
    	}
    	//echo "<br>*******************temp sku List*******************<br>";
    	//var_dump($temp_SKU);
    	return $temp_SKU;
    }
    
    
    
    public function getMasterlist()
    {
    	$query = $this->db->query('select productSKU,br.brandName, productModel from products pr,brands br where pr.brandId=br.brandId');
    
    	return $query->result();
    }
    
    public function insertSKUTS($skuList)
    {
    	echo "<br>*******************SKU_TS table data*******************<br>";
    	var_dump($skuList);
    	//die();
    	$this->db->insert_batch("sku_ts",$skuList);
    }
    
    
    public function uploadProdSpecXLS($sheetData,$fields,$catId)
    {	
    	$errorMsg = "";
    	$prodSKU="";
    	$tsId=0;
    	$groupName="";
    	$labelId="";
       	$groupFlag=0;
       	$prodFlag=0;
       	$temp_GroupId="";
       	$temp_Brand=NULL;
       	$temp_Model=NULL;
     	$userData=array();
     	$firstIteration=1;
     	$errorMsg="";

     	
     	echo "<br>&&&&&&&&&&&&&&&&&&&&&&&&  field data &&&&&&&&&&&&&&&&&&&&&&&<br>";
     	var_dump($fields);
      	foreach ($sheetData as $key=>$rowVal)
      	{
      		
      		if($firstIteration=="1")
      		{      			
      			$firstIteration = 0;
      			$isValidXls = $this->common_model->isValidXls($rowVal, $fields);
      			echo "<br>&&&&&&&&&&&&&&&&&&&&&&&&  excel valid value: ".$isValidXls ." &&&&&&&&&&&&&&&&&&&&&&&<br>";
      			if(!$isValidXls)
      			{
      				echo "<br> Error occur in excel Validation <br> please check the fields";
      				return $errorMsg = $this->lang->line('invalidXlsFields');
      			}
      			echo "<br>&&&&&&&&&&&&&&&&&&&&&&&& Validation End &&&&&&&&&&&&&&&&&&&&&&&<br>";
      			continue;
      		}
      		
      		
      		//die();
      		
      		if(		($rowVal['A']===NULL  &&  $rowVal['B']===NULL  &&  $rowVal['C']===NULL )	 ||		(	isset($rowVal['A'])!=1  &&  isset($rowVal['B'])!=1  &&  isset($rowVal['C'])!=1	)	)
      		{
      			continue;
      		}    

      		if( (	isset($rowVal['A'])!=1  &&  isset($rowVal['B'])!=1  &&  isset($rowVal['C'])==1	) )
      		{
      			continue;
      		}
      		
      		if($rowVal['A']!=NULL)//To get prodSKU for each product
	      	{
	  			//$prodSKU=$rowVal['A'];
	  			$tsId+=1;	  			
	  			$prodFlag=1;
	   		}
	   		//echo $rowVal['A']." :: ".$rowVal['B']." :: ".$rowVal['C']."<br>";
	   		
			if(		(	isset($rowVal['A'])==1  &&  isset($rowVal['B'])==1  &&  isset($rowVal['C'])!=1)    ||	 (  isset($rowVal['A'])!=1  &&  isset($rowVal['B'])==1  &&  isset($rowVal['C'])!=1))
      		{
      			$groupFlag=1;	      			
	      		$groupName= ucfirst(strtolower($rowVal['B']));
	      		//echo $prodSKU." :: ".$groupName."<br>";
	      		continue;
	      	}	
	      	
      		if (	isset($rowVal['A'])!=1	&&	isset($rowVal['B'])==1	&&	isset($rowVal['C'])==1   ) 
      		{
      			$temp_Label=ucfirst(strtolower($rowVal['B']));
      			$temp_Value=ucfirst(strtolower($rowVal['C']));
      			
      			if(strcmp($temp_Label,'Brand')===0)
      			{
					$temp_Brand=$temp_Value;
      			}
      			
      			if(strcmp($temp_Label,'Model')===0)
      			{
      				$temp_Model=$temp_Value;
      			}
      			
      			if( $prodFlag==1 && isset($temp_Brand)==1 && isset($temp_Model)==1)
      			{
      				//var_dump($temp_Brand);
      				//var_dump($temp_Model);
      				$skuList=$this->getSkuList($temp_Brand,$temp_Model,$tsId);
      				//echo "<br>***************sku list for:".$tsId."  ***************<br>";
      				//var_dump($skuList);
      				echo "<br>***************sku list count:".count($skuList)."  ***************<br>";
      				
      				if(count($skuList)>0)
      				{
      					
      					$this->insertSKUTS($skuList);
      					echo "<br>*************** skuts inserted  ***************<br>";
      				}
      				//die();
      				//echo "<br>***************sku list for:".$prodSKU."  ***************<br>";
      				//var_dump($skuList); 
      				$prodFlag=0; 
      				$temp_Brand=NULL;
      				$temp_Model=NULL;
      				//die();    				
      			}
      			
      			
      				//write seperate function for getting groupId
      				//TO get gruopId
      			if ($groupFlag==1) 
      			{
      				$temp_GroupId=$this->getGroupId($groupName,$catId);     				
      				$groupFlag=0;
      			}
      	      			
   	   				//Code to get label id for current label
      				//Write function to get label id
      			$labelId=$this->getLabelId($temp_GroupId,$temp_Label,$catId);    			
      			
      		}//sub label and value
	      	
      		//echo $tsId."  		::		  ".$labelId."  		::		 ".$temp_Value."<br>";
      		//For Creation of array for each rec[Bulk array creation]
      		
      		$userData[]= array(	
      							$fields['productSKU']=>$tsId,
			      				$fields['labelId']=>$labelId,
			      				$fields['labelValue']=>$temp_Value
	      				);
      		    		        	
      	}//End of Outer for
     	//die();
     	
      	var_dump($userData);
      	//echo "<br>prodSKU :: temp_GroupId  ::  groupName ::  labelId  ::  temp_Label  :: temp_Value";
            	
      	//Insert bulk data into database[In 1 attempt]
        if($this->db->insert_batch("prod_spec",$userData))
        {
            $errorMsg = $this->lang->line('operationSuccess');
        }
        return $errorMsg;
    }//End of uploadProdSpecXLS()
    
    
    
    public function getGroupId($groupName,$catId)
    {
    	$groupFlag=0;
    	$specTemplet = $this->getSpecificationByCat($catId);
    	
    	
    	foreach ($specTemplet as $specRow)
    	{
    		if(		isset($specRow->labelId)==1		&&		isset($specRow->labelLevel)!=1		&&		 isset($specRow->labelName)==1		)
    		{    			
    			if(strcmp($groupName,ucfirst(strtolower($specRow->labelName)))==0)
    			{
    				$temp_GroupId=$specRow->labelId;
    				$groupFlag=1;
    				break;
    			}
    		}
    	}
    	
    	if (!$groupFlag) 
    	{
    			$data = array();
    			$query=$this->db->query("SELECT labelId FROM spec_templet order BY labelId DESC LIMIT 1");
    			$data = $query->row_array();
    			
 				$tempLabelId=intval($data['labelId']);
 				$tempLabelId+=1;
    			$groupData=array(
    					'labelId'=>$tempLabelId,
    					'labelLevel'=>NULL,
    					'labelName'=>$groupName,
    					'catId'=>$catId
    				);
    			$this->db->insert("spec_templet",$groupData);        		
        		$temp_GroupId=$this->getGroupId($groupName, $catId);
        		//echo "<br>New group id is: ".$temp_GroupId."<br>";
        		$groupFlag=0;
        		return $temp_GroupId;
    	}        
    	else 
    	{
    		return $temp_GroupId;
    	}	
    }
    
    
    public function getLabelId($GroupId,$Label,$catId)
    {
    	$labelFlag=0;
    	$specTemplet = $this->getSpecificationByCat($catId);
    	foreach ($specTemplet as $specRow)
    	{
    		if(	$specRow->labelLevel==$GroupId		&&		strcmp(ucfirst(strtolower($Label)),ucfirst(strtolower($specRow->labelName)))==0		)
    		{
    			$temp_LabelId=$specRow->labelId;
    			$labelFlag=1;    			
    			break;
    		}
    	}
    	    	 
    	if (!$labelFlag)
    	{
    		$data = array();
    		$query=$this->db->query("SELECT labelId FROM spec_templet order BY labelId DESC LIMIT 1");
    		$data = $query->row_array();
    		 
    		$tempLabelId=intval($data['labelId']);
    		$tempLabelId+=1;
    		$labelData=array(
    				'labelId'=>$tempLabelId,
    				'labelLevel'=>$GroupId,
    				'labelName'=>$Label,
    				'catId'=>$catId
    		);
    		$this->db->insert("spec_templet",$labelData);
    		$temp_LabelId=$this->getLabelId($GroupId, $Label, $catId);
    		//echo "<br>New Label id is: ".$temp_LabelId."<br>";
    		$labelFlag=0;
    		return $temp_LabelId;
    	}
    	else
    	{
    		return $temp_LabelId;
    	}
    	
    }
    
    
    
    
    /*  End By sandy */
    
    /*
     * public function uploadProdSpecXLS($sheetData,$fields)
    {
        $errorMsg = "";
        $specGroup = $this->product_model->getSpecificationGroupBy();
        $firstIteration = "1";
        foreach ($sheetData as $sheetRowKey => $sheetColVal){
            if($firstIteration=="1"){
                $indexArr = $sheetColVal;
                $firstIteration = 0;
                $isValidXls = $this->common_model->isValidXls($indexArr, $fields);
                if(!$isValidXls){
                    return $errorMsg = $this->lang->line('invalidXlsFields');
                }
                continue;
            }
            foreach ($sheetColVal as $sheetCellKey => $sheetCellVal){
                $groupId = "";
                if($indexArr[$sheetCellKey] == "group"){
                    if($sheetCellVal!=""){
                        if(in_array($sheetCellVal, $specGroup)){
                           $groupId = array_search($sheetCellVal,$specGroup); 
                        }else{
                            $specGroupData['groupName'] = $sheetCellVal;
                            if ($this->db->insert('specification_group', $specGroupData)) {
                                $groupId = $this->db->insert_id();
                            } 
                            $specGroup[$groupId] = $sheetCellVal;
                        }
                        $sheetCellVal = $groupId;
                    }
                }
                if($sheetCellVal!=""){
                    $sheetColumnData[$fields[$indexArr[$sheetCellKey]]] = $sheetCellVal;                    
                }else{
                    $sheetColumnData = array();
                    break;
                }
            }
            if(count($sheetColumnData) > 0){
                $userData[] = $sheetColumnData;
            }
        }
        if($this->db->insert_batch("product_specification",$userData))
        {
            $errorMsg = $this->lang->line('operationSuccess');
        }
        return $errorMsg;
    }
     *   */
    
    public function uploadProdMasterXLS($sheetData,$fields)
    {
        $errorMsg = "";
        $firstIteration = "1";
        echo "<br>*********************in model SHEETDATA ***********************";
        
        foreach ($sheetData as $sheetRowKey => $sheetColVal){
            if($firstIteration=="1"){
                $indexArr = $sheetColVal;
                $firstIteration = 0;
                $isValidXls = $this->common_model->isValidXls($indexArr, $fields);
                
                if(!$isValidXls){
                    return $errorMsg = $this->lang->line('invalidXlsFields');
                }
                continue;
            }
            
            $prodData = array('productImg'=>'noImage.png');
            $prodMetaData = array();
            $prodCategoryData = array();
            $prodCategoryId = "";
            foreach ($sheetColVal as $sheetCellKey => $sheetCellVal){
                if($fields[$indexArr[$sheetCellKey]] == "categoryId"){
                    $prodCategoryId = $sheetCellVal;
                    if($prodCategoryId!=""){
                        $prodCategoryData[] = $prodCategoryId;
                        $this->getProductCategoryTreeBottomtoTop($prodCategoryId, $prodCategoryData);
                    }
                }elseif(($fields[$indexArr[$sheetCellKey]] == "pageTitle") || ($fields[$indexArr[$sheetCellKey]] == "metaKeyword") || ($fields[$indexArr[$sheetCellKey]] == "metaDesc")){
                    $prodMetaData[$fields[$indexArr[$sheetCellKey]]] = $sheetCellVal;
                }else{
                    $prodData[$fields[$indexArr[$sheetCellKey]]] = $sheetCellVal;
                }                
            }
            
            if ($this->db->insert('products', $prodData)) {
                $productId = $this->db->insert_id();
                $prodMetaData['target'] = 'Product';
                $prodMetaData['targetCode'] = $productId;
                $this->db->insert('meta_data', $prodMetaData);
                
                $j=0;
                foreach ($prodCategoryData as $prodCatKey => $prodCatVal){
                    $prodCategories[$j]['productId'] = $productId;
                    $prodCategories[$j]['categoryId'] = $prodCatVal;
                    $j++;                    
                }
                
                if(count($prodCategories) > 0){
                    $this->db->insert_batch("product_category",$prodCategories);
                }
                        
                $errorMsg = $this->lang->line('operationSuccess');
            }
        }
        return $errorMsg;
    }
    
    
    
    
    /* public function uploadProdMasterXLS($sheetData,$fields)
    {
        $errorMsg = "";
        $firstIteration = "1";
        foreach ($sheetData as $sheetRowKey => $sheetColVal){
            if($firstIteration=="1"){
                $indexArr = $sheetColVal;
                $firstIteration = 0;
                $isValidXls = $this->common_model->isValidXls($indexArr, $fields);
                if(!$isValidXls){
                    return $errorMsg = $this->lang->line('invalidXlsFields');
                }
                continue;
            }
            $prodData = array('productImg'=>'noImage.png');
            $prodMetaData = array();
            $prodCategoryData = array();
            $prodCategoryId = "";
            foreach ($sheetColVal as $sheetCellKey => $sheetCellVal){
                if($fields[$indexArr[$sheetCellKey]] == "categoryId"){
                    $prodCategoryId = $sheetCellVal;
                    if($prodCategoryId!=""){
                        $prodCategoryData[] = $prodCategoryId;
                        $this->getProductCategoryTreeBottomtoTop($prodCategoryId, $prodCategoryData);
                    }
                }elseif(($fields[$indexArr[$sheetCellKey]] == "pageTitle") || ($fields[$indexArr[$sheetCellKey]] == "metaKeyword") || ($fields[$indexArr[$sheetCellKey]] == "metaDesc")){
                    $prodMetaData[$fields[$indexArr[$sheetCellKey]]] = $sheetCellVal;
                }else{
                    $prodData[$fields[$indexArr[$sheetCellKey]]] = $sheetCellVal;
                }                
            }
            
            if ($this->db->insert('products', $prodData)) {
                $productId = $this->db->insert_id();
                $prodMetaData['target'] = 'Product';
                $prodMetaData['targetCode'] = $productId;
                $this->db->insert('meta_data', $prodMetaData);
                
                $j=0;
                foreach ($prodCategoryData as $prodCatKey => $prodCatVal){
                    $prodCategories[$j]['productId'] = $productId;
                    $prodCategories[$j]['categoryId'] = $prodCatVal;
                    $j++;                    
                }
                
                if(count($prodCategories) > 0){
                    $this->db->insert_batch("product_category",$prodCategories);
                }
                        
                $errorMsg = $this->lang->line('operationSuccess');
            }
        }
        return $errorMsg;
    } */
    
    public function getProdColorAutoComplete($keyword) {
        $productColors = array();
        $this->db->like('productColor', $keyword);
        $this->db->distinct();
        $this->db->select('productColor');
        $query = $this->db->get('products');
        foreach ($query->result() as $row) {
            $color = array();
            $color['id'] = $row->productColor;
            $color['label'] = $row->productColor;
            $color['value'] = $row->productColor;
            $productColors[] = $color;
        }
        return $productColors;
    }
    
    public function getProdVariantAutoComplete($keyword) {
        $productVariants = array();
        $this->db->like('productVariant', $keyword);
        $this->db->distinct();
        $this->db->select('productVariant');
        $query = $this->db->get('products');
        foreach ($query->result() as $row) {
            $variant = array();
            $variant['id'] = $row->productVariant;
            $variant['label'] = $row->productVariant;
            $variant['value'] = $row->productVariant;
            $productVariants[] = $variant;
        }
        return $productVariants;
    }
    
    function getProductCategoryTreeBottomtoTop($categoryId, &$prodCategoryData) {
        $this->db->where('categoryId', $categoryId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('parentId');
        $query = $this->db->get('categories');
        $row = $query->row();
        if($row->parentId!='0'){
            $prodCategoryData[] = $row->parentId;
            $this->getProductCategoryTreeBottomtoTop($row->parentId, $prodCategoryData);
        }
        return $prodCategoryData;
    }
    
    function getProdFilterList($categoryId="") {
        $prodFilterList = array();
        $this->db->where('mf.status != ', 'Delete');
        if($categoryId!=""){
            $this->db->where('mf.categoryId', $categoryId);
        }
        $this->db->select('mf.*,c.categoryName');
        $this->db->from('master_filters as mf');
        $this->db->join('categories as c', 'c.categoryId = mf.categoryId', 'left');
        $query = $this->db->get();
        $prodFilterList = $query->result();
        return $prodFilterList;
    }
    
    function insertProdFilter() {
        $userData['categoryId'] = $this->input->post('category');
        $userData['filterType'] = ($this->input->post('filterTypeTxt')!='')?($this->input->post('filterTypeTxt')):($this->input->post('filterType'));
        $userData['filterValue'] = $this->input->post('filterValue');
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('master_filters', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateProdFilter() {
        if($this->input->post('editFilterType')=="1" && $this->input->post('filterTypeTxt')!=''){
            $categoryId = $this->input->post('categoryId');
            $filterTypeData['filterType'] = $this->input->post('filterTypeTxt');
            $this->db->where('categoryId', $categoryId);
            $this->db->where('filterType', $this->input->post('filterType'));
            $this->db->update('master_filters', $filterTypeData);
        }
        
        $filterId = $this->input->post('filterId');
        $userData['categoryId'] = $this->input->post('category');
        $userData['filterValue'] = $this->input->post('filterValue');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('filterId', $filterId);
        $this->db->update('master_filters', $userData);
        return true;
    }
    
    public function getProdFilter($filterId) {
        $table_name = "master_filters";
        $this->db->where('filterId', $filterId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }
    
    function toggleProdFilterStatus($filterId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('filterId', $filterId);
        $this->db->update('master_filters', $data);
        return $statusToUpdate;
    }
    
    function prodFilterDelete($filterId) {
        $this->db->where('filterId', $filterId);
        $this->db->delete('master_filters');
        
        $this->db->where('filterId', $filterId);
        $this->db->delete('product_filters');
        return true;
    }
    
    public function getProductFilters($productId) {
        
        $cetegories = $this->getCategories();
        $data = array();
        $this->db->distinct();
        $this->db->where('productId', $productId);
        $this->db->select('categoryId');
        $query = $this->db->get('product_category');
        foreach ($query->result() as $row) {
            $categories[] = $row->categoryId;
        }
        
        if(count($categories) > 0){
            $this->db->select('*');
            $this->db->where('status != ', 'Delete');
            $this->db->where_in('categoryId', $categories);
            $query = $this->db->get('master_filters');
            foreach ($query->result() as $row) {
                $data[$row->filterType.'-('.$cetegories[$row->categoryId].')'][$row->filterId] = $row->filterValue;
            }
        }
        return $data;
    }
    
    public function getAssignedProductFilters($productId) {
        $data = array();
        $this->db->select('*');
        $this->db->where('productId', $productId);
        $query = $this->db->get('product_filters');
        foreach ($query->result() as $row) {
            $data[] = $row->filterId;
        }
        return $data;
    }
    
    function updateProductFilterAssociate() {
        $productId = $this->input->post('productId');
        $this->db->where('productId', $productId);
        $this->db->delete('product_filters');
        $productFilterType = $this->input->post('productFilterType');
        foreach ($productFilterType as $filterKey => $filterValue) {
            if (count($this->input->post('productFilter_' . $filterValue)) > 0) {
                $productFilters = array();
                $productFilters = $this->input->post('productFilter_' . $filterValue);
                for ($i = 0; $i < count($productFilters); $i++) {
                    $productFiltersData['productId'] = $productId;
                    $productFiltersData['filterId'] = $productFilters[$i];
                    $this->db->insert('product_filters', $productFiltersData);
                }
            }
        }
        return true;
    }
    
    function updateAssociatedSubAreas(){
            $areaId = $this->input->post('areaId');
            $subAreas = $this->input->post('subAreas');
            $subAreaName = $this->input->post('subAreaName');
            $this->db->where('areaId', $areaId);
            $this->db->delete('area_has_subareas');
            for($i=0;$i < count($subAreas); $i++){
                    $userStoreData['areaId'] = $areaId;
                    $userStoreData['subAreaId'] = $subAreas[$i];
                    $this->db->insert('area_has_subareas', $userStoreData);
            }
            
            if(count($subAreas) > 0){
                foreach ($subAreas as $key => $subAreaId) {
                    $areaIncludeArr[] = $subAreaName[$subAreaId];
                }
                $areaInclude = implode(", ", $areaIncludeArr);                
                $areaIncludesData['areaIncludes'] = $areaInclude;
                $this->db->where('areaId', $areaId);
                $this->db->update('areas', $areaIncludesData);            
            }
            return true;
    }
    
    public function getSearchProductsBy() {
        $searchProds = array();
        $productIdIn = array();
        $prodName = $this->input->post('prodName');
        $prodModel = $this->input->post('prodModel');
        $prodBrand = $this->input->post('prodBrand');
        $prodCategoryId = $this->input->post('prodCategoryId');
        
        if($prodCategoryId!=""){
            $this->db->select('productId');
            $this->db->where('categoryId', $prodCategoryId);
            $query = $this->db->get('product_category');
            foreach ($query->result() as $row) {
                $productIdIn[] = $row->productId;
            }
        }
        
        if($prodName!=""){
            $this->db->like('productName', $prodName);
        }
        
        if($prodModel!=""){
            $this->db->like('productModel', $prodModel);
        }

        
        if($prodBrand!=""){
            $this->db->where('brandId', $prodBrand);
        }
        
        if(count($productIdIn) > 0){
            $this->db->where_in('productId', $productIdIn);
        }
        
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $query = $this->db->get('products');
        foreach ($query->result() as $row){
                $searchProds[$row->productId] = $row;
        };
        return $searchProds;
    }
    
    public function getSelectedProducts($productSelection)
    {
        $selectedProducts = array();
        if(count($productSelection) > 0){
            $this->db->where_in('productId', $productSelection);
            $this->db->where('status != ', 'Delete');
            $this->db->select('*');
            $query = $this->db->get('products');
            foreach ($query->result() as $row){
                    $selectedProducts[$row->productId] = $row;
            }
        }
        return $selectedProducts;
    }
    
    public function insertStoreProducts()
    {
        $response = false;
        $productIds = $this->input->post('productId');
        $storeIds = $this->input->post('storeIds');        
        
        $productSKU = $this->input->post('productSKU');
        $sellingPrice = $this->input->post('sellingPrice');
        $qty = $this->input->post('qty');
        $dispatchPeriod = $this->input->post('dispatchPeriod');
        $offerPrice = $this->input->post('offerPrice');
        $offerRemark = $this->input->post('offerRemark');
        $remark = $this->input->post('remark');

        foreach ($productIds as $key => $prodId) {
            foreach ($storeIds as $storekey => $storeId) {
                $storeProdData = array();
                $this->db->where('productId', $prodId);
                $this->db->where('storeId', $storeId);
                $this->db->delete('stores_has_products');

                $storeProdData['productId'] = $prodId;
                $storeProdData['storeId'] = $storeId;
                $storeProdData['storeProdSku'] = $productSKU[$key];
                $storeProdData['sellPrice'] = $sellingPrice[$key];
                $storeProdData['qty'] = $qty[$key];
                $storeProdData['dispatchPeriod'] = $dispatchPeriod[$key];
                $storeProdData['offerPrice'] = $offerPrice[$key];
                $storeProdData['offerRemark'] = $offerRemark[$key];
                $storeProdData['remark'] = $remark[$key];
                $storeProdData['create_date'] = date("Y-m-d H:i:s");
                $storeProdData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
                $this->db->insert('stores_has_products', $storeProdData);
                $response = true;
            }            
        }
        return $response;        
    }
    
    function toggleHomePublish($productId, $status) {
        $statusToUpdate = ($status == '1') ? ('0') : ('1');
        $data = array(
            'isHome' => $statusToUpdate,
        );
        $this->db->where('productId', $productId);
        $this->db->update('products', $data);
        return $statusToUpdate;
    }
    
    function isUsefullReview($reviewId, $status) {        
        $this->db->where('reviewId', $reviewId);
        if($status){
            $this->db->set('usefull', 'usefull+1', FALSE);
        }else{
            $this->db->set('notUsefull', 'notUsefull+1', FALSE);
        }
        $this->db->update('product_reviews');
        
        if($status){            
            $select = 'usefull';
        }else{
            $select = 'notUsefull';
        }
        $this->db->select($select);
        $this->db->where('reviewId', $reviewId);
        $query = $this->db->get('product_reviews');
        $row = $query->row();
        return $row->$select;
    }
    
    function addProductReview()
    {
        $reviewData['productId'] = $this->input->post('productId');
        $reviewData['customerId'] = $this->session->userdata('customerId');
        $reviewData['custEmail'] = $this->input->post('custEmail');        
        $reviewData['reviewTitle'] = $this->input->post('prodReviewTitle');
        $reviewData['reviewDesc'] = $this->input->post('prodReviewDesc');
        $reviewData['rating'] = $this->input->post('score');
        $reviewData['usefull'] = 0;
        $reviewData['notUsefull'] = 0;
        $reviewData['status'] = 'Inactive';
        $reviewData['create_date'] = date("Y-m-d H:i:s");
        $reviewData['create_by'] = $this->session->userdata('customerId');
        $this->db->insert('product_reviews', $reviewData);
        $this->updateProductRating($this->input->post('productId'));
        $response = true;
    }
    
    function updateProductRating($productId)
    {
        $prodRating = '0.0';
        $this->db->select_avg('rating');
        $this->db->where('productId', $productId); 
        $this->db->where('status', 'Active');
        $query = $this->db->get('product_reviews');
        $row = $query->row();
        $prodRating = $row->rating;

        $prodRatingData['rating'] = $prodRating;
        $this->db->where('productId', $productId);
        $this->db->update('products', $prodRatingData); 
    }


    public function getTopSearchAutoComplete($keyword) {
        $suggestions = array();
        $prodBrands = array();
        $prodCats = array();
        $products = array();
        $i = 0;
        /* Brand Start */
        $this->db->like('brandName', $keyword);
        $this->db->distinct();
        $this->db->where('status', 'Active');
        $this->db->limit(2);
        $this->db->select('brandName, brandId');
        $query = $this->db->get('brands');
        foreach ($query->result() as $row) {
            $brand = array();
            $brand['category'] = 'brand';
            $brand['id'] = $row->brandId;
            $brand['label'] = highlight_phrase($row->brandName, $keyword, '<span style="color:#FAA323">', '</span>');
            $brand['value'] = $row->brandName;
            $brand['url'] = site_url('product/brand/'.$row->brandId.'/'.url_title(strtolower($row->brandName)));;
            $suggestions[$i] = $brand;
            $i++;
        }
        //$suggestions[$keyword]['brands'] = $prodBrands;
        //$suggestions = $prodBrands;
        /* Brand end */
        
        /* Category start */
        $this->db->like('categoryName', $keyword);
        $this->db->distinct();
        $this->db->where('status', 'Active');
        $this->db->limit(2);
        $this->db->select('categoryName, categoryId');
        $query = $this->db->get('categories');
        foreach ($query->result() as $row) {
            $cats = array();
            $cats['category'] = 'categories';
            $cats['id'] = $row->categoryId;
            $cats['label'] = highlight_phrase($row->categoryName, $keyword, '<span style="color:#FAA323">', '</span>');
            $cats['value'] = $row->categoryName;
            $cats['url'] = site_url('product/cat/'.$row->categoryId.'/'.url_title(strtolower($row->categoryName)));
            $suggestions[$i] = $cats;
            $i++;
        }
        //$suggestions = $prodCats;
        /* Category end */
        
        /* product start */
        $this->db->like('productName', $keyword);
        $this->db->or_like('productModel', $keyword);        
        $this->db->distinct();
        $this->db->where('status', 'Active');
        $this->db->limit(2);
        $this->db->select('productName, productId');
        $query = $this->db->get('products');
        foreach ($query->result() as $row) {
            $product = array();
            $product['category'] = 'products';
            $product['id'] = $row->productId;
            $product['label'] = highlight_phrase($row->productName, $keyword, '<span style="color:#FAA323">', '</span>');
            $product['value'] = $row->productName;
            $product['url'] = site_url('product/detail/'.$row->productId.'/'.url_title($row->productName));
            $suggestions[$i] = $product;
            $i++;
        }
        //$suggestions = $products;
        /* product end */
        return $suggestions;
    }
    
    function getProductReviewsList($productId) {
        $productReviewsList = array();
        $this->db->where('pr.status != ', 'Delete');
        $this->db->where('pr.productId', $productId);
        $this->db->select('pr.*,c.name as custName');
        $this->db->from('product_reviews as pr');
        $this->db->join('customers as c', 'c.customerId = pr.customerId', 'left');
        $query = $this->db->get();
        $productReviewsList = $query->result();        
        return $productReviewsList;
    }
    
    function toggleProductReviewsStatus($reviewId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('reviewId', $reviewId);
        $this->db->update('product_reviews', $data);
        return $statusToUpdate;
    }
    
    function prodReviewDelete($reviewId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('reviewId', $reviewId);
        $this->db->update('product_reviews', $data);
        return true;
    }
    //updateProdReview
    function insertProdReview() {
        $userData['productId'] = $this->input->post('productId');
        $userData['customerId'] = $this->input->post('customerId');
        $userData['custEmail'] = $this->input->post('custEmail');
        $userData['reviewTitle'] = $this->input->post('reviewTitle');
        $userData['reviewDesc'] = $this->input->post('reviewDesc');        
        $userData['rating'] = $this->input->post('score');
        $userData['usefull'] = $this->input->post('usefull');
        $userData['notUsefull'] = $this->input->post('notUsefull');
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('product_reviews', $userData)) {
            $this->updateProductRating($this->input->post('productId'));
            return true;
        } else {
            return false;
        }
    }
    
    function updateProdReview() {
        
        $reviewId = $this->input->post('reviewId');
        $userData['customerId'] = $this->input->post('customerId');
        $userData['custEmail'] = $this->input->post('custEmail');
        $userData['reviewTitle'] = $this->input->post('reviewTitle');
        $userData['reviewDesc'] = $this->input->post('reviewDesc');        
        $userData['rating'] = $this->input->post('score');
        $userData['usefull'] = $this->input->post('usefull');
        $userData['notUsefull'] = $this->input->post('notUsefull');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('reviewId', $reviewId);
        $this->db->update('product_reviews', $userData);
        $this->updateProductRating($this->input->post('productId'));
        return true;
    }
    
    public function getCustomerByEmailAutoComplete($keyword) {
        $customers = array();
        $this->db->like('username', $keyword);
        $this->db->select('*');
        $query = $this->db->get('customers');
        foreach ($query->result() as $row) {
            $customer = array();
            $customer['id'] = $row->customerId;
            $customer['label'] = $row->email;
            $customer['value'] = $row->email;
            $customers[] = $customer;
        }
        return $customers;
    }
    
    public function getProdReview($reviewId) {
        $table_name = "product_reviews";
        $this->db->where('reviewId', $reviewId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }
    
    public function mybargain(){
    	
    	$customerId = $this->session->userdata('interfaceUserId');
    	$table_Master = "bargain_master";
    	$store_response = "store_response";
    	//$bargain_customerRequest = "bargin_custRequest";
    	//$this->db->where('customerId', $customerId);
    	//$this->db->where('status != ', 'Closed');
    	//$myBargainStatus = array();
    	//$this->db->select('*')->from($table_Master);
    	//$query = $this->db->get();
    	$query=$this->db->query("select * from bargain_master where customerId='$customerId'");
    	//var_dump($query->result());
    	//die();
    	/*foreach ($query->result_array() as $row) {
    		$master[$row['customerId']] = $row;
    	}*/
    	$master=$query->result_array();
    	///var_dump($master);
    	//die();
    	return $master;
    	 
    }
    
    public function getSavedSearch() {
			$customerId = $this->session->userdata('interfaceUserId');
			 $table_name = "products p";
        $this->db->join('saved_search ss', 'ss.product_id=productId','left');
        $this->db->where('ss.customerId', $customerId);
        
        $this->db->select('p.*')->from($table_name);
        $query = $this->db->get();
		
		$data=array();
		
        foreach($query->result_array() as $prod) {
			$data[$prod['productId']]=$prod;
		}
		
		return $data;
    }
	
	public function removeSavedSearch($productId) {
		$customerId = $this->session->userdata('interfaceUserId');
		 $sql="delete from saved_search where product_id=".$productId." AND customerId=".$customerId;
		$this->db->query($sql);
		return true;
	}
    
}

?>