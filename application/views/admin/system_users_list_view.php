<!-- content starts -->
	<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/system/systemUserSignup') ?>"><i class="icon-plus"></i> Add System User</a>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
			<div id="errorMsg"></div>			
			<?php  if(count($systemUserslist) > 0){ ?>
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>First Name</th>
								  <th>Last Name</th>
								  <th>Username</th>
								  <th>Email</th>								  
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?php foreach ($systemUserslist as $sysUsers => $user) { ?>
							<tr>
								<td><?php echo $user->first_name; ?></td>
								<td><?php echo $user->last_name?></td>
								<td><?php echo $user->username?></td>
								<td><?php echo $user->email?></td>
								<td class="center">
									<a href="javascript:void(0)" onClick="xajax_toggle_status('<?php echo $user->id; ?>','<?php echo $user->status; ?>');"><span class="label <?php if($user->status=='Active'){?>label-success<?php } ?>"><?php echo $user->status?></span></a>
								</td>
								<td class="center">
									<a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/system/systemUserEdit/'.$user->id);?>">
										<i class="icon-edit icon-white"></i> Edit                                            
									</a>
									<a class="btn btn-danger" href="<?php echo site_url($this->config->item('controlPanel') . '/system/systemUserDelete/'.$user->id);?>">
										<i class="icon-trash icon-white"></i> Delete
									</a>
									<a class="btn btn-success" href="<?php echo site_url($this->config->item('controlPanel') . '/system/systemUserProfile/'.$user->id);?>">
										<i class="icon-star-empty icon-white"></i> Profile
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