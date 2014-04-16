<?php
$recentlyViewedProds = $this->common_model->getRecentViewProducts();
?>
<div class="leftnarrow">
            <div id="mostview" class="tabbed-box">
                <ul class="tabs">
                    <li><a href="#mostview1">Recently Viewed</a></li>
                    <!--<li><a href="#mostview2">Saved<br /> Searches</a></li>
                    <li class="last"><a href="#mostview3">My <br />Wishlist</a></li>-->
                </ul>
                <div id="mostview1" class="tabbed-content">
                    <div class="gray-skin scroll">                        
                        <?php if(count($recentlyViewedProds) > 0){ ?>
                        <ul class="tablist">                            
                            <?php foreach ($recentlyViewedProds as $recentProdKey => $recentlyViewedProds) { ?>
                            <li>
                                <span class="imgbox"><a href="<?php echo site_url('product/detail/'.$recentlyViewedProds['productId'].'/'.url_title($recentlyViewedProds['productName']))?>"  title="<?php echo $recentlyViewedProds['productName']; ?>"><img src="<?php echo base_url().$this->config->item('productStampImgPath') . $recentlyViewedProds['productImg']?>" title="<?php echo $recentlyViewedProds['productName']?>" alt="<?php echo $recentlyViewedProds['productName']?>"/></a></span>
                                <span class="namebox">
                                    <span class="title">
                                        <a href="<?php echo site_url('product/detail/'.$recentlyViewedProds['productId'].'/'.url_title($recentlyViewedProds['productName']))?>" title="<?php echo $recentlyViewedProds['productName']; ?>" alt="<?php echo $recentlyViewedProds['productName']; ?>"><?php echo truncate(strtolower($recentlyViewedProds['productName']),22); ?> <br> <?php if($recentlyViewedProds['productColor'] != "") { echo '('.$recentlyViewedProds['productColor'].')'; }else{ echo '&nbsp;'; } ?></a>
                                    </span>   
                                    <?php if(isset($recentlyViewedProds['storeProdStats']['storeCnt'])) { ?>
                                        <span class="avil">Available in <?php echo $recentlyViewedProds['storeProdStats']['storeCnt']; ?> stores</span>
                                    <?php }else{ ?>
                                        <span class="avil">&nbsp;</span>
                                    <?php } ?>
                                </span>
                                <?php if(isset($recentlyViewedProds['storeProdStats'])) { ?>
                                    <?php if(round($recentlyViewedProds['storeProdStats']['min_sellPrice']) != round($recentlyViewedProds['storeProdStats']['max_sellPrice'])){ ?>
                                        <span class="price">Rs. <?php echo round($recentlyViewedProds['storeProdStats']['min_sellPrice']); ?> - Rs <?php echo round($recentlyViewedProds['storeProdStats']['max_sellPrice']); ?></span>
                                    <?php }else{ ?>
                                        <span class="price">Rs. <?php echo round($recentlyViewedProds['storeProdStats']['max_sellPrice']); ?></span>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <span class="price">Rs. <?php echo round($recentlyViewedProds['productMRP']); ?></span>
                                <?php } ?>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php }else{ ?>
                        <p>No any product viewed yet.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

<div class="rightwide">
            <div class="subheadingholder">
                <h2>PRODUCTS ON SALE</h2>
                <a href="#">View All <span>&raquo;</span></a>
            </div>
            <div class="space15"></div> 
            <ul class="list prodlist">
                <li>
                    <a href="#" class="btntopcomman btnred">SALE</a>
                    <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/product1.jpg" alt="" /></a></span>
                    <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                    <span class="avil">Available in 34 stores</span>
                    <span class="price">Rs. 4567- Rs 6789</span>
                </li>
                <li>
                    <a href="#" class="btntopcomman btnred">SALE</a>
                    <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/book-4.jpg" alt="" /></a></span>
                    <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                    <span class="avil">Available in 34 stores</span>
                    <span class="price">Rs. 4567- Rs 6789</span>
                </li>
                <li class="last">
                    <a href="#" class="btntopcomman btnred">SALE</a>
                    <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/book-5.jpg" alt="" /></a></span>
                    <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                    <span class="avil">Available in 34 stores</span>
                    <span class="price">Rs. 4567- Rs 6789</span>
                </li>
                <li>
                    <a href="#" class="btntopcomman btnred">SALE</a>
                    <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/product1.jpg" alt="" /></a></span>
                    <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                    <span class="avil">Available in 34 stores</span>
                    <span class="price">Rs. 4567- Rs 6789</span>
                </li>
                <li>
                    <a href="#" class="btntopcomman btnred">SALE</a>
                    <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/book-4.jpg" alt="" /></a></span>
                    <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                    <span class="avil">Available in 34 stores</span>
                    <span class="price">Rs. 4567- Rs 6789</span>
                </li>
                <li class="last">
                    <a href="#" class="btntopcomman btnred">SALE</a>
                    <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/book-5.jpg" alt="" /></a></span>
                    <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                    <span class="avil">Available in 34 stores</span>
                    <span class="price">Rs. 4567- Rs 6789</span>
                </li>
            </ul>  
        </div>

                  <ul class="list">
        <li>
            <a href="#" class="btntopcomman btnred">SALE</a>
            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/book-4.jpg" alt="" /></a></span>
            <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
			<span class="productstarholder">
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
			</span> 
            <span class="avil">Available in 34 stores</span>
            <span class="price">Rs. 4567- Rs 6789</span>
        </li>
        <li>
            <a href="#" class="btntopcomman btnred">SALE</a>
            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/book-4.jpg" alt="" /></a></span>
            <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
			<span class="productstarholder">
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
			</span> 
            <span class="avil">Available in 34 stores</span>
            <span class="price">Rs. 4567- Rs 6789</span>
        </li>
        <li>
        	<a href="#" class="btntopcomman btnred">SALE</a>
            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/book-5.jpg" alt="" /></a></span>
            <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>  
			<span class="productstarholder">
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
			</span>  
            <span class="avil">Available in 34 stores</span>
            <span class="price">Rs. 4567- Rs 6789</span>
        </li>
		<li>
            <a href="#" class="btntopcomman btnred">SALE</a>
            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/book-4.jpg" alt="" /></a></span>
            <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
			<span class="productstarholder">
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
			</span> 
            <span class="avil">Available in 34 stores</span>
            <span class="price">Rs. 4567- Rs 6789</span>
        </li>
        <li>
            <a href="#" class="btntopcomman btnred">SALE</a>
            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/book-4.jpg" alt="" /></a></span>
            <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
			<span class="productstarholder">
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
				<a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star.jpg" /></a>
			</span> 
            <span class="avil">Available in 34 stores</span>
            <span class="price">Rs. 4567- Rs 6789</span>
        </li>
      </ul>
      <div class="space10"></div>

        <div class="ad">
            <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/add.jpg" alt="" /></a>
        </div>  
        <div class="space20"></div> 

      
        <!--  <div class="homesliderholder">
            <div class="homesliderbox">
                <h2>NEW ARRIVALS</h2>
                <div id="arrivals">
                    <div class="slides_container">
                        <div>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/th1.jpg" /></a></span>
                            <span class="namebox">
                                <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                                <span class="avil">Available in 34 stores</span>
                            </span>
                            <span class="price">Rs. 4567- Rs 6789</span>
                        </div>
                        <div>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/th2.jpg" /></a></span>
                            <span class="namebox">
                                <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                                <span class="avil">Available in 34 stores</span>
                            </span>
                            <span class="price">Rs. 4567- Rs 6789</span>
                        </div>
                        <div>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/th1.jpg" /></a></span>
                            <span class="namebox">
                                <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                                <span class="avil">Available in 34 stores</span>
                            </span>
                            <span class="price">Rs. 4567- Rs 6789</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="homesliderbox">
                <h2>BEST OFFERS</h2>
                <div id="offers">
                    <div class="slides_container">
                        <div>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/th2.jpg" /></a></span>
                            <span class="namebox">
                                <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                                <span class="avil">Available in 34 stores</span>
                            </span>
                            <span class="price">Rs. 4567- Rs 6789</span>
                        </div>
                        <div>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/th1.jpg" /></a></span>
                            <span class="namebox">
                                <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                                <span class="avil">Available in 34 stores</span>
                            </span>
                            <span class="price">Rs. 4567- Rs 6789</span>
                        </div>
                        <div>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/th2.jpg" /></a></span>
                            <span class="namebox">
                                <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                                <span class="avil">Available in 34 stores</span>
                            </span>
                            <span class="price">Rs. 4567- Rs 6789</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="homesliderbox homesliderboxlast">
                <h2>STORES OF THE DAY</h2>
                <div id="storeday">
                    <div class="slides_container">
                        <div>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/th3.jpg" /></a></span>
                            <span class="namebox">
                                <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                                <span class="avil">Available in 34 stores</span>
                            </span>
                            <span class="price">Rs. 4567- Rs 6789</span>
                        </div>
                        <div>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/th2.jpg" /></a></span>
                            <span class="namebox">
                                <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                                <span class="avil">Available in 34 stores</span>
                            </span>
                            <span class="price">Rs. 4567- Rs 6789</span>
                        </div>
                        <div>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/th1.jpg" /></a></span>
                            <span class="namebox">
                                <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                                <span class="avil">Available in 34 stores</span>
                            </span>
                            <span class="price">Rs. 4567- Rs 6789</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        -->
        <?php /* ?>
        <?php $brands = $this->common_model->getPublishedBrands(); ?>
        <?php if(count($brands) > 0){ ?>
        <div id="ourbrands" >
            <div class="brandshead"><h1>OUR BRANDS</h1></div>
            <ul class="marquee-with-options">
                <?php foreach ($brands as $brandKey => $brand) { ?>
                <li><a href="javascript:void(0);"><img src="<?php echo base_url().$this->config->item('brandImgPath').$brand->brandImg; ?>"  /></a></li>
                <?php } ?>
            </ul>
        </div>
        <?php } ?>
        <?php */ ?>