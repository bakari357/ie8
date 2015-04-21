<?php

return array(
    		 'staging'=>array(
					'source_id' => 'REWSMART',
			   		'url' => 'https://uat.billdesk.com/directpay/MPayment?msg=',
					'component'=>'REW123',
					'prepaid'=>'U03005',
					'prepaid_pay'=>'U03013',
					'payment'=>'U05003',
					'billers'=>'U02001',
				 ),

		'production'=>array(
					'source_id' => 'REWSMART',
					'url' => 'https://uat.billdesk.com/directpay/MPayment?msg=',
					'component'=>'REW123',
					'prepaid'=>'U03005',
					'payment'=>'U05003'
				    ),
				    
		'recon'=>array(
					'server_address' =>'202.140.38.73',
					'server_port' => '22',
					'username' => 'rewftp',
					'password'=>'rewftp'
					
				    ),	
				    
				    
		    'hdfc_flipkart'=>array(
					'store' =>'http://hdfcsmartbuy.store.flipkart.com/'
					
			
		    ),	
				    
				    	    
				    
	   );







