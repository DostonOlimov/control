<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

$layoutPath = Yii::getAlias('@frontend/view');
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
		.search-q-btn
		{
			padding: 4px 8px;
			font-size: 12px;
			line-height: 1.5;
			border-radius: 3px;
			margin-top: -3px;
			margin-left: -5px;
		}
		.search-form
		{
			padding: 10px 0;
			margin-right: 30px;
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
	// $menuItems = [];
	$q = Yii::$app->request->get('q');
	$q = strip_tags($q);
	$q = addslashes($q);
	$menuItems[] = '<li>'
		. Html::beginForm(['/site/search'], 'get', ['class' => 'search-form'])
		. ' '
		. Html::input('text', 'q', $q, ['class' => 'search-q'])
		. Html::submitButton(
			'<i class="fas fa-search"></i>',
			['class' => 'btn btn-primary btn-xs search-q-btn']
		)
		. Html::endForm()
		. '</li>';
	$menuItems[] = ['label' => Yii::t('app', 'Ўзб'), 'url' => array_merge(\Yii::$app->request->get(), [\Yii::$app->controller->route, 'language' => 'cyrl'])];
	$menuItems[] = ['label' => Yii::t('app', 'Рус'), 'url' => array_merge(\Yii::$app->request->get(), [\Yii::$app->controller->route, 'language' => 'ru'])];

	if (Yii::$app->user->isGuest)
	{
	}
	else
	{
	}

	echo Nav::widget([
		'options' => ['class' => 'navbar-nav navbar-right'],
		'items' => $menuItems,
	]);
	NavBar::end();
	?>

	<div class="container">
		<?= Alert::widget() ?>
		<?= $content ?>
	</div>
</div>

<footer class="footer">
	<div class="container">
		<p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> 
		<?= date('Y') ?></p>
	</div>
</footer>

<?php $this->endBody() ?>
<!-- Begin JS -->
<?=$this->render('/layouts/_js', ['layoutPath' => $layoutPath]);?>
<!-- End JS -->
</body>
</html>
<?php $this->endPage() ?>
