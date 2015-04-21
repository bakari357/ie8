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
    data : {req:req},
    async:true,
    success: function(response, textStatus, jqXHR)
    {
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
	console.log(json);
       var car_name_template = Mustache.compile($.trim($("#car_name_template").html())),
	$car_name_container = $('#car_name_criteria') ;
	var stops_template=Mustache.compile($.trim($("#stops_template").html())),
	$stops_container=$('#stops_criteria') ;
	var carrier_array = new Array();
	var stop_array= new Array();
	var price_array=new Array();
       var cnt=1;
	
	$('returnflights', json).each(function(index, element) {
		 var flight = new Object();      
		       var fcar_name;
			
		$('resource', this).each(function(index, element) {
			
			flight.flightservice = new Array();
			//flight.returnfl = new Array();
			 n_of_flights = $(this).find("Flight").length;
			
			var outFl = new Array();
			var retFl = new Array();
			var allFl = new Array();
			
			var inorput = false;
			var fcnt=1;
			var flycnt=1;
			
				//console.log(element);
//alert($(element).contents().empty().end().text());
				var sour = $(element).find('orgin').text();
				
				alert(sour);	
				var dest = $(element).find('Destination').text();
				var fnum =$(element).find('flightno').text();
				var car_id =$(element).find('carrierid').text();
				var img = car_id;
				var car_name =$(element).find('airline').text();
				var duration=$(element).find('splitduration').text();
				
				var arr_tym =$(element).find('arrdate').text();
				var dst_tym =$(element).find('depdate').text();
				var flight_fare=car_name+'newgrossamount';
				
				var nos=$(element).find('NumberOfStops').text();
				var fclass=$(element).find('Class').text();
				//var fbasis=htmlEncode($(element).find('FareBasis').html());
				if (window.DOMParser)
				{
				 var fbasis=encodeURI(htmlEncode($(element).find('FareBasis').html()));
				}
				else // Internet Explorer
				{
				 var fbasis=$(element).find('FareBasis').text();
				}
				fcar_name=car_name;
				
			        var tempAry = new Array();
				tempAry.push(sour);
				tempAry.push(dest);
				allFl.push(tempAry);
				
				
					var fs = new Object();
					fs.identify=1;
					fs.sour = sour;
					fs.desti = dest;
					fs.car_id=car_id;
					fs.fnum=fnum;
					
					
					
					
					
					
				
			      
				
				flight.flightservice.push(fs);
					
			
			//full_sky.push(flight);
			
			

        });
		

                       full_sky.push(flight);
			
				carrier_array.push(fcar_name);	
			
		
	
        
      });

  var rcnt=1;

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
		 
		
		
		final_tym=time.hours()+' h '+time.minutes()+' m';
		
			
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
      $('#total_movies').text(result.length+' Flights available');
    },
    before_add: function(services){
     $('#total_movies').text(services.length+' Flights available');
    },
    after_add: function(services){
    $('#total_movies').text(services.length+' Flights available');
    var cnt_fly=services.length;
if($('input[name=onward]:radio:checked'))
	{
	  get_checked();
	  
	}
    	if(cnt_fly==0)
    	{
$('#total_movies').text('No Results Found');
$('#result').html('<div id="result" align="center"><div style="padding-top:120px;"><section class="retrive_password"><h3>No Results Found</h3><div class="retrive_password_content"><img style="padding-right: 57px;"</div></section></div></div> </div>');
$('.price_pad').hide();
$('.airlines').hide();
$(".fare_pad").hide();
$('.fare_button').hide();

     	}
	
    }
  };
options="";
  options = {
    filter_criteria: {
			
    },
    and_filter_on: true,
    callbacks: callbacks,
    search: {input: '#searchbox'},
    
  }
$('#result').html('');


     // console.log(services);

        return FilterJS(services, "#movies", view, "#movies1", view1, options);
	


}


