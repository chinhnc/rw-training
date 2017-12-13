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

    public function activeItems()
    {
        return $this->items()->active();
    }

    public function item_categories()
    {
        return $this->hasMany('App\Models\ItemCategory');
    }

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($category) { // before delete() method call this
             $category->item_categories()->delete();
             // do the rest of the cleanup...
        });
    }
}
