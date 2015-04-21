<!DOCTYPE html>
<html>
  <head>
  	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Travel Agency - HTML5 Booking template</title>
	
    <!-- Bootstrap -->
    <link href="dist/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="assets/css/custom.css" rel="stylesheet" media="screen">


	<link href="examples/carousel/carousel.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
	
    <!-- Fonts -->	
	<link href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400,300,300italic' rel='stylesheet' type='text/css'>	
	<!-- Font-Awesome -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" media="screen" />
    <!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="assets/css/font-awesome-ie7.css" media="screen" /><![endif]-->
	
	<!-- Animo css-->
	<link href="plugins/animo/animate+animo.css" rel="stylesheet" media="screen">

    <!-- Picker -->	
	<link rel="stylesheet" href="assets/css/jquery-ui.css" />	
	
    <!-- jQuery -->		
    <script src="assets/js/jquery-1.11.1.min.js"></script>

<body id="top" class="thebg" >
   
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#" class="active">Tag A Program</a></li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt25 offset-0">
			
			
			<!-- CONTENT -->
			<div class="col-md-12 pagecontainer2 offset-0">
				
			
					
				<!-- RIGHT CPNTENT -->
				<div class="col-md-11 offset-0">
					<!-- Tab panes from left menu -->
					<div class="tab-content5">
					
					  <!-- TAB 1 -->
					  <div class="tab-pane padding40 active" id="profile">

						
						  
						  
						<div class="clearfix"></div>
						
						<div class="relative margtop10">
							
						
						</div>
						  
						
						<span class="size16 bold">Enter Valid Program Data.</span>
						<div class="line2"></div>
						  
						<!-- COL 1 -->
 <div class="col-md-12 offset-0">
 
 
<?php echo Form::open(array("id"=>"signup","role"=>"form"));?>
<br/>
<?php foreach($program_details as $parameters)
{ ?>
 <input type="hidden" name="program_id" value="<?php echo $parameters->id;?>">

<?php $access=json_decode($parameters->access);

foreach($access as $key=>$value)
{
 
$arra[]=$key;

}

   ?>
<input type="hidden" name="id" value="<?php print_r($arra);?>">
<?php $imp=implode(",",$arra);
$result =DB::table('program_params')->select('program_params.param','program_params.name')->whereIn('id', $arra)->get();
foreach($result as $valid_para)
{
if($valid_para->param=='first_name')
{ ?>
First Name *:
<input type="text" name="first_name" value="" rel="popover" id="first_name" class="form-control" placeholder="First Name" data-content="This field is mandatory" autocomplete="off"  />
<br/>

<?php } elseif($valid_para->param=='last_name')
{?>
Last Name :
<input type="text" name="last_name" value="" rel="popover" id="last_name" class="form-control" placeholder="Last Name" autocomplete="off" />
<br/>
<?php } elseif($valid_para->param=='member_tier'){ ?>

Member Tier:<br/>
<input type="text" name="member_tier" value="" id="member_tier" class="form-control" placeholder="* member_tier"   data-content="This field is mandatory" autocomplete="off" />
<br/>
<?php } elseif($valid_para->param=='point_to_cash'){ ?>
Point To Cash:<br/>
<input type="text" name="point_to_cash" value="" id="point_to_cash" class="form-control" placeholder="*point_to_cash"   data-content="This field is mandatory" autocomplete="off" />
<br/>

<?php }elseif($valid_para->param=='member_or_account'){ ?>

Member Or Account:<br/>
<input type="text" name="member_or_account" value="" id="member_or_account'" class="form-control" placeholder="* member_or_account'"   data-content="This field is mandatory" autocomplete="off" />
<br/>
<?php }elseif($valid_para->param=='mother_madien_name'){ ?>

Mother/Maiden Name:<br/>
<input type="text" name="mother_madien_name" value="" id="mother_madien_name" class="form-control" placeholder="* mother_madien_name"   data-content="This field is mandatory" autocomplete="off" />
<br/>
<?php }elseif($valid_para->param=='father_name'){ ?>
Father Name:<br/>
<input type="text" name="father_name" value="" id="father_name" class="form-control" placeholder="* father_name"   data-content="This field is mandatory" autocomplete="off" />
<br/>

<?php }elseif($valid_para->param=='gender'){ ?>
Gender:<br/>
<input type="text" name="gender" value="" id="gender" class="form-control" placeholder="* Gender"   data-content="This field is mandatory" autocomplete="off" />
<br/>

<?php }

elseif($valid_para->param=='id_proof_type'){ ?>

ID Proof Type:<br/>
<input type="text" name="id_proof_type" value="" id="id_proof_type" class="form-control" placeholder="* id_proof_type"   data-content="This field is mandatory" autocomplete="off" />
<br/>

<?php }elseif($valid_para->param=='id_proof_number'){ ?>

ID Proof Number:<br/>
<input type="text" name="id_proof_number" value="" id="id_proof_number" class="form-control" placeholder="* Date of Birth"   data-content="This field is mandatory" autocomplete="off" />
<br/>
<?php }elseif($valid_para->param=='add_proof_type'){ ?>

Add proof Type:<br/>
<input type="text" name="add_proof_type" value="" id="add_proof_type" class="form-control" placeholder="* add_proof_type"   data-content="This field is mandatory" autocomplete="off" />
<br/>
<?php }elseif($valid_para->param=='add_proof_number'){ ?>

Add Proof Number:<br/>
<input type="text" name="add_proof_number" value="" id="add_proof_number" class="form-control" placeholder="* add_proof_number"   data-content="This field is mandatory" autocomplete="off" />
<br/>

<?php }elseif($valid_para->param=='email'){ ?>
E-mail *:
<font color='red' style='margin-top:48px;margin-left:-201px;position:absolute;'>{{ $errors->first('email') }} </font>
<input type="text" name="email" value="" id="email" class="form-control" placeholder="Ex: office@email.com" data-content="This field is mandatory" autocomplete="off" />
<br/>			
<?php }elseif($valid_para->param=='address1'){?>

Address1 *:
<input type="text" name="address1" value="" id="address1" class="form-control" placeholder="address1"  data-content="This field is mandatory"/>
<br/>
<?php }elseif($valid_para->param=='address2'){ ?>
Address2 *:
<input type="text" name="address2" value="" id="address2" class="form-control" placeholder="address2"  data-content="This field is mandatory"/>
<br/>

<?php }elseif($valid_para->param=='dob'){ ?>

<div class="col-md-4">							
										<div class="w50percent">
											<div class="wh90percent textleft">
												<span class="opensans size13"><b>Date Of Birth</b></span>
												<input type="text" class="form-control mySelectCalendar" id="datepicker5" name="dob" placeholder="mm/dd/yyyy"/>
											</div></div>
										</div><br/>

<?php }elseif($valid_para->param=='anniversary_date'){ ?>
<div class="col-md-4">
										<div class="w50percent">
											<div class="wh90percent textleft">
												<span class="opensans size13"><b>Anniversary Date</b></span>
												<input type="text" class="form-control mySelectCalendar" id="datepicker3" name="anniversary_date" placeholder="mm/dd/yyyy"/>
											</div>
										</div>
										</div><br/>
										</br>

<?php }elseif($valid_para->param=='pincode'){ ?>
PINCODE*:
<input type="text" name="pincode" value="" id="pincode" class="form-control" placeholder="* pincode" data-content="This field is mandatory" />
<br/>	

<?php }elseif($valid_para->param=='country'){ ?>

Country*:
						<select class="form-control mySelectBoxClass">
						  <option value="">Country...</option>
							<option value="AF">Afghanistan</option>
							<option value="AL">Albania</option>
							<option value="DZ">Algeria</option>
							<option value="AS">American Samoa</option>
							<option value="AD">Andorra</option>
							<option value="AG">Angola</option>
							<option value="AI">Anguilla</option>
							<option value="AG">Antigua &amp; Barbuda</option>
							<option value="AR">Argentina</option>
							<option value="AA">Armenia</option>
							<option value="AW">Aruba</option>
							<option value="AU">Australia</option>
							<option value="AT">Austria</option>
							<option value="AZ">Azerbaijan</option>
							<option value="BS">Bahamas</option>
							<option value="BH">Bahrain</option>
							<option value="BD">Bangladesh</option>
							<option value="BB">Barbados</option>
							<option value="BY">Belarus</option>
							<option value="BE">Belgium</option>
							<option value="BZ">Belize</option>
							<option value="BJ">Benin</option>
							<option value="BM">Bermuda</option>
							<option value="BT">Bhutan</option>
							<option value="BO">Bolivia</option>
							<option value="BL">Bonaire</option>
							<option value="BA">Bosnia &amp; Herzegovina</option>
							<option value="BW">Botswana</option>
							<option value="BR">Brazil</option>
							<option value="BC">British Indian Ocean Ter</option>
							<option value="BN">Brunei</option>
							<option value="BG">Bulgaria</option>
							<option value="BF">Burkina Faso</option>
							<option value="BI">Burundi</option>
							<option value="KH">Cambodia</option>
							<option value="CM">Cameroon</option>
							<option value="CA">Canada</option>
							<option value="IC">Canary Islands</option>
							<option value="CV">Cape Verde</option>
							<option value="KY">Cayman Islands</option>
							<option value="CF">Central African Republic</option>
							<option value="TD">Chad</option>
							<option value="CD">Channel Islands</option>
							<option value="CL">Chile</option>
							<option value="CN">China</option>
							<option value="CI">Christmas Island</option>
							<option value="CS">Cocos Island</option>
							<option value="CO">Colombia</option>
							<option value="CC">Comoros</option>
							<option value="CG">Congo</option>
							<option value="CK">Cook Islands</option>
							<option value="CR">Costa Rica</option>
							<option value="CT">Cote D'Ivoire</option>
							<option value="HR">Croatia</option>
							<option value="CU">Cuba</option>
							<option value="CB">Curacao</option>
							<option value="CY">Cyprus</option>
							<option value="CZ">Czech Republic</option>
							<option value="DK">Denmark</option>
							<option value="DJ">Djibouti</option>
							<option value="DM">Dominica</option>
							<option value="DO">Dominican Republic</option>
							<option value="TM">East Timor</option>
							<option value="EC">Ecuador</option>
							<option value="EG">Egypt</option>
							<option value="SV">El Salvador</option>
							<option value="GQ">Equatorial Guinea</option>
							<option value="ER">Eritrea</option>
							<option value="EE">Estonia</option>
							<option value="ET">Ethiopia</option>
							<option value="FA">Falkland Islands</option>
							<option value="FO">Faroe Islands</option>
							<option value="FJ">Fiji</option>
							<option value="FI">Finland</option>
							<option value="FR">France</option>
							<option value="GF">French Guiana</option>
							<option value="PF">French Polynesia</option>
							<option value="FS">French Southern Ter</option>
							<option value="GA">Gabon</option>
							<option value="GM">Gambia</option>
							<option value="GE">Georgia</option>
							<option value="DE">Germany</option>
							<option value="GH">Ghana</option>
							<option value="GI">Gibraltar</option>
							<option value="GB">Great Britain</option>
							<option value="GR">Greece</option>
							<option value="GL">Greenland</option>
							<option value="GD">Grenada</option>
							<option value="GP">Guadeloupe</option>
							<option value="GU">Guam</option>
							<option value="GT">Guatemala</option>
							<option value="GN">Guinea</option>
							<option value="GY">Guyana</option>
							<option value="HT">Haiti</option>
							<option value="HW">Hawaii</option>
							<option value="HN">Honduras</option>
							<option value="HK">Hong Kong</option>
							<option value="HU">Hungary</option>
							<option value="IS">Iceland</option>
							<option value="IN">India</option>
							<option value="ID">Indonesia</option>
							<option value="IA">Iran</option>
							<option value="IQ">Iraq</option>
							<option value="IR">Ireland</option>
							<option value="IM">Isle of Man</option>
							<option value="IL">Israel</option>
							<option value="IT">Italy</option>
							<option value="JM">Jamaica</option>
							<option value="JP">Japan</option>
							<option value="JO">Jordan</option>
							<option value="KZ">Kazakhstan</option>
							<option value="KE">Kenya</option>
							<option value="KI">Kiribati</option>
							<option value="NK">Korea North</option>
							<option value="KS">Korea South</option>
							<option value="KW">Kuwait</option>
							<option value="KG">Kyrgyzstan</option>
							<option value="LA">Laos</option>
							<option value="LV">Latvia</option>
							<option value="LB">Lebanon</option>
							<option value="LS">Lesotho</option>
							<option value="LR">Liberia</option>
							<option value="LY">Libya</option>
							<option value="LI">Liechtenstein</option>
							<option value="LT">Lithuania</option>
							<option value="LU">Luxembourg</option>
							<option value="MO">Macau</option>
							<option value="MK">Macedonia</option>
							<option value="MG">Madagascar</option>
							<option value="MY">Malaysia</option>
							<option value="MW">Malawi</option>
							<option value="MV">Maldives</option>
							<option value="ML">Mali</option>
							<option value="MT">Malta</option>
							<option value="MH">Marshall Islands</option>
							<option value="MQ">Martinique</option>
							<option value="MR">Mauritania</option>
							<option value="MU">Mauritius</option>
							<option value="ME">Mayotte</option>
							<option value="MX">Mexico</option>
							<option value="MI">Midway Islands</option>
							<option value="MD">Moldova</option>
							<option value="MC">Monaco</option>
							<option value="MN">Mongolia</option>
							<option value="MS">Montserrat</option>
							<option value="MA">Morocco</option>
							<option value="MZ">Mozambique</option>
							<option value="MM">Myanmar</option>
							<option value="NA">Nambia</option>
							<option value="NU">Nauru</option>
							<option value="NP">Nepal</option>
							<option value="AN">Netherland Antilles</option>
							<option value="NL">Netherlands (Holland, Europe)</option>
							<option value="NV">Nevis</option>
							<option value="NC">New Caledonia</option>
							<option value="NZ">New Zealand</option>
							<option value="NI">Nicaragua</option>
							<option value="NE">Niger</option>
							<option value="NG">Nigeria</option>
							<option value="NW">Niue</option>
							<option value="NF">Norfolk Island</option>
							<option value="NO">Norway</option>
							<option value="OM">Oman</option>
							<option value="PK">Pakistan</option>
							<option value="PW">Palau Island</option>
							<option value="PS">Palestine</option>
							<option value="PA">Panama</option>
							<option value="PG">Papua New Guinea</option>
							<option value="PY">Paraguay</option>
							<option value="PE">Peru</option>
							<option value="PH">Philippines</option>
							<option value="PO">Pitcairn Island</option>
							<option value="PL">Poland</option>
							<option value="PT">Portugal</option>
							<option value="PR">Puerto Rico</option>
							<option value="QA">Qatar</option>
							<option value="ME">Republic of Montenegro</option>
							<option value="RS">Republic of Serbia</option>
							<option value="RE">Reunion</option>
							<option value="RO">Romania</option>
							<option value="RU">Russia</option>
							<option value="RW">Rwanda</option>
							<option value="NT">St Barthelemy</option>
							<option value="EU">St Eustatius</option>
							<option value="HE">St Helena</option>
							<option value="KN">St Kitts-Nevis</option>
							<option value="LC">St Lucia</option>
							<option value="MB">St Maarten</option>
							<option value="PM">St Pierre &amp; Miquelon</option>
							<option value="VC">St Vincent &amp; Grenadines</option>
							<option value="SP">Saipan</option>
							<option value="SO">Samoa</option>
							<option value="AS">Samoa American</option>
							<option value="SM">San Marino</option>
							<option value="ST">Sao Tome &amp; Principe</option>
							<option value="SA">Saudi Arabia</option>
							<option value="SN">Senegal</option>
							<option value="RS">Serbia</option>
							<option value="SC">Seychelles</option>
							<option value="SL">Sierra Leone</option>
							<option value="SG">Singapore</option>
							<option value="SK">Slovakia</option>
							<option value="SI">Slovenia</option>
							<option value="SB">Solomon Islands</option>
							<option value="OI">Somalia</option>
							<option value="ZA">South Africa</option>
							<option value="ES">Spain</option>
							<option value="LK">Sri Lanka</option>
							<option value="SD">Sudan</option>
							<option value="SR">Suriname</option>
							<option value="SZ">Swaziland</option>
							<option value="SE">Sweden</option>
							<option value="CH">Switzerland</option>
							<option value="SY">Syria</option>
							<option value="TA">Tahiti</option>
							<option value="TW">Taiwan</option>
							<option value="TJ">Tajikistan</option>
							<option value="TZ">Tanzania</option>
							<option value="TH">Thailand</option>
							<option value="TG">Togo</option>
							<option value="TK">Tokelau</option>
							<option value="TO">Tonga</option>
							<option value="TT">Trinidad &amp; Tobago</option>
							<option value="TN">Tunisia</option>
							<option value="TR">Turkey</option>
							<option value="TU">Turkmenistan</option>
							<option value="TC">Turks &amp; Caicos Is</option>
							<option value="TV">Tuvalu</option>
							<option value="UG">Uganda</option>
							<option value="UA">Ukraine</option>
							<option value="AE">United Arab Emirates</option>
							<option value="GB">United Kingdom</option>
							<option value="US">United States of America</option>
							<option value="UY">Uruguay</option>
							<option value="UZ">Uzbekistan</option>
							<option value="VU">Vanuatu</option>
							<option value="VS">Vatican City State</option>
							<option value="VE">Venezuela</option>
							<option value="VN">Vietnam</option>
							<option value="VB">Virgin Islands (Brit)</option>
							<option value="VA">Virgin Islands (USA)</option>
							<option value="WK">Wake Island</option>
							<option value="WF">Wallis &amp; Futana Is</option>
							<option value="YE">Yemen</option>
							<option value="ZR">Zaire</option>
							<option value="ZM">Zambia</option>
							<option value="ZW">Zimbabwe</option>
						</select>
						
						<br/><br/>
					<?php	}elseif($valid_para->param=='city'){?>
						City*:
						<input type="text" class="form-control" name="city" placeholder="ex: London">

						<br/><?php } elseif($valid_para->param=='state'){ ?>

						Region/State*:
						<input type="text" class="form-control" name="state" placeholder="">
<?php }}}?>
<br/><br/>	
			  
<input type="submit" name="Save" class="bluebtn margtop20" value="Submit">
<div style="margin-left:114px;margin-top:-30px;"><?php echo HTML::link("list_program", "cancel",array("class"=>"bluebtn margtop20")); ?></div>

{{Form::close()}}

						
						</div>
						<!-- END OF COL 1 -->
						
						<div class="clearfix"></div><br/><br/><br/>
						
						
						
						
						
					  </div>
				
					  
					

					  
					</div>
					<!-- End of Tab panes from left menu -->	
					
				</div>
				<!-- END OF RIGHT CPNTENT -->
			
			<div class="clearfix"></div><br/><br/>
			</div>
			<!-- END CONTENT -->			
			

			
		</div>
		
		
	</div>
