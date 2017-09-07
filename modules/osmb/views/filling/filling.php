<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Filling');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filling">
    <?php
    $form = ActiveForm::begin();

    ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-striped table-bordered">
        <tr class="info">
            <th>№ квартиры</th>
            <th>Площадь</th>
            <th>Льгота</th>
            <th>Площадь льготы</th>
        </tr>
        <?php foreach ($appartments as $i => $appartment) { ?>
            <tr>
                <td><?= $appartment->num_app; ?></td>
                <td><?= $form->field($appartment, "[$i]area")->textInput()->label(false); ?></td>
                <td>
                    <?= Html::dropDownList('benefit', 'null', ArrayHelper::map($benefit,'id','name'), ['prompt' => 'Выберите льготу...']);?>
                </td>

                <td>
                    <?= $form->field( )->textInput()->label(false); ?>
                </td>

                <!--<td><?/*= $form->field($benefit, 'benefit')->dropDownList
                (
                    ArrayHelper::map($benefit, 'id', 'name'),
                    ['prompt' => 'Выберите льготу...']
                ) */?></td>-->


                <!--<td><?/*= $form->field($appartment.benefit_appartment, "[$i]area_benefit")->textInput()->label(false); */?></td>-->
            </tr>
        <?php } ?>
    </table>
    <?= Html::submitButton('Сохранить'); ?>
    <?php ActiveForm::end(); ?>
</div>
