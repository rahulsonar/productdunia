<?php
$cacheData = $this->datacache->getCache();
$categoryIds = $cacheData['refineSearch']['categoryReverseChain'];
$dynamicFiltersChecked = $cacheData['refineSearch']['dynamicFilters'];

$brandIds = $cacheData['refineSearch']['brands'];
$brands = $this->common_model->getFilterBrands($brandIds);
$dynamicFilters = $this->common_model->getDynamicFilters($categoryIds);
//print_debug($dynamicFiltersChecked, __FILE__, __LINE__, 0);
?>
<!-- Left Warp -->  
<div class="leftwarp">
    <h2>REFINE RESULT</h2>
    <div id="leftaccordion">
        <h3 class="sorttitle">Price</h3>
        <div class="sortbox  refine-by-cont">
            <div id="price-range"></div>
            <div id="price"></div>
        </div>
        <?php if(count($brands) > 0){ ?>
        <h3 class="sorttitle">Brands</h3>
        <div class="sortbox">
            <ul>
                <?php foreach ($brands as $brandId => $brandName){ ?>
                <li><label><input type="checkbox" name="filterBrands[]" id="filterBrands" class="filterBrands" value="<?php echo $brandId; ?>" <?php if (in_array($brandId, $brandIdChecked)) { ?> checked='checked' <?php } ?> /> <?php echo $brandName; ?> </label></li>
                <?php } ?>
            </ul>
        </div>
        <?php } ?>
        
        <?php if(count($dynamicFilters) > 0){ ?>
        <?php foreach ($dynamicFilters as $filterType => $filterOptions){ ?>
        <h3 class="sorttitle"><?php echo $filterType; ?></h3>
        <div class="sortbox">
            <ul>
                <?php foreach ($filterOptions as $filterId => $filterValue){ ?>
                <li><label><input type="checkbox" name="<?php echo url_title($filterType, '-',true).'[]';?>" id="<?php echo url_title($filterType, '-',true); ?>" class="<?php echo url_title($filterType, '-',true); ?>" value="<?php echo $filterId; ?>" /> <?php echo $filterValue; ?> </label></li>
                <?php } ?>
            </ul>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
</div>

<script type="text/javascript">
    $(function() {
          
        $("#price-range").slider({
            range: true,
            min: <?php echo $cacheData['refineSearch']['priceRange']['priceFrom']; ?>,
            max: <?php echo $cacheData['refineSearch']['priceRange']['priceTo']; ?>,
            values: [ <?php echo $cacheData['refineSearch']['priceRange']['priceFrom']; ?>, <?php echo $cacheData['refineSearch']['priceRange']['priceTo']; ?> ],
            change:function(event, ui) {
                xajax_setRefineCriteria('priceRange',ui.values);},
            slide: function( event, ui ) {
                $("#price" ).html( "<span class='min'>INR " + ui.values[ 0 ] + "</span> <span class='max'>INR " + ui.values[ 1 ]+"</span>" );
            }
        });
        $( "#price" ).html( "<span class='min'>INR  " + $( "#price-range" ).slider( "values", 0 ) + " </span> <span class='max'>INR " + $( "#price-range" ).slider( "values", 1 )+"</span>" );
            
        $('.filterBrands').click(function(){
            var values = new Array();
            $.each($("input[name='filterBrands[]']:checked"), function() {
                values.push($(this).val());
            });
            xajax_setRefineCriteria('filterBrands',values);
        });
        
        <?php foreach ($dynamicFilters as $filterType => $filterOptions){ ?>
            $('.<?php echo url_title($filterType, '-',true);?>').click(function(){
                var values = new Array();
                $.each($("input[name='<?php echo url_title($filterType, '-',true);?>[]']:checked"), function() {
                    values.push($(this).val());
                });
                xajax_setRefineCriteria('<?php echo url_title($filterType, '-',true);?>',values);
            });
        <?php } ?>
    });
</script>
<style type="text/css">
    .refine-by-cont .ui-slider .ui-slider-range{position:absolute;z-index:1;font-size:.7em;display:block;border:0;background-position:0 0;}
    .refine-by-cont .ui-slider{position:relative;text-align:left;}
    .refine-by-cont .ui-slider .ui-slider-handle{position:absolute;z-index:2;width:1.2em;height:1.2em;cursor:default;}
    .refine-by-cont .ui-slider.ui-state-disabled .ui-slider-handle,
    .refine-by-cont .ui-slider.ui-state-disabled .ui-slider-range{filter:inherit;}
    .refine-by-cont .ui-slider-horizontal{height:.8em;}
    .refine-by-cont .ui-slider-horizontal .ui-slider-handle{top:-.3em;margin-left:-.6em;}
    .refine-by-cont .ui-slider-horizontal .ui-slider-handle,
    .refine-by-cont .ui-slider-handle,
    .refine-by-cont .ui-state-default{background:url(<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/bg-slider-handle.png) no-repeat;}
    .refine-by-cont .ui-slider-horizontal{height:0.8em;}
    .refine-by-cont .ui-slider-horizontal .ui-slider-range{top:0;height:100%;}
    .refine-by-cont .ui-slider-horizontal .ui-slider-range-min{left:0;}
    .refine-by-cont .ui-slider-horizontal .ui-slider-range-max{right:0;}
    .refine-by-cont .ui-widget-content{border:1px solid #aaaaaa;-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;background:#f2f2f2;-moz-box-shadow:inset 0 0 7px #ccc;-webkit-box-shadow:inset 0 0 7px #ccc;box-shadow:inset 0 0 7px #ccc;}
    .refine-by-cont .ui-slider{position:relative;text-align:left;}
    .refine-by-cont .ui-slider .ui-slider-handle{position:absolute;z-index:2;width:1.2em;height:1.2em;cursor:default;}
    .refine-by-cont .ui-slider .ui-slider-range{position:absolute;z-index:1;font-size:.7em;display:block;border:0;background-position:0 0;}
</style>