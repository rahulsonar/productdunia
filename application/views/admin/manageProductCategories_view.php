<!-- content starts -->
<a class="btn btn-large" href="<?php echo site_url($this->config->item('controlPanel') . '/catalog/productCategoryListShow') ?>"><i class="icon-chevron-left"></i> Back</a>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-list-alt"></i> <?php echo $page_title; ?></h2>
		</div>
		<div class="box-content">
			<div id="errorMsg"></div>
			<?php  if(count($productCategories) > 0){ ?>
			<form class="form-horizontal">
			<section id="demo">
			<ol class="sortable ui-sortable">
				<?php foreach ($productCategories as $firstLevelKey => $firstLevelVal) { ?>
				<?php $firstLevelClass = (count($firstLevelVal['submenus']) > 0)?('mjs-nestedSortable-branch mjs-nestedSortable-collapsed'):('mjs-nestedSortable-leaf');?> 
				<li class="<?php echo $firstLevelClass;?>" id="list_<?php echo $firstLevelVal['categoryId'];?>"><div><span class="disclose"><span></span></span><?php echo $firstLevelVal['name'];?></div>
					<?php if(count($firstLevelVal['submenus']) > 0){?>
					<ol>
						<?php foreach ($firstLevelVal['submenus'] as $secondLevelKey => $secondLevelVal) { ?>
						<?php $secondLevelClass = (count($secondLevelVal['submenus']) > 0)?('mjs-nestedSortable-branch mjs-nestedSortable-collapsed'):('mjs-nestedSortable-leaf');?> 
						<li class="<?php echo $secondLevelClass;?>" id="list_<?php echo $secondLevelVal['categoryId'];?>"><div><span class="disclose"><span></span></span><?php echo $secondLevelVal['name'];?></div>
							<?php if(count($secondLevelVal['submenus']) > 0){?>
							<ol>
								<?php foreach ($secondLevelVal['submenus'] as $thirdLevelKey => $thirdLevelVal) { ?>
								<?php $thirdLevelClass = (count($thirdLevelVal['submenus']) > 0)?('mjs-nestedSortable-branch mjs-nestedSortable-collapsed'):('mjs-nestedSortable-leaf');?> 
								<li class="<?php echo $thirdLevelClass;?>" id="list_<?php echo $thirdLevelVal['categoryId'];?>"><div><span class="disclose"><span></span></span><?php echo $thirdLevelVal['name'];?></div>
								</li>
								<?php } ?>
							</ol>
							<?php } ?>
						</li>
						<?php } ?>
					</ol>
					<?php } ?>
				</li>
				<?php } ?>
			</ol>
			</section> 
			<!-- END #demo -->
			<div class="form-actions">
			<input name="saveOrder" id="saveOrder" value="Save Order" type="button" class="btn btn-primary">
			</div>
			</form>
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
<!-- Nested Sortable Start-->
<link href='<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/nestedSortable/css/ui.nestedSortable.css' rel='stylesheet'>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/nestedSortable/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/nestedSortable/jquery-ui-1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/nestedSortable/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/nestedSortable/jquery_002.js"></script>
<!-- Nested Sortable  ENDS-->

<script>
;(function($) {
	$(document).ready(function(){

		$('ol.sortable').nestedSortable({
			forcePlaceholderSize: true,
			handle: 'div',
			helper:	'clone',
			items: 'li',
			opacity: .6,
			placeholder: 'placeholder',
			revert: 250,
			tabSize: 25,
			tolerance: 'pointer',
			toleranceElement: '> div',
			maxLevels: 3,
			isTree: true,
			expandOnHover: 700,
			startCollapsed: true,
		});

		$('.disclose').on('click', function() {
			$(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
		})
	})
})(jQuery);
</script>
<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$('#saveOrder').click(function(e){
        list = $('ol.sortable').nestedSortable('toHierarchy', {startDepthCount: 0});
        xajax_manageProductCategoriesSubmit(list);
	});	
})
})(jQuery); 
</script>

