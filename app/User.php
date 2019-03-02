<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','type','img_user','img_bio','bio_description','sex','fecha','address','work','phone','facebook','twitter','instagram'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function scopeSearch($query,$name)
    {
        return $query->where('name', 'LIKE', "%$name%");
    }

    public function scopeSearchUser($query,$id)
    {
        return $query->where('id', '=', $id);
    }

    public function admin(){
        return $this->type==="admin";
    }

    public function superadmin(){
        return $this->type==="superadmin";
    }

    public function hasBeenUpdated()
    {
        return $this->updated_at != $this->created_at;
    }

    public function likes()
    {
        return $this->belongsToMany('App\Article', 'likes', 'user_id', 'article_id')->withTimestamps();
    }

    public function coments()
    {
        return $this->hasMany('App\Coment');
    }


}
