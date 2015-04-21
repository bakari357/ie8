//var airline_data1=jQuery.parseJSON(airline_data);

//console.log(airline_data);


var app = [];
var xmlservices = {};
var movies = {};
 
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

        //console.log(airline_data);

	$('#stops_criteria :checkbox').prop('checked', true);
	$('#stops_all').on('click', function(e){
	$('#stops_criteria :checkbox').prop('checked', $(this).is(':checked'));
 
  });

app.onwardfl = spoint;
app.returnfl = epoint;

crate=cratio;
//console.log(spoint);
//console.log(epoint);
	$.ajax({
    url : "get_flights_cleartrip",
    type: "POST",
    data : {req:req},
    async:true,
    success: function(response, textStatus, jqXHR)
    {
        if($.trim(response)=='Flights not available.')
        {
           
            $('#result').html('<div id="result" align="center"><div style="padding-top:120px;"><section class="retrive_password"><h3>No Results Found</h3><div class="retrive_password_content"><img style="padding-right: 57px;"</div></section></div></div> </div>');
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
       
	var car_name_template = Mustache.compile($.trim($("#car_name_template").html())),
	$car_name_container = $('#car_name_criteria') 
	var stops_template=Mustache.compile($.trim($("#stops_template").html())),
	$stops_container=$('#stops_criteria') 
	var carrier_array = new Array();
	var stop_array= new Array();
	var price_array=new Array();
	var cnt=1;
	$('solution', json).each(function(index, element) {
		       var flight = new Object();
		  
		$('segments', this).each(function(index, element) {

			//console.log(cnt);
			
				 n_of_flights = $(this).find("Flight").length;
				//console.log(n_of_flights);
			flight.onwardfl = new Array();
			flight.returnfl = new Array();
			var outFl = new Array();
			var retFl = new Array();
			var allFl = new Array();
			var row_id;
			var inorput = false;
			var fcnt=1;
			var flycnt=1;
			flight.onwardfl = new Array();
		
		    var n_of_flights = $(this).find("segment").length;
			
		$('segment', this).each(function(index, element) {
         			
         		var car_name;	
				var sour = $(element).find('departure-airport').text();
				var dest = $(element).find('arrival-airport').text();
				var fnum =$(element).find('flight-number').text();
				var car_id =$(element).find('airline').text();
				var img = car_id;
				$.each(airline_data, function( index, value ) {
				//console.log( index + ": " + value );
				//console.log(car_id+'-'+index);
				if(car_id==index)
				{
				var car_name =value;
				carrier_array.push(car_name);
				}
				});				
				
				var arr_tym =$(element).find('arrival-date-time').text();
				var dst_tym =$(element).find('departure-date-time').text();
				var nos=$(element).find('stops').text();
                                var ful_data=encodeURI(JSON.stringify(onwFlights[f]));
				//console.log(nos)

				
                //var rf=$(element).find('Refundable').text();
				//var num_of_stops=find_stops(nos);
				var duration=$(element).find('duration').text()+ ' mins';
				var friend_arr=friend_tym(arr_tym);
				var friend_dst=friend_tym(dst_tym);
				//var ref_status=find_refund(rf);
				row_id=cnt;
			    var tempAry = new Array();


				tempAry.push(sour);
				tempAry.push(dest);
				allFl.push(tempAry);
				
				
					var fs = new Object();
					
					fs.sour = sour;
					fs.desti = dest;
					fs.car_id=car_id;
					fs.fnum=fnum;
					//fs.car_name=car_name;
					fs.img=img+'.gif';
					fs.arr_tym=arr_tym;
					fs.dst_tym=dst_tym;
										
					
					//fs.fclass=fclass;
					//fs.fbasis=fbasis;
					fs.duration=duration;
					fs.friend_arr=friend_arr[0];
					fs.friend_adate=friend_arr[1];
					fs.friend_dst=friend_dst[0];
					fs.friend_ddate=friend_dst[1];
					if(flycnt==1)
					{
						fs.show_price=1;
						//fs.rf=ref_status;
					}
					else{
						fs.show_price='';
					}
					
					if(flycnt==n_of_flights)
					{
					
					fs.nos=flycnt-1;		
					fcnt=1;
					stop_array.push(fs.nos);
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
					fcnt="";			
					$.each(airline_data, function( index, value ) {
				//console.log( index + ": " + value );
				//console.log(car_id+'-'+index);
				if(car_id==index)
				{
				var car_name =value;
				//carrier_array.push(car_name);
				fs.car_name=value;
				}
				});	

					fs.fcnt=fcnt;
					flight.onwardfl.push(fs);
				
					flycnt=flycnt+1;
			      
				
					
			});
			//full_sky.push(flight);
		

        });
				
/*------------------------ Price Info ---------------------*/
			
			flight.price=new Array();				
			var ps = new Object();
			$('pricing-summary', this).each(function(index, element) {
				
				var base = $(element).find('base-fare').text();
				var taxes = $(element).find('taxes').text();
				var total = $(element).find('total-fare').text();
				
				ps.total_base=Math.round(base);
				ps.total_tax=Math.round(taxes);
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
			                    	//console.log(fare_type);
			                       
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
                                
                                
//                                //fare_key
//                                flight.farekey=new Array();				
//				var fk = new Object();
//                                $('pax-pricing-info', this).each(function(index, element) {
//                                    var fare_key = $(element).find('fare-key').text();
//                                    
//                                    fk.fare_key=fare_key;
//				    
//                                });
//                                flight.farekey.push(fk);
                                $('pricing-info', this).each(function(index, element) {
			    		var rf = $(element).find('fare-type').text();

					ps.rf=rf;
						//console.log(rf);
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
			
                                //console.log(flight.booking);
			/*--------*/
			});
			
                        
			flight.price.push(ps);
			
/*-----------price info ends here---------------------*/

	
		var county= new Object();
		if(cnt==1)
		flight.row=cnt;
		else
		flight.row='';

		full_sky.push(flight);

        //console.log(full_sky) ;
	cnt=cnt+1;
        //console.log(fly_agents);
        // do_stream(fly_agents);
        
      });

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
//console.log(fly_agents);

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

	
		function split_ctime(str)
	{
		var splitted = str.split("T");
		flys_date=splitted[0];
		flys_tym=splitted[1];
		var mydate= new Date(flys_date+'T'+flys_tym.substring(0,2)+ ':' + flys_tym.substring(2,4));
		return mydate;

	}

	function calculate_duration(duration)
	{
		seconds = Math.floor((edate - (sdate))/1000);
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
		return output;




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








var MovieFilter = function(services){
  var template = Mustache.compile($.trim($("#template").html()));
  var view = function(movies){

	//console.log(JSON.stringify(movies));
 // movie.stars = movie.stars.join(', ');
   
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
    get_checked_oneway();
    var cnt_fly=services.length;
    	if(cnt_fly==0)
    	{
$('#total_movies').text('No Results Found');
$('#result').html('<div id="result" align="center"><div style="padding-top:120px;"><section class="retrive_password"><h3>No Results Found</h3><div class="retrive_password_content"><img style="padding-right: 57px;"</div></section></div></div> </div>');
$('.price_pad').hide();
$('.airlines').hide();

     	}
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



