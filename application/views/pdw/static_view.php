<style>
    .staticContent {
        font-family:'robotocondensed ,Arial, Helvetica, sans-serif';
        font-size: 13px;
    }
</style>
<script type="text/javascript">
    ;(function($) { 
        $(document).ready(function() {
            $(".staticContent ul").addClass('keylist');
        })
    })(jQuery); 
</script>
<!-- Main -->  
<div id="main">
    <div class="mainholder">
        <div class="space10"></div>	
        <div class="staticContent">
            <div class="prodheadholder">
                <h1><?php echo $pageHeading ?></h1>                
            </div>
            <p><?php echo $pageContent; ?></p>
            <div class="space20"></div>
        </div>
        <div class="space10"></div>
    </div>
</div>