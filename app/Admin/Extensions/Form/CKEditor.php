<?php
/**
 * Created by PhpStorm.
 * User: nguyen_cong_chinh
 * Date: 2017/12/14
 * Time: 12:12
 */

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class CKEditor extends Field
{
    public static $js = [
        '/packages/ckeditor/ckeditor.js',
        '/packages/ckeditor/adapters/jquery.js',
    ];

    protected $view = 'admin.ckeditor';

    public function render()
    {
        $this->script = "$('textarea." . $this->getElementClass()[0] . "').ckeditor();";

        return parent::render();
    }
}