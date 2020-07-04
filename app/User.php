<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\PasswordResetNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'gender',
        'date_of_birth', 'phone_number', 'image', 'role_id',
        'password_changed', 'profile_updated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password_changed' => 'boolean',
        'profile_updated' => 'boolean',
        'date_of_birth'=> 'date',
    ];

    //relationships
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function getImageAttribute($value)
    {
        return asset('images/users/'.$value);
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }
}
