<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\osmb\models\HouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Houses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'label'=>Yii::t('app', 'id'),
                'attribute'=>'id'
            ],
            [
                'label'=>Yii::t('app', 'city'),
                'attribute'=>'city'
            ],
            [
                'label'=>Yii::t('app', 'street'),
                'attribute'=>'street'
            ],
            [
                'label'=>Yii::t('app', 'num_house'),
                'attribute'=>'num_house'
            ],
            [
                'label'=>Yii::t('app', 'quan_app'),
                'attribute'=>'quan_app'
            ],
            // 'cost_on_m',
            // 'buchg_id',
            ['class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('app', 'Apply now'),
                'template' => '{apply}',
                'buttons' => [
                    'apply' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-arrow-right"></span>', $url, [
                            'title' => Yii::t('app', 'Apply now'),
                        ]);
                    }
                ],

            ],

      ]
    ]); ?>


</div>
