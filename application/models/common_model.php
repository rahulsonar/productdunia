<?php
class Common_model extends CI_Model {
	function __construct()
    {
        parent::__construct();
        $this->load->library('encrypt');
    }
    
	
    public function get_branches()
    {
        $this->db->select('*');
        $query = $this->db->get('master_branch');
        foreach ($query->result() as $row){
                $branch[$row->branch_id] = $row->branch_name;
        };
        return $branch;
    }

    public function get_timezones()
    {
        $this->db->select('*');
        $query = $this->db->get('master_timezone');
        foreach ($query->result() as $row){
                $timezone[$row->timezone] = $row->timezone_name;
        };
        return $timezone;
    }

    public function get_timezones1($page,$offset)
    {
        $this->db->select('*');
        $query = $this->db->get('master_timezone',$page,$offset);
        return $query->result();
    }

    public function getTimezoneOffset($timeZoneString)
    {
        $timezone = '0';
        $this->db->select('timezone');
        $this->db->where('timezoneGMT', $timeZoneString);
        $query = $this->db->get('master_timezone');
        //if(!empty($query->row())){
                $timezone = $query->row()->timezone;
        //}
        return $timezone;
    }
    
    function send_email($optionData)
    {
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html';		
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);

        $this->email->from($optionData['senderEmail'], $optionData['senderName']);
        $this->email->to($optionData['receiverEmail']);

        $this->email->subject($optionData['subject']);
        $this->email->message($optionData['msg']);

        $response = $this->email->send();
        return $response;		
    }
    
    
    public function get_agencies($extraOption = '0')
    {
        $agencies = ($extraOption == '1') ? (array('' => 'Select agency')) : (array());
        
        $this->db->select('*');
        $query = $this->db->get('agencies');
        foreach ($query->result() as $row){
                $agencies[$row->agencyId] = $row->agencyName;
        };
        return $agencies;
    }
    
    public function getCityBy($target,$targetId,$extraOption = '0') {
        $cities = ($extraOption == '1') ? (array('' => 'Select city')) : (array());
        
        if($target=="cityId"){
            $this->db->where('cityId', $targetId);
        }  elseif ($target=="countryId") {
            $this->db->where('countryId', $targetId);
        }  elseif ($target=="cityName") {
            $this->db->where('cityName', $targetId);
        }
        
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $query = $this->db->get('cities');
        foreach ($query->result() as $row){
                $cities[$row->cityId] = $row->cityName;
        };
        return $cities;
    }
    
    public function getAreaBy($target,$targetId,$extraOption = '0') {
        $areas = ($extraOption == '1') ? (array('' => 'Select area')) : (array());
        
        if($target=="areaId"){
            $this->db->where('areaId', $targetId);
        }  elseif ($target=="cityId") {
            $this->db->where('cityId', $targetId);
        }  elseif ($target=="areaName") {
            $this->db->where('areaName', $targetId);
        }
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $query = $this->db->get('areas');
        foreach ($query->result() as $row){
                $areas[$row->areaId] = $row->areaName;
        };
        return $areas;
    }
    
    function getCountries($extraOption = '0') {
        $countries = ($extraOption == '1') ? (array('' => 'Select country')) : (array());
        //$this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $this->db->order_by('countryName', 'ASC');
        $query = $this->db->get('countries');
        foreach ($query->result() as $row){
                $countries[$row->countryId] = $row->countryName;
        };
        return $countries;
    }
    
    public function getProductAttributeType($extraOption = '0') {
        $productAttributeType = ($extraOption == '1') ? (array('' => 'Select attribute type')) : (array());
        $this->db->distinct();
        $this->db->select('attributeType');
        $this->db->order_by('attributeType', 'ASC');
        $query = $this->db->get('master_attributes');
        foreach ($query->result() as $row){
                $productAttributeType[$row->attributeType] = $row->attributeType;
        };
        return $productAttributeType;
    }
    
    public function getBrands($extraOption = '0') {
        $brands = ($extraOption == '1') ? (array('' => 'Select brand')) : (array());
        $this->db->distinct();
        $this->db->where('status != ', 'Delete');
        $this->db->select('brandId, brandName');
        $this->db->order_by('brandName', 'ASC');
        $query = $this->db->get('brands');
        foreach ($query->result() as $row){
                $brands[$row->brandId] = $row->brandName;
        };
        return $brands;
    }
    
    public function getProductSpecificationGroup($extraOption = '0') {
        $productSpecificationGroup = ($extraOption == '1') ? (array('' => 'Select specification group')) : (array());
        $this->db->select('*');
        $this->db->order_by('groupName', 'ASC');
        $query = $this->db->get('specification_group');
        foreach ($query->result() as $row){
                $productSpecificationGroup[$row->groupId] = $row->groupName;
        };
        return $productSpecificationGroup;
    }
    
    function _uploadXLS() {
        $this->load->helper('string');
        $config['upload_path'] = $this->config->item('tempXls');
        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['file_name'] = random_string('unique');
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('excelFile')) {
            $uploadStatus = array('error' => $this->upload->display_errors());
        } else {
            $uploadStatus = array('upload_data' => $this->upload->data());
        }
        return $uploadStatus;
    }
    
    public function _readXlsFile($fileName)
    {
        $sheetData = array();
        $pathToXls = getcwd().$this->config->item('pathToXls').$fileName;
        if (file_exists($pathToXls)){
            //load our new PHPExcel library
            $this->load->library('excel');
            $objReader = PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($pathToXls);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,false,true);
        }
        return $sheetData;
    }
    
    public function _deleteTempXlsFile($fileName)
    {
        $pathToXls = getcwd().$this->config->item('pathToXls').$fileName;
        @unlink($pathToXls);
    }
    
    public function isValidXls($sheetColumns,$fields)
    {
        $res = TRUE; 
        if(count($sheetColumns) != count($fields)){
           $res = FALSE; 
        }
        foreach ($fields as $fieldKey => $fieldVal){
            if(!in_array($fieldKey, $sheetColumns)){
               $res = FALSE; 
            }
        }
        return $res;
    }
    
    public function getPublishedBrands($offset="10") {
        $this->db->select('*');
        $this->db->order_by('brandName', 'ASC');
        $this->db->where('isHome', '1');
        $this->db->limit($offset);
        $query = $this->db->get('brands');
        foreach ($query->result() as $row){
                $brands[$row->brandId] = $row;
        };
        return $brands;
    }
    
    public function getProductFilterType($categoryId, $extraOption = '0') {
        $productFilterType = ($extraOption == '1') ? (array('' => 'Select filter type')) : (array());
        $this->db->distinct();
        $this->db->select('filterType');
        $this->db->where('categoryId', $categoryId);
        $this->db->order_by('filterType', 'ASC');
        $query = $this->db->get('master_filters');
        foreach ($query->result() as $row){
            $productFilterType[$row->filterType] = $row->filterType;
        };
        return $productFilterType;
    }

    public function getStaticContent($contentId) {
        $table_name = "static_content";
        $this->db->where('id', $contentId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }

    public function updateStaticContent() {
        $contentId = $this->input->post('contentId');
        $userData['page_heading'] = $this->input->post('page_heading');
        $userData['page_content'] = $this->input->post('page_content');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('id', $contentId);
        $this->db->update('static_content', $userData);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getFAQList() {
        $faqList = array();
        $this->db->where('status != ', 'Delete');
        $this->db->select('*');
        $this->db->from('master_faq');
        $this->db->order_by('create_date', 'DESC');
        $query = $this->db->get();
        //$faqList = $query->result();
        foreach ($query->result() as $row){
                $faqList[$row->faq_category][] = $row;
        };
        return $faqList;
    }

    public function getFAQ($faqId) {
        $table_name = "master_faq";
        $this->db->where('faq_id', $faqId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->row_array());
    }

    function toggleFAQStatus($faqid, $status) {
        $statusToUpdate = ($status == 'Active') ? ('Inactive') : ('Active');
        $data = array(
            'status' => $statusToUpdate,
            'modify_date' => date("Y-m-d H:i:s"),
            'modify_by' => $this->session->userdata('sysuser_loggedin_user')
        );
        $this->db->where('faq_id', $faqid);
        $this->db->update('master_faq', $data);
        return $statusToUpdate;
    }

    function faqDelete($faqid) {
        $data = array(
            'status' => 'Delete',
            'modify_date' => date("Y-m-d H:i:s"),
            'modify_by' => $this->session->userdata('sysuser_loggedin_user')
        );
        $this->db->where('faq_id', $faqid);
        $this->db->update('master_faq', $data);
        return true;
    }

    function insertFAQ() {
        $userData['faq_category'] = ($this->input->post('questionCategoryTxt')!='')?($this->input->post('questionCategoryTxt')):($this->input->post('questionCategory'));
        $userData['faq_ques'] = $this->input->post('faq_ques');
        $userData['faq_ans'] = $this->input->post('faq_ans');
        $userData['status'] = $this->input->post('status');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = $this->session->userdata('sysuser_loggedin_user');
        if ($this->db->insert('master_faq', $userData)) {
            return true;
        } else {
            return false;
        }
    }

    function updateFAQ() {        
        $faqId = $this->input->post('faqId');
        $userData['faq_category'] = $userData['faq_category'] = ($this->input->post('questionCategoryTxt')!='')?($this->input->post('questionCategoryTxt')):($this->input->post('questionCategory'));
        $userData['faq_ques'] = $this->input->post('faq_ques');
        $userData['faq_ans'] = $this->input->post('faq_ans');
        $userData['status'] = $this->input->post('status');
        $userData['modify_date'] = date("Y-m-d H:i:s");
        $userData['modify_by'] = $this->session->userdata('sysuser_loggedin_user');
        $this->db->where('faq_id', $faqId);
        $this->db->update('master_faq', $userData);
        return false;
    }
    
    public function getQuestionCategory($extraOption = '0') {
        $questionCategory = ($extraOption == '1') ? (array('' => 'Select question category')) : (array());
        $this->db->distinct();
        $this->db->select('faq_category');
        $this->db->order_by('faq_category', 'ASC');
        $query = $this->db->get('master_faq');
        foreach ($query->result() as $row){
                $questionCategory[$row->faq_category] = $row->faq_category;
        };
        return $questionCategory;
    }
    
    function getHomeProducts() {
        $homeProducts = array();
        
        $topCats = $this->getTopParentCategories();
        foreach ($topCats as $key => $category) {
            $homeProducts[$category->categoryId]['title'] = strtoupper($category->categoryName);
            $homeProducts[$category->categoryId]['viewAll'] = site_url('product/cat/'.$category->categoryId.'/'.url_title(strtolower($category->categoryName)));
            $homeProducts[$category->categoryId]['prods'] = $this->getCategoryProductsForHome('',$category->categoryId);
        }
        
        
        /*$homeProducts['automobile']['title'] = 'AUTOMOBILE';
        $homeProducts['automobile']['viewAll'] = '#';
        $homeProducts['automobile']['prods'] = $this->getCategoryProductsForHome('',2);
        
        $homeProducts['books']['title'] = 'BOOKS';
        $homeProducts['books']['viewAll'] = '#';
        $homeProducts['books']['prods'] = $this->getCategoryProductsForHome('',3);*/
        
        return $homeProducts;
    }
    
    function getCategoryProductsForHome($offset='',$categoryId) {
        $offset = ($offset!='')?($offset):($this->config->item('homePageProductCount'));
        $categoryProducts = array();
        $this->db->where('p.status', 'Active');
        $this->db->where('p.isHome', '1');
        $this->db->where_in('pc.categoryId', $categoryId);
        $this->db->select('p.*, pc.categoryId');
        $this->db->from('products as p');
        $this->db->join('product_category as pc', 'pc.productId = p.productId', 'left');
        $this->db->order_by('rand()', 'DESC');
        $this->db->limit($offset);
        $query = $this->db->get();        
        foreach ($query->result_array() as $row) {
            $categoryProducts[$row['productId']] = $row;
        }
        return $categoryProducts;
    }
    
    public function getStoreProdStats()
    {
        $storeProdStats = array();
        $str = "select productId, count(storeId) as storeCnt, min(sellPrice) as min_sellPrice, max(sellPrice) as max_sellPrice, min(offerPrice) as min_offerPrice, max(offerPrice) as max_offerPrice from stores_has_products where qty > 0 and status = 'Unpublish' group by(productId)";
        $query = $this->db->query($str);
        foreach ($query->result_array() as $row) {
            $storeProdStats[$row['productId']] = $row;
        }
        return $storeProdStats;
    }
    
    function getProductCategories($parent_menu='0')
    {
            $menu = array();
            $this->db->where('parentId', $parent_menu);
            $this->db->where('status', 'Active');
            $this->db->select('*');
            $this->db->order_by('catSeq asc');
            $query = $this->db->get('categories');
            $j=0;
            foreach ($query->result() as $row){
                    $menu[$j]['categoryId'] = $row->categoryId;
                    $menu[$j]['parentId'] = $row->parentId;
                    $menu[$j]['name'] = $row->categoryName;
                    $menu[$j]['submenus'] = $this->getProductCategories($row->categoryId);
                    $j++;
            }	
            return $menu;
    }
    
    function getTopParentCategories()
    {
            $menu = array();
            $this->db->where('parentId', 0);
            $this->db->where('status', 'Active');
            $this->db->select('*');
            $this->db->order_by('catSeq asc');
            $query = $this->db->get('categories');
            $menu = $query->result();
            return $menu;
    }
    
    public function getProductDetail($productId)
    {
        //$productOccasions = $this->getProductsOccasions();
        //$productsRelations = $this->getProductsRelations();
        //$productsAttributes = $this->getProductsAttributes();
        //$productsAddOns = $this->getProductsAddons($productId);
        
        $table_name = "products";
        $this->db->where('productId', $productId);
        $this->db->where('status', 'Active');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        $row = $query->row_array();
        //$row['occasions'] = (count($productOccasions[$row['productId']]) > 0) ? ($productOccasions[$row['productId']]) : (array());
        //$row['relations'] = (count($productsRelations[$row['productId']]) > 0) ? ($productsRelations[$row['productId']]) : (array());
        //$row['attributes'] = (count($productsAttributes[$row['productId']]) > 0) ? ($productsAttributes[$row['productId']]) : (array());
        //$row['productsAddOns'] = (count($productsAddOns) > 0) ? ($productsAddOns) : (array());
        return ($row);
    }
    
    public function getProductImages($productId, $proImg='') {
        $table_name = "master_gallery";
        $this->db->where('targetCode', $productId);
        if ($proImg != '') {
            $this->db->where('imgName !=', $proImg);
        }
        $this->db->where('target', 'products');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        return ($query->result_array());
    }
    
    function newsletter_subscription() {
        $userData['email'] = $this->input->post('email_address');
        $userData['subscribed'] = $this->input->post('newsletter');
        $userData['create_date'] = date("Y-m-d H:i:s");
        $userData['create_by'] = 'self';
        if ($this->db->insert('newsletter_subscription', $userData)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getAvailableAtStores($productId)
    {
        //$offset = ($offset!='')?($offset):($this->config->item('homePageProductCount'));
        $availableAtStores = array();
        $this->db->where('s.status', 'Active');
        $this->db->where('shp.productId', $productId);
        $this->db->select('shp.*,s.*');
        $this->db->from('stores_has_products as shp');
        $this->db->join('stores as s', 's.storeId = shp.storeId', 'left');
        //$this->db->order_by('rand()', 'DESC');
        //$this->db->limit($offset);
        $query = $this->db->get();        
        foreach ($query->result_array() as $row) {
            $availableAtStores[$row['storeId']] = $row;
        }
        return $availableAtStores;
    }
    
    public function getProductReviews($productId)
    {
        $orderBy = $this->session->userdata('orderBy');
        $productReviews = array();
        //$this->db->where('c.status !=', 'Delete');
        $this->db->where('pr.status', 'Active');
        $this->db->where('pr.productId', $productId);
        $this->db->select('pr.*,c.name');
        $this->db->from('product_reviews as pr');
        $this->db->join('customers as c', 'c.customerId = pr.customerId', 'left');
        $this->db->order_by($orderBy, 'DESC');        
        $query = $this->db->get();        
        foreach ($query->result_array() as $row) {
            $productReviews[$row['reviewId']] = $row;
        }
        return $productReviews;
    }
    
    function getCities() {
        $cities = array();
        //$this->db->where('cityId !=', $this->session->userdata('citySelected'));
        $this->db->where('status !=', 'Delete');
        $this->db->select('*');
        $this->db->order_by('cityName', 'ASC');
        $query = $this->db->get('cities');
        foreach ($query->result() as $row){
                $cities[$row->cityId]['cityId'] = $row->cityId;
                $cities[$row->cityId]['cityName'] = $row->cityName;
                $cities[$row->cityId]['status'] = $row->status;
        };
        return $cities;
    }
    
    function getMajorAreas($cityId) {
        $data = array();
        $table_name = "areas";
        $this->db->where('cityId', $cityId);
        $this->db->where('isMajor', '1');
        $this->db->where('status != ', 'Delete');
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        foreach ($query->result() as $row){
             $data[$row->areaId] = $row->areaName;
        }
        return $data;
    }
    
    function getMetaData($metaTarget='',$metaTargetCode='') {
        $data = array();
        $table_name = "meta_data";
        $this->db->where('target', $metaTarget);
        $this->db->where('targetCode', $metaTargetCode);
        $this->db->select('*')->from($table_name);
        $query = $this->db->get();
        $data = $query->row_array();
        if(count($data) == 0){
           $data['pageTitle'] = $this->config->item('pageTitle'); 
           $data['metaKeyword'] = $this->config->item('metaKeyword');
           $data['metaDesc'] = $this->config->item('metaDesc');
        }else{
            $data['pageTitle'] .= $this->config->item('pageTitle'); 
        }
        return $data;
    }
    
    public function getProducts()
    {
        $storeProdStats = $this->getStoreProdStats();
        $productFilters = $this->getProductFilters();
        
        $cacheData = $this->datacache->getCache();
        $filterOption['refineSearch'] = $cacheData['refineSearch'];
        //print_debug($filterOption,__FILE__,__LINE__,1);
        
        $strWhere = " WHERE p.status = 'Active' ";
        if($filterOption['refineSearch']['keyword']!=''){
            $strWhere .= " AND p.productName like '%".$filterOption['refineSearch']['keyword']."%' ";
        }
        
        if($filterOption['refineSearch']['brandId']!=''){
            $strWhere .= " AND p.brandId=".$filterOption['refineSearch']['brandId'];
        }
        
        $latestProducts = array();
        if($filterOption['refineSearch']['filterCategories']!=''){
            $strWhere .= " AND pc.categoryId=".$filterOption['refineSearch']['filterCategories'];
            $sql = "SELECT p.productMRP as '0', p.* FROM (products as p) LEFT JOIN product_category as pc ON pc.productId=p.productId " . $strWhere;    
        }else{
            $sql = "SELECT p.productMRP as '0', p.* FROM (products as p) " . $strWhere;
        }
        
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $row['storeProdStats'] = $storeProdStats[$row['productId']];
            $row['productFilters'] = $productFilters[$row['productId']];
            
            $latestProducts[] = $row;
            $brands[] = $row['brandId'];
        }
        //echo "<pre>";
        //print_r($latestProducts);exit;
        $brands = array_unique($brands);
        $cacheData = $this->datacache->getCache();
        $cacheData['refineSearch']['brands'] = $brands;
        $this->datacache->appendCache($cacheData);
        
        $latestProducts = $this->refineSearchResult($latestProducts);
        return $latestProducts;
    }
    
    function refineSearchResult($prodList) {
        $refinedArr = $prodList;
        
        $cacheData = $this->datacache->getCache();
        $priceFrom = $cacheData['refineSearch']['priceRange']['priceFrom'];
        $priceTo = $cacheData['refineSearch']['priceRange']['priceTo'];
        $sortBy = $cacheData['refineSearch']['sort']['sortBy'];
        $sortDirection = $cacheData['refineSearch']['sort']['sortDirection'];
        
        $filterBrands = $cacheData['refineSearch']['filterBrands'];
        $dynamicFilters = $cacheData['refineSearch']['dynamicFilters'];
        
        /* Refine based on price - Start */
        if($priceFrom!='0.00' && $priceTo!='0.00'){
            $searchResponse = $refinedArr;
            $refinedArr = array();
            foreach ($searchResponse as $responseKey => $responseArr) {
                $saleCost = ($responseArr['storeProdStats']['min_sellPrice']!='')?($responseArr['storeProdStats']['min_sellPrice']):($responseArr['productMRP']);
                if (($priceFrom <= $saleCost) && ($priceTo >= $saleCost)) {
                    $refinedArr[] = $responseArr;
                }
            }
        }
        /* Refine based on price - End */
        
        /* Refine based on Brands - Start */
        if(count($filterBrands) > 0){
            $searchResponse = $refinedArr;
            $refinedArr = array();
            foreach ($searchResponse as $responseKey => $responseArr) {
                if (in_array($responseArr['brandId'],$filterBrands)) {
                    $refinedArr[] = $responseArr;
                }                
            }
        }
        /* Refine based on Brands - End */
        
        /* Refine based on dynamic filters - Start */
        if(count($dynamicFilters) > 0){
            foreach ($dynamicFilters as $filterType => $filterArr) {
                $searchResponse = $refinedArr;
                if(count($filterArr)  > 0){
                    $refinedArr = array();
                    foreach ($searchResponse as $responseKey => $responseArr) {
                        if((count($responseArr['productFilters'][$filterType]) > 0)){
                            $refinedItem = array();
                            foreach ($filterArr as $filterKey => $filterVal) {
                                if (in_array($filterVal, $responseArr['productFilters'][$filterType])) {
                                    $refinedItem = $responseArr;
                                    break;
                                }
                            }
                            if(count($refinedItem) > 0){
                                $refinedArr[] = $refinedItem;
                            }
                        }
                    }
                }
            }
        }
        /* Refine based on dynamic filters - End */
        //print_r($dynamicFilters);exit;
        
        /* Result sort - Start */
        $searchResponse = $refinedArr;
        $refinedArr = array();
        foreach ($searchResponse as $responseKey => $responseArr) {
            if ($sortBy == 'price') {
                $searchResponse[$responseKey][0] = ($responseArr['storeProdStats']['min_sellPrice']!='')?($responseArr['storeProdStats']['min_sellPrice']):($responseArr['productMRP']);
            } elseif ($sortBy == 'proName') {
                $searchResponse[$responseKey][0] = $responseArr['productName'];
            }
        }
        $refinedArr = $searchResponse;
        if ($sortDirection == 'asc') {
            sort($refinedArr);
        } else {
            rsort($refinedArr);
        }
        /* Result sort - End */
        
        $refinedDataArr = $refinedArr;
        //print_debug($refinedDataArr,__FILE__,__LINE__,1);
        return $refinedDataArr;        
    }
    
    function getCategoryReverseChain($categoryId, &$prodCategoryData) {
        $this->db->where('categoryId', $categoryId);
        $this->db->where('status != ', 'Delete');
        $this->db->select('categoryId, parentId,categoryName');
        $query = $this->db->get('categories');
        $row = $query->row();
        //print_r($row);exit;
        
        $prodCategoryData[$row->categoryId] = $row;
        if($row->parentId!='0'){
            $this->getCategoryReverseChain($row->parentId, $prodCategoryData);        
        }        
        return $prodCategoryData;
    }
    
    public function getFilterBrands($brandsIds) {
        $brands = array();
        if(count($brandsIds) > 0){
            $this->db->distinct();
            $this->db->where_in('brandId', $brandsIds);
            $this->db->where('status', 'Active');
            $this->db->select('brandId, brandName');
            $this->db->order_by('brandName', 'ASC');
            $query = $this->db->get('brands');
            foreach ($query->result() as $row){
                    $brands[$row->brandId] = $row->brandName;
            }
        }
        return $brands;
    }
    
    function getDynamicFilters($categoryIds)
    {
        $dynamicFilters = array();
        if(count($categoryIds) > 0){
            $this->db->where_in('categoryId', $categoryIds);        
            $this->db->where('status', 'Active');
            $this->db->select('*');
            $query = $this->db->get('master_filters');
            foreach ($query->result() as $row){
                    $dynamicFilters[$row->filterType][$row->filterId] = $row->filterValue;
            }
        }
        return $dynamicFilters;        
    }
    
    public function getProductFilters()
    {
        
        $productFilters = array();
        $this->db->select('pf.*, mf.filterType');
        $this->db->from('product_filters as pf');
        $this->db->join('master_filters as mf', 'mf.filterId = pf.filterId', 'left');
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $productFilters[$row['productId']][url_title($row['filterType'], '-',true)][] = $row['filterId'];
        }
        return $productFilters;
    }
    
    public function setRecentViewProd($productId)
    {
        $prodArr = array();
        $prodEnc = $this->input->cookie('recentlyViewedProds',TRUE);
        if($prodEnc){
            $prodArr = unserialize($prodEnc);
        }
        
        if(count($prodArr) > 0){
           $prodArr[] = $productId; 
           $prodArr = array_unique($prodArr);
        }else{
            $prodArr = array($productId);
        }                
        $prodEnc = serialize($prodArr);        
        $cookie = array(
            'name'   => 'recentlyViewedProds',
            'value'  => $prodEnc,
            'expire' => '86500'
        );
        $this->input->set_cookie($cookie); 
    }
    
    public function getRecentViewProducts()
    {
        $prodArr = array();
        $products = array();
        $prodEnc = $this->input->cookie('recentlyViewedProds',TRUE);
        if($prodEnc){
            $prodArr = unserialize($prodEnc);
        }
        
        if(count($prodArr) > 0){
            $storeProdStats = $this->getStoreProdStats();
            $this->db->where_in('productId', $prodArr);
            $this->db->where('status', 'Active');
            $this->db->select('*');
            $query = $this->db->get('products');
            foreach ($query->result_array() as $row){
                    $row['storeProdStats'] = $storeProdStats[$row['productId']];
                    $products[$row['productId']] = $row;
            }
        }
        return $products;
    }
    
    public function getWishlistProds($customerId)
    {
        $wishlist = array();
        if($customerId !=''){
            $storeProdStats = $this->getStoreProdStats();
            $this->db->where('p.status != ', 'Delete');
            $this->db->where('pw.customerId', $customerId);
            $this->db->select('p.*');
            $this->db->from('products as p');
            $this->db->join('product_wishlist as pw', 'pw.productId = p.productId', 'left');
            $query = $this->db->get();
            //$productReviewsList = $query->result();
            foreach ($query->result_array() as $row) {
                $row['storeProdStats'] = $storeProdStats[$row['productId']];
                $wishlist[$row['productId']] = $row;
            }
        }
        return $wishlist;
    }
    
    public function isInWishlist($productId,$customerId='')
    {
        if($productId !='' && $customerId !=''){
            $data['productId'] = $productId;
            $data['customerId'] = $customerId;
            $queryUser = $this->db->get_where('product_wishlist', $data);
            if ($queryUser->num_rows > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
    
    public function addToWishlist($productId,$customerId)
    {
        if($productId !='' && $customerId !=''){
            $wishlistData['productId'] = $productId;
            $wishlistData['customerId'] = $customerId;
            $this->db->insert('product_wishlist', $wishlistData);
        }
    }
    
    public function removeFromWishlist($productId,$customerId)
    {
        if($productId !='' && $customerId !=''){
            $this->db->where('productId', $productId);
            $this->db->where('customerId', $customerId);
            $this->db->delete('product_wishlist');
        }
    }
}


?>
