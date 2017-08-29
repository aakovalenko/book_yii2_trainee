<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $title
 * @property integer $cost
 * @property integer $type_id
 * @property string $test
 * @property integer $sklad_id
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type_id', 'sklad_id'], 'required'],
            [['cost', 'type_id', 'sklad_id'], 'integer'],
            [['test'], 'string'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'cost' => Yii::t('app', 'Cost'),
            'type_id' => Yii::t('app', 'Type ID'),
            'test' => Yii::t('app', 'Test'),
            'sklad_id' => Yii::t('app', 'Sklad ID'),
        ];
    }

    public static function getTypeList()
    {
        return [
            'first',
            'second',
            'third'
        ];
    }

    public function getSklad()
    {
        return $this->hasOne(Sklad::className(), ['id' => 'sklad_id']);
    }

    public function getSkladName()
    {
        return (isset($this->sklad)) ? $this->sklad->title: 'Not specified!';
    }

    public function getTypeName()
    {
        $list = $this->getTypeList();
        return $list[$this->type_id];
    }



}
