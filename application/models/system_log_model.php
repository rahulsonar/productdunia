<?php
class System_log_model extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }

	function system_user_login_log_insert($log_action,$interface="back")
	{
		$logData['username'] = ($interface=='front')?($this->session->userdata('interfaceUsername')):($this->session->userdata('sysuser_loggedin_user'));
		$logData['session_id'] = $this->session->userdata('session_id');
		$logData['interface'] = $interface;
		$logData['action_time'] = date("Y-m-d H:i:s");
		$logData['action_type'] = $log_action;
		$logData['ip_address'] = $this->input->ip_address();
		$this->db->insert('system_user_login_log', $logData);
	}
}
