<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Item;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ItemController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Items');
            $content->description('management');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Item');
            $content->description('edit');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Item');
            $content->description('create');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Item::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title('Title');
            $grid->description('Description');
            $grid->categories('Categories')->pluck('name')->label();
            $grid->point_num('Point');
            $grid->url('URL');
            $grid->image('Image')->image();
            $grid->is_active('Is Active');
            $grid->start_time('Start Time');
            $grid->end_time('End Time');

            $grid->created_at();
            $grid->updated_at();

            $grid->filter(function($filter){
                // Add a column filter
                $filter->like('title', 'Title');
                $filter->like('description', 'Description');
                $filter->between('point_num', 'Point');
                $filter->equal('is_active')->radio([
                    ''   => 'All',
                    0    => 'Disactived',
                    1    => 'Actived',
                ]);
                $filter->between('start_time', 'Start Time')->datetime();
                $filter->between('end_time', 'End Time')->datetime();
                $filter->date('created_at', 'Created At');
                $filter->date('updated_at', 'Updated At');
            });

            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Item::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('title', 'Title')->rules('required|max:255');
            $form->textarea('description', 'Description')->rules('required');
            $form->number('point_num', 'Point')->rules('required|numeric');
            $form->text('url', 'URL')->rules('required|max:255');
            $form->image('image', 'Image')->rules('required');
            $states = [
                'on'  => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];
            $form->switch('is_active', 'Is Active')->states($states)->rules('required');
            $form->multipleSelect('categories', 'Categories')->options(Category::all()->pluck('name', 'id'))->rules('required');
            $form->datetime('start_time', 'Start Time')->rules('required');
            $form->datetime('end_time', 'End Time')->rules('required');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
