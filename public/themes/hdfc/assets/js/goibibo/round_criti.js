var app = [];
var jsonData = [];
var total_flights=0;
var full_sky=[];
var fly_agents=1;
var goibibo_onward='';
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

$('.fare_button').hide();
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
    url : "round_flights",
    type: "POST",
    data : {req:req,_token:token},
    async:true,
    dataType: 'json',
    success: function(response)
    {
	
       	var car_name_template = Mustache.compile($.trim($("#car_name_template").html())),
	$car_name_container = $('#car_name_criteria') ;
	var stops_template=Mustache.compile($.trim($("#stops_template").html())),
	$stops_container=$('#stops_criteria') ;
	var carrier_array = new Array();
	var stop_array= new Array();
	var price_array=new Array();
        var cnt=1;
	var rcnt=1;
	
	var onwFlights=response.data.onwardflights;
	var retFlights =response.data.returnflights;
						
			var outFl = new Array();
			var retFl = new Array();
			var allFl = new Array();
			
			var inorput = false;
		if(onwFlights.length==0)
                {
                     $('.proceed_sec').hide();

                            $('#total_movies').text('No Results Found');
                            $('.result').html('<div id="result" align="center"><div style="padding-top:50px;">  <section class="retrive_password"><h3>No Results Found</h3><div class="retrive_password_content"><img style="padding-right: 57px;"</div></section></div></div> </div>');
                            $('.price_pad').hide();
                            $('.airlines').hide();  
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
				carrier_array.push(car_name);
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
					carrier_array.push(car_name);  
					
					
				}}

					var county= new Object();
					if(f==0)
					flight.row=cnt;
					else
					flight.row='';
				   full_sky.push(flight);
				   full_sky.sort(function (a,b){
                                //   console.log("a");console.log(a.price[0]['cash']);console.log("b");console.log(b.price[0]['cash']);
                                if (a.price[0]['cash'] < b.price[0]['cash'])
                                return -1;
                                if (a.price[0]['cash']> b.price[0]['cash'])
                                return 1;
                                return 0;
                                });
				   if (typeof fcar_name != "undefined") {
				   carrier_array.push(fcar_name);
                                }

       		}
			for (var f=0; f<retFlights.length;f++){
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
				carrier_array.push(car_name);
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
					carrier_array.push(car_name); 
				}}
				var county= new Object();
				if(f==0)
				flight.row=cnt;
				else
				flight.row='';
				full_sky.push(flight);
					
                                            
                                full_sky.sort(function (a,b){
                                //   console.log("a");console.log(a.price[0]['cash']);console.log("b");console.log(b.price[0]['cash']);
                                if (a.price[0]['cash'] < b.price[0]['cash'])
                                return -1;
                                if (a.price[0]['cash']> b.price[0]['cash'])
                                return 1;
                                return 0;
                                });
				
					
				if (typeof fcar_name != "undefined") {
				   carrier_array.push(fcar_name);
                                }

       		}


				
		






		
    
      
      
      
     
      
//console.log(full_sky);
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
 	//app.console('some error encountered');	
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
		 
		
		
		final_tym=time.hours()+' h '+time.minutes()+' m';
		
			
		return final_tym;
		



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
 var template1 = Mustache.compile($.trim($("#template1").html()));
  var view1 = function(movies){
  return template1(movies);
  };
   var callbacks = {
    after_filter: function(result){
    total_flights=services.length;
      $('#total_movies').text(services.length+' of '+total_flights+ ' Flights available');
    },
    before_add: function(services){
    total_flights=services.length;
      $('#total_movies').text(services.length+' of '+total_flights+ ' Flights available');
    },
    after_add: function(services){
        console.log('hiii doble');
    total_flights=services.length;
    $('#total_movies').text(services.length+' of '+total_flights+ ' Flights available');
    var cnt_fly=services.length;
/*if($('input[name=onward]:radio:checked'))
	{
	*/
	  //get_checked();
          //get_checked_onwardr();
          //    var onward_r =get_checked_onwardr();
           
          //get_checked_roundr();
/*	  
	}
	*/
    	if(cnt_fly==0)
    	{
$('#total_movies').text('No Results Found');
$('#result').html('<div id="result" align="center"><div style="padding-top:120px;"><section class="retrive_password"><h3>No Results Found</h3><div class="retrive_password_content"><img style="padding-right: 57px;"</div></section></div></div> </div>');
$('.price_pad').hide();
$('.airlines').hide();
$(".fare_pad").hide();
$('.fare_button').hide();

     	}
        
       
	
    },
    
     after_add1: function(services){
      //  var onward_r =get_checked_onwardr();
        
      var goibibo=get_checked_goibibo();
      
//      var cleartrip_onward=get_checked_cleartrip_onward(goibibo);
//      var cleartrip_return=get_checked_cleartrip_reuturn();
      
     
     }
  };
options="";
  options = {
    filter_criteria: {
    	price_filter:  ['#price_filter .TYPE.range', 'price.ARRAY.cash'],
		 car_name: ['#car_name_criteria input:checkbox .EVENT.click .SELECT.:checked', 'flightservice.ARRAY.car_name'],
			//car_name: ['#car_name_criteria input:checkbox .EVENT.click .SELECT.:checked', 'returnfl.ARRAY.car_name'],
			//nos: ['#stops_criteria input:checkbox .EVENT.click .SELECT.:checked', 'flightservice.ARRAY.nos'],

			nos: ['#stops_criteria input:checkbox .EVENT.click .SELECT.:checked', 'flightservice.ARRAY.nos']	
    },
    and_filter_on: true,
    callbacks: callbacks,
    search: {input: '#searchbox'},
    
  }
$('#result').html('');
$('#hidef').show();

     // console.log(services);

        return FilterJS(services, "#movies", view, "#movies1", view1, options);
	


}



