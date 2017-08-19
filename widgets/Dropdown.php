<?php
/**
 * Created by PhpStorm.
 * User: andri
 * Date: 19.08.17
 * Time: 12:05
 */

namespace app\widgets;

use yii\bootstrap\Dropdown as BaseDropdown;
use yii\helpers\Html;


class Dropdown extends BaseDropdown
{

    public function init()
    {
        if ($this->submenuOptions === null) {
            // copying of [[options]] kept for BC
            // @todo separate [[submenuOptions]] from [[options]] completely before 2.1 release
            $this->submenuOptions = $this->options;
            unset($this->submenuOptions['id']);
        }
        parent::init();
        Html::removeCssClass($this->options, 'dropdown-menu');
    }

}