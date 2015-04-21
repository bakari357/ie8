<!-- END OF CONTENT -->
<script src="themes/hdfc/assets/assets/js/jquery.validate.js"></script>
<script>
$(document).ready(function() {
$("#exclusive_offer").hide();
$("#payable_amount").hide();
$.validator.addMethod("falpha", function(value, element) {
return this.optional(element) || /^[A-Za-z\s'\-]+$/i.test(value);
},  "Name field must contain only letters");
$.validator.addMethod("lalpha", function(value, element) {
return this.optional(element) || /^[A-Za-z\s'\-]+$/i.test(value);
},  "Last name field must contain only letters");
jQuery.validator.addMethod("numbersonly", function(value, element) {
    return this.optional(element) || /^[0-9\s]+$/i.test(value);
}, "This field only contain numbers."); 
 

		$("#passenger_checkout").validate({

		rules: {
		first_name : {
		required: {depends:function(){$(this).val($(this).val());return true;}},
		falpha:true
		},
		last_name : {
		required: {depends:function(){$(this).val($(this).val());return true;} },
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
		    },},
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
					<li><a href="#">Seat Layout</a></li>
					
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt8 offset-0">
			
			
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
					<span class="size16px bold dark left">Select your Seats </span>
					
					<div class="clearfix"></div>
					<div class="line4"></div>
<div class="seat"><ul> 
                        	<li><img src="<?php echo Theme::asset()->url('images/available_seat.jpg'); ?>" border="0" align="absmiddle"> Available</li>
                            <li><img src="<?php echo Theme::asset()->url('images/booked_seat.jpg'); ?>" border="0" align="absmiddle"> Booked</li>
                            <li><img src="<?php echo Theme::asset()->url('images/selected_seat.jpg'); ?>" border="0" align="absmiddle"> Your Selection</li>
                           
                           
                        </ul>
                  </div>
					
					
					<!--seat layout-->
		<form method="post" id="passenger_checkout" name="passenger_checkout" action="<?php echo $url = URL::action('cinepolisController@get_fun_final'); ?>" >		
<?php
$Seatavailablit[]=$Seatavailablity['seatlist']['ShowSeatsResult'];
//echo '<pre>';
//print_r($Seatavailablit);
//echo '</pre>';exit;
if($Seatavailablit['0']['ErrMessage']!='Available' && $Seatavailablit['0']['ErrMessage']!='Available')
{
echo '<b>'.$Seatavailablit['0']['ErrMessage'].'</b>';
}else{
 ?>
 
 
 
 
 
 
 

 <section class="table_div_change" style="border:none; border-top:1px solid #dfdfdf;" >
 
               <h3 class="new_info_class" style="float: right;color: #4a4949;font-size: 11px;margin-top: -39px;margin-right: -49px;">Class: <?php if($ClassId=='VP') echo 'vip';
 else if($ClassId=='PR') echo 'premium'.'' ;
 else if($ClassId=='NL') echo 'normal'.'';
 else if($ClassId=='EX') echo 'executive'.''; ?></h3>
              
               <h3 class="info_class" style="margin-top: -39px;margin-left: 363px;color: #4a4949;font-size: 11px;">Total Amount: &#8377; <span id="Total_Amount">0</span></h3>
 
                <div class="ticket_select_row" style="border:none">
                	<div class="seat_select">
<div id="changeclass">
<?php  $pcnt=1; foreach($Seatavailablit as $class)
{

//echo '<pre>';print_r($class);exit;
if(str_replace(' ','',$class['ShowClass'])==$ClassId)
{

?>
<div  <?php if($pcnt==1) echo 'class=""'; ?> id="<?php echo trim($class['ShowClass']); ?>" style="cursor: pointer; margin:0 0 0 5px;" onclick="gopage('<?php echo $class['TheatreId']; ?>','<?php echo $class['BookingId']; ?>','<?php echo trim($class['ShowClass']); ?>');"><?php 
 

 //$cuniqueid=arrayvalue_search($showlist,'ShowClass',$class['ShowClass']);



 /*foreach($cuniqueid as $needid)
 {
		//echo '<pre>';print_r($needid);exit;
 if($needid['ShowTime']=='1899-12-30T'.$time && str_replace(' ','',$needid['ShowClass'])==$type)
 {
// echo '<pre>';
 //print_r($needid);
 //echo '</pre>';

 echo '<input type="hidden" name="uid_'.trim($class['ShowClass']).'" id="uid_'.trim($class['ShowClass']).'" value="'.$needid['UId'].'" />';
 echo '<input type="hidden" name="bid_'.trim($class['ShowClass']).'" id="bid_'.trim($class['ShowClass']).'" value="'.$needid['BookingId'].'" />';
 }
 }



 //$cuniqueid1=arrayvalue_search($showlist,'ShowTime','1899-12-30T'.$time);
 //echo '<pre>';
 //print_r($cuniqueid);
 //echo '</pre>';*/


  ?>
</div>
<?php  $pcnt++; } } ?>
</div>
<div id="seatshow">

<div id="seatslayout">

<?php
foreach($Seatavailablit as $value)
{
if(str_replace(' ','',$value['ShowClass'])==$ClassId)
{


 $cinepolistimeseats = '';
		$responseseats=$Seatavailablity;

		
if(isset($responseseats)&& !empty($responseseats) && $responseseats['seatlist']['ShowSeatsResult']['StatusId']==1):

	$out='<ul>';

	
	$out .='<input name="selectedclass" type="hidden" id="selectedclass"value="'.$responseseats['seatlist']['ShowSeatsResult']['ShowClass'].'" />
    <input name="ticketprice" type="hidden" id="ticketprice" value="'.$responseseats['seatlist']['ShowSeatsResult']['TotalCharge'].'"  />';
	

	foreach($responseseats['seatlist']['ShowSeatsResult']['AvailableSeats']['Seat'] as $seats)
	{

	$row[]=$seats['Row'];

	}
	$rows=array_unique($row);
         
	foreach($rows as $key=>$singlerow)
	{
	$finalseats=$responseseats['seatlist']['ShowSeatsResult']['AvailableSeats']['Seat'];
 
	//$out .='<li>&nbsp;</li>';
	$out .='</ul><ul><li>'.$singlerow.'</li><li>&nbsp;</li>
                            <li>&nbsp;</li>
                            ';
                         //  echo '<pre>'; print_r($finalseats);exit;
	$count=1;foreach($finalseats as $singlerows)
	{
	//echo '<pre>'; print_r($singlerows);exit;
       if($singlerow==$singlerows['Row'])
{
	$out .='<li style="cursor:pointer" onclick="selectseat(\'td_'.$singlerow.'_'.$singlerows['Col'].'\',\''.$singlerow.'\',\''.$singlerows['Col'].'\',36)" ><img class="navailable" id="td_'.$singlerow.'_'.$singlerows['Col'].'" src="'.Theme::asset()->url('images/available_seat.jpg').'" border="0"></li>';
	
	if($count==20)
		       {
		       $out .='';
		       }
		       $count=$count+1;
}
		        }
	//$out .='</tr>';
	//$out .='<tr>&nbsp;</tr>';

	}

	$out .='</ul>';


	echo $out;
 else: ?>
		<?php $out='<ul>';
			$out .='<li><td>&nbsp;</li>';
			$out .='<li style="width: 300px;">'.$responseseats['seatlist']['ShowSeatsResult']['ErrMessage'].'</li>';
			$out .='</ul>';
			
			
			echo $out;
			 ?>
	<?php endif; } }?>
	
	</div></div>
<div class="screen_link">
                        	<a href="#"><img src="<?php echo Theme::asset()->url('images/screen_link.jpg'); ?>" border="0"></a>
                        </div>
                    </div>
                  
                </div> 
               
                        
                    
            </section>
        
<?php } ?>

<script>
	function gopage(tid,bid,classid)
	{
	$("#changeclass p").removeClass('highlight');
	$("#"+classid).addClass('highlight');
	$.post("cinepolis/getseats", {tid:tid,bid:bid,classid:classid}, function(data){
	$("#seatcount").val(0);
	$("#seats").val('');
	//document.getElementById("Ticket_Amount").innerHTML = "0";
	//document.getElementById("confee_label").innerHTML = "0";
	//document.getElementById("servicefee_label").innerHTML = "0";
	document.getElementById("Total_Amount").innerHTML = "0";
	$("#uniqueid").val($("#uid_"+classid).val());
	$("#bookid").val($("#bid_"+classid).val());
	$("#seatslayout").html(data);
	});
	}



 	var seats = new Array();
        function selectseat(tdid, row, col, count) {
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
                var tp = document.getElementById("ticketprice").value * j;
                var cp = 10 * j;
                //var Sp = (cp * 12.36) / 100;
                var Sp = 1.24 * j;
                //document.getElementById("Ticket_Amount").innerHTML = tp;
                //document.getElementById("confee_label").innerHTML = cp;
                //document.getElementById("servicefee_label").innerHTML = Sp.toFixed(2);
                document.getElementById("Total_Amount").innerHTML = Math.round(tp + Sp + cp);
                document.getElementById("Total_Amount2").innerHTML = Math.round(tp + Sp + cp);
                document.getElementById("seatcount").value = j;
                 
                
                $("#totalamount").val(tp + Sp + cp);
                $("#servicetax").val(Sp.toFixed(2));
                $("#convfee").val(cp);
                $("#"+tdid).attr('src',"<?php echo Theme::asset()->url('images/available_seat.jpg'); ?>");
                return false;
            }
            if (j >= <?php echo $seat; ?>) {
                alert("You have already selected "+<?php echo $seat; ?>+" seats. To select more seats please change quantity and try again.");
                return false;
            }
            if (document.getElementById(tdid).className == "navailable") {
                //alert(document.getElementById(tdid).className);
                document.getElementById(tdid).className = "ncurrent";
                seats[j] = row + ":" + col;

                //alert(seats[j]);
                j++;
                var tp = document.getElementById("ticketprice").value * j;
                var cp = 10 * j;
                //var Sp = (cp * 12.36) / 100;
                var Sp = 1.24 * j;

                //document.getElementById("Ticket_Amount").innerHTML = tp;
                //document.getElementById("confee_label").innerHTML = cp;
                //document.getElementById("servicefee_label").innerHTML = Sp.toFixed(2);
              document.getElementById("Total_Amount").innerHTML = Math.round(tp + Sp + cp);
               var amount     =document.getElementById("Total_Amount").innerHTML;
  document.getElementById("Total_Amount2").innerHTML = Math.round(tp + Sp + cp);
                document.getElementById("seatcount").value = j;
                
                //calling ajax
                            
                            var total_amount = Math.round(tp + Sp + cp);
                          	$.ajax({
			url : "get_smartbyoffercinepolis",
			type: "POST",
			data : { partner: 2, total_amount:total_amount},
			 dataType: "json",
			success: function(response, textStatus, jqXHR)
			{    if(response.discount_amount !='')
			     {
			      $("#exclusive_offer").show();
                              $("#payable_amount").show(); 
                             }
			  var result = jQuery.parseJSON(response.discount_amount);
			   
			 document.getElementById("discountamount").innerHTML = '₹ '+ result;
			 document.getElementById("payableamount").innerHTML = '₹ '+ (total_amount - result);
				
			}
			});
                
                
                $("#totalamount").val(tp + Sp + cp);
                $("#amount").val(tp + Sp + cp);
                $("#servicetax").val(Sp.toFixed(2));
                $("#convfee").val(cp);
                 $("#"+tdid).attr('src',"<?php echo Theme::asset()->url('images/selected_seat.jpg'); ?>");
            }


            var seatsno = seats.join(",");
            //  alert(seatsno);
            document.getElementById("seats").value = seatsno;
          
        }
         function seatvalidate() {
            var k = document.getElementById("seatcount").value;
            var qty=<?php echo $seat; ?>;
            
            if (k == qty) {
            $('#persondetails').submit();
                
            }else{
            alert("You have already selected "+qty+" seats in previous page.So Please Book same "+qty+"  seat(s)");
                return false;
            }
        }


</script>


  <input type="hidden" name="BookingId" id="BookingId" value="<?php echo $BookingId; ?>" />
    <input type="hidden" name="seatcount" id="seatcount" value="0" />
      <input name="seats" type="hidden" id="seats" />
      <input type="hidden" id="pid" name="pid" value="10" />
      <input type="hidden" id="convfee" name="convfee" />
 <input type="hidden" id="amount" name="amount" />
    <input type="hidden" id="servicetax" name="servicetax" />
    <input type="hidden" id="totalamount" name="totalamount" />
<input type="hidden" id="city" name="city" value="<?php echo $city; ?>" />
   <input type="hidden" value="23" name="pid" id="pid" />
   <input name="ctype" type="hidden" id="ctype" value="movie1" />
  <input type="hidden" id="moviename" name="moviename"  value="<?php echo $MovieName; ?>"/>
   <input type="hidden" value="<?php echo $ScreenId ;?>" name="ScreenId" id="ScreenId" />
   <input name="filmid" type="hidden" id="filmid" value="<?php echo $filmid;?>" />
    <input name="theatreid" type="hidden" id="theatreid" value="<?php echo $theatreid;?>" />
      <input name="QTY" type="hidden" id="QTY" value="<?php echo $seat;?>"/>
    <input name="showtime" type="hidden" id="showtime" value="<?php echo $showtime;?>" />
      <input name="showdate" type="hidden" id="showdate" value="<?php echo $showdate;?>"/>

 
   
<script>
        function submitform()
{


            $('#persondetails').submit();
      
 
}
</script>
		<?php		if(isset($responseseats['seatlist']['ShowSeatsResult']['TicketRate']) && !empty($responseseats['seatlist']['ShowSeatsResult']['TicketRate'])) ?>
					
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
					</div>
					<div class="clearfix"></div><br><br>
( All email notifications will be sent to the above address).<br/> <br/>

	
					<span class="size16px bold dark left">Review and book your movie ticket.</span>
					<div class="roundstep right">3</div>
					<div class="clearfix"></div>
					<div class="line4"></div><div class="alert alert-info" style="color:#3a87ad;margin-top: 25px;margin-bottom: 20px;margin-left: 1%;text-shadow: 0 1px 0 rgba(255,255,255,0.5);background-color: #EBF2F7;border: 1px solid #2296EA;
-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;padding: 8px 15px 8px 14px;position: relative;width: 98%;border: teal;background-color: #d9edf7;border-color: #bce8f1;">	<b> <span class="attention">Attention!</span><span class="attention_sub"> Please read important movie ticket information!<span></b><br/><br/>
					<p class="size12" style="font-size: 13px">• This ticket is booked though our partner Cinepolis.</p>
					<p class="size12" style="font-size: 13px;">• For all queries and/or activities related to booking, please contact us at support@smartbuy.com and  1860 425 3322.</p>
<p class="size12" style="font-size: 13px;">• HDFC Bank SmartBuy is not responsible for any cancellations that occur at the partner side. </p>
<p class="size12" style="font-size: 13px;">• All bookings are subject to Partner terms and conditions.</p>
<p class="size12" style="font-size: 13px;">• Movie tickets booked through the portal cannot be cancelled or modified.</p>


					</div>	
 By clicking on continue booking I acknowledge that I have read and accept the rules & restrictions,
<?php echo HTML::link('content/Terms & Conditions', 'Terms & Conditions',array('target'=>'_blank')); ?> and <?php echo HTML::link('content/Privacy Policy', ' Privacy Policy',array('target'=>'_blank'));?>.<br>
					
				
				
					</div>
		<div class="col-xs-12 col-md-12 col-lg-4 pull-right">
<input type="submit" name="go" id="submit"  class="btn-search"" value="Continue Booking"/></div><br/><br/><br/>		
			</div>
			<!-- END OF LEFT CONTENT -->			

			<!-- END OF LEFT CONTENT -->		
		<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						<span class="opensans size18 dark bold"><?php  if(isset($MovieName)) echo $MovieName; ?></span><br/>
						<span class="opensans size13 grey"> <?php  echo date('D, d M Y',strtotime($showdate)); ?>, Cinepolis - <?php echo $city;?> , <?php echo  $ScreenId ;?></span><br/>
					</div>
					<div class="line3"></div>
					
					<div class="hpadding30 margtop30">
						<table class="table table-bordered margbottom20">
							<tr><td>
               			<?php if($seat>1){?>Tickets<?php } else {?>Ticket <?php } ?></td><td class="center"> <?php if(isset($seat) ) echo $seat;?></td>
							<tr><td>Class</td>
							<td class="center"><?php  if(isset($ClassId) ) if($ClassId=='VP') echo 'Vip'.''.'  Class';
 else if($ClassId=='PR') echo 'Premium'.''.'  Class' ;
 else if($ClassId=='NL') echo 'Normal'.''.'  Class';
 else if($ClassId=='EX') echo 'Executive'.''.'  Class';?>
	</tr>						
							<tr>
								<td>Show Date</td>
								<td class="center"><?php  if(isset($showdate)) echo $showdate ; ?></td>
							</tr>

							<tr>
								<td>Show Time</td>
								<td class="center"><?php  if(isset($showtime)) echo $showtime ; ?></td>
							</tr>
							<!--<tr>
								<td >Ticket</td>
								<td> <?php  if(isset($check_data['amount'])) echo $check_data['amount'] ; ?></td>
							</tr>
							<!--<tr>
								<td colspan=2>Service fee</td>
								<td>1.24</td> 
								
							</tr>-->
						</table>
					</div>	
					<div class="line3"></div>
         
	
	
	
	
	<div class="padding20">
            <span class="left size14 "  style="width: 120px;">Booking Total: <span style="font-size:10px"></br> <span class="red"></span> </span></span>
            <div class="right"> <div style ="float:left"> &#8377; </div><div id="Total_Amount2" class="right" style="margin-left: 7px;width: 50px;" >0</div>
            <div class="clearfix"></div>
            <span style="font-size:10px"> <span class="red"></span>(Inclusive Tax) </span>
           
            </div>
            </span>
         
         </div>   
          
					<div id="exclusive_offer" class="padding20">					
					<span class="left size14 ">SmartBuy Exclusive Offer:</span>

<span class="right"  style="margin-left: 7px;width: 58px; color:#e20613;">   <div id="discountamount"> </div> </span>  
						
					</div>
					
					<div id="payable_amount" class="padding20">					
					<span class="left size14 ">Net Payable Amount:</span>
	
<span class="right"  style="margin-left: 7px;width: 58px;">  <div id="payableamount"> </div> </span>
	
	
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				
      </div>
      </div>
      <br/>
   </div>
</div>
	<!-- END OF CONTENT -->
	

	</form>
	
<script>
$(document).ready(function() {
$('.emi_details').hide();
		$('.payment').change(function() {
			
			var paytype=$('input[name=payment]:checked', '#passenger_checkout').val()
			console.log(paytype);
			if(paytype==3)
			{
				$('.emi_details').show();
				$('.emi_showup').hide();
				$('.emi').prop('checked', false);
			}
			else
			{
			  $('.emi_details').hide();
			}
		});

		$('.emi').change(function() {


				if($(".emi").is(':checked'))
				{
				$('.emi_showup').show();

				}
				else
				{
				$('.emi_showup').hide();
				}



		});});
</script>

	
