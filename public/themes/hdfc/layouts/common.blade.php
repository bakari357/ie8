<!DOCTYPE HTML>
<html lang="en" style="background: #f0f0f0;">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
<?php 
$style=Theme::asset()->styles();
/*$style.="	<link href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400,300,300italic' rel='stylesheet' type='text/css'>";*/
$script=Theme::asset()->scripts();
 $header=Theme::partial('newheader');
 $footer=Theme::partial('footer');
 $content=Theme::content();

$validations = '';
               $valid = json_decode($errors); 
	if($valid){ $validations .='<div class="container col-md-12 mt10 alert_error">'; }
                      $i=1; foreach($valid as $valids => $key){
				
                               $validations .= implode(' ',$key).'</br>';
                       $i++; }
$validations .='</div>';
$alert= $validations; 
$templ=DB::table('template')->where('templ_name','common')->get();

$var= str_replace('{style}',$style,$templ[0]->content);

$var1= str_replace('{header}',$header,$var);
$var2= str_replace('{footer}',$footer,$var1);
$var3= str_replace('{script}',$script,$var2);
$var4= str_replace('{content}',$content,$var3);
$var5= str_replace('{alert}',$alert,$var4);

echo $var5;




?>

</body> </html>


