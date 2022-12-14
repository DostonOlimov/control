<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ProductUz;
use yii\grid\ActionColumn;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RiskTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Товары').Yii::t('app', '(сертификация)');
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
    .grid-view table thead 
	{
    background-color: rgba(250, 249, 240);
	color:rgba(45, 100, 224) !important;
	}
</style>
<div class="row">
    <?php include dirname(__DIR__) . '/country/_left_menu.php' ?>
    <div class="col-lg-10"  style="background-color: rgb(226, 230, 225);">
        <div class="product-index" style="background-color: rgb(226, 230, 225); padding: 20px; overflow: auto;">

            <h3 ><?= Html::encode($this->title) ?></h3>
            <div class="row" >
                <div class="col-sm-1" >
                    <?= Html::a(Yii::t('app', 'Добавить').'&emsp;&emsp;&emsp;', ['create'], ['class' => 'btn btn-success']) ?>
                </div>
                <div class="col-sm-1">
                    <?php //     Html::a(Yii::t('app', 'Вставить изображение'), ['image'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <div style = "background-color:#FFFFFF;">
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
                                return "<img style=\"max-height: 100px;\" src=\"/productuzPhotos/{$model->photo}\">";
                            }
                        },
                        'contentOptions' => ['style' => 'text-align: center'],
                        'format' => 'raw'
                    ],
                     'codetnved:ntext',
                    [
                        'attribute' => Yii::t('app', 'Тип оповещения'),
                        'value' => function ($model) {
                         if($model->type_of_alert)
                            return ProductUz::getAlert($model->type_of_alert);
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
                    'company_inn:ntext',
                    'company_name:ntext',
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
                            return Html::a(Yii::t('app',
                                    '<span class="glyphicon glyphicon-eye-open"></span>'),
                                    ['view', 'id' => $model->id],
                                    ['class' => 'btn btn-primary btn-xs']) . ' ' .
                                Html::a(Yii::t('app',
                                    '<span class="glyphicon glyphicon-pencil"></span>'),
                                    ['create', 'id' => $model->id],
                                    ['class' => 'btn btn-success btn-xs']).
                                Html::a(Yii::t('app',
                                    '<span class=" glyphicon glyphicon-trash"></span>'),
                                    ['delete', 'id' => $model->id],
                                    ['onClick' => 'return confirm("Are you sure you want to delete this item?")','class' => 'btn btn-danger btn-xs']);
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
</div>