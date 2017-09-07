<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\modules\components\AlertWidget;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('app', 'OSMB'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('app', 'Home'), 'url' => ['/']],

            ['label' => Yii::t('app', 'OSMB'), 'items' => [
                ['label' => Yii::t('app', 'House'), 'url' => ['/osmb/house/']],
                ['label' => Yii::t('app', 'Appartment'), 'url' => ['/osmb/appartment/']],
                ['label' => Yii::t('app', 'Benefit'), 'url' => ['/osmb/benefit/'], 'visible' => Yii::$app->user->can("admin"),],
                ['label' => Yii::t('app', 'Raschet'), 'url' => ['/osmb/raschet/']],
                ['label' => Yii::t('app', 'Oplata'), 'url' => ['/osmb/oplata/']],
                ['label' => Yii::t('app', 'BenefitAppartment'), 'url' => ['/osmb/benefit-appartment/']],
                ['label' => Yii::t('app', 'Request') .  \app\modules\osmb\models\Access::getRequestLabel(), 'url' => ['/osmb/access/exist-access/']],
            ], 'visible' => Yii::$app->user->can("accountant"),
            ],
            ['label' => Yii::t('app', 'User'), 'items' => [
                ['label' => Yii::t('app', 'Houses'), 'url' => ['/osmb/house/user-index']],
                ['label' => Yii::t('app', 'Appartments'), 'url' => ['/osmb/access/appartments-view']],
            ], 'visible' => Yii::$app->user->can("user"),
            ],

            ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']],
            ['label' => Yii::t('app', 'Users'), 'url' => ['/admin/default/index/'], 'visible' => Yii::$app->user->can("admin"),],
            ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
            ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    Yii::t('app', 'Logout') .' ('. Yii::$app->user->identity->username .')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= AlertWidget::widget() ?>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
