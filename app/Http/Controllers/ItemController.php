<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewCreateRequest;
use App\Models\ActionHistory;
use App\Models\Category;
use App\Models\Item;
use App\Models\Point;
use App\Models\Ranking;
use Auth;
use DB;
use Illuminate\Http\Request;
use willvincent\Rateable\Rating;
use Illuminate\Support\Facades\Cache;

class ItemController extends Controller
{
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
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
        $keyword = $request->keyword;

        if (!empty($keyword)) {
            $items = Item::search($keyword)->paginate(config('settings.items.paginate.perPage'));
        } else {
            $items = Item::active()->defaultOrder()->paginate(config('settings.items.paginate.perPage'));
        }

        return view('items.search', compact(['items', empty($keyword) ? '' : 'keyword']));
    }

    public function autocomplete(Request $request)
    {
        $keyword = $request->term;

        $queries = Item::search($keyword)
            ->take(config('items.autocomplete.termCount'))
            ->get();

        $results = [];

        foreach ($queries as $item) {
            $results[] = [
                'id' => $item->id,
                'image' => asset('uploads/' . $item->image),
                'url' => route('item.show', $item->id),
                'title' => str_limit(
                    $item->title,
                    config('settings.items.autocomplete.stringLimit'),
                    '...'
                ),
            ];
        }

        return response()->json($results);
    }

    public function review(Item $item, ReviewCreateRequest $request)
    {
        $rating = new Rating;
        $rating->rating = $request->star;
        $rating->review = $request->review;
        $rating->user_id = Auth::user()->id;
        $item->ratings()->save($rating);

        return back()->with('success-msg', 'レビューを送りました！');
    }
}
