<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\osmb\models\HouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'House');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create House'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo DatePicker::widget([
        'name' => 'house_calendar',
        'id' => 'house-calendar',

        'removeButton' => false,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => "yyyy-mm",
            'startView' => "months",
            'minViewMode' => "months"
        ],
        'pluginEvents' => [
            "changeDate" => "function(e) {  location = house_mondolg_href + '&date=' + $('#house-calendar').val(); }",
        ],
    ]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'city',
            'street',
            'num_house',
            'quan_app',
            // 'cost_on_m',
            // 'buchg_id',


            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{view}{update}{delete}',
            ],

            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Создать расчет',
                'template' => '{new-raschet}',
                'buttons' => [
                    'new-raschet' => function ($url) {   //'new-raschet' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', $url, [
                            'title' => Yii::t('app', 'new-raschet'),
                        ]);
                    }
                ],

            ],
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Оплата за месяц',
                'template' => '{house-pay}',
                'buttons' => [
                    'house-pay' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', $url, [
                            'title' => Yii::t('app', 'house-pay'),
                        ]);
                    }
                ],

            ],
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Субсидия',
                'template' => '{grant-subsid}',
                'buttons' => [
                    'grant-subsid' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', $url, [
                            'title' => Yii::t('app', 'grant-subsid'),
                        ]);
                    }
                ],

            ],
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Долг за месяц',
                'template' => '{month-dolg}',
                'buttons' => [
                    'month-dolg' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-calendar"></span>', \yii\helpers\Url::to('/osmb/house/month-dolg?house_id=' . $model->id), [
                            'title' => Yii::t('app', 'month-dolg'),
                            'class' => 'house-calendar-month-dolg',
                        ]);
                    }
                ],

            ],
        ],
    ]); ?>
</div>
