<script type="text/javascript">
    ;(function($) { 
        $(document).ready(function() {
            $("#frmPersonalInfo").validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    mobile: {
                        required: true,
                        minlength: 10,
                        maxlength: 10
                    }		},errorElement: "div",
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function(){
                    xajax_personalInfoSubmit(xajax.getFormValues('frmPersonalInfo'));
                }
            });	
        })
    })(jQuery); 
</script>
<div id="main">
    <div class="mainholder">
        <div class="add">
            <ul>
                <li> <img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/add1.jpg" alt="" /></li>
            </ul>
        </div>
        <!-- Left Warp -->  
        <?php $this->load->view($this->config->item('themeCode') . "/account_left_section_view", $data); ?>

        <!-- Right Warp -->  
        <div class="rightwarp">
            <?php $this->load->view($this->config->item('themeCode') . "/breadcrumbs_view"); ?>
            <div class="subheadingholder">
                <h2>Saved Search</h2>
            </div>
            <div class="prodsubbox"> 
                <?php $this->load->view($this->config->item('themeCode') . "/SavedsearchGrid_view",$products); ?>
            </div>
            <!--<div class="paginate">
                <ul>
                    <li class="next"><a href="#">Next</a></li>
                    <li><a class="active" href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li class="prev"><a href="#">Prev</a></li>
                </ul>
            </div>-->
            <div class="space15"></div>
        </div>
    </div>
</div>

<script type="text/javascript">    
    function callRating(){        
        <?php foreach ($products as $proKey => $product) { ?>
                $('#productId-<?php echo $product['productId'];?>').raty({
                        score: <?php echo $product['rating'];?>,
                        readOnly: true,
                        starOn: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-on.png',
                        starOff: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-off.png',
                        starHalf: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-half.png'
                });
        <?php } ?>        
    }
    
    ;(function($) {
        $(document).ready(function() {
            callRating();
        })
    })(jQuery);
</script>