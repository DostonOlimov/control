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
						<h3 class="text-center"><?= Yii::t('app', 'О портале') ?></h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div style="background-color: #FFFFFF; padding: 20px; margin-bottom: 30px;">
						<?php if ($lang == 'cyrl'): ?>
							<p class="text-justify">
								&nbsp; &nbsp; &nbsp; &nbsp;Ушбу портал Ўзбекистон Республикаси Президентининг 2020 йил 21 августдаги ПҚ-4812-сонли “Маҳаллий ишлаб чиқарувчиларни қўллаб-қувватлашга доир қўшимча чора-тадбирлар тўғрисида”ги Қарори асосида, маҳаллий ишлаб чиқарувчиларни қўллаб-қувватлаш ва мамлакатимиз ҳудудига сифатсиз маҳсулотларни кириб келишини олдини олиш мақсадида жорий этилди.
							</p>
							<p class="text-justify">
								&nbsp; &nbsp; &nbsp; &nbsp;Шунингдек, порталнинг асосий вазифаси истеъмолчиларга сифатсиз маҳсулотлар тўғрисида маълумот бериш ва огоҳлантиришдан иборат.
							</p>
						<?php else: ?>
							<p class="text-justify">
								&nbsp; &nbsp; &nbsp; &nbsp;Данный портал был запущен на основании Постановления Президента Республики Узбекистан от 21 августа 2020 года № ПП-4812 «О дополнительных мерах по поддержке отечественных производителей» для поддержки местных производителей и предотвращения проникновения некачественной продукции в страну.
							</p>
							<p class="text-justify">
								&nbsp; &nbsp; &nbsp; &nbsp;А также основная задача портала - информирование и предупрежение потребителей о некачественной продукции.
							</p>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>