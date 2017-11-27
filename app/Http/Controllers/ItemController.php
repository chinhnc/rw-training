<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function show(Item $item)
    {
        $categories = Category::all();
        return view('items.show', compact(['item', 'categories']));
    }
}
