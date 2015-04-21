
<?php 
       
if(isset($book_passenger) && $book_passenger<>'')
{
$book_passenger=json_decode(urldecode($post['book_passenger']));
}
if(isset($post['clear_select']) && $post['clear_select']<>'')
{
$clear_select=json_decode(urldecode($post['clear_select']));
}

//goibibo
//echo "<pre>";print_r($response->booking_id);exit;
if(isset($response->booking_id) && $response->booking_id<>'')
{
    $response_goibibo=  json_decode($response->booking_id);
    
    //echo "<pre>"; print_r($response_goibibo);exit;
    
    $booking_id=$response_goibibo->data['0']->bookingid;
    $final_fare=$response_goibibo->data['0']->finalfare;
}
?>
<link href="themes/hdfc/assets/updates/update1/css/style01.css" rel="stylesheet" media="screen">
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Flights</a></li>
					<li>/</li>
					<li><a href="#">Booking Summary</a></li>
									
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt25 offset-0">
			
	<form method="post" action="<?php echo $url = URL::action('Checkout@checkout_process'); ?>"  id="passenger_checkout">

           
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
                                        <div class="row">
                                        <?php if(isset($xml_array['book-response']['trip-id']) && $xml_array['book-response']['trip-id']<>'' ||  isset($booking_id) && $booking_id<>'')
                                        {
                                        ?> 
                                        <span class="size16px bold dark left">Flight has been booked successfully !!!</span>
                                        <?php }
                                        else
                                        {
                                        ?>
                                        <span class="size16px bold dark left">Flight booking is Failed !!!</span>
                                        <?php } ?>
                                        <div class="clearfix"></div>
					<div class="line4"></div>
						<div class="col-md-4">
                                                    <b><?php if(isset($xml_array['book-response']['trip-id']) && $xml_array['book-response']['trip-id']<>'' ||  isset($booking_id) && $booking_id<>'')
                                                       {
                                                       ?> 
                                                    Booking ID
                                                       <?php }
                                                       else
                                                       {
                                                       echo "Status";
                                                       }
                                                        ?> </b> :
                                                   
                                                    <?php if(isset($xml_array['book-response']['trip-id']) && $xml_array['book-response']['trip-id']<>'')
                                                       {
                                                    
                                                     echo $xml_array['book-response']['trip-id'];    
                                                     }
                                                     else if(isset($booking_id) && $booking_id<>'')
                                                     {
                                                         echo $booking_id;
                                                     }
                                                     else
                                                     {
                                                     echo "Failed";
                                                     }
                                                     ?>
						</div>
						<div class="col-md-4">
                                                    <b>Price</b> : Rs
                                                    <?php 
                                                   if(isset($clear_select['0']->price) && $clear_select['0']->price<>'')
                                                   {
                                                    echo round($clear_select['0']->price['0']->cash);   
                                                   }
                                                   else if(isset($final_fare) && $final_fare<>'')
                                                   {
                                                       echo $final_fare;
                                                   }
                                                    ?>
						</div>
	                        </div>
                                 <br/><br/>  
	                        <?php
	                        if(isset($xml_array['book-response']['flights']['flight']) && $xml_array['book-response']['flights']['flight']<>'')
	                        {
	                       $count_data=count($xml_array['book-response']['flights']['flight']);
	                       
	                       
	                       if($count_data>1 && $count_data<3)
	                       {
	                       for($i=0;$i<$count_data;$i++)
	                       {  
	                        ?>
	                        <div class="padding30 grey">				
						<div class="col-md-4">
                                                    <b>Departure</b> :
                                                   <?php
                                                   //echo "<pre>";print_r($xml_array['AirBookingStatusResponse']['Bookings']);exit;
                                                    echo $xml_array['book-response']['flights']['flight']['segments']['segment'][$i]['departure-airport']; ?>
						</div>
						<div class="col-md-4">
							<div class="w50percent">
<b>Arrival</b> :
                                                    <?php echo $xml_array['book-response']['flights']['flight']['segments']['segment'][$i]['arrival-airport']; ?>
							</div>
												
						</div>
						
						<div class="clearfix"></div><br/>
						
						

					</div>
				<?php }
				}
				else
				{
				 ?>	
				  <div class="padding30 grey">				
						<div class="col-md-4">
                                                    <b>Departure</b> :
                                                   <?php
                                                   //echo "<pre>";print_r($xml_array['AirBookingStatusResponse']['Bookings']);exit;
                                                    echo $xml_array['book-response']['flights']['flight']['segments']['segment']['departure-airport']; ?>
						</div>
						<div class="col-md-4">
							<div class="w50percent">
<b>Arrival</b> :
                                                    <?php echo $xml_array['book-response']['flights']['flight']['segments']['segment']['arrival-airport']; ?>
							</div>
												
						</div>
						
						<div class="clearfix"></div><br/>
						
						

					</div>
				 <?php } 
				 }
				 ?>
				
					<span class="size16px bold dark left">Passenger Details</span>
					<div class="roundstep active right">1</div>
					<div class="clearfix"></div>
					<div class="line4"></div>
					<?php 
                                       
                                         //echo "<pre>";print_r($post);exit;
                                        $book_passsenger=json_decode(urldecode($post['book_passenger']));
                                        // echo "<pre>";print_r($book_passsenger);exit;
                                        $count_passengers=$book_passsenger->adults+$book_passsenger->children+$book_passsenger->children;
                                        $adults=$book_passsenger->adults;
                                        $children=$book_passsenger->children;
                                        $infants=$book_passsenger->infants;
                                       
					$i=0;
					if(isset($adults) && $adults<>'')
					{
					$j=$adults+3;
					for($i=3;$i<$j;$i++)
					{
					 ?>
					<!-- ROW -->
					<div class="row">
					
						<div class="col-md-4">
<!--							<span class="size13 dark">First name<font color="red">*</font></span>-->
                                                        <?php echo $post['firstname'.$i] ; ?>
							<input type="hidden" name="firstname<?php echo $i;?>" id="firstname<?php echo $i;?>" class="form-control " value="<?php echo $post['firstname'.$i] ; ?>" placeholder="">
						</div>
						<div class="col-md-4">
<!--							<span class="size13 dark">Last Name<font color="red">*</font></span>-->
                                                    <?php echo $post['lastname'.$i] ; ?>
							<input type="hidden" name="lastname<?php echo $i;?>" id="lastname<?php echo $i;?>" class="form-control " placeholder="" value="<?php echo $post['lastname'.$i] ; ?>">
						</div>
						<div class="col-md-4">
							<div class="w50percent">
<!--								<span class="size13 dark">Date of birth<font color="red">*</font></span>-->                                                     <?php echo $post['datepicker'.$i] ; ?>
								<input type="hidden"name="datepicker<?php echo $i;?>" readonly="readonly" class="form-control mySelectCalendar" id="datepicker<?php echo $i;?>" value="<?php echo $post['datepicker'.$i] ; ?>" placeholder="mm-dd-yyyy"/>
							</div>
												
						</div>
						
						<div class="clearfix"></div><br/>
						
						

					</div>
					<!-- END OF ROW -->
                                        <?php } 
                                        }
                                        ?>
                                        <?php
                                        if(isset($children) && $children<>'')
					{
					$j=$j=$adults+$children+3;
					for($i=3+$adults;$i<$j;$i++)
					{
					 ?>
					<!-- ROW -->
					<div class="row">
					
						<div class="col-md-4">
<!--							<span class="size13 dark">First name<font color="red">*</font></span>-->
                                                        <?php echo $post['firstname'.$i] ; ?>
							<input type="hidden" name="firstname<?php echo $i;?>" id="firstname<?php echo $i;?>" class="form-control " value="<?php echo $post['firstname'.$i] ; ?>" placeholder="">
						</div>
						<div class="col-md-4">
<!--							<span class="size13 dark">Last Name<font color="red">*</font></span>-->
                                                    <?php echo $post['lastname'.$i] ; ?>
							<input type="hidden" name="lastname<?php echo $i;?>" id="lastname<?php echo $i;?>" class="form-control " placeholder="" value="<?php echo $post['lastname'.$i] ; ?>">
						</div>
						<div class="col-md-4">
							<div class="w50percent">
<!--								<span class="size13 dark">Date of birth<font color="red">*</font></span>-->                                                     <?php echo "hai";echo $post['datepicker'.$i] ; ?>
								<input type="hidden"name="datepicker<?php echo $i;?>"  class="form-control mySelectCalendar" id="datepicker<?php echo $i;?>" value="<?php echo $post['datepicker'.$i] ; ?>" placeholder="mm-dd-yyyy"/>
							</div>
												
						</div>
						
						<div class="clearfix"></div><br/>
						
						

					</div>
					<!-- END OF ROW -->
                                        <?php } 
                                        }
                                        ?>
                                        
                                        <?php
                                        if(isset($infants) && $infants<>'')
					{
					$j=$j=$infants+$adults+$children+3;
					for($i=3+$adults+$children;$i<$j;$i++)
					{
					 ?>
					<!-- ROW -->
					<div class="row">
					
						<div class="col-md-4">
<!--							<span class="size13 dark">First name<font color="red">*</font></span>-->
                                                        <?php echo $post['firstname'.$i] ; ?>
							<input type="hidden" name="firstname<?php echo $i;?>" id="firstname<?php echo $i;?>" class="form-control " value="<?php echo $post['firstname'.$i] ; ?>" placeholder="">
						</div>
						<div class="col-md-4">
<!--							<span class="size13 dark">Last Name<font color="red">*</font></span>-->
                                                    <?php echo $post['lastname'.$i] ; ?>
							<input type="hidden" name="lastname<?php echo $i;?>" id="lastname<?php echo $i;?>" class="form-control " placeholder="" value="<?php echo $post['lastname'.$i] ; ?>">
						</div>
						<div class="col-md-4">
							<div class="w50percent">
<!--								<span class="size13 dark">Date of birth<font color="red">*</font></span>-->                                                     <?php echo $post['datepicker'.$i] ; ?>
								<input type="hidden"name="datepicker<?php echo $i;?>" readonly="readonly" class="form-control mySelectCalendar" value="<?php echo $post['datepicker'.$i] ; ?>" id="datepicker<?php echo $i;?>" placeholder="mm-dd-yyyy"/>
							</div>
												
						</div>
						
						<div class="clearfix"></div><br/>
						
						

					</div>
					<!-- END OF ROW -->
                                        <?php } 
                                        }
                                        ?>
                                        
					
					<br/>
					<div class="fdash"></div>
					<br/>
					
					
					
					<br/>
					<br/>
					
					
				
					<span class="size16px bold dark left">Customer </span>
					<div class="roundstep right">2</div>
					<div class="clearfix"></div>
					<div class="line4"></div>
					Please tell us who will be checking in. Must be 18 or older. <br/><br/>
					
					<div class="col-md-4 textright">
						<div class="margtop15"><span class="dark">Contact Name:</span><span class="red"><font color="red">*</font></span></div>
					</div>
					<div class="col-md-4">

                   <?php echo $post['first_name'].''.$post['last_name'];?>
					</div>
					<div class="col-md-4 textleft margtop15">
					</div>
					<div class="clearfix"></div>
					
					<br/>
					<div class="col-md-4 textright">
						<div class="margtop7"><span class="dark">Phone Number:</span><span class="red"><font color="red">*</font></span></div>
					</div>
					
					<div class="col-md-4 textleft">
<!--						<span class="size12">Preferred Phone Number<font color="red">*</font></span>	-->
						<input type="hidden" class="form-control" placeholder="" name="phonenumber" id="phonenumber" value="<?php echo $post['mobile'];?>">
                                                <?php echo $post['mobile'];?>
					</div>
					<div class="clearfix"></div>

					<br/>
					<div class="col-md-4">
					</div>
					<div class="clearfix"></div>
					<div class="line4"></div>		
					Please enter the email address where you would like to receive your confirmation.<br/> 
					
					
					<br/>
					<div class="col-md-4 textright">
						<div class="margtop7"><span class="dark">Email:</span><span class="red"><font color="red">*</font></span></div>
					</div>
					<div class="col-md-4">
<!--						<span class="size12">Email Address<font color="red">*</font></span>	-->
						<input type="hidden" value="<?php echo $post['s_email'];?>" class="form-control margtop10" placeholder="" name="s_email" id="email">
                                                <?php echo $post['s_email'];?>
					</div>
                                        <div class="col-md-4 textleft">
<!--						<span class="size12">Preferred Phone Number<font color="red">*</font></span>	
						<input type="text" class="form-control" placeholder="">-->
					</div>
					<div class="col-md-4 textleft">
					</div>
					<div class="clearfix"></div>
						<!-- End of collapse 3 -->
						<div class="clearfix"></div>				

						
					
					<div class="clearfix"></div>
					
					
					<br/>
					<br/>
					
					
					
</form>			
				</div>
		
			</div>
			<!-- END OF LEFT CONTENT -->			
			
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding20">
						<span class="opensans size18 dark bold">Trip Summary</span>
					</div>
					<div class="line3"></div>
					
					<div class="hpadding30 margtop30">
					
					
					<!-- GOING TO -->
					<div>
						<div class="wh33percent left size12 bold dark">
							<?php 
                                                       echo  $book_passsenger->leavingfrom; ?>
						</div>
						<div class="wh33percent left center size12 bold dark">
							
						</div>
						<div class="wh33percent right textright size12 bold dark">
							<?php
                                                        
                                                        echo  $book_passsenger->goingto; ?>
						</div>
						<div class="clearfix"></div>
						
						<div class="wh33percent left">
							<div class="fcircle">
								<span class="fdeparture"></span>
							</div>
						</div>
						<div class="wh33percent left">
							<div class="fcircle center">
								<span class="fstop"></span>
							</div>
						</div>
						<div class="wh33percent right">
							<div class="fcircle right">
								<span class="farrival"></span>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="fline2px"></div>
						
						<div class="wh33percent left size12">
                                                    
                                                    <?php 
                                                    if(isset($clear_select) && $clear_select<>'')
                                                    {
                                                    echo date('G:i',strtotime($clear_select['0']->onwardfl['0']->arr_tym));
                                                    }
                                                    else
                                                    {
                                                        
                                                     
                                                    }
                                                    ?>
                                                    
							
						</div>
						<div class="wh33percent left center size12">
							
						</div>
						<div class="wh33percent right textright size12">
                                                <?php 
                                                if(isset($clear_select) && $clear_select<>'')
                                                {
                                                echo date('G:i',strtotime($clear_select['0']->onwardfl['0']->dst_tym)); 
                                                }
                                                else
                                                {

                                                }
                                                ?>
						</div>
						<div class="clearfix"></div>
					</div>
					<!-- END OF GOING TO -->
					
					<br/>
					<?php if(isset($rsourc)){ ?>
					<!-- RETURNING -->
					<div>
						<div class="wh33percent left size12 bold dark">
							<?php echo $rsourc; ?>
						</div>
						<div class="wh33percent left center size12 bold dark">
							
						</div>
						<div class="wh33percent right textright size12 bold dark">
							<?php echo $rdeat; ?>
						</div>
						<div class="clearfix"></div>
						
						<div class="wh33percent left">
							<div class="fcircle">
								<span class="fdeparture"></span>
							</div>
						</div>
						<div class="wh33percent left">
							<div class="fcircle center">
								<span class="fstop"></span>
							</div>
						</div>
						<div class="wh33percent right">
							<div class="fcircle right">
								<span class="farrival"></span>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="fline2px"></div>
						
						<div class="wh33percent left size12">
						<?php echo date('G:i',strtotime(str_replace("T"," ",$rdept_tym))); ?>	
                                                    
						</div>
						<div class="wh33percent left center size12">
							1 h 00 m
						</div>
						<div class="wh33percent right textright size12">
							<?php echo date('G:i',strtotime(str_replace("T"," ",$rarr_tym))); ?>
						</div>
						<div class="clearfix"></div>
					</div>
<?php } ?>
					<!-- END OF RETURNING -->
					
					
					<br/>
					
					<!-- Collapse 1 -->	
<!--					<button type="button" class="collapsebtn3 collapsed mt-5" data-toggle="collapse" data-target="#collapse1"></button>
					<div id="collapse1" class="collapse in">
						<div class="left size14">
							Flight<br/>
							Taxes & Fees 
						</div>
						<div class="right size14">
							$458.00<br/>
							$329.25
						</div><div class="clearfix"></div>	
					</div>-->
					<!-- End of collapse 1 -->
                                  
					<!-- Collapse 1 -->	
<!--					<button type="button" class="collapsebtn3 collapsed mt-5" data-toggle="collapse" data-target="#collapse1"></button>
					<div id="collapse1" class="collapse in">
						<div class="left size14">
							Flight<br/>
							Taxes & Fees 
						</div>
						<div class="right size14">
							$458.00<br/>
							$329.25
						</div><div class="clearfix"></div>	
					</div>-->
					<!-- End of collapse 1 -->
                                   
                                        
					
					
					

                                        </div>	


				</div><br/>
				
				
				
				
			
			</div>
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
	
<script type="text/javascript">


$("#datepicker1").on('click',function(){
alert('coming');
});



</script>
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>	
<script type="text/javascript" >
$(document).ready(function() {
$("#passenger_checkout").validate({
rules: {
firstname3 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname3 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker3 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        

firstname4 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname4 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker4 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
firstname5 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname5 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker5 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        


firstname6 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname6 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker6 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
firstname7 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname7 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker7 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
firstname8 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname8 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker8 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
firstname9 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname9 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker9 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
firstname10 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
lastname10 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
datepicker10 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
name : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
countrycode : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
phonenumber : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},     
landline : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
},      
state : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},       
city : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
country : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
countrycode : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
pincode : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

}, 
email : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},         
        


},
messages: {
email: { 
required: "This field is required.",
email: "Please Enter a Valid Email-Address."
}
},
submitHandler: function(frm) {
//  var point=$("#myTextInput").val();
//   var cash=$("#customerpoints1").val();

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
<style> .error{ color:red; } </style>
	
	
