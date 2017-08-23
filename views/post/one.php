<?php
use yii\helpers\Html;
/**
 * Created by PhpStorm.
 * User: andri
 * Date: 23.08.17
 * Time: 9:12
 */
/* @var $post app\models\Post */

?>

<h1><?=$post->title;?></h1>
<?=$post->text;?>
<br>
<br>
<p>
    <?= Html::a(Yii::t('app', 'Update'), ['update'], ['class' => 'btn btn-success']) ?>
</p>



