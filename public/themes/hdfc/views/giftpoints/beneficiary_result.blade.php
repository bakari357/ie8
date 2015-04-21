<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo 'Confirm Delete Benificiary';?>');
}
</script>

<div class="accountoutbx">
<div class="page-header">
<h3>Beneficiary</h3>
</div>
</div>

<table class="table table-striped tablesorter">

		<thead>
			<tr >
				<th><input type="checkbox" id="gc_check_all" /></th>
				<th>Id</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php echo (count($results) < 1)?'<tr><td style="text-align:center;" colspan="6">There are currently no beneficiary(s)</td></tr>':''?>
	<?php if($results):?>
	<tbody id="properties_sortable">

		<?php 
			foreach($results as $benificiary)
			{ ?>
			<tr class="gc_row" id="giftpoints-<?php echo $benificiary->id;?>" >
			        <td><input name="benificiary[]" type="checkbox" value="<?php echo $benificiary->id; ?>" class="gc_check"/></td> <td><?php echo $benificiary->id;?></td>
				<td>
					<?php echo $benificiary->firstname; ?>
				</td>
				<td>
					<?php echo $benificiary->email; ?>
				</td>
				<td>
					<?php echo $benificiary->phone; ?>
				</td>
				<td>
					<div class="btn-group pull-right">
							<a class="btn" href="<?php echo $benificiary->id; ?>" title="<?php echo 'Add';?>"><i class="icon-pencil"></i> </a>
							
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
	<style>

table th {
width:500px !important;
}
</style>
