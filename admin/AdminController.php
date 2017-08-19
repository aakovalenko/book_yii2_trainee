<?php
/**
 * Created by PhpStorm.
 * User: andri
 * Date: 19.08.17
 * Time: 12:19
 */

namespace admin;


use yii\filters\AccessControl;
use yii\web\Controller;

class AdminController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ]
        ];
    }

    public $layout = '@admin/views/layouts/main';

}