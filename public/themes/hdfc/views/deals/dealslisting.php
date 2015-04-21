

<script>
	$(document).ready(function() {
	//$("#food_subcategory").hide();
		$("#city").on('change', function(){
		$("#food_subcategory").hide();
 var city = $(this).val();
 var _token = $("#_token").val();
		 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_deal_areas')?>",
                      data: {
               "city":city,
                  "_token":_token
              },             
                    dataType: "JSON",    success: function(data) {
                    
                          $("#offer_citys").html(data.area);
                          $("#category").html(data.category); 
                          //$("#food_subcategory").html(data.category);
                      }
                  });

		});
		
	$("#category").change(function() {
	
	if($(this).val()=='food'){
	     var city =  $("#city").val();
               var _token = $("#_token").val();
		 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_sub_category')?>",
                      data: {
             
                  "_token":_token,
                  "city":city
              },             
                    dataType: "JSON",    success: function(data) {
                     if(data.count_subcategory > 0){
                      $("#food_subcategory").html(data.sub_category);
                      $("#food_subcategory").show();
                     }else{
                     alert('No Food Fiesta offers are available currently in this place.');
                     }
                     
                      }
                  });

	
	}
	else
	{ 
	$("#food_subcategory").hide();
	}
	 
	
	});
		});
		
		
		
		
   function change_category(){
   
  $("#food_subcategory").hide();    
  var city =  $("#city").val();
  var area =  $("#area").val();
  var _token = $("#_token").val();
  
     $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_deal_category')?>",
                      data: {
               "area":area,"city":city,
                  "_token":_token
              },             
                        dataType: "JSON",    success: function(data) {
                         
	                 //$("#deals_category").html(data);
	                  $("#category").html(data.load_deal_category);
                         
                      }
                  });

		}
		
		
        $(".pagination").on('click', function(){  
	$('form').attr('action', $(this).attr('href')).submit();
	});

</script>



 <div class="breadchange container" style="margin-top: 13px !important;" >
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
			
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Deals </a></li>
					<li>/</li>
					<li><a href="#"> List</a></li>				
				</ul>	
						
			</div>
		
			
		</div>
		
	

<!---here Starting food fiesta---->

<div class="container">
		<div class="container pagecontainer offset-0" >	

			<!-- FILTERS -->
			
			
			<!-- LIST CONTENT-->
			<div class=" col-md-12 offset-0">
			
				<div class="hpadding20">
					<!-- Top filters -->
<form method="POST" action="<?php echo $url = URL::action('dealsController@search_deals'); ?>" id="deals_form" name="deals_form" accept-charset="UTF-8">	
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
					<div class="topsortby">
						<div class="col-md-12">
								
								<div class="col-md-2 nopad"><h4><b>Deals Nearby:</b></h4></div>
								<div class="col-md-2">
							  
									
<?php echo Form::select('offer_city',$offers_city,$citys,array( "class"=>"form-control","id"=>"city")); ?>	
								</div>
								<div class="col-md-2" id="offer_citys">

									
	<?php echo Form::select('area',$areas,$selected_area,array( "class"=>"form-control", "id"=>"area","onchange"=>"change_category();")); ?>	
								</div>
								
							<div class="col-md-2" id="deals_category">
							
	<?php echo Form::select('categeory',$categeory,$selected_categeory,array( "class"=>"form-control","id"=>"category")); ?>	
									
							</div>
							
							<div class="col-md-2" id="food_subcategory"> 
		<?php if(isset($food_sub_catgory) && count($food_sub_catgory) >0) { 	
					
		 echo Form::select('food_sub_catgory',$food_sub_catgory,$selected_sub_category,array( "class"=>"form-control")); ?>
						<?php } ?>	
							</div>
							
						<div class="col-md-2" style="float:right;">
							<button type="submit" id="search" class="btn-search">Search</button>
						</div>
						<div class="col-md-2" >
        			<?php $city = 1; if(isset($_POST['offer_city'])){ $city=$_POST['offer_city']; } else if(isset($citys)){ $city = $citys; } ?>
		       <!--   <?php echo HTML::Decode(HTML::link('fiesta_list/'.$city,'<span  style="color:#0060b1">Click Here</span>',array('id'=>'fiesta_link'))); ?> for Food Fiesta!-->
    					</div>
					</div>
					<!-- End of topfilters-->
</form>
				</div>
				<!-- End of padding -->
				
				<br/><br/>
				<div class="clearfix"></div>
				

	<ul class="offer_list_food">			

	<?php if(count($offers)> 0){ $i=0; foreach($offers as $deals) { ?>


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
                                                 <?php echo '<font color="#034387" style="font-size:13px;"><b>'.$deal_or_food_name.'</b></br></font><span style="font-size:12px; color:#cc0000" ><b>'.$offer_name.'</b></span><span style="font-size:11px;">' ?>.<br/>Address : <?php echo  ucfirst(strtolower($deals->address)); ?></span></div>   
                                            </li>
                                          


<?php $i++;  } }  } else {  ?>
		 <b>No offer are available currently.  </b> 
	
	<?php } ?>	
	</ul>  
<div class="clearfix"></div>
	<div style="float:right; margin-top:20px"><?php  echo $offers->links(); ?> </div>
<div class="clearfix"></div>
 <br><br>

				</div>	
				<!-- End of offset1-->		

				
			</div>
			<!-- END OF LIST CONTENT-->
			
		

		</div>
		<!-- END OF container-->
		
	</div>
	<!-- END OF CONTENT -->
	
	
