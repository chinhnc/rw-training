<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use willvincent\Rateable\Rateable;

class Item extends Model
{
    use Rateable;
    use Searchable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'point_num', 'url', 'image', 'is_active', 'start_time', 'end_time'];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'item_categories', 'item_id', 'category_id');;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1)->where('end_time', '>=', now())->where('start_time', '<=', now());
    }

    public function scopeDefaultOrder($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
