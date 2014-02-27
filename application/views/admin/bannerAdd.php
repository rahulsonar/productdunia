<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	callChangPosition();
	$("#frmbannerAdd").validate({
		rules: {
			position: {
				required: true
			},
       		image: {
				required: true
			},
			url: {
				required: true
			}
		},errorElement: "div",
		messages: {
			
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			document.getElementById("frmbannerAdd").submit();
		}
		
	});	
        
        
})
})(jQuery); 

function callChangPosition(){

    var positionName = $("#position>option:selected").text();
    $("#positionName").val(positionName);
}        
        
</script>
<!-- content starts -->
	<div class="row-fluid sortable">		
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-edit"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
			<div id="errorMsg"><?php echo $this->session->flashdata('Msg'); ?></div>
			<?php echo form_open_multipart($action,$attributes); ?>
			<input type='hidden' value="<?php echo $bannerId; ?>" name="bannerId" id="bannerId" />
			<input type='hidden' value="<?php echo $image; ?>" name='imageFile' id='imageFile'>
				<fieldset>
                                        
                                        <div class="control-group">
						<label class="control-label" for="selectError"><?php echo $this->lang->line('bannerPosition'); ?></label>
						<div class="controls">
                                                        <input type='hidden' value="" name='positionName' id="positionName">
							<?php echo form_dropdown($positions['name'],$positions['options'],$positions['selectedPosition'],$positions['attribute']); ?>
						</div>
					</div>
                                        
                     <div class="control-group <?php if($image==''){ ?> hidden<?php } ?>">
                                            <label class="control-label" for="focusedInput"><?php echo $this->lang->line('bannerImage'); ?></label>
                                            <div class="controls">
                                            	<a href="#" onclick="window.open('<?php echo base_url() . $this->config->item('bannerUploadPath') ."/". $image; ?>','BannerImg'); return false;">
                                                <img alt="BannerImg" width="50" src="<?php echo base_url() . $this->config->item('bannerUploadPath') ."/". $image; ?>">
                                                </a>
                                                <a href="javascript:void(0)" onClick="xajax_deleteBannerImage('<?php echo $bannerId; ?>','<?php echo $image; ?>')" title="Click to delete"><span class="icon32 icon-red icon-trash"/></span></a>
                                            </div>
                                        </div>
                                        <div class="control-group <?php if($image!=''){ ?> hidden<?php } ?>">
                                            <label class="control-label" for="focusedInput"><?php echo $this->lang->line('bannerImage'); ?></label>
                                            <div class="controls">
                                                <?php echo form_input($image_field); ?>
                                            </div>
                                        </div>
                                        
					<div class="control-group">
						<label class="control-label" for="focusedInput"><?php echo $this->lang->line('bannerUrl'); ?></label>
						<div class="controls">
							<?php echo form_input($url_field); ?>
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