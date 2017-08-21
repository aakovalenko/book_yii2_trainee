<?php
/**
 * Created by PhpStorm.
 * User: andri
 * Date: 19.08.17
 * Time: 13:13
 */

namespace app\models;

use yii\web\UploadedFile;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;



class RegistrationForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $fio;
    public $avatar;

    public $_user;

    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'email', 'fio'], 'required'],
            [['username', 'email'], 'trim'],
            [['email'], 'email'],
            [['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['username', 'email'], 'unique', 'targetClass' => Users::className()],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'fio' => Yii::t('app', 'Fio'),
            'email' => Yii::t('app', 'Email'),
            'avatar' => Yii::t('app', 'Avatar'),
        ];
    }

    public function register()
    {
        if (!$this->validate()) {
            return false;
        }
        $this->_user = new Users();
        $this->upload();
        $this->_user->load(
            ArrayHelper::merge($this->attributes, [
                'hash' => Yii::$app->security->generatePasswordHash($this->password),
                'role' => 'client',
            ])

        );


        $saved = $this->_user->save();
        if ($saved) {
            Yii::$app->user->login($this->_user);
        }
        return $saved;
    }


    public function upload()
    {
        if ($this->validate()) {

            $files = UploadedFile::getInstance($this, 'files');

            foreach ($files as $file) {
                $this->_user = new User();
                $filename = $file->baseName . '.' . $file->extension;
                $pat = '@app/admin/downloads/avatar' . $this->type . DIRECTORY_SEPARATOR . $this->id;
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }
            }

        } else {
            return false;
        }

    }
}