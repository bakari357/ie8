<!DOCTYPE HTML>
<html lang="en" style="background: #f0f0f0;">
<head>
<meta charset="utf-8" />
<!--<link rel="shortcut icon" type="image/x-icon" href="{{Theme::asset()->url('img/favicon.ico.png')}}"/>-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--{{ Theme::get('title') }}-->
<title>Points Pool</title>
<meta name="keywords" content="{{ Theme::get('keywords') }}">
        <meta name="description" content="{{ Theme::get('description') }}">
        {{ Theme::asset()->styles() }}
        {{ Theme::asset()->scripts() }}
</head>
<body>
<!--Main Starts here-->
<section id="main">
<!--Header Start here-->	
<header class="header">
{{ Theme::partial('header') }}	
</header>
<!--Header End here-->	
<!--Menu Strats here-->	
<section class="menu_pad">	
{{ Theme::partial('menu') }}		
</section>
<!--Menu Ends here-->

<!--Content Starts here-->
<section class="row">
<section class="content_pad">
<!--Menu Strats here-->	
{{ Theme::partial('musicmenu') }}		
<!--Menu Ends here-->

{{ Theme::content() }}
</section>
</section>
<!--Content Ends here-->
<!--Footer Starts here-->
<footer>
{{ Theme::partial('footer') }}
</footer>
<!--Footer Ends here--> 
</section>
<!--Main Ends here-->
 {{ Theme::asset()->container('footer')->scripts() }}
</body>
</html>

