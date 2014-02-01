<?php if($this->session->userdata('sysuser_loggedin_user')!=''){ ?>
<div id="content" class="span10">
	<?php $this->load->view($this->config->item('controlPanel')."/breadcrumb_view"); ?>
<?php } ?>
<?php
	if(isset($output)){
		$this->load->view($template,$output);
	}else{
		$this->load->view($template);
	}
?>
<?php if($this->session->userdata('sysuser_loggedin_user')!=''){ ?>
</div><!--/#content.span10-->
<?php } ?>