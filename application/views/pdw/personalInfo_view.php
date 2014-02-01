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
        <?php $this->load->view($this->config->item('themeCode') . "/account_left_section_view", $data); ?>

        <!-- Right Warp -->  
        <div class="rightwarp">
            <?php $this->load->view($this->config->item('themeCode') . "/breadcrumbs_view"); ?>
            <div class="subheadingholder prodheadingholder">
                <h2>My Account</h2>
            </div>
            <div class="subheadingholder">
                <h2>Personal Information</h2>
            </div>
            <form name="frmPersonalInfo" id="frmPersonalInfo">
            <div class="form_holder">
                <div class="left_row">
                    <div class="cell_input">
                        <label class="label">Name</label> 
                        <input type="text" value="<?php echo $customerData['name']; ?>" name="name" id="name" class="input"/> 
                    </div>
                    <div class="cell_input">
                        <label class="label">Gender</label> 
                        <select class="gender" name="gender" id="gender">
                            <option <?php if($customerData['gender']=='Male'){ ?>selected='selected'<?php } ?>>Male</option>
                            <option <?php if($customerData['gender']=='Female'){ ?>selected='selected'<?php } ?>>Female</option>
                        </select>
                    </div>
                </div> 
                <div class="right_row">
                    <div class="cell_input">
                        <label class="label">Email ID</label> 
                        <input type="text" value="<?php echo $customerData['email']; ?>" name="email" id="email" class="input"> 
                    </div>                    
                    <div class="cell_input">
                        <label class="label">Mobile Number</label> 
                        <input type="text" value="<?php echo $customerData['mobile']; ?>" name="mobile" id="mobile" class="input"/> 
                    </div>                    
                    <div class="right">
                        <input type="submit" name="save" id="save" value="Save" class="btncomman rounded" /></div>	 
                </div>
            </div>
            </form>
        </div>
    </div>
</div>