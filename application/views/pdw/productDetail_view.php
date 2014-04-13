<div class="mapview shadow">

<iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Pune,+Maharashtra&amp;aq=0&amp;oq=pune&amp;sll=18.815426,76.775144&amp;sspn=14.17265,24.98291&amp;ie=UTF8&amp;hq=&amp;hnear=Pune,+Maharashtra&amp;t=m&amp;z=11&amp;ll=18.52043,73.856744&amp;output=embed"></iframe>
<div class="mapslide"></div>
</div>
<!-- Main -->  
<div id="main">
    <div class="mainholder">
        <div class="space10"></div>
        <?php $this->load->view($this->config->item('themeCode') . "/breadcrumbs_view"); ?>
        <div class="proddetailsleft">
            <div class="prodimg">
                <a href="<?php echo base_url().$this->config->item('productImgPath') . $product['productImg']?>" class="jqzoom" rel='gal1'  title="<?php echo $product['productName']?>" >
                    <img src="<?php echo base_url().$this->config->item('productLargeImgPath') . $product['productImg']?>" alt="<?php echo $product['productName']?>" title="<?php echo $product['productName']?>"/>    
                </a>
            </div>
            <div class="proddbox imgthum">
            <?php if(count($prodGallery) > 0) { ?>
            
            <ul id="thumblist" class="clearfix" >
                <?php foreach ($prodGallery as $galleryKey => $galleryVal) { ?>
                    <li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo base_url().$this->config->item('productLargeImgPath') . $galleryVal['imgName']?>',largeimage: '<?php echo base_url().$this->config->item('productImgPath') . $galleryVal['imgName']?>'}"><img src='<?php echo base_url().$this->config->item('productStampImgPath') . $galleryVal['imgName']?>'></a></li>
                <?php } ?>
            </ul>
            <?php } ?>
            </div>
        </div>

        <div class="proddetailsright">
            <div class="prodheadholder">
                <h1><?php echo $product['productName']; ?> <?php if($product['productColor']!=''){ echo '('.$product['productColor'].')';} ?></h1>
                <div class="ratingbox">
                    <div class="prodRaty"></div>
                    <a href="#pdreview">Rate This Product</a>
                </div>
            </div>
            <?php if($product['productDesc']!=''){ ?>
                <p><?php echo $product['productDesc']; ?></p>
            <?php } ?>
            <?php if($product['productFeatures']!=''){ 
                $productFeatures = explode('||', $product['productFeatures']);
            ?>    
            <div class="space20"></div>
            <h2>KEY FEATURES:</h2>
            <ul class="keylist">
                <?php foreach ($productFeatures as $featureKey => $featureVal) { ?>
                    <li><?php echo $featureVal; ?></li>
                <?php } ?>
            </ul>
            <?php } ?>
            <div class="space20"></div>
            <table class="prdotab">
                <tr>
                    <?php if(isset($storeProdStats[$product['productId']]['storeCnt'])) { ?>
                    <td class="avilbox1">
                        <p>Available in:</p>
                        <p class="bigt"><?php echo $storeProdStats[$product['productId']]['storeCnt']; ?> STORES</p>
                    </td>
                    <?php } ?>
                    <td class="avilbox1">
                        <p>Price :</p>
                        <?php if(isset($storeProdStats[$product['productId']])) { ?>
                            <?php if(round($storeProdStats[$product['productId']]['min_sellPrice']) != round($storeProdStats[$product['productId']]['max_sellPrice'])){ ?>
                                <p class="bigt">Rs. <?php echo round($storeProdStats[$product['productId']]['min_sellPrice']); ?> - Rs <?php echo round($storeProdStats[$product['productId']]['max_sellPrice']); ?></p>
                            <?php }else{ ?>
                                <p class="bigt">Rs. <?php echo round($storeProdStats[$product['productId']]['max_sellPrice']); ?></p>
                            <?php } ?>
                        <?php }else{ ?>
                            <p class="bigt">Rs. <?php echo round($product['productMRP']); ?></p>
                        <?php } ?>                        
                    </td>
                    <td class="avilbox3">
                       
                        <label ><input type="checkbox" id="compare"/><span id="compare_label">Add to Product Compare</span></label>
                        <?php if ($this->session->userdata('interfaceUsername') != '') { ?>
                        <label><input type="checkbox" onClick="xajax_toggleToWishlist('<?php echo $product['productId']; ?>');" <?php if($isInWishlist){ ?>checked <?php } ?>/>Add to Wishlist</label>
                        <label><input type="checkbox" />Add to Product Pinger</label>
                        <?php } ?>
                    </td>
                </tr>
            </table>
            <!--<p class="offer">*Offer available in 5 stores</p>-->
            <div class="space20"></div>
            <div id="pdtabs">
                <a href="#pdavil"></a>
                <a href="#pdspication"></a>
                <a href="#pdreview"></a>
            </div>

        </div>
        <div class="space10"></div>
        <?php 
            if(count($availableAtStores) > 0){
                $temp['availableAtStores'] = $availableAtStores;
                $temp['availableAtStoresTotal'] = $availableAtStoresTotal;
                $temp['showloadMore'] = true;
                $this->load->view($this->config->item('themeCode') . "/availableAtStores_view",$temp); 
            }
        ?>
        <?php 
        if(count($productSpecification) > 0){
            $temp['productSpecification'] = $productSpecification;
            $this->load->view($this->config->item('themeCode') . "/productSpecification_view",$temp); 
        } ?>
        
        <?php 
            $temp['productId'] = $product['productId'];
            $temp['productReviews'] = $productReviews;
            $this->load->view($this->config->item('themeCode') . "/productReviews_view", $temp); 
        ?>
        
        <div class="subheadingholder">
            <h2>PRODUCT RECOMMENDED FOR YOU</h2>
        </div>
        <div class="prodsubbox prodsubboxbor"> 
            <ul class="list prodlist">
                <li>
                    <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/thumb1.jpg" alt="" /></a></span>
                    <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                    <span class="avil">Available in 34 stores</span>
                    <span class="price">Rs. 4567- Rs 6789</span>
                    <span class="compare"><label> <input type="checkbox"  /> Add to COMPARE </label></span>
                </li>
                <li>
                    <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/thumb2.jpg" alt="" /></a></span>
                    <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                    <span class="avil">Available in 34 stores</span>
                    <span class="price">Rs. 4567- Rs 6789</span>
                    <span class="compare"><label> <input type="checkbox"  /> Add to COMPARE </label></span>
                </li>
                <li>
                    <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/thumb3.jpg" alt="" /></a></span>
                    <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                    <span class="avil">Available in 34 stores</span>
                    <span class="price">Rs. 4567- Rs 6789</span>
                    <span class="compare"><label> <input type="checkbox"  /> Add to COMPARE </label></span>
                </li>
                <li>
                    <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/thumb4.jpg" alt="" /></a></span>
                    <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                    <span class="avil">Available in 34 stores</span>
                    <span class="price">Rs. 4567- Rs 6789</span>
                    <span class="compare"><label> <input type="checkbox"  /> Add to COMPARE </label></span>
                </li>
                <li class="last">
                    <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/thumb5.jpg" alt="" /></a></span>
                    <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                    <span class="avil">Available in 34 stores</span>
                    <span class="price">Rs. 4567- Rs 6789</span>
                    <span class="compare"><label> <input type="checkbox"  /> Add to COMPARE </label></span>
                </li>
            </ul>
        </div>
        <div class="space20"></div>
        <?php $this->load->view($this->config->item('themeCode') . "/bottom_section_view"); ?>
    </div>
</div>
<!--<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/js/jquery.elevateZoom-3.0.8.min.js" ></script>-->
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/js/jquery.jqzoom-core.js" ></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/css/jquery.jqzoom.css"/>

<style type="text/css">
.clearfix:after{clear:both;content:".";display:block;font-size:0;height:0;line-height:0;visibility:hidden;}
.clearfix{display:block;zoom:1}


ul#thumblist li a.zoomThumbActive{
    border:1px solid red;
}

.jqzoom{
	text-decoration:none;
	float:left;
}

</style>

<script type="text/javascript">

        
    $(document).ready(function () {
        
        $('.prodRaty').raty({
                score: <?php echo $prodRating; ?>,
                readOnly: true,
                starOn: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-on.png',
                starOff: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-off.png',
                starHalf: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-half.png'
        });
            
        /*$("#leftaccordion h3.sorttitle").click(function () {
            $(this).next(".sortbox").toggle();
            $(this).addClass("sorttitlehide");
        });*/

        $("a.prodsubarrow").click(function () {
            $(this).addClass("prodsubarrowd");
            $(this).parent().parent().addClass("proddboxheight");
        });
	
        $("a.prodsubarrowd").click(function () {
            $(this).addClass("prodsubarrow");
            $(this).parent().parent().removeClass("proddboxheight");
        });
        
        //$("#zoom_01").elevateZoom({gallery:'gallery_01'}); 
        
        /*$('.jqzoom').jqzoom({
            zoomType: 'standard',
            lens:false,
            title:false,
            preloadImages: false,
            alwaysOn:false,
            zoomWidth: 350,
            zoomHeight: 340,
            xOffset:70,
            yOffset:0,
            position:'left'
        });*/
   
    });
</script>
<script>
$(function(){
		$("#bargainBoxProdImg").attr('src','<?php echo base_url().$this->config->item('productLargeImgPath') . $product['productImg']?>');
	
});
</script>