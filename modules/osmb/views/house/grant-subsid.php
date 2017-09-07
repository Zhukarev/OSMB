<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Grant Subsid');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="grant-subsid">

    <?php
    $form = ActiveForm::begin();
    ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-striped table-bordered">
        <tr class="info">
            <th>№ квартиры</th>
            <th>Субсидия за позапрошлый месяц</th>
            <th>Назначение субсидии</th>
        </tr>
        <?php foreach ($raschets as $i => $raschet) {?>
            <tr>
                <td><?= $raschet->appartment->num_app; ?></td>
                <td><?= $form->field($raschet, "[$i]summ_subsid")->label(false)->textInput(['readonly' => true]); ?></td>
                <td><?= $form->field($raschet->appartment, "[{$raschet->appartment->id}]subsidStasus")->label(false)->checkbox(); ?></td>
            </tr>
        <?php } ?>
    </table>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']); ?>
    <?php ActiveForm::end(); ?>
</div>