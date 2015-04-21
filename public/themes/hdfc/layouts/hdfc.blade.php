<?php $key=Theme::get('keywords');
 $des=Theme::get('description');
 $style=Theme::asset()->styles();
 $script= Theme::asset()->scripts();
 $header=Theme::partial('header');
 $menu=Theme::partial('menu');
 $banner=Theme::partial('banner');
 $content=Theme::content();
 $footer=Theme::partial('footer');
 $fscript=Theme::asset()->container('footer')->scripts(); ?> 
<?php

 
$templ=DB::table('template')->where('templ_name','hdfc')->get();
$var= str_replace('{style}',$style,$templ[0]->content);
$var1= str_replace('{header}',$header,$var);
$var2= str_replace('{footer}',$footer,$var1);
$var3= str_replace('{script}',$script,$var2);
$var4= str_replace('{menu}',$menu,$var3);
$var5= str_replace('{banner}',$banner,$var4);
$var6= str_replace('{content}',$content,$var5);
$var7= str_replace('{fscript}',$fscript,$var6);

	echo $var7;

?>





