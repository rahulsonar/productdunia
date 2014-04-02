<?php
//print_debug($availableAtStores, __FILE__, __LINE__, 0);
?>
<div id="storeList">
<div id="pdavil" class="subheadingholder">
    <h2>AVAILABLE AT STORES (<?php echo count($availableAtStores); ?>):</h2>
	<?php
	$availableAtStoresIds=array();
	foreach($availableAtStores as $store) {
		$availableAtStoresIds[]=$store['storeId'];
	}
	?>
    <span class="right"> 
        <a href="#" class="savepdf" onclick="SavePDF(<?php echo $product['productId']; ?>); return false;">Save PDF</a>
        <a href="#" class="savesearch" onclick="xajax_savesearch('<?php echo $product['productName']; ?>',<?php echo $product['productId']; ?>,<?php echo implode(',',$availableAtStoresIds); ?>); return false;">Save Search</a>
    </span>
</div>
<div class="prodsubbox">
    <div class="shortholder">
        <div class="showing">
            Showing: 
            <select>
                <option>1</option>
                <option>2</option>
            </select>
            per page
        </div>
        <div class="sortright">
            Sort By: 
            <select name="sortStores" id="sortStores" onchange="javascript:sortAreas();">
                <option <?php if(!empty($sorting['availability'])) { ?>selected="selected" <?php } ?> value="availability~availability">Availability</option>
				<option <?php if(!empty($sorting['price']) && $sorting['price']=='asc') { ?>selected="selected" <?php } ?> value="price~asc">Price Low-High</option>
				<option <?php if(!empty($sorting['price']) && $sorting['price']=='desc') { ?>selected="selected" <?php } ?> value="price~desc">Price High-Low</option>
            </select>
        </div>
        <div class="sortright">
            Filter Area: 
			<?php
			$areaNames=$this->common_model->getSelectedAreaNames2($this->session->userdata('areasSelected'));
			?>
            <select id="areaFilter" name="areaFilter" onchange="javascript:sortAreas();">
                <option value="all">All Areas</option>
				<?php
				foreach($areaNames as $areaId=>$aName) { ?>
				<option <?php if($filters['areaId']==$areaId) { ?>selected="selected" <?php } ?> value="<?php echo $areaId; ?>"><?php echo $aName; ?></option>
				<?php }
				?>
            </select>
        </div>
       <!-- <div class="sortright">
            Sort By: 
            <select>
                <option>Price Low-High</option>
            </select>
        </div>-->
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
                            <label>
                                    <span class="left check">
                                        <input type="checkbox" id="sto_compare"/>
                                    </span>
                                    <span class="left lab" id="sto_compare_label">
                                        Add To Store Compare
                                    </span>
                                </label>

                </div>
                <div class="trow row">
                    <span class="inrbox">
                        INR <?php echo $storeArr['sellPrice']; ?>
                    </span>
                    <div class="space10"></div>

                </div>
                <div class="trow row">
                    <ul class="listorange">
						<?php if($storeArr['offerPrice']>0) { ?>
                        <li><a href="#">Offer available</a></li>
						<?php } ?>
                        <li><a href="#">Last <?php echo $storeArr['qty']; ?> piece<?php if($storeArr['qty']>1) { echo 's'; } ?> left</a></li>
                    </ul>
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
                            <?php if ($this->session->userdata('interfaceUsername') == '') {
                            	$buyNowfunc="shortLogin('buyNow','".$storeId."');";
                            	$targetBox='#shotlogin';
                            } 
                            else {
								$buyNowfunc='buyNow('.$storeId.');';
								$targetBox='#bargainreq';
							}
							?>
                                <a href="<?php echo $targetBox; ?>" id="buyNow_<?php echo $storeId; ?>" class="btncomman rounded btnshadow">BUY NOW</a>
								<a href="<?php echo $targetBox; ?>" class="btncomman rounded btnshadow bargainBtn">BARGAIN</a>
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
	<?php if($showloadMore) { ?>
	<div id='loadMoreItems'>
                <a href="javascript:void(0);" class="loadmore loadMoreItems">Load More Stores</a>
            </div>
		<?php } ?>
</div>
<div class="space15"></div>
<script>
	function SavePDF(product_id) {
		window.open('<?php echo site_url('product/pdf/'); ?>/'+product_id);
	}
	function sortAreas(){
		var filterVal=$("#areaFilter").val();
		var sortVal=$("#sortStores").val();
        xajax_loadmorestores(<?php echo $product['productId']; ?>,<?php echo $availableAtStoresTotal; ?>,filterVal,sortVal);
    }
	 
	$(function(){
	
	$('.loadMoreItems').click(function(){
		xajax_loadmorestores(<?php echo $product['productId']; ?>,<?php echo $availableAtStoresTotal; ?>);
	});
	});
	
</script>
</div>