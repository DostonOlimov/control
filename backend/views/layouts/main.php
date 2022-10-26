<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
use common\widgets\Alert;

$layoutPath = Yii::getAlias('@backend/view');
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="/images/no-shopping-50-50.png">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style type="text/css">
        .navbar-inverse .navbar-brand
        {
            padding: 0 0;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<?php
$brandLabel = '<div><img src="/images/no-shopping-50-50.png" style="float: left; width: 60px; padding-right: 10px;"><div style="padding: 15px 0; float: left;">' . Yii::$app->name . '</div></div>';
?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => $brandLabel,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->user->isGuest)
    {
        $menuItems = [];
        // $menuItems[] = ['label' => 'Главная', 'url' => ['/site/index']];
        // $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        // $menuItems[] = ['label' => 'Авторизация', 'url' => ['/site/login']];
    }
    else
    {
        $menuItems = [];
        $identity = Yii::$app->user->identity;

        // $menuItems = [];
        // $menuItems[] = ['label' => 'Главная', 'url' => ['/site/index']];
        // if ($identity->typeId == 1 or $identity->typeId == 3)
        // {
        //  $menuItems[] = ['label' => 'Заполнить KPI', 'url' => ['/kpi/balls']];
        // }
        // else
        // {
        //  $menuItems[] = ['label' => 'KPI', 'url' => ['/kpi/balls']];
        // }
        // if ($identity->typeId == 1 or $identity->typeId == 2)
        // {
        //  $menuItems[] = ['label' => 'Настройка', 'url' => ['/account/section-names']];
        // }
        $menuItems[] = ['label' => Yii::t('app', 'Главная'), 'url' => ['/site/index']];
        $menuItems[] = ['label' => Yii::t('app','Настройка'), 'url' => ['/country/index']];
        $menuItems[] = ['label' => Yii::t('app','Выход').'(' . $identity->username . ')', 'url' => ['/site/logout']];
        
        $menuItems[] = ['label' => '            ','url' => ['#']];
        $menuItems[] = ['label' => Yii::t('app', 'Ўзб'), 'url' => array_merge(\Yii::$app->request->get(), [\Yii::$app->controller->route, 'language' => 'cyrl'])];
	    $menuItems[] = ['label' => Yii::t('app', 'Рус'), 'url' => array_merge(\Yii::$app->request->get(), [\Yii::$app->controller->route, 'language' => 'ru'])];
    
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<!-- Begin JS -->
<?=$this->render('/layouts/_js', ['layoutPath' => $layoutPath]);?>
<!-- End JS -->
</body>
</html>
<?php $this->endPage() ?>
