<div class="container breadcrub" style="margin-top: 13px !important;">
	    <div>
			<a class="homebtn left" href="<?php print_r(Config::get('app.url'));?>"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>  
         <?php if($off_types == 2)  { ?>  <li><a href="#" class="active">CC</a></li> <?php } ?> 
         <?php if($off_types == 1)  { ?>  <li><a href="#" class="active">DC</a></li> <?php } ?> 	
	 <?php if($off_types == 3)  { ?>  <li><a href="#" class="active">NB</a></li> <?php } ?>	
         <?php if($off_types == 4)  { ?>  <li><a href="#" class="active">PC</a></li> <?php } ?>
        		
				</ul>				
			</div>
			<!--<a class="backbtn right" href="#"></a>-->
		</div>
		
	</div>
		
<style>
.viewc {float: right;
margin-top: -34px;
margin-right: 50px;
color:#0060B1;}

</style>
<div class="container mt8 ">	
<div class="col-md-12 pagecontainer2 ">



	<form method="post" action="" id="hotel_checkout" name="hotel_checkout" >	
            <div class="col-md-2" style="margin-top: 30px;"> <h4 ><b>Offers </b></h4></div>
		
         
            <?php if(isset($_POST['card'])) { $selected=$_POST['card'];} else { $selected =''; } ?>
			<div id="hide_circle" class="col-md-4">
    			<div>


<?php  $url= explode('/',Request::url());  if(isset($url[6])) { $card_selected=$url[6];} else { $card_selected =''; } ?>
<?php   $card_type=array('2'=>'Credit Card Offers','1'=>'Debit Card Offers','3'=>'Net Banking Offers','4'=>'Prepaid Card Offers','5'=>'Easy EMI Offers');
 //,17=>'Credit Card Offers' ?>
<?php echo Form::select('card',$card_type,$card_selected,array( "class"=>"form-control segment","style"=>"float: left;","id"=>"card" ,"name"=>"card")); if($card_selected==17) $card_selected=2; ?>
			</div>
		</div>				
             
	
		
       
      </form>

	</br>



			<?php $count= 1; 
if(count($cat_types)==0)
{
echo '<font color="red" style="margin-left:409px;" > <b>No offers are available currently. </b></font>';
}else{ 

foreach($cat_types as $daily_offer) {
 
$offers4 = Offermodel::get_offers_list_sub($daily_offer->id); 

?>
			<div class="clearfix"></div> 
<div class="line4"></div>
	
<h4 style="padding: 0px 23px; color:#0060B1;"><?php echo $daily_offer->name; ?></h4> 
<?php if(!empty($offers4) && count($offers4) >4) { ?>

<?php echo HTML::link('list_offer/'.$daily_offer->id.'/'.$off_types.'', 'View More',array('class'=>'viewc')); ?>

<?php } ?>

</br>



 <ul class="offer_list">
<?php  
if(!empty($offers4)) {
$i=1;
foreach($offers4 as $sub_offer){
if($i>4)  break;
?>

<li>
  <?php 
	if(isset($sub_offer->image))
	$segment_image =  $sub_offer->image; 
	
       	$filename = public_path().'/uploads/offer_images/'.$segment_image;
	 
	if (file_exists($filename)){ 
	$image =Config::get('app.url').'uploads/offer_images/'.$segment_image ;
	} else {  
	if($daily_offer->name=='Easy EMI'){
	$image =Theme::asset()->url('offers_images/offer_card/15-card.jpg');
	}else{
	$image =Theme::asset()->url('offers_images/offer_card/'.$card_selected.'-card.jpg');
	}
	} 
        ?>
        
       <div style="border: 1px solid #EAEBEC;">
        <?php $img='<img width="226" hight="61" src="'.$image.'">';
        echo HTML::decode(HTML::link('offer_details/'.$sub_offer->id.'/'.$off_types.'', $img)); ?>
        </div> 
	<br/>		
	
	<?php if(strlen($sub_offer->short_description) >30){
                 $description = preg_replace('/\s+?(\S+)?$/', '', substr($sub_offer->short_description,0,50)).'...';
                                }else{
                               $description =  $sub_offer->short_description;
                                }?>
        <div class="cpadding1" style="margin-top: -21px;"> <font color="#034387" style="font-size:13px;"><b><?php echo $sub_offer->deal_name; ?></b></font><br>
       <span style="font-size:12px;"><?php echo  $description; ?></b></span></div>
       
       
 
  </li>
  

  <?php $i++; } }else{ ?>  
<span class="size14" style="padding: 50px;">No offer are available currently</span>
<?php } ?>    
   

</ul>
<?php $count++; } }?>
<br/>
<!--end!--><div class="clearfix"></div> 
<div style="float: right;margin-right: 50px;"> <?php echo $offers->links(); ?> </div> 
			</div>
</div>


<script>
$("#card").on('change', function(){
 //$("#hide_segment").hide();
 var card = $(this).val(); 
 
              $.ajax({
                      type: "POST",
                      url: "<?=URL::to('load_segment')?>",
                      data: {
                      "card":card
              },             
                        success: function(data) { 
                   
                          $("#show_segment").html(data);
                      }
                  });

});





</script>

<script type="text/javascript">
     $("#card").on('change', function(){
     var id = $(this).val();
     switch(id) {
    case "1":
      window.location.replace('1');
        break;
    case "2":
  window.location.replace('2');
        break;
         case "3":
  window.location.replace('3');
        break;
         case "4":
 window.location.replace('4');
        break;
         case "5":
 window.location.replace('15');
        break;
     }
});
 </script>


<style>
.cpadding0{
height:94px !important;
width:233px !important;
}

.change{
width:10799px !important;
height:743px !important;
}
.breadchange{
margin-top:19px;
margin-left:98px;
}
.blink:hover{display:block}
</style>
