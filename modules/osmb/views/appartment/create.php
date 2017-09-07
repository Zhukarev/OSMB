<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\osmb\models\Appartment */

$this->title = Yii::t('app', 'Create Appartment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Appartments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appartment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
