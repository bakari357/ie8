<script type="text/javascript" language="javascript">
	$(function() {
		/*
		$("#foo3 img").each(function() {
			this.title = this.alt;
		});
		*/
						
		$("#foo1").carouFredSel({
			auto: false,
			prev: '#prev2',
			next: '#next2',
			pagination: "#pager2",
			//mousewheel: true,
			swipe: {
			onMouse: true,
			onTouch: true
			}
		});
		
		$("#foo1 a").fancybox({
			cyclic	: true,
			onStart	: function() {
				$("#foo1").trigger("pause");
			},
			onClosed: function() {
				$("#foo1").trigger("play");
			}
		});
		

		$("#foo3").carouFredSel({
			auto: false,
			prev: '#prev3',
			next: '#next3',
			pagination: "#pager3",
			//mousewheel: true,
			swipe: {
			onMouse: true,
			onTouch: true
			}
		});

		$("#foo3 a").fancybox({
			cyclic	: true,
			onStart	: function() {
				$("#foo3").trigger("pause");
			},
			onClosed: function() {
				$("#foo3").trigger("play");
			}
		});
		
		$("#foo4").carouFredSel({
			auto: false,
			prev: '#prev4',
			next: '#next4',
			pagination: "#pager4",
			//mousewheel: true,
			swipe: {
			onMouse: true,
			onTouch: true
			}
		});

		$("#foo4 a").fancybox({
			cyclic	: true,
			onStart	: function() {
		        $("#foo4").trigger("pause");
			},
			onClosed: function() {
			$("#foo4").trigger("play");
			}
		});
		
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

	$catelog = json_helper($albums);
?>
<section class="music-contentpad pad12">
                	<div class="bolly-alb" id="bolly">
                       <!-- <span class="lang-cat1">
                          <select>
                            <option>Sort</option>
                            <option>Grid</option>
                            <option>List</option>
                          </select>
                          </span> -->
                          <?php  if(!empty($catelog)) {
                        ?> 
                          <h1><?php if(isset($name)){
		  echo $name; }?> </h1>
                        <br>
                        <div id="fancy" class="bolly-alb-list pad12">
                          <ul><?php  $count=1; $br=6; foreach($catelog as $album) { //echo '<pre>'; print_r($catelog); exit;?>
                          <?php if($count==$br) { $class= 'last'; }else $class='';?>
                                          <li class="<?php echo $class; ?>">
			<?php 	if(isset($album->thumbnail_url) && $album->thumbnail_url <> '') { 
			$img = HTML::image($album->thumbnail_url,"",array('border'=>'0','height'=>'139','width'=>'139'));
                          } else { 
			$img = HTML::image('/nopicture.gif',"",array('border'=>'0'));
                          } 
                         $name = '<span>'.substr($album->album_title,0,10); if(strlen($album->album_title) > 10) $name .= '...';      $name .= '</span>'; 
           	echo HTML::decode(HTML::link('songlist/'.$album->album_id, $img.' <br>'.$name, array('rel' => 'fancybox'))); ?>				

				</li>
                        <?php  $count++; if($count==7) { $count=1;echo '</ul></div> <div id="fancy" class="bolly-alb-list"><ul>'; } } } ?>
                            
                            
                         
                              </ul>
                            </div>
                      </div>
                      <div class="pagin-alb"></div>    
                </section>
            </section> 
        </section>
