<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name','description','photo','uom_id','category_id','prices'];

    public function uom(){
    	return $this->belongsTo('App\Uom');
    }

    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function tags(){
    	return $this->belongsToMany('App\Tag','product_tags');
    }
}
