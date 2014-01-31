<?php 
if(count($products) > 0){ ?>
    <?php foreach ($products as $proKey => $product) { ?>
    <li>
        <span class="imgbox"><a href="<?php echo site_url('product/detail/'.$product['productId'].'/'.url_title($product['productName']))?>"  title="<?php echo $product['productName']; ?>" alt="<?php echo $product['productName']; ?>"><img src="<?php echo base_url().$this->config->item('productThumbImgPath') . $product['productImg']?>" alt="<?php echo $product['productName']?>" title="<?php echo $product['productName']?>" alt="<?php echo $product['productName']?>" /></a></span>
        <span class="title"><a href="#" title="<?php echo $product['productName']; ?>" alt="<?php echo $product['productName']; ?>"><?php echo truncate(strtolower($product['productName']),22); ?> <br> <?php if($product['productColor'] != "") { echo '('.$product['productColor'].')'; }else{ echo '&nbsp;'; } ?></a></span>
        <span class="productstarholder">
            <div id="productId-<?php echo $product['productId'];?>"></div>
        </span>
        <?php if(isset($product['storeProdStats']['storeCnt'])) { ?>
            <span class="avil">Available in <?php echo $product['storeProdStats']['storeCnt']; ?> stores</span>
        <?php }else{ ?>
            <span class="avil">&nbsp;</span>
        <?php } ?>
        
        <?php if(isset($product['storeProdStats'])) { ?>
            <?php if(round($product['storeProdStats']['min_sellPrice']) != round($product['storeProdStats']['max_sellPrice'])){ ?>
                <span class="price">Rs. <?php echo round($product['storeProdStats']['min_sellPrice']); ?> - Rs <?php echo round($product['storeProdStats']['max_sellPrice']); ?></span>
            <?php }else{ ?>
                <span class="price">Rs. <?php echo round($product['storeProdStats']['max_sellPrice']); ?></span>
            <?php } ?>
        <?php }else{ ?>
            <span class="price">Rs. <?php echo round($product['productMRP']); ?></span>
        <?php } ?>
    </li>    
    <?php } ?>
<?php }else{ ?>
<!--<div>
    <div id="singin">
            <center>Sorry, No matching records found.</center>
    </div>
</div>-->
<?php } ?>