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
		<li class="divder">»</li>
		<li>Bargain Request</li>
		
	</ul>
	<?php //var_dump($master);
          // var_dump($storeResp);
           //var_dump($storeResp);    
        ?>
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
        <?php  foreach ($master as $bargainId => $value) {   
		//var_dump($value);
		?>
        <input type="hidden" name="bargainImg_<?php echo $bargainId; ?>" id="bargainImg_<?php echo $bargainId; ?>" value="<?php echo base_url().$this->config->item('productImgPath').$value['bargain']['productImg']; ?>" />
		<input type="hidden" name="bargainProdName_<?php echo $bargainId; ?>" id="bargainProdName_<?php echo $bargainId; ?>" value="<?php echo $value['bargain']['productName']; ?>" />
		<input type="hidden" name="bargainCustomerName_<?php echo $bargainId; ?>" id="bargainCustomerName_<?php echo $bargainId; ?>" value="<?php echo $value['customerName']; ?>" />
		<input type="hidden" name="bargainCustomerContact_<?php echo $bargainId; ?>" id="bargainCustomerContact_<?php echo $bargainId; ?>" value="<?php echo $value['customer_mobile']; ?>" />
		<input type="hidden" name="bargainActualPrice_<?php echo $bargainId; ?>" id="bargainActualPrice_<?php echo $bargainId; ?>" value="<?php echo $value['sellPrice']; ?>" />
		<input type="hidden" name="bargainExpectedPrice_<?php echo $bargainId; ?>" id="bargainExpectedPrice_<?php echo $bargainId; ?>"  value="<?php echo $value['expectedPrice']; ?>" />
		<input type="hidden" name="bargainQuantity_<?php echo $bargainId; ?>" id="bargainQuantity_<?php echo $bargainId; ?>"  value="<?php echo $value['quantity']; ?>" />
        <div class="proddbox">
                        
                <div class="left bargainreqimg">
                <img src="<?php echo base_url().$this->config->item('productImgPath').$value['bargain']['productImg']; ?>"  width="90px"/>
                </div>
           
            <div class="left bargainreq">
                <div class="left">
                   
                     <table style="width: 300px">
                        <tr>
                            <td style="alignment-adjust: hanging"><label><strong>Product:</strong></label></td>
                            <td><label style="width: 200px"><?php echo  $value['bargain']['productName'] ; ?></label></td>
                        </tr>
                        <tr>
                            <td><label><strong>Customer Name:</strong></label></td>
                            <td><label><?php echo  $value['bargain']['customerName'] ; ?></label></td>
                        </tr>
                        <tr>
                            <td><label><strong>Contact Detail:</strong></label></td>
                            <td><label><?php echo  $value['bargain']['customer_mobile'] ; ?></label></td>
                        </tr>
                   
                       
                    
                </table>
                    
                </div>
                
                <div class="right bargainreqrigthe">
                    <table style="width: 200px">
                        <tr>
                            <td><label><strong>Actual Price:</strong></label></td>
                            <td><label style="width: 200px">INR <?php echo  $value['bargain']['productMRP'] ; ?></span></label></label></td>
                        </tr>
                    <tr>
                            <td><label><strong>Offer:</strong></label></td>
                            <td style="height: 15px"><label><?php echo  $value['offer_price'] ; ?></label></td>
                        </tr>
                  </table>
                   
                    
                </div>
                
            </div>
            <div class="space20"></div>
            <div class="left" style="padding: 6px 30px;margin-left: 16px"><span class="reply">Reminder: 0</span></div>
             <div class="right">
                <input type="button" class="btncomman rounded" value="Send Reminder"/>
             	<?php $overlay_name='quotation'.$bargainId;?>
                <a href="#quotation" class="quot inline btncomman rounded" id="quoteBtn_<?php echo $bargainId; ?>" value="Create Quotation">Create Quotation 1</a><?php //echo $overlay_name;?>
               
            </div>
             <a href="javascript:void(0)" class="bargainSubArrow" id="bargainSubArrow_<?php echo $bargainId; ?>"></a>
            <a href="javascript:void(0)" class="bargainreqsubarrow"></a>
            <div id="storeResponses_<?php echo $bargainId; ?>" class="bargainreqview proddbox" style="display: none;border-bottom: 0px solid;padding: 0px 0px;">
            <div class="space5"></div>
            <div class="left_row bargaintab">
                 <div class="box">
                     <h3 style="margin-left: 33px"><strong>Customer Requests</strong></h3>
                    </div>
                    <table class="shorttable">
                        <tr>
                             
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
                        <?php  foreach ($value['responses'] as $Id => $CustReqValue) {   ?>
                        <tr>
                             
                            <td>
                               
                                <span class="trow left"><?php echo  $CustReqValue['msg'] ; ?></span>
                            </td>
                            <td >
                                <span class="trow"><?php echo  $CustReqValue['quantity'] ; ?></span>
                            </td>
                            
                            <td>
                                <span class="trow left">INR <?php echo  $CustReqValue['expectedPrice'] ; ?></span>
                              
                            </td>
                            <td>
                                <span class="trow left"></span><br/>
                                <span class="trow left"><?php echo  $CustReqValue['storeResponse_time'];?></span> 
                            </td>
                            <td> <span class="trow"><?php echo  $CustReqValue['Status'] ; ?></span>
                            </td>
                        </tr>
                         
                        <?php }?>
                    </table>
                </div>
            <div class="space10"></div>
           <div class="right">
                
                <a href="#<?php echo $overlay_name; ?>" class="quot inline btncomman rounded" value="Create Quotation">Create Quotation 2</a><?php echo $overlay_name;?>
               
            </div>
             <!-- --quotation overlay -->
            <div style="display: none">
			<div id="<?php echo $overlay_name; ?>"> 
   			<div class="hearderholder">Send Quotation<span class="smalltextbox"></span></div>
                <div class="lightboxcontent" style="padding: 0px 0px">
                    <div class="leftwarp bargainproddetail">
                        <ul>
                            <li><span class="imgbox">
                                     <a href="#">
                                         <img alt="" src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/automobile4.jpg" style="border: 2px solid #bfbfbf"></img>
                                     </a>
                                </span>
                            </li>
                        </ul>
                        <div class="bargaindetailleft">
                        <div class="cell_textaria">
                            <label><b>Product pname</b></label>
                            <label><?php echo  $value['PName'] ; ?></label>
                        </div>
                        <div class="cell_textaria">
                            <label><b>Customer Name</b></label>
                            <label><?php echo  $value['CName'] ; ?></label>
                        </div>
                             <div class="cell_textaria">
                            <label><b>Customer Contact</b></label>
                            <label><?php echo  $value['ContactNo'] ; ?></label>
                             
                        </div>
                        <div class="cell_textaria">
                            <label><b>Actual Price</b></label>
                            <label>INR<?php echo  '   '.$value['ActualPrice'] ; ?></label>
                        </div>
                       
                        </div>
                        </div>
                    <div class="right">
         `               <div class="bargaindetailright">
         					<?php $form_name="frm".$value['bargainId'];?>
         					<form name="<?php echo $form_name?>" id="<?php echo $form_name;?>">
                            <div class="left">
                                <div class="cell_textaria">
                                
                                    <label>Offered Price <span style="color: #bab7b7;">(Per Unit)</span></label>
                                    <input type="text" name="offerprice" id="offerprice"/>
                                    <input type="hidden" name="bargainId" value="<?php echo $value['bargainId']; ?>"/>
                                    <input type="hidden" name="cust_reqId" value="<?php echo $value['customer_requestId']; ?>"/>
                                </div>
                                <div class="space10"></div>
                                <div class="cell_textaria">
                                    <label>Valid Upto <span style="color: #bab7b7;">(Quotation)</span></label>
                                    <input type="text" name="redate" id="datepicker"/>
                                </div>
                            </div>
                            <div class="right" style="margin-left: 15px">
                                <div class="cell_textaria">
                                    <label>Quantity <span style="color: #bab7b7;">(In Units)</span></label>
                                    <input type="text" name="quantity" id="quantity" style="width: 110px"/>
                                </div>
                                <div class="space10"></div>
                               
                            </div>
                        
                        <div class="cell_textaria">
                            <label>Comment <span style="color: #bab7b7;">(Optional)</span></label>
                            <textarea style="width: 410px;height: 130px" name="comment" id="comment"></textarea>
                        </div>
                            <div class="space20"></div>
                            <div class="right">
                           <!--  a href="#quotation" class="quot inline btncomman rounded" value="Send Quotation">Save</a-->
                            
                           <input type="submit"  class="btnprced" value="SEND"/>
                        </div>
                        </form>
                      </div>
                    </div>
                </div>
</div>
                
               
   </div>
   
            <!-- --end of quotation overlay -->
            <div class="left_row bargaintab">
                 <div class="box">
                     <h3 style="margin-left: 33px"><strong>Store Quotations</strong></h3>
                    </div>
                    <form name="selected_radio" id="selected_radio">
                    <table class="shorttable">
                        <tr>
                            <!--  th width="20px" align="center" style="background-color: #FFFFFF;border: 1px solid #ffffff;border-right:1px solid #b5b5b5 ">select</th-->
                           <th width="3%">
                                Select
                            </th>
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
                       	
                         <?php 
                         $storeResForOverlay=$storeResp;
                         
                         
                         foreach ($value['store'] as $Id => $storeRespValue) {   ?>
                         
                             
                        <tr>
                            <td>
                                 <?php 
                                 		
                                 echo  $storeRespValue['store_responseId']; ?>
                                 <input type="radio" value="<?php echo  $storeRespValue['store_responseId']; ?>" name="select_rad" class="left"/>
                            </td>
                            <td>
                               
                                <span class="trow left"><?php echo  $storeRespValue['msg'] ; ?></span>
                            </td>
                            <td >
                                <span class="trow"><?php echo  $storeRespValue['quantity'] ; ?></span>
                            </td>
                            
                            <td>
                                <span class="trow left">INR <?php echo  $storeRespValue['offer_price'] ; ?></span>
                              
                            </td>
                            <td>
                                <span class="trow left"><?php echo  $storeRespValue['validity_date'] ; ?></span></td>
                             <td>   <span class="trow left"><?php echo  $storeRespValue['added_time'];?></span> 
                            </td>
                        </tr>
                          <?php   }  ?>
                          </table>
                          <div class="space10"></div>
           				  <div class="right">
           				  <div id="message" class="message"></div>
                          <input type="submit" class="" value="Modify"/>
                          </div>
                          </form>
                    
                </div>
                   
            
               
                
            </div>
            </div>
			<?php } ?>
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
			var cPosition=$(this).css('background-position');
			if(cPosition=='0px 0px') 
			$(this).css('background-position','0px -90px');
			else 
			$(this).css('background-position','0px 0px');
			var id1=$(this).attr('id');
			var id2=id1.split('_');
			var id=id2[1];
			$('#storeResponses_'+id).toggle();
		});
	});
</script>