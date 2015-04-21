<?php

class Customerpointsmodel extends Eloquent {
  
   public static function get_cutomer_type($param1,$param2)
	{ 
	
	 $result =  DB::table('customers_points')->where('param1',$param1)->where('param2',$param2)->where('expiry_date','>=',DATE('Y-m-d h:i:s'))->where('balance','>', 0)->get();
	    return $result;
		
	}

   
   
   public static function block_points($block,$parm1,$parm2)
	{
               DB::table('customers_points')
            ->where('param1',$parm1)->where('param2',$parm2)
            ->update(array('block_points' =>$block));  
		
	}
   
   
   
   public static function get_blockpoints($parm1,$parm2)
	{  
	      $query =  DB::table('customers_points')->select('block_points')->where('param1',$parm1)->where('param2',$parm2)->first();
           
	   return $query;
	}
   
    public static function reduce_customer_points($points,$param1,$param2,$cash=0,$status=false)
	{
		if($points>0)
		{
			//get customer_id from $param1 & $param2
			
			
			$result = DB::table('customers')->select('id')->where('param1',$param1)->where('param2',$param2)->first();
			$cust_id=$result->id;
			// insert the debited points in to customer transaction table
			if($status)
			$sta='Gift Points Redeemed';
			else 
			$sta= 'Points Redeemed';
			$data=array(
			'f_customer_id'=>$cust_id,
			'debit'=>$points,
			'cash'=>$cash,
			'status'=>$sta,'date'=>date('Y-m-d H:i:s')
			);
			
		         DB::table('customer_transactions')
			         ->insert($data);
			         
			       $result_points = DB::table('customers_points')    
			         ->where('expiry_date', '>=',date('Y-m-d'))
			         ->where('f_customer_id',$cust_id)
			         ->where('balance', '>',$points)
			         ->orderBy('f_customer_id', 'RANDOM')
                                 ->take(1)->get();
			
			if(isset($result_points)&&$result_points<>NULL):
			foreach($result_points as $key=>$point)
			{
			if(isset($point->balance)&&$point->balance>0){
				$check_val=check_individual_points($point->balance,$points);
				if($point->balance>$points){
				$check_value=Currency::check_individual_points($point->balance,$check_val);
// 				//reduce the debited points
				
				DB::table('customers_points')
                        ->where('param1',$param1)->where('param2',$param2)->where('points',$point->points)
                        ->where('id',$point->id)
                       ->update(array('balance' =>'balance' - $check_value ));  
				
				//$this->go_cart->debit_points(0);
				return true;
				} else {
				$remaing_points=$points-$point->balance;
				$points=$remaing_points;
				//reduce the debited points
				
				
				DB::table('customers_points')
                        ->where('param1',$param1)->where('param2',$param2)->where('points',$point->points)
                        ->where('id',$point->id)
                       ->update(array('balance' =>'balance' - $point->balance ));  
				//$this->go_cart->debit_points(0);
				}
				}
			}
			else:
			//reduce the debited points
			DB::table('customers_points')
                        ->where('param1',$param1)->where('param2',$param2)
                       ->update(array('balance' =>'balance' - $points ));  
			
			
			//$this->go_cart->debit_points(0);
			return true;
			endif;
		}
	}
   
   
   
}
