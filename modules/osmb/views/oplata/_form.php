<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\osmb\models\Oplata */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oplata-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'oplata')->textInput() ?>

    <?= $form->field($model, 'subsid')->textInput() ?>

    <?= $form->field($model, 'raschet_id')->hiddenInput(['maxlength' => true])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
