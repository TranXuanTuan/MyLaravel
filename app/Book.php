<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    public function scopeCheckNum($query)
    {
    	return $query->where('num', '>', 10);
    }

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
  
}
