<!--Start: Flower cont-->
  <div class="cont flower-cont">
    <div class="clear breadcrumb">&nbsp;</div>
    <?php $this->load->view($this->config->item('themeCode') . "/left_section_view", $data); ?>  
    <!--Start: Flower Category List-->
    <div class="col-right flower-cont-list">
      <div class="clear pagination"><span class="items" id="items"><?php echo $totalProducts; ?></span>
        <div class="page-no">
          <ul id="paginate">
              <?php echo $links_pager; ?>
          </ul>
        </div>
      </div>
      <ul class="flower-item" id="product_list">
        <?php $this->load->view($this->config->item('themeCode') . "/productGrid_view",$products); ?>
      </ul>
      <div id="ajax_loader" class="ajax_loader"><img src="<?php echo base_url() . "assets/".$this->config->item('themeCode')."/images/ajax-loader.gif" ?>" alt="Loading..." title="Loading..."></div>
      <div class="clear pagination"><span class="items" id="items-bottom"><?php echo $totalProducts; ?></span>
        <div class="page-no">
          <ul id="paginate-bottom">
              <?php echo $links_pager; ?>
          </ul>
        </div>
      </div>
    </div>    
    <!--End: Flower Category List-->
    <div class="clear"></div>
  </div>
  <!--End: Flower cont-->
    <script type="text/javascript">
     $("#ajax_loader").hide();
    </script>