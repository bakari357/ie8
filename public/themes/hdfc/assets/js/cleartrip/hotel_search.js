var app = [];
var jsonData = [];
var trip_data;
var hotelcode;
var nflightcode;
var clear_sky=[];
var clear_total;
function hotel_search(trip_data,hotel_code,hotelid)
{
	hotel_code=hotel_code.split(",");
	
	hotel_code=hotel_code[0];

	console.log(hotel_code);
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
	clear_total="";
	$('hotels', json).each(function(index, element) {
	 var hotels = new Object();
	 var check_flag=0;
		
	$('hotel', this).each(function(index, element) {
          
			var id = $(element).find('hotel-id').text();

			$('basic-info', this).each(function(index, element) {
			 var sour = $(element).find('hotel-info\\:hotel-name').text();
		
				var fs = new Object();
				hotels_cleartp = new Array();
			
				 var hotelname = $(element).find('hotel-info\\:hotel-name').text();
				var address = $(element).find('hotel-info\\:address').text();
				var locality = $(element).find('hotel-info\\:locality').text();
				var city = $(element).find('hotel-info\\:city').text();
				var state = $(element).find('hotel-info\\:state').text();
				var country_code = $(element).find('hotel-info\\:country-code').text();
				var zip = $(element).find('hotel-info\\:zip').text();


	
				$('hotel-info\\:rate-info', this).each(function(index, element) {
				var rate = Math.round($(element).find('hotel-info\\:low-rate').text());
				var currency = $(element).find('hotel-info\\:currency').text();
				fs.rate=rate;
				});
				

						
				
					
					fs.id = id;
					fs.hotelname = hotelname;
					fs.address=address;
					fs.locality=locality;
					fs.city=city;
					fs.state=state;
					fs.zip=zip;
					fs.country_code=country_code;
					//fs.rate=rate;
					hotels_cleartp.push(fs);
					clear_total=hotels_cleartp[0].rate;
				return false;
			 
			});	
		});	
	
 
   var clear_json=JSON.stringify(hotels_cleartp);
 jQ_append('#clear_select'+hotelid, clear_json);
	
   
	
	
	

});

	
	

}

function jQ_append(id_of_input, text){
	$(id_of_input).val($(id_of_input).val() + text);
	}



	
	

 

