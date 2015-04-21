<link href="../themes/hdfc/assets/assetshdfc/css/popstyle.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../themes/hdfc/assets/assetshdfc/js/script.js"></script>
<script type="text/javascript" src="../themes/hdfc/assets/assetshdfc/js/moment.min.js"></script>
<?php 
function json_helper($json){
	$featured =array();
	if(!empty($json))
	{
	foreach($json as $key => $falbums){

	$featured[$key] = json_decode($falbums);

	}  
        $featured = array_filter($featured); 
	return $featured; 
	}} 
	
	$catdr=json_helper($redis_menu);
	$new_arrivals = json_helper($new_arrivals);
	$feat_albums = json_helper($feat_albums);
	$hot_picks = json_helper($hot_picks);
	$albums = json_helper($albums);
?>
<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><?php echo HTML::link('allmusic', 'Music'); ?></li>				
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	
<!-- CONTENT -->
<?php   if(!empty($catdr)) { ?>	
	<div class="container">

		
		
			<div class="col-md-12 pagecontainer2 offset-0">
				
				
			
			<!-- CONTENT -->
				

			<div class="row anim3">
			 
			  <div class="col-md-12">
			  
				<!-- Carousel -->
				<div class="wrapper">
					<div class="list_carousel" style="height: 105px;">		
						<ul id="menu_foo1">
<?php if(!empty($catdr)) {
    

    ?>
       <?php
   $count=1; foreach($catdr as $album) {
if($album->cat_name=='Regional'){
continue;
}
   $slug='music_category'; 
$name = '<div class=""><h6 class="lh1 dark"><b>'.substr($album->cat_name,0,20); if(strlen($album->cat_name) > 20) $name .= '...';      $name .= '</b></h6></div>';?>
							<li style="height: 102px;
margin-right: 20px;
width: 176px;">
								<a href="<?php echo $album->cat_id;  ?>"><img style="width: 172px;" src="<?php echo Theme::asset()->url('music_image/'.$album->cat_name.'.jpg'); ?>" alt=""/></a>
								
							</li><?php $count++;  }?> <?php   }  else echo 'No Music Found' ;?>
													
						</ul>
						<div class="clearfix"></div>
						<a id="menuprev_btn1" style="margin-top: -31px" class="prev" href="#"><img src="images/spacer.png" alt=""/></a>
						<a id="menunext_btn1" style="margin-top: -31px" class="next" href="#"><img src="images/spacer.png" alt=""/></a>
					</div>
				</div>
			  
			  </div>
			</div>	
			<!-- END CONTENT -->			
			

			
		</div>
		</div>
	
	<!-- END OF CONTENT -->
<?php } ?>

<?php   if(!empty($new_arrivals)) { ?>	
<br><br>
	<!-- CONTENT -->
	<div class="container">

		
		
			<div class="col-md-12 pagecontainer2 offset-0">
				
				
			
			<!-- CONTENT -->
				

			<div class="row anim2">
			  
			  <div class="col-md-12">
			  
			  
				<!-- Carousel -->
				<div class="wrapper">
<div class="hpadding40c">
					<p class="lato size30 slim">New Arrivals</p>
				</div>
<div class="line3"></div><br>
					<div class="list_carousel">
						<ul id="foo1">
                      <?php if(!empty($new_arrivals)) { $arrivas=$new_arrivals; ?>
       <?php
   $count=1; foreach($arrivas as $album) { 
   $slug='music/viewform'; ?>
<li>
<?php
  					 
                           if(isset($album->thumbnail_url) && $album->thumbnail_url <> '') {                        
                          $img = HTML::image($album->thumbnail_url,"",array('border'=>'0'));
                          } else { 
			$img = HTML::image('/nopicture.gif',"",array('border'=>'0'));
                          } 
    			 $name = '<div class=""><h6 class="lh1 dark"><b>'.substr($album->album_title,0,20); if(strlen($album->album_title) > 20) $name .= '...';      $name .= '</b></h6></div>'; ?>
<a href="javascript:;" onclick="submiform(<?php echo $album->album_id; ?>);"><?php echo $img; ?></a><?php echo $name; ?>	
 <?php $count++;  }?> <?php   }  else echo 'No Music Found' ;?>
							
						
							
						</ul>
						<div class="clearfix"></div>
						<a id="prev_btn1" class="prev" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
						<a id="next_btn1" class="next" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
					</div>
				</div>

			  
			  </div>
			</div>	
			<!-- END CONTENT -->			
			

			
		</div>
		</div>
	
	<!-- END OF CONTENT -->

<?php }?>			
	
	<!-- CONTENT -->

<?php   if(!empty($feat_albums)) { ?>	
<br><br>
	<div class="container">

		
		
			<div class="col-md-12 pagecontainer2 offset-0">
				
				
			
			<!-- CONTENT -->
				

			<div class="row anim2">
			  

			  <div class="col-md-12">
	  
			  
				<!-- Carousel -->
<div class="hpadding40c">
					<p class="lato size30 slim">Featured Albums</p>
				</div>
<div class="line3"></div><br>
				<div class="wrapper">
					<div class="list_carousel">		
						<ul id="foo3">
<?php   if(!empty($feat_albums)) { $featured=$feat_albums; ?>
<?php  $count=1; foreach($featured as $album) {
   $slug='music/viewform';?>
<li>
<?php
				if(isset($album->thumbnail_url) && $album->thumbnail_url <> '') {                        
                          $img = HTML::image($album->thumbnail_url,"",array('border'=>'0'));
                          } else { 
			$img = HTML::image('/nopicture.gif',"",array('border'=>'0'));
                          } 
    			 $name = '<div class=""><h6 class="lh1 dark"><b>'.substr($album->album_title,0,20); if(strlen($album->album_title) > 20) $name .= '...';      $name .= '</b></h6></div>';?> <a href="javascript:;" onclick="submiform(<?php echo $album->album_id; ?>);"><?php echo $img; ?></a><?php  echo $name; ?> </li>
  <?php $count++;  }?>

<?php }  else echo 'No Music Found' ; ?>
							
						</ul>
						<div class="clearfix"></div>
						<a id="prev_btn3" class="prev" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
						<a id="next_btn3" class="next" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
					</div>


				</div>

			  
			  </div>

			</div>	
			<!-- END CONTENT -->			
<?php }?>			

			
		</div>
		</div>
	<!-- END OF CONTENT -->
         
	
<?php   if(!empty($hot_picks)) { ?>
<br><br>

		<div class="container">
			<div class="col-md-12 pagecontainer2 offset-0">
			<!-- CONTENT -->
			<div class="row anim2">
			  <div class="col-md-12">
				<!-- Carousel -->
<div class="hpadding40c">
					<p class="lato size30 slim">Hot Picks</p>
				</div>
<div class="line3"></div><br>
				<div class="wrapper">

					<div class="list_carousel">		
						<ul id="hot_foo1">
<?php   if(!empty($hot_picks)) { $hot=$hot_picks; ?>
<?php  $count=1; foreach($hot as $album) {
   $slug='music/viewform';?>
<li>
<?php
			if(isset($album->thumbnail_url) && $album->thumbnail_url <> '') {                        
                         $img = HTML::image($album->thumbnail_url,"",array('border'=>'0'));
                          } else { 
			$img = HTML::image('/nopicture.gif',"",array('border'=>'0'));
                          } 
    			 $name = '<div class=""><h6 class="lh1 dark"><b>'.substr($album->album_title,0,20); if(strlen($album->album_title) > 20) $name .= '...';      $name .= '</b></h6></div>'; ?> <a href="javascript:;" onclick="submiform(<?php echo $album->album_id; ?>);"><?php echo $img; ?></a> <?php echo $name; ?> </li>
  <?php $count++;  }?>

<?php }  else echo 'No Music Found' ; ?>
							
						</ul>
						<div class="clearfix"></div>
						<a id="hotprev_btn1" class="prev" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
						<a id="hotnext_btn1" class="next" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
					</div>
				</div>

			  
			  </div>

			</div>	
			<!-- END CONTENT -->			
			

			
		</div>
		</div>

<?php }?>
	<!-- CONTENT -->
<?php   if(!empty($albums)) { ?>	
	</br></br>
	<div class="container">
			<div class="col-md-12 pagecontainer2 offset-0">
			<!-- CONTENT -->
			<div class="row anim2">
			  <div class="col-md-12">
				<!-- Carousel -->
<div class="hpadding40c">
					<p class="lato size30 slim">Albums</p>
				</div>
<div class="line3"></div><br>
				<div class="wrapper">

					<div class="list_carousel">		
						<ul id="foo">
<?php   if(!empty($albums)) {  ?>
<?php  $count=1; foreach($albums as $album) {
   $slug='music/viewform';?>
<li>
<?php
			if(isset($album->thumbnail_url) && $album->thumbnail_url <> '') { 
			$img = HTML::image($album->thumbnail_url,"",array('border'=>'0'));
                          } else { 
			$img = HTML::image('/nopicture.gif',"",array('border'=>'0'));
                          } 
    			 $name = '<div class=""><h6 class="lh1 dark"><b>'.substr($album->album_title,0,20); if(strlen($album->album_title) > 20) $name .= '...';      $name .= '</b></h6></div>'; ?> <a href="javascript:;" onclick="submiform(<?php echo $album->album_id; ?>);"><?php echo $img; ?></a> <?php echo $name; ?> </li>
  <?php $count++;  }?>

<?php }  else echo 'No Music Found' ; ?>
							
						</ul>
						<div class="clearfix"></div>
						<a id="prev_btn" class="prev" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
						<a id="next_btn" class="next" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
					</div>
				</div>

			  
			  </div>

			</div>	
			<!-- END CONTENT -->			
			

			
		</div>
		</div>
	<!-- END OF CONTENT -->
<br><br>

<?php } ?>
	<!-- CONTENT -->
	
	<!-- END OF CONTENT -->

<script>
      function submiform(i){
	var id  =  i;
  $.ajax({
                      type: "POST",
                      url: "<?=URL::to('songlist')?>",
                      data: {
               "id":id
              },             
                        success: function(data) {
                          $("#popup_content").html(data);
              		$("#backgroundPopup").show();
			$("#toPopup").show();

                      }
                  });
					
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
	
	$("div#backgroundPopup").click(function() {
		$("#toPopup").hide();
		$("#backgroundPopup").hide();
	});  
	
		$("div.close").click(function() {
		$("#toPopup").hide();
		$("#backgroundPopup").hide();
	});          
						
      }
      function changesch(i,j){
     // console.log(i);
      //console.log(j);
      $("#MovieDatejs").val(i);
       $("#daterange").val(j);
      $("#jquerysubmit").submit();
      }
      </script>
<div id="toPopup" class="container col-xs-12" style="margin-left: 25%;width: 50%; top:15%;height:75%;"> 
    <div class="topopup-inner">
        <div class="close"></div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup_content" > <!--your content start-->
   
       </div> <!--your content end-->
    </div>
   </div> <!--toPopup end-->
<div class="loader"></div>
<div id="backgroundPopup"></div>
