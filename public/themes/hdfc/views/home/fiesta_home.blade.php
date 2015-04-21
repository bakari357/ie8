	    <div class="breadchange">
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Food Fiesta </a></li>
					<li>/</li>
					<li><a href="#"> Offers</a></li>				
				</ul>	
						
			</div>
			<div class="clearfix"></div>
			<div class="brlines" style="width:86%!important;"></div>	
		</div>
		
	

<!---here Starting food fiesta---->
</br>
<div class="container">	
<div class="col-md-12 pagecontainer2 offset-0">

<div class="col-md-6 ">
	<br/>		
	<form method="POST" action="" id="food" name="food">	
<h4 style="margin-top: 21px;display: block;" ><b>Deals Nearby</b></h4>
					
				</div>
							
<div class="col-md-6 nopad">
				<div class="col-md-6">
			          
					<select class="form-control" name="city" id="city" style="margin-left: -397px;">
					<option value="">Select City</option>
				<option value="1"<?php if(isset($_POST['city']) && $_POST['city'] =="1") { echo "Selected";  }?> >----All City----</option>
					<?php  if(isset($fiesta_city)){ $i=1;foreach($fiesta_city as $city_offer) { 

					if(isset($present_city) && ($i==1) ) {
					?>


					<?php  }elseif(isset($_POST['city']) && $_POST['city']!=$city_offer->city){ ?> 
					<option value="<?php echo $city_offer->city; ?>"  <?php if(isset($_POST['city']) && $_POST['city'] == $city_offer->city) { echo "Selected";  }?> ><?php echo ucfirst(strtolower($city_offer->city)); ?></option>

					<?php  }else {?>
					<option value="<?php echo $city_offer->city; ?>" <?php if(isset($_POST['city']) && $_POST['city'] == $city_offer->city) { echo "Selected";  }?> ><?php echo  ucfirst(strtolower($city_offer->city)); ?></option>
					<?php  } $i++; } }?>
					</select>
						
				<div id="city_errmsg"> </div>	
				</div>
					<div  class="col-md-6"> </div>
			<?php if(isset($_POST['segment'])) { $selected=$_POST['segment'];} else { $selected =''; } ?>
			<div class="col-md-6">
			<div>
				
			<?php echo Form::select('segment',$segment,$selected,array( "class"=>"form-control segment","style"=>"margin-left: -380px;","id"=>"segment")); ?>

							</div>
							<div id="segment_errmsg"> </div>
						</div>
						<?php if(isset($selected_hotel)) { $selected=$selected_hotel;} else { $selected =''; } ?>
						<div class="searchbg" style="margin-top: -198px; width: 101px;">
						<div id="show_hotel"> </div>
						<?php echo Form::select('hotel',$hotels,$selected,array( "class"=>"form-control hotel","style"=>"margin-left: -264px;margin-top: 12px; width:228px;","id"=>"hide_hotel")); ?>
       <div id="hotel_errmsg"> </div>
         </div>
						<div class="searchbg" style="margin-top: -198px; width: 101px;">
          <input type="hidden" name="hotel_filter"  id="hotel_filter" />
          <button type="submit" class="btn-search" onclick="return validation_all();">Search</button>
     
        
      </div>  
			</div>
			<div class="clearfix"></div> <div class="line4"></div></br>
			<div style="margin-left:826px;"> <?php echo $foodfiesta_offers->links(); ?> </div>
			</form>
			
			<?php if(count($foodfiesta_offers) > 0) { if(count($foodfiesta_offers) > 4)  { ?>
			 <table cellpadding="10" cellspacing="10" align="center" ><tr>
			 <?php } else { ?>
			  <table cellpadding="10" cellspacing="10" style="margin-left:40px;"><tr>
			 <?php } ?>
			<?php $count= 1; foreach($foodfiesta_offers as $food_offers) {   ?>
			<td>
              <?php if($food_offers->image == ''){
                    $segment_image =  $food_offers->segment; 
              
               ?>
                 <?php $img='<img width="" src="'.Theme::asset()->url('foodfiesta_images/'.$segment_image.'.jpg').'">'; echo HTML::decode(HTML::link('foodfiesta_offer_details/'.$food_offers->id.'', $img)); ?>
               <?php } else { ?>
               
                <?php $img='<img width="" src="uploads/foodfiesta_images/'.$food_offers->image.'">'; echo HTML::decode(HTML::link('foodfiesta_offer_details/'.$food_offers->id.'', $img)); ?>
                <?php } ?>
			
		<?php  if(strlen($food_offers->offer_details) >30){
               $offer_name = preg_replace('/\s+?(\S+)?$/', '', substr($food_offers->offer_details,0,30)).'...';
                }else{
                $offer_name = $food_offers->offer_details;
                }?>	
			
<div class="cpadding0"> <?php echo '<span style="font-size:13px; color:#cc0000"><b>'.$offer_name.'</b></span><br/><span style="font-size:11px;">'.$food_offers->me_name.', '.substr(ucfirst(strtolower($food_offers->address)),0,100).', '.ucfirst(strtolower($food_offers->city)).', '.ucfirst(strtolower($food_offers->state));  if(strlen($food_offers->address) > 100) echo '....';?>.</span></div>
  </td>
  <?php if($count%4==0){?>
  </tr>
  <?php } ?>

  <?php   $count++;   }  ?>     
  </tr>     
</table>
<?php  } else{ ?> 
  	 <b>No Food-Fiesta offer in this Place  </b> 
<?php } ?>
<div style="margin-left:826px;"> <?php echo $foodfiesta_offers->links(); ?> </div>
<!--end!-->
			</div>
</div>

<script>
$("#city").on('change', function(){
 $("#hide_hotel").hide();
 var city = $(this).val();
 
 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_hotels')?>",
                      data: {
               "city":city
              },             
                        success: function(data) {
                    
                          $("#show_hotel").html(data);
                      }
                  });

});

$(".pagination a").on('click', function(){
var hotel_food = $(".hotel").val();
 $("#hotel_filter").val(hotel_food);
 $('form').attr('action', $(this).attr('href')).submit();
    return false;

});

function validation_all(){

    var hotel_food = $(".hotel").val();
    $("#hotel_filter").val(hotel_food);

 if($("#city").val() ==''){
  $("#city_errmsg").html("<font color='#F35958'  style='margin-top: 68px;font-size:12px; font-weight: 400 !important; float: left;margin-left: -390px;'> Please select the City.</font>");
  $("#segment_errmsg").html('');
  $("#hotel_errmsg").html('');
  return false;
 }
 else if($("#segment").val()=='' ){
  $("#segment_errmsg").html("<font color='#F35958'  style='margin-top: 68px;font-size:12px; font-weight: 400 !important; float: left;margin-left: -380px;'> Please select the Category.</font>");
  $("#city_errmsg").html('');
  $("#hotel_errmsg").html('');
  return false;
 }
 else if($(".hotel").val()==''){
  $("#hotel_errmsg").html("<font color='#F35958'  style='margin-top:48px;font-size:12px; font-weight: 400 !important; float: left;margin-left: -261px;'> Please select the hotel.</font>");
  $("#segment_errmsg").html('');
  $("#segment_errmsg").html('');
  return false;
 } 


}

</script>


<style>
.cpadding0{
height:156px !important;
width:232px !important;
}

.change{
width:10799px !important;
height:743px !important;
}
.breadchange{
margin-top:19px;
margin-left:171px;
}
</style>



