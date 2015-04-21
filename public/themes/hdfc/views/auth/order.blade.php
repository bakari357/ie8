<?php


?>
<script>

</script>
<script type="text/javascript">
function toggleDiv(divId) {

 $("#panel"+divId).slideToggle("fast");
}
</script>
<style type="text/css">
.panel
{
display:none;
}
.table th {
width:500px !important;
}
</style>


<div class="row" style="margin-top:30px;">
	<div class="span12">
	<span class="error" style="width:auto !important;display:none;padding:5px !important;" >Max 3 downloads. You have downloaded maximum number of times.</span>
		<div class="btn-group pull-right">
			<a class="btn btn-primary" href="{{ URL::to('my_order') }}" title="Go Back">Go Back></a>
		</div>
	</div>
</div>
<div class="row">
	<div class="span4">
		<h3 class="acninfo">Account Information</h3>
		<p class="infocontent">
		<?php echo (!empty($order->company))?$order->company.'<br>':'';?>
		<?php echo $order->firstname;?> <?php echo $order->lastname;?> <br/>
		<?php echo $order->email;?> <br/>
		<?php echo $order->phone;?>
		</p>
	</div>
	<div class="span4">
		<h3 class="acninfo">Billing Address</h3>
		<?php echo (!empty($order->bill_company))?$order->bill_company.'<br/>':'';?>
		<?php echo $order->bill_firstname.' '.$order->bill_lastname;?> <br/>
		<?php echo $order->bill_address1;?><br>
		<?php echo (!empty($order->bill_address2))?$order->bill_address2.'<br/>':'';?>
		<?php echo $order->bill_city.', '.$order->bill_zone.' '.$order->bill_zip;?><br/>
		<?php echo $order->bill_country;?><br/>

		<?php echo $order->bill_email;?><br/>
		<?php echo $order->bill_phone;?>
	</div>
	<div class="span4">
		<h3 class="acninfo">Shipping Address</h3>
		<?php echo (!empty($order->ship_company))?$order->ship_company.'<br/>':'';?>
		<?php echo $order->ship_firstname.' '.$order->ship_lastname;?> <br/>
		<?php echo $order->ship_address1;?><br>
		<?php echo (!empty($order->ship_address2))?$order->ship_address2.'<br/>':'';?>
		<?php echo $order->ship_city.', '.$order->ship_zone.' '.$order->ship_zip;?><br/>
		<?php echo $order->ship_country;?><br/>

		<?php echo $order->ship_email;?><br/>
		<?php echo $order->ship_phone;?>
	</div>
</div>

<div class="row" style="margin-top:20px;">
	<div class="span4">
		<h3 class="acninfo">Order details</h3>
		<p class="infocontent">
		<?php if(!empty($order->referral)):?>
			<strong>Referral: </strong><?php echo $order->referral;?><br/>
		<?php endif;?>
		<?php if(!empty($order->is_gift)):?>
			<strong>Gift:</strong>
		<?php endif;?>

		<?php if(!empty($order->gift_message)):?>
			<strong>Gift Note</strong><br/>
			<?php echo $order->gift_message;?>
		<?php endif;?>
		</p>
	</div>
	<div class="span4">
		<h3 class="acninfo">Payment Method</h3>
		<p class="infocontent"><?php echo $order->payment_info; ?></p>
	</div>
	<div class="span4">
		<h3 class="acninfo">Shipping Method</h3>
		<?php if($order->shipping_method==0) echo' No Method';else echo $order->shipping_method;
		 ?>
		<?php if(!empty($order->shipping_notes)):?><div style="margin-top:10px;"><?php echo $order->shipping_notes;?></div><?php endif;?>
	</div>
</div>
<table class="table table-striped">
	<thead>
		<tr>
			<th >Name</th>
			<th >Quantity</th>
			<th>Points Paid</th>
			<th> Cash Paid</th>
			<th >Status</th>
			<th ></th>
		</tr>
	</thead>
	<tbody>
	
<?php $mongo_db_order= Mongomodel::get_order($order->id); 
//echo '<pre>'; print_r($mongo_db_order); exit;
if(($order->contents)) { $i=0;foreach($mongo_db_order as $orderkey=>$mongo):
$product=(array)(json_decode($mongo['contents']));

if(isset($product['apiproduct']) && !empty($product['apiproduct']))

		$quantitynew=$product['quantity'];
		else{
		if(!(bool)$product['fixed_quantity'])
		$quantitynew=$product['quantity'];
		else
		$quantitynew=1;
		}

	$finaldealpoints=$product['custom_point']*$quantitynew;
	$finaldealcash= Currency::cash_ratio($product['custom_cash']*$product['quantity']);
	//echo '<pre>';
	//print_r($product['offer_code']);
	
	if(isset($product['offer_code']))
	$offers=get_offer_by_id($product['offer_code']);
	
	if(!empty($offers))
	{
	        $price = (float) $finaldealpoints;
	        $offerprice = (float) $finaldealpoints + $finaldealcash;
		$total_cash=cash_ratio($product['custom_cash']*$product['quantity']);
		$offerdiscounts=calculate_discount($offers,$offerprice);
		$points=$offerdiscounts['offerpoints'];
		$discount_amount=$offerdiscounts['discount'];
		
		                if($price<$discount_amount)
		                 $finaldeal= $discount_amount-$price;
		                 else
	                        $finaldeal= $price-$discount_amount;
	                        if($total_cash<$discount_amount)
		                 $finalcash= $discount_amount-$total_cash;
		                 else
	                        $finalcash= $total_cash-$discount_amount;
	                        if($discount_amount>0){
				if($price==0)
				{
				$finaldealpoints=0;
				if($finalcash<=0)
				$finaldealcash=0;
				else
				$finaldealcash=$finalcash;
				
				}
				else if($total_cash==0)
				{
				if($finaldeal<=0)
				$finaldealpoints=0;
				else
				$finaldealpoints=$finaldeal;
				
				$finaldealcash=0; 
				}
				else if($price<$total_cash)
				{
				$finaldealpoints=$finaldeal;
				$finaldealcash=$total_cash - $finaldeal; 
				}
				else
				{
				$finaldealpoints=$finaldeal;
				$finaldealcash=$total_cash; 
				}
				}
				else
				{
				$finaldealpoints=$finaldeal;
				$finaldealcash=$total_cash; 
				}
		
		
		
		
	}
	//echo '<br />';
	//echo $finaldealcash; echo '<br />';
	//echo $finaldealpoints;
	//print_r($offerdiscounts);
	//echo '</pre>';
	
?>
<tr>
<td>
        <div id="flip">	<a href="javascript:toggleDiv(<?php echo $i;?>);"><?php echo $product['name'];?></a>
        <?php echo (trim($product['sku']) != '')?'<br/><small>'.'sku'.': '.$product['sku'].'</small>':'';?></div>
   <?php //echo '<pre>'; print_r($product['apiproduct']->API_Type); exit;
  /* echo "Recharge Type ".  $product['apiproduct']->Posted->rtype."<br/>" ;
    echo "operator ".  $product['apiproduct']->Posted->operator."<br/>" ;
     echo "circle ".  $product['apiproduct']->Posted->circlevalue."<br/>" ;
      echo "Amount ".  $product['apiproduct']->Posted->amount."<br/>" ;
          echo "ttype ".      $product['apiproduct']->Posted->ttype."<br/>";
   exit;*/
   
    ?>
        <?php if(isset($product['apiproduct'])) { 
     
         ?>
        <?php if(strtolower(str_replace(' ','',$product['apiproduct']->API_Type))=="myoxigen") 
        {      ?>
                <div id="panel<?php echo $i; ?>" class="panel">
                <?php echo "</br>"."Recharge Type - ".$product['apiproduct']->Posted->rtype."</br>"."Operator Type - ".$product['apiproduct']->Posted->operator."</br>"."Circle - ".$product['apiproduct']->Posted->circlevalue."</br>"."Amount - ".$product['apiproduct']->Posted->amount."</br>"."Transaction Type - " .$product['apiproduct']->Posted->ttype; ?>
                </div>
        <?php } 
        elseif (strtolower(str_replace(' ','',$product['apiproduct']->API_Type))=="savaari") { ?>
                <div id="panel<?php echo $i; ?>" class="panel">
                <?php echo "<br />".$product['item']."</br>"."SKU ID - ".$product['apiproduct']->Posted->sku."</br>"."Car Type - ".$product['apiproduct']->Posted->cartype."</br>"."Start Date - ".date('d F, Y',strtotime($product['apiproduct']['Posted']['start']))."</br>"."End Date - ".date('d F, Y',strtotime($product['apiproduct']->Posted->end))."</br>"."City - ".$product['apiproduct']->Posted->city; ?>
                </div>
        <?php } 
        elseif (strtolower(str_replace(' ','',$product['apiproduct']->API_Type))=="yatra") { ?>

        <div id="panel<?php echo $i; ?>" class="panel" >
        <?php include('yatra_details.php'); ?>
        </div>
        <?php } 
        elseif (strtolower(str_replace(' ','',$product['apiproduct']->API_Type))=="hungama")  {
        $exprod=$this->Order_model->get_exproduct($product['apiproduct']['api_pid']);
                if(!empty($exprod))
                {
                $resu=json_decode($exprod['output']);
                $res=json_decode($exprod['input']);
                $r=toArray($resu);
                if(isset($resu->Output->result->response->code) && $resu->Output->result->response->code==1)
                {
                $musiclink=$resu->Output->result->response->url;
                $muorid=$r['Output']['order']['response']['order_id'];
                }
                else{
                $musiclink='';
                $muorid='';
                }
                }
                else
                {
                $musiclink='';
                $muorid='';
                }
        ?>
        <div id="panel<?php echo $i; ?>" class="panel" >
                <?php echo"SKU ID - ".$product['apiproduct']['Posted']['sku']."</br>"."<b>Description</b> - ".$product['description']."</br>"."Album - ".$product['name']."</br>".""."Created Date - ".$product['apiproduct']['Created_Date']."</br>"."Quantity - ".$product['quantity']."<br />"; ?>
                <?php if(!empty($musiclink))
                echo 'Doanload Link : <a href="'.$musiclink.'" id="'.$muorid.'" class="musiclink" target="_blank">'.$product['name'].'</a>';
                ?>
        </div>
        <?php } 
        elseif (strtolower(str_replace(' ','',$product['apiproduct']->API_Type))=="indianstage") { 
        
            $iexprod=$this->Order_model->get_exproduct($product['apiproduct']['api_pid']);
                if(!empty($iexprod))
                {
                $resu=json_decode($iexprod['output']);
                $res=json_decode($iexprod['input']);
                $r=toArray($resu);
             $oid=toArray(json_decode($r['Output']['success']));
             if(isset( $oid['ORDERID'])) { 
             $check_indianstage=check_indianstage_booking($oid['ORDERID']);
                 if(isset($check_indianstage['success']))
           {
           $ocheck=toArray(json_decode($check_indianstage['success']));
            
            if(!isset($ocheck['error']))
            {
            $k='</br> <a target="_blank" href="http://indianstage.in:8080/admin/ChannelService?user=reward360&password=chp&email=vijay@reward360.co&command=print-ticket&orderId='.$oid['ORDERID'].'" > Print you ticket </a> Orderid : '.$oid['ORDERID'];
            }
            else
            {
            $k='</br> '.$ocheck['error'];
            }
           }
           else
             $k='';
             }
             else
             $k='';
        }
        
        
        ?>
        <div id="panel<?php echo $i; ?>" class="panel" >
        <?php echo "</br>".$product['item']; 
        
        echo $k?>
        </div><?php }
        
          elseif (strtolower(str_replace(' ','',$product['apiproduct']->API_Type))=="bouquet") { ?>
        <div id="panel<?php echo $i; ?>" class="panel" >
        <?php echo '<img src="'.$product['apiproduct']['Posted']['flowerdetails']['ProductImage'].'" width="200">';
        echo "</br>"."Description - ".$product['apiproduct']['Posted']['flowerdetails']['ProductDescription']."</br>"."Category - ".$product['apiproduct']['Posted']['flowerdetails']['CategoryName']."</br>Delevery City - ".$product['apiproduct']['Posted']['city']."</br>Delevery Date - ".date('d, M Y',strtotime($product['apiproduct']['Posted']['deliverydate']))."</br>"."Quantity - ".$product['quantity']."</br>"."Points - ".$product['apiproduct']['Posted']['amount']; ?>
        </div><?php }
              elseif (strtolower(str_replace(' ','',$product['apiproduct']->API_Type))=="flightraja") { ?>
        <div id="panel<?php echo $i; ?>" class="panel" >
        <?php 
        include('flightraja_details.php');  ?>
        </div><?php }
         elseif (strtolower(str_replace(' ','',$product['apiproduct']->API_Type))=="hotels") { ?>
        <div id="panel<?php echo $i; ?>" class="panel" >
        <?php 
        include('hotels_details.php');  ?>
        </div><?php }
                elseif (strtolower(str_replace(' ','',$product['apiproduct']->API_Type))=="pvrcinema") { ?>
                <div id="panel<?php echo $i; ?>" class="panel" >
                Film Name : <?php echo $product['apiproduct']['Posted']['film_name']; ?><br />
                Show Date & Time : <?php echo $product['apiproduct']['Posted']['film_start_date']; ?><br />
                Seat Info :  <?php echo $product['apiproduct']['Posted']['seatinfo']; ?><br />
                Qty : <?php echo $product['apiproduct']['Posted']['qty_val']; ?><br />
                Amopunt :<?php echo $product['apiproduct']['Posted']['totalamt']; ?>
                
                </div><?php }
                 elseif (strtolower(str_replace(' ','',$product['apiproduct']->API_Type))=="indushealth") { ?>
        <div id="panel<?php echo $i; ?>" class="panel" >
        <?php 
        $city=$this->db->where('id',$product['apiproduct']['Posted']['city'])->get('indus_cities')->row();
       ?>
                First Name : <?php echo $product['apiproduct']['Posted']['fname']; ?><br />
                Last Name : <?php echo $product['apiproduct']['Posted']['lname']; ?><br />
                Email :  <?php echo $product['apiproduct']['Posted']['email']; ?><br />
                Gender : <?php echo $product['apiproduct']['Posted']['gender']; ?><br />
                Age : <?php echo $product['apiproduct']['Posted']['age']; ?><br />
                Mobile :<?php echo $product['apiproduct']['Posted']['mobile']; ?><br />
                City :<?php echo $city->city; ?>
        </div><?php }
        } else {   ?>
                 
                <div id="panel<?php echo $i; ?>" class="panel"><?php echo "Description:".$product['description'].'<br>'."Sales Price ".$product['saleprice']; ?></div>
        <?php } ?>
</td>
        <td><?php echo $product['quantity'];?></td>
        <td><?php echo Currency::get_currency_value($finaldealpoints,1); ?></td>
        <td><?php echo Currency::get_currency_value($finaldealcash);?></td>
        <td><?php echo $mongo['status'] ?></td>
         <td><?php if(isset($product['apiproduct']) && strtolower(str_replace(' ','',$product['apiproduct']->API_Type))=='yatra') echo '<a target="_blank" class="print_ticket"href="'.base64_encode('yatra'.$product['apiproduct']['api_pid']).'" >
	Print your ticket</a>' ?></td>
</tr>
		<?php $i++; endforeach;?>
		<?php } ?>
		</tbody>
		<tfoot>
		<?php if(isset($order->coupon_discount) && $order->coupon_discount > 0):?>
		<tr>
			<td><strong>Coupon Discount</strong></td>
			<td colspan="4"></td>
			<td><?php echo get_currency_value(0-$order->coupon_discount); ?></td>
		</tr>
		<?php endif;?>
		<?php if(isset($order->offer_discount) && $order->offer_discount > 0):?>
		<tr>
			<td><strong>Offer Discount</strong></td>
			<td colspan="4"></td>
			<td><?php echo Currency::get_currency_value($order->offer_discount); ?></td>
		</tr>
		<?php endif;?>
		

		<?php
		$charges = @$order->custom_charges;
		if(!empty($charges))
		{
			foreach($charges as $name=>$price) : ?>

		<tr>
			<td><strong><?php echo $name?></strong></td>
			<td colspan="4"></td>
			<td><?php echo format_currency($points); ?></td>
		</tr>

		<?php endforeach;
		}
		?>
		
	</tfoot>
</table>

