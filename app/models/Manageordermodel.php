<?php
class Manageordermodel extends Eloquent {
	
  public static function order_list($value)
   { 
        
    if(isset($_POST) && !empty($_POST)) {
           $order_list = DB::table('orders')
                       ->Join('order_items', 'orders.id', '=', 'order_items.order_id')
                       ->Join('extended_products','orders.id', '=', 'extended_products.order_id')->select('orders.order_number','order_items.status','order_items.created_date','order_items.cashpaid','order_items.pointspaid','order_items.order_id','extended_products.input')
                       ->where('orders.customer_id', $value->id)
                       ->where('orders.order_number',$_POST['order_num'])
                       ->orderBy('orders.id', 'desc')
                       ->groupBy('orders.id')
                       ->get(); 
          }
         else  {
           $order_list = DB::table('orders')
                       ->Join('order_items', 'orders.id', '=', 'order_items.order_id')
                       ->Join('extended_products','orders.id', '=', 'extended_products.order_id')->select('orders.order_number','order_items.status','order_items.cashpaid','order_items.created_date','order_items.pointspaid','order_items.order_id','extended_products.input')
                       ->where('orders.customer_id', $value->id)
                       ->orderBy('orders.id', 'desc')
                       ->groupBy('orders.id')
                       ->get();
              } 

         return $order_list;
}



      public static function guest_order_details($_POST)
          { 
             if(isset($_POST) && !empty($_POST)) {
               $guest_list = DB::table('orders')
                       ->Join('order_items','orders.id', '=', 'order_items.order_id')
                       ->Join('extended_products','orders.id','=','extended_products.order_id')->select('orders.order_number','order_items.status','orders.email','order_items.created_date','order_items.cashpaid','order_items.pointspaid','order_items.order_id','extended_products.input')
                       ->where('orders.order_number',$_POST['order_id'])
                       ->where('orders.email',$_POST['email'])
                       ->get();  }
               return $guest_list;

        }


}
