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
        <?php $this->load->view($this->config->item('themeCode') . "/account_left_section_view", $data); ?>

	<!-- Right Warp -->  
    <div class="rightwarp">
        <ul class="breadcrumbs">
		<li><a href="#">Home</a></li>
		<li class="divder">�</li>
		<li>My Bargains</li>
	</ul>
        <div class="subheadingholder nonmargin">
    	<h2>My Bargains</h2>
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
                                <td>
				Store
				<select style="width: 80px">
					<option>Unread</option>
					<option>Read</option>
                                        <option>Mostly Bargained</option>
				</select>
				</td>
                            <td style="width: 32%">
                                <label for="from">From</label>
                                    <input type="text" id="from" name="from"  placeholder='mm/dd/yyyy'/>
                                    <label for="to">To</label>
                                    <input type="text" id="to" name="to" placeholder='mm/dd/yyyy'/></td>
			</tr>
		</table>		
	</div>
        <div class="space15"></div>
        
        <?php 
       // var_dump($master); 
		foreach ($master as $bargainId => $value) {   ?>
        <div class="proddbox">
                        
            <div class="left bargainreqimg">
                <img src="<?php echo base_url().$this->config->item('productImgPath').$value['bargain']['productImg']; ?>" width="90px"/>
                </div>
            
           
            <div class="left bargainreq" style="margin-left: 15px">
                <div class="left">
                    <table style="width: 350px;">
                        <tr>
                            <td style="alignment-adjust: hanging"><label><strong>Product:</strong></label></td>
                            <td><label style="width: 200px"><?php echo  $value['bargain']['productName'] ;?></label></td>
                        </tr>
                        <tr>
                            <td><label><strong>Store Name:</strong></label></td>
                            <td><label><?php echo  $value['bargain']['storeName'] ; ?></label></td>
                        </tr>
                        <tr>
                            <td><label><strong>Store Contact Person:</strong></label></td>
                            <td><label><?php echo  $value['bargain']['storeContactPerson'] ;  ?></label></td>
                        </tr>
                   
                        <tr>
                            <td><label><strong>Store Contact Detail:</strong></label></td>
                            <td><label><?php echo  $value['bargain']['storeMobile'] ;  ?></label></td>
                        </tr>
                        
                    
                </table>
                    
                </div>
                
                <div class="right bargainreqrigthe">
                   
                    <table style="width: 150px">
                        <tr>
                            <td><label><strong>Actual Price:</strong></label></td>
                            <td><label style="width: 200px">INR <?php  echo  $value['bargain']['productMRP'];  ?></span></label></label></td>
                        </tr>
                    <tr>
                            <td><label><strong>Offer:</strong></label></td>
                            <td style="height: 15px"><label><?php  echo  $value['offer'] ; ?></label></td>
                        </tr>
                  </table>
                   
                    
                </div>
                
            </div>
            <div class="space20"></div>
            <div class="left" style="padding: 6px 30px;margin-left: 16px"><span class="reply">Reply: <?php echo count($response)  ?></span></div>
            <div class="right">
               
                <input type="button" class="btncomman rounded" value="Send Reminder"/>
                <a href="javascript:void(0)" class="rounded right btncommanpe">Buy</a>
            </div>
            
             <a href="javascript:void(0)" class="bargainSubArrow" id="bargainSubArrow_<?php echo $bargainId; ?>"></a>
            <a href="javascript:void(0)" class="bargainsubarrow"></a>
            <div class="bargainview proddbox" id="storeResponses_<?php echo $bargainId; ?>" style="display: none;border-bottom: 0px solid;padding: 0px 0px;">
            <div class="space5"></div>
               <div class="left_row bargaintab">
                 <div class="box">
                     <h3 style="margin-left: 33px"><strong>Store Quotations</strong></h3>
                    </div>
                    <table class="shorttable" style="border-left: 0px solid">
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
                        
                         <?php   
						 
						 foreach ($value['store'] as $Id => $val) { ?>
                       <tr class="newbargainreq">
                            <td style="border:1px solid #fff;background-color: white;border-right: 1px solid #d9d9d9">
                                 <input type="radio" class="left" name="bargain"/>
                            </td>
                            <td>
                               
                                <span class="trow left"><?php  echo  $val['msg'];  ?></span>
                            </td>
                            <td>
                                <span class="trow"><?php  echo  $val['quantity'];  ?></span>
                            </td>
                            <td>
                                <span class="trow left">INR  <?php  echo  $val['offer_price'];  ?></span>
                              
                            </td>
                            <td>
                                <span class="trow left"> <?php  echo  $val['validity_date'];  ?></span>
                            </td>
                            <td>                         
                                <span class="trow left"><?php  echo  $val['added_time']; ?></span> 
                            </td>
                        </tr>
                         <?php   } ?> 
 
                        
                    </table>
                </div>
            <div class="space10"></div>
            <div class="right">
               
                <input type="button" class="btncomman rounded bargain_req inline" value="Buy"/>
            </div>
            <div class="right_row bargaintab" style="width: 716px">
                 <div class="box">
                     <h3 ><strong>My Requests</strong></h3>
                    </div>
                <div class="space5"></div>
                   
                <div class="proddbox" style="background-color: #fff;border: 1px solid #B5B5B5">
                    <div class="left msg">
                        <label><b>My Message</b></label>
                        <table>
                            <tr>
                                <td>
                                    <p><?php echo $value['customer_msg'];?></p>
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                    
                    <div class="right">
                        <div class="left">
                    <div class="left mybargain">
                        <label><b>Quantity</b></label><br/>
                        <label><?php echo $value['quantity'];?> pcs</label>
                    </div>
                            <div class="space5"></div>
                    <div class="mybargain">
                        <label><b>Expected Price</b></label><br/>
                        <label>INR <?php echo $value['expectedPrice'];?></label>
                    </div>
                        </div>
                        <div class="right">
                    <div class="left mybargain">
                        <label><b>Status</b></label><br/>
                        <label><?php echo $value['status'];?></label>
                    </div>
                            <div class="space5"></div>
                        <div class="mybargain">
                        <label><b>Date(Time)</b></label><br/>
                        <label><?php echo $value['request_time'];?></label>
                    </div>
                        </div>
                    </div>
                </div>

                </div>
            <div class="space10"></div>
           <div class="right">
             	<?php $overlay_name='modify'.$value['bargainId'];?>
                <a href="#<?php echo $overlay_name; ?>" class="btncomman rounded bargain_req inline" value="Modify">Modify</a>
               <?php //echo $overlay_name;?>
            </div>
         
            </div>
            
            <!--    SCRIPT AND VALIDATION FOR EACH FORM WHICH CREATE DYNAMITICALLY -->
                    <script type="text/javascript">
;(function($) { 
$(document).ready(function() {
	<?php $form_name="frm".$value['bargainId'];?>
	$("#<?php echo $form_name;?>").validate({
		rules: {
			bargainprice: {
				required: true,
                number:true                
			},
            shippingPincode: {
				required: true,
                number:true,
                minlength:6,
                maxlength:6               
			},
            quantity: {
				required: true,
                number:true,
                minlength:1,
                maxlength:3         
			},
            mobile: {
				required: true,
                minlength:10,
                maxlength:10            
			}
                      
		},errorElement: "div",
		messages: {
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(){
			xajax_modifyBargain(xajax.getFormValues('<?php echo $form_name;?>'));
		}
		
	});	
});
})(jQuery); 

</script>
            
            <!-- -----END OF SCRIPT -->
       <!-- modify overlay -->
           <div style="display: none">
        
		<div id="<?php echo $overlay_name;?>"> 
   		<div class="hearderholder">Modify Your Bargain Request<span class="smalltextbox"></span></div>
                <div class="lightboxcontent" style="padding: 0px 0px">
                    <div class="leftwarp bargainproddetail">
                  
                        <ul>
                            <li><span class="imgbox">
                                     <a href="#">
                                         <img alt="" src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/thumb2.jpg" style="border: 2px solid #bfbfbf"></img>
                                     </a>
                                </span>
                            </li>
                        </ul>
                        <div class="bargaindetailleft">
                        <div class="cell_textaria">
                            <label><b>Product</b></label>
                            <label><?php echo  $value['PName'] ;?></label>
                        </div>
                        <div class="cell_textaria">
                            <label><b>Store</b></label>
                            <label><?php echo  $value['SName'] ; ?></label>
                        </div>
                        <div class="cell_textaria">
                            <label><b>Actual Price</b></label>
                            <label><?php echo $value['ActualPrice']; ?></label>
                        </div>
                        <div class="cell_textaria">
                            <label><b>Offer</b></label>
                            <label><?php echo $value['offer']; ?></label>
                             
                        </div>
                        </div>
                       
                        </div>
                    <div class="right">
                        <div class="bargaindetailright">
                           <form name="<?php echo $form_name?>" id="<?php echo $form_name;?>">
                            <div class="left">
                                <div class="cell_textaria">
                                    <label>Expected Bargain Price <span style="color: #bab7b7;">(Per Unit)</span></label>
                                    <input type="text" name="bargainprice" id="bargainprice" value="<?php echo $value['expectedPrice'];?>"/>
                                    <input type="hidden" name="bargainid" value="<?php echo $value['bargainId']; ?>"/>
                                    <input type="hidden" name="custreqid" value="<?php echo $value['customer_requestId']?>"/>
                                </div>
                                <div class="space10"></div>
                                <div class="cell_textaria">
                                    <label>Shipping Pincode <span style="color: #bab7b7;">(Pune)</span></label>
                                    <input type="text" name="shippingPincode"id="shippingPincode" value="<?php echo $value['shipping_pinCode'];?>"/>
                                </div>
                            </div>
                            <div class="right" style="margin-left: 15px">
                                <div class="cell_textaria">
                                    <label>Quantity <span style="color: #bab7b7;">(In Units)</span></label>
                                    <input type="text" name="quantity" value="<?php echo $value['quantity'];?>" id="quantity" style="width: 110px"/>
                                </div>
                                <div class="space10"></div>
                                <div class="cell_textaria">
                                    <label>Mobile No <span style="color: #bab7b7;">(Verify)</span></label>
                                    <input type="text" name="mobile" id="mobile" value="<?php  echo $value['customer_mobile'];?>" style="width: 110px"/>
                                    <label><a href="#" class="right">Change</a></label>
                                </div>
                            </div>
                        
                        <div class="cell_textaria">
                            <label>Comment <span style="color: #bab7b7;">(Optional)</span></label>
                            <textarea name="comment" id="comment"style="width: 410px;height: 100px"><?php echo $value['customer_msg'];?></textarea>
                        </div>
                            <div class="space20"></div>
                            <div class="right">
                            <input type="submit" class="btnprced" value="Save"/>
                        </div>
                            </form>
                      </div>
                    </div>
                </div>
                </div>
                
</div>
       
       <!-- end of modify overlay -->     
            
            
       
           
        </div>
        
        
        <?php }?>

               
        
		<div class="space15"></div>
	</div>
    </div>
</div>
<script>
	$(function(){
	$(".bargainSubArrow").click(function(){
			var id1=$(this).attr('id');
			var id2=id1.split('_');
			var id=id2[1];
			$('#storeResponses_'+id).toggle();
		});
	});
</script>