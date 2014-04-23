<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends MY_Controller {

	/**
	 * Product controller.
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('store_model');
                $this->xajax->register(XAJAX_FUNCTION, array('personalInfoSubmit', &$this, 'personalInfoSubmit'));
                $this->xajax->register(XAJAX_FUNCTION, array('removeFromWishlist', &$this, 'removeFromWishlist'));
                $this->xajax->register(XAJAX_FUNCTION, array('removeFromSavedSearch', &$this, 'removeFromSavedSearch'));
                $this->xajax->register(XAJAX_FUNCTION, array('getAreaBy', &$this, 'getAreaBy'));
                $this->xajax->register(XAJAX_FUNCTION, array('getCityBy', &$this, 'getCityBy'));
                $this->xajax->register(XAJAX_FUNCTION, array('createStoreSubmit', &$this, 'createStoreSubmit'));
                $this->xajax->processRequest();
	}
	
	public function index()
	{	
		//$this->home();
	}
	
	public function removeFromSavedSearch($productId) {
		$objResponse = new xajaxResponse();
		
		$this->product_model->removeSavedSearch($productId);
		$objResponse->redirect(site_url('customer/savedsearch'));
		return $objResponse;
	}
	public function subscribe(){
            $msg = "Operation failed. Please try again later.";
            $result = $this->common_model->newsletter_subscription();
            if($result){
                   $msg = "Thank you for your interest.";
            }
            echo $msg;
       }
       
    
       
        public function logout() {
            //$this->cart->destroy();
            $this->user_model->logout();
			//var_dump($this->session->userdata('interfaceUsername'));
            redirect(site_url());
        }
		public function login() {
			$data['template'] = "loginPage_view";
			$data['login_flag'] = true;
                    
                    $temp['data'] = $data;
                    $this->load->view($this->config->item('themeCode')."/common_view", $temp);
		}
        public function loginGoogleSubmit($profile)
        {
            try {
                $user = $this->openid->getAttributes();
            } catch (GoogleApiException $e) {
                $user = '0';
            }

            if ($user == '0') {
                redirect(site_url('/'));
            } else {
                $params = array('next' => site_url('customer/logout'));
                $logoutUrl = $this->openid->getLogoutUrl($params);

                $session_data['logoutUrl'] = $logoutUrl;
                $this->session->set_userdata($session_data);

                $user_profile = $user;
                $response = $this->user_model->signupGoogleUser($user_profile);

                $redirectTo = ($this->session->userdata('redirectTo') != '') ? ($this->session->userdata('redirectTo')) : ('');
                $this->session->unset_userdata('redirectTo');
                redirect(site_url($redirectTo));
            }
        }
        
        public function loginFacebookSubmit()
        {
		
			
        	try {
        		$access_token=$this->facebook->getAccessToken();
        	}
        	catch(Exception $e)
        	{
        		$access_token="";
        	}
        	
            try {
                $user = $this->facebook->getUser();
            } catch (FacebookApiException $e) {
				//print_r($e);
                $user = '0';
            }
            
            
            if ($user == '0') {
                redirect(site_url('/'));
            } else {                
                $params = array('next' => site_url('customer/logout'));
                $logoutUrl = $this->facebook->getLogoutUrl($params);

                $session_data['logoutUrl'] = $logoutUrl;
                $this->session->set_userdata($session_data);

                $user_profile = $this->facebook->api('/me');
				
                $response = $this->user_model->signupFacebookUser($user_profile);

                $redirectTo = ($this->session->userdata('redirectTo') != '') ? ($this->session->userdata('redirectTo')) : ('');
                $this->session->unset_userdata('redirectTo');
                redirect(site_url($redirectTo));
            }
        }
        
        public function account($action) {
            $customerId = $this->session->userdata('interfaceUserId');
            if ($customerId != '') {
                switch ($action) {
                case "wishlist":
                    //$this->session->set_userdata('redirectTo','customer/account/profile');
                    /* Breadcrumbs Start */
                    $this->breadcrumb->append_crumb('Home', site_url());
                    $this->breadcrumb->append_crumb('My Wishlist', site_url());
                    /* Breadcrumbs End */
                    $wishlistData = $this->common_model->getWishlistProds($customerId);
                    //print_debug($wishlistData, __FILE__, __LINE__, 1);
                    $data['products'] = $wishlistData;
                    $data['template'] = "wishlist_view";
                    $data['home'] = "active";
                    $temp['data'] = $data;
                    $this->load->view($this->config->item('themeCode')."/common_view", $temp);
                    break;
                case "profile":
                default:
                    $this->session->set_userdata('redirectTo','customer/account/profile');
                    /* Breadcrumbs Start */
                    $this->breadcrumb->append_crumb('Home', site_url());
                    $this->breadcrumb->append_crumb('My Account', site_url());
                    /* Breadcrumbs End */
                    $customerData = $this->user_model->getCustomer($customerId);
                    //print_debug($customerData, __FILE__, __LINE__, 1);
                    $data['customerData'] = $customerData;
                    $data['template'] = "personalInfo_view";                
                    $data['home'] = "active";
                    $temp['data'] = $data;
                    $this->load->view($this->config->item('themeCode')."/common_view", $temp);
                }
            } else {
                redirect(site_url('customer/login'));
            }
        }
        public function savedsearch() {
        	$data=array();
        	
        	$products=$this->product_model->getSavedSearch();
        	$data['template']='customer_savedsearch';
			
			$data['products']=$products;
        	$temp['data'] = $data;
        	$this->load->view($this->config->item('themeCode')."/common_view", $temp);
        }
        
        public function personalInfoSubmit($formData)
        {
            foreach ($formData as $id => $field) {
                $_POST[$id] = $field;
            }
            $objResponse = new xajaxResponse();        
            $response = $this->user_model->personalInfoSubmit();
            $objResponse->Alert("Personal information updated successfully.");
            $redirectTo = ($this->session->userdata('redirectTo') != '') ? ($this->session->userdata('redirectTo')) : ('');
            if($this->session->userdata('redirect_uri')!="") {
            	$redirectTo=$this->session->userdata('redirect_uri');
            	$this->session->unset_userdata('redirect_uri');
            }
            $this->session->unset_userdata('redirectTo');
            $objResponse->redirect(site_url($redirectTo));
            return $objResponse;
        }
        
        public function removeFromWishlist($productId)
        {
            $objResponse = new xajaxResponse();
            $customerId = $this->session->userdata('interfaceUserId');
            $this->common_model->removeFromWishlist($productId,$customerId);
            $objResponse->Alert("Wishlist updated succefully.");
            $objResponse->script("window.location.reload();");
            return $objResponse;
        }
        
		public function twitterLogin() {
			$twitter_data=$this->session->userdata('twitter');
			if (empty($twitter_data['access_token']) || empty($twitter_data['access_token']['oauth_token']) || empty($twitter_data['access_token']['oauth_token_secret'])) {
				redirect(site_url('customer/twitterRedirect'));
			}
			else {
				redirect(site_url('customer/twitterLoginSite'));
			}
			
		}
		public function twitterRedirect() {
			
			$config=array();
			$config['consumer_key']=$this->config->item('twitter_api_key');
			$config['consumer_secret']=$this->config->item('twitter_secret');
			
			$this->load->library('TwitterOAuth',$config);
			 
			/* Get temporary credentials. */
			$request_token = $this->twitteroauth->getRequestToken(site_url($this->config->item('twitter_oauth_callback')));

			/* Save temporary credentials to session. */
			$twitter_data['oauth_token'] = $token = $request_token['oauth_token'];
			$twitter_data['oauth_token_secret'] = $request_token['oauth_token_secret'];
			$this->session->set_userdata(array('twitter'=>$twitter_data));
			if(200==$this->twitteroauth->http_code) {
				$url = $this->twitteroauth->getAuthorizeURL($token);
				redirect($url);
				//echo $url;
			}
			
			
		}
        public function twitteroauthcallback() {
						
			/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
			$twitter_data=$this->session->userdata('twitter');
			
			$config=array();
			$config['consumer_key']=$this->config->item('twitter_api_key');
			$config['consumer_secret']=$this->config->item('twitter_secret');
			$config['oauth_token']=$twitter_data['oauth_token'];
			$config['oauth_token_secret']=$twitter_data['oauth_token_secret'];
			
			$this->load->library('TwitterOAuth',$config);
			/* Request access tokens from twitter */
			$access_token = $this->twitteroauth->getAccessToken($_REQUEST['oauth_verifier']);

			/* Save the access tokens. Normally these would be saved in a database for future use. */
			$twitter_data['access_token'] = $access_token;

			/* Remove no longer needed request tokens */
			$this->session->set_userdata(array('twitter'=>$twitter_data));

			/* If HTTP response is 200 continue otherwise send to connect page to retry */
			if (200 == $this->twitteroauth->http_code) {
			  /* The user has been verified and the access tokens can be saved for future use */
			  
			  redirect(site_url('customer/twitterLoginSite'));
			} else {
			  /* Save HTTP status for error dialog on connnect page.*/
			  redirect(site_url('customer/twitterRedirect'));
			}
        }
		public function twitterLoginSite() {
		$twitter_data=$this->session->userdata('twitter');
        	$access_token = $twitter_data['access_token'];
			$config=array();
			$config['consumer_key']=$this->config->item('twitter_api_key');
			$config['consumer_secret']=$this->config->item('twitter_secret');
			$config['oauth_token']=$access_token['oauth_token'];
			$config['oauth_token_secret']=$access_token['oauth_token_secret'];
			
			$this->load->library('TwitterOAuth',$config);
			$content = $this->twitteroauth->get('account/verify_credentials');
			$this->user_model->signupTwitterUser($content);
			?>
			<script>
			window.opener.location.reload();
			window.close();
			</script>
			<?php
		}
		
		public function bargainRequest()
		{
			$customerId = $this->session->userdata('interfaceUserId');
			if ($customerId == '') {
				redirect(site_url('customer/login'));
				die();
			}
			$userName=$this->session->userdata('interfaceUsername');
			$user=$this->user_model->getUserByUserName($userName);
			
			$storeUser=$this->user_model->getStoreUserByEmail($user->email);
			
			$data['master']=$this->user_model->getBargainRequests($storeUser->id);
			$data['template']="bargainrequest";
			$temp['data'] = $data;
			$this->load->view($this->config->item('themeCode')."/common_view",$temp);
		}
		public function mybargain()
		{
			$customerId = $this->session->userdata('interfaceUserId');
			if ($customerId == '') {
				redirect(site_url('customer/login'));
				die();
			}
			$data['master'] = $this->product_model->mybargain();
			$data['template'] = "mybargain";
			$temp['data'] = $data;
			$this->load->view($this->config->item('themeCode')."/common_view",$temp);
		}
		
		public function create_store() {
			
			$userName=$this->session->userdata('interfaceUsername');
			$user=$this->user_model->getUserByUserName($userName);
			if(empty($user->email) || empty($user->password)) {
				$sessionData=array('error_msg1'=>'Please add your email address and create a password',
								'redirect_uri'=>'customer/create_store'
								);
				$this->session->set_userdata($sessionData);
				
				redirect(site_url('customer/account/profile'));
				die();
			}
			else {
				$storeUser=$this->user_model->getStoreUserByEmail($user->email);
				$agency='';
				if(!empty($storeUser)) {
					$agency=$this->user_model->getStoreAgency($storeUser);
				}
				$countryArr = $this->common_model->getCountries(1);
				
				$data['sel_country']['name'] = 'country';
				$data['sel_country']['attribute'] = 'id = "country" data-rel="chosen" onChange="xajax_getCityBy(\'countryId\',this.value,1)"';
				$data['sel_country']['options'] = $countryArr;
				$data['sel_country']['selected_country'] = (isset($store['countryId'])) ? ($store['countryId']) : ('');
				
				$data['sel_city']['name'] = 'city';
				$data['sel_city']['attribute'] = 'id = "city" data-rel="chosen" onChange="xajax_getAreaBy(\'cityId\',this.value,1)"';
				$data['sel_city']['options'] = $cityArr;
				$data['sel_city']['selected_city'] = (isset($store['cityId'])) ? ($store['cityId']) : ('');
				
				$data['sel_area']['name'] = 'area';
				$data['sel_area']['attribute'] = 'id = "area" data-rel="chosen"';
				$data['sel_area']['options'] = $areaArr;
				$data['sel_area']['selected_area'] = (isset($store['areaId'])) ? ($store['areaId']) : ('');
				
				
				$data['address'] = array(
						'name' => 'address',
						'id' => 'address',
						'value' => (isset($store['address'])) ? ($store['address']) : (set_value('address')),
						'size' => '20',
						'class' => 'input-xlarge focused',
						'style' => 'height:75px;'
				);
				
				$data['pincode'] = array(
						'name' => 'pincode',
						'id' => 'pincode',
						'value' => (isset($store['pincode'])) ? ($store['pincode']) : (set_value('pincode')),
						'maxlength' => '6',
						'size' => '20',
						'class' => 'input-xlarge focused'
				);

				$data['storeName'] = array(
						'name' => 'storeName',
						'id' => 'storeName',
						'value' => (isset($store['storeName'])) ? ($store['storeName']) : (set_value('storeName')),
						'maxlength' => '200',
						'size' => '20',
						'class' => 'input-xlarge focused'
				);

				$data['contactPerson'] = array(
						'name' => 'contactPerson',
						'id' => 'contactPerson',
						'value' => (isset($store['contactPerson'])) ? ($store['contactPerson']) : (set_value('contactPerson')),
						'maxlength' => '100',
						'size' => '20',
						'class' => 'input-xlarge focused'
				);

				$data['mobile'] = array(
						'name' => 'mobile',
						'id' => 'mobile',
						'value' => (isset($store['mobile'])) ? ($store['mobile']) : (set_value('mobile')),
						'maxlength' => '10',
						'size' => '20',
						'class' => 'input-xlarge focused'
				);
				
				$data['phone'] = array(
						'name' => 'phone',
						'id' => 'phone',
						'value' => (isset($store['phone'])) ? ($store['phone']) : (set_value('phone')),
						'maxlength' => '15',
						'size' => '20',
						'class' => 'input-xlarge focused'
				);
				
				$data['alternatPhone'] = array(
						'name' => 'alternatPhone',
						'id' => 'alternatPhone',
						'value' => (isset($store['alternatPhone'])) ? ($store['alternatPhone']) : (set_value('alternatPhone')),
						'maxlength' => '15',
						'size' => '20',
						'class' => 'input-xlarge focused'
				);
				
				$data['storeTimings'] = array(
						'name' => 'storeTimings',
						'id' => 'storeTimings',
						'value' => (isset($store['storeTimings'])) ? ($store['storeTimings']) : (set_value('storeTimings')),
						'size' => '20',
						'class' => 'input-xlarge focused',
						'style' => 'height:75px;'
				);
				
				$data['storeEmail'] = array(
						'name' => 'storeEmail',
						'id' => 'storeEmail',
						'value' => (isset($store['storeEmail'])) ? ($store['storeEmail']) : (set_value('storeEmail')),
						'maxlength' => '100',
						'size' => '20',
						'class' => 'input-xlarge focused'
				);

				$data['latitude'] = array(
						'name' => 'latitude',
						'id' => 'latitude',
						'value' => (isset($store['latitude'])) ? ($store['latitude']) : (set_value('latitude')),
						'maxlength' => '100',
						'size' => '20',
						'class' => 'input-xlarge focused'
				);
				
				$data['longitude'] = array(
						'name' => 'longitude',
						'id' => 'longitude',
						'value' => (isset($store['longitude'])) ? ($store['longitude']) : (set_value('longitude')),
						'maxlength' => '100',
						'size' => '20',
						'class' => 'input-xlarge focused'
				);
				$data['storeLogo'] = array(
						'name' => 'storeLogo',
						'id' => 'storeLogo',
						'value' => (isset($store['storeLogo'])) ? ($store['storeLogo']) : (set_value('storeLogo')),
						'maxlength' => '100',
						'size' => '20',
						'class' => 'input-file uniform_on focused'
				);

				$data['sel_isParking']['name'] = 'isParking';
				$data['sel_isParking']['attribute'] = 'id = "isParking" data-rel="chosen"';
				$data['sel_isParking']['options'] = array(
						'1' => 'Yes',
						'0' => 'No'
				);
				$data['sel_isParking']['selected_isParking'] = (isset($store['isParking'])) ? ($store['isParking']) : ('0');
				
				$data['sel_status']['name'] = 'status';
				$data['sel_status']['attribute'] = 'id = "status" data-rel="chosen"';
				$data['sel_status']['options'] = array(
						'Active' => 'Active',
						'Inactive' => 'Inactive'
				);
				$data['sel_status']['selected_status'] = (isset($store['status'])) ? ($store['status']) : ('Inactive');
				$data['frm_submit'] = array(
						'name' => 'submit',
						'id' => 'submit',
						'value' => 'Login'
				);
				$data['action'] = site_url('customer/createStoreSubmit');
				$data['attributes'] = array('name' => 'frmStore', 'id' => 'frmStore', 'class' => 'form-horizontal');
				$data['storeLogoImg'] = '';
				$data['storeUser'] = $storeUser;
				$data['agency'] = $agency;
				$data['template'] = "createStore";
				$temp['data'] = $data;
				$this->load->view($this->config->item('themeCode')."/common_view",$temp);
			
		}
		}
		
		public function getAreaBy($target,$targetId,$extraOption) {
			//$this->access_control_model->check_access('getAreaBy', __CLASS__, __FUNCTION__, 'basic');
			$objResponse = new xajaxResponse();
			$areaArr = $this->common_model->getAreaBy($target,$targetId,$extraOption);
		
			$sel_area['name'] = 'area';
			$sel_area['attribute'] = 'id = "area" data-rel="chosen"';
			$sel_area['options'] = $areaArr;
			$sel_area['selected_area'] = (isset($store['areaId'])) ? ($store['areaId']) : ('');
		
			$areaSelect = form_dropdown($sel_area['name'],$sel_area['options'],$sel_area['selected_area'],$sel_area['attribute']);
			$objResponse->Assign("areaHolder", "innerHTML", $areaSelect);
			$objResponse->Script("$('#area').chosen();");
			return $objResponse;
		}
		
		public function getCityBy($target,$targetId,$extraOption) {
			//$this->access_control_model->check_access('getCityBy', __CLASS__, __FUNCTION__, 'basic');
			$objResponse = new xajaxResponse();
			$cityArr = $this->common_model->getCityBy($target,$targetId,$extraOption);
		
			$sel_city['name'] = 'city';
			$sel_city['attribute'] = 'id = "city" data-rel="chosen" onChange="xajax_getAreaBy(\'cityId\',this.value,1)"';
			$sel_city['options'] = $cityArr;
			$sel_city['selected_city'] = (isset($store['cityId'])) ? ($store['cityId']) : ('');
		
			$areaSelect = form_dropdown($sel_city['name'],$sel_city['options'],$sel_city['selected_city'],$sel_city['attribute']);
			$objResponse->Script("$.uniform.update();");
			$objResponse->Assign("cityHolder", "innerHTML", $areaSelect);
			$objResponse->Script("$('#city').chosen();");
			return $objResponse;
		}
		
		public function createStoreSubmit() {
					//	$this->access_control_model->check_access('storeSubmit', __CLASS__, __FUNCTION__, 'basic');
			foreach ($formData as $id => $field) {
				$_POST[$id] = $field;
			}
			
			//$objResponse = new xajaxResponse();$storeUser=$this->user_model->getStoreUserByEmail($user->email);
			
			if(!empty($_POST['agencyId'])) {
				$agencyId=$_POST['agencyId'];
			}
			else {
				$agencyId=$this->store_model->getAgencyIdByName($_POST['agencyName']);
			}
			
			$userName=$this->session->userdata('interfaceUsername');
			$user=$this->user_model->getUserByUserName($userName);
			$storeUser=$this->user_model->getStoreUserByEmail($user->email);
			
				if(empty($storeUser)) {
					$this->user_model->createStoreUserForCustomer($user,$agencyId);
					$storeUser=$this->user_model->getStoreUserByEmail($user->email);
				}
			
			if($_FILES['storeLogo']['name']!=""){
				$uploadStatus = $this->_uploadStoreLogo();
				if (isset($uploadStatus['error'])) {
					$error = $uploadStatus['error'];
					$this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $error . '</div>');
					redirect(site_url($this->config->item('controlPanel') . '/store/storeListShow'));
				}
				$fileName = $uploadStatus['upload_data']['file_name'];
			}else{
				$fileName = $this->input->post('storeLogoImg');
			}
			
			
			
			if ($_POST['storeId'] != '') {
				$response = $this->store_model->update_store($fileName,$agencyId,$storeUser->id);
			} else {
				$response = $this->store_model->insert_store($fileName,$agencyId,$storeUser->id);
			}
			if ($response) {
				$this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('storeSuccess') . '</div>');
				//$objResponse->redirect(site_url('customer/account/profile'));
				redirect(site_url('customer/account/profile'));
			} else {
				//$objResponse->Assign("errorMsg", "innerHTML", '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
				$this->session->set_flashdata('Msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>' . $this->lang->line('operationFail') . '</div>');
				redirect(site_url('customer/account/profile'));
			}
		}
		
		function _uploadStoreLogo() {
			$this->load->helper('string');
		
			$config['upload_path'] = FCPATH.$this->config->item('storeLogoPath');
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$config['max_width'] = '49';
			$config['max_height'] = '49';
			$config['file_name'] = random_string('unique');
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('storeLogo')) {
				$uploadStatus = array('error' => $this->upload->display_errors());
			} else {
				$uploadStatus = array('upload_data' => $this->upload->data());
			}
			return $uploadStatus;
		}
		
	}
			
			/* End of file welcome.php */
			/* Location: ./application/controllers/welcome.php */