<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'text:raw', //raw - убирает html теги
           // 'created_date',
            //'modified_date',
             ['attribute' => 'url', 'format'=>'text'],
             ['attribute' => 'status_id', 'filter' => [0 => 'off', 1 =>'on']],
            // 'sort',

            ['class' => 'yii\grid\ActionColumn',
                   'template' => '{view} {update} {delete} {check}',
                   'buttons' => [
                      'check' => function ($url, $model, $key){
                         return Html::a('<i class="fa fa-check" aria-hidden="true"></i>',$url);

                      }
               ],
                'visibleButtons' => [
                        'check' => function ($model, $key, $index){
                            return $model->status_id === 1;
                        }
                ]
            ]
        ],
    ]); ?>


<?php Pjax::end(); ?>
</div>
