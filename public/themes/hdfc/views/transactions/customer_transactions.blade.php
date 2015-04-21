<?php

?>
<div class="accountoutbx">
    <div class="page-header">
	<h3>Transaction and Points</h3>
    </div>
                </div>
<div class="row">
	<div class="span12" style="border-bottom:1px solid #f5f5f5;">
		<div class="row">
			<div class="span4">
				
			</div>
			<div class="span8">
				<?php echo Form::open(array("id"=>"customer_transactions", "class"=>"form-inline"));?>
					<fieldset>
						<input id="start_top"  value="" class="eminpt" type="text" placeholder="Start Date"/>
						<input id="start_top_alt" type="hidden" name="start_date" />
						<input id="end_top" value="" class="eminpt" type="text"  placeholder="End Date"/>
						<input id="end_top_alt" type="hidden" name="end_date" />
						<button class="btn btn-primary" name="submit" value="search">Search</button>
					</fieldset>
				{{ Form::close()}}
			</div>
		</div>
	</div>
</div>
<div class="orderinfobx">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="ordtxt">Transaction Date</td>
    <td class="ordtxt">Points</td>
    <td class="ordtxt">Activity</td>
  </tr>
<?php echo (count($transactions) < 1)?'<tr><td style="text-align:center;" colspan="3">'. 'No Transaction'.'</td></tr>':''?>
<?php  foreach($transactions as $transaction):	 ?>
  <tr>
    <td class="ordsubtxt"><?php echo date("F d, Y g:i a",strtotime($transaction->date)) ?></td>
    <td class="ordsubtxt"><?php   if($transaction->credit >0){ echo $transaction->credit; $point_status='Points Earned';}else{ echo $transaction->debit; $point_status='Points Redeemed';}?></td>
    <td class="ordsubtxt"><?php echo $transaction->status; ?></td>
  </tr>
	<?php endforeach;?>
</table>
</div>
<script type="text/javascript">
$(document).ready(function(){

$( "#start_top" ).datepicker({
                 dateFormat : 'dd-mm-yy',
		changeMonth : true,
		altField: '#start_top_alt', altFormat: 'yy-mm-dd',
		changeYear : true,
		maxDate: '0d',
		onSelect: function( selectedDate ) {
var maxDate = $(this).datepicker('getDate');
           if (maxDate) {
                 maxDate.setDate(maxDate.getDate() );
           }
           $( "#end_top" ).datepicker( "option",{ minDate:maxDate}, selectedDate );
                          }

                           });
                 $( "#end_top" ).datepicker({
                 dateFormat : 'dd-mm-yy',
		changeMonth : true,
		altField: '#end_top_alt', altFormat: 'yy-mm-dd',
		changeYear : true,
		maxDate: '0d',
		onSelect: function( selectedDate ) {
var maxDate = $(this).datepicker('getDate');
           if (maxDate) {
                 maxDate.setDate(maxDate.getDate() );
           } $( "#start_top" ).datepicker( "option",{ maxDate:maxDate}, selectedDate );
                          }

              });





});
</script>
