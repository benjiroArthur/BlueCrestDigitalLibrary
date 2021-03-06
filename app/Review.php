<?php

namespace App;

use App\Events\BroadcastComment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Review extends Model
{
    //
    protected $fillable = ['user_id', 'book_id', 'comment', 'like'];

    //protected $casts = ['like' => 'boolean'];

    //broadcast
//    protected $dispatchesEvents = [
//        'created' => BroadcastComment::class,
//        'updated' => BroadcastComment::class
//    ];

    //relationships
    public function book()
    {
        return $this->belongsTo('App\Book');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
