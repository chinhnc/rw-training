<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionHistory extends Model
{
    protected $primaryKey = 'result_id';

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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function genResultId($user_id, $item_id)
    {
        return $user_id . '_' . $item_id . '_' . now() . '_' . str_random(5);
    }

    public function showStatus()
    {
        return config('settings.items.status.' . $this->status);
    }
}
