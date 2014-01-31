<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmProdSpecification").validate({
                ignore: ":hidden:not(select)",
		rules: {
                        specificationGroup: {
                                required: function(element){
                                            return $("#specificationGroupTxt").val() == "";
                                        }
                        }, 
			specLabel: {
				required: true
			}, 
			specValue: {
				required: true
			}
		},errorElement: "div",
		messages: {
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
                    xajax_prodSpecificationSubmit(xajax.getFormValues('frmProdSpecification'));
		}
		
	});
        
            $( "#specLabel" ).autocomplete({            	
            	source: '<?php echo site_url("admin/catalog/getSpecLabelAutoComplete"); ?>',
            	minLength: 2,
            	select: function( event, ui ) {            		
            		//$('#customerId').val(ui.item.id);                	
            	},
            	search: function() {
                	//$('#customerId').val('');
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
                            <input type='hidden' value="<?php echo $specificationId ?>" name='specificationId' id='specificationId'>
                            <input type='hidden' value="<?php echo $productId ?>" name='productId' id='productId'>
				<fieldset>
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('specificationGroup'); ?></label>
						<div class="controls">
							<?php echo form_dropdown($sel_specificationGroup['name'],$sel_specificationGroup['options'],$sel_specificationGroup['selected_status'],$sel_specificationGroup['attribute']); ?>
                                                        <?php echo form_checkbox($editSpecGroup); ?>&nbsp;<?php echo $this->lang->line('editSpecificationGroup'); ?>
                                                        <br /><?php echo form_input($specificationGroupTxt); ?>
                                                        <p class="help-block">If specification group does not exist in select box, you can add new one using above text box.</p>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('specificationLabel'); ?></label>
						<div class="controls">
							<?php echo form_input($specLabel); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('specificationValue'); ?></label>
						<div class="controls">
							<?php echo form_input($specValue); ?><br />
                                                        <p class="help-block">Use || as separator for multiple values.</p>
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