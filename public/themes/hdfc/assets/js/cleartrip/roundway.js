var app = [];
var xmlservices = {};

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
}

jQuery(document).ready(function($) {
$('.flights_tablein').hide();
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


//console.log(spoint);
//console.log(epoint);
	$.ajax({
    url : "round_flights_cleartrip",
    type: "POST",
    data : {req:req},
    async:true,
    success: function(response, textStatus, jqXHR)
    {
        $('.flights_tablein').show();
	 if ( response.dataType == 'script' || textStatus.dataType == 'script' ) {
     response.cache = true;
     }
		
       if (window.DOMParser)
		{
		var xobj=response;
		}
		else // Internet Explorer
		{
		var xobj = $.parseXML(response) 
		}
		/*if ( response.dataType == 'script' || textStatus.dataType == 'script' ) {
		response.cache = true;
		}*/
	var json=xobj;
       // console.log(json);
       var car_name_template = Mustache.compile($.trim($("#car_name_template").html())),
	$car_name_container = $('#car_name_criteria') ;
	var stops_template=Mustache.compile($.trim($("#stops_template").html())),
	$stops_container=$('#stops_criteria') ;
	var carrier_array = new Array();
	var stop_array= new Array();
	var price_array=new Array();
	var carrier_return = new Array();
       var cnt=1;
	$('solution', json).each(function(index, element) {
			var flight = new Object();
			flight.onwardfl = new Array();
			flight.returnfl = new Array();
			var trip_counter=0;
                        var car_name;
	$('flights', this).each(function(index, element) {
	
	
		       
	$('flight', this).each(function(index, element) {
	

	$('segments', this).each(function(index, element) {

			
			var flycnt=0;
		        var focnt=1;
			var frcnt=1;
			var flyocnt=1;
			var flyrcnt=1;
			
			$('segment', this).each(function(index, element) {

			
			var sour = $(element).find('departure-airport').text();
			var dest = $(element).find('arrival-airport').text();
			var fnum = $(element).find('flight-number').text();
			var car_id =$(element).find('airline').text();
			var arr_tym =$(element).find('arrival-date-time').text();
			var dst_tym =$(element).find('departure-date-time').text();
			var operating_airline=$(element).find('operating-airline').text();
			
			var nos=$(element).find('stops').text();
                        //console.log(nos);
			var operating_airline=$(element).find('operating-airline').text();
			var img=car_id;
                        $.each(airline_data, function( index, value ) {
				//console.log( index + ": " + value );
				//console.log(car_id+'-'+index);
				if(car_id==index)
				{
				var car_name =value;
                                if (typeof car_name != "undefined") {
				carrier_array.push(car_name);
                                }
				}
				});
			
		fcar_name=car_name;
                stop_array.push(nos);  
			
			/*-------------------------*/



			         
				
				
				
                              	
				var duration=$(element).find('duration').text()+ ' mins';
				var friend_arr=friend_tym(arr_tym);
				var friend_dst=friend_tym(dst_tym);
				 
				console.log(friend_arr);
				
					var fs = new Object();
					
					fs.sour = sour;
					fs.desti = dest;
					fs.car_id=car_id;
					fs.fnum=fnum;
					fs.img=img+'.gif';
					fs.arr_tym=arr_tym;
					fs.dst_tym=dst_tym;
                                        fs.duration=duration;
                                        fs.friend_arr=friend_arr[0];
					fs.friend_adate=friend_arr[1];
					fs.friend_dst=friend_dst[0];
					fs.friend_ddate=friend_dst[1];
                                        $.each(airline_data, function( index, value ) {
					fs.frcnt=frcnt;
                                        if(car_id==index)
                                        {
                                        var car_name =value;
                                        //carrier_array.push(car_name);
                                        fs.car_name=value;
                                        }
                                        });
                                        if(dest==spoint)
					{
					fs.nos=flyrcnt-1;		
					frcnt=1;
					stop_array.push(fs.nos);    
                                        //console.log(stop_array);
					if(fs.nos==0)
					{
				         fs.nonstop=1;
					}
					else
					{
				         fs.nonstop="";	
					}
					}					
					else
					frcnt="";
                                         if(flyrcnt==1)
					{
						fs.show_price=1;
					}
					else
					{

						fs.show_price="";

					}
					fs.operating_airline=operating_airline;	
									
					if(trip_counter==0)
					{
						flight.onwardfl.push(fs);
						check_flag=1;
						match_codes.push(fnum)
						flycnt=flycnt+1;
                                                $.each(airline_data, function( index, value ) {
                                                if(car_id==index)
                                                {
                                                if (typeof car_name != "undefined") {    
                                                carrier_array.push(car_name);
                                                }
                                                }
                                                });	
					}
					else{
						flight.returnfl.push(fs);
                                                $.each(airline_data, function( index, value ) {
                                                if(car_id==index)
                                                {
                                                carrier_return.push(car_name);
                                                }
                                                });
						
					    }

									      	       
		});
	});
                                                trip_counter=trip_counter+1;

});
		
});

			
		/*------------------------ Price Info ---------------------*/
			
			flight.price=new Array();				
			var ps = new Object();
			$('pricing-summary', this).each(function(index, element) {
				
				var base = $(element).find('base-fare').text();
                                var discount = parseInt($(element).find('discount').text());
                                
                                
                                var markup = $(element).find('markup').text();
                             
				var taxes = $(element).find('taxes').text()-Math.abs(discount);
                                
                              
				var total = $(element).find('total-fare').text();
				
				ps.total_surcharge=Math.round(base);
				ps.total_tax=Math.round(taxes+parseInt(markup));
				ps.cash=Math.round(total);
                                
				price_array.push(ps.cash)

			});

			
			$('pax-pricing-info-list', this).each(function(index, element) {
				
			       //taking paxtype
			flight.passenger_onward=new Array();
			flight.cleartrip_faretype=new Array();		
			var pass = new Object();
			var pt = 1;
				$('pax-pricing-info', this).each(function(index, element) {
			                    	var pax_type = $(element).find('pax-type').text();
			                    	var fare_type = $(element).find('fare-type').text();
			                    	
			                        pass.pax_type=pax_type;
                                                $('pricing-element', this).each(function(index, element) {
                                                var category = $(element).find('category').text();
                                                var amount = $(element).find('amount').text();
                                                var pass = new Object();
                                                pass.category=category;
                                                pass.amount=amount;
                                                pass.pax_type= pax_type;
                                                 flight.passenger_onward.push(pass);
                                                });
			                       var pass_faretype = new Object();
                                                pass_faretype.fare_type= fare_type;
                                                flight.cleartrip_faretype.push(pass_faretype);
			                       
				});
				$('pricing-info', this).each(function(index, element) {
			    		var farekey = $(element).find('fare-key').text();

					ps.farekey=farekey;
				});	


				flight.booking=new Array();				
				var bs = new Object();	
							
				/* booking info begins here --------*/
				$('booking-info', this).each(function(index, element) {

					
					var cabin = $(element).find('cabin-type').text();
					var book_class=$(element).find('booking-class').text();
					var ticket_type=$(element).find('ticket-type').text();
					


					bs.cabin=cabin;
					bs.book_class=book_class;
					bs.ticket_type=ticket_type;
					flight.booking.push(bs);
					});
			

			/*--------*/
			});
			

			flight.price.push(ps);
			
/*-----------price info ends here---------------------*/

			


				

				var fly_onward=0
				var fly_return=0;

				

		
				if(fly_onward==1 && fly_return==1)	
				{
				clear_sky=[];
				clear_sky.push(flight);
                                clear_faretype=flight.cleartrip_faretype['0'].fare_type;
				clear_total=flight.price[0].cash;
				}
				//carrier_array = [];
				//carrier_return = [];

				
				
			if(fly_onward==1 && fly_return==1)	
			return false;
	
        
        if(cnt==1)
		flight.row=cnt;
		else
		flight.row='';

		if(flight.returnfl.length>0)
		{
			full_sky.push(flight);
			cnt=cnt+1;
			//console.log(flight.onwardfl);
                        if (typeof fcar_name != "undefined") { 
			carrier_array.push(fcar_name);	
                        }
		}
		else{
			flight.onwardfl.pop();
			flight.returnfl.pop();
			flight.price.pop();
			carrier_array.pop();				     
		    }

});
        console.log('hai');
        console.log(carrier_array);
	carrier = unique( carrier_array );

	stps=unique(stop_array);
	//console.log(stps);
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
		//var fly_agents =[{"all_flights": { "OnwardPricedItinerary":  full_sky  }}];
          var fly_agents =full_sky;
//console.log(full_sky);

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
 	app.console('some error encountered');	
    }





});

function find_stops(stops)
{
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
		



	}
	function friend_tym(str)
	{
		
		var splitted = str.split("T");
		
		flys_date=splitted[0];

		flys_tym=splitted[1];
		// Parse it to a moment
		var m = moment(flys_date+"T"+flys_tym.substring(0,2)+ ':' + flys_tym.substring(2,4));

		// Format it in local time in whatever format you want
		var s = m.format("YYYY-MM-DD  HH:mm:ss")

		// Or treat it as UTC and then format it
		var s = m.utc().format("DD-MMM-YYYY")
	
	         date_time=Array();
		 date_time[0]=flys_tym.substring(0,2) + flys_tym.substring(2,5);
		 date_time[1]=s;
		return date_time;

	}

	function split_time(str)
	{
		var splitted = str.split("T");
		flys_date=splitted[0];
		flys_tym=splitted[1];
		var m = moment(flys_date+"T"+flys_tym.substring(0,2)+ ':' + flys_tym.substring(2,4),'YYYY-MM-DD  HH:mm:ss');
		return m;
		

	}




});


function do_stream(getval,min_price,max_price)
{	
	var Movies =getval;

$("#price_slider").slider({ 
    min: min_price,
    max: max_price,
    values:[min_price, max_price],
    step: 2000,
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

var MovieFilter = function(services){
  var template = Mustache.compile($.trim($("#template").html()));
  var view = function(movies){
  return template(movies);
  };
   var callbacks = {
    after_filter: function(result){
      $('#total_movies').text(result.length+' Flights available');
    },
    before_add: function(services){
     $('#total_movies').text(services.length+' Flights available');
    },
    after_add: function(services){
    $('#total_movies').text(services.length+' Flights available');
    var cnt_fly=services.length;
    	if(cnt_fly==0)
    	{
$('#total_movies').text('No Results Found');
$('#result').html('<div id="result" align="center"><div style="padding-top:120px;"><section class="retrive_password"><h3>No Results Found</h3><div class="retrive_password_content"><img style="padding-right: 57px;"</div></section></div></div> </div>');
$('.price_pad').hide();
$('.airlines').hide();

     	}
        
        get_checked_international();
    }
  };
options="";
  options = {
    filter_criteria: {
			price_filter:  ['#price_filter .TYPE.range', 'price.ARRAY.cash'],
			car_name: ['#car_name_criteria input:checkbox .EVENT.click .SELECT.:checked', 'onwardfl.ARRAY.car_name'],
			nos: ['#stops_criteria input:checkbox .EVENT.click .SELECT.:checked', 'onwardfl.ARRAY.nos'],


    },
    and_filter_on: true,
    callbacks: callbacks,
    search: {input: '#searchbox'},
    
  }
$('#result').html('');



   //   console.log(services);
        return FilterJS(services, "#movies", view, options);


}

