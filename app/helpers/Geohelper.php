<?php 
   //Rewards helper functions
class Geohelper {

   public static function get_cityname()
   {

		$ip=$_SERVER['REMOTE_ADDR'];

	       
	
		if(substr($ip,0,9)=='192.168.1')
		{

			$regions['city']='Bangalore';
			$regions['state']='Karnataka';
		}else
		{
			$region = geoip_record_by_name($ip);
			
			if (!empty($region['region'])) 
			{
			$region_data=geoip_region_name_by_code($region['country_code'],$region['region']);
			$regions['state']=$region_data;
			$regions['city']=$region['city'];
			
			} 
			else
			{
			$regions['state']='';
			$regions['city']='';

			}

		}
    		return $regions;
   
   }
	
      
		
}
