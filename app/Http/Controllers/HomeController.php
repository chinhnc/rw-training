<?php

namespace App\Http\Controllers;

use App\Models\ActionHistory;
use App\Models\Category;
use App\Models\Item;
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
        $top_items = Ranking::getCurrentTopItemsFromCache();
        $top_users = Ranking::getCurrentTopUsersFromCache();
        $categories = Category::all();
        $items = Item::active()->defaultOrder()->paginate(config('settings.items.paginate.perPage'));
        return view('homes.index', compact(['categories', 'items', 'top_users', 'top_items']));
    }

    public function showItemsByCategory(Category $category)
    {
        $top_items = Cache::has('top_items') ? Cache::get('top_items') : [];
        $top_users = Cache::has('top_users') ? Cache::get('top_users') : [];
        $categories = Category::all();
        $items = $category->activeItems()->defaultOrder()->paginate(config('settings.items.paginate.perPage'));
        return view('homes.show_item_by_category', compact(['items', 'category', 'categories', 'top_users', 'top_items']));
    }
}
