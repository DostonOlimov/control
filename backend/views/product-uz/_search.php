<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductUzSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-uz-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'parent_id') ?>

    <?= $form->field($model, 'lang') ?>

    <?= $form->field($model, 'codetnved') ?>

    <?= $form->field($model, 'type_of_alert') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'alert_number') ?>

    <?php // echo $form->field($model, 'counterfeit') ?>

    <?php // echo $form->field($model, 'risk_type') ?>

    <?php // echo $form->field($model, 'product') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'brand') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'type_number_of_model') ?>

    <?php // echo $form->field($model, 'batch_number_barcode') ?>

    <?php // echo $form->field($model, 'technical_defect') ?>

    <?php // echo $form->field($model, 'products_were_found_and_measures_were_taken_also_in') ?>

    <?php // echo $form->field($model, 'barcode') ?>

    <?php // echo $form->field($model, 'batch_number') ?>

    <?php // echo $form->field($model, 'company_recall_code') ?>

    <?php // echo $form->field($model, 'production_dates') ?>

    <?php // echo $form->field($model, 'packaging_description') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php // echo $form->field($model, 'company_inn') ?>

    <?php // echo $form->field($model, 'company_name') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
