<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <noscript>
        <div class="overlay-layer" id="overlay" style="display:block;"></div>
        <div class="overlayBox" id="overlayBox" style="top: 160px;">
            <a class="boxclose" id="boxclose"></a>
            <h1>Important message</h1>
            <p>
                <br />Please enable JavaScript on your browser or upgrade to a JavaScript-capable browser.<br />
            </p>
        </div>
    </noscript>    
    <head>
        <?php $this->load->view($this->config->item('themeCode')."/meta_view",$data); ?>        
        <?php $this->load->view($this->config->item('themeCode')."/includes_view"); ?>
        <?php $this->xajax->configure("javascript URI", base_url().'assets/js/');?>
        <?php echo $this->xajax->getJavascript(base_url().'assets/js/'); ?>
    </head>
    <body>
        <!--Start: Wrapper-->
        <!--<div id="wrapper">-->
            <?php $this->load->view($this->config->item('themeCode')."/header_view",$data); ?>
            <?php $this->load->view($this->config->item('themeCode')."/main_content_view",$data); ?>
            <?php $this->load->view($this->config->item('themeCode')."/footer_view",$data); ?>
        <!--</div>-->
        <!--End: Wrapper-->
    </body>
</html>
