<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmLogin").validate({
		rules: {
			signupEmail: {
				required: true,
				emailPhone: true
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
	$.validator.addMethod("emailPhone", function(value, element) {
	     if (this.optional(element)) // return true on optional element
	         return true;
	     valid = true;

	     if (value.indexOf("@") > 0) {
	         valid = valid && $.validator.methods.email.call(this, value, element);
	     } else {
	         valid = valid && $.validator.methods.number.call(this, value, element);
	     }
	     return valid;
	 }, 'Please provide a valid email or mobile');
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
                <a href="#" onclick="window.open('<?php echo site_url('customer/twitterLogin'); ?>','twitterLogin','width=500,height=700'); return false;"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/bttw.jpg" alt=""  /></a>
                <a href="<?php echo $this->session->userdata('googleLoginUrl'); ?>"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/btgo.jpg" alt=""  /></a>
            </div>
        </div>
        <div class="lightboxfooter">
            Don't have an account?
            <a href="#signup" class="btnft signupinline">Sign Up Now</a>
        </div>
    </div>
    
   
</div>
