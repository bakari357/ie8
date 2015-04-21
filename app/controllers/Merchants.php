<?php 
class Merchants extends AdminBaseController {
protected $pages;

   public function index()
    {
	 //$merchants = Merchant::paginate( Config::get('15'));
	$merchants=Merchant::where('role_id', '=', '4')->get();
	return $this->load_admin_theme('merchants','index',array('customers'=>$merchants));      
    }

    public function show($id)
    {
	$merchant =Merchant::find($id);
	if(isset($merchant)&&$merchant<>''){
	return $this->load_admin_theme('merchants','show',array('merchant'=>$merchant)); 
	}else{
	return Redirect::route('cpanel.merchants.index')
	->with('danger', 'Requested merchant not found');
	     }
    }

    public function create(){
	$images = array();
	$states = DB::table('states')->where('country_code', 'IN')->get();
	$cities  = DB::table('cities')->where('country_code', 'IN')->get();
	return $this->load_admin_theme('merchants','create',array('images'=>$images,'states'=>$states,'cities'=>$cities)); 
       
    }
     public function loadcity(){
       $type=$_POST['city'];
	$cities  = DB::table('cities')->where('country_code', $type)->get();
	$out='';
             $out .=' <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">City</label>
                                    <div class="col-md-4">
                                          <select id="groups" name="city" class="select2 form-control">
                                            <option selected="1" value="">City Name</option>';
                      if(isset($cities)) { 
                        foreach ($cities as $city) { 
                                            
                                          $out .='   <option  value="'.$city->id.'">'. $city->city.'</option>';
                                      } }
                                        $out .='  </select>
                                    </div>
                                </div> ';
      echo $out;
       
    }
   public function edit($id)
    {  
        
        $merchants =Merchant::find($id);
	$merchantsdetails  = DB::table('merchant_details')->where('merchant_id',$id)->get();
	foreach(@$merchantsdetails  as $merchantdetail){
	$merchants_details = $merchantdetail;
	}
	$states = DB::table('states')->where('country_code', 'IN')->get();
        $cities  = DB::table('cities')->where('country_code', 'IN')->get();
	if(isset($merchants)&& $merchants <>''){
	return $this->load_admin_theme('merchants','edit',array('merchant'=>$merchants,'merchants_details'=>@$merchants_details,'states'=>$states,'cities'=>$cities)); 
	}
        
        else{
	  return Redirect::route('cpanel.merchants.index')
                ->with('danger', 'Requested merchant not found');
	}
        
   
    }

   public function store() 
    {
         $input = Input::all();
         $rules=array();
         $rules['name'] = 'required|min:5';
	 $rules['first_name'] = 'required|min:3|max:40|alpha';
         $rules['last_name'] = 'required|min:5'; 
         $rules['email'] = 'required|email|unique:users,email';
         $rules['password'] = 'required|min:6|confirmed'; 
	 $rules['vat_number'] = 'required|AlphaNum';
	 $rules['merchant_code'] = 'required|AlphaNum';
	$rules['line_number'] = 'required|numeric';
	$rules['st_number'] = 'required|AlphaNum';
	$rules['tin_number'] = 'required|AlphaNum';
	$rules['pan_number'] = 'required|AlphaNum';
	$rules['active'] = 'required';
	
         $messages = array('password.confirmed' => 'Password does not matches');
        
       
	 $validator = Validator::make(Input::all(), $rules,$messages);
            
	 
	    if ($validator->fails())
	      {
	           return Redirect::route('cpanel.merchants.create')
                 ->withInput()
                 ->withErrors($validator->messages());
	      }else
                  {   
			$password = sha1(Input::get('password'));
			$active =0;
			if(Input::get('active') == 1){$active = 1;}
			      					
                       $id = DB::table('users')->insertGetId(array(
			'name'=> Input::get('name'),
			'role_id'=> 4,
			'first_name'=>     Input::get('first_name'),
			'last_name'=>     Input::get('last_name'),
			'vat'=>     Input::get('vat_number'),
			'st_number'=>     Input::get('st_number'),
			'tin_number'=>     Input::get('tin_number'),
			'pan'=>     Input::get('pan_number'),
			'email'=>     Input::get('email'),
			'user_code'=>     Input::get('merchant_code'),
			'landline'=>     Input::get('line_number'),
			'password'=>    $password,
			'activated_at'=> $active,
			'status'=> $active,
			'created_at'=>    date('Y-m-d H:i:s'),
			)); 
		        $ids = DB::table('merchant_details')->insertGetId(array(
			'merchant_id'=> $id,
			'address1'=>     Input::get('address1'),
			'address2'=>     Input::get('address2'),
			'pincode'=>     Input::get('pin_code'),
			'state'=>     Input::get('state'),
			'city'=>     Input::get('city'),
			'country'=>     Input::get('country'),
			'cp1_fname'=>     Input::get('cfist_name1'),
			'cp1_lname'=>     Input::get('clast_name1'),
			'cp1_mobile'=>     Input::get('cmobile_number1'),
			'cp1_email'=>     Input::get('cemail1'),
			'cp2_fname'=>     Input::get('cfist_name2'),
			'cp2_lname'=>     Input::get('clast_name2'),
			'cp2_mobile'=>     Input::get('cmobile_number2'),
			'cp2_email'=>     Input::get('cemail2'),
			'maker_commnet'=>     Input::get('maker_comm'),
			'checker_comment'=>     Input::get('checker_comm'),
			'other_details'=>     Input::get('other_details'),
			));
			
                        

			return Redirect::route('cpanel.merchants.index')
			->with('success','Merchant created');
               }
 
    }

    public function update($id)
    {
	$rules =array();
        $rules['name'] = 'required|min:5';
	$rules['first_name'] = 'required|min:3|max:40|alpha';
        $rules['last_name'] = 'required|min:5'; 
        $rules['email'] = 'unique:users,email,'.$id.'';
	$rules['vat_number'] = 'required|AlphaNum';
	$rules['line_number'] = 'required|numeric';
	$rules['st_number'] = 'required|AlphaNum';
	$rules['tin_number'] = 'required|AlphaNum';
	$rules['pan_number'] = 'required|AlphaNum';
	$rules['activated'] = 'required';
     	  /*if(!empty(Input::get('password'))){
          $rules['password'] = 'confirmed';
         $messages = array('password.confirmed' => 'Password does not matches');
          }*/
     	 $validator = Validator::make(Input::all(), $rules);
	 if ($validator->fails())
	{
	return Redirect::back()
	->withInput()
	->withErrors($validator->errors());
	}else{  
                 $merchant_details =array();
                 $merchant = array();
                 $password = sha1(Input::get('password'));
                 $active =0;
		 if(Input::get('active') == 1){$active = 1;}
	        $merchant['name'] = Input::get('name');
		$merchant['first_name']=     Input::get('first_name');
		$merchant['last_name']=     Input::get('last_name');
		$merchant['vat']=     Input::get('vat_number');
		$merchant['st_number']=     Input::get('st_number');
		$merchant['tin_number']=    Input::get('tin_number');
		$merchant['pan']=     Input::get('pan_number');
		$merchant['email']=     Input::get('email');
		$merchant['user_code']=     Input::get('merchant_code');
		$merchant['landline']=     Input::get('line_number');
		  if(!empty($password)){
		  $merchant['password']     = $password;
		  }
		 $merchant['activated_at']= $active;
		 $merchant['status']= $active;
		 $merchant['updated_at']=    date('Y-m-d H:i:s');
			
		         DB::table('users')->where('id', $id)->update($merchant);
			$merchant_details['address1']=     Input::get('address1');
			$merchant_details['address2']=     Input::get('address2');
			$merchant_details['pincode']=     Input::get('pin_code');
			$merchant_details['state']=     Input::get('state');
			$merchant_details['city']=     Input::get('city');
			$merchant_details['country']=     Input::get('country');
			$merchant_details['cp1_fname']=     Input::get('cfist_name1');
			$merchant_details['cp1_lname']=     Input::get('clast_name1');
			$merchant_details['cp1_mobile']=     Input::get('cmobile_number1');
			$merchant_details['cp1_email']=     Input::get('cemail1');
			$merchant_details['cp2_fname']=     Input::get('cfist_name2');
			$merchant_details['cp2_lname']=     Input::get('clast_name2');
			$merchant_details['cp2_mobile']=     Input::get('cmobile_number2');
			$merchant_details['cp2_email']=     Input::get('cemail2');
			$merchant_details['maker_commnet']=     Input::get('maker_comm');
			$merchant_details['checker_comment']=     Input::get('checker_comm');
			$merchant_details['other_details']=     Input::get('other_details');
			DB::table('merchant_details')->where('merchant_id', $id)->update($merchant_details);
	return Redirect::route('cpanel.merchants.index')
	->with('success','Merchant updated');
	}

          
    }

    
   
    public function putActivate($id)
    {
	if(isset($id)&&$id<>''){
	$update = array('activated'=>1,'status'=>1);
	DB::table('users')->where('id', $id)->update( $update);
	return Redirect::route('cpanel.merchants.index')->with('success','Enterprise Activated');
	}else{
	return Redirect::route('cpanel.clients.index')
	->with('danger', 'Requested Enterprise not found');
	} 
    }
   

    public function putDeactivate($id)
    {   if(isset($id)&&$id<>''){
	$update = array('activated'=>0,'status'=>0);
	DB::table('users')->where('id', $id)->update( $update);
	return Redirect::route('cpanel.merchants.index')
	->with('success','Merchants Deactivated');
	}else{
	return Redirect::route('cpanel.merchants.index')
	->with('danger', 'Requested Merchant Not Found');
	}
    }

    /*public function destroy($id)
    {
	$merchant = Merchant::find($id);
	if(isset($merchant)&&$merchant<>''){
	$merchant->delete();
	return Redirect::route('cpanel.merchants.index')
	->with('success','Merchant deleted');
	}else{
	return Redirect::route('cpanel.merchants.index')
	->with('danger', 'Requested merchant not found');
	}
    }*/
    

}
