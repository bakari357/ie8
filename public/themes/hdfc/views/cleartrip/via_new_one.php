<link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/style.css"> 
 <link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/filter1.css"> 
 <link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/filter2.css"> 
<script src="themes/hdfc/assets/jsfillter/jquery-1.8.2.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.1.7.2.min.js"></script>
<script src="themes/hdfc/assets/assets/js/jquery.v2.0.3.js"></script> 
<script src="themes/hdfc/assets/jsfillter/jquery-ui-1.10.3.custom.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.lazyload.js"></script>
<script src="themes/hdfc/assets/js/jquery.validate.min.js"></script>
<?php
//echo "<pre>";print_r(json_decode($output['0']->airlines));exit;
foreach($output as $airlines)
{
    
    
  foreach(json_decode($airlines->airlines) as $key=>$airline_data)
  {
     //echo "<pre>";print_r($key);print_r($airline_data->name);
     $aa=$airline_data->name;
     $a[$key]=$aa;
    
     ?>
     <script>
        
         var airline_data=<?php echo json_encode($a);?>
     </script>    
         <?php
    
  }
  
}
?>
<script>
    
 
//var Movies="";
var req="<?php echo $req ?>"; 
var spoint="<?php echo $spoint ?>"; 
var epoint="<?php echo $epoint ?>";
var adult="<?php echo (int)$_POST['adults']; ?>";
var child="<?php echo (int)$_POST['children'];?>";
var infant="<?php echo (int)$_POST['infants'];?>";
var services="";
var clear_total;
var cratio="1";
var token="<?php echo csrf_token(); ?>";

</script>
<!--scripts used for flight listing and flight filters!-->
<script src="themes/hdfc/assets/jsfillter/mustache.js"></script>
<script src="themes/hdfc/assets/js/cleartrip/oneway.js"></script> 
<script src="themes/hdfc/assets/js/cleartrip/moment.min.js"></script>
<script src="themes/hdfc/assets/js/cleartrip/filter.js"></script> 
<script src="themes/hdfc/assets/js/cleartrip/chck_box.js"></script>
<script src="themes/hdfc/assets/js/cleartrip/radioselect.js"></script>
<script src="themes/hdfc/assets/js/cleartrip/fare_search.js"></script> 

<style>
   span.ind_syb
    {
        color:#0062b6 !important;
    }
</style>    
	
<?php 
if($_POST['plantype']=='DomFlight')
	{ 
	$city_suggest='cities_suggestions';
	}
	else
	{
	$city_suggest='icities_suggestions';

	}
?>
<script type="text/javascript" >

	
	function get_fare(fare)
		{
		//alert (fare);
		
		$.post("airlines/farerule", {fare:fare}, function(data){
              
               		$("#popup_content").html(data);
              		$("#backgroundPopup").show();
			$("#toPopup").show();
			
				
});
             $(".ecs_tooltip").click(function()
	          	{	
		               $("#toPopup").hide();
				$("#backgroundPopup").hide();
		        });  
		    
		     
		       $(".loader").load(function()
		       {
		       $("#popup_content").html(data);
		       });
		       
		      	$(this).keyup(function(event) {
		if (event.which == 27) { // 27 is 'Ecs' in the keyboard
			$("#toPopup").hide();
				$("#backgroundPopup").hide();
		}  	
	});
	
	$("div#backgroundPopup").click(function() {
		$("#toPopup").hide();
		$("#backgroundPopup").hide();
	});  
	
		$("div.close").click(function() {
		$("#toPopup").hide();
		$("#backgroundPopup").hide();
	});          
		        
		}
</script>

<script> 
     function compare()
    {
      var leavingfrom=$('#leavingfrom').val();  
      
      var goingto=$('#goingto').val();
                        
      if(leavingfrom == null || leavingfrom=='')
          {
            alert("No City Specified, Please Select City from dropdown to Proceed.");
            return false;
          }
          
     if(goingto==null || goingto=='')     
         {
           alert("No City Specified, Please Select City from dropdown to Proceed.");
            return false;  
         }
         
        if(leavingfrom == goingto)
        {

        alert("Please change Source/Destination, as they cannot be the same.");
        return false;

        } 
        
        if($('#leavingfrom1').val() =='')
            {
              alert("Please select Source/Destination from the dropdown");
              return false;  
            }
        if($('#goingto1').val() =='')
            {
              alert("Please select Source/Destination from the dropdown");
              return false;  
            }    
    }

 </script>

	
	
	
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><?php echo HTML::link('flight_index', 'Flights'); ?></li>
					<li>/</li>
					<li><a href="javascript:;">Listing Flights</a></li>
					
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		
	</div>	

	<!-- CONTENT -->
	<div class="container">
            
            
		<div class="container pagecontainer offset-0">	
                    
			<!-- FILTERS -->
			<div class="col-md-3 filters offset-0">
			
				
				<!-- TOP TIP -->
				
				
	
                                    
	
	
				<div class="bookfilters hpadding20">
				<section class="trip_txt"><span style="color: #6D6B6B;" id="total_movies"></span></section> 	
					
						
							 
							
								<input type="hidden" name="optionsRadios" id="optionsRadios1" value="option1" checked>
								
							 
							
						
						
						
						<div class="line4" style="margin: 30px 0 15px 0;"></div>
						<div class="clearfix"></div>
						<form name="complaintdetails" method="post" id="singleform" class="form-horizontal" action="">
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<input type="hidden" name="leavingfrom"  id="leavingfrom1" value="<?php if(isset($_POST['leavingfrom'])) echo trim($_POST['leavingfrom']) ; ?>"  />
<input type="hidden" name="goingto"  id="goingto1" value="<?php if(isset($_POST['goingto'])) echo trim($_POST['goingto']) ; ?>" />
<input type="hidden" name="type" value="<?php if(isset($_POST['type'])) echo  $_POST['type']; ?>" / >
<input type="hidden" name="adults" value="<?php if(isset($_POST['adults'])) echo  $_POST['adults']; ?>" / >
<input type="hidden" name="children" value="<?php if(isset($_POST['children'])) echo  $_POST['children']; ?>" / >
<input type="hidden" name="class" value="<?php if(isset($_POST['class'])) echo  $_POST['class']; ?>" / >
<input type="hidden" name="infants" value="<?php if(isset($_POST['infants'])) echo  $_POST['infants']; ?>" / >
<input type="hidden" name="plantype" value="<?php if(isset($_POST['plantype'])) echo  $_POST['plantype']; ?>" />
<?php if(isset($_POST['international']) && $_POST['international']<>'')
{
?>
<input type="hidden" name="international" id="international" value="international">
<?php } ?>	

						<!-- HOTELS TAB -->
                                               
                                                <div class="clearfix pbottom15"></div>
<div class="flightstab2">                      
<div style="margin-left: -16px;">         
							<div class="col-md-12">
								<div class="wh90percent textleft">
									<span class="opensans size13"><b>Flying From</b></span>
									<input type="text" name="leavingfrom1"   class="flights-new-control" id="leavingfrom"  value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom1']) ; ?>"/>
								</div>
							</div>
<br/>
							<div class="col-md-12">
								<div class="wh90percent textleft">
									<span  class="opensans size13"><b>Flying To</b></span>
									<input type="text" name="goingto1"  class="flights-new-control-going-to" id="goingto" style="margin-top: 0px;margin-left: 0px;"  value="<?php if(isset($_POST['goingto1'])) echo trim($_POST['goingto1']) ; ?>"/>
								</div>
							</div>
</div>							
							
							<div class="clearfix pbottom15"></div>
							
							<div class="w50percent">
								<div class="wh90percent textleft">
									<span class="opensans size13"><b>Departing</b></span>
								
 <?php $tomorrow = mktime(0, 0, 0, date("m"), date("d")+1, date("y")); ?>
                                  <input id="datepicker" class="form-control mySelectCalendar" type="text" style="background-color:#fff;" autocomplete="off" readonly="" value="<?php if(isset($_POST['departure'])) echo $_POST['departure'] ;else echo date('d-m-Y',$tomorrow);?>" name="departure"  />
								</div>
							</div>

							
							
							
						<div class="clearfix pbottom15"></div>
							
							<div class="room1" >
								<div class="w30percent">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b>Adult</b></span>
										<select class="form-control" name="adults" id="adults">
                                                                                    
                                                                                    <?php for($a=1;$a<=9;$a++)
                                                                                    {
                                                                                     ?>   
										  <option value="<?php echo  $a;?>" 
                                                                                      <?php if($_POST['adults']== $a){echo "selected";
                                                                                          }?>><?php echo $a;?>
                                                                                  </option>
                                                                                    <?php } ?>
										</select>
									</div>
								</div>

								<div class="w30percent">	
									<div class="wh90percent textleft right">
										<span class="opensans size13"><b><font color="#666666">Child</font></b></span>
										<select class="form-control" name="children">
										  <?php for($a=0;$a<=8;$a++)
                                                                                    {
                                                                                     ?>   
										  <option value="<?php echo $a;?>" 
                                                                                      <?php if($_POST['children']== $a){echo "selected";
                                                                                          }?>><?php echo $a;?>
                                                                                  </option>
                                                                                    <?php } ?>
										</select>
									</div>
								</div>
                                                            
                                                                <div class="w30percentlast">
									<div class="wh90percent textleft">
										<span class="opensans size13"><b>Infant</b></span>										<span id="hide_infants_data">
                                                                                <select name="infants" id="infants" class="form-control" > 
                                                                                <?php 

                                                                                for($aa=0;$aa<=$_POST['adults'];$aa++)
                                                                                {
                                                                                ?>    
                                                                                <option <?php if($_POST['infants']==$aa ){echo "selected";
                                                                                }?>  value="<?php echo $aa;?>"> <?php echo $aa;?></option>
                                                                                <?php }
                                                                                ?>
                                                                                </select>
										</span>
										<span id="infants_data">
										</span>
									</div>
								</div>
                                                            <div class="clearfix pbottom15" ></div>
                                                                <div class="w95percent">
									<div class="wh100percent">
										<span class="opensans size13"><b>Class</b></span>
                                                                        <select id="cabinClass" class="form-control_flights" name="class">
                                                                        <option value="A" <?php if($class=='A') echo 'selected'; ?>>All </option>
                                                                        <option value="E" <?php if($class=='E') echo 'selected'; ?> >Economy</option>
                                                                        <option value="B" <?php if($class=='B') echo 'selected'; ?>>Business </option>
                                                                        </select>
									</div>
								</div>
							</div><div class="clearfix"></div>
			<button type="submit" onclick="return compare();"  class="btn-search3" style="background: #e20613;bottom: 10px;">Modify Search</button>
						</div>					
										
</form>						
							

						
						
				</div>
				<!-- END OF BOOK FILTERS -->	
				
				<div class="clearfix"></div>
                                <div class="line2"></div>
				
				<div class="padding20title"><h4 class="opensans dark2"><span>Filter by</span></h3></div><br/>
<!-- Price range -->					
				
<font color="#333" style="margin-left: 20px; font-weight: bold;">Price</font> <span style="margin-top: 26px;display: inline-block;"></span>
				
					
				 <div class="price_pad" >
                        	
                            	 <div id="price_criteria">
				  <span id="price_label1" class="slider-label"></span>
					  <span id="price_label2" style="float:right;" class="slider-label"></span>

				  <div id="price_slider" class="slider"></div>
				  <input type="hidden" id="price_filter" value="">
                                   <input type="hidden" id="price_filter_hidden" value="">
                            </div>
                        </div>

				<!-- End of Price range -->	
				<div class="clearfix"></div>
                                <div class="line2"></div><br/>
				
				<!-- Star ratings -->	
				<font color="#333" style="margin-left: 20px; font-weight: bold;">
				  Airlines
                                  </font>  
                                  <span class=""></span>
				

				<div id="collapse1" class="collapse in" style="margin-left: 18px;background: rgba(255, 255, 255, 0.85);">
					<div class="hpadding20" id="car_name_criteria">
						
					</div>
					<div class="clearfix"></div>
				</div>
				<!-- End of Star ratings -->	
				
				
				
				
				
               
				
				<div class="clearfix"></div>
                                <div class="line2"></div><br/>
				<font color="#333" style="margin-left: 20px; font-weight: bold;">
				  Stops <span class=""></span>
                                  </font>

				<div id="collapse4" class="collapse in" style="margin-left: 18px;background: rgba(255, 255, 255, 0.85);">
                        	<div class="hpadding20" id="stops_criteria">
						
					</div>
                           
                        </div>
					<div class="clearfix"></div>
                                <div class="line2"></div><br/>
				</div>
				<!-- End of Star ratings -->	
				
				
<div class="rightcontent col-md-9 offset-0">
<form id="clearform" name="flightform" method="POST" action="checkout_cleartrip">
  <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">  
 <input type="hidden" name="req" value="<?php echo $req; ?>" />  
 
 <?php $p= str_replace('"','quot',serialize($post)) ;?>
<input type="hidden" id="clearpost" name="clearpost" value="<?php echo $p; ?>">
	 <section class="proceed_sec">
			
                	<section class="proc_box">
                        <section class="proc_details">
			<div class="onward_fly">
				
			</div>
                        </section>
                    </section>
                    <section class="proc_box">
                        <section class="proc_details">
			<div class="return_fly">
                        	
			</div>
                        </section>
                    </section>
		    
			
                    
		
			<section class="fare_loader">
			Searching for Fares
                       <img src="<?php print_r(Config::get('app.url'))?>themes/hdfc/assets/images/ajax-loader.gif">
			</section>
		   
		 

		    
		<div class="fare_price_list_header">
                    <table class="labelright">
                        <tr><td valign="top">
                        <div style="width: 200px;padding-left:10px">
                        <?php if(isset($_POST['international']) && $_POST['international']<>'')
                        {
                        ?>
                        <input type="hidden" name="international" id="international" value="<?php echo $_POST['international'];?>">
                        <?php } ?>
                        <input type="radio" name="proceed_prices" id="proceed_go" value="flightform" /><section class="cleartrip_pad" style="padding-left: 20px;">
                            
                        </section>
                        <br>
                        <input type="radio" name="proceed_prices" id="proceed_clear" value="clearform" /><section class="fare_pad1" style=" padding-left: 20px;"></section>
                        </div>
                            </td><td valign="bottom">
			
				

				<div class="fare_button" style="float: left;">
				<a class="select_button" id="proceed" href="javascript:;" style="display:none;" onclick="return push_flights()" >Proceed</a>
				</div>
			
                            </td></tr>
                    </table>
		</div>
			
			
		   
			
			
		
			
                   </section>
</form>		

<form id="flightform" name="clearform" method="POST" action="checkout_goibibo" id="airpricerequest">	
<?php if(isset($_POST['international']) && $_POST['international']<>'')
{
?>
<input type="hidden" name="international" id="international" value="<?php echo $_POST['international'];?>">
<?php } ?>
	<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
        <?php $p= str_replace('"','quot',serialize($post)) ;?>
<input type="hidden" name="post" value="<?php echo $p ?>" />
<input type="hidden" id="goibibo_data" name="fuldata" value="">

</form>				
				
				
			
	<section class="flight_cont_rgt">
<table cellpadding="0" cellspacing="0" class="flights_table_one">
		<tr>
		<th colspan="9" class="headtxt"><?php echo $_POST['leavingfrom1'] ?>&nbsp;  <img src="<?php print_r(Config::get('app.url'))?>themes/hdfc/assets/images/blue_arrow.png"> &nbsp; <?php echo $_POST['goingto1'];?> - <?php $tomorrow = mktime(0, 0, 0, date("m"), date("d")+1, date("y")); ?><?php if(isset($_POST['departure'])) echo date('j F Y', strtotime($_POST['departure'] )); else echo date('j F Y',$tomorrow);?> </th>      
		</tr>
			<tr class="head_bdr">
			<th width="5%"></th>
			<th width="5%">Airline</th>
                        <th width="10%"></th>
			<th width="10%">Depart</th>
			<th width="10%">Arrive</th>
			<th width="15%">Duration</th>
			
                        <th width="18%" style="padding-left: 62px;">Price</th>
		</tr>	

</table>
<script id="template" type="text/html">
<table cellpadding="0" cellspacing="0" class="flights_table_one">
	
{{#onwardfl}}
{{#fcnt}}
			<tr>
			<td width="5%">{{#show_price}}<input type="radio" name="onward" class="onward" value="1" />{{/show_price}}</td>
			<td width="5%" ><img src="<?php print_r(Config::get('app.url'))?>themes/hdfc/assets/images/via/{{img}}">
                                   
                                    </td>
                        <td width="10%" >
                                   <span class="spaceRight"> {{car_name}}<br/>
                                       {{car_id}}-{{fnum}}</span>
                         </td>     
			<td width="10%"><span class="space">{{sour}}<br/>{{friend_dst}}</span></td>
			<td width="10%"><span class="space">{{desti}}<br/>{{friend_arr}}</span></td>	
			<td width="15%"><span class="space">{{duration}}<br>{{nos_list}} </td>
            		
			  <td width="18%" class="">

{{#show_price}} 






 <a class="btn_price tt"><button style="background:none; padding:4px 0; border:none; color:#0062b6; font-size:12px;font-family:'Helvetica', Arial, sans-serif; outline:none;" > <span class="ind_syb">&#x20b9;</span>&nbsp;<b>{{#price}}{{cash}}{{/price}}</b>
                                <span class="tooltip1">
                                    <span class="top">
                                        <section class="top_main">
                                            <h4>Fare Breakup</h4>
                                            <section class="total_base_txt">Base Fare</section>	
                                            <section class="rs_txt WebRupee">&#x20b9; {{#price}}{{total_surcharge}}{{/price}}</section><br>
 					    
                                            <section class="total_base_txt">Total Tax</section>	
                                            <section class="rs_txt2">&#x20b9; {{#price}}{{total_tax}}{{/price}}</section><br>
                                        </section>
                                    </span>
                                    <span class="middle">
                                        <section class="middle_main">
                                            <section class="sub_title">
                                                <section class="total_base_txt"> Total Fare</section>
                                                <section class="rs_txt2">&#x20b9; {{#price}}{{cash}}{{/price}}</section>
                                            </section>
                                        </section>
					{{#onwardfl}}{{#fcnt}}
                                        <section class="fare_txt">Fare type:<section class="refund_color">{{#price}}{{rf}}{{/price}}</section>
				      </section>{{/fcnt}}{{/onwardfl}}
                                    </span>
                                    <span class="bottom">
				{{#onwardfl}}
                                        <section class="bottom_main">
                                            {{car_name}} {{car_id}}-{{fnum}}<br>
                                            Dep: {{sour}} {{friend_dst}}	<section class="rs_txt2">Dur: {{duration}}</section><br>
                                            Arr: {{desti}} {{friend_arr}}	<section class="rs_txt2"></section>
                                        </section>
				{{/onwardfl}}
					
                                    </span>
                                </span></button> </a>
				<span class="refund_txt get_fare" style="margin-left: 40px;">{{#price}}{{rf}}{{/price}}</span>
{{/show_price}}  
                            </td> 


<td class="select_fly">
{{#onwardfl}}     
<div class="disp_trip">
<div class="abimg"><img src="<?php print_r(Config::get('app.url'))?>themes/hdfc/assets/images/via/{{img}}" align="absmiddle"></div>
<p> {{car_name}} {{car_id}}-{{fnum}}</p>
<p>{{friend_dst}} - {{friend_arr}}</p>
<p>{{duration}} | {{sour}}  <img class="garrow" src="<?php print_r(Config::get('app.url'))?>themes/hdfc/assets/images/blue_arrow.png">  {{desti}}</p>
</div>
{{/onwardfl}}
<input type="hidden" name="leavingfrom1"   value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom1']) ; ?>"  />
<input type="hidden" name="leavingfrom"   value="<?php if(isset($_POST['leavingfrom'])) echo trim($_POST['leavingfrom']) ; ?>"  />
<input type="hidden" name="ocarid" value={{#onwardfl}}{{car_id}},{{/onwardfl}} />
<input type="hidden" name="ocarname" value={{#onwardfl}}{{car_name}},{{/onwardfl}} />
<input type="hidden" name="ofnum" value={{#onwardfl}}{{fnum}},{{/onwardfl}} />
<input type="hidden" name="oarr_tym" value={{#onwardfl}}{{arr_tym}},{{/onwardfl}} />
<input type="hidden" name="odept_tym" value={{#onwardfl}}{{dst_tym}},{{/onwardfl}} />
<input type="hidden" name="osourc" value={{#onwardfl}}{{sour}},{{/onwardfl}} />
<input type="hidden" name="odeat" value={{#onwardfl}}{{desti}},{{/onwardfl}} />
<input type="hidden" name="oarr_ter" value={{#onwardfl}}{{fnum}},{{/onwardfl}} />
<input type="hidden" name="odest_ter" value={{#onwardfl}}{{fnum}},{{/onwardfl}} />
<input type="hidden" name="oclass" value={{#onwardfl}}{{fclass}},{{/onwardfl}} />
<input type="hidden" name="ofare_base" value={{#onwardfl}}{{farebasis}},{{/onwardfl}}>
<input type="hidden" name="ibibopartner" value={{#onwardfl}}{{ibibopartner}},{{/onwardfl}}>
<input type="hidden" name="bookingclass" value={{#onwardfl}}{{bookingclass}},{{/onwardfl}}>
<input type="hidden" name="tickettype" value={{#onwardfl}}{{tickettype}},{{/onwardfl}}>
<input type="hidden" name="oamount" value={{#price}}{{cash}}{{/price}} />
<!--pricing -->
<input type="hidden" name="oprice1" value={{#price}}{{SingleAdultBaseFare}}{{/price}} />
<input type="hidden" name="oprice2" value={{#price}}{{SingleAdultSurcharge}}{{/price}} />
<input type="hidden" name="oprice3" value={{#price}}{{SingleAdultTotalTaxes}}{{/price}} />
<input type="hidden" name="oprice4" value={{#price}}{{SingleAdultAgentSurcharge}}{{/price}} />
<input type="hidden" name="oprice5" value={{#price}}{{SingleAdultTotalAmount}}{{/price}} />
<input type="hidden" name="oprice6" value={{#price}}{{SingleAdultCreditCardCharges}}{{/price}} />
<input type="hidden" name="oprice7" value={{#price}}{{SingleAdultCommission}}{{/price}} />
<input type="hidden" name="oprice8" value={{#price}}{{SingleAdultServiceTax}}{{/price}} />
<input type="hidden" name="oprice9" value={{#price}}{{pricing_currency}}{{/price}} />
<input type="hidden" name="oprice10" value={{#price}}{{SingleChildTotalAmount}}{{/price}} />
<input type="hidden" name="oprice11" value={{#price}}{{SingleInfantTotalAmount}}{{/price}} />
<input type="hidden" name="clear_select" class="clear_select" value={{flightdata}} />
<input type="hidden" name="type" value="<?php if(isset($_POST['type'])) echo  $_POST['type']; ?>" / >
<input type="hidden" name="discouted" value="N" />

<input type="hidden" name="goingto"  id="goingto" value="<?php if(isset($_POST['goingto'])) echo trim($_POST['goingto']) ; ?>" />
<input type="hidden" name="goingto1"  id="goingto2" value="<?php if(isset($_POST['goingto1'])) echo trim($_POST['goingto1']) ; ?>" />
<input type="hidden" name="stop"  id="stop" value="" />

</td>
<td class=select_price>{{#price}}{{cash}}{{/price}}</td>
<td class=select_airlines style="display: none;">{{#onwardfl}}{{car_id}}{{/onwardfl}}</td> 
<td class=select_fcode style="display: none;">{{#onwardfl}}{{fnum}}{{/onwardfl}}</td>
			</tr>
{{/fcnt}}
{{^fcnt}}
	   <tr class="bdr_non">
			<td width="5%">{{#show_price}}<input type="radio" name="onward" class="onward" value="1"{{#cnt}}checked{{/cnt}} />{{/show_price}}</td>
			<td width="5%" ><img src="<?php print_r(Config::get('app.url'))?>themes/hdfc/assets/images/via/{{img}}">
                                  
                                    </td>
                        <td width="10%" >
                                   <span class="spaceRight"> {{car_name}}<br/>
                                       {{car_id}}-{{fnum}}</span>
                                    </td>    
			<td width="10%"><span class="space">{{sour}}<br/>{{friend_dst}}</span></td>
			<td width="10%"><span class="space">{{desti}}<br/>{{friend_arr}}</span></td>		
			<td width="15%"><span class="space">{{duration}}<br>{{nos_list}} </td>
            		
<td class="select_fly">    
{{#onwardfl}}     
<div class="disp_trip">
<div class="abimg"><img src="<?php print_r(Config::get('app.url'))?>themes/hdfc/assets/images/via/{{img}}" align="absmiddle"></div>
<p> {{car_name}} {{car_id}}-{{fnum}}</p>
<p>{{friend_dst}} - {{friend_arr}}</p>
<p>{{duration}} | {{sour}} <img class="garrow" src="<?php print_r(Config::get('app.url'))?>themes/hdfc/assets/images/blue_arrow.png"> {{desti}}</p>
</div>
{{/onwardfl}}

<input type="hidden" name="leavingfrom1"   value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom1']) ; ?>"  />
<input type="hidden" name="leavingfrom"   value="<?php if(isset($_POST['leavingfrom'])) echo trim($_POST['leavingfrom']) ; ?>"  />
<input type="hidden" name="ocarid" value={{#onwardfl}}{{car_id}},{{/onwardfl}} />
<input type="hidden" name="ocarname" value={{#onwardfl}}{{car_name}},{{/onwardfl}} />
<input type="hidden" name="ofnum" value={{#onwardfl}}{{fnum}},{{/onwardfl}} />
<input type="hidden" name="oarr_tym" value={{#onwardfl}}{{arr_tym}},{{/onwardfl}} />
<input type="hidden" name="odept_tym" value={{#onwardfl}}{{dst_tym}},{{/onwardfl}} />
<input type="hidden" name="osourc" value={{#onwardfl}}{{sour}},{{/onwardfl}} />
<input type="hidden" name="odeat" value={{#onwardfl}}{{desti}},{{/onwardfl}} />
<input type="hidden" name="oarr_ter" value={{#onwardfl}}{{fnum}},{{/onwardfl}} />
<input type="hidden" name="odest_ter" value={{#onwardfl}}{{fnum}},{{/onwardfl}} />
<input type="hidden" name="oclass" value={{#onwardfl}}{{fclass}},{{/onwardfl}} />
<input type="hidden" name="ofare_base" value={{#onwardfl}}{{farebasis}},{{/onwardfl}}>
<input type="hidden" name="ibibopartner" value={{#onwardfl}}{{ibibopartner}},{{/onwardfl}}>
<input type="hidden" name="bookingclass" value={{#onwardfl}}{{bookingclass}},{{/onwardfl}}>
<input type="hidden" name="tickettype" value={{#onwardfl}}{{tickettype}},{{/onwardfl}}>
<input type="hidden" name="oamount" value={{#price}}{{cash}}{{/price}} />
<!--pricing -->
<input type="hidden" name="oprice1" value={{#price}}{{SingleAdultBaseFare}}{{/price}} />
<input type="hidden" name="oprice2" value={{#price}}{{SingleAdultSurcharge}}{{/price}} />
<input type="hidden" name="oprice3" value={{#price}}{{SingleAdultTotalTaxes}}{{/price}} />
<input type="hidden" name="oprice4" value={{#price}}{{SingleAdultAgentSurcharge}}{{/price}} />
<input type="hidden" name="oprice5" value={{#price}}{{SingleAdultTotalAmount}}{{/price}} />
<input type="hidden" name="oprice6" value={{#price}}{{SingleAdultCreditCardCharges}}{{/price}} />
<input type="hidden" name="oprice7" value={{#price}}{{SingleAdultCommission}}{{/price}} />
<input type="hidden" name="oprice8" value={{#price}}{{SingleAdultServiceTax}}{{/price}} />
<input type="hidden" name="oprice9" value={{#price}}{{pricing_currency}}{{/price}} />
<input type="hidden" name="oprice10" value={{#price}}{{SingleChildTotalAmount}}{{/price}} />
<input type="hidden" name="oprice11" value={{#price}}{{SingleInfantTotalAmount}}{{/price}} />
<input type="hidden" name="clear_select" class="clear_select" value={{flightdata}} />
<input type="hidden" name="type" value="<?php if(isset($_POST['type'])) echo  $_POST['type']; ?>" / >
<input type="hidden" name="discouted" value="N" />
<?php $p= str_replace('"','quot',serialize($post)) ;?>
<input type="hidden" name="post" value="<?php echo $p ?>" />
<input type="hidden" name="goingto"  id="goingto" value="<?php if(isset($_POST['goingto'])) echo trim($_POST['goingto']) ; ?>" />
<input type="hidden" name="goingto1"  id="goingto2" value="<?php if(isset($_POST['goingto1'])) echo trim($_POST['goingto1']) ; ?>" />
<input type="hidden" name="stop"  id="stop" value="" />
<?php $p= str_replace('"','quot',serialize($post)) ;?>
<input type="hidden" name="post" value="<?php echo $p ?>" />
</td>
<td class=select_price>{{#price}}{{cash}}{{/price}}</td>
<td class=select_airlines style="display: none;">{{#onwardfl}}{{car_id}},{{/onwardfl}}</td> 
<td class=select_fcode style="display: none;">{{#onwardfl}}{{fnum}},{{/onwardfl}}</td> 
{{#show_price}} 
			  <td width="18%" class="">
  <a class="btn_price tt"><button  style="background:none; padding:4px 0; border:none; color:#0062b6; font-size:12px; font-family:'Helvetica', Arial, sans-serif;outline:none;" > <span class="ind_syb">&#x20b9;</span>&nbsp;<b>{{#price}}{{cash}}{{/price}}</b>
                                <span class="tooltip1">
                                    <span class="top">
                                        <section class="top_main">
                                            <h4>Fare Breakup</h4>
                                            <section class="total_base_txt">Base Fare</section>	
                                            <section class="rs_txt WebRupee">&#x20b9; {{#price}}{{total_surcharge}}{{/price}} </section><br>
						

						
 					    
                                            <section class="total_base_txt">Total Tax</section>	
                                            <section class="rs_txt2">&#x20b9; {{#price}}{{total_tax}}{{/price}}</section><br>
                                        </section>
                                    </span>
                                    <span class="middle">
                                        <section class="middle_main">
                                            <section class="sub_title">
                                                <section class="total_base_txt"> Total Fare</section>
                                                <section class="rs_txt2">&#x20b9; {{#price}}{{cash}}{{/price}}</section>
                                            </section>
                                        </section>
					{{#onwardfl}}{{#fcnt}}
                                        <section class="fare_txt">Fare type:<section class="refund_color">{{#price}}{{rf}}{{/price}}</section>
				      </section>{{/fcnt}}{{/onwardfl}}
                                    </span>
                                    <span class="bottom">
				{{#onwardfl}}
                                        <section class="bottom_main">
                                            {{car_name}} {{car_id}}-{{fnum}}<br>
                                            Dep: {{sour}} {{friend_dst}}	<section class="rs_txt2">Dur: {{duration}}</section><br>
                                            Arr: {{desti}} {{friend_arr}}	<section class="rs_txt2"></section>
                                        </section>
				{{/onwardfl}}
					
                                    </span>
                                </span></button> </a><span class="refund_txt get_fare" style="margin-left: 40px;">{{#price}}{{rf}}{{/price}}</span>
				</form> 
                        
              </td> 
{{/show_price}}               
			
	  </tr>





{{/fcnt}}








{{/onwardfl}}    
		</table>	                 
</script>  

</section> 	
<div class="clearfix"></div>
<div id="movies">
<link href="themes/hdfc/assets/updates/update1/css/style01.css" rel="stylesheet" media="screen">	
        <div id="result" align="center"><div style="padding-top:0px;">  
               	<section class="retrive_password">
                <div class="center">
                <span class="opensans size18 caps bold blue">We're on it! Searching for the best prices.</span><br/>
                <span class="opensans size18 grey xsmall">In a few moments, you'll be directed to Flights options galore!</span>
                <br/><br/>
                <img src="<?php echo Theme::asset()->url('images/logo.png'); ?>" width="169px" height="50px" alt=""/>

                </div>
                    <div class="retrive_password_content">
                    <img style="padding-right: 30px;" src="<?php print_r(Config::get('app.url'))?>themes/hdfc/assets/images/ajax-loader.gif"> </div>
      </br></br>
<span class="grey" style="font-size: 9px;">Disclaimer: HDFC Bank will not be liable for actual product delivery or performance.</span>           
             </section></div></div>
<div class="result" align="center"></div>
</div>
             <div class="clearfix"></div>
				<!-- End of offset1-->		

				

			</div>
			<!-- END OF LIST CONTENT-->
			
		

		</div>
		<!-- END OF container-->
		
	</div>
	<!-- END OF CONTENT -->
	
<script id="car_name_template" type="text/html">
	<div class="checkbox">
							<label>
	<input type="checkbox" value="{{car_name}}" class="f_all"> <span class="ccr_lab">{{car_name}}</label>
						</div>	
</script>

<script id="stops_template" type="text/html">
	<div class="checkbox">
							<label>
	<input type="checkbox" value="{{nos}}" class="f_all"><span class="ccr_lab"> {{nos}}</label>
						</div>	
</script>
<script type="text/javascript">
var fly="<?php $city_suggest ?>";
var flig="<?php echo $_POST['plantype']; ?>";

$(document).on('click', '.onward', function(){
     $(".onward").prop("disabled",true);
$(".onward_fly").html("");
$(".fare_pad1").html('');
$(".cleartrip_pad").html("");
$(".lowest_pad").html("");
$(".fare_loader").show();
$(".fare_price_list_header").hide();
$("#proceed_go").hide();
var owner = $(this).closest('td').siblings('td.select_fly').html();
onward_price= $(this).closest('td').siblings('td.select_price').text();
var onward_airline= $(this).closest('td').siblings('td.select_airlines').text();
var onward_fcode=$(this).closest('td').siblings('td.select_fcode').text();
$(".onward_fly").append(owner);
var combined_price=parseInt(onward_price)
var token="<?php echo csrf_token(); ?>";
 $("html, body").animate({ scrollTop: 0 }, "slow");

$.ajax({
    url : "price_search_cleartrip",
    type: "POST",
    data : {req:req,car_id:onward_airline,fcode:onward_fcode,_token:token},
    async:true,
    dataType: 'json',
    success: function(response)
    {
		clear_sky=[];
		fare_search(response,onward_fcode);
		
		$(".fare_loader").hide();
		$(".fare_pad1").html('<img src="themes/hdfc/assets/images/cleartrip-logo1.png" height="21px">  &#8377 '+combined_price);
		$("#proceed").show();
		$(".fare_price_list_header").show();
		if(clear_total != "" && typeof clear_total!="undefined")
		{
		
		$(".cleartrip_pad").html('<img src="themes/hdfc/assets/images/goibibo.png" height="17px"> &#8377 '+clear_total);
		var fares = [combined_price,clear_total];
		var lowest=fares.sort(function(a, b){return a-b});
		$(".lowest_pad").html('Lowest &#8377 '+lowest[0]);
		$(".fare_price_list_header").show();
                $("#proceed_go").show();
                 $(".onward").prop("disabled",false);
                 $(".cleartrip_pad").show();
		}
		else{
		$(".cleartrip_pad").hide();
			$(".lowest_pad").html('Lowest &#8377 '+combined_price);
                        $("#proceed_clear").show();
                        $("#proceed_go").hide();
                        $(".cleartrip_pad").hide();
                         $(".onward").prop("disabled",false);   
		    }}

});

});

$(document).ready(function() {
$("#adults").on('change',function()
{
  $.ajax({
  	 type:"POST",
  	 url:"<?=URL::to('load_infants')?>",
  	 data:
		{
		"adults_count":$('#adults option:selected').html()
		},            
  	 success:function(options){
  	 	$("#hide_infants_data").hide();
  	 	$("#infants_data").html(options);
  	 }
  })
}); 


 $(".fare_loader").hide();
 $(".fare_price_list_header").hide();
$(function() {	
        if(flig=='DomFlight'){
		$("#leavingfrom").autocomplete({
                    
	            source: "flightcityauto_cleartrip",
                    minLength: 1,
                    select: function( event, ui ) {
                        $('#leavingfrom1').val(ui.item.id);
                    },
                    
                    change:function (event, ui) {
                     
                    if (ui.item === null) {
                       $('#leavingfrom1').val('');
                    }
                    }   
		});
		}else
			{
			$("#leavingfrom").autocomplete({
			  source: "flighticityautocomplete",
                          minLength: 1,                    
                    select: function( event, ui ) {
                        $('#leavingfrom1').val(ui.item.id);
                      
                    },
                    change:function (event, ui) {
                     
                    if (ui.item === null) {
                       $('#leavingfrom1').val('');
                    }
                    }
		});
			}
		//Going to suggesstion
		 if(flig=='DomFlight'){
		$("#goingto").autocomplete({
		    source: "flightcityauto_cleartrip",
                    minLength: 1,                    
                    select: function( event, ui ) {
                        $('#goingto1').val(ui.item.id);
                      
                    },
                    change:function (event, ui) {
                     
                    if (ui.item === null) {
                       $('#goingto1').val('');
                    }
                    }
		});
		}else
			{
			$("#goingto").autocomplete({
	            source: "flighticityautocomplete",
                    minLength: 1,                    
                    select: function( event, ui ) {
                        $('#goingto1').val(ui.item.id);
                      
                    },
                    change:function (event, ui) {
                     
                    if (ui.item === null) {
                       $('#goingto1').val('');
                    }
                    }
		});
			}
                        

});
});



function submitform1()
{
  $('#airpricerequest1').submit();
}

function submitform()
{
  $('#airpricerequest').submit();
}
</script>


 <script>
	$(function() {
		
		$( "#datepicker" ).datepicker({
			dateFormat : 'dd-mm-yy',
			changeMonth : true,
			changeYear : true, 
			minDate: '+1d',
			
			showButtonPanel: true,
			onSelect: function( selectedDate ) {
				var minDate = $(this).datepicker('getDate');
				if (minDate) {
				minDate.setDate(minDate.getDate() );
				}
				$( "#datepicker" ).datepicker( "option",{ minDate:minDate}, selectedDate );

			}

		});
		
		
		$( "#return" ).datepicker({
		dateFormat : 'dd-mm-yy',
		changeMonth : true,
		changeYear : true, 
		minDate: '+1d',
		
		showButtonPanel: true,
		onSelect: function( selectedDate ) { //alert($('#startPicker').val());
			var minDate = $(this).datepicker('getDate');
			if (minDate) {
			minDate.setDate(minDate.getDate());
			}
			$( "#departure" ).datepicker( "option",{ maxDate:minDate}, selectedDate );
		}
		});
		
		var v=$('[name="type"]:checked').val();
		if(v=='R')
		$("#return").removeAttr('disabled');
		else
		$("#return").attr('disabled','true');

		if(v=='R')
		$("#rbox").show();
		else
		$("#rbox").hide();
	});
	function changetype()
	{
	 
		var v=$('[name="type"]:checked').val();
		if(v=='R')
		$("#return").removeAttr('disabled');
		else
		$("#return").attr('disabled','true');

		if(v=='R')
		$("#rbox").show();
		else
		$("#rbox").hide();
	 
	 
	 
	 
	}

		function push_flights()
		{
		if($("#proceed_go").prop("checked")==false && $("#proceed_clear").prop("checked")==false)
		{
		alert('Please select the partner to proceed further');
		}
		
		if ($("#proceed_go").prop("checked")) {
		// do something
		$("#flightform").submit();
		}

		// OR
		if ($("#proceed_clear").is(":checked")) {
		// do something
		$("#clearform").submit();
		}
			
		}

	/*function push_flights()
		{
			$("#clearform").submit();
		}

	function go_flights()
		{
			$("#flightform").submit();
		}*/
</script>




