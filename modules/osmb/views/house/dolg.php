<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Dolg');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dolg-create">
    <?php
    $form = ActiveForm::begin();
    ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-striped table-bordered">
        <tr class="info">
            <th>№</th>
            <th>Долг</th>
            <th>Дата</th>
        </tr>
        <?php foreach ($raschets as $i => $raschet) { ?>
            <tr>
                <td><?= $raschet->appartment->num_app; ?></td>
                <td><?= $form->field($raschet, "[$i]summ_dolg")->label(false); ?></td>
                <td><?= Yii::$app->formatter->asMyDate($raschet->date); ?></td>
            </tr>
        <?php } ?>
    </table>
    <?= Html::submitButton('Сохранить'); ?>
    <?php ActiveForm::end(); ?>
</div>
