<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\osmb\models\BenefitAppartment */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Benefit Appartment',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Benefit Appartments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="benefit-appartment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
