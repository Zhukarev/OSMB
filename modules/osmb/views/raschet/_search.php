<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\osmb\models\RaschetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="raschet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nachisleno') ?>

    <?= $form->field($model, 'summ_oplata') ?>

    <?= $form->field($model, 'summ_dolg') ?>

    <?= $form->field($model, 'summ_subsid') ?>

    <?php // echo $form->field($model, 'summ_benefit') ?>

    <?php // echo $form->field($model, 'appartment_id') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
