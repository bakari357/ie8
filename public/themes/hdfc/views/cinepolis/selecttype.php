<style> #fancybox-inner {
	top: 10 !important;
	} 
	       #myElement1{ margin-left: 177px; margin-top: 117px}
	       #close1{cursor:pointer; float:left; margin-left:273px; margin-top:-1px;  }
	      	</style>
		<div>
			<!-- CONTENT -->
			<div>
		<div>
	
           <form action="cinepolis_showseats" id="persondetails" name="persondetails" method="post" >

	<div class="pbottom15 clearfix">
					<h5 class="cinehd21 npleft col-xs-9 col-md-9 col-lg-9"><?php  if(isset($movie)) echo $movie; ?></h5>
					<h6 class="textright npright col-xs-3 col-md-3 col-lg-3"><span> <?php  echo date('D, d M Y',strtotime($daterange)); ?></br> Cinepolis,&nbsp; <?php echo $city;?></span></h6>
	</div>
<div class="line3"></div>
<div class="clearfix"></div>
				
<input type="hidden" id="showtime"  class="type" name="showtime" value="<?php echo $Showtime; ?>" >
 <input type="hidden" id="daterange"  class="type" name="daterange" value="<?php echo $daterange; ?>" >
 <input type="hidden" id="cityid"  class="type" name="cityid" value="<?php echo $cityid; ?>" >
 <input type="hidden" id="theatreid"  class="type" name="theatreid" value="<?php echo $theatreid; ?>" >
 <input type="hidden" id="filmid"  class="type" name="filmid" value="<?php echo $filmid; ?>" >
 <input type="hidden" id="allclass"  class="type" name="allclass" value="<?php //echo $allclass; ?>" >
 <input type="hidden" id="time"  class="type" name="time" value="<?php //echo $time; ?>" >
 <input type="hidden" id="city"  class="type" name="city" value="<?php echo $city; ?>" >
<br>
				<div class="clearfix">
                <div>
                	<?php if(isset($Seatavailablity['FnSchedule_ShowDetailsResult']['Show_Out'])){$Seatavailabli=$Seatavailablity['FnSchedule_ShowDetailsResult']['Show_Out'];  $errstring=''; $vp='';$PR='';$NL='';$EX='';   }
if(array_key_exists(0,$Seatavailabli))
{

foreach($Seatavailabli as $class)
                                { 
 ?>
<input type="hidden" id="BookingId"  class="type" name="BookingId" value="<?php echo $class['BookingId']; ?>" >
 <input type="hidden" id="MovieName"  class="type" name="MovieName" value="<?php echo $class['MovieName']; ?>" >
<input type="hidden" id="ScreenId"  class="type" name="ScreenId" value="<?php echo $class['ScreenId']; ?>" >
<?php if(!empty($class['ErrorString']))
                                        { 

                                        $errstring=$class['ErrorString'];
                                        //echo $class['ErrorString'];
                                        }else{
                                ?>
                                <?php if(trim($class['ShowClass'])=='VP') 
                                  $vp=$vp+1;
                                   elseif(trim($class['ShowClass'])=='PR') 
                                  $PR=$PR+1;
                                    elseif(trim($class['ShowClass'])=='NL') 
                                 $NL=$NL+1;
                                   elseif(trim($class['ShowClass'])=='EX') 
                                  $EX=$EX+1;
                                  
                                   } } }else { if(!empty($Seatavailabli['ErrorString']))
                                        { 
                                        $errstring=$Seatavailabli['ErrorString'];
                                        //echo $class['ErrorString'];
                                        }else{ 
                                ?>
                                <?php if(trim($Seatavailabli['ShowClass'])=='VP') 
                                  $vp=$vp+1;
                                   elseif(trim($Seatavailabli['ShowClass'])=='PR') 
                                  $PR=$PR+1;
                                    elseif(trim($Seatavailabli['ShowClass'])=='NL') 
                                 $NL=$NL+1;
                                   elseif(trim($Seatavailabli['ShowClass'])=='EX') 
                                  $EX=$EX+1;
                                  
                                   } 

?>

<input type="hidden" id="BookingId"  class="type" name="BookingId" value="<?php echo $Seatavailabli['BookingId']; ?>" >
 <input type="hidden" id="MovieName"  class="type" name="MovieName" value="<?php echo $Seatavailabli['MovieName']; ?>" >
<input type="hidden" id="ScreenId"  class="type" name="ScreenId" value="<?php echo $Seatavailabli['ScreenId']; ?>" ><?php }?>
                    	
                    </div>
                    
                	<div class="ticket_details col-xs-10 npleft">
                	

                    	 <div class="pbottom15 nopad col-xs-6" >
									
					<span class="opensans size13" style="margin-top: -21px;"><b>Ticket type </b></span>
                            <div id="error_city"></div>
                           
                           
                            <select name="ClassId" id="ClassId" class="form-control">
                           
                                <?php if(!empty($vp)) { ?>
                                  <option value="VP">VIP</option>
                                   <?php }if(!empty($PR)) {?>
                                  <option value="PR">Premium</option>
                                   <?php } if(!empty($NL)) {?>
                                  <option value="NL">Normal</option>
                                  <?php } if(!empty($EX)){ ?>
                                  <option value="EX">Executive</option>
                                  <? } ?>
                                  
                                  </select>
                            </div>
                        
                       
                        <div id="error_movie"></div>
                    	<div class="pbottom15 col-xs-3">
									
	<span class="opensans size13"><b>Quantity </b></span><select name="seat" id="seat" class="date-next  form-control">
                           
                            <option value="1">1</option>
                            <option value="2">2</option>
                           <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            </select></div>
                        <br/>
                        <span class="col-xs-6" style="display:block;">Children aged 3 years and above will require a separate ticket.</span>
                    </div> 
                    <?php  ?>  
            <?php if(empty($errstring)) { ?>
           <a class="subm col-xs-2" style="margin-top: 16px;" href="javascript:;"  onclick="submitform();">Continue </a>         <?php  }?> 
                </div> 
               
        </form>             
           
    <script>
        function submitform()
{
form_data  =  $("#persondetails").serialize();
//alert(form_data);
$.post("<?=URL::to('cinepolis_select')?>", form_data, function(data)
		{
		 

		});


var search_name=document.getElementById('ClassId').value;
//alert(search_name);
var search_seat=document.getElementById('seat').value;
 var count=0;
 if($.trim($('#ClassId').val()) == '')
	{
		count=1;
		document.getElementById("ClassId").focus();
		$("#error_city").html("<font color='red'>Select the city</font>"); 
		return false;
    } 
if($.trim($('#seat').val()) == '')
	{
		count=1;
		document.getElementById("seat").focus();
		$("#error_movie").html("<font color='red'>Movie name Field is required</font>"); 
		return false;
    }

    
    if(count==0)
    {
    $("#error_city").hide;
    $("#error_movie").hide;
  $('#persondetails').submit();
  }
$('#persondetails').submit();
}

</script>
    </body>
</html>
