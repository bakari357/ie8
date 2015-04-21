<style>
.nav-tabs > li {background-color: #edf2f7; width:155px; padding:0px 0px; text-align:center; font-family:18px;}</style>	
	
	
	 <div class="container breadcrub" >
	    <div>
			         <?php $request = Request::url(); $request_from = explode('/',$request);?>
			       
			         
			
				<ul class="bcrumbs">
					<a class="homebtn left" href="<?php echo url::to('/');?>"></a>
					
                                          <li>/</li>
                                        <li><a href="{{URL::to('deals_list')}}">Deals </a></li>
					 <li>/</li>
					<li><a href="{{URL::to('fiesta_list')}}">Food Fiesta </a></li>
					<li>/</li>
					 <li><a href="#"> Offer Details</a></li>
									
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		
	</div>	
	 <div class="container " style="margin-top: 11px !important;margin-left:109px;">
        
    <?php foreach ($offer_details as $offers){
     $offer = $offers;
//echo'<pre>'; print_r($offer);exit;
     }       
	 ?>
	<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						
						<div class="wh30percent left">
									<?php 
				   if($offer->image==''){ 
				     $segment_image =  $segment = $offer->segment;
                 ?>
                  <img width='108' height='83' src="<?php echo Theme::asset()->url('foodfiesta_large_images/'.$segment_image.'.jpg'); ?>" />
				   
		 <?php   } else { ?>
				   
			<img src="<?php echo public_path('uploads/foodfiesta_images/'). $offer->image; ?>" width='108' height='83' alt=""/>
			<?php } ?>
						</div>

						<div class="wh60percent mt-10 right">
							<span class="opensans size18 dark bold"><?php echo $offer->proper_me_name; ?></span><br/>
							
							
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="line3"></div>
					
					
					<div class="line3"></div>
					<div class="padding20">	
                                           <span class="left size14 dark">Address : </span>     <span class="opensans size15"><?php echo $offer->address; ?><br> <?php echo $offer->city; ?> <?php echo $offer->state; ?>- <?php echo $offer->pin;?></span></br>
                                           </br>
                                            <div class="line3"></div>  
                                            </br>
						<span class="left size14 dark">Offer Details:</span></br></br>
						
						
						<?php 
					
					if(empty($offer->discount_offer)){
					   $offers =  $offer->offefr_details;
					   }else{
					   $offers =  $offer->discount_offer;
					   }
					   
					
					echo $offers; ?></span>
                                                
                                             
						<div class="clearfix"></div>
                                                
                                                <a href="#" class="lblue" rel="popover" id="infottip2" data-content="><?php echo $offer->discount_offer;?>"></a>
					</div>


				</div><br/>
</div>	

		</div>
		<!-- END OF container-->
		
		<div class="container mt25 offset-0">
			
			<!-- CONTENT -->	
		
			<!-- END OF CONTENT -->	
			
							
			
			</div>
		</div>
		
		
		
	</div>	</div>	
	<!-- END OF CONTENT -->
	
	
	


	

