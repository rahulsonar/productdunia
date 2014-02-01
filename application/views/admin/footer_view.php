</div><!--/fluid-row-->
	<hr>
	<footer>
		<p class="pull-left">&copy; <?php echo $this->config->item("controlPanelCopyright"); ?></p>
		<p class="pull-right"></p>
	</footer>
	</div><!--/.fluid-container-->
	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<!-- <script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.cookie.js"></script> -->
	<!-- calander plugin -->
	<script src='<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.dataTables.min.js'></script>
	
	<!-- chart libraries start -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/excanvas.js"></script>
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.flot.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.flot.pie.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.flot.stack.js"></script>
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->
	
	<!-- select or dropdown enhancer -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/js/charisma.js"></script>
	
	
	<!-- Dashboard Charts -->
	<script type="text/javascript">
	if($("#order-status").length)
	{
		$.plot($("#order-status"), dataOrderStatus,
		{
			series: {
					pie: {
							show: true
					}
			},
			grid: {
					hoverable: true,
					clickable: true
			},
			legend: {
				show: false
			}
		});
		
		function pieHover(event, pos, obj)
		{
			if (!obj)
					return;
			percent = parseFloat(obj.series.percent).toFixed(2);
			$("#hover").html('<span style="font-weight: bold; color: '+obj.series.color+'">'+obj.series.label+' ('+percent+'%)</span>');
		}
		$("#order-status").bind("plothover", pieHover);
	}

	if($("#payment-status").length)
	{
		$.plot($("#payment-status"), paymentStatusChart,
		{
			series: {
					pie: {
							show: true
					}
			},
			grid: {
					hoverable: true,
					clickable: true
			},
			legend: {
				show: false
			}
		});
		
		function pieHover(event, pos, obj)
		{
			if (!obj)
					return;
			percent = parseFloat(obj.series.percent).toFixed(2);
			$("#hover").html('<span style="font-weight: bold; color: '+obj.series.color+'">'+obj.series.label+' ('+percent+'%)</span>');
		}
		$("#payment-status").bind("plothover", pieHover);
	}

	if($("#orderTypeStatus").length)
	{
		$.plot($("#orderTypeStatus"), orderTypeStatusChart,
		{
			series: {
					pie: {
							show: true
					}
			},
			grid: {
					hoverable: true,
					clickable: true
			},
			legend: {
				show: false
			}
		});
		
		function pieHover(event, pos, obj)
		{
			if (!obj)
					return;
			percent = parseFloat(obj.series.percent).toFixed(2);
			$("#hover").html('<span style="font-weight: bold; color: '+obj.series.color+'">'+obj.series.label+' ('+percent+'%)</span>');
		}
		$("#orderTypeStatus").bind("plothover", pieHover);
	}
        
</script>
	<!-- Chart End -->