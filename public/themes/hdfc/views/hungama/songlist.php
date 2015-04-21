<style> #fancybox-inner {
	top: 10 !important;
	height: 532px; overflow: auto;
	} 
	       #myElement1{ margin-left: 177px; margin-top: 117px}
	       #close1{cursor:pointer; float:left; margin-left:273px; margin-top:-1px;  }
	       
.pop-names ul li a {
color: #4d4d4d;
text-decoration: none;
float: inherit;
}
.bookbtn a:hover {
color:#FFF !important;
text-decoration: none;
}

    	</style>
    	<script src="http://localhost/smartbuy/public/themes/hdfc/assets/assets/js/jquery.nicescroll.min.js"></script>
<div class="popup-box">
    <div class="popup-content" id="fancybox-inner" style="height: 380px;">
    <?php if(!empty($songlist)) {
 	 $catelogs = json_decode($songlist[$alb_id]);
   $count=1; 
   $slug='hungama/viewform';

  ?>
        <div class="pop-img col-md-10 col-xs-10 col-lg-10">
        <div class="col-xs-12 col-md-4 col-lg-4"><img src="<?php echo $catelogs->thumbnail_url; ?>" width="100%" height="100%" alt="" border="0" /></div>
        <div class="pop-txt col-xs-12 col-md-8 col-lg-8">
        <span><?php echo $catelogs->album_title; ?></span>
        <?php if($catelogs->music_directors!='N/A'){ ?>
        Music Director :<?php echo $catelogs->music_directors;} ?> 
        
        <br /><br /><?php echo count($catelogs->tracks); ?> Songs
        <br /><?php echo $catelogs->release_year; ?>
        </div> </div>
        <div class="clearfix"></div>
        <span class="cls1" style="display:none">
        <div  class="pop-txt" id="myElement1" style="display:none">
         </div> </span><input type = "hidden" id ="player1">
    
    <div class="pop-names mt5 line4">
        <ul>
        
           <li class="col-xs-12 col-md-12 col-lg-12">
                <div class="pop-names-title" style="float:left; width:35%">Name</div>
                <div class="pop-names-title1"></div>
                <div class="pop-names-title2">&nbsp;</div>
            </li>
            <?php  foreach($catelogs->tracks as $alb)
   { $bencode=base64_encode($alb->track_id.'|'.$alb->track_title.'|'.$catelogs->album_title.'|'.$catelogs->thumbnail_url.'|1'); ?>
            <li class="alt col-xs-12 col-md-12 col-lg-12" ><span class="col-xs-12 col-md-3 col-lg-1 nopad" id="track1-<?php echo $alb->track_id; ?>"><a href="javascript:;" onclick="load_video('<?php echo $alb->track_id; ?>')" ><div class="play_arrow"></div></a></span>
                <div class="pop-names-txt col-xs-12 col-md-5 col-lg-4">

<?php $title_name=''.$alb->track_title.'</br><span>'.$catelogs->album_title.'</span>'; ?>
<?php echo HTML::decode(HTML::link('music_cart/'.$bencode, $title_name)); ?>


</div>
                <!--<div class="pop-names-txt1 col-xs-12 col-md-4 col-lg-4"><a href="#"><span style="display:inline-block"><?php echo substr($catelogs->singers,0,20); if(strlen($catelogs->singers) > 20) echo '...';?></span></a></div>-->
			<!--<div class="pop-names-txt1 col-xs-12 col-md-4 col-lg-5" style="overflow: hidden;"><a href="#"><span style="display:inline-block;cursor: default;"><?php echo $catelogs->singers; ?></span></a></div> -->
                <div class="pop-names-txt2 col-xs-12 col-md-3 col-lg-3"><span class="bookbtn"   style="display:inline-block; font-size:15px;">

<?php echo HTML::decode(HTML::link('music_cart/'.$bencode, '&#x20b9; 10')); ?></div></span>
           <div class="clearfix"></div>
            </li>
            
            
            <?php $count++;  }?>

<?php }  else echo 'No Music Found' ; ?>
        </ul>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() { 

 var check1 = $('#player').val();
 $('#track-'+check1).html('<a href="javascript:;" onclick="load_video1('+check1+')" ><div class="play_arrow"></div></a>');
$('.cls').html('');
$('.cls1').html('');
$('#close').hide();
$('#myElement').html('');
$('#myElement').hide();

$('#close1').hide();
$('#myElement1').html('');
$('#myElement1').hide();

});

function load_video(file1){
$('.cls1').html('');
$('.cls1').html('<div id="play-'+file1+'"></div>');
$.post("<?php echo URL::action('MusicController@preview'); ?>", {track:file1}, function(data){

  var obj=jQuery.parseJSON(data);
  var play = obj.previ;
 
  
   jwplayer('play-'+file1).setup({
        file: play,
        height: 30,
        width: 300,
        autostart:true,
        events: {
           
                onComplete: function() {
                   $('#track1-'+file1).html('<a href="javascript:;" onclick="load_video('+file1+')" ><div class="play_arrow1"></div></a>');
                }
            }
    });
    $('#close1').show();
});
var check1 = $('#player1').val();

 $('#player1').val(file1);
 $('#track1-'+check1).html('<a href="javascript:;" onclick="load_video('+check1+')" ><div class="play_arrow1"></div></a>');
$('#track1-'+file1).html('<a href="javascript:;" onclick="pause_video('+file1+')" ><div class="stop_arrow1"></div></a>');

 } 
 
 function pause_video(file1){

  $('.cls1').html('');
 $('#track1-'+file1).html('<a href="javascript:;" onclick="load_video('+file1+')" ><div class="play_arrow1"></div></a>');
 }
 

 
 function close2(){
  $('.cls1').html('');
   $('#close1').hide();
 } 
  </script>
</body>
</html>

