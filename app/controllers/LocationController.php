<?php

class LocationController extends BaseController {

      public function get_zone_menu()
	{
		$id	= Input::get('id');
		$zones	= Locationmodel::get_zones_menu($id);
		
		foreach($zones as $id=>$z):?>
		
		<option value="<?php echo $id;?>"><?php echo $z;?></option>
		
		<?php endforeach;
	}
   
}
