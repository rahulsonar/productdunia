<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmFAQ").validate({
                ignore: ":hidden:not(select)",
		rules: {
                        questionCategory: {
                                required: function(element){
                                            return $("#questionCategoryTxt").val() == "";
                                        }
                        },
			faq_ques: {
				required: true
			},
			faq_ans: {
				required: true
			}
		},errorElement: "div",
		messages: {
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_faqSubmit(xajax.getFormValues('frmFAQ'));
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
			<input type='hidden' value="<?php echo $faqId; ?>" name='faqId' id='faqId'>
				<fieldset>
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('questionCategory'); ?></label>
						<div class="controls">
							<?php echo form_dropdown($sel_questionCategory['name'],$sel_questionCategory['options'],$sel_questionCategory['selected_status'],$sel_questionCategory['attribute']); ?>
                                                        <br /><?php echo form_input($questionCategoryTxt); ?>
                                                        <p class="help-block">If question category does not exist in select box, you can add new one using above text box.</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('question'); ?></label>
						<div class="controls">
							<?php echo form_input($faq_ques); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('answer'); ?></label>
						<div class="controls">
							<?php echo form_textarea($faq_ans); ?>
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