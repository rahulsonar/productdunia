<script type="text/javascript">
    ;(function($) { 
        
        $.widget("custom.catcomplete", $.ui.autocomplete, {
        _renderMenu: function (ul, items) {
            var self = this,
                currentCategory = "";
                $.each(items, function (index, item) {
                    if (item.category != currentCategory) {
                        ul.append("<li class='ui-autocomplete-category'>" + item.category + "</li>");
                        currentCategory = item.category;
                    }
                    self._renderItem(ul, item);
                });
            }
        });
    
        $(document).ready(function() {
            $( "#topSearchBox" ).autocomplete({            	
                source: '<?php echo site_url("product/getTopSearchAutoComplete"); ?>',
                minLength: 1,
                select: function( event, ui ) {            		
                    var keyword = $('#topSearchBox').val();
                    $('#keyword').val(keyword); 
                    
                    var action = ui.item.url;
                    $("#frmSearchKeyword").attr("action", action);
                    $("#frmSearchKeyword").submit();
                },
                search: function() {
                    var keyword = $('#topSearchBox').val();
                    $('#keyword').val(keyword);
                    var action = '<?php echo site_url('/product/search/'); ?>'+'/'+keyword;
                    $("#frmSearchKeyword").attr("action", action);
                }
            })
            .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                .append( "<a>" + item.label + "</a>" )
                .appendTo( ul );
            };
        })
    })(jQuery); 
</script>
 <style>
.ui-autocomplete-category {
font-weight: bold;
padding: .2em .4em;
margin: .8em 0 .2em;
line-height: 1.5;
}
</style>
<!-- Header -->
<div id="header">
    <div class="topmenu">
        <div class="mainholder">
            <div class="left">
                <a href="#">My Wishlist <span class="badge">0</span></a> | <a href="#">Product pinger <span class="badge">0</span></a> | <a href="#">Store Pinger <span class="badge">0</span></a>
            </div>
            <div class="right">
                <a href="#shotlogin" class="inline">Track Order</a > | 
                <?php if ($this->session->userdata('interfaceUsername') == '') { ?>
                    <a href="#signin" class="inline">Create Store</a>          
                <?php } else { ?>
                    <a href="#verification" class="inline">Create Store</a>
                <?php } ?>

                <?php if ($this->session->userdata('interfaceUsername') == '') { ?>
                    <a href="#signup" class="signup rounded inline">Sign Up</a>
                    <a href="#signin" class="signin rounded inline">Sign In</a>
                <?php } else { ?>
                    <?php if ($this->session->userdata('logoutUrl') != '') { ?>
                        | <a href="<?php echo $this->session->userdata('logoutUrl'); ?>">Logout</a>
                    <?php } else { ?>
                        | <a href="<?php echo site_url('customer/logout'); ?>">Logout</a>
                    <?php } ?>                    
                <?php } ?>
            </div>
        </div>
    </div>
    <?php $cities = $this->common_model->getCities(); ?>
    <div  class="default">
        <div class="logoholder">
            <div class="mainholder">
                <?php if($activePage!="home"){ 
                    $this->load->view($this->config->item('themeCode') . "/categoryNavigation_view", $data);
                 } ?>
                <a href="<?php echo site_url(); ?>" class="logo">
                    <span class="logotagline">Search, Bargain n Shop</span>
                </a>
                <div class="cartholder">
                    <a href="#" class="cart"><span>0</span> Products Added</a><span class="cartdivder"></span>
                    <div class="cityholder">
                        <a href="#" class="city cityName" id="topCity"><?php echo $this->session->userdata('citySelectedName'); ?></a>
                        <?php if (count($cities) > 0) { ?>
                            <div id="cities" style="display:none">
                                <span class="toparrow"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/arrow1.png" /></span>
                                <div class="gray-skin scroll" id="topCityList">
                                    <ul>
                                        <?php foreach ($cities as $cityKey => $city) { ?>
                                            <?php if ($city['status'] == 'Active') { ?>
                                                <li><a href="javascript:void(0);" onClick="xajax_changeCity('<?php echo $cityKey; ?>');" class='cityName' id='cityName' title="<?php echo $city['cityName']; ?>"><?php echo $city['cityName']; ?></a></li>
                                            <?php } else { ?>
                                                <li><a href="javascript:void(0);" class='cityName' id='cityName' title="<?php echo $city['cityName']; ?>"><?php echo $city['cityName']; ?></a></li>
                                            <?php } ?>                                
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div id="search">
                    <?php $majorAreas = $this->common_model->getMajorAreas($this->session->userdata('citySelected')); ?>
                    <input type="text" class="inpselsearch" placeholder="Type Your Areas" />
                    <div class="selsearchholder"><a class="selsearch" href="#"></a>
                        <div id="multipleareas">		
                            <h2 class="majoretra">Major Area</h2>
                            <ul>
                                <?php foreach ($majorAreas as $areaId => $areaName) { ?>
                                    <li><input type="checkbox" class="commencheck" id="<?php echo $areaName; ?>" value="<?php echo $areaId; ?>" /><label for="<?php echo $areaName; ?>"><?php echo $areaName; ?></label></li>
                                <?php } ?>
                            </ul>
                            <div class="subarea"><span>Included Sub Area</span></div>
                        </div>
                    </div>
                    <form name="frmSearchKeyword" id="frmSearchKeyword" method="post" action="<?php echo site_url('product/search'); ?>">
                        <input type="hidden" value="" name="keyword" id="keyword" />
                        <input class="inpsearch rounded" id="topSearchBox" type="text" value="<?php echo $keyword; ?>" placeholder="Enter Product Name you want to search eg. Samsung Galaxy"  />
                        <input type="submit" class="btnsearch rounded" value="search" />
                    </form>
                    <a href="#" class="advsearch">WINDOW SHOPPING</a>
                </div>
            </div>
        </div>
        <span class="colorstriplarge"></span>
    </div>
</div>
<?php if($activePage=="home"){
    $this->load->view($this->config->item('themeCode') . "/categoryNavigation_view", $data);
} ?>