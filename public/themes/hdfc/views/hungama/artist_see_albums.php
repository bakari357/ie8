<script type="text/javascript" language="javascript">
$(function() {
	$("#fancy a").fancybox({
		cyclic	: true,
		onStart	: function() {
			$("#fancy").trigger("pause");
		},
		onClosed: function() {
			$("#fancy").trigger("play");
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

	$catelog = json_helper($albums);
	
?>
 <section class="music-contentpad pad12">
                	<div class="bolly-alb" id="bolly">
                          <?php  if(!empty($catelog)) { ?>
                     
                          <h1><?php if(isset($name)){
		  echo $name; }elseif(isset($category)) { echo $category; } else echo $scategory;?> </h1>
                        <br>
                        <div id="fancy" class="bolly-alb-list pad12">
                          <ul><?php  $count=1; $br=6;  foreach($catelog as $album) { ?>
                          <?php if($count==$br) $class='last'; else $class='';?>
                                          <li class="<?php echo $class; ?>">
				<?php 	if(isset($album->thumbnail_url) && $album->thumbnail_url <> '') { 
			$img = HTML::image($album->thumbnail_url,"",array('border'=>'0','height'=>'139','width'=>'139'));
                          } else { 
			$img = HTML::image('/nopicture.gif',"",array('border'=>'0'));
                          } 
                         $name = '<span>'.substr($album->album_title,0,10); if(strlen($album->album_title) > 10) $name .= '...';      $name .= '</span>'; 
           	echo HTML::decode(HTML::link('songlist/'.$album->album_id, $img.' <br>'.$name, array('rel' => 'fancybox'))); ?>
		</li>
                      <?php $count++; if($count==7) { $count=1;echo '</ul></div> <div id="fancy" class="bolly-alb-list"><ul>'; } } } ?>
                            
                                </ul>
                            </div>
                      </div>
                      <div class="pagin-alb"></div>    
                </section>
            </section> 
        </section>
