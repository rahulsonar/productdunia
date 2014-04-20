<div id="storeList">
<div class="space10"></div>
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
			
		</div>
<?php foreach ($availableAtStores as $storeId => $storeArr) { ?>
		<div class="proddbox">
			<div class="proddboxcollitems">
			<div class="frow row">
			<?php if(!empty($storeArr['storeLogo'])) { ?>
                 <img src="<?php echo base_url().$this->config->item('storeLogoPath').$storeArr['storeLogo']; ?>" alt="<?php echo $storeArr['storeName']; ?>"  />
                <?php } else { echo "&nbsp;"; } ?>
				</div>
                            <div class="srow row">
				<h2><?php echo $storeArr['storeName']; ?></h2>
				<p class="locationbor"><span class="locationbox"><?php echo $storeArr['areaName']; ?> ( 2 Km ) </span>
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

			</div>
			<div class="frrow row">
			
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
					<a href="<?php echo $targetBox; ?>" id="bargainBtn_<?php echo $storeId; ?>" class="btncomman rounded btnshadow bargain_req inline">BARGAIN</a>
					<ul class="listorange">
					<li><a href="#">12 Store Reviews</a></li>
					<?php if($storeArr['offerPrice']>0) { ?>
                        <li><a href="#">Offer available</a></li>
						<?php } ?>
                                        </ul>
                        </div>
			</div>

			<a href="javascript:void(0)" class="prodsubarrowd"></a>
			<a href="javascript:void(0)" class="prodsubarrow"></a>
			
			<div class="pdetailsexpand">
				<div class="srow row">
				
				<table class="addresstab">
				<?php if(!empty($storeArr['address'])) {?>
					<tr>
						<td class="adddefault">
						
							<p><strong>Address:</strong> <br />
							
							<?php echo $storeArr['address']; ?> - <?php echo $storeArr['pincode']; ?>
							
							
							</p>
						</td>
					</tr>
					<?php } ?>
					<?php if(!empty($storeArr['contactPerson'])) {?>
					<tr>
						<td>
							<p><strong>Contact Person:</strong> <br />
							<?php echo $storeArr['contactPerson']; ?></p>
						</td>
					</tr>
					<?php } ?>
					<?php if(!empty($storeArr['mobile']) || !empty($storeArr['phone'])) { ?>
					<tr>
						<td>
							<p><strong>Contact Number:</strong> <br />
							<?php echo $storeArr['mobile']; ?><br /> <?php echo $storeArr['phone']; ?></p>
						</td>
					</tr>
					<?php } ?>
					<?php if(!empty($storeArr['storeTimings'])) {?>
					<tr>
						<td>
							<p><strong>Store Timings:</strong> <br />
							<?php echo $storeArr['storeTimings']; ?></p>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td class="emailsmsbox">
							<a href="#" class="sendsms">Send on SMS</a>
							<a href="#" class="sendsms1">Send on Email</a>
						</td>
					</tr>
				</table>
				
			</div>
			<table class="storereviewtable">
				<tr>
					<td></td>
					<td>
					<table class="storebox">
						
						<tr>
							<td>
								<div class="giftbox">
								<?php if($storeArr['offerPrice']>0) { ?>
								<a href="#">
									<span><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/cgift.png" alt="" /></span>
									Offer <br /> Available
								</a>
								<?php } ?>
								<?php if($storeArr['isParking']>0) { ?>
								<a href="#">
									<span><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/ccar.png" alt="" /></span>
									Parking <br /> Available
								</a>
								<?php } ?>
								<?php
								$paymentMethods=explode(",",$storeArr['paymentMethods']); 
								if(in_array('card',$paymentMethods)) { ?>
								<a href="#">
									<span><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/ccard.png" alt="" /></span>
									Credit/Debit <br /> Card Accepted
								</a>
								<?php } ?>
								<?php if(in_array('cash',$paymentMethods)) { ?>
								<a href="#">
									<span><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/crup.png" alt="" /></span>
									Cash <br /> Accepted
								</a>
								<?php } ?>
								</div>
							</td>
						</tr>
					</table>
						
					</td>
				</tr>
				<tr>
					<td colspan="2">
                                            <div class="space50"></div>
                                            <span class="left"><h2>Store Review</h2></span>	
                                                <span class="right"><a href="#" class="showalllink ">Show All Review</a></span>
                                          
						<div class="space10"></div>
                                                <p><strong>Amit Jain:</strong> <span id="review_line">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</span></p>	
						<a href="javascript:click()" id='fullreview' class="reviewlink">Read Full Review</a>	
						<!--<a href="#" class="showalllink">Show All Review</a>-->			
					</td>
				</tr>
			</table>
			
		
			</div>
			
			</div>
<?php } ?>

	</div>
	
	<a name="#anchor2"></a>

        <div class="inrbox loadmorestore">
            Show more store
        </div>

</div>
