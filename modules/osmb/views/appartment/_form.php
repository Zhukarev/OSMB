<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\osmb\models\House;

/* @var $this yii\web\View */
/* @var $model app\modules\osmb\models\Appartment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appartment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'num_app')->textInput() ?>

    <?= $form->field($model, 'FIO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'propisano')->textInput() ?>

    <?= $form->field($model, 'area')->textInput() ?>

    <?= $form->field($model, 'telefon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'house_id')->dropDownList
    (
        ArrayHelper::map(House::find()->all(), 'id', 'num_house'),
        $params = ['prompt' => 'Выберите номер дома...']
    )->label('Номер дома') ?>

    <?= $form->field($model, 'subsidStasus')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
