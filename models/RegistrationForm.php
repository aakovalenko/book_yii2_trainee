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

        ];
    }

    public function register()
    {

        if (!$this->validate()){
            return false;
        }
        $this->_user = new Users();


        $this->_user->load(

            ArrayHelper::merge($this->attributes, [
                'hash' => Yii::$app->security->generatePasswordHash($this->password),
                'role' => 'client',
            ]),
            ''
        );

        $saved = $this->_user->save();
        if ($saved) {
            Yii::$app->user->login($this->_user);
        }

        return $saved;
    }



}