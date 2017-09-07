<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Appartments view');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appartments-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-striped table-bordered">
        <tr class="info">
            <th>№ дома</th>
            <th>Квартира</th>
            <th>Статус</th>
            <th>Перейти</th>
        </tr>
        <?php foreach ($appartments as $appartment) { ?>
            <tr>
                <td><?= $appartment->house->num_house; ?></td>
                <td><?= $appartment->num_app; ?></td>
                <td></td>
                <td><?= Html::a('<span class="glyphicon glyphicon-arrow-right"></span>', ['/osmb/raschet/view-appartment/', 'id' => $appartment->id]) ?></td>
            </tr>
        <?php } ?>
    </table>
</div>



