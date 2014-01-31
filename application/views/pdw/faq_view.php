<style>
    .staticContent {
        font-family:'robotocondensed ,Arial, Helvetica, sans-serif';
        font-size: 13px;
    }
    
    .faq_std dl dt {
        font-weight: bold;
    }

    .accordion dt {
        display: block;
        padding: 10px;
        border-bottom: 1px dotted #ccc;
    }

    .accordion dt.active {
        border-bottom: 0 dotted #ccc;
        color: #00A8C5;

    }

    .accordion dd {
        display: none;
        padding: 10px;
    }

    .accordion dd.active {
        display: block;
        padding: 10px 0 10px 11px;
        border-bottom: 1px dotted #FAA82B;
    }

</style>
<script type="text/javascript">
    ;(function($) { 
        $(document).ready(function() {
            $(".staticContent ul").addClass('keylist');
        })
    })(jQuery); 
    
    function clickMe(num)
    {
        if($("#faq_"+num).hasClass('active'))
        {
                $("#faq_"+num).removeClass("active");
                $("#ans_"+num).removeClass("active");
        }else{
                $("#faq_"+num).addClass("active");
                $("#ans_"+num).addClass("active");
        }
    }
</script>
<!-- Main -->  
<div id="main">
    <div class="mainholder">
        <div class="space10"></div>	
        <div class="staticContent">
            <!--<div class="prodheadholder">
                <h1><?php echo $pageHeading ?></h1>                
            </div>-->
            <p><?php //echo $pageContent; ?></p>
            <?php foreach ($faqList as $faqCat => $faq) { ?>
            <div class="subheadingholder">
                <h2><?php echo $faqCat; ?></h2>
            </div>
            <dl class="accordion">
            <?php foreach ($faq as $faqKey => $faqVal) { ?>
            <dt class="" id="faq_<?php echo $faqVal->faq_id;?>" onClick="clickMe('<?php echo $faqVal->faq_id;?>')">Q. <?php echo $faqVal->faq_ques;?></dt>
            <dd class="" id="ans_<?php echo $faqVal->faq_id;?>"><?php echo $faqVal->faq_ans;?></dd>
            <?php } ?>
            </dl>
            <div class="space20"></div>
            <?php } ?>
        </div>
        <div class="space10"></div>
    </div>
</div>