<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\osmb\models\HouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Exist Access');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exist-access">

    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-striped table-bordered">
        <tr class="info">
            <th>Улица </th>
            <th>№ дома</th>
            <th>№ квартиры</th>
            <th>e-mail пользователя заявки</th>
            <th>Комментарий</th>
            <th>Решение</th>
            <th></th>

        </tr>
        <?php foreach ($exist as $i => $item) { ?>
            <tr>
                <td><?= $item->appartment->house->num_house; ?></td>
                <td><?= $item->appartment->house->street; ?></td>
                <td><?= $item->appartment->num_app; ?></td>
                <td><?= $item->user->email; ?></td>
                <?php
                $form = ActiveForm::begin();
                ?>
                <td><?= $form->field($item, "[$i]comment")->label(false)->textInput(['value' => 'необходимо предварительное согласование']); ?></td>
                <td><?= $form->field($item, "[$i]status")
                        ->radioList([
                            '1' => 'Принять',
                            '3' => 'Отклонить',
                        ],
                            ['separator'=>"<br />",'encode'=>false])->label(false); ?></td>
                <td><?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']); ?></td>

                <?php ActiveForm::end(); ?>

            </tr>
        <?php } ?>
    </table>
</div>



