<?php 

class Format {

  public static function  format_address($fields, $br=false)
  
{

	if(empty($fields))
	{
		return ;
	}
	
	// Default format
	//$default = "{first_name} {last_name}\n{name}\n{address_1}\n{address_2}\n{city}, {zone} {postcode}\n{country}";
	$default = "{first_name} {last_name}\n{company}";
	// Fetch country record to determine which format to use
	
	$c_data = Locationmodel::get_country('99');
	
	
	if(empty($c_data->address_format))
	{
		$formatted	= $default;
	} else {
		$formatted	= $c_data->address_format;
	}

	$formatted		= str_replace('{first_name}', $fields['first_name'], $formatted);
	$formatted		= str_replace('{last_name}',  $fields['last_name'], $formatted);
	$formatted		= str_replace('{company}',  $fields['name'], $formatted);
	
/*	$formatted		= str_replace('{address_1}', $fields['address1'], $formatted);
	$formatted		= str_replace('{address_2}', $fields['address2'], $formatted);
	$formatted		= str_replace('{city}', $fields['city'], $formatted);
	$formatted		= str_replace('{zone}', $fields['zone'], $formatted);
	$formatted		= str_replace('{postcode}', $fields['zip'], $formatted);
	$formatted		= str_replace('{country}', $fields['country'], $formatted);*/
	
	// remove any extra new lines resulting from blank company or address line
	$formatted		= preg_replace('`[\r\n]+`',"\n",$formatted);
	if($br)
	{
		$formatted	= nl2br($formatted);
	}
	
	return $formatted;
	
}

}
