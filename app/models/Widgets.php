<?php
//use Jenssegers\Mongodb\Model as Eloquent;
class Widgets extends Eloquent {
   //protected $connection = 'mongodb';
  // protected $collection = 'Products';
   
    protected $table = 'widget';
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
        public function getwidget()
	{
		$widget=DB::table('widget')->Join('widget_relation', 'widget_relation.widget_id', '=', 'widget.id')->Join('template', 'template.id', '=', 'widget_relation.temp_id')->where('template.active','1')->where('widget.region','middle')->where('widget.position','1')->get();
		return $widget;
	}

   
}


