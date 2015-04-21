<style> #fancybox-inner {
	top: 10 !important;
	} 
	       #myElement1{ margin-left: 177px; margin-top: 117px}
	       #close1{cursor:pointer; float:left; margin-left:273px; margin-top:-1px;  }
	      	</style>
 <link media="all" type="text/css" rel="stylesheet" href="themes/hdfc/assets/jsfillter/style.css"> 

		<div>
			<!-- CONTENT -->
			<div>
				<div>
				<div class="pbottom15 clearfix">
					<h5 class="cinehd21 npleft col-xs-9 col-md-9 col-lg-9"><?php  if(isset($movie_details['MovieName'])) echo $movie_details['MovieName']; ?></h5>
					<h6 class="textright npright col-xs-3 col-md-3 col-lg-3"><span><?php  echo date('D, d M Y',strtotime($movie_details['ShowDate'])); ?></span></br><span style="display: inline-block;"> Funcinemas - <?php echo str_replace(",", "<br/>", $movie_details['CenterName']);?> , <?php echo $movie_details['ScreenName'] ; ?></span></h6>
				</div>
				<div class="line3"></div>
				<div class="clearfix"></div>
				</br>
			
                <form name="class" method="post" id="class" action="funaudilayout"  accept-charset="UTF-8" >
                 <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                
    <input type="hidden" value="<?php  if(isset($movie_details['ServiceFee'])) echo $movie_details['ServiceFee']; ?>" name="ServiceFee" id="ServiceFee" />
                 <input type="hidden" value="<?php  if(isset($movie_details['CenterName'])) echo $movie_details['CenterName']; ?>" name="CenterName" id="CenterName" />
                  <input type="hidden" value="<?php  if(isset($movie_details['MovieName'])) echo $movie_details['MovieName']; ?>" name="MovieName" id="MovieName" />
                  <input type="hidden" value="<?php  if(isset($movie_details['ScreenName'])) echo $movie_details['ScreenName']; ?>" name="ScreenName" id="ScreenName" />
                 <input type="hidden" value="<?php  if(isset($movie_details['ShowDate'])) echo $movie_details['ShowDate']; ?>" name="ShowDate" id="ShowDate" />
                  <input type="hidden" value="<?php  if(isset($movie_details['FinishTime'])) echo $movie_details['FinishTime']; ?>" name="FinishTime" id="FinishTime" />
              
             
                <input type="hidden" value="<?php  if(isset($value['Price']))  echo $value['Price']; ?>" name="Price" id="Price" />
                <input type="hidden" value="<?php  if(isset($value['Class']))  echo $value['Class']; ?>" name="Class" id="Class" />
                <input type="hidden" value="<?php if(isset($net)) echo $net; ?>" name="net" id="net" />
                <input type="hidden" value="<?php  if(isset($centercode)) echo $centercode; ?>" name="CenterCode" id="CenterCode" />
                <input type="hidden" value="<?php  if(isset($ShowCode)) echo $ShowCode; ?>" name="ShowCode" id="ShowCode" /><input type="hidden" value="<?php  if(isset($moviecode)) echo $moviecode; ?>" name="moviecode" id="moviecode" />
                <input type="hidden" value="<?php if(isset($Film_strTitle)) echo $Film_strTitle; ?>" name="Film_strTitle" id="Film_strTitle" />
                <input type="hidden" value="<?php if(isset($Film_strCode)) echo $Film_strCode; ?>" name="Film_strCode" id="Film_strCode" />
                
                <div class="ticket_details clearfix">
								<div class="pbottom15 nopad col-xs-6" >
									<span class="opensans size13"><b>Ticket type </b></span>
                           <select name="ClassCode" id="ClassCode"  class="form-control">
                           <?php if(!empty($seat_details)){  
                             if(array_key_exists(0, $seat_details)){?>		 

		<?php foreach($seat_details as $key=>$value) {

                            if(isset($value['ClassCode'])) {?>
		
		<option value="<?php echo $value['ClassCode'].'_'.$value['Class'].'_'.$value['AreaCode']; ?>" <?php if(isset($_POST['ClassCode']) && $_POST['ClassCode']==$value['ClassCode']) echo 'selected' ;// else if($ClassCode==$value['ClassCode']) echo 'selected';?>><?php echo $value['Class'];?></option>
	   <?php  } } } else{ ?>

<option value="<?php echo $seat_details['ClassCode'].'_'.$seat_details['Class'].'_'.$seat_details['AreaCode']; ?>" <?php if(isset($_POST['ClassCode']) && $_POST['ClassCode']==$seat_details['ClassCode']) echo 'selected' ;// else if($ClassCode==$value['ClassCode']) echo 'selected';?>><?php echo $seat_details['Class'];?></option>
<?php }}?></select></div>
					<div class="pbottom15 col-xs-3">
                    	 <span class="opensans size13"><b>Quantity </b></span>
                    	 		<select name="QTY" id="seat" class="date-next  form-control"><?php for($i=1;$i<=6;$i++){?>
	
	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
	<?php } ?></select></div>
	
							 <a class="subm col-xs-2" style="margin-top:20px" href="#" onclick="submitforms();">Continue </a>   
						     <span class="col-xs-6" style="display:block;">Children aged 3 years and above will require a separate ticket.</span>
						     
                    </div>
                    
                   
                    
								</div>

				
	 </form>
                       
                     
            	<div class="clearfix"></div>
					<br/><br/>
        <div class="pop-img"></div>
        <div class="pop-txt">
       	
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
$.post("music/preview", {track:file1}, function(data){

  var obj=jQuery.parseJSON(data);
  var play = obj.previ;
 
  
   jwplayer('play-'+file1).setup({
        file: play,
        height: 30,
        width: 300,
        autostart:true,
        events: {
           
                onComplete: function() {
                   $('#track1-'+file1).html('<a href="javascript:;" onclick="load_video('+file1+')" ><div class="pop-names-tt"></div></a>');
                }
            }
    });
    $('#close1').show();
});
var check1 = $('#player1').val();

 $('#player1').val(file1);
 $('#track1-'+check1).html('<a href="javascript:;" onclick="load_video('+check1+')" ><div class="pop-names-tt"></div></a>');
$('#track1-'+file1).html('<a href="javascript:;" onclick="pause_video('+file1+')" ><div class="pop-names-stop"></div></a>');

 } 
 
 function pause_video(file1){

  $('.cls1').html('');
 $('#track1-'+file1).html('<a href="javascript:;" onclick="load_video('+file1+')" ><div class="pop-names-tt"></div></a>');
 }
 

 
 function close2(){
  $('.cls1').html('');
   $('#close1').hide();
 } 
  </script>
<script>
        function submitforms()
{

  $('#class').submit();
  
}
</script>
  <form name="jquerysubmit" method="post" id="jquerysubmit" accept-charset="UTF-8" >
  <input name="ClassCode" value="" id="ClassCodejs" type="hidden" />
  <input name="Class" value="" id="Class" type="hidden" />

  </form>
</body>
</html>

