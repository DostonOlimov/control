<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RiskTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$lang = Yii::$app->language;

$this->title = Yii::t('app', 'Тип риска');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <?php include dirname(__DIR__) . '/country/_left_menu.php' ?>
    <div class="col-lg-10">
        <div class="category-index" style="background-color: #FFFFFF; padding: 20px;">
            <h3><?= Html::encode($this->title) ?></h3>
            <p>
                <?= Html::a(Yii::t('app', 'Добавить'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name_cyrl',
            'name_ru',
           // 'created_at',
          //  'updated_at',
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
                    return
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

        ],
    ]); ?>
        </div>
        </div>
</div>
