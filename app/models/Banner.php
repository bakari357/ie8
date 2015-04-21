<?php
//use Jenssegers\Mongodb\Model as Eloquent;
class Banner extends Eloquent {
   //protected $connection = 'mongodb';
  // protected $collection = 'Products';
   
    protected $table = 'banners';
 //public static $timestamps = true;
     public static $unguarded = true;
	public static $sluggable = array('build_from' => 'title',
	'save_to' => 'slug',
	'method' => null,
	'separator'       => '-',
	'unique'          => true,
	'include_trashed' => false,
	'on_update'       => false,
	'reserved'        => null); 

	public function setTitleAttribute($title)
	{
	$this->attributes['title'] = $title;
	$this->attributes['slug'] = Str::slug($title);
	}
       public function isActivated()
	{
		return (bool) $this->active;
	}

	   public static function get_todays_banner($type)
	{ 
			$somedate = date('Y-m-d H:i:s');
			$end = strtotime('+1 day ', strtotime($somedate));
		$end_date = date('Y-m-d',$end);
	
	 $result =  DB::table('banners')->where('start_date','<=',DATE('Y-m-d').'00:00:00')->where('end_date','>=',DATE('Y-m-d').'00:00:00')->where('active',1)->where('banner_type',$type)->get();
	 
	   return $result; 
		
	}

   
}


