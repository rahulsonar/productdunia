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
			}
			<?php if(empty($customerData['password'])) { ?>
			,
			password: {
				required:true,
				minlength:8
			} <?php } ?>
		},
		errorElement: "div",
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
<style>
.cell_input {
	width:auto !important;
}
</style>
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
            <div class="subheadingholder">
                <h2>My Account</h2>
            </div>
            <div class="subheadingholder">
                <h2>Create Store</h2>
            </div>
            <div style="color:red;">
            
            </div>
            <form name="frmPersonalInfo" id="frmPersonalInfo">
            <div class="form_holder">
                <div class="left_row" style="width:auto; ">
                
                    <div class="cell_input">
                        <label class="label">Agency</label> 
                        <?php if(empty($agency)) { ?>
                        <input type="text" value="<?php echo $customerData['name']; ?>" name="name" id="name" class="input"/> 
                        <?php } else { ?>
                        <?php echo $agency;  ?>
                        <?php } ?>
                    </div>
                    
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('country'); ?></label> 
                        <?php echo form_dropdown($sel_country['name'],$sel_country['options'],$sel_country['selected_country'],$sel_country['attribute']); ?> 
                    </div>
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('city'); ?></label> 
                        <div id="cityHolder">
							<?php echo form_dropdown($sel_city['name'],$sel_city['options'],$sel_city['selected_city'],$sel_city['attribute']); ?>
						</div>
                    </div>
                    
                     <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('area'); ?></label> 
                        <div class="controls" id="areaHolder">
							<?php echo form_dropdown($sel_area['name'],$sel_area['options'],$sel_area['selected_area'],$sel_area['attribute']); ?>
						</div>
                    </div>
                    
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('address'); ?></label>
                        <?php echo form_textarea($address); ?>
                    </div>
                    
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('pincode'); ?></label>
                        <?php echo form_input($pincode); ?>
                    </div>
                    
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('storeName'); ?></label>
                        <?php echo form_input($storeName); ?>
                    </div>
                    
                    
                </div> 
   
            </div>
            </form>
        </div>
    </div>
</div>