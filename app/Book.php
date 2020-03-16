<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'cover_image', 'file_name', 'department_id', 'year_of_publication'];

    protected $with = ['reviews'];

    protected $withCount = ['reviews'];

    public function getAuthorAttribute($value)
    {
        return Str::title($value);
    }

    public function getTitleAttribute($value)
    {
        return Str::title($value);
    }

    public function getCoverImageAttribute($value)
    {
        //$department = $this->book->department->name;
        return asset('images/books/'.$value);
    }

    public function getFileNameAttribute($value)
    {

        return public_path().'/books/'.$value;

    }
//    public function getYearOfPublicationAttribute($value)
//    {
//
//        return diffForHumans($value);
//    }

    //relationship
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function faculty()
    {
        return $this->hasOneThrough('App\Faculty', 'App\Department');
    }
}
