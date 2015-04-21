<div class="container breadcrub" style="margin-top: 13px !important;">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
       <li><a href="<?php echo url::to('list_offer/2');?>" class="">CC</a></li> 
                                       <li>/</li>
                                          <li><a href="#" class="active">Easy EMI Offer</a></li>  <
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		
	</div>
	<?php    $url= explode('/',Request::url());  if(isset($url[9])) {  $card_selected=$url[9];
} else { $card_selected =''; }  
?>
<!---here Starting food fiesta---->
<br>
<div class="container" style="margin-top: -8px !important;">	
<div class="col-md-12 pagecontainer2 offset-0 container">

<div class="col-md-6 ">
	
	<form method="post" action="<?php echo Config::get('app.url');?>" id="food_form" name="food_form" accept-charset="UTF-8"  >
<?php if(isset($_SERVER['HTTP_REFERER'])){?>		
<h4 style="margin-top: 21px;display: block;" ><b><?php echo @$offer_name; ?></b></h4>
<?php } ?>					
				</div>
							
<div class="col-md-6 nopad">
				
        
						<div class="searchbg" style="margin-top: -204px; width: 236px;">
          <input type="hidden" name="hotel_filter"  id="hotel_filter" />
         <!-- <button type="submit" class="btn-search" onclick="goback();">Search</button>!-->
             
            <a  href="javascript: goBack()"> <button class="btn-search" style="margin-right: 46px;" type="button" > go back to search </button></a>
     
        </form>
      </div>  
			</div>
			<div class="clearfix"></div> <div class="line4"></div></br>
			
			<?php   if(count($offers) > 0) {  ?>
			<?php $count= 1; foreach($offers as $daily_offer) {   ?>
			<div class="col-md-12"><div class="col-md-4">	
              <?php if(!empty($daily_offer->image)){
                    $segment_image =  $daily_offer->image; 
			
                        $filename = public_path().'/uploads/offer_images/'.$segment_image;

			if (file_exists($filename)) {
			$image =Config::get('app.url').'/uploads/offer_images/'.$segment_image; ;
			} else {
			
			if($offer_name=='Easy EMI'){
			$image =Theme::asset()->url('offers_images/offer_card/15-card.jpg');
			}
			else{
			$image =Theme::asset()->url('offers_images/offer_card/'.$card_selected.'-card.jpg');
			}
			}


              
               ?>
         <?php $img='<img width="232" hight="118" style="height: 61px;width: 233px;border: 1px solid #EAEBEC;" src="'.$image.'">'; echo HTML::decode(HTML::link('offer_details/'.$daily_offer->id.'/'.$off_types.'', $img)); ?>
                
                  
                
                
                 <?php } else {  ?>
              <?php $img='<img width="226" hight="61" style="height: 61px;width: 233px;border: 1px solid #EAEBEC;" src="'.Theme::asset()->url('offer_images/'.$daily_offer->image).'">'; echo HTML::decode(HTML::link('offer_details/'.$daily_offer->id.'/'.$off_types.'', $img)); ?>
               
               
            
                
                <?php } 
		
		$city = ($daily_offer->city=='all') ? '':$daily_offer->city;	 		
                $current_offer =  $daily_offer->short_description;

                if(strlen( $current_offer) >30){
                $offer_name = $current_offer;//preg_replace('/\s+?(\S+)?$/', '', substr( $current_offer,0,25)).'...';
                }else{
                $offer_name =  $current_offer;
                }?>	
			
			
</div>		
<div class="col-md-8">	 <?php echo '<font color="#034387" style="font-size:16px;"><b>'.$daily_offer->deal_name.'</b></font></br><span style="font-size:14px; color:#cc0000" ><b>'.str_replace('?','',$offer_name).'</b></span><br/><span style="font-size:13px;">'.str_replace('?','',$daily_offer->address).' '.$city;  ?></span></div>
  
  

  <?php   $count++; if($count ==100){ echo '<div style="margin-left:826px;">'.HTML::Decode(HTML::link('foodfiesta','View All Offers',array('class' => 'btn-search','style'=>'width:162px;'))).'</div>'; break; } echo '</div><div class="clearfix"></div> <div class="line4"></div>'; }  ?>     
      

<?php  } else{ ?> 
  	 <b>No offer are available currently.   </b> 
<?php } ?>


			


	
<!--end!-->
			</div>
</div>

<script>

$(".btn-search").on('click', function(){
   $('food_form').submit();
});

function goBack() {
    window.history.back();
}

</script>






