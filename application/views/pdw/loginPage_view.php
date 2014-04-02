<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmPersonalInfo").validate({
		rules: {
			name: {
				required: true
			},
                        email: {
				required: true,
				email: true
			},
			mobile: {
				required: true,
				minlength: 10,
                                maxlength: 10
			}		},errorElement: "div",
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
                    xajax_personalInfoSubmit(xajax.getFormValues('frmPersonalInfo'));
		}
	});	
})
})(jQuery); 
</script>
<div id="main">
    <div class="mainholder">
        <div class="add">
            <ul>
                <li> <img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/add1.jpg" alt="" /></li>
            </ul>
        </div>
        <!-- Left Warp -->  
        <?php //$this->load->view($this->config->item('themeCode') . "/account_left_section_view", $data); ?>
	
    
        <div class="leftwarp">
           &nbsp;
        </div>
		<div class="rightwarp">
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
</div>