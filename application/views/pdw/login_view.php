<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmLogin").validate({
		rules: {
			signupEmail: {
				required: true,
				email: true
			},
			password: {
				required: true
			}
		},errorElement: "div",
		messages: {
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_loginSubmit(xajax.getFormValues('frmLogin'));
		}
		
	});	
})
})(jQuery); 
</script>
<!-- Code Sign in -->
<div style="display:none">
    <div id="signin"> 
        <div class="hearderholder">LOGIN</div>
        <div class="lightboxcontent">
            <div class="lightboxcontentleft">
                <form name="frmLogin" id="frmLogin" method="post">
                    <div class="frmholder">
                        <label>Email Address / Mobile Number</label>
                        <input type="text" name="signupEmail" id="signupEmail" class="inplog" />
                    </div>
                    <div class="frmholder">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="inplog" />
                    </div>
                    <div class="btnholder">
                        <input type="submit" style="float:left;" class="btnprced" value="PROCEED"  />
                        <a href="#forgotpass" class="forgetpassword forgetpassinline">Forget Password?</a>
                    </div>
                </form>
            </div>
            <div class="lightboxcontentmid"></div>
            <div class="lightboxcontentright" id="sociallogin">
                <label>Login Using</label>
                <a href="<?php echo $this->session->userdata('facebookLoginUrl'); ?>"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/btfb.jpg" alt=""  /></a>
                <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/bttw.jpg" alt=""  /></a>
                <a href="<?php echo $this->session->userdata('googleLoginUrl'); ?>"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/btgo.jpg" alt=""  /></a>
            </div>
        </div>
        <div class="lightboxfooter">
            Don't have an account?
            <a href="#signup" class="btnft signupinline">Sign Up Now</a>
        </div>
    </div>
    
   
</div>
