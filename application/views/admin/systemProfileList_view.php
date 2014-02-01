<!-- content starts -->
	<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/system/addSystemProfile') ?>"><i class="icon-plus"></i> Add Profile</a>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
			<div id="errorMsg"></div>			
			<?php  if(count($systemProfilelist) > 0){ ?>
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th width="30%">Profile Name</th>
								  <th width="20%">Status</th>
								  <th width="50%">Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?php foreach ($systemProfilelist as $sysProfile => $profile) { ?>
							<tr>
								<td><?php echo $profile->profile_name; ?></td>
								<td class="center">
									<a href="javascript:void(0)" onClick="xajax_toggleProfileStatus('<?php echo $profile->profile_id; ?>','<?php echo $profile->status; ?>');"><span class="label <?php if($profile->status=='Active'){?>label-success<?php } ?>"><?php echo $profile->status?></span></a>
								</td>
								<td class="right">
									<a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/system/systemProfileEdit/'.$profile->profile_id);?>">
										<i class="icon-edit icon-white"></i> Edit                                            
									</a>
									<?php if(($profile->profile_id==$this->config->item('adminProfileId')) OR ($profile->profile_id==$this->config->item('storeOwnerProfileId'))){?>
									<a class="btn btn-danger disabled" href="javascript:void(0);">
										<i class="icon-trash icon-white"></i> Delete
									</a>
									<?php }else{?>
                                                                        <a class="btn btn-danger" href="<?php echo site_url($this->config->item('controlPanel') . '/system/systemProfileDelete/'.$profile->profile_id);?>">
										<i class="icon-trash icon-white"></i> Delete
									</a>                                                                    
									<?php }?>
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