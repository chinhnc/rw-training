<?php
/**
 * Created by PhpStorm.
 * User: nguyen_cong_chinh
 * Date: 2017/12/15
 * Time: 18:07
 */

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Displayers\AbstractDisplayer;

class Popover extends AbstractDisplayer
{
    public function display($placement = 'left')
    {
        Admin::script("$('[data-toggle=\"dmm\"]').popover()");

        return <<<EOT
<button type="button"
    class="btn btn-secondary"
    title="Detail" 
    data-html="true" 
    data-container="body"
    data-toggle="popover"
    data-placement="$placement"
    data-content="{$this->value}"
    >Detail
</button>

EOT;

    }
}
