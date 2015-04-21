<?php if(count($products)==0):?>
	<div class="alert alert-info">
		<a class="close" data-dismiss="alert">×</a>
		<?php echo "There are no products in your wishlist!";?>
	</div>
<?php else: ?>
<div class="accountoutbx">
	<div class="page-header">
		<h1>Your Wishlist</h1>
	</div>
</div>
        {{ Form::open() }}
	
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
			        <th style="width:10%;">Image</th>
			        <th style="width:10%;">SKU</th>
				<th style="width:20%;">Name</th>
				<th style="width:10%;">Points</th>
				<th>Description</th>
				<th style="width:8%;">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($products as $product):?>
		
			<tr>  
			        <?php  $photo	= Theme::asset()->url('img/no_picture.png'); 
			      
			                $images=(array)json_decode($product->images);
			                
			                if(array_key_exists('custom',$images))
					{

					$image_path=Rewards::custom_url();
					$img=1;
					} else{$image_path= Rewards::rewards_url();}
			                
			                if(!empty($images) && $images!=='false')
			                {
					$product->images	= array_values($images);
					

					if(!empty($product->images[0]))
					{
					   $primary	= $product->images[0];
					   foreach($product->images as $photo)
					   {
					     if(isset($photo->primary))
						{
						   $primary	= $photo;
						}
					    }
					    
					  $photo	= '<img src="'.$image_path.''.$primary->filename.'"  width="100" height="100" />';
					  
					 }
					}
					?>
					
			        <td id="thumb-image">
			       <!--here i using product slug for getting product id !-->
			        <?php echo "<a href='".url::to('product/'.$product->slug)."'>".$photo."</a>";?>
			     
			      
			        </td>
				<td><?php echo $product->sku;?></td>
				<td>
			
			   <?php echo "<a href='".url::to('product/'.$product->slug)."'>".$product->name."</a>";?>
			</td>
				   <?php  $is_client_api=Producthelper::get_product_information($product->f_partnerid); 
				  
				   if(isset($is_client_api->is_client_api)  && $is_client_api->is_client_api==0) { ?>
           <td><?php
		$pointsDetails = Productsmodel::getPoints($product->id,0,1); 		// points only
		  
			if($pointsDetails) { 
			$points = $pointsDetails[0]->points; } else { $points = Currency::point_to_case(intval($product->saleprice));  }

		$points_cashDetails = Productsmodel::getPoints($product->id,1,1);   	// points + Cash
			if($points_cashDetails) {  $pointcash = $points_cashDetails[0]['points'].'+'.$points_cashDetails[0]['cash']; } else { $pointcash = '0+0.00'; }

		$cashDetails = Productsmodel::getPoints($product->id,1,0);  		//Cash Only
			if($cashDetails) { $cash = $cashDetails[0]['cash']; } 	else { $cash = '0.00'; }
		?> <?php echo round(Currency::get_offer($points,$product->offer));?></br>
		</td>
		
		<?php } ?>
				
				<td><?php echo substr($product->excerpt,0,100); ?></td>
				<td><?php echo "<a href='".url::to($product->category_slug.'/'.$product->slug)."' ><img src='".Theme::asset()->url("img/cart-add.png")."'></a> ";  ?><?php echo "<a href='".url::to('remove_wishlist/'.$product->id)."' onclick=\"return areyousure();\" ><img src='".Theme::asset()->url("img/remove.png")."'></a>";  ?></td>
				<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
			</tr>

		<?php endforeach; ?>

		</tbody>
	</table>
	<div class="row">
	<div style="float:right;">
                               <input type="button" value="Continue »" onclick="redirection();" class="btn btn-large btn-primary">
        </div> </div>
{{Form::close()}}
<?php endif; ?>
<script>
function redirection()
{
  window.location="{{ url::to('myaccount'); }}";
}
function areyousure()
{
	return confirm('<?php echo "Are you sure you want to delete this wishlist?";?>');
}
</script>
