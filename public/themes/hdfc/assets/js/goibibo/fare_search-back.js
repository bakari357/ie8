var app = [];
var jsonData = [];
var trip_data
var clear_sky=[];
 var view="";
function fare_search(trip_data)
{

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
	
	$('solution', json).each(function(index, element) {
	 var flight = new Object();
	$('segments', this).each(function(index, element) {

			flight.onwardfl = new Array();
			
			var flycnt=1;
		        n_of_flights = $(this).find("segment").length;
		$('segment', this).each(function(index, element) {

			var sour = $(element).find('departure-airport').text();
			var dest = $(element).find('arrival-airport').text();
			var fnum = $(element).find('flight-number').text();
			var car_id =$(element).find('airline').text();
			var arr_tym =$(element).find('departure-date-time').text();
			var dst_tym =$(element).find('arrival-date-time').text();
			var nos=$(element).find('stops').text();
			var img=car_id;
			/*--------------------------*/



			         
				
				
				
                              	
				var duration=calculate_duration(arr_tym,dst_tym);
				var friend_arr=friend_tym(arr_tym);
				var friend_dst=friend_tym(dst_tym);
				 
				
				
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
					if(flycnt==1)
					{
					fs.first_flight=1;
					}
					else
					fs.first_flight="";
					if(flycnt==n_of_flights)
					{
					fs.nos=flycnt-1;		
					fcnt=1;
					stop_array.push(fs.nos);
					}					
					else
					fcnt="";			
					
					fs.fcnt=fcnt;
					flight.onwardfl.push(fs);
				
					flycnt=flycnt+1;
			      
		});
	});


			$('pricing-summary', this).each(function(index, element) {
				flight.price=new Array();				
				var ps = new Object();
				var base = $(element).find('base-fare').text();
				var taxes = $(element).find('taxes').text();
				var total = $(element).find('total-fare').text();
				
				ps.total_base=Math.round(base);
				ps.total_tax=Math.round(taxes);
				ps.cash=Math.round(total);
				
				flight.price.push(ps);
				price_array.push(ps.cash)

			})




			clear_sky.push(flight);
			
	

});

	
	find_flight(clear_sky);


}

function calculate_duration(arr,dept)
	{
		var sdate=split_time(dept);
		var edate=split_time(arr);
	       

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
		 date_time[0]=flys_tym.substring(0,2)+ ':' + flys_tym.substring(2,4);
		 date_time[1]=s;
		return date_time;

	}

	function split_time(str)
	{
		var splitted = str.split("T");
		flys_date=splitted[0];
		flys_tym=splitted[1];
		var mydate= new Date(flys_date+'T'+flys_tym.substring(0,2)+ ':' + flys_tym.substring(2,4));
		return mydate;

	}

	function calculate_duration(arr,dept)
	{
		var sdate=split_time(dept);
		var edate=split_time(arr);
	       

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
	
	function find_flight(flightmatch)
	{
		
	}

 

