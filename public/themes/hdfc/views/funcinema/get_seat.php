<!-- END OF CONTENT -->
<script src="themes/hdfc/assets/assets/js/jquery.validate.js"></script>
<script>
   $(document).ready(function() {
   $("#exclusive_offer").hide();
    $("#payable_amount").hide();
   $.validator.addMethod("falpha", function(value, element) {
   return this.optional(element) || /^[a-z\-\s]+$/i.test(value);
   },  "Name field must contain only letters");
   $.validator.addMethod("lalpha", function(value, element) {
   return this.optional(element) || /^[a-z\-\s]+$/i.test(value);
   },  "Last name field must contain only letters");
   jQuery.validator.addMethod("numbersonly", function(value, element) {
    return this.optional(element) || /^[0-9\s]+$/i.test(value);
}, "This field only contain numbers."); 
   
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
   		required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
               numbersonly:true,
                minlength:10,
		 maxlength:10
   		},        
                   s_email : {
   		required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
   		email:true	
   		    },
   		    },
   		messages: {
		s_email: { 
		required: "required.",
		email: "Please Enter a Valid Email-Address."
		},
		first_name: { 
			required: "required."
			},
			last_name: { 
			required: "required."
			},
			mobile: { 
			required: "required.",
			minlength: "Please enter a valid phone / mobile number."
			}
			},
   		submitHandler: function(frm) {
   		
			var sel = $("#seatcount").val();
			var qty = $("#QTY").val();
   			if(sel != qty){
   			 alert('You hav not selected the seats as per the given quantity'); return false; 
   			}
   		
   
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
            <li><a href="#" class="active">Seat Layout</a></li>
         </ul>
      </div>
      <a class="backbtn right" href="#"></a>
   </div>
  
</div>
<!-- CONTENT -->
<div class="container">
<div class="container mt8 offset-0">
<!-- LEFT CONTENT -->
<div class="col-md-8 pagecontainer2 offset-0">
<div class="padding30 grey">
   <span class="size16px bold dark left">Select your Seats  </span>
   <div class="roundstep active right">1</div>
   <div class="clearfix"></div>
   <div class="line4"></div>
   <div class="seat">
      <ul class="col-xs-12 col-md-12 col-lg-12">
         <li class="col-xs-2 col-md-2 col-lg-2"><img src="<?php echo Theme::asset()->url('images/available_seat.jpg'); ?>" border="0" align="absmiddle"> Available</li>
         <li class="col-xs-2 col-md-2 col-lg-2"><img src="<?php echo Theme::asset()->url('images/booked_seat.jpg'); ?>" border="0" align="absmiddle"> Booked</li>
         <li class="col-xs-2 col-md-2 col-lg-2"><img src="<?php echo Theme::asset()->url('images/selected_seat.jpg'); ?>" border="0" align="absmiddle"> Your Selection</li>
         <li class="col-xs-3 col-md-3 col-lg-3">Class: <?php echo $Class; ?></li>
		 <li class="col-xs-3 col-md-3 col-lg-3">Total Amount: &#8377; <span id="Total_Amount">0</span></li>
      </ul>
   </div>
   <br/><br/>
   <!--seat layout-->
   <!--Content Starts here-->
   <section class="table_div_change" style="border:none; border-top:1px solid #dfdfdf;"  >

      <div class="ticket_select_row" style="border:none">
         <div class="seat_select">
            <div id="seatshow">
               <div id="seatslayout">
                  <ul>
                     <?php 
                        if(!empty($audidetails)) { 
                        
                        if(array_key_exists(0,$audidetails['objArea'])) { 
                        
                        foreach($audidetails['objArea'] as $audiseats=>$seats)
                        {
                         
                        if($seats['@attributes']['AreaCode']==$AreaCode && $seats['@attributes']['HasCurrentOrder']=true )
                        {
                                 $out ='';
                               if(array_key_exists(0,$seats['objRow'])){ 
                               
                               foreach($seats['objRow'] as $key=>$seat)
                               {
                                    
                               
                                    $singlerow=$seat['@attributes']['PhyRowId'];
                               
                               $out .='<li>'.$singlerow.'</li><li>&nbsp;</li>
                                                    ';
                               
                              
                               
                                $count=1; foreach($seat['objSeat'] as $singlerows)
                        	{  
                        	 
                        	 if($singlerows['@attributes']['SeatStatus']==0 || $singlerows['@attributes']['SeatStatus']==5)
                        	 {
                        	$out .='<li  style="cursor:pointer" onclick="selectseat(\'td_'.$singlerow.'_'.$singlerows['@attributes']['GridSeatNum'].'\',\''.$singlerow.'\',\''.$singlerows['@attributes']['GridSeatNum'].'\',36)" ><img class="navailable"  id="td_'.$singlerow.'_'.$singlerows['@attributes']['GridSeatNum'].'" src="'.Theme::asset()->url('images/available_seat.jpg').'" border="0"></li>';
                        	}elseif($singlerows['@attributes']['SeatStatus']==-1)
                        	{
                        	$out .='<li  style="cursor:pointer"  ><img id="td_'.$singlerow.'_'.$singlerows['@attributes']['GridSeatNum'].'" src="'.Theme::asset()->url('images/unavailable_seat.jpg').'" border="0"></li>';
                        	}else{
                        	$out .='<li  style="cursor:pointer"  ><img id="td_'.$singlerow.'_'.$singlerows['@attributes']['GridSeatNum'].'" src="'.Theme::asset()->url('images/booked_seat.jpg').'" border="0"></li>';
                        	}
                        	
                        	
                        	
                                }
                        	
                        	
                        	$out .='</ul><ul>';
                               
                               }
                               }
                               else
                               {
                               $rows=$seats['objRow'];
                               $singlerow=$rows['@attributes']['PhyRowId'];
                        	$out .='<li>'.$singlerow.'</li> <li>&nbsp;</li>
                                                    ';
                        	$count=1;foreach($rows['objSeat'] as $key=>$singlerows)
                        	{
                        
                        	
                        	 if($singlerows['@attributes']['SeatStatus']==0 || $singlerows['@attributes']['SeatStatus']==5|| $singlerows['@attributes']['HasCurrentOrder']==true)
                        	 {
                        	$out .='<li  style="cursor:pointer" onclick="selectseat(\'td_'.$singlerow.'_'.$singlerows['@attributes']['GridSeatNum'].'\',\''.$singlerow.'\',\''.$singlerows['@attributes']['GridSeatNum'].'\',36)" ><img class="navailable"  id="td_'.$singlerow.'_'.$singlerows['@attributes']['GridSeatNum'].'" src="'.Theme::asset()->url('images/available_seat.jpg').'" border="0"></li>';
                        	}elseif($singlerows['@attributes']['SeatStatus']==-1)
                        	{
                        	$out .='<li  style="cursor:pointer"  ><img id="td_'.$singlerow.'_'.$singlerows['@attributes']['GridSeatNum'].'" src="'.Theme::asset()->url('images/unavailable_seat.jpg').'" border="0"></li>';
                        	}else{
                        	$out .='<li  style="cursor:pointer"  ><img id="td_'.$singlerow.'_'.$singlerows['@attributes']['GridSeatNum'].'" src="'.Theme::asset()->url('images/booked_seat.jpg').'" border="0"></li>';
                        	}
                        	
                                
                        	}
                        	$out .='</ul><ul>';
                        	
                        	}
                               
                        }
                        }
                        }
                        else
                        {
                        
                        $seats=$audidetails['objArea'];
                        if($seats['@attributes']['AreaCode']==$AreaCode && $seats['@attributes']['HasCurrentOrder']=true )
                        {
                               if(array_key_exists(0,$seats['objRow'])){ 
                               foreach($seats['objRow'] as $key=>$seat)
                               {
                                    
                               
                                    $singlerow=$seat['@attributes']['PhyRowId'];
                               
                              // $out .='<tr>&nbsp;</tr>';
                               $out .='<li>'.$singlerow.'</li> <li>&nbsp;</li>
                                                    ';
                               
                              
                               
                                 $count=1;foreach($seat['objSeat'] as $singlerows)
                        	{  
                        	 
                        	 if($singlerows['@attributes']['SeatStatus']==0 || $singlerows['@attributes']['SeatStatus']==5|| $singlerows['@attributes']['HasCurrentOrder']==true)
                        	 {
                        	$out .='<li  style="cursor:pointer" onclick="selectseat(\'td_'.$singlerow.'_'.$singlerows['@attributes']['GridSeatNum'].'\',\''.$singlerow.'\',\''.$singlerows['@attributes']['GridSeatNum'].'\',36)" ><img class="navailable"  id="td_'.$singlerow.'_'.$singlerows['@attributes']['GridSeatNum'].'" src="'.Theme::asset()->url('images/available_seat.jpg').'" border="0"></li>';
                        	}elseif($singlerows['@attributes']['SeatStatus']==-1)
                        	{
                        	$out .='<li  style="cursor:pointer"  ><img id="td_'.$singlerow.'_'.$singlerows['@attributes']['GridSeatNum'].'" src="'.Theme::asset()->url('images/unavailable_seat.jpg').'" border="0"></li>';
                        	}else{
                        	$out .='<li  style="cursor:pointer"  ><img id="td_'.$singlerow.'_'.$singlerows['@attributes']['GridSeatNum'].'" src="'.Theme::asset()->url('images/booked_seat.jpg').'" border="0"></li>';
                        	}
                        	
                        	
                        	
                                }
                        	
                        	
                        	$out .='</ul><ul>';
                               
                               }
                               }
                               else
                               {
                               $rows=$seats['objRow'];
                               $singlerow=$rows['@attributes']['PhyRowId'];
                        	$out .='<li>'.$singlerow.'</li> <li>&nbsp;</li>
                                                    ';
                        	$count=1;foreach($rows['objSeat'] as $key=>$singlerows)
                        	{
                        
                        	
                        	 if($singlerows['@attributes']['SeatStatus']==0 || $singlerows['@attributes']['SeatStatus']==5|| $singlerows['@attributes']['HasCurrentOrder']==true)
                        	 {
                        	$out .='<li  style="cursor:pointer" onclick="selectseat(\'td_'.$singlerow.'_'.$singlerows['@attributes']['GridSeatNum'].'\',\''.$singlerow.'\',\''.$singlerows['@attributes']['GridSeatNum'].'\',36)" ><img class="navailable"  id="td_'.$singlerow.'_'.$singlerows['@attributes']['GridSeatNum'].'" src="'.Theme::asset()->url('images/available_seat.jpg').'" border="0"><li>';
                        	}else
                        	{
                        	$out .='<li  style="cursor:pointer"  ><img id="td_'.$singlerow.'_'.$singlerows['@attributes']['GridSeatNum'].'" src="'.Theme::asset()->url('images/booked_seat.jpg').'" border="0"></li>';
                        	}
                        	
                              
                        	}
                        	$out .='</ul><ul>';
                        	
                        	}
                               
                        }
                        
                        }	
                        }
                        else
                        {
                        $out .='<td>No results found</td>';
                        }
                        	$out .='</tr>';
                        
                        
                        	echo $out;
                        
                        		 $out='<ul>';
                        			//$out .='<tr><td>&nbsp;</td></tr>';
                        			//$out .='<li>'.$audidetails['objArea']['ErrMessage'].'</li>';
                        			$out .='</ul>';
                        			
                        			
                        			echo $out; ?>
                  </ul>
               </div>
            </div>
          
            <div class="screen_link">
               <a href="#"><img src="<?php echo Theme::asset()->url('images/screen_link.jpg'); ?>" border="0"></a>
               <script>
                  var seats = new Array();
                  function selectseat(tdid, row, col, count) {
                      var qty=$("#QTY").val();
                     var service_fee=$("#ServiceFee").val();
                     
                      var price=$("#Prices").val();
                      var i = 0;
                  
            
            
                
                      if (document.getElementById("seatcount").value == "0") {
                          seats = [];
                          seats.length = 0;
                          j = 0;
                           
                      }
                      if (document.getElementById(tdid).className == "ncurrent") {
                          document.getElementById(tdid).className = "navailable";
                          for (var i = 0; i < seats.length; i++) {
                              //alert(seats[tdid]);
                              if (seats[i] == row + ":" + col)
                                  seats.splice(i, 1);
                          }
                          j--;
                          if(j=='0'){
                          
                          $("#exclusive_offer").hide();
                           $("#payable_amount").hide(); 
                          }
                          var seatsnos = seats.join(",");
                  
                          document.getElementById("seats").value = seatsnos;
                          var tp = document.getElementById("TicketPrice").value * j;
                           var St = (1.24 * j);
                  var Sp =  document.getElementById("service_fee").value * j;
                          //document.getElementById("Price").innerHTML = tp;
                         // document.getElementById("servicetax").innerHTML = St.toFixed(2);
                         // document.getElementById("Service").innerHTML = Sp;
                          document.getElementById("Total_Amount").innerHTML = Math.round(tp + Sp +St);
                  document.getElementById("Total_Amount2").innerHTML ='₹ '+ Math.round(tp + Sp +St);
                          document.getElementById("seatcount").value = j;
                          $("#total").val(tp + Sp +St );
                        //  $("#service_fee").val(Sp);
                          $("#tax").val(St.toFixed(2));
                          $("#"+tdid).attr('src',"<?php echo Theme::asset()->url('images/available_seat.jpg'); ?>");
                          return false;
                      }
                     if (j >= qty) { 
                          alert("You have already selected "+qty+" seats. To select more seats please change quantity and try again.");
                          return false;
                      }
                      if (document.getElementById(tdid).className == "navailable") {
                      
                          //alert(document.getElementById(tdid).className);
                          document.getElementById(tdid).className = "ncurrent";
                          seats[j] = row + ":" + col;
                  
                          //alert(seats[j]);
                          j++;
                          var tp = document.getElementById("TicketPrice").value * j;
                         
                          var St = (1.24 * j);
                          var Sp =  document.getElementById("service_fee").value * j;
                          //document.getElementById("Price").innerHTML = tp;
                          //document.getElementById("servicetax").innerHTML = St.toFixed(2);
                          //document.getElementById("Service").innerHTML = Sp;
                          document.getElementById("Total_Amount").innerHTML =Math.round(tp + Sp +St);
                  document.getElementById("Total_Amount2").innerHTML ='₹ '+Math.round(tp + Sp +St);
                          document.getElementById("seatcount").value = j;
                  
                            //calling ajax
                            
                            var total_amount = Math.round(tp + Sp +St);
                          	$.ajax({
			url : "get_smartbyoffer",
			type: "POST",
			data : { partner: 3, total_amount:total_amount},
			 dataType: "json",
			success: function(response, textStatus, jqXHR)
			{    
			     if(response.discount_amount !='')
			     {
			     $("#exclusive_offer").show();
                             $("#payable_amount").show(); 
                             }
			  var result = jQuery.parseJSON(response.discount_amount);
			 
			  
			   
			 document.getElementById("discountamount").innerHTML = '₹ '+ result;
			 document.getElementById("payableamount").innerHTML = '₹ '+ (total_amount - result);
				
			}
			});
                     
                        
                          $("#total").val(tp + Sp + St );
                         // $("#service_fee").val(Sp);
                          $("#tax").val(St.toFixed(2));
                          $("#"+tdid).attr('src',"<?php echo Theme::asset()->url('images/selected_seat.jpg'); ?>");
                      }
                  
                  
                      var seatsno = seats.join(",");
                      //  alert(seatsno);
                      document.getElementById("seats").value = seatsno;
                     
                  }
                   function seatvalidate() {
                      var k = document.getElementById("seatcount").value;
                      var qty=$("#QTY").val();
                      if (k < qty) {
                          alert("You have already selected "+qty+" seats in previous page.So Please Book same "+qty+"  seat(s)");
                          return false;
                      }
                  }
                  
                  
               </script>
               </div>
               </section>
            <div class="container">
           
         <form  method="post" id="passenger_checkout" action="<?php echo $url = URL::action('funController@getaudilayout_final'); ?>"  name="passenger_checkout" accept-charset="UTF-8" >
               <input name="ctype" type="hidden" id="ctype" value="movie2" />
               <input name="Center" type="hidden" id="Center" value="<?php if(isset($movie_details['CenterName'])) echo  $movie_details['CenterName']; ?>" />
               <input type="hidden" id="Screen" name="Screen" value="<?php  if(isset($movie_details['ScreenName'])) echo $movie_details['ScreenName'] ; ?>" />
               <input type="hidden" id="Movie" name="Movie" value="<?php  if(isset($movie_details['MovieName'])) echo $movie_details['MovieName'] ; ?>"  />
               <input type="hidden" id="ShowTime" name="ShowTime" value="<?php  if(isset($movie_details['ShowDate'])) echo $movie_details['ShowDate'] ; ?>"/>
               <input type="hidden" id="FinishTime" name="FinishTime" value="<?php  if(isset($movie_details['FinishTime'])) echo $movie_details['FinishTime'] ; ?>" />
               <input type="hidden" id="order_id" name="order_id" value="<?php if(isset($order_id['GenrateOrderIDResult'])) echo($order_id['GenrateOrderIDResult']) ; ?>" />
               <input type="hidden" id="bookingid" name="bookingid" value="<?php if(isset($bookingdetails)) print_r($bookingdetails) ; ?>" />
               <input type="hidden" id="rowid" name="rowid" value="<?php  if(isset($seat['@attributes']['PhyRowId'])) echo $seat['@attributes']['PhyRowId']; ?>"/>
               <input type="hidden" id="gridseatnum" name="gridseatnum" value="<?php  if(isset($singlerows['@attributes']['GridSeatNum'])) echo $singlerows['@attributes']['GridSeatNum']; ?>"/> 
               <input type="hidden" id="area" name="area" value="<?php  if(isset($seats['@attributes']['AreaCode'])) echo $seats['@attributes']['AreaCode']; ?>"/>
               <input type="hidden" id="areanum" name="areanum" value="<?php  if(isset($seats['@attributes']['AreaNum'])) echo $seats['@attributes']['AreaNum']; ?>"/>
               <input type="hidden" id="seatstatus" name="seatstatus" value="<?php  if(isset($singlerows['@attributes']['SeatStatus'])) echo $singlerows['@attributes']['SeatStatus']; ?>"/> 
               <input name="QTY" type="hidden" id="QTY" value="<?php if(isset($QTY) ) echo $QTY;?>"/>
               <input name="Class" type="hidden" id="Class" value="<?php if(isset($Class) ) echo $Class;?>"/>
               <input type="hidden" id="TicketPrice" name="TicketPrice" value="<?php  if(isset($Price)) echo $Price ; ?>" />
               <input type="hidden" id="TicketPrice" name="amount" value="<?php  if(isset($Price)) echo round($Price + (1.24 *$QTY)) ; ?>" />
               <input type="hidden" value="<?php  if(isset($ServiceFee)) echo $ServiceFee; ?>" name="service_fee" id="service_fee" />
               <input type="hidden" name="seatcount" id="seatcount" value="0" />
               <input name="seats" type="hidden" id="seats" />
               <input name="tax" type="hidden" id="tax" />
               <input type="hidden" id="total" name="total" />
	       <input type="hidden" id="ClassCode" name="ClassCode" value="<?php echo $OClassCode ;?> " />
	        <input type="hidden" id="CenterCode" name="CenterCode" value="<?php echo $centercode ;?> " />
		<input type="hidden" id="Film_strCode" name="Film_strCode" value="<?php echo $Film_strCode ;?> " />
		<input type="hidden" id="ShowCode" name="ShowCode" value="<?php echo $ShowCode ;?> " />
		<input type="hidden" id="ServiceFee" name="ServiceFee" value="<?php echo $ServiceFee ;?> " />
             <!-- End of seat layout -->
               <?php		
                  $check_data=array(
                  		   'amount'=>round($Price + (1.24 *$QTY) ),
                                                                        'book'=>'Movie Ticket',	
                  		   'cash'=>0,
                  		   'ctype'=>'movie2',
                  		   'form_option'=>1,
                  		   'msg'=>''
                  		   ); ?>
               <br/>
               <br/>
               <span class="size16px bold dark left">Where can we reach you?</span>
               <div class="roundstep" style="float:right">2</div>
               <div class="clearfix"></div>
               <div class="line4"></div>
              <div class="col-md-4">
						<div class="margtop15"><span class="dark">Contact Name:</span><span class="red">*</span></div>
			</div>
					
					<div class="col-md-3">
						<span class="size12">First Name</span>
						<input type="text" name="first_name" id="first_name"class="form-control " placeholder=""></div>
					<div class="col-md-3">
						<span class="size12">Last Name</span>
						<input type="text" name="last_name" id="last_name" class="form-control " placeholder="">
					</div>
					<div class="clearfix"></div>
					<div>
					<div class="col-md-4">
						<div class="margtop15"><span class="dark">Email Address:</span><span class="red">*</span></div>
					</div>
					<div class="col-md-6">
						<input type="text" name="s_email" id="s_email " class="form-control margtop10" placeholder="" ><br>
					</div>
<div class="clearfix"></div>
					
					
					<div class="col-md-4">
						<div class="margtop15"><span class="dark">Preferred Phone Number:</span><span class="red">*</span></div>
					</div>
					<div class="col-md-6 ">
						<div class="col-md-2 col-xs-2 col-lg-2 nopad">
						<input type="text" readonly value="+91" class="form-control"/>
						</div>
						<div class="col-md-10 col-xs-10 col-lg-10 nopad">
						<input type="text" name = "mobile" id="mobile" class="form-control" placeholder="">
						</div>
					</div>
					
					<div class="clearfix"></div><br>
            ( All email notifications will be sent to the above address).  <br/>
            <br/>
            <span class="size16px bold dark left">Review and book your movie ticket</span>
            <div class="roundstep right">3</div>
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
 By clicking on continue booking I acknowledge that I have read and accept the rules & restrictions,
<?php echo HTML::link('content/Terms & Conditions', 'Terms & Conditions',array('target'=>'_blank')); ?> and <?php echo HTML::link('content/Privacy Policy', ' Privacy Policy',array('target'=>'_blank'));?>.<br>
            <br>
            <br>
            <div class="col-xs-12 clearfix nopad pbottom15">
					<div class="col-xs-12 col-md-4 col-lg-4 pull-right">
		<input type="submit" name="go" id="submit" class="btn-search" value="Continue Booking"/>		
					</div>
			</div>
            </br></br>
   </section>
   </div>
   </div>
  </div>
  </div>
   <!-- END OF LEFT CONTENT -->			
   <!-- RIGHT CONTENT -->
   <div class="col-md-4" >
      <div class="pagecontainer2 paymentbox grey">
         <div class="padding30">
            <span class="opensans size18 dark bold"><?php  if(isset($movie_details['MovieName'])) echo $movie_details['MovieName']; ?></span><br/>
            <span class="opensans size13 grey"> <?php  echo date('D, d M Y',strtotime($movie_details['ShowDate'])); ?>, Funcinemas - <?php echo $movie_details['CenterName'];?> , <?php echo $movie_details['ScreenName'] ; ?></span><br/>
         </div>
         <div class="line3"></div>
         <div class="hpadding30 margtop30">
            <table class="table table-bordered margbottom20">
               <tr>
                  <td colspan=2>Class</td>
                  <td><?php if(isset($Class) ) echo $Class;?></td>
               </tr>
               <tr>
                  <td colspan=2>QTY</td>
                  <td><?php if(isset($QTY) ) echo $QTY;?></td>
               </tr>
               <tr>
                  <td colspan=2>Show Time</td>
                  <td><?php  if(isset($movie_details['ShowDate'])) echo $movie_details['ShowDate'] ; ?></td>
               </tr>
               <tr>
                  <td colspan=2>Finish Time</td>
                  <td><?php  if(isset($movie_details['FinishTime'])) echo $movie_details['FinishTime'] ; ?></td>
               </tr>
               <!--<tr>
                  <td colspan=2>Tax</td>
                  <td><?php  if(isset($movie_details['ServiceFee'])) echo '<span  class="size12">&#8377;</span> '. $movie_details['ServiceFee'] ; ?></td>
               </tr>
               <tr>
                  <td colspan=2>Service fee</td>
                  <td><span  class="size12">&#8377;</span> 1.24</td>
               </tr> -->
            </table>
         </div>
         <div class="line3"></div>
         <div class="padding30">
            <span class="left size14"  style="width: 120px;">Booking Total: <span style="font-size:10px"></br> <span class="red"></span> </span></span>
            <div class="right"> <div id="Total_Amount2" class="right ">0</div>
            <div class="clearfix"></div>
            <span style="font-size:10px"> <span class="red"></span>(Inclusive Tax) </span>
            </div>
            </span>
         
					<div id="exclusive_offer" class="clearfix" >					
					<span class="left size14">Smartbuy Exclusive Offer:</span>

<span class="right size14 lred2"  >   <div id="discountamount"> </div> </span>  
						
					</div>
					</br>
					<div id="payable_amount" >					
					<span class="left size14">Payable Amount:</span>
	
<span class="right  size14">  <div id="payableamount"> </div> </span>
	
	
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				
      </div></div> 
      
     
      <br/>
   </div>
</div>
<!-- END OF CONTENT -->
