<?php
/**
 * Created by PhpStorm.
 * User: nguyen_cong_chinh
 * Date: 2017/11/28
 * Time: 17:19
 */

namespace App\Models;
use DB;


class Point
{
    public static function updatePointForUser($user, $item)
    {
        // get current point of current user
        $currentPoint = $user->getCurrentPoint->lockForUpdate()->first();

        if (!$currentPoint) {
            UserPoint::create(['user_id' => $user->id])->save();
            $currentPoint = $user->getCurrentPoint->lockForUpdate()->first();
        }

        //update current point for current user
        DB::transaction(function () use ($currentPoint, $item) {
            $currentPoint->update(['pending_point' => ($currentPoint->pending_point + $item->point_num)]);
        });
    }
}