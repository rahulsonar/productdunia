<script type="text/javascript">
;(function($) { 
$(document).ready(function() {

	$("#frmStore").validate({
                ignore: ":hidden:not(select)",
		rules: {
			agency: {
				required: function(element){
					
					return ($("#agencyNameNew").val()=='');
				}
			},
			agencyNameNew: {
				required:function(element){
					return ($("#agency").val()=='');
				}
			},
                        country: {
				required: true
			},
                        city: {
				required: true
			},
                        area: {
				required: true
			},
                        storeName: {
				required: true
			},
			latitude: {
				required: true,
                                decimalnumeric: true
			},
			longitude: {
				required: true,
                                decimalnumeric: true
			}
		},errorElement: "div",
		messages: {
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			//xajax_storeSubmit(xajax.getFormValues('frmStore'));
                        document.getElementById("frmStore").submit();
		}
		
	});	
        
        
})
})(jQuery); 

function callChangeAgency(){

    var agencyName = $("#agency>option:selected").text();
    $("#agencyName").val(agencyName);
}        
        
</script>
<!-- content starts -->
	<div class="row-fluid sortable">		
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-edit"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
			<div id="errorMsg"><?php echo $this->session->flashdata('Msg'); ?></div>
			<?php echo form_open_multipart($action,$attributes); ?>
			<input type='hidden' value="<?php echo $storeId ?>" name='storeId' id='storeId'>
                        <input type='hidden' value="<?php echo $storeLogoImg ?>" name='storeLogoImg' id='storeLogoImg'>
				<fieldset>
                                        <?php if($this->session->userdata('sysuser_type')=='system'){ ?>
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('agency'); ?></label>
						<div class="controls">
                                                        <input type='hidden' value="<?php echo $agencyName ?>" name='agencyName' id='agencyName'>
							<?php echo form_dropdown($sel_agency['name'],$sel_agency['options'],$sel_agency['selected_agency'],$sel_agency['attribute']); ?>
							<input type="text" name="agencyNameNew" value="" id="agencyNameNew" />
						</div>
					</div>
                                        <?php }else{ ?>
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('storeUserSignupAgencyCode'); ?></label>
						<div class="controls">
                                                        <?php echo form_input($agency); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('agency'); ?></label>
						<div class="controls">
    							<?php echo form_input($agencyName); ?>
						</div>
					</div>
                                        <?php } ?>
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('country'); ?></label>
						<div class="controls">
							<?php echo form_dropdown($sel_country['name'],$sel_country['options'],$sel_country['selected_country'],$sel_country['attribute']); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('city'); ?></label>
						<div class="controls" id="cityHolder">
							<?php echo form_dropdown($sel_city['name'],$sel_city['options'],$sel_city['selected_city'],$sel_city['attribute']); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('area'); ?></label>
						<div class="controls" id="areaHolder">
							<?php echo form_dropdown($sel_area['name'],$sel_area['options'],$sel_area['selected_area'],$sel_area['attribute']); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('address'); ?></label>
						<div class="controls">
							<?php echo form_textarea($address); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('pincode'); ?></label>
						<div class="controls">
							<?php echo form_input($pincode); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('storeName'); ?></label>
						<div class="controls">
							<?php echo form_input($storeName); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('contactPerson'); ?></label>
						<div class="controls">
							<?php echo form_input($contactPerson); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('storeEmail'); ?></label>
						<div class="controls">
							<?php echo form_input($storeEmail); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('mobile'); ?></label>
						<div class="controls">
							<?php echo form_input($mobile); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('phone'); ?></label>
						<div class="controls">
							<?php echo form_input($phone); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('alternatPhone'); ?></label>
						<div class="controls">
							<?php echo form_input($alternatPhone); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('storeTimings'); ?></label>
						<div class="controls">
							<?php echo form_textarea($storeTimings); ?>
						</div>
					</div>
                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput"><?php echo $this->lang->line('latitude'); ?></label>
                                            <div class="controls">
                                                <?php echo form_input($latitude); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput"><?php echo $this->lang->line('longitude'); ?></label>
                                            <div class="controls">
                                                <?php echo form_input($longitude); ?>
                                            </div>
                                        </div>
                                        <div class="control-group <?php if($storeLogoImg==''){ ?> hidden<?php } ?>">
                                            <label class="control-label" for="focusedInput"><?php echo $this->lang->line('storeLogoImg'); ?></label>
                                            <div class="controls">
                                                <img alt="storeLogoImg" src="<?php echo base_url() . $this->config->item('storeLogoPath') . $storeLogoImg?>">
                                                <a href="javascript:void(0)" onClick="xajax_deleteStoreLogoImage('<?php echo $storeId; ?>','<?php echo $storeLogoImg; ?>')" title="Click to delete"><span class="icon32 icon-red icon-trash"/></span></a>
                                            </div>
                                        </div>
                                        <div class="control-group <?php if($storeLogoImg!=''){ ?> hidden<?php } ?>">
                                            <label class="control-label" for="focusedInput"><?php echo $this->lang->line('storeLogoImg'); ?></label>
                                            <div class="controls">
                                                <?php echo form_upload($storeLogo); ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput"><?php echo $this->lang->line('paymentMethods'); ?></label>
                                            <div class="controls">
                                                <input type="checkbox" name="paymentMethods[]" value="card" <?php if(in_array('card', $paymentMethods)) { ?> checked <?php } ?>>&nbsp;Credit/Debit card<br />
                                                <input type="checkbox" name="paymentMethods[]" value="cash" <?php if(in_array('cash', $paymentMethods)) { ?> checked <?php } ?>>&nbsp;Cash accepted<br />
                                            </div>
                                        </div>
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('parking'); ?></label>
						<div class="controls">
							<?php echo form_dropdown($sel_isParking['name'],$sel_isParking['options'],$sel_isParking['selected_isParking'],$sel_isParking['attribute']); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('storeUserSignupStatus'); ?></label>
						<div class="controls">
							<?php echo form_dropdown($sel_status['name'],$sel_status['options'],$sel_status['selected_status'],$sel_status['attribute']); ?>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Save changes</button>
						<button type="button" class="btn" onClick="javascript:history.back();">Cancel</button>
					</div>
				</fieldset>
			<?php echo form_close(); ?>
		</div>					
		</div><!--/span-->
	</div><!--/row-->	
<!-- content ends -->