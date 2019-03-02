<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{

    protected $table = 'likes';

    protected $fillable = ['user_id','article_id'];
}
