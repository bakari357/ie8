<!DOCTYPE html>
<html>
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Smart Buy</title><link rel="shortcut icon" href="themes/hdfc/assets/images/fav.png" />
<link href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400,300,300italic' rel='stylesheet' type='text/css'>	

<!-- Top wrapper -->
<div class="navbar-wrapper_head2 navbar-fixed-top">
  <div class="container">
    <div class="navbar mtnav_h">
      <div class="container offset_h-3">
        <!-- Navigation-->
        <div class="navbar-header">
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <a href="" class="navbar-brand"><img src="{{Theme::asset()->url('images/logo.jpg') }}" alt="SmartBUY Logo" class="logo"/></a>
          <div class="right"> <span>support 1800 425 1120</span> <a href="#" class="brand-partner_h"><img src="{{Theme::asset()->url('images/hdfc-logo.jpg') }}" alt="HDFC Logo" class="logo"/></a> </div>
        </div>
        <!-- /Navigation-->
      </div>
    </div>
  </div>
  <div class="wrap menu-wrap_h">
    <div class="container">
      <div class="navbar-fixed-menu_h">
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
           
           
          </ul>
         
          <div class="right">
            <ul>
                   <?php $login=Session::get('customer_data'); if(!$login){?> 	
                  <li><?php echo HTML::link('registration', 'Sign up'); ?><span>|</span></li>
                  <li><?php echo HTML::link('securelogin', 'Sign in'); ?></li>
                  <?php }else{  ?>  
                       <li style="margin-left: 15px;margin-top: 2px;">Hai <?php echo $login->first_name; ?> !!</li>
                         <li><?php echo HTML::link('myaccount', 'My Account'); ?><span>|</span></li>
                                   <li><?php echo HTML::link('logout', 'Logout'); ?></li>   
    

              
           <?php } ?>	</ul>
            <div class="cart"><a href="#"><img src="images/cart-img.png" /></a><span>0</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<link href="{{Theme::asset()->url('dist/css/bootstrap.css')}}" rel='stylesheet' type='text/css'>
<link href="{{Theme::asset()->url('assets/css/custom.css')}}" rel='stylesheet' type='text/css'>
<link href="{{Theme::asset()->url('assets/css/header_footer.css')}}" rel='stylesheet' type='text/css'>
<link href="{{Theme::asset()->url('examples/carousel/carousel.css')}}" rel='stylesheet' type='text/css'>
<link href="{{Theme::asset()->url('assets/css/font-awesome.css')}}" rel='stylesheet' type='text/css'>
<link href="{{Theme::asset()->url('css/fullwidth.css')}}" rel='stylesheet' type='text/css'>
<link href="{{Theme::asset()->url('rs-plugin/css/settings2.css')}}" rel='stylesheet' type='text/css'>
<link href="{{Theme::asset()->url('assets/css/jquery-ui.css')}}" rel='stylesheet' type='text/css'>   
	
 



 <script src="{{Theme::asset()->url('assets/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{Theme::asset()->url('assets/js/js-index7.js')}}"></script>
</head>
<body>
<!--Main Starts here-->

{{ Theme::content() }}
{{ Theme::asset()->scripts() }}
<script>
	function errorMessage(){
		$('.login-wrap').animo( { animation: 'tada' } );
	}
	</script>
</body>
{{Theme::partial('footer')}}
</html>
