<?php

class hasher {

	// hashing mechanism


	public static function createSalt()
	{
		$saltLength=16;
		
		$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		return substr(str_shuffle(str_repeat($pool, 5)), 0, $saltLength);
	}




	public static function checkhash($string, $hashedString)
	{ 
		$saltLength=16;

		

		$salt = substr($hashedString, 0, $saltLength);

		return ($salt.hash('sha256', $salt.$string))===$hashedString;
                 
        }



	public static function hash($string)
	{
		// Create salt
		$salt = hasher::createSalt();

		return $salt.hash('sha256', $salt.$string);
	}











}
