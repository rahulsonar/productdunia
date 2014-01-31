<!-- content starts -->
<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/static_content/addFAQ') ?>"><i class="icon-plus"></i> Add FAQ </a>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
			<div><?php echo $this->session->flashdata('Msg'); ?></div>
			<?php  if(count($faqList) > 0){ ?>
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
						<th>Question</th>
						<th>Answer</th>
						<th>Status</th>
						<th width="20%">Actions</th>
					</tr>
				</thead>   
				<tbody>
					<?php foreach ($faqList as $faqs => $faq) { ?>
					<tr>
						<td><?php echo $faq->faq_ques; ?></td>
						<td><?php echo word_limiter($faq->faq_ans, 30);?></td>
						<td class="center">
							<a href="javascript:void(0)" onClick="xajax_toggleFAQStatus('<?php echo $faq->faq_id; ?>','<?php echo $faq->status; ?>');" title="Click to toggle status"><span class="label <?php if($faq->status=='Active'){?>label-success<?php } ?>"><?php echo $faq->status?></span></a>
						</td>
						<td class="right">
							<a class="btn btn-info" href="<?php echo site_url($this->config->item('controlPanel') . '/static_content/faqEdit/'.$faq->faq_id);?>">
								<i class="icon-edit icon-white"></i> <?php echo $this->lang->line('btnEdit'); ?>                                            
							</a>
							<a class="btn btn-danger" href="<?php echo site_url($this->config->item('controlPanel') . '/static_content/faqDelete/'.$faq->faq_id);?>">
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