<?php

class Digitalproductsmodel extends Eloquent {
  
  
      public static function get_associations_by_product($product_id)
	{
		return DB::table('products_files')->where('product_id', $product_id)->get();
	}
	
    
}
