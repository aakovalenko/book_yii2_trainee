<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use kartik\select2\Select2;
use app\models\Tag;
use app\models\Post;


/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'text')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'plugins' => [
                'clips',
                'fullscreen',
                'frontcolor'
            ],
            'imageUpload' => Url::to(['/default/image-upload']),
        ]
    ]);?>


    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_id')->dropDownList(Post::STATUS_LIST) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?=$form->field($model, 'tags_array')->widget(Select2::classname(), [

    'data' => ArrayHelper::map(
            Tag::find()->all(), 'id', 'name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a tag ...', 'multiple' => true], //'multiple -> для выбора нескольких значений
    'pluginOptions' => [
        'allowClear' => true,
        'tags' => true,
        'maximumInputLength' => 10,
    ],

    ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
