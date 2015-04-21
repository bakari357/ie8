<?php
 class Loghelper{


public static function logwriter($file,$data=array())
{
		$ip=$_SERVER['REMOTE_ADDR'];
		array_push($data,$ip);
		$logFile = $file.'.log';
		Log::useDailyFiles(storage_path().'/logs/'.$logFile);
		$offer_info=implode('|',$data);
		Log::info($offer_info);

}





}

