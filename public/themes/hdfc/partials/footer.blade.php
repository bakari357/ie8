<!-- FOOTER -->
</div>
<?php  $home=Theme::get('home'); if(isset($home) && $home==1) { ?>

<div class="clearfix mt30">&nbsp;</div>
<div class="wrap mt30">
<?php }else{ ?>
<div class="clearfix mt30">&nbsp;</div>
<div class="wrap mt30">

<?php } ?>
  <div class="footerbg">
    

    <div class="container">
<div class="row col-md-12">

      <div class="left col-md-10 " >
        <p class="mt15" style="margin-top: 20px;font-size: 13px;">&copy; 2014 Smartbuy
      

      
<?php echo HTML::link('content/About us', 'About us'); ?>&nbsp; |&nbsp; 
<?php echo HTML::link('content/Privacy Policy', ' Privacy Policy'); ?>&nbsp;  |&nbsp;
<?php echo HTML::link('content/Terms & Conditions', 'Terms & Conditions'); ?>&nbsp;  |&nbsp;
<?php echo HTML::link("content/FAQ's", "FAQ's"); ?>&nbsp;  |&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
</p></div>
<div class="right col-md-2" style="margin-top: 15px;"> <a href="#" class="powered-partner"><img src="<?php echo Theme::asset()->url('images/reward360.png') ?>" alt="Powered" class="logo"  style="width: 109px;width: 115px !important; height: 35px;"/></a> </div>
    </div>
</div><br>
    <div class="line5 clearfix"></div>


<div class="container">
<div class="row col-md-12" style="font-size: 12px;">
<span class="grey" ><b><span style="color:#00a4e9;">Disclaimer:</span> HDFC Bank SmartBuy is a platform for communication of offers extended by Merchants to HDFC Bank's Customers. HDFC Bank is only communicating the offers extended by Merchants to its Customers and not selling/rendering any of these Products/Services.  HDFC Bank is merely facilitating the payment to its Customers by providing the Payment Gateway Services. HDFC Bank is neither  guaranteeing nor making any representation. HDFC Bank is not responsible for sale/quality/features of the Products/ Services under the offer.</b> 



 </br> </br>HDFC Bank SmartBuy supports Windows Vista or 7 or 8, or Mac OS X for operating systems.</br> Supported browsers are Internet Explorer 9.0 or above, Mozilla Firefox v29 or above, Safari v6 or above, Google Chrome v18 or above.</span></div><br/>
</div>

  </div>
</div>

</div>
<script type="text/javascript">
 $ = jQuery;
$(document).ready(function() {
    $('#password').bind('copy paste cut',function(e) { 
        e.preventDefault(); //this line will help us to disable cut,copy,paste        
    });
    });
    
  
   
    function poplogin(){
	
  $.ajax({
                      type: "GET",
                      url: "<?=URL::to('poplogin')?>",
                                
                        success: function(data) {
                          $("#popup_content").html(data);
              		$("#backgroundPopup").show();
			$("#toPopup").show();
                      }
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
      


$('#email').change(function(){
	var search_email=document.getElementById('email').value;
if(search_email!='')
$("#error_email").hide();
var search_phone=document.getElementById('password').value;
if(search_phone!='')
$("#error_password").hide();

});
  
</script>
<!-- <script src="{{Theme::asset()->url('assets/js/respond.src.js')}}"></script> -->
      <div id="toPopup"> 
    	
        <div class="close"></div>
       	<span class="ecs_tooltip"><span class="arrow"></span></span>
       	<div class="wrapper"> 
       	<div class="rfd_flight">
                    <h3></h3>
                </div>

		<div id="popup_content" > <!--your content start-->
   
       </div> <!--your content end-->
    </div>
    </div> <!--toPopup end-->
    
	<div class="loader"></div>
   	<div id="backgroundPopup"></div>
<span class="cls" style="display:none">
                          <div  class="pop-txt" id="myElement">
               </div></span><input type = "hidden" id ="player">
<script type="text/javascript">
$(document).ready(function() {
$('.cls').html('');
$('#close').hide();
});


function load_video1(file1){
$('.cls').html('');
$('.cls').html('<div id="play-'+file1+'"></div>');

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
                   $('#track-'+file1).html('<a href="javascript:;" onclick="load_video1('+file1+')" ><div class="play_arrow"></div></a>');
                }
            }
      
    });
});
 var check1 = $('#player').val();
 
 $('#player').val(file1);
 $('#track-'+check1).html('<a href="javascript:;" onclick="load_video1('+check1+')" ><div class="play_arrow"></div></a>');
$('#track-'+file1).html('<a href="javascript:;" onclick="pause_video('+file1+')" ><div class="stop_arrow"></div></a>');
 } 

 function pause_video(file1){
 
  $('.cls').html('');
 $('#track-'+file1).html('<a href="javascript:;" onclick="load_video1('+file1+')" ><div class="play_arrow"></div></a>');
 }
 
 function close1(){
 $('#myElement').html('');
  $('#close').hide();
   
 } 
  </script>
<script src="http://jwpsrv.com/library/_vCScIQgEeSaZA6sC0aurw.js"></script>
