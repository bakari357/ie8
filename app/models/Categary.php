<?php
use Jenssegers\Mongodb\Model as Eloquent;

class Categary extends Eloquent {
  protected $connection = 'mongodb';
    protected $collection = 'category';


}
