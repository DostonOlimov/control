<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveField;
use common\models\Country;
use common\models\Category;
use common\models\Codetnved;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
	<?php include dirname(__DIR__) . '/country/_left_menu.php' ?>
	<div class="col-lg-10">
		<div class="product-form" style="background-color: #FFFFFF; padding: 20px;">


            <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
<h2 style = "text-align: center">Malumotlarni yuklovchi maydonlarni tanlang</h2>
                    <div class="row">
                        <div class="col-lg-3">
                        <?php
                        echo $form->field($model, 'lang')->dropDownList(['0'=>'барчаси','1'=>'руcча','2'=>'крйлча']);
                        echo $form->field($model, 'name')->checkbox(['class'=>'chk','checked' => true], true);
                        echo $form->field($model, 'type_of_alert')->checkbox(['class'=>'chk','checked' => true], true);
                        echo $form->field($model, 'alert_number')->checkbox(['class'=>'chk','checked' => true], true);
                        echo $form->field($model, 'alert_submitted_by')->checkbox(['class'=>'chk','checked' => true], true);
                        echo $form->field($model, 'country_of_origin')->checkbox(['class'=>'chk','checked' => true], true);
                        echo $form->field($model, 'type')->checkbox(['class'=>'chk','checked' => true], true);
                        ?>
                      </div>
            <div class="col-lg-3">
                <?php
                       echo $form->field($model, 'product')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'risk_type')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'production_dates')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'description')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'category')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'brand')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'batch_number_barcode')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'oecd_portal_category')->checkbox(['class'=>'chk','checked' => true], true);
                        ?>
            </div>
            <div class="col-lg-3">
                <?php
                echo $form->field($model, 'risk')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'url_of_case')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'barcode')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'company_recall_page')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'company_recall_code')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'codetnved')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'risk')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'status')->checkbox(['class'=>'chk','checked' => true], true);
                      ?>
            </div>

            <div class="col-lg-3">
                <?php
                        echo $form->field($model, 'packaging_description')->checkbox(['class'=>'chk','checked' => true]);
                       echo $form->field($model, 'technical_defect')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'type_number_of_model')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'counterfeit')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'products_were_found_and_measures_were_taken_also_in')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'measures_adopted_by_notifying_country')->checkbox(['class'=>'chk','checked' => true], true);
                       echo $form->field($model, 'batch_number')->checkbox(['class'=>'chk','checked' => true,], true);


                       ?>
                <input type="button" onclick='selects()' value="Hammasini tanlash"/>
                <input type="button" onclick='deSelect()' value="Tozalash"/>
            </div></div>
            <div class="row">
                <div class="col-lg-4">
                  <?= $form->field($model, 'date_from')->widget(DatePicker::className());?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'date_to')->widget(DatePicker::className());?>
                </div>
                <div class="col-lg-4">

                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="form-group text-center">
    <?= Html::a(Yii::t('app', 'Товары'), ['index'], ['class' => 'btn btn-primary']) ?>
    <?php if($t) echo  Html::a('yuklab olish','../../uploads/products.xlsx',['class'=>'btn btn-primary']);
         else echo Html::submitButton(Yii::t('app', 'Файл загружен'), ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>
<script type="text/javascript">
    function selects(){
        var ele=document.getElementsByClassName('chk');
        for(var i=0; i<ele.length; i++){
            if(ele[i].type=='checkbox')
                ele[i].checked=1;

        }
    }
    function deSelect(){
        var ele=document.getElementsByClassName('chk');
        for(var i=0; i<ele.length; i++){
            if(ele[i].type=='checkbox')
                ele[i].checked=0;

        }
    }
</script>
