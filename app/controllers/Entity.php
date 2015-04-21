<?php 
class Entity extends AdminBaseController {
protected $clients;

   public function index()
    {
	 //$entity = Entitymodel::paginate( Config::get('15'));
	$entity=Entitymodel::where('role_id', '=', 3)->get();
	return $this->load_admin_theme('entity','index',array('entity'=>$entity));      
    }

    public function show($id)
    {
	$entity =Entitymodel::find($id);
	if(isset($entity)&& $entity<>''){
	return $this->load_admin_theme('entity','show',array('entity'=>$entity)); 
	}else{
	return Redirect::route('cpanel.entity.index')
	->with('danger', 'Requested Entity not found');
	     }
    }

   
    public function create(){
    $images = array();
    $states = DB::table('states')->where('country_code', 'IN')->get();
    $cities  = DB::table('cities')->where('country_code', 'IN')->get();
    return $this->load_admin_theme('entity','create',array('images'=>$images,'states'=>$states,'cities'=>$cities));
    }
    
    
   public function edit($id)
    {
	$entity =Entitymodel::find($id);
	$entitydetails  = DB::table('entity_details')->where('entity_id',$id)->get();
	foreach($entitydetails  as $entitydetail){
	$entity_details = $entitydetail;
	}
	$states = DB::table('states')->where('country_code', 'IN')->get();
        $cities  = DB::table('cities')->where('country_code', 'IN')->get();
	if(isset($entity)&& $entity<>''){
	return $this->load_admin_theme('entity','edit',array('entity'=>$entity,'entity_details'=>@$entity_details,'states'=>$states,'cities'=>$cities)); 
	}else{
	return Redirect::route('cpanel.entity.index')
	->with('danger', 'Requested Entity not found');
	      }
       
    }

   public function store() 
    {    
	$input = Input::all();
         
       	 $rules=array();
         $rules['entity_name'] = 'required|min:3|max:30|alpha_num';
         $rules['email'] = 'required|email|unique:users,email';
         $rules['password'] = 'required|confirmed';
         $rules['landline'] = 'required|numeric';
         $rules['entity_code'] = 'required|min:3|max:30|alpha_num';
         $rules['entity_status'] = 'required';
         $messages = array('password.confirmed' => 'Password does not matches');
         if(!empty(Input::get('address1'))){
          $rules['address1'] = 'max:100';
          }
          if(!empty(Input::get('address2'))){
          $rules['address2'] = 'max:100';
          } 
           if(!empty(Input::get('pincode'))){
            $rules['pincode'] = 'min:6';
          } 
           if(!empty(Input::get('contact_firstname'))){
          $rules['contact_firstname'] = 'min:2|max:15';
          }
           if(!empty(Input::get('contact_lasttname'))){
          $rules['contact_lasttname'] = 'min:1|max:15';
          } 
           if(!empty(Input::get('contact_mobile_no'))){
          $rules['contact_mobile_no'] = 'numeric';
        
          } 
          if(!empty(Input::get('contact1_landline_no'))){
          $rules['contact_landline_no'] = 'numeric';
          } 
          if(!empty(Input::get('contact_email'))){
          $rules['contact_email'] = 'email';
          } 
          if(!empty(Input::get('contact_email'))){
          $rules['contact_email'] = 'email';
          } 
          if(!empty(Input::get('maker_comment'))){
          $rules['maker_comment'] = 'max:100';
          } 
          if(!empty(Input::get('checker_comment'))){
          $rules['checker_comment'] = 'max:100';
          } 
          if(!empty(Input::get('other_details'))){
          $rules['other_details'] = 'max:100';
          }  
	 $validator = Validator::make(Input::all(), $rules,$messages);

	    if ($validator->fails())
	      {
	         return Redirect::route('cpanel.entity.create')
                 ->withInput()
                 ->withErrors($validator->messages());
	      }else
                  {   
                     
                        $active =0;
                        $password = sha1(Input::get('password'));
			if(Input::get('entity_status') == 1){$active = 1;}
			            
			$id = DB::table('users')->insertGetId(array(
                        'name'=> Input::get('entity_name'),
			'email'=> Input::get('email'),
			'password'=>$password,
			'landline'=>     Input::get('landline'),
			'user_code'=>     Input::get('entity_code'),
			'role_id'=> 3,
                        'status'=>    $active,
                        'activated_at'=> $active,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => '',
                        
                         ));
                      
                       $entity_details = DB::table('entity_details')->insertGetId(array(
                       'entity_id'=>  $id,
                        'address1'=>    Input::get('address1'),
                        'address2'=>    Input::get('address2'),
                        'city'=>    Input::get('city'),
                        'state'=>    Input::get('state'),
                        'pincode'=>    Input::get('pincode'),
                        'country'=>    Input::get('country'),
                        'cp_fname'=>    Input::get('contact_firstname'),
                        'cp_lname'=>    Input::get('contact_lastname'),
                        'cp_mobile'=>    Input::get('contact_mobile_no'),
                        'cp_landline'=>    Input::get('contact_landline_no'),
                        'cp_email'=>    Input::get('contact_email'),
                        'maker_comment'=>    Input::get('maker_comment'),
                        'checker_comment'=>    Input::get('checker_comment'),
                        'other_details'=>    Input::get('other_details'),
                        ));
                      
                
			return Redirect::route('cpanel.entity.index')
			->with('success','Entity created');
               }
 
    }

    public function update($id)
    { 
	 $rules =array();
         $rules['entity_name'] = 'required|min:3|max:30|alpha_num';
         $rules['email'] = 'required|email|unique:users,email,'.$id.'';
         $rules['landline'] = 'required|numeric';
         $rules['entity_code'] = 'required|min:3|max:30|alpha_num';
         $rules['entity_status'] = 'required';
         if(!empty(Input::get('password'))){
          $rules['password'] = 'confirmed';
         $messages = array('password.confirmed' => 'Password does not matches');
          } 
         if(!empty(Input::get('password_confirmation'))){
          $rules['password'] = 'required!confirmed';
          $messages = array('password.confirmed' => 'Password does not matches');
          }
         
         if(!empty(Input::get('address1'))){
          $rules['address1'] = 'max:100';
          }
          if(!empty(Input::get('address2'))){
          $rules['address2'] = 'max:100';
          } 
           if(!empty(Input::get('pincode'))){
            $rules['pincode'] = 'min:6';
          } 
           if(!empty(Input::get('contact_firstname'))){
          $rules['contact_firstname'] = 'min:2|max:15';
          }
           if(!empty(Input::get('contact_lasttname'))){
          $rules['contact_lasttname'] = 'min:1|max:15';
          } 
           if(!empty(Input::get('contact_mobile_no'))){
          $rules['contact_mobile_no'] = 'numeric';
        
          } 
          if(!empty(Input::get('contact1_landline_no'))){
          $rules['contact_landline_no'] = 'numeric';
          } 
          if(!empty(Input::get('contact_email'))){
          $rules['contact_email'] = 'email';
          } 
          if(!empty(Input::get('contact_email'))){
          $rules['contact_email'] = 'email';
          } 
          if(!empty(Input::get('maker_comment'))){
          $rules['maker_comment'] = 'max:100';
          } 
          if(!empty(Input::get('checker_comment'))){
          $rules['checker_comment'] = 'max:100';
          } 
          if(!empty(Input::get('other_details'))){
          $rules['other_details'] = 'max:100';
          }  */
         
         $validator = Validator::make(Input::all(), $rules);
	
	if ($validator->fails())
	{
	return Redirect::back()
	->withInput()
	->withErrors($validator->errors());
	}else{
	$entity = array();
	$entity_details = array();
	
	
	  $active =0;
	   $password = sha1(Input::get('password'));
	 if(Input::get('entity_status') == 1){$active = 1;}
           $entity['name']  = Input::get('entity_name');
	   $entity['email']        = Input::get('email');
	   if(!empty($password)){
            $enterprise['password']     = $password;
	    }
	   $entity['landline']     = Input::get('landline');
	   $entity['user_code']  = Input::get('entity_code');
	   $entity['status']= $active;
	   $entity['updated_at'] 	= date('Y-m-d H:i:s');
	   $entity['created_by']   = '';
	
             DB::table('users')->where('id', $id)->update($entity);
                
                $entity_details['address1']  =    Input::get('address1');
                $entity_details['address2']  =    Input::get('address2');
                $entity_details['city']      =    Input::get('city');
                $entity_details['state']     =    Input::get('state');
                $entity_details['pincode']   =    Input::get('pincode');
                $entity_details['country']   =    Input::get('country');
                $entity_details[ 'cp_fname'] =    Input::get('contact_firstname');
                $entity_details['cp_lname']  =    Input::get('contact_lastname');
                $entity_details['cp_mobile'] =    Input::get('contact_mobile_no');
                $entity_details['cp_landline']=    Input::get('contact_landline_no');
                $entity_details['cp_email']      = Input::get('contact_email');
                $entity_details['maker_comment'] = Input::get('maker_comment');
                $entity_details['checker_comment'] = Input::get('checker_comment');
                $entity_details['other_details']   =   Input::get('other_details');
                
                 DB::table('entity_details')->where('entity_id', $id)->update($entity_details);
	
	return Redirect::route('cpanel.entity.index')
	->with('success','Entity updated');
	}

          
    }


    public function putDeactivate($id)
    {
	if(isset($id)&&$id<>''){
	$update = array('activated'=>0,'status'=>0);
	DB::table('users')->where('id', $id)->update( $update);
	return Redirect::route('cpanel.entity.index')
	->with('success','Entity Deactivated');
	}else{
	return Redirect::route('cpanel.entity.index')
	->with('danger', 'Requested Entity Not Found');
	}
    }

  public function putActivate($id)
    {
	if(isset($id)&&$id<>''){
	$update = array('activated'=>1,'status'=>1);
	DB::table('users')->where('id', $id)->update( $update);
	return Redirect::route('cpanel.entity.index')->with('success','Entity Activated');
	}else{
	return Redirect::route('cpanel.entity.index')
	->with('danger', 'Requested Entity not found');
	} 
    }
   
   
   /* public function destroy($id)
    {
	$client = Client::find($id);
	if(isset($client)&&$client<>''){
	$client->delete();
	return Redirect::route('cpanel.clients.index')
	->with('success','Client deleted');
	}else{
	return Redirect::route('cpanel.clients.index')
	->with('danger', 'Requested client not found');
	}
    }*/

}
