<?php

namespace App\Http\Controllers;

use App\Models\ActionHistory;
use App\Models\Category;
use App\Models\Item;
use App\Models\Point;
use Auth;
use DB;
use Illuminate\Http\Request;

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

        if (!$item->is_active || $item->start_time > now() || $item->end_time < now()) {
            return back()->with('error-msg', 'この案件はすでに無効になりました！利用できなくなります！');
        }

        $user->getActionHistories()->create([
            'result_id' => ActionHistory::genResultId($user->id, $item->id),
            'item_id' => $item->id,
            'point_num' => $item->point_num
        ]);

        // update point after action item
        Point::updatePointForUser($user, $item);

        return redirect($item->url);
    }

    public function searchItem(Request $request)
    {
        $categories = Category::all();
        $keyword = $request->keyword;

        if (!empty($keyword)) {
            $items = Item::search($keyword)->paginate(config('settings.items.paginate.perPage'));
        } else {
            $items = Item::active()->defaultOrder()->paginate(config('settings.items.paginate.perPage'));
        }

        return view('items.search', compact(['items', 'categories', empty($keyword) ? '' : 'keyword']));
    }
}
