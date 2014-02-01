<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmRegister").validate({
		rules: {
			signupEmail: {
				required: true,
				email: true
			},
			signupPassword: {
				required: true,
				minlength: 5,
                                maxlength: 15
			},
			signupCnf_password: {
				required: true,
				equalTo: "#signupPassword"
			}
		},errorElement: "div",
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
                    xajax_signupSubmit(xajax.getFormValues('frmRegister'));
		}
	});	
})
})(jQuery); 
</script>
<!-- Code Sign Up -->
<div style="display:none">
    <div id="signup"> 
        <div class="hearderholder">SIGN UP</div>
        <div class="lightboxcontent">
            <div class="lightboxcontentleft">
                <form name="frmRegister" id="frmRegister">
                    <div class="frmholder">
                        <label>Email Address</label>
                        <input type="text" name="signupEmail" id="signupEmail" class="inplog" onblur="xajax_isUsernameAvailable(this.value)"/>
                    </div>
                    <div class="frmholder">
                        <label>Password</label>
                        <input type="password" name="signupPassword" id="signupPassword" class="inplog" value="" />
                    </div>

                    <div class="frmholder">
                        <label>Retype Password</label>
                        <input type="password" name="signupCnf_password" id="signupCnf_password" class="inplog" value="" />
                    </div>
                    <div class="btnholder">
                        <input type="submit" name="register" id="register" value="REGISTER" class="btnprced" />
                    </div>
                </form>
            </div>
            <div class="lightboxcontentmid" style="height:220px;"></div>
            <div class="lightboxcontentright" id="sociallogin" style="padding-top:50px;">
                <label>Login Using</label>
                <a href="<?php echo $this->session->userdata('facebookLoginUrl'); ?>"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/btfb.jpg" alt=""  /></a>
                <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/bttw.jpg" alt=""  /></a>
                <a href="<?php echo $this->session->userdata('googleLoginUrl'); ?>"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/btgo.jpg" alt=""  /></a>
            </div>
        </div>
        <div class="lightboxfooter">
            Already have an account?    
            <a  href="#signin"  class="btnft signupinline">Sign IN</a>
        </div>
    </div>
</div>