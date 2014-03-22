<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include 'links.php';?>
        <link href="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/css/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css" />
    </head>
<body>
<!-- Header -->
  
<!-- Main -->  
<div id="main">
	<div class="mainholder">
    <div class="add">
       <ul>
         <li> <img src="images/add1.jpg" alt=""></li>
       </ul>
    </div>
	<!-- Left Warp --> 
        <?php include 'leftprofilemenu.php';?>
	
	
	<!-- Right Warp -->  
    <div class="rightwarp">
        <ul class="breadcrumbs">
		<li><a href="#">Home</a></li>
		<li class="divder">»</li>
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
        
        
        <div class="proddbox">
                        
                <div class="left bargainreqimg">
                <img src="images/lava_img1.jpg" height="90px" width="90px"/>
                </div>
           
            <div class="left bargainreq">
                <div class="left">
                   
                     <table style="width: 300px">
                        <tr>
                            <td style="alignment-adjust: hanging"><label><strong>Product:</strong></label></td>
                            <td><label style="width: 200px">Nokia</label></td>
                        </tr>
                        <tr>
                            <td><label><strong>Customer Name:</strong></label></td>
                            <td><label>Pravinkumar</label></td>
                        </tr>
                        <tr>
                            <td><label><strong>Contact Detail:</strong></label></td>
                            <td><label>7507546002</label></td>
                        </tr>
                   
                       
                    
                </table>
                    
                </div>
                
                <div class="right bargainreqrigthe">
                    <table style="width: 200px">
                        <tr>
                            <td><label><strong>Actual Price:</strong></label></td>
                            <td><label style="width: 200px">INR 6000</span></label></label></td>
                        </tr>
                    <tr>
                            <td><label><strong>Offer:</strong></label></td>
                            <td style="height: 15px"><label>NA</label></td>
                        </tr>
                  </table>
                   
                    
                </div>
                
            </div>
            <div class="space5"></div>
             <div class="right">
                <input type="button" class="btncomman rounded" value="Send Reminder"/>
             
                <a href="#quotation" class="quot inline btncomman rounded" value="Send Quotation">Send Quotation</a>
               
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
		<div class="space15"></div>
	</div>
  </div>
 </div>
 
<!-- Footer -->  
<?php include 'footer.php';?>
</body>
</html>
