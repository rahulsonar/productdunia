<script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	$("#frmPersonalInfo").validate({
		rules: {
			name: {
				required: true
			},
                        email: {
				required: true,
				email: true
			},
			mobile: {
				required: true,
				minlength: 10,
                                maxlength: 10
			}		},errorElement: "div",
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
                    xajax_personalInfoSubmit(xajax.getFormValues('frmPersonalInfo'));
		}
	});	
})
})(jQuery); 
</script>
<div id="main">
    <div class="mainholder">
        <div class="add">
            <ul>
                <li> <img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/add1.jpg" alt="" /></li>
            </ul>
        </div>
        <!-- Left Warp -->  
        <?php $this->load->view($this->config->item('themeCode') . "/leftprofilemenu", $data); ?>

        <!-- Right Warp -->  
    <div class="rightwarp">
        <ul class="breadcrumbs">
		<li><a href="#">Home</a></li>
		<li class="divder">Â»</li>
		<li>Bargain Request</li>
	</ul>
        <div class="subheadingholder nonmargin">
    	<h2>Bargain Request</h2>
	</div>
    
	<div class="shortholder_order">
		<table class="short_table">
			<tr>
                            <td style="width: 25%">
                                Showing:
			<select>
					<option>1</option>
					<option>2</option>
				
				</select>
                                Per Page
                            <td>
				Sort by 
                                <select style="width: 80px">
					<option>Unread</option>
					<option>Read</option>
                                        <option>Mostly Bargained</option>
				</select>
				</td>
                                <td>
				Products
				<select style="width: 80px">
					<option>Unread</option>
					<option>Read</option>
                                        <option>Mostly Bargained</option>
				</select>
				</td>
                            <td class="right"><label for="from">From</label>
                                    <input type="text" id="from" name="from" placeholder='mm/dd/yyyy'/>
                                    <label for="to">To</label>
                                    <input type="text" id="to" name="to" placeholder='mm/dd/yyyy'/></td>
			</tr>
		</table>			
	</div>
        <div class="space15"></div>
        <?php 
		echo '<pre>';
		//print_r($master);
		echo '</pre>';
		?>
        <?php foreach ($master as $bargainId => $value) { 
			
		?>
		<input type="hidden" name="bargainImg_<?php echo $bargainId; ?>" id="bargainImg_<?php echo $bargainId; ?>" value="<?php echo base_url().$this->config->item('productImgPath').$value['productImg']; ?>" />
		<input type="hidden" name="bargainProdName_<?php echo $bargainId; ?>" id="bargainProdName_<?php echo $bargainId; ?>" value="<?php echo $value['productName']; ?>" />
		<input type="hidden" name="bargainCustomerName_<?php echo $bargainId; ?>" id="bargainCustomerName_<?php echo $bargainId; ?>" value="<?php echo $value['customerName']; ?>" />
		<input type="hidden" name="bargainCustomerContact_<?php echo $bargainId; ?>" id="bargainCustomerContact_<?php echo $bargainId; ?>" value="<?php echo $value['customer_mobile']; ?>" />
		<input type="hidden" name="bargainActualPrice_<?php echo $bargainId; ?>" id="bargainActualPrice_<?php echo $bargainId; ?>" value="<?php echo $value['sellPrice']; ?>" />
		<input type="hidden" name="bargainExpectedPrice_<?php echo $bargainId; ?>" id="bargainExpectedPrice_<?php echo $bargainId; ?>"  value="<?php echo $value['expectedPrice']; ?>" />
		<input type="hidden" name="bargainQuantity_<?php echo $bargainId; ?>" id="bargainQuantity_<?php echo $bargainId; ?>"  value="<?php echo $value['quantity']; ?>" />
		
        <div class="proddbox">
                <a class="bargainSubArrow" href="javascript:void(0)" id="bargainExpand_<?php echo $bargainId; ?>"></a>
                <div class="left bargainreqimg">
                <img src="<?php echo base_url().$this->config->item('productImgPath').$value['bargain']['productImg']; ?>" width="90px"/>
                </div>
           
            <div class="left bargainreq">
                <div class="left">
                   
                     <table style="width: 300px">
                        <tr>
                            <td style="alignment-adjust: hanging"><label><strong>Product:</strong></label></td>
                            <td><label style="width: 200px"><?php echo $value['bargain']['productName']; ?></label></td>
                        </tr>
						
                        <tr>
                            <td><label><strong>Customer Name:</strong></label></td>
                            <td><label><?php echo $value['bargain']['customerName']; ?></label></td>
                        </tr>
                        <tr>
                            <td><label><strong>Contact Detail:</strong></label></td>
                            <td><label><?php echo $value['bargain']['customer_mobile']; ?></label></td>
                        </tr>
						<tr>
                            <td><label><strong>Expected Quantity:</strong></label></td>
                            <td style="height: 15px"><label><?php echo $value['responses']['quantity']; ?></label></td>
                        </tr>
                   
                       
                    
                </table>
                    
                </div>
                
                <div class="right bargainreqrigthe">
                    <table style="width: 200px">
                        <tr>
                            <td><label><strong>Your Selling Price:</strong></label></td>
                            <td><label style="width: 200px">INR <?php echo $value['bargain']['sellPrice']; ?></span></label></label></td>
                        </tr>
						<tr>
                            <td style="alignment-adjust: hanging"><label><strong>Store Name:</strong></label></td>
                            <td><label style="width: 200px"><?php echo $value['bargain']['storeName']; ?></label></td>
                        </tr>
                    <tr>
                            <td><label><strong>Offer:</strong></label></td>
                            <td style="height: 15px"><label>NA</label></td>
                        </tr>
						 <tr>
                            <td><label><strong>Expected Price:</strong></label></td>
                            <td style="height: 15px"><label>INR <?php echo $value['responses'][0]['expectedPrice']; ?></label></td>
                        </tr>
					<tr>
                            <td><label><strong>Customer's Message:</strong></label></td>
                            <td style="height: 15px"><label><?php echo $value['responses'][0]['msg']; ?></label></td>
                        </tr>
                  </table>
                   
                    
                </div>
                
            </div>
			
			
<?php /* responses */ ?>
<div style="display:none;" id="storeResponses_<?php echo $bargainId; ?>">
<?php 
$totResponses=count($value['responses']);
for($i=1; $i<($totResponses); $i++) { ?>
<div class="left bargainreq">
                <div class="left">
                   
                     <table style="width: 300px">
                        <tr>
                            <td style="alignment-adjust: hanging"><label><strong>Product:</strong></label></td>
                            <td><label style="width: 200px"><?php echo $value['bargain']['productName']; ?></label></td>
                        </tr>
						
                        <tr>
                            <td><label><strong>Customer Name:</strong></label></td>
                            <td><label><?php echo $value['bargain']['customerName']; ?></label></td>
                        </tr>
                        <tr>
                            <td><label><strong>Contact Detail:</strong></label></td>
                            <td><label><?php echo $value['bargain']['customer_mobile']; ?></label></td>
                        </tr>
						<tr>
                            <td><label><strong>Expected Quantity:</strong></label></td>
                            <td style="height: 15px"><label><?php echo $value['responses'][$i]['quantity']; ?></label></td>
                        </tr>
                   
                       
                    
                </table>
                    
                </div>
                
                <div class="right bargainreqrigthe">
                    <table style="width: 200px">
                        <tr>
                            <td><label><strong>Your Selling Price:</strong></label></td>
                            <td><label style="width: 200px">INR <?php echo $value['bargain']['sellPrice']; ?></span></label></label></td>
                        </tr>
						<tr>
                            <td style="alignment-adjust: hanging"><label><strong>Store Name:</strong></label></td>
                            <td><label style="width: 200px"><?php echo $value['bargain']['storeName']; ?></label></td>
                        </tr>
                    <tr>
                            <td><label><strong>Offer:</strong></label></td>
                            <td style="height: 15px"><label>NA</label></td>
                        </tr>
						 <tr>
                            <td><label><strong>Expected Price:</strong></label></td>
                            <td style="height: 15px"><label>INR <?php echo $value['responses'][$i]['expectedPrice']; ?></label></td>
                        </tr>
					<tr>
                            <td><label><strong>Customer's Message:</strong></label></td>
                            <td style="height: 15px"><label><?php echo $value['responses'][$i]['msg']; ?></label></td>
                        </tr>
                  </table>
                   
                    
                </div>
                
            </div>
		<?php } ?>
</div>
<?php /* responses end */ ?>
            <div class="space5"></div>
             <div class="right">
                <!--<input type="button" class="btncomman rounded" value="Send Reminder"/>-->
             
                <a href="#quotation" id="quoteBtn_<?php echo $bargainId; ?>" class="quot inline btncomman rounded" value="Send Quotation">Send Offer</a>
               
            </div>
             <a href="javascript:void(0)" class="bargainreqsubarrowd"></a>
            <a href="javascript:void(0)" class="bargainreqsubarrow"></a>
            <div class="bargainreqview proddbox" style="display: none;border-bottom: 0px solid;padding: 0px 0px;">
            <div class="space5"></div>
            <div class="left_row bargaintab">
                 <div class="box">
                     <h3 style="margin-left: 33px"><strong>Customer Requests</strong></h3>
                    </div>
                    <table class="shorttable">
                        <tr>
                            <th width="20px" style="background-color: #FFFFFF;border: 1px solid #ffffff;border-right:1px solid #b5b5b5 "></th>
                            <th width="50%">
                                Customer Message
                            </th>
                            <th width="8%" align="center">
                                Quantity
                            </th>
                            <th width="13%">
                               Expected Price 
                            </th>
                            <th width="13%">
                                Date (Time)
                            </th>
                            <th>
                                Status
                            </th>
                        </tr>
                        <tr>
                            <td>
                                 <input type="radio" class="left" name="bargain"/>
                            </td>
                            <td>
                               
                                <span class="trow left">26 Jan</span>
                            </td>
                            <td >
                                <span class="trow">1</span>
                            </td>
                            
                            <td>
                                <span class="trow left">INR 7000</span>
                              
                            </td>
                            <td>
                                <span class="trow left">26 Jan</span><br/>
                                <span class="trow left">12:43 PM</span> 
                            </td>
                        </tr>
                        <tr class="newbargainreq">
                            <td>
                                 <input type="radio" class="left" name="bargain"/>
                            </td>
                             <td>
                               
                                <span class="trow left">26 Jan</span>
                            </td>
                            <td>
                                <center><span class="trow left">1</span></center>
                            </td>
                            
                            <td>
                                <span class="trow left">INR 7000</span><br/>
                                <span class="trow left">NA</span> 
                            </td>
                            <td>
                                <span class="trow left">26 Jan</span><br/>
                                <span class="trow left">12:43 PM</span> 
                            </td>
                            <td class="active">
                                <span >NEW</span>
                            </td>
                        </tr>
                        
                    </table>
                </div>
            <div class="space10"></div>
           <div class="right">
                
                <a href="#quotation" class="quot inline btncomman rounded" value="Send Quotation">Send Quotation</a>
               
            </div>
            <div class="left_row bargaintab">
                 <div class="box">
                     <h3 style="margin-left: 33px"><strong>Store Quotations</strong></h3>
                    </div>
                    <table class="shorttable">
                        <tr>
                            <th width="20px" style="background-color: #FFFFFF;border: 1px solid #ffffff;border-right:1px solid #b5b5b5 "></th>
                            <th width="50%">
                                Store Message
                            </th>
                            <th width="8%" align="center">
                                Quantity
                            </th>
                            <th width="13%">
                               Offered Price 
                            </th>
                            <th width="13%">
                                Validity 
                            </th>
                            <th>
                                Time
                            </th>
                        </tr>
                        <tr>
                            <td>
                                 <input type="radio" class="left" name="bargain"/>
                            </td>
                            <td>
                               
                                <span class="trow left">26 Jan</span>
                            </td>
                            <td >
                                <span class="trow">1</span>
                            </td>
                            
                            <td>
                                <span class="trow left">INR 7000</span>
                              
                            </td>
                            <td>
                                <span class="trow left">26 Jan</span><br/>
                                <span class="trow left">12:43 PM</span> 
                            </td>
                        </tr>
                        <tr class="newbargainreq">
                            <td>
                                 <input type="radio" class="left" name="bargain"/>
                            </td>
                             <td>
                               
                                <span class="trow left">26 Jan</span>
                            </td>
                            <td>
                                <center><span class="trow left">1</span></center>
                            </td>
                            
                            <td>
                                <span class="trow left">INR 7000</span><br/>
                                <span class="trow left">NA</span> 
                            </td>
                            <td>
                                <span class="trow left">26 Jan</span><br/>
                                <span class="trow left">12:43 PM</span> 
                            </td>
                            <td class="active">
                                <span >NEW</span>
                            </td>
                        </tr>
                        
                    </table>
                </div>
            <div class="space10"></div>
            <div class="right">
               
                <input type="button" class="btncomman rounded" value="Modify"/>
            </div>
            </div>
        </div>
        <?php } ?>
		<div class="space15"></div>
	</div>
    </div>
</div>

<script>
	$(function(){
		$('.quot').click(function(){
			var id1=$(this).attr('id');
			var id2=id1.split('_');
			var id=id2[1];
			
			$("#quote_prodImg").attr('src',$('#bargainImg_'+id).val());
			$("#quote_prodName").html($('#bargainProdName_'+id).val());
			$("#quote_customerName").html($('#bargainCustomerName_'+id).val());
			$("#quote_customerContact").html($('#bargainCustomerContact_'+id).val());
			$("#quote_actualPrice").html($('#bargainActualPrice_'+id).val());
			$("#quote_expectedPrice").html($('#bargainExpectedPrice_'+id).val());
			$("#quote_quantity").html($('#bargainQuantity_'+id).val());
			$("#quote_bargainId").val(id);
			
		});
		
		$(".bargainSubArrow").click(function(){
			var id1=$(this).attr('id');
			var id2=id1.split('_');
			var id=id2[1];
			$('#storeResponses_'+id).toggle();
		});
	});
</script>