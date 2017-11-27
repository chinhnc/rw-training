<?php

namespace App\Http\Controllers;

use App\Models\ActionHistory;
use App\Models\Category;
use App\Models\Item;
use App\Models\Point;
use Auth;
use DB;

class ItemController extends Controller
{
    public function show(Item $item)
    {
        $categories = Category::all();
        return view('items.show', compact(['item', 'categories']));
    }

    public function actionItem(Item $item)
    {
        $user = Auth::user();
        $user->getActionHistories()->create([
            'result_id' => ActionHistory::genResultId($user->id, $item->id),
            'item_id' => $item->id,
            'point_num' => $item->point_num
        ]);

        // update point after action item
        Point::updatePointForUser($user, $item);

        return redirect($item->url);
    }
}
