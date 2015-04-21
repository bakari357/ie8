
<script type="text/javascript">

(function($){
 $("img").lazyload({
     effect       : "fadeIn"
 });
})(jQuery);

$(document).ready(function() {
		$("#hotelsearch").validate({
		rules: {
			
			check_in: {
				required: true
			},
			check_out: {
				required: true
			}
		},
		messages: {
			
			check_in: { 
			required: "This field is required.",
			},
			check_out: { 
			required: "This field is required.",
			}
		}
		});
});


function loadage(id)
{
//numberof children
}

//var Movies="";
var req="<?php echo $req ?>"; 


//var services="";
var cratio="<?php echo $c_ratio=1;?>";
 </script>


<section class="row"><!--Content Starts here-->
    	<section class="content_pad">
            <section class="table_div pad27">
	    
<form name="hotelsearch" method="post" action="" id="hotelsearch" class="form-horizontal">
 <?php $postval=serialize(Input::get());?>
   <input type="hidden" name="postvalue" id="postvalue" value="<?php echo $postval; ?>" />
            	<section class="table_top">
                	<section class="hot_c_search">
	                    <input type="text" class="txtbox" name="cityname" value="<?php if(isset($cityname)) echo $cityname;?>" id="cityname"/>	 
                    </section>
                    <section class="hot_city_search">
                     <input type="text" class="txtbox" name="search_name" placeholder="Hotel Name" value="<?php if(isset($search_name)) echo $search_name;?>" id="search_name" />
                     </section>
                    <section class="date_pad">
                    <?php $tomorrow = mktime(0, 0, 0, date("m"), date("d")+1, date("y")); ?>
                       <input type="text" class="date_txt_h" name="check_in" value="<?php if(isset($_POST['check_in'])) echo $_POST['check_in'] ;else echo date('d-m-Y',$tomorrow);?>" readonly autocomplete="off" id="check_in" /> 
                       
                    </section>
                    <section class="date_pad pad8">
                    <?php $dtomorrow = mktime(0, 0, 0, date("m"), date("d")+2, date("y")); ?>
                        <input type="text" name="check_out" class="date_txt_h" value="<?php if(isset($_POST['check_out'])) echo $_POST['check_out'] ;else echo date('d-m-Y',$dtomorrow);?>" readonly autocomplete="off" id="check_out" />
                       
                    </section>
                    <input type="hidden" name="id" id="id" value="" />
                    <input type="hidden" name="search_name" id="search_name" value="<?php echo Input::get('search_name'); ?>"  />
                    <input type="hidden" name="num_rooms" id="num_rooms" value="<?php echo Input::get('num_rooms'); ?>" />
                   
                    <input type="hidden" name="numberOfAdults" id="numberOfAdults" value="<?php  echo Input::get('numberOfAdults'); ?>" />
                    <input type="hidden" name="numberOfChildren" id="numberOfChildren" value="<?php  echo Input::get('numberOfChildren'); ?>" />
                    
                    
                
                    <?php for($i=1; $i<=Input::get('num_rooms'); $i++) { ?>
                    <?php for($j=1; $j<=Input::get('numberOfChildren'.$i.''); $j++) { ?>
                    
                    <input type="hidden" name="room<?php echo $i; ?>Child<?php echo $j; ?>" id="room<?php echo $i; ?>Child<?php echo $j; ?>" value="<?php echo $_POST['room'.$i.'Child'.$j.'']; ?>" />
                    
                     <?php } } ?>
               	<section class="modify"><input type="submit" class="btn_modify" name="submit"  value="Modify Search"> </section>
               	
</form>
                </section>
               
                <section class="trip_txt"><span id="total_movies"></span></section>
                <section class="flight_content_pad"> 
                	<section class="flight_cont_lft">
                	<div class="searchbox">
          <input type="text" id="searchbox" placeholder="Filter hotel or location.." value="">
          
        </div>
                	 <div class="price_pad">
                    	<strong>Star Rating</strong>
                        <ul class="" id="car_name_criteria">
			<li class=" ccr_control">
			<span class="">Select ( <a id="category_all" href="javascript:;"><span >All</span></a>&nbsp;|
&nbsp;<a id="category_none" href="javascript:;"><span>None</span></a>)</span>
			</li>
			</ul>
			</div>
                        <div class="price_pad">
                        	<strong>Price</strong>
                            	 <div id="price_criteria">
				  <span id="price_label1" class="slider-label"></span>
					  <span id="price_label2" class="slider-label"></span>

				  <div id="price_slider" class="slider"></div>
				  <input type="hidden" id="price_filter" value="">
                                   <input type="hidden" id="price_filter_hidden" value="">
                            </div>
                        </div>
                       
                    </section>
                   
<!--<section class="flight_cont_rgt">
<table cellpadding="0" cellspacing="0" class="flights_table_one">
		<tr>
		
		</tr>
		</tr>	
</table>-->
<div class="hotels_wraps">
<script id="template" type="text/html">
{{#hotel_data}}
  
<section class="list_row flights_table_one">
<form action="<?php echo $url = URL::action('Hotels@hotel_details'); ?>"  method="post" id="hotel_list" >

               
                   <?php $postval=str_replace('"','quot',serialize($_POST));?>
                   <input type="hidden" name="postvalue" id="postvalue" value="<?php echo $postval; ?>" />
               <input type="hidden" name="pid" id="pid" value="<?php echo $id=1; ?>" />
               <input type="hidden" name="check_in" id="check_in" value="<?php echo Input::get("check_in");?>" " />
               <input type="hidden" name="check_out" id="check_out" value="<?php echo Input::get("check_out");?>" />
              <input type="hidden" name="num_rooms" id="num_rooms" value="<?php echo 1; ?>" />
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
          
               <input type="hidden" name="thumbnail" id="thumbnail" value="{{hotel_image}}"/>
                
                    <input type="hidden" name="numberOfAdults" id="numberOfAdults" value="" />
                    <input type="hidden" name="numberOfChildren" id="numberOfChildren" value="" />
                    
                    
                    
                  
                    
                    <input type="hidden" name="room" id="roomChild" value="" />
                    
                    
                     <input type="hidden" class="txtbox" name="cityname" value="<?php if(isset($cityname)) echo $cityname;?>" id="cityname"/>
                <?php 
               /*echo '<pre>';
               print_r(str_replace('<br />','',($newhotel)));
               echo '</pre>';*/
               //$hotelinfo='';
               //$hotelinfo=str_replace('"','quot',serialize($newhotel[0])); ?>
               <input type="hidden" name="hotelinfo" id="hotelinfo" value="" />
                </form> 




                	<section class="img_pad">
                	{{#hotel_image}}
                    	<img src="https://images.travelnow.com/{{hotel_image}}">
                    	{{/hotel_image}}
                    	{{^hotel_image}}
                    	<img src="<?php echo  Theme::asset()->url('img/no-photo.png'); ?>">
                    	{{/hotel_image}}
                    </section>
                    <section class="hotel_details">
                    	{{hotel_name}}, {{hotel_address1}}, {{hotel_address2}}
                        <span>{{hotel_city}}</span>
                    </section>
                	<section class="rgt_btn_pad">
                        <a class="hot_btn_price tt" onclick="hotel_details({{hotel_id}})" href="javascript:;"> <img src= "<?php echo Theme::asset()->url('img/rs_symbol.png'); ?>">&nbsp;{{hotel_price}} ({{points}} Pts)
                        
                            <span class="tooltip">
                                <span class="top">
                                    <section class="top_main">
                                        <h3>Average per night</h3>
                                        <p>Amount does not include service fees, tax recovery charges, extra guest charges (if applicable), or other non-room hotel charges.</p>
                                    </section>
                                </span>
                                <span class="bottom"></span>
                            </span></a>
                            <section class="btm_link"><a href="#" onclick="return dispaly();">avg&#47;night</a></section>
                    </section>
                </section>

	{{/hotel_data}}                 
</script>  

<div id="movies">
<div id="resultss"></div>
<div id="result" align="center"><div style="padding-top:120px;">  
               	<section class="retrive_password">
                    <h3>Searching for available Hotels</h3>
                    <div class="retrive_password_content">
                    <img style="padding-right: 57px;" src="<?php echo Theme::asset()->url('img/ajax-loader.gif'); ?>"> </div>
                 
             </section></div></div> </div></div>
</section>
</section>
</section>
</section><!--Content Ends here-->

<script id="car_name_template" type="text/html">
	<li>
	<input type="checkbox" value="{{car_name}}" class="f_all"> <span class="ccr_lab">{{car_name}}</span>
	</li>
</script>

<script id="stops_template" type="text/html">
	<li>
	<input type="checkbox" value="{{nos}}" class="f_all"><span class="ccr_lab"> {{nos}}</span>
	</li>
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
                    
                
                
		$( "#check_in" ).datepicker({
			dateFormat : 'dd-mm-yy',
			changeMonth : true,
			changeYear : true, 
			minDate: '+1d',
			//numberOfMonths: 2, 
			showButtonPanel: true,
			onSelect: function( selectedDate ) {
			
			
				var minDate = $(this).datepicker('getDate');
				if (minDate) {
				minDate.setDate(minDate.getDate() + 1);
				
				}
                                var dateMin = $('#check_in').datepicker("getDate");
                                var rMin = new Date(dateMin.getFullYear(), dateMin.getMonth(),dateMin.getDate() + 1); 
                                var rMax = new Date(dateMin.getFullYear(), dateMin.getMonth(),dateMin.getDate() + 1); 
                                $('#check_out').val($.datepicker.formatDate('dd-mm-yy', new Date(rMax)));     
                        
				$( "#check_out" ).datepicker( "option",{ minDate:minDate,"setDate":'+1d' }, selectedDate  );

			}

		});
		
		
		$( "#check_out" ).datepicker({
		dateFormat : 'dd-mm-yy',
		changeMonth : true,
		changeYear : true, 
		minDate: '+1d',
		//numberOfMonths: 2, 
		showButtonPanel: true,
		onSelect: function( selectedDate ) { //alert($('#startPicker').val());
			var minDate = $(this).datepicker('getDate');
			if (minDate) {
			minDate.setDate(minDate.getDate());
			}
			$( "#check_in" ).datepicker( "option",{ maxDate:minDate}, selectedDate );
		}
		});
	   
	});

    function dispaly()
    {
    alert('Amount does not include service fees, tax recovery charges, extra guest charges (if applicable), or other non-room hotel charges.');
    }
    
    function hotel_details(id){
      $("#hotel_list").submit();
    }
    </script>
