<!DOCTYPE html>
<html lang="en">
<noscript>
	<div class="overlay" id="overlay" style="display:block;"></div>
	<div class="overlayBox" id="overlayBox" style="top: 160px;">
 		<a class="boxclose" id="boxclose"></a>
 		<h1>Important message</h1>
 		<p>
  			<br />Please enable JavaScript on your browser or upgrade to a JavaScript-capable browser.<br />
 		</p>
	</div>
</noscript>
<head>
    <?php $this->load->view($this->config->item('controlPanel')."/meta_view"); ?>
    <title><?php echo $this->config->item('site_title'); ?></title>
    <?php $this->load->view($this->config->item('controlPanel')."/includes_view"); ?>
    <?php $this->xajax->configure("javascript URI", base_url().'assets/js/');?>
	<?php echo $this->xajax->getJavascript(base_url().'assets/js/'); ?>    
</head>
<body>
	<div class="" id="messageBox">
	    <div class="" id="errorMessage">&nbsp;</div>
	 </div>
	<?php $this->load->view($this->config->item('controlPanel')."/header_view"); ?>
	<?php $this->load->view($this->config->item('controlPanel')."/main_content_view",$data); ?>
	<?php $this->load->view($this->config->item('controlPanel')."/footer_view"); ?>
</body>
</html>
<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#messageBox").hide();
})
})(jQuery); 
</script>

