<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\Ranking;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::defaultOrder()->paginate(config('settings.news.paginate.perPage'));
        return view('news.index', compact('news'));
    }
}
