<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {
        var $customReviewConfig;
	/**
	 * Product controller.
	 */
	function __construct(){
		parent::__construct();
                $this->load->library("xajax_pagination");
                $this->xajax->register(XAJAX_FUNCTION, array('isUsefullReview', &$this, 'isUsefullReview'));
                $this->xajax->register(XAJAX_FUNCTION, array('addProductReview', &$this, 'addProductReview'));
                $this->xajax->register(XAJAX_FUNCTION, array('nextProdReview', &$this, 'nextProdReview'));
                $this->xajax->register(XAJAX_FUNCTION, array('sortReviews', &$this, 'sortReviews'));
                $this->xajax->register(XAJAX_FUNCTION, array('refineSearchResult', &$this, 'refineSearchResult'));
                $this->xajax->register(XAJAX_FUNCTION, array('setRefineCriteria', &$this, 'setRefineCriteria'));
                $this->xajax->register(XAJAX_FUNCTION, array('loadMoreResult', &$this, 'loadMoreResult'));
                $this->xajax->register(XAJAX_FUNCTION, array('toggleToWishlist', &$this, 'toggleToWishlist'));
                $this->xajax->register(XAJAX_FUNCTION, array('savesearch', &$this, 'savesearch'));
                
                
                $this->xajax->processRequest();
                $uniqueId = $this->datacache->saveCache($cacheData,'productduniya');
	}
	
	public function index()
	{	
		$this->initRefineCriteria();
                $data['productList'] = $this->common_model->getProducts();
                $this->productList($data);
	}
        
        /**
	 * Initiate default refine criteria. 
	 */
	public function initRefineCriteria(){
            $cacheData = $this->datacache->getCache();
            $cacheData['refineSearch'] = array();
            $this->datacache->appendCache($cacheData);
            
            $cacheData = $this->datacache->getCache();            
            $cacheData['refineSearch']['priceRange']['priceFrom'] = '0.00';
            $cacheData['refineSearch']['priceRange']['priceTo'] = '0.00';			
            $cacheData['refineSearch']['sort']['sortBy'] = $this->config->item('sortBy');
            $cacheData['refineSearch']['sort']['sortDirection'] = $this->config->item('sortDirection');
            $cacheData['refineSearch']['keyword'] = '';
            $cacheData['refineSearch']['categoryReverseChain'] = '';
            $cacheData['refineSearch']['filterCategories'] = '';
            $cacheData['refineSearch']['brandId'] = '';
            $this->datacache->appendCache($cacheData);
	}
        
        /**
	 * cache recent refine criteria based on new selection. 
	 * @param integer $refineIndex
	 * @param array $refineValueArr
	 */
	public function setRefineCriteria($refineIndex,$refineValueArr){
		$objResponse = new xajaxResponse();		
		$cacheData = $this->datacache->getCache();

		if($refineIndex=='priceRange'){
                    $cacheData['refineSearch'][$refineIndex]['priceFrom'] = $refineValueArr[0];
                    $cacheData['refineSearch'][$refineIndex]['priceTo'] = $refineValueArr[1];
		}elseif($refineIndex=='sort'){
                    $cacheData['refineSearch'][$refineIndex]['sortBy'] = $refineValueArr[0];
                    $cacheData['refineSearch'][$refineIndex]['sortDirection'] = $refineValueArr[1];
		}elseif($refineIndex=='filterBrands'){
                    $cacheData['refineSearch'][$refineIndex] = $refineValueArr;
		}else{                
                    $cacheData['refineSearch']['dynamicFilters'][$refineIndex] = $refineValueArr;
                }
                
		$this->datacache->appendCache($cacheData);
                //print_r($cacheData);exit;
		$objResponse->script("xajax_refineSearchResult(0);");
		return $objResponse;
	}
        
        /**
	 * Display product list while load more button clicked.
	 * @param integer $offset
	 */
	public function loadMoreResult($offset){
		$offset = (empty($offset))?(0):($offset);
		$objResponse = new xajaxResponse();
		$ci =&get_instance();			

                $productList = $this->common_model->getProducts();
		$refinedDataArr['products'] = array_slice($productList,$offset,$this->config->item('productPerPageCount'));
                $refinedData = $this->load->view($this->config->item('themeCode')."/productGrid_view",$refinedDataArr,true);
                
                $offset += $this->config->item('productPerPageCount');
                $objResponse->assign("offset","value",$offset);
                if(count($productList) <= $offset){
                    $objResponse->script("$('.loadMoreItems').html('No More Items');");
                }else{
                    $objResponse->script("$('.loadMoreItems').html('Load More Items');");
                }                
		$objResponse->append("prodlist","innerHTML", $refinedData);
                $objResponse->script("callRating();");                
		return $objResponse;
	}
        
        /**
	 * Display product list after applying refine criteria.
	 * @param integer $offset
	 */
	public function refineSearchResult($offset){
		$offset = (empty($offset))?(0):($offset);
		$objResponse = new xajaxResponse();
		$ci =&get_instance();			

                $productList = $this->common_model->getProducts();
		$refinedDataArr['products'] = array_slice($productList,$offset,$this->config->item('productPerPageCount'));
                $refinedData = $this->load->view($this->config->item('themeCode')."/productGrid_view",$refinedDataArr,true);
                
                $offset += $this->config->item('productPerPageCount');
                $objResponse->assign("offset","value",$offset);
                if(count($productList) <= $offset){
                    $objResponse->script("$('.loadMoreItems').html('No More Items');");
                }else{
                    $objResponse->script("$('.loadMoreItems').html('Load More Items');");
                }                
		$objResponse->assign("prodlist","innerHTML", $refinedData);
                $objResponse->assign("totalProd","innerHTML", "Showing " . count($productList) . " Products");
                $objResponse->script("callRating();");
		return $objResponse;
	}
        
        public function cat($categoryId,$categoryName,$filterOption='')
	{
                $this->initRefineCriteria();
                /* Meta Start */
                $data['metaTarget'] = "Category";
                $data['metaTargetCode'] = $categoryId;
                /* Meta End */
                
                $categoryReverseChain = $this->common_model->getCategoryReverseChain($categoryId);
                sort($categoryReverseChain);
                
                /* Breadcrumbs Start */
                $this->breadcrumb->append_crumb('Home', site_url());
                foreach ($categoryReverseChain as $keyIndex => $catData){
                    $this->breadcrumb->append_crumb($catData->categoryName, site_url('product/cat/'.$catData->categoryId.'/'.url_title(strtolower($catData->categoryName))));
                }
                /* Breadcrumbs End */
                if(count($categoryReverseChain) > 0){
                    foreach ($categoryReverseChain as $keyIndex => $category)
                    {
                        $categoryIds[] = $category->categoryId;
                    }
                }

                $cacheData = $this->datacache->getCache();
                $cacheData['refineSearch']['categoryReverseChain'] = $categoryIds;
                $cacheData['refineSearch']['filterCategories'] = $categoryId;
                $this->datacache->appendCache($cacheData);

                $data['productList'] = $this->common_model->getProducts();
                $data['keyword'] = $this->input->post('keyword');

                $this->productList($data);
        }
        
        public function productList($data =  array())
        {
            $offset = (empty($offset))?(0):($offset);
            $cacheData = $this->datacache->getCache();
            if(isset($data['productList']) && (!empty($data['productList'])) ){
                $priceFrom = ($data['productList'][0]['storeProdStats']['min_sellPrice']!='')?($data['productList'][0]['storeProdStats']['min_sellPrice']):($data['productList'][0]['productMRP']);
                $priceTo = $priceFrom;
                foreach($data['productList'] as $responseKey => $responseArr){
                        $saleCost = ($responseArr['storeProdStats']['min_sellPrice']!='')?($responseArr['storeProdStats']['min_sellPrice']):($responseArr['productMRP']);
                        $priceFrom = ($saleCost < $priceFrom)?($saleCost):($priceFrom);
                        $priceTo = ($saleCost > $priceTo)?($saleCost):($priceTo);	
                }
                $cacheData['refineSearch']['priceRange']['priceFrom'] = $priceFrom;
                $cacheData['refineSearch']['priceRange']['priceTo'] = $priceTo;
            }
            $this->datacache->appendCache($cacheData);
            $data['totalProducts'] = "Showing " . count($data['productList']) . " Products";
            $data['products'] = array_slice($data['productList'],$offset,$this->config->item('productPerPageCount'));
            $data['productsAll'] = $data['productList'];
            $data['offset'] = $this->config->item('productPerPageCount');
            $data['template'] = "productList_view";
            $data['activePage'] = "prodDetail";
            $temp['data'] = $data;	
            $this->load->view($this->config->item('themeCode')."/common_view",$temp);
        }
		
		public function savearea() {
			$a=explode(",",$_POST['final_val']);
			$exlude=explode(",",$_POST['sub_ids']);
			$exlude=array_unique($exlude);
			$final=array();
			foreach($a as $b) {
				if(trim($b)!="") 
				$final[]=trim($b);
			}
			$final=array_unique($final);
			$this->session->set_userdata(array('areasSelected'=>$final));
			if(!empty($final)) {
			
			$subAreas=$this->common_model->GetsubAreasByMajorAreas($final,$exlude);
			if(count($subAreas)>0) {
			?>
			<ul>
			<?php
			foreach($subAreas as $areaId=>$subarea) {
				$areaName=$subarea['areaName'];
				?>
				<li class="subArealis" id="sub_<?php echo $areaId; ?>"><input type="checkbox" checked="checked" class="commencheck" id="sub_<?php echo $areaId; ?>_<?php echo str_replace(" ","",$areaName); ?>" value="<?php echo $areaId; ?>" /><label for="<?php echo $areaName; ?>"><?php echo $areaName; ?></label></li>
				<?php
			}
			?>
			</ul>
			<?php
			}
			}
			else 
			{
				echo "";
			}
			
			//print_r($this->session->userdata('areasSelected'));
		}
        
        public function search($keyword='')
	{
            $keyword = ($this->input->post('keyword')!='')?($this->input->post('keyword')):($keyword);
            $this->initRefineCriteria();

            /* Breadcrumbs Start */
            $this->breadcrumb->append_crumb('Home', site_url());
            $this->breadcrumb->append_crumb($keyword, site_url('/product/search/').$keyword);
            /* Breadcrumbs End */
            
            $cacheData = $this->datacache->getCache();
            $cacheData['refineSearch']['keyword'] = $keyword;
            $this->datacache->appendCache($cacheData);

            $data['productList'] = $this->common_model->getProducts();
            $data['keyword'] = $this->input->post('keyword');            
            $this->productList($data);
        }
        
        public function brand($brandId,$brandName)
	{
            $this->initRefineCriteria();

            /* Breadcrumbs Start */
            $this->breadcrumb->append_crumb('Home', site_url());
            $this->breadcrumb->append_crumb($brandName, site_url('/product/brand/').$brandId.'/'.$brandName);
            /* Breadcrumbs End */
            
            $cacheData = $this->datacache->getCache();
            $cacheData['refineSearch']['brandId'] = $brandId;
            $this->datacache->appendCache($cacheData);

            $data['productList'] = $this->common_model->getProducts();
            $data['keyword'] = $this->input->post('keyword');            
            $this->productList($data);            
        }
        /**
	 * 
	 * Set pagination configuration.
	 * @param integer $totalCount
	 */
	function configReviewPag($totalCount=0){
            $this->customReviewConfig['first_link'] = 'First';
            $this->customReviewConfig['last_link'] = 'Last'; 
            $this->customReviewConfig['next_link'] = 'Next'; 
            $this->customReviewConfig['prev_link'] = 'Prev'; 
            $this->customReviewConfig['uri_segment'] = '0'; 
            $this->customReviewConfig['num_links'] = '2'; 
            
            
            $this->customReviewConfig['full_tag_open'] = '<ul>'; 
            $this->customReviewConfig['full_tag_close'] = '</ul>'; 
            $this->customReviewConfig['first_tag_open'] = '<li class="next">'; 
            $this->customReviewConfig['first_tag_close'] = '</li>'; 
            $this->customReviewConfig['last_tag_open'] = '<li class="prev">'; 
            $this->customReviewConfig['last_tag_close'] = '</li>'; 
            $this->customReviewConfig['cur_tag_open'] = '<li><b><i>'; 
            $this->customReviewConfig['cur_tag_close'] = '</i></b></li>'; 
            $this->customReviewConfig['next_tag_open'] = '<li>'; 
            $this->customReviewConfig['next_tag_close'] = '</li>'; 
            $this->customReviewConfig['prev_tag_open'] = '<li>'; 
            $this->customReviewConfig['prev_tag_close'] = '</li>'; 
            $this->customReviewConfig['num_tag_open'] = '<li>'; 
            $this->customReviewConfig['num_tag_close'] = '</li>'; 
            
            
            $this->customReviewConfig['panel_to_update'] = 'reviewList'; //Div to update
            $this->customReviewConfig['function_to_call'] = "nextProdReview";
            $this->customReviewConfig['total_rows'] = $totalCount;
            $this->customReviewConfig['per_page'] = 5;
            $this->xajax_pagination->initialize($this->customReviewConfig);
	}
	
	public function detail($productId)
	{
                $session_data['productId'] = $productId;
                $session_data['orderBy'] = 'usefull';
                $this->session->set_userdata($session_data);
                $customerId = $this->session->userdata('interfaceUserId');
                
                $offset = (empty($offset))?(0):($offset);
                $prodRating = '0';                
		$data['product'] = $this->common_model->getProductDetail($productId);
                if(count($data['product']) == 0){
                    redirect(site_url());
                }
                
                $data['isInWishlist'] = $this->common_model->isInWishlist($productId,$customerId);
                $data['productSpecification'] = $this->product_model->getProductSpecifications($productId);
                $data['availableAtStores'] = $this->common_model->getAvailableAtStores($productId);
                //print_r($data['availableAtStores']);exit;
                $productReviews = $this->common_model->getProductReviews($productId);
                
                $this->common_model->setRecentViewProd($productId);
                
                $reviewCnt = count($productReviews);
                if($reviewCnt > 0){
                    $rating = '0';
                    foreach ($productReviews as $key => $review) {
                        $rating += $review['rating'];
                    }
                    $prodRating = ($rating/$reviewCnt);
                }

                $data['reviewCnt'] = $reviewCnt;
                $data['prodRating'] = $prodRating;
                $data['prodGallery'] = $this->common_model->getProductImages($productId);
                $data['storeProdStats'] = $this->common_model->getStoreProdStats();
                
                
                $this->configReviewPag($reviewCnt);
                $data['productReviews'] = array_slice($productReviews,$offset,$this->customReviewConfig["per_page"],true);
                $data["reviewPaginate"] = $this->xajax_pagination->create_links($offset);
                
                //print_debug($data['product'], __FILE__, __LINE__, 0);
                
                $data['metaTarget'] = "Product";
                $data['metaTargetCode'] = $productId;
                
                //$d = $this->common_model->getBreadcrumbCategoryChain($productId);
                //print_debug($d, __FILE__, __LINE__, 1);
                /* Breadcrumb Start */
                $this->breadcrumb->append_crumb('Home', site_url());
                $this->breadcrumb->append_crumb($data['product']['productName'], site_url('/product/detail/').$productId);
                /* Breadcrumb End */

                $data['template'] = "productDetail_view";
		$data['activePage'] = "prodDetail";
		$temp['data'] = $data;	
		$this->load->view($this->config->item('themeCode')."/common_view",$temp);
	}
        
        public function nextProdReview($offset)
        {
            $offset = (empty($offset))?(0):($offset);
            $objResponse = new xajaxResponse();
            $ci =&get_instance();			
            //$objResponse->Assign("propertyListContainer","innerHTML", "<div id='emptyProperty'><center>Processing...Please wait</center></div>");	
            $productId = $this->session->userdata('productId');
            $productReviews = $this->common_model->getProductReviews($productId);
            
            $this->configReviewPag(count($productReviews));
            $data['productReviews'] = array_slice($productReviews,$offset,$this->customReviewConfig["per_page"],true);
            $links_pager = $this->xajax_pagination->create_links($offset);
            
            $refinedData = $this->load->view($this->config->item('themeCode')."/listProdReviewAjax",$data,true);
            $objResponse->Assign("reviewPaginate","innerHTML", $links_pager);
            $objResponse->Assign("reviewList","innerHTML", $refinedData);
            return $objResponse;
        }

        public function isUsefullReview($reviewId, $status) {
            $objResponse = new xajaxResponse();
            $cnt = $this->product_model->isUsefullReview($reviewId, $status);
            $spanId = ($status)?('yes-'.$reviewId):('no-'.$reviewId);
            $objResponse->Assign($spanId, "innerHTML", $cnt);
            return $objResponse;
        }
        
        public function addProductReview($formData)
        {
            foreach ($formData as $id => $field) {
                $_POST[$id] = $field;
            }
            $objResponse = new xajaxResponse();
            $response = $this->product_model->addProductReview();
            $objResponse->Assign("reviewTlt", "innerHTML", '<center><b>Thank you for your kind words.</b></center>');
            $objResponse->Assign("reviewMsg", "innerHTML", '');
            return $objResponse;
            
        }
        
        public function sortReviews($orderBy)
        {
            $session_data['orderBy'] = $orderBy;
            $this->session->set_userdata($session_data);
            $objResponse = new xajaxResponse();
            
            $rmClass = ($orderBy=='usefull')?('create_date'):('usefull');
            $objResponse->script("$('#$orderBy').addClass('active');");
            $objResponse->script("$('#$rmClass').removeClass('active');");
            $objResponse->script("xajax_nextProdReview(0);");
            return $objResponse;
        }
        
        public function getTopSearchAutoComplete() {
            if (isset($_GET['term'])) {
                $term = $_GET['term'];
            }
            $suggestions = $this->product_model->getTopSearchAutoComplete($term);
            $suggestions = json_encode($suggestions);
            print_r($suggestions); // print response to populate in drop down.
        }
        
        public function toggleToWishlist($productId)
        {
            $objResponse = new xajaxResponse();
            $customerId = $this->session->userdata('interfaceUserId');
            $isInWishlist = $this->common_model->isInWishlist($productId,$customerId);
            if($isInWishlist){
                $this->common_model->removeFromWishlist($productId,$customerId);
            }else{                
                $this->common_model->addToWishlist($productId,$customerId);
            }
            $objResponse->Alert("Wishlist updated succefully.");
            $objResponse->script("window.location.reload();");
            return $objResponse;
        }
		public function savesearch($prodoct_name,$product_id,$availableAtStoresIds) {
		$objResponse = new xajaxResponse();
			$availableAtStoresIds=explode(",",$availableAtStoresIds);			
			$this->common_model->Savesaved_search($prodoct_name,$product_id,$availableAtStoresIds,$this->session->userdata('areasSelected'));
			
			//$objResponse->Alert($ret);
			return $objResponse;	
		}
		
		public function pdf($productId) {
			$session_data['productId'] = $productId;
                $session_data['orderBy'] = 'usefull';
                $this->session->set_userdata($session_data);
                $customerId = $this->session->userdata('interfaceUserId');
                
                $offset = (empty($offset))?(0):($offset);
                $prodRating = '0';                
		$data['product'] = $this->common_model->getProductDetail($productId);
                if(count($data['product']) == 0){
                    redirect(site_url());
                }
                
                $data['isInWishlist'] = $this->common_model->isInWishlist($productId,$customerId);
                $data['productSpecification'] = $this->product_model->getProductSpecifications($productId);
                $data['availableAtStores'] = $this->common_model->getAvailableAtStores($productId);
                //print_r($data['availableAtStores']);exit;
                //$productReviews = $this->common_model->getProductReviews($productId);
                
                $this->common_model->setRecentViewProd($productId);
                /*
                $reviewCnt = count($productReviews);
                if($reviewCnt > 0){
                    $rating = '0';
                    foreach ($productReviews as $key => $review) {
                        $rating += $review['rating'];
                    }
                    $prodRating = ($rating/$reviewCnt);
                }*/

                //$data['reviewCnt'] = $reviewCnt;
                //$data['prodRating'] = $prodRating;
                //$data['prodGallery'] = $this->common_model->getProductImages($productId);
                $data['storeProdStats'] = $this->common_model->getStoreProdStats();
                
                
                //$this->configReviewPag($reviewCnt);
                //$data['productReviews'] = array_slice($productReviews,$offset,$this->customReviewConfig["per_page"],true);
                //$data["reviewPaginate"] = $this->xajax_pagination->create_links($offset);
                
                //print_debug($data['product'], __FILE__, __LINE__, 0);
                
                $data['metaTarget'] = "Product";
                $data['metaTargetCode'] = $productId;
                
                //$d = $this->common_model->getBreadcrumbCategoryChain($productId);
                //print_debug($d, __FILE__, __LINE__, 1);
                /* Breadcrumb Start */
                //$this->breadcrumb->append_crumb('Home', site_url());
                //$this->breadcrumb->append_crumb($data['product']['productName'], site_url('/product/detail/').$productId);
                /* Breadcrumb End */

                $data['template'] = "productDetail_pdf";
		$data['activePage'] = "prodDetail";
		$temp['data'] = $data;
		
		// include pdf files
		
		//require_once(FCPATH.'/application/html2pdf/html2pdf.class.php');
		require_once(FCPATH.'/application/dompdf/dompdf_config.inc.php');
		ob_start();
     
		$this->load->view($this->config->item('themeCode')."/common_pdf",$temp);
		$content = ob_get_clean();
		
		//echo $content;
		$dompdf = new DOMPDF();
		  $dompdf->load_html($content);
		//  $dompdf->set_paper($_POST["paper"], $_POST["orientation"]);
		  $dompdf->render();

		  $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
		}
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */