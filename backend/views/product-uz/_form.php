<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use common\models\Country;
use common\models\Category;
use common\models\ProductUz;
use common\models\RiskType;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\ProductUz */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Добавить');

if($errors){
    foreach ($errors as $error) {
        echo '<div style="color:red;text-align:center;font-size:22px;">'.$error.'</div>';
    }
}


$country = Country::find()
    ->where(['active' => 1])
    ->orderBy('name_country ASC')
    ->all();
$country = ArrayHelper::map($country, 'id', 'name_country');
unset($country[250]);

$category = Category::find()
    ->where(['status' => 1])
    ->orderBy('name_cyrl ASC')
    ->all();
$category = ArrayHelper::map($category, 'id', 'name_cyrl');

$codetnved = [];

$csrf_param = Yii::$app->request->csrfParam;
$csrf_token = Yii::$app->request->csrfToken;
?>
    <style type="text/css">
        .select2-container
        {
            width: 100% !important;
        }
        .select2-container .select2-selection--single
        {
            height: 34px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered
        {
            line-height: 32px;
            padding-left: 5px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow
        {
            top: 4px;
        }
    </style>
    <div class="row">
        <?php include dirname(__DIR__) . '/country/_left_menu.php' ?>
        <div class="col-lg-10">
            <div class="product-form" style="background-color: #F1F1F1; padding: 20px; color:blue;">

                <ul class="nav nav-tabs">
                    <?php foreach ($models as $inx => $model): ?>
                        <li <?php if ($model->lang == 'cyrl'): ?>class="active"<?php endif ?>>
                            <a data-toggle="tab" href="#<?= $model->lang ?>"><?php if ($model->lang == 'cyrl'): ?>Ўзб<?php elseif($model->lang == 'ru'): ?>Рус<?php endif ?></a></li>
                    <?php endforeach ?>
                </ul>

                <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
                <div class="tab-content">
                    <?php foreach ($models as $inx => $model): ?>
                        <div id="<?= $model->lang ?>" class="tab-pane fade <?php if ($model->lang == 'cyrl'): ?>active in<?php endif ?>">
                            <div class="row">
                            <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]company_name")->textInput() ?>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <?= $form->field($model, "[{$inx}]company_inn")->widget(MaskedInput::className(), [
                                        'mask' => '999999999'
                                    ]) ?>
                                </div>
                                <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]made_company")->textInput() ?>
                                </div>                            
                            </div>
                            <div class="row">
                            <div class="col-md-4">
                                    <?= $form->field($model, "[{$inx}]made_company_inn")->textInput(['type' => 'number']) ?>
                                </div>
                                <div class="col-lg-4">
                            <?php if ($model->country_of_origin):?>
                            <?= $form->field($model, "[{$inx}]country_of_origin")->dropDownList($country, ['prompt' => '---', 'class' => 'form-control select2']) ?>
                             <?php  else : ?>
                            <?= $form->field($model, "[{$inx}]country_of_origin")->dropDownList($country, ['prompt' => '---', 'class' => 'form-control select2']) ?>
                             <?php endif ?>
                            </div>
                            <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]type")->dropDownList(ProductUz::getType(),['prompt'=>'Tanlash...']) ?>
                                </div>
                                <div class="col-lg-6">
                                    <?= $form->field($model, "[{$inx}]name")->textInput() ?>
                                </div>
                                <div class="col-lg-6">
                                    <?= $form->field($model, "[{$inx}]description")->textInput() ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <?php
                                    if (!$model->isNewRecord) {
                                        echo Html::activeHiddenInput($model, "[{$inx}]id");
                                    }

                                    echo Html::activeHiddenInput($model, "[{$inx}]lang");
                                    echo Html::activeHiddenInput($model, "[{$inx}]parent_id");
                                    ?>
                                        <?= $form->field($model, "[{$inx}]type_of_alert")->dropDownList(ProductUz::getAlert(),['prompt'=>'Tanlash...']) ?>

                                </div>
                          
                                <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]alert_number")->textInput() ?>
                                </div>
                                <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]risk_type")->dropDownList(ArrayHelper::map(RiskType::find()->orderBy('name_cyrl', 'ASC')->asArray()->all(), 'id', 'name_cyrl'),['prompt'=>'Tanlash...']) ?>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]category")->dropDownList($category, ['prompt' => '---', 'class' => 'form-control select2']) ?>
                                </div>
                                <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]product")->textInput() ?>
                                </div>
                                <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]counterfeit")->textInput() ?>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]brand")->textInput() ?>
                                </div>
                                <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]type_number_of_model")->textInput() ?>
                                </div>
                                <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]batch_number_barcode")->textInput() ?>
                                </div>
                            </div>
                            <div class="row">
                               
                                <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]products_were_found_and_measures_were_taken_also_in")->textInput() ?>
                                </div>
                                <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]technical_defect")->textInput() ?>
                                </div>

                                <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]barcode")->textInput() ?>
                                </div>
                            </div>

                            <div class="row">
                                
                                <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]batch_number")->textInput() ?>
                                </div>
                                <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]company_recall_code")->textInput() ?>
                                </div>
                                <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]production_dates")->textInput() ?>
                                </div>
                            </div>
                            <div class="row">
                            <?php if ($model->codetnved){?>
                                    <div class="col-lg-6">
                                        <?= $form->field($model, "[{$inx}]codetnved")->dropDownList($codetnved, ['value'=>$model->codetnved, 'class' => 'form-control select2222']) ; ?>
                                        <?= 'ТН-ВЭД коди --- '.$model->codetnved;?>
                                    </div>
                                <?php } else {?>
                                    <div class="col-lg-6">
                                        <?= $form->field($model, "[{$inx}]codetnved")->dropDownList($codetnved, ['prompt' => '---', 'class' => 'form-control select2222']) ?>
                                    </div>
                                <?php } ?>
                                <div class="col-lg-6">
                                    <?= $form->field($model, "[{$inx}]packaging_description")->textInput() ?>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-lg-4">
                                    <?= $form->field($model, "[{$inx}]status")->dropDownList([1 =>  Yii::t('app', 'Активный'), 0 => Yii::t('app', 'Неактивный')]) ?>
                                </div>
                            <div class="col-lg-8">
                                    <?= $form->field($model, "[{$inx}]comment")->textArea() ?>
                                </div>
                            </div>
                            <?php if ($model->photo): ?>
                                <div class="text-center" style="padding: 10px; ">
                                    <img style="max-width: 50%" src="/productPhotos/<?= $model->photo ?>">
                                </div>
                            <?php endif ?>
                        </div>
                    <?php endforeach ?>
                </div>
                <div style = "background-color: #FFFFFF">
                <?= $form->field($model, 'photo')->widget(FileInput::classname(), [
                    'language' => 'ru',
                    'options' => ['accept' => 'image/*'],
                ]);
                ?>
                </div>
                <div class="form-group text-right">
                    <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>

<?php

$script = "
$(function(){
	// $('.select2:not(:hidden)').select2();
	// $('a[data-toggle=tab]').on('shown.bs.tab', function (e) {
	// 	$('.select2').select2();
	// });
	$('.select2222').select2({
		minimumInputLength: 2,
		ajax: {
			url: '".Url::to(['/product/code-tn-ved'])."',
			type: 'GET',
			dataType: 'json',
			data: function (params)
			{
				var jsonObj = {
					term: params.term
				};
				jsonObj['$csrf_param'] = '$csrf_token';
				return jsonObj;
			},
			processResults: function (data, params)
			{
				console.log(data);
				return {
					results: data
				};
			}
		}
	});
});
";

$this->registerJs($script);

?>