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
		//return 0;
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

//app.onwardfl = spoint;
//app.returnfl = epoint;

crate=cratio;

//console.log(spoint);
//console.log(epoint);
	$.ajax({
    url : "showhotel",
    type: "POST",
    data : {req:req,_token:_token},
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
	var rate_array = new Array();
	var price_array=new Array();
	var cnt=1;
	$('HotelSummary', json).each(function(index, element) {
		       var hotel = new Object();
		       hotel.hotel_data = new Array();
			var fs = new Object();
				var name = $(element).find('name').text();
			        var n_name = name.replace("&amp;", "&");
				fs.hotel_name = n_name.replace("&apos;s", "'s");
				fs.hotel_id = $(element).find('hotelId').text();
				fs.hotel_ChargeableRateInfo = $(element).find('ChargeableRateInfo').text();
				fs.hotel_roomDescription = $(element).find('roomDescription').text();
				fs.hotel_address1 = $(element).find('address1').text();
				fs.hotel_roomTypeCode = $(element).find('roomTypeCode').text();
				fs.hotel_rateKey = $(element).find('rateKey').text();
				fs.hotel_rateCode = $(element).find('rateCode').text();
				fs.hotel_supplierType = $(element).find('supplierType').text();
				fs.hotel_address2 = $(element).find('locationDescription').text();
				fs.hotel_city = $(element).find('city').text();
				fs.hotel_countryCode = $(element).find('countryCode').text();
				fs.hotel_postalCode = $(element).find('postalCode').text();
				fs.hotel_price = Math.round($(element).find('lowRate').text());
				hotel_image = $(element).find('thumbNailUrl').text();
				fs.hotel_image = hotel_image.replace("_t.", "_l.");
				fs.hotel_rates = Math.round($(element).find('hotelRating').text());
				fs.points=Math.round(fs.hotel_price/cratio); 
				rate_array.push(fs.hotel_rates);
				price_array.push(Math.round(fs.hotel_price))
				hotel.hotel_data.push(fs);
				full_sky.push(hotel);
				
	});
     
 
           //console.log(full_sky);
                hrates = unique( rate_array );
hrates.sort(function(a, b){return b-a});
	price_array.sort(function(a,b){return a-b});
	price_len=price_array.length;
	min_price=price_array[0];
	max_price=price_array[price_len-1];
	
	$("#price_label1" ).html('&#8377 '+min_price );
	$("#price_label2" ).html('&#8377 '+max_price );
	$('#price_filter').val(min_price+'-'+max_price);
	$('#price_filter_hidden').val(min_price+'-'+max_price);
	$.each(hrates, function(i, g){
	$car_name_container.append(car_name_template({car_name: g}));
	
  });
	
		
          var fly_agents =full_sky;
      

$('#car_name_criteria :checkbox').prop('checked', true);

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
      $('#total_movies').text(result.length+' Hotels available');
      var cnt_fly=result.length;
    	if(cnt_fly==0)
    	{
$('#resultss').show();
$('#resultss').html('<div id="result" align="center"><div style="padding-top:120px;"><section class="retrive_password"><h3>No Results Found</h3><div class="retrive_password_content"><img style="padding-right: 57px;"</div></section></div></div> </div>');
     	}else{
     	$('#resultss').hide();
     	}
    },
    before_add: function(services){
     $('#total_movies').text(services.length+' Hotels available');
    },
    after_add: function(services){
    $('#total_movies').text(services.length+' Hotels available');
    var cnt_fly=services.length;
    	if(cnt_fly==0)
    	{
$('#total_movies').text('No Results Found');
$('#result').html('<div id="result" align="center"><div style="padding-top:120px;"><section class="retrive_password"><h3>No Results Found</h3><div class="retrive_password_content"><img style="padding-right: 57px;"</div></section></div></div> </div>');
$('.searchbox').hide();
$('.price_pad').hide();
$('.airlines').hide();

     	}
    }
  };
//options="";

  options = {
    filter_criteria: {
   price_filter:  ['#price_filter .TYPE.range', 'hotel_data.ARRAY.hotel_price'],
   car_name: ['#car_name_criteria input:checkbox .EVENT.click .SELECT.:checked', 'hotel_data.ARRAY.hotel_rates'],
 


    },
    and_filter_on: true,
    callbacks: callbacks,
    search: {input: '#searchbox'}
    
  }
$('#result').html('');



   //   console.log(services);
        return FilterJS(services, "#movies", view, options);


}


