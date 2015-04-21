<?php
class Paymenthelper
{



   public static function payment_process($response)
   {
	
		
		$response['Udf3']=isset($response['Udf3']) ? $response['Udf3'] : '';
				
		switch($response['Udf2'])
		{
		

				
		   case 'PG':
		   case 'EMI':

		        $strResponseIPAdd = $_SERVER['REMOTE_ADDR'];

	$pg_setup=Checkouthelper::pg_keys($response['Udf2'],$response['Udf3'],$response['active']);			

	
			(string)$ResErrorText= isset($response['ResErrorText']) ? $response['ResErrorText'] : ''; //Error Text/message
			(int)$ResPaymentId = isset($response['ResPaymentId']) ? $response['ResPaymentId'] : '';	//Payment Id
			(int)$ResTrackID = isset($response['ResTrackId']) ? $response['ResTrackId'] : '';        //Merchant Track ID
			(int)$ResErrorNo = isset($response['ResErrorNo']) ? $response['ResErrorNo'] : '';            //Error Number

			//To collect transaction result
			(string)$ResResult = isset($response['ResResult']) ? $response['ResResult'] : '';           //Transaction Result
			$ResPosdate = isset($response['ResPosdate']) ? $response['ResPosdate'] : '';      //Postdate
			//To collect Payment Gateway Transaction ID, this value will be used in dual verification request
			(int)$ResTranId = isset($response['ResTranId']) ? $response['ResTranId'] : '';           //Transaction ID
			(int)$ResAuth = isset($response['ResAuth']) ? $response['ResAuth'] : '';                 //Auth Code		
			$ResAVR = isset($response['ResAVR']) ? $response['ResAVR'] : '';                    //TRANSACTION avr					
			(int)$ResRef = isset($response['ResRef']) ? $response['ResRef'] : '';                    //Reference Number also called Seq Number
			(string)$Resudf5=isset($response['Udf5']) ? $response['Udf5'] : ''; 
			//To collect amount from response
			(int)$ResAmount = isset($response['ResAmount']) ? $response['ResAmount'] : '';  
			/* Check whether the IP Address from where response is received is PG IP */
		/*if($strResponseIPAdd == "221.134.101.175" || $strResponseIPAdd == "221.134.101.187" || $strResponseIPAdd == "221.134.101.169")
		{*/
			if(isset($ResTranId) && $ResTranId<>'')
			{
				 /*******************HASHING CODE LOGIC START************************************/
					/*IMP NOTE: For Hashing below listed parameters have been used. In case merchant develops 
					his/her own pages, merchant to 		make note of these parameters to ensure hashing 
					logic remains same.
					Tranportal ID, TrackID, Amount, Result, Payment ID, Reference Number, Auth Code, Transaction ID 
				
					If any Hashing parameters is null of blank then merchant need to exclude those parameters 
					from hashing*/					
									
					/*
					USE Tranportal ID FIELD as one parameter for hashing.
					Tranportal ID is a sensitive parameter, Merchant can store the Tranportal ID field in 
					database as well in page as config value. We recommend merchant storing this parameter 
					in database and then calling from database.
					*/
					$strHashTraportalID=trim($pg_setup['tid']); //USE Tranportal ID FIELD FOR HASHING ,Mercahnt need to take this filed value  from his Secure channel such as DATABASE.
					//$strhashstring="";            //Declaration of Hashing String 
					
					$strhashstring=trim($strHashTraportalID);
					
					//Below code creates the Hashing String also it will check NULL and Blank parmeters and exclude from the hashing string
					if ($ResTrackID != '' && $ResTrackID != null )
					$strhashstring=trim($strhashstring).trim($ResTrackID);					
					if ($ResAmount != '' && $ResAmount != null )
					$strhashstring=trim($strhashstring).trim($ResAmount);					
					if ($ResResult != '' && $ResResult != null )
					$strhashstring=trim($strhashstring).trim($ResResult);					
					if ($ResPaymentId != '' && $ResPaymentId != null )
					$strhashstring=trim($strhashstring).trim($ResPaymentId);					
					if ($ResRef != '' && $ResRef != null )
					$strhashstring=trim($strhashstring).trim($ResRef);					
					if ($ResAuth != '' && $ResAuth != null )
					$strhashstring=trim($strhashstring).trim($ResAuth);					
					if ($ResTranId != '' && $ResTranId != null )
					$strhashstring=trim($strhashstring).trim($ResTranId);					
										
			//Use sha256 method which is defined below for Hashing ,It will return Hashed valued of above strin				
				$hashvalue= hash('sha256', $strhashstring); 
				Log::info('smartbuy|PG_response|'.$strhashstring.'|'.$hashvalue);
								
				
			//$phashed = DB::table('pg_hash_verfy')->insertGetId(array("hash"=>$hashvalue,'udf5'=>$Resudf5));
					
					
					/*******************HASHING CODE LOGIC END************************************/
				if ($hashvalue == $Resudf5)
					{

						if ($ResResult== 'CAPTURED' || $ResResult == 'APPROVED' || $ResResult == 'SUCCESS')
						{
								  
							//Collect DUAL VERIFICATION RESULT
		
							$INQResResult = $ResResult;//It will give DualInquiry Result 
							$INQResAmount = $ResAmount;//It will give Amount
							$INQResTrackId = $ResTrackID;//It will give TrackID ENROLLED
							$INQResPayid = $ResPaymentId;//It will give payid
							$INQResRef = $ResRef;//It will give Ref.NO.
							$INQResTranid = $ResTranId;//It will give tranid
							//MERCHANT CAN GET ALL VERIFICATION RESULT PARAMETERS USING BELOW CODE 

							  
						} 


					    }

					else
					{
						Log::info('smartbuy|PG_response|Hashing Response Mismatch'.$hashvalue.'|'.$Resudf5);
						$INQResResult='Declined';
						$INQCheck='Hashing Response Mismatch';
						$INQResAmount = $ResAmount;//It will give Amount
						$INQResTrackId = $ResTrackID;//It will give TrackID ENROLLED
						$INQResPayid = $ResPaymentId;//It will give payid
						$INQResRef = $ResRef;//It will give Ref.NO.
						$INQResTranid = $ResTranId;//It will give tranid
						//MERCHANT CAN GET ALL VERIFICATION RESULT PARAMETERS USING BELOW CODE 
						$cap_response=array(
						       'ResResult'=>'Cancelled',
						       'ResTrackId'=>$INQResTrackId,
						       'ResAmount ' =>$INQResAmount,
						       'ResPaymentId'=>$INQResPayid,
						       'ResRef'=>$INQResRef,
						       'ResTranId'=>$INQResTranid,
						       'ResError'=>'Hashing Response Mismatch'
						     );

						$up_response['response2']=json_encode($cap_response);

					      $res=DB::table('pg_response')->where('order_id',$INQResTrackId)->update($up_response);

						



					}
			}
			
					else
					{
						$INQResAmount = $ResAmount;//It will give Amount
						$INQResTrackId = $ResTrackID;//It will give TrackID ENROLLED
						$INQResPayid = $ResPaymentId;//It will give payid
						$INQResRef = $ResRef;//It will give Ref.NO.
						//MERCHANT CAN GET ALL VERIFICATION RESULT PARAMETERS USING BELOW CODE 

						if(isset($response['ResError'])&& $response['ResError']<>'')
						$INQCheck=$response['ResError'];
						else
						$INQCheck=$response['Message'];

						$cap_response=array(
								       'ResResult'=>'Cancelled',
								       'ResTrackId'=>$INQResTrackId,
								       'ResAmount ' =>$INQResAmount,
								       'ResPaymentId'=>$ResPaymentId,
								       'ResRef'=>$INQResRef,
								       'ResError'=>'ResTranId Missing'
						     		   );

						$up_response['response2']=json_encode($cap_response);
						$res=DB::table('pg_response')->where('order_id',$INQResTrackId)->update($up_response);
					}

			/*}

			else
			{
						$INQResResult='Declined';
						$INQCheck='IP Mismatch';
						$INQResAmount = $ResAmount;//It will give Amount
						$INQResTrackId = $ResTrackID;//It will give TrackID ENROLLED
						$INQResPayid = $ResPaymentId;//It will give payid
						$INQResRef = $ResRef;//It will give Ref.NO.
						$INQResTranid = $ResTranId;//It will give tranid
						//MERCHANT CAN GET ALL VERIFICATION RESULT PARAMETERS USING BELOW CODE 
						$cap_response=array(
						       'ResResult'=>'Cancelled',
						       'ResTrackId'=>$INQResTrackId,
						       'ResAmount ' =>$INQResPayid,
						       'ResPaymentId'=>$INQResPayid,
						       'ResRef'=>$INQResRef,
						       'ResTranId'=>$INQResTranid,
						       'ResError'=>'IP Mismatch'
						     );

					$up_response['response2']=json_encode($cap_response);

					$res=DB::table('pg_response')->where('order_id',$INQResTrackId)->update($up_response);	
			}	*/	
					
					

			$data['pmethod']= 'hdfc';

 if (isset($INQResResult) && ($INQResResult == 'CAPTURED' || $INQResResult == 'APPROVED' || $INQResResult == 'SUCCESS') && $INQResTrackId<>'')
			{
				$data['reason'] =$INQResResult;
				$status='Approved';
			}
			else if(isset($INQResResult) && $INQResResult == 'CANCELED' && $INQResTrackId<>'')
			{
				//$status=$INQResResult;
				$status='Declined';
				$data['reason'] =$INQCheck;
			}
			else if(!isset($INQResResult) && $ResResult == 'CANCELED' && isset($ResTrackID) && $ResTrackID<>'')
			{
				//$status=ucfirst($ResResult);
				$status='Declined';
				$data['reason'] ='Transaction Canceled.';
			}
			else
			{
				$data['reason']=isset($INQCheck)? $INQCheck:'' ;
				$status='Declined';
			}

			
			$data['ResRef']=$ResRef;

			$data['customer'] 			= 1;
			if(isset($INQResTrackId) &&  $INQResTrackId<>'')
			$data['order_id']			= (string)$INQResTrackId;
			else
			$data['order_id']			=(string)$response['ResTrackId'];


			$data['status']  			= ucfirst(strtolower((string)$status));
			$data['hide_menu']			= true;
			if(isset($INQResTrackId) && $INQResTrackId<>'')
			$data['ResTrackId']			= $INQResTrackId;
			if(isset($GET['ResTrackId']))
			$data['ResTrackId']			= (string)$response['ResTrackId'];
			if(isset($INQResPayid))
			$data['ResPaymentId']			= (string)$INQResPayid;
			if(isset($INQResRef))
			$data['ResRef']			= (string)$INQResRef;
			if(isset($INQResTranid))
			$data['transresponseid']		= $INQResTranid;
			else
			$data['transresponseid']='';

			if(isset($response['ResError']))
			$data['ResError']			= $response['ResError'];
			break;



			case 'NB':

			$data['ResRef']=$response['ResTrackId'];
			$data['customer']= 1;
			if($response['Message']=='Transaction Successful')
			$data['status']='Approved';
			else
			if($response['Message']=='Transaction Declined')
			$data['status']='Declined';
			break;


		}

		return $data;


    }

}
