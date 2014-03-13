<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmRegister").validate({
		rules: {
			signupEmail: {
				required: true,
				emailPhone: true
			},
			signupPassword: {
				required: true,
				minlength: 5,
                                maxlength: 15
			},
			signupCnf_password: {
				required: true,
				equalTo: "#signupPassword"
			},
			readtnc: {
				required:true
			}
		},errorElement: "div",
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
                    xajax_signupSubmit(xajax.getFormValues('frmRegister'));
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

function validateEMail(email)
{
var x=email;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  
  return false;
  }
  return true;
}
</script>
<!-- Code Sign Up -->
<!--<div style="display:none">
    <div id="signup">
        <div class="hearderholder">SIGN UP</div>
        <div class="lightboxcontent">
            <div class="lightboxcontentleft">
                <form>
                    <div class="frmholder">
                        <label>Mobile Number / Email Address </label>
                        <input type="text" class="inplog"  />
                    </div>
                    <div class="frmholder">
                        <label>Password</label>
                        <input type="password" class="inplog"  />
                    </div>
                    <div class="frmholder">
                        <label>Retype Password</label>
                        <input type="password" class="inplog"  />
                    </div>
                    <div class="cell_input">
                        <input type="checkbox" class="inplog"/>
                        I have read the <a href="#" style="color: #0000EE">Terms & Conditions </a>and agree to them.
                    </div>
                    <div class="btnholder">
                        <input type="button" class="btnprced" value="Sign UP"  />
                    </div>
                </form>
            </div>
            <div class="lightboxcontentmid" style="margin-left: 10px;height:200px;"></div>
            <div class="lightboxcontentright" id="sociallogin" style="padding-top:50px;margin-left: 10px;">
                <label>Login Using</label>
                <a href="<?php echo $this->session->userdata('facebookLoginUrl'); ?>"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/btfb.jpg" alt=""  /></a>
                <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/bttw.jpg" alt=""  /></a>
                <a href="<?php echo $this->session->userdata('googleLoginUrl'); ?>"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/btgo.jpg" alt=""  /></a>
            </div>
        </div>
        <div class="lightboxfooter">
            Already have an account? 
            <a  href="#signin"  class="btnft inline signupinline">Sign IN</a>
        </div>
    </div>
</div>-->

<div style="display:none">
    <div id="signup"> 
        <div class="hearderholder">SIGN UP</div>
        <div class="lightboxcontent">
            <div class="lightboxcontentleft">
                <form name="frmRegister" id="frmRegister">
                    <div class="frmholder">
                        <label>Mobile Number / Email Address</label>
                        <input type="text" name="signupEmail" id="signupEmail" required class="inplog" onblur="xajax_isUsernameAvailable(this.value)"/>
                    </div>
                    <div class="frmholder">
                        <label>Password</label>
                        <input type="password" name="signupPassword" id="signupPassword" class="inplog" value="" required/>
                    </div>

                    <div class="frmholder">
                        <label>Retype Password</label>
                        <input type="password" name="signupCnf_password" id="signupCnf_password" class="inplog" value="" required/>
                    </div>
                    <div class="cell_input">
                        <input type="checkbox" class="inplog" name="readtnc" />
                        I have read the <a href="#" style="color: #0000EE">Terms & Conditions </a>and agree to them.
                    </div>
                    <div class="btnholder">
                        <input type="submit" name="register" id="register" value="REGISTER" class="btnprced" />
                    </div>
                </form>
            </div>
            <div class="lightboxcontentmid" style="margin-left: 10px;height:200px;"></div>
            <div class="lightboxcontentright" id="sociallogin" style="padding-top:50px;margin-left: 10px;">
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
