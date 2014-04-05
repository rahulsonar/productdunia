<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmStore").validate({
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
            <?php echo form_open_multipart($action,$attributes); ?>
            <div class="form_holder">
                <div class="left_row" style="width:auto; ">
                
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('agency'); ?></label> 
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
                    
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('contactPerson'); ?></label>
                        <?php echo form_input($contactPerson); ?>
                    </div>
                    
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('storeEmail'); ?></label>
                        <?php echo form_input($storeEmail); ?>
                    </div>
                    
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('mobile'); ?></label>
                        <?php echo form_input($mobile); ?>
                    </div>
                    
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('phone'); ?></label>
                        <?php echo form_input($phone); ?>
                    </div>
                    
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('alternatPhone'); ?></label>
                        <?php echo form_input($alternatPhone); ?>
                    </div>
                    
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('storeTimings'); ?></label>
                        <?php echo form_textarea($storeTimings); ?>
                    </div>
                    
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('latitude'); ?></label>
                        <?php echo form_input($latitude); ?>
                    </div>
                    
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('longitude'); ?></label>
                        <?php echo form_input($longitude); ?>
                    </div>
                    
                    <div class="cell_input" <?php if(empty($storeLogoImg)) { ?> style="display: none;"<?php } ?>>
                        <label class="label"><?php echo $this->lang->line('storeLogoImg'); ?></label>
                        <img alt="storeLogoImg" src="<?php echo base_url() . $this->config->item('storeLogoPath') . $storeLogoImg?>">
                        <a href="javascript:void(0)" onClick="xajax_deleteStoreLogoImage('<?php echo $storeId; ?>','<?php echo $storeLogoImg; ?>')" title="Click to delete"><span class="icon32 icon-red icon-trash"/></span></a>
                    </div>
                    
                    <div class="cell_input <?php if($storeLogoImg!=''){ ?> hidden<?php } ?>">
                        <label class="label"><?php echo $this->lang->line('storeLogoImg'); ?></label>
                        <?php echo form_upload($storeLogo); ?>
                    </div>
                    
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('paymentMethods'); ?></label>
                        
                        <input type="checkbox" name="paymentMethods[]" value="card" <?php if(in_array('card', $paymentMethods)) { ?> checked <?php } ?>>&nbsp;Credit/Debit card &nbsp;
                        <input type="checkbox" name="paymentMethods[]" value="cash" <?php if(in_array('cash', $paymentMethods)) { ?> checked <?php } ?>>&nbsp;Cash accepted<br />
                        
                    </div>
                    
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('parking'); ?></label>
                        <?php echo form_dropdown($sel_isParking['name'],$sel_isParking['options'],$sel_isParking['selected_isParking'],$sel_isParking['attribute']); ?>
                    </div>
                    
                    <div class="cell_input">
                        <label class="label"><?php echo $this->lang->line('storeUserSignupStatus'); ?></label>
                        <?php echo form_dropdown($sel_status['name'],$sel_status['options'],$sel_status['selected_status'],$sel_status['attribute']); ?>
                    </div>
                    
                    <div class="cell_input">
                        <button type="submit" class="btn btn-primary">Save changes</button>
						<button type="button" class="btn" onClick="javascript:history.back();">Cancel</button>
                    </div>
                    <div class="cell_input">
                        &nbsp;
                    </div>
                    
                </div> 
   
            </div>
            
            <?php echo form_close(); ?>
        </div>
    </div>
</div>