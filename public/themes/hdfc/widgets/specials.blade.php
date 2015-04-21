<div class="box">      <?php if(!empty($artists)) { ?>
                          <h3>Specials</h3>
                          <div class="carousel-box2">
                            <div class="clearfix"></div>
                            <div class="image_carousel">
                              <div id="foo4">  <?php  $count=1; foreach($artists as $album) {
   $slug='music/viewform';
			$img = HTML::image($album->big_image,"",array('border'=>'0'));
    			 $name = '<span>'.substr($album->artist_name,0,20); if(strlen($album->artist_name) > 20) $name .= '...';      $name .= '</span>';

		echo HTML::decode(HTML::link('artist_individual/'.$album->artist_id.'/'.$album->artist_name, $img.' <br>'.$name, array('rel' => 'fancybox'))); ?> 
  <?php $count++; if($count==5){break;} }?>

<?php }  else echo 'No Music Found' ; ?></div>
                            </div>
                          </div>
