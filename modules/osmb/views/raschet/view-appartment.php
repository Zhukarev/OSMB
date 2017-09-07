<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\osmb\models\HouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'View appartment');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="view-appartment">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if ($choice==1){?>

    <table class="table table-striped table-bordered">
        <tr class="info">
            <th>Дата</th>
            <th>Начислено</th>
            <th>Оплачено</th>
            <th>Субсидия</th>
            <th>Льгота</th>
            <th>Долг</th>
        </tr>
        <?php foreach ($raschets as $i => $raschet) { ?>

            <tr>
                <td><?= Yii::$app->formatter->asMyDate($raschet->date); ?></td>
                <td><?= Yii::$app->formatter->asDecimal($raschet->nachisleno/100, 2); ?></td>
                <td><?= Yii::$app->formatter->asDecimal($raschet->summ_oplata/100, 2); ?></td>
                <td><?= Yii::$app->formatter->asDecimal($raschet->summ_subsid/100, 2); ?></td>
                <td><?= Yii::$app->formatter->asDecimal($raschet->summ_benefit/100, 2); ?></td>
                <td><?= Yii::$app->formatter->asDecimal($raschet->summ_dolg/100, 2);?></td>
            </tr>
        <?php } ?>
    </table>

    <?php } elseif($choice==3){?>

        <table class="table table-striped table-bordered">
        <tr class="info">
            <th>Комментарий отказа</th>
            <th>Удалить заявку</th>
        </tr>
        <tr>
            <td><?= $raschets->comment?></td>
            <td><?= Html::a('Удалить', ['access/delete-recuest', 'id' => $raschets->id], ['class' => 'btn btn-danger',
                'style' => ['width' => '90px', 'height' => '32px']])?></td>
        </tr>
    </table>
    <?php } elseif($choice==4){?>

        <table class="table table-striped table-bordered">
        <tr class="info">
            <th>Дата регистрации заявки</th>
            <th>Удалить заявку</th>
        </tr>
        <tr>
            <td><?= $raschets->date_create?></td>
            <td><?= Html::a('Удалить', ['access/delete-recuest', 'id' => $raschets->id], ['class' => 'btn btn-danger',
                'style' => ['width' => '90px', 'height' => '32px']])?></td>
        </tr>
    </table>
    <?php } else{?>
        Увы - Вы не имеете права просматривать статистику по данной квартире
    <?php  }?>


</div>



