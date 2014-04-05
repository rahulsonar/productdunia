<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends MY_Controller {

	/**
	 * Product controller.
	 */
	function __construct(){
		parent::__construct();
                $this->xajax->register(XAJAX_FUNCTION, array('personalInfoSubmit', &$this, 'personalInfoSubmit'));
                $this->xajax->register(XAJAX_FUNCTION, array('removeFromWishlist', &$this, 'removeFromWishlist'));
                $this->xajax->register(XAJAX_FUNCTION, array('removeFromSavedSearch', &$this, 'removeFromSavedSearch'));
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
		
		public function mybargain()
		{
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
				$data['template'] = "createStore";
				$temp['data'] = $data;
				$this->load->view($this->config->item('themeCode')."/common_view",$temp);
			
		}
		}
		
		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */