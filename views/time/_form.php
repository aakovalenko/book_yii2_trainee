<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;


/* @var $this yii\web\View */
/* @var $model app\models\Time */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="time-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'time')->widget(DateControl::className(),[
            'type' => DateControl::FORMAT_TIME
    ]); ?>

    <?= $form->field($model, 'date')->widget(DateControl::className(), []); ?>

    <?= $form->field($model, 'datetime')->widget(DateControl::className(),[
        'type' => DateControl::FORMAT_DATETIME,
        'displayFormat' => 'yyyy-mm-dd h:i:s'
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
