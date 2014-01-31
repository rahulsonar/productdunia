<!--Content-->
<?php
if (isset($output)) {
    $this->load->view($this->config->item('themeCode') . "/" . $template, $output);
} else {
    $this->load->view($this->config->item('themeCode') . "/" . $template);
}
?>
