<!-- content starts -->
<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/addBrand') ?>"><i class="icon-plus"></i> Add Brand </a>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
			<div><?php echo $this->session->flashdata('Msg'); ?></div>
			<?php  if(count($brandsList) > 0){ ?>
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
                                                <th>Brand Id</th>
                                                <th>Brand Logo</th>
                                                <th>Brand Name</th>
                                                <th>Published</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php foreach ($brandsList as $brands => $brand) { ?>
					<tr>
                                            <td><?php echo $brand->brandId; ?></td>
                                            <td>
                                                <?php if($brand->brandImg!=''){?>
                                                <img alt="brandImg" src="<?php echo base_url() . $this->config->item('brandImgPath') . $brand->brandImg?>">
						<?php }?>
                                            </td>
						<td><?php echo $brand->brandName; ?></td>
                                                <td>
							<a href="javascript:void(0)" onClick="xajax_toggleBrandPublish('<?php echo $brand->brandId; ?>','<?php echo $brand->isHome; ?>');" title="Click to toggle publish"><span class="icon32 <?php if($brand->isHome=='1'){?>icon-blue icon-star-on<?php }else{ ?>icon-star-off<?php } ?>"/></span></a>
						</td>
						<td class="center">
							<a href="javascript:void(0)" onClick="xajax_toggleBrandStatus('<?php echo $brand->brandId; ?>','<?php echo $brand->status; ?>');" title="Click to toggle status"><span class="label <?php if($brand->status=='Active'){?>label-success<?php } ?>"><?php echo $brand->status?></span></a>
						</td>
						<td class="right">
							<a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/brandEdit/'.$brand->brandId);?>">
								<i class="icon-edit icon-white"></i> <?php echo $this->lang->line('btnEdit'); ?>                                            
							</a>
							<a class="btn btn-danger" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/brandDelete/'.$brand->brandId);?>">
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