
<div id="pdreview" class="subheadingholder">
    <h2>PRODUCT REVIEWS <?php if($reviewCnt > 0) { ?> (<?php echo $reviewCnt; ?>) <?php } ?>:</h2>
</div>
<div class="prodsubbox"> 
    <form name="frmProdReview" id="frmProdReview">
    <input type='hidden' value="<?php echo $productId; ?>" name='productId' id='productId'>
    <h2 class="seftitlesmall" id="reviewTlt">How do you rate this product ?</h2>
    <div id="reviewMsg">
        <?php if($this->session->userdata('interfaceEmail')==''){ ?>
<!--        <div class="reviewfrmholder">
            <label>Email</label>
            <input type="text" name='custEmail' id='custEmail' value="" />
        </div>-->
        <?php }else{ ?>
<!--        <div class="reviewfrmholder">
            <label>Email</label>
            <input type="text" name='custEmail' id='custEmail' value="<?php echo $this->session->userdata('interfaceEmail'); ?>" readonly/>
        </div>            -->
        <?php } ?>
        <div class="reviewfrmholder">
            <label>Review Title</label>
            <input type="text" name='prodReviewTitle' id='prodReviewTitle' />
        </div>
        <div class="reviewfrmholder">
            <label>Review Description</label>
            <textarea id='prodReviewDesc' name='prodReviewDesc'></textarea>
        </div>
        <div class="ratingholder">
            <label>Click On the Stars</label>
            <div class="reviewstarholder left">
                <div class="raty"></div>
            </div>
            <div class="right">
                <input type="submit" class="btncomman rounded" value="Submit"></div>
        </div>
     </div>

    </form>
    <div class="space10"></div>
    <?php if(count($productReviews) > 0){?>
        <h2 class="seftitlesmall">How do other rate this product...</h2>
        <div class="usefullholder">
            <a href="javascript:void('0');" onClick="xajax_sortReviews('usefull')" id="usefull" class='active'>Most usefull First</a> | <a href="javascript:void('0');" onClick="xajax_sortReviews('create_date')" id="create_date">Newest First</a>
        </div>
        <div id='reviewList'>
        <?php
        $tempReview['productReviews'] = $productReviews;
        $this->load->view($this->config->item('themeCode')."/listProdReviewAjax",$tempReview);
        ?>
        </div>        
    <?php } ?>
</div>
<div class="paginate" id="reviewPaginate"><?php echo $reviewPaginate; ?></div>
<div class="space15"></div>

<script type="text/javascript">
;(function($) { 
	$(document).ready(function() {
            //star rating
            $('.raty').raty({
                    score: 1,
                    starOn: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-big-on.png',
                    starOff: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-big-off.png'
            });
            
            $('#custEmail').watermark("Please enter your email.");
            $('#prodReviewTitle').watermark("Please enter at least 10 characters.");
            $('#prodReviewDesc').watermark("Please enter at least 100 characters.");
            
	    $("#frmProdReview").validate({
                ignore: ":hidden:not(input)",
		rules: {
			custEmail: {
				required: true,
                                email: true
			},prodReviewTitle: {
				required: true,
                                minlength: 10
			},
                        prodReviewDesc: {
				required: true,
                                
                                maxlength: 2000
			},
                        score: {
				required: true
			}
		},errorElement: "div",
                messages: {
                    score: 'Click on the stars for rating.'
                },
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
                    xajax_addProductReview(xajax.getFormValues('frmProdReview'));
		}
            });
	})
})(jQuery);
</script>
