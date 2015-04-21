<script type="text/javascript" src="themes/hdfc/assets/js/image-scale.js"></script>
<script type="text/javascript" src="themes/hdfc/assets/js/image-scale.min.js"></script>



<style>
.deals_padd { padding: 3px 10px 0px 10px;
margin-top: 5px; }
.form_control_deals{
display: block;
width: 48%;
height: 34px;
padding: 6px 8px 6px 8px;
font-size: 14px;
line-height: 1.428571429;
color: #999;
vertical-align: middle;
background-color: #ffffff;
border: 1px solid #DBD9D9;
border-radius: 4px;
-webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;

}
.select_height{
height:32px;
margin-top:0px;
}
.deals_padd_food { padding: 8px 2px 0px 3px;
margin-top: 8px; }
.searchbg_food {
height: 62px;
width: 88%;
position: absolute;
top: 211px;
right: -2px;
display: block;
z-index: 100;
}
</style>
<script>

function setMainColumnWidth(){
    var mainColumnWidth = $(".border-box:first").width();
    $(".caroufredsel_wrapper").css("width", 900);
}
function cusion(){

var city =  $("#foodfieasta_city").val();
var area =  $("#food_area").val();
var _token =  $("#_token").val();
 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_foodfiesta_cusine')?>",
                      data: {
              			 "area":area,"city":city,"_token":_token
             		    },             
                        success: function(data) {
                         
	                 $("#load_foodfiesta_cusine").html(data);
                         
                      }
                  });
}
function change_category(){

var city =  $("#city").val();
var area =  $("#area").val();
var _token =  $("#_token").val();
 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_deal_category')?>",
                      data: {
               "area":area,"city":city,"_token":_token
              },             
                         dataType: "JSON",    success: function(data) {
	                  $("#categeory").html(data.load_deal_category);
                      }
                  });
		}

$(document).ready(function() {

$("#foodfieasta_city").on('change',function(){
var paying_to =  $(this).val();
var _token =  $("#_token").val();

 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_foodfiesta')?>",
                      data: {
               "area":paying_to,"_token":_token
              },             
                        success: function(data) {
                         
	                 $("#foodfieasta_area_load").html(data);
                         
                      }
                  });
});
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  e.target // activated tab
  e.relatedTarget // previous tab
   jQuery("#foo10").carouFredSel({
		width: "100%",
		height: 240,
		items: {
			visible:4,
			minimum: 1,
			start: 4
		},
                
		scroll: {
			items: 1,
			easing: "easeInOutQuad",
			duration: 500,
			pauseOnHover: true
		},
		auto: false,				
		prev: {
			button: "#prev_btn10",
			key: "left"
		},
		next: {
			button: "#next_btn10",
			key: "right"
		},				
		swipe: true
	});
	jQuery("#foo9").carouFredSel({
		width: "100%",
		height: 240,
		items: {
			visible:4,
			minimum: 1,
			start: 4
		},
                
		scroll: {
			items: 1,
			easing: "easeInOutQuad",
			duration: 500,
			pauseOnHover: true
		},
		auto: false,				
		prev: {
			button: "#prev_btn9",
			key: "left"
		},
		next: {
			button: "#next_btn9",
			key: "right"
		},				
		swipe: true
	});
	jQuery("#foo5").carouFredSel({
		width: "100%",
		height: 240,
		items: {
			visible:4,
			minimum: 1,
			start: 4
		},
                
		scroll: {
			items: 1,
			easing: "easeInOutQuad",
			duration: 500,
			pauseOnHover: true
		},
		auto: false,				
		prev: {
			button: "#prev_btn5",
			key: "left"
		},
		next: {
			button: "#next_btn5",
			key: "right"
		},				
		swipe: true
	});
})
	$("#food_form").validate({

		rules: {
			
			city : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
				},
			segmentt : {
			required: {depends:function(){$(this).val($.trim($(this).val()));return true;} }
			
			}
						
		},
		messages: {
			email: { 
			required: "required.",
			email: "Please Enter a Valid Email-Address."
			},
			
			account_no:{
			required: "required.",
			minlength: "please enter valid account number."
			}
		},
        submitHandler: function(frm) {
        submit();
        }
		
		
		});
		
		$("#city").on('change', function(){
 	
 var city = $(this).val();
 var _token =  $("#_token").val();
 $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_deal_areas')?>",
                      data: {
               "city":city,"_token":_token
              },             
                    dataType: "JSON",    success: function(data) {
                    
                          $("#offer_citys").html(data.area);
                         // $("#deals_category").html(data.category);
                          $("#categeory").html(data.category);
                          
                      }
                  });

});
		});
		
$(window).resize(function() {
    setMainColumnWidth();
});
	
</script>
<style>
.decrease{
height:297px !important;
}
</style>
<div class="">
<div class="" >
  <div class="">
    <div class="container mt15">
      <div class="">
        <div class="row">
          <div class="col-md-8">
			
            <!--
							#################################
								- THEMEPUNCH BANNER -
							#################################
							-->
            <div class="fullwidthbanner" style="box-shadow: rgba(0, 0, 0, 0.13) 0px 5px 5px;">
              <ul>
                <!-- papercut fade turnoff flyin slideright slideleft slideup slidedown-->
                <!-- FADE -->
                <!-- FADE -->
                <?php foreach($banners as $banner){ 
                
                 
                 $prim = $banner->primary_image;
                 $images = json_decode($banner->images);
                 $image = $images; 
               
                 if($prim <> ''){
                   $image  = $images->$prim; 
                 }
                 else{
                 foreach($images as $key => $image){
                 $prim = $key; 
                 break; 
                 }
                 $image =  $images->$prim; 
                 }
                
                
                  ?>
                    
                		
                <li data-transition="fade" data-slotamount="1" data-masterspeed="300"> <img src="<?php echo '/smartbuy_admin/public/uploads/banners/'.$image->filename; ?>" alt=""/>
               
                </li>
                 <?php } ?> 
                
                
              </ul>
              <div class="tp-bannertimer none"></div>
            </div>
            <!--
						##############################
						 - ACTIVATE THE BANNER HERE -
						##############################
						-->
            <script type="text/javascript">

							var tpj=jQuery;
							tpj.noConflict();

							tpj(document).ready(function() {

							if (tpj.fn.cssOriginal!=undefined)
								tpj.fn.css = tpj.fn.cssOriginal;

								var api = tpj('.fullwidthbanner').revolution(
									{
										delay:9000,
										startwidth:732,
										startheight:356,

										onHoverStop:"on",						// Stop Banner Timet at Hover on Slide on/off

										thumbWidth:100,							// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
										thumbHeight:50,
										thumbAmount:3,

										hideThumbs:0,
										navigationType:"bullet",				// bullet, thumb, none
										navigationArrows:"none",				// nexttobullets, solo (old name verticalcentered), none

										navigationStyle:"round",				// round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom


										navigationHAlign:"right",				// Vertical Align top,center,bottom
										navigationVAlign:"bottom",					// Horizontal Align left,center,right
										navigationHOffset:30,
										navigationVOffset:30,

										soloArrowLeftHalign:"left",
										soloArrowLeftValign:"center",
										soloArrowLeftHOffset:20,
										soloArrowLeftVOffset:0,

										soloArrowRightHalign:"right",
										soloArrowRightValign:"center",
										soloArrowRightHOffset:20,
										soloArrowRightVOffset:0,

										touchenabled:"off",						// Enable Swipe Function : on/off


										stopAtSlide:-1,							// Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
										stopAfterLoops:-1,						// Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic

										hideCaptionAtLimit:0,					// It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
										hideAllCaptionAtLilmit:0,				// Hide all The Captions if Width of Browser is less then this value
										hideSliderAtLimit:0,					// Hide the whole slider, and stop also functions if Width of Browser is less than this value


										fullWidth:"on",

										shadow:2								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)

									});

									
									
									
									

									// TO HIDE THE ARROWS SEPERATLY FROM THE BULLETS, SOME TRICK HERE:
									// YOU CAN REMOVE IT FROM HERE TILL THE END OF THIS SECTION IF YOU DONT NEED THIS !
										api.bind("revolution.slide.onloaded",function (e) {


											jQuery('.tparrows').each(function() {
												var arrows=jQuery(this);

												var timer = setInterval(function() {

													if (arrows.css('opacity') == 1 && !jQuery('.tp-simpleresponsive').hasClass("mouseisover"))
													  arrows.fadeOut(300);
												},3000);
											})

											jQuery('.tp-simpleresponsive, .tparrows').hover(function() {
												jQuery('.tp-simpleresponsive').addClass("mouseisover");
												jQuery('body').find('.tparrows').each(function() {
													jQuery(this).fadeIn(300);
												});
											}, function() {
												if (!jQuery(this).hasClass("tparrows"))
													jQuery('.tp-simpleresponsive').removeClass("mouseisover");
											})
										});
									// END OF THE SECTION, HIDE MY ARROWS SEPERATLY FROM THE BULLETS

						});
						
						
						
						
						jQuery(document).ready(function($){
							// gets the width of black bar at the bottom of the slider
							var $gwsr = $('.scolright').outerWidth();
							$('.blacklable').css({'width' : $gwsr +'px'});
						});
						jQuery(window).resize(function() {
							jQuery(document).ready(function($){

								// gets the width of black bar at the bottom of the slider
								var $gwsr = $('.scolright').outerWidth();
								$('.blacklable').css({'width' : $gwsr +'px'});

							});
						});
		 

						</script>
          </div>
          <!--- first right -->
          <div class="col-md-4">
<div class="pagecontainer2 alsolikebox">
  <div class="row" style="min-height: 141px;">
 <h4  style="margin-left:20px;margin-top: 12px;margin-bottom: 18px;">Top Offers  </h4>
                 <?php foreach($top_offers as $offers_t) { 
               if(strlen($offers_t->short_description) > 40){
               $offer_desc = preg_replace('/\s+?(\S+)?$/', '', substr( $offers_t->short_description,0,40)).'...';
               }else{
               $offer_desc =$offers_t->short_description;
               }
                 ?>
                       <div class="col-md-12" style="margin-left: -12px;margin-bottom: 50px;">
<div class="col-md-2">
<?php $cont='<img  src="'.Config::get('app.url').'uploads/offer_images/thumbs/'.str_replace('png','jpg',$offers_t->image).'"  style="height: 38px;width: 44px;" alt=""/></div> <div class="col-md-10" ><font style="font-size:12px;">'.$offers_t->deal_name .'</fornt><br><font  style="font-size:12px;">'. $offer_desc.'</fornt></a>';
echo HTML::decode(HTML::link('offer_details/'.$offers_t->id.'/1', $cont)); ?></div></div>

<?php } ?>
<div class="line5 clearfix"></div> 
</div>
            
<div class="row" style="margin-top: -11px;">
<form method="post" action="dealsandfiesta" id="deals" name="deals" accept-charset="UTF-8">	
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<div class=" deals_padd clearfix">

<select name="cityss"  class="form_control_deals select_height left" id="city">
<option>Select City</option>
<option value="1">--ALL--</option>
<?php foreach($offers_city as $citys) { ?>
<option value="<?php echo $citys->city; ?>" ><?php echo  ucfirst(strtolower($citys->city)); ?></option>
<?php } ?>
</select>
<div id="offer_citys">


<select class="form_control_deals select_height right" id="area" name="area">
<option>Select Area</option>
<?php foreach($areas as $areass) { ?>
<option value="<?php echo str_replace('?','',$areass->area); ?>" ><?php echo  ucfirst(strtolower(str_replace('?','',$areass->area))); ?></option>
<?php } ?>
</select>
</div>
<div id="city_error"> </div>

</div>


<div class=" deals_padd clearfix">
<div id="deals_category">
<select name="categeory" id="categeory" class="form_control_deals select_height left"  >
<option value="">Select Category</option>
<?php foreach($categeory as $cat) { ?>
<option value="<?php echo str_replace('?','',$cat->segment); ?>" ><?php echo  ucfirst(strtolower(str_replace('?','',$cat->segment))); ?></option>
<?php } ?>
</select>
</div>
       
          <button type="submit" class="btn-search right" onclick="return deals_validation();" style="width: 48%;margin-top: 0;
margin-right: 0 !important; height: 32px;">Search</button>
       
      
</div>

 <div class="line5 clearfix" style="margin-top: 10px;" ></div> 
 </form>
</div>
<div class="pagecontainer2" style="border: none;background: none;box-shadow: none;height: 98px;top:2px;">
              <div > <span class="icon-location">

  
<span style="float:left;text-decoration: underline;"><?php echo HTML::link('dealsandfiesta?city='.$city, $city); ?></span><a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="lightcaret" style="position: absolute;top: 5px;" ></span></a>
					<ul class="dropdown-menu">
					  <?php if($city!='Bangalore'){ ?><li><?php echo HTML::link('dealsandfiesta?city=Bangalore', 'Bangalore'); ?></li><?php } ?>
					  <?php if($city!='Chennai'){ ?><li><?php echo HTML::link('dealsandfiesta?city=Chennai', 'Chennai'); ?></li><?php } ?>
					<?php if($city!='Delhi'){ ?><li><?php echo HTML::link('dealsandfiesta?city=Delhi', 'Delhi'); ?></li><?php } ?>
					
					<?php if($city!='Gurgaon'){ ?><li><?php echo HTML::link('dealsandfiesta?city=Gurgaon', 'Gurgaon'); ?></li><?php } ?>
					<?php if($city!='Hyderabad'){ ?><li> <?php echo HTML::link('dealsandfiesta?city=Hyderabad', 'Hyderabad'); ?></li><?php } ?>
					<?php if($city!='Bombay'){ ?><li><?php echo HTML::link('dealsandfiesta?city=Mumbai', 'Mumbai'); ?></li><?php } ?>
					<?php if($city!='Pune'){ ?><li><?php echo HTML::link('dealsandfiesta?city=Pune', 'Pune'); ?></li><?php } ?>
	<li><?php echo HTML::link('dealsandfiesta?city=other', 'Other Cities'); ?></li>
					</ul> </span>
                <h4  style="margin-left:20px;margin-top: 2px;">Deals Nearby  </h4>
               
                      
              </div>
<?php $s=0; foreach($offers as $offers_list){ 
     
    
	if(empty($offers_list->discount_offer)){
	$current_offer =  $offers_list->offer_details;
	}else{
	$current_offer =  $offers_list->discount_offer;
	}
	if(strlen( $current_offer) >30){
	$offer_name = preg_replace('/\s+?(\S+)?$/', '', substr( $current_offer,0,25)).'...';
	}else{
	$offer_name =  $current_offer;
	}	
     
     
       if(strlen($offers_list->address) >40){
       $address = preg_replace('/\s+?(\S+)?$/', '', substr($offers_list->address,0,50)).'...';
       }else{
       $address = $offers_list->address;
       }
?>
              <div class="cpadding1">
            
              
<?php echo '<font color="#034387" style="font-size:13px;"><b>'.$offers_list->proper_me_name.'</b></br></font><font color="#cc0000" style="font-size:12px;">'.$offer_name.'</font></br><font style="font-size:12px;"> '.$address;?></font>

             
 </div>            
		
            
            <?php $s++; } ?>
</div>






   
            
          </div>  
          </div>
        </div>
        <!-- end-->
      </div>
      <!-- end of row -->
    </div>
  </div>
</div>
</div>
<!---here banners2 flipkart---->

<div class="clearfix"></div>
</br>
 <div class="container mt20" >
 
  <div class="row">
     <?php if(isset($flipkart_banners) && count($flipkart_banners) > 0) { $i =1;
    foreach($flipkart_banners[0] as $banners1){ 
     $offer_url='';
     $offer_url = str_replace('/dl','',$banners1->offer_url); 
     $offer_urls =array();
     $offer_urls = explode('http://', $offer_url);
     //echo '<pre>'; print_r($offer_urls);
     $final_offer_url ='';
     if($offer_urls[0]==''){
     $final_offer_url ='http://'.$offer_urls[1];
     } 
     else{
     $final_offer_url='http://'.$offer_urls[0];
     }
if($i==1){ ?>

     <div class="col-xs-12 col-sm-4 nopad pb_10">
      <?php }else{ ?> 
 <div class="col-xs-12 col-sm-4 pb_10">
<?php } if(date("Y-m-d H:i:s",strtotime($banners1->end_date)) > date("Y-m-d H:i:s")) {?>
        <div class="boxshadow center"><a   href="javascript:void(0)" onclick="return redirect_url('<?php echo $final_offer_url;?>');"><img src="<?php echo $banners1->image360x140; ?>" style="height: 173px;"  class="mwimg" /></a></div> 
      </div>
    <?php if($i==2){
    break;
    }?>
    <?php } $i++;} ?>
    
 
    <?php } else { ?>
    
  <b> No Flipkart Banners Found </b>
 
   <?php }  ?>
<div class="col-xs-12 col-sm-4 nopad pb_10" id="offer_banner">
<div class="boxshadow center">
         <div class="list_carousel">

            <ul id="foo11">
       <?php foreach($offer_banner as $banner){ 
                
                
                 $prim = $banner->primary_image;
                 $images = json_decode($banner->images);
                 $image = $images; 
                 
                 if($prim <> ''){

                   $image  = $images->$prim;
			 $link=$images->$prim->url; 
                 }
                 else{
                 foreach($images as $key => $image){
                 $prim = $key; 
                 break; 
                 }
                 $image =  $images->$prim; 
		$link=$images->$prim->url;
                 }
                
                
                  ?>
                    
                		
         <li class="border-box">
             
                <!--<p><img src="<?php echo Theme::asset()->url('images/new-tag.png'); ?>" /></p>!-->
                <a href="<?php echo $link; ?>"><img  src="<?php echo '/smartbuy_admin/public/uploads/banners/'.$image->filename; ?>"  alt=""/></a>
              
            </li>
                 <?php } ?>   
 
          <!--  <li class="border-box">
              
                <a href="#" target="_blank"><img  src="<?php echo Theme::asset()->url('images/b2.png'); ?>"  alt=""/></a>
               
                
             
            </li> -->
            </ul>
            <div class="clearfix"></div>
          <a id="prev_btn11" class="prev" href="#"><img src="<?php echo Theme::asset()->url('images/spacer.png'); ?>" alt=""/></a> <a id="next_btn11" class="next" href="#"><img src="<?php echo Theme::asset()->url('images/spacer.png'); ?>" alt=""/></a> </div>
          
      </div>
	 </div>		
	</div> <!-- TAB 1  end-->
</div>
 <div class="clearfix"></div>




 
 <!--<p class="lato size30 slim">Flipkart Offers</p>!-->
<div class="container mt25 offset-0 mmt25" style="top: 56px;position: relative;">
  <div class="col-md-12 pagecontainer2 tab-pdt offset-0 homehide ">
  
    <ul class="nav nav-tabs" id="myTab">
					<li onclick="mySelectUpdate()" class="active"><a data-toggle="tab" href="#bellsellers"><span class=""></span><span class="hidetext  text-18">Credit Card</span>&nbsp;</a></li>
					
					
					<li onclick="mySelectUpdate()" class=""><a data-toggle="tab" href="#wtnew"><span class=""></span><span class="hidetext  text-18">Debit Card</span>&nbsp;</a></li>
					
					
					<li onclick="mySelectUpdate()" class=""><a data-toggle="tab" href="#dealsofday"><span class=""></span><span class="hidetext  text-18">Net Banking</span>&nbsp;</a></li>
				
				</ul>			
    <div class="tab-content4 " >
    
    <!-- TAB 1 -->				
	<div id="bellsellers" class="tab-pane fade active in">
	 <div class="wrapper">
         <div class="list_carousel homecaro">

            <ul id="foo10">
          <?php if(isset($cc_offers) && count($cc_offers) > 0) { 
             foreach($cc_offers as $sub_offer) { 
             
if(isset($sub_offer->image))
	$segment_image =  $sub_offer->image; 
	
       	$filename = public_path().'/uploads/offer_images/'.$segment_image;
	 
	if (file_exists($filename)){ 
	$image =Config::get('app.url').'uploads/offer_images/'.$segment_image ;
	} else {  
	$image =Theme::asset()->url('offers_images/offer_card/2-card.jpg');
	}
             
             ?>
 <li class="border-box">
              <div class="box-product">
                 <?php $img='<img width="226" hight="61" src="'.$image.'">';
        echo HTML::decode(HTML::link('offer_details/'.$sub_offer->id.'/10', $img)); ?>
                <div class="carousel-list mt30">
                  <div class="price-list"> <span class="price-new"> <?php echo $sub_offer->deal_name;?></span>  </div>
                </div>
                <div class="mt50 mt45">
                  <h6 class="lh1 dark"><b><?php echo $sub_offer->short_description;?></b></h6>
                 <!-- <div class="buy-btn mt-10"> <span><img src="<?php echo Theme::asset()->url('images/buy_left.png'); ?>" alt=""  /></span><a href="<?php echo $final_offer_url ;?>" target="_blank" class="mt15" style="display: inline !important;padding: 12px;">Buy Now</a> </div>-->
                </div>
              </div>
            </li> 
           <?php } ?> 
            
          <?php } else {  ?>
           <b> No Flipart Best Sellers Found.</b>
          <?php } ?>
</ul>
            <div class="clearfix"></div>
          <a id="prev_btn10" class="prev" href="#"><img src="<?php echo Theme::asset()->url('images/spacer.png'); ?>" alt=""/></a> <a id="next_btn10" class="next" href="#"><img src="<?php echo Theme::asset()->url('images/spacer.png'); ?>" alt=""/></a> </div>
      </div>
			
	</div> <!-- TAB 1  end-->
					
    
     
      
      <!-- TAB 2 -->
	<div id="wtnew" class="tab-pane fade ">
					
	<div class="wrapper">
	<div class="list_carousel homecaro">
	 <ul id="foo9">
          <?php if(isset($dc_offers) && count($dc_offers) > 0) { 
             foreach($dc_offers as $sub_offer) { 
             
if(isset($sub_offer->image))
	$segment_image =  $sub_offer->image; 
	
       	$filename = public_path().'/uploads/offer_images/'.$segment_image;
	 
	if (file_exists($filename)){ 
	$image =Config::get('app.url').'uploads/offer_images/'.$segment_image ;
	} else {  
	$image =Theme::asset()->url('offers_images/offer_card/1-card.jpg');
	}
             
             ?>
 <li class="border-box">
              <div class="box-product">
                 <?php $img='<img width="226" hight="61" src="'.$image.'">';
        echo HTML::decode(HTML::link('offer_details/'.$sub_offer->id.'/5', $img)); ?>
                <div class="carousel-list mt30">
                  <div class="price-list"> <span class="price-new"> <?php echo $sub_offer->deal_name;?></span>  </div>
                </div>
                <div class="mt50 mt45">
                  <h6 class="lh1 dark"><b><?php echo $sub_offer->short_description;?></b></h6>
                 <!-- <div class="buy-btn mt-10"> <span><img src="<?php echo Theme::asset()->url('images/buy_left.png'); ?>" alt=""  /></span><a href="<?php echo $final_offer_url ;?>" target="_blank" class="mt15" style="display: inline !important;padding: 12px;">Buy Now</a> </div>-->
                </div>
              </div>
            </li> 
           <?php } ?> 
            
          <?php } else {  ?>
           <b> No Flipart Best Sellers Found.</b>
          <?php } ?>
 </ul>
            <div class="clearfix"></div>
           
          <a id="prev_btn9" class="prev" href="#"><img src="<?php echo Theme::asset()->url('images/spacer.png'); ?>" alt=""/></a> <a id="next_btn9" class="next" href="#"><img src="<?php echo Theme::asset()->url('images/spacer.png'); ?>" alt=""/></a> </div>
      </div>
						 
			</div>
					
					<!-- TAB 3 -->					
		<!-- TAB 3 -->					
					<div id="dealsofday" class="tab-pane fade">
					 <div class="wrapper">
         <div class="list_carousel homecaro">

           <ul id="foo5">
               <?php if(isset($net_offers) && count($net_offers) > 0) { 
             foreach($net_offers as $sub_offer) { 
             
if(isset($sub_offer->image))
	$segment_image =  $sub_offer->image; 
	
       	$filename = public_path().'/uploads/offer_images/'.$segment_image;
	 
	if (file_exists($filename)){ 
	$image =Config::get('app.url').'uploads/offer_images/'.$segment_image ;
	} else {  
	$image =Theme::asset()->url('offers_images/offer_card/3-card.jpg');
	}
             
             ?>
 <li class="border-box">
              <div class="box-product">
                 <?php $img='<img width="226" hight="61" src="'.$image.'">';
        echo HTML::decode(HTML::link('offer_details/'.$sub_offer->id.'/5', $img)); ?>
                <div class="carousel-list mt30">
                  <div class="price-list"> <span class="price-new"> <?php echo $sub_offer->deal_name;?></span>  </div>
                </div>
                <div class="mt50 mt45">
                  <h6 class="lh1 dark"><b><?php echo $sub_offer->short_description;?></b></h6>
                 <!-- <div class="buy-btn mt-10"> <span><img src="<?php echo Theme::asset()->url('images/buy_left.png'); ?>" alt=""  /></span><a href="<?php echo $final_offer_url ;?>" target="_blank" class="mt15" style="display: inline !important;padding: 12px;">Buy Now</a> </div>-->
                </div>
              </div>
            </li> 
           <?php } ?> 
            
          <?php } else {  ?>
           <b> No Flipart Best Sellers Found.</b>
          <?php } ?>
            
            
           </ul>
            <div class="clearfix"></div>
          <a id="prev_btn5" class="prev" href="#"><img src="<?php echo Theme::asset()->url('images/spacer.png'); ?>" alt=""/></a> <a id="next_btn5" class="next" href="#"><img src="<?php echo Theme::asset()->url('images/spacer.png'); ?>" alt=""/></a> </div>

      </div>	
						
					</div>
					
					<!-- TAB 4 -->	
					
								
					
								

   
      </div>
						
					</div>	
</div>	
	<div class="container" style="margin-top: 78px;" >
 <div class="clearfix"></div>
  <div class="row">
 
    
  
  
     <div class="col-xs-12 col-sm-4 nopad pb_10">
      
     <div class="boxshadow center"> <a href="javascript:void(0)" onclick="return redirect_url('http://hdfcsmartbuy.store.flipkart.com/luxury-store-watches&icmpid=mntz_rhscard');" ><img src="<?php echo Theme::asset()->url('flipkart_images/1.jpg'); ?>"  alt="" style="height: 168px;"  class="mwimg" /> </a>
   
    </div>
  
  </div>
  

    
  
   
 <div class="col-xs-12 col-sm-4 pb_10">

     <div class="boxshadow center"> <a href="javascript:void(0)" onclick="return redirect_url('http://hdfcsmartbuy.store.flipkart.com/poe?otracker=hp_nmenu_sub_men_1_POE');" ><img src="<?php echo Theme::asset()->url('flipkart_images/2.jpg'); ?>"  alt="" style="height: 168px;"  class="mwimg" /> </a>
   
    </div>
  
  </div>
  

    
  
  
     <div class="col-xs-12 col-sm-4 nopad pb_10">
      
     <div class="boxshadow center"> <a href="javascript:void(0)" onclick="return redirect_url('http://hdfcsmartbuy.store.flipkart.com/offers-zone/lifestyle?cacheRefresh=true&storeGroup=fashion&otracker=hp_imgModule_7_OffersinFashion');" ><img src="<?php echo Theme::asset()->url('flipkart_images/3.jpg'); ?>"  alt="" style="height: 168px;"  class="mwimg" /> </a>
   
    </div>
  
  </div>
  

   </div>
</div>		
<div class="container" style="margin-top: 25px;" >
 <div class="clearfix"></div>
  <div class="row">
 
    
  
  
     <div class="col-xs-12 col-sm-4 nopad pb_10">
      
     <div class="boxshadow center"> <a href="javascript:void(0)" onclick="return redirect_url('http://hdfcsmartbuy.store.flipkart.com/premium-beauty-store?otracker=hp_mod_lifestyle_bn_middle');" ><img src="<?php echo Theme::asset()->url('flipkart_images/4.jpg'); ?>"  alt="" style="height: 241px;"  class="mwimg" /> </a>
   
    </div>
  
  </div>
  

    
  
   
 <div class="col-xs-12 col-sm-4 pb_10">

     <div class="boxshadow center"> <a href="javascript:void(0)" onclick="return redirect_url('http://hdfcsmartbuy.store.flipkart.com/arihant-test-series-jee-main-2015/p/itmeffg7smg3ybz2?pid=EDMEFFG59ZNKFAYB&otracker=hp_mod_books_bn_middle');" ><img src="<?php echo Theme::asset()->url('flipkart_images/5.jpg'); ?>"  alt="" style="height: 241px;"  class="mwimg" /> </a>
   
    </div>
  
  </div>
  

    
  
  
     <div class="col-xs-12 col-sm-4 nopad pb_10">
      
     <div class="boxshadow center"> <a href="javascript:void(0)" onclick="return redirect_url('http://hdfcsmartbuy.store.flipkart.com/sports-fitness/indoor-sports-games/chess/pr?sid=dep,mq9,5s4&otracker=hp_mod_rest_bn_middle');" ><img src="<?php echo Theme::asset()->url('flipkart_images/6.jpg'); ?>"  alt="" style="height: 241px;"  class="mwimg" /> </a>
   
    </div>
  
  </div>
  

   </div>
</div>	
			

<!---here Starting food fiesta---->

<div class="row"></div>
<div class="container" style="margin-top: 15px;">

  <form method="post" action="<?php echo $url = URL::action('dealsController@search_fiesta'); ?>" id="food_form" name="food_form" accept-charset="UTF-8">

<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
 <div class="row">
  
      <!-- Carousel -->
<div class="container" style="height: 347px;
overflow: hidden;margin-top: 9px;border-bottom: 1px solid #CCC;box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.13);">
<div class="col-md-12 pagecontainer2 offset-0 btop">
    
    <ul class="nav nav-tabs" id="myTab" >
      <li onClick="mySelectUpdate()" class="active bright"><a data-toggle="tab" href="#summary"><span class=" text-18">Top Offers</span>&nbsp;</a></li>
     
   </ul>
      <div class="col-md-12 wrapper">
        <div class="list_carousel homecaro">
          <div class="caroufredsel_wrapper">
            <ul id="foo12" style="left:0px;">
            <?php if(!empty($foodfiesta_offers[0])){  foreach($foodfiesta_offers as $food_offers) { ?>
              <li>
              <?php  $segment_image =  'RESTAURANT'; 
              
                $name = base64_encode($food_offers->proper_me_name);
                $city = base64_encode($food_offers->city); 
                $seg  = base64_encode($food_offers->segment); 

               if($food_offers->image == ''){
                   
              
               $img='<img class="scale" data-scale="best-fit-down" data-align="center"  width="125" height="125" src="'.Theme::asset()->url('foodfiesta_images/'.$segment_image.'.jpg').'">'; echo HTML::decode(HTML::link('offer_details/'.$food_offers->id.'/'.$food_offers->type_id, $img)); ?>
               <?php } else { 
                 
                 if($food_offers->type_id == 3){
                  $image=getcwd().'/uploads/foodfiesta_images/'.$food_offers->image; 
                 }
                 else {
                 
                  $image = Theme::asset()->url('offer_images/').$food_offers->image; 
                 }
               
			
			if (file_exists($image)) {
			if($food_offers->type_id == 3){
			  
			
			$img='<img class="scale" data-scale="best-fit-down" data-align="center"  width="140" height="125" src="uploads/foodfiesta_images/'.$food_offers->image.'">'; echo HTML::decode(HTML::link('get_hotels/'.$name.'/'.$city.'/'.$seg.'', $img)); 
			}else{
	$img='<img width="232" hight="118" style="width="125" height="125" src="uploads/offer_images/'.$food_offers->image.'"">'; echo HTML::decode(HTML::link('offer_details/'.$food_offers->id.'/'.$food_offers->type_id.'', $img)); 
			}
			 } else{
                         if($food_offers->type_id==3){
			$img='<img class="scale" data-scale="best-fit-down" data-align="center"  width="125" height="125" src="uploads/foodfiesta_images/restaurant.jpg">'; echo HTML::decode(HTML::link('get_hotels/'.$name.'/'.$city.'/'.$seg.'', $img));
			}
			else{
			
			$img='<img width="226" hight="61" style="width="125" height="125"  src="uploads/offer_images/'.$food_offers->image.'">'; echo HTML::decode(HTML::link('offer_details/'.$food_offers->id.'/'.$food_offers->type_id.'', $img));
			} 

		}}    ?>
               
               
                <?php 
                
                if($food_offers->type_id ==3){
		$var=30;
                $name = $food_offers->proper_me_name;
                $current_offer =  $food_offers->discount_offer;
             
                }else{
                   $var=90;
                   $name = $food_offers->deal_name;
                   $current_offer = $food_offers->short_description;
                }
                
               
                if(strlen($current_offer) >30){
        
                $offer_name = preg_replace('/\s+?(\S+)?$/', '', substr($current_offer,0,$var)).'...';
               
                }else{
               
                $offer_name = $current_offer;
                }?>
               
                <div class="cpadding0"> <?php echo '<font color="#034387" style="font-size:13px;"><b></br>'.$name.'</b></br></font><span style="font-size:12px; color:#cc0000"><b>'.str_replace('?','',$offer_name).'</b></span><br/><span style="font-size:11px;">';
                if($food_offers->type_id ==3){
                $city_state= $food_offers->city.','.$food_offers->state;
                 if(strlen($food_offers->address) > 100) { echo preg_replace('/\s+?(\S+)?$/', '', substr($food_offers->address,0,30)).'...'.$city_state; } else { echo $food_offers->address; } } ?></span></div>
              </li>
            <?php } } else { 
               echo '</br></br><b>No Food-Fiesta offer in this Place  </b>';
            } ?>
            </ul>
            
          </div>
          <div class="clearfix"></div>
          <a href="#" class="prev" id="prev_btn12" style="display: block;"><img alt="" src="<?php echo Theme::asset()->url('images/spacer.png'); ?>"></a> <a href="#" class="next" id="next_btn12" style="display: block;"><img alt="" src="<?php echo Theme::asset()->url('images/spacer.png'); ?>"></a> </div>
      </div>
    </div>
  </div>
</div>
<!--</div>-->

</br>

			

<?php 
	$featured =array();
	function json_helper($json){
		$featured =array();
		if(!empty($json))
		{
		  foreach($json as $key => $falbums){

		   $featured[$key] = json_decode($falbums);

		}  $featured = array_filter($featured); 
		return $featured; 
	}    }  // $regional_albums=array();
	$featured = json_helper($redis_falbums);
?>
<!-- CONTENT -->
	<div class="container" style="height: 347px;
overflow: hidden;margin-top: 9px;border-bottom: 1px solid #CCC;box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.13);">
<div class="col-md-12 pagecontainer2 offset-0 btop">
    
    <ul class="nav nav-tabs" id="myTab" >
      <li onClick="mySelectUpdate()" class="active bright"><a data-toggle="tab" href="#summary"><span class=" text-18">Music</span>&nbsp;</a></li>
      
   </ul>
    <div class="tab-content4" >
      <!-- TAB 1 -->
   <div id="summary" class="tab-pane fade "> </div>
      <!-- Carousel -->
     <div class="wrapper">
					<div class="list_carousel">
						<ul id="shomefoo4">
                      <?php if(!empty($featured)) { ?>
       <?php
   $count=1; foreach($featured as $album) { 
   $slug='music/viewform'; ?>
<li>
<?php
  					$img = HTML::image($album->thumbnail_url,"",array('border'=>'0'));
    			 $name = '<div class="m1"><h6 class="lh1 dark" style="text-align: -webkit-center;"><b>'.substr($album->album_title,0,20); if(strlen($album->album_title) > 20) $name .= '...';      $name .= '</b></h6></div>'; ?>
<a href="javascript:;" onclick="submiform(<?php echo $album->album_id; ?>);"><?php echo $img; ?></a><?php echo $name; ?>	
 <?php $count++;  }?> <?php   }  else echo 'No Music Found' ;?>
							
						
							
						</ul>
						<div class="clearfix"></div>
						<a id="shomeprev_btn4" class="prev" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
						<a id="shomenext_btn4" class="next" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
					</div>
				</div>

			  
			  </div>
			</div>	
			<!-- END CONTENT -->			
			

			
		</div>
		</div>
	

<div id="opening_content" style="display:none;">
<div id="fancybox-inner2" style="min-height: 226px ;">	
</br>
<h2 class="welcome_h2">Welcome to SmartBuy! </h2><ul><li class="hm_pop_li">
SmartBuy is a platform for communication of offers extended by Merchants to HDFC Bank's Customers. </li><li class="hm_pop_li">HDFC Bank is only communicating the offers extended by Merchants to its Customers and is not selling/rendering any of these Products/Services.</li><li class="hm_pop_li">  HDFC Bank is merely facilitating the payment by its Customers by providing the Payment Gateway Services.</li><li class="hm_pop_li"> HDFC Bank is neither  guaranteeing nor making any representation. HDFC Bank  is not  responsible for sale/quality/features of the Products/Services under the offer.</li></ul> 
 

</div>
</div>



<style>

.strike{
text-decoration: line-through;
}
.wrapperchange {
	background-color: none;
	width: 100%;
	margin: 0px auto;
	padding: 5px;

}
.cpadding0{
height:133px !important;
width:232px !important;

}
</style>

<script>

function submit_deals(){

 $("#deals").submit();
}
function fiesta_validation(){

if($("#foodfieasta_city").val()=='Select City'){
$("#foodfieasta_city_error").html("<font color='#F35958'  style='margin-top: 63px;font-size:12px; font-weight: 400 !important;'> Please select the city.</font>");
return false;
}

}


function deals_validation(){


if($("#city").val()=='Select City' || $("#city").val()==''){
$("#city_error").html("<font color='#F35958'  style=' margin-top: 5px;font-size:12px; float: left; margin-left: 12px; font-weight: 400 !important;'> Please select the city.</font>");
return false;
}

}
</script>
<script src="<?php print_r(Config::get('app.url'));?>themes/hdfc/assets/assets/js/jquery.validate.js"></script>
<script>
$ = jQuery;
$(document).ready(function() {
// $("img.scale").imageScale();
		var data = $("#opening_content").html();
   			$("#popup_content").html(data);
              		$("#backgroundPopup").show();
			$("#toPopup").show();
			
	$("div#backgroundPopup").click(function() {
		$("#toPopup").hide();
		$("#backgroundPopup").hide();
	});  
	
		$("div.close").click(function() {
		$("#toPopup").hide();
		$("#backgroundPopup").hide();
	});     

	});

      function submiform(i){
	var id  =  i;
	var _token =  $("#_token").val();
		
  $.ajax({
                      type: "POST",
                      url: "<?=URL::to('songlist')?>",
                      data: {
               			"id":id,"_token":_token
              		    },             
                        success: function(data) {
                          $("#popup_content").html(data);
              		$("#backgroundPopup").show();
			$("#toPopup").show();

                      }
                  });
					
				
      }
      function changesch(i,j){
     // console.log(i);
      //console.log(j);
      $("#MovieDatejs").val(i);
       $("#daterange").val(j);
      $("#jquerysubmit").submit();
      }
$(".ecs_tooltip").click(function()
	          	{	
		               $("#toPopup").hide();
				$("#backgroundPopup").hide();
		        });  
		    
		     
		       $(".loader").load(function()
		       {
		       $("#popup_content").html(data);
		       });
		       
		      	$(this).keyup(function(event) {
		if (event.which == 27) { // 27 is 'Ecs' in the keyboard
			$("#toPopup").hide();
				$("#backgroundPopup").hide();
		}  	
			});
         
      </script>
