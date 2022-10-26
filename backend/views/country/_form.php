<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Добавить');
?>

<div class="row">
	<?php include '_left_menu.php' ?>
	<div class="col-lg-10">
		<div class="country-form" style="background-color: #FFFFFF; padding: 20px;">
			<?php $form = ActiveForm::begin(); ?>
			<div class="row">
				<div class="col-lg-12">
					<?= $form->field($model, 'name_country')->textInput(['maxlength' => true]) ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<?= $form->field($model, 'id_country')->textInput(['maxlength' => true]) ?>
				</div>
				<div class="col-lg-4">
					<?= $form->field($model, 'code_country')->textInput(['maxlength' => true]) ?>
				</div>
				<div class="col-lg-4">
					<?= $form->field($model, 'active')->dropDownList([1 => 'Активный', 0 => 'Неактивный']) ?>
				</div>
			</div>
			<div class="form-group text-right">
				<?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>