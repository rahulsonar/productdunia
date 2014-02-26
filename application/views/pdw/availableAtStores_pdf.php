<?php
//print_debug($availableAtStores, __FILE__, __LINE__, 0);
?>
<div id="pdavil" class="subheadingholder prodheadingholder">
    <h2>AVAILABLE AT STORES (<?php echo count($availableAtStores); ?>):</h2>
	<?php
	$availableAtStoresIds=array();
	foreach($availableAtStores as $store) {
		$availableAtStoresIds[]=$store['storeId'];
	}
	?>
    
</div>
<div class="prodsubbox">
    <div class="shortholder">
        
    </div>

    <?php foreach ($availableAtStores as $storeId => $storeArr) { ?>
        <div class="proddbox">
            <div class="proddboxcollitems">
                <div class="frow row">
                    <img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/prodthumb2.jpg" alt=""  />
                </div>
                <div class="srow row">
                    <h2><?php echo $storeArr['storeName']; ?></h2>
                    <p class="locationbor"><span class="locationbox"><?php echo $storeArr['areaName']; ?> ( 2 Km )</span>
                        <span class="starholder">
                            <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" alt=""></a>
                            <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" alt=""></a>
                            <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" alt=""></a>
                            <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" alt=""></a>
                            <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" alt=""></a>
                        </span>
                    </p>


                </div>
                <div class="trow row">
                    <ul class="listorange">
						<?php if($storeArr['offerPrice']>0) { ?>
                        <li><a href="#">Offer available</a></li>
						<?php } ?>
                        <li><a href="#">Last <?php echo $storeArr['qty']; ?> piece<?php if($storeArr['qty']>1) { echo 's'; } ?> left</a></li>
                    </ul>
                </div>
                <div class="frrow row">
                    <span class="inrbox">
                        INR <?php echo $storeArr['sellPrice']; ?>
                    </span>
                    <div class="space10"></div>

                </div>
            </div>

            <a href="javascript:void(0)" class="prodsubarrowd"></a>
            <a href="javascript:void(0)" class="prodsubarrow"></a>

            <div class="pdetailsexpand">
                <div class="srow row">

                    <table class="addresstab">
                        <tr>
                            <td class="adddefault">
                                <p><strong>Address:</strong> <br />
                                    2/102, Floor 2 <br />
                                    Inorbit Mall, Nagar Road <br />
                                    Viman Nagar, Pune- 411010
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><strong>Contact Number:</strong> <br />
                                    Mr. K.P. Roy </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><strong>Contact Person:</strong> <br />
                                    +91 12345 2345 <br /> 022 12345788</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><strong>Store Timings:</strong> <br />
                                    9:00 AM to 6:00 PM<br /> Monday - Saturday</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="emailsmsbox">
                                <a href="#" class="sendsms">Send on SMS</a>
                                <a href="#" class="sendsms1">Send on Email</a>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="trow row">
                    <ul class="listorange">
                        <li><a href="#">12 Store Reviews</a></li>
                    </ul>
                </div>
                <div class="frrow row">

                    <div class="space10"></div>
                    <table class="storebox">
                        <tr>
                            <td>
                                <a href="#" class="btncomman rounded btnshadow">BUY NOW</a> <a href="#" class="btncomman rounded btnshadow">BARGAIN</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="storeboxtd">
                                <label><input type="checkbox" /> Add to STORE COMPARE</label> 
                                <label><input type="checkbox" /> Add to STORE COMPARE</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="giftbox">
                                    <a href="#">
                                        <span><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/cgift.png" alt="" /></span>
                                        Offer <br /> Available
                                    </a>
                                    <a href="#">
                                        <span><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/ccar.png" alt="" /></span>
                                        Parking <br /> Available
                                    </a>
                                    <a href="#">
                                        <span><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/ccard.png" alt="" /></span>
                                        Credit/Debit <br /> Card Accepted
                                    </a>
                                    <a href="#">
                                        <span><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/crup.png" alt="" /></span>
                                        Cash <br /> Accepted
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    <?php } ?>
</div>
<div class="space15"></div>
<script>
	function SavePDF(product_id) {
		window.open('<?php echo site_url('product/pdf/'); ?>/'+product_id);
	}
</script>