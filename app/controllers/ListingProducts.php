<?php use Jenssegers\Mongodb\Connection;

class ListingProducts extends BaseController {


    public function list_products()
    {   
        $connection = DB::connection('mongodb');
        $order ='';        
        $data['products'] =$connection->getCollection('Products')->find();
        //echo '<pre>'; print_r($data['products']); exit;
        if(Input::get()){
        $order = Input::get('sorted_by');
       
          $sort =  ($order == 1) ?  array('product_name' => 1) : (($order == 2) ? array('product_name' => -1)  : (($order == 3) ? array ("mrp"=>1) : (($order == 4 ) ? array("mrp"=>-1) : array('product_name', 1))));
          
          $data['products'] = $data['products']->sort($sort);
       
        }
       
          $data['selected'] = $order;          
          $data['bread_crumb']=array('Home'=>'/');
       
          	
	  return $this->render_reward_theme_hotels('list_products',$data);
   
  }
  
    public function listing_products()
    {
    
      $connection = DB::connection('mongodb');
      $products =$connection->getCollection('Products')->find();
      
      $i=1;
     foreach($products as $product=>$row)
     {
    $product_construct['product_'.$i]=array('product_id'=>$row['product_id'],'product_name'=>$row['product_name'],'product_type'=>$row['product_type'],'product_code'=>$row['product_code'],'short_desc'=>$row['short_desc'],'product_brand_id'=>$row['product_brand_id'],'product_category_id'=>$row['product_category_id'],'product_category'=>$row['product_category'],'product_images'=>$row['product_images'],'mrp'=>$row['mrp'],'tax_percent'=>$row['tax_percent'],'quantity'=>$row['quantity']);
        $i=$i+1;
     }
     
      $products_xml= Xml2array::array_to_xml($product_construct, $rootNodeName = 'data', $xml=null);
       echo $products_xml;
     }
  
  //product details function
    public function product_details($id){
        $url = "product_details/$id";
        Session::put('request_url',$url);
        $customer_id ='';
        $customer = Session::get('customer_data');  
         if(isset($customer )){
         $customer_id =  $customer->id;
          }
         if($customer_id == '' ){
         return Redirect::to('securelogin');
          }
      $connection = DB::connection('mongodb');
      $find = array('product_id'=>$id);
      $product_details =$connection->getCollection('Products')->find($find);
      $data['product_details']=$product_details;
      $data['bread_crumb']=array('Home'=>'/');	
      $data['js_array'] = array('js/jquery.fancybox-1.3.1.pack.js');
      $data['css_array'] = array('css/listgrid.css','css/font-awesome.min.css','css/jquery.fancybox-1.3.1.css');
     return $this->render_reward_theme_hotels_details('product_details',$data);
    
   }
   
   
   //ajax addwishlist function 
   public function addwishlist($id){
   
     $connection = DB::connection('mongodb');
      $cusomer_id = Session::get('customer_id');
     
     $product_id = $id;
  
        $add_whishlist = array();
        $add_whishlist['product_id'] = $product_id;
        $add_whishlist['customer_id'] =  $cusomer_id;
        $add_whishlist['user_id'] =  $cusomer_id;
        $add_whishlist['status'] = 1;
       
        $add_whishlist['created_on'] = date ( 'Y-m-d H:i:s' );
        $check_addwishlist =Productsmodel::dupilicate_addwishlist($add_whishlist); 
        if( $check_addwishlist == 1) {
        $save_addwishlist =Productsmodel::add_whishlist($add_whishlist); 
       
     if($save_addwishlist){
     $find = array('product_id'=>$product_id );
     $product_details =$connection->getCollection('Products')->find($find);
      foreach ($product_details as $product){
	  $image = explode('|',$product['product_images']);
	  $product_name = $product['product_name'];
      }
     $out ='';
     if($product_id ){
      $out .="<img src= $image[0] height='100px' width='100px'/>";
      $out .="<span style='color:green' >". $product_name." is added on Wish list  </span>";
     
    
     }
     }
    }if( $check_addwishlist == 2) {
   $out ='';
      $out .="<span style='color:red' >Sorry this product is already added on your Wish list </span>";
      
    }
    echo $out; 
   }
    
    }
