<!-- content starts -->
<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/store/addStore') ?>"><i class="icon-plus"></i> Add Store</a>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
        </div>
        <div class="box-content">
            <div><?php echo $this->session->flashdata('Msg'); ?></div>
            <?php if (count($storesList) > 0) { ?>
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Store Name</th>
                            <th>Agency</th>
                            <th>City</th>
                            <th>Area</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php foreach ($storesList as $stores => $store) { ?>
                            <tr>
                                <td><?php echo $store->storeName; ?></td>
                                <td><?php echo $store->agencyName; ?></td>
                                <td><?php echo $store->cityName; ?></td>
                                <td><?php echo $store->areaName; ?></td>
                                <td class="center">
                                    <a href="javascript:void(0)" onClick="xajax_toggleStoreStatus('<?php echo $store->storeId; ?>','<?php echo $store->status; ?>');"><span class="label <?php if ($store->status == 'Active') { ?>label-success<?php } ?>"><?php echo $store->status ?></span></a>
                                </td>
                                <td class="center">
                                    <a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/store/storeEdit/' . $store->storeId); ?>">
                                        <i class="icon-edit icon-white"></i> Edit                                            
                                    </a>
                                    <a class="btn btn-danger" href="<?php echo site_url($this->config->item('controlPanel') . '/store/storeDelete/' . $store->storeId); ?>">
                                        <i class="icon-trash icon-white"></i> Delete
                                    </a>
                                    <!--<a class="btn btn-success" href="<?php echo site_url($this->config->item('controlPanel') . '/store/systemUserProfile/' . $store->storeId); ?>">
                                            <i class="icon-star-empty icon-white"></i> Profile
                                    </a>-->
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>  
            <?php } else { ?>
                <div class="alert alert-error">
                    <h4 class="alert-heading">Oops!!!</h4>
                    No record found.
                </div>
            <?php } ?>            
        </div>					
    </div><!--/span-->
</div><!--/row-->	
<!-- content ends -->