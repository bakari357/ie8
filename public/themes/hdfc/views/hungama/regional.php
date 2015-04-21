<?php if(!empty($regional)) {
   
   	function json_helper($json){
$featured =array();
	foreach($json as $key => $falbums){

 	$featured[$key] = json_decode($falbums);

}  $featured = array_filter($featured); 
return $featured; 
}
   $regional = json_helper($regional);
   
   $count=1; foreach($regional as $album) {
   $slug='hungama/viewform';
  ?>
					<li>
								<a href="javascript:;" onclick="submiform(<?php echo $album->album_id; ?>);"><img src="<?php if(isset($album->big_image)){ echo $album->big_image; } else { echo $album->thumbnail_url; } ?>" alt=""/></a>
								<div class="m1">
									<h6 class="lh1 dark"><b><?php echo $album->album_title; ?></b></h6>
									
								</div>

							</li>
<?php $count++;  }?>

						
						<?php }  else echo 'No Music Found' ; ?>
				
