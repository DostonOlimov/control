<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::$app->name;

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
	p
	{
		text-align: justify;
		text-indent: 2em;
	}
</style>
<div class="row">
	<div class="col-lg-9">
		<div class="site-index">
			<div class="row">
				<div class="col-lg-12">
					<div style="background-color: #FFFFFF; padding: 10px; padding-bottom: 0px; margin-bottom: 30px;">
						<div class="row">
							<div class="col-lg-3">
								<a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/index']) ?>"><?= Yii::t('app', 'Главная') ?></a>
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
						<h3 class="text-center"><?= Yii::t('app', 'Полезная информация') ?></h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div style="background-color: #FFFFFF; padding: 20px; margin-bottom: 30px;">
						<p class="text-justify">
							<a class="a-link-docs" href="https://lex.uz/docs/4964633" target="_blank">
								Ўзбекистон Республикаси Президентининг 2020 йил 21 августдаги ПҚ-4812-сонли "Маҳаллий ишлаб чиқарувчиларни қўллаб-қувватлашга доир қўшимча чора-тадбирлар тўғрисида"ги Қарори
							</a>
						</p>
						<p>
							<a class="a-link-docs" href="https://lex.uz/docs/4305020" target="_blank">
								Ўзбекистон Республикаси Вазирлар Маҳкамасининг 2019 йил 24 апрелдаги 348-сонли "Ўзбекистон стандартлаштириш, метрология ва сертификатлаштириш агентлигининг фаолиятини янада такомиллаштириш чора-тадбирлари тўғрисида"ги қарори
							</a>
						</p>
						<p>
							<a class="a-link-docs" href="https://lex.uz/docs/4704" target="_blank">
								Ўзбекистон Республикасининг "Истеъмолчиларнинг ҳуқуқларини ҳимоя қилиш тўғрисида"ги Қонуни
							</a>
						</p>
						<p>
							<a class="a-link-docs" href="https://lex.uz/docs/99882" target="_blank">
								Ўзбекистон Республикасининг "Озиқ-овқат маҳсулотларининг сифати ва ҳавсизлиги тўғрисида"ги Қонуни
							</a>
						</p>
						<p>
							<a class="a-link-docs" href="https://lex.uz/docs/2509996" target="_blank">
								Ўзбекистон Республикасининг "Жисмоний ва юридик шахсларнинг мурожаатлари тўғрисида"ги Қонуни
							</a>
						</p>
						<p>
							<a class="a-link-docs" href="https://lex.uz/docs/99872" target="_blank">
								Ўзбекистон Республикасининг "Стандартлаштириш тўғрисида"ги қонуни
							</a>
						</p>
						<p>
							<a class="a-link-docs" href="https://lex.uz/docs/1474642" target="_blank">
								Ўзбекистон Республикасининг "Техник жиҳатдан тартибга солиш тўғрисида"ги қонуни
							</a>
						</p>
						<p>
							<a class="a-link-docs" href="https://lex.uz/docs/99877" target="_blank">
								Ўзбекистон Республикасининг "Метрология тўғрисида" Қонуни
							</a>
						</p>
						<p>
							<a class="a-link-docs" href="https://lex.uz/docs/99882" target="_blank">
								Ўзбекистон Республикасининг “Маҳсулот ва хизматларни сертификатлаштириш тўғрисида”ги қонуни
							</a>
						</p>
						<p>
							<a class="a-link-docs" href="https://lex.uz/docs/2248099" target="_blank">
								Ўзбекистон Республикасининг "Мувофиқликни баҳолаш тўғрисида"ги Қонуни
							</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include '_left_menu.php'; ?>
</div>