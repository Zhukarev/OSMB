<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Month Dolg');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="month-dolg-create">
    <form>
    <table>
        <tr>
            <td>
                <h3>Выберете месяц</h3>
            </td>
            <td width="20%">
            </td>
            <td>
                <h3> Выберете № дома </h3>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo DatePicker::widget([
                    'name' => 'date',
                    'id' => 'month_dolg',
                    'value' => $date,
                    'removeButton' => false,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => "yyyy-mm",
                        'startView' => "months",
                        'minViewMode' => "months"
                    ],
                    'pluginEvents' => [
                        "changeDate" => "function(e) {  $('#submit-filter').trigger('click') }",
                    ],
                ]); ?>
            </td>
            <td></td>
            <td>
                <?=
                Html::dropDownList('house_id', $house_id, ArrayHelper::map($houses, 'id', 'num_house'),
                    ['class'=>'form-control', 'id'=>'date_drop']);
                ?>
            </td>
            <td><input id="submit-filter" class="btn btn-info" type="submit" value="Применить" /></td>
        </tr>
    </table>
    </form>
    <?php
    $form = ActiveForm::begin();
    ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-striped table-bordered">
        <tr class="info">
            <th>№ квартиры</th>
            <th>Долг</th>
        </tr>
        <?php foreach ($raschets as $i => $raschet) { ?>
            <tr>
                <td><?= $raschet->appartment->num_app; ?></td>
                <td><?= $form->field($raschet, "[$i]summ_dolg")->label(false); ?></td>
            </tr>
        <?php } ?>
    </table>
    <?= Html::submitButton('Сохранить', ['class'=> 'btn btn-success']); ?>
    <?php ActiveForm::end(); ?>
</div>
