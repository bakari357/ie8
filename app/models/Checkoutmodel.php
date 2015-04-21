<?php use Jenssegers\Mongodb\Connection;

class Checkoutmodel extends Eloquent {
  
  
   
  
  //customer products adding wishlist function
  public static function do_checkout($data){
  
	

	$data['exdid']=DB::table('extended_products')->insertGetId(array('input'=>$data['input']));
	$connection = DB::connection('mongodb');
	$ext_entry=$connection->getCollection('extended_products')->insert($data);

	return $data['exdid'];
	
   }
  
  
  public static function checkout_referal($data){
  
  	
  	$referal = json_encode($data); 
  	
  	$id=DB::table('checkout_referal')->insertGetId(array('referal'=>$referal));
  
  	$referal_key = date('U').$id;
  	
		DB::table('checkout_referal')
            ->where('id', $id)
            ->update(array('referal_key' => $referal_key));
            
            return $referal_key; 
  }
  
  public static function get_referalvalue($key){
  
  	  return DB::table('checkout_referal')
            ->where('referal_key', $key)
            ->first();
           
  }
  
  
  }
