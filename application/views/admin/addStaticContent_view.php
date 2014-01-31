<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmStaticContent").validate({
		rules: {
			page_heading: {
				required: true
			},
			page_content: {
				required: true
			}
		},errorElement: "div",
		messages: {
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_staticContentSubmit(xajax.getFormValues('frmStaticContent'));
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
			<input type='hidden' value="<?php echo $contentId; ?>" name='contentId' id='contentId'>
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('pageTitle'); ?></label>
						<div class="controls">
							<?php echo form_input($page_heading); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('pageDesc'); ?></label>
						<div class="controls">
							<?php echo form_textarea($page_content); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('status'); ?></label>
						<div class="controls">
							<?php echo form_dropdown($sel_status['name'],$sel_status['options'],$sel_status['selected_status'],$sel_status['attribute']); ?>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('btnSave'); ?></button>
						<button type="button" class="btn" onClick="javascript:back(-1)"><?php echo $this->lang->line('btnCancel'); ?></button>
					</div>
				</fieldset>
			<?php echo form_close(); ?>
		</div>					
		</div><!--/span-->
	</div><!--/row-->	
<!-- content ends -->