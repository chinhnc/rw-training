<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\News;
use App\Models\Ranking;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('common.categories_bar', function ($view) {
            $top_users = Ranking::getCurrentTopUsersFromCache();
            $categories = Category::all();
            $view->with(['categories' => $categories, 'top_users' => $top_users]);
        });

        view()->composer('common.top_items', function ($view) {
            $top_items = Ranking::getCurrentTopItemsFromCache();
            $view->with('top_items', $top_items);
        });

        view()->composer('common.news', function ($view) {
            $news = News::getRecentlyNews();
            $view->with('news', $news);
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
