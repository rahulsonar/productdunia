<!-- Main -->  
<div id="main">
    <div class="mainholder">
        <?php $this->load->view($this->config->item('themeCode') . "/banner_view"); ?>

        <div class="subheadingholder prodheadingholder">
            <h2>TOP SELLING PRODUCTS</h2>
        </div>
        <div class="space20"></div>
        <?php
        foreach ($products as $proKey => $productList) {
            $data['prods'] = $productList['prods'];
            $temp['data'] = $data;
            ?>
            <?php if (count($productList['prods']) > 0) { ?>
                <div class="subheadingholder">
                    <h2><?php echo $productList['title']; ?></h2>
                    <a href="<?php echo $productList['viewAll']; ?>">View All <span>&raquo;</span></a>
                </div>
                <ul class="list">
                    <?php $this->load->view($this->config->item('themeCode') . "/homeProductGrid_view", $data); ?>
                </ul>
                <div class="space20"></div>
            <?php } ?>
        <?php } ?>
        <?php $this->load->view($this->config->item('themeCode') . "/bottom_section_view"); ?>
    </div>
</div>