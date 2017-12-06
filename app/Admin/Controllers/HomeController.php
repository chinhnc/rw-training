<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Item;
use App\Models\User;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Dashboard');
            $content->description('Management');

            $all_contacts = sizeof(Contact::all());
            $uncheck_contacts = sizeof(Contact::where('checked', 1)->get());
            $checked_contacts = sizeof(Contact::where('checked', 0)->get());
            $all_users = sizeof(User::all());
            $all_categories = sizeof(Category::all());
            $all_items = sizeof(Item::all());

            $content->row(view('admin.home.index', compact([
                'all_contacts',
                'uncheck_contacts',
                'checked_contacts',
                'all_users',
                'all_categories',
                'all_items'
            ])));
        });
    }
}
