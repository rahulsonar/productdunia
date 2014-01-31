<link rel="stylesheet" href="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/bxslider/jquery.bxslider.css" type="text/css" media="screen" title="default" />
<script type='text/javascript' src='<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/bxslider/jquery.bxslider.js'></script>
<script type="text/javascript">
    ;(function($) { 
        $(document).ready(function() {
            $('.bxslider').bxSlider({
                slideWidth: 300,
                minSlides: 1,
                maxSlides: 3,
                moveSlides: 3,
                pagerType: 'short',
                slideMargin: 5
            });
            
            $(".iWantToSell").change(function() {
                var productId = $(this).val();
                if($(this).is(':checked')) {
                    xajax_selectStoreProducts(productId, 'push');
                }else{
                    xajax_selectStoreProducts(productId, 'pop');
                }
            });
        })
    })(jQuery); 
</script>

<!-- content starts -->

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
                        <fieldset>
                        <?php if(count($searchProducts) > 0){ ?>
                        <?php echo form_open($action,$attributes); ?>                        
                        <ul class="bxslider">
                        <?php foreach ($searchProducts as $prodKey => $product) { ?>
                        <li style="font: normal 12px Arial">
                            <table border="1" width="90%">
                                <tr>
                                    <td width="10%"><img alt="product" src="<?php echo base_url().$this->config->item('productThumbImgPath') . $product->productImg; ?>" title="<?php echo $product->productName; ?>" width="80" height="80"></td>
                                    <td width="50%">
                                        <table width="100%" border="1">
                                            <tr>
                                                <td><b><?php echo $product->productName; ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>Model : <?php echo $product->productModel; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Verient : <?php echo $product->productVariant; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Color : <?php echo $product->productColor; ?></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="iWantToSell" value="<?php echo $product->productId; ?>" <?php if(in_array($product->productId, $selectedStoreProducts)){ echo 'checked'; } ?>> <span style="color: #FD8205; font: normal 12px Arial">I want to sell this product</span></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </li>
                        <?php } ?>
                    </ul>
                    <div class="form-actions">
                        <button type="submit" id="btnSubmit" class="btn btn-primary <?php if(count($selectedStoreProducts) == 0){ echo 'hide'; }?>"><?php echo $this->lang->line('btnContinue'); ?></button>
                        <!--<button type="button" class="btn" onClick="javascript:history.back();"><?php echo $this->lang->line('btnCancel'); ?></button>-->
                    </div>                    
                    <?php echo form_close(); ?>
                    <?php }else{ ?>
                    <div class="alert alert-error">
                            <h4 class="alert-heading">Oops!!!</h4>
                            No record found.
                    </div>
                    <?php } ?>
                    </fieldset>
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- content ends -->
