<?php
use yii\helpers\Html;
// https://yiiframework.com.ua/ru/doc/guide/2/helper-html/
//echo $appartment_id;
switch($status){
    case 1:
        $button = Html::tag('a', 'Готово', ['class' => 'btn disabled btn-info',
            'style' => ['width' => '90px', 'height' => '32px']]);
        break;
    case 2:
        $button = Html::a('Отменить', ['access/delete-access', 'id' => $appartment_id], ['class' => 'btn btn-danger',
            'style' => ['width' => '90px', 'height' => '32px']]);
        break;
    case 3:
        $button = Html::a('Отклонено', ['/osmb/raschet/view-appartment/', 'id' => $appartment_id], ['class' => 'btn btn-warning',
            'style' => ['width' => '90px', 'height' => '32px']]);
        break;
    case 4:
        $button = Html::tag('a', 'Заявка есть', ['class' => 'btn disabled btn-success',
            'style' => ['width' => '90px', 'height' => '32px']]);
        break;
    case 5:
        $button = Html::a('Подать', ['access/create-access', 'id' => $appartment_id], ['class' => 'btn btn-success',
            'style' => ['width' => '90px', 'height' => '32px']]);
        break;
    default:
        $button = '---';
        break;
}
echo $button . ' - ' . $status;