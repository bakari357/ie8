<?php

class Customermodel extends Eloquent {
  
   
  public static function get_points_cash($id,$type=false)
	{    
	      $query =  DB::table('points_to_cash')->leftJoin('customers_type', 'customers_type.id', '=', 'points_to_cash.customer_type_id')->select('points_to_cash.id as id' ,'customers_type.id as type_id','points_to_cash.cash','customers_type.type');
	   
		
		if($id)
		$query->where('points_to_cash.id',$id);
		if(is_numeric($type))
		$query->where('customers_type.id',$type);
		if(!is_numeric($type))
		$query->where('customers_type.type',$type);
		$result	= $query->first();
		return $result;
	}
	
	
       public static function get_transactions($customer_id,$data=array(), $return_count=false)
	{
                      $query = DB::table('customer_transactions');
	
			if(!empty($data['rows']))
			{
				$query->take($data['rows']);
			}

			//grab the offset
			if(!empty($data['page']))
			{
				$$query->skip($data['page']);
			}

			//do we order by something other than category_id?
			if(!empty($data['order_by']))
			{
				$query->orderBy('customer_transactions.'.$data['order_by'], $data['sort_order']);
			}
			if(!empty($data['term']))
			{
				$search	= json_decode($data['term']);
				if(!empty($search->start_date) && empty($search->end_date))
				{
					$query->where('date','>=',$search->start_date);
 					//$this->db->where('DATE_FORMAT('.$this->db->dbprefix('customer_transactions').'.date,"%Y-%m-%d" ) >=',$search->start_date);
				}
				if(!empty($search->end_date) && empty($search->start_date))
				{
					$query->where('date','<=',$search->end_date);
                                        //$this->db->where('DATE_FORMAT('.$this->db->dbprefix('customer_transactions').'.date,"%Y-%m-%d" ) <=',$search->end_date);
                                }
if(!empty($search->start_date) && !empty($search->end_date))
{
  $query->where('date','>=',$search->start_date);
  $query->where('date','<=',$search->end_date);
//$query->where('DATE_FORMAT("re_customer_transactions.date","%Y-%m-%d")', '>=',$search->start_date);
//$query->where('DATE_FORMAT("re_customer_transactions.date","%Y-%m-%d")',  '<=',$search->end_date);
}
			}
// 				
				if($return_count)
				{
				$this->db->where('f_customer_id',$customer_id);
				return $this->db->count_all_results('customer_transactions');
				} else	{
				$query->where('f_customer_id',$customer_id);
				return $query->get();
				}


	}
	
	
	//save customer address	
	public static function save_address($data)
	{   //echo '<pre>'; print_r($data); exit;
		// prepare fields for db insertion
		$data['field_data'] = serialize($data['field_data']);
		// update or insert
    
		if(!empty($data['id']))
		{       
		         DB::table('customers_address_bank')->where('id', $data['id'])->update($data);
			 return $data['id'];
		} else {
			$id = DB::table('customers_address_bank')->insertGetId($data);
			return $id;
		}
	}

	public static function get_customer()
	{
	$customer= DB::table('customers')->get();
	
		return $customer;
	}
	
	
	
	
	
	

}
