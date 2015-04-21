<?php
//use Jenssegers\Mongodb\Model as Eloquent;
class Page extends Eloquent {
   //protected $connection = 'mongodb';
  // protected $collection = 'Products';
   
    protected $table = 'pages';
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


   
}


