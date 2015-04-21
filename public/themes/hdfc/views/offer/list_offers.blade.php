<div class="container breadcrub" style="margin-top: 13px !important;">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
                                       
         <?php if($off_types == 2)  { ?>  <li><a href="#" class="active">CC</a></li> <?php } ?> 
         <?php if($off_types == 1)  { ?>  <li><a href="#" class="active">DC</a></li> <?php } ?> 	
	 <?php if($off_types == 3)  { ?>  <li><a href="#" class="active">NB</a></li> <?php } ?>	
         <?php if($off_types == 4)  { ?>  <li><a href="#" class="active">PC</a></li> <?php } ?>
        
         <?php if($off_types == 5) { ?>  <li><a href="<?php echo url::to('list_offer/1');?>" class="">DC</a></li> 
                                          <li>/</li>
                                          <li><a href="#" class="active">Ecom Offer</a></li>  <?php } ?>
         <?php if($off_types == 6) { ?>  <li><a href="<?php echo url::to('list_offer/1');?>" class="">DC</a></li> 
                                          <li>/</li>
                                          <li><a href="#" class="active">Travel Offer</a></li>  <?php } ?>
          <?php if($off_types == 7) { ?>  <li><a href="<?php echo url::to('list_offer/1');?>" class="">DC</a></li> 
                                       <li>/</li>
                                          <li><a href="#" class="active">Instore Offer</a></li>  <?php } ?>
          <?php if($off_types == 8) { ?>  <li><a href="<?php echo url::to('list_offer/1');?>" class="">DC</a></li> 
                                       <li>/</li>
                                          <li><a href="#" class="active">Master Card Offer</a></li>  <?php } ?>
         <?php if($off_types == 9) { ?>  <li><a href="<?php echo url::to('list_offer/1');?>" class="">DC</a></li> 
                                       <li>/</li>
                                          <li><a href="#" class="active">Visa Offer</a></li>  <?php } ?>

         <?php if($off_types == 10) { ?>  <li><a href="<?php echo url::to('list_offer/1');?>" class="">CC</a></li> 
                                          <li>/</li>
                                          <li><a href="#" class="active">Ecom Offer</a></li>  <?php } ?>
         <?php if($off_types == 11) { ?>  <li><a href="<?php echo url::to('list_offer/2');?>" class="">CC</a></li> 
                                       <li>/</li>
                                          <li><a href="#" class="active">Travel Offer</a></li>  <?php } ?>	
	 <?php if($off_types == 12) { ?>  <li><a href="<?php echo url::to('list_offer/2');?>" class="">CC</a></li> 
                                       <li>/</li>
                                          <li><a href="#" class="active">Instore Offer</a></li>  <?php } ?>
         <?php if($off_types == 13) { ?>  <li><a href="<?php echo url::to('list_offer/2');?>" class="">CC</a></li> 
                                       <li>/</li>
                                          <li><a href="#" class="active">Master Card Offer</a></li>  <?php } ?>
        <?php if($off_types == 14) { ?>  <li><a href="<?php echo url::to('list_offer/2');?>" class="">CC</a></li> 
                                       <li>/</li>
                                          <li><a href="#" class="active">Visa Offer</a></li>  <?php } ?>
 <?php if($off_types == 15) { ?>  <li><a href="<?php echo url::to('list_offer/2');?>" class="">CC</a></li> 
                                       <li>/</li>
                                          <li><a href="#" class="active">Easy EMI Offer</a></li>  <?php } ?>
 <?php if($off_types == 16) { ?>  <li><a href="<?php echo url::to('list_offer/2');?>" class="">CC</a></li> 
                                       <li>/</li>
                                          <li><a href="#" class="active">Commercial Card Offer</a></li>  <?php } ?>
 <?php if($off_types == 17) { ?>  <li><a href="<?php echo url::to('list_offer/2');?>" class="">CC</a></li> 
                                       <li>/</li>
                                  <li><a href="#" class="active">International Offer</a></li>  <?php } ?>		
<?php if($off_types == 18) { ?>  <li><a href="<?php echo url::to('list_offer/2');?>" class="">CC</a></li> 
                                       <li>/</li>
                                          <li><a href="#" class="active">MasterCard Offers</a></li>  <?php } ?>

<?php if($off_types == 19) { ?>  <li><a href="<?php echo url::to('list_offer/2');?>" class="">CC</a></li> 
                                       <li>/</li>
                                          <li><a href="#" class="active">Visa Offers</a></li>  <?php } ?>

<?php if($off_types == 20) { ?>  <li><a href="<?php echo url::to('list_offer/2');?>" class="">CC</a></li> 
                                       <li>/</li>
                                          <li><a href="#" class="active">Bank offers</a></li>  <?php } ?>

				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		
	</div>
		

<div class="container mt8 offset-0">	
<div class=" col-md-12 pagecontainer2 offset-0">
            <div class="col-md-2" style="margin-top: 30px;"><h4><b>Offers</b></h4>
		</div>
          <div class="col-md-4 nopad">
            <?php if(isset($_POST['card'])) { $selected=$_POST['card'];} else { $selected =''; } ?>
			<div id="hide_circle" >

    			<div>


<?php   $url= explode('/',Request::url());  if(isset($url[6])) { $card_selected=$url[6];} else { $card_selected =''; } ?>
<?php   $card_type=array('2'=>'Credit Card Offers','1'=>'Debit Card Offers','3'=>'Net Banking Offers','4'=>'Prepaid Card Offers','15'=>'Easy EMI Offers');?> 
<?php echo Form::select('card',$card_type,$card_selected,array( "class"=>"form-control segment","id"=>"card" ,"name"=>"card","style"=>"width: 189px;margin-left: -24px;")); if($card_selected==17) $card_selected=2; ?>
			</div>
		</div>		
		
		<form method="post" action="<?php print_r(Config::get('app.url')); echo 'list_offer/'.$url[6];?>" id="offers_form" name="offers_form" >	 

<?php if(isset($emi_offer_city)) {?>

<?php echo Form::select('city',$emi_offer_city,$selected_city,array( "class"=>"form-control","style"=>"margin-left: 239px;margin-top: -33px;width: 228px","id"=>"hide_segment" ));?>

  <button type="submit" onclick="return fiesta_validation();" style="width: 158px;margin-right: -342px;margin-top: -33px;" class="btn-search">Search</button>
<?php } ?>
       </form>
				
      
</div>  
	<div class="clearfix"></div> <div class="line4">  </div>
                        <?php foreach($names as $offers_name) {
                                         $offer_name = $offers_name; } ?> 
                     
<h4 style="padding: 0px 23px; color:#0060B1;"><?php echo $offer_name; ?></h4> 
<br/>



			<?php if(count($offers) > 4)  { ?>
			 <ul class="offer_list">
			 <?php } else { ?>
			  <ul class="offer_list">
			 <?php } ?>

			<?php $count= 1;
if(count($offers)==0)
{
echo '<font color="red" style="margin-left:409px;" > <b>No offers are available currently. </b></font>';
}else{ 
		foreach($offers as $daily_offer) {
			$name = base64_encode($daily_offer->deal_name);
                        $city = base64_encode($daily_offer->city);
		   ?>
			<li>
              <?php if(!empty($daily_offer->image)){
			
                        $segment_image =  $daily_offer->image; 

			
			
                        $filename = public_path().'/uploads/offer_images/'.$segment_image;

			if (file_exists($filename)) {
			$image =Config::get('app.url').'/uploads/offer_images/'.$segment_image;
			} else {
			$image =Theme::asset()->url('offers_images/offer_card/'.$card_selected.'-card.jpg');
			}


                  $offerurl= explode('/',Request::url());  if(isset($offerurl[6])) {  $off_types=$offerurl[6]; 
} else { $off_types =''; }  
               ?>
              
                
                  <?php if($off_types==15) { 
                  $img='<img width="232" hight="118" style="height: 61px;width: 233px;border: 1px solid #EAEBEC;" src="'.$image.'">'; echo HTML::decode(HTML::link('get_offers/'.$daily_offer->id.'/'.$name.'/'.$city.'/'.$card_selected.'', $img)); 
                  
                  } else{ 
                  
                   $img='<img width="232" hight="118" style="height: 61px;width: 233px;border: 1px solid #EAEBEC;" src="'.$image.'">'; echo HTML::decode(HTML::link('offer_details/'.$daily_offer->id.'/'.$off_types.'', $img));
                  
                  }
                } else { 
                 
                 if($off_types==15){ 
              
                  $img='<img width="226" hight="61" style="height: 61px;width: 233px;border: 1px solid #EAEBEC;" src="'.Theme::asset()->url('offer_images/'.$daily_offer->image).'">'; echo HTML::decode(HTML::link('get_offers/'.$name.'/'.$city.'/'. $card_selected.'', $img)); 
                  } else{
                  
                   $img='<img width="226" hight="61" style="height: 61px;width: 233px;border: 1px solid #EAEBEC;" src="'.$image.'">'; echo HTML::decode(HTML::link('offer_details/'.$daily_offer->id.'/'.$off_types.'', $img)); 
              
                
               }  } ?>
              
		<?php if(isset($daily_offer->start_date) && $daily_offer->start_date !='1970-01-01') {
                      $start =  date('jS F', strtotime($daily_offer->start_date)); }
                      else { $start = '';  }

                     if(isset($daily_offer->end_date) && $daily_offer->end_date !='1970-01-01') {
                      $end =  date('jS F Y', strtotime($daily_offer->end_date)); }
                       else { $end = '';  } 
                       
                        if(strlen($daily_offer->short_description) >30){
                 $description = preg_replace('/\s+?(\S+)?$/', '', substr($daily_offer->short_description,0,50)).'...';
                                }else{
                               $description =  $daily_offer->short_description;
                                }?>
			
	<br/>		
<div class="cpadding1"><font color="#034387" style="font-size:13px;"> <b><?php echo $daily_offer->deal_name; ?></b></font><br/><span style="font-size:12px;">   <?php echo $description.",".$daily_offer->city; ?></span></div>
 <div class="blink buy-btn mt-10" ><?php echo HTML::link('offer_details/'.$daily_offer->id.'/'.$off_types.'', 'View Offer',array('class'=>'mt15')); ?></div>
  </li>
  <?php if($count%4==0){?>
 
  <?php } ?>

  <?php   $count++; } }?>     
    

</ul>	<div class="clearfix"></div>
<div style="float: right;margin-right: 50px;"> 
<?php if(isset($emi_offer_city)) {
 echo  $offers->appends(array("city"=>$selected_city))->links(); 
 } else { 
echo  $offers->links(); 

 } ?>
 
 </div> 

<!--end!--><div class="clearfix"></div> 

</div>
</div>


<script>
$("#card").on('change', function(){
 //$("#hide_segment").hide();
 var card = $(this).val(); 
 
              $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_segment')?>",
                      data: {
               "card":card
              },             
                        success: function(data) { 
                   
                          $("#show_segment").html(data);
                      }
                  });

});



$(".pagination a").on('click', function(){
$('form').attr('action', $(this).attr('href')).submit();
   return false;

});


</script>

<script type="text/javascript">
     $("#card").on('change', function(){
     var id = $(this).val();
     switch(id) {
    case "1":
      window.location.replace('1');
        break;
    case "2":
  window.location.replace('2');
        break;
         case "3":
  window.location.replace('3');
        break;
         case "4":
 window.location.replace('4');
        break;
         case "15":
 window.location.replace('15');
        break;
     }
});
 </script>


<style>
.cpadding0{
height:94px !important;
width:233px !important;
}

.change{
width:10799px !important;
height:743px !important;
}
.breadchange{
margin-top:19px;
margin-left:98px;
}
.blink:hover{display:block}
</style>
