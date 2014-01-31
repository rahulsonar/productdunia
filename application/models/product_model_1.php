<?php

class Product_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
    }

    function getProductList() {
        $productList = array();
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $this->db->from('master_product');
        $this->db->order_by('create_date', 'DESC');
        $query = $this->db->get();
        $productList = $query->result();
        return $productList;
    }
    
    public function getProducts($extraOption = '0') {
        $data = ($extraOption == '1') ? (array('0' => 'Select product')) : (array());
        $this->db->select('*');
        $this->db->where('status != ', 'Delete');
        $query = $this->db->get('master_product');
        foreach ($query->result() as $row) {
            $data[$row->productId] = $row->productName;
        }
        return $data;
    }

    public function getVendor($vendor_id) {
        $table_name = "master_vendor";
        $this->db->where('vendor_id', $vendor_id);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }

    public function getVendors($extraOption = '0') {
        $data = ($extraOption == '1') ? (array('0' => 'Select vendor.')) : (array());
        $this->db->select('*');
        $this->db->where('status != ', 'Delete');
        $query = $this->db->get('master_vendor');
        foreach ($query->result() as $row) {
            $data[$row->vendor_id] = $row->vendor_name;
        }
        return $data;
    }
    
    public function getVendorOrders($vendor_id) {
        $this->db->select('*');
        $this->db->where('vendor_id', $vendor_id);
        $query = $this->db->get('orders');
        foreach ($query->result() as $row) {
            $data[$row->order_id]['orderCode'] = $row->orderCode;
            $data[$row->order_id]['purchase_amount'] = $row->purchase_amount;
            $data[$row->order_id]['shippingCharge'] = $row->shippingCharge;
            $data[$row->order_id]['vendor_payment_status'] = $row->vendor_payment_status;
            $data[$row->order_id]['paid_to_vendor'] = $row->paid_to_vendor;            
        }
        return $data;
    }

    public function getProductAttributes() {
        $this->db->select('*');
        $this->db->where('status != ', 'Delete');
        $query = $this->db->get('master_attributes');
        foreach ($query->result() as $row) {
            $data[$row->attributeType][$row->attributeId] = $row->attributeValue;
        }
        return $data;
    }

    function getVendorsList() {
        $vendorsList = array();
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $this->db->from('master_vendor');
        $this->db->order_by('create_date', 'DESC');
        $query = $this->db->get();
        $vendorsList = $query->result();
        return $vendorsList;
    }

    function getCustomerList() {
        $customerList = array();
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $this->db->from('master_customer');
        $this->db->order_by('firstName', 'ASC');
        $query = $this->db->get();
        $customerList = $query->result();
        return $customerList;
    }

    public function getOccasions($extraOption = '0') {
        $data = ($extraOption == '1') ? (array('0' => 'Select occation.')) : (array());
        $this->db->select('*');
        $this->db->where('status != ', 'Delete');
        $query = $this->db->get('master_occasions');
        foreach ($query->result() as $row) {
            $data[$row->occasionId] = $row->occasion;
        }
        return $data;
    }

    function getOccasionList() {
        $occasionList = array();
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $this->db->from('master_occasions');
        $this->db->order_by('occasion', 'ASC');
        $query = $this->db->get();
        $occasionList = $query->result();
        return $occasionList;
    }

    public function getRelations($extraOption = '0') {
        $data = ($extraOption == '1') ? (array('0' => 'Select relation.')) : (array());
        $this->db->select('*');
        $this->db->where('status != ', 'Delete');
        $query = $this->db->get('master_relations');
        foreach ($query->result() as $row) {
            $data[$row->relationId] = $row->relation;
        }
        return $data;
    }

    function getRelationList() {
        $relationList = array();
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $this->db->from('master_relations');
        $this->db->order_by('relation', 'ASC');
        $query = $this->db->get();
        $relationList = $query->result();
        return $relationList;
    }
    
    function getAddonProdList() {
        $addonProdList = array();
        $this->db->where('ap.status != ', 'Delete');
        $this->db->select('ap.*,mp.productName as mainProduct');
        $this->db->from('addon_products as ap');
        $this->db->join('master_product as mp', 'mp.productId = ap.productId', 'left');
        $this->db->order_by('ap.productName', 'ASC');
        $query = $this->db->get();
        $addonProdList = $query->result();
        return $addonProdList;
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

    function getCityList() {
        $categoryList = array();
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $this->db->from('master_cities');
        $this->db->order_by('city_name', 'ASC');
        $query = $this->db->get();
        $categoryList = $query->result();
        return $categoryList;
    }

    public function getCity($city_id) {
        $table_name = "master_cities";
        $this->db->where('city_id', $city_id);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }

    public function getOccasion($occasionId) {
        $table_name = "master_occasions";
        $this->db->where('occasionId', $occasionId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }

    public function getRelation($relationId) {
        $table_name = "master_relations";
        $this->db->where('relationId', $relationId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }

    public function getProdAttribute($attributeId) {
        $table_name = "master_attributes";
        $this->db->where('attributeId', $attributeId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }
    
    public function getAddonProduct($prodId) {
        $table_name = "addon_products";
        $this->db->where('prodId', $prodId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }

    public function getProductCategory($catId) {
        $table_name = "master_categories";
        $this->db->where('catId', $catId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }

    public function getProduct($productId) {
        $table_name = "master_product";
        $this->db->where('productId', $productId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }

    function getProductCategoryList() {
        $categoryList = array();
        $this->db->where('mc.status != ', 'Delete');
        $this->db->select('mc.catId,mc.catName,mc.parentId,mc.status,mc.catSeq,mpc.catName as parentCatName');
        $this->db->from('master_categories as mc');
        $this->db->join('master_categories as mpc', 'mpc.catId = mc.parentId', 'left');
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
        $query = $this->db->get('master_categories');
        $j = 0;
        foreach ($query->result() as $row) {
            $menu[$j]['catId'] = $row->catId;
            $menu[$j]['parentId'] = $row->parentId;
            $menu[$j]['name'] = $row->catName;
            $menu[$j]['submenus'] = $this->getProductCategoryTree($row->catId);
            $j++;
        }
        return $menu;
    }

    public function isProductCodeAvailable($productCode) {
        $data['productCode'] = $productCode;
        $querySysemUser = $this->db->get_where('master_product', $data);
        if ($querySysemUser->num_rows > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function insertProduct() {
        $userData['productCode'] = $this->input->post('productCode');
        $userData['productName'] = $this->input->post('productName');
        $userData['purchaseCost'] = $this->input->post('purchaseCost');
        $userData['saleCost'] = $this->input->post('saleCost');
        $userData['comboCost'] = $this->input->post('comboCost');
        $userData['productImg'] = 'noImage.png';
        $userData['productDesc'] = $this->input->post('productDesc');
        $userData['vendorProdDesc'] = $this->input->post('vendorProdDesc');        
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('master_product', $userData)) {
            $productId = $this->db->insert_id();
            $this->product_category($productId);
            $this->updateProductVendors($productId);
            return true;
        } else {
            return false;
        }
    }

    function updateProduct() {
        $productId = $this->input->post('productId');
        $userData['productCode'] = $this->input->post('productCode');
        $userData['productName'] = $this->input->post('productName');
        $userData['purchaseCost'] = $this->input->post('purchaseCost');
        $userData['saleCost'] = $this->input->post('saleCost');
        $userData['comboCost'] = $this->input->post('comboCost');
        $userData['productDesc'] = $this->input->post('productDesc');
        $userData['vendorProdDesc'] = $this->input->post('vendorProdDesc');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('productId', $productId);
        $this->db->update('master_product', $userData);
        $this->product_category($productId);
        $this->updateProductVendors($productId);
        $this->updateProductOccasions($productId);
        $this->updateProductRelations($productId);
        return true;
    }

    function updateProductVendors($productId) {
        $this->db->where('productId', $productId);
        $this->db->delete('product_vendor');
        $productVendors = $this->input->post('productVendors');
        for ($i = 0; $i < count($productVendors); $i++) {
            $productVendorsData['productId'] = $productId;
            $productVendorsData['vendor_id'] = $productVendors[$i];
            $this->db->insert('product_vendor', $productVendorsData);
        }
    }

    function updateProductAttributeAssociate($productId) {
        $productId = $this->input->post('productId');
        $this->db->where('productId', $productId);
        $this->db->delete('product_attribute');
        $productAttributeType = $this->input->post('productAttributeType');
        foreach ($productAttributeType as $attributeKey => $attributeValue) {
            if (count($this->input->post('productAttribute_' . $attributeValue)) > 0) {
                $productAttribute = array();
                $productAttributes = $this->input->post('productAttribute_' . $attributeValue);
                for ($i = 0; $i < count($productAttributes); $i++) {
                    $productAttributesData['productId'] = $productId;
                    $productAttributesData['attributeType'] = $attributeValue;
                    $productAttributesData['attributeId'] = $productAttributes[$i];
                    $this->db->insert('product_attribute', $productAttributesData);
                }
            }
        }
        return true;
    }

    function updateProductOccasions($productId) {
        $this->db->where('productId', $productId);
        $this->db->delete('product_occasion');
        $productOccasions = $this->input->post('productOccasions');
        for ($i = 0; $i < count($productOccasions); $i++) {
            $productOccasionsData['productId'] = $productId;
            $productOccasionsData['occasionId'] = $productOccasions[$i];
            $this->db->insert('product_occasion', $productOccasionsData);
        }
    }

    function updateProductRelations($productId) {
        $this->db->where('productId', $productId);
        $this->db->delete('product_relation');
        $productRelations = $this->input->post('productRelations');
        for ($i = 0; $i < count($productRelations); $i++) {
            $productRelationsData['productId'] = $productId;
            $productRelationsData['relationId'] = $productRelations[$i];
            $this->db->insert('product_relation', $productRelationsData);
        }
    }

    function product_category($productId) {
        $this->db->where('productId', $productId);
        $this->db->delete('product_category');
        $productCategories = $this->input->post('productCategories');
        for ($i = 0; $i < count($productCategories); $i++) {
            $productCategoriesData['productId'] = $productId;
            $productCategoriesData['catId'] = $productCategories[$i];
            $this->db->insert('product_category', $productCategoriesData);
        }
    }

    function insertProductCategory() {
        $userData['catName'] = $this->input->post('catName');
        $userData['parentId'] = $this->input->post('parentCatId');
        $userData['status'] = $this->input->post('status');
        if ($this->db->insert('master_categories', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateProductCategory() {
        $catId = $this->input->post('catId');
        $userData['catName'] = $this->input->post('catName');
        $userData['parentId'] = $this->input->post('parentCatId');
        $userData['status'] = $this->input->post('status');
        $this->db->where('catId', $catId);
        $this->db->update('master_categories', $userData);
        return true;
    }

    function toggleProductCategoryStatus($catId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('catId', $catId);
        $this->db->update('master_categories', $data);
        return $statusToUpdate;
    }

    function toggleCityStatus($cityId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('city_id', $cityId);
        $this->db->update('master_cities', $data);
        return $statusToUpdate;
    }

    function toggleCustomerStatus($customerId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('customerId', $customerId);
        $this->db->update('master_customer', $data);
        return $statusToUpdate;
    }

    function toggleOccasionStatus($occasionId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('occasionId', $occasionId);
        $this->db->update('master_occasions', $data);
        return $statusToUpdate;
    }

    function toggleRelationStatus($relationId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('relationId', $relationId);
        $this->db->update('master_relations', $data);
        return $statusToUpdate;
    }
    
    function toggleAddonProductStatus($prodId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('prodId', $prodId);
        $this->db->update('addon_products', $data);
        return $statusToUpdate;
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

    function toggleTestimonialStatus($testimonialId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('testimonial_id', $testimonialId);
        $this->db->update('master_testimonials', $data);
        return $statusToUpdate;
    }

    function toggleVendorStatus($vendorId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('vendor_id', $vendorId);
        $this->db->update('master_vendor', $data);
        return $statusToUpdate;
    }

    function toggleVendorPreferred($vendorId, $status) {
        $statusToUpdate = ($status == 'Preferred') ? ('Unpreferred') : ('Preferred');
        $data = array(
            'is_preferred' => $statusToUpdate,
            'modify_date' => date("Y-m-d H:i:s"),
            'modify_by' => $this->session->userdata('sysuser_loggedin_user')
        );
        $this->db->where('vendor_id', $vendorId);
        $this->db->update('master_vendor', $data);
        return $statusToUpdate;
    }

    function toggleProductStatus($productId, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
        );
        $this->db->where('productId', $productId);
        $this->db->update('master_product', $data);
        return $statusToUpdate;
    }

    function toggleProductHome($productId, $status) {
        $statusToUpdate = ($status == '1') ? ('0') : ('1');
        $data = array(
            'isHome' => $statusToUpdate,
        );
        $this->db->where('productId', $productId);
        $this->db->update('master_product', $data);
        return $statusToUpdate;
    }

    function toggleProductFeatured($productId, $status) {
        $statusToUpdate = ($status == '1') ? ('0') : ('1');
        $data = array(
            'isFeatured' => $statusToUpdate,
        );
        $this->db->where('productId', $productId);
        $this->db->update('master_product', $data);
        return $statusToUpdate;
    }

    function toggleProductSpecial($productId, $status) {
        $statusToUpdate = ($status == '1') ? ('0') : ('1');
        $data = array(
            'isSpecial' => $statusToUpdate,
        );
        $this->db->where('productId', $productId);
        $this->db->update('master_product', $data);
        return $statusToUpdate;
    }
    
    function toggleProductFreqBrought($productId, $status) {
        $statusToUpdate = ($status == '1') ? ('0') : ('1');
        $data = array(
            'isFreqBought' => $statusToUpdate,
        );
        $this->db->where('productId', $productId);
        $this->db->update('master_product', $data);
        return $statusToUpdate;
    }

    function deleteProductCategory($catId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('catId', $catId);
        $this->db->update('master_categories', $data);
        return true;
    }

    function deleteProduct($productId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('productId', $productId);
        $this->db->update('master_product', $data);
        return true;
    }

    function deleteVendor($vendorId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('vendor_id', $vendorId);
        $this->db->update('master_vendor', $data);
        return true;
    }

    function cityDelete($cityId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('city_id', $cityId);
        $this->db->update('master_cities', $data);
        return true;
    }

    function customerDelete($customerId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('customerId', $customerId);
        $this->db->update('master_customer', $data);
        return true;
    }

    function occasionDelete($occasionId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('occasionId', $occasionId);
        $this->db->update('master_occasions', $data);
        return true;
    }

    function relationDelete($relationId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('relationId', $relationId);
        $this->db->update('master_relations', $data);
        return true;
    }
    
    function addonProductDelete($prodId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('prodId', $prodId);
        $this->db->update('addon_products', $data);
        return true;
    }

    function prodAttributeDelete($attributeId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('attributeId', $attributeId);
        $this->db->update('master_attributes', $data);
        return true;
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
                $catId = $orderVal['id'];
                $userData['parentId'] = $parentId;
                $userData['catSeq'] = $orderKey;
                $this->db->where('catId', $catId);
                $this->db->update('master_categories', $userData);
                $this->saveCategoryOrder($orderVal['children'], $orderVal['id']);
            } else {
                $catId = $orderVal['id'];
                $userData['parentId'] = $parentId;
                $userData['catSeq'] = $orderKey;
                $this->db->where('catId', $catId);
                $this->db->update('master_categories', $userData);
            }
        }
    }

    public function getAssignedVendors($productId) {
        $data = array();
        $this->db->select('*');
        $this->db->where('productId', $productId);
        $query = $this->db->get('product_vendor');
        foreach ($query->result() as $row) {
            $data[] = $row->vendor_id;
        }
        return $data;
    }

    public function getAssignedOccasions($productId) {
        $data = array();
        $this->db->select('*');
        $this->db->where('productId', $productId);
        $query = $this->db->get('product_occasion');
        foreach ($query->result() as $row) {
            $data[] = $row->occasionId;
        }
        return $data;
    }

    public function getAssignedProductAttributes($productId) {
        $data = array();
        $this->db->select('*');
        $this->db->where('productId', $productId);
        $query = $this->db->get('product_attribute');
        foreach ($query->result() as $row) {
            $data[] = $row->attributeId;
        }
        return $data;
    }

    public function getAssignedRelations($productId) {
        $data = array();
        $this->db->select('*');
        $this->db->where('productId', $productId);
        $query = $this->db->get('product_relation');
        foreach ($query->result() as $row) {
            $data[] = $row->relationId;
        }
        return $data;
    }

    public function getAssignedCategories($productId) {
        $data = array();
        $this->db->select('*');
        $this->db->where('productId', $productId);
        $query = $this->db->get('product_category');
        foreach ($query->result() as $row) {
            $data[] = $row->catId;
        }
        return $data;
    }

    function insertVendor() {
        $userData['vendor_name'] = $this->input->post('vendor_name');
        $userData['contact_name'] = $this->input->post('contact_name');
        $userData['email'] = $this->input->post('email');
        $userData['alternate_email'] = $this->input->post('alternate_email');
        $userData['shipping_charge'] = $this->input->post('shipping_charge');
        $userData['mobile'] = $this->input->post('mobile');
        $userData['alternate_number'] = $this->input->post('alternate_number');
        $userData['address'] = $this->input->post('address');
        $userData['city'] = $this->input->post('city');
        $userData['state'] = $this->input->post('state');
        $userData['bank_detail'] = $this->input->post('bank_detail');
        $userData['comments'] = $this->input->post('comments');
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('master_vendor', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateVendor() {
        $vendor_id = $this->input->post('vendor_id');
        $userData['vendor_name'] = $this->input->post('vendor_name');
        $userData['contact_name'] = $this->input->post('contact_name');
        $userData['email'] = $this->input->post('email');
        $userData['alternate_email'] = $this->input->post('alternate_email');
        $userData['shipping_charge'] = $this->input->post('shipping_charge');
        $userData['mobile'] = $this->input->post('mobile');
        $userData['alternate_number'] = $this->input->post('alternate_number');
        $userData['address'] = $this->input->post('address');
        $userData['city'] = $this->input->post('city');
        $userData['state'] = $this->input->post('state');
        $userData['bank_detail'] = $this->input->post('bank_detail');
        $userData['comments'] = $this->input->post('comments');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('vendor_id', $vendor_id);
        $this->db->update('master_vendor', $userData);
        return true;
    }
    
    function updateVendorPayments() {
        $orderIds = $this->input->post('orderId');
        $paidToVendor = $this->input->post('paid_to_vendor');
        $paymentStatus = $this->input->post('paymentStatus');
        
        $i = 0;
        foreach ($orderIds as $key => $orderId) {
            $userData[$i]['order_id'] = $orderId;
            $userData[$i]['paid_to_vendor'] = $paidToVendor[$key];
            $userData[$i]['vendor_payment_status'] = $paymentStatus[$key];
            $i++;
        }
        $this->db->update_batch('orders', $userData,'order_id');
        return true;
    }

    function updateMarkupMeter() {
        $markupMeter_id = $this->input->post('markupMeter_id');
        $userData['multiplier'] = $this->input->post('multiplier');
        $userData['markup'] = $this->input->post('markup');
        $userData['news_flash'] = $this->input->post('news_flash');
        $this->db->where('id', $markupMeter_id);
        $this->db->update('markup_meter', $userData);
        return true;
    }

    function insertCity() {
        $userData['city_name'] = $this->input->post('city_name');
        $userData['country_name'] = $this->input->post('country_name');
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('master_cities', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateCity() {
        $city_id = $this->input->post('city_id');
        $userData['city_name'] = $this->input->post('city_name');
        $userData['country_name'] = $this->input->post('country_name');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('city_id', $city_id);
        $this->db->update('master_cities', $userData);
        return true;
    }

    public function setMainImg($productId, $image) {
        $galleryData['productImg'] = $image;
        $this->db->where('productId', $productId);
        $this->db->update('master_product', $galleryData);
        return true;
    }

    public function getMainImg($productId) {
        $this->db->where('productId', $productId);
        $this->db->select('productImg');
        $query = $this->db->get('master_product');
        $res = $query->row_array();
        return $res['productImg'];
    }

    public function deleteImg($productId, $image) {

        $file_name = $image;
        $file_path = getcwd() . $this->config->item('productImgPath') . $file_name;
        $file_path_thumb = getcwd() . $this->config->item('productThumbImgPath') . $file_name;

        @unlink($file_path);
        @unlink($file_path_thumb);

        $this->db->where('img_name', $file_name);
        $this->db->delete('master_gallery');
        $mainImg = $this->getMainImg($productId);
        if ($mainImg == $file_name) {
            $this->setMainImg($productId, $this->config->item('defaultMainImg'));
        }
        return true;
    }

    public function getMarkupMeter() {
        $markupMeter_id = 1;
        $this->db->select('*');
        $this->db->where('id', $markupMeter_id);
        $query = $this->db->get('markup_meter');
        return $markupMeter = $query->row_array();
    }

    function getTestimonialsList() {
        $testimonialsList = array();
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $this->db->from('master_testimonials');
        $this->db->order_by('testimonial_id', 'DESC');
        $query = $this->db->get();
        $testimonialsList = $query->result();
        return $testimonialsList;
    }

    function deleteTestimonial($testimonialId) {
        $data = array(
            'status' => 'Delete',
        );
        $this->db->where('testimonial_id', $testimonialId);
        $this->db->update('master_testimonials', $data);
        return true;
    }

    function insertTestimonial() {
        $userData['testimonial'] = $this->input->post('testimonial');
        $userData['customer_name'] = $this->input->post('customer_name');
        $userData['city'] = $this->input->post('city');
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('master_testimonials', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateTestimonial() {
        $testimonial_id = $this->input->post('testimonial_id');
        $userData['testimonial'] = $this->input->post('testimonial');
        $userData['customer_name'] = $this->input->post('customer_name');
        $userData['city'] = $this->input->post('city');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('testimonial_id', $testimonial_id);
        $this->db->update('master_testimonials', $userData);
        return true;
    }

    public function getTestimonial($testimonial_id) {
        $table_name = "master_testimonials";
        $this->db->where('testimonial_id', $testimonial_id);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }

    function insertCustomer() {
        $userData['firstName'] = $this->input->post('firstName');
        $userData['lastName'] = $this->input->post('lastName');
        $userData['email'] = $this->input->post('email');
        $userData['mobile'] = $this->input->post('mobile');
        $userData['customerType'] = $this->input->post('customerType');
        $userData['discountCoupon'] = $this->input->post('discountCoupon');
        $userData['phone'] = $this->input->post('phone');
        $userData['companyName'] = $this->input->post('companyName');
        $userData['username'] = $this->input->post('username');
        $userData['password'] = $this->encrypt->encode($this->input->post('password'));
        $userData['address'] = $this->input->post('address');
        $userData['city'] = $this->input->post('city');
        $userData['state'] = $this->input->post('state');
        $userData['country'] = $this->input->post('country');
        $userData['zipCode'] = $this->input->post('zipCode');
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('master_customer', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateCustomer() {
        $customerId = $this->input->post('customerId');
        $userData['firstName'] = $this->input->post('firstName');
        $userData['lastName'] = $this->input->post('lastName');
        $userData['email'] = $this->input->post('email');
        $userData['mobile'] = $this->input->post('mobile');
        $userData['customerType'] = $this->input->post('customerType');
        $userData['discountCoupon'] = $this->input->post('discountCoupon');
        $userData['phone'] = $this->input->post('phone');
        $userData['companyName'] = $this->input->post('companyName');
        $userData['password'] = $this->encrypt->encode($this->input->post('password'));
        $userData['address'] = $this->input->post('address');
        $userData['city'] = $this->input->post('city');
        $userData['state'] = $this->input->post('state');
        $userData['country'] = $this->input->post('country');
        $userData['zipCode'] = $this->input->post('zipCode');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('customerId', $customerId);
        $this->db->update('master_customer', $userData);
        return true;
    }

    function insertOccasion() {
        $userData['occasion'] = $this->input->post('occasion');
        $userData['upcomingDate'] = $this->input->post('upcomingDate');
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('master_occasions', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateOccasion() {
        $occasionId = $this->input->post('occasionId');
        $userData['occasion'] = $this->input->post('occasion');
        $userData['upcomingDate'] = $this->input->post('upcomingDate');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('occasionId', $occasionId);
        $this->db->update('master_occasions', $userData);
        return true;
    }

    function insertRelation() {
        $userData['relation'] = $this->input->post('relation');
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('master_relations', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateRelation() {
        $relationId = $this->input->post('relationId');
        $userData['relation'] = $this->input->post('relation');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('relationId', $relationId);
        $this->db->update('master_relations', $userData);
        return true;
    }

    function insertProdAttribute() {
        $userData['attributeType'] = $this->input->post('attributeType');
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
        $userData['attributeType'] = $this->input->post('attributeType');
        $userData['attributeValue'] = $this->input->post('attributeValue');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('attributeId', $attributeId);
        $this->db->update('master_attributes', $userData);
        return true;
    }
    
    function insertAddonProduct() {
        $userData['productId'] = $this->input->post('product');
        $userData['productName'] = $this->input->post('productName');
        $userData['purchaseCost'] = $this->input->post('purchaseCost');
        $userData['saleCost'] = $this->input->post('saleCost');
        $userData['info'] = $this->input->post('info');
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('addon_products', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateAddonProduct() {
        $prodId = $this->input->post('prodId');
        $userData['productId'] = $this->input->post('product');
        $userData['productName'] = $this->input->post('productName');
        $userData['purchaseCost'] = $this->input->post('purchaseCost');
        $userData['saleCost'] = $this->input->post('saleCost');
        $userData['info'] = $this->input->post('info');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('prodId', $prodId);
        $this->db->update('addon_products', $userData);
        return true;
    }

}

?>