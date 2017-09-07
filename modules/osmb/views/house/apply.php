<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\osmb\models\HouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Appartments of House');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="house-apply">

    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-striped table-bordered">
        <tr class="info">
            <th>№ квартиры</th>
            <th>Подать заявку</th>
        </tr>
        <?php foreach ($appartments as $appartment) { ?>
        <?php $appartment->id  ?>
            <tr>
                <td><?= $appartment->num_app; ?></td>
                <td>

                        <?php echo $this->render('_statusacc',
                            [
                                'appartment_id' => $appartment->id,
                                'status' => $appartment->getAccessStatus($isAccesses, $isAccessesActive),
//                                'isAccesses' => $isAccesses,
//                                'isAccessesActive' => $isAccessesActive,
                            ]
                        )?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

