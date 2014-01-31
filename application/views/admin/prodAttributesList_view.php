<!-- content starts -->
<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/addProdAttribute') ?>"><i class="icon-plus"></i> Add Product Attribute </a>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
			<div><?php echo $this->session->flashdata('Msg'); ?></div>			
			<?php  if(count($prodAttributesList) > 0){ ?>
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
						<th>Attribute Type</th>
                                                <th>Attribute Value</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php foreach ($prodAttributesList as $prodAttributes => $prodAttribute) { ?>
					<tr>
						<td><?php echo $prodAttribute->attributeType; ?></td>
                                                <td><?php echo $prodAttribute->attributeValue; ?></td>
						<td class="center">
							<a href="javascript:void(0)" onClick="xajax_toggleProdAttributeStatus('<?php echo $prodAttribute->attributeId; ?>','<?php echo $prodAttribute->status; ?>');" title="Click to toggle status"><span class="label <?php if($prodAttribute->status=='Active'){?>label-success<?php } ?>"><?php echo $prodAttribute->status?></span></a>
						</td>
						<td class="right">
							<a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/prodAttributeEdit/'.$prodAttribute->attributeId);?>">
								<i class="icon-edit icon-white"></i> <?php echo $this->lang->line('btnEdit'); ?>                                            
							</a>
							<a class="btn btn-danger" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/prodAttributeDelete/'.$prodAttribute->attributeId);?>">
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