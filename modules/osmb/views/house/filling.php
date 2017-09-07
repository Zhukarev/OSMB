<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;


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
            <th>№ кв.</th>
            <th>Площадь</th>
            <th>Льгота</th>
            <th>Площадь льготы</th>
        </tr>
        <?php foreach ($appartments as $i => $appartment) { ?>
            <tr>
                <td><?= $appartment->num_app; ?></td>
                <td><?= $form->field($appartment, "[$i]area")->textInput()->label(false); ?></td>
                <td>
                    <?= Select2::widget([
                        'name' => "Appartment[$i][benefit]",//($model i atrrbute)
                        'data' => ArrayHelper::map($benefits, 'id', 'name'),
                        'theme' => Select2::THEME_KRAJEE,
                        'options' => [
                            'placeholder' => Yii::t('app', 'Выберите льготу...'),
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>

                </td>

                <td>
                    <?= $form->field($appartment, "[$i]areaBenefit")->textInput()->label(false); ?>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?= Html::submitButton('Сохранить'); ?>
    <?php ActiveForm::end(); ?>
</div>
