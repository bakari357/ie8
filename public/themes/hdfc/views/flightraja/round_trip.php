 <link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/style.css"> 
<script src="themes/hdfc/assets/jsfillter/jquery-1.8.2.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.1.7.2.min.js"></script>
<script src="themes/hdfc/assets/assets/js/jquery-1.11.1.min.js"></script> 
<script src="themes/hdfc/assets/jsfillter/jquery-ui-1.10.3.custom.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.lazyload.js"></script>


<script src="themes/hdfc/assets/js/jquery.validate.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/mustache.js"></script>

<script src="themes/hdfc/assets/jsfillter/moment.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/chck_box.js"></script>
<script src="themes/hdfc/assets/jsfillter/radioselect.js"></script>
<script src="themes/hdfc/assets/jsfillter/filter_criti.js"></script>
<script src="themes/hdfc/assets/jsfillter/round_criti.js"></script>	
	
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

<script type="text/javascript">

	
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



function push_flights()
		{
		
		  $("#flightform").submit();
		}
</script>
<script> 
//var Movies="";
var req="<?php echo $req ?>"; 
var spoint="<?php echo $spoint ?>"; 
var epoint="<?php echo $epoint ?>";
var adult="<?php echo (int)$_POST['adults']; ?>";
var child="<?php echo (int)$_POST['children'];?>";
var infant="<?php echo (int)$_POST['infants'];?>";
var services="";
var cratio="<?php echo $c_ratio ?>";
var onward_price=0;
var return_price=0;

var flig="<?php echo $_POST['flig']; ?>";


 </script>
	
	
	
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Hotels</a></li>
					<li>/</li>
					<li><a href="#">U.S.A.</a></li>
					<li>/</li>					
					<li><a href="#" class="active">New York</a></li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">
		<div class="container pagecontainer offset-0">	

			<!-- FILTERS -->
			<div class="col-md-3 filters offset-0">
			
				
				<!-- TOP TIP -->
				
				
	

	
	
				<div class="bookfilters hpadding20">
					
					
						<div class="w50percent">
							<div class="radio">
							  
								<input type="hidden" name="optionsRadios" id="optionsRadios1" value="option1" checked>
								<span class="flight-ico"></span> Flights
							 
							</div>
							
						</div>
						
						
						
						<div class="clearfix"></div><br/>
						<form name="complaintdetails" method="post" id="singleform" class="form-horizontal" action="">

<input type="hidden" name="leavingfrom"  id="leavingfrom1" value="<?php if(isset($_POST['leavingfrom'])) echo trim($_POST['leavingfrom']) ; ?>"  />
<input type="hidden" name="goingto"  id="goingto1" value="<?php if(isset($_POST['goingto'])) echo trim($_POST['goingto']) ; ?>" />
<input type="hidden" name="type" value="<?php if(isset($_POST['type'])) echo  $_POST['type']; ?>" / >
<input type="hidden" name="adults" value="<?php if(isset($_POST['adults'])) echo  $_POST['adults']; ?>" / >
<input type="hidden" name="children" value="<?php if(isset($_POST['children'])) echo  $_POST['children']; ?>" / >
<input type="hidden" name="class" value="<?php if(isset($_POST['class'])) echo  $_POST['class']; ?>" / >
<input type="hidden" name="infants" value="<?php if(isset($_POST['infants'])) echo  $_POST['infants']; ?>" / >
<input type="hidden" name="plantype" value="<?php if(isset($_POST['plantype'])) echo  $_POST['plantype']; ?>" />
<input type="hidden" name="flig" value="<?php if(isset($_POST['flig'])) echo  $_POST['flig']; ?>" />
 
						<!-- HOTELS TAB -->
<div class="flightstab2">
							<div class="w50percent">
								<div class="wh90percent textleft">
									<span class="opensans size13">Flying from</span>
									<input type="text" name="leavingfrom1"   class="form-control" id="leavingfrom"  value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom1']) ; ?>"/>
								</div>
							</div>

							<div class="w50percentlast">
								<div class="wh90percent textleft right">
									<span class="opensans size13">To</span>
									<input type="text" name="goingto1"  class="form-control" id="goingto"  value="<?php if(isset($_POST['goingto1'])) echo trim($_POST['goingto1']) ; ?>"/>
								</div>
							</div>
							
							
							<div class="clearfix pbottom15"></div>
							
							<div class="w50percent">
								<div class="wh90percent textleft">
									<span class="opensans size13">Departing</span>
									
 <?php $tomorrow = date('d-m-Y',mktime(0, 0, 0, date("m"), date("d")+1, date("y"))); ?>
                                  <input id="datepicker3" class="form-control mySelectCalendar" type="text" autocomplete="off" readonly="readonly" value="<?php if(isset($_POST['departure'])) echo $_POST['departure'] ;else echo date('d-m-Y',$tomorrow);?>" name="departure"  />
								</div>
							</div>
								<div class="w50percent">
								<div class="wh90percent textleft">
									<span class="opensans size13">Return</span>
									
 <?php $dtomorrow = date('d-m-Y',mktime(0, 0, 0, date("m"), date("d")+2, date("y"))); ?>                     
                        <input type="text" name="return" class="form-control mySelectCalendar" value="<?php if(isset($_POST['return'])) echo $_POST['return'] ;?>" readonly autocomplete="off" id="datepicker4" />
								</div>
							</div>
							
							
							<div class="clearfix pbottom15"></div>
							
							<div class="clearfix"></div>
							<button type="submit" onclick="return date_validation();" class="btn-search3">Search</button>
						</div>					
										
</form>						
							

						
						
				</div>
				<!-- END OF BOOK FILTERS -->	
				
				<div class="line2"></div>
				
				<div class="padding20title"><h3 class="opensans dark">Filter by</h3></div>
				<div class="line2"></div>
				
				<!-- Star ratings -->	
				<button type="button" class="collapsebtn" data-toggle="collapse" data-target="#collapse1">
				  Flights <span class="collapsearrow"></span>
				</button>

				<div id="collapse1" class="collapse in">
					<div class="hpadding20" id="car_name_criteria">
						
					</div>
					<div class="clearfix"></div>
				</div>
				<!-- End of Star ratings -->	
				
				<div class="line2"></div>
				
				<!-- Price range -->					
				<button type="button" class="collapsebtn" data-toggle="collapse" data-target="#collapse2">
				  Price range <span class="collapsearrow"></span>
				</button>
					
				 <div class="price_pad">
                        	
                            	 <div id="price_criteria">
				  <span id="price_label1" class="slider-label"></span>
					  <span id="price_label2" class="slider-label"></span>

				  <div id="price_slider" class="slider"></div>
				  <input type="hidden" id="price_filter" value="">
                                   <input type="hidden" id="price_filter_hidden" value="">
                            </div>
                        </div>
				<!-- End of Price range -->	
				
               
				<br/><br/>
				<div class="clearfix"></div>
<div class="line2"></div>
				<button type="button" class="collapsebtn" data-toggle="collapse" data-target="#collapse1">
				  Stops <span class="collapsearrow"></span>
				</button>

				<div id="collapse4" class="collapse in">
                        	<div class="hpadding20" id="stops_criteria">
						
					</div>
                           
                        </div>
					<div class="clearfix"></div>
				</div>
				<!-- End of Star ratings -->	
				
				
<div class="rightcontent col-md-9 offset-0">

				
	<form id="flightform" name="flightform" method="POST" action="<?php echo $url = URL::action('Airlines@Yatra_Checkout'); ?>">
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
                    <section class="fare_pad">
                    		
                       <!-- <span>Fare breakup</span>-->
                    </section>

			<div class="fare_button">
                    <a class="select_button" href="javascript:;" onclick="return push_flights()" >Proceed</a>
		 	</div>
                </section>
</form>			
				
			
	<section class="f_titwrap">
               
                  <div class="f_topsection">
 					<h5 class="head_flight"><?php echo $_POST['leavingfrom1'];?>&nbsp; <img src="gocart/themes/default/assets/images/blue_arrow.jpg">&nbsp;<?php echo $_POST['goingto1'];?>&nbsp; - <?php echo date('j F Y', strtotime($_POST['departure'] ));?> </h5> 
                    <h5 class="head_flight"><?php echo $_POST['goingto1'];?>&nbsp; <img src="gocart/themes/default/assets/images/blue_arrow.jpg">&nbsp; <?php echo $_POST['leavingfrom1'];?>&nbsp;  -  <?php echo date('j F Y', strtotime($_POST['return'] ));?> </h5>
                    <div class="air_titsection">
                      <div class="chn_airline">Airline</div>
                      <div  class="chn_depart">Depart</div>
                      <div class="chn_arrive">Arrive</div>
                      <div class="chn_duration">Duration</div>
                      <div class="chn_points">Price</div>
                    		</div>
                     <div class="air_titsection">
                      <div class="chn_airline">Airline</div>
                      <div  class="chn_depart">Depart</div>
                      <div class="chn_arrive">Arrive</div>
                      <div class="chn_duration">Duration</div>
                      <div class="chn_points">Price</div>
                    		</div>       
                    	</div>  
<!----------------------onward begins ---------------------------->
<script id="template" type="text/html">
			
   <div class="flight_leftwrap">                   
                	<table cellpadding="0" cellspacing="0" border="0" id="myTable" >

{{#flightservice}}
  {{#identify}}   
            
			{{#fcnt}}

			
			<tr>
			
			 <td class="chn_airline">{{#show_price}}<input type="radio" name="onward" class="onward" value="1"{{#cnt}}checked{{/cnt}} />{{/show_price}}{{^show_price}}<input type="radio" name="onward" class="r_hide"  />{{/show_price}}
                            <img src="themes/hdfc/assets/img/via/{{img}}" align="absmiddle"></td>
                        <td  class="chn_depart"><strong>{{friend_dst}}</strong> <span>{{car_name}} {{car_id}}-{{fnum}}</span> </td>
                        <td class="chn_arrive"><strong>{{friend_arr}}</strong> <span>{{friend_adate}}</span></td>
                        <td class="chn_duration"><strong>{{duration}}</strong><span><span>{{sour}}<img src="images/gray_arrow.jpg">{{desti}}</span></span></td>
<td class="chn_points">{{#show_price}}<a class="btn_price tt">&#8377; {{#price}}{{cash}}{{/price}} 
  <span class="tooltip">
                                    <span class="top">
                                        <section class="top_main">
                                            <h4>Fare Breakup</h4>
                                            <section class="total_base_txt">Base Fare</section>	
                                            <section class="rs_txt WebRupee">&#8377; {{#price}}{{total_basefare}}{{/price}}</section><br>
 					    <section class="total_base_txt">Total Surcharge</section>	
                                            <section class="rs_txt2">&#8377; {{#price}}{{total_surcharge}}{{/price}}</section><br>
                                            <section class="total_base_txt">Total Tax</section>	
                                            <section class="rs_txt2">&#8377; {{#price}}{{total_tax}}{{/price}}</section><br>
                                        </section>
                                    </span>
                                    <span class="middle">
                                        <section class="middle_main">
                                            <section class="sub_title">
                                                <section class="total_base_txt"> Total Fare</section>
                                                <section class="rs_txt2">&#8377; {{#price}}{{cash}}{{/price}}</section>
                                            </section>
                                        </section>
					{{#flightservice}}{{#fcnt}}
                                        <section class="fare_txt">Fare type:<section class="refund_color">{{rf}}</section>
				      </section>{{/fcnt}}{{/flightservice}}
                                    </span>
                                    <span class="bottom">
				{{#flightservice}}
                                        <section class="bottom_main">
                                            {{car_name}} {{car_id}}-{{fnum}}<br>
                                            Dep: {{sour}} {{friend_dst}}	<section class="rs_txt2">Dur: {{duration}}</section><br>
                                            Arr: {{desti}} {{friend_arr}}	<section class="rs_txt2"></section>
                                        </section>
				{{/flightservice}}
					
                                    </span>
                                </span>

				






</a> <span class="refund_txt get_fare" onclick="get_fare('{{sour}},{{desti}},{{car_id}},{{fclass}},{{fbasis}}')">{{rf}}</span>{{/show_price}}</td>

<td class="select_fly">
{{#flightservice}}     
<div class="disp_trip">
<div class="abimg"><img src="themes/hdfc/assets/img/via/{{img}}" align="absmiddle"></div>
<p> {{car_name}} {{car_id}}-{{fnum}}</p>
<p>{{friend_dst}} - {{friend_arr}}</p>
<p>{{duration}} | {{sour}}<img class="garrow" src="images/gray_arrow.jpg">{{desti}}</p>
</div>
{{/flightservice}}
<input type="hidden" name="leavingfrom1"   value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom1']) ; ?>"  />
<input type="hidden" name="leavingfrom"   value="<?php if(isset($_POST['leavingfrom'])) echo trim($_POST['leavingfrom']) ; ?>"  />
<input type="hidden" name="ocarid" value={{#flightservice}}{{car_id}},{{/flightservice}} />
<input type="hidden" name="ocarname" value={{#flightservice}}{{car_name}},{{/flightservice}} />
<input type="hidden" name="ofnum" value={{#flightservice}}{{fnum}},{{/flightservice}} />
<input type="hidden" name="oarr_tym" value={{#flightservice}}{{arr_tym}},{{/flightservice}} />
<input type="hidden" name="odept_tym" value={{#flightservice}}{{dst_tym}},{{/flightservice}} />
<input type="hidden" name="osourc" value={{#flightservice}}{{sour}},{{/flightservice}} />
<input type="hidden" name="odeat" value={{#flightservice}}{{desti}},{{/flightservice}} />
<input type="hidden" name="oarr_ter" value={{#flightservice}}{{fnum}},{{/flightservice}} />
<input type="hidden" name="odest_ter" value={{#flightservice}}{{fnum}},{{/flightservice}} />
<input type="hidden" name="oclass" value={{#flightservice}}{{fclass}},{{/flightservice}} />
<input type="hidden" name="ofare_base" value={{#flightservice}}{{fbasis}},{{/flightservice}}>
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
<input type="hidden" name="type" value="<?php if(isset($_POST['type'])) echo  $_POST['type']; ?>" / >
<input type="hidden" name="discouted" value="N" />

<input type="hidden" name="goingto"  id="goingto" value="<?php if(isset($_POST['goingto'])) echo trim($_POST['goingto']) ; ?>" />
<input type="hidden" name="goingto1"  id="goingto2" value="<?php if(isset($_POST['goingto1'])) echo trim($_POST['goingto1']) ; ?>" />
<input type="hidden" name="stop"  id="stop" value="" />
<?php $p= str_replace('"','quot',serialize($post)) ;?>


<input type="hidden" name="post" value="<?php echo $p ?>" />
</td>
<td class=select_price>{{#price}}{{cash}}{{/price}}</td> 
</tr>
                    	{{/fcnt}}
			{{^fcnt}}
			 <tr class="final_bord">
			<td class="chn_airline">{{#show_price}}<input type="radio" name="onward" class="onward" value="1" {{#cnt}}checked{{/cnt}}/>{{/show_price}}{{^show_price}}<input type="radio" name="return" class="r_hide"  />{{/show_price}}
                        <img src="themes/hdfc/assets/img/via/{{img}}" align="absmiddle"></td>
                        <td  class="chn_depart"><strong>{{friend_dst}}</strong> <span>{{car_name}} {{car_id}}-{{fnum}}</span> </td>
                        <td class="chn_arrive"><strong>{{friend_arr}}</strong> <span>{{friend_adate}}</span></td>
                        <td class="chn_duration"><strong>{{duration}}</strong><span><span>{{sour}}<img src="images/gray_arrow.jpg">{{desti}}</span></span></td>
 <td class="chn_points">{{#show_price}}<a class="btn_price tt">&#8377; {{#price}}{{cash}}{{/price}} 
  <span class="tooltip">
                                    <span class="top">
                                        <section class="top_main">
                                            <h4>Fare Breakup</h4>
                                            <section class="total_base_txt">Base Fare</section>	
                                            <section class="rs_txt WebRupee">&#8377; {{#price}}{{total_basefare}}{{/price}}</section><br>
 					    <section class="total_base_txt">Total Surcharge</section>	
                                            <section class="rs_txt2">&#8377; {{#price}}{{total_surcharge}}{{/price}}</section><br>
                                            <section class="total_base_txt">Total Tax</section>	
                                            <section class="rs_txt2">&#8377; {{#price}}{{total_tax}}{{/price}}</section><br>
                                        </section>
                                    </span>
                                    <span class="middle">
                                        <section class="middle_main">
                                            <section class="sub_title">
                                                <section class="total_base_txt"> Total Fare</section>
                                                <section class="rs_txt2">&#8377; {{#price}}{{cash}}{{/price}}</section>
                                            </section>
                                        </section>
					{{#flightservice}}{{#fcnt}}
                                        <section class="fare_txt">Fare type:<section class="refund_color">{{rf}}</section>
				      </section>{{/fcnt}}{{/flightservice}}
                                    </span>
                                    <span class="bottom">
				{{#flightservice}}
                                        <section class="bottom_main">
                                            {{car_name}} {{car_id}}-{{fnum}}<br>
                                            Dep: {{sour}} {{friend_dst}}	<section class="rs_txt2">Dur: {{duration}}</section><br>
                                            Arr: {{desti}} {{friend_arr}}	<section class="rs_txt2"></section>
                                        </section>
				{{/flightservice}}
					
                                    </span>
                                </span>










</a> <span class="refund_txt get_fare" onclick="get_fare('{{sour}},{{desti}},{{car_id}},{{fclass}},{{fbasis}}')">{{rf}}</span>{{/show_price}}</td>
<td class="select_fly">
{{#flightservice}}     
<div class="disp_trip">
<div class="abimg"><img src="themes/hdfc/assets/img/via/{{img}}" align="absmiddle"></div>
<p> {{car_name}} {{car_id}}-{{fnum}}</p>
<p>{{friend_dst}} - {{friend_arr}}</p>
<p>{{duration}} | {{sour}}<img class="garrow" src=images/gray_arrow.jpg">{{desti}}</p>
</div>
{{/flightservice}}
<input type="hidden" name="leavingfrom1"   value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom1']) ; ?>"  />
<input type="hidden" name="leavingfrom"   value="<?php if(isset($_POST['leavingfrom'])) echo trim($_POST['leavingfrom']) ; ?>"  />
<input type="hidden" name="ocarid" value={{#flightservice}}{{car_id}},{{/flightservice}} />
<input type="hidden" name="ocarname" value={{#flightservice}}{{car_name}},{{/flightservice}} />
<input type="hidden" name="ofnum" value={{#flightservice}}{{fnum}},{{/flightservice}} />
<input type="hidden" name="oarr_tym" value={{#flightservice}}{{arr_tym}},{{/flightservice}} />
<input type="hidden" name="odept_tym" value={{#flightservice}}{{dst_tym}},{{/flightservice}} />
<input type="hidden" name="osourc" value={{#flightservice}}{{sour}},{{/flightservice}} />
<input type="hidden" name="odeat" value={{#flightservice}}{{desti}},{{/flightservice}} />
<input type="hidden" name="oarr_ter" value={{#flightservice}}{{fnum}},{{/flightservice}} />
<input type="hidden" name="odest_ter" value={{#flightservice}}{{fnum}},{{/flightservice}} />
<input type="hidden" name="oclass" value={{#flightservice}}{{fclass}},{{/flightservice}} />
<input type="hidden" name="ofare_base" value={{#flightservice}}{{fbasis}},{{/flightservice}}>
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
<input type="hidden" name="type" value="<?php if(isset($_POST['type'])) echo  $_POST['type']; ?>" / >
<input type="hidden" name="discouted" value="N" / >
<input type="hidden" name="goingto"  id="goingto" value="<?php if(isset($_POST['goingto'])) echo trim($_POST['goingto']) ; ?>" />
<input type="hidden" name="goingto1"  id="goingto2" value="<?php if(isset($_POST['goingto1'])) echo trim($_POST['goingto1']) ; ?>" />
<input type="hidden" name="stop"  id="stop" value="" />
<?php $p= str_replace('"','quot',serialize($post)) ;?>


<input type="hidden" name="post" value="<?php echo $p ?>" />
</td>
<td class=select_price>{{#price}}{{cash}}{{/price}}</td> 
</tr>
			{{/fcnt}}
	
 {{/identify}}   
{{/flightservice}} 

	</table>
                    </div>


</script>
<script id="template1" type="text/html">
    <div class="flight_rgtwrap">
                	<table cellpadding="0" cellspacing="0" border="0">
{{#flightservice}}                   
                 {{^identify}}   
                
			{{#fcnt}}
			<tr>
			 <td class="chn_airline">{{#show_price}}<input type="radio" name="return" class="return" {{#rcnt}}checked{{/rcnt}} />{{/show_price}}{{^show_price}}<input type="radio" name="return" class="r_hide"  />{{/show_price}}
                            <img src="themes/hdfc/assets/img/via/{{img}}" align="absmiddle"></td>
                        <td  class="chn_depart"><strong>{{friend_dst}}</strong> <span>{{car_name}} {{car_id}}-{{fnum}}</span> </td>
                        <td class="chn_arrive"><strong>{{friend_arr}}</strong> <span>{{friend_adate}}</span></td>
                        <td class="chn_duration"><strong>{{duration}}</strong><span><span>{{sour}}<img src="images/gray_arrow.jpg">{{desti}}</span></span></td>
<td class="chn_points">{{#show_price}}<a class="btn_price tt">&#8377; {{#price}}{{cash}}{{/price}}
<span class="tooltip">
                                    <span class="top">
                                        <section class="top_main">
                                            <h4>Fare Breakup</h4>
                                            <section class="total_base_txt">Base Fare</section>	
                                            <section class="rs_txt WebRupee">&#8377; {{#price}}{{total_basefare}}{{/price}}</section><br>
 					    <section class="total_base_txt">Total Surcharge</section>	
                                            <section class="rs_txt2">&#8377; {{#price}}{{total_surcharge}}{{/price}}</section><br>
                                            <section class="total_base_txt">Total Tax</section>	
                                            <section class="rs_txt2">&#8377; {{#price}}{{total_tax}}{{/price}}</section><br>
                                        </section>
                                    </span>
                                    <span class="middle">
                                        <section class="middle_main">
                                            <section class="sub_title">
                                                <section class="total_base_txt"> Total Fare</section>
                                                <section class="rs_txt2">&#8377; {{#price}}{{cash}}{{/price}}</section>
                                            </section>
                                        </section>
					{{#flightservice}}{{#fcnt}}
                                        <section class="fare_txt">Fare type:<section class="refund_color">{{rf}}</section>
				      </section>{{/fcnt}}{{/flightservice}}
                                    </span>
                                    <span class="bottom">
				{{#flightservice}}
                                        <section class="bottom_main">
                                            {{car_name}} {{car_id}}-{{fnum}}<br>
                                            Dep: {{sour}} {{friend_dst}}	<section class="rs_txt2">Dur: {{duration}}</section><br>
                                            Arr: {{desti}} {{friend_arr}}	<section class="rs_txt2"></section>
                                        </section>
				{{/flightservice}}
					
                                    </span>
                                </span>




 </a> <span class="refund_txt get_fare" onclick="get_fare('{{sour}},{{desti}},{{car_id}},{{fclass}},{{fbasis}}')">{{rf}}</span>{{/show_price}}</td>
<td class="select_fly">
{{#flightservice}}     
<div class="disp_trip">
<div class="abimg"><img src="themes/hdfc/assets/img/via/{{img}}" align="absmiddle"></div>
<p>{{car_name}} {{car_id}}-{{fnum}}</p>
<p>{{friend_dst}} - {{friend_arr}}</p>
<p>{{duration}} | {{sour}}<img class="garrow" src="images/gray_arrow.jpg">{{desti}}</p>
</div>
{{/flightservice}}
<input type="hidden" name="leavingfrom"   value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom']) ; ?>"  />
<input type="hidden" name="leavingfrom1"   value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom1']) ; ?>"  />
<input type="hidden" name="rcarid" value={{#flightservice}}{{car_id}},{{/flightservice}} />
<input type="hidden" name="rcarname" value={{#flightservice}}{{car_name}},{{/flightservice}} />
<input type="hidden" name="rfnum" value={{#flightservice}}{{fnum}},{{/flightservice}} />
<input type="hidden" name="rarr_tym" value={{#flightservice}}{{arr_tym}},{{/flightservice}} />
<input type="hidden" name="rdept_tym" value={{#flightservice}}{{dst_tym}},{{/flightservice}} />
<input type="hidden" name="rsourc" value={{#flightservice}}{{sour}},{{/flightservice}} />
<input type="hidden" name="rdeat" value={{#flightservice}}{{desti}},{{/flightservice}} />
<input type="hidden" name="rarr_ter" value={{#flightservice}}{{fnum}},{{/flightservice}} />
<input type="hidden" name="rdest_ter" value={{#flightservice}}{{fnum}},{{/flightservice}} />
<input type="hidden" name="rclass" value={{#flightservice}}{{fclass}},{{/flightservice}} />
<input type="hidden" name="rfare_base" value={{#flightservice}}{{fbasis}},{{/flightservice}}>
<input type="hidden" name="ramount" value={{#price}}{{cash}}{{/price}} />
<!--pricing -->
<input type="hidden" name="rprice1" value={{#price}}{{SingleAdultBaseFare}}{{/price}} />
<input type="hidden" name="rprice2" value={{#price}}{{SingleAdultSurcharge}}{{/price}} />
<input type="hidden" name="rprice3" value={{#price}}{{SingleAdultTotalTaxes}}{{/price}} />
<input type="hidden" name="rprice4" value={{#price}}{{SingleAdultAgentSurcharge}}{{/price}} />
<input type="hidden" name="rprice5" value={{#price}}{{SingleAdultTotalAmount}}{{/price}} />
<input type="hidden" name="rprice6" value={{#price}}{{SingleAdultCreditCardCharges}}{{/price}} />
<input type="hidden" name="rprice7" value={{#price}}{{SingleAdultCommission}}{{/price}} />
<input type="hidden" name="rprice8" value={{#price}}{{SingleAdultServiceTax}}{{/price}} />
<input type="hidden" name="rprice9" value={{#price}}{{pricing_currency}}{{/price}} />
<input type="hidden" name="rprice10" value={{#price}}{{SingleChildTotalAmount}}{{/price}} />
<input type="hidden" name="rprice11" value={{#price}}{{SingleInfantTotalAmount}}{{/price}} />
<input type="hidden" name="type" value="<?php if(isset($_POST['type'])) echo  $_POST['type']; ?>" / >
<input type="hidden" name="discouted" value="N" / >
<input type="hidden" name="goingto"  id="goingto" value="<?php if(isset($_POST['goingto'])) echo trim($_POST['goingto']) ; ?>" />
<input type="hidden" name="goingto1"  id="goingto2" value="<?php if(isset($_POST['goingto1'])) echo trim($_POST['goingto1']) ; ?>" />
<input type="hidden" name="stop"  id="stop" value="" />
<?php $p= str_replace('"','quot',serialize($post)) ;?>


<input type="hidden" name="post" value="<?php echo $p ?>" />
</td>
<td class=select_price>{{#price}}{{cash}}{{/price}}</td> 
</tr>

                    	{{/fcnt}}
			{{^fcnt}}
			 <tr class="final_bord">
			<td class="chn_airline">{{#show_price}}<input type="radio" name="return" class="return" value="1"{{#rcnt}} checked{{/rcnt}}/>{{/show_price}}{{^show_price}}<input type="radio" name="return" class="r_hide"  />{{/show_price}}
                        <img src="themes/hdfc/assets/img/via/{{img}}" align="absmiddle"></td>
                        <td  class="chn_depart"><strong>{{friend_dst}}</strong> <span>{{car_name}} {{car_id}}-{{fnum}}</span> </td>
                        <td class="chn_arrive"><strong>{{friend_arr}}</strong> <span>{{friend_adate}}</span></td>
                        <td class="chn_duration"><strong>{{duration}}</strong><span><span>{{sour}}<img src="images/gray_arrow.jpg">{{desti}}</span></span></td>
 <td class="chn_points">{{#show_price}}<a class="btn_price tt">&#8377; {{#price}}{{cash}}{{/price}} 
<span class="tooltip">
                                    <span class="top">
                                        <section class="top_main">
                                            <h4>Fare Breakup</h4>
                                            <section class="total_base_txt">Base Fare</section>	
                                            <section class="rs_txt WebRupee">&#8377; {{#price}}{{total_basefare}}{{/price}}</section><br>
 					    <section class="total_base_txt">Total Surcharge</section>	
                                            <section class="rs_txt2">&#8377; {{#price}}{{total_surcharge}}{{/price}}</section><br>
                                            <section class="total_base_txt">Total Tax</section>	
                                            <section class="rs_txt2">&#8377; {{#price}}{{total_tax}}{{/price}}</section><br>
                                        </section>
                                    </span>
                                    <span class="middle">
                                        <section class="middle_main">
                                            <section class="sub_title">
                                                <section class="total_base_txt"> Total Fare</section>
                                                <section class="rs_txt2">&#8377; {{#price}}{{cash}}{{/price}}</section>
                                            </section>
                                        </section>
					{{#flightservice}}{{#fcnt}}
                                        <section class="fare_txt">Fare type:<section class="refund_color">{{rf}}</section>
				      </section>{{/fcnt}}{{/flightservice}}
                                    </span>
                                    <span class="bottom">
				{{#flightservice}}
                                        <section class="bottom_main">
                                            {{car_name}} {{car_id}}-{{fnum}}<br>
                                            Dep: {{sour}} {{friend_dst}}	<section class="rs_txt2">Dur: {{duration}}</section><br>
                                            Arr: {{desti}} {{friend_arr}}	<section class="rs_txt2"></section>
                                        </section>
				{{/flightservice}}
					
                                    </span>
                                </span>







</a> <span class="refund_txt get_fare" onclick="get_fare('{{sour}},{{desti}},{{car_id}},{{fclass}},{{fbasis}}')">{{rf}}</span>{{/show_price}}</td>
<td class="select_fly">
{{#flightservice}}     
<div class="disp_trip">
<div class="abimg"><img src="themes/hdfc/assets/img/via/{{img}}" align="absmiddle"></div>
<p>{{car_name}} {{car_id}}-{{fnum}}</p>
<p>{{friend_dst}} - {{friend_arr}}</p>
<p>{{duration}} | {{sour}}<img class="garrow" src="images/gray_arrow.jpg">{{desti}}</p>
</div>
{{/flightservice}}
<input type="hidden" name="leavingfrom1"   value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom1']) ; ?>"  />
<input type="hidden" name="leavingfrom"   value="<?php if(isset($_POST['leavingfrom'])) echo trim($_POST['leavingfrom']) ; ?>"  />
<input type="hidden" name="rcarid" value={{#flightservice}}{{car_id}},{{/flightservice}} />
<input type="hidden" name="rcarname" value={{#flightservice}}{{car_name}},{{/flightservice}} />
<input type="hidden" name="rfnum" value={{#flightservice}}{{fnum}},{{/flightservice}} />
<input type="hidden" name="rarr_tym" value={{#flightservice}}{{arr_tym}},{{/flightservice}} />
<input type="hidden" name="rdept_tym" value={{#flightservice}}{{dst_tym}},{{/flightservice}} />
<input type="hidden" name="rsourc" value={{#flightservice}}{{sour}},{{/flightservice}} />
<input type="hidden" name="rdeat" value={{#flightservice}}{{desti}},{{/flightservice}} />
<input type="hidden" name="rarr_ter" value={{#flightservice}}{{fnum}},{{/flightservice}} />
<input type="hidden" name="rdest_ter" value={{#flightservice}}{{fnum}},{{/flightservice}} />
<input type="hidden" name="rclass" value={{#flightservice}}{{fclass}},{{/flightservice}} />
<input type="hidden" name="rfare_base" value={{#flightservice}}{{fbasis}},{{/flightservice}}>
<input type="hidden" name="ramount" value={{#price}}{{cash}}{{/price}} />
<!--pricing -->
<input type="hidden" name="rprice1" value={{#price}}{{SingleAdultBaseFare}}{{/price}} />
<input type="hidden" name="rprice2" value={{#price}}{{SingleAdultSurcharge}}{{/price}} />
<input type="hidden" name="rprice3" value={{#price}}{{SingleAdultTotalTaxes}}{{/price}} />
<input type="hidden" name="rprice4" value={{#price}}{{SingleAdultAgentSurcharge}}{{/price}} />
<input type="hidden" name="rprice5" value={{#price}}{{SingleAdultTotalAmount}}{{/price}} />
<input type="hidden" name="rprice6" value={{#price}}{{SingleAdultCreditCardCharges}}{{/price}} />
<input type="hidden" name="rprice7" value={{#price}}{{SingleAdultCommission}}{{/price}} />
<input type="hidden" name="rprice8" value={{#price}}{{SingleAdultServiceTax}}{{/price}} />
<input type="hidden" name="rprice9" value={{#price}}{{pricing_currency}}{{/price}} />
<input type="hidden" name="rprice10" value={{#price}}{{SingleChildTotalAmount}}{{/price}} />
<input type="hidden" name="rprice11" value={{#price}}{{SingleInfantTotalAmount}}{{/price}} />

<input type="hidden" name="goingto"  id="goingto" value="<?php if(isset($_POST['goingto'])) echo trim($_POST['goingto']) ; ?>" />
<input type="hidden" name="goingto1"  id="goingto2" value="<?php if(isset($_POST['goingto1'])) echo trim($_POST['goingto1']) ; ?>" />
<input type="hidden" name="stop"  id="stop" value="" />

<input type="hidden" name="type" value="<?php if(isset($_POST['type'])) echo  $_POST['type']; ?>" / >
<input type="hidden" name="discouted" value="N" / >
<?php $p= str_replace('"','quot',serialize($post)) ;?>


<input type="hidden" name="post" value="<?php echo $p ?>" />
</td>
<td class=select_price>{{#price}}{{cash}}{{/price}}</td> 
</tr>
			{{/fcnt}}
               		
		{{/identify}}
{{/flightservice}}
</table>
                    </div>

</script>
<table cellpadding="0" cellspacing="0" border="0">
			<tr>
			<td style="padding-top:0px; border-right: 1px solid #E5E5E5;">


<div id="movies">

</td>
<td style="padding-top:0px ">
<div id="movies1">
</div>
</td></tr>
</table>

<div id="result" align="center"><div style="padding-top:120px;">  
               	<section class="retrive_password">
                    <h3>Searching for available Flights</h3>
                    <div class="retrive_password_content">
                    <img style="padding-right: 57px;" src="public/themes/hdfc/assets/img/ajax-loader.gif"> </div>
                 </section>
</div>
</div>
</div>
</section> 	

				<!-- End of offset1-->		

				

			</div>
			<!-- END OF LIST CONTENT-->
			
		

		</div>
		<!-- END OF container-->
		
	</div>
	<!-- END OF CONTENT -->
	
	<script>
	
	$(document).ready(function(){
	
	$('#singleform').validate({
	                focusInvalid: false,
	                ignore: "",
	                rules: {
	                       leavingfrom1: {
	                        required: true
	                    },
	                    goingto1: {
	                        required: true
	                    },
	                    form1CardNumber: {
	                        required: true,
	                        creditcard: true
	                    }
	                },
	
	                invalidHandler: function (event, validator) {
	                                        //display error alert on form submit   
	                },
	
	                errorPlacement: function (label, element) { // render error placement for each input type   
	                                        $('<span class="error"></span>').insertAfter(element).append(label)
	                    var parent = $(element).parent('.input-with-icon');
	                    parent.removeClass('success-control').addClass('error-control'); 
	                },
	
	                highlight: function (element) { // hightlight error inputs
	                                        var parent = $(element).parent();
	                    parent.removeClass('success-control').addClass('error-control');
	                },
	
	                unhighlight: function (element) { // revert the change done by hightlight
	                   
	                },
	
	                success: function (label, element) {
	                                        var parent = $(element).parent('.input-with-icon');
	                                        parent.removeClass('error-control').addClass('success-control');
	                },
	
	                submitHandler: function (form) {
	                submit();
	                }
	            });
	       
	       
	        });
	</script>



	
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
$(document).on('click', '.onward', function(){ 

$(".onward_fly").html("");
$(".fare_pad").html("");
var owner = $(this).closest('td').siblings('td.select_fly').html();
onward_price= $(this).closest('td').siblings('td.select_price').text();
$(".onward_fly").append(owner);
var combined_price=parseInt(onward_price)+parseInt(return_price);
$(".fare_pad").html('&#8377 '+combined_price+' ('+Math.round(combined_price/cratio)+' pts)');

});

$(document).on('click', '.return', function(){ 

$(".return_fly").html("");
$(".fare_pad").html("");
var owner = $(this).closest('td').siblings('td.select_fly').html();
    $(".return_fly").append(owner);
return_price= $(this).closest('td').siblings('td.select_price').text();
var  combined_price=parseInt(onward_price)+parseInt(return_price);
$(".fare_pad").html('&#8377 '+combined_price+' ('+Math.round(combined_price/cratio)+' pts)');
                   

});
$(document).ready(function() {	

        if(flig=='DomFlight'){
		$("#leavingfrom").autocomplete({
			  source: "flightcityautocomplete",
                    minLength: 1,                    
                    select: function( event, ui ) {
                        $('#leavingfrom1').val(ui.item.id);
                      
                    }
		});
		}else
			{
			$("#leavingfrom").autocomplete({
			  source: "flighticityautocomplete",
                    minLength: 1,                    
                    select: function( event, ui ) {
                        $('#leavingfrom1').val(ui.item.id);
                      
                    }
		});
			}
		//Going to suggesstion
		 if(flig=='DomFlight'){
		$("#goingto").autocomplete({
				  source: "flightcityautocomplete",
                    minLength: 1,                    
                    select: function( event, ui ) {
                        $('#goingto1').val(ui.item.id);
                      
                    }
		});
		}else
			{
			$("#goingto").autocomplete({
				  source: "flighticityautocomplete",
                    minLength: 1,                    
                    select: function( event, ui ) {
                        $('#goingto1').val(ui.item.id);
                      
                    }
		});
			}
		


});

function date_validation(){
	
	 var dep_date = $("#datepicker3").val();
	 var ret_date = $("#datepicker4").val();
	 
	if(dep_date > ret_date){
	alert('please select Returning date must greater than Departing date.');
	return false;
	}
	
	
	}


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
		
		$( "#departure" ).datepicker({
			dateFormat : 'dd-mm-yy',
			changeMonth : true,
			changeYear : true, 
			minDate: '+1d',
			numberOfMonths: 2, 
			showButtonPanel: true,
			onSelect: function( selectedDate ) {
				var minDate = $(this).datepicker('getDate');
				if (minDate) {
				minDate.setDate(minDate.getDate() );
				}
				$( "#return" ).datepicker( "option",{ minDate:minDate}, selectedDate );

			}

		});
		
		
		$( "#return" ).datepicker({
		dateFormat : 'dd-mm-yy',
		changeMonth : true,
		changeYear : true, 
		minDate: '+1d',
		numberOfMonths: 2, 
		showButtonPanel: true,
		onSelect: function( selectedDate ) { //alert($('#startPicker').val());
			var minDate = $(this).datepicker('getDate');
			if (minDate) {
			minDate.setDate(minDate.getDate());
			}
			$( "#departure" ).datepicker( "option",{ maxDate:minDate}, selectedDate );
		}
		});
		
		
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


</script>

