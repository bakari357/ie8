<?php
/*-------Currency helper-----*/

 class Currency  {

//cash ratio function
   public static function cash_ratio($cash,$customervalue=array())
{

	$cust = Session::get('customer_data');
	
	foreach($cust as $customer){
	if(isset($customer->param1) && isset($customer->param2))
	{
	  $param1 =  $customer->param1;
	  $param2 =  $customer->param2;
	}
	}
	
	if(!empty($cust))
	{
	  if(isset($param1) && isset($param2))
	  $get_customer_type=Customerpointsmodel::get_cutomer_type($param1,$param2);
	  else
	  return $cash;

	  if(!empty( $get_customer_type)) {
	foreach($get_customer_type as $value)
	{
		 $customer_cash=Customermodel::get_points_cash('',$value->customer_type);
	}
	  if(isset($customer_cash->cash))
	  return $customer_point_amount=$cash*$customer_cash->cash;
	  else
	  return $customer_point_amount=$cash;
	  }
	  else
	   $cash;
	}
	else if(!empty($customervalue))
	{
	  if(isset($customervalue['param1']) && isset($customervalue['param2']))
	  $get_customer_type=$CI->Customerpoint_model->get_cutomer_type($customervalue['param1'],$customervalue['param2']);
	  else
	  return $cash;

	  if(!empty( $get_customer_type)) {
	foreach($get_customer_type as $value)
	{
		 $customer_cash=$CI->customer_model->get_points_cash('',$value->customer_type);
	}

	  if(isset($customer_cash->cash))
	  return $customer_point_amount=$cash*$customer_cash->cash;
	  else
	  return $customer_point_amount=$cash;
	  }
	  else
	   $cash;
	}
	else
	return $cash;
    }

     //getting currency value function
     public static function get_currency_value($value,$points=0,$id=false)
     {
      
	if($id<>''){
	$row= Currency::get_currency_amount($id);
	}
	else{
	$row=Currency::get_currency_amount();
	}
	// echo $row[0]->value; 
	$amount=$value/$row[0]->value;
	 // print_r($row); 
	return Currency::format_currency($amount,$row[0]->symbol,$row[0]->currency_decimal,$row[0]->currency_thousands_separator,
	 $row[0]->currency_symbol_side,$points);
    }
  
  
     public static function format_currency($value,$symbol='',$currency_decimal='',$currency_thousands_separator='',   
           $currency_symbol_side='',$points=0)
     {
	if(!is_numeric($value))
	{
		return;
	}
	
	if($value < 0 )
	{
		$neg = '- ';
	} else {
		$neg = '';
	}

	if($points==1)
	{
	$formatted	= number_format(round(abs($value)), 0, $currency_decimal,'');
	return $formatted;

	}

	if($symbol)
	{
		$formatted	= number_format(round(abs($value)), 2, $currency_decimal,$currency_thousands_separator);
		if($currency_symbol_side == 'left')
		{
			$formatted	= $neg.$symbol." ".$formatted;
		}
		else
		{
			$formatted	= $neg.$formatted." ".$symbol;
		}
	}
	else
	{
		//traditional number formatting
		$formatted	= number_format(round(abs($value)), 2, '.', ',');
	}
	return $formatted;
    }
  
  
       public static function get_currency_amount($id=false)
       {
        if($id<>''){
         if(isset($adminsession)){
          $currency_id=$adminsession['currency']; 
         }}else{
        //$currency_id=$CI->session->userdata('currency_id');
        $currency_id = 4;
        }
        return Currencymodel::get_currency_amount($currency_id);
        }
  
          
  //point to case function
    public static function point_to_case($price)
    {
	
	$customer_info = Session::get('customer_data');
	foreach($customer_info as $customers){
	$customer = $customers;
	}
	if(!empty($customer_info))
	{
	  if(isset($customer->param1) && isset($customer->param2))
	  $get_customer_type=Customerpointsmodel::get_cutomer_type($customer->param1,$customer->param2);
	  else
	  return $price;

	  if(!empty( $get_customer_type)) {
	    
	  foreach($get_customer_type as $value)
	  {     
		 $customer_cash=Customermodel::get_points_cash('',$value->customer_type);
	  }
	  if(isset($customer_cash->cash))
	  return $customer_point_amount=$price/$customer_cash->cash;
	  else
	  return $customer_point_amount=$price;
	  }
	  else
	   $price;
	}
	else
	return $price;
}
  
  public static function get_cutomer()
{
        $customer = Session::get('customer_data');
       
       $cust_info = $customer;
       
	if(!empty($customer))
	{  
	if(isset($cust_info->param1) && isset($cust_info->param2)){
	
	  $get_customer_type=Customerpointsmodel::get_cutomer_type($cust_info->param1,$cust_info->param2);
	    
	  }
	  else{
	  return 1;
	  }
	  if(!empty($get_customer_type)) {

	foreach($get_customer_type as $value)
	{
		 $customer_cash=Customermodel::get_points_cash('',$value->customer_type);
		$balance_point[]=$value->balance;
	}
	  $customer_fields['customer_points']=array_sum($balance_point);	/*$get_customer_type->points;*/
	  if(isset($customer_cash->cash))
	  $customer_fields['customer_cash']=	$customer_cash->cash;
	  else
	   $customer_fields['customer_cash']=	'';
	  return $customer_fields;
	  }
	  else
	  return 1;
	}
	else
	return 1;
     }
  
 
 
   public static function cash_ratio_gift($cash,$customervalue=array())
    {
	
	$customer = $customervalue;
	
	if(!empty($customer))
	{
	  if(isset($customer['param1']) && isset($customer['param2'])){
	  $get_customer_type=Customerpointsmodel::get_cutomer_type($customer['param1'],$customer['param2']);
	 
	  }
	
	  else{
	  return $cash;
	  }
	  if(!empty( $get_customer_type)) {
	
	foreach($get_customer_type as $value)
	{       
		 $customer_cash=Customermodel::get_points_cash('',$value->customer_type);
		  
	}
	
	  if(isset($customer_cash->cash))
	  return $customer_point_amount=$cash*$customer_cash->cash;
	  else
	  return $customer_point_amount=$cash;
	  }
	  else
	  {
	   $cash;
	   }
	}
	elseif(!empty($customervalue))
	{  
	  if(isset($customervalue['param1']) && isset($customervalue['param2']))
	  $get_customer_type=Customerpointsmodel::get_cutomer_type($customervalue['param1'],$customervalue['param2']);
	  else
	  return $cash;

	  if(!empty( $get_customer_type)) {
	foreach($get_customer_type as $value)
	{
		 $customer_cash=Customer_model::get_points_cash('',$value->customer_type);
	}

	  if(isset($customer_cash->cash)){
	  return $customer_point_amount=$cash*$customer_cash->cash;
	  }
	  else
	  {
	  return $customer_point_amount=$cash;
	  }
	  }
	  else
	   $cash;
	}
	else
	return $cash;
   } 
  
  
  public static function block_points($block)
	{
		
   		$cust_info = Session::get('customer_data');
   		foreach($cust_info as $customer ){
   		$customer = (array)$customer;
   		}
   		
   		
   		    if(isset($customer['param1']) && isset($customer['param2']))
   			return Customerpointsmodel::block_points($block,$customer['param1'],$customer['param2']);

	}
	
    
    public static function get_block_points()
	{
		
   		$customer_details = Session::get('customer_data');
   		
   		foreach($customer_details as $customer){
   		$customer = (array)$customer;
   		}
   		
   		if(isset($customer['param1']) && isset($customer['param2']))
   		return Customerpointsmodel::get_blockpoints($customer['param1'],$customer['param2']);
   	}	        
    
   public static function reduce_customer_points($points,$cash,$status=false)
   {
    $customer_details = Session::get('customer_data');
    foreach($customer_details as $customer){
    $customer = (array)$customer;
    }
   
    if(isset($customer['param1']) && isset($customer['param2']))
    return Customerpointsmodel::reduce_customer_points($points,$customer['param1'],$customer['param2'],$cash,$status);
    else
    return $points;

   }	

      public static function check_individual_points($points,$postpoints)
 	{
	if($points>=$postpoints)
	{
		$remaingpoints=$points-$postpoints;
		return $remaingpoints;
	} else {

		$remaingpoints=$postpoints-$points;
		return $remaingpoints;
	}

     }	
  
   public static function get_offer($amount,$offer)
   {
	  if(!empty($offer))
	  {
	   $percent=$amount*($offer/100);
	   $amount=$amount-$percent;
	  }
	  return $amount;
     }


     public static function get_onlycurrency_value($value)
    {
	
	$row=Currency::get_currency_amount();
        $amount=$value/$row[0]->value;
	return round(abs($amount));
     }

     public static function get_cash_value()
	{
	
	
	$customer_details = Session::get('customer_data');
        foreach($customer_details as $customer){
        $customer = (array)$customer;
        }
	if(!empty($customer))
	{
	  if(isset($customer['param1']) && isset($customer['param2']))
	  $get_customer_type=Customerpointsmodel::get_cutomer_type($customer['param1'],$customer['param2']);
	  else
	  return 1;

	  if(!empty( $get_customer_type)) {
	  $customer_cash=Customermodel::get_points_cash('',$get_customer_type[0]->customer_type);
	  if(isset($customer_cash->cash))
	  return $customer_cash->cash;
	  else
	  return 1;
	  }
	  else
	   $price;
	}
	else
	return 1;
	}


   public static function get_offer_based_on_cid($c_id)
   {
       	$url= URL::to('/').'/add_to_cart'; 
	$parsedUrl = parse_url($url);
	$host = explode('.', $parsedUrl['host']);
	$subdomainname='';
	if(count($host)==3)
	$subdomainname=$host[0];
	$offer_amount="";
	/*if($subdomainname)
	{*/
	 $result=Productsmodel::get_catgory_id($subdomainname,$c_id);
	 if(!empty($result))
	 $offer_amount=$result->offer;
     	//}
        return $offer_amount;
  }





}
