<?php class Manageorder extends BaseController {

  public function list_orders()
 {
        $value = Session::get('customer_data');
        $data['order_list'] =Manageordermodel::order_list($value); 
      
      if(isset($_POST['order_num']) && empty($data['order_list'])) { 
        
         
         $data['error'] ="<font color='red' style='margin-top: 66px;margin-left: 2px;position: absolute;'> <b> " . $_POST['order_num']. " - "."</b>This is an invalid order number.Please check with your order number and try again..</font>" ;
 
        }

        $menus=array('one','two');    		
	$bread_crumb=array('Home'=>'/');
	$data['page'] ='testest';
	$data['bread_crumb']=array('Home'=>'/');
	return $this->render_reward_theme('my_account.order_list',$data);

}
 
   public function order_details($id)
{

       $exist=array('order_id'=>(int)$id); 
       $condrestwo=DB::connection('mongodb')->getCollection('extended_products')->find($exist);
       if($condrestwo->count()==0){
	$exist=array('order_id'=>$id);
	$condrestwo=DB::connection('mongodb')->getCollection('extended_products')->find($exist);
	}

         foreach($condrestwo as $details) {
           $data['input'] = json_decode($details['input']); 
           $data['output'] = json_decode($details['output']); 
          }
            
     
        $menus=array('one','two');    		
	$bread_crumb=array('Home'=>'/');
	$data['page'] ='testest';
	$data['bread_crumb']=array('Home'=>'/');
	
     return $this->render_reward_theme('my_account.order_details',$data);

}

   public function guest_order()
{    
        $credentials = Input::get();
         $data = Session::get('guest_order');
        $menus=array('one','two');    		
	$bread_crumb=array('Home'=>'/');
	$data['page'] ='testest';
	$data['bread_crumb']=array('Home'=>'/');
        return $this->render_reward_theme('my_account.manage_order',$data);
}


     public function guest_order_details()
{          
          if(empty($_POST)){
          return Redirect::to('guest_order');
          }
          $order_list =Manageordermodel::guest_order_details($_POST);

               
                if(!empty($order_list)){
                 if(trim($_POST['order_id'])==$order_list[0]->order_number && trim($_POST['email']) == $order_list[0]->email)
                    {  $data['order_list'] = $order_list;  }  
                    }
           else  {
         $data['result'] = "<font color='red' style='margin-top: 15px;margin-left: 161px;  font-size='15px;'position: absolute;'>Please enter the valid Order details. . </font>";
      	return Redirect::to('guest_order')->with('guest_order',$data); 
           }
        $menus=array('one','two');    		
	$bread_crumb=array('Home'=>'/');
	$data['page'] ='testest';
	$data['bread_crumb']=array('Home'=>'/');
	
     return $this->render_reward_theme('my_account.order_list',$data);


}
}

