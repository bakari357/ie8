<?php
class Cachehelper
{
	

	public static function store($key,$value,$expiresAt)
	{
		
		Cache::put($key,$value,$expiresAt);
	}



	public static function fetch($key)
	{
		$value = Cache::get($key);

		return $value;	
	}

	






}





