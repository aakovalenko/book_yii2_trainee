<?php
namespace app\components\behaviors;

use yii\base\Behavior;
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 28.08.17
 * Time: 14:18
 */

class StatusBehaviors extends Behavior
{
    public $statusList;

    public function getStatusList()
    {
        return $this->statusList;
    }

    public function getStatusName()
    {
        $list = $this->owner->getStatusList();
        return $list[$this->owner->status_id];
    }

    public function events()
    {
        return [];
    }
}