<script type="text/javascript">
    ;(function($) { 
        $(document).ready(function() {
            $("#frmAddStoreProducts").validate({
                ignore: ":hidden:not(select)",
                rules: {
                    agency: {
                        required: true
                    },
                    'storeIds[]': {
                        required: true
                    },
                    'sellingPrice[]': {
                        required: true,
                        decimalnumeric: true
                    }
                },errorElement: "div",
                messages: {
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function(){
                    xajax_addStoreProductsSubmit(xajax.getFormValues('frmAddStoreProducts'));
                }
		
            });
        })
    })(jQuery); 
</script>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
                    <?php echo form_open($action, $attributes); ?>
                    <fieldset>
                    <?php if($this->session->userdata('sysuser_type')=='system'){ ?>
                    <div class="control-group">
                            <label class="control-label" for="focusedInput"><?php echo $this->lang->line('agency'); ?></label>
                            <div class="controls">
                            <select id = "agency" data-rel="chosen" name = "agency" onChange="xajax_getAgencyStores(this.value);">
                                <?php foreach ($agencyArr as $key => $agencyName) { ?>
                                        <option value="<?php echo $key;?>"><?php echo $agencyName;?></option>
                                <?php }?>
                            </select>
                            </div>
                    </div>
                    <div class="control-group hide" id="storeSelect" >
                            <label class="control-label" for="selectError"><?php echo $this->lang->line('stores'); ?></label>
                            <div class="controls" id="storeHolder"></div>
                    </div>    
                    <?php }else{ ?>
                    <input type='hidden' value="<?php echo $agency; ?>" name='agency' id='agency'>                        
                    <div class="control-group">
                            <label class="control-label" for="selectError"><?php echo $this->lang->line('stores'); ?></label>
                            <div class="controls">
                                <select id = "storeIds" data-rel="chosen" class="multiselect" multiple="multiple" name = "storeIds[]">
                                <?php foreach ($storesArr as $key => $storesName) { ?>
                                        <option value="<?php echo $key;?>"><?php echo $storesName;?></option>
                                <?php } ?>
                                </select>
                            </div>
                    </div>
                    <?php } ?>                    
                    <table class="table table-bordered table-striped table-condensed">
                    <thead>
                            <tr>
                                    <th width="50px;">Product Img</th>
                                    <th width="220px;">Product Name</th>
                                    <th width="100px;">Model Number</th>
                                    <th width="100px;">Variant</th>
                                    <th width="100px;">Color</th>
                                    <th width="100px;">Product SKU</th>
                                    <th width="100px;">Selling Price</th>
                                    <th width="100px;">Qty</th>
                                    <th width="100px;">Dispatch Period</th>
                                    <th width="100px;">Offer Price</th>
                                    <th width="100px;">Offer Remark</th>
                                    <th>Remark</th>
                            </tr>
                    </thead>   
                    <tbody>
                        <?php foreach ($selectedStoreProducts as $key => $product) { ?>
                            <input type='hidden' value="<?php echo $product->productId; ?>" name='productId[]' id='productId'>
                            <tr>
                                  <td><a href="<?php echo base_url().$this->config->item('productImgPath') . $product->productImg?>" class="cboxElement" target="_blank" title="<?php echo $product->productName; ?>"><img alt="product" src="<?php echo base_url().$this->config->item('productThumbImgPath') . $product->productImg?>" title="<?php echo $product->productName; ?>" width="50px" height="50px"></a></td>
                                  <td><input type='text' value="<?php echo $product->productName; ?>" name='productName[]' id='productName-<?php echo $product->productId; ?>' readonly="readonly" class="input-medium"></td>
                                  <td><input type='text' value="<?php echo $product->productModel; ?>" name='productModel[]' id='productModel-<?php echo $product->productId; ?>' readonly="readonly" class="input-mini"></td>
                                  <td><input type='text' value="<?php echo $product->productVariant; ?>" name='productVariant[]' id='productVariant-<?php echo $product->productId; ?>' readonly="readonly" class="input-mini"></td>
                                  <td><input type='text' value="<?php echo $product->productColor; ?>" name='productColor[]' id='productColor-<?php echo $product->productId; ?>' readonly="readonly" class="input-mini"></td>
                                  <td><input type='text' value="" name='productSKU[]' id='productSKU-<?php echo $product->productId; ?>' class="input-mini"></td>
                                  <td><input type='text' value="" name='sellingPrice[]' id='sellingPrice-<?php echo $product->productId; ?>' class="input-mini"></td>
                                  <td><input type='text' value="" name='qty[]' id='qty-<?php echo $product->productId; ?>' class="input-mini"></td>
                                  <td><input type='text' value="" name='dispatchPeriod[]' id='dispatchPeriod-<?php echo $product->productId; ?>' class="input-mini"></td>
                                  <td><input type='text' value="" name='offerPrice[]' id='offerPrice-<?php echo $product->productId; ?>' class="input-mini"></td>
                                  <td><input type='text' value="" name='offerRemark[]' id='offerRemark-<?php echo $product->productId; ?>' class="input-mini"></td>
                                  <td><input type='text' value="" name='remark[]' id='remark-<?php echo $product->productId; ?>' class="input-mini"></td>
                          </tr>
                          <?php } ?>
                    </tbody>
                    </table>
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