<?php  use Jenssegers\Mongodb\Connection;
class CartController extends BaseController {

    //showing added wishlist
    public function view_wishlist()
       {   
           $redirect	= Session::get('customer_data');
	 if($redirect){
           $data['page_title'] = "Your Wishlist";
           $data['seo_title']	= "Your Wishlist";
	  $customer_id = Session::get('customer_id');
		if(isset($customer_id)){
		$user_id=$customer_id;
		} else {
		$user_id=0;
		}
		
           $data['products'] = Productsmodel::get_wishlist_products(8);
           //echo '<pre>'; print_r($data['products']); exit;
               $menus=array('one','two');    		
		$data['bread_crumb']=array('Home'=>'/');
		$data['test'] ='testest';
      		$data['css_array'] = array('css/jquery-ui.css','css/style1.css','css/stream.css','css/tabcontent.css','css/jquery-ui-1.10.3.custom.css','css/bootstrap.css');
      		$data['js_array'] = array('js/jquery.select_skin.js','js/jquery-ui-1.10.3.custom.js','js/jquery.validate.js','js/bootstrap.min.js','js/squard.js','js/equal_heights.js','js/jquery.hint.js');
        	$this->load_reward_region('auth','data',''); 
       		return $this->render_reward_theme('cart_wishlist.wishlist',$data);
       	   }else{
       	     return Redirect::to('securelogin');
       	    }
       }
	
	
	
 	//$id,$cid=false,$pid=false,$categ=false
	public function  product($product_slug)
	{  
	     $product_details =  DB::table('routes')->select('route')->where('slug',$product_slug)->first();
	     $pduct = json_decode(json_encode((array)$product_details),true);
	     $product_id = explode('/',$pduct['route']);	 
	     $productdetail =Productsmodel::get_product($product_id[2]);
	     //echo '<pre>'; print_R( $productdetail); exit;
	       $data['product'] = $productdetail;
		//for listing pay/cash details of the product
		$data['payment_details'] = Productsmodel::get_payment_details($product_id[2]);
		//echo '<pre>'; print_R($data['payment_details']); exit;
		if(!$data['product'] || $data['product']->enabled==0)
		{
			return Redirect::to('/');
			
		}
		Loginmodel::is_logged_in($data['product']->slug);
		
		// load the digital language stuff
		
		$data['options']	= Optionmodel::get_product_options($data['product']->id);
		$related			= $data['product']->related_products;
		$data['related']	= array();
		$data['posted_options']	= Session::get('option_values');
		$data['page_title']			= $data['product']->name;
		$data['meta']				= $data['product']->meta;
		$data['seo_title']			= $data['product']->seo_title;
		if($data['product']->images == 'false')
		{
			$data['product']->images = array();
		} else	{

			$data['product']->images	= (array)json_decode($data['product']->images);

		}
		//$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		$data['id']=$product_id[2];
	        $menus=array('one','two');    		
      		$bread_crumb=array('Home'=>'/');
      		$css_array = array('css/style_reward.css','css/jquery-ui-1.10.3.custom.css','css/bootstrap.css','css/reset-min.css');
      		$js_array = array('js/jquery.select_skin.js','js/jquery-ui-1.10.3.custom.js','js/jquery.validate.js','js/bootstrap.min.js','js/squard.js','js/equal_heights.js','js/jquery.hint.js');
	        $this->load_reward_theme('HDFC Superia-Credit Card','cart_wishlist.product','auth',$bread_crumb,'','',$css_array,$js_array); 
        	$this->load_reward_region('auth','data',''); 
       		return $this->render_reward_theme('cart_wishlist.product','auth',$data);
	  
	}
	
	
	        public function add_to_cart(){
	
	        $product_details = Session::get('Product_Details');
	        $product_det['quantity']=$_POST['quantity'];
	        $product_det['custompoint']=$product_details['mrp'];
	        $product_det['customcash']=0;
	        $point= $product_det['custompoint']/$product_det['quantity'];
		$cash=$product_det['customcash']/$product_det['quantity'];
		$product_id		= $product_details['product_id'];
		$quantity 		= (int)$product_det['quantity'];
		$custom_cash		= $cash;
		$custom_point		= $point;
                $update_block=Currency::block_points($custom_point);
                $product = Productsmodel::get_cart_ready_product($product_id, $quantity);
		$categories=Productsmodel::get_product_categories($product_id);
		$get_offer = '';
	        $payment_option 	= 1;
                $product_detail = Productsmodel::get_payment_mode_details($payment_option);
                if(isset($product['mrp']))
                {
		$sales_price= $product['mrp'];
		}
		$catgories=Productsmodel::get_category_by_product($product_id);
		 
		foreach($catgories as $category)
		{
		$cats = $category;
		}
		 if(isset($product_detail) &&  !empty($product_detail))
		 {
		 $point_to_cash=Currency::point_to_case($sales_price,$product_detail[0]->points);
		
		 }
		 
                 $images=(array)$product['product_images'];
                 $photo	=  Theme::asset()->url('img/no_picture.png','No Image Available');
                if(array_key_exists('custom',$images))
                {
                $image_path=Rewards::custom_url();
                
                $img=1;
                }
                else{$image_path=Rewards::rewards_url();}

                $images	= array_values($images);
                if(!empty($images[0])) 
                {
                $primary	= $images[0];
                foreach($images as $photo)
                {
                if(isset($photo->primary))
                {
                $primary	= $photo;
                }
                }
                if(isset($img)&&$img==1)
                {
                $filepath=$image_path.''.$primary->filename;
                $image_name=Rewards::getExtension($filepath);
                $thumb= str_replace('original','thumb',str_replace('.'.$image_name,'_thumb.'.$image_name, $filepath));
                $photo	= '<img class="responsiveImage" width="200" height="200" src="'.$thumb.'" alt="'.$product['seo_title'].'"/>';
                }else{
                $photo	= '<img class="responsiveImage" width="200" height="200"  src="'.$image_path.''.$primary['filename'].'"/>';
                }
                }
                $description='<table  class="in-table bordernone" style="border:0 none !important;"><tr><td>'.$photo.'
                </td><td><table class="in-table bordernone" >
                <tr><td><b>'.$product['product_name'].'</b></td></tr>';
                $description .='<tr><td><b>'.$product['product_name'].' </b></td></tr>';
                $description .='</table></td></tr></table>';
		if(isset($point_to_cash))
                $point_to_cash=$point_to_cash;
		$customer_fields=Currency::get_cutomer();
		$product['points'] =Currency::cash_ratio($point);
		$product['cash']   = 0;
		if(isset($customer_fields['customer_cash']) && !empty($customer_fields['customer_cash']))
		{
		$product['customer_points']  = $customer_fields['customer_points'];
		}
		if(isset($customer_fields['customer_cash']) && !empty($customer_fields['customer_cash']))
		{
		$product['customer_type_amount'] = $customer_fields['customer_cash'];
		}
		$product['coupon_product']   =  $product['product_id'];
		$product['client_offer']  = $get_offer;
			$product['custom_cash'] = ($cash);
			$product['custom_point'] =($point);
			$product['original_cash'] =Currency::cash_ratio($custom_cash);
			$product['original_point'] =Currency::cash_ratio($custom_point);
			$product['item'] = $description;
			$product['original_amount'] = $product_details['mrp'];
			$product['coupon_category']   =  $cats['category_id'];
			$product['product_type']   =  'Physical';
			$product['fixed_quantity'] = 1;
			$product['id'] =$product_id;
			$product['name']=$product_details['product_name'];
			$product['price']=$product_details['mrp'];
                        $items		= Cart::content();
		        $qty_count	= $quantity;
			$product['payment_mode']	= $payment_option;
			$product['is_gc']		= false;
                        if($quantity>0){
			Cart::add($product);
			$items		= Cart::content();
			return Redirect::to('view_cart');
			}
			else
			{
			Session::flash('error','Quantity should be greater than 0');
			return Redirect::to(Productsmodel::get_slug($product_id));
			}
}
               public function view_cart(){
	        $data['page_title']	= 'View Cart';
		//$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		$menus=array('one','two');    		
		$bread_crumb=array('Home'=>'/');
		$data['test'] ='testest';
                $data['bread_crumb']=array('Home'=>'/');
               
       		return $this->render_reward_theme('product_cart',$data);
       	 }
     
	      public  function  checkout()
	      {
	     
	       return Redirect::to('DigitalCheckout');
              }
	
	function update_cart($redirect = false)
	{
                 
	   
	        $tpoints=$_POST['custompoint'] +0;
	         Cart::dealTotal(0);
	
	        if($tpoints==0)
	        {
	        Session::flash('error','Points is empty.');
	        return Redirect::to('view_cart');
	        }
		if(!$redirect)
		{
			$redirect = $_POST['redirect'];
		}

		// see if we have an update for the cart
		$item_keys		= $_POST['cartkey'];
		
		$coupon_code	= isset($_POST['coupon_code']) ? $_POST['coupon_code'] : '' ;
		$gc_code	= isset($_POST['gc_code']) ? $_POST['gc_code'] : '';


		//get the items in the cart and test their quantities
		$items			= Cart::content();
		
		
		$new_key_list	= array();
		//first find out if we're deleting any products
		
		foreach($item_keys as $key=>$quantity)
		{ 
			if(intval($quantity) === 0)
			{   
				//this item is being removed we can remove it before processing quantities.
				//this will ensure that any items out of order will not throw errors based on the incorrect values of another item in the cart
				Cart::update($key ,$quantity);
			}
			else
			{
				//create a new list of relevant items
				$new_key_list[$key]	= $quantity;
			}
		}
		$response	= array();
		foreach($new_key_list as $key=>$quantity)
		{
			$product	= Cart::get($key);
			//if out of stock purchase is disabled, check to make sure there is inventory to support the cart.
			if(!Config::get('laravel_cart.allow_os_purchase') && (bool)$product['track_stock'])
			{  
				$stock	= Productsmodel::get_product($product['id']);

				//loop through the new quantities and tabluate any products with the same product id
				$qty_count	= $quantity;
				foreach($new_key_list as $item_key=>$item_quantity)
				{ 
					if($key != $item_key)
					{
						$item	= Cart::get($item_key);
						
						//look for other instances of the same product (this can occur if they have different options) and tabulate the total quantity
						if($item['id'] == $stock->id)
						{
							$qty_count = $qty_count + $item_quantity;
						}
					}
				}
				if($stock->quantity < $qty_count)
				{
					if(isset($response['error']))
					{
						$response['error'] .= '<p>'.sprintf('Not Enough Stock', $stock->name, $stock->quantity).'<p>';
					}
					else
					{
						$response['error'] = '<p>'.sprintf('Not Enough Stock', $stock->name, $stock->quantity).'</p>';
					}
				}
				else
				{
					//this one works, we can update it!
					//don't update the coupons yet
					Cart::update($key ,$quantity);
				}
			}
			else
			{  foreach($item_keys as $key=>$quantity)
	                   {
	                   //echo "key=>".$key."qty=>".$quantity."<br/>";
			    Cart::update($key,$quantity);
			   
			   }
				
			}
		}
		
		//update points
		$update=$_POST;
		
		if($_POST['deal_points']<>$_POST['custompoint']){
		foreach($items as $key=>$product)
		{
			
				//this item is being removed we can remove it before processing quantities.
				//this will ensure that any items out of order will not throw errors based on the incorrect values of another item in the cart
				Cart::update($key,$update);
		}
		
		}

		//if we don't have a quantity error, run the update
		if(!isset($response['error']))
		{
			//update the coupons and gift card code
			
			//This is pending update=======================>
			//$response = Cart::update(false, $coupon_code, $gc_code);
			
		}
		else
		{
			$response['error'] = '<p>'.'Error in Updating Cart'.'</p>'.$response['error'];
		}
		//check for errors again, there could have been a new error from the update cart function
		if(isset($response['error']))
		{
			Session::flash('error',$response['error']);
		}
		if(isset($response['message']))
		{
			Session::flash('message',$response['message']);
		}

		if($redirect)
		{
			
			return Redirect::to($redirect);
		}
		else
		{
			return Redirect::to('view_cart');
		}
	}
	

	public function remove_item($key)
	{
		//drop quantity to 0
		Cart::remove($key);
		return Redirect::to('view_cart');
	}

	
	
	 //removing from wishlist
	public  function remove_wishlist($id)
       {  
           Productsmodel::remove_wishlist($id);
           return Redirect::to('wishlist');
           
       }

	public function cart_expired()
	{
	
	   $data['bread_crumb']=array('Home'=>'/');
	   return $this->render_reward_theme('checkout.expired',$data);

	}
	
	
	
  }
	

