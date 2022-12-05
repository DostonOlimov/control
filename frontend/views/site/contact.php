<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::$app->name;

$lang = Yii::$app->language;

?>
<style type="text/css">
	h3.text-center
	{
		margin: 0;
	}
	.product-img
	{
		background-repeat: no-repeat;
		background-size: cover;
		/*background-size: 100% 100%;*/
		background-position: center;
		width: 100%;
		height: 200px;
	}
	.product-link
	{
		color: #000000;
	}
	.product-link:hover
	{
		text-decoration: none;
	}
	.btn-top
	{
		margin-bottom: 10px;
	}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="site-index">
			<div class="row">
				<div class="col-lg-12">
					<div style="background-color: #FFFFFF; padding: 10px; padding-bottom: 0px; margin-bottom: 30px;">
						<div class="row">
							<div class="col-lg-3">
								<a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/index','product'=>1]) ?>"><?= Yii::t('app', 'Главная') ?></a>
							</div>
							<div class="col-lg-3">
								<a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/about']) ?>"><?= Yii::t('app', 'О портале') ?></a>
							</div>
							<div class="col-lg-3">
								<a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/information']) ?>"><?= Yii::t('app', 'Полезная информация') ?></a>
							</div>
							<div class="col-lg-3">
								<a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/contact']) ?>"><?= Yii::t('app', 'Контакты') ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div style="background-color: #FFFFFF; padding: 10px; margin-bottom: 30px;">
						<h3 class="text-center"><?= Yii::t('app', 'Контакты') ?></h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div style="background-color: #FFFFFF; padding: 20px; margin-bottom: 30px;">
						<?php if ($lang == 'cyrl'): ?>
							<p>
								<i class="fas fa-map-marker-alt"></i> Манзил: 100055, Ташкент шаҳри, Зафаробод кўчаси, 7А<br>
								<i class="fas fa-headset"></i> Call марказ: (998-71) 202-00-11<br>
								<i class="fas fa-phone-square"></i> Телефон: (998-71)242-35-20, 242-74-62<br>
								<i class="fas fa-at"></i> Электрон почта манзили: depart@standart.uz<br>
								<i class="fas fa-globe-asia"></i> Веб-сайт: depstan.uz<br>
								<i class="fas fa-clock"></i> Иш вақти: Душанба-Жума: 09:00 – 18:00<br>
							</p>
						<?php else: ?>
							<p>
								<i class="fas fa-map-marker-alt"></i> Адрес: 100055, г. Ташкент, ул. Зафаробод, 7А<br>
								<i class="fas fa-headset"></i> Call центр: (998-71) 202-00-11<br>
								<i class="fas fa-phone-square"></i> Телефон: (998-71)242-35-20, 242-74-62<br>
								<i class="fas fa-at"></i> Адрес электронной почты: depart@standart.uz<br>
								<i class="fas fa-globe-asia"></i> Веб-сайт: depstan.uz<br>
								<i class="fas fa-clock"></i> Рабочее время: Понедельник-пятница: 09:00 – 18:00<br>
							</p>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>