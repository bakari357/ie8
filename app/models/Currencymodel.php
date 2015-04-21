<?php

class Currencymodel extends Eloquent {
  
  
  public static function get_currency_amount($id=false,$symbol=false){
               
       $currency =  DB::table('currency_to_rupees')->Join('currencies', 'currencies.id', '=', 'currency_to_rupees.currency_id')     
            ->select('currencies.name', 'currencies.symbol','currencies.currency_decimal','currencies.currency_thousands_separator',
            'currencies.currency_symbol_side','currency_to_rupees.id','currency_to_rupees.value');
            
              if($id)
             $currency->where('currency_to_rupees.id',$id);
              if($symbol<>'')
             $currency->where('currencies.symbol',$symbol);
	   return (array)$result = $currency->get();         
               
   
   }
  
  
   
   
   
	
	


}
