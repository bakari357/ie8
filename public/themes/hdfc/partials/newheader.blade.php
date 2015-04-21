
<script src="{{Theme::asset()->url('assets/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{Theme::asset()->url('assets/js/placeholders.jquery.min.js')}}"></script>
<!--[if lte IE 8]>
<style>
/* 
.container{
width : 1100px !important;
}
*/
</style> 
<link href="{{Theme::asset()->url('assets/css/bootstrap-ie.css')}}" rel="stylesheet" type="text/css" media="all" />

<![endif]-->
<link href="themes/hdfc/assets/assetshdfc/css/popstyle.css" rel="stylesheet" type="text/css" media="all" />

<!-- Top wrapper -->
            <?php $qlink = explode('/',Request::url()); ?> 
            
            	<?php $offers = DB::table('offer_category')->orderby('sequence')->get(); 
            	
            	$offers_menu = array();
            	foreach($offers as $of){
            		$offers_menu[$of->parent_id][] = $of;
            	
            	} $offerss = $offers_menu[0];  ?>
            	
            
            	
        <div class="navbar-wrapper2 navbar-fixed-top" style="min-height: 0px !important;">
   <div class="container" style="height:54px;overflow: hidden;">       		
  <!--[if lte IE 8]>
<div class="navbar mtnav" style="top:-9px;width: 100%;">
<![endif]-->
<!--[if !IE]><!-->
   <div class="navbar mtnav" style="top:-9px;">
<!--<![endif]-->   	

     
	  
      <div>
        <!-- Navigation-->
        <div class="navbar-header col-xs-12">
		<!--[if !IE]><!-->
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle pull-right" type="button"> 
		  <span class="icon-bar"></span> 
		  <span class="icon-bar"></span> 
		  <span class="icon-bar"></span> 
		  </button>
		  <!--<![endif]--> 
          <div class="sblogo pull-left">
          
          <a href="<?php print_r(Config::get('app.url'));?>" class="navbar-brand">
		  <img src="{{Theme::asset()->url('images/logo.png') }}" alt="SmartBUY Logo" style="height:50px; width:170px"/>
		  </a> 
		  </div>
          
          <div class="pull-right"> 
		  
		  
		    <!--[if lte IE 8]>
 <span class="hidden-xs  pull-left brand-partner_t" >Customer Care: 
		  <span style="font-size: 11px; "> 
		  1860 425 3322<br> 
		  <span style="margin-left: 100px;">( 9 AM to 9 PM ) </span>
		  </span>
		  </span>
<![endif]-->
<!--[if !IE]><!-->
    <span class="hidden-xs visible-md visible-lg pull-left brand-partner_t" >Customer Care: 
		  <span style="font-size: 11px; "> 
		  1860 425 3322<br> 
		  <span style="margin-left: 100px;">( 9 AM to 9 PM ) </span>
		  </span>
		  </span>
<!--<![endif]-->  

         
		  
 
           <a href="http://www.hdfcbank.com/" class="brand-partner_h pull-right" target="_blank">
		   
		   <!--[if lte IE 8]>
		   <span class="hidden-xs">
		   <img style="height:30;width:170px" src="{{Theme::asset()->url('images/hdfc-logo.png') }}" target="_blank" alt="HDFC Logo"/> 
		   </span>
<![endif]-->
<!--[if !IE]><!-->
   		   <span class="hidden-xs visible-md visible-lg">
		   <img style="height:30;width:170px" src="{{Theme::asset()->url('images/hdfc-logo.png') }}" target="_blank" alt="HDFC Logo"/> 
		   </span>


          
          <span class="hidden-md hidden-lg pull-right">
		  <img style="height:30;width:30px"  src="{{Theme::asset()->url('images/hdfc-short-logo.png') }}" target="_blank" alt="HDFC Logo" />    
		  </span>
		  <!--<![endif]-->   
		  
          </a> 
          </div>
      
        </div>
        <!-- /Navigation-->
      </div>
    </div>
  </div>
 <div class="head-shadow"></div>
 
  <div class="wrap menu-wrap">
  
    <div class="container">
      <div class="navbar-fixed-menu">
	  
	    <!--[if lte IE 8]>
<div class="navbar-collapse collapse" style="display:block">
<![endif]-->
<!--[if !IE]><!-->
   <div class="navbar-collapse collapse">
<!--<![endif]--> 
        
		
		
          <ul class="nav navbar-nav navbar-left col-xs-12 col-md-6 col-lg-6 nopad">
            <li class="dropdown active col-xs-12 col-md-4 col-lg-4 nopad"> 
			<a  href="javascript:void(0)" onclick="return redirect_url('<?php echo Config::get('settings.hdfc_flipkart.store'); ?>');"  style="text-align:center !important;font-weight: 700;font-size:16px;">Shopping</a>
             <!-- <ul class="dropdown-menu posright-0 col-xs-12 nopad">
                <li>
                  <div class="row dropwidth01">
                    <div class="col-md-4 menu1-bg">
                      <ul class="droplist offset-0">
                        <li class="dropdown-header"><strong>Main Menu</strong></li>
                        <li><a href="#">Sub Menu 1</a></li>
                        <li><a href="#">Sub Menu 2</a></li>
                        <li><a href="#">Sub Menu 3</a></li>
                        <li><a href="#">Sub Menu 4</a><span class="blue-bg">new</span></li>
                        <li><a href="#">Sub Menu 5</a></li>
                        <li><a href="#">Sub Menu 6</a></li>
                        <li><a href="#">Sub Menu 7</a></li>
                        <li><a href="#">Sub Menu 7</a> </li>
                      </ul>
                      <ul class="droplist offset-0">
                        <li class="dropdown-header"><strong>Intro pages</strong></li>
                        <li><a href="#">Sub Menu 1</a></li>
                        <li><a href="#">Sub Menu 2</a></li>
                        <li><a href="#">Sub Menu 3</a><span class="blue-bg">new</span></li>
                      </ul>
                    </div>
                    <ul class="droplist col-md-4 menu2-bg">
                      <li class="dropdown-header"><strong>Intro pages</strong></li>
                      <li><a href="#">Sub Menu 1</a></li>
                      <li><a href="#">Sub Menu 2</a></li>
                      <li><a href="#">Sub Menu 3</a><span class="blue-bg">new</span></li>
                    </ul>
                    <div class="col-md-4 menu3-bg">
                      <ul class="droplist offset-0">
                        <li class="dropdown-header"><strong>Main Menu</strong></li>
                        <li><a href="#">Sub Menu 1</a></li>
                        <li><a href="#">Sub Menu 2</a></li>
                        <li><a href="#">Sub Menu 3</a></li>
                        <li><a href="#">Sub Menu 4</a><span class="blue-bg">new</span></li>
                        <li><a href="#">Sub Menu 5</a></li>
                        <li><a href="#">Sub Menu 6</a></li>
                        <li><a href="#">Sub Menu 7</a></li>
                        <li><a href="#">Sub Menu 7</a> </li>
                      </ul>
                      <ul class="droplist offset-0">
                        <li class="dropdown-header"><strong>Intro pages</strong></li>
                        <li><a href="#">Sub Menu 1</a></li>
                        <li><a href="#">Sub Menu 2</a></li>
                        <li><a href="#">Sub Menu 3</a><span class="blue-bg">new</span></li>
                      </ul>
                    </div>
                  </div>
                </li>
              </ul>-->
            </li>
            <li id="travelMenu" class="dropdown col-xs-12 col-md-4 col-lg-4 nopad"> 
			<a data-toggle="dropdown" class="dropdown-toggle" href="#" style="text-align:center !important;font-weight: 700;font-size:16px;">Travel & More </a>
              <ul class="dropdown-menu posright-0 col-xs-12 nopad" id="travelMenuList">
                <li>
                  <div class="row dropwidth01">
                    <ul class="droplist menu1-bg nopad">
                      
                      <li><?php echo HTML::link('flight_index', 'Flights'); ?></li>

                      <li><?php echo HTML::link('Hotels', 'Hotels'); ?></li>
			 <li><?php echo HTML::link('cinemas', 'Movies'); ?></li>
			 <li><?php echo HTML::link('allmusic', 'Music'); ?></li>
			<li><?php echo HTML::link('mobile_payments', 'Recharge'); ?></li>
                      <li><?php echo HTML::link('dth_payments', 'Bill Payments'); ?></li>
                    </ul>
                   <!-- <ul class="droplist col-md-4 menu2-bg">
                      <li class="dropdown-header"><strong>Intro pages</strong></li>
                      <li><a href="#">Sub Menu 1</a></li>
                      <li><a href="#">Sub Menu 2</a></li>
                      <li><a href="#">Sub Menu 3</a><span class="blue-bg">new</span></li>
                    </ul>
                    <ul class="droplist col-md-4 menu3-bg">
                      <li class="dropdown-header"><strong>Intro pages</strong></li>
                      <li><a href="#">Sub Menu 1</a><span class="blue-bg">new</span></li>
                      <li><a href="#">Sub Menu 2</a></li>
                      <li><a href="#">Sub Menu 3</a></li>
                    </ul>-->
                  </div>
                </li>
              </ul>
            </li>
            <li  id="offerMenu" class="dropdown col-xs-12 col-md-4 col-lg-4 nopad"> 
			<a data-toggle="dropdown" class="dropdown-toggle" href="#" style="text-align:center;font-weight: 700;font-size:16px;">Offers & Deals  </a>
              <ul class="dropdown-menu posright-0 col-xs-12 nopad" id="offerMenuList">
                <li>
                  <div class="row dropwidth01">
                    <ul class="droplist menu1-bg nopad">
			 
                      	 <!--<li ><?php echo HTML::Decode(HTML::link('list_offer/'.$offerss[2]->id, '<span class="b">'.$offerss[2]->name.' Offers</span>')); ?></li>
                      	  <li ><?php echo HTML::Decode(HTML::link('list_offer/'.$offerss[3]->id, '<span class="b">'.$offerss[3]->name.' Offers</span>')); ?></li>-->
                      	  
                  <?php    foreach($offerss as $oofer){ ?>
            			
            			<li><?php echo HTML::Decode(HTML::link('list_offer/'.$oofer->id, '<span class="b">'.$oofer->name.' Offers</span>')); ?></li>
            		<?php }
            	?>
			<li ><?php echo HTML::Decode(HTML::link('dealsandfiesta?city=other', '<span class="b">Deals</span>')); ?></li>
			<li ><?php echo HTML::Decode(HTML::link('fiesta_list', '<span class="b">Food Fiesta</span>')); ?></li>
	
                    </ul>
                    
                  </div>
                </li>
              </ul>
            </li>
          </ul>
          <!-- <div class="search">
            <input type="text" class="search-box" placeholder="Search for a product or catrgory" >
            <input type="submit" class="submit-btn" value="search">
          </div>-->
          <div class="right col-xs-12 col-md-3 col-lg-3 nopad">
            <ul class="pull-right">
                   <?php $login=Session::get('customer_data'); if(!$login){?>
                     <li><?php echo HTML::link('guest_order', 'Manage Order'); ?><!--<span>|</span>--></li> 	
                  <!--<li><?php echo HTML::link('signup', 'Sign up'); ?><span>|</span></li>
                   <li><?php echo HTML::link('securelogin', 'Sign in'); ?></li>-->
               <!--   <li><a href="javascript:;" onclick="poplogin();">Sign in</a></li>-->
                  <?php }else{  ?>  
                       <!--<li style="margin-left: 15px;margin-top: 2px;">Hai <?php echo $login->first_name; ?> !!</li>-->
                         <li><?php echo HTML::link('myaccount', 'My Account'); ?><span>|</span></li>
                                   <li><?php echo HTML::link('logout', 'Logout'); ?></li>   
    

              
           <?php } ?>	</ul>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php  $home=Theme::get('home'); if(isset($home) && $home==1) { ?>

<div></div>
<?php }else{ ?>
<div class="wrap">
  <div class="container quick clearfix">
    <div class=" col-xs-12 col-md-12 col-lg-8 quick-links nopad" style="height:56px;"> 
	
	  <!--[if lte IE 8]>
<div class=" qlblk col-xs-12 col-md-1 col-lg-2  hidden-xs">
<![endif]-->
<!--[if !IE]><!-->
   <div class=" qlblk col-xs-12 col-md-1 col-lg-2  hidden-xs visible-md visible-lg">
<!--<![endif]-->   	

	
	<img src="{{Theme::asset()->url('images/quicklinks.png') }}" alt="" /></div>
      <div class="quick-list col-xs-12 col-md-11 col-lg-10">
        <div>
          <ul class="clearfix">
		  	  <!--[if lte IE 8]>
			  
 <li style="margin-right: 10px;"><?php echo HTML::Decode(HTML::link('flight_index', '<img width="30" height="30" style="px30" src="'.Theme::asset()->url("images/plane-quick.png").'" alt="Travel"></img><span class="quick-text hidden-xs">Flights</span>')); ?></li>
 <li style="margin-right: 10px;"><?php echo HTML::Decode(HTML::link('Hotels', '<img width="30" height="30" style="px30-wth-margin-left" src="'.Theme::asset()->url("images/hotels.png").'" alt="Hotels"></img><span class="quick-text hidden-xs">Hotels</span>')); ?></li>
 <li style="margin-right: 10px;"><?php echo HTML::Decode(HTML::link('cinemas', '<img width="30" height="30" style="px30-wth-margin-left" src="'.Theme::asset()->url("images/movies.png").'" alt="Movies"></img><span class="quick-text hidden-xs">Movies</span>')); ?></li>
 <li style="margin-right: 10px;"><?php echo HTML::Decode(HTML::link('allmusic', '<img width="30" height="30" style="px30-wth-margin-left" src="'.Theme::asset()->url("images/music.png").'" alt="Music"></img><span class="quick-text hidden-xs">Music</span>')); ?></li>
 <li style="margin-right: 10px;"><?php echo HTML::Decode(HTML::link('mobile_payments', '<img width="30" height="30" style="px30-wth-margin-left" src="'.Theme::asset()->url("images/recharge.png").'" alt="Recharge"></img><span class="quick-text hidden-xs">Recharge</span>')); ?></li>
 <li style="margin-right: 10px;"><?php echo HTML::Decode(HTML::link('dth_payments', '<img width="30" height="30" style="px30-wth-margin-left" src="'.Theme::asset()->url("images/bill-payments.png").'" alt="Bill Payments"></img><span class="quick-text hidden-xs">Bill Payments</span>')); ?></li>
         
			  

<![endif]-->
<!--[if !IE]><!-->
    <li><?php echo HTML::Decode(HTML::link('flight_index', '<span class="flights"><span class="quick-text hidden-xs visible-md visible-lg">Flights</span></span>')); ?></li>
              <li><?php echo HTML::Decode(HTML::link('Hotels', '<span class="hotels"><span class="quick-text hidden-xs visible-md visible-lg">Hotels</span></span>')); ?></li>
               <li ><?php echo HTML::Decode(HTML::link('cinemas', '<span class="movies"><span class="quick-text hidden-xs visible-md visible-lg">Movies</span></span>')); ?></li>
               <li ><?php echo HTML::Decode(HTML::link('allmusic', '<span class="music"><span class="quick-text hidden-xs visible-md visible-lg">Music</span></span>')); ?></li>
               <li ><?php echo HTML::Decode(HTML::link('mobile_payments', '<span class="recharge"><span class="quick-text hidden-xs visible-md visible-lg">Recharge</span></span>')); ?></li>
               <li><?php echo HTML::Decode(HTML::link('dth_payments', '<span class="bill-payments"><span class="quick-text hidden-xs visible-md visible-lg">Bill Payments</span></span>')); ?></li>
<!--<![endif]-->   
            
          </ul>
        </div>
      </div>
    </div>
	
	  <!--[if lte IE 8]>
  <div class="tags col-xs-12 col-md-12 col-lg-4" style="height:56px; background-color: #0060b1;">
  <span  class="offer">
<![endif]-->
<!--[if !IE]><!-->
     <div class="tags col-xs-12 col-md-12 col-lg-4 visible-xs visible-md visible-lg" style="height:56px; background-color: #0060b1;">
	 <span  class="offer hidden-xs hidden-md visible-lg">
<!--<![endif]-->  
   
	
	
	<img style="margin-top:17px" src="{{Theme::asset()->url('images/offers-top.png') }}" alt="" />
	</span>
      <ul id="offerico" class="header_ul clearfix">
        <li class="col-xs-3 col-md-3 col-lg-3 nopad"><?php echo HTML::Decode(HTML::link('list_offer/2', '<img  style="width:76px;" src="'.Theme::asset()->url("images/credit_card.png").'" alt="" />')); ?></li>
        <li class="col-xs-3 col-md-3 col-lg-3 nopad"><?php echo  HTML::Decode(HTML::link('list_offer/1', '<img  style="width:76px;" src="'.Theme::asset()->url("images/debit_card.png").'" alt="" />')); ?></li>
         <li class="col-xs-3 col-md-3 col-lg-3 nopad"><?php echo  HTML::Decode(HTML::link('list_offer/3', '<img  style="width:76px;" src="'.Theme::asset()->url("images/netbanking.png") .'" alt="" />')); ?></li>
        <li class="col-xs-3 col-md-3 col-lg-3 nopad"><?php echo  HTML::Decode(HTML::link('list_offer/4', '<img  style="width:76px;" src="'.Theme::asset()->url("images/prepaid_card.png") .'" alt="" />')); ?></li>
      
       
      </ul>
    </div>
  </div>
</div>

<?php } ?>
<div id="moving_content" style="display:none">

<style> #fancybox-inner1 {
	top: 10 !important;
	overflow: auto;
	height:320px !important;
	} 
 #fancybox-inner2 {
	top: 10 !important;
	overflow: auto;
	height:230px ;
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
<script src="themes/hdfc/assets/assets/js/jquery.nicescroll.min.js"></script>
<div id = "fancybox-inner1">
<h2 class="shooping_h2">Shopping! </h2>
<ul style="padding:0px"><li>
Dear Customer,</li><br>
<li> By clicking on the hyperlink you will be exiting HDFC Bank SmartBuy website and entering into the Merchant’s website.
 This link is provided only for the convenience of HDFC Bank's customers.</li><br><li> HDFC Bank is not selling/rendering any of these Products/Services and HDFC Bank is not liable /responsible for sale/quality/features of the Products/Services selected for purchase by the customers.</li><br><li>Thank you for visiting www.smartbuy.hdfcbank.com </li> 
<li><span class="bookbtn right flipkart_link"   style="display:inline-block; font-size:15px;"></span></li><br></ul>
</div></div>


<style>


	ul.droplist li  ul { 
	display:none;
        }
	ul.droplist li:hover ul {
    display: block;
	}

</style>
<!--[if lte IE 8]>
 <script>
$(document).ready(function() { 
var _visibleControl =false;
    $("#travelMenu").mouseenter(function() {
		$("#travelMenuList").toggle(400,'linear');				 
    }).mouseleave(function () { 
		$("#travelMenuList").hide();
    });
	$("#offerMenu").mouseenter(function() { 
        $("#offerMenuList").toggle(400,'linear');        
    }).mouseleave(function (){  
        $("#offerMenuList").hide();
    });
});
</script>
<![endif]-->
 <script>
function redirect_url(url){
$("#popup_content").html('');
var link = '<a href="'+url+'" target="_blank">Proceed</a>'; 
$(".flipkart_link").html(link);
var data = $("#moving_content").html();
   			$("#popup_content").html(data);
              		$("#backgroundPopup").show();
			$("#toPopup").show();
			
	$("div#backgroundPopup").click(function() {
		$("#toPopup").hide();
		$("#backgroundPopup").hide();
	});  
	
		$("div.close").click(function() {
		$("#toPopup").hide();
		$("#backgroundPopup").hide();
	});     
}


$("#postp").click(function(){
window.location="";
});




</script>
<style>
.head_pop{ margin-left: 25%;width: 50%; top:15%;height:75%; z-index: 10000; }
</style>
<div id="toPopup" class="container col-xs-12 head_pop" style=""> 
    <div class="topopup-inner">
        <div class="close"></div>
       	<!--<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>!-->
		<div id="popup_content" > <!--your content start-->
   
       </div> <!--your content end-->
    </div>
   </div> <!--toPopup end-->
<div class="loader"></div>
<div id="backgroundPopup"></div>
