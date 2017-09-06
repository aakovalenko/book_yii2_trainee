<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Menu');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Menu'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tree',
            'lft',
            'rgt',
            'depth',
            // 'name',
            ['attribute' => 'url', 'format'=>'text'],
            // 'text',

            ['class' => 'yii\grid\ActionColumn',

                'template' => '{view} {update} {delete}',
                'buttons' => [

                    'view' => function($url, $model, $key){
                        return Html::a("<i class='glyphicon glyphicon-eye-open'></i>", ['/menu/view/', 'id' => $model->id]);
                    },
                    'update' => function($url, $model, $key){
                        return Html::a("<i class='glyphicon glyphicon-pencil'></i>", ['/menu/update/', 'id' => $model->id]);
                    },
                ],
                ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
