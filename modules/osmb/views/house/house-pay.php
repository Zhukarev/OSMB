<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\osmb\models\House */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'House Pay');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Yii::t('ben_text', 'Pay`s appartments per this month') ?>
<div class="house-benefit-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php $form = ActiveForm::begin(); ?>
    <table class="table table-striped table-bordered">
        <tr>
            <th><?= Yii::t('appart', '№ Appartment') ?></th>
            <th><?= Yii::t('pay', 'Payment') ?></th>
            <th><?= Yii::t('subsidy', 'Subsidy') ?></th>
        </tr>
        <?php foreach ($benefits as $benefit) ?>
        <tr>
            <td><?= $benefit->appartment->num_app; ?></td>
            <td><?= Select2::widget([
                    'name' => "Appartment[$i][benefit]",//($model i atrrbute)
                    'data' => ArrayHelper::map($benefits, 'id', 'name'),
                    'theme' => Select2::THEME_KRAJEE,
                    'options' => [
                        'placeholder' => Yii::t('app','Выберите льготу...'),
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?></td>
            <td><?= Yii::$app->formatter->asMyDate($raschet->date); ?></td>
        </tr>
    </table>

    <?= Html::submitButton('Сохранить'); ?>
    <?php ActiveForm::end(); ?>
</div>
