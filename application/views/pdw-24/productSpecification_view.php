<?php
    //print_debug($productSpecification, __FILE__, __LINE__, 0);
?>
<div id="pdspication" class="subheadingholder prodheadingholder">
    <h2>PRODUCT SPECIFICATION:</h2>
</div>
<div class="prodsubbox">
    <?php foreach ($productSpecification as $specGroup => $specArr) { ?>
    <h2 class="seftitle"><?php echo $specGroup; ?></h2>
    <table class="prodsubdetails">
        <?php foreach ($specArr as $specKey => $specVal) { ?>
        <tr>
            <td class="prodlabel"><?php echo $specVal['specLabel']; ?></td>
            <?php 
            $pos = strpos($specVal['specValue'], '||');
            if ($pos === false) { ?>
                <td><?php echo $specVal['specValue']; ?></td>
            <?php }else{ 
                $specValueArr = explode('||',$specVal['specValue']);
            ?>
                <td>                    
                    <ul class="listitem">
                        <?php foreach ($specValueArr as $Key => $Val) { ?>
                            <li><?php echo $Val; ?></li>
                        <?php } ?>
                    </ul>
                </td>
            <?php } ?>            
        </tr>
        <?php } ?>
    </table>
    <?php } ?>
</div>
<div class="space15"></div>