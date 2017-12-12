<?php
/**
 * Created by PhpStorm.
 * User: nguyen_cong_chinh
 * Date: 2017/12/12
 * Time: 17:36
 */

namespace App\Models;

use Illuminate\Support\Facades\Cache;

class Ranking
{
    public static function getAndPutCurrentTopUsersToCache()
    {
        $top_users = ActionHistory::getCurrentTopUsers();
        Cache::put('top_users', $top_users, config('settings.cache.cache_minutes'));
        return $top_users;
    }

    public static function getAndPutCurrentTopItemsToCache()
    {
        $top_items = ActionHistory::getCurrentTopItems();
        Cache::put('top_items', $top_items, config('settings.cache.cache_minutes'));
        return $top_items;
    }

    public static function getCurrentTopUsersFromCache()
    {
        return Cache::has('top_users') ? Cache::get('top_users') : self::getAndPutCurrentTopUsersToCache();
    }

    public static function getCurrentTopItemsFromCache()
    {
        return Cache::has('top_items') ? Cache::get('top_items') : self::getAndPutCurrentTopItemsToCache();
    }
}