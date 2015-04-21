<?php use Jenssegers\Mongodb\Connection;

class Productsmodel extends Eloquent {
  
  
  var $group_discount_formula = false;

	
  
  
  //customer products adding wishlist function
  public static function add_whishlist($add_wishlist){
   
   
    $id = DB::table('wishlist')->insertGetId(
    array('product_id' => $add_wishlist['product_id'], 'user_id' => $add_wishlist['customer_id'],
                                          'status'=> $add_wishlist['status'],'date'=> $add_wishlist['created_on']));
    
    return $id;
   
   }
  
  //Checking duplicate products entry function
  public static function dupilicate_addwishlist($add_wishlist){
  $result = DB::table('wishlist')->where('product_id' , $add_wishlist['product_id'])->where('user_id', $add_wishlist['customer_id'])->get();
 
  if(count($result) == 0){
  return 1;
  }else{
  return 2;
  } 
  }

 public static function checkuser($id){
 
 $result = DB::table('customers')->where('id' , $id)->get();
  return $result;
 }

     //calling from helper started by udayakumar
     //getting customer points function
     public static function getPoints($productId,$cash = 0,$points = 0)
     {
     $query =  DB::table('product_pointscash')->select('points','cash','id');
     if($cash == 1 and $points == 0)
		{
		   $query->where('points', 0);
		}
		if($cash == 0 and $points == 1)
		{
		    $query->where('cash', 0);
		}
		if($cash == 1 and $points == 1)
		{
		     $query->where('cash', '<>', 0);
		    $query->where('points', '<>', 0);
		}
		$pointscash = $query->get();
             
              return $pointscash = $query->get();
	
		
	}
	
	
       //Removing the added wishlist function
        public static function remove_wishlist($id)
	{  
	   return DB::table('wishlist')->where('id', $id)->delete();
	   
	}
    
       
       
    
    
     public static function group_discount_formula()
	{
		// check for possible group discount
		$customer_details = Session::get('customer_data');
		
		foreach($customer_details as $customer_info){
		$customer = $customer_info;
		}
		if(isset($customer->group_discount_formula))
		{
			$this->group_discount_formula = $customer->group_discount_formula;
		}
	}
    
    
       public static function get_product_categories($id)
	{
	        $connection = DB::connection('mongodb');
	        $exist=array('product_id'=>$id);
		$categ=$connection->getCollection('Category_Products')->find($exist);
		foreach($categ as $category)
		{
		$categories[] =$category['category_id'];
	        }     
               
		return $categories;
	}
	 
    
    
      public static function get_payment_details($id, $related=true)
	{     
	
		
		$result	= DB::table('product_pointscash')->where('f_product_id',$id)->get();
		   $payment_details = array(''=>'Select');
		  foreach($result as $key => $value){
			if($value['points'] !=0 AND $value['cash'] == 0.00) {
				$payment_details[$value['id']] = "Points";
			}else if($value['points'] !=0 AND $value['cash'] != 0.00) {
				$payment_details[$value['id']] = "Points + Cash";
			}else if($value['points'] ==0 AND $value['cash'] != 0.00) {
				$payment_details[$value['id']] = "Cash";
			}
		   }
// 		print_r($payment_details);
		return $payment_details;
	}
    
    
         public static function get_cart_ready_product($id, $quantity=false)
	{
	        $connection = DB::connection('mongodb');
	        $save['quantity']=$quantity;
	        $criteria = array('product_id' =>$id);
                $connection->getCollection('Products')->update($criteria, array('$set' =>$save));
	        $exist=array('product_id'=>$id,'quantity'=>$quantity);
	        $products=$connection->getCollection('Products')->find($exist);
	        foreach($products as $prod)
	        {
	        $product=$prod;
	         }             
                 
		//unset some of the additional fields we don't need to keep
		if(!$product)
		{
			return false;
		}

		$product['base_price']	= $product['mrp'];

		if (isset($product['saleprice']) && $product['saleprice'] != 0.00)
		{    
			$product['price']	= $product['saleprice'];
		}


		// Some products have n/a quantity, such as downloadables
		//overwrite quantity of the product with quantity requested
		if (!$quantity || $quantity <= 0 || $product['quantity']==1)
		{
			$product['quantity'] = 1;
		}
		else
		{
			$product['quantity'] = $quantity;
		}


		// attach list of associated downloadables
		$product['file_list']	= Digitalproductsmodel::get_associations_by_product($id);

		return $product;
	}
    
    
    
      public static function get_catgory_id($sudomainname,$c_id)
        {
            
	     $sudomainname=str_replace(' ','',strtolower($sudomainname));
	    $result =  DB::table('admin')->select('client_offer.offer')->Join('userdetails', 'userdetails.f_userid', '=', 'admin.id')
	                              ->join('client_offer', 'client_offer.client_id', '=', 'admin.id')
	                              ->where('client_offer.category_id',$c_id)->where('client_offer.status',1)
	                              ->where('userdetails.client_name','LIKE',$sudomainname)->first();
	                             
	     return $result;
        }

     public static function get_payment_mode_details($id)
	{
	        $result	= DB::table('product_pointscash')->where('id',$id)->get();
		return $result;
	}
	
        public static function get_category_by_product($id)
        {
               $connection=DB::connection('mongodb');
               $exist=array('product_id'=>$id);
	       $cats=$connection->getCollection('Category_Products')->find($exist);
	     
	        return  $cats;
        }
        public static function get_product_partner($id)
   	{
   	 $result= DB::table('products')->where('id',$id)->get();
   	 return $result;
            
	}
	
	//getting product slug 
        public static function get_slug($id)
	{
		return DB::table('products')->select('slug')->where('id',$id)->first();
		 
	}

	public static function get_cat_by_product($id)
        {
          $result= DB::table('category_products')->where('product_id',$id)->get();
   	 return $result;
         }
    
}
