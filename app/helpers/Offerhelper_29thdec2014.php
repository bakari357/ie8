<?php 
   //Offer helper functions
class Offerhelper {

  
	public static function offer_calculate($partner_id,$amount)
	{
	    
		$get_offer = Commonmodel::getoffersby_partner($partner_id);
		if(isset($get_offer[0]->offer_type)  && $get_offer[0]->offer_type!=''){
		$offers =  json_decode($get_offer[0]->offer_type);

		if(isset($offers) && $offers->type =='2')
		{  $offer['offer_type'] = 'Flat';
		   $offer['discount_amount'] = $offers->flat_fee;
		  return $offer;
		}
		elseif(isset($offers) && $offers->type =='1')
		{
		
		   $offer['offer_type'] ='Percentage';
		
		   if($offers->min_fee > $amount)
		   { 
		    $offer['discount_amount'] = '';
		   }
		   else
		   {
		   $percentage_amount = $offers->percentage;
		   
		   $percent = round($amount * ($percentage_amount/100));
		   
		   if($percent > $offers->min_fee && $percent < $offers->max_fee)
		   {
		   $offer['discount_amount'] =  $percent;
		   }
		   else if($percent <= $offers->min_fee)
		   {
		   $offer['discount_amount'] = $offers->min_fee;
		   }
		   else if($percent >= $offers->max_fee)
		   {
		      $offer['discount_amount'] = $offers->max_fee;
		   }
                 
		    return $offer; 
		
		}
             
                
		}
		else{
		 $offer['offer_type'] = '';
		 $offer['discount_amount'] = '';
		 return $offer;
		}
		}
	
	}



	
}
