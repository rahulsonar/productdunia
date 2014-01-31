

<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$(".multiselect").multiselect();
	$("#frmProduct").validate({
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
			xajax_productSubmit(xajax.getFormValues('frmProduct'));
		}
		
	});
        
        $( "#productColor" ).autocomplete({            	
            source: '<?php echo site_url("admin/catalog/getProdColorAutoComplete"); ?>',
            minLength: 2,
            select: function( event, ui ) {            		
                    //$('#customerId').val(ui.item.id);                	
            },
            search: function() {
                    //$('#customerId').val('');
            }
        });
        
        $( "#productVariant" ).autocomplete({            	
            source: '<?php echo site_url("admin/catalog/getProdVariantAutoComplete"); ?>',
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
			<input type='hidden' value="<?php echo $productId ?>" name='productId' id='productId'>
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('productSKU'); ?></label>
						<div class="controls">
							<?php echo form_input($productSKU); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('productModel'); ?></label>
						<div class="controls">
							<?php echo form_input($productModel); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('productName'); ?></label>
						<div class="controls">
							<?php echo form_input($productName); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('productVariant'); ?></label>
						<div class="controls">
							<?php echo form_input($productVariant); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('productColor'); ?></label>
						<div class="controls">
							<?php echo form_input($productColor); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('productMRP'); ?></label>
						<div class="controls">
							<?php echo form_input($productMRP); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('productDP'); ?></label>
						<div class="controls">
							<?php echo form_input($productDP); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('productBrand'); ?></label>
						<div class="controls">
							<?php echo form_dropdown($sel_brand['name'],$sel_brand['options'],$sel_brand['selected_brand'],$sel_brand['attribute']); ?>
						</div>
					</div>
                                        <?php if($productImg!=''){?>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('productProductImg'); ?></label>
						<div class="controls">
                                                    <img alt="product" src="<?php echo base_url().$this->config->item('productThumbImgPath') . $productImg?>">
						</div>
					</div>
					<?php }?>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('productDesc'); ?></label>
						<div class="controls">
							<?php echo form_textarea($productDesc); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('productFeatures'); ?></label>
						<div class="controls">
							<?php echo form_textarea($productFeatures); ?>
                                                        <p class="help-block">Use <b>double pipe</b> (||) as separator for multiple features.</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('status'); ?></label>
						<div class="controls">
							<?php echo form_dropdown($sel_status['name'],$sel_status['options'],$sel_status['selected_status'],$sel_status['attribute']); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('productCategory'); ?></label>
						<div id="checkboxTree" class="controls">
						<fieldset>
						<ul>
							<?php foreach ($productCategories as $firstLevelKey => $firstLevelVal) { ?>
							<?php $firstLevelClass = (count($firstLevelVal['submenus']) > 0)?('mjs-nestedSortable-branch mjs-nestedSortable-collapsed'):('mjs-nestedSortable-leaf');?> 
							<li id="list_<?php echo $firstLevelVal['categoryId'];?>"><input type="checkbox" name="productCategories[]" value="<?php echo $firstLevelVal['categoryId'];?>" <?php if(in_array($firstLevelVal['categoryId'],$assignedCategories)){?>checked<?php } ?>/><?php echo $firstLevelVal['name'];?>
								<?php if(count($firstLevelVal['submenus']) > 0){?>
								<ul>
									<?php foreach ($firstLevelVal['submenus'] as $secondLevelKey => $secondLevelVal) { ?>
									<?php $secondLevelClass = (count($secondLevelVal['submenus']) > 0)?('mjs-nestedSortable-branch mjs-nestedSortable-collapsed'):('mjs-nestedSortable-leaf');?> 
									<li id="list_<?php echo $secondLevelVal['categoryId'];?>"><input type="checkbox" name="productCategories[]" value="<?php echo $secondLevelVal['categoryId'];?>" <?php if(in_array($secondLevelVal['categoryId'],$assignedCategories)){?>checked<?php } ?>/><?php echo $secondLevelVal['name'];?>
										<?php if(count($secondLevelVal['submenus']) > 0){?>
										<ul>
											<?php foreach ($secondLevelVal['submenus'] as $thirdLevelKey => $thirdLevelVal) { ?>
											<?php $thirdLevelClass = (count($thirdLevelVal['submenus']) > 0)?('mjs-nestedSortable-branch mjs-nestedSortable-collapsed'):('mjs-nestedSortable-leaf');?> 
											<li id="list_<?php echo $thirdLevelVal['categoryId'];?>"><input type="checkbox" name="productCategories[]" value="<?php echo $thirdLevelVal['categoryId'];?>" <?php if(in_array($thirdLevelVal['categoryId'],$assignedCategories)){?>checked<?php } ?>/><?php echo $thirdLevelVal['name'];?>
											</li>
											<?php } ?>
										</ul>
										<?php } ?>
									</li>
									<?php } ?>
								</ul>
								<?php } ?>
							</li>
							<?php } ?>
						</ul>
						</fieldset>
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