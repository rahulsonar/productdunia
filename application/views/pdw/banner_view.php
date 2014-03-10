<div class="add">
    <ul>
		<?php
		$positions=array("front1","front2","front3");
		$banners=$this->common_model->getBannersByPosition($positions);
		?>
        <li><a href="<?php echo $banners['front1']->url; ?>"><img src="<?php echo base_url().$this->config->item('bannerUploadPath')."/".$banners['front1']->image; ?>" /></a> <a href="#" class="btntopcomman">Shop Now</a></li>
        <li><a href="<?php echo $banners['front2']->url; ?>"><img src="<?php echo base_url().$this->config->item('bannerUploadPath')."/".$banners['front2']->image; ?>" /></a> <a href="#" class="btntopcomman">Shop Now</a></li>
        <li class="last"><a href="<?php echo $banners['front3']->url; ?>"><img src="<?php echo base_url().$this->config->item('bannerUploadPath')."/".$banners['front3']->image; ?>" /></a> <a href="#" class="btntopcomman">Shop Now</a></li>
    </ul>
</div>
