<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$(".multiselect").multiselect();
	$("#frmAssociateSubarea").validate({
		rules: {
			areaName: {
				required: true
			}
		},errorElement: "div",
		messages: {
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_subAreaAssociationSubmit(xajax.getFormValues('frmAssociateSubarea'));
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
			<input type='hidden' value="<?php echo $areaId ?>" name='areaId' id='areaId'>
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('areaName'); ?></label>
						<div class="controls">
							<?php echo form_input($areaName); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('areaIncludes'); ?></label>
						<div class="controls">
							<select id = "subAreas" class="multiselect" multiple="multiple" name = "subAreas[]">
								<?php foreach ($subAreas as $key => $areaVal) { ?>
									<option value="<?php echo $key;?>" <?php if(in_array($key,$associatedAreas)){?>selected="selected"<?php }?>><?php echo $areaVal;?></option>
								<?php }?>
                                                        </select>
                                                        <?php foreach ($subAreas as $key => $areaVal) { ?>
                                                                <input type='hidden' value="<?php echo $areaVal ?>" name="subAreaName[<?php echo $key; ?>]" id='subAreaName'>
                                                        <?php }?>
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