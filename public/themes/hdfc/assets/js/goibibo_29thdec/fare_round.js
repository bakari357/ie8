var app = [];
var jsonData = [];
var trip_data;
var flightcode;
var nflightcode;
var clear_sky=[];
var return_sky=[];
 var view="";
var match_codes=new Array();
function fare_search(trip_data,flight_code)
{
    
	flightcode=flight_code.split(",");
	var fcodes=$.grep(flightcode,function(n){ return(n) });
	var f_len=fcodes.length;
	if (flightcode.length==1) {
   		   nflight_code=flightcode;
		}
		else
		{

		  nflight_code=flightcode[0];
		}

		if (window.DOMParser)
		{
		var xobj=trip_data;
		
		}
		else // Internet Explorer
		{
		var xobj = $.parseXML(trip_data) 
		}
		/*if ( response.dataType == 'script' || textStatus.dataType == 'script' ) {
		response.cache = true;
		}*/
	var json=trip_data;
	
	var car_name_template = Mustache.compile($.trim($("#car_name_template").html())),
	$car_name_container = $('#car_name_criteria') 
	var stops_template=Mustache.compile($.trim($("#stops_template").html())),
	$stops_container=$('#stops_criteria') 
	var carrier_array = new Array();
	var stop_array= new Array();
	var price_array=new Array();
	var cnt=1;
	var clear_sky=[];
	var check_flag=0;
	var pushed=0;

	
	$('onward-solutions', json).each(function(index, element) {
		
		$('solution', this).each(function(index, element) {
			var flight = new Object();
			$('segments', this).each(function(index, element) {
				
				flight.onwardfl = new Array();
				var flycnt=0;
				n_of_flights = $(this).find("segment").length;	
				
			     $('segment', this).each(function(index, element) {
				
			    	
				var sour = $(element).find('departure-airport').text();
				var dest = $(element).find('arrival-airport').text();
				var fnum = $(element).find('flight-number').text();
				var car_id =$(element).find('airline').text();
				var operating_airline=$(element).find('operating-airline').text();
				var arr_tym =$(element).find('departure-date-time').text();
				var dst_tym =$(element).find('arrival-date-time').text();
				var nos=$(element).find('stops').text();
				var operating_airline=$(element).find('operating-airline').text();
				var img=car_id;

				var duration=calculate_duration(arr_tym,dst_tym);
				var friend_arr=friend_ctym(arr_tym);
				var friend_dst=friend_ctym(dst_tym);


				var fs = new Object();
					
					fs.sour = sour;
					fs.desti = dest;
					fs.car_id=car_id;
					fs.fnum=fnum;
					fs.img=img+'.gif';
					fs.arr_tym=arr_tym;
					fs.dst_tym=dst_tym;
					fs.operating_airline=operating_airline;					
											
					
					flight.onwardfl.push(fs);
					check_flag=1;
					match_codes.push(fnum)
					flycnt=flycnt+1;
					carrier_array.push(fnum);
			     });
			});


			/*------------------------ Price Info ---------------------*/
			
			flight.price=new Array();				
			var ps = new Object();
			$('pricing-summary', this).each(function(index, element) {
				
				var base = $(element).find('base-fare').text();
				var taxes = $(element).find('taxes').text();
				var total = $(element).find('total-fare').text();
                                
                                var markup = $(element).find('markup').text();
				
				ps.total_base=Math.round(base);
				ps.total_tax=(Math.round(taxes)+Math.round(markup));
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
		
				var fly_add=find_flight(carrier_array,fcodes,'onward')
				
				if(fly_add==1)	
				{
				clear_sky=[];
				clear_sky.push(flight);
                                clear_faretype=flight.cleartrip_faretype['0'].fare_type;
				onward_total=flight.price[0].cash;
				}
				carrier_array = [];
			if(fly_add==1)	
			return false;
		});

	});
	

	var clear_json=JSON.stringify(clear_sky) ;

	
	jQ_append('#clear_select', clear_json);
	

}



function fare_round(trip_data,flight_code)
{

	flightcode=flight_code.split(",");
	var fcodes=$.grep(flightcode,function(n){ return(n) });
	var f_len=fcodes.length;
	if (flightcode.length==1) {
   		   nflight_code=flightcode;
		}
		else
		{

		  nflight_code=flightcode[0];
		}

		if (window.DOMParser)
		{
		var xobj=trip_data;
		
		}
		else // Internet Explorer
		{
		var xobj = $.parseXML(trip_data) 
		}
		/*if ( response.dataType == 'script' || textStatus.dataType == 'script' ) {
		response.cache = true;
		}*/
	var json=trip_data;
	
	var car_name_template = Mustache.compile($.trim($("#car_name_template").html())),
	$car_name_container = $('#car_name_criteria') 
	var stops_template=Mustache.compile($.trim($("#stops_template").html())),
	$stops_container=$('#stops_criteria') 
	var carrier_array = new Array();
	var stop_array= new Array();
	var price_array=new Array();
	var cnt=1;
	var return_sky=[];
	var check_flag=0;
	var pushed=0;

	
	$('return-solutions', json).each(function(index, element) {
		
		$('solution', this).each(function(index, element) {
			var flight = new Object();
			$('segments', this).each(function(index, element) {
				
				flight.returnfl = new Array();
				var flycnt=0;
				n_of_flights = $(this).find("segment").length;	
				
			     $('segment', this).each(function(index, element) {
				
			   
				var sour = $(element).find('departure-airport').text();

				var dest = $(element).find('arrival-airport').text();
				var fnum = $(element).find('flight-number').text();
				var car_id =$(element).find('airline').text();
				var arr_tym =$(element).find('departure-date-time').text();
				var dst_tym =$(element).find('arrival-date-time').text();
				var nos=$(element).find('stops').text();
			        var operating_airline=$(element).find('operating-airline').text();
				var img=car_id;

				var duration=calculate_duration(arr_tym,dst_tym);
				var friend_arr=friend_ctym(arr_tym);
				var friend_dst=friend_ctym(dst_tym);


				var fs = new Object();
					
					fs.sour = sour;
					fs.desti = dest;
					fs.car_id=car_id;
					fs.fnum=fnum;
					fs.img=img+'.gif';
					fs.arr_tym=arr_tym;
					fs.dst_tym=dst_tym;
					fs.operating_airline=operating_airline;					
													
					
					flight.returnfl.push(fs);
					check_flacog=1;
					match_codes.push(fnum)
					flycnt=flycnt+1;
					carrier_array.push(fnum);
			     });
			});


			/*------------------------ Price Info ---------------------*/
			
			flight.price=new Array();				
			var ps = new Object();
			$('pricing-summary', this).each(function(index, element) {
				
				var base = $(element).find('base-fare').text();
				var taxes = $(element).find('taxes').text();
				var total = $(element).find('total-fare').text();
				var markup = $(element).find('markup').text();
                                
				ps.total_base=Math.round(base);
				ps.total_tax=(Math.round(taxes)+Math.round(markup));
				ps.cash=Math.round(total);
				ps.total=Math.round(total);
				
				price_array.push(ps.cash)

			});

			
			$('pax-pricing-info-list', this).each(function(index, element) {
				
                                //taking paxtype
			flight.passenger_return=new Array();
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
                                                 flight.passenger_return.push(pass);
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
		
				var fly_add=find_flight(carrier_array,fcodes,'return')
				
				if(fly_add==1)	
				{
				return_sky=[];
				return_sky.push(flight);
                                //console.log(flight);
                                clear_faretype=flight.cleartrip_faretype['0'].fare_type;
				return_total=flight.price[0].cash;
				}
				carrier_array = [];

				
				
			if(fly_add==1)	
			return false;
		});

	});
	

	var return_json=JSON.stringify(return_sky) ;
	
	
	jQ_append('#return_select', return_json);
	

}


	function friend_ctym(str)
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
		 date_time[0]=flys_tym.substring(0,2)+ ':' + flys_tym.substring(2,4);
		 date_time[1]=s;
		return date_time;

	}

	function split_ctime(str)
	{
		var splitted = str.split("T");
		flys_date=splitted[0];
		flys_tym=splitted[1];
		var mydate= new Date(flys_date+'T'+flys_tym.substring(0,2)+ ':' + flys_tym.substring(2,4));
		return mydate;

	}

	function calculate_duration(arr,dept)
	{
		var sdate=split_ctime(dept);
		var edate=split_ctime(arr);
	       

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
	
	function find_flight(a1,a2,trip_type)
	{
                if(trip_type=='onward')
                {
                  onward_total=0;
                }
                 if(trip_type=='return')
                {
                  return_total=0;
                }
		
		if(a2.toString() == a1.toString())
		{
		console.log(a2.toString()+'-'+a1.toString());
                return true;
		}
		
	}


	function jQ_append(id_of_input, text){
	$(id_of_input).val($(id_of_input).val() + text);
	}

 
