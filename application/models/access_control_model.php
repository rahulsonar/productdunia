<?php
class access_control_model extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }

	function access_deny(){
		redirect($this->config->item('controlPanel') . '/access_deny');
	}

	function check_access($human_txt,$class_name,$func_name,$func_type){
		$module_code = $class_name."#".$func_name;
		if($this->session->userdata('sysuser_loggedin_user')==''){
			redirect($this->config->item('controlPanel') . '/login');
		}else{
			$data['username'] = $this->session->userdata('sysuser_loggedin_user');
			$data['profile_id'] = $this->session->userdata('sysuser_loggedin_user_profiles');
			$this->db->select('count(*) as cnt');
                        if($data['profile_id']!=''){
                            $where = "module_code = '".$module_code."' and (username = '".$data['username']."' OR profile_id IN (".$data['profile_id']."))";
                        }else{
                            $where = "module_code = '".$module_code."' and (username = '".$data['username']."')";                            
                        }
                        
			$this->db->where($where);
			
			$query = $this->db->get('module_access_control',$data);
			
			$row = $query->row();
			
			if($row->cnt <= 0){
				
				
				$this->master_module_insert($human_txt,$module_code,$func_type);
				if($func_type=='functional'){
					$this->access_deny();
				}
			}else{
				if($func_type=='functional'){
					$this->system_user_activity_log_insert($module_code);
				}
			}
		}
	}

	function master_module_insert($human_txt,$module_code,$moduletype)
	{
		
		$moduleData['module_code'] = $module_code;
		$this->db->select('count(*) as cnt');
		$query = $this->db->get_where('master_module',$moduleData);
		$row = $query->row();
		
		
		if($row->cnt <= 0){
			$moduleDataEntry['module_code'] = $module_code;
			$moduleDataEntry['module_name'] = $human_txt;
			$moduleDataEntry['module_type'] = $moduletype;
			$this->db->insert('master_module', $moduleDataEntry);
			$this->access_control_insert($module_code,'admin',$this->config->item('adminProfileId'));
		}
		if($moduletype=='basic')
		{
			$username = $this->session->userdata('sysuser_loggedin_user');
			$this->access_control_insert($module_code,$username,'');
		}

	}

	function access_control_insert($module_code,$username='',$profileId='')
	{
		$DataEntry['profile_id'] = $profileId;
		$DataEntry['username'] = $username;
		$DataEntry['module_code'] = $module_code;
		$this->db->insert('module_access_control', $DataEntry);

	}

	function system_user_activity_log_insert($activity)
	{
		$logData['username'] = $this->session->userdata('sysuser_loggedin_user');
		$logData['module_code'] = $activity;
		$logData['create_date'] = date("Y-m-d H:i:s");
		$this->db->insert('activity_control_log', $logData);
	}

	function menu_loader($parent_menu='0')
	{
		error_reporting(0);
		$Where['parent_menu'] = $parent_menu;
		$Where['menu_type'] = 'visible';
		$this->db->select('*');
		$this->db->order_by('menu_level asc,menu_seq asc');
		$query = $this->db->get_where('master_menu',$Where);
		$j=0;
		foreach ($query->result() as $row){
			$menu[$j]['name'] = $row->menu_name;
			$menu[$j]['url'] = $row->menu_url;
			$menu[$j]['submenus'] = $this->menu_loader($row->menu_id);
			$j++;
		}		
		return $menu;
	}
	
	function isValidUser(){
		if($this->session->userdata('interfaceUserId')==''){
			redirect('login');
		}else{
			
		}
	}		
}
