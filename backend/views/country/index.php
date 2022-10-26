<?php

use yii\helpers\Html;
use yii\grid\GridView;

$lang = Yii::$app->language;
$this->title = Yii::t('app', 'Страны мира');
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
	.table.table-striped.table-bordered .filters
	{
		display: none;
	}
	.grid-view td
	{
		white-space: normal;
	}
	/*.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td
	{
		vertical-align: middle;
	}*/
	.table > thead > tr > th
	{
		text-align: center;
	}
</style>
<div class="row">
	<?php include '_left_menu.php' ?>
	<div class="col-lg-10">
		<div class="country-index" style="background-color: #FFFFFF; padding: 20px;">
			<h3 style="margin-top: 0;"><?= Html::encode($this->title) ?></h3>
			<p>
				<?= Html::a(Yii::t('app', 'Добавить'), ['create'], ['class' => 'btn btn-success']) ?>
			</p>
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					// 'id',
					'id_country',
					'name_country',
					'code_country',
					// 'active',
					[
						'attribute' => 'active',
						'value' => function($model)
						{
							return ($model->active == 1) ? Yii::t('app', 'Активный')  : Yii::t('app', 'Неактивный');
						}
					],
					[
						'label' => Yii::t('app', 'Действие'),
						'value' => function($model)
						{
							return Html::a(Yii::t('app', '<span class="glyphicon glyphicon-pencil"></span>'), ['create', 'id' => $model->id], ['class' => 'btn btn-success btn-xs']);
						},
						'contentOptions' => ['style' => 'text-align: center'],
						'format' => 'raw',
					],
					// ['class' => 'yii\grid\ActionColumn'],
				],
			]); ?>
		</div>
	</div>
</div>