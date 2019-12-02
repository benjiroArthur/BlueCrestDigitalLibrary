<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable= ['name','faculty_id', 'cover_image'];

    protected $with = ['books'];

    protected $withCount = ['books'];
    //relationships

    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }

    public function books()
    {
        return $this->hasMany('App\Book');
    }

//    public function getCoverImageAttribute($value)
//    {
//        return asset('images/department/'.$value);
//    }
}
