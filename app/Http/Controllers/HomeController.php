<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $items = Item::active()->defaultOrder()->paginate(config('settings.items.paginate.perPage'));
        return view('homes.index', compact(['categories', 'items']));
    }

    public function showItemsByCategory(Category $category)
    {
        $categories = Category::all();
        $items = $category->activeItems()->defaultOrder()->paginate(config('settings.items.paginate.perPage'));
        return view('homes.show_item_by_category', compact(['items', 'category', 'categories']));
    }
}
