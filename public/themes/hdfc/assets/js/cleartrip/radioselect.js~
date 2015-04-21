function get_checked()
{
//var name = $('#myTable').find('tr:first').html();
//alert(name);
$(".onward_fly").html("");
$(".fare_pad").html("");
var owner = $('input[name=onward]:checked').closest('td').siblings('td.select_fly').html();
onward_price=  $('input[name=onward]:checked').closest('td').siblings('td.select_price').text();
var onward_airline= $('input[name=onward]:checked').closest('td').siblings('td.select_airlines').text();
var onward_fcode=$('input[name=onward]:checked').closest('td').siblings('td.select_fcode').text();
$(".onward_fly").append(owner);
var combined_price=parseInt(onward_price)+parseInt(return_price);
$.ajax({
    url : "price_search_round",
    type: "POST",
    data : {req:req,car_id:onward_airline,fcode:onward_fcode},
    async:true,
    success: function(response)
    {
	
		$("#clear_select").val("");
		clear_sky=[];
		fare_search(response,onward_fcode);
		$(".fare_loader").hide();
		$(".fare_pad").html('Goibibo  &#8377 '+combined_price);
	

		
		if(onward_total != "")
		{
		var clear_total=onward_total+return_total;
		$(".cleartrip_pad").html('Clear Trip &#8377 '+clear_total);
		var fares = [combined_price,clear_total];
		var lowest=fares.sort(function(a, b){return a-b});
		$(".lowest_pad").html('Lowest &#8377 '+lowest[0]);
		
		}
		else{
			$(".lowest_pad").html('Lowest &#8377 '+combined_price);
		    }

			console.log($('#clear_select').val());
    }

});



$(".return_fly").html("");
$(".fare_pad").html("");
var owner = $('input[name=return]:checked').closest('td').siblings('td.select_fly').html();
$(".return_fly").append(owner);
return_price= $('input[name=return]:checked').closest('td').siblings('td.select_price').text();
var return_airline=$('input[name=return]:checked').closest('td').siblings('td.select_airlines').text();
var return_fcode=$('input[name=return]:checked').closest('td').siblings('td.select_fcode').text();
var  combined_price=parseInt(onward_price)+parseInt(return_price);
$('.fare_button').show();

$.ajax({
    url : "price_search_round",
    type: "POST",
    data : {req:req,car_id:return_airline,fcode:return_fcode},
    async:true,
    success: function(response)
    {
	
		$("#return_select").val("");
		return_sky=[];
		fare_round(response,return_fcode);
		$(".fare_loader").hide();
		$(".fare_pad").html('Goibibo  &#8377 '+combined_price);
	
		
		
		if(return_total != "")
		{
		
		var clear_total=onward_total+return_total;
		
		$(".cleartrip_pad").html('Clear Trip &#8377 '+clear_total);
		var fares = [combined_price,clear_total];
		var lowest=fares.sort(function(a, b){return a-b});
		$(".lowest_pad").html('Lowest &#8377 '+lowest[0]);
		
		}
		else{
			$(".lowest_pad").html('Lowest &#8377 '+combined_price);
		    }
		console.log($('#return_select').val());
			
    }

});

}
