<?php use Jenssegers\Mongodb\Connection;
      
class PhysicalController extends BaseController {

              public function Physical_Products($id=false)
	      {
	       $connection = DB::connection('mongodb');
	 		$c = curl_init();
                        $url = 'http://erp.reward360.co/index.php/ri_api/get_master_products/RI73180901/2012-01-01/0/99'; 	
			curl_setopt($c, CURLOPT_URL, $url);
			curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);
			$page = curl_exec ($c);
			if(curl_errno($c))
			{
			$page['error']= curl_error($c);
			}
			curl_close ($c);
			$toarr= Xml2array::xml2array_test($page);
			//echo '<pre>'; print_r($toarr); exit;
			/*foreach($toarr['product_list']['product'] as $produc){
			if(isset($produc['group'])){
			echo '<pre>'; print_r($produc['group']);
			}}
			exit;*/
			foreach($toarr['product_list']['product'] as $produc)
			{
                        $product_id=$produc['product_id'];
		
		 //get values for category relation
		
		 $data1=array(
		              'product_id'=>$product_id,
		              'category_id'=>$produc['product_category_id']
		             );
                        $exist=array('product_id'=>$product_id,'product_category_id'=>$produc['product_category_id']);
                        $condt=$connection->getCollection('Products')->find($exist);
                        $cond_cate=$connection->getCollection('Category_Products')->find($exist);
                        $cnt=$cond_cate->count();
                        $count= $condt->count();
                        if($count==0) 
                        {
                        $products = array();
                        $products['product_id'] = $produc['product_id']; 
			$products['product_type'] = $produc['product_type']; 
			$products['product_name'] = $produc['product_name']; 
			$products['product_code'] = $produc['product_code'];
			if(isset($produc['group'])){
			$products['group'] = $produc['group']; 
			}
			$products['short_desc'] = $produc['short_desc']; 
			$products['product_brand_id'] = $produc['product_brand_id']; 
			$products['product_category_id'] = $produc['product_category_id']; 
			$products['product_category'] = $produc['product_category']; 
			$products['product_images'] =$produc['product_images']; 
			$products['mrp'] = intval(trim($produc['mrp'])); 
			$products['tax_percent'] = $produc['tax_percent']; 
			$products['quantity'] = intval(trim('')); 
			
			
                       $connection->getCollection('Products')->insert($products);
                        }
                        if($cnt==0) 
                        {
                        
                        $connection->getCollection('Category_Products')->insert($data1);
                        //$connection->getCollection('Products')->insert($save);
                        }
                        }
              }
               public function Physical_Categories($id=false)
               {
                        $connection = DB::connection('mongodb');
                        $c = curl_init();
                        $url = 'http://erp.reward360.co/index.php/ri_api/get_master_categories/RI73180901/0/1000'; 	
			curl_setopt($c, CURLOPT_URL, $url);
			curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);
			$page = curl_exec ($c);
			if(curl_errno($c))
			{
			$page['error']= curl_error($c);
			}
			curl_close ($c);
		        $toarr= Xml2array::xml2array_test($page);
			foreach($toarr['brand_list']['brand'] as $mong)
			{
                        $cat_id=$mong['cat_id'];
                        $exist=array('cat_id'=>$cat_id);
                        $condt=$connection->getCollection('categories')->find($exist);
                        $count= $condt->count();
                        if($count==0) 
                        {
                        $save=(array)$mong;
                        $connection->getCollection('categories')->insert($save);
                        }
                        }
             
                 }
               
	       public function Physical_Brands($id=false)
	       {
	                $connection = DB::connection('mongodb');
			$c = curl_init();
                        $url = 'http://erp.reward360.co/index.php/ri_api/get_master_brands/RI73180901'; 	
			curl_setopt($c, CURLOPT_URL, $url);
			curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);
			$page = curl_exec ($c);
			if(curl_errno($c))
			{
			$page['error']= curl_error($c);
			}
			curl_close ($c);
			$toarr= Xml2array::xml2array_test($page);
			foreach($toarr['brand_list']['brand'] as $brand)
			{
                        $brand_id=$brand['brand_id'];
                        $exist=array('brand_id'=>$brand_id);
                        $brands=$connection->getCollection('Brands')->find($exist);
                        $count=$brands->count();
                        if($count==0) 
                        {
                        $save=(array)$brand;
                        $connection->getCollection('Brands')->insert($save);
                        }
                        }
               }
              
   }
  
  
  
