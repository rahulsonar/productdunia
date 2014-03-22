<?php 
//var_dump($products);
if(count($products) > 0){ ?>
    <?php foreach ($products as $proKey => $product) { ?>
	
<div class="productlisting" id="productlisting1">
     <a href="#javascript:void(0)" class="btntopcomman removewishlist" id="removewishlist1" title="Remove From Save Searches" onClick="xajax_removeFromSavedSearch('<?php echo $product['productId'];?>'); return false;">
         Remove From Saved Search
     </a>
    <div class="prodlistimg">
        <span class="imgbox">
		
            <a href="<?php echo site_url('product/detail/'.$product['productId'].'/'.url_title($product['productName']))?>"  title="<?php echo $product['productName']; ?>" alt="<?php echo $product['productName']; ?>"><img src="<?php echo base_url().$this->config->item('productThumbImgPath') . $product['productImg']?>" alt="<?php echo $product['productName']?>" title="<?php echo $product['productName']?>" alt="<?php echo $product['productName']?>" /></a>
        </span>
        <!--<span class="title"><a href="javascript:void(0)" onClick="xajax_removeFromWishlist('<?php echo $product['productId'];?>');">Remove From Wishlist</a></span>-->
    </div>
    <div class="prodlistdis">
        <div class="srow row">
            <h2><a href="#" title="<?php echo $product['productName']; ?>" alt="<?php echo $product['productName']; ?>"><?php echo truncate(strtolower($product['productName']),22); ?> <?php if($product['productColor'] != "") { echo '('.$product['productColor'].')'; }else{ echo '&nbsp;'; } ?></a></h2>
            <p class="locationbor">
                <span class="locationbox">Viman Nagar ( 2 Km )</span>
                <span class="starholder">
                    <div id="productId-<?php echo $product['productId'];?>"></div>
                </span>
            </p>
            <span class="title"><a href="#">*Offer Available in 5 Stores</a></span>
        </div>
        <div class="space20"></div>
        <div class="space15"></div>
        <table class="prdotab prdotabwish">
			<tr>
				<td class="avilbox1">
                                    <?php if(isset($product['storeProdStats']['storeCnt'])) { ?>
					<p>Available in:</p>
					<p class="bigt"><?php echo $product['storeProdStats']['storeCnt']; ?> STORES</p>
                                         <a href="#"><p class="offer">*Offer available in 5 stores</p></a>
                                       <?php } ?>
				</td>
				<td class="avilbox1">
					<p>Price Range:</p>
                                         <?php if(isset($product['storeProdStats'])) { ?>
                                                <?php if(round($product['storeProdStats']['min_sellPrice']) != round($product['storeProdStats']['max_sellPrice'])){ ?>
                                                    <p class="bigt">INR <?php echo round($product['storeProdStats']['min_sellPrice']); ?> - INR <?php echo round($product['storeProdStats']['max_sellPrice']); ?></p>
                                                <?php }else{ ?>
                                                    <p class="bigt">INR <?php echo round($product['storeProdStats']['max_sellPrice']); ?></p>
                                                <?php } ?>
                                            <?php }else{ ?>
                                               <p class="bigt">INR <?php echo round($product['productMRP']); ?></p>
                                            <?php } ?>
				</td>
                            <td>
                                <div class="space20"></div>
                                <div class="space10"></div>
                                <span class="right">
                                        <a href="#" class="btncomman rounded btnshadow">Search & BUY</a>
                                </span>
                            </td>
			</tr>
                            </table>
    </div>
</div>
<?php } ?>
<?php }else{ ?>
<!--<div>
    <div id="singin">
            <center>Sorry, No matching records found.</center>
    </div>
</div>-->
<?php } ?>