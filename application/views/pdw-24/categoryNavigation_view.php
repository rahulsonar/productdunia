<?php $productCategories = $this->common_model->getProductCategories(); ?>
<?php //print_r($productCategories);exit; ?>
<?php if($activePage=="home"){ ?>
<!-- Banner -->  
<div id="banner">
    <div class="mainholder">                                                                             
        <div id="navigation">
            <ul>
                <?php foreach ($productCategories as $firstLevelKey => $firstLevelVal) { ?>
                <li class="maincat"><a href="<?php echo site_url('product/cat/'.$firstLevelVal['categoryId'].'/'.url_title(strtolower($firstLevelVal['name']))); ?>"><?php echo $firstLevelVal['name']; ?></a>
                    <?php if(count($firstLevelVal['submenus']) > 0) { ?>
                    <div class="submenu menutabs">
                        <?php foreach ($firstLevelVal['submenus'] as $secondLevelKey => $secondLevelVal) { ?>
                        <div class="submenubox">
                            <span class="submenutitle"><?php echo $secondLevelVal['name'];?></span>
                            <?php if(count($secondLevelVal['submenus']) > 0) { ?>
                            <ul class="thirdlevel">
                                <?php foreach ($secondLevelVal['submenus'] as $thirdLevelKey => $thirdLevelVal) { ?>
                                <li><a href="<?php echo site_url('product/cat/'.$thirdLevelVal['categoryId'].'/'.url_title(strtolower($thirdLevelVal['name']))); ?>" title=""><span class="arrow">&raquo;</span> <?php echo $thirdLevelVal['name'];?></a></li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </li>
                <?php } ?>
            </ul>
        </div>
        <?php
        if ($activePage == 'home') {
            $this->load->view($this->config->item('themeCode') . "/slider_view", $data);
        }
        ?>
    </div>
</div>
<?php }else{ ?>
    <div class="mainnavdropholder"><a class="mainnavdrop" href="#"></a>
        <div id="innernavigation">
            <span class="innerarrow"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/navarrow1.png" alt="" /></span>
            <div id="navigation">
                <ul>
                <?php foreach ($productCategories as $firstLevelKey => $firstLevelVal) { ?>
                <li class="maincat"><a href="<?php echo site_url('product/cat/'.$firstLevelVal['categoryId'].'/'.url_title(strtolower($firstLevelVal['name']))); ?>"><?php echo $firstLevelVal['name']; ?></a>
                    <?php if(count($firstLevelVal['submenus']) > 0) { ?>
                    <div class="submenu menutabs">
                        <?php foreach ($firstLevelVal['submenus'] as $secondLevelKey => $secondLevelVal) { ?>
                        <div class="submenubox">
                            <span class="submenutitle"><?php echo $secondLevelVal['name'];?></span>
                                <?php if(count($secondLevelVal['submenus']) > 0) { ?>
                                <ul class="thirdlevel">
                                    <?php foreach ($secondLevelVal['submenus'] as $thirdLevelKey => $thirdLevelVal) { ?>
                                    <li><a href="<?php echo site_url('product/cat/'.$thirdLevelVal['categoryId'].'/'.url_title(strtolower($thirdLevelVal['name']))); ?>" title=""><span class="arrow">&raquo;</span> <?php echo $thirdLevelVal['name'];?></a></li>
                                    <?php } ?>
                                </ul>
                                <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </li>
                <?php } ?>
            </ul>
            </div>
        </div>
    </div>
<?php } ?>
