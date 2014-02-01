<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$(".multiselect").multiselect();
	$("#frmstoreProfile").validate({
                ignore: ":hidden:not(select)",
		rules: {
                        agency: {
				required: true
			},
			profile_name: {
				required: true,
				alphaspecial: true
			}
		},errorElement: "div",
		messages: {
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_storeProfileSubmit(xajax.getFormValues('frmstoreProfile'));
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
			<div id="errorMsg"></div>
			<?php echo form_open($action,$attributes); ?>
			<input type='hidden' value="<?php echo $profileId ?>" name='profileId' id='profileId'>
				<fieldset>
                                        <?php if($this->session->userdata('sysuser_type')=='system'){ ?>
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('agency'); ?></label>
						<div class="controls">
                                                        <input type='hidden' value="<?php echo $agencyName ?>" name='agencyName' id='agencyName'>
							<?php echo form_dropdown($sel_agency['name'],$sel_agency['options'],$sel_agency['selected_agency'],$sel_agency['attribute']); ?>
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
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('systemProfileName'); ?></label>
						<div class="controls">
							<?php echo form_input($profile_name); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('accessPermissions'); ?></label>
						<div class="controls">
							<select id = "accessPermissions" class="multiselect" multiple="multiple" name = "accessPermissions[]">
								<?php foreach ($accessPermissions as $key => $permissionName) { ?>
									<option value="<?php echo $key;?>" <?php if(in_array($key,$accessPermissionsAssigned)){?>selected="selected"<?php }?>><?php echo $permissionName;?></option>
								<?php }?>
						        
						    </select>
						</div>
					</div>	
					<div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('status'); ?></label>
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