<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\CheckContact;
use App\Models\Contact;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

class ContactController extends Controller
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

            $content->header('Contacts');
            $content->description('management');

            $content->body($this->grid());
        });
    }

    public function toggleContactCheckedStatus(Request $request)
    {
        foreach (Contact::find($request->get('ids')) as $contact) {
            $contact->checked = $request->get('action');
            $contact->save();
        }
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Contact::class, function (Grid $grid) {
            $grid->model()->orderBy('created_at', 'desc');
            $grid->id('ID')->sortable();
            $grid->user()->display(function ($user) {
                return $user['nickname'] ? '<a href="' . route('users.edit', $user['id']) . '">' . $user['nickname'] . '</a>' : 'Unknown';
            });
            $grid->email('Email');
            $grid->tel('Tel');
            $grid->subject('Subject');
            $grid->content('Content')->popover();
            $grid->checked('Checked?')->display(function ($checked) {
                return $checked ? '<span style="color: blue;">YES</span>' : '<span style="color: red;">NO</span>';
            });

            $grid->created_at();
            $grid->updated_at();

            $grid->filter(function($filter){
                $filter->like('email', 'Email');
                $filter->like('tel', 'Tel');
                $filter->equal('checked')->radio([
                    ''   => 'All',
                    0    => 'Unchecked',
                    1    => 'Checked',
                ]);
            });

            $grid->disableActions();
            $grid->disableCreation();

            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->add('Check', new CheckContact(1));
                    $batch->add('Uncheck', new CheckContact(0));
                });
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

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
