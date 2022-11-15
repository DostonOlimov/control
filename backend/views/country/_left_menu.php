<?php

use yii\helpers\Url;
use yii\helpers\Html;

$user = Yii::$app->user->identity;

?>
<style type="text/css">
	.menu-title {
		font-size: 120%;
		font-weight: bold;
		margin-bottom: 15px;
	}
	.menu-title-border::after {
		margin-top: 10px;
		display: block;
		content: "";
		width: 70px;
		border-top: 3px solid #CC3304;
	}
	.left-block-menu
	{
		text-align: left;
		border-bottom: 1px solid #DDDDDD;
	}
</style>
<div class="col-lg-2">
	<div style="background-color: #FFFFFF; padding: 20px 15px; margin-bottom: 20px; text-align: center;">
		<p style="margin-bottom: 15px;">
			<img src="/images/avatar.png" style="max-width: 100%; border-radius: 3px;">
		</p>
		<p>
			<b><?= $user->username ?></b>
		</p>
	</div>
	<div style="background-color: #FFFFFF; padding: 20px 15px; margin-bottom: 20px;">
		<p class="menu-title menu-title-border">
			Меню
		</p>
		<?= Html::a(Yii::t('app', 'Страны мира'), ['/country/index'], ['class' => 'btn btn-block left-block-menu']) ?>
		<?= Html::a(Yii::t('app', 'Код ТН-ВЭД'), ['/codetnved/index'], ['class' => 'btn btn-block left-block-menu']) ?>
		<?= Html::a(Yii::t('app', 'Категории'), ['/category/index'], ['class' => 'btn btn-block left-block-menu']) ?>
		<?= Html::a(Yii::t('app', 'Товары'), ['/product/index'], ['class' => 'btn btn-block left-block-menu']) ?>
        <?= Html::a(Yii::t('app', 'Товары').'(uz)', ['/product-uz/index'], ['class' => 'btn btn-block left-block-menu']) ?>
        <?= Html::a(Yii::t('app', 'Тип риска'), ['/risk-type/index'], ['class' => 'btn btn-block left-block-menu']) ?>
		<?= Html::a(Yii::t('app', 'Пользователи'), ['/site/users'], ['class' => 'btn btn-block left-block-menu']) ?>

	</div>
</div>