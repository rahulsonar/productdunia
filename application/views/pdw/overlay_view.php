<?php $this->load->view($this->config->item('themeCode')."/login_view"); ?>
<?php $this->load->view($this->config->item('themeCode')."/forgotPassword_view"); ?>
<?php $this->load->view($this->config->item('themeCode')."/signup_view"); ?>
<?php //$this->load->view($this->config->item('themeCode')."/shortLogin_view"); ?>

<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmShortLogin").validate({
		rules: {
			signupEmail: {
				required: true
			}
		},errorElement: "div",
		messages: {
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_shortLoginSubmit(xajax.getFormValues('frmShortLogin'));
		}
		
	});	

	$("#shortLoginEmail").change(function(){
		var str=$(this).val();
		
		if(str!='') {
			$("#shortLoginMobile").val('');
			$("#shortLoginMobile").attr('disabled','disabled');
		}
		else {
			$("#shortLoginMobile").removeAttr('disabled');
		}
		});

	$("#shortLoginMobile").change(function(){
		var str=$(this).val();
		if(str!='') {
			$("#shortLoginEmail").val('');
			$("#shortLoginEmail").attr('disabled','disabled');
		}
		else {
			$("#shortLoginEmail").removeAttr('disabled');
		}
		});

	$("#frmShortConfirm").validate({
		rules: {
			signupPass: {
				required: true,
				number:true
			}
		},errorElement: "div",
		messages: {
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_shortLoginConfirmSubmit(xajax.getFormValues('frmShortConfirm'));
		}
		
	});	
})
})(jQuery); 
</script>
<!-- shot login -->
<div style="display:none">
    <div id="shotlogin">
        <div class="hearderholder">New Customer <span class="smalltextbox">(Short Log In)</span></div>
        <div class="signaddbox">
            <table class="signaddtable">
                <tr>
                    <td class="whyduniya">WHY PRODUCT DUNIYA?</td>
                </tr>
                <tr>
                    <td>
                        <img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/signicons4.png"  />
                        <span class="green">BEST PRICE</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/signicons1.png"  />
                        <span class="org">FAST DELIVERY</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/signicons1.png"  />
                        <span class="blue">24X7 SERVICE</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/signicons1.png"  />
                        <span class="pink">BEST Quality </span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="signaddright">
            <div class="lightboxcontent">
                <p class="italic">Please provide you Email or Mobile number. <br  />
                    This information may be passed to Store to serve you better</p>
                <div class="lightboxcontentleft">
                    <!-- <h2>NEW CUSTOMER</h2>
                    <p>If you dont thave an accont but want to login quickly.</p> -->

                    <form id="frmShortLogin" name="frmShortLogin">
                        <div class="frmholder">
                            <label>Email Address</label>
                            <input type="text" name="shortLoginEmail" id="shortLoginEmail" class="inplog"  />
                        </div>

                        <div class="frmholder">
                            <label>Mobile Number</label>
                            <input type="text" name="shortLoginMobile" id="shortLoginMobile" class="inplog"  />
                        </div>

                        <div class="btnholder">
                            <input type="submit" class="btnprced" value="PROCEED"  />
                        </div>

                    </form>
                </div>
                <div class="lightboxcontentmid"></div>
                <div class="lightboxcontentright" id="sociallogin">
                    <label>Login Using</label>
                    <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/btfb.jpg" alt=""  /></a>
                    <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/bttw.jpg" alt=""  /></a>
                    <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/btgo.jpg" alt=""  /></a>
                </div>

            </div>
            <div class="lightboxfooter" style="clear:both;">
                Want to create an account?   
                <a  href="#signup"  class="btnft inline">Sign Up Now</a>
                Already have an account?    
                <a  href="#signin"  class="btnft inline">Sign IN</a>
            </div>
        </div>
    </div>
</div>

<!-- Code Verification -->
<div style="display:none">
    <div id="verification"> 
        <div class="hearderholder">USER VERIFICATION <span class="smalltextbox">Please verify your account.</span></div>
        <div class="lightboxcontent" style="width:750px; display:block;">

            <!-- <p>Verification link has been send to your registered email address <span class="org">username@gmail.com</span>. Please click on 
link or copy and paste the link into your browser to activate your account and continue shopping with
Product Duniya. </p>
                            <p><a href="#" class="und">Click here to change your email address</a></p>
            
                    <div class="lightboxcontentmidbox"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/rtmid.jpg" alt="" /></div> -->

            <p>Verification Code has been send to your mobile number<span class="org"> +91 1234 12345</span>. Please enter the four digit 
                verification code below to complete the process of sign up with product duniya. We will be sure that 
                you are not a robot! </p>
            <p><a href="#" class="und">Click here to change your mobile number</a></p>

            <form id="frmShortConfirm" name="frmShortConfirm">
                <div class="frmholder">
                    <label>Verification Code</label>
                    <input type="text" name="signupPass" id="signupPass" class="inplog"  />
                </div>



                <div class="btnholder">
                    <input type="submit" class="btnprced" value="Submit"  />
                </div>

            </form>             
        </div>

    </div>
</div>