<!-- content starts -->
<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/addProdSpecification/' . $productId) ?>"><i class="icon-plus"></i> Add Product Specification </a>
<a class="btn btn-large btn-setting" href="javascript:void(0);"><i class="icon-upload"></i> Upload Excel </a>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
        </div>
        <div class="box-content">
            <div><?php echo $this->session->flashdata('Msg'); ?></div>			
            <?php if (count($prodSpecificationsList) > 0) { ?>
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Specification Group</th>
                            <th>Specification Label</th>
                            <th>Specification Value</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php foreach ($prodSpecificationsList as $prodSpecifications => $prodSpecification) { ?>
                            <tr>
                                <td><?php echo $prodSpecification->groupName; ?></td>
                                <td><?php echo $prodSpecification->specLabel; ?></td>
                                <td><?php echo $prodSpecification->specValue; ?></td>
                                <td class="right">
                                    <a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/prodSpecificationEdit/' . $prodSpecification->productId . '/' . $prodSpecification->specificationId); ?>">
                                        <i class="icon-edit icon-white"></i> <?php echo $this->lang->line('btnEdit'); ?>                                            
                                    </a>
                                    <a class="btn btn-danger" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/prodSpecificationDelete/' . $prodSpecification->productId . '/' . $prodSpecification->specificationId); ?>">
                                        <i class="icon-trash icon-white"></i> <?php echo $this->lang->line('btnDelete'); ?>
                                    </a>							
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table> 
            <?php } else { ?>
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
                    document.frmUploadXls.action = "<?php echo site_url($this->config->item('controlPanel') . '/catalog/uploadProdSpecXLS');?>";
                    document.frmUploadXls.submit();                    
                }
		
            });	
        })
    })(jQuery); 
</script>
<!-- Advance Search Form Start -->
    <form id="frmUploadXls" class="form-horizontal" enctype="multipart/form-data" name="frmUploadXls" accept-charset="utf-8" method="post">
    <input type='hidden' value="<?php echo $productId ?>" name='productId' id='productId'>
    <div class="modal hide fade" id="myModal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3><?php echo $this->lang->line('uploadProdSpecExcel'); ?></h3>
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
<!-- Advance Search Form End -->