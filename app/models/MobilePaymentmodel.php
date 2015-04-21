<?php use Jenssegers\Mongodb\Connection;

class MobilePaymentmodel extends Eloquent {
  
  //get charity payeer
  
   public static function get_charitypayeer(){
   
    $result   = DB::Select(DB::RAW("select biller_name,ubp_biller_id,biller_name,id,sub_category from pp_billers where category='charity'  and type in('BOTH','PAYEE') order by biller_name asc ")); 
                    
	   return  $result;
   
   }
  
  
  
  //get mobile biller name
  public static function getmobile_billername() {
     
              $result   = DB::Select(DB::RAW("select biller_name,ubp_biller_id,biller_name,id,sub_category,type,network from pp_billers where category='Utility' and sub_category='Mobile' and type in('BOTH','PAYEE') order by biller_name asc ")); 
                    
	   return  $result;
	}
  
  
  
   //get insurance payeer name
    public static function getinsurance_payeername(){
    
    $result   = DB::Select(DB::RAW("select biller_name,ubp_biller_id,biller_name,id,sub_category from pp_billers where category='Insurance' and sub_category='Insurance' and type in('BOTH','PAYEE') order by biller_name asc ")); 
                    
	   return  $result;
     
     }
  
  //get electricity payeer name
  
   public static function getelectricity_payeername(){
   
    $result   = DB::Select(DB::RAW("select biller_name,ubp_biller_id,biller_name,id,sub_category from pp_billers where category='Utility'   
                and sub_category='Electricity' and type in('BOTH','PAYEE') ")); 
                    
	   return  $result;
  
  }
   
   //get telephone biller name
   public static function  get_telephonebiller(){
   
   $result   = DB::Select(DB::RAW("select biller_name,ubp_biller_id,biller_name,id,sub_category from pp_billers WHERE sub_category LIKE  'Telephone' and category='Utility' and type in('BOTH','PAYEE') order by biller_name asc  ")); 
                    
	   return  $result;
   
   }
   
   
   //get gas payeer name
   
   public static function getgas_payeername(){
   
   $gas_result   = DB::Select(DB::RAW("select biller_name,ubp_biller_id,biller_name,id,sub_category from pp_billers where category='Utility' and sub_category='Gas' and type in('BOTH','PAYEE') order by biller_name asc   ")); 
                    
	   return  $gas_result;
   
   }
   
   
   
   //get billers circles
   
   public static function getbillers_circle($network){
                                 
           $result   = DB::table('billers')->select('biller_name','id')->where('network',$network)->where('sub_category','Mobile')->orderBy('biller_name', 'asc')->get();
	   return  $result;
   
   }
 
   //get subscription details
   public static function get_subscription(){
   
    $sub_result   = DB::Select(DB::RAW("select biller_name,ubp_biller_id,biller_name,id,sub_category from pp_billers where category='Subscription' and sub_category='Subscription' and type in('BOTH','PAYEE') order by biller_name asc")); 
                    
	   return  $sub_result;
   }
  
  
  //get creaditcard details
  
  public static function get_creditcards(){
  
  $sub_result   = DB::Select(DB::RAW("select biller_name,ubp_biller_id,biller_name,id,sub_category from pp_billers where category='Credit Cards' and sub_category='Credit Cards' and type in('BOTH','PAYEE') order by biller_name asc  ")); 
                    
	   return  $sub_result;
  
  }
  
  
  //getting dth  deatails
  public static function get_dth_details(){
  
  $dth_result   = DB::Select(DB::RAW("select biller_name,ubp_biller_id,biller_name,id,sub_category from pp_billers where category='Utility' and sub_category='DTH' and type in('BOTH','PAYEE') order by biller_name asc  ")); 
                    
	   return  $dth_result;
  
  }
  
  
  //loading scheme based on the subscriper
  public static function get_loadscheme($subscribe_id){
  
  $schema_result =  DB::table('billers')->select('scheme')->where('id',$subscribe_id)->first();
  return $schema_result;
  
  }
  
  //loading subscriber biller
  public static function  loadsubscribebiller($subscribe_id){
  $res = DB::table('billers')->select('ubp_biller_id','biller_name')->where('id',$subscribe_id)->first();
  return $res;
  }
  
  
  //get operators
  
    public static function get_operators(){
    $operators = DB::table('myoxi_operators')->get();
    return $operators; 
    }
    public static function get_postpaid_operators(){
    $operators = DB::table('myoxi_operators')->where('status',1)->get();
    return $operators; 
    }
    
    //getting card prefix
    public static function load_creditcardprefix($id){
    $card_prefix = DB::table('billers')->select('starts_with','biller_name')->where('id',$id)->first();
    return $card_prefix;
    
    }
  
   public static function load_creditcard_biller($id){
   $card_details = DB::table('billers')->select('ubp_biller_id')->where('id',$id)->first();
   return  $card_details;
   }
   
   //load biller
   
   public static function load_biller($biller_id){
   $biller_details = DB::table('billers')->select('remarks')->where('id',$biller_id)->first();
    return  $biller_details;
   }
   
   public static function load_charitybiller($biller_id){
   
    $billers_details = DB::table('billers')->select('ubp_biller_id')->where('id',$biller_id)->first();
    return $billers_details;
    
   }
   
   
  //billdesk order details
   public static function get_billdesk_order_details(){
   
   $order_details = DB::select( DB::raw("SELECT 
    (CASE
        WHEN LENGTH(transaction_amount) = '1' THEN concat('0000000',transaction_amount,'00')
	WHEN LENGTH(transaction_amount) = '2' THEN concat('000000',transaction_amount,'00')
	WHEN LENGTH(transaction_amount) = '3' THEN concat('00000',transaction_amount,'00')
	WHEN LENGTH(transaction_amount) = '4' THEN concat('0000',transaction_amount,'00')
	WHEN LENGTH(transaction_amount) = '5' THEN concat('000',transaction_amount,'00')
	WHEN LENGTH(transaction_amount) = '6' THEN concat('00',transaction_amount,'00')
	WHEN LENGTH(transaction_amount) = '7' THEN concat('0',transaction_amount,'00')
     END) as t_amount,  DATE_FORMAT(transaction_date, '%Y%m%d'),billdesk_transaction_id,bank_account_number,bank_refence_number,customer_id,transaction_status,failure_reason  FROM  pp_billdesk_order_items WHERE DATE_FORMAT(transaction_date, '%Y-%m-%d') = '".date("Y-m-d")."' order by transaction_date desc") ); 
   
      return $order_details;
		
   
   }
   
   

}
