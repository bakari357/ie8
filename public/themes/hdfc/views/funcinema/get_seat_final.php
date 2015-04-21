<style> 
.login{
 color: #333333 !important; 
 font-size:24px !important; 
 width: auto !important; 
 font-family: "Open Sans" !important;
 margin-top: 14px !important; 
 padding: aas !important;  
 float: none !important; 
}
</style>
<!-- END OF CONTENT -->
<script src="themes/hdfc/assets/assets/js/jquery.validate.js"></script>
<script>
$(document).ready(function() {
$('.emi_details').hide();
	


$.validator.addMethod("falpha", function(value, element) {
return this.optional(element) || /^[a-z\-\s]+$/i.test(value);
},  "Name field must contain only letters");
$.validator.addMethod("lalpha", function(value, element) {
return this.optional(element) || /^[a-z\-\s]+$/i.test(value);
},  "Last name field must contain only letters");

		$("#passenger_checkout").validate({

		rules: {
		first_name : {
		required: {depends:function(){$(this).val($.trim($(this).val()));return true;}},
		falpha:true
		},
		last_name : {
		required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
		falpha:true
		},
		mobile : {
		required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

		},        
                s_email : {
		required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
		email:true	
		    },},
		messages: {
		email: { 
		required: "This field is required.",
		email: "Please Enter a Valid Email-Address."
		}
		},
		submitHandler: function(frm) {


		if(point==0 && cash==0)
		{
		$("#perror").css('display','block');

		return false;
		}
		else
		{
		frm.submit();
		$("#submit").css('display','none');
		return true;
		}
		}
});

		


});
</script>	
<link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/style.css"> 	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					   <li><?php echo HTML::link('cinemas', 'Movies'); ?></li>
					<li>/</li>
					<li><a href="#">Summary</a></li>
					<li>/</li>					
					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		
	</div>	
<form method="post" action="<?php echo $url = URL::action('Checkout@checkout_process'); ?>" onsubmit="return term_condition();" accept-charset="UTF-8" >
	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt8 offset-0">
			
			
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					



<input name="ctype" type="hidden" id="ctype" value="movie2" />
    <input name="Center" type="hidden" id="Center" value="<?php if(isset($post['Center'])) echo  $post['Center']; ?>" />
     <input type="hidden" id="Screen" name="Screen" value="<?php  if(isset($post['Screen'])) echo $post['Screen'] ; ?>" />
     <input type="hidden" id="Movie" name="Movie" value="<?php  if(isset($post['Movie'])) echo $post['Movie'] ; ?>"  />
     <input type="hidden" id="ShowTime" name="ShowTime" value="<?php  if(isset($post['ShowTime'])) echo $post['ShowTime'] ; ?>"/>
     <input type="hidden" id="FinishTime" name="FinishTime" value="<?php  if(isset($post['FinishTime'])) echo $post['FinishTime'] ; ?>" />
     <input type="hidden" id="order_id" name="order_id" value="<?php if(isset($post['order_id'])) echo($post['order_id']) ; ?>" />
     <input type="hidden" id="bookingid" name="bookingid" value="<?php if(isset($post['bookingid'])) print_r($post['bookingid']) ; ?>" />
     <input type="hidden" id="rowid" name="rowid" value="<?php  if(isset($post['rowid'])) echo $post['rowid']; ?>"/>
     
    <input type="hidden" id="gridseatnum" name="gridseatnum" value="<?php  if(isset($post['gridseatnum'])) echo $post['gridseatnum']; ?>"/> 
        <input type="hidden" id="area" name="area" value="<?php  if(isset($post['area'])) echo $post['area']; ?>"/>
        <input type="hidden" id="areanum" name="areanum" value="<?php  if(isset($post['areanum'])) echo $post['areanum']; ?>"/>
      
        
      <input type="hidden" id="seatstatus" name="seatstatus" value="<?php  if(isset($post['seatstatus'])) echo $post['seatstatus']; ?>"/> 

     <input name="QTY" type="hidden" id="QTY" value="<?php if(isset($post['QTY']) ) echo $post['QTY'];?>"/>
     <input name="Class" type="hidden" id="Class" value="<?php if(isset($post['Class']) ) echo $post['Class'];?>"/>
     <input type="hidden" id="TicketPrice" name="TicketPrice" value="<?php  if(isset($post['TicketPrice'])) echo $post['TicketPrice'] ; ?>" />
<input type="hidden" id="TicketPrice" name="amount" value="<?php  if(isset($post['total'])) echo round($post['total']) ; ?>" />
     <input type="hidden" value="<?php  if(isset($post['service_fee'])) echo $post['service_fee']; ?>" name="service_fee" id="service_fee" />
    
     <input type="hidden" name="seatcount" id="seatcount" value="0" />
     <input name="seats" type="hidden" id="seats" />
     <input name="tax" type="hidden" id="tax" />
     <input type="hidden" id="total" name="total" />

       
      
    


						<!-- End of seat layout -->
				
					<br/>
					<br/>


<span class="size16px bold dark left">Where can we reach you?</span>
					<div class="roundstep right">1</div>
					<div class="clearfix"></div>
					<div class="line4"></div>		
					<div class="col-md-4">
						<span class="dark">First Name:</span>
						&nbsp;&nbsp;<?php echo $post['first_name']; ?><input type="hidden" name="first_name" id="firstName"class="form-control " placeholder="" value="<?php echo $post['first_name']; ?>">
					</div>
					<div class="col-md-4 textleft">
					<span class="dark">Last Name:</span>
						&nbsp;&nbsp;<?php echo $post['last_name']; ?><input type="hidden" name="last_name" id="lastName" class="form-control " placeholder="" value="<?php echo $post['last_name']; ?>">
					</div>
					
					<div>
					
					
					
					<div class="col-md-8 textright">
						<div class="mt15"><span class="dark" style="float: left;">Email Address:</span><span style="float: left;"> &nbsp;&nbsp;<?php echo $post['s_email']; ?><span></div>
					</div>
					<div class="col-md-4">
						<input type="hidden" name="s_email" class="form-control margtop10" placeholder="" value="<?php echo $post['s_email']; ?>">
					</div>
<div class="col-md-10 textright"><br>
						<div class="mt15" style="float: left;"><span class="dark">Preferred Phone Number:</span>&nbsp;&nbsp;<span> <?php echo $post['mobile']; ?></span></div>
					</div>
					<div class="col-md-4">
						<input style="width:20%;position: absolute;" type="hidden" readonly value="91" class="form-control"/><input type="hidden" name = "mobile" class="form-control" placeholder="" value="<?php echo $post['mobile']; ?>" >
					</div></div>
					<div class="col-md-4 textleft">
					</div>
					<div class="clearfix"></div><br/><br/>
					( All Email notification will be sent to the above address).<br/> 
					<br/>
					
					<span class="size16px bold dark left">Review and book your movie ticket</span>
					<div class="roundstep right">2</div>
					<div class="clearfix"></div>
					<div class="line4"></div>
            <div class="alert alert-info" style="color:#3a87ad;margin-top: 25px;margin-bottom: 20px;margin-left: 1%;text-shadow: 0 1px 0 rgba(255,255,255,0.5);background-color: #EBF2F7;border: 1px solid #2296EA;
               -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;padding: 8px 15px 8px 14px;position: relative;width: 98%;border: teal;background-color: #d9edf7;border-color: #bce8f1; float:left; margin-left:2px">
               <b><span class="attention"> Attention!</span><span class="attention_sub"> Please read important movie ticket information!</span></b><br/><br/>
               <p class="size12" style="font-size: 13px">• This ticket is booked through our partner Funcinemas.</p>
                <p class="size12" style="font-size: 13px;">• For all queries and/or activities related to booking, please contact us at support@smartbuy.com and  1860 425 3322.</p>
               <p class="size12" style="font-size: 13px;">• HDFC Bank SmartBuy is not responsible for any cancellations that occur at the partner side. </p>
               <p class="size12" style="font-size: 13px;">• All bookings are subject to Partner terms and conditions.</p>
               <p class="size12" style="font-size: 13px;">• Movie tickets booked through the portal cannot be cancelled or modified.</p>
                <p class="size12" style="font-size: 13px;">• HDFC Bank is acting merely as a facilitator and the services and/or goods purchased on SmartBuy are provided by our partners/ merchants. And HDFC bank is not responsible for any fees, charges and/ or taxes levied by the partners/ merchants.</p>
            </div>
					<input type="checkbox" name="check_term" id="check_term" value="2" checked/>You have accepted the <?php echo HTML::link('content/Terms & Conditions', 'Terms & conditions ',array('target'=>'_blank')); ?> 
					
					<div id="term_error"></div>
					
					<?php			   
					 $offer = Offerhelper::offer_calculate(3,$post['total']); 
					 
					$check_data=array(
							   'amount'=>round($post['total'] -  $offer['discount_amount']),
                                                           'book'=>'Movie Ticket',	
							   'cash'=>0,
							   'ctype'=>'movie2',
							   'emi_data'=>$emi_data,
							   'interest'=>$interest,
							   'form_option'=>0
							   );
						
					$view = View::make('payment_form',$check_data);
					echo $view;
					?>			
				  <br>

                                       <br>
	
					<div class="clearfix"></div>
				
				
					<div>
		
			
				</div></div></div>
		
			
			<!-- END OF LEFT CONTENT -->			
			
			<!-- RIGHT CONTENT -->

			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						<span class="opensans size18 dark bold"><?php  if(isset($post['Movie'])) echo $post['Movie']; ?></span><br/>
						<span class="opensans size13 grey"> <?php  echo date('D, d M Y',strtotime($post['ShowTime'])); ?>, Funcinemas - <?php echo $post['Center'];?> , <?php echo $post['Screen'] ; ?></span><br/>
					</div>
					<div class="line3"></div>
					
					<div class="hpadding30 margtop30">
						<table class="table table-bordered margbottom20">
							<tr>
								<td colspan=2>Class</td>

								<td ><?php if(isset($post['Class']) ) echo $post['Class'];?></td>

							</tr>

							<tr>

								<td colspan=2>QTY</td>
								<td><?php if(isset($QTY) ) echo $QTY;?></td>
							
							<tr>
								<td colspan=2>Show Time</td>
								<td><?php  if(isset($post['ShowTime'])) echo $post['ShowTime'] ; ?></td>
							</tr>

							<tr>
								<td colspan=2>Finish Time</td>
								<td><?php  if(isset($post['FinishTime'])) echo $post['FinishTime'] ; ?></td>
							</tr>

						<!--	<tr>
								<td colspan=2>Tax</td>
								<td><?php  if(isset($post['service_fee'])) echo '<span  class="size12">&#8377;</span> '.$post['service_fee'] ; ?></td>
							</tr>

							<tr>
								<td colspan=2>Service fee</td>
								<td><span  class="size12">&#8377;</span> 1.24</td>
							</tr> -->
<tr>
								<td colspan=2>Seat</td>
								<td><?php echo $post['seats']; ?> </td>
							</tr>


	 </table>
					</div>	
					
					
                                        <div class="padding20">
                                        <span class="left size14 "  style="width: 120px;">Booking Total: <span style="font-size:10px"></br> <span class="red"></span> </span></span>
                                        <div class="right "><div id="Total_Amount2" class="right" >&#8377;<?php  if(isset($post['total'])) echo round($post['total']) ; ?></div>
                                        <div class="clearfix"></div>
                                        <span style="font-size:10px"> <span class="red"></span>(Inclusive Tax) </span>
                                        </div>
                                        </span>
                                 
                                      
                                       <div class="clearfix"></div>  
                                        <?php  if(!empty($offer)){ ?>
									
					<span class="left size14 ">SmartBuy Exclusive Offer:</span>
	
<span class="right" style="color:#e20613;"> ₹ <?php echo $offer['discount_amount'];?> </span>						
					
				<div class="clearfix"></div>
			</br>		
										
					<span class="left size14 ">Net Payable Amount:</span>
	
<span class="right">₹ <?php echo round($post['total'] - $offer['discount_amount']);?> </span>
	
	
						<div class="clearfix"></div>
					
<?php } ?>
  </div>
				</div><br/><div class="clearfix"></div>
				<?php 
			$login=Session::get('customer_data'); if(!$login){
 echo Form::open(array("id"=>"form-login","role"=>"form",'method'=>'post','onsubmit' => 'return validateForm();', 'action'=>'Login@checkout_login')); ?>		
				<div class="pagecontainer2 loginbox">
					<div class="cpadding1">
					
						<span class="icon-lockk"></span>
						
						<h3 class="opensans login"	>Log in</h3></br></br>
						<font color="red" style="margin-top: -28px;margin-left: 2px;position: absolute;"><?php echo $validation; ?> </font>
						<input type="text" class="form-control logpadding" name="email" placeholder="Username">
						<br/>
						<input type="password" class="form-control logpadding" name="password" placeholder="Password">
						<div class="margtop20">
							
							<div class="right">
								<button class="btn-search5" type="submit" onclick="errorMessage()">Login</button>	
							</div>
						</div>
						<div class="clearfix"></div><br/>
					</div>
				</div><br/>
			</form>
			<?php } ?>
			

</div></div>
	
	
	<!-- END OF CONTENT -->
