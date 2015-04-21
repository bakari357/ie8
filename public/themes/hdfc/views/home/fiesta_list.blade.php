 <div class="container breadcrub" style="margin-top: 13px !important;">
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Food Fiesta </a></li>
					<li>/</li>
					<li><a href="#"> Offers</a></li>				
				</ul>	
						
			</div>
			
		</div>
		
	

<!---here Starting food fiesta---->
<br>
<div class="container">	
<div class="container col-md-12 pagecontainer2 offset-0">

<div class="col-md-12" style="padding-top:20px">
	<form method="post" action="<?php echo $url = URL::action('dealsController@search_fiesta'); ?>" id="food_form" name="food_form" accept-charset="UTF-8" >	<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
	
		<div class="col-md-2 nopad">
		<h4 style="display: block;" ><b>Food Fiesta</b></h4>
		</div>
			<div class="col-md-2">
					
	<?php echo Form::select('city',$fiesta_city,$city_set,array( "class"=>"form-control","id"=>"city")); ?>		
				<div id="city_errmsg"> </div>	
			</div>
			<div class="col-md-2" id="foodfieasta_area_load">
				<?php   if(isset($area_set)) { $area_selected=$area_set;} else { $area_selected =''; } ?>
                                
		<?php echo Form::select('area',$areas,$area_selected,array( "class"=>"form-control select_height","id"=>"food_area", "onchange"=>"cusion();")); ?>
		
			</div>
				
			<?php if(isset($category_set)) { $selected=$category_set;} else { $selected =''; } ?>
			<div class="col-md-2" >
				
	<?php echo Form::select('segment',$segment,$selected,array( "class"=>"form-control segment","id"=>"newcusine")); ?>
			
			</div>
		                       <div id="segment_errmsg"> </div>
					
					
						<div class="col-md-2">
          <input type="hidden" name="hotel_filter"  id="hotel_filter" />
          <button type="submit" onclick="return fiesta_validation();" class="btn-search">Search</button>
    			 </div> 
     

        	<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
        </form>
        	
       
			</div>
			<div class="clearfix"></div> <div class="line4"></div></br>
			
			<?php if(count($foodfiesta_offers_list) > 0) { if(count($foodfiesta_offers_list) > 4)  { ?>
			<ul class="offer_list_food">
			 <?php } else { ?>
			 <ul class="offer_list_food">
			 <?php } ?>
			<?php $count= 1; foreach($foodfiesta_offers_list as $food_offers) {  
                                    $name = base64_encode($food_offers->proper_me_name);
                                    $city = base64_encode($food_offers->city); 
                                    $seg  = base64_encode($food_offers->segment);  ?>
			<li>
              <?php $filename =getcwd().'/uploads/foodfiesta_images/'.$food_offers->image; 

			if (file_exists($filename)) {
			$segment_image=$food_offers->image;
			
			} else {
			$segment_image='restaurant.jpg';
			}  ?>
		 <?php $img='<img style="width: 176px;height: 117px;" src="'.Config::get('app.url').'/uploads/foodfiesta_images/'.$segment_image.'">'; echo HTML::decode(HTML::link('get_hotels/'.$name.'/'.$city.'/'.$seg.'', $img));
		 
 ?>                  
                    <?php   
                    if(strlen($food_offers->discount_offer) >30){
                    $offer_name = preg_replace('/\s+?(\S+)?$/', '', substr($food_offers->discount_offer,0,25)).'...';
                    }else{
                    
                    $offer_name = $food_offers->discount_offer;
                    }
                    
                    
                    
                    
                    ?>	
			
			
<div class="cpadding01"> <?php echo '<font color="#034387" style="font-size:13px;"><b>'.$food_offers->proper_me_name.'</b></br></font><span style="font-size:12px; color:#cc0000" ><b>'.str_replace('?','',$offer_name).'</b></span><br/><span style="font-size:11px;">'.substr($food_offers->address,0,100).', '.$food_offers->city.', '.$food_offers->state;  if(strlen($food_offers->address) > 100) echo '....';?>.</span></div>
  </li>
  <?php if($count%4==0){?>
  
  <?php } ?>

  <?php   $count++;  }  ?>     
  </ul>
                        </ul>
                        
<?php   } else{ ?> 
  	 <b>No offer are available currently.  </b> 
<?php } ?>
<div class="clearfix"></div>
<div style="float:right; margin-top:20px"><?php  echo $foodfiesta_offers_list->links();  ?> </div>
<!--end!-->
			</div>
</div>

<script>
function cusion(){
var city =  $("#city").val();
var area =  $("#food_area").val();
var _token =  $("#_token").val();
 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_foodfiesta_cusine')?>",
                      data: {
               "area":area,"city":city,"_token":_token
              },             
                      dataType: "JSON",    success: function(data) {
                      
	                 $("#newcusine").html(data.cusine);
                         
                      }
                  });
}

$("#city").on('change', function(){
 
var paying_to =  $(this).val();
var _token =  $("#_token").val();
 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('foodfiesta_area_fiesta')?>",
                      data: {
               "area":paying_to,"_token":_token
              },             
                        dataType: "JSON",    success: function(data) {
                 
                         $("#food_area").html(data.area);
                          $("#newcusine").html(data.segment);
                      }
                  });

});



$(".pagination").on('click', function(){

     var hotel_food = $(".hotel").val();
    
     $("#hotel_filter").val(hotel_food);
     var s= $('form').attr('foodfiesta', $(this).attr('href'));
     $('form').attr('action', $(this).attr('href')).submit();
            
          

});


function fiesta_validation(){

if($("#city").val()==''){
$("#city_errmsg").html("<font color='#F35958'  style='margin-top: 63px;font-size:12px; font-weight: 400 !important;'> Please select the city.</font>");
return false;
}
else if($("#food_area").val()=='Select Area' ){
  $("#segment_errmsg").html("<font color='#F35958'  style='margin-top: 43px;font-size:12px; font-weight: 400 !important; float: left;margin-left: -335px;'> Please select the Area.</font>");
  $("#city_errmsg").html('');
  $("#hotel_errmsg").html('');
  return false;
 }
 
}

</script>


<style>
.cpadding01{
height:156px !important;
width:232px !important;
}

.change{
width:10799px !important;
height:743px !important;
}
.breadchange{
margin-top:19px;

}
</style>


