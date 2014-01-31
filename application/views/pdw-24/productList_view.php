<input type="hidden" name = "offset" id="offset" value="<?php echo $offset; ?>" />
<!-- Main -->  
<div id="main">
    <div class="mainholder">
        <div class="add">
            <ul>
                <li> <img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/add1.jpg" alt="" /></li>
            </ul>
        </div>
        <?php $this->load->view($this->config->item('themeCode') . "/left_section_view", $data); ?>
        <!-- Right Warp -->  
        <div class="rightwarp">
            <?php $this->load->view($this->config->item('themeCode') . "/breadcrumbs_view"); ?>
            <!--<div class="subheadingholder prodheadingholder">
                <h2>Cameras</h2>
            </div>
            <div class="jcarousel-wrapper">
                <div class="jcarousel">
                    <ul class="listslider">
                        <li>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/cam.jpg" alt="" /></a></span>
                            <span class="title"><a href="#">Canon <br /> Camcorder (7)</a></span>   
                        </li>
                        <li>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/cam.jpg" alt="" /></a></span>
                            <span class="title"><a href="#">Canon <br /> Camcorder (7)</a></span>   
                        </li>
                        <li>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/cam.jpg" alt="" /></a></span>
                            <span class="title"><a href="#">Canon <br /> Camcorder (7)</a></span>   
                        </li>
                        <li>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/cam.jpg" alt="" /></a></span>
                            <span class="title"><a href="#">Canon <br /> Camcorder (7)</a></span>   
                        </li>
                        <li>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/cam.jpg" alt="" /></a></span>
                            <span class="title"><a href="#">Canon <br /> Camcorder (7)</a></span>   
                        </li>
                        <li>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/cam.jpg" alt="" /></a></span>
                            <span class="title"><a href="#">Canon <br /> Camcorder (7)</a></span>   
                        </li>
                        <li>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/cam.jpg" alt="" /></a></span>
                            <span class="title"><a href="#">Canon <br /> Camcorder (7)</a></span>   
                        </li>
                        <li>
                            <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/cam.jpg" alt="" /></a></span>
                            <span class="title"><a href="#">Canon <br /> Camcorder (7)</a></span>   
                        </li>

                    </ul>
                </div>
                <a href="#" class="jcarousel-control-prev"></a>
                <a href="#" class="jcarousel-control-next"></a>
            </div>-->

            <div class="subheadingholder">
                <h2><div id="totalProd"><?php echo $totalProducts; ?></div></h2>
                <span class="right">Sort By:  
                    <select name="productSort" id="productSort" onChange="javascript:sortProd(this.value);">
                        <option value="price~asc">Price - Low to High</option>
                        <option value="price~desc">Price - High to low</option>
                        <option value="proName~asc">Product Name</option>
                    </select>
                </span>
            </div>
            <ul class="list prodlist" id="prodlist">
                <?php $this->load->view($this->config->item('themeCode') . "/productGrid_view",$products); ?>
            </ul>
            <div class="space10"></div>
            <?php if(count($products) > 0){ ?>
            <div id='loadMoreItems'>
                <a href="javascript:void(0);" class="loadmore loadMoreItems">Load More Items</a>
            </div>
                <?php } ?>
        </div>


        <!--<div class="subheadingholder prodheadingholder">
            <h2>People Who Viewed These Item Also Viewed</h2>
            <a href="#">View All <span>&raquo;</span></a>
        </div>
        <div class="space20"></div>
        <ul class="list prodlist">
            <li>
                <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/thumb1.jpg" alt="" /></a></span>
                <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                <span class="avil">Available in 34 stores</span>
                <span class="price">Rs. 4567- Rs 6789</span>
            </li>
            <li>
                <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/thumb2.jpg" alt="" /></a></span>
                <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                <span class="avil">Available in 34 stores</span>
                <span class="price">Rs. 4567- Rs 6789</span>
            </li>
            <li>
                <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/thumb3.jpg" alt="" /></a></span>
                <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                <span class="avil">Available in 34 stores</span>
                <span class="price">Rs. 4567- Rs 6789</span>
            </li>
            <li>
                <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/thumb4.jpg" alt="" /></a></span>
                <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                <span class="avil">Available in 34 stores</span>
                <span class="price">Rs. 4567- Rs 6789</span>
            </li>
            <li class="last">
                <span class="imgbox"><a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/thumb5.jpg" alt="" /></a></span>
                <span class="title"><a href="#">HP Laptop 67AZ <br /> (White)</a></span>   
                <span class="avil">Available in 34 stores</span>
                <span class="price">Rs. 4567- Rs 6789</span>
            </li>
        </ul>-->
        <div class="space20"></div>
        <?php $this->load->view($this->config->item('themeCode') . "/bottom_section_view"); ?>
        <div class="space20"></div> 
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('.loadMoreItems').click(function(){
            offset = $('#offset').val();
            xajax_loadMoreResult(offset);
        });
      
    });    
    
    function sortProd(sortVal){
        var sortSplit = sortVal.split('~');
        var values = new Array();
        values.push(sortSplit[0]);
        values.push(sortSplit[1]);
        xajax_setRefineCriteria('sort',values);
        //$('#loadMoreItems').html('<a href="javascript:void(0);" class="loadmore loadMoreItems">Load More Items</a>');
    }
    
</script>

<script type="text/javascript">    
    function callRating(){        
        <?php foreach ($productsAll as $proKey => $product) { ?>
                $('#productId-<?php echo $product['productId'];?>').raty({
                        score: <?php echo $product['rating'];?>,
                        readOnly: true,
                        starOn: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-on.png',
                        starOff: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-off.png',
                        starHalf: '<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/star-half.png'
                });
        <?php } ?>        
    }
    
    ;(function($) {
        $(document).ready(function() {
            callRating();
        })
    })(jQuery);
</script>