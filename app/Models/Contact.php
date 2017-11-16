<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'tel', 'subject', 'content', 'checked'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}