<!-- content starts -->
<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/addProdReview/' . $productId) ?>"><i class="icon-plus"></i> Add Product Review </a>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
        </div>
        <div class="box-content">
            <div><?php echo $this->session->flashdata('Msg'); ?></div>			
            <?php if (count($prodReviewsList) > 0) { ?>
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Review title</th>
                            <th>Usefull</th>
                            <th>Not Usefull</th>
                            <th>Status</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php foreach ($prodReviewsList as $prodReviews => $prodReview) { ?>
                            <tr>
                                <td><?php echo ($prodReview->custName!='')?($prodReview->custName):('Guest User'); ?></td>
                                <td><?php echo $prodReview->custEmail; ?></td>
                                <td><?php echo $prodReview->reviewTitle; ?></td>
                                <td><?php echo $prodReview->usefull; ?></td>
                                <td><?php echo $prodReview->notUsefull; ?></td>
                                <td class="center">
                                   <a href="javascript:void(0)" onClick="xajax_toggleProductReviewStatus('<?php echo $productId; ?>','<?php echo $prodReview->reviewId; ?>','<?php echo $prodReview->status; ?>');" title="Click to toggle status"><span class="label <?php if($prodReview->status=='Active'){?>label-success<?php } ?>"><?php echo $prodReview->status?></span></a>
                                </td>
                                <td class="right">
                                    <a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/prodReviewEdit/' . $prodReview->productId . '/' . $prodReview->reviewId); ?>">
                                        <i class="icon-edit icon-white"></i> <?php echo $this->lang->line('btnEdit'); ?>
                                    </a>
                                    <a class="btn btn-danger" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/prodReviewDelete/' . $prodReview->productId . '/' . $prodReview->reviewId); ?>">
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