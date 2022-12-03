<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Product;
use yii\grid\ActionColumn;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Товары');
$this->params['breadcrumbs'][] = $this->title;

?>
<style type="text/css">

	.grid-view td
	{
		white-space: normal;
	}
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td
	{
		vertical-align: middle;
	}
	.table > thead > tr > th
	{
		text-align: center;
	}
</style>
<div class="row">
	<?php include dirname(__DIR__) . '/country/_left_menu.php' ?>
	<div class="col-lg-10">
		<div class="product-index" style="background-color: #FFFFFF; padding: 20px; overflow: auto;">
			<h3><?= Html::encode($this->title) ?></h3>
			<div class="row">
			<div class="col-sm-1">
				<?= Html::a(Yii::t('app', 'Добавить').'&emsp;&emsp;&emsp;', ['create'], ['class' => 'btn btn-success']) ?>
			</div>
			<div class="col-sm-1">
				<?= Html::a(Yii::t('app', 'Файл загружен').'&emsp;', ['import'], ['class' => 'btn btn-success']) ?>
				</div>
			<div class="col-sm-1">
				<?=    Html::a(Yii::t('app', 'Получить данные'), ['getdata'], ['class' => 'btn btn-success']) ?>
				</div>
			</div>
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
					// 'id',
					[
						'attribute' => 'id',
						'value' => function($model)
						{
							if ($model->product)
							{
								return Html::a($model->id, ['create', 'id' => $model->id]);
							}
						},
						'format' => 'raw'
					],
					[
						'attribute' => 'photo',
						'value' => function($model)
						{
							if ($model->photo)
							{
								return "<img style=\"max-height: 100px;\" src=\"/productPhotos/{$model->photo}\">";
							}
						},
						'contentOptions' => ['style' => 'text-align: center'],
						'format' => 'raw'
					],
					 'codetnved:ntext',
                    [
                        'attribute' => 'Ogohlantirish turi',
                        'value' => function ($model) {
                            if($model->type_of_alert and is_numeric($model->type_of_alert))
                                return Product::getAlert($model->type_of_alert);
                            else return $model->type_of_alert;
                        }
                    ],
					// 'type:ntext',
					// 'alert_number:ntext',
					//'alert_submitted_by:ntext',
					//'country_of_origin:ntext',
					//'counterfeit:ntext',
					//'risk_type:ntext',
					// 'product:ntext',
					[
						'attribute' => 'product',
						'value' => function($model)
						{
							if ($model->product)
							{
								return Html::a($model->product, ['view', 'id' => $model->id]);
							}
						},
						'format' => 'raw'
					],
					'name:ntext',
					//'description:ntext',
					//'brand:ntext',
					// 'category:ntext',
					[
						'attribute' => 'category',
						'value' => function($model)
						{
							if ($model->categoryName)
							{
								return $model->categoryName->name_cyrl;
							}
						}
					],
					//'type_number_of_model:ntext',
					//'batch_number_barcode:ntext',
					//'oecd_portal_category:ntext',
					//'risk:ntext',
					//'technical_defect:ntext',
					//'measures_adopted_by_notifying_country:ntext',
					//'products_were_found_and_measures_were_taken_also_in:ntext',
					//'company_recall_page:ntext',
					//'url_of_case:ntext',
					//'barcode:ntext',
					//'batch_number:ntext',
					//'company_recall_code:ntext',
					//'production_dates:ntext',
					//'packaging_description:ntext',	
					//'status',
					//'created_at',
					//'updated_at',
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
                            $delete_button = '';
                            if ($model->share_status == 0)
                            {
                                $delete_button = Html::a(Yii::t('app',
                                    '<span class=" glyphicon glyphicon-trash"></span>'),
                                    ['delete', 'id' => $model->id],
                                    ['onClick' => 'return confirm("Are you sure you want to delete this item?")','class' => 'btn btn-danger btn-xs']);
                            }
							return Html::a(Yii::t('app',
							'<span class="glyphicon glyphicon-eye-open"></span>'),
							['view', 'id' => $model->id],
							['class' => 'btn btn-primary btn-xs']) . ' ' .
							 Html::a(Yii::t('app',
							 '<span class="glyphicon glyphicon-pencil"></span>'),
							 ['create', 'id' => $model->id],
							 ['class' => 'btn btn-success btn-xs']).
                                $delete_button;
						},
						'contentOptions' => ['style' => 'text-align: center'],
						'format' => 'raw',
					],
					[
					'label' => Yii::t('app', 'Доставка на таможню'),
					'format' => 'raw',
					'value' => function($model)
					{
                        if ($model->share_status == 1)
                        {
                            return 	  Html::a(Yii::t('app', 'Юборилган'),
                                ['#','id' => $model->id],
                                ['class' => 'btn btn-success']);
                        }
                        elseif($model->share_status ==2)
                        {
                            return 	  Html::a(Yii::t('app', 'Хато юборилган'),
                                ['product/shares','id' => $model->id],
                                ['class' => 'btn btn-danger']);
                        }
                        else
                        {
                            return 	  Html::a(Yii::t('app', 'Юбориш'),
                                ['product/shares','id' => $model->id],
                                ['class' => 'btn btn-warning']);
                        }

					},
				],
					
					
					// ['class' => 'yii\grid\ActionColumn'],
				],
			]); ?>
		</div>
	</div>
</div>