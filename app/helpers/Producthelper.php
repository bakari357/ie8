<?php 

class Producthelper {

  
 public static function get_product_points($productId,$cash,$points)
 {
   $result = Productsmodel::getPoints($productId,$cash,$points);
   return $result;
   
  }
  
  
 public static function get_product_information($partner_id)
{
   
   $result=Productsmodel::partner_is_client_api($partner_id);  
   return $result;
   
}
  

}
