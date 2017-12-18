<?php

namespace App\Http\Controllers;

use App\Models\ActionHistory;
use App\Models\Category;
use App\Models\Item;
use App\Models\News;
use App\Models\Ranking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::active()->defaultOrder()->paginate(config('settings.items.paginate.perPage'));
        return view('homes.index', compact(['items']));
    }

    public function showItemsByCategory(Category $category)
    {
        $items = $category->activeItems()->defaultOrder()->paginate(config('settings.items.paginate.perPage'));
        return view('homes.show_item_by_category', compact(['items', 'category']));
    }
}
