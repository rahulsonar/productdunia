<!-- left menu starts -->
<div class="span2 main-menu-span">
    <div class="well nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <li class="nav-header hidden-tablet">Main</li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/dashboard'); ?>"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
            <li class="nav-header hidden-tablet">Catalog</li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/geo'); ?>"><i class="icon-home"></i><span class="hidden-tablet"> Master Cities</span></a></li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/geo/areaListShow'); ?>"><i class="icon-home"></i><span class="hidden-tablet"> Master Areas</span></a></li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/catalog/brandListShow'); ?>"><i class="icon-home"></i><span class="hidden-tablet"> Master Brands</span></a></li>
            
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/catalog/productCategoryListShow'); ?>"><i class="icon-list"></i><span class="hidden-tablet"> Master Categories</span></a></li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/catalog/prodFilterListShow'); ?>"><i class="icon-list"></i><span class="hidden-tablet"> Master Filters</span></a></li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/catalog/productListShow'); ?>"><i class="icon-list"></i><span class="hidden-tablet"> Product List</span></a></li>
            
            
            
            <li class="nav-header hidden-tablet">Store</li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/store/storeListShow'); ?>"><i class="icon-user"></i><span class="hidden-tablet"> Stores </span></a></li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/store'); ?>"><i class="icon-user"></i><span class="hidden-tablet"> Store User</span></a></li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/store/storeProfiles'); ?>"><i class="icon-briefcase"></i><span class="hidden-tablet"> Store Profile</span></a></li>
            <li><a class="ajax-link" href="javascript:void(0);" id="addStoreProduct"><i class="icon-briefcase"></i><span class="hidden-tablet"> Add Store Products</span></a></li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/store/banners'); ?>"><i class="icon-briefcase"></i><span class="hidden-tablet"> Add Banners</span></a></li>
            
            <li class="nav-header hidden-tablet">System</li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/system'); ?>"><i class="icon-user"></i><span class="hidden-tablet"> System User</span></a></li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/system/systemProfiles'); ?>"><i class="icon-briefcase"></i><span class="hidden-tablet"> System Profile</span></a></li>
            
            <li class="nav-header hidden-tablet">Static content</li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/static_content/editStaticContent/about-us'); ?>"><i class="icon-text-width"></i><span class="hidden-tablet"> About Us</span></a></li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/static_content/editStaticContent/sales-purchase'); ?>"><i class="icon-text-width"></i><span class="hidden-tablet"> Sales and Purchase</span></a></li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/static_content/editStaticContent/terms-conditions'); ?>"><i class="icon-text-width"></i><span class="hidden-tablet"> Terms and conditions</span></a></li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/static_content/editStaticContent/return-policy'); ?>"><i class="icon-text-width"></i><span class="hidden-tablet"> Return Policy</span></a></li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/static_content/editStaticContent/contact-us'); ?>"><i class="icon-text-width"></i><span class="hidden-tablet"> Contact Us</span></a></li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/static_content/editStaticContent/privacy-policy'); ?>"><i class="icon-text-width"></i><span class="hidden-tablet"> Privacy Policy</span></a></li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/static_content/faq'); ?>"><i class="icon-bell"></i><span class="hidden-tablet"> FAQ</span></a></li>
                        
            <li class="nav-header hidden-tablet">Utility</li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/databasedump'); ?>"><i class="icon-leaf"></i><span class="hidden-tablet"> Database Backup</span></a></li>
            <li><a class="ajax-link" href="<?php echo site_url($this->config->item('controlPanel').'/logout'); ?>"><i class="icon-off"></i><span class="hidden-tablet"> Logout</span></a></li>
        </ul>
    </div><!--/.well -->
</div><!--/span-->
<!-- left menu ends -->

<script type="text/javascript">
    ;(function($) { 
        $(document).ready(function() {
            $("#frmSearchProducts").validate({
                rules: {
                    keyword: {
                        //required: true
                    }
                },errorElement: "div",
                messages: {
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function(){
                    document.frmSearchProducts.action = "<?php echo site_url($this->config->item('controlPanel') . '/catalog/searchStoreProducts');?>";
                    document.frmSearchProducts.submit();                    
                    //alert("Go");
                }
		
            });	
        })
    })(jQuery); 
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $('#addStoreProduct').click(function(e){
		e.preventDefault();
		$('#productModal').modal('show');
            });

        }); 
</script>
<?php
    $productCategories = $this->product_model->getProductCategoryTree();
    $brandArr = $this->common_model->getBrands(1);
?>
<!-- Upload XLS Form Start -->
    <form id="frmSearchProducts" class="form-horizontal" enctype="multipart/form-data" name="frmSearchProducts" accept-charset="utf-8" method="post">
    <div class="modal hide fade" id="productModal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3>Search products</h3>
        </div>
        <div class="modal-body">
            <div class="box-content">
                <fieldset>
                    <div class="control-group">
                            <label class="control-label" for="focusedInput">Product Name</label>
                            <div class="controls">
                                    <input type="text" id="prodName" name="prodName" class="input-large">
                            </div>
                    </div>
                    <div class="control-group">
                            <label class="control-label" for="focusedInput">Product Model</label>
                            <div class="controls">
                                    <input type="text" id="prodModel" name="prodModel" class="input-large">
                            </div>
                    </div>
                    <div class="control-group">
                            <label class="control-label" for="selectError">Category</label>
                            <div class="controls">
                                    <select id="prodCategoryId" name="prodCategoryId">
                                            <option value="0">Select Category</option>
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
                            <label class="control-label" for="selectError">Brand</label>
                            <div class="controls">
                                    <select id="prodBrand" name="prodBrand">
                                            <?php foreach ($brandArr as $brandKey => $brandVal) { ?>
                                                <option value="<?php echo $brandKey;?>"><?php echo $brandVal;?></option>
                                            <?php } ?>
                                    </select>
                            </div>
                    </div>
                </fieldset>			
            </div>	
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal"><?php echo $this->lang->line('btnClose'); ?></a>
            <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('btnContinue'); ?></button>
        </div>
    </div>
</form>
<!-- Upload XLS Form End -->