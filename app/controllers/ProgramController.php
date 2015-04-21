<?php use Jenssegers\Mongodb\Connection;

class ProgramController extends BaseController {


    public function list_programs()
    {    
        $templ=DB::table('template')->where('active','1')->get();
        $data['program'] = DB::table('program')->where('pgm_status','=',1)->get();
       
       // Program list after login
       	$customer = Session::get('customer_data'); 
       	 
        if(!empty($customer)) { 
          
         $customer_id = $customer->id;	
       
	 $data['program'] = DB::table('program')->where('pgm_status','=',1)->get();
                              
	}

	  $data['customer']=$customer;
            
          $data['bread_crumb']=array('Home'=>'/');
       
          $this->load_reward_region('common','left',$data); 
      	
	  return $this->render_reward_theme('program.list_programs',$data);
   
    }
  
  //product details function
    public function program_details($id){

      $customer = Session::get('customer_data'); 
      $data['program_details']= DB::table('program')->where('pgm_status','!=',3)->where('id',$id)->get();
      $templ=DB::table('template')->where('active','1')->get();
      $data['bread_crumb']=array('Home'=>'/');	
      $data['js_array'] = array('js/jquery.fancybox-1.3.1.pack.js');
      $data['css_array'] = array('css/listgrid.css','css/font-awesome.min.css','css/jquery.fancybox-1.3.1.css');
      $data['customer']=$customer;
      return $this->render_reward_theme('program.program_details',$data);
    
   }
    //product details function
    public function program_validation($id){
    
      $data['program_details']= DB::table('program')->where('pgm_status','!=',3)->where('id',$id)->get();

      $data['bread_crumb']=array('Home'=>'/');	
      $data['js_array'] = array('js/jquery.fancybox-1.3.1.pack.js');
      $data['css_array'] = array('css/listgrid.css','css/font-awesome.min.css','css/jquery.fancybox-1.3.1.css');
     
      return $this->render_reward_theme('program.validate',$data);
    
   }
   
      public function search_program()
      {
        $data['bread_crumb']=array('Home'=>'/');
      $pro=$_POST;
      $data['result'] =  DB::table('program')->where('program.pgm_name','LIKE',$pro['program_name'])->get();
      return $this->render_reward_theme('program.list_programs',$data);
      }
   
   public function gridview(){
   
          $templ=DB::table('template')->where('active','1')->get();
          $data['program'] = DB::table('program')->where('pgm_status','!=',3)->get();

	$user_result = Session::get('customer_data'); 
	if(!empty($user_result)) { 
	 foreach($user_result as $customer){
	        $customer_id = $customer->id;	
}  

	$data['program'] = DB::table('customers_points')->where('user_id','=',$customer_id)
	->leftJoin('program', 'customers_points.program_id', '=', 'program.id')
	->get();   
	}




          $bread_crumb=array('Home'=>'/');	
          $this->load_reward_theme('Points Pool','program.gridview',$templ[0]->templ_name,$bread_crumb,'',''); 	
	  return $this->render_reward_theme('program.gridview',$templ[0]->templ_name,$data);
   
   }
   
    public function listview(){
    
          $templ=DB::table('template')->where('active','1')->get();
          $data['program'] = DB::table('program')->where('pgm_status','!=',3)->get();
        
          $user_result = Session::get('customer_data'); 
        if(!empty($user_result)) { 
           foreach($user_result as $customer){
               $customer_id = $customer->id;	}  
       
	 $data['program'] = DB::table('customers_points')->where('user_id','=',$customer_id)
                          ->leftJoin('program', 'customers_points.program_id', '=', 'program.id')
                          ->get();   
	}

          $bread_crumb=array('Home'=>'/');	
          $this->load_reward_theme('Points Pool','program.listview',$templ[0]->templ_name,$bread_crumb,'',''); 	
	  return $this->render_reward_theme('program.listview',$templ[0]->templ_name,$data);
   
   }
  
   public function post_programs()
   {
     //   $data = array('csvfile' => Input::file('csvfile'));
       
        //$result=DB::table('temp_customers_points')->leftJoin('program','program.id','=','temp_customers_points.program_id');
         
    /*  echo '<pre>';   print_r($_POST); exit;
        
        $da=$_POST;
        $data['first_name']=$_POST['first_name'];
        $data['anniversary_date']=date('Y-m-d',strtotime($_POST['anniversary_date']));
        $_POST['anniversary_date']=date('Y-m-d',strtotime($_POST['anniversary_date']));*/ 
        
        
        
       // $users = DB::table('temp_customers_points')->where('first_name',$data['first_name'])->orWhere()->get();
        $dat=DB::table('program')->where('id',$_POST['program_id'])->get();
        foreach($dat as $data)
        {
        $access=json_decode($data->access);
        foreach($access as $key=>$value)
        {
         $arra[]=$key;
         }}
        $result =DB::table('program_params')->select('program_params.param','program_params.name')->whereIn('id', $arra)->get();
        foreach($result as $res)
        {
        $resul[]=$res;
        }
        for($i = 0; $i <count($resul); $i++)
        {
        $tem=$i+1;
        $program['param'.$tem]=(array)$resul[$i];
        }
        $q=0;
        $query="select * from pp_temp_customers_points where ";
        $params="";

        
        foreach($program as $column=>$value)
        {
        if($q >0)
          {
         $query.=' AND '. $value['param']."=?";
          }
          else
          $query.= $value['param']."=?";
          $q=$q+1;
         $params['param'.$q]=$_POST[$value['param']];
         }
		
         $query.= ' AND expiry_date >= '.date('Y-m-d').' AND transfer_status =0';

	//echo '<pre>';
	//print_r($query);

	
         $arr_val=array_values($params); 
       
         $program_tag_data=DB::select($query, $arr_val);
       
     
       
         foreach($program_tag_data as $tag_data)
         {
		
         $tags[]=$tag_data;
         }
         
          $user_result = Session::get('customer_data'); 
        if(!empty($user_result)) { 
            $user_id = $user_result->id;
            }
            
              
               
        if(isset($tags) && $tags <>'')
        {

		
       		 foreach($tags as $tag){ 

		
              $cs_po['program_id']=$tag->program_id;
              $cs_po['user_id']=$user_id;
              $cs_po['f_client_id']=$tag->f_client_id;
              $cs_po['param1']=$tag->first_name;
              $cs_po['param2']=$tag->anniversary_date;
              $cs_po['points']=$tag->points;
              $tag_po['program_id']=$tag->program_id;
              $tag_po['user_id']=$user_id;
              $tag_po['created_date']=date('Y-m-d');
              $inser=  DB::table('customers_points')->insert($cs_po);
              $inser=  DB::table('program_tag_data')->insert($tag_po);
              $update = DB::table('temp_customers_points')->where('id', $tag->id)->update(array('transfer_status' => 1));
              
         }
         
         }
         
         if(isset($inser) && $inser <>'')
         {
         return Redirect::to('list_program')
         ->with('Your Program is Successfuly Tagged.');
        }
        else
        {
       
        return Redirect::to('program_validation/'.$_POST['program_id'])
        ->with('danger','Please Enter The Valid Data.');
        }
  
   
   
   }
   
    }
