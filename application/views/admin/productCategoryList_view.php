<!-- content starts -->
<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/addProductCategory') ?>"><i class="icon-plus"></i> Add Category </a>
<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/manageProductCategories') ?>"><i class="icon-retweet"></i> Manage </a>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
			<div><?php echo $this->session->flashdata('Msg'); ?></div>			
			<?php  if(count($productCategories) > 0){ ?>
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
                                                <th width="10%">Category Id</th>
						<th>Category Name</th>
						<th>Parent Category</th>
						<th>Status</th>
						<th width="25%">Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php foreach ($productCategories as $proCat => $category) { ?>
					<tr>
						<td><?php echo $category->categoryId; ?></td>
                                                <td><?php echo $category->categoryName; ?></td>
						<td><?php echo $category->parentCatName; ?></td>
						<td class="center">
							<a href="javascript:void(0)" onClick="xajax_toggleProductCategoryStatus('<?php echo $category->categoryId; ?>','<?php echo $category->status; ?>');"><span class="label <?php if($category->status=='Active'){?>label-success<?php } ?>"><?php echo $category->status?></span></a>
						</td>
						<td class="right">
							<a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/productCategoryEdit/'.$category->categoryId);?>">
								<i class="icon-edit icon-white"></i> Edit                                            
							</a>
							<a class="btn btn-danger" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/productCategoryDelete/'.$category->categoryId);?>">
								<i class="icon-trash icon-white"></i> Delete
							</a>
                                                        <!--<a class="btn btn-success" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/productCategoryDelete/'.$category->categoryId);?>">
								<i class="icon-cog icon-white"></i> Filters
							</a>-->
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