<?php
namespace app\components\behaviors;

use yii\db\ActiveRecord;
use yii\base\Behavior;
use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 28.08.17
 * Time: 14:18
 */

class StatusBehaviors extends Behavior
{
    public $statusList;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'ddd',
        ];
    }


    public function getStatusList()
    {
        return $this->statusList;
    }

    public function getStatusName()
    {
        $list = $this->owner->getStatusList();
        return $list[$this->owner->status_id];
    }


    public function ddd($events)
    {
        $this->owner->title = $this->owner->title.' ]-__-[';
    }
}