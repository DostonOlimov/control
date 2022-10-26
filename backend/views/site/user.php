<?php

use yii\helpers\Html;
use yii\grid\GridView;

$lang = Yii::$app->language;
$this->title = Yii::t('app', 'Пользователи');
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
	
	.table > thead > tr > th
	{
		text-align: center;
	}
</style>
<div class="row">
	<?php include dirname(__DIR__) . '/country/_left_menu.php' ?>
	<div class="col-md-9">
		<div class="user-index" style="background-color: #FFFFFF; padding: 20px;">
			<h3 style="margin-top: 0;"><?= Html::encode($this->title) ?></h3>
			<p>
				<?= Html::a(Yii::t('app', 'Добавить'), ['/site/signup'], ['class' => 'btn btn-success']) ?>
			</p>
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],
					// 'id',
					// 'username',
					[
						'attribute' => 'username',
						'value' => function($model)
						{
							return $model->username;
						},
						'contentOptions' => ['style' => 'text-align: center;'],
					],
					// 'password',
					// 'auth_key',
					// 'password_hash',
					//'password_reset_token',
					//'verification_token',
					// 'status',
					[
						'attribute' => 'status',
						'value' => function($model)
						{
							$statuses = [
								0 => 'Неактивный',
								10 => 'Активный',
							];
							return isset($statuses[$model->status]) ? $statuses[$model->status] : null;
						},
						'contentOptions' => ['style' => 'text-align: center;'],
					],
					// 'typeId',
					// [
					// 	'attribute' => 'typeId',
					// 	'value' => function($model)
					// 	{
					// 		$types = [
					// 			// 1 => 'СуперАдмин',
					// 			2 => 'Админ',
					// 			3 => 'Модератор',
					// 			4 => 'Пользователь',
					// 		];
					// 		return isset($types[$model->typeId]) ? $types[$model->typeId] : null;
					// 	},
					// 	'contentOptions' => ['style' => 'text-align: center;'],
					// ],
					//'created_at',
					//'updated_at',
					[
						'label' => 'Действие',
						'value' => function($model)
						{
							$return = Html::a(Yii::t('app', 'Изменить пароль'), ['password-update', 'id' => $model->id], ['class' => 'btn btn-primary btn-xs']);

							$return .= ' ' . Html::a(Yii::t('app', 'Обновить'), ['status-update', 'id' => $model->id], ['class' => 'btn btn-success btn-xs']);
							return $return;
						},
						'contentOptions' => ['style' => 'text-align: center; width: 185px;'],
						'format' => 'raw',
					],
					// ['class' => 'yii\grid\ActionColumn'],
				],
			]); ?>
		</div>
	</div>
</div>