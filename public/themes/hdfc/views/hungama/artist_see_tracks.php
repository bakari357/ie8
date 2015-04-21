<script type="text/javascript" language="javascript">
			$(function() {
				
				$(".bolly-alb-list a").fancybox({
					cyclic	: true,
					onStart	: function() {
						$(".bolly-alb-list").trigger("pause");
					},
					onClosed: function() {
						$(".bolly-alb-list").trigger("play");
					}
				});
			});	
</script>
<?php function json_helper($json){
$featured =array();
	foreach($json as $key => $falbums){

 	$featured[$key] = json_decode($falbums);

}  $featured = array_filter($featured); 
return $featured; 
} 

	$catelog = json_helper($tracks);
	
?>
 <section class="music-contentpad">
                  <div class="bolly-alb"><h3><?php echo $name; ?> </h3></div>
                  <?php if(!empty($catelog)) {
   $count=1; 
   $a=1;
   $slug='hungama/viewform'; ?> 
     <span class="cls" style="display:none">
                        <div  class="pop-txt" id="myElement">
               </div></span><input type = "hidden" id ="player">
                  <h4>Songs</h4>
                  <div class="categories pad14">
                      <div class="cat-names">
                        <ul>
                        <?php $co=1; foreach($catelog as $album)
                                  
                                  { 
                                  $bencode=base64_encode($album->song_id.'|'.$album->song_title.'|'.$album->album_title.'|'.$album->thumbnail_url.'|1');?>
                                  <?php if($count==$a) {
                                   $a=$a+2;?>
                          <li class="alter">
                          <?php } else { ?>
                             <li>
                             <?php } ?>
                            <div class="name-wrap"><span style="padding:0" id="track-<?php echo $album->song_id; ?>"><a href="javascript:;" onclick="load_video1('<?php echo $album->song_id; ?>')" ><div class="play_arrow"> </div></a></span><a class="a"<a href="music/viewform/<?php echo $bencode; ?>"><span><?php echo substr($album->song_title,0,16); if(strlen($album->song_title) > 16) echo '...';?></span><cite><?php echo substr($album->album_title,0,20); if(strlen($album->album_title) > 20) echo '...';?></cite></a></div>
                            <a href="music/viewform/<?php echo $bencode; ?>" class="rate_btn" style="text-decoration: none">10 (Pts)</a>
                          </li>
                           <?php $count++;  if($count==13 && $co<>'3'){ $count=1; $a=1;$co++; echo '</ul>
                      </div>
                    </div>
                    <div class="categories pad14">
                      <div class="cat-names">
                        <ul>'; } }  ?> 
                          
                        </ul>
                      </div>
                      <?php } else echo 'No Songs Found'; ?>
                    </div>
                  <div class="pagin-alb pad13"><ul class="pagination">
    <?php echo $paginator->links(); ?>
</ul> </div>    
            	</section>
            </section> 
        </section>
