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

    public function scopeGetCurrentTopUsers($query)
    {
        $month = now()->format('m');
        $year = now()->format('Y');
        return $query->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->where('status', 'approval')
            ->groupBy('user_id')
            ->selectRaw('sum(point_num) as sum_point, user_id')
            ->orderBy('sum_point', 'desc')->limit(3)->get();
    }

    public function scopeGetCurrentTopItems($query)
    {
        $month = now()->format('m');
        $year = now()->format('Y');
        return $query->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->where('status', 'approval')
            ->groupBy('item_id')
            ->selectRaw('count(*) as action_count, item_id')
            ->orderBy('action_count', 'desc')->limit(8)->get();
    }
}
