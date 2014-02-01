<!-- content starts -->
<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/geo/addArea') ?>"><i class="icon-plus"></i> Add Area </a>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
			<div><?php echo $this->session->flashdata('Msg'); ?></div>
			<?php  if(count($areasList) > 0){ ?>
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
						<th>Area Name</th>
						<th>City Name</th>                                                
                                                <!--<th>Sub-area Includes</th>-->
                                                <th>Latitude</th>
                                                <th>Longitude</th>
                                                <th>Major</th>
						<th>Status</th>
						<th width="25%">Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php foreach ($areasList as $areas => $area) { ?>
					<tr>
						<td><?php echo $area->areaName; ?></td>
						<td><?php echo $area->cityName; ?></td>
                                                <!--<td><a data-content="<?php echo $area->areaIncludes; ?>" data-rel="popover" class="btn-info" href="#" data-original-title="Sub-area included"><span class="label label-info">Sub-areas</span></a></td>-->
                                                <td><?php echo $area->latitude; ?></td>
                                                <td><?php echo $area->longitude; ?></td>
                                                <td>
							<a href="javascript:void(0)" onClick="xajax_toggleAreaMajor('<?php echo $area->areaId; ?>','<?php echo $area->isMajor; ?>');" title="Click to toggle major"><span class="icon32 <?php if($area->isMajor=='1'){?>icon-blue icon-star-on<?php }else{ ?>icon-star-off<?php } ?>"/></span></a>
						</td>
						<td class="center">
							<a href="javascript:void(0)" onClick="xajax_toggleAreaStatus('<?php echo $area->areaId; ?>','<?php echo $area->status; ?>');" title="Click to toggle status"><span class="label <?php if($area->status=='Active'){?>label-success<?php } ?>"><?php echo $area->status?></span></a>
						</td>                                                
						<td class="right">
							<a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/geo/areaEdit/'.$area->areaId);?>">
								<i class="icon-edit icon-white"></i> <?php echo $this->lang->line('btnEdit'); ?>                                            
							</a>
							<a class="btn btn-danger" href="<?php echo site_url($this->config->item('controlPanel') . '/geo/areaDelete/'.$area->areaId);?>">
								<i class="icon-trash icon-white"></i> <?php echo $this->lang->line('btnDelete'); ?>
							</a>
                                                        <?php if($area->isMajor==1){ ?>
                                                        <a class="btn btn-warning" href="<?php echo site_url($this->config->item('controlPanel') . '/geo/subAreaAssociation/'.$area->areaId);?>">
								<i class="icon-random icon-white"></i> <?php echo $this->lang->line('Subarea'); ?>
							</a>
                                                        <?php }else{ ?>
                                                        <a class="btn btn-warning disabled" href="javascript:void(0);">
								<i class="icon-random icon-white"></i> <?php echo $this->lang->line('Subarea'); ?>
							</a>
                                                        <?php } ?>
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