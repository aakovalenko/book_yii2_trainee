<?php
use yii\helpers\Html;
/**
 * Created by PhpStorm.
 * User: andri
 * Date: 23.08.17
 * Time: 9:12
 */


/* @var $this yii\web\View */
/* @var $posts app\models\Post */ //чтоб не ругалась ide на $posts
?>
<div class="body-content">

    <div class="row">
        <?php foreach ($posts as $post) :?>
            <div class="col-lg-12">
                <h2><?=$post->title;?></h2>

                <p><?=$post->text;?></p>

                <?= \yii\bootstrap\Html::a('подробнее', ['post/one', 'url' => $post->url],['class' => 'btn-btn-success']) ?>
            </div>
        <?php endforeach;?>
    </div>

</div>
<p>
    <?= Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
</p>
