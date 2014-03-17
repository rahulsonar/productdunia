<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
		

	$("#frmShortConfirm").validate({
		rules: {
			signupPass: {
				required: true,
				numeric:true
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
<div style="display:none;">
  <div id="shortLogin"> 
        <div class="hearderholder">LOGIN</div>
        <div class="lightboxcontent">
            <div class="lightboxcontentleft">
                <!-- <h2>Registered Customer</h2>
                <p>If you already have an account please log in.</p> -->

                <form name="frmShortLogin" id="frmShortLogin" method="post">
                    <div class="frmholder">
                        <label>Email Address / Mobile Number</label>
                        <input type="text" name="signupEmail" id="signupEmail" class="inplog" />
                    </div>
                    <div class="btnholder">
                        <input type="submit" style="float:left;" class="btnprced" value="PROCEED"  />
                        <a href="#forgotpass" class="forgetpassword forgetpassinline">Forget Password?</a>
                    </div>

                </form>
            </div>
            
           
        </div>
       
    </div>
   </div>
   
   
