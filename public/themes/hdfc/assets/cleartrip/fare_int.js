var app = [];
var jsonData = [];
var trip_data;
var flightcode;
var nflightcode;
var clear_sky=[];
 var view="";
var match_codes=new Array();
function fare_search(trip_data,flight_code,return_code)
{
	flightcode=flight_code.split(",");
	returncode=return_code.split(",");
	var fcodes=$.grep(flightcode,function(n){ return(n) });
	var rcodes=$.grep(returncode,function(n){ return(n) });
	var f_len=fcodes.length;
        
        
	var response=trip_data;
        
	var car_name_template = Mustache.compile($.trim($("#car_name_template").html())),
	$car_name_container = $('#car_name_criteria') ;
	var stops_template=Mustache.compile($.trim($("#stops_template").html())),
	$stops_container=$('#stops_criteria') ;
	var carrier_array = new Array();
        var carrier_return=new Array();
	var stop_array= new Array();
	var price_array=new Array();
        var cnt=1;
	var onwFlights=response.data.onwardflights;
                                     
	//var retFlights =response.data.returnflights;					
			var outFl = new Array();
			var retFl = new Array();
			var allFl = new Array();
                        
                   		var outFl = new Array();
			var retFl = new Array();
			var allFl = new Array();
			
			var inorput = false;
                        
                        
                        for (var f=0; f<onwFlights.length;f++){
				var flight = new Object();      
				var fcar_name;

				
				flight.onwardfl = new Array();
				flight.returnfl = new Array();			
				var sour =onwFlights[f].origin;
				var dest =onwFlights[f].destination;
				var ffnum =onwFlights[f].flightcode;
				var car_id =onwFlights[f].carrierid;
				var car_name =onwFlights[f].airline;
				var duration=onwFlights[f].splitduration;
				var arr_tym =onwFlights[f].arrdate;
				var dst_tym =onwFlights[f].depdate;
				var stops=onwFlights[f].stops;
                                var stops_list=onwFlights[f].stops+" - stop";
				var img = car_id;
				var rf=onwFlights[f].warnings;
				var ful_data=encodeURI(JSON.stringify(onwFlights[f]));
				
				 var friend_arr=friend_tym(arr_tym);
                                 var friend_dst=friend_tym(dst_tym);
				
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
				
						
				if(child >0)
				{
				//child break up
                                   ps.SingleChildBaseFare=Math.round(onwFlights[f].fare.childbasefare);
				   ps.SingleChildTotalAmount=Math.round(onwFlights[f].fare.childtotalfare);
				
				}
				else
				{
					ps.SingleChildSurcharge=0;
                                        ps.SingleChildBaseFare=0;
					SingleChildTotalTaxes=0;
					ps.SingleChildTotalAmount=0;
				}

				if(infant >0)
				{
				//infant break up
                                   ps.SingleInfantBaseFare=Math.round(onwFlights[f].fare.infanttotalfare);
				   ps.SingleInfantTotalAmount=Math.round(onwFlights[f].fare.infanttotalfare);
			
				}
				else
				{
                                        ps.SingleInfantBaseFare=0;
					SingleInfantSurcharge=0;
					SingleInfantTotalTaxes=0;
					ps.SingleInfantTotalAmount=0;

				}
				
							
				ps.total_surcharge=(ps.SingleAdultBaseFare * adult)+(ps.SingleChildBaseFare * child)+(ps.SingleInfantBaseFare *infant);
                        
			ps.cash=((ps.SingleAdultTotalAmount * adult) + (ps.SingleChildTotalAmount  * child)+ ( ps.SingleInfantTotalAmount * infant ));
                        
                        ps.total_tax=ps.cash-ps.total_surcharge;
			ps.points=Math.round(ps.cash); 
		

				flight.price.push(ps);
				price_array.push(ps.cash);

			        var tempAry = new Array();
				tempAry.push(sour);
				tempAry.push(dest);
				allFl.push(tempAry);
                                
				carrier_array.push(ffnum);
				var friend_arr=friend_tym(arr_tym);
				var friend_dst=friend_tym(dst_tym);
				
				row_id=cnt;
			        var tempAry = new Array();
				
					var fus = new Object();
					fus.identify=1;
					fus.sour = sour.toUpperCase();
					fus.desti = dest.toUpperCase();
					fus.car_id=car_id;
					fus.img=img+'.gif';
					fus.fnum=ffnum;
					fus.car_name=car_name;
					fus.duration=duration;
                  			fus.arr_tym=arr_tym;
					fus.dst_tym=dst_tym;
					fus.friend_arr=friend_arr[0];
					fus.friend_adate=friend_arr[1];
					fus.friend_dst=friend_dst[0];
					fus.friend_ddate=friend_dst[1];
					fus.show_price=1;
					fus.nos=stops;
					fus.nos_list=stops_list;
					fus.rf= rf;
					fus.fuldata=ful_data;
					
					if(onwFlights[f].onwardflights.length==0)
					{
					fus.fcnt=1;
					fus.nonstop=1;
					
					}
					else
					{
					fus.fcnt="";
					fus.nonstop="";
					
					}

//					if(f==0)
//					fus.cnt=cnt;
					
					stop_array.push(fus.nos);
					
					flight.onwardfl.push(fus);

				//connection flight goes here

				
					if(onwFlights[f].onwardflights.length >0)
				     {
					
					var fcar_name;
					var connection_flight=onwFlights[f].onwardflights.length
					
					for(m=0;m<connection_flight;m++)
					{
					connection=onwFlights[f].onwardflights;
					test=connection[m];
					var sour =test.origin;
					var dest =test.destination;
					var fcnum =test.flightcode;
					var car_id =test.carrierid;
					var car_name =test.airline;
					var duration=test.splitduration;
					var arr_tym =test.arrdate;
					var dst_tym =test.depdate;
					var stops=test.stops;
					var stops_list=test.stops+" - stop";
					var img = car_id;
					
					var friend_arr=friend_tym(arr_tym);
					var friend_dst=friend_tym(dst_tym);
					
					var fcs = new Object();
					fcs.identify=1;
					fcs.sour = sour.toUpperCase();
					fcs.desti = dest.toUpperCase();
					fcs.car_id=car_id;
					fcs.img=img+'.gif';
					fcs.fnum=fcnum;
					fcs.car_name=car_name;
					fcs.duration=duration;
                   			fcs.arr_tym=arr_tym;
					fcs.dst_tym=dst_tym;
                                        fcs.nos=stops;
                                        
					fcs.friend_arr=friend_arr[0];
					fcs.friend_adate=friend_arr[1];
					fcs.friend_dst=friend_dst[0];
					fcs.friend_ddate=friend_dst[1];
					fcs.show_price=1;
					if(m==connection_flight-1)
					{
					fcs.fcnt=1;
					}
					else
					fcs.fcnt="";
					fcs.show_price="";
					flight.row="";
					
					flight.onwardfl.push(fcs);
					carrier_array.push(fcnum); 
					
					
				}}

			// return flights goes here
				if(onwFlights[f].returnfl.length >0)
				     {
					
					var fcar_name;
					var return_flight=onwFlights[f].returnfl.length
					for(n=0;n<return_flight;n++)
					{
					return_fly=onwFlights[f].returnfl;
					back=return_fly[n];
					var sour =back.origin;
					var dest =back.destination;
					var fnum =back.flightcode;
					var car_id =back.carrierid;
					var car_name =back.airline;
                                        
					var duration=back.splitduration;
					var arr_tym =back.arrdate;
					var dst_tym =back.depdate;
					var stops=back.stops;
					var stops_list=back.stops+" - stop";
					var img = car_id;
					var rf=back.warnings;
                                        //console.log(rf);
					var friend_arr=friend_tym(arr_tym);
					var friend_dst=friend_tym(dst_tym);

					var rs = new Object();
					rs.identify=1;
					rs.sour = sour.toUpperCase();
					rs.desti = dest.toUpperCase();
					rs.car_id=car_id;
					rs.img=img+'.gif';
					rs.fnum=fnum;
					rs.car_name=car_name;
					rs.duration=duration;
                   			rs.arr_tym=arr_tym;
					rs.dst_tym=dst_tym;
					rs.friend_arr=friend_arr[0];
					rs.friend_adate=friend_arr[1];
					rs.friend_dst=friend_dst[0];
					rs.friend_ddate=friend_dst[1];
					rs.fnum=fnum;
                                        rs.nos=stops;
                                        rs.nos_list=stops_list;
					rs.show_price=1;
					rs.rf=rf;
					if(n==return_flight-1)
					{
					rs.fcnt=1;
					}
					else
					{
					rs.fcnt="";
					rs.show_price="";
					flight.row="";
					}
					
					flight.returnfl.push(rs);
					carrier_return.push(fnum); 
					
					if(return_fly[0].onwardflights.length >0)
				     {
					
					var fcar_name;
					var connection_flight=return_fly[0].onwardflights.length
					
					for(m=0;m<connection_flight;m++)
					{
					myconnection=return_fly[0].onwardflights;
					rapid=myconnection[m];
					var sour =rapid.origin;
					var dest =rapid.destination;
					var fnum =rapid.flightno;
					var car_id =rapid.carrierid;
					var car_name =rapid.airline;
					var duration=rapid.splitduration;
					var arr_tym =rapid.arrdate;
					var dst_tym =rapid.depdate;
					var stops=rapid.stops;
					var stops_list=rapid.stops+" - stop";
					var img = car_id;
                                        var rf=rapid.warnings;
                                        
					var friend_arr=friend_tym(arr_tym);
					var friend_dst=friend_tym(dst_tym);

					var bcs = new Object();
					bcs.identify=1;
					bcs.sour = sour.toUpperCase();
					bcs.desti = dest.toUpperCase();
					bcs.car_id=car_id;
					bcs.img=img+'.gif';
					bcs.fnum=fnum;
					bcs.car_name=car_name;
                                        bcs.stops=stops;
                                        bcs.stops=stops_list;
					bcs.duration=duration;
                   			bcs.arr_tym=arr_tym;
					bcs.dst_tym=dst_tym;
					bcs.friend_arr=friend_arr[0];
					bcs.friend_adate=friend_arr[1];
					bcs.friend_dst=friend_dst[0];
					bcs.friend_ddate=friend_dst[1];
					bcs.show_price=1;
                                        bcs.rf=rf;
					if(m==connection_flight-1)
					{
					bcs.fcnt=1;
					}
					else
					bcs.fcnt="";
					bcs.show_price="";
					flight.row="";
					
					flight.returnfl.push(bcs);
					carrier_return.push(fnum); 
					
					
				}}





					
					
					
				}}

					var county= new Object();
					if(f==0)
					flight.row=cnt;
					else
					flight.row='';
				   //full_sky.push(flight);
                                   
                                   
                                   var fly_onward=0
				var fly_return=0;
                                
                                //console.log(carrier_array);
				fly_onward=find_flight(carrier_array,fcodes);
				//console.log(fly_onward);

				if(fly_onward==1)
				{
					fly_return=find_flight(carrier_return,rcodes);
				}
		
				if(fly_onward==1 && fly_return==1)	
				{
				clear_sky=[];
				clear_sky.push(flight);
                                
                                
				clear_total=flight.price[0].cash;
				}
				carrier_array = [];
				carrier_return = [];

				
				
			if(fly_onward==1 && fly_return==1)	
			return false;
                          

       		}
                
                  var rcnt=1;
                        
	
	

	var clear_json=JSON.stringify(clear_sky) ;
	
	
	jQ_append('#clear_select', clear_json);
	

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
	
	function find_flight(a1,a2)
	{
		//console.log(a2.toString() +'-'+ a1.toString());
		if(a2.toString() == a1.toString())
		return true;
		else
		return false;
		
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
	function jQ_append(id_of_input, text){
	$(id_of_input).val($(id_of_input).val() + text);
	}

 

