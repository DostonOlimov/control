<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = Yii::$app->name;
$productCount = count($models);

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
	<div class="col-lg-9">
		<div class="site-index">
			<div class="row">
				<div class="col-lg-12">
					<div style="background-color: #FFFFFF; padding: 10px; padding-bottom: 0px; margin-bottom: 30px;">
						<div class="row">
							<div class="col-lg-3">
								<a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/index','product'=>1]) ?>"><?= Yii::t('app', 'Главная') ?></a>
							</div>
							<div class="col-lg-3">
								<a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/about',]) ?>"><?= Yii::t('app', 'О портале') ?></a>
							</div>
							<div class="col-lg-3">
								<a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/information']) ?>"><?= Yii::t('app', 'Полезная информация') ?></a>
							</div>
							<div class="col-lg-3">
								<a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/contact']) ?>"><?= Yii::t('app', 'Контакты') ?></a>
							</div>
						</div>
					</div>
                    <div style="background-color: #FFFFFF; padding: 10px; padding-bottom: 0px; margin-bottom: 30px;">
                        <div class="row">
                            <div class="col-lg-6">
                                <a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/index','product'=>1]) ?>"><?= Yii::t('app', 'Импортные продукты') ?></a>
                            </div>
                            <div class="col-lg-6">
                                <a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/indexuz','product'=>2]) ?>"><?= Yii::t('app', 'Продукция производства Узбекистана') ?></a>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
			<?php foreach ($models as $key => $model): ?>
				<?php if (($key % 3) == 0): ?>
					<div class="row">
				<?php endif ?>
				<div class="col-lg-4">
					<a href="<?= Url::to(['/site/view', 'productId' => $model->parent_id,'product'=>1]) ?>" class="product-link">
						<div style="background-color: #FFFFFF; padding: 20px; margin-bottom: 30px;">
							<?php if ($model->photo): ?>
								<div class="product-img" style="background-image: url(/productPhotos/<?= $model->photo ?>);"></div>
							<?php else: ?>
								<div class="product-img" style="background-image: url(/images/no-photo.jpg);"></div>
							<?php endif ?>
							<div style="margin-top: 10px;">
								<b><?= $model->getAttributeLabel('category') ?>:</b> <?= (isset($model->categoryName)) ? $model->categoryName->{'name_' . $lang} : ''; ?>
							</div>
							<div style="margin-top: 10px;">
								<b><?= $model->getAttributeLabel('product') ?>:</b> <?= (isset($model->product)) ? $model->product : ''; ?>
							</div>
							<div style="margin-top: 10px;">
								<span class="glyphicon glyphicon-calendar" aria-hidden="true" style="font-size: 80%"></span> <?= date('d.m.Y H:i', $model->created_at)  ?>
								&nbsp;&nbsp;&nbsp;
								<span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="font-size: 80%"></span> <?= $model->views ?>
							</div>
						</div>
					</a>
				</div>
				<?php if ($key == (1 * $productCount - 1)): ?>
					</div>
				<?php else: ?>
					<?php if (((1 * $key + 1) % 3) == 0): ?>
						</div>
					<?php endif ?>
				<?php endif ?>
			<?php endforeach ?>
			<div class="row">
				<div class="col-lg-12">
					<div style="background-color: #FFFFFF; padding: 10px; margin-bottom: 30px; text-align: center;">
						<?php
							echo LinkPager::widget([
								'pagination' => $pages,
							]);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include '_left_menu.php'; ?>
</div>