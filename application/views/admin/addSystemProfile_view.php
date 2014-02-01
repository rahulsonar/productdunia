<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$(".multiselect").multiselect();
	$("#frmsystemProfile").validate({
		rules: {
			profile_name: {
				required: true,
				alphaspecial: true
			}
		},errorElement: "div",
		messages: {
			profile_name: {
				//required: '',
				//alphaspecial: ''
			}
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_systemProfileSubmit(xajax.getFormValues('frmsystemProfile'));
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
			<input type='hidden' value="<?php echo $profileId ?>" name='profileId' id='profileId'>
				<fieldset>
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