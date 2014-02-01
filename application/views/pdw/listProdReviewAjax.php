<?php foreach ($productReviews as $reviewKey => $review) { ?>
    <table class="prodsubdetails1">
        <tr>
            <td class="prodlabel">
                <strong><?php if($review['name']!=""){ echo $review['name']; }else{ echo "Guest"; }; ?></strong><br />
                <div class="reviewstarsmall">
                    <div id="reviewId-<?php echo $reviewKey;?>"></div>
                </div>
                <div class="date"><?php echo date("M d Y", strtotime($review['create_date'])); ?></div>
            </td>
            <td>
                <strong><?php echo $review['reviewTitle']; ?></strong> <br />
                <p><?php echo $review['reviewDesc']; ?></p>
            </td>
        </tr>
    </table>
    <div class="feedback">
        <span>Was the above review usefull to you</span>
        <a href="javascript:void(0);" onClick="xajax_isUsefullReview(<?php echo $review['reviewId']; ?>,'1');" class="yes">Yes</a>(<span id="yes-<?php echo $review['reviewId']; ?>"><?php echo $review['usefull']; ?></span>) / <a href="javascript:void(0);" onClick="xajax_isUsefullReview(<?php echo $review['reviewId']; ?>,'0');" class="no">No</a>(<span id="no-<?php echo $review['reviewId']; ?>"><?php echo $review['notUsefull']; ?></span>)
    </div>
    <script type="text/javascript">
    ;(function($) { 
        $(document).ready(function() {
            //star rating
            $('#reviewId-<?php echo $reviewKey;?>').raty({
                    score: <?php echo $review['rating']; ?>,
                    readOnly: true,
                    starOn: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-on.png',
                    starOff: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-off.png'
            });
        })
    })(jQuery);
    </script>
<?php } ?>