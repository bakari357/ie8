var app = [];
var jsonData = [];
var movies = {};
var total_flights=0;
 
window.onload = function(){
  movies =  document.getElementById('movies');
 
};

var full_sky=[];
var fly_agents=1;

function unique(arr) {
var i,
    len = arr.length,
    out = [],
    obj = { };

for (i = 0; i < len; i++) {
    obj[arr[i]] = 0;
}
for (i in obj) {
    out.push(i);
}
return out;
};
	function htmlEncode(value) {
		value=value.replace(/<!--/g, '');
		value=value.replace(/-->/g, '');
		return $('<div/>').text(value).html();
		//return 0;
	}

jQuery(document).ready(function($) {

	$('#car_name_criteria :checkbox').prop('checked', true);
	$('#category_all').on('click', function(e){
	$('#car_name_criteria :checkbox').prop('checked', true);
	var phv=$('#price_filter_hidden').val();
	var slide_sp = phv.split("-");
	//$( "#price_slider" ).slider( "values", [slide_sp[0], slide_sp[1]] );
	$('#price_filter').trigger('change');
	});
	$('#category_none').on('click', function(e){
	$('#car_name_criteria :checkbox').prop('checked', false);
	var phv=$('#price_filter_hidden').val();
	var slide_sp = phv.split("-");
	//$( "#price_slider" ).slider( "values", [slide_sp[0], slide_sp[1]] );
	$('#price_filter').trigger('change');
	});



	$('#stops_criteria :checkbox').prop('checked', true);
	$('#stops_all').on('click', function(e){
	$('#stops_criteria :checkbox').prop('checked', $(this).is(':checked'));
 
  });

app.onwardfl = spoint;
app.returnfl = epoint;


       
	var car_name_template = Mustache.compile($.trim($("#car_name_template").html())),
	$car_name_container = $('#car_name_criteria') 
	var stops_template=Mustache.compile($.trim($("#stops_template").html())),
	$stops_container=$('#stops_criteria') 
	var carrier_array = new Array();
	var stop_array= new Array();
	var price_array=new Array();
	var cnt=1;
	$.ajax({
    url : "get_flights",
    type: "POST",
    data : {req:req},
    async:true,
    dataType: 'json',
    success: function(response)
    {
	
	
			
		    	var onwFlights=response.data.onwardflights;
		
			
			for (var f=0; f<onwFlights.length;f++){
				
			var flight = new Object();
			flight.onwardfl = new Array();
			flight.returnfl = new Array();
			var outFl = new Array();
			var retFl = new Array();
			var allFl = new Array();
			var row_id;
			var inorput = false;
			var fcnt=1;
			var flycnt=1;
			


			// variable assign
			        var sour =onwFlights[f].origin;
				var dest =onwFlights[f].destination;
				var fnum =onwFlights[f].flightcode;
				var car_id =onwFlights[f].carrierid;
				var car_name =onwFlights[f].airline;
				var car_name =onwFlights[f].airline;
				var duration=onwFlights[f].splitduration;
				var arr_tym =onwFlights[f].arrdate;
				var dst_tym =onwFlights[f].depdate;
				var stops=onwFlights[f].stops;
				var img = car_id;
				var farebasis =onwFlights[f].farebasis;
				var ibibopartner=onwFlights[f].ibibopartner;
				var bookingclass=onwFlights[f].bookingclass;
				var tickettype=onwFlights[f].tickettype;
                                var stops=onwFlights[f].stops;
				var friend_arr=friend_tym(arr_tym);
				var friend_dst=friend_tym(dst_tym);
				var rf=onwFlights[f].warnings;
				var ful_data=encodeURI(JSON.stringify(onwFlights[f]));
				
				
				
				flight.price=new Array();				
				var ps = new Object();
				
				ps.SingleAdultBaseFare=Math.round(onwFlights[f].fare.adultbasefare);
				ps.SingleAdultSurcharge=Math.round(onwFlights[f].fare.adultbasefare);
				ps.SingleAdultTotalTaxes=Math.round(onwFlights[f].fare.adultbasefare);
				ps.SingleAdultAgentSurcharge=Math.round(onwFlights[f].fare.adultbasefare);
				ps.SingleAdultTotalAmount=Math.round(onwFlights[f].fare.adulttotalfare);
				ps.SingleAdultCreditCardCharges=Math.round(onwFlights[f].fare.adultbasefare);
				ps.SingleAdultCommission=Math.round(onwFlights[f].fare.adultbasefare);
				ps.SingleAdultServiceTax=Math.round(onwFlights[f].fare.adultbasefare);
				
						
							
				ps.total_surcharge=(ps.SingleAdultSurcharge);
				ps.total_tax=(ps.SingleAdultTotalTaxes);
				ps.cash=(ps.SingleAdultTotalAmount);
				ps.points=Math.round(ps.cash); 
		

				flight.price.push(ps);
				price_array.push(ps.cash)
				
				       var fs = new Object();
					
					fs.sour = sour.toUpperCase();
					fs.desti = dest.toUpperCase();
					fs.car_id=car_id;
					fs.img=img+'.gif';
					fs.fnum=fnum;
					fs.car_name=car_name;
					fs.duration=duration;
                    			fs.arr_tym=arr_tym;
					fs.dst_tym=dst_tym;
					fs.friend_arr=friend_arr[0];
					fs.friend_adate=friend_arr[1];
					fs.friend_dst=friend_dst[0];
					fs.friend_ddate=friend_dst[1];
					fs.fnum=fnum;
					fs.show_price=1;
					fs.nos=stops;
					fs.farebasis=farebasis;
					fs.ibibopartner=ibibopartner;
					fs.bookingclass=bookingclass;
					fs.tickettype=tickettype
					fs.fuldata=ful_data;
					fs.rf= rf;
			                
				if(onwFlights[f].onwardflights.length ==0)
				{
					fs.fcnt=1;
					
					
				}
				else
				{
					fs.fcnt="";
				
				}

					flight.onwardfl.push(fs);
				
					carrier_array.push(car_name);             
					stop_array.push(fs.nos);
					
			
		


					

					
					
				


				if(onwFlights[f].onwardflights.length >0)
				{

					var connection_flight=onwFlights[f].onwardflights.length
					
					for(m=0;m<connection_flight;m++)
					{
					connection=onwFlights[f].onwardflights;
					test=connection[m];
					var sour =test.origin;
					var dest =test.destination;
					var fnum =test.flightcode;
					var car_id =test.carrierid;
					var car_name =test.airline;
					var car_name =test.airline;
					var duration=test.splitduration;
					var arr_tym =test.arrdate;
					var rf =test.warnings;
					var dst_tym =test.depdate;
					var stops=test.stops;
					var img = car_id;
					var farebasis =test.farebasis;
					var ibibopartner=test.ibibopartner;
					var bookingclass=test.bookingclass;
					var tickettype=test.tickettype;
					var rf=onwFlights[f].warnings;
					
					var friend_arr=friend_tym(arr_tym);
					var friend_dst=friend_tym(dst_tym);
					
					var fs = new Object();
					
					fs.sour = sour.toUpperCase();
					fs.desti = dest.toUpperCase();
					fs.car_id=car_id;
					fs.img=img+'.gif';
					fs.fnum=fnum;
					fs.car_name=car_name;
					fs.duration=duration;
                   			fs.arr_tym=arr_tym;
					fs.dst_tym=dst_tym;
					fs.friend_arr=friend_arr[0];
					fs.friend_adate=friend_arr[1];
					fs.friend_dst=friend_dst[0];
					fs.friend_ddate=friend_dst[1];
					fs.fnum=fnum;
					fs.show_price=1;
					fs.nos=stops;
					fs.farebasis=farebasis;
					fs.ibibopartner=ibibopartner;
					fs.bookingclass=bookingclass;
					fs.tickettype=tickettype;
					fs.rf= rf;	
					
					if(m==connection_flight-1)
					fs.fcnt="1";
					fs.show_price="";
					flight.onwardfl.push(fs);
					carrier_array.push(car_name);  
					
					
				}}
				full_sky.push(flight);

			}

		
	carrier = unique( carrier_array );

	stps=unique(stop_array);
	price_array.sort(function(a,b){return a-b});
	price_len=price_array.length;
	min_price=price_array[0];
	max_price=price_array[price_len-1];
	//console.log(min_price);
	//console.log(max_price);
	$("#price_label1" ).html('&#8377 '+min_price );
	$("#price_label2" ).html('&#8377 '+max_price );
	$('#price_filter').val(min_price+'-'+max_price);
	$('#price_filter_hidden').val(min_price+'-'+max_price);
	$.each(carrier, function(i, g){
	$car_name_container.append(car_name_template({car_name: g}));
	
  });
	$.each(stps, function(i, j){
	$stops_container.append(stops_template({nos: j}));
	
  });	
		
          var fly_agents =full_sky;


$('#car_name_criteria :checkbox').prop('checked', true);
$('#stops_criteria :checkbox').prop('checked', true);


do_stream(fly_agents,min_price,max_price);
						

    },
 complete: function (response, textStatus, errorThrown)
    {
 	//

    },

    error: function (response, textStatus, errorThrown)
    {
 	console.log('some error encountered');	
    }





});

function find_stops(stops)
{
//console.log(stops);
   if(stops==0)
   {
     return 'Non Stop'

   }
   else if(stops==1)
   {
        return '1 Stop';
   }
   else
   {


       return stops+'Stops';


   }
}

function find_refund(refund)
{
   if(refund)
   {

      return 'Refundable'

   }
   else
   {

      return 'Non Refundable';

   }
   

}

	function calculate_duration(arr,dept)
	{

      
		var sdate=split_time(dept);
		var edate=split_time(arr);
	       
		time=moment.duration(edate - sdate);
		
		if(time.hours()>0)
		{
		if(time.minutes()>0)
		final_tym=time.hours()+' h '+time.minutes()+' m';
		else
		final_tym=time.hours()+' h ';		
		}
		else
		{
		 final_tym=time.minutes()+' m';
		}		
		return final_tym;
		/*seconds = Math.floor((edate - (sdate))/1000);
		//document.write(seconds)
		minutes = Math.floor(seconds/60);
		hours = Math.floor(minutes/60);
		days = Math.floor(hours/24);
		
		hours = hours-(days*24);
		minutes = minutes-(days*24*60)-(hours*60);
		seconds = seconds-(days*24*60*60)-(hours*60*60)-(minutes*60);
		var output="";			
		if(days>0)
		{		
	         output+="Days: "+ days; 
		}
		if(hours>0)
		{
		 output+=hours+' h '; 
		}
		if(minutes>0)
		{
		output+=minutes +' m';
		}	        
		return output;*/




	}
	function friend_tym(str)
	{
		
		var splitted = str.split("t");
		
		flys_date=splitted[0];

		flys_tym=splitted[1];
		// Parse it to a moment
		var m = moment(flys_date+"T"+flys_tym.substring(0,2)+ ':' + flys_tym.substring(2,4));

		// Format it in local time in whatever format you want
		var s = m.format("YYYY-MM-DD  HH:mm:ss")

		// Or treat it as UTC and then format it
		var s = m.utc().format("DD-MMM-YYYY")
	
	         date_time=Array();
		 date_time[0]=flys_tym.substring(0,2)+ ':' + flys_tym.substring(2,4);
		 date_time[1]=s;
		return date_time;

	}

	function split_time(str)
	{
		var splitted = str.split("t");
		flys_date=splitted[0];
		flys_tym=splitted[1];
		
		var m = moment(flys_date+"T"+flys_tym.substring(0,2)+ ':' + flys_tym.substring(2,4),'YYYY-MM-DD  HH:mm:ss');

		return m;
		

	}

	

	
//console.log(fly_agents);
//  var Movies =fly_agents;
 // console.log(Movies);


	function get_fare(fare)
		{
		//alert (fare);
		
		$.post("<?php echo base_url();?>airlines/farerule", {fare:fare}, function(data){

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




		

});

function do_stream(getval,min_price,max_price)
{

var Movies =getval;

$("#price_slider").slider({ 
    min: min_price,
    max: max_price,
    values:[min_price, max_price],
    step: 100,
    range:true,
    slide: function( event, ui ) {

      $("#price_label1" ).html('&#8377 '+ui.values[ 0 ] ); 
      $("#price_label2" ).html('&#8377 '+ui.values[ 1 ]);
      $('#price_filter').val(ui.values[0] + '-' + ui.values[1]).trigger('change');
    }
  });

//console.log(Movies);
$.each(Movies, function(i, m){ m.id = i+1; });

$('#hidden_movie').val(Movies);
window.mf = MovieFilter(Movies);

}

function cleanArray(actual){

  var newArray = new Array();
  for(var i = 0; i<actual.length; i++){
      if (actual[i]){
      
        newArray.push(actual[i]);
        
    }
  }
  return newArray;
}


function fare_search(trip_data)
{

	


}







var MovieFilter = function(services){
  var template = Mustache.compile($.trim($("#template").html()));
  var view = function(movies){

	//console.log(JSON.stringify(movies));
 // movie.stars = movie.stars.join(', ');
   
    return template(movies);
  };

  
  
  var callbacks = {
    after_filter: function(result){
      $('#total_movies').text(result.length+' of '+total_flights+' Flights available');
      var cnt_fly=result.length;
    
    	if(cnt_fly==0)
    	{
    	$('.proceed_sec').hide();
    	
$('#total_movies').text('No Results Found');
$('#result').html('<div id="result" align="center"><div style="padding-top:120px;"><section class="retrive_password"><h3>No Results Found</h3><div class="retrive_password_content"><img style="padding-right: 57px;"</div></section></div></div> </div>');
$('.price_pad').hide();
$('.airlines').hide();

     	}
     	
     	
    },
    before_add: function(services){
     total_flights=services.length;
     $('#total_movies').text(services.length+' of '+total_flights+ ' Flights available');
    },
    after_add: function(services){
     total_flights=services.length;
    $('#total_movies').text(services.length+' of '+total_flights+ ' Flights available');

    }
  };
//options="";

  options = {
    filter_criteria: {
    price_filter:  ['#price_filter .TYPE.range', 'price.ARRAY.cash'],
   car_name: ['#car_name_criteria input:checkbox .EVENT.click .SELECT.:checked', 'onwardfl.ARRAY.car_name'],
   nos: ['#stops_criteria input:checkbox .EVENT.click .SELECT.:checked', 'onwardfl.ARRAY.nos']


    },
    and_filter_on: true,
    callbacks: callbacks,
    search: {input: '#searchbox'}
    
  }
$('#result').html('');



   //   console.log(services);
        return FilterJS(services, "#movies", view, options);


}



