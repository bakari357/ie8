<td class="theatr_pad theatr_pad_ci"><span >Cinepolis<span></td>
 
<?php $cntplus=1; ?>

<?php foreach($cinepolis as $cine) {
 ?>

<?php $times=$cine['times']['FnSchedule_CityMovieDateResult']['CityDate_Out'];
                         
    if(empty($times['ErrorString'])){
   
                       if(array_key_exists(0,$times))
			{
		foreach($times as $shows) {

						$time_array[]=$shows['ShowTime'];
					   }
					$time_mac=array_unique($time_array);
					$time_count=count($time_mac);
					
			$tcounter=0;
                   $cnt=1;   foreach($times as $shows) {
		
?>
<form action="cinepolis" id="submiform<?php echo $cntplus; ?>" method="post" />   
<input type="hidden" id="movie"  class="type" name="movie" value="<?php if(isset($movie))echo $movie;?>" >  
<input type="hidden" id="cityid"  class="type" name="cityid" value="<?php echo $cine['cinecty'];?>" >
 <input type="hidden" id="filmid"  class="type" name="filmid" value="<?php echo $cine['cinemovie'];?>" > 
<input type="hidden" id="TheatreId"  class="type" name="TheatreId" value="<?php echo $shows['TheatreId'];?>" >
<input type="hidden" id="ShowDate"  class="type" name="ShowDate" value="<?php echo $shows['ShowDate'];?>" >
<input type="hidden" id="ShowTime"  class="type" name="ShowDate" value="<?php echo $daterange;?>" > 
<input type="hidden" id="city"  class="type" name="city" value="<?php echo $city;?>" >
<input type="hidden" id="ShowClass"  class="type" name="ShowClass" value="<?php echo $shows['ShowClass'];?>" >   
<input type="hidden" id="ShowTime"  class="type" name="Showtime" value="<?php echo date('g:i A',strtotime(str_replace('1899-12-30T','',$shows['ShowTime'])));?>" >         
 </form>

<?php if($tcounter < $time_count)
 { ?> <td class="time_txt_pad">
<a href="javascript:;" onclick="submiform(<?php echo $cntplus; ?>);" class="time_button tt2  time_cine "><?php if(isset($shows['ShowTime'])) echo date('g:i A',strtotime(str_replace('1899-12-30T','',$shows['ShowTime']))); ?></td>
 <?php }?>

<?php $tcounter++; $cntplus++; $cnt++; if($cnt == 7){ echo '</tr><tr><td class="theatr_pad theatr_pad_ci"><span ><span></td>'; }  }
}else{ ?>
<form action="cinepolis" id="submiform<?php echo $cntplus; ?>" method="post" />    
<input type="hidden" id="cityid"  class="type" name="cityid" value="<?php echo $cine['cinecty'];?>" >
 <input type="hidden" id="filmid"  class="type" name="filmid" value="<?php echo $cine['cinemovie'];?>" > 
<input type="hidden" id="TheatreId"  class="type" name="TheatreId" value="<?php echo $times['TheatreId'];?>" >

<input type="hidden" id="ShowDate"  class="type" name="ShowDate" value="<?php echo $times['ShowDate'];?>" >
<input type="hidden" id="ShowTime"  class="type" name="ShowDate" value="<?php echo $daterange;?>" > 
<input type="hidden" id="city"  class="type" name="city" value="<?php echo $city;?>" > 
<input type="hidden" id="ShowTime"  class="type" name="ShowDate" value="<?php echo $daterange;?>" > 
<input type="hidden" id="Showtime"  class="type" name="Showtime" value="<?php echo date('g:i A',strtotime(str_replace('1899-12-30T','',$shows['ShowTime'])));?>" >           
 </form>
                                   <td class="time_txt_pad" ><a href="javascript:;" onclick="submiform(<?php echo $cntplus; ?>);" class="time_button tt2  time_cine " style="margin: 0em -48em 0;"><?php if(isset($times['ShowTime'])) echo date('g:i A',strtotime(str_replace('1899-12-30T','',$times['ShowTime']))); ?>
                                  
                                    </td>

<?php
} }$cntplus++;}   ?>





<script>
      function submiform(i){

	form_data  =  $("#submiform"+i).serialize();
		
		$.post("<?=URL::to('cinepolis')?>", form_data, function(data)
		{
			$("#popup_content").html(data);
			$("#backgroundPopup").show();
			$("#toPopup").show();
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
<div id="toPopup" class="container col-xs-12" style="height:243px;top:36%; margin-left:-15px"> 
    <div class="topopup-inner">
        <div class="close"></div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
       	<div> 
       

		<div id="popup_content" > <!--your content start-->
   
       </div> <!--your content end-->
    </div>
    </div>
   </div> <!--toPopup end-->
	<div class="loader"></div>
   	<div id="backgroundPopup"></div>
