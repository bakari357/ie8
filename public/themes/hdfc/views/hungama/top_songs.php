<?php 
	$featured =array();
	foreach($top_songs as $key => $falbums){

 	$featured[$key] = json_decode($falbums);

}  $top_songs = array_filter($featured);  ?> 

<span class="cls" style="display:none">

 <div  class="pop-txt" id="myElement" style="display:none">
    </div></span>
    <input type = "hidden" id ="player">
	
 <?php
if(!empty($top_songs)) { ?>   <ul> <?php 

  $a=1; $count=1; foreach($top_songs as $album) { 
   if($count==10)
   {
   continue;
   }
   $slug='hungama/viewform';
  // $bencode=base64_encode($album->track_id.'|'.$album->track_title.'|'.$album->album_title.'|'.$album['thumbnail_url'].'|1');
	$bencode ='';
   ?>
                <?php if($count==$a) {
                                   $a=$a+2;?>
                          <li class="alter">
                          <?php } else { ?>
                             <li>
                             <?php } ?>
                <div class="name-wrap"><span style="padding:0" id="track-<?php echo $album->track_id; ?>"><a href="javascript:;" onclick="load_video1('<?php echo $album->track_id; ?>')" ><div class="play_arrow"> </div></a></span><a class="a" href="music/viewform/<?php echo $bencode; ?>"><span><?php echo substr($album->track_title,0,20); if(strlen($album->track_title) > 20) echo '...';?></span><cite><?php echo substr($album->album_title,0,20); if(strlen($album->album_title) > 20) echo '...';?></cite></a></div>
                <a href="music/viewform/<?php echo $bencode; ?>" class="rate_btn" style="text-decoration: none">10 (<?php echo '10';?> Pts)</a>
              </li>
              <?php $count++; if($count==9){ break; }  }?>

<?php }  else echo 'No Music Found' ; ?>

