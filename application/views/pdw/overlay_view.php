<?php $this->load->view($this->config->item('themeCode')."/login_view"); ?>
<?php $this->load->view($this->config->item('themeCode')."/forgotPassword_view"); ?>
<?php $this->load->view($this->config->item('themeCode')."/signup_view"); ?>
<?php $this->load->view($this->config->item('themeCode')."/shortLogin_view"); ?>

<!-- shot login -->
<!--<div style="display:none;">
    <div id="shotlogin" > 
        <div class="hearderholder">New Customer <span class="smalltextbox"></span></div>
        <div class="signaddright">
            <div class="lightboxcontent">
                <div class="lightboxcontentleft">
                    <form>
                        <div class="frmholder">
                            <label>Mobile Number / Email Address</label>
                            <input type="text" class="inplog"  placeholder="Please provide you Email or Mobile number."/>
                        </div>
                        <p class="italic">
                            This information may be passed to Store to serve you better
                        </p>
                        <div class="space10"></div>
                        <div class="btnholder">
                            <input type="button" class="btnprced" value="PROCEED"  />
                        </div>
                    </form>
                </div>
                <div class="lightboxcontentmid"></div>
                <div class="lightboxcontentright" id="sociallogin">
                    <label>Login Using</label>
                    <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/btfb.jpg" alt=""  /></a>
                    <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/bttw.jpg" alt=""  /></a>
                    <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/btgo.jpg" alt=""  /></a>
                </div>
            </div>
            <div class="lightboxfooter">
                Already have an account?
                <a  href="#signin"  class="btnft inline signininline">Sign IN</a>
                Want to create an account?
                <a  href="#signup"  class="btnft inline signupinline">Sign Up Now</a>
            </div>
        </div>
   </div>
</div>-->
<div style="display:none;">

   <div id="shotlogin" > 

   		<div class="hearderholder">New Customer <span class="smalltextbox"></span></div>

	

        <div class="signaddright">

		<div class="lightboxcontent">

			

        	 <div class="lightboxcontentleft">

             	<!-- <h2>NEW CUSTOMER</h2>

                <p>If you dont thave an accont but want to login quickly.</p> -->

                

                <form>

                	<div class="frmholder">

                	<label>Mobile Number / Email Address</label>

                    <input type="text" class="inplog"  placeholder="Please provide you Email or Mobile number."/>

                    </div>
 <p class="italic">

This information may be passed to Store to serve you better</p> 
                    
                    
<div class="space10"></div>
                    <div class="btnholder">

                    	<input type="button" class="btnprced" value="PROCEED"  />

                    </div>

                    

                </form>

             </div>

             <div class="lightboxcontentmid"></div>

             <div class="lightboxcontentright" id="sociallogin">

			 	<label>Login Using</label>

             <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/btfb.jpg" alt=""  /></a>
                    <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/bttw.jpg" alt=""  /></a>
                    <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>/images/btgo.jpg" alt=""  /></a>

             </div>

			 

        </div>

		<div class="lightboxfooter">

                    Already have an account?    

                    <a  href="#signin"  class="btnft inline signininline">Sign IN</a>
                    Want to create an account?   

                    <a  href="#signup"  class="btnft inline signupinline">Sign Up Now</a>

                </div>

        </div>

   </div>

</div>
<!--Track order-->
<div style="display:none">

   <div id="trackorder" > 

   		<div class="hearderholder">Track Order <span class="smalltextbox"></span></div>

<!--		 <div class="signaddbox">

		 	<table class="signaddtable">

				<tr>

					<td class="whyduniya">WHY PRODUCT DUNIYA?</td>

				</tr>

				<tr>

					<td>

						<img src="images/signicons4.png"  />

						<span class="green">BEST PRICE</span>

					</td>

				</tr>

				<tr>

					<td>

						<img src="images/signicons1.png"  />

						<span class="org">FAST DELIVERY</span>

					</td>

				</tr>

				<tr>

					<td>

						<img src="images/signicons1.png"  />

						<span class="blue">24X7 SERVICE</span>

					</td>

				</tr>

				<tr>

					<td>

						<img src="images/signicons1.png"  />

						<span class="pink">BEST Quality </span>

					</td>

				</tr>

			</table>

		 </div>-->

        <div class="signaddright">

		<div class="lightboxcontent">

<!--			 <p class="italic">Please provide you Email or Mobile number. <br  />

This information may be passed to Store to serve you better</p>-->

        	 <div class="lightboxcontentleft">

<!--             	 <h2>NEW CUSTOMER</h2>

                <p>If you dont thave an accont but want to login quickly.</p> 

                -->

                <form>
                    <table cellpadding="10px" style="height: 100px;">
                        <tr>
                	<td><div class="frmholder">

                	
                            <span class="left" ><input type="radio" name="radiotrack" checked id="email_no"/></span><span class="left"><label>Email Address / Mobile Number</label></span>
                            <div class="left" id="email_text1"><input id="email_text" type="text" class="inplog" placeholder="Enter Email ID or Mobile number used to place the order" /></div>
<!--                    <p class="italic">Enter Email ID or Mobile number used to place the order</p>-->

                            </div></td></tr>
                     <tr><td>   
                    <div class="frmholder">

                        <span class="left" ><input type="radio" name="radiotrack" id="order_id"/></span><span class="left"><label>Order ID</label></span>

                        <div class="left" style="display: none" id="id_text1"><input type="text" class="inplog" id="id_text" placeholder="Enter Order ID to track" /></div>

                    </div></td></tr>
                        </table>
                    
                                
                    <div class="btnholder left_row">

                    	<input type="button" class="btnprced" value="Submit"  />

                    </div>

                            

                </form>

             </div>

             <div class="lightboxcontentmid"></div>

             <div class="lightboxcontentright" id="sociallogin" >

                 <h3><span style="font-family: 'robotomedium'">Sign in and get more option for</span> </h3>

<!--             	<a href="#"><img src="images/btfb.jpg" alt=""  /></a>

                <a href="#"><img src="images/bttw.jpg" alt=""  /></a>

                <a href="#"><img src="images/btgo.jpg" alt=""  /></a>-->
                 <ul style="list-style: circle;margin-left: 30px">
                                    <li>Track Individual Orders</li>
                                    <li>View your entire Order history</li>
                                    <li>Cancel Individual Orders</li>
                                    <li>Conveniently review products and sellers</li>
                                </ul>
                 <div class="btnholder">

                    	<input type="button" class="btnprced" value="Sign in"  />

                    </div>

             </div>

			 

        </div>

		<div class="lightboxfooter" style="clear:both;">

        	Want to create an account?   

            <a  href="#signup"  class="btnft inline signupinline">Sign Up Now</a>

<!--                Already have an account?    

                <a  href="#signin"  class="btnft inline">Sign IN</a>-->

        </div>

        </div>

   </div>

</div>
<!-- Code Sign Up -->
<!--<div style="display:none">

   <div id="signup"> 

   		<div class="hearderholder">SIGN UP</div>

        <div class="lightboxcontent">

        	 <div class="lightboxcontentleft">

             	 <h2>NEW USER</h2>

                <p>If you dont have an account, please sign up.</p> 

                

                <form>

                	<div class="frmholder">

                	<label>Mobile Number / Email Address </label>

                    <input type="text" class="inplog"  />

                    </div>

                    

                     <div class="frmholder">

                    <label>10 digit Mobile Number</label>

                    <input type="text" class="inplog"  />

                    </div> 

                    

                    <div class="frmholder">

                    <label>Password</label>

                    <input type="password" class="inplog"  />

                    </div>

                    

                    <div class="frmholder">

                    <label>Retype Password</label>

                    <input type="password" class="inplog"  />

                    </div>
                    <div class="cell_input">
                         <div class="row">
                             <div class="left_row">
                                 <input type="checkbox" class="inplog"/>
                                </div>
                             <div class="right_row">
                             I have read the <a href="#" style="color: #0000EE">Terms & Conditions </a>and agree to them.
                             </div>
                        </div>
                    </div>

                    

                    <div class="btnholder">

                    	<input type="button" class="btnprced" value="Sign UP"  />

                    </div>

                    

                </form>

             </div>

             <div class="lightboxcontentmid" style="margin-left: 10px;height:200px;"></div>

             <div class="lightboxcontentright" id="sociallogin" style="padding-top:50px;margin-left: 10px;">

			 	 <label>Login Using</label>

             	<a href="#"><img src="images/btfb.jpg" alt=""  /></a>

                <a href="#"><img src="images/bttw.jpg" alt=""  /></a>

                <a href="#"><img src="images/btgo.jpg" alt=""  /></a>

             </div>

        </div>

        <div class="lightboxfooter">
            
               Already have an account?    

            <a  href="#signin"  class="btnft inline signupinline">Sign IN</a>
                
            </div>
        </div>

   </div>-->
<!-- Code Sign in -->
<!--<div style="display:none;">

   <div id="signin"> 

   		<div class="hearderholder">LOGIN</div>

        <div class="lightboxcontent">

        	 <div class="lightboxcontentleft">

             	 <h2>Registered Customer</h2>

                <p>If you already have an account please log in.</p> 

                

                <form>

                	<div class="frmholder">

                	<label>Email Address / Mobile Number</label>

                    <input type="text" class="inplog"  />

                    </div>

                    

                    <div class="frmholder">

                    <label>Password</label>

                    <input type="password" class="inplog"  />

                    </div>

                    

                    <div class="btnholder">

                    	<input type="button" style="float:left;" class="btnprced" value="PROCEED"  />

						

						<a href="#" class="forgetpassword">Forget Password?</a>

                    </div>

                    

                </form>

             </div>

             <div class="lightboxcontentmid"></div>

             <div class="lightboxcontentright" id="sociallogin">

			 	 <label>Login Using</label>

             	<a href="#"><img src="images/btfb.jpg" alt=""  /></a>

                <a href="#"><img src="images/bttw.jpg" alt=""  /></a>

                <a href="#"><img src="images/btgo.jpg" alt=""  /></a>

             </div>

        </div>

        <div class="lightboxfooter">

        	Don't have an account?

            <a href="#signup"  class="btnft inline signupinline">Sign Up Now</a>

        </div>

   </div>

</div>-->
<!-- Code Verification -->
<div style="display:none">

   <div id="verification" > 

   		<div class="hearderholder">USER VERIFICATION <span class="smalltextbox">Please verify your account.</span></div>

        <div class="lightboxcontent">

    

                <!-- <p>Verification link has been send to your registered email address <span class="org">username@gmail.com</span>. Please click on 

link or copy and paste the link into your browser to activate your account and continue shopping with

Product Duniya. </p>

				<p><a href="#" class="und">Click here to change your email address</a></p>

                

                	<div class="lightboxcontentmidbox"><img src="images/rtmid.jpg" alt="" /></div> -->

                    

                <p>Verification Code has been send to your mobile number<span class="org"> +91 1234 12345</span>. Please enter the four digit 

verification code below to complete the process of sign up with product duniya. We will be sure that 

you are not a robot! </p>

				<p><a href="#" class="und">Click here to change your mobile number</a></p>

                

                <form>

                	<div class="frmholder">

                	<label>Verification Code</label>

                    <input type="text" class="inplog"  />

                    </div>

                    

                    

                    

                    <div class="btnholder">

                    	<input type="button" class="btnprced" value="Submit"  />

                    </div>

                    

                </form>             

        </div>

        

   </div>

</div>
<!--Confirmation-->
<div style="display: none">
<div id="remove_conferm"> 
   		<div class="smalloverlayhearder">Confirm<span class="smalltextbox"></span></div>
                <div class="smalloverlay" style="width: 320px">
                    <label>Do you want to remove address from list?</label>
                    <div class="right" style="margin-top: 5px">
                         <input type="button" class="btncomman rounded" style="padding: 2px 5px;text-transform: lowercase;" value="ok"/>
                    <input type="button" class="btncomman rounded" style="padding: 2px 5px;text-transform: lowercase;" value="cancel"/>
                </div>
                </div>
               
   </div>
</div>
<!--update address-->
<div style="display: none">
<div id="update_panel"> 
   		<div class="hearderholder">Update Address<span class="smalltextbox"></span></div>
                <div class="lightboxcontent">
                    <div class="row">
                        <div class="left" style="width: 290px">
				<div class="cell_input">
					 <label>Name</label> 
					 <input type="text" value=""/> 
				</div>
				<div class="cell_input">
					 <label>Phone Number</label> 
					 <input type="text" value=""/> 
				</div>
				<div class="cell_input">
					 <label>Landmark</label> 
					 <input type="text" value=""/> 
				</div>
				<div class="cell_input">
					 <label>City</label> 
					 <input type="text" value=""/> 
				</div>
			  	<div class="cell_input">
					 <label>State</label> 
					 <select>
					 <option>select</option>
					 <option>select</option>
					 <option>select</option>
					 <option>select</option>
					 </select>
				</div>
				
			</div> 
                        <div class="right">
				<div class="cell_textaria">
					<label>Street Address</label> 	
					<textarea></textarea>
					<span class="note">( Maximum Limit: 216 characters )</span>
				</div>
				<div class="cell_textaria">
					<label>Pincode / Zipcode</label> 	
					<input type="text" value=""/>
					
                                </div>
                            <div class="cell_textaria">
					 <label>Country</label> 
                                         <span class=""><strong>India</strong> ( Service available only in india )</span>
				</div>
                            <!--<div class="space50"></div>-->
                                <div class="space20"></div>
				<div class="btnaddress right">
	<input type="button" class="btncomman rounded" value="save">
	<input type="button" class="btncomman rounded btncancel" value="clear">
	</div>
				
			</div>
                    </div>
                </div>
                </div>
               
   </div>
<!--store review-->
<div style="display: none">
<div id="review_order"> 
   		<div class="hearderholder">Store Review<span class="smalltextbox"></span></div>
                <div class="lightboxcontent">
                   
<!--                        <div class="cell_input">
                            <label><b>Order Id :</b></label>
                            <p>0D68846354393</p>
                        </div> -->
                        <div class="cell_textaria">
                            <label>Store Name </label>
                            <p >Croma, Viman Nagar, Pune</p>
                        </div>
                        <div class="cell_textaria">
                            <label>Rating </label>
                       <p> <span class="productstarholder">
                            <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>images/star.jpg" /></a>
                            <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>images/star.jpg" /></a>
                            <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>images/star.jpg" /></a>
                            <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>images/star.jpg" /></a>
                           </span></p>
                        </div>
                        <div class="cell_textaria">
                            <label>Review</label>
                            <textarea></textarea>
                        </div>
                        <div class="space15"></div>
                        <div class="right">
                            <input type="button" class="btncomman rounded" value="Save"/>
                        </div>
              
                </div>
                </div>
               
   </div>
<!--product review-->
<div style="display: none">
<div id="product_review"> 
   		<div class="hearderholder">Product Review<span class="smalltextbox"></span></div>
                <div class="lightboxcontent">
                   
<!--                        <div class="cell_input">
                            <label><b>Order Id :</b></label>
                            <p>0D68846354393</p>
                        </div> -->
                        <div class="cell_textaria">
                            <label>Product Name </label>
                            <p>HP Laptop 67AZ (White)</p>
                        </div>
                        <div class="cell_textaria">
                            <label>Rating </label>
                       <p> <span class="productstarholder">
                            <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>images/star.jpg" /></a>
                            <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>images/star.jpg" /></a>
                            <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>images/star.jpg" /></a>
                            <a href="#"><img src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>images/star.jpg" /></a>
                           </span></p>
                        </div>
                        <div class="cell_textaria">
                            <label>Review</label>
                            <textarea></textarea>
                        </div>
                        <div class="space15"></div>
                        <div class="right">
                            <input type="button" class="btncomman rounded" value="Save"/>
                        </div>
              
                </div>
                </div>
               
   </div>
<!--bargain overlay-->
        <div style="display: none">
<div id="bargainreq"> 
   		<div class="hearderholder">Bargain<span class="smalltextbox"></span></div>
                <div class="lightboxcontent" style="padding: 0px 0px">
                    <div class="leftwarp bargainproddetail">
                        <ul>
                            <li><span class="imgbox">
                                     <a href="#">
                                         <img alt="" src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('themeCode'); ?>images/thumb2.jpg" style="border: 2px solid #bfbfbf"></img>
                                     </a>
                                </span>
                            </li>
                        </ul>
                        <div class="bargaindetailleft">
                        <div class="cell_textaria">
                            <label><b>Product</b></label>
                            <label>Lava XOLO Q800v (BLACK)</label>
                        </div>
                        <div class="cell_textaria">
                            <label><b>Store</b></label>
                            <label>Croma, Viman Nagar, Pune</label>
                        </div>
                        <div class="cell_textaria">
                            <label><b>Actual Price</b></label>
                            <label>INR 8000</label>
                        </div>
                        <div class="cell_textaria">
                            <label><b>Offer</b></label>
                            <label>Yes</label>
                             
                        </div>
                        </div>
                        </div>
                    <div class="right">
                        <div class="bargaindetailright">
                            <div class="left">
                                <div class="cell_textaria">
                                    <label>Expected Bargained Price <span style="color: #bab7b7;">(Per Unit)</span></label>
                                    <input type="text" name="bargainprice"/>
                                </div>
                                <div class="space10"></div>
                                <div class="cell_textaria">
                                    <label>Shipping Pincode <span style="color: #bab7b7;">(Pune)</span></label>
                                    <input type="text" name="bargainprice"/>
                                </div>
                            </div>
                            <div class="right" style="margin-left: 15px">
                                <div class="cell_textaria">
                                    <label>Quantity <span style="color: #bab7b7;">(In Units)</span></label>
                                    <input type="text" name="bargainprice" style="width: 110px"/>
                                </div>
                                <div class="space10"></div>
                                <div class="cell_textaria">
                                    <label>Mobile No <span style="color: #bab7b7;">(Verify)</span></label>
                                    <input type="text" name="bargainprice" style="width: 110px"/>
                                    <label><a href="#" class="right">Change</a></label>
                                </div>
                            </div>
                        
                        <div class="cell_textaria">
                            <label>Comment <span style="color: #bab7b7;">(Optional)</span></label>
                            <textarea style="width: 410px;height: 100px"></textarea>
                        </div>
                            <div class="space20"></div>
                            <div class="right">
                            <input type="button" class="btncomman rounded" value="Save"/>
                        </div>
                      </div>
                    </div>
                </div>
</div>
                
               
   </div>