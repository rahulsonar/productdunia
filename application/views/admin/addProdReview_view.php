

<script type="text/javascript">
$(document).ready(function() {
   $('#prodRating').raty({
            score: <?php echo $rating; ?>,
            starOn: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-big-on.png',
            starOff: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-big-off.png'
    }); 
});
;(function($) {     
$(document).ready(function() {       
        
        $( "#custEmail" ).autocomplete({            	
            source: "<?php echo site_url("admin/catalog/getCustomerByEmailAutoComplete"); ?>",
            minLength: 2,
            select: function( event, ui ) {            		
                    $('#customerId').val(ui.item.id);                	
            },
            search: function() {
                    $('#customerId').val('0');
            }
        });
            
	$("#frmProdReview").validate({
		rules: {
			reviewTitle: {
				required: true
			}
		},errorElement: "div",
		messages: {
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_prodReviewSubmit(xajax.getFormValues('frmProdReview'));
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
                        <input type='hidden' value="<?php echo $reviewId ?>" name='reviewId' id='reviewId'>
                        <input type='hidden' value="<?php echo $customerId ?>" name='customerId' id='customerId'>
				<fieldset>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('custEmail'); ?></label>
						<div class="controls">
							<?php echo form_input($custEmail); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('reviewTitle'); ?></label>
						<div class="controls">
							<?php echo form_input($reviewTitle); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('reviewDesc'); ?></label>
						<div class="controls">
							<?php echo form_textarea($reviewDesc); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('rating'); ?></label>
						<div class="controls">
                                                    <div id="prodRating"></div>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('usefull'); ?></label>
						<div class="controls">
							<?php echo form_input($usefull); ?>
						</div>
					</div>
                                        <div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('notusefull'); ?></label>
						<div class="controls">
							<?php echo form_input($notUsefull); ?>
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