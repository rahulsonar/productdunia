<?php
class TwitterOAuthClass {
	static $con;
	public function __construct($config) {
		require_once "twitteroauth.php";
		if(!isset($this->con))
		$this->con=new TwitterOAuth($config['consumer_key'],$config['consumer_secret']);
		
		return $this->con;
	}
}