<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CodetnvedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Код ТН-ВЭД');
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">

	.grid-view td
	{
		white-space: normal;
	}
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td
	{
		/*vertical-align: middle;*/
	}
	.table > thead > tr > th
	{
		text-align: center;
	}
</style>
<div class="row">
	<?php include dirname(__DIR__) . '/country/_left_menu.php' ?>
	<div class="col-lg-10">
		<div class="codetnved-index" style="background-color: #FFFFFF; padding: 20px;">
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
					'kod',
					'name:ntext',
					// 'import',
					[
						'attribute' => 'import',
						'value' => function($model)
						{
							return ($model->import == 1) ? Yii::t('app', 'Да') : Yii::t('app', 'Нет');
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