<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('app', 'Добавить');
?>

<div class="row">
	<?php include dirname(__DIR__) . '/country/_left_menu.php' ?>
	<div class="col-lg-10">
		<div class="category-form" style="background-color: #FFFFFF; padding: 20px;">
			<?php $form = ActiveForm::begin(); ?>
			<div class="row">
				<div class="col-lg-4">
					<?= $form->field($model, 'name_cyrl')->textInput(['maxlength' => true]) ?>
				</div>
				<div class="col-lg-4">
					<?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
				</div>
				<div class="col-lg-4">
					<?= $form->field($model, 'status')->dropDownList([1 => 'Активный', 0 => 'Неактивный']) ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<?php //= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>
				</div>
				<div class="col-lg-4">
					<?php //= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>
				</div>
			</div>
			<div class="form-group text-right">
				<?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>