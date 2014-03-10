<script type="text/javascript">
//Home Banner
$(function(){
  $('#homeslides').slides({
	  preload: true,
	  effect: 'slide',
	  generateNextPrev: false,
	  pagination: true,
	  generatePagination: true
  });
});
</script>

<script type="text/javascript">
;(function($) { 
	$(document).ready(function() {
	    $('#newsEmail').watermark("Enter Email Address.");
	    $("#newsletter").validate({
		rules: {
			newsEmail: {
				required: true,
				email: true
			}
		},errorElement: "div",
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			var email_address = $('#newsEmail').val();
			var newsletter = 1;
			$.ajax({
				type: "POST",
				url: '<?php echo site_url("customer/subscribe"); ?>',
				data: "email_address="+email_address+"&newsletter="+newsletter,
				success: function(result)
				{	
					alert(result);
				}
			}); 			
		}
		
	});
	})
})(jQuery);

function showConfirmShortLogin() {
	 $.colorbox({inline:true, href:'#verification'});
}
function setBuyNowId(storeId) {
	$("#BuyNowStoreId").val(storeId);
}
</script>
<input type="hidden" name="BuyNowStoreId" id="BuyNowStoreId" value="" />
</script>

<!-- JS Start -->
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/js/jquery.watermark.min.js" ></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/js/jquery.validate.js" ></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/js/jquery.raty.min.js"></script>
<!-- JS Ends -->
<!-- Google plus script starts here -->