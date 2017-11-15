<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['result_id', 'user_id', 'item_id', 'point_num', 'status'];

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }
}
