

<?php 

if(!empty($term)):
	$term = json_decode($term);
	if(!empty($term->term)):
	$searchvalue=$term->term;
	?>
		<div class="alert alert-info">
			<?php echo sprintf('Search Returned'), intval($total);?>
		</div>
	<?php endif;?>
<?php endif;?>
<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo 'confirm delete_benificiary';?>');
}
</script>

<div class="accountoutbx">
<div class="page-header">
<h2>Beneficiary</h2>
</div>
</div>


<div class="row " >
	<div class="span7 pull-right">
		<div class="row">
			<div class="span7 ">
				{{ Form::open(array("class"=>"form-inline","style"=>"float:right;"))}}
					<fieldset>

						<input type="text" class="span2" name="term" placeholder="<?php echo 'Search Term';?>" />
						<button class="btn" name="submit" value="search">Submit</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
&nbsp;
</div>
<div class="row">
	<div class="span6">
		<div class="row">
			<div class="span6">
				
			</div>
		</div>
	</div>
</div>

<div class="row">
<span class="btn-group pull-right">
<a class="btn" href="{{ url::to('giftpointsform');}}" style="font-weight:normal;"><i class="icon-plus-sign"></i> <?php echo 'Add New Beneficiary';?></a>
</span>
</div>

<table class="table table-striped tablesorter">

		<thead>
			<tr > <?php /*echo sort_url('id', 'id', $order_by, $sort_order, $code, '');
			 echo sort_url('email', 'email', $order_by, $sort_order, $code, ''); */?>
				<th>Id</th>
				<th>Email</th>
				<th><?php echo 'Status'; ?></th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
		<?php echo (count($beneficiaries) < 1)?'<tr><td style="text-align:center;" colspan="5">No Giftpoints</td></tr>':''?>
	<?php if($beneficiaries):?>
	<tbody id="properties_sortable">

		<?php 
			foreach($beneficiaries as $benificiary)
			{ ?>
			<tr class="gc_row" id="giftpoints-<?php echo $benificiary->id;?>" >
			         <td><?php echo $benificiary->id;?></td>
				<td>
					<?php echo $benificiary->email; ?>
				</td>
				<td>
					<?php
					if($benificiary->active ==1) echo 'Enabled'; else echo 'Disabled';
					?>
				</td>
				<td>
					<div class="btn-group pull-right">
					
							<a class="btn" href="{{url::to('edit_giftpoints');}}<?php echo '/'. $benificiary->beneficiary_id;?>" title="<?php echo 'Pay';?>"><i class="icon-pencil"></i> Edit </a>  |
							
						<a class="btn btn-danger" href="{{url::to('delete_giftpoints');}}<?php echo '/'. $benificiary->beneficiary_id;?>" onclick="return areyousure();" title="<?php echo 'Delete';?>"><i class="icon-trash icon-white"></i>Delete</a>
					
					</div>
				</td>
			</tr>
			<?php
			}
		?>
	</tbody>
	<?php endif;?>
		</tbody>
	</table>
	{{ Form::close() }}
<script type="text/javascript">

$(document).ready(function(){
       $('#gc_check_all').click(function(){
               if(this.checked)
               {
                       $('.gc_check').attr('checked', 'checked');
               }
               else
               {
                        $(".gc_check").removeAttr("checked");
               }
       });

});

function submit_form_delete()
{
	if($(".gc_check:checked").length > 0)
	{
		if(confirm('<?php echo 'confirm_delete_benificiary'; ?>'))
		{
		       $('#operation').val(2);
			$('#active_form').submit();
		}
	}
	else
	{
		alert('<?php echo 'Select giftpoints to deleting procress'; ?>');
	}
}

</script>

<style>
table th{
width:500px !important;
}
</style>
