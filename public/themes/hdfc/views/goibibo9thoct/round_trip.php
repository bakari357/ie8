<link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/style.css"> 
 <link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/filter1.css"> 
 <link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/filter2.css"> 
<script src="themes/hdfc/assets/jsfillter/jquery-1.8.2.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.min.js"></script>

<script src="themes/hdfc/assets/assets/js/jquery-1.11.1.min.js"></script> 
<script src="themes/hdfc/assets/jsfillter/jquery-ui-1.10.3.custom.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.lazyload.js"></script>



<script src="themes/hdfc/assets/js/goibibo/mustache.js"></script>
<script src="themes/hdfc/assets/js/goibibo/moment.min.js"></script>
<script src="themes/hdfc/assets/js/goibibo/chck_box.js"></script>

<script src="themes/hdfc/assets/js/goibibo/filter_criti.js"></script>
<script src="themes/hdfc/assets/js/goibibo/round_criti.js"></script>
<script src="themes/hdfc/assets/js/goibibo/fare_round.js"></script>			
<script src="themes/hdfc/assets/js/jquery.validate.min.js"></script>	
<script src="themes/hdfc/assets/js/goibibo/radioselect.js"></script>
	<script>
$(document).ready(function(){
	$(".fare_price_list_header").hide();
	$(".fare_loader").hide();
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

<script type="text/javascript" >
var flig='';
	
	function get_fare(fare)
		{
		//alert (fare);
		
		$.post("airlines/farerule", {fare:fare}, function(data){

               		$("#popup_content").html(data);
              		$("#backgroundPopup").show();
			$("#toPopup").show();
			});
             $(".ecs_tooltip1").click(function()
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
		if($("#proceed_go").prop("checked")==false && $("#proceed_clear").prop("checked")==false)
		{
		alert('Please select the partner to proceed further');
		}
		
		
		if ($("#proceed_go").prop("checked")) {
		
		$("#flightform").submit();
		}

		
		if ($("#proceed_clear").is(":checked")) {
		
		$("#clearform").submit();
		}
			
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
var onward_total=0;
var return_total=0;
var clear_total =0;





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
			<a class="backbtn right" href="#"></a>
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
							<div class="col-xs-12 col-md-12 col-lg-12 nopad clearfix pbottom15">
								<div class="textleft">
									<span class="opensans size13"><b>Flying From</b></span>
									<input type="text" name="leavingfrom1"   class="form-control" id="leavingfrom"  value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom1']) ; ?>"/>
								</div>
							</div>

							<div class="col-xs-12 col-md-12 col-lg-12 nopad clearfix pbottom15">
								<div class="textleft">
							<span class="opensans size13"><b>Flying To</b></span>
									<input type="text" name="goingto1"  class="form-control" id="goingto"  value="<?php if(isset($_POST['goingto1'])) echo trim($_POST['goingto1']) ; ?>"/>
								</div>
							</div>
							
							
							<div class="clearfix pbottom15"></div>
							
							<div class="w50percent">
								<div class="wh90percent textleft">
									<span class="opensans size13"><b>Departing</b></span>
									
 <?php $tomorrow = date('m/d/Y',mktime(0, 0, 0, date("m"), date("d")+1, date("y"))); ?>
                                  <input id="datepicker3" class="form-control mySelectCalendar" type="text" autocomplete="off" readonly="readonly" style="background-color:#fff;" value="<?php if(isset($_POST['departure'])) echo $_POST['departure'] ;else echo date('d-m-Y',$tomorrow);?>" name="departure"  />
								</div>
							</div>
								<div class="w50percent">
								<div class="wh90percent textleft">
									<span class="opensans size13"><b>Return</b></span>
									
 <?php $dtomorrow = date('m/d/Y',mktime(0, 0, 0, date("m"), date("d")+2, date("y"))); ?>                     
                        <input type="text" style="background-color:#fff;" name="return" class="form-control mySelectCalendar" value="<?php if(isset($_POST['return'])) echo $_POST['return'] ;?>" readonly autocomplete="off" id="datepicker4" />
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
										<span class="opensans size13"><b><font color="#666;">Child</font></b></span>
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
										<span class="opensans size13"><b>Infant</b></span>
										<span id="hide_infants_data">
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
                                                                <div class="w95percent ">
									<div class="wh100percent">
										<span class="opensans size13"><b>Class</b></span>
                                                                        <select id="cabinClass" class="form-control_flights" name="class">
                                                                        <option value="A" <?php if($class=='A') echo 'selected'; ?>>All </option>
                                                                        <option value="E" <?php if($class=='E') echo 'selected'; ?> >Economy</option>
                                                                        <option value="B" <?php if($class=='B') echo 'selected'; ?>>Business </option>
                                                                        </select>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<button type="submit" onclick="return date_validation();" class="btn-search3" style="background: #e20613;bottom: 10px;">Modify Search</button>
						</div>					
										
</form>						
							

						
						
				</div>
				<!-- END OF BOOK FILTERS -->	
				
				<!--<div class="line2"></div>-->
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

				
	<form id="flightform" name="flightform" method="POST" action="<?php echo $url = URL::action('Goibibo@go_Checkout'); ?>">
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
                <input type="radio" name="proceed_prices" id="proceed_go" value="flightform" /><section class="fare_pad1"></section>
                <br>
                <input type="radio" name="proceed_prices" id="proceed_clear" value="clearform" /><section class="cleartrip_pad"></section>
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
				
	<form id="clearform" name="clearform" method="POST" action="<?php echo $url = URL::action('Goibibo@clear_Checkout'); ?>">	
	<input type="hidden" id="clear_select" name="clear_select" >
	<input type="hidden" id="return_select" name="return_select" >
	<?php $p= str_replace('"','quot',serialize($post)) ;?>
	<input type="hidden" id="clearpost" name="clearpost" value="<?php echo $p; ?>">
	</form>
<div id="hidef">		
<section class="flight_content_pad">
<section class="f_titwrap">
<div class="f_topsection">
 					<h5 class="head_flight"><?php echo $_POST['leavingfrom1'];?>&nbsp; <img src="themes/hdfc/assets/images/blue_arrow.png">&nbsp;<?php echo $_POST['goingto1'];?>&nbsp; - <?php echo date('j F Y', strtotime($_POST['departure'] ));?> </h5> 
                    <h5 class="head_flight"><?php echo $_POST['goingto1'];?>&nbsp; <img src="themes/hdfc/assets/images/blue_arrow.png">&nbsp; <?php echo $_POST['leavingfrom1'];?>&nbsp;  -  <?php echo date('j F Y', strtotime($_POST['return'] ));?> </h5>
                    <div class="air_titsection">
                      <div class="chn_airline">Airline</div>
                      <div class="chn_depart"></div>
                      <div  class="chn_depart">Depart</div>
                      <div class="chn_arrive">Arrive</div>
                      <div class="chn_duration">Duration</div>
                      <div class="chn_points" style="padding-left: 20px;">Price</div>
                    		</div>
                     <div class="air_titsection">
                      <div class="chn_airline">Airline</div>
                      <div class="chn_depart"></div>
                      <div  class="chn_depart">Depart</div>
                      <div class="chn_arrive">Arrive</div>
                      <div class="chn_duration">Duration</div>
                      <div class="chn_points" style="padding-left: 20px;">Price</div>
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
                            <img src="themes/hdfc/assets/images/via/{{img}}" align="absmiddle"></td>
                        <td  class="chn_depart">
                                   <span class="spaceRight"> {{car_name}}<br/>
                                       {{car_id}}-{{fnum}}</span>
                                    </td>           
                        <td  class="chn_depart"><span class="space">{{sour}}<br/>{{friend_dst}}</td>
                        <td class="chn_arrive"><span class="space">{{desti}}<br/>{{friend_arr}}</td>
                        <td class="chn_duration"><span class="space">{{duration}}<br>{{nos}} </td>
<td class="chn_points" style="background:none; padding:4px 0; border:none; color:#0062b6; font-size:12px;font-family:'Helvetica', Arial, sans-serif; outline:none;">{{#show_price}}<a class="btn_price tt">&#8377; {{#price}}{{cash}}{{/price}} 
                        <span class="tooltip1">
                                  <span class="top">
                                      <section class="top_main">
                                          <h4>Fare Breakup</h4>
                                          <section class="total_base_txt">Base Fare</section>	
                                          <section class="rs_txt WebRupee">&#8377; {{#price}}{{total_surcharge}}{{/price}}</section><br>
                                          
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
                               </a> <span class="refund_txt get_fare" style="margin-left:25px;">{{rf}}</span>{{/show_price}}</td>

<td class="select_fly">
{{#flightservice}}     
<div class="disp_trip">
<div class="abimg"><img src="themes/hdfc/assets/images/via/{{img}}" align="absmiddle"></div>
<p> {{car_name}} {{car_id}}-{{fnum}}</p>
<p>{{friend_dst}} - {{friend_arr}}</p>
<p>{{duration}} | {{sour}} <img class="garrow" src="themes/hdfc/assets/images/blue_arrow.png"> {{desti}}</p>
</div>
{{/flightservice}}
<input type="hidden" name="leavingfrom1"   value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom1']) ; ?>"  />
<input type="hidden" name="leavingfrom"   value="<?php if(isset($_POST['leavingfrom'])) echo trim($_POST['leavingfrom']) ; ?>"  />

<input type="hidden" name="fuldata" value={{fuldata}} />
<!--pricing -->
<input type="hidden" name="discouted" value="N" />

<input type="hidden" name="goingto"  id="goingto" value="<?php if(isset($_POST['goingto'])) echo trim($_POST['goingto']) ; ?>" />
<input type="hidden" name="goingto1"  id="goingto2" value="<?php if(isset($_POST['goingto1'])) echo trim($_POST['goingto1']) ; ?>" />
<input type="hidden" name="stop"  id="stop" value="" />
<?php $p= str_replace('"','quot',serialize($post)) ;?>


<input type="hidden" name="post" value="<?php echo $p ?>" />
</td>
<td class=select_price>{{#price}}{{cash}}{{/price}}</td> 
<td class=select_airlines style="display: none;">{{#flightservice}}{{car_id}},{{/flightservice}}</td> 
<td class=select_fcode style="display: none;">{{#flightservice}}{{fnum}},{{/flightservice}}</td>
<td class=select_refund style="display: none;">{{rf}}</td>
</tr>
                    	{{/fcnt}}
			{{^fcnt}}
			 <tr class="final_bord">
			<td class="chn_airline">{{#show_price}}<input type="radio" name="onward" class="onward" value="1" {{#cnt}}checked{{/cnt}}/>{{/show_price}}{{^show_price}}<input type="radio" name="return" class="r_hide"  />{{/show_price}}
                        <img src="themes/hdfc/assets/images/via/{{img}}" align="absmiddle"></td>
                        <td  class="chn_depart">
                                   <span class="spaceRight"> {{car_name}}<br/>
                                       {{car_id}}-{{fnum}}</span>
                                    </td>           
                        <td  class="chn_depart"><span class="space">{{sour}}<br/>{{friend_dst}}</td>
                        <td class="chn_arrive"><span class="space">{{desti}}<br/>{{friend_arr}}</td>
                        <td class="chn_duration"><span class="space">{{duration}}<br>{{nos}} </td>
 <td class="chn_points">{{#show_price}}<a class="btn_price tt">&#8377; {{#price}}{{cash}}{{/price}} 
  <span class="tooltip1">
                                    <span class="top">
                                        <section class="top_main">
                                            <h4>Fare Breakup</h4>
                                            <section class="total_base_txt">Base Fare</section>	
                                            <section class="rs_txt WebRupee">&#8377; {{#price}}{{total_surcharge}}{{/price}}</section><br>
 					    
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
                                </span>    









</a> <span class="refund_txt get_fare" style="margin-left:25px;" onclick="get_fare('{{sour}},{{desti}},{{car_id}},{{fclass}},{{fbasis}}')">{{rf}}</span>{{/show_price}}</td>
<td class="select_fly">
{{#flightservice}}     
<div class="disp_trip">
<div class="abimg"><img src="themes/hdfc/assets/images/via/{{img}}" align="absmiddle"></div>
<p> {{car_name}} {{car_id}}-{{fnum}}</p>
<p>{{friend_dst}} - {{friend_arr}}</p>
<p>{{duration}} | {{sour}} <img class="garrow" src="themes/hdfc/assets/images/blue_arrow.png"> {{desti}}</p>
</div>
{{/flightservice}}
<input type="hidden" name="leavingfrom1"   value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom1']) ; ?>"  />
<input type="hidden" name="leavingfrom"   value="<?php if(isset($_POST['leavingfrom'])) echo trim($_POST['leavingfrom']) ; ?>"  />

<input type="hidden" name="fuldata" value={{fuldata}} />
<!--pricing -->
<input type="hidden" name="discouted" value="N" / >
<input type="hidden" name="goingto"  id="goingto" value="<?php if(isset($_POST['goingto'])) echo trim($_POST['goingto']) ; ?>" />
<input type="hidden" name="goingto1"  id="goingto2" value="<?php if(isset($_POST['goingto1'])) echo trim($_POST['goingto1']) ; ?>" />
<input type="hidden" name="stop"  id="stop" value="" />
<?php $p= str_replace('"','quot',serialize($post)) ;?>


<input type="hidden" name="post" value="<?php echo $p ?>" />
</td>
<td class=select_price>{{#price}}{{cash}}{{/price}}</td> 
<td class=select_airlines style="display: none;">{{#flightservice}}{{car_id}},{{/flightservice}}</td> 
<td class=select_fcode style="display: none;">{{#flightservice}}{{fnum}},{{/flightservice}}</td>
<td class=select_refund style="display: none;">{{rf}}</td>
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
                            <img src="themes/hdfc/assets/images/via/{{img}}" align="absmiddle"></td>
                        <td  class="chn_depart">
                                   <span class="spaceRight"> {{car_name}}<br/>
                                       {{car_id}}-{{fnum}}</span>
                                    </td>           
                        <td  class="chn_depart"><span class="space">{{sour}}<br/>{{friend_dst}}</td>
                        <td class="chn_arrive"><span class="space">{{desti}}<br/>{{friend_arr}}</td>
                        <td class="chn_duration"><span class="space">{{duration}}<br>{{nos}} </td>
<td class="chn_points">{{#show_price}}<a class="btn_price tt">&#8377; {{#price}}{{cash}}{{/price}}
                        <span class="tooltip1">
                                    <span class="top">
                                        <section class="top_main">
                                            <h4>Fare Breakup</h4>
                                            <section class="total_base_txt">Base Fare</section>	
                                            <section class="rs_txt WebRupee">&#8377; {{#price}}{{total_surcharge}}{{/price}}</section><br>
 					    
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
                                        <section class="fare_txt">Fare type:<section class="refund_color">{{rf}}</section>s
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
                        </span>



 </a> <span class="refund_txt get_fare" style="margin-left:25px;">{{rf}}</span>{{/show_price}}</td>
<td class="select_fly">
{{#flightservice}}     
<div class="disp_trip">
<div class="abimg"><img src="themes/hdfc/assets/images/via/{{img}}" align="absmiddle"></div>
<p>{{car_name}} {{car_id}}-{{fnum}}</p>
<p>{{friend_dst}} - {{friend_arr}}</p>
<p>{{duration}} | {{sour}} <img class="garrow" src="themes/hdfc/assets/images/blue_arrow.png"> {{desti}}</p>
</div>
{{/flightservice}}
<input type="hidden" name="leavingfrom"   value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom']) ; ?>"  />
<input type="hidden" name="leavingfrom1"   value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom1']) ; ?>"  />

<input type="hidden" name="returndata" value={{returndata}} />
<!--pricing -->

<input type="hidden" name="discouted" value="N" / >
<input type="hidden" name="goingto"  id="goingto" value="<?php if(isset($_POST['goingto'])) echo trim($_POST['goingto']) ; ?>" />
<input type="hidden" name="goingto1"  id="goingto2" value="<?php if(isset($_POST['goingto1'])) echo trim($_POST['goingto1']) ; ?>" />
<?php $p= str_replace('"','quot',serialize($post)) ;?>


<input type="hidden" name="post" value="<?php echo $p ?>" />
</td>
<td class=select_price>{{#price}}{{cash}}{{/price}}</td> 
<td class=select_airlines style="display: none;">{{#flightservice}}{{car_id}},{{/flightservice}}</td> 
<td class=select_fcode style="display: none;">{{#flightservice}}{{fnum}},{{/flightservice}}</td>
</tr>

                    	{{/fcnt}}
			{{^fcnt}}
			 <tr class="final_bord">
			<td class="chn_airline">{{#show_price}}<input type="radio" name="return" class="return" value="1"{{#rcnt}} checked{{/rcnt}}/>{{/show_price}}{{^show_price}}<input type="radio" name="return" class="r_hide"  />{{/show_price}}
                        <img src="themes/hdfc/assets/images/via/{{img}}" align="absmiddle"></td>
                       <td  class="chn_depart">
                                   <span class="spaceRight"> {{car_name}}<br/>
                                       {{car_id}}-{{fnum}}</span>
                                    </td>           
                        <td  class="chn_depart"><span class="space">{{sour}}<br/>{{friend_dst}}</td>
                        <td class="chn_arrive"><span class="space">{{desti}}<br/>{{friend_arr}}</td>
                        <td class="chn_duration"><span class="space">{{duration}}<br>{{nos}} </td>
 <td class="chn_points">{{#show_price}}<a class="btn_price tt">&#8377; {{#price}}{{cash}}{{/price}} 
<span class="tooltip1">
                                    <span class="top">
                                        <section class="top_main">
                                            <h4>Fare Breakup</h4>
                                            <section class="total_base_txt">Base Fare</section>	
                                            <section class="rs_txt WebRupee">&#8377; {{#price}}{{total_surcharge}}{{/price}}</section><br>
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







</a> <span class="refund_txt get_fare" style="margin-left:25px;" >{{rf}}</span>{{/show_price}}</td>
<td class="select_fly">
{{#flightservice}}     
<div class="disp_trip">
<div class="abimg"><img src="themes/hdfc/assets/images/via/{{img}}" align="absmiddle"></div>
<p>{{car_name}} {{car_id}}-{{fnum}}</p>
<p>{{friend_dst}} - {{friend_arr}}</p>
<p>{{duration}} | {{sour}}<img class="garrow" src="themes/hdfc/assets/images/blue_arrow.png">{{desti}}</p>
</div>
{{/flightservice}}
<input type="hidden" name="leavingfrom1"   value="<?php if(isset($_POST['leavingfrom1'])) echo trim($_POST['leavingfrom1']) ; ?>"  />
<input type="hidden" name="leavingfrom"   value="<?php if(isset($_POST['leavingfrom'])) echo trim($_POST['leavingfrom']) ; ?>"  />
<input type="hidden" name="returndata" value={{returndata}} />
<!--pricing -->
<input type="hidden" name="goingto"  id="goingto" value="<?php if(isset($_POST['goingto'])) echo trim($_POST['goingto']) ; ?>" />
<input type="hidden" name="goingto1"  id="goingto2" value="<?php if(isset($_POST['goingto1'])) echo trim($_POST['goingto1']) ; ?>" />
<input type="hidden" name="stop"  id="stop" value="" />
<input type="hidden" name="type" value="<?php if(isset($_POST['type'])) echo  $_POST['type']; ?>" / >
<input type="hidden" name="discouted" value="N" / >
<?php $p= str_replace('"','quot',serialize($post)) ;?>
<input type="hidden" name="post" value="<?php echo $p ?>" />
</td>
<td class=select_price>{{#price}}{{cash}}{{/price}}</td> 
<td class=select_airlines style="display: none;">{{#flightservice}}{{car_id}},{{/flightservice}}</td> 
<td class=select_fcode style="display: none;">{{#flightservice}}{{fnum}},{{/flightservice}}</td>
<td class=select_refund style="display: none;">{{rf}}</td>
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
       <link href="themes/hdfc/assets/updates/update1/css/style01.css" rel="stylesheet" media="screen">
</div>
</td></tr>
</table>
</div>
<div id="result" align="center"><div style="padding-top:10px;">  
               	<section class="retrive_password">
                <div class="center">
                <span class="opensans size18 caps bold blue">We're on it! Searching for the best prices.</span><br/>
                <span class="opensans size18 grey xsmall">In a few moments, you'll be directed to Flights options galore!</span>
                <br/><br/>
               <img src="<?php echo Theme::asset()->url('images/logo.png'); ?>" width="169px" height="50px" alt=""/>

                </div>
                    <div class="retrive_password_content">
                    <img style="padding-right: 30px;" src="themes/hdfc/assets/images/ajax-loader.gif"> </div>
                 </section>
</div>
</div>
</div>
</section>
</section>
		
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
     $("html, body").animate({ scrollTop: 0 }, "slow");
$(".fare_price_list_header").hide();
$(".onward_fly").html("");
$(".fare_pad1").html("");
$(".cleartrip_pad").html("");
$(".lowest_pad").html("");
$(".fare_loader").show();
var owner = $(this).closest('td').siblings('td.select_fly').html();
onward_price= $(this).closest('td').siblings('td.select_price').text();
var onward_airline= $(this).closest('td').siblings('td.select_airlines').text();
var onward_fcode=$(this).closest('td').siblings('td.select_fcode').text();
$(".onward_fly").append(owner);
var combined_price=parseInt(onward_price)+parseInt(return_price);



$.ajax({
    url : "price_search_round",
    type: "POST",
    data : {req:req,car_id:onward_airline,fcode:onward_fcode},
    async:true,
    success: function(response)
    {
	
		$("#clear_select").val("");
		clear_sky=[];
		fare_search(response,onward_fcode);
		$(".fare_loader").hide();
		$(".fare_pad1").html('<img src="themes/hdfc/assets/images/goibibo.png" height="17px">  &#8377 '+combined_price);
		$("#proceed").show();

		
		if(onward_total != "" && return_total !="")
		{
		var clear_total=onward_total+return_total;
		$(".cleartrip_pad").html('<img src="themes/hdfc/assets/images/cleartrip-logo1.png" height="21px"> &#8377 '+clear_total);
		var fares = [combined_price,clear_total];
		var lowest=fares.sort(function(a, b){return a-b});
		$(".lowest_pad").html('Lowest &#8377 '+lowest[0]);
		$("#proceed_clear").show();
		}
		else{
			$(".lowest_pad").html('Lowest &#8377 '+combined_price);
			$("#proceed_clear").hide();
		    }

			$(".fare_price_list_header").show();
    }

});



});

$(document).on('click', '.return', function(){ 
 $("html, body").animate({ scrollTop: 0 }, "slow");
$(".fare_price_list_header").hide();
$(".return_fly").html("");
$(".fare_pad1").html("");
$(".cleartrip_pad").html("");
$(".fare_loader").show();
$(".lowest_pad").html("");
var owner = $(this).closest('td').siblings('td.select_fly').html();
return_price= $(this).closest('td').siblings('td.select_price').text();
var return_airline= $(this).closest('td').siblings('td.select_airlines').text();
var return_fcode=$(this).closest('td').siblings('td.select_fcode').text();
$(".return_fly").append(owner);
return_price= $(this).closest('td').siblings('td.select_price').text();
var  combined_price=parseInt(onward_price)+parseInt(return_price);


$.ajax({
    url : "price_search_round",
    type: "POST",
    data : {req:req,car_id:return_airline,fcode:return_fcode},
    async:true,
    success: function(response)
    {
	
		$("#return_select").val("");
		return_sky=[];
		fare_round(response,return_fcode);
		$(".fare_loader").hide();
		
		$(".fare_pad1").html('<img src="themes/hdfc/assets/images/goibibo.png" height="17px">  &#8377 '+combined_price);
		$("#proceed").show();
		
		
		if(return_total != "" &&  onward_total != "" )
		{
		
		var clear_total=onward_total+return_total;
		
		$(".cleartrip_pad").html('<img src="themes/hdfc/assets/images/cleartrip-logo1.png" height="21px"> &#8377 '+clear_total);
		var fares = [combined_price,clear_total];
		var lowest=fares.sort(function(a, b){return a-b});
		$(".lowest_pad").html('Lowest &#8377 '+lowest[0]);
		$("#proceed_clear").show();
		
		}
		else{
			$(".lowest_pad").html('Lowest &#8377 '+combined_price);
			$("#proceed_clear").hide();
		    }

		$(".fare_price_list_header").show();
    }

});
                   

});
$(document).ready(function() {	
$("#hidef").hide();
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
		

$(".fare_price_list_header").hide();
$(".fare_loader").hide();
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
<script>
	$(function() {
	
		 $( "#datepicker3" ).datepicker({
		
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
				$( "#datepicker4" ).datepicker( "option",{ minDate:minDate}, selectedDate );

			}

		});
		
		$( "#datepicker4" ).datepicker({
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
			$( "#datepicker3" ).datepicker( "option",{ maxDate:minDate}, selectedDate );
		}
		});

	   
	});
	
</script>
<style> .error{ color:red; } </style>


