 <link href="themes/hdfc/assets/updates/update1/css/style01.css" rel="stylesheet" media="screen">
<script src="themes/hdfc/assets/js/goibibo/price_update.js"></script> 
<script src="themes/hdfc/assets/js/script.js"></script> 
	<script src="themes/hdfc/assets/assets/js/jquery.validate.js"></script>
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><?php echo HTML::link('flight_index', 'Flights'); ?></li>
					<li>/</li>
					<li><a href="javascript:;">Checkout</a></li>
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt8 offset-0">
			
	<form method="post" action="<?php echo $url = URL::action('Goibibo@continue_checkout'); ?>" id="passenger_checkout" >
            <?php if(isset($json_decoded) && $json_decoded<>'')
            {
            ?>    
            <input type="hidden" name="reprice_data" value="<?php echo urlencode(json_encode($json_decoded));?>"/>
            <?php } ?>
            
            
            <?php
            if(isset($clear_select) && $clear_select<>'')
            {
            ?>
            <input type="hidden" name="clear_select" value="<?php echo urlencode(json_encode($clear_select));?>">
            <?php
            }
            ?>
            <?php
            if(isset($return_select) && $return_select<>'')
            {
            ?>
            <input type="hidden" name="return_select" value="<?php echo urlencode(json_encode($return_select));?>">
            <?php
            }
            ?>
            <?php
            if(isset($fuldata) && $fuldata<>'')
            {
            ?>
             <input type="hidden" name="fuldata" value="<?php echo $fuldata;?>">
            <?php } ?>
            
            <input type="hidden" name="tickets" value="<?php echo $tickets;?>">
            <input type="hidden" name="clearpost" value="<?php echo urlencode(json_encode($book_passsenger));?>">
        <?php if(isset($booking_data) && $booking_data<>'')
        {
        ?>
        <input type="hidden" name="booking_data" value="<?php echo $booking_data;?>" >
            
        <input type="hidden" name="query_data" value="<?php echo urlencode($querydata);?>" >   <!--
        
        
        <input type="text" name="fare" value="<?php //echo $fare;?>" >  
        <input type="text" name="searchKey_onward" value="<?php //echo $searchKey_onward;?>" >  -->
        <?php } ?>
        
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey" >
				
				
					<span class="size16px bold dark left">Who's traveling?
</span>
					<div class="roundstep right">1</div>
					<div class="clearfix"></div>
					<div class="line4"></div>
					
					<!-- ROW -->
					<div class="row">
					<?php 
					$i=0;
					if(isset($adults) && $adults<>'')
					{
					$j=$adults+3;
					for($i=3;$i<$j;$i++)
					{
					 ?>
                                                <div class="col-md-2">
							<span class="size12">Title<font color="red"> *</font></span>
                                                        <select class="form-control "  name="title<?php echo $i;?>" id="title<?php echo $i;?>">
                                                                    <option value="Mr">Mr</option>
                                                                    <option value="Mrs">Mrs</option>
                                                                    <option value="Miss">Miss</option>
                                                        </select>
						</div>
                                            
						<div class="col-md-3">
							<span class="size12">First Name<font color="red">  * </font></span>
                                                        
							<input type="text" name="firstname<?php echo $i;?>" id="firstname<?php echo $i;?>" class="form-control " placeholder="">
						</div>
						<div class="col-md-3">
							<span class="size12">Last Name<font color="red"> *</font></span>
							<input type="text" name="lastname<?php echo $i;?>" id="lastname<?php echo $i;?>" class="form-control " placeholder="">
						</div>
						<div class="col-md-3">
							
								<span class="size12">DoB<font color="red"> *</font></span>
								<input type="text"name="datepicker<?php echo $i;?>" readonly  class="form-control mySelectCalendar" id="datepicker<?php echo $i;?>" style="background-color:white;" placeholder="dd-mm-yy"/>
							
                                                    <script>
                                                    $(document).ready(function() {
                                                    $( "#datepicker<?php echo $i;?>" ).datepicker({
                                                    dateFormat: 'dd-mm-yy',	
                                                    changeMonth: true,
                                                    changeYear: true,
                                                    maxDate: '-18Y',
                                                    yearRange: "-75:+0"	

                                                    });


                                                    });
                                                    </script>
                                                 </div>   
                                                    
							<div class="col-md-1 col-xs-6">
								
									
<span class="newspan size12" style="margin-left: 8px;">Gender</span>
									<div class="radio ">
									 
										<input type="radio" checked="" name="gender<?php echo $i;?>" id="optionsRadios2" value="1" >Male
										
									  
									</div>
									<div class="radio ">
									 
										<input type="radio" name="gender<?php echo $i;?>" id="optionsRadios2" value="2"  >Female
										
									  
									</div>
								</div>
                                                      				
						
						
						<div class="clearfix"></div><br/>
						
						
                                        <?php } } ?>        
					
                                        </div>
					<div class="row">
					<?php 
					
					if(isset($children) && $children<>'')
					{
					$j=$j=$adults+$children+3;
					for($i=3+$adults;$i<$j;$i++)
					{
					 ?>
                                                
					        <div class="col-md-2">
							<span class="size12">Title<font color="red"> *</font></span>
                                                        <select class="form-control "  name="title<?php echo $i;?>" id="title<?php echo $i;?>">
                                                                    <option value="Mr">Mr</option>
                                                                    <option value="Mrs">Mrs</option>
                                                                    <option value="Miss">Miss</option>
                                                                </select>
						</div>
                                            
						<div class="col-md-3">
							<span class="size12">First name<font color="red"> *</font></span>
							<input type="text" name="firstname<?php echo $i;?>" id="firstname<?php echo $i;?>" class="form-control " placeholder="">
						</div>
						<div class="col-md-3">
							<span class="size12">Last Name<font color="red"> *</font></span>
							<input type="text" name="lastname<?php echo $i;?>" id="lastname<?php echo $i;?>" class="form-control " placeholder="">
						</div>
						<div class="col-md-3">
							
								<span class="size12">DoB<font color="red"> *</font></span>
								<input type="text"name="datepicker<?php echo $i;?>" readonly  class="form-control mySelectCalendar" id="datepicker<?php echo $i;?>" style="background-color:white;" placeholder="dd-mm-yy"/>
							
                                                    <script>
                                                    $(document).ready(function() {
                                                    $( "#datepicker<?php echo $i;?>" ).datepicker({
                                                    dateFormat: 'dd-mm-yy',	
                                                    changeMonth: true,
                                                    changeYear: true,
                                                    maxDate: '-2Y',
                                                    minDate: '-18Y',
                                                    yearRange: "-12:+0"	

                                                    });


                                                    });
                                                    </script>
                                                 </div>   
                                                    
							<div class="col-md-1 col-xs-6">
								
									
<span class="newspan size12" style="margin-left: 8px;">Gender</span>
									<div class="radio ">
									 
										<input type="radio" checked="" name="gender<?php echo $i;?>" id="optionsRadios2" value="1" >Male
										
									  
									</div>
									<div class="radio ">
									 
										<input type="radio" name="gender<?php echo $i;?>" id="optionsRadios2" value="2"  >Female
										
									  
									</div>
								</div>
                                                       
						
						<div class="clearfix"></div><br/>
						
						
                                        <?php } } ?>        
					</div>
					
					<div class="row">
					<?php 
					
					if(isset($infants) && $infants<>'')
					{
					$j=$j=$infants+$adults+$children+3;
					for($i=3+$adults+$children;$i<$j;$i++)
					{
					 ?>
                                                      <div class="col-md-2">
							<span class="size12">Title<font color="red"> *</font></span>
                                                        <select class="form-control "  name="title<?php echo $i;?>" id="title<?php echo $i;?>">
                                                                    <option value="1">Mr</option>
                                                                    <option value="2">Mrs</option>
                                                                </select>
						</div>
                                            
						<div class="col-md-3">
							<span class="size12">First name<font color="red"> *</font></span>
							<input type="text" name="firstname<?php echo $i;?>" id="firstname<?php echo $i;?>" class="form-control " placeholder="">
						</div>
						<div class="col-md-3">
							<span class="size12">Last Name<font color="red"> *</font></span>
							<input type="text" name="lastname<?php echo $i;?>" id="lastname<?php echo $i;?>" class="form-control " placeholder="">
						</div>
						<div class="col-md-3">
							
								<span class="size12">DoB<font color="red"> *</font></span>
								<input type="text"name="datepicker<?php echo $i;?>" readonly class="form-control mySelectCalendar" id="datepicker<?php echo $i;?>" style="background-color:white;" placeholder="dd-mm-yy"/>
							
                                                    <script>
                                                    $(document).ready(function() {
                                                    $( "#datepicker<?php echo $i;?>" ).datepicker({
                                                    dateFormat: 'dd-mm-yy',	
                                                    changeMonth: true,
                                                    changeYear: true,
                                                    maxDate: 0,
                                                    minDate: '-2Y',
                                                    yearRange: "-12:+0"	

                                                    });


                                                    });
                                                    </script>
                                                 </div>   
                                                    
							<div class="col-md-1">
								
									
<span class="newspan size12" style="margin-left: 8px;">Gender</span>
									<div class="radio ">
									 
										<input type="radio" checked="" name="gender<?php echo $i;?>" id="optionsRadios2" value="1" >Male
										
									  
									</div>
									<div class="radio ">
									 
										<input type="radio" name="gender<?php echo $i;?>" id="optionsRadios2" value="2"  >Female
										
									  
									</div></div>
                                                       
						
						<div class="clearfix"></div><br/>
						
						
                                        <?php } } ?>        
					</div>
					
					
					
					<!-- END OF ROW -->
					
					
					
					
					
                                        <!-- ROW -->
					
					
					
				
					<span class="size16px bold dark left">Where can we reach you?
 </span>
					<div class="roundstep right">2</div>
					<div class="clearfix"></div>
					<div class="line4"></div>
					
					<?php	$view = View::make('checkout/common_flights');	echo $view;?><br/>
<!--					<div class="col-md-4 textright">
						<div class="margtop15"><span class="dark">Contact Name:</span><span class="red"><font color="red"> *</font></span></div>
					</div>
					<div class="col-md-4">
						<span class="size12">First and Last Name<font color="red"> *</font></span>
						<input type="text" class="form-control " name="name" id="name" placeholder="">
					</div>
					<div class="col-md-4 textleft margtop15">
					</div>
					<div class="clearfix"></div>
					
					<br/>
					<div class="col-md-4 textright">
						<div class="margtop7"><span class="dark">Phone Number:</span><span class="red"><font color="red"> *</font></span></div>
					</div>
					
					<div class="col-md-4 textleft">
						<span class="size12">Preferred Phone Number<font color="red"> *</font></span>	
						<input type="text" class="form-control" placeholder="" name="phonenumber" id="phonenumber">
					</div>
					<div class="clearfix"></div>

					<br/>
					<div class="col-md-4">
					</div>
					<div class="clearfix"></div>
                                        <br/>
                                        <div class="col-md-4 textright">
						<div class="margtop7"><span class="dark"></span><span class="red"></span></div>
					</div>
					
					<div class="clearfix"></div>
                                        <br/>
                                        
                                     
                                        <span class="size16px bold dark left">Contact Info </span>	
					<div class="roundstep right">3</div>
					<div class="clearfix"></div>
					<div class="line4"></div>	
				
				Please enter the email address where you would like to receive your confirmation.<br/> 
					
					
					<div class="col-md-4 textright">
						<div class="mt15"><span class="dark">Email Address:</span><span class="red"><font color="red"> *</font></span></div>
					</div>
					<div class="col-md-4">
						<input type="text" class="form-control margtop10" placeholder="" name="s_email" id="email">
					</div>
					<div class="col-md-4 textleft">
					</div>                                       -->
                                        
                                  
					<div class="clearfix"></div>
<!--					<span class="size16px bold dark left">Review and book your trip</span>
					<div class="roundstep right">5</div>
					<div class="clearfix"></div>
					<div class="line4"></div>		
                                        
					<div class="alert alert-info">-->
                                            
					<div class="alert alert-info">
				        <?php
                                         if(isset($clear_select) && $clear_select<>'')
                                        {
                                        echo Lang::get('partners.cleartrip.checkout');
                                        }
                                        else
                                        {
                                        echo Lang::get('partners.goibibo.checkout');    
                                        }
                                        ?>
                                        </div>
					  
                                          By clicking on continue booking I acknowledge that I have read and accept the rules & restrictions,
 <?php echo HTML::link('content/Terms & Conditions', 'Terms & Conditions'); ?> and <?php echo HTML::link('content/Privacy Policy', ' Privacy Policy');?>.<br>
<div class="col-xs-12 clearfix nopad pbottom15">

		<div class="col-xs-12 col-md-4 col-lg-4 pull-right">
		<input type="submit" name="go" id="submit" onclick="save_customer();" class="btn-search" value="Continue Booking"/>		<br/><br/>
                                            
			</div>		
		</div>					

    
					
</form>			
                    
                    
				</div>
                            <div id="toPopupajax" style="height:243px;top:36%;display:none;"> 
 <img src="<?php print_r(Config::get('app.url'))?>themes/hdfc/assets/images/ajax-loader.gif">
</div>

<div id="toPopup" class="container col-xs-12" style="height:243px;top:36%; margin-left:-15px"> 
    <div class="topopup-inner">
        <div class="close"></div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
       	<div> 
       

		<div id="popup_content" > <!--your content start-->
   
       </div> <!--your content end-->
    </div>
    </div>
   </div> <!--toPopup end-->
	<div class="loader"></div>
   	<div id="backgroundPopup"></div>
		
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
                                        <span class="dark"><b>Onward Flights</b></span>
                                        
                                                <div class="fdash mt10"></div><br/>
                                        
                                        <?php
                                        $count_faretype=0;
                                        foreach($onw_return as $onward)
                                        {
                                            ?>
					<div>
                                            <table border="0" > 
                                                    <tr>
                                                        <td width="70px">
                                                <img src="themes/hdfc/assets/images/via/<?php echo $onward['car_id'];?>.gif"  />
                                                
                                                        </td>
                                                        <td valign="top" width="80px">
                                                    <font size="1">
                                                    <?php  
                                                   
                                                    echo $onward['car_id'].' - '.$onward['fnum']."<br/>";
                                                    echo $faretype[0]['fare_type'];
                                                    ?>
                                                    
                                                    </font>      
                                                    </td>
                                                        <td valign="top">
                                                        <font size="1">
                                                            <?php echo date('D d M Y',strtotime(str_replace("T","",$onward['dst_tym'])));?>      
                                                        </font>    
                                                        </td>
                                                    </tr>
                                            </table>
                                            <br/>
						<div class="wh33percent left size12 bold dark">
							<?php echo strtoupper($onward['sour']);
                                                        
                                                        ?>
						</div>
						<div class="wh33percent left center size12 bold dark">
							
						</div>
                                                
						<div class="wh33percent right textright size12 bold dark">
							<?php echo strtoupper($onward['desti']);?>
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
                                                    <?php echo  date('g:i A',strtotime(str_replace("T"," ",$onward['arr_tym']))); ?>
                                                  
						</div>
						<div class="wh33percent left center size12">
                                                    <?php
							//if(isset($con_origin) && $con_origin<>'')
                                                        //{
                                                          //echo $con_deptime;  
                                                        //}
                                                     ?>    
						</div>
						<div class="wh33percent right textright size12">
						<font size="1">
                                                    <?php echo  date('g:i A',strtotime(str_replace("T"," ",$onward['dst_tym']))); ?>
                                                </font>    
						</div>
						<div class="clearfix"></div>
					</div><br/>
                                        <?php 
                                        $count_faretype++;
                                        } 
                                        if(isset($ret_return) && $ret_return<>'')
                                        {
                                        ?>
                                        
                                        <span class="dark"><b>Return Flights</b></span>
                                        
                                                <div class="fdash mt10"></div><br/>
                                                
                                                
                                        <?php
                                        
                                        foreach($ret_return as $return)
                                        {
                                            ?>
					<div>
                                            <table border="0" > 
                                                    <tr>
                                                    <td width="70px">
                                                    <img src="themes/hdfc/assets/images/via/<?php echo $return['car_id'];?>.gif"  />
                                                    
                                                    </td>
                                                    <td valign="top" width="80px">
                                                    <font size="1">
                                                    <?php  echo $return['car_id'].' - '.$return['fnum'];?><br/>
                                                    <?php echo $faretype_return[0]['fare_type']; ?>
                                                    </font>      
                                                    </td>
                                                    <td valign="top">
                                                    <font size="1">
                                                    <?php echo date('D d M Y',strtotime(str_replace("T","",$return['dst_tym'])));?>      
                                                    </font>
                                                    </td>
                                                    </tr>
                                            </table>
                                            <br/>
						<div class="wh33percent left size12 bold dark">
							<?php echo strtoupper($return['sour']);
                                                        
                                                        ?>
						</div>
						<div class="wh33percent left center size12 bold dark">
							
						</div>
                                                
						<div class="wh33percent right textright size12 bold dark">
							<?php echo strtoupper($return['desti']);?>
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
                                                    <?php echo  date('g:i A',strtotime(str_replace("T"," ",$return['arr_tym']))); ?>
                                                  
						</div>
						<div class="wh33percent left center size12">
                                                    <?php
							//if(isset($con_origin) && $con_origin<>'')
                                                        //{
                                                          //echo $con_deptime;  
                                                        //}
                                                     ?>    
						</div>
						<div class="wh33percent right textright size12">
                                                    <?php echo  date('g:i A',strtotime(str_replace("T"," ",$return['dst_tym']))); ?>
						</div>
						<div class="clearfix"></div>
					</div><br/>
                                        <?php } 
                                        }?>
					<!-- END OF GOING TO -->
					
					
					
					
					
					<br/>
					

    
					<span class="dark"><?php echo $tickets;?>  Tickets</span>
                                        
                                        <?php
                                        if(isset($adultbasefare) && $adultbasefare<>'')
                                        {
                                        ?>
					<div class="fdash mt10"></div><br/>
					<?php echo $adults;?> Adult <span class="right">₹ <?php echo round($adult_final_price);?></span>
					<!-- Collapse 1 -->	
					<button type="button" class="collapsebtn3 collapsed mt-5" data-toggle="collapse" data-target="#collapse1"></button>
					<div id="collapse1" class="collapse in">
						<div class="left size14">
							Flight<br/>
							Taxes & Fees 
						</div>
						<div class="right size14">
							₹ <?php 
                                                        if(isset($adultbasefare_return) && $adultbasefare_return<>'')
                                                        {
                                                        echo round($adults*($adultbasefare+$adultbasefare_return));
                                                        }
                                                        else
                                                        {
                                                        echo round($adults*$adultbasefare);    
                                                        }
                                                        ?><br/>
							₹ <?php 
                                                        if(isset($adulttax_return) && $adulttax_return<>'')
                                                        {
                                                            
                                                        echo round($adults*($adulttax+$adulttax_return));
                                                        }
                                                        else
                                                        {
                                                         echo round($adults*$adulttax);   
                                                        }
                                                        ?>
						</div><div class="clearfix"></div>	
					</div>
                                        <?php } ?>
					<!-- End of collapse 1 -->
					
					<?php
                                        if(isset($childrenbasefare) && $childrenbasefare<>'')
                                        {
                                        ?>
					<div class="fdash mt10"></div><br/>
					<?php echo $children;?> Children <span class="right">₹ <?php echo round($children_final_price);?></span>
					<!-- Collapse 1 -->	
					<button type="button" class="collapsebtn3 collapsed mt-5" data-toggle="collapse" data-target="#collapse2"></button>
					<div id="collapse2" class="collapse in">
						<div class="left size14">
							Flight<br/>
							Taxes & Fees 
						</div>
						<div class="right size14">₹
                                            <?php 
                                            if(isset($childrenbasefare_return) && $childrenbasefare_return<>'')
                                            {
                                            echo round($children*($childrenbasefare+$childrenbasefare_return));
                                            }
                                            else
                                            {
                                            echo round($children*$childrenbasefare);    
                                            }
                                            ?><br/>
                                            ₹ <?php 
                                            if(isset($childtax_return) && $childtax_return<>'')
                                            {

                                            echo round($children*($childtax+$childtax_return));
                                            }
                                            else
                                            {
                                            echo round($children*$childtax);   
                                            }
                                            ?>
						</div><div class="clearfix"></div>	
					</div>
                                        <?php } ?>
                                        
                                        <?php
                                        if(isset($infantsbasefare) && $infantsbasefare<>'')
                                        {
                                        ?>
					<div class="fdash mt10"></div><br/>
					<?php echo $infants;?> Infants <span class="right">₹ <?php echo round($infants_final_price);?></span>
					<!-- Collapse 1 -->	
					<button type="button" class="collapsebtn3 collapsed mt-5" data-toggle="collapse" data-target="#collapse3"></button>
					<div id="collapse3" class="collapse in">
						<div class="left size14">
							Flight<br/>
							Taxes & Fees 
						</div>
						<div class="right size14">
                                            ₹ <?php 
                                            if(isset($infantsbasefare_return) && $infantsbasefare_return<>'')
                                            {
                                            echo round($infants*($infantsbasefare+$infantsbasefare_return));
                                            }
                                            else
                                            {
                                            echo round($infants*$infantsbasefare);    
                                            }
                                            ?><br/>
                                            ₹ <?php 
                                            if(isset($infantstax_return) && $infantstax_return<>'')
                                            {

                                            echo round($infants*($infantstax+$infantstax_return));
                                            }
                                            else
                                            {
                                            echo round($infants*$infantstax);   
                                            }
                                            ?>
						</div><div class="clearfix"></div>	
					</div>
                                        <?php } ?>
					
					

					<br/>
					<br/>

					
					
					</div>	
					<div class="line3"></div>
					<div class="padding30">					
						<span class="left size14 dark">Booking Total</span>
                                                <span id="priceloader" style="margin-left:10px;" ></span>
						<span class="right lred2 bold size18" style="color:#FF0014" >₹ <?php echo round($adults*$adult_final_price+$children*$children_final_price+$infants*$infants_final_price); ?>
                                                <br/>
                                                
                                                 <font  size="1" color="grey">( Inclusive Tax )</font>
                                                </span>
                                                
                                                <input type="hidden" id="price_final" name="price_final">
                                               
						<div class="clearfix"></div>
					</div>
                                           

				</div><br/>
				
				
				
				
			
				
			
			</div>
			<!-- END OF RIGHT CONTENT -->
			
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
        
        
<script type="text/javascript" >
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
firstname3 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;}},
falpha:true
},
lastname3 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
datepicker3 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        

firstname4 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
lastname4 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
datepicker4 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
firstname5 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
lastname5 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
datepicker5 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        


firstname6 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
lastname6 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
datepicker6 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
firstname7 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
lastname7 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
datepicker7 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
firstname8 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
lastname8 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
datepicker8 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
firstname9 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
lastname9 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
datepicker9 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },

},        
firstname10 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
lastname10 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
datepicker10 : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},        
name : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
falpha:true
},
countrycode : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }

},
phonenumber : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;},number:true },
number:true
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
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
number:true
}, 
s_email : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;} },
email:true	
    },         
first_name : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;}},
falpha:true
},
last_name : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;}},
falpha:true
},
mobile : {
required: {depends:function(){$(this).val($.trim($(this).val()));return true;}},
number:true
}


},
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


	
