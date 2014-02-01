<script type="text/javascript">
$(document).ready(function(){
	//datatable
	$('.datatable-product').dataTable({
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"aaSorting": [[ 0, "desc" ]],
			"oLanguage": {
			"sLengthMenu": "_MENU_ records per page"
			}
		} );	
});

</script>
<!-- content starts -->
<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/addProduct') ?>"><i class="icon-plus"></i> Add Product </a>
<a class="btn btn-large btn-setting" href="javascript:void(0);"><i class="icon-upload"></i> Upload Excel </a>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
			<div><?php echo $this->session->flashdata('Msg'); ?></div>
			<?php  if(count($productList) > 0){ ?>
			<table class="table table-striped table-bordered bootstrap-datatable datatable-product">
				<thead>
					<tr>
                                                <th>Pid</th>
                                                <th>Image</th>
						<th>Product Name</th>
                                                <th>Product MRP</th>
						<th>Product SKU</th>
                                                <th>Product Model</th>
                                                <th>Home</th>
						<th>Status</th>
						<th width="20%">Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php foreach ($productList as $products => $product) { ?>
					<tr>
                                            <td><?php echo $product->productId; ?></td>    
                                            <td width="5%">
						<?php if($product->productImg!=''){?>
                                                    <a href="<?php echo base_url().$this->config->item('productImgPath') . $product->productImg?>" class="cboxElement" target="_blank" title="<?php echo $product->productName; ?>">
                                                    <img alt="product" src="<?php echo base_url().$this->config->item('productThumbImgPath') . $product->productImg?>" title="<?php echo $product->productName; ?>" width="50px" height="50px">
                                                    </a>
						<?php }?>
                                                </td>
                                                
						<td><?php echo $product->productName; ?></td>
                                                <td><?php echo $product->productMRP; ?></td>
						<td><?php echo $product->productSKU; ?></td>						
						<td><?php echo $product->productModel; ?></td>
                                                <td>
							<a href="javascript:void(0)" onClick="xajax_toggleHomePublish('<?php echo $product->productId; ?>','<?php echo $product->isHome; ?>');" title="Click to toggle publish"><span class="icon32 <?php if($product->isHome=='1'){?>icon-blue icon-star-on<?php }else{ ?>icon-star-off<?php } ?>"/></span></a>
						</td>
						<td class="center">
							<a href="javascript:void(0)" onClick="xajax_toggleProductStatus('<?php echo $product->productId; ?>','<?php echo $product->status; ?>');" title="Click to toggle status"><span class="label <?php if($product->status=='Active'){?>label-success<?php } ?>"><?php echo $product->status?></span></a>
						</td>
						<td class="right">
							<a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/productEdit/'.$product->productId);?>" title="Click to edit">
								<i class="icon-edit icon-white"></i> <?php //echo $this->lang->line('btnEdit'); ?>                                            
							</a>
							<a class="btn btn-danger" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/deleteProduct/'.$product->productId);?>" title="Click to delete">
								<i class="icon-trash icon-white"></i> <?php //echo $this->lang->line('btnDelete'); ?>
							</a>
                                                        <a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/productMetadata/'.$product->productId);?>" title="Meta data">
								<i class="icon-flag icon-white"></i> <?php //echo $this->lang->line('btnDelete'); ?>
							</a>
							<a class="btn btn-inverse" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/photoGallery/'.$product->productId);?>" title="Photo Gallery">
								<i class="icon-camera icon-white"></i> <?php //echo $this->lang->line('btnGallery'); ?>
							</a>
                                                        <a class="btn btn-success" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/productSpecificationListShow/'.$product->productId);?>" title="Product Specification">
								<i class="icon-briefcase icon-white"></i> <?php //echo $this->lang->line('btnGallery'); ?>
							</a>
                                                        <a class="btn btn-warning" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/productFilterAssociate/'.$product->productId);?>" title="Product Filter">
								<i class="icon-filter icon-white"></i> <?php //echo $this->lang->line('btnGallery'); ?>
							</a>
                                                        <a class="btn btn-warning" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/productReviewsListShow/'.$product->productId);?>" title="Product Filter">
								<i class="icon-pencil icon-white"></i> <?php //echo $this->lang->line('btnGallery'); ?>
							</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table> 
			<?php }else{ ?>
			<div class="alert alert-error">
				<h4 class="alert-heading">Oops!!!</h4>
				No record found.
			</div>
			<?php } ?>            
		</div>					
	</div><!--/span-->
</div><!--/row-->	
<!-- content ends -->
<script type="text/javascript">
    ;(function($) { 
        $(document).ready(function() {
            $("#frmUploadXls").validate({
                rules: {
                    excelFile: {
                        required: true
                    }
                },errorElement: "div",
                messages: {
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function(){
                    document.frmUploadXls.action = "<?php echo site_url($this->config->item('controlPanel') . '/catalog/uploadProdMasterXLS');?>";
                    document.frmUploadXls.submit();                    
                }
		
            });	
        })
    })(jQuery); 
</script>
<!-- Upload XLS Form Start -->
    <form id="frmUploadXls" class="form-horizontal" enctype="multipart/form-data" name="frmUploadXls" accept-charset="utf-8" method="post">
    <div class="modal hide fade" id="myModal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3><?php echo $this->lang->line('uploadProdMasterExcel'); ?></h3>
        </div>
        <div class="modal-body">
            <div class="box-content">

                <fieldset>
                    <table width="100%" cellspacing="5" cellpadding="5">
                        <tr>
                            <td width="30%"><?php echo $this->lang->line('selectExcel'); ?> : </td>
                            <td>
                                <input type="file" id="excelFile" name="excelFile" class="input-file uniform_on" size="19" style="opacity: 0;">
                            </td>
                        </tr>						
                    </table>
                </fieldset>			
            </div>	
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal"><?php echo $this->lang->line('btnClose'); ?></a>
            <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('btnUpload'); ?></button>
        </div>	
    </div>
</form>
<!-- Upload XLS Form End -->