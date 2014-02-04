<?php 
if(count($products) > 0){ ?>
    <?php foreach ($products as $proKey => $product) { ?>
<div class="productlisting">
    <div class="prodlistimg">
        <span class="imgbox">
            <a href="<?php echo site_url('product/detail/'.$product['productId'].'/'.url_title($product['productName']))?>"  title="<?php echo $product['productName']; ?>" alt="<?php echo $product['productName']; ?>"><img src="<?php echo base_url().$this->config->item('productThumbImgPath') . $product['productImg']?>" alt="<?php echo $product['productName']?>" title="<?php echo $product['productName']?>" alt="<?php echo $product['productName']?>" /></a>
        </span>
        <span class="title"><a href="javascript:void(0)" onClick="xajax_removeFromWishlist('<?php echo $product['productId'];?>');">Remove From Wishlist</a></span>
    </div>
    <div class="prodlistdis">
        <div class="srow row">
            <h2><a href="#" title="<?php echo $product['productName']; ?>" alt="<?php echo $product['productName']; ?>"><?php echo truncate(strtolower($product['productName']),22); ?> <?php if($product['productColor'] != "") { echo '('.$product['productColor'].')'; }else{ echo '&nbsp;'; } ?></a></h2>
            <p class="locationbor"><span class="locationbox">Viman Nagar ( 2 Km )</span>
                <span class="starholder">
                    <div id="productId-<?php echo $product['productId'];?>"></div>
                </span>
            </p>
            <span class="title"><a href="#">*Offer Available in 5 Stores</a></span>
        </div>
        <div class="frrow row">
            <?php if(isset($product['storeProdStats'])) { ?>
                <?php if(round($product['storeProdStats']['min_sellPrice']) != round($product['storeProdStats']['max_sellPrice'])){ ?>
                    <span class="inrbox">Rs. <?php echo round($product['storeProdStats']['min_sellPrice']); ?> - Rs <?php echo round($product['storeProdStats']['max_sellPrice']); ?></span>
                <?php }else{ ?>
                    <span class="inrbox">Rs. <?php echo round($product['storeProdStats']['max_sellPrice']); ?></span>
                <?php } ?>
            <?php }else{ ?>
                <span class="inrbox">Rs. <?php echo round($product['productMRP']); ?></span>
            <?php } ?>            
            <div class="space10"></div>            
            <?php if(isset($product['storeProdStats']['storeCnt'])) { ?>
                <span class="inrbox">Available in <?php echo $product['storeProdStats']['storeCnt']; ?> stores</span>
            <?php } ?>
            <div class="space10"></div>
            <a href="#" class="btncomman rounded btnshadow">Search & BUY</a>
        </div>
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