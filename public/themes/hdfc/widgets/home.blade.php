                            <div class="hdg-pg">
				
                            <?php if(!empty($featured)) {
    

    ?>
                              <h3 style="width: 32%" class="pad10">Items Recommended For You</h3>
                              <div class="carousel-box pad10" id="music">
                                <div class="clearfix"></div>
                                <div class="pagin"><a id="prev2" class="prev" href="#">Previous</a> <span class="fl">|</span> <a id="next2" class="next" href="#">Next</a>
                                  <div id="pager2" class="pager"></div>
                                </div>
                                <div class="image_carousel">
                                
                                  <div id="foo1">
                                  <?php
   $count=1; foreach($featured as $album) { 
   $slug='music/viewform'; 
  					$img = HTML::image($album->thumbnail_url,"",array('border'=>'0'));
    			 $name = '<span>'.substr($album->album_title,0,20); if(strlen($album->album_title) > 20) $name .= '...';      $name .= '</span>';

		echo HTML::decode(HTML::link('songlist/'.$album->album_id, $img.' <br>'.$name, array('rel' => 'fancybox'))); ?>  <?php $count++;  }  }  else echo 'No Music Found' ;?> </div>
								</div>
                    
                                </div>
                              </div>
                              
                                           <div class="hdg-pg">
				
                            <?php if(!empty($featured)) {
    

    ?>
    						<h3 style="width: 32%" class="pad10">Best Earn</h3>
                           <div class="carousel-box1 pad10 border-non"  id="music">
                                  <div class="clearfix"></div>
                                      <div class="pagin"><a id="prev3" class="prev" href="#">Previous</a> <span class="fl">|</span> <a id="next3" class="next" href="#">Next</a>
                                    <div id="pager4" class="pager"></div>
                                  </div>
                                  <div class="image_carousel">
                                    <div id="foo3">
                                  <?php
   $count=1; foreach($featured as $album) { 
   $slug='music/viewform'; 
  					$img = HTML::image($album->thumbnail_url,"",array('border'=>'0'));
    			 $name = '<span>'.substr($album->album_title,0,20); if(strlen($album->album_title) > 20) $name .= '...';      $name .= '</span>';

		echo HTML::decode(HTML::link('songlist/'.$album->album_id, $img.' <br>'.$name, array('rel' => 'fancybox'))); ?>  <?php $count++;  }  }  else echo 'No Music Found' ;?> </div>
								</div>
                    
                                </div>
                              </div>
                              <div class="hdg-pg">
                              <?php if(!empty($brand)) {
    

    ?>
    						<h3 style="width: 32%" class="pad10">Offers & Deals</h3>
                           <div class="carousel-box1 pad10 border-non"  id="music">
                                  <div class="clearfix"></div>
                                      <div class="pagin"><a id="prev4" class="prev" href="#">Previous</a> <span class="fl">|</span> <a id="next4" class="next" href="#">Next</a>
                                    <div id="pager3" class="pager"></div>
                                  </div>
                                  <div class="image_carousel">
                                    <div id="foo4">
                                  <?php
   $count=1; foreach($brand as $album) { 
   $slug='music/viewform'; 
   						$brand_image = explode('|',$album['brand_images']);
  					$img = HTML::image($brand_image[0],"",array('border'=>'0'));
    			 $name = '<span>'.substr($album['brand_name'],0,20); if(strlen($album['brand_name']) > 20) $name .= '...';      $name .= '</span>';

		echo HTML::decode(HTML::link('songlist/'.$album['brand_name'], $img.' <br>'.$name, array('rel' => 'fancybox'))); ?>  <?php $count++;  }  }  else echo 'No Music Found' ;?> </div>
								</div>
                    
                                </div>
                             </div>
                          
