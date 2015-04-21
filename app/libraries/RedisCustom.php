<?php
 class RedisCustom{

    /**
     * Show the profile for the given user.
     */
    public static function Redis_writer($hashname,$key,$value)
    { 
	$date = new DateTime();
	$redis = RedisL4::connection();
	$redis->HDEL($hashname,$key);
	$redis->hmset($hashname,$key,$value);
	$redis->hmset($hashname,'timestamp',$date->format('Y-m-d'));
	$data=$redis->HGET($hashname,$key);
	
	
    }

    public static function Redis_reader($hashname,$index='')
    { 
	$date = new DateTime();
	$redis = RedisL4::connection();
	if(empty($index))
	$data=$redis->HGETALL($hashname);	
	else
	$data=$redis->HGET($hashname,$index);
	return $data; 
    }
    
}
