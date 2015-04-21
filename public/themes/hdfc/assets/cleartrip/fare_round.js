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
        
        //console.log(fcodes);    
        var f_len=fcodes.length;
        if (flightcode.length==1) {
        nflight_code=flightcode;
        }
        else
        {
        nflight_code=flightcode[0];
        }
	
	var response=trip_data;
	
	var onwFlights=response.data.onwardflights;
	var retFlights =response.data.returnflights;
	console.log(retFlights.length);
        //console.log(retFlights);
			var outFl = new Array();
			var retFl = new Array();
			var allFl = new Array();
			var price_array = new Array();
                        var carrier_array = new Array();
			var inorput = false;
                        var cnt=1;
                        var stop_array=new Array();
                        //var flig=new Array();
		if(onwFlights.length==0)
                {
                            console.log('no response from goibibo');
                }
		for (var f=0; f<onwFlights.length;f++){
				var flight = new Object();      
				var fcar_name;

				flight.flightservice = new Array();
				// variable assign
			        var sour =onwFlights[f].origin;
				var dest =onwFlights[f].destination;
				var fnum =onwFlights[f].flightcode;
				var car_id =onwFlights[f].carrierid;
				var car_name =onwFlights[f].airline;
				var duration=onwFlights[f].splitduration;
				var arr_tym =onwFlights[f].arrdate;
                                
				var dst_tym =onwFlights[f].depdate;
				var stops=onwFlights[f].stops;
				var stops_list=onwFlights[f].stops+ '- stop';
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
					SingleChildTotalTaxes=0;
					ps.SingleChildTotalAmount=0;
                                        ps.SingleChildBaseFare=0;
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
		

				flight.price.push(ps);
				price_array.push(ps.cash);

			        var tempAry = new Array();
				tempAry.push(sour);
				tempAry.push(dest);
				allFl.push(tempAry);
				carrier_array.push(fnum);
				var friend_arr=friend_tym(arr_tym);
				var friend_dst=friend_tym(dst_tym);
				
				row_id=cnt;
			        var tempAry = new Array();
				
					var fs = new Object();
					fs.identify=1;
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
					fs.nos_list=stops_list;
					fs.rf= rf;
					fs.fuldata=ful_data;
					if(onwFlights[f].onwardflights.length==0)
					{
					fs.fcnt=1;
					fs.nonstop=1;
					
					}
					else
					{
					fs.fcnt="";
					fs.nonstop="";
					
					}

					/*if(f==0)
					fs.cnt=cnt;*/
					
					stop_array.push(fs.nos);
					flight.flightservice.push(fs);

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
					var fnum =test.flightcode;
					var car_id =test.carrierid;
					var car_name =test.airline;
					
					var duration=test.splitduration;
					var arr_tym =test.arrdate;
					var dst_tym =test.depdate;
					var stops=test.stops;
					var stops_list=test.stops;
                                        var rf=test.warnings;
					var img = car_id;
                                        

					var fs = new Object();
					fs.identify=1;
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
                                        fs.rf= rf;
					fs.show_price=1;
					if(m==connection_flight-1)
					{
					fs.fcnt=1;
					}
					else
					fs.fcnt="";
					fs.show_price="";
					flight.row="";
					
					flight.flightservice.push(fs);
					carrier_array.push(fnum);  
					
					
				}}
                            
                            //console.log(carrier_array);
                         //console.log(carrier_array+'-'+fcodes);
			 var fly_add=find_flight(carrier_array,fcodes)
                         //console.log(carrier_array+'-'+fcodes);
                            if(fly_add==1)	
				{
				clear_sky=[];
				clear_sky.push(flight);
                                //console.log(flight);
                                //clear_faretype=flight.cleartrip_faretype['0'].fare_type;
                                
                                //console.log(flight.cleartrip_faretype['0'].fare_type);
				onward_total=flight.price[0].cash;
                                console.log(onward_total);
                                //return clear_total;
				}
			carrier_array = [];
                        
//                        if(fly_add==1)	
//			return false;

       		}
           
                
	

	var clear_json=JSON.stringify(clear_sky) ;

	
	jQ_append('#clear_select', clear_json);
	

}



function fare_round(trip_data,flight_code)
{

	 flightcode=flight_code.split(",");
        var fcodes=$.grep(flightcode,function(n){ return(n) });
        
        //console.log(fcodes);    
        var f_len=fcodes.length;
        if (flightcode.length==1) {
        nflight_code=flightcode;
        }
        else
        {
        nflight_code=flightcode[0];
        }
	
	var response=trip_data;
	
	var onwFlights=response.data.onwardflights;
	var retFlights =response.data.returnflights;
	console.log(retFlights.length);
        //console.log(retFlights);
			var outFl = new Array();
			var retFl = new Array();
			var allFl = new Array();
			var price_array = new Array();
                        var carrier_array = new Array();
			var inorput = false;
                        var cnt=1;
                        var stop_array=new Array();
                        //var flig=new Array();
		if(onwFlights.length==0)
                {
                            console.log('no response from goibibo');
                }
	var response=trip_data;
	
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

	
	for (var f=0; f<retFlights.length;f++){
                    
                    console.log('hafffi');
				var flight = new Object();      
				var fcar_name;
				flight.flightservice = new Array();
				// variable assign
			        var sour =retFlights[f].origin;
				var dest =retFlights[f].destination;
				var fnum =retFlights[f].flightcode;
				var car_id =retFlights[f].carrierid;
				var car_name =retFlights[f].airline;
				
				var duration=retFlights[f].splitduration;
				var arr_tym =retFlights[f].arrdate;
				var dst_tym =retFlights[f].depdate;
                                var rf=retFlights[f].warnings;
				var stops=retFlights[f].stops;
				var stops_list=retFlights[f].stops+ '- stop';
				var img = car_id;
				var return_data=encodeURI(JSON.stringify(retFlights[f]));
				
				 var friend_arr=friend_tym(arr_tym);
                                 var friend_dst=friend_tym(dst_tym);
				
				flight.price=new Array();				
				var ps = new Object();
				
				ps.SingleAdultBaseFare=Math.round(retFlights[f].fare.adultbasefare);
				ps.SingleAdultSurcharge=Math.round(retFlights[f].fare.adultbasefare);
				ps.SingleAdultTotalTaxes=Math.round(retFlights[f].fare.adultbasefare);
				ps.SingleAdultAgentSurcharge=Math.round(retFlights[f].fare.adultbasefare);
				ps.SingleAdultTotalAmount=Math.round(retFlights[f].fare.adulttotalfare);
				ps.SingleAdultCreditCardCharges=Math.round(retFlights[f].fare.adultbasefare);
				ps.SingleAdultCommission=Math.round(retFlights[f].fare.adultbasefare);
				ps.SingleAdultServiceTax=Math.round(retFlights[f].fare.adultbasefare);
				
				


				if(child >0)
				{
				//child break up
                                   ps.SingleChildBaseFare=Math.round(retFlights[f].fare.childbasefare);
				   ps.SingleChildTotalAmount=Math.round(retFlights[f].fare.childtotalfare);
				
				}
				else
				{
                                        ps.SingleChildBaseFare=0;
					ps.SingleChildSurcharge=0;
					SingleChildTotalTaxes=0;
					ps.SingleChildTotalAmount=0;
				}

				if(infant >0)
				{
				//infant break up
                                   ps.SingleInfantBaseFare=Math.round(retFlights[f].fare.infanttotalfare);
				   ps.SingleInfantTotalAmount=Math.round(retFlights[f].fare.infanttotalfare);
			
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
//                        console.log(ps.total_surcharge);
//                        console.log(ps.SingleAdultBaseFare);console.log(ps.SingleChildBaseFare);console.log(ps.SingleInfantBaseFare);
//                        console.log(ps.cash);
//                        console.log(ps.total_tax);
			ps.points=Math.round(ps.cash); 
		

				flight.price.push(ps);
				price_array.push(ps.cash);

			        var tempAry = new Array();
				tempAry.push(sour);
				tempAry.push(dest);
				allFl.push(tempAry);
				carrier_array.push(fnum); 
				var friend_arr=friend_tym(arr_tym);
				var friend_dst=friend_tym(dst_tym);
				row_id=cnt;
			        var tempAry = new Array();
				
					var fs = new Object();
					fs.identify="";
					fs.sour = sour.toUpperCase();;
					fs.desti = dest.toUpperCase();;
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
                                        fs.rf= rf;
					fs.nos=stops;
					fs.nos_list=stops_list;
					fs.returndata=return_data;

					if(retFlights[f].onwardflights.length ==0)
					{
					fs.fcnt=1;
					}
					else
					{
					fs.fcnt="";
					}

					if(f==0)
					fs.rcnt=1;
					stop_array.push(fs.nos);
					flight.flightservice.push(fs);

				//connection flight goes here

				
					if(retFlights[f].onwardflights.length >0)
				{
					
					var fcar_name;
					var connection_flight=retFlights[f].onwardflights.length
					
					for(m=0;m<connection_flight;m++)
					{
					connection=retFlights[f].onwardflights;
					test=connection[m];
					var sour =test.origin;
					var dest =test.destination;
					var fnum =test.flightcode;
					var car_id =test.carrierid;
					var car_name =test.airline;
					
					var duration=test.splitduration;
					var arr_tym =test.arrdate;
					var dst_tym =test.depdate;
                                        var friend_arr=friend_tym(arr_tym);
                                        var friend_dst=friend_tym(dst_tym);
					var stops=test.stops;
					var stops_list=test.stops;
					var img = car_id;
                                        var rf=test.warnings;

					var fs = new Object();
					fs.identify="";
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
					fs.nos_list=stops_list;
					if(m==connection_flight-1)
					fs.fcnt=1;
					fs.show_price="";
                                        fs.rf= rf;
					
					flight.flightservice.push(fs);
					carrier_array.push(fnum); 
				}}
				var county= new Object();
				if(f==0)
				flight.row=cnt;
				else
				flight.row='';
				//full_sky.push(flight);
					
                               var fly_add=find_flight(carrier_array,fcodes)
                        
                            if(fly_add==1)	
				{
				clear_sky=[];
				clear_sky.push(flight);
                                //console.log(flight);
                                //clear_faretype=flight.cleartrip_faretype['0'].fare_type;
                                
                                //console.log(flight.cleartrip_faretype['0'].fare_type);
				return_total=flight.price[0].cash;
                                //return clear_total;
				}
			carrier_array = [];
                        
                        if(fly_add==1)	
			return false;             
                              

       		}
	

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
	
	function find_flight(a1,a2)
	{
		
		if(a2.toString() == a1.toString())
		{
		console.log(a2.toString()+'-'+a1.toString());
                return true;
		}
		
	}


	function jQ_append(id_of_input, text){
	$(id_of_input).val($(id_of_input).val() + text);
	}

 

