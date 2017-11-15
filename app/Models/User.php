<?php

namespace App\Models;

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
        'nickname', 'name', 'email', 'password', 'tel', 'birthday', 'gender', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getCurrentPoint()
    {
        return $this->belongsTo('App\Models\UserPoint');
    }

    public function getActionHistories()
    {
        return $this->hasMany('App\Models\ActionHistory');
    }
}
