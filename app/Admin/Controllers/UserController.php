<?php

namespace App\Admin\Controllers;

use App\Models\ActionHistory;
use App\Models\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserController extends Controller
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

            $content->header('Users');
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

            $content->header('Users');
            $content->description('edit');

            $content->body($this->form()->edit($id));
        });
    }

    public function getPassbookByUser($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Users');
            $content->description('Passbook');

            $content->body($this->actionsByUser($id));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function actionsByUser($id)
    {
        return Admin::grid(ActionHistory::class, function (Grid $grid) use ($id) {
            $grid->model()->where('user_id', $id)->orderBy('created_at', 'desc');

            $grid->item_id('Item ID');
            $grid->item()->display(function ($item) {
                return $item['title'];
            });
            $grid->point_num('Point');
            $grid->status('Status');

            $grid->created_at()->sortable();
            $grid->updated_at()->sortable();

            $grid->filter(function($filter){
                $filter->equal('item_id', 'Item ID');
                $filter->in('status')->multipleSelect(['approval' => 'approval', 'pending' => 'pending', 'reject' => 'reject',]);
                $filter->date('created_at', 'Created At');
                $filter->date('updated_at', 'Updated At');
            });

            $grid->disableCreation();
            $grid->disableActions();
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('activated')->display(function ($activated) {
                return $activated ? '<span class="label label-success">True</span>' : '<span class="label label-danger">False</span>';
            });
            $grid->name('Name')->sortable();
            $grid->nickname('Nickname');
            $grid->email('Email');
            $grid->tel('Tel');

            $grid->created_at()->sortable();
            $grid->updated_at()->sortable();

            $grid->filter(function($filter){
                $filter->like('name', 'Name');
                $filter->like('nickname', 'Nickname');
                $filter->like('email', 'Email');
                $filter->like('tel', 'Tel');
                $filter->date('created_at', 'Created At');
                $filter->date('updated_at', 'Updated At');
            });

            $grid->disableCreation();
            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->append('<a href="' . route('admin_passbook', $actions->getKey()) . '"><i class="fa fa-eye"></i>Passbook</a>');
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
        return Admin::form(User::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->display('activated', 'Activated?');
            $form->display('nickname', 'Nickname');
            $form->display('name', 'Name');
            $form->display('email', 'Email');
            $form->display('tel', 'Tel');
            $form->display('birthday', 'Birthday');
            $form->display('gender', 'Gender');

            $states = [
                'on'  => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
            ];
            $form->switch('is_active', 'Is Active')->states($states)->rules('required');

            $form->display('created_at', trans('admin.created_at'));
            $form->display('updated_at', trans('admin.updated_at'));
        });
    }
}
