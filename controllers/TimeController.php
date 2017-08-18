<?php
/**
 * Created by PhpStorm.
 * User: andri
 * Date: 18.08.17
 * Time: 12:38
 */

namespace app\controllers;


use yii\base\Controller;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use app\models\Post;


class TimeController extends Controller
{
    public function actionIndex()
    {
        $post = new Post;
        $post->title = 'Gotch!';
        $post->text = 'We need some laughter to ease the tension of holiday
shopping.';
        $post->save();

        return $this->renderContent(Html::tag('pre',
            VarDumper::dumpAsString($post->attributes))
        );
    }
}