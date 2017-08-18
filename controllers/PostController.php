<?php
/**
 * Created by PhpStorm.
 * User: andri
 * Date: 18.08.17
 * Time: 11:40
 */

namespace app\controllers;


use yii\web\Controller;
use app\models\Post;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;



class PostController extends Controller
{
    public function actionIndex()
    {
        $posts = Post::find()->all();

        foreach ($posts as $post) {
            echo Html::tag('h4', $post->title);
            echo $post->text;
        }

    }
}