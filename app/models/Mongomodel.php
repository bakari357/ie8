<?php
use Jenssegers\Mongodb\Model as Eloquent;

class Mongomodel extends Eloquent {
  
      
   
       public static function get_order($id)
	{       $connection = DB::connection('mongodb');
	        $author = array();
	        $author =$connection->getCollection('order_items')->find(array('order_id' =>(int)$id));
	        return $author;
	}
   
   
   
   
   
   
 }
   
