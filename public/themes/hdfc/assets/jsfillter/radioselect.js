function get_checked()
{
//var name = $('#myTable').find('tr:first').html();
//alert(name);
$(".onward_fly").html("");
$(".fare_pad").html("");
var owner = $('input[name=onward]:checked').closest('td').siblings('td.select_fly').html();
onward_price=  $('input[name=onward]:checked').closest('td').siblings('td.select_price').text();
$(".onward_fly").append(owner);
var combined_price=parseInt(onward_price)+parseInt(return_price);
$(".fare_pad").html('&#8377 '+combined_price+' ('+Math.round(combined_price/cratio)+' pts)');



$(".return_fly").html("");
$(".fare_pad").html("");
var owner = $('input[name=return]:checked').closest('td').siblings('td.select_fly').html();
$(".return_fly").append(owner);
return_price= $('input[name=return]:checked').closest('td').siblings('td.select_price').text();
var  combined_price=parseInt(onward_price)+parseInt(return_price);
$(".fare_pad").html('&#8377 '+combined_price+' ('+Math.round(combined_price/cratio)+' pts)');

$('.fare_button').show();
}
