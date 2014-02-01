<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$('#username').watermark("<?php echo $this->lang->line('watermarkLoginUsername'); ?>");
	$('#password').watermark("<?php echo $this->lang->line('watermarkLoginPassword'); ?>");
	$("#frmLogin").validate({
		rules: {
			username: {
				required: true
			},
			password: {
				required: true
			}
		},errorElement: "div",
		messages: {		
			username: {
				required: '<?php echo $this->lang->line('errMsgloginUsernameReq'); ?>'
			},
			password: {
				required: '<?php echo $this->lang->line('errMsgloginPasswordReq'); ?>'
			}
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_loginSystemUser($("#username").val(),$("#password").val());
		}
		
	});	
})
})(jQuery); 
</script>
<div class="row-fluid">
	<div class="well span5 center login-box">
		<div class="alert alert-info">Please login with your Username and Password.</div>
		<div id="errorMsg"></div>
		<?php echo form_open($action,$attributes); ?>
			<fieldset>
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i></span><?php echo form_input($username_txt); ?>
				</div>
				<div class="clearfix"></div>
				<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span><?php echo form_password($password_txt); ?>
				</div>
				<div class="clearfix"></div>
				<p class="center span5">
				<button type="submit" class="btn btn-primary">Login</button>
				</p>
			</fieldset>
		<?php echo form_close(); ?>
	</div><!--/span-->
</div><!--/row-->
