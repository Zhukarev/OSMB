<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\osmb\models\Raschet */

$this->title = Yii::t('app', 'Create Raschet');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Raschets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raschet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
