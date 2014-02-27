<!-- content starts -->
	<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/store/bannerAdd') ?>"><i class="icon-plus"></i> Add New Banner</a>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
                        <div><?php echo $this->session->flashdata('Msg'); ?></div>
			<?php  if(count($bannersList) > 0){ ?>
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Position</th>
								  <th>Image</th>
								  <th>URL</th>
                                                              				  
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
							<?php foreach ($bannersList as $id => $banner) { ?>
							<tr>
								<td><?php echo $banner->position; ?></td>
								<td>
								<?php
								if(!is_dir(FCPATH.$this->config->item('bannerUploadPath') ."/". $banner->image) && file_exists(FCPATH.$this->config->item('bannerUploadPath') ."/". $banner->image)) {?>
								<a href="#" onclick="window.open('<?php echo base_url() . $this->config->item('bannerUploadPath') ."/". $banner->image; ?>','BannerImg'); return false;">
                                    <img alt="BannerImg" width="50" src="<?php echo base_url() . $this->config->item('bannerUploadPath') ."/". $banner->image; ?>">
                                </a>
                                <?php } ?>
                                </td>
								<td><?php echo $banner->url; ?></td>
                                                         
								
								<td class="center">
									<a href="javascript:void(0)" onClick="xajax_toggle_statusBanner('<?php echo $banner->id; ?>','<?php echo $banner->status; ?>');"><span class="label <?php if($banner->status=='Active'){?>label-success<?php } ?>"><?php echo $banner->status?></span></a>
								</td>
								<td class="center">
									<a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/store/bannerEdit/'.$banner->id);?>">
										<i class="icon-edit icon-white"></i> Edit                                            
									</a>
									<a class="btn btn-danger" href="<?php echo site_url($this->config->item('controlPanel') . '/store/bannerDelete/'.$banner->id);?>">
										<i class="icon-trash icon-white"></i> Delete
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