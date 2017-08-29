<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "time".
 *
 * @property integer $id
 * @property string $time
 * @property string $date
 * @property string $datetime
 */
class Time extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time', 'date', 'datetime'], 'required'],
            [['time', 'date', 'datetime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'time' => Yii::t('app', 'Time'),
            'date' => Yii::t('app', 'Date'),
            'datetime' => Yii::t('app', 'Datetime'),
        ];
    }
}
