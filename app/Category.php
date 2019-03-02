<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name'];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }
    public function scopeSearch($query,$name)
    {
        return $query->where('name', 'LIKE', "%$name%");
    }
    public function scopeSearchCategory($query,$name)
    {
        return $query->where('name', '=', $name);
    }
}
