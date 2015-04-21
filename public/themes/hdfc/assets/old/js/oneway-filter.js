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
function htmlEncode(value) {
value=value.replace(/<!--/g, '');
value=value.replace(/-->/g, '');
    return $('<div/>').text(value).html();
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

crate=cratio;
//console.log(spoint);
//console.log(epoint);
	$.ajax({
    url : "get_flights",
    type: "POST",
    data : {req:req},
    async:true,
    success: function(response, textStatus, jqXHR)
    {
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
	$('OnwardPricedItinerary', json).each(function(index, element) {
		       var flight = new Object();
		  
		$('Flights', this).each(function(index, element) {
			
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
			$('Flight', this).each(function(index, element) {
				

				var sour = $(element).find('pick_point').text();
				
					
				var dest = $(element).find('Destination').text();
				var fnum =$(element).find('FlightNumber').text();
				var car_id =$(element).find('Carrier').attr('id');
				var img = car_id;
				var car_name =$(element).find('Carrier').text();
				var arr_tym =$(element).find('ArrivalTimeStamp').text();
				var dst_tym =$(element).find('departuretimestamp').text();
				var nos=$(element).find('NumberOfStops').text();
				var fclass=$(element).find('Class').text();
				if (window.DOMParser)
				{
				
				var fbasis=htmlEncode($(element).find('FareBasis').html());
				}
				else // Internet Explorer
				{
				var fbasis=$(element).find('FareBasis').text();
				}
				carrier_array.push(car_name);
                              	var rf=$(element).find('Refundable').text();
				//var num_of_stops=find_stops(nos);
				var duration=calculate_duration(arr_tym,dst_tym);
				var friend_arr=friend_tym(arr_tym);
				var friend_dst=friend_tym(dst_tym);
				var ref_status=find_refund(rf);
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
					fs.car_name=car_name;
					fs.img=img+'.gif';
					fs.arr_tym=arr_tym;
					fs.dst_tym=dst_tym;
										
					
					fs.fclass=fclass;
					fs.fbasis=fbasis;
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
					fs.rf=ref_status;
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
			//full_sky.push(flight);
		

        });

		$('Pricing', this).each(function(index, element) {
				flight.price=new Array();				
				var ps = new Object();
				ps.pricing_currency= $(element).attr('currency');
				ps.SingleAdultBaseFare=Math.round($(element).find('SingleAdultBaseFare').text());
				ps.SingleAdultSurcharge=Math.round($(element).find('SingleAdultSurcharge').text());
				ps.SingleAdultTotalTaxes=Math.round($(element).find('SingleAdultTotalTaxes').text());
				ps.SingleAdultAgentSurcharge=Math.round($(element).find('SingleAdultAgentSurcharge').text());
				ps.SingleAdultTotalAmount=Math.round($(element).find('SingleAdultTotalAmount').text());
				ps.SingleAdultCreditCardCharges=Math.round($(element).find('SingleAdultCreditCardCharges').text());
				ps.SingleAdultCommission=Math.round($(element).find('SingleAdultCommission').text());
				ps.SingleAdultServiceTax=Math.round($(element).find('SingleAdultServiceTax').text());
				//child
				ps.SingleChildBaseFare=Math.round($(element).find('SingleChildBaseFare').text());
				ps.SingleChildSurcharge=Math.round($(element).find('SingleChildSurcharge').text());
				ps.SingleChildTotalTaxes=Math.round($(element).find('SingleChildTotalTaxes').text());
				ps.SingleChildAgentSurcharge=Math.round($(element).find('SingleChildAgentSurcharge').text());
				ps.SingleChildTotalAmount=Math.round($(element).find('SingleChildTotalAmount').text());
				ps.SingleChildCreditCardCharges=Math.round($(element).find('SingleChildCreditCardCharges').text());
				ps.SingleChildCommission=Math.round($(element).find('SingleChildCommission').text());
				ps.SingleChildServiceTax=Math.round($(element).find('SingleChildServiceTax').text());
				if(ps.SingleChildTotalAmount>0)
				ps.childprice=1;
				else
				ps.childprice="";
				//infant
				ps.SingleInfantBaseFare=Math.round($(element).find('SingleInfantBaseFare').text());
				ps.SingleInfantSurcharge=Math.round($(element).find('SingleInfantSurcharge').text());
				ps.SingleInfantTotalTaxes=Math.round($(element).find('SingleInfantTotalTaxes').text());
				ps.SingleInfantAgentSurcharge=Math.round($(element).find('SingleInfantAgentSurcharge').text());
				ps.SingleInfantTotalAmount=Math.round($(element).find('SingleInfantTotalAmount').text());
				ps.SingleInfantCreditCardCharges=Math.round($(element).find('SingleInfantCreditCardCharges').text());
				ps.SingleInfantCommission=Math.round($(element).find('SingleInfantCommission').text());
				ps.SingleInfantServiceTax=Math.round($(element).find('SingleInfantServiceTax').text());				
				if(ps.SingleInfantTotalAmount>0)
				ps.infantprice=1;
				if(child==0)
				{
			        ps.SingleChildSurcharge=0;
				SingleChildTotalTaxes=0;
				ps.SingleChildTotalAmount=0;
				
				}
						
				if(infant==0)
				{
				SingleInfantSurcharge=0;
				SingleInfantTotalTaxes=0;
				ps.SingleInfantTotalAmount=0;
				}				
				ps.total_surcharge=(ps.SingleAdultSurcharge * adult)+(ps.SingleChildSurcharge * child)+(ps.SingleInfantSurcharge *infant);
				ps.total_tax=(ps.SingleAdultTotalTaxes * adult)+(ps.SingleChildTotalTaxes * child)+(ps.SingleInfantTotalTaxes *infant);
				ps.cash=(ps.SingleAdultTotalAmount * adult)+(ps.SingleChildTotalAmount *child)+(ps.SingleInfantTotalAmount * infant);
				ps.points=Math.round(ps.cash/cratio); 
				console.log(ps.cash);

				flight.price.push(ps);
				price_array.push(ps.cash)
				//full_sky.push(flight);
				});
		var county= new Object();
		if(cnt==1)
		flight.row=cnt;
		else
		flight.row='';

		full_sky.push(flight);

	cnt=cnt+1;
        //console.log(fly_agents);
        // do_stream(fly_agents);
        
      });

	carrier = unique( carrier_array );

	stps=unique(stop_array);

	price_len=price_array.length;
	min_price=price_array[0];
	max_price=price_array[price_len-1];
	//console.log(min_price);
	//console.log(max_price);
$("#price_label" ).html('Rs '+min_price + '  - ' +'Rs '+max_price );
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
    step: 10,
    range:true,
    slide: function( event, ui ) {

      $("#price_label" ).html(ui.values[ 0 ] + ' Rs. - ' + ui.values[ 1 ] + ' Rs.');
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


