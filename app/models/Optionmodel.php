<?php 
class Optionmodel extends Eloquent {

	public static function get_product_options($product_id)
	{
		
		
		$result	=  DB::table('options')->where('product_id',$product_id)->orderBy('sequence', 'ASC')->get();
		
		$return = array();
		foreach($result as $option)
		{
			$option->values	= $this->get_option_values($option->id);
			$return[]	= $option;
		}
		return $return;
	}

       public static function validate_product_options(&$product, $post_options)
	{
		
		if( ! isset($product['id'])) return false;
		
		// set up to catch option errors
		$error = false;
		$msg = 'The following options were not selected and are required:<br/>';
		
		// Get the list of options for the product 
		//  We will check the submitted options against this to make sure required options were selected	
		$db_options = Optionmodel::get_product_options($product['id']);
		
		// Loop through the options from the database
		foreach($db_options as $option)
		{
			// Use the product option to see if we have matching data from the product form
			$option_value = @$post_options[$option->id];
						
			// are we missing any required values?
			if((int) $option->required && empty($option_value)) 
			{
				// Set our error flag and add to the user message
				//  then continue processing the other options to built a full list of missing requirements
				$error = true;
				$msg .= "- ". $option->name .'<br/>';	
				continue; // don't bother processing this particular option any further
			}
			
			// process checklist items specially
			   // multi-valued
			if($option->type == 'checklist')
			{

				$opts = array();				
				// tally our adjustments
				
				//check to make sure this is an array before looping
				if(is_array($option_value))
				{
					
					foreach($option_value as $check_value) 
					{
						//$val = $this->get_value($check_value);
						
						foreach($option->values as $check_match)
						{
							if($check_match->id == $check_value)
							{
								$val	= $check_match;
							}
						}
						
						$price = '';
						if($val->price > 0)
						{
							$price = ' ('.Currency::format_currency($val->price).')';
						}
						$product['price'] 	= $product['price'] + $val->price;
						$product['weight'] 	= $product['weight'] + $val->weight;

						array_push($opts, $val->value.$price);
					}
				}
				
				// If only one option was checked, add it as a single value
				if(count($opts)==1) 
				{
					$product['options'][$option->name] = $opts[0];
				}
				// otherwise, add it as an array of values
				else if(!empty($opts)) 
				{ 
					$product['options'][$option->name] = $opts;
				}
				
			}
			
			 // handle text fields
			else if($option->type == 'textfield' || $option->type == 'textarea') 
			{
				//get the value and weight of the textfield/textarea and add it!
				
				if($option_value)
				{
					//get the potential price and weight of this field
					$val	= $option->values[0];
										
					//add the weight and price to the product
					$product['price'] 	= $product['price'] + $val->price;
					$product['weight'] 	= $product['weight'] + $val->weight;
					
					//if there is additional cost, add it to the item description
					$price = '';
					if($val->price > 0)
					{
						$price = ' ('.Currency::format_currency($val->price).')';
					}
					
					$product['options'][$option->name] = $option_value.$price;
				}
			}
			 // handle radios and droplists
			else
			{
				//make sure that blank options aren't used
				if ($option_value)
				{
					// we only need the one selected
					//$val = $this->get_value($option_value);
					
					foreach($option->values as $check_match)
					{
						if($check_match->id == $option_value)
						{
							$val	= $check_match;
						}
					}
					
					//adjust product price and weight
					$product['price'] 	= $product['price'] + $val->price;
					$product['weight'] 	= $product['weight'] + $val->weight;
					
					$price = '';
					if($val->price > 0)
					{
						$price = ' ('.Currency::format_currency($val->price).')';
					}
					//add the option to the options
					//$product['options'][$option->name] = $val->name.$price.$weight;
					$product['options'][$option->name] = $val->name.$price;
				}
			}
		}
		
		if($error)
		{
			return( array( 'validated' => false,
						   'message' => $msg
						  ));
		}
		else
		{
			return( array( 'validated' => true ));
		}
		
	}


}


