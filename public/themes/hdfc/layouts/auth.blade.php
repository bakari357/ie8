<!DOCTYPE html>
<html>
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Smart buy</title><link rel="shortcut icon" href="{{Theme::asset()->url('images/favicon.png')}}" />
<link href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400,300,300italic' rel='stylesheet' type='text/css'>	
        {{ Theme::asset()->styles() }}
 <script src="{{Theme::asset()->url('assets/js/jquery-1.11.1.min.js')}}"></script>
</head>
<?php $validations = '';
              $valid = json_decode($errors); 
                     $i=1; foreach($valid as $valids => $key){
                               if($i==1){ $validations .='<div style="float:right" class="container col-md-12 mt10 alert_error">'; }
                              $validations .= implode(' ',$key).'</br>';
                      $i++; }
$validations .='</div>';
$alert= $validations;
echo $alert; 
 ?>
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
</html>

