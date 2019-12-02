<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['name', 'cover_image'];

    protected $with = ['departments', 'books'];

    protected $withCount = ['books','departments'];

    //relationships
    public function books()
    {
        return $this->hasManyThrough('App\Book', 'App\Department');
    }

    public function departments()
    {
        return $this->hasMany('App\Department');
    }

    public function getCoverImageAttribute($value)
    {
        return asset('images/faculty/'.$value);
    }


}
