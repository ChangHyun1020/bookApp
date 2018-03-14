<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'confrim_code', 'activated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
        'confrim_code', 'activated', 'last_login'
    ];

    protected $dates = [
        'last_login'
    ];

    protected $casts = [
        'activated' => 'boolean',
    ];


    //relation
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
