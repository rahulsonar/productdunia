<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmsystemUserSignup").validate({
		rules: {
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
			    maxlength: 10,
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
				//required: '',
				equalTo: 'Confirm password does not match with password.'
			}
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_systemUserSignupSubmit(xajax.getFormValues('frmsystemUserSignup'));
		}
		
	});	
})
})(jQuery); 
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
			<input type='hidden' value="<?php echo $userid ?>" name='userid' id='userid'>
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('systemUSerSignupFirstName'); ?></label>
						<div class="controls">
							<?php echo form_input($first_name_txt); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('systemUSerSignupLastName'); ?></label>
						<div class="controls">
							<?php echo form_input($last_name_txt); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('systemUSerSignupEmail'); ?></label>
						<div class="controls">
							<?php echo form_input($email_txt); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('systemUSerSignupBranch'); ?></label>
						<div class="controls">
							<?php echo form_dropdown($sel_branch['name'],$sel_branch['options'],$sel_branch['selected_branch'],$sel_branch['attribute']); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('systemUSerSignupTimezone'); ?></label>
						<div class="controls">
							<?php echo form_dropdown($sel_timezone['name'],$sel_timezone['options'],$sel_timezone['selected_timezone'],$sel_timezone['attribute']); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('systemUSerSignupUsername'); ?></label>
						<div class="controls">
							<?php echo form_input($username_txt); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('systemUSerSignupPassword'); ?></label>
						<div class="controls">
							<?php echo form_password($password_txt); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('systemUSerSignupConfirmPassword'); ?></label>
						<div class="controls">
							<?php echo form_password($cnf_password_txt); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('systemUSerSignupStatus'); ?></label>
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