<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    public function items()
    {
        return $this->belongsToMany('App\Models\Item', 'item_categories', 'category_id', 'item_id');
    }
}
