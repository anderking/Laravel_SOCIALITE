<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;
    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'maxLength'       => null,
                'method'          => null,
                'separator'       => '-',
                'unique'          => true,
                'uniqueSuffix'    => null,
                'includeTrashed'  => false,
                'reserved'        => null,
            ]
        ];
    }
    protected $table = 'articles';
    protected $fillable = ['title','content','category_id','user_id','img_dest'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
    public function scopeSearch($query,$title)
    {
        return $query->where('title', 'LIKE', "%$title%");
    }

    public function hasBeenUpdated()
    {
        return $this->updated_at != $this->created_at;
    }

    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }
    
    public function coments()
    {
        return $this->hasMany('App\Coment');
    }

}