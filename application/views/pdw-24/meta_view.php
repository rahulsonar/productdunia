<?php
    $metaData = $this->common_model->getMetaData($metaTarget,$metaTargetCode);
    //print_debug($metaData, __FILE__, __LINE__, 1);
?>
<meta charset="UTF-8">
<meta name="keywords" content="<?php echo $metaData['metaKeyword']; ?>" />
<meta name="description" content="<?php echo $metaData['metaDesc']; ?>" />
<title><?php echo $metaData['pageTitle']; ?></title>