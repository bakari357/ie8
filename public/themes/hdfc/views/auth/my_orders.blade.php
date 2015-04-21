<div class="accountoutbx">
    <div class="page-header">
	<h1>Order History</h1>
    </div>
    <?php if($orders):?>
                </div>

<div class="orderinfobx">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="ordtxt">Ordered On</td>
    <td class="ordtxt">Order Number</td>
    <td class="ordtxt">Points</td>
    <td class="ordtxt nobordR">Status</td>
  </tr>
<?php if(!empty($orders)) { foreach($orders as $order): $getprice=unserialize($order['contents']);
			$price=$getprice['saleprice'];
			 $getPoints = Producthelper::get_product_points($order['product_id'],0,1);
// 			 if(isset($getPoints[0]['points']))
// 			 $points=$getPoints[0]['points'];
// 			 else
// 			 $points=0;
			 if(isset($getprice['points']))
			 $points=$getprice['points'];
			 else
			 $points=0;
			//$points=get_currency_value(point_to_case($price,$points));  ?>
   <tr>
    <td class="ordsubtxt"><?php $d = Datehelper::format_date($order['ordered_on']);
						$d = explode(' ', $d);
						echo $d[0].' '.$d[1].', '.$d[3];
						?> </td>
    <td class="ordsubtxt"><a href="{{ URL::to('view') }}<?php echo "/". $order['id'];?>"><?php echo $order['order_number']; ?></a></td>
    <td class="ordsubtxt"><?php echo $order['total_points']; ?></td>
    <td class="ordsubtxt nobordR"><?php echo $order['status'];?></td>
  </tr>
	<?php endforeach;?>
	<?php } ?>
	<?php else: ?>
	<tr align="center"><TD colspan="4">'No Products</TD></tr>
	<?php endif;?>
</table>
</div>
