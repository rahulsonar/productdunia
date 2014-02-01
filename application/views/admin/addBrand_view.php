<script type="text/javascript">
    ;(function($) { 
        $(document).ready(function() {
            $("#frmBrand").validate({
                ignore: ":hidden:not(select)",
                rules: {
                    brandName: {
                        required: true
                    }
                },errorElement: "div",
                messages: {
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function(){
                    //xajax_brandSubmit(xajax.getFormValues('frmBrand'));
                    document.getElementById("frmBrand").submit();
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
            <?php echo form_open_multipart($action, $attributes); ?>
            <input type='hidden' value="<?php echo $brandId ?>" name='brandId' id='brandId'>
            <input type='hidden' value="<?php echo $brandLogo ?>" name='brandLogo' id='brandLogo'>
            
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="focusedInput"><?php echo $this->lang->line('brandName'); ?></label>
                    <div class="controls">
                        <?php echo form_input($brandName); ?>
                    </div>
                </div>
                <div class="control-group <?php if($brandLogo==''){ ?> hidden<?php } ?>">
                    <label class="control-label" for="focusedInput"><?php echo $this->lang->line('brandImg'); ?></label>
                    <div class="controls">
                        <img alt="brandImg" src="<?php echo base_url() . $this->config->item('brandImgPath') . $brandLogo?>">
                        <a href="javascript:void(0)" onClick="xajax_deleteBrandImage('<?php echo $brandId; ?>','<?php echo $brandLogo; ?>')" title="Click to delete"><span class="icon32 icon-red icon-trash"/></span></a>
                    </div>
                </div>
                <div class="control-group <?php if($brandLogo!=''){ ?> hidden<?php } ?>">
                    <label class="control-label" for="focusedInput"><?php echo $this->lang->line('brandImg'); ?></label>
                    <div class="controls">
                        <?php echo form_upload($brandImg); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="selectError"><?php echo $this->lang->line('status'); ?></label>
                    <div class="controls">
                        <?php echo form_dropdown($sel_status['name'], $sel_status['options'], $sel_status['selected_status'], $sel_status['attribute']); ?>
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