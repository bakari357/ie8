<style>
.bookbtn a:hover {
color:#FFF !important;
text-decoration: none;
}
</style>

<link href="../../themes/hdfc/assets/assetshdfc/css/popstyle.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../../themes/hdfc/assets/assetshdfc/js/script.js"></script>
<script type="text/javascript" src="../../themes/hdfc/assets/assetshdfc/js/moment.min.js"></script>

<?php function json_helper($json){
$featured =array();
	if(!empty($json))
	{
		foreach($json as $key => $falbums){

		$featured[$key] = json_decode($falbums);

		}  
		$featured = array_filter($featured);
		return $featured; 
	} 

}

	$albums = json_helper($albums);
	$songs = json_helper($tracks);
$catdr=json_helper($redis_menu);
	
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
			<a class="backbtn right" href="#"></a>
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

   $slug='music_category'; 
$name = '<div class="m1"><h6 class="lh1 dark"><b>'.substr($album->cat_name,0,20); if(strlen($album->cat_name) > 20) $name .= '...';      $name .= '</b></h6></div>';?>
							<li style="height: 102px;
margin-right: 20px;
width: 176px;">
								<?php $img = '<img style="width: 172px;" src="'.Theme::asset()->url('music_image/'.$album->cat_name.'.jpg').'" alt=""/>';
								echo HTML::Decode(HTML::Link('music_category/'.$album->cat_id,$img)); ?>
								
							</li><?php $count++;  }?> <?php   }  else echo 'No Music Found' ;?>
													
						</ul>
						<div class="clearfix"></div>
						<a id="prev_btn1" style="margin-top: -31px" class="prev" href="#"><img src="images/spacer.png" alt=""/></a>
						<a id="next_btn1" style="margin-top: -31px" class="next" href="#"><img src="images/spacer.png" alt=""/></a>
					</div>
				</div>
			  
			  </div>
			
	
	<!-- END OF CONTENT -->
<br><br>
	<!-- CONTENT -->
	
				
				
			
			<!-- CONTENT -->
				

			
			  
			  <div class="col-md-12">
			  
			  
				<!-- Carousel -->
				<div class="wrapper">
<div class="hpadding40c">
					<p class="lato size30 slim"> Albums</p>
				</div>
<div class="line3"></div><br>
					<div class="list_carousel">
						<ul id="foo">
                      <?php if(!empty($albums)) {
    

    ?>
       <?php
   $count=1; foreach($albums as $album) { 
   $slug='music/viewform'; ?>
<li>
<?php
  					$img = HTML::image($album->thumbnail_url,"",array('border'=>'0'));
    			 $name = '<div class="m1"><h6 class="lh1 dark"><b>'.substr($album->album_title,0,20); if(strlen($album->album_title) > 20) $name .= '...';      $name .= '</b></h6></div>'; ?>
<a href="javascript:;" onclick="submiform(<?php echo $album->album_id; ?>);"><?php echo $img; ?></a><?php echo $name; ?>	
 <?php $count++;  }?> <?php   }  else echo 'No Music Found' ;?>
							
						
							
						</ul>
						<div class="clearfix"></div>
						<a id="prev_btn" class="prev" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
						<a id="next_btn" class="next" href="javascript:;"><img src="images/spacer.png" alt=""/></a>
					</div>
				</div>

			  
			  </div>
			
	
	<!-- END OF CONTENT -->

	
         <!--top songs-->
<br><br>
	
<div class="col-md-12">
<div class="wrapper">
<div class="hpadding40c">
					<p class="lato size30 slim"> Tracks </p>
				</div>
<div class="line3"></div><br>
				<div class="row" style="margin-right: 0px;
margin-left: 0px;">
					
  <?php
if(!empty($songs)) { ?>
<?php 

  $cs=1;$count=1; foreach($songs as $album) { 
   if($count==1 && $cs!=4)
   { ?>
   
  
<div class="col-md-4">
<?php }  if($cs==4 && $count==1 )
   { ?>
   
  </div>
<div class="row" style="margin-right: 0px;
margin-left: 0px;">
<div class="col-md-4">

<?php }

   $slug='hungama/viewform';
  $bencode=base64_encode($album->song_id.'|'.$album->song_title.'|'.$album->album_title.'|'.$album->thumbnail_url.'|1');
	
   ?>
<?php if($count%2 <> 0) { ?>
                          <li class="alter">
                          <?php } else { ?>
                             
                             <?php } ?>
						<div class="deal"> <span style="padding:0" id="track-<?php echo $album->song_id; ?>"><a href="javascript:;" onclick="load_video1('<?php echo $album->song_id; ?>')" ><div class="play_arrow"> </div></a></span><?php $img = HTML::image($album->thumbnail_url,"",array('border'=>'0','class'=>'dealthumb fit'));
 echo HTML::decode(HTML::link('music_cart/'.$bencode, $img)); ?>
							
							<div class="dealtitle">
								<p><a href="javascript:;"  id="track-<?php echo $album->song_id; ?>" class="dark size12"><?php echo substr($album->song_title,0,20); if(strlen($album->song_title) > 20) echo '...';?></a></p>
								<span class="size11 grey mt-9"><?php echo substr($album->album_title,0,20); if(strlen($album->album_title) > 20) echo '...';?></span>
							</div>
							<div class="dealprice">
								<p class="size12 grey lh2 mt15"><span class="bookbtn"><?php echo HTML::decode(HTML::link('music_cart/'.$bencode, '&#x20b9; 10')); ?></span><br/></p>
							</div>					
						</div>
<?php $count++; if($count==10){ $count = 1; $cs=$cs+1;; ?> </div> <?php   }  } ?>

<?php }  else echo 'No Music Found' ; ?>
									
					
								
				</div>
			</div>
</div>
</div>
</div>
		</div></div>
     <!--end top -->
	

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
<div id="toPopup" class="container col-xs-12" style="margin-left: 25%;width: 50%; top:15%; height:75%;"> 
    <div class="topopup-inner">
        <div class="close"></div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup_content" > <!--your content start-->
   
       </div> <!--your content end-->
    </div>
   </div> <!--toPopup end-->
<div class="loader"></div>
<div id="backgroundPopup"></div>
