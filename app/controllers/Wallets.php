<?php 
class Wallets extends AdminBaseController {
protected $wallets;

   public function index()
     {
	 $wallets = Wallet::paginate( Config::get('15'));
       // $wallets=Wallet::where('role_id', '=', '3')->where('sub_user','<>',1)->get();
	return $this->load_admin_theme('wallets','index',array('wallets'=>$wallets));      
     }

    public function show($id)
    {
	$partner =Partner::find($id);
	if(isset($partner)&&$partner<>''){
	return $this->load_admin_theme('partners','show',array('partner'=>$partner)); 
	}else{
	return Redirect::route('cpanel.partners.index')
	->with('danger', 'Requested partner not found');
	     }
    }


    public function create(){
        $states = DB::table('states')->where('country_code', 'IN')->get();
	$cities  = DB::table('cities')->where('country_code', 'IN')->get();
        $images = array();
	return $this->load_admin_theme('wallets','create',array('images'=>$images,'states'=>$states,'cities'=>$cities)); 
    }
 

  public function edit($id)
    {
         $data['states'] = DB::table('states')->where('country_code', 'IN')->get();
           $data['cities']  = DB::table('cities')->where('country_code', 'IN')->get();
	$partner =Partner::find($id);
        $data['partner']=$partner;
         $partnerdetails = DB::table('partner_details')->where('partner_id',$id)->get();
             foreach($partnerdetails as $partners) { $data['partners']=$partners;}         
          if(isset($partner)&&$partner<>''){
	return $this->load_admin_theme('partners','edit',$data); 
	}else{
	return Redirect::route('cpanel.partners.index')
	->with('danger', 'Requested partner not found');
	}
       
    }

   public function store() 
    {  
      echo'<pre>'; print_r($_POST); exit;
 	 $rules=array();
         $rules['min_balance'] = 'required|numeric';
         $rules['max_balance'] = 'required|numeric';
         $rules['max_recharge'] = 'required|numeric';
         $rules['max_recharge'] = 'required|numeric';
       
        
	 $validator = Validator::make(Input::all(), $rules);
          	if ($validator->fails())
		  {
			return Redirect::route('cpanel.wallets.create')
			->withInput()
			->withErrors($validator->messages());
		  }else{
			
			
			$wallet_id = DB::table('wallet_settings')->insertGetId(array(
                        
			'wallet_status'          =>   Input::get('wallet_status'),
			'wallet_type'            =>   Input::get('wallet_type'),
                        'min_balance'            =>   Input::get('min_balance'),
			'max_balance'            =>   Input::get('max_balance'),
			//'allowed_balance'      =>   Input::get('user_code'),
			'max_recharge_amount'    =>   Input::get('max_recharge'),
			'min_recharge_amount'    =>   Input::get('min_recharge'),
			'recharge_mode'          =>   Input::get('rech_mode'),
			'recharge_fee'           =>   Input::get('rech_fee'),
                        'recharge_st'            =>   Input::get('rech_st'), 
			'service_charge'         =>   Input::get('service'), 
			'over_draft_limit'       =>   Input::get('crd_limit'), 
                        'over_draft_duration'    =>  Input::get('crd_duration'), 
			'discount_type'          =>   Input::get('discount'), 
                        'discount_regular_basis' =>   Input::get('discount_mode'), 
                       // 'other_details'          =>   Input::get('service'), 
                        'threshold_limit'        =>  Input::get('threshold'), 
                        'created_on'             =>   date('Y-m-d H:i:s'),
                        'pp_currency_ratio'     =>  Input::get('pp_currency'), 
                    
			'maker_comment'  =>  Input::get('maker_comment'), 
			'checker_comment'=>  Input::get('checker_comment'), 
			'details'  =>  Input::get('Details'), 
                        ));
                        
                        $wallet['wallet_id']     = $wallet_id;
                        DB::table('wallet_settings')->where('id',$wallet_id)->update($wallet);
                             
			return Redirect::route('cpanel.wallets.index')
			->with('success','Wallets created');
			}
  }

    public function update($id)
    {
		$rules=array();
		$rules['name'] = 'required|min:3|max:30';
		$rules['email'] = 'required|email|unique:users,email,'.$id.'';
		$rules['landline'] = 'required|numeric';
		$rules['user_code'] = 'required';
		$rules['vat'] = 'required|max:20';
		$rules['st_number'] = 'required|max:20';
		$rules['tin_number'] = 'required|max:20';
		$rules['pan'] = 'required|max:12';
     		// if($_POST['password']<>''){
     		// $rules['password'] = 'required|min:6|confirmed'; }
     		// $messages = array('password.confirmed' => 'Password does not matches');
     		 $validator = Validator::make(Input::all(), $rules);
	         $validator = Validator::make(Input::all(), $rules);
	    if ($validator->fails())
	    {
		     return Redirect::back()
		     ->withInput()
		    ->withErrors($validator->messages());
	    }else{
			//$partner = user::find($id);

                $partner['name'] = Input::get('name');
                $partner['email'] = Input::get('email');
                $partner['landline'] = Input::get('landline');
                $partner['user_code'] = Input::get('user_code');
                $partner['vat'] = Input::get('vat');
                $partner['st_number'] = Input::get('st_number');
                $partner['tin_number'] = Input::get('tin_number');
                $partner['pan'] = Input::get('pan');
                $partner['first_name'] = Input::get('first_name');
                $partner['last_name'] = Input::get('last_name');
                $partner['approved_by'] = Input::get('approved_by');
                $partner['last_login'] = date('Y-m-d H:i:s');
                $partner['updated_at'] = date('Y-m-d H:i:s');       
                DB::table('users')->where('id',$id)->update($partner);

                $partner_details['address1']       =  Input::get('address1');
		$partner_details['address2']       =  Input::get('address2');
		$partner_details['city']           =  Input::get('city');
		$partner_details['state']         =  Input::get('state');
		$partner_details['pincode']        =  Input::get('pincode');
		$partner_details['country']        =  Input::get('country');
		$partner_details['cp1_fname']      =  Input::get('cp1_fname');
		$partner_details['cp1_lname']      =  Input::get('cp1_lname'); 
		$partner_details['cp1_mobile']     =  Input::get('cp1_mobile');
		$partner_details['cp1_landline']   =  Input::get('cp1_landline'); 
		$partner_details['cp1_email']      =  Input::get('cp1_email');
		$partner_details['cp2_fname']      =  Input::get('cp2_fname');
		$partner_details['cp2_lname']      =  Input::get('cp2_lname');
		$partner_details['cp2_mobile']     =  Input::get('cp2_mobile');
		$partner_details['cp2_landline']   =  Input::get('cp2_landline');
                $partner_details['cp2_email']      =  Input::get('cp2_email');
		$partner_details['maker_comment']  =  Input::get('maker_comment'); 
		$partner_details['checker_comment']=  Input::get('checker_comment'); 
		$partner_details['other_details']  =  Input::get('other_details'); 
                DB::table('partner_details')->where('partner_id',$id)->update($partner_details);



/* if($_POST['password']<>''){
                        $partner->password= sha1(Input::get('password'));
                         }
	                $partner->save(); */
			return Redirect::route('cpanel.partners.index')
			->with('success','users updated');
                 }

          
    }

    public function destroy($id)
    {
	$client = Partner::find($id);
	if(isset($client)&&$client<>''){
	$client->delete();
	return Redirect::route('cpanel.partners.index')
	->with('success','Partners deleted');
	}else{
	return Redirect::route('cpanel.partners.index')
	->with('danger', 'Requested client not found');
	}
    }


    public function putDeactivate($id)
    {
	$client = Partner::find($id);
	if(isset($client)&&$client<>''){
	$client->active=   0;
	$client->save();
	return Redirect::route('cpanel.partners.index')
	->with('success','Partners deactive');
	}else{
	return Redirect::route('cpanel.partners.index')
	->with('danger', 'Requested client not found');
	}
    }


    public function putActivate($id)
    {
	$client = Partner::find($id);
	if(isset($client)&&$client<>''){
	$client->active=   1;
	$client->save();
	return Redirect::route('cpanel.partners.index')
	->with('success','Partners active');
	}else{
	return Redirect::route('cpanel.partners.index')
	->with('danger', 'Requested client not found');
	} 

    }

}
