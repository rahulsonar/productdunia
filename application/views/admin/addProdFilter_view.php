<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmProdFilter").validate({
                ignore: ":hidden:not(select)",
		rules: {
                        category: {
				required: true
			},
                        filterType: {
                                required: function(element){
                                            return $("#filterTypeTxt").val() == "";
                                        }
                        }, 
			filterValue: {
				required: true
			}
		},errorElement: "div",
		messages: {
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
                    xajax_prodFilterSubmit(xajax.getFormValues('frmProdFilter'));
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
			<input type='hidden' value="<?php echo $filterId ?>" name='filterId' id='filterId'>
                        <input type='hidden' value="<?php echo $categoryId ?>" name='categoryId' id='categoryId'>
				<fieldset>
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('productCategory'); ?></label>
						<div class="controls">
							<select id="category" name="category" data-rel="chosen" style="width: 370px;" <?php if($filterId==""){ ?> onChange="xajax_getProductFilterType(this.value,1)" <?php } ?>>
								<option value="">Select Category</option>
								<?php foreach ($productCategories as $firstLevelKey => $firstLevelVal) { ?>
                                                                <option value="<?php echo $firstLevelVal['categoryId'];?>" <?php if($firstLevelVal['categoryId']== $categoryId){ echo 'selected=selected'; } ?>><?php echo $firstLevelVal['name'];?></option>
									<?php if(count($firstLevelVal['submenus']) > 0){?>
										<?php foreach ($firstLevelVal['submenus'] as $secondLevelKey => $secondLevelVal) { ?>
										<option value="<?php echo $secondLevelVal['categoryId'];?>" <?php if($secondLevelVal['categoryId']== $categoryId){ echo 'selected=selected'; } ?>>===>> <?php echo $secondLevelVal['name'];?></option>
											<?php if(count($secondLevelVal['submenus']) > 0){?>
												<?php foreach ($secondLevelVal['submenus'] as $thirdLevelKey => $thirdLevelVal) { ?>
												<option value="<?php echo $thirdLevelVal['categoryId'];?>" <?php if($thirdLevelVal['categoryId']== $categoryId){ echo 'selected=selected'; } ?>>======>>> <?php echo $thirdLevelVal['name'];?></option>
												<?php } ?>
											<?php } ?>
										<?php } ?>
									<?php } ?>
								<?php } ?>
					  		</select>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('filterType'); ?></label>
						<div class="controls" id="filterTypeHolder">
							<?php echo form_dropdown($sel_filterType['name'],$sel_filterType['options'],$sel_filterType['selected_status'],$sel_filterType['filter']); ?><br /><?php echo form_input($filterTypeTxt); ?>
                                                        <?php echo form_checkbox($editFilterType); ?>&nbsp;<?php echo $this->lang->line('editFilterType'); ?>
                                                        <p class="help-block">If filter type does not exist in select box, you can add new one using above text box.</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('filterValue'); ?></label>
						<div class="controls">
							<?php echo form_input($filterValue); ?>
						</div>
					</div>					
					<div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('status'); ?></label>
						<div class="controls">
							<?php echo form_dropdown($sel_status['name'],$sel_status['options'],$sel_status['selected_status'],$sel_status['filter']); ?>
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