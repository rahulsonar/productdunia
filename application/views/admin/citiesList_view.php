<!-- content starts -->
<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/geo/addCity') ?>"><i class="icon-plus"></i> Add City </a>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
			<div><?php echo $this->session->flashdata('Msg'); ?></div>
			<?php  if(count($citiesList) > 0){ ?>
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
						<th>City Name</th>
						<th>Country Name</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php foreach ($citiesList as $cities => $city) { ?>
					<tr>
						<td><?php echo $city->cityName; ?></td>
						<td><?php echo $city->countryName; ?></td>
                                                <td><?php echo $city->latitude; ?></td>
                                                <td><?php echo $city->longitude; ?></td>
						<td class="center">
							<a href="javascript:void(0)" onClick="xajax_toggleCityStatus('<?php echo $city->cityId; ?>','<?php echo $city->status; ?>');" title="Click to toggle status"><span class="label <?php if($city->status=='Active'){?>label-success<?php } ?>"><?php echo $city->status?></span></a>
						</td>
						<td class="right">
							<a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/geo/cityEdit/'.$city->cityId);?>">
								<i class="icon-edit icon-white"></i> <?php echo $this->lang->line('btnEdit'); ?>                                            
							</a>
							<a class="btn btn-danger" href="<?php echo site_url($this->config->item('controlPanel') . '/geo/cityDelete/'.$city->cityId);?>">
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