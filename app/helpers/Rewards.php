<?php 
   //Rewards helper functions
class Rewards {

  
	public static function custom_url()
	{
	return 'http://erp.rewards360.in//resources/product/original/';
	}



	public static function rewards_url()
	{

	return 'http://admin1.rewardengine.in/uploads/images/full/';
	}


	public static function getExtension($filename)
	{
	$dot = substr (strrchr ($filename, "."), 1);
	return $dot;
	}
      
      
        public static function points_escalator($points,$customerpoints)
        {
                $out='<script src="http://yui.yahooapis.com/3.8.0/build/yui/yui-min.js"></script>

                <style>
                #demo {
                margin:0 0 1em;
                }
                .yui3-dial-label-string {
                display:none !important;
                }
                .yui3-dial-value-string{
                margin-left:45px !important;
                }
                #myTextInput {
                width:96px;
                }
                </style>
                <div id="demo"></div><div id="err"  style="color:red;display:none;">Exceeds Points value </div>

                        <script>
                        YUI().use(\'dial\', function(Y) {

                        $("#err").hide();
                        var cash ='.$points.';
                        var points='.Currency::get_onlycurrency_value(Currency::point_to_case($points)).';
                        var variation='.Currency::get_onlycurrency_value(Currency::point_to_case($points)).'/100;
                        var cpoints='.$customerpoints.';
                        var cashvalue='.Currency::get_cash_value().';
                        var dial = new Y.Dial({
                        min:0,
                        max:100,
                        stepsPerRevolution:100,
                        value: 0
                        });
                        dial.render(\'#demo\');


                        // Function to update the text input value from the Dial value
                        function updateInput( e )
                        {
                                var val = e.newVal;
                                if ( isNaN( val ) ) 
                                {
                                // Not a valid number.
                                return;
                                }
                                var n=points-(val*variation);
                                this.set( "value", Math.round(n ));
                                if(n>=0 && n > cpoints){
                                $("#err").css(\'display\',\'block\');
                                }
                                else
                                {
                                $("#err").css(\'display\',\'none\');
                                }
                        }

                        function updateCash( e )
                        {
                                var val = e.newVal;
                                if ( isNaN( val ) ) {
                                // Not a valid number.
                                return;
                                }
                                var n=points-(val*variation);
                                this.set( "value", Math.round(n ));
                                k= (Math.round(n ));

                                newvl= cash- (k*cashvalue);

                                //newvl=(val*variation);
                                if ( isNaN( newvl ) ) {
                                // Not a valid number.
                                return;
                                }
                                if(newvl>=0){
                                        if(newvl<(cashvalue/2))
                                        {
                                        var new1=0;
                                        this.set( "value", Math.round((new1)) );
                                        $("#customerpoints1").val((new1)/cashvalue);
                                        }
                                        else {
                                        this.set( "value", Math.round((newvl)) );
                                        $("#customerpoints1").val(((newvl)/cashvalue));
                                        }
                                }
                                else
                                {
                                $("#customerpoints1").val(Math.round(0));
                                this.set( "value", \'0\' );
                                }
                        }


                        var theInput = Y.one( "#myTextInput" );
                        var customerpoints = Y.one( "#customerpoints" );
                        var customerpoints1 = Y.one( "#customerpoints1" );
                        // Subscribe to the Dial\'\s valueChange event, passing the input as the \'this\'
                        dial.on( "valueChange", updateInput, theInput );

                        // Function to pass input value back to the Slider
                        function updateDial( e )
                        {
                                dial.set( "value" , e.target.get( "value" ) - 0);
                        }
                        theInput.on( "keyup", updateDialnew );

                        // Initialize the input
                        //theInput.set(\'value\', dial.get(\'value\'));
                        dial.on( "valueChange", updateCash, customerpoints );

                        // Function to pass input value back to the Slider
                        function updateDialnew( e )
                        {

                                var dialvalue=e.target.get( "value" );
                                var newvalue=points-e.target.get( "value" );
                                if(dialvalue < cpoints) {

                                if(parseInt(newvalue) >= 0 && parseInt(newvalue) <= parseInt(points) ){
                                customerpoints.set(\'value\', Math.round(newvalue*cashvalue));

                                $("#customerpoints1").val(Math.round(newvalue));
                                $("#err").css(\'display\',\'none\'); 
                                var newdial= (newvalue*100)/points;
                                dial.set( "value" , (newdial) - 0);
                                $("#err").css(\'display\',\'none\');
                                }
                                else
                                {
                                $("#customerpoints1").val(Math.round(0));
                                customerpoints.set(\'value\',0);
                                customerpoints1.set(\'value\',0);
                                dial.set( "value" , 0 - 0);
                                $("#err").css(\'display\',\'block\'); ;
                                }
                                $("#err").css(\'display\',\'none\'); 
                                }
                                else
                                {
                                $("#customerpoints1").val(Math.round(0));
                                customerpoints.set(\'value\',0);
                                customerpoints1.set(\'value\',0);
                                dial.set( "value" , 0 - 0);
                                $("#err").css(\'display\',\'block\'); 
                                } 
                        }
                        //customerpoints.on( "keyup", updateDial );

                        // Initialize the input
                        //customerpoints.set(\'value\', dial.get(\'value\'));
                        dial.set( "value" , 0 - 0);


                        });


                        </script>
                <!-- End of yui jquery -->';
                echo $out;
        }
        
        
      public static function get_cat_by_product($id)
        {
	        $cats= DB::table('category_products')->where('product_id',$id)->get();
	        return json_decode(json_encode((array)$cats),true);
        }
        
      public static function points_escalator_cart($points,$cpoints,$cash,$customerpoints)
        {
                $out='<script src="http://yui.yahooapis.com/3.8.0/build/yui/yui-min.js"></script>

                <style>
                #demo {
                margin:0 0 1em;
                }
                .yui3-dial-label-string {
                display:none !important;
                }
                .yui3-dial-value-string{
                margin-left:45px !important;
                }
                #myTextInput {
                width:96px;
                }
                </style>
                <div id="demo"></div><div id="err"  style="color:red;display:none;">Exceeds Points value </div>

                        <script>
                        YUI().use(\'dial\', function(Y) {

                        $("#err").hide();
                        var points='.Currency::get_onlycurrency_value(($points)).';
                        var variation='.Currency::get_onlycurrency_value(($points)).'/100;
                        var cpoints='.$customerpoints.';
                        var mycash='.$cpoints.';
                        var cashvalue='.Currency::get_cash_value().';
                        var customcash='.$cash.';
                        var dial = new Y.Dial({
                        min:0,
                        max:100,
                        stepsPerRevolution:100,
                        value: 0
                        });
                        
                        dial.render(\'#demo\');
                        var dialpointer=(points-mycash)/variation;
                        
                        //console.log(dialpointer);
                       // console.log(points);
                       // console.log(variation);
                        // Function to update the text input value from the Dial value
                        function updateInput( e )
                        {
                                var val = e.newVal;
                                if ( isNaN( val ) ) 
                                {
                                // Not a valid number.
                                return;
                                }
                               //  console.log(val);
                                var n=(points-(val*variation));
                                this.set( "value", Math.round(n));
                                if(n>=0 && n > cpoints){
                                $("#err").css(\'display\',\'block\');
                                }
                                else
                                {
                                $("#err").css(\'display\',\'none\');
                                }
                        }

                        function updateCash( e )
                        {
                                 //$("#checkdial").val(1);
                                var val = e.newVal;
                                if ( isNaN( val ) ) {
                                // Not a valid number.
                                return;
                                }
                                var n=points-(val*variation);
                               // this.set( "value", Math.round(n ));
                                k= (Math.round(n ));
                                newvl= points- (k);
                                //newvl=(val*variation);
                                if ( isNaN( newvl ) ) {
                                // Not a valid number.
                                return;
                                }
                                if(newvl>=0){
                                        if(newvl<(cashvalue/2))
                                        {
                                        var new1=0;
                                        this.set( "value", Math.round((new1)) );
                                        $("#customerpoints1").val((new1));
                                        }
                                        else {
                                        this.set( "value", Math.round((newvl*cashvalue)) );
                                        $("#customerpoints1").val(((newvl)/cashvalue));
                                        }
                                }
                                else
                                {
                                $("#customerpoints1").val(Math.round(0));
                                this.set( "value", \'0\' );
                                }
                        }


                        var theInput = Y.one( "#myTextInput" );
                        var customerpoints = Y.one( "#customerpoints" );
                        var customerpoints1 = Y.one( "#customerpoints1" );
                        // Subscribe to the Dial\'\s valueChange event, passing the input as the \'this\'
                        dial.on( "valueChange", updateInput, theInput );

                        // Function to pass input value back to the Slider
                        function updateDial( e )
                        {
                                dial.set( "value" , e.target.get( "value" ) - 0);
                        }
                        theInput.on( "keyup", updateDialnew );

                        // Initialize the input
                        //theInput.set(\'value\', dial.get(\'value\'));
                        dial.on( "valueChange", updateCash, customerpoints );

                        // Function to pass input value back to the Slider
                        function updateDialnew( e )
                        {
                                //$("#checkdial").val(1);
                                var dialvalue=e.target.get( "value" );
                                var newvalue=points-e.target.get( "value" );
                                
                               // console.log(dialvalue);
                               // console.log(newvalue);
                                // console.log(points);
                                
                                if(dialvalue < cpoints) {

                                if(parseInt(newvalue) >= 0 && parseInt(newvalue) <= parseInt(points) ){
                                customerpoints.set(\'value\', Math.round(newvalue*cashvalue));

                                $("#customerpoints1").val(Math.round(newvalue));
                                $("#err").css(\'display\',\'none\'); 
                                var newdial= (newvalue*100)/points;
                                dial.set( "value" , (newdial) - 0);
                                $("#err").css(\'display\',\'none\');
                                }
                                else
                                {
                                $("#customerpoints1").val(Math.round(0));
                                customerpoints.set(\'value\',0);
                                customerpoints1.set(\'value\',0);
                                dial.set( "value" , 0 - 0);
                                $("#err").css(\'display\',\'block\'); ;
                                }
                                $("#err").css(\'display\',\'none\'); 
                                }
                                else
                                {
                                $("#customerpoints1").val(Math.round(0));
                                customerpoints.set(\'value\',0);
                                customerpoints1.set(\'value\',0);
                                dial.set( "value" , 0 - 0);
                                $("#err").css(\'display\',\'block\'); 
                                } 
                        }
                        //customerpoints.on( "keyup", updateDial );

                        // Initialize the input
                        //customerpoints.set(\'value\', dial.get(\'value\'));
                        dial.set( "value" , dialpointer- 0);


                        });


                        </script>
                <!-- End of yui jquery -->';
                echo $out;
        }
        
        public static function redirect_helper($url){
        
				if(isset($_POST) && !empty($_POST)){
					$refer['key'] = Checkoutmodel::checkout_referal($_POST);
					$refer['refer'] = $url; 	// Rirect root
					Session::put('for_redirect',$refer );
					$data = $_POST; 
					$data['validation'] ='';
				}
				
				else {
					$key = Session::get('for_redirect'); 
					$values = Checkoutmodel::get_referalvalue($key['key']);
					if(isset($values->referal))
					$data = (array)json_decode($values->referal); 
					
					$data['validation'] = @$key['error']; 
				}
				
        return $data; 
        }
        
        public static function login_redirect($url){
        
        			$urlsplit = explode('/',$url); 
        			unset($urlsplit[0]);
        			unset($urlsplit[1]);
        			unset($urlsplit[2]);
        			unset($urlsplit[3]);
        			unset($urlsplit[4]);
        			
        			// Routes to be avoided 
        			$redirect_array = array();
        			$redirect_array[] = 'songlist'; 
        			$redirect_array[] = 'securelogin'; 
        			$redirect_array[] = 'poplogin';
        			$redirect_array[] = 'logout'; 
        			$redirect_array[] = 'signup'; 
        			$redirect_array[] = 'forgot_password'; 
        			$redirect_array[] = 'redirections'; 
        			$redirect_array[] = 'funcinemas'; 
        			$redirect_array[] = 'cinepolis'; 
        			
        			$dual_check = Session::get('login_redirect');
        			//Routes to be avoided ends here
        			$continue = 0; 
        			if(isset($_POST) && isset($dual_check['key']) && json_encode($_POST) <> $dual_check['key']){	
        			$continue = 1; 

        			}
        			 //Check for redirecting again
        			
        			if(isset($urlsplit[5]) &&  !in_array($urlsplit[5], $redirect_array) && $continue==1){
        				
        			$url = implode('/',$urlsplit); 
					$refer = array(); 
        			$refer['url'] = $url;
					$refer['method'] = 'to';
					
				if(isset($_POST) && !empty($_POST)){
					$refer['key'] = json_encode($_POST);
					$refer['method'] = 'action';
				}

				Session::put('login_redirect',$refer );
				}
        }
        
         public static function get_values($check){
          $data = Session::get('login_redirect');
    	  // print_r($data); exit;
     		  if($data['url'] == $check){
    		  $post = (array)json_decode($data['key']); 
    		 	
   			    }else{
    		   $post=$_POST;
    		   }
        	return $post; 
        	}	
      public static function store_mdr($oid,$partner_id,$custom_cash){
     	$mdr=DB::table('mdr_percent')->where('partner_id',$partner_id)->first();
     	if(count($mdr)> 0){
	$save['orderitem_id']=$oid;
	$save['partner_id']=$partner_id;
	$save['partner_mdr']=	round(Rewards::calculator_mdr($mdr->partner_mdr,$custom_cash));
	$save['different_mdr']=	round(Rewards::calculator_mdr($mdr->different_mdr,$custom_cash));
	$save['commission']=	round(Rewards::calculator_mdr($mdr->commission,$custom_cash));
	$save['service_tax']=	round(Rewards::calculator_mdr($mdr->service_tax,$custom_cash));
	$save['amount']=	round($custom_cash);
	$comm_amount= $save['commission']-$save['service_tax'];
	$save['reward_amount']=	round(Rewards::calculator_mdr(65,$comm_amount));
	$save['hdfc_amount']=	round(Rewards::calculator_mdr(35,$comm_amount));
	$save['status']=	'pending';
	$oid=DB::table('orderitems_mdr')->insertGetId($save);
        }
        	}
         public static function calculator_mdr($per,$custom_cash){
          
    	  return $val=($per/100)*$custom_cash;
     	
        	}
		    public static function update_mdr($status,$oid){
			if($status=='Successful' || $status=='Failed'){
			$save['status']=$status;
			DB::table('orderitems_mdr')->where('orderitem_id',$oid)->update($save);
			}else{
			$save['partner_mdr']=	0;
			$save['different_mdr']=	0;
			$save['commission']=	0;
			$save['service_tax']=	0;
			$save['reward_amount']=	0;
			$save['hdfc_amount']=	0;
			$save['status']=	$status;
			DB::table('orderitems_mdr')->where('orderitem_id',$oid)->update($save);
			}
        	}


		/*
		* Method to strip tags globally.
		*/
		public static function globalXssClean()
		{

                    
			// Recursive cleaning for array [] inputs, not just strings.
			$sanitized = static::arrayStripTags(Input::get());
			Input::merge($sanitized);
		}

		public static function arrayStripTags($array)
		{

			
			$result = array();

			foreach ($array as $key => $value) {
			// Don't allow tags on key either, maybe useful for dynamic forms.
			$key = strip_tags($key);

			// If the value is an array, we will just recurse back into the
			// function to keep stripping the tags out of the array,
			// otherwise we will set the stripped value.
			if (is_array($value)) {
			$result[$key] = static::arrayStripTags($value);
			} else {
			// I am using strip_tags(), you may use htmlentities(),
			// also I am doing trim() here, you may remove it, if you wish.
			$result[$key] = trim(strip_tags($value));
			}
			}

			
			return $result;
		}

     
        public static function validation_common(){

        $rules=array();
	$rules=array('first_name' => 'required|regex:/^[a-z\s]+$/i',
	             'last_name'  => 'required|regex:/^[a-z\s]+$/i',
		     's_email'    => 'required|email',
	             'b_mobile'     => 'required|numeric');
	$messages = array(
	            's_email.required' => 'please enter valid email address.',
	            's_email.email' => 'please enter valid email address.',
	            'b_mobile.required' => 'please enter valid mobile number.',
	            'b_mobile.numeric' => 'please enter valid mobile number.', );

        $validator =  Validator::make(Input::all(), $rules,$messages);
        return $validator;

        }
		
     
		
}
