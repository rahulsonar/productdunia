<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmstoreUserSignup").validate({
		rules: {
			agency: {
				required: true
			},
                        first_name: {
				required: true,
				alphaspecial: true
			},
			last_name: {
				required: true,
				alphaspecial: true
			},
			email: {
				required: true,
				email: true
			},
			username: {
				required: true,
				alphanumeric: true,
				minlength: 5,
                                maxlength: 10
			},
			password: {
				required: true,
				minlength: 5,
                                maxlength: 15			    		    
			},
			cnf_password: {
				required: true,
				equalTo: "#password"				
			}
		},errorElement: "div",
		messages: {
			cnf_password: {
				equalTo: 'Confirm password does not match with the password.'
			}
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_storeUserSignupSubmit(xajax.getFormValues('frmstoreUserSignup'));
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
			<?php echo form_open($action,$attributes); ?>
			<input type='hidden' value="<?php echo $userid ?>" name='userid' id='userid'>
				<fieldset>
                                        <?php if($this->session->userdata('sysuser_type')=='system'){ ?>
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('storeUserSignupAgency'); ?></label>
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
						<label class="control-label" for="selectError"><?php echo $this->lang->line('storeUserSignupAgency'); ?></label>
						<div class="controls">
    							<?php echo form_input($agencyName); ?>
						</div>
					</div>
                                        <?php } ?>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('storeUserSignupFirstName'); ?></label>
						<div class="controls">
							<?php echo form_input($first_name_txt); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('storeUserSignupLastName'); ?></label>
						<div class="controls">
							<?php echo form_input($last_name_txt); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('storeUserSignupEmail'); ?></label>
						<div class="controls">
							<?php echo form_input($email_txt); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('storeUserSignupBranch'); ?></label>
						<div class="controls">
							<?php echo form_dropdown($sel_branch['name'],$sel_branch['options'],$sel_branch['selected_branch'],$sel_branch['attribute']); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('storeUserSignupTimezone'); ?></label>
						<div class="controls">
							<?php echo form_dropdown($sel_timezone['name'],$sel_timezone['options'],$sel_timezone['selected_timezone'],$sel_timezone['attribute']); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('storeUserSignupUsername'); ?></label>
						<div class="controls">
							<?php echo form_input($username_txt); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('storeUserSignupPassword'); ?></label>
						<div class="controls">
							<?php echo form_password($password_txt); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('storeUserSignupConfirmPassword'); ?></label>
						<div class="controls">
							<?php echo form_password($cnf_password_txt); ?>
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