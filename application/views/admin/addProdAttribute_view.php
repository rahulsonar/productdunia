<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmProdAttribute").validate({
                ignore: ":hidden:not(select)",
		rules: {
                        attributeType: {
                                required: function(element){
                                            return $("#attributeTypeTxt").val() == "";
                                        }
                        }, 
			attributeValue: {
				required: true
			}
		},errorElement: "div",
		messages: {
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
                    xajax_prodAttributeSubmit(xajax.getFormValues('frmProdAttribute'));
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
			<input type='hidden' value="<?php echo $attributeId ?>" name='attributeId' id='attributeId'>
				<fieldset>
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('attributeType'); ?></label>
						<div class="controls">
							<?php echo form_dropdown($sel_attributeType['name'],$sel_attributeType['options'],$sel_attributeType['selected_status'],$sel_attributeType['attribute']); ?><br /><?php echo form_input($attributeTypeTxt); ?>
                                                        <p class="help-block">If attribute type does not exist in select box, you can add new one using above text box.</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('attributeValue'); ?></label>
						<div class="controls">
							<?php echo form_input($attributeValue); ?>
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
						<button type="button" class="btn" onClick="javascript:history.back();"><?php echo $this->lang->line('btnCancel'); ?></button>
					</div>
				</fieldset>
			<?php echo form_close(); ?>
		</div>					
		</div><!--/span-->
	</div><!--/row-->	
<!-- content ends -->