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
            $uncheck_contacts = sizeof(Contact::where('checked', 0)->get());
            $checked_contacts = sizeof(Contact::where('checked', 1)->get());
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

            $content->row(function (Row $row) {

                $row->column(3, function (Column $column) {
                    $new_contacts = Contact::orderBy('id', 'desc')
                        ->limit(config('settings.admin.home.index.contacts_limit'))->get();
                    $column->append(view('admin.home.new_contacts')->with('new_contacts', $new_contacts));
                });

                $row->column(3, function (Column $column) {
                    $new_users = User::orderBy('id', 'desc')
                        ->limit(config('settings.admin.home.index.users_limit'))->get();
                    $column->append(view('admin.home.new_users')->with('new_users', $new_users));
                });

                $row->column(3, function (Column $column) {
                    $new_categories = Category::orderBy('id', 'desc')
                        ->limit(config('settings.admin.home.index.categories_limit'))->get();
                    $column->append(view('admin.home.new_categories')->with('new_categories', $new_categories));
                });

                $row->column(3, function (Column $column) {
                    $new_items = Item::orderBy('id', 'desc')
                        ->limit(config('settings.admin.home.index.items_limit'))->get();
                    $column->append(view('admin.home.new_items')->with('new_items', $new_items));
                });
            });
        });
    }
}
