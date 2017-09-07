<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\osmb\models\House */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="house-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_house')->textInput(['maxlength' => true])->hint( Yii::t('app', 'If_exist_num')) ?>

    <?= $form->field($model, 'quan_app')->textInput() ?>

    <?= $form->field($model, 'cost_on_m')->textInput() ?>

    <?= $form->field($model, 'buchg_id')->textInput(['readonly' => true, 'value' => Yii::$app->user->id])->hiddenInput(['maxlength' => true])->label(false)  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
