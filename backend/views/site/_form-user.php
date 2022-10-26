<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'KPI');
?>

<div class="row">
	<?php include dirname(__DIR__) . '/country/_left_menu.php' ?>
	<div class="col-md-9">
		<div class="kpi-form" style="background-color: #FFFFFF; padding: 20px;">
			<?php $form = ActiveForm::begin(); ?>
				<div class="row">
					<div class="col-lg-4">
						<?= $form->field($model, 'username')->textInput(['maxlength' => true, 'class' => 'form-control inn']) ?>
					</div>
					<div class="col-lg-4">
						<?= $form->field($model, 'status')->dropDownList([10 => 'Активный', 0 => 'Неактивный']) ?>
					</div>
					<div class="col-lg-4">
						<?php //= $form->field($model, 'typeId')->dropDownList([2 => 'Админ', 3 => 'Модератор', 4 => 'Пользователь']) ?>
					</div>
				</div>
				<div class="form-group text-right">
					<?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
				</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>