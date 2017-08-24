<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use app\models\PostTag;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $created_date
 * @property integer $modified_date
 * @property string $url
 * @property integer $status_id
 * @property integer $sort
 */
class Post extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    public function behaviors(){
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_date',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'modified_date',
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'url', 'status_id', 'sort'], 'required'],
            [['text'], 'string'],
            [['url'],'unique'],
            [['created_date', 'modified_date', 'status_id', 'sort'], 'integer'],
            [['title', 'url'], 'string', 'max' => 255],
            [['sort'], 'integer', 'max' => 99, 'min' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Заголовок'),
            'text' => Yii::t('app', 'Text'),
            //'created_date' => Yii::t('app', 'Created Date'),
            //'modified_date' => Yii::t('app', 'Modified Date'),
            'url' => Yii::t('app', 'ЧПУ'),
            'status_id' => Yii::t('app', 'Статус'),
            'sort' => Yii::t('app', 'Сортировка'),
        ];
    }

    //-------------------------СВЯЗИ------------------------------------------//

    public function getAuthor()
    {
       return $this->hasOne(Users::className(),['id' => 'user_id']);
    }

    public function getPostTag()
    {
        return $this->hasMany(PostTag::className(),['blog_id' => 'id']);
    }

    public function getTag(){
        return $this->hasMany(Tag::className(),['id'=>'tag_id'])->via('PostTag');
    }
}
