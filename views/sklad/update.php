<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sklad */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Sklad',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sklads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sklad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
