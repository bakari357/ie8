<style>
.bookbtn a:hover {
color:#FFF !important;
text-decoration: none;
}
</style>
<script type="text/javascript" src="themes/hdfc/assets/assetshdfc/js/script.js"></script>
<script type="text/javascript" src="themes/hdfc/assets/assetshdfc/js/moment.min.js"></script>
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
	$artists = json_helper($redis_artist);
	$catdr=json_helper($redis_menu);
 	//$regionals = json_decode($regional);
	//$rcates = $regionals->subcategories;
	//$regional_albums=RedisCustom::Redis_reader('hung_regional'.$rcates[0]->subcat_id);
	//$regional_albums = json_helper($regional_albums);
	$top_songs	=Cachehelper::fetch('hung_top_5');
	$top_songs = json_helper($top_songs);
	$top_songs_484	=Cachehelper::fetch('hung_top_484');
	$top_songs_484 = json_helper($top_songs_484);
	$top_songs_2818	=Cachehelper::fetch('hung_top_2818');
	$top_songs_2818 = json_helper($top_songs_2818);
	?>
<div class="container breadcrub" style="padding-bottom: 5px;">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#" class="active">Music</a></li>					
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		
	</div>	
<!-- CONTENT -->
	<div class="container">

		
		
			<div class="col-md-12 pagecontainer2 offset-0">
				
				
			
			<!-- CONTENT -->
				

			<div class="row anim3">
			 
			  <div class="col-md-12">
			  
				<!-- Carousel -->
				<div class="wrapper">
					<div class="list_carousel" style="height: 105px;">		
						<ul id="foo1">
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
								<a href="music_category/<?php echo $album->cat_id;  ?>"><img style="width: 172px;" src="<?php echo Theme::asset()->url('music_image/'.$album->cat_name.'.jpg'); ?>" alt=""/></a>
								
							</li><?php $count++;  }?> <?php   }  else echo 'No Music Found' ;?>
													
						</ul>
						<div class="clearfix"></div>
						<a id="prev_btn1" style="margin-top: -31px" class="prev" href="#"><img src="images/spacer.png" alt=""/></a>
						<a id="next_btn1" style="margin-top: -31px" class="next" href="#"><img src="images/spacer.png" alt=""/></a>
					</div>
				</div>
			  
			  </div>
			</div>	
			<!-- END CONTENT -->			
			

			
		</div>
		</div>
	
	<!-- END OF CONTENT -->
<br>
<div class="container">

		
		
			<div class="col-md-12 pagecontainer2 offset-0">
<img  src="<?php echo Theme::asset()->url('music_image/Music.jpg'); ?>" alt=""/>
</div>
</div>
<br>
	<!-- CONTENT -->
	<div class="container">

		
		
			<div class="col-md-12 pagecontainer2 offset-0">
				
				
			
			<!-- CONTENT -->
				

			<div class="row anim2">
			  
			  <div class="col-md-12">
			  
			  
				<!-- Carousel -->
				<div class="wrapper">
<div class="hpadding40c">
					<p class="lato size30 slim">Featured Albums</p>
				</div>
<div class="line3"></div><br>
					<div class="list_carousel">
						<ul id="homefoo4">
                      <?php if(!empty($featured)) { ?>
       <?php
   $count=1; foreach($featured as $album) { 
   $slug='music/viewform'; ?>
<li>
<?php
  					$img = HTML::image($album->thumbnail_url,"",array('border'=>'0'));
    			 $name = '<div class=""><h6 class="lh1 dark"><b>'.substr($album->album_title,0,20); if(strlen($album->album_title) > 20) $name .= '...';      $name .= '</b></h6></div>'; ?>
<a href="javascript:;" onclick="submiform(<?php echo $album->album_id; ?>);"><?php echo $img; ?></a><?php echo $name; ?>	
 <?php $count++;  }?> <?php   }  else echo 'No Music Found' ;?>
							
						
							
						</ul>
						<div class="clearfix"></div>
						<a id="homeprev_btn4" class="prev" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
						<a id="homenext_btn4" class="next" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
					</div>
				</div>

			  
			  </div>
			</div>	
			<!-- END CONTENT -->			
			

			
		</div>
		</div>
	
	<!-- END OF CONTENT -->

	
         <!--top songs-->
<br><br>
	<div class="container">	
<div class="col-md-12 pagecontainer2 offset-0">
<div class="hpadding40c">
					<p class="lato size30 slim">Top songs</p>
				</div>
<div class="line3"></div><br>
				<div class="row" style="margin-right: 0px;
margin-left: 0px;">
					<div class="col-md-4">
						<span class="dtitle">Bollywood</span>
  <?php
if(!empty($top_songs)) { ?>
<?php 

  $a=1; $count=1; foreach($top_songs as $album) { 
   if($count==10)
   {
   continue;
   }
   $slug='hungama/viewform';
   $bencode=base64_encode($album->track_id.'|'.$album->track_title.'|'.$album->album_title.'|'.$album->thumbnail_url.'|1');
	

   ?>
<?php if($count==$a) {
                                   $a=$a+2;?>
                          <li class="alter">
                          <?php } else { ?>
                             
                             <?php } ?>
											<span style="padding:0" id="track-<?php echo $album->track_id; ?>"><a href="javascript:;" onclick="load_video1('<?php echo $album->track_id; ?>')" ><div class="play_arrow"> </div></a></span>	<div class="deal"><?php $img = HTML::image($album->thumbnail_url,"",array('border'=>'0','class'=>'dealthumb fit'));
 echo HTML::decode(HTML::link('music_cart/'.$bencode, $img)); ?>
						<div class="dealtitle">							
								<p><span class="dark size12"><?php echo substr($album->track_title,0,20); if(strlen($album->track_title) > 20) echo '...';?></span></p>
							
								<span class="size11 grey mt-9"><?php echo substr($album->album_title,0,20); if(strlen($album->album_title) > 20) echo '...';?></span>
							</div>
							<div class="dealprice">
								<p class="size12 grey lh2 mt15"><span class="bookbtn"><?php echo HTML::decode(HTML::link('music_cart/'.$bencode, '&#x20b9; 10')); ?></span><br/></p>
							</div>					
						</div>
<?php $count++; if($count==9){ break; }  }?>

<?php }  else echo 'No Music Found' ; ?>
									
					</div>
					<!-- End of first row-->
					
					<div class="col-md-4">
						<span class="dtitle">International</span>			
						<?php
if(!empty($top_songs_484)) { ?>
<?php 

  $a=1; $count=1; foreach($top_songs_484 as $album) { 
   if($count==10)
   {
   continue;
   }
   $slug='hungama/viewform';
  $bencode=base64_encode($album->track_id.'|'.$album->track_title.'|'.$album->album_title.'|'.$album->thumbnail_url.'|1');

   ?>
<?php if($count==$a) {
                                   $a=$a+2;?>
                          <li class="alter">
                          <?php } else { ?>
                             
                             <?php } ?>
						<div class="deal">
							<span style="padding:0" id="track-<?php echo $album->track_id; ?>"><a href="javascript:;" onclick="load_video1('<?php echo $album->track_id; ?>')" ><div class="play_arrow"> </div></a></span>	<?php $img = HTML::image($album->thumbnail_url,"",array('border'=>'0','class'=>'dealthumb fit'));
 echo HTML::decode(HTML::link('music_cart/'.$bencode, $img)); ?>
							<div class="dealtitle">
								<p><span class="dark size12"><?php echo substr($album->track_title,0,20); if(strlen($album->track_title) > 20) echo '...';?></span></p>
								<span class="size11 grey mt-9"><?php echo substr($album->album_title,0,20); if(strlen($album->album_title) > 20) echo '...';?></span>
							</div>
							<div class="dealprice">
								<p class="size12 grey lh2 mt15"><span class="bookbtn"><?php echo HTML::decode(HTML::link('music_cart/'.$bencode, '&#x20b9; 10')); ?></span><br/></p>
							</div>					
						</div>
<?php $count++; if($count==9){ break; }  }?>


<?php }  else echo 'No Music Found' ; ?>				
					</div>
					<!-- End of first row-->
					
					<div class="col-md-4">
						<span class="dtitle">Malayalam</span>			
						<?php
if(!empty($top_songs_2818)) { ?>
<?php 

  $a=1; $count=1; foreach($top_songs_2818 as $album) { 
   if($count==10)
   {
   continue;
   }
   $slug='hungama/viewform';
  $bencode=base64_encode($album->track_id.'|'.$album->track_title.'|'.$album->album_title.'|'.$album->thumbnail_url.'|1');

   ?>
<?php if($count==$a) {
                                   $a=$a+2;?>
                          <li class="alter">
                          <?php } else { ?>
                             
                             <?php } ?>
						<div class="deal">
					<span style="padding:0" id="track-<?php echo $album->track_id; ?>"><a href="javascript:;" onclick="load_video1('<?php echo $album->track_id; ?>')" ><div class="play_arrow"> </div></a></span>
							<?php $img = HTML::image($album->thumbnail_url,"",array('border'=>'0','class'=>'dealthumb fit'));
 echo HTML::decode(HTML::link('music_cart/'.$bencode, $img)); ?>
							<div class="dealtitle">
								<p><span class="dark size12"><?php echo substr($album->track_title,0,20); if(strlen($album->track_title) > 20) echo '...';?></span></p>
								<span class="size11 grey mt-9"><?php echo substr($album->album_title,0,20); if(strlen($album->album_title) > 20) echo '...';?></span>
							</div>
							<div class="dealprice">
								<p class="size12 grey lh2 mt15"><span class="bookbtn"><?php echo HTML::decode(HTML::link('music_cart/'.$bencode, '&#x20b9; 10')); ?></span><br/></p>
							</div>					
						</div>
<?php $count++; if($count==9){ break; }  }?>
<?php }  else echo 'No Music Found' ; ?>				
					</div>
					<!-- End of first row-->			
				</div>
			</div>
</div>


     <!--end top -->
<!-- Region Starts Here -> 
<div style="width: 89%;" class="container mt25 offset-0">
				<div class="cstyle10"></div>
		
				<ul class="nav nav-tabs" id="myTab">
					<li onclick="region('22')" class=""><a data-toggle="tab" href="#summary"><span class="summary"></span><span class="hidetext">Bengali</span>&nbsp;</a></li>
					<li onclick="region('4272')" class="active"><a data-toggle="tab" href="#roomrates"><span class="rates"></span><span class="hidetext">Gujarati</span>&nbsp;</a></li>
				
				</ul>
				
	<div class="tab-content4 col-md-12" >
					<!-- TAB 1 ->				
					<div id="summary" class="tab-pane fade active in">
<div class="row anim2">
				 <div class="col-md-12">				
				<div class="wrapper">
					<div class="list_carousel">
						<ul class ="region_response" id="foo3">
							
<?php if(!empty($regional_albums)) {
   $regional=$regional_albums;
   $count=1; foreach($regional as $album) {
   $slug='hungama/viewform';
    
   //echo '<pre>';print_r($album);?>
							<li>
								<a href="javascript:;" onclick="submiform(<?php echo $album->album_id; ?>);"><img src="<?php echo $album->big_image; ?>" alt=""/></a>
								<div class="">
									<h6 class="lh1 dark"><b><?php echo $album->album_title; ?></b></h6>
									
								</div>

							</li>
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
					</div>
					<!-- TAB 4 ->					
					
					
					<!-- TAB 5 -->					
							
					
					<!-- TAB 6 ->					
											
				</div>
			</div>

</div>				
			
			</div>
		</div>

<!-- Region Ends Here -->
<br><br>
	<!-- CONTENT -->
	<div class="container">

		
		
			<div class="col-md-12 pagecontainer2 offset-0">
				
				
			
			<!-- CONTENT -->
				

			<div class="row anim2">
			  

			  <div class="col-md-12">
			  
			  
				<!-- Carousel -->
<div class="hpadding40c">
					<p class="lato size30 slim">Artist</p>
				</div>
<div class="line3"></div><br>
				<div class="wrapper">

					<div class="list_carousel">		
						<ul id="artistfoo2">
<?php if(!empty($artists)) { ?>
<?php  $count=1; foreach($artists as $album) {
   $slug='music/viewform';?>
<li>
<?php
			$img = HTML::image($album->big_image,"",array('border'=>'0','style'=>'width:200px'));
    			 $name = '<div class=""><h6 class="lh1 dark"><b>'.substr($album->artist_name,0,20); if(strlen($album->artist_name) > 20) $name .= '...';      $name .= '</b></h6></div>'; echo HTML::decode(HTML::link('artist_individual/'.$album->artist_id.'/'.$album->artist_name, $img.' '));  echo $name; ?> </li>
  <?php $count++;  }?>

<?php }  else echo 'No Music Found' ; ?>
							
								
							
											
						</ul>
						<div class="clearfix"></div>
						<a id="artistprev_btn2" class="prev" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
						<a id="artistnext_btn2" class="next" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
					</div>
				</div>

			  
			  </div>

			</div>	
			<!-- END CONTENT -->			
			

			
		</div>
		</div>
	<!-- END OF CONTENT -->
<script>
      function submiform(i){
	var id  =  i;
	var _token ='<?php echo csrf_token(); ?>';
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
   	<script>
   	function region(value){
   	
   	$('.region_response').html("<p align='center'><img src='themes/hdfc/assets/img/ajax-loader.gif' ></p>").fadeIn('slow');
$.post("regional_albums/"+value, function(data){

$(".region_response").html(data);
				
				
});
   	}
   	</script>
   	
