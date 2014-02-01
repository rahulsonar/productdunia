<!-- content starts -->
	<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/databasedump/db_backup') ?>"><i class="icon-download-alt"></i> Click to backup</a>
	<div class="row-fluid sortable">		
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
			<?php  if(count($map) > 0){ ?>
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th>Filename</th>
							<th>Delete</th>
							<th>Download</th>
						</tr>
					</thead>   
					<tbody>
						<?php for($i=0;$i < count($map); $i++) { ?>
						<tr>
							<td><h5><?php echo $map[$i] ?></h5></td>
							<td><a href="<?php echo site_url($this->config->item('controlPanel') . '/databasedump/dump_delete/'.$map[$i]) ?>"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel'); ?>/img/delete_icon.png" width="50" height="50" alt="Delete"  title="Click to Delete"/></a></td>
							<td><a href="<?php echo site_url($this->config->item('controlPanel') . '/databasedump/dump_download/'.$map[$i]) ?>"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel'); ?>/img/zip_download.gif" width="50" height="50" alt="Download" title="Click to Download"/></a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php }else{ ?>
				<div class="alert alert-error">
					<h4 class="alert-heading">Oops!!!</h4>
					Database backup not generated. Please click the above button to generate backup.
				</div>
			  <?php } ?>            
			</div>					
		</div><!--/span-->
	</div><!--/row-->	
<!-- content ends -->