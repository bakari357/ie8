<?php


//In this function using Format helper
class Locationmodel extends Eloquent {
  
  
  public static function get_country($id){

    $country_result = DB::table('countries')->where('id' , $id)->get();
    return $country_result;
   
   }
  
    public static function  get_zones_menu($country_id)
	{    $zones	=  DB::table('country_zones')->where('country_id' , $country_id)->where('status',1)->get();
		
		$return	= array();
		foreach($zones as $z)
		{
			$return[$z->id] = $z->name;
		}
		return $return;
	}
      
      
     public static  function get_countries_menu()
	{	$countries	= DB::table('countries') ->orderBy('sequence', 'ASC')->where('id' , 99)->where('status',1)->get();
		
		$return		= array();
		foreach($countries as $c)
		{
			$return[$c->id] = $c->name;
		}
		return $return;
	}
	
	
	   public static function get_zone($id)
	{      
	       $result = DB::table('country_zones')->where('id', $id)->get();
		
		return  $result;
	}
	
      

}
