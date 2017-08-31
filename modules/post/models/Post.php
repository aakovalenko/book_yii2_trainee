<?php

namespace app\modules\post\models;

use app\models\ImageUpload;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use app\modules\post\models\PostTag;
use yii\helpers\ArrayHelper;
use app\components\behaviors\StatusBehaviors;

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
 *  @property string  $image
 *
 */
class Post extends ActiveRecord
{
    const STATUS_LIST = ['off','on'];
    public $tags_array;
    public $file;
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
            ],
            'statusBehavior' => [
                'class' => StatusBehaviors::className(),
                'statusList' => self::STATUS_LIST,
            ]
        ];
        /*
        [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'create_time',
            'updatedAtAttribute' => 'update_time',
            'value' => new Expression('NOW()'),
        ],
        */
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
            [['tags_array'], 'safe'],
            [['image'], 'string', 'max' => 100],
            [['file'],'image'],
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
            'tags_array' => Yii::t('app','Теги'),
            'tagsAsString' => Yii::t('app','Теги'),
            'author.name' => Yii::t('app', 'Автор'),
            //'image' => Yii::t('app', 'Картинка'),
            //'file' => Yii::t('app', 'Картинка'),
        ];
    }

    //-------------------------СВЯЗИ------------------------------------------//




    public function getAuthor()
    {
       return $this->hasOne(Users::className(),['id' => 'user_id']);
    }

    public function getPostTag()
    {
        return $this->hasMany(PostTag::className(),['post_id' => 'id']);
    }

    public function getTags(){
        return $this->hasMany(Tag::className(),['id'=>'tag_id'])->via('postTag'); //**********PostTrag
    }

    public function getTagsAsString(){
        $arr = ArrayHelper::map($this->tags, 'id', 'name');
        return implode(', ',$arr);
    }

    public function afterFind(){
        parent::afterFind();
        $this->tags_array = $this->tags;
    }


    public function afterSave($insert, $changeAttributes)
    {
        parent::afterSave($insert, $changeAttributes);

        $arr = ArrayHelper::map($this->tags, 'id','id');
        foreach ($this->tags_array as $one) {
            if(!in_array($one, $arr)){
                $model = new PostTag();
                $model->post_id = $this->id;
                $model->tag_id = $one;
                $model->save();
            }
            if(isset($arr[$one])){
                unset($arr[$one]);
            }
        }
        PostTag::deleteAll(['tag_id' => $arr]);
    }

    public function saveImage($filename) //ловим имя загруженной картинки
    {
        $this->image = $filename;
        return $this->save(false); //сохраняем без валидации
    }

    public function getImage()
    {
        return ($this->image) ? '/uploads/' . $this->image : '/no-image.png';
    }

    public function deleteImage()
    {
        $imageUpLoadModel = new ImageUpload();
        $imageUpLoadModel->deleteCurrentImage($this->image);
    }

    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete();
    }
}
