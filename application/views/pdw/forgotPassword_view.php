<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmLogin").validate({
		rules: {
			email_address: {
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
    <div id="forgotpass"> 
        <div class="hearderholder">Forgot Password</div>
        <div class="lightboxcontent">
            <div class="lightboxcontentleft">
                <!-- <h2>Registered Customer</h2>
                <p>If you already have an account please log in.</p> -->

                <form name="frmLogin" id="frmLogin" method="post">
                    <div class="frmholder">
                        <label>Email Address / Mobile Number</label>
                        <input type="text" name="email_address" id="email_address" class="inplog" />
                    </div>

                    <div class="frmholder">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="inplog" />
                    </div>

                    <div class="btnholder">
                        <input type="submit" style="float:left;" class="btnprced" value="PROCEED"  />
                        <a href="#" class="forgetpassword">Forget Password?</a>
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
            <a href="#signup"  class="btnft inline">Sign Up Now</a>
        </div>
    </div>
</div>