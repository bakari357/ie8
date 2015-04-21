<?php  
   //$adminid= get_api_url('funcinemas');
  //echo '<pre>';print_r($funcinemas);exit;
  if(!empty($funcinemas))
  {   
  $cntplus=1; 
 $citycode=''; foreach($funcinemas as $fun)
 {

 if(!empty($fun['times']) && $citycode!=$fun['centercode'])
 {
//echo '<pre>';print_r($fun);
 $wherecity=array('funcinema'=>trim($fun['centercode']));
                      
     ?>
   <tr> <td class="theatr_pad theatr_pad_cin"> Fun Cinemas<?php if(isset($namecity)) echo $namecity['CenterName']; ?></td> 
   <?php
   $count=1; 
   if(isset($fun['times']['ShowDetail']) && array_key_exists(0,$fun['times']['ShowDetail']) )
   {
   $t=array_reverse($fun['times']['ShowDetail']); 
 
   $ct=count($fun['times']['ShowDetail']);//echo $ct;
   foreach($t as $value) {
   if(!empty($value)) {
   $fr=$cntplus; ?>


<td class="time_txt_pad" valign="top"><span class = "foo4"><a href="javascript:;" onclick="funform(<?php echo $fr; ?>);" class="time_button tt3"  ><?php echo substr($value['ShowDesc'],0,8); if(strlen($value['ShowDesc']) > 8) echo ' '; ?>
                                        </a></span>
                                    </td>
                                    <?php 
                                    $film=$fun['filmcode'];
                                 ?>
                                 
                <form action="funcinemas" id="funform<?php echo $fr; ?>" method="post" />
                <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" value="<?php echo $value['ShowCode']; ?>" name="ShowCode" id="ShowCode" />
                <input type="hidden" value="<?php echo $value['ShowDesc']; ?>" name="ShowDesc" id="ShowDesc" />
                <input type="hidden" value="<?php if(isset($daterange)) print_r($daterange); ?>" name="Date" id="Date" />
                <input type="hidden" value="<?php if(isset($fun['centercode'])) echo $fun['centercode']; ?>" name="CenterCode" id="CenterCode" />
                <input type="hidden" value="<?php //echo $name; ?>" name="Film_strTitle" id="Film_strTitle" />
                <input type="hidden" value="<?php if(isset($fun['filmcode'])) echo $fun['filmcode']; ?>" name="Film_strCode" id="Film_strCode" />
                 <input type="hidden" value="<?php //echo $adminid['f_userid']; ?>" name="pid" id="pid" />
                         
                       </form>

  
  <?php  } $count++; $cntplus++; } 
  }elseif(isset($fun['times']['ShowDetail_attr'])) {
  ?> 
  <td class="time_txt_pad" valign="top"><span class = "foo4"><a href="javascript:;" onclick="funform(<?php echo $cntplus; ?>);" class="time_button tt3"><?php echo substr($fun['times']['ShowDetail_attr']['ShowDesc'],0,8); if(strlen($fun['times']['ShowDetail_attr']['ShowDesc']) > 8) echo ' '; ?>
                                        </a></span>
                                    </td>
                                 
                                    <?php 
                                    $film=$fun['filmcode'];
                                    $center=$fun['centercode'];//$where=array('fid'=>"$film",'city_id'=>"$center"); //$product= get_api_details('funcinemas_movies',$filmcode,$where) ;  // based on city and movie get the sku   ?>
                <form action="funcinemas" id="funform<?php echo $cntplus; ?>" method="post" />
                <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" value="<?php echo $fun['times']['ShowDetail_attr']['ShowCode']; ?>" name="ShowCode" id="ShowCode" />
                <input type="hidden" value="<?php echo $fun['times']['ShowDetail_attr']['ShowDesc']; ?>" name="ShowDesc" id="ShowDesc" />
                <input type="hidden" value="<?php if(isset($daterange)) print_r($daterange); ?>" name="Date" id="Date" />
                <input type="hidden" value="<?php if(isset($fun['centercode'])) echo $fun['centercode']; ?>" name="CenterCode" id="CenterCode" />
                <input type="hidden" value="<?php if(isset($fun['filmcode'])) echo $fun['filmcode']; ?>" name="Film_strCode" id="Film_strCode" />
                         
                       </form>

  <?php 
  }
  
  $ct=12;
  
  
   if(($ct/2)<'6') { 
  for($i=0;$i<=$ct;$i++) { ?>  <td class="time_txt_pad" valign="top"></td> <?php } } ?> </tr> <?php } $citycode=$fun['centercode']; $cntplus++;  } }else { ?>
  
  <tr>
     <td style="width:100px;margin:10px;"> No bookings are available for this show.</td>
     </tr>
     <?php } ?>
    </div>

    </div>


  <script>
      function funform(i){ 
        
	$("#backgroundPopup").show();
	form_data  =  $("#funform"+i).serialize();
					$.post("<?=URL::to('funcinemas')?>", form_data, function(data)
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

  <form name="jquerysubmit" method="post" id="jquerysubmit" >
  <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
  <input name="MovieDate" value="" id="MovieDatejs" type="hidden" />
  <input name="daterange" value="" id="daterange" type="hidden" />

  </form>

<div id="toPopupajax" style="height:243px;top:36%;display:none;"> 
 <img src="<?php print_r(Config::get('app.url'))?>themes/hdfc/assets/images/ajax-loader.gif">
</div>

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
