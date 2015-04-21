
 <link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/style.css">
<script src="themes/hdfc/assets/jsfillter/jquery-1.8.2.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.1.7.2.min.js"></script>
<script src="themes/hdfc/assets/assets/js/jquery-1.11.1.min.js"></script> 
<script src="themes/hdfc/assets/jsfillter/jquery-ui-1.10.3.custom.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.lazyload.js"></script>


 <script src="themes/hdfc/assets/js/jquery.validate.min.js"></script> 
<script src="themes/hdfc/assets/jsfillter/mustache.js"></script>
<script src="themes/hdfc/assets/jsfillter/oneway.js"></script>
<script src="themes/hdfc/assets/jsfillter/moment.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/filter.js"></script> 
<script src="themes/hdfc/assets/jsfillter/chck_box.js"></script>
	
<style> .error{ color:red;} </style>	
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

<script>


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
//var Movies="";
var req="<?php echo $req ?>"; 
var spoint="<?php echo $spoint ?>"; 
var epoint="<?php echo $epoint ?>";
var adult="<?php echo (int)$_POST['adults']; ?>";
var child="<?php echo (int)$_POST['children'];?>";
var infant="<?php echo (int)$_POST['infants'];?>";
var services="";
var cratio="<?php echo $c_ratio ?>";
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
									
 <?php $tomorrow = mktime(0, 0, 0, date("m"), date("d")+1, date("y")); ?>
                                  <input id="datepicker3" class="form-control mySelectCalendar" type="text" autocomplete="off" readonly="" value="<?php if(isset($_POST['departure'])) echo $_POST['departure'] ;else echo date('d-m-Y',$tomorrow);?>" name="departure"  />
								</div>
							</div>

							
							
							<div class="clearfix pbottom15"></div>
							
							<div class="clearfix"></div>
							<button type="submit" class="btn-search3">Search</button>
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

				
				
				
			
	<section class="flight_cont_rgt">
<table cellpadding="0" cellspacing="0" class="flights_table_one">
		<tr>
		<th colspan="9" class="headtxt"><?php echo $_POST['leavingfrom1'] ?>&nbsp; <img src="">&nbsp; <?php echo $_POST['goingto'];?> - <?php $tomorrow = mktime(0, 0, 0, date("m"), date("d")+1, date("y")); ?><?php if(isset($_POST['departure'])) echo date('j F Y', strtotime($_POST['departure'] )); else echo date('j F Y',$tomorrow);?> </th>      
		</tr>
			<tr class="head_bdr">
			<th width="15%">Airline</th>
			<th width="15%">Depart</th>
			<th width="15%">Arrive</th>
			<th width="15%">Duration</th>
			<th width="15%">&nbsp;</th>
                        <th width="18%">&nbsp;</th>
		</tr>	
</table>
<script id="template" type="text/html">
<table cellpadding="0" cellspacing="0" class="flights_table_one">
	
{{#onwardfl}}
{{#fcnt}}
			<tr>
			<td width="15%" ><img src="themes/hdfc/assets/img/via/{{img}}"></td>
			<td width="15%"><strong><b>{{friend_dst}}</b></strong><br><span>{{car_name}} {{car_id}}-{{fnum}}</span></td>
			<td width="15%"><strong><b>{{friend_arr}}</b></strong><br><span>{{friend_adate}}</span></td>	
			<td width="15%"><strong><b>{{duration}}</b></strong><br>{{#nonstop}}<span>Non Stop</span>{{/nonstop}}{{^nonstop}}<span>{{sour}} <img src="themes/hdfc/assets/img/gray_arrow.jpg"> {{desti}}</span>{{/nonstop}}</td>
            		<td width="15%"><strong><b>&nbsp;</b></strong><br><div class="get_fare" onclick="get_fare('{{sour}},{{desti}},{{car_id}},{{fclass}},{{fbasis}}')"><span>{{rf}}</span></div></td>

			  <td width="18%" class="">
{{#show_price}} 
<form action="<?php echo $url = URL::action('Airlines@Yatra_Checkout'); ?>" id="airpricerequest" method="post">
			     <input type="hidden" name="leavingfrom1"   value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom1']) ; ?>"  />&nbsp;&nbsp;&nbsp;&nbsp;
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
<input type="hidden" name="ofare_base" value={{#onwardfl}}{{fbasis}},{{/onwardfl}}>
<input type="hidden" name="amount" value={{#price}}{{cash}}{{/price}} />
<!--pricing -->
<input type="hidden" name="price1" value={{#price}}{{SingleAdultBaseFare}}{{/price}} />
<input type="hidden" name="price2" value={{#price}}{{SingleAdultSurcharge}}{{/price}} />
<input type="hidden" name="price3" value={{#price}}{{SingleAdultTotalTaxes}}{{/price}} />
<input type="hidden" name="price4" value={{#price}}{{SingleAdultAgentSurcharge}}{{/price}} />
<input type="hidden" name="price5" value={{#price}}{{SingleAdultTotalAmount}}{{/price}} />
<input type="hidden" name="price6" value={{#price}}{{SingleAdultCreditCardCharges}}{{/price}} />
<input type="hidden" name="price7" value={{#price}}{{SingleAdultCommission}}{{/price}} />
<input type="hidden" name="price8" value={{#price}}{{SingleAdultServiceTax}}{{/price}} />
<input type="hidden" name="price9" value={{#price}}{{pricing_currency}}{{/price}} />
<input type="hidden" name="price10" value={{#price}}{{SingleChildTotalAmount}}{{/price}} />
<input type="hidden" name="price11" value={{#price}}{{SingleInfantTotalAmount}}{{/price}} />


<input type="hidden" name="goingto1"  id="goingto2" value="<?php if(isset($_POST['goingto1'])) echo trim($_POST['goingto1']) ; ?>" />
<input type="hidden" name="leavingfrom"   value="<?php if(isset($_POST['leavingfrom'])) echo trim($_POST['leavingfrom']) ; ?>" 
/>
<input type="hidden" name="city_type"   value="<?php if(isset($_POST['city_type'])) echo trim($_POST['city_type']) ; ?>" 
/>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="goingto"  id="goingto" value="<?php if(isset($_POST['goingto'])) echo trim($_POST['goingto']) ; ?>" />
<input type="hidden" name="stop"  id="stop" value="" />
<input type="hidden" name="plantype" value="<?php if(isset($_POST['plantype'])) echo  $_POST['plantype']; ?>" />
<input type="hidden" name="type" value="<?php if(isset($_POST['type'])) echo  $_POST['type']; ?>" / >
<?php $p= str_replace('"','quot',serialize($post)) ;?>


<input type="hidden" name="post" value="<?php echo $p ?>" />






 <a class="btn_price tt"><button onclick="submitform1();" style="background:none; padding:4px 0; border:none; color:#fff; font-size:12px;font-family:'Helvetica', Arial, sans-serif; outline:none;" > <span class="ind_syb">&#8377;</span>&nbsp;<b>{{#price}}{{cash}} ({{points}} pts){{/price}}</b>
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
					{{#onwardfl}}{{#fcnt}}
                                        <section class="fare_txt">Fare type:<section class="refund_color">{{rf}}</section>
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
				</form>   
{{/show_price}}  
                            </td> 
			</tr>
{{/fcnt}}
{{^fcnt}}
	   <tr class="bdr_non">
			<td width="15%"><img src="{{img}}"></td>		    		     
			<td width="15%"><strong><b>{{friend_dst}}</b></strong><br><span>{{car_name}} {{car_id}}-{{fnum}}</span></td>
			<td width="15%"><strong><b>{{friend_arr}}</b></strong><br><span>{{friend_adate}}</span></td>	
			<td width="15%"><strong><b>{{duration}}</b></strong><br><span>{{sour}} <img src="images/gray_arrow.jpg"> {{desti}}</span></td>
            		<td width="15%"><strong><b>&nbsp;</b></strong><br><div class="get_fare" onclick="get_fare('{{sour}},{{desti}},{{car_id}},{{fclass}},{{fbasis}}')"><span>{{rf}}</span></div></td>
{{#show_price}} 
			  <td width="18%" class="">
<form action="" id="airpricerequest" method="post">
			     <input type="hidden" name="leavingfrom1"   value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom1']) ; ?>"  />&nbsp;&nbsp;&nbsp;&nbsp;
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
<input type="hidden" name="ofare_base" value={{#onwardfl}}{{fbasis}},{{/onwardfl}}">
<input type="hidden" name="amount" value={{#price}}{{cash}}{{/price}} />
<!--pricing -->
<input type="hidden" name="price1" value={{#price}}{{SingleAdultBaseFare}}{{/price}} />
<input type="hidden" name="price2" value={{#price}}{{SingleAdultSurcharge}}{{/price}} />
<input type="hidden" name="price3" value={{#price}}{{SingleAdultTotalTaxes}}{{/price}} />
<input type="hidden" name="price4" value={{#price}}{{SingleAdultAgentSurcharge}}{{/price}} />
<input type="hidden" name="price5" value={{#price}}{{SingleAdultTotalAmount}}{{/price}} />
<input type="hidden" name="price6" value={{#price}}{{SingleAdultCreditCardCharges}}{{/price}} />
<input type="hidden" name="price7" value={{#price}}{{SingleAdultCommission}}{{/price}} />
<input type="hidden" name="price8" value={{#price}}{{SingleAdultServiceTax}}{{/price}} />
<input type="hidden" name="price9" value={{#price}}{{pricing_currency}}{{/price}} />
<input type="hidden" name="price10" value={{#price}}{{SingleChildTotalAmount}}{{/price}} />
<input type="hidden" name="price11" value={{#price}}{{SingleInfantTotalAmount}}{{/price}} />
<input type="hidden" name="plantype" value="<?php if(isset($_POST['plantype'])) echo  $_POST['plantype']; ?>" />
<input type="hidden" name="type" value="<?php if(isset($_POST['type'])) echo  $_POST['type']; ?>" / >

<input type="hidden" name="goingto1"  id="goingto2" value="<?php if(isset($_POST['goingto1'])) echo trim($_POST['goingto1']) ; ?>" />
<input type="hidden" name="leavingfrom"   value="<?php if(isset($_POST['leavingfrom'])) echo trim($_POST['leavingfrom']) ; ?>" 
/>
<input type="hidden" name="city_type"   value="<?php if(isset($_POST['city_type'])) echo trim($_POST['city_type']) ; ?>" 
/>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="goingto"  id="goingto" value="<?php if(isset($_POST['goingto'])) echo trim($_POST['goingto']) ; ?>" />
<input type="hidden" name="stop"  id="stop" value="" />
<?php $p= str_replace('"','quot',serialize($post)) ;?>


<input type="hidden" name="post" value="<?php echo $p ?>" />






  <a class="btn_price tt"><button onclick="submitform1();" style="background:none; padding:4px 0; border:none; color:#fff; font-size:12px; font-family:'Helvetica', Arial, sans-serif;outline:none;" > <span class="ind_syb">&#8377;</span>&nbsp;<b>{{#price}}{{cash}} ({{points}} pts){{/price}}</b>
                                <span class="tooltip">
                                    <span class="top">
                                        <section class="top_main">
                                            <h4>Fare Breakup</h4>
                                            <section class="total_base_txt">Base Fare</section>	
                                            <section class="rs_txt WebRupee">&#8377; {{#price}}{{total_basefare}}{{/price}} </section><br>
						

						
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
					{{#onwardfl}}{{#fcnt}}
                                        <section class="fare_txt">Fare type:<section class="refund_color">{{rf}}</section>
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
				</form> 
  
              </td> 
{{/show_price}}               
			
	  </tr>





{{/fcnt}}








{{/onwardfl}}    
		</table>
	                 
</script>  

<div id="movies">
<div id="result" align="center"><div style="padding-top:120px;">  
               	<section class="retrive_password">
                    <h3>Searching for available Flights</h3>
                    <div class="retrive_password_content">
                    <img style="padding-right: 57px;" src="public/themes/hdfc/assets/img/ajax-loader.gif"> </div>
                 
             </section></div></div> </div>
</section> 	

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

$(document).ready(function() {


$(function() {	
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
	
	$(document).ready(function(){

$('#singleform').validate({
               
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

