<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\osmb\models\AppartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Appartments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appartment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Appartment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'num_app',
            'FIO',
            'propisano',
            'area',
            // 'telefon',
            // 'house_id',
            // 'subsidStasus',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
