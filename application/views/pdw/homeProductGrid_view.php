<?php 
$iteration = 1;
foreach ($prods as $proKey => $product) { ?>
    <li <?php if(count($prods) == $iteration) { echo 'class="last"'; } ?>>
        <!--<a href="#" class="btntopcomman btngreen">Hot</a>-->
        <span class="imgbox"><a href="<?php echo site_url('product/detail/'.$product['productId'].'/'.url_title($product['productName']))?>"  title="<?php echo $product['productName']; ?>" alt="<?php echo $product['productName']; ?>">
            <img src="<?php echo base_url().$this->config->item('productThumbImgPath') . $product['productImg']?>" alt="<?php echo $product['productName']?>" title="<?php echo $product['productName']?>" alt="<?php echo $product['productName']?>" />
            </a></span>
        <span class="title"><a href="#" title="<?php echo $product['productName']; ?>" alt="<?php echo $product['productName']; ?>"><?php echo truncate(strtolower($product['productName']),22); ?> <br /> <?php if($product['productColor']!="") { echo '('.$product['productColor'].')'; } ?></a></span>   
        <span class="productstarholder">
            <div id="productId-<?php echo $product['productId'];?>"></div>
        </span> 
        <?php if(isset($storeProdStats[$product['productId']]['storeCnt'])) { ?>
            <span class="avil">Available in <?php echo $storeProdStats[$product['productId']]['storeCnt']; ?> stores</span>
        <?php }else{ ?>
            <span class="avil">&nbsp;</span>
        <?php } ?>
            
        <?php if(isset($storeProdStats[$product['productId']])) { ?>
            <?php if(round($storeProdStats[$product['productId']]['min_sellPrice']) != round($storeProdStats[$product['productId']]['max_sellPrice'])){ ?>
                <span class="price">Rs. <?php echo round($storeProdStats[$product['productId']]['min_sellPrice']); ?> - Rs <?php echo round($storeProdStats[$product['productId']]['max_sellPrice']); ?></span>
            <?php }else{ ?>
                <span class="price">Rs. <?php echo round($storeProdStats[$product['productId']]['max_sellPrice']); ?></span>
            <?php } ?>
        <?php }else{ ?>
            <span class="price">Rs. <?php echo round($product['productMRP']); ?></span>
        <?php } ?>
    </li>
    <script type="text/javascript">
    ;(function($) { 
        $(document).ready(function() {
            //star rating
            $('#productId-<?php echo $product['productId'];?>').raty({
                    score: <?php echo $product['rating'];?>,
                    readOnly: true,
                    starOn: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-on.png',
                    starOff: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-off.png',
                    starHalf: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-half.png'
            });
        })
    })(jQuery);
    </script>
<?php 
$iteration++;
} ?>