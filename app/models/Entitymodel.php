<?php
//use Jenssegers\Mongodb\Model as Eloquent;
class Entitymodel extends Eloquent {
  
     protected $table = 'users';
    
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
