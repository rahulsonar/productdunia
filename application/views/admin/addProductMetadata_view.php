

<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$(".multiselect").multiselect();
	$("#frmProductMetadata").validate({
		rules: {
			productName: {
				required: true
			}
		},errorElement: "div",
		messages: {
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_productMetadataSubmit(xajax.getFormValues('frmProductMetadata'));
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
			<input type='hidden' value="<?php echo $productId ?>" name='productId' id='productId'>
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('productName'); ?></label>
						<div class="controls">
							<?php echo form_input($productName); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('pageTitle'); ?></label>
						<div class="controls">
							<?php echo form_input($pageTitle); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('metaKeyword'); ?></label>
						<div class="controls">
							<?php echo form_textarea($metaKeyword); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('metaDesc'); ?></label>
						<div class="controls">
							<?php echo form_textarea($metaDesc); ?>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('btnSave'); ?></button>
						<button type="button" class="btn" onClick="javascript:history.back();"><?php echo $this->lang->line('btnCancel'); ?></button>
					</div>
				</fieldset>
			<?php echo form_close(); ?>
		</div>					
		</div><!--/span-->
	</div><!--/row-->	
<!-- content ends -->