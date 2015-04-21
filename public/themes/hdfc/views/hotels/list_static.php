<script src="themes/hdfc/assets/js/jquery.validate.min.js"></script>
 <link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/style.css">      
 <link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/filter1.css"> 
 <link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/filter2.css">   
<script src="themes/hdfc/assets/jsfillter/jquery-ui-1.10.3.custom.js"></script>
<script src="themes/hdfc/assets/jsfillter/jquery.lazyload.js"></script>



<script src="themes/hdfc/assets/jsfillter/mustache.js"></script>
<script src="themes/hdfc/assets/jsfillter/hotels_new/hotels.js"></script>
<script src="themes/hdfc/assets/js/goibibo/moment.min.js"></script>
<script src="themes/hdfc/assets/jsfillter/hotels_new/filter.js"></script> 
<script src="themes/hdfc/assets/js/goibibo/chck_box.js"></script> 
<script src="themes/hdfc/assets/js/goibibo/radioselect.js"></script>
<script src="themes/hdfc/assets/js/goibibo/hotel_search.js"></script> 
 

<?php //echo '<pre>'; print_r($_POST); exit; ?>


	
<script type="text/javascript">






function loadage(id)
{
//numberof children
}

//var Movies="";
var req="<?php echo $req ?>"; 


//var services="";
var cratio="<?php echo $c_ratio=1;?>";
var _token="<?php echo csrf_token(); ?>";
 </script>
	
	
	
	
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="Hotels" class="active">Hotels</a></li>	
					 <li>/</li>
					<li><a href="#">Hotels List</a></li>
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		
	</div>	

	<!-- CONTENT -->
	<div class="container">
		<div class="container pagecontainer offset-0">	

			<!-- FILTERS -->
			<div class="col-md-3 filters offset-0" style="background: #fbfcfd" >
			
				
				<!-- TOP TIP -->
				
				
	

	
	
				<div class="bookfilters hpadding20">
					
					 <span class="progress-bar" id="stream_progress" style="width: 0%">0 %</span>

<div class="line2"></div>
						<div class="w50percent" style="display:none;">
							<div class="radio">
							  
								<input type="hidden" name="optionsRadios" id="optionsRadios1" value="option1" checked>
								
							</div>
							
						</div>
						
						
						
						<div class="clearfix"></div><br/>
						
						<!-- HOTELS TAB -->
<form name="hotelsearch" method="post" action="" id="hotelsearch" class="form-horizontal" onclick="return date_validation();" accept-charset="UTF-8" >
 <?php $postval=urlencode(json_encode(Input::get()));?>
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
 <input type="hidden" name="postvalue" id="postvalue" value="<?php echo $postval; ?>" />
						<div class="hotelstab2 col-md-12 col-lg-12 col-xs-12 nopad pbottom15">
							<div class="hotelstab2 col-md-12 col-lg-12 col-xs-12 nopad pbottom15">
							<span class="opensans size13"><b>Where do you want to go?</b></span>
			
<input type="text" class="form-control" name="cityname" value="<?php if(isset($cityname)) echo $cityname;?>" id="cityname"/>

<?php $inputName = "city_id"; ?>
    <?php echo Form::hidden($inputName, Input::get($inputName), array("id"=>$inputName, "class"=>"citbox_hot")); ?> <?php $inputName = "search_name"; ?>
    <?php echo Form::hidden($inputName, Input::get($inputName), array("id"=>$inputName, "class"=>"citbox_hot")); ?>
							</div>
							<div class="col-xs-12 col-md-12 col-lg-12 nopad clearfix pbottom15">
								<div class="col-xs-12 col-md-12 col-lg-6 textleft nopad">
									<span class="opensans size13"><b>Check In Date</b></span>
							
<?php $tomorrow = mktime(0, 0, 0, date("m"), date("d")+1, date("y")); ?>
                       <input type="text" class="form-control mySelectCalendar" name="check_in" value="<?php if(isset($_POST['check_in'])) echo $_POST['check_in'] ;else echo date('d-m-Y',$tomorrow);?>" style="background-color: #ffffff;" readonly autocomplete="off" id="datepicker" /> 
								</div>
							
								<div class="col-xs-12 col-md-12 col-lg-6 textleft nopad">
									<span class="opensans size13" style="color:#666;"><b>Check Out Date</b></span>
								
<?php $dtomorrow = mktime(0, 0, 0, date("m"), date("d")+2, date("y")); ?>
                        <input type="text" name="check_out" class="form-control mySelectCalendar" value="<?php if(isset($_POST['check_out'])) echo $_POST['check_out'] ;else echo date('d-m-Y',$dtomorrow);?>" style="background-color: #ffffff;" readonly autocomplete="off" id="datepicker2" />
								</div>
							
							
							</div>
							
					
					
					<div class="clearfix"></div>
							
							<div class="room1" >
								<div class="col-xs-12 col-md-12 col-lg-12 nopad pbottom15" >
									<div class="textleft">
										<b>Rooms </b></span><br/>
										
									 <?php $rooms = array('1' => '1', '2' => '2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8');?>
                               <?php echo Form::select("num_rooms",$rooms,$num_rooms,array("id"=>"num_rooms", "class"=>"form-control")); ?>
									</div>
								</div>
								<div class="clearfix"></div>
								<div id="adultdiv">
<!---adult and child listing --->
<?php for($i=1;$i<=$_POST['num_rooms'];$i++){ ?>
								<span class="col-xs-12 col-md-3 col-lg-3 nopad"><b style="display:block; padding-top:24px"> Room <?php echo $i; ?></b></span>


						<div class="col-lg-9 col-md-9 col-xs-12 nopad pbottom15">	
										<div class="col-xs-12 col-lg-6 col-md-6 npright">
												<span class="opensans size13"><b>Adults</b></span> <br>
												<?php $adults = array('1' => '1', '2' => '2','3'=>'3','4'=>'4');?>
						<?php echo Form::select('numberOfAdults'.$i.'',$adults,$_POST['numberOfAdults'.$i.''],array( "class"=>"form-control")); ?>
										</div>
																	
										<div class="col-xs-12 col-lg-6 col-md-6 npright">
											<span class="opensans size13"><b>Child</b></span>
					<?php $children = array('0' => '0','1' => '1', '2' => '2','3'=>'3');?>
                               <?php echo Form::select('numberOfChildren'.$i.'',$children,$_POST['numberOfChildren'.$i.''],array( "id"=>"numberOfChildren'.$i.'","class"=>"form-control","onchange"=>"loadage(".$i.")")); ?>
											</div>
								</div>
							<div class="clearfix"></div>
							
				<div id="childage<?php echo $i; ?>" class="pbottom15 nopad col-xs-12 col-md-12 col-lg-12 pull-right">
<?php if($_POST['numberOfChildren'.$i.'']!=0)
{  
$s=1;for($j=1;$j<=$_POST['numberOfChildren'.$i.''];$j++){ ?>

	<div class="col-xs-12 col-md-4 col-lg-4 npright">
<span>Child <?php echo $j; ?></span><br>
		         <?php $childage = array('0' => '0','1' => '1', '2' => '2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17');?>
						<?php echo Form::select('room'.$i.'Child'.$j.'',$childage,$_POST['room'.$i.'Child'.$j.''],array( "class"=>"form-control")); ?>	
		        </select></div>		

<?php }  } ?>



</div><br>

				
     <?php } ?> 
                           
<div class="clearfix"></div>
          <!--- adult and child listing --->                   	
</div>	</div>						
						
		
 <input type="hidden" name="total_rooms" id="total_rooms" value="<?php echo $num_rooms;?>" /> 			<div class="clearfix pbottom15"></div>
							
							<div class="clearfix"></div>
							<button type="submit" id="search" class="btn-search" >Modify Search</button>
						</div>
						<!-- END OF HOTELS TAB -->
						
										
</form>						
							

	 					
						
				</div>
				<!-- END OF BOOK FILTERS -->	
				
				<div class="line2"></div>
				
				<div class="padding20title" style="background: #fbfcfd;"><span class="opensans dark" style="background: #fbfcfd;color: #333333!important;
font-size: 20px!important;
padding: 0px!important;
">Filter by</span></div><br>
<div class="line2"></div>

<button type="button" class="collapsebtn" data-toggle="collapse" style="background: #fbfcfd;" data-target="#collapse1">	Search by hotel or location</button>
<br><br>
<div style="padding: 0px 10px 0px 16px;margin-top: -16px;">
<input type="text" id="searchbox" class="form-control" placeholder="Filter hotel or location.." value=""><br>
</div>				<div class="line2"></div>
				
				<!-- Star ratings -->	
				<button type="button" class="collapsebtn" data-toggle="collapse" style="background: #fbfcfd;" data-target="#collapse1">
				  Ratings 
				</button>

				<div id="collapse1" class="collapse in">
					<div class="hpadding20" id="car_name_criteria" style="background: #fbfcfd;">
						
					</div>
					<div class="clearfix"></div>
				</div><br>
				<!-- End of Star ratings -->	
				
				<div class="line2"></div>
				
				<!-- Price range -->					
				<button type="button" class="collapsebtn" data-toggle="collapse" style="background: #fbfcfd;" data-target="#collapse2">
				  Price 
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
				</div>
<div class="rightcontent col-md-9 offset-0" style="">


<br/><br/>
				<div class="clearfix"></div>
				
				
			
	<script id="template" type="text/html">
					{{#hotel_data}}
<div class="itemscontainer offset-1">

					
					<div class="offset-2">
						<div class="col-md-4 offset-0">

							<div class="listitem2">
								<a data-footer="A custom footer text" data-title="A random title" data-toggle="lightbox">{{#hotel_image}}
<img lazy_loaded_src="https://images.travelnow.com/{{hotel_image}}" src="http://d3l0yfdzam28k6.cloudfront.net/images/loading-400.gif"   class="lazy_loaded">
                    	{{/hotel_image}}
                    	{{^hotel_image}}
                    	<img src="<?php echo  Theme::asset()->url('img/no-photo.png'); ?>">
                    	{{/hotel_image}}</a>
								
								
							</div>
						</div>
						<div class="col-md-8 offset-0">
							<div class="itemlabel4">
								<div class="labelright"><br/><br/>
									<span class="green size18"><img src="themes/hdfc/assets/images/filter-rating-{{hotel_rates}}.png" class="imgpos1" alt=""/></span>
									<br/><br/><br/>
									<span class="green size18"><b>&#x20b9; {{hotel_price}}</b></span><br/>
									<span class="size11 grey"><a href="#" onclick="return dispaly();">avg&#47;night</a></span><br/><br/>

<table ><tr><td id="hot_table{{hotel_id}}" style="border:none !important;">

<button class="selectbtn mt1 onward" onclick="push_price({{hotel_id}});"name="onward" value="1" type="button" data-toggle="collapse" data-target="#collapse{{hotel_id}}">Find Room</button>	</td> 

<td class="select_fly{{hotel_id}}">

		<input type="hidden" name="postvalue" id="postvalue" value="<?php echo $postval; ?>" />
               <input type="hidden" name="pid" id="pid" value="<?php echo $id=1; ?>" />
               <input type="hidden" name="check_in" id="check_in" value="<?php echo Input::get("check_in");?>" " />
               <input type="hidden" name="check_out" id="check_out" value="<?php echo Input::get("check_out");?>" />
              <input type="hidden" name="num_rooms" id="num_rooms" value="<?php echo $num_rooms;?>" /> 
               <input type="hidden" name="numberOfAdults" id="numberOfAdults" value="<?php echo 1; ?>" />
               <input type="hidden" name="numberOfChildren" id="numberOfChildren" value="<?php echo  1; ?>" />
		<input type="hidden" name="supplierType" id="supplierType" value="{{hotel_supplierType}}"/>
		<input type="hidden" name="roomTypeCode" id="roomTypeCode" value="{{hotel_roomTypeCode}}" />
               <input type="hidden" name="hotelid" id="hotelid" value="{{hotel_id}}" />
               <input type="hidden" name="name" id="name" value="{{hotel_name}}" />
               <input type="hidden" name="supplierType" id="supplierType" value="{{hotel_supplierType}}" />
               <input type="hidden" name="roomTypeCode" id="roomTypeCode" value="{{hotel_roomTypeCode}}" />
               <input type="hidden" name="rateCode" id="rateCode" value="{{hotel_rateCode}}" />
               <input type="hidden" name="rateKey" id="rateKey" value="{{hotel_rateKey}}" />
               <input type="hidden" name="rm_desc" id="rm_desc" value="{{hotel_roomDescription}}"/>
               <input type="hidden" name="average_rate" id="average_rate" value="{{hotel_ChargeableRateInfo}}"/>
          
               <input type="hidden" name="thumbnail" id="thumbnail" value=""/>
                
                    <input type="hidden" name="numberOfAdults" id="numberOfAdults" value="" />
                    <input type="hidden" name="numberOfChildren" id="numberOfChildren" value="" />
                    
                    
                    
                  
                    
                    <input type="hidden" name="room" id="roomChild" value="" />
                    
                    
                     <input type="hidden" class="txtbox" name="cityname" value="<?php if(isset($cityname)) echo $cityname;?>" id="cityname"/>
</td>
<td class="select_price{{hotel_id}}" style="display: none;">{{hotel_name}}</td>
<td class="select_countryCode{{hotel_id}}" style="display: none;">{{hotel_countryCode}}</td>
<td class="select_postalCode{{hotel_id}}" style="display: none;">{{hotel_postalCode}}</td>
<td class="select_city{{hotel_id}}" style="display: none;">{{hotel_city}}</td>
<td class="exp_price{{hotel_id}}" style="display: none;">{{hotel_price}}</td>
</tr> </table>
									
									 
 <!--<a class="bookbtn mt1" onclick="hotel_details({{hotel_id}})" href="javascript:;">Book</a>	-->
											
								</div>
								<div class="labelleft2">			
									<b>{{hotel_name}}</b><br/><br/><br/>
									<p class="grey">
									{{hotel_name}}, {{hotel_address1}}, {{hotel_address2}}
                        <span>{{hotel_city}}</span></p><br/>
								
									
								</div>
							</div>
						</div>
					

					<div class="clearfix"></div>
<div class="cruisedropd" id="collapse{{hotel_id}}" style="height: 132px; display:none;">
							
<form id="expform{{hotel_id}}" name="expform" method="POST" action="<?php echo $url = URL::action('Hotels@hotel_details'); ?>" accept-charset="UTF-8">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">	 
<section id="proceed_sec{{hotel_id}}" class="proceed_sec">
			
                	<section id="proc_box{{hotel_id}}" >
                        <section  id="proc_details{{hotel_id}}" >
			<div id="onward_fly{{hotel_id}}" >
				
			</div>
                        </section>
                    </section>
                 
			<section id="fare_loader{{hotel_id}}" class="fare_loader_hot fare_hotels col-md-9 col-xs-11 col-sm-12" >
			<span>We're On It! searching more booking options</span>

                       <img src="<?php print_r(Config::get('app.url'))?>themes/hdfc/assets/images/ajax-loader.gif">
			</section>

               <div id="fare_price_list_header_hot{{hotel_id}}" class="fare_price_list_header_hot col-md-10 col-sm-12 col-xs-12 "><div class="labelright col-md-8 col-sm-12 col-xs-12" style="margin-top: -8px;" >

       	       <!--<input type="radio"  name="proceed_prices{{hotel_id}}" id="proceed_exp{{hotel_id}}" value="expform{{hotel_id}}" />    -->         <section id="fare_pad1{{hotel_id}}" class="fare_pad1">
                  		
                       <!-- <span>Fare breakup</span>-->
                    </section>
		
			<br>
		   
		 <!--<input type="radio" name="proceed_prices{{hotel_id}}" id="proceed_clear{{hotel_id}}" value="clearform{{hotel_id}}" />-->  <section id="cleartrip_pad{{hotel_id}}" class="cleartrip_pad">
                  	
                       <!-- <span>Fare breakup</span>-->
                    </section>

		   <br>

			
                   </section>
</form>	
<form id="clearform{{hotel_id}}" name="clearform" method="POST" action="<?php echo $url = URL::action('Hotels@hotel_cleartrp'); ?>" accept-charset="UTF-8">	
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<input type="hidden" name="postvalue" id="postvalue" value="<?php echo $postval; ?>" />
<input type="hidden" id="clear_select{{hotel_id}}" name="clear_select" value="">
<input type="hidden" name="req" value="<?php echo $req ?>">
<input type="hidden" name="postvalue" id="postvalue" value="<?php echo $postval; ?>" />
</form>	
						
							<!--<div class="crclose">
								<button class="bookbtn crpos right" type="button" data-toggle="collapse" data-target="#collapse{{hotel_id}}"><span class="glyphicon glyphicon-remove"></span></button>
								<div class="clearfix"></div>
							</div>-->
						</div>
</div>
<br><br>
{{/hotel_data}}

</script> 
<div id="movies">
<div id="resultss"></div>
     <link href="themes/hdfc/assets/updates/update1/css/style01.css" rel="stylesheet" media="screen">	
	
	<!-- Animo css-->
	<link href="themes/hdfc/assets/plugins/animo/animate+animo.css" rel="stylesheet" media="screen">
<div  id="result" class="login-wrap2">
			<div class="center" style="margin-left: 141px;">
				<br/><br/>
				<span class="opensans size18 caps bold blue">We're on it! Searching for the best prices.</span><br/>
				<span class="opensans size18 grey xsmall">In a few moments, you'll be directed to Hotels options galore!</span>
				<br/><br/>
				<img src="<?php echo Theme::asset()->url('images/logo.jpg'); ?>" alt=""/>
				<br/><br/>
				<img src="<?php echo Theme::asset()->url('images/ajax-loader.gif'); ?>" alt=""/>
			</div>

			
</div>
             </form>	

				<!-- End of offset1-->		

				

			</div>
			<!-- END OF LIST CONTENT-->
			
		

		</div>
		<!-- END OF container-->
		
	</div>
	<!-- END OF CONTENT -->
</div></div>	
<script id="car_name_template" type="text/html">
     <div style="font-size:12px;">
							<label>
							<input type="checkbox" value="{{car_name}}" ><img src="themes/hdfc/assets/images/filter-rating-{{car_name}}.png" class="imgpos1" alt=""/>{{car_name}} Stars
							</label>
						</div>
	
</script>

<script id="stops_template" type="text/html">
	<li>
	<input type="checkbox" value="{{nos}}" class="f_all"><span class="ccr_lab"> {{nos}}</span>
	</li>
</script>



 <script type="text/javascript">
function push_price(hotelid) {
$("#collapse"+hotelid).show();
$("#onward_fly"+hotelid).html("");
$("#fare_pad1"+hotelid).html('');
$("#cleartrip_pad"+hotelid).html("");

$("#fare_loader"+hotelid).show();
$("#proceed_clear"+hotelid).hide();
$("#fare_price_list_header_hot"+hotelid).hide();
var owner = $("#hot_table"+hotelid).closest('td').siblings('td.select_fly'+hotelid).html();
var hotel_name= $("#hot_table"+hotelid).closest('td').siblings('td.select_price'+hotelid).text();
var hotel_countryCode= $("#hot_table"+hotelid).closest('td').siblings('td.select_countryCode'+hotelid).text();
var hotel_postalCode= $("#hot_table"+hotelid).closest('td').siblings('td.select_postalCode'+hotelid).text();
var hotel_city= $("#hot_table"+hotelid).closest('td').siblings('td.select_city'+hotelid).text();
var combined_price= $("#hot_table"+hotelid).closest('td').siblings('td.exp_price'+hotelid).text();
var _token="<?php echo csrf_token(); ?>";
$("#onward_fly"+hotelid).append(owner);

$.ajax({
    url : "hotels_search",
    type: "POST",
    data : {req:req,hotel_name:hotel_name,hotelid:hotelid,hotel_countryCode:hotel_countryCode,hotel_postalCode:hotel_postalCode,hotel_city:hotel_city,_token:_token},
    async:true,
    success: function(response)
    {
	hotel_search(response,hotel_name,hotelid);
	if(clear_total != ""){
var first="";
var second="";
var f="";
var s="";
if(clear_total < combined_price){
first='cleartrip_pad'; 
second='fare_pad1';
f=1; 
s=2;
}else{
second='cleartrip_pad'; 
first='fare_pad1';
f=2; 
s=1;
}
	$("#fare_loader"+hotelid).hide();
	$("#proceed"+hotelid).show();
	$("#fare_price_list_header_hot"+hotelid).show();
		$("#"+first+hotelid).html("<img src='<?php echo Theme::asset()->url('images/Expedia.jpg'); ?>' >&nbsp;&nbsp;&nbsp;<span class='size11 grey'><a href='#' onclick='return dispaly();'>Avg&#47;night from</a></span>&nbsp;&nbsp;  &#x20b9; "+combined_price+"<a class='select_button' style='color: #2a6496;background: white;' id='proceed' href='javascript:;'  onclick='return push_flights(1,"+hotelid+")' >Details</a>");
		
		
		
		$("#proceed_clear"+hotelid).show();
		$("#"+second+hotelid).html('<img src="<?php echo Theme::asset()->url('images/cleartrip.jpg'); ?>" alt="">&nbsp;&nbsp;&nbsp;<span class="size11 grey"><a href="#" onclick="return dispaly();">Avg&#47;night from</a></span>&nbsp;&nbsp; &#x20b9; '+clear_total+"<a class='select_button' style='color: #2a6496;background: white;' id='proceed' href='javascript:;'  onclick='return push_flights(2,"+hotelid+")' >Details</a>");
		var fares = [combined_price,clear_total];
		//var lowest=fares.sort(function(a, b){return a-b});
		
		
	}else{

			$("#fare_loader"+hotelid).hide();
	$("#proceed"+hotelid).show();
	$("#fare_price_list_header_hot"+hotelid).show();
		$("#fare_pad1"+hotelid).html("<img src='<?php echo Theme::asset()->url('images/Expedia.jpg'); ?>' >&nbsp;&nbsp;&nbsp;<span class='size11 grey'><a href='#' onclick='return dispaly();'>Avg&#47;night from</a></span>&nbsp;&nbsp;  &#x20b9; "+combined_price+"<a class='select_button' style='color: #2a6496;background: white;' id='proceed' href='javascript:;'  onclick='return push_flights(1,"+hotelid+")' >Details</a>");


		}
		
	
    }

});
}






 $(function() {
    
              
                
                $("#num_rooms").change(function () {
                var count = $("select#num_rooms option:selected").attr('value');
                $.post("loadadults/"+count, function(data){
                $("#adultdiv").html(data);
               //jQuery(".seloption").select_skin();
				
});  

            
               $.post("loadchild/"+count, function(data1){  
               $("#childdiv").html(data1);
               //jQuery(".seloption").select_skin();
               });
               $.post("num_row_child/"+count, function(data1){
              
               $("#child_age").html(data1);
                
               });
                
                });
               
               
              
             
                
	               $( "#datepicker" ).datepicker({
		
			dateFormat : 'dd/mm/yy',
			changeMonth : true,
			changeYear : true, 
			minDate: '+1d',
			
			showButtonPanel: true,
			onSelect: function( selectedDate ) {
				var minDate = $(this).datepicker('getDate');
				if (minDate) {
				minDate.setDate(minDate.getDate() + 1 );
				}
				$( "#datepicker2" ).datepicker( "option",{ minDate:minDate}, selectedDate );

			}

		});
		
		$( "#datepicker2" ).datepicker({
		dateFormat : 'dd/mm/yy',
		changeMonth : true,
		changeYear : true, 
		minDate: '+1d',
		
		showButtonPanel: true,
		onSelect: function( selectedDate ) { //alert($('#startPicker').val());
			var minDate = $(this).datepicker('getDate');
			if (minDate) {
			minDate.setDate(minDate.getDate());
			}
			$( "#datepicker" ).datepicker( "option",{ maxDate:minDate}, selectedDate );
		}
		});
	});
	
	function loadage(id)
              { 
		            
            
		
		var count =$("select[name=numberOfChildren"+id+"] option:selected").val();
     
              $.ajax({
                      type: "POST",
                      url: "<?=URL::to('loadages')?>",
                      data: {
               "id":id,"count": count
              },             
                        success: function(data1) {
                        
                          $("#childage"+id).html(data1);
                      }
                  });
            
          }
		
		
		

    </script> 
    <script>
 
$(document).ready(function(){
$(".fare_loader").hide();
$(".fare_price_list_header").hide();
 $(function() {
  $('#datepicker').datepicker({ minDate: new Date() });
$('#datepicker2').datepicker({ minDate: new Date() });
});
   
    var total = $("#total_rooms").val();
    var count = total;
               /* $.post("loadadults/"+count, function(data){
        
                $("#adultdiv").html(data);
                });*/

    

                
      

$('#hotelsearch').validate({
                focusInvalid: false, 
                ignore: "",
                rules: {
                       cityname: {
                        required: true
                    },
			 check_in: {
                        required: true
                    },
			 check_out: {
                        required: true
                    },
                    form1CardHolderName: {
						minlength: 2,
                        required: true,
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
	
	$('#cityname').keypress(function () { 
	this.value = this.value;
	});	
		
	});
	


</script>

</section>
<script>
                $(function() {
                
                
    
               $("#cityname").autocomplete({
                    source: "cityautocomplete",
                    minLength: 1,                    
                    select: function( event, ui ) {
                        $('#city_id').val(ui.item.id);
                      
                    }
                   }); 
                    
                
	});

    function dispaly()
    {
    alert('Amount does not include service fees, tax recovery charges, extra guest charges (if applicable), or other non-room hotel charges.');
    }
    
    function hotel_details(id){
      $("#hotel_list"+id).submit();
   }
function push_flights(hotelid,name)
		{
if(hotelid==1)
{
$("#expform"+name).submit();
}else
{
$("#clearform"+name).submit();
}
			

		}

	function date_validation()
{
var start=$('#datepicker').val();
var end= $('#datepicker2').val();
if(start==end)
{
alert("Check-in date and check-out date not be same.");
return false;
}else
{
return true;

}

}

 $(function() {
   $("img.lazy").lazyload();
})

    </script>		
	
