<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Category;
use common\models\Product;
use common\models\ProductUz;

$lang = Yii::$app->language;
$category = Category::find()
	->where(['status' => 1])
	->all();


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
	.btn-right
	{
		white-space: normal;
		/*background-color: #C8C8FF;*/
		/*color: #000000;*/
	}
	@media only screen and (min-width: 1199px) {
		.right-cat-menu
		{
			position: fixed;
			width: 260px;
		}
	}
</style>
<div class="col-lg-3" style="position: relative;">
	<div style="background-color: #FFFFFF; padding: 20px 15px; margin-bottom: 20px;" class="">
		<p class="menu-title menu-title-border">
			<?= Yii::t('app', 'Категории') ?>
		</p>
		<?php if ($product == 1){
			echo Html::a(Yii::t('app', 'Все'), ['/site/index'], ['class' => 'btn btn-success btn-block left-block-menu']);
		} else 
		{
			echo Html::a(Yii::t('app', 'Все'), ['/site/indexuz'], ['class' => 'btn btn-success btn-block left-block-menu']);
		} ?>

		<?php foreach ($category as $key => $cat): ?>
			<?php
				$count1 = Product::find()
					->where(['status' => 1])
					->andWhere(['category' => $cat->id])
					->andWhere(['lang' => $lang])
					->count();
            $count2 = ProductUz::find()
                ->where(['status' => 1])
                ->andWhere(['category' => $cat->id])
                ->andWhere(['lang' => $lang])
                ->count();
            $count = $count1 + $count2;
			?>
			<?php if ($product == 1): 
				if ($count1 > 0): ?>
				<?= Html::a($cat->{'name_'.$lang} . ' - ' . $count1 . 'та', ['/site/index', 'categoryId' => $cat->id], ['class' => 'btn-right btn btn-primary btn-block left-block-menu']) ?>
			<?php else: ?>
				<?= Html::a($cat->{'name_'.$lang}, ['/site/index', 'categoryId' => $cat->id], ['class' => 'btn-right btn btn-primary btn-block left-block-menu']) ?>
			<?php endif ?>
			<?php else: 
				if ($count2 > 0): ?>
				<?= Html::a($cat->{'name_'.$lang} . ' - ' . $count2 . 'та', ['/site/indexuz', 'categoryId' => $cat->id], ['class' => 'btn-right btn btn-primary btn-block left-block-menu']) ?>
			<?php else: ?>
				<?= Html::a($cat->{'name_'.$lang}, ['/site/indexuz', 'categoryId' => $cat->id], ['class' => 'btn-right btn btn-primary btn-block left-block-menu']) ?>
			<?php endif ?>
			<?php endif ?>
		  <?php endforeach ?>
		<?php  ?>
	</div>
</div>
