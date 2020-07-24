<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    protected $table = 'uoms';
    protected $fillable = ['name','code','measure_type'];
}
