	 <div class="container breadcrub" style="margin-top: 13px !important;">
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
				<?php if(isset($_SERVER['HTTP_REFERER'])){$request_from = explode('/', $_SERVER['HTTP_REFERER']);
                             $request =  explode('?',$request_from[5]);
                            }
                             else {  $request[0] ='deals';}
                             
			 $type_id = @$foodfiesta_offers[0]->type_id;


?>
                                 
					 
					 
					   <li>/</li>
 
                                        <?php if($request[0] != 'fiesta_list') { ?>
                                      <li ><?php echo HTML::Decode(HTML::link('dealsandfiesta?city=other', 'Deals')); ?></li>
					 <li>/</li>
<?php } ?>                       <?php if( $type_id!=2) {?>
                  
				<li><?php echo HTML::Decode(HTML::link("fiesta_list", '<span class="b"> Foodfiesta</span>')); ?></li> <li>/</li> 
					<?php } ?>
					<li><a href="#"> Offers</a></li>				
				</ul>	
						
			</div>
			
		</div>
		
	

<!---here Starting food fiesta---->
<br>
<div class="container" style="margin-top: -8px !important;">	
<div class="col-md-12 pagecontainer2 offset-0 container">

<div class="col-md-6 ">
	
	<form method="post" action="<?php echo Config::get('app.url');?>" id="food_form" name="food_form" accept-charset="UTF-8"  >
<?php if(isset($_SERVER['HTTP_REFERER'])){?>		
<h4 style="margin-top: 21px;display: block;" ><b><?php echo @$hotel_name; ?></b></h4>
<?php } ?>					
				</div>
							
<div class="col-md-6 nopad">
				
					<!--<div  class="col-md-6"> </div>
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
         </div>!-->
						<div class="searchbg" style="margin-top: -204px; width: 236px;">
          <input type="hidden" name="hotel_filter"  id="hotel_filter" />
         <!-- <button type="submit" class="btn-search" onclick="goback();">Search</button>!-->
             
            <a  href="#" onclick="goBack()"> <button class="btn-search" type="button" > go back to search </button></a>
     
        </form>
      </div>  
			</div>
			<div class="clearfix"></div> <div class="line4"></div></br>
			
			<?php   if(count($foodfiesta_offers) > 0) {  ?>
			<?php $count= 1; foreach($foodfiesta_offers as $food_offers) {   ?>
			<div class="col-md-12"><div class="col-md-4">	
              <?php if($food_offers->image == ''){
                    $segment_image =  $food_offers->segment; 
              
               ?>
                 <img width="" src="<?php echo Theme::asset()->url('foodfiesta_images/'.$segment_image.'.jpg'); ?>'"> 
               <?php } else { ?>
               
                <img width="" src="<?php echo Theme::asset()->url('uploads/foodfiesta_images/'.$food_offers->image); ?> " style="width: 200px;height: 100px;">
                <?php } ?>
		<?php  if(empty($food_offers->discount_offer)){
					   $current_offer =  $food_offers->offer_details;
					   }else{
					  $current_offer =  $food_offers->discount_offer;
					   }
					     if(strlen( $current_offer) >30){
               $offer_name = $current_offer;//preg_replace('/\s+?(\S+)?$/', '', substr( $current_offer,0,25)).'...';
                }else{
                $offer_name =  $current_offer;
                }?>	
			
			
</div>		
<div class="col-md-8">	 <?php echo '<font color="#034387" style="font-size:16px;"><b>'.$food_offers->proper_me_name.'</b></font></br><span style="font-size:14px; color:#cc0000" ><b>'.str_replace('?','',$offer_name).'</b></span><br/><span style="font-size:13px;">'.str_replace('?','',$food_offers->address).', '.$food_offers->city.', '.$food_offers->state;  ?></span></div>
  
  

  <?php   $count++; if($count ==100){ echo '<div style="margin-left:826px;">'.HTML::Decode(HTML::link('foodfiesta','View All Offers',array('class' => 'btn-search','style'=>'width:162px;'))).'</div>'; break; } echo '</div><div class="clearfix"></div> <div class="line4"></div>'; }  ?>     
      

<?php  } else{ ?> 
  	 <b>No offer are available currently.   </b> 
<?php } ?>


			


	<ul class="offer_list_food">			

	<?php if(count($foodfiesta_offers)  >0){ ?>
<h4 style="padding: 12px 30px 0px 30px;">Top Deals</h4>
</br>
<?php $i=0; foreach($foodfiesta_offers_top as $deals) { ?>


<?php if(!empty($deals)){ if($i==0)
{ ?>



<?php  } ?>
<?php if($i==4)
{ ?>



				

<?php $i=0; } ?>
                                <?php  
                                if(empty($deals->discount_offer)){
					   $current_offer =  $deals->offer_details;
					   }else{
					  $current_offer =  $deals->discount_offer;
					   }
					   
                                
                               
                                
                                if(strlen($current_offer) >30){
                                $offer_name = preg_replace('/\s+?(\S+)?$/', '', substr( $current_offer,0,25)).'...';
                                }else{
                                $offer_name =  $current_offer;
                                }
                                
                                
                                    
			            $name = base64_encode($deals->proper_me_name);
                                    $city = base64_encode($deals->city); 
                                    $seg  = base64_encode($deals->segment);  ?>
			<li>
              <?php 
               $deal_or_food_name='';
                 $filename ='';
                         if($deals->type_id==3){
                         $deal_or_food_name = $deals->proper_me_name;
                         $filename =getcwd().'/uploads/foodfiesta_images/'.$deals->image; 
                         }
                         else{
                           $deal_or_food_name = $deals->deal_name;
                         $filename =getcwd().'/uploads/deals_images/'.str_replace(' ',"",strtolower($deals->segment)).'png'; 
                         
                         }

			if (file_exists($filename)) {
			$segment_image=$deals->image;
			
			} else {
			 if($deals->type_id==3){
			$segment_image='restaurant.jpg';
			
			}
			else{
			$segment_images=str_replace(' ',"",strtolower($deals->segment)).'.png';
			$segment_image=str_replace('/',"",$segment_images);
			}
			}  ?>
					
                                           <?php if($deals->type_id==3){ 
                                                $img='<img style="width: 176px;height: 117px;" src="'.Config::get('app.url').'/uploads/foodfiesta_images/'.$segment_image.'">'; echo HTML::decode(HTML::link('get_hotels/'.$name.'/'.$city.'/'.$seg.'', $img));
        }
        else{
             $img='<img style="width: 176px;height: 117px;" src="'.Config::get('app.url').'/uploads/deals_images/'.$segment_image.'">'; echo HTML::decode(HTML::link('get_hotels/'.$name.'/'.$city.'/'.$seg.'', $img));
        
        }                                        
                                                
 ?>
                                             <div class="cpadding01"> 
                                                 <?php echo '<font color="#034387" style="font-size:13px;"><b>'.$deal_or_food_name.'</b></br></font><span style="font-size:12px; color:#cc0000" ><b>'.$offer_name.'</b></span><span style="font-size:11px;">' ?>.<br/>Address : <?php echo  str_replace('?','',$deals->address); ?></span></div>   
                                            </li>
                                          


<?php $i++;  } }  }  ?>	
	</ul> 
  	 
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

$(".btn-search").on('click', function(){
       
      
            $('food_form').submit();
          //  return false;

});

function goBack() {
    window.history.back();	
}


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



