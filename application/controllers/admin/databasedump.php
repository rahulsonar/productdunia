<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Databasedump extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('zip');
		$this->load->helper('directory');
	}
	public function index()
	{
		$this->access_control_model->check_access('Database Backup List',__CLASS__,__FUNCTION__,'functional');
		$this->dump_list();
	}


	private function _backup($tables = '*')
	{
		error_reporting(0);
		$dump_path = $this->config->item('dump_path');
		$dbuser = $this->db->username;
		$dbpass = $this->db->password;
		$dbhost = $this->db->hostname;
		$dbname = $this->db->database;
		$return = '';
		$row = '';

		$link = mysql_connect($dbhost,$dbuser,$dbpass);
		mysql_select_db($dbname,$link);

	  //get all of the tables
	  if($tables == '*')
	  {
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
		  $tables[] = $row[0];
		}
	  }
	  else
	  {
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	  }


	  //cycle through
	  foreach($tables as $table)
	  {
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);

		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";

		for ($i = 0; $i < $num_fields; $i++)
		{
		  while($row = mysql_fetch_row($result))
		  {
			$return.= 'INSERT INTO '.$table.' VALUES(';
			for($j=0; $j<$num_fields; $j++)
			{
			  $row[$j] = addslashes($row[$j]);
			  $row[$j] = ereg_replace("\n","\\n",$row[$j]);
			  if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
			  if ($j<($num_fields-1)) { $return.= ','; }
			}
			$return.= ");\n";
		  }
		}
		$return.="\n\n\n";
	  }

	  //save file
	  $filename = 'db-backup-'.date('Y_m_d_H_i');
	  $handle = fopen($dump_path.$filename.'.sql','w+');
	  fwrite($handle,$return);
	  fclose($handle);

		redirect($this->config->item('controlPanel') . '/databasedump/dump_list');
	}
	public function dump_list()
	{
		/* Breadcrumb Start */
		$this->breadcrumb->append_crumb('Dashboard',site_url($this->config->item('controlPanel') . '/dashboard'));
		$this->breadcrumb->append_crumb('Database Dump',site_url($this->config->item('controlPanel') . '/databasedump/dump_list'));
		/* Breadcrumb End */
		$dump_path = $this->config->item('dump_path');
		$data['map'] = directory_map($dump_path);
		$temp = array();
		if(count($data['map']) > 0){ 
			foreach ($data['map'] as $files => $file)
			{
				$fileExt = pathinfo($dump_path.'/'.$file, PATHINFO_EXTENSION);
				if($fileExt=='sql'){
					$temp[] = $file;
				}
			}
		}
		$data['map'] = array();
		if(count($temp) > 0){
			$data['map'] = $temp;
		}
		$data['page_title'] = 'Database Dump';
		$data['template'] = $this->config->item('controlPanel') . "/dump_download_view";
		$temp['data'] = $data;
		$this->load->view($this->config->item('controlPanel') . "/common_view",$temp);
	}
	public function dump_download($filename)
	{
		$this->access_control_model->check_access('Database Backup Download',__CLASS__,__FUNCTION__,'functional');
		$dump_path = $this->config->item('dump_path');
		$this->zip->read_file($dump_path.$filename);
		$this->zip->download($filename);
		exit;
	}
	public function dump_delete($filename)
	{
		$this->access_control_model->check_access('Database Backup Delete',__CLASS__,__FUNCTION__,'functional');
		$dump_path = $this->config->item('dump_path');
		@unlink($dump_path.$filename);
		redirect($this->config->item('controlPanel') . '/databasedump/dump_list');
	}
	public function db_backup()
	{
		$this->access_control_model->check_access('Database Backup',__CLASS__,__FUNCTION__,'functional');
		$this->_backup();
		redirect($this->config->item('controlPanel') . '/databasedump/dump_list');
	}

}