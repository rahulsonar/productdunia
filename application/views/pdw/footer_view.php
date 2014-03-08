<!-- Footer -->  
<div id="footer">
    <div class="space20"></div>
    <div class="space15"></div>
    <div class="mainholder">
        <div class="othersavicesbox">
            <div class="othersavicesboxicons">
                <img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/footericons1.png" />
            </div>
            <h2>FAST DELIVERY</h2>
            <p>We guarantee an effective, secure and friendly delivery deadlines announced. Depending on your order, we select the packaging and the most suited to your needs sending mode.</p>
        </div>

        <div class="othersavicesbox">
            <div class="othersavicesboxicons">
                <img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/footericons2.png" />
            </div>
            <h2>24X7 SERVICE</h2>
            <p>Perhaps we do not know you deliver in 48 hours, but we always treat your request within 24 working hours.Whether a board to match our products or a custom quote, we are here to help you by e-mail or by phone.</p>
        </div>

        <div class="othersavicesbox">
            <div class="othersavicesboxicons">
                <img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/footericons3.png" />
            </div>
            <h2>BEST Quality </h2>
            <p>To be clear, this helps you to get the lowest price! Creating a markaetplace where vendors can competitively bid for a set of products and/or services that a consumer wishes to purchase at the best possible price at a specialc point in time.</p>
        </div>

        <div class="othersavicesbox">
            <div class="othersavicesboxicons">
                <img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/footericons4.png" />
            </div>
            <h2>BEST PRICE</h2>
            <p>Yes, we give you the lowest price: the best! We set our prices so that they are the fairest and most competitive possible equal service. And if you find cheaper elsewhere, please contact us, you will not be disappointed.</p>
        </div>
    </div>
    
    <?php $cities = $this->common_model->getCities(); ?>
    <div id="footerstroe">
        <div class="mainholder">
            <div class="itemholder">
                <p>Stores In:</p> 
                <?php foreach ($cities as $cityKey => $city) { ?>
                    <?php if($city['status']=='Active'){ ?>
                        <a href="javascript:void(0);" onClick="xajax_changeCity('<?php echo $cityKey; ?>');" title="<?php echo $city['cityName']; ?>"><?php echo $city['cityName']; ?></a> |
                    <?php }else{ ?>
                        <a href="javascript:void(0);" title="<?php echo $city['cityName']; ?>"><?php echo $city['cityName']; ?></a> |
                    <?php } ?>                                
                <?php } ?>
            </div>
        </div>
    </div>
    
    <div id="footerpayment">
        <div class="mainholder">
            <a href="#" class="visa"></a>
            <a href="#" class="master"></a>
            <a href="#" class="mastro"></a>
            <a href="#" class="amiracan"></a>
            <a href="#" class="dc"></a>
            <a href="#" class="netb"></a>
            <a href="#" class="cashp"></a>
            <a href="#" class="easyp"></a>
        </div>
    </div>

    <div id="footeritems">
        <div class="mainholder">
            <div class="itemholder">
                <p>Electronics:</p> 
                    <a href="#">Refrigerator</a>
                    <a href="#">Blender</a>
                    <a href="#">Washing machine</a>
                    <a href="#">Laptop</a>
                    <a href="#">Mobile Phones </a>
                    <a href="#">Computers</a>
                    <a href="#">Washing machine</a>
                    <a href="#">Laptop</a>
                    <a href="#">Mobile Phones</a>
                    <a href="#">Computers</a> 
            </div>
            <div class="itemholder">
                <p>Automobile:</p> <a href="#">Scooty</a>
                <a href="#">Bikes</a>
                <a href="#">Cars</a>
                <a href="#">Heavy Vehicles</a>
                <a href="#">Accessories</a>
                <a href="#">Lights</a>
                <a href="#">Music System</a>
            </div>
            <div class="itemholder">
                <p>Books:</p> <a href="#">Fiction</a>
                <a href="#">Horror</a>
                <a href="#">Best Sellers</a>
                <a href="#">Romantic</a>
                <a href="#">Sale</a>
                <a href="#">Thriller</a>
                <a href="#">Sci-Fi</a>
                <a href="#">Fiction</a>                
            </div>
        </div>
    </div>

    <div id="footermain">
        <div class="mainholder">
            <div class="box1">
                <h3>CONTACT US</h3>
                <p>
                    Wood Heights <br />
                    107, Block B<br />
                    Delhi<br /> <br />

                    Email: info@PD.com <br />
                    Tel: +91 123456<br />
                    Fax: +91 654321
                </p>
            </div>
            <div class="box2">
                <h3>RETURN POLICY</h3>
                <p>Once products delivered, they are not returned or exchanged. However, if the product is damaged during the handling, we will be responsible for any such act and we will replace your product.</p>
                <p>Once products delivered, they are not returned or exchanged. However, if the product is damaged during the handling, we will be responsible for any such act and we will replace your product.</p>
                <p>Once products delivered, they are not returned or exchanged. However, if the product is </p>
                
            </div>
            <div class="box3">
                <h3>Subscribe Newsletter</h3>
                <p>Subscribe to our newsletter to know about offers, sale and new products.</p>
                <form name="frmNewsletterSubscription" id="newsletter">
                    <input type="text" name="newsEmail" id="newsEmail" class="inpnewsletter rounded"/>
                    <input type="submit" class="btnorang rounded" value="GO" />
                </form>
                <div id="sociallinks">
                    <a href="<?php echo $this->config->item('pd_gplus');?>" class="go" target="_blank"></a>
                    <a href="<?php echo $this->config->item('pd_youtube');?>" class="you" target="_blank"></a>
                    <a href="<?php echo $this->config->item('pd_pint');?>" class="pin" target="_blank"></a>
                    <a href="<?php echo $this->config->item('pd_twitter');?>" class="tw" target="_blank"></a>
                    <a href="<?php echo $this->config->item('pd_linkedin');?>" class="in" target="_blank"></a>
                    <a href="<?php echo $this->config->item('pd_fb');?>" class="fb" target="_blank"></a>
                </div>
            </div>
            <div class="space10"></div>
            <div id="footermenu">
                <a style="font-weight: bold;font-size: 11px"><?php echo $this->config->item('copyright'); ?></a><a href="<?php echo site_url('sales-purchase'); ?>">Sales and Purchase</a> | <a href="<?php echo site_url('terms-conditions'); ?>">Terms and Conditions</a> | <a href="<?php echo site_url('return-policy'); ?>">Return Policy</a> | <a href="<?php echo site_url('faq'); ?>">FAQ</a> | <a href="<?php echo site_url('privacy-policy'); ?>">Privacy Policy </a> | <a href="<?php echo site_url('about-us'); ?>">About Us</a>
                <!--<a style="font-weight: bold;font-size: 11px">Copyrights 2014 @ Product Duniya</a><a href="#">Sales and Purchase</a> | <a href="#">Terms and Conditions</a> | <a href="#">Return Policy</a> | <a href="#">FAQ</a>  | <a href="#">Privacy Policy </a> | <a href="#">About Us</a>-->
            </div>
        </div>
    </div>
</div>

<!--<div id="stickfooter">
	<div class="mainholder">
		<ul id="stickfooteritem" class="tabs">
			<li><a href="#scomparer">Store Comparer </a><span class="badge">5</span>
				<div class="sctabitem lastab">
					<div class="stickitem">
						<a href="#" class="stickitemclose"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/close1.jpg" alt="" /></a>
						<a href="#" class="stickitemimg"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/scitem.jpg" alt="" /></a>
						<div class="stickitemcontent">
							<span class="title"><a href="#">HP Laptop 67AZ <br> (White)</a></span>
							<span class="avil">Available in 34 stores</span>
							<span class="price">Rs. 4567- Rs 6789</span>
						</div>
					</div>
					<div class="stickitem">
				<a href="#" class="stickitemclose"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/close1.jpg" alt="" /></a>
				<a href="#" class="stickitemimg"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/scitem.jpg" alt="" /></a>
				<div class="stickitemcontent">
				<span class="title"><a href="#">HP Laptop 67AZ <br> (White)</a></span>
				<span class="avil">Available in 34 stores</span>
				<span class="price">Rs. 4567- Rs 6789</span>
				</div>
			</div>
					<div class="compare">
								<input type="button" class="btnblue" value="Compare"  />
							</div>
				</div>
			</li>
			<li><a href="#pcomparer">Product Comparer </a><span class="badge">5</span>
				<div class="sctabitem lastab">
					<div class="stickitem">
						<a href="#" class="stickitemclose"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/close1.jpg" alt="" /></a>
						<a href="#" class="stickitemimg"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/scitem.jpg" alt="" /></a>
						<div class="stickitemcontent">
							<span class="title"><a href="#">HP Laptop 67AZ <br> (White)</a></span>
							<span class="avil">Available in 34 stores</span>
							<span class="price">Rs. 4567- Rs 6789</span>
						</div>
					</div>
					<div class="stickitem">
				<a href="#" class="stickitemclose"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/close1.jpg" alt="" /></a>
				<a href="#" class="stickitemimg"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/scitem.jpg" alt="" /></a>
				<div class="stickitemcontent">
				<span class="title"><a href="#">HP Laptop 67AZ <br> (White)</a></span>
				<span class="avil">Available in 34 stores</span>
				<span class="price">Rs. 4567- Rs 6789</span>
				</div>
			</div>
					<div class="compare">
						<input type="button" class="btnblue" value="Compare"  />
					</div>
				</div>
			</li>
		</ul>
		
	</div>
</div>-->



<?php $this->load->view($this->config->item('themeCode')."/overlay_view"); ?>

<?php $this->load->view($this->config->item('themeCode')."/footer_includes_view"); ?>