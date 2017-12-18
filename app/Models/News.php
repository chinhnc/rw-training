<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content'];

    public function scopeDefaultOrder($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public static function getRecentlyNews()
    {
        return News::defaultOrder()->limit(config('settings.news.home.limit'))->get();
    }
}
