function get_checked_goibibo()
{
       $(".onward").prop("disabled",true);
    //$('input[name=return]').attr("disabled",true);
   
     $(".return").prop("disabled",true);
    var  combined_price=0;
    var onward_price=0;
    var return_price=0;
    var checked=$('.flight_leftwrap').closest('div#fjs_1').html();
    
    $('.onward:first').attr('checked',true);
//var name = $('#myTable').find('tr:first').html();
//alert(name);
$(".onward_fly").html("");
$(".fare_pad1").html("");
$(".fare_loader").show();
$(".fare_price_list_header").hide();
var owner = $('input[name=onward]:checked').closest('td').siblings('td.select_fly').html();

var onward_price=  $('input[name=onward]:checked').closest('td').siblings('td.select_price').text();
var onward_airline= $('input[name=onward]:checked').closest('td').siblings('td.select_airlines').text();
var onward_fcode=$('input[name=onward]:checked').closest('td').siblings('td.select_fcode').text();
var sour=$('input[name=onward]:checked').closest('td').siblings('td.sour').text();
var desti=$('input[name=onward]:checked').closest('td').siblings('td.desti').text();
var return_airline=$('input[name=return]:checked').closest('td').siblings('td.select_airlines').text();

if(onward_airline=='' && return_airline=='' )
{
}
$(".onward_fly").append(owner);



 var checked=$('.flight_rgtwrap').closest('div#fjs_1').html();
    
    $('.return:first').attr('checked',true);
    
$(".return_fly").html("");
$(".fare_pad1").html("");
var owner = $('input[name=return]:checked').closest('td').siblings('td.select_fly').html();
$(".return_fly").append(owner);
return_price= $('input[name=return]:checked').closest('td').siblings('td.select_price').text();
var return_airline=$('input[name=return]:checked').closest('td').siblings('td.select_airlines').text();
var return_fcode=$('input[name=return]:checked').closest('td').siblings('td.select_fcode').text();
var arr_tym1=$('input[name=return]:checked').closest('td').siblings('td.arr_tym').text();
var dst_tym1=$('input[name=return]:checked').closest('td').siblings('td.dst_tym').text();
var return_sour=$('input[name=return]:checked').closest('td').siblings('td.return_sour').text();
var return_desti=$('input[name=return]:checked').closest('td').siblings('td.return_desti').text();
console.log(onward_price);
if(return_price=='')
{
    combined_price=parseInt(onward_price);
}
else if(onward_price=='')
{
 
    combined_price=parseInt(return_price);
}
else
{
    
combined_price=parseInt(onward_price)+parseInt(return_price);
}

//$(".fare_price_list_header").show();
//		$("#proceed").show();
//$(".fare_pad1").html('<img src="themes/hdfc/assets/images/goibibo.png" height="17px">  &#8377 '+combined_price);
//$('.fare_loader').hide();
//$(".fare_price_list_header").show();
//$("#proceed").show();
//return combined_price;
get_checked_cleartrip_onward(combined_price);
}



function get_checked_cleartrip_onward(goibibo)
{

    $(".cleartrip_pad").html("");

    var clear_total='';
    var onward_airline= $('input[name=onward]:checked').closest('td').siblings('td.select_airlines').text();
    var onward_fcode=$('input[name=onward]:checked').closest('td').siblings('td.select_fcode').text();
    var return_airline=$('input[name=return]:checked').closest('td').siblings('td.select_airlines').text();
    var return_fcode=$('input[name=return]:checked').closest('td').siblings('td.select_fcode').text();  
//    alert(onward_airline);
    $.ajax({
    url : "price_search_round",
    type: "POST",
    data : {req:req,car_id:onward_airline,fcode:onward_fcode,_token:token},
    async:true,
    success: function(response)
    {

	        if(trimStr(response) =='Flights not available.' || trimStr(response) == 'Invalid carrier code:')
		{

			
		onward_total=0;
		}
		else
		{
		$("#clear_select").val("");
		clear_sky=[];
		fare_search(response,onward_fcode);
                clear_total=onward_total;
		}
                get_checked_return(goibibo,onward_total);
            
    }

});

}

function get_checked_return(goibibo,onward_total)
{
  
    var onward_airline= $('input[name=onward]:checked').closest('td').siblings('td.select_airlines').text();
    var onward_fcode=$('input[name=onward]:checked').closest('td').siblings('td.select_fcode').text();
    var return_airline=$('input[name=return]:checked').closest('td').siblings('td.select_airlines').text();
    var return_fcode=$('input[name=return]:checked').closest('td').siblings('td.select_fcode').text(); 
//     alert(return_airline);
    var clear_total1='';
    var clear_total='';
    $.ajax({
    url : "price_search_round",
    type: "POST",
    data : {req:req,car_id:return_airline,fcode:return_fcode,_token:token},
    async:true,
    success: function(response)
    {
		$("#return_select").val("");
		return_sky=[];
                
     		if(trimStr(response) =='Flights not available.'|| trimStr(response) == 'Invalid carrier code:')
		{
		clear_total=0;
		return_total=0;
		}
		else
		{           
		fare_round(response,return_fcode);
		$(".fare_loader").hide();
		var clear_total=onward_total+return_total;
		}
                
		fare_render(goibibo,onward_total,return_total,clear_total);
             
	
    }

});
}

function fare_render(goibibo,onward_total,return_total,clear_total)
{
     
    $('#proceed_clear').hide();
    $(".fare_pad1").html('<img src="themes/hdfc/assets/images/goibibo.png" height="17px"/>  &#8377 '+goibibo);
    if(onward_total!=0 && return_total!=0)
    {
    $(".cleartrip_pad").html('<img src="themes/hdfc/assets/images/cleartrip-logo1.png" height="21px"/> &#8377 '+clear_total);
   
    $('#proceed_clear').show();
    }
      // $(".cleartrip_pad").html('<img src="themes/hdfc/assets/images/cleartrip-logo1.png" height="21px"> &#8377'+ 5260);
// <section class="cleartrip_pad" style="
//    padding-left: 20px;
//"><img src="themes/hdfc/assets/images/cleartrip-logo1.png" height="21px"> ₹ 5260</section>
    $("#proceed").show();
    $('.proceed_sec').show();
    $('.fare_button').show();
    $(".fare_price_list_header").show();
    $(".fare_loader").hide();
    $(".onward").prop("disabled",false);
    //$('input[name=return]').attr("disabled",true);

    $(".return").prop("disabled",false);
    //$(".return input:radio").attr('disabled',false);
		
               
}

function get_checked_oneway()
{
    var checked=$('.flights_table_one').closest('table#fjs_1').html();
     $(".onward").prop("disabled",true);
    $('.onward:first').attr('checked',true);
$(".onward_fly").html("");
$(".fare_pad1").html("");
$(".fare_loader").show();
$(".fare_price_list_header").hide(); 

var owner = $('input[name=onward]:checked').closest('td').siblings('td.select_fly').html();

var onward_price=  $('input[name=onward]:checked').closest('td').siblings('td.select_price').text();
var onward_airline= $('input[name=onward]:checked').closest('td').siblings('td.select_airlines').text();

var onward_fcode=$('input[name=onward]:checked').closest('td').siblings('td.select_fcode').text();


$(".onward_fly").append(owner);
var combined_price=parseInt(onward_price);
$.ajax({
    url : "price_search",
    type: "POST",
    data : {req:req,car_id:onward_airline,fcode:onward_fcode,_token:token},
    async:true,
    success: function(response)
    {
	
		$("#clear_select").val("");
		clear_sky=[];
		fare_search(response,onward_fcode);
		$(".fare_loader").hide();
		$(".fare_pad1").html('<img src="themes/hdfc/assets/images/goibibo.png" height="17px"/>  &#8377 '+combined_price);
		$("#proceed").show();
	$(".fare_price_list_header").show();
		
		
		if(clear_total != "" && typeof clear_total!="undefined")
		{
		
		$(".cleartrip_pad").html('<img src="themes/hdfc/assets/images/cleartrip-logo1.png" height="21px"/> &#8377 '+clear_total);
		var fares = [combined_price,clear_total];
		var lowest=fares.sort(function(a, b){return a-b});
		$(".lowest_pad").html('Lowest &#8377 '+lowest[0]);
		$(".fare_price_list_header").show();
                $("#proceed_clear").show();
                 $(".onward").prop("disabled",false);
		$(".fare_loader").hide();
		}
		else{
		
			$(".lowest_pad").html('Lowest &#8377 '+combined_price);
                        $("#proceed_clear").hide();
                         $(".onward").prop("disabled",false);   
		    }

   }

});
}

function get_checked_international()
{
        var checked=$('.flight_leftwrap').closest('div#fjs_1').html();
     $(".onward").prop("disabled",true);
    $('.onward:first').attr('checked',true);
//var name = $('#myTable').find('tr:first').html();
//alert(name);
$(".onward_fly").html("");
$(".fare_pad1").html("");
$(".fare_loader").show();
$(".fare_price_list_header").hide();
var owner = $('input[name=onward]:checked').closest('td').siblings('td.select_fly_onward').html();
var r_owner = $('input[name=onward]:checked').closest('td').siblings('td.select_fly_return').html();
onward_price= $('input[name=onward]:checked').closest('td').siblings('td.select_price').text();
var onward_airline= $('input[name=onward]:checked').closest('td').siblings('td.select_airlines').text();
var onward_fcode=$('input[name=onward]:checked').closest('td').siblings('td.select_fcode').text();
var return_airline= $('input[name=onward]:checked').closest('td').siblings('td.return_airlines').text();
var return_fcode=$('input[name=onward]:checked').closest('td').siblings('td.return_fcode').text();
$(".onward_fly").append(owner);
$(".return_fly").append(r_owner);



var combined_price=parseInt(onward_price);
$.ajax({
    url : "price_search_round",
    type: "POST",
    data : {req:req,car_id:onward_airline,fcode:onward_fcode,_token:token},
    async:true,
    success: function(response)
    {
		$("#clear_select").val("");
		clear_sky=[];
                
		fare_search(response,onward_fcode,return_fcode);
		$(".fare_loader").hide();
		$(".fare_pad1").html('<img src="themes/hdfc/assets/images/goibibo.png" height="17px">  &#x20b9 '+combined_price);
		$("#proceed").show();
		$(".cleartrip_pad").hide();
                
		 if(response.trim()=='Flights not available.')
		{
		clear_total='';
		}
		
		
		if(clear_total != "")
		{
		$(".cleartrip_pad").html('<img src="themes/hdfc/assets/images/cleartrip-logo1.png" height="21px"> &#x20b9 '+clear_total);
		var fares = [combined_price,clear_total];
		var lowest=fares.sort(function(a, b){return a-b});
		$(".lowest_pad").html('Lowest &#x20b9 '+lowest[0]);
		$(".cleartrip_pad").show()
		$(".proceed_clear").show();
                $(".onward").prop("disabled",false);
		}
		else{
			$(".lowest_pad").html('Lowest &#x20b9 '+combined_price);
			$("#proceed_clear").hide();
                         $(".onward").prop("disabled",false);
		    }

		$(".fare_price_list_header").show();
		$("#proceed").show();
                $("#fare_button").show();
    }

});


}

function get_checked_go()
{
     var  combined_price=0;
    var onward_price=0;
    var return_price=0;
 $(".onward").prop("disabled",true);
    //$('input[name=return]').attr("disabled",true);
   
     $(".return").prop("disabled",true);
    //var checked=$('.flight_leftwrap').closest('div#fjs_1').html();
    
//var name = $('#myTable').find('tr:first').html();
//alert(name);
$(".onward_fly").html("");
$(".fare_pad1").html("");
$(".fare_loader").show();
$(".fare_price_list_header").hide();
var owner = $('input[name=onward]:checked').closest('td').siblings('td.select_fly').html();
$(".onward_fly").append(owner);
onward_price=  $('input[name=onward]:checked').closest('td').siblings('td.select_price').text();
var onward_airline= $('input[name=onward]:checked').closest('td').siblings('td.select_airlines').text();
var onward_fcode=$('input[name=onward]:checked').closest('td').siblings('td.select_fcode').text();
var sour=$('input[name=onward]:checked').closest('td').siblings('td.sour').text();
var desti=$('input[name=onward]:checked').closest('td').siblings('td.desti').text();



    

    
$(".return_fly").html("");
$(".fare_pad1").html("");
var owner = $('input[name=return]:checked').closest('td').siblings('td.select_fly').html();
$(".return_fly").append(owner);
return_price= $('input[name=return]:checked').closest('td').siblings('td.select_price').text();
var return_airline=$('input[name=return]:checked').closest('td').siblings('td.select_airlines').text();
var return_fcode=$('input[name=return]:checked').closest('td').siblings('td.select_fcode').text();
var arr_tym1=$('input[name=return]:checked').closest('td').siblings('td.arr_tym').text();;
var dst_tym1=$('input[name=return]:checked').closest('td').siblings('td.dst_tym').text();
var return_sour=$('input[name=return]:checked').closest('td').siblings('td.return_sour').text();
var return_desti=$('input[name=return]:checked').closest('td').siblings('td.return_desti').text();
var  combined_price=parseInt(onward_price)+parseInt(return_price);
//$(".fare_price_list_header").show();
//		$("#proceed").show();
//$(".fare_pad1").html('<img src="themes/hdfc/assets/images/goibibo.png" height="17px">  &#8377 '+combined_price);
//$('.fare_loader').hide();
//$(".fare_price_list_header").show();
//$("#proceed").show();
//return combined_price;
if(return_price=='')
{
    combined_price=parseInt(onward_price);
}
else if(onward_price=='')
{
    var combined_price=parseInt(return_price);
}
else
{
    
var combined_price=parseInt(onward_price)+parseInt(return_price);
}
//console.log(onward_price);console.log(return_price);console.log(combined_price);
 var checked=$('.flight_rgtwrap').closest('div#fjs_1').html();
get_checked_cleartrip_onward(combined_price);
}

function trimStr(str) {
  return str.replace(/^\s+|\s+$/g, '');
}


