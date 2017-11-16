<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'point_num', 'url', 'image', 'is_active', 'start_time', 'end_time'];

    public function category()
    {
        return $this->belongsToMany('App\Models\Category', 'item_categories', 'item_id', 'category_id');;
    }
}
