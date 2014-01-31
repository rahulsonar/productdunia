<!-- content starts -->
<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/addProdFilter') ?>"><i class="icon-plus"></i> Add Product Filter </a>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
			<div><?php echo $this->session->flashdata('Msg'); ?></div>			
			<?php  if(count($prodFiltersList) > 0){ ?>
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
                                                <th>Category</th>
						<th>Filter Type</th>
                                                <th>Filter Value</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php foreach ($prodFiltersList as $prodFilters => $prodFilter) { ?>
					<tr>
                                                <td><?php echo $prodFilter->categoryName; ?></td>	
                                                <td><?php echo $prodFilter->filterType; ?></td>
                                                <td><?php echo $prodFilter->filterValue; ?></td>
						<td class="center">
							<a href="javascript:void(0)" onClick="xajax_toggleProdFilterStatus('<?php echo $prodFilter->filterId; ?>','<?php echo $prodFilter->status; ?>');" title="Click to toggle status"><span class="label <?php if($prodFilter->status=='Active'){?>label-success<?php } ?>"><?php echo $prodFilter->status?></span></a>
						</td>
						<td class="right">
							<a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/prodFilterEdit/'.$prodFilter->filterId);?>">
								<i class="icon-edit icon-white"></i> <?php echo $this->lang->line('btnEdit'); ?>                                            
							</a>
							<a class="btn btn-danger" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/prodFilterDelete/'.$prodFilter->filterId);?>">
								<i class="icon-trash icon-white"></i> <?php echo $this->lang->line('btnDelete'); ?>
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