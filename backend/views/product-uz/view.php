<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\ProductUz;
use common\models\RiskType;

$this->title = $model->product;
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
    .table > tbody > tr > th
    {
        width: 200px;
    }
</style>

<div class="row">
    <?php include dirname(__DIR__) . '/country/_left_menu.php' ?>
    <div class="col-lg-10">
        <div class="product-view" style="background-color: #FFFFFF; padding: 20px;">
            <h3><?= Html::encode($this->title) ?></h3>
            <div class="text-center" style="padding: 10px;">
                <img style="max-height: 400px;" src="/productuzPhotos/<?= $model->photo ?>">
            </div>
            <div style="padding: 10px;display: inline-block;">
                <?= Html::a(Yii::t('app', 'Обновить'), ['create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </div>
            <div style="padding: 10px;display: inline-block;" >
                <?= Html::a(Yii::t('app', 'Товары'), ['index'], ['class' => 'btn btn-primary']) ?>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            // 'id',
                            'company_inn:ntext',
                            'company_name:ntext',
                            [
                                'attribute' => 'type_of_alert',
                                'value' => function($model)
                                {
                                    if ($model->type_of_alert)
                                    {
                                        return ProductUz::getAlert($model->type_of_alert);

                                    }
                                }
                            ],
                            [
                                'attribute' => 'type',
                                'value' => function($model)
                                {
                                    if ($model->type)
                                    {
                                        return ProductUz::getType($model->type);

                                    }
                                }
                            ],
                            'alert_number:ntext',
                            'counterfeit:ntext',
                            [
                                'attribute' => 'risk_type',
                                'value' => function($model)
                                {
                                    if ($model->risk_type)
                                    {
                                        return RiskType::find()->where(['id' => $model->risk_type])->one()->name_cyrl;
                                    }
                                }
                            ],
                            'product:ntext',
                            'name:ntext',
                            'description:ntext',
                            'brand:ntext',
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
                            'type_number_of_model:ntext',
                            'batch_number_barcode:ntext',
                            'technical_defect:ntext',
                            'products_were_found_and_measures_were_taken_also_in:ntext',
                            // 'url_of_case:ntext',

                            'barcode:ntext',
                            'batch_number:ntext',
                            'company_recall_code:ntext',
                            'production_dates:ntext',
                            'packaging_description:ntext',
                            // 'codetnved:ntext',
                            [
                                'attribute' => 'codetnved',
                                'value' => function($model)
                                {
                                    if ($model->codeTnVedName)
                                    {
                                        return $model->codeTnVedName->name;
                                    }
                                }
                            ],
                            // 'status',
                            [
                                'attribute' => 'status',
                                'value' => function($model)
                                {
                                    return ($model->status == 1) ? 'Активный' : 'Неактивный';
                                }
                            ],
                            // 'created_at',
                            // 'updated_at',
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
                        ],
                    ]) ?>
                </div>
                <?php if ($modelRu): ?>
                    <div class="col-lg-6">
                        <?= DetailView::widget([
                            'model' => $modelRu,
                            'attributes' => [
                                // 'id',
                                'company_inn:ntext',
                                'company_name:ntext',
                                [
                                    'attribute' => 'type_of_alert',
                                    'value' => function($model)
                                    {
                                        if ($model->type_of_alert)
                                        {
                                            return ProductUz::getAlert($model->type_of_alert);

                                        }
                                    }
                                ],
                                [
                                    'attribute' => 'type',
                                    'value' => function($model)
                                    {
                                        if ($model->type)
                                        {
                                            return ProductUz::getType($model->type);

                                        }
                                    }
                                ],
                                'alert_number:ntext',
                                'counterfeit:ntext',
                                [
                                    'attribute' => 'risk_type',
                                    'value' => function($model)
                                    {
                                        if ($model->risk_type)
                                        {
                                            return RiskType::find()->where(['id' => $model->risk_type])->one()->name_ru;
                                        }
                                    }
                                ],
                                'product:ntext',
                                'name:ntext',
                                'description:ntext',
                                'brand:ntext',
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
                                'type_number_of_model:ntext',
                                'batch_number_barcode:ntext',
                                'technical_defect:ntext',
                                'products_were_found_and_measures_were_taken_also_in:ntext',
                                // 'url_of_case:ntext',

                                'barcode:ntext',
                                'batch_number:ntext',
                                'company_recall_code:ntext',
                                'production_dates:ntext',
                                'packaging_description:ntext',
                                // 'codetnved:ntext',
                                [
                                    'attribute' => 'codetnved',
                                    'value' => function($model)
                                    {
                                        if ($model->codeTnVedName)
                                        {
                                            return $model->codeTnVedName->name;
                                        }
                                    }
                                ],
                                // 'status',
                                [
                                    'attribute' => 'status',
                                    'value' => function($model)
                                    {
                                        return ($model->status == 1) ? 'Активный' : 'Неактивный';
                                    }
                                ],
                                // 'created_at',
                                // 'updated_at',
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
                            ],
                        ]) ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>