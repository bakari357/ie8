<?php
//use Jenssegers\Mongodb\Model as Eloquent;
class Wallet extends Eloquent {
  // protected $connection = 'mongodb';
  // protected $collection = 'pages';
     protected $table = 'wallet_settings';
     
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
