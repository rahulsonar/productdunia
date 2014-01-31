<!-- content starts -->
	<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/store/addStoreProfile') ?>"><i class="icon-plus"></i> Add Profile</a>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
			<div><?php echo $this->session->flashdata('Msg'); ?></div>			
			<?php  if(count($storeProfilelist) > 0){ ?>
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Profile Name</th>
                                                                  <th>Agency</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?php foreach ($storeProfilelist as $storeProfile => $profile) { ?>
							<tr>
								<td><?php echo $profile->profile_name; ?></td>
                                                                <td><?php echo $profile->agencyName; ?></td>
								<td class="center">
									<a href="javascript:void(0)" onClick="xajax_toggleStoreProfileStatus('<?php echo $profile->profile_id; ?>','<?php echo $profile->status; ?>');"><span class="label <?php if($profile->status=='Active'){?>label-success<?php } ?>"><?php echo $profile->status?></span></a>
								</td>
								<td class="right">
									<a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/store/storeProfileEdit/'.$profile->profile_id);?>">
										<i class="icon-edit icon-white"></i> Edit                                            
									</a>
                                                                        <a class="btn btn-danger" href="<?php echo site_url($this->config->item('controlPanel') . '/store/storeProfileDelete/'.$profile->profile_id);?>">
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