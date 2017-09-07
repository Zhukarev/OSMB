<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
        <?php echo Url::to(['osmb/house/month-dolg', 'id' => 6, 'date'=>1705]);?>
    </p>

    <code><?= __FILE__ ?></code>
</div>
