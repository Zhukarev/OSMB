<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\osmb\models\Oplata */

$this->title = Yii::t('app', 'Create Oplata');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oplatas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oplata-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
