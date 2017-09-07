<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\osmb\models\OplataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Oplatas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oplata-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Oplata'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'oplata',
            'subsid',
            'raschet.date:myDate',
            'raschet.appartment.num_app',
            'raschet.appartment.house.num_house',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
