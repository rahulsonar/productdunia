<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$(".multiselect").multiselect();
	$("#frmAssignStores").validate({
		rules: {
			username: {
				required: true
			}
		},errorElement: "div",
		messages: {
			username: {
				//required: ''
			}
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_assignStoresSubmit(xajax.getFormValues('frmAssignStores'));
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
			<input type='hidden' value="<?php echo $userId ?>" name='userId' id='userId'>
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('username'); ?></label>
						<div class="controls">
							<?php echo form_input($username_txt); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('stores'); ?></label>
						<div class="controls">
							<select id = "user_stores" class="multiselect" multiple="multiple" name = "user_stores[]">
								<?php foreach ($stores as $key => $storeName) { ?>
									<option value="<?php echo $key;?>" <?php if(in_array($key,$storeAssigned)){?>selected="selected"<?php }?>><?php echo $storeName;?></option>
								<?php }?>
                                                        </select>
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