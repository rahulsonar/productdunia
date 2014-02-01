<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmProductCategory").validate({
		rules: {
			categoryName: {
				required: true
			}
		},errorElement: "div",
		messages: {
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_productCategorySubmit(xajax.getFormValues('frmProductCategory'));
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
			<input type='hidden' value="<?php echo $categoryId ?>" name='categoryId' id='categoryId'>
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('productCategoryName'); ?></label>
						<div class="controls">
							<?php echo form_input($categoryName); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('parentCategory'); ?></label>
						<div class="controls">
							<select id="parentCatId" name="parentCatId" data-rel="chosen" style="width: 370px;">
								<option value="0">Select Parent Category</option>
								<?php foreach ($productCategories as $firstLevelKey => $firstLevelVal) { ?>
                                                                <option value="<?php echo $firstLevelVal['categoryId'];?>" <?php if($firstLevelVal['categoryId']==$parentId){ echo 'selected=selected'; } ?>><?php echo $firstLevelVal['name'];?></option>
									<?php if(count($firstLevelVal['submenus']) > 0){?>
										<?php foreach ($firstLevelVal['submenus'] as $secondLevelKey => $secondLevelVal) { ?>
										<option value="<?php echo $secondLevelVal['categoryId'];?>" <?php if($secondLevelVal['categoryId']==$parentId){ echo 'selected=selected'; } ?>>===>> <?php echo $secondLevelVal['name'];?></option>
											<?php if(count($secondLevelVal['submenus']) > 0){?>
												<?php foreach ($secondLevelVal['submenus'] as $thirdLevelKey => $thirdLevelVal) { ?>
												<option value="<?php echo $thirdLevelVal['categoryId'];?>" <?php if($thirdLevelVal['categoryId']==$parentId){ echo 'selected=selected'; } ?>>======>>> <?php echo $thirdLevelVal['name'];?></option>
												<?php } ?>
											<?php } ?>
										<?php } ?>
									<?php } ?>
								<?php } ?>
					  		</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('status'); ?></label>
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