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
       var car_name_template = Mustache.compile($.trim($("#car_name_template").html())),
	$car_name_container = $('#car_name_criteria') ;
	var stops_template=Mustache.compile($.trim($("#stops_template").html())),
	$stops_container=$('#stops_criteria') ;
	var carrier_array = new Array();
	var stop_array= new Array();
	var price_array=new Array();
       var cnt=1;
	$('OnwardPricedItinerary', json).each(function(index, element) {
		       var flight = new Object();
		       var fcar_name;
		$('Flights', this).each(function(index, element) {
			var rfly= new Array();
			var ofly= new Array();
			flight.onwardfl = new Array();
			flight.returnfl = new Array();
			
			var outFl = new Array();
			var retFl = new Array();
			var allFl = new Array();
			var row_id;
			var inorput = false;
			var focnt=1;
			var frcnt=1;
			var flyocnt=1;
			var flyrcnt=1;
			$('Flight', this).each(function(index, element) {

				var inorput=$(this).attr('isReturn')=='true'
				
				
				if(inorput)
				{

					rfly.push('true');

				}
				else
				{

					ofly.push('false');



				}


			})
			var olen=ofly.length;
			var rlen=rfly.length;
			$('Flight', this).each(function(index, element) {
				var inorput=$(this).attr('isReturn')=='true'
				if(inorput)
				{

					inorput=true;

				}
				
				var sour = $(element).find('pick_point').text();
				
					
				var dest = $(element).find('Destination').text();
				var fnum =$(element).find('FlightNumber').text();
				var car_id =$(element).find('Carrier').attr('id');
				var img = car_id;
				var car_name =$(element).find('Carrier').text();
				var arr_tym =$(element).find('ArrivalTimeStamp').text();
				var dst_tym =$(element).find('DepartureTimeStamp').text();
				var nos=$(element).find('NumberOfStops').text();
				var fclass=$(element).find('Class').text();
				//var fbasis=htmlEncode($(element).find('FareBasis').html());
				if (window.DOMParser)
				{
				 var fbasis=encodeURI(htmlEncode($(element).find('FareBasis').html()));
				}
				else // Internet Explorer
				{
				 var fbasis=encodeURI($(element).find('FareBasis').text());
				}
				fcar_name=car_name;
				
				var rf=$(element).find('Refundable').text();
				var num_of_stops=find_stops(nos);
				var duration=calculate_duration(arr_tym,dst_tym);
				var friend_arr=friend_tym(arr_tym);
				var friend_dst=friend_tym(dst_tym);
				var ref_status=find_refund(rf);
			        var tempAry = new Array();
				tempAry.push(sour);
				tempAry.push(dest);
				allFl.push(tempAry);
				
				if(!inorput) {
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
					if(flyocnt==1)
					{
					fs.startpoint=sour;
					fs.rf=ref_status;
					}					
					if(flyocnt==olen)
					{
					fs.destination=dest;
					fs.nos=flyocnt-1;		
					focnt=1;
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
					focnt="";
					
					fs.focnt=focnt;
					flight.onwardfl.push(fs);
					flyocnt=flyocnt+1;
				} else {
					var fs = new Object();
					
					fs.sour = sour;
					fs.desti = dest;
					fs.car_id=car_id;
					fs.car_name=car_name;
					fs.fnum=fnum;
					fs.img=img+'.gif';
					fs.arr_tym=arr_tym;
					fs.dst_tym=dst_tym;
					fs.fclass=fclass;
					fs.fbasis=fbasis
					fs.duration=duration;
					fs.friend_arr=friend_arr[0];
					fs.friend_adate=friend_arr[1];
					fs.friend_dst=friend_dst[0];
					fs.friend_ddate=friend_dst[1];
					if(flyrcnt==rlen)
					{
					
					fs.nos=flyrcnt-1;		
					frcnt=1;
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
					frcnt="";
					

					if(flyrcnt==1)
					{
						fs.show_price=1;
						fs.rf=ref_status;
					}
					else
					{

						fs.show_price="";

					}
					fs.frcnt=frcnt;
					flight.returnfl.push(fs);
					flyrcnt=flyrcnt+1;
					
					
				}
				/*if(dest == app.returnfl) {
					inorput = true;
				}*/
				//inorput=$(this).attr('isReturn');
			      
				
					
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

				ps.total_basefare=(ps.SingleAdultBaseFare * adult)+(ps.SingleChildBaseFare * child)+(ps.SingleInfantBaseFare *infant);								
				ps.total_surcharge=(ps.SingleAdultSurcharge * adult)+(ps.SingleChildSurcharge * child)+(ps.SingleInfantSurcharge *infant);
				ps.total_tax=(ps.SingleAdultTotalTaxes * adult)+(ps.SingleChildTotalTaxes * child)+(ps.SingleInfantTotalTaxes *infant);
				ps.cash=(ps.SingleAdultTotalAmount * adult)+(ps.SingleChildTotalAmount *child)+(ps.SingleInfantTotalAmount * infant);
				ps.points=Math.round(ps.cash/cratio); 

				if(flight.returnfl.length>0)
				{				
				price_array.push(ps.cash)
				}				
				flight.price.push(ps);
				

	
       // console.log(fly_agents);
        // do_stream(fly_agents);
		
				});


		var county= new Object();
		if(cnt==1)
		flight.row=cnt;
		else
		flight.row='';

		if(flight.returnfl.length>0)
		{
			full_sky.push(flight);
			cnt=cnt+1;
			//console.log(flight.onwardfl);
			carrier_array.push(fcar_name);		
		}
		else{
			flight.onwardfl.pop();
			flight.returnfl.pop();
			flight.price.pop();
			carrier_array.pop();				     
		    }
	
        
      });

	carrier = unique( carrier_array );
	
	stps=unique(stop_array);
	console.log(carrier);
	console.log(stps);
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


   if(refund=='true')
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


