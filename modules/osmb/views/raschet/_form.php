<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\osmb\models\Raschet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="raschet-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nachisleno')->textInput() ?>

    <?= $form->field($model, 'summ_oplata')->textInput() ?>

    <?= $form->field($model, 'summ_dolg')->textInput() ?>

    <?= $form->field($model, 'summ_subsid')->textInput() ?>

    <?= $form->field($model, 'summ_benefit')->textInput() ?>

    <?= $form->field($model, 'appartment_id')->textInput() ?>

    <?= $form->field($model, 'date')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
