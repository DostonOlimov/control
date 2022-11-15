<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$lang = Yii::$app->language;

$this->title = Yii::t('app', 'Категории');
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">

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
	<?php include dirname(__DIR__) . '/country/_left_menu.php' ?>
	<div class="col-lg-10">
		<div class="category-index" style="background-color: #FFFFFF; padding: 20px;">
			<h3><?= Html::encode($this->title) ?></h3>
			<p>
				<?= Html::a(Yii::t('app', 'Добавить'), ['create'], ['class' => 'btn btn-success']) ?>
			</p>
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => [

                    [
                        'class' => 'yii\grid\SerialColumn',

                    ],
					// 'id',
					'name_cyrl',
					'name_ru',
					// 'name_uz',
					// 'name_en',
					// 'status',

					[
						'attribute' => 'status',
						'value' => function($model)
						{
							return ($model->status == 1) ? Yii::t('app', 'Активный')  : Yii::t('app', 'Неактивный');
						}
					],
					[
						'attribute' => 'created_at',
						'value' => function($model)
						{
							return date('d.m.Y H:i:s', $model->created_at);
						}
					],
					[
						'attribute' => 'updated_at',
						'value' => function($model)
						{
							return date('d.m.Y H:i:s', $model->updated_at);
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
					//'created_at',
					//'updated_at',
					// ['class' => 'yii\grid\ActionColumn'],
				],
			]); ?>
		</div>
	</div>
</div>