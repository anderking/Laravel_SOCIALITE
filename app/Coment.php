<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coment extends Model
{
    protected $table = 'coments';
    protected $fillable = ['coment','article_id','user_id'];
		
		public function article()
    {
        return $this->belongsTo('App\Article');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function hasBeenUpdated()
    {
        return $this->updated_at != $this->created_at;
    }
}
