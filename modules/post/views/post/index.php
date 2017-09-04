<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\post\models\Post;
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
            'created_date:datetime', //выводит время в читаевом виде
            'modified_date:datetime',
             ['attribute' => 'url', 'format'=>'text'],
             ['attribute' => 'status_id', 'filter' => Post::STATUS_LIST],
            // 'sort',

             ['attribute' => 'tags', 'value' => 'TagsAsString'],

            ['class' => 'yii\grid\ActionColumn',
                   'template' => '{view} {update} {delete} {check}',
                   'buttons' => [
                      'check' => function ($url, $model, $key){
                         return Html::a("<i class='glyphicon glyphicon-hand-right'></i>",$url);
                      },
                       'view' => function($url, $model, $key){
                          return Html::a("<i class='glyphicon glyphicon-eye-open'></i>", ['/post/post/view', 'url' => $model->url]);
                       },
               ],
                'visibleButtons' => [
                        'check' => function ($model, $key, $index){
                            return $model->status_id === 1;
                        }
                ],
            ],

            [
                    'format' => 'html',
                    'label' => 'Image',
                    'value' => function($data){
                         return Html::img($data->getImage(),['width'=> 75]);
                    }
            ]
        ],
    ]); ?>


<?php Pjax::end(); ?>
</div>
<div>
<?php Pjax::begin([
        'enablePushState' => false,
]); ?>
    <a href="/post/post/push" class="btn btn-info" role="button">Push here</a>

<?php Pjax::end(); ?>
</div>