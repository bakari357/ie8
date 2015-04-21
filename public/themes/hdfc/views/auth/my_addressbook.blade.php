<script type="text/javascript">
$(document).ready(function(){
        $('.edit_address').click(function(){
var id = $(this).attr('rel');

              $.ajax({
                      type: "POST",
                     // url: "<?=URL::to('show_address')?>",
                     url: "address/"+ id +" ",
                     
                      data: {
               "id":id
              },             
                        success: function(data) {
                        $('#address-form-container').html(data).modal('show');
                              
                      }
                  });
	
	});
	
	$('.delete_address').click(function(){
	
	if($('.delete_address').length > 1)
		{ 
			if(confirm('You Must leave at least 1 address in the Address Manager.'))
			{
				$.post("<?=URL::to('delete_address')?>", { id: $(this).attr('rel') },
					function(data){
						$('#address_'+data).remove();
						$('#address_list .my_account_address').removeClass('address_bg');
						$('#address_list .my_account_address:even').addClass('address_bg');
						window.location = "{{ url::to('my_addressbook')}}";
					});
			}
		}
		else
		{
			alert('Must have address');
		}
	});
	
	if ($.browser.webkit) {
	    $('input:password').attr('autocomplete', 'off');
	}

});
function set_default(address_id, type)
{
	$.post("<?=URL::to('setdefault_address')?>",{id:address_id, type:type});
	
	
}
</script>
<div class="accountoutbx">
<div class="page-header">
<h1>Address Manager</h3>
</div>
</div>
<div class="orderinfobx">

<table class="table table-bordered table-striped">
<tr align="right"><TD colspan="2"><input type="button" class="btn btn-primary edit_address" rel="0" value="Add Address"/></TD></tr>

<?php if(count($addresses) > 0):?>
			<?php
			$c = 1;
			foreach($customer as $customers){
				foreach($addresses as $a){ ?>
					<tr id="address_<?php echo $a->id;?>">
						<td>
							<?php
							$b	= $a->field_data;
							echo Format::format_address($b, true);
							?>
</td>
<td>
<div class="row-fluid">
<div class="span12">
	<div class="btn-group pull-right">
		<input type="button" class="btn edit_address" rel="<?php echo $a->id;?>" value="Edit" />
		<input type="button" class="btn btn-danger delete_address" rel="<?php echo $a->id;?>" value="Delete" />
	</div>
</div>
</div>
<div class="row-fluid">
<div class="span12">
	<div class="pull-right" style="padding-top:10px;">
	
	<input type="radio" name="bill_chk" onclick="set_default(<?php echo $a->id ?>, 'bill')" <?php if($customers->default_billing_address ==$a->id) echo 'checked="checked"'?> /> Default Billing</div>
		<div class="pull-right" style="padding-top:10px;">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="ship_chk" onclick="set_default(<?php echo $a->id ?>,'ship')"  <?php if($customers->default_shipping_address == $a->id) echo 'checked="checked" '?>/> Default Shipping
	</div>
</div>
</div>
</td>
</tr>
<?php } 
}
?>
				<?php endif;?>
</table>

</div>

<div id="address-form-container" class="hide">
</div>
