
$(document).ready(function() {
$("#complete_booking").hide();
});


function update_cleartripprice(xml)
{
    //$("#update_price").hide();
    var xml_data=xml;
    
    
    
    
    $('#priceloader').html('<img src="themes/hdfc/assets/images/ajax-loader.gif" >');        
            $.ajax({ url: "createitinerary",
                
            data: { xmlrequest:xml_data},
            type: "POST",
            success: function(data){ 
               
            $(data).find('pricing-summary').each(function(){
            var price = $(this).find('total-fare').text();

            $('#price_final').val(price);
            $('span #price').text(price);
            $('#priceloader').html('');
       // doing something with your longitude variable
     });
 
            }
            });
}