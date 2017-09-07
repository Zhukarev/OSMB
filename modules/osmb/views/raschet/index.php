<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\osmb\models\RaschetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Raschets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raschet-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Raschet'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'appartment.num_app',
            'nachisleno',
            'summ_oplata',
            'summ_dolg',
            'summ_subsid',
            'summ_benefit',
            // 'appartment_id',
            'date:myDate' =>
                ['attribute' => 'date',
                    'label' => 'Создано расчет',
                    'format' => 'myDate',
                    'filter' => DatePicker::widget([
  //                      'name' => 'RaschetSearch[date]',
                        'model' => $searchModel,
                        'attribute' => 'date',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => "yymm",
                            'startView' => "months",
                            'minViewMode' => "months"
                        ]
                    ]),
 //                   'format' => 'html',

                ],
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Добавить оплату',
                'template' => '{create}',
                'buttons' => [
                    'create' => function ($url, $model) {   //'new-raschet' => function ($url, $model) {

                        return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', \yii\helpers\Url::to('/osmb/oplata/create?raschet_id=' . $model->id), [
                            'title' => Yii::t('app', 'create'),
                        ]);
                    }
                ],

            ],
            //'date:myDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
