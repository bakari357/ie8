<style>
.nav-tabs > li {background-color: #edf2f7; width:160px; padding:0px 0px; text-align:center; font-family:18px;}</style>	
	
	
	
	 <?php foreach ($offer_details as $offers){
     $offer = $offers;
//echo'<pre>'; print_r($offer);exit;
     }       
	 ?>  
	<div class="container breadcrub" >
	    <div>
			
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
				<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
 <?php if($off_types == 2)  { ?>  
<li><a href="<?php echo url::to('list_offer/'.$offer->offer_type);?>" >CC</a></li> 
<?php } ?> 
         
<?php if($off_types == 1)  { ?>  
<li><a href="<?php echo url::to('list_offer/'.$offer->offer_type);?>" >DC</a></li> 
<?php } ?> 	

<?php if($off_types == 3)  { ?> 
<li><a href="<?php echo url::to('list_offer/'.$offer->offer_type);?>" >NB</a></li> 
<?php } ?>

<?php if($off_types == 4)  { ?> 
<li><a href="<?php echo url::to('list_offer/'.$offer->offer_type);?>" >PC</a></li> 
<?php } ?>

<?php if($off_types == 5 || $off_types == 6 || $off_types == 7 || $off_types == 8 || $off_types == 9) { ?> 
<li><a href="<?php echo url::to('list_offer/'.$offer->offer_type);?>" >DC</a></li> 
<?php } ?>   

<?php if($off_types == 10 || $off_types == 11 || $off_types == 12 || $off_types == 13 || $off_types == 14 || $off_types == 15 || $off_types == 16 || $off_types == 17)  { ?> 
<li><a href="<?php echo url::to('list_offer/'.$offer->offer_type);?>" >CC</a></li> 
<?php } ?>                            
 <li>/</li>
<li><a href="#" class="active">Offer Details</a></li>
					
									
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		
	</div>	
   
	
		<?php $start =  date('jS M', strtotime($offer->start_date));
                                      $end =  date('jS M Y', strtotime($offer->end_date));  ?>
		<div class="container mt25 offset-0">
			
			<!-- CONTENT -->	
			<div class="col-md-8 pagecontainer2 offset-0" style="min-height: 272px;">

	<?php $offer_html = $offer->description; ?> 
	<div class ="hidden" style="display:none" > <?php echo str_replace('_x000D_','',$offer_html); ?></div>




<ul class="nav nav-tabs"  id="myTab" style="background:none ! important;">
					
					<li onclick="mySelectUpdate()" class="active"><a data-toggle="tab" href="#wtnew"><span class=""></span><span class="hidetext  text-18">Offer Details</span>&nbsp;</a></li>
					
			<li class="avil_show" style="display:none"><a data-toggle="tab" href="#avail"><span class="avail"></span><span class="hidetext">How To Avail</span>&nbsp;</a></li> 
					
					<li class=""><a data-toggle="tab" href="#maps"><span class="maps"></span><span class="hidetext">Terms & Condition</span>&nbsp;</a></li>
					
				</ul>	

<div class="tab-content4"  style="margin-top:-24px;">
					<div id="wtnew" class="tab-pane fade active in"></div>
					<div id="avail" class="tab-pane fade"></div>
					<div id="maps" class="tab-pane fade"></div>
</div>
		

<div>
</div>	
</div>

		<?php $large_image = $offer->image; 
			
                      $filepath=public_path().'/themes/hdfc/assets/offer_images/'.$large_image;
			
		?>
		
<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						
						<div class="wh30percent left">
									<?php 
				   if(empty($offer->image) || !file_exists($filepath)){ 
				     $segment_image =  $segment = $offer->segment;
                 ?>       
                  <img style="width:150px; height:100px;" class="fwimg margright20"src="<?php echo Theme::asset()->url('offers_images/offer_card/'.$off_types.'-card.jpg'); ?>" />
				   
		 <?php   } else { ?>
			<img style="width:200px; height:100px;" class="fwimg margright20" src="<?php echo Theme::asset()->url('offer_images/'.$large_image.'');?>" />
			<?php } ?>
						</div>

						<div class="wh60percent mt-10 right">
							
							<span class="opensans size13 grey"><?php echo $offer->long_description;?></span><br/>
							
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="line3"></div>
					
					
					<div class="line3"></div>

					<div class="padding30">	
					<span class="left size18 lblue"><?php echo $offer->deal_name; ?></span>
					<span class="left size14 dark "></span><br><br>
					<span class="left size15 dark"><?php echo $offer->short_description; ?></span>
					<span class="left size14 dark "></span><div class="clearfix"></div></br>
					<?php if($end !="1st Jan 1970"){?>
					<span class="left lred2 bold size15"><?php echo 'Valid upto'.' '.$end; ?></span> <?php } ?>
					<div class="clearfix"></div>
					</div>	


					


				</div><br/>
</div>	
	<!-- END OF CONTENT -->
</div>	
	
	
<script>

$(document).ready(function() {
	var data1 = $("#OfferDetails").html(); 
	var data2 = $("#TermsConditions").html();
        $("#wtnew").html(data1); 
	$("#maps").html(data2); 
	$(".avil_show").hide();
if( $('#HowtoAvail').length )         // use this if you are using id to check
{
	$(".avil_show").show();
	var data3 = $("#HowtoAvail").html();
	$("#avail").html(data3);
}else{
}
});

</script>

	
<style> 
#wtnew, #maps, #avail {padding-top:20px;  }
#wtnew li, #maps li, #avail li{ list-style-type: disc; line-height:1.5; color:rgb(51, 51, 51); font-size:12px }

</style>
