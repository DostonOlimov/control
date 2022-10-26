<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Добавить');
?>

<div class="row">
	<?php include dirname(__DIR__) . '/country/_left_menu.php' ?>
	<div class="col-lg-10">
		<div class="codetnved-form" style="background-color: #FFFFFF; padding: 20px;">
			<?php $form = ActiveForm::begin(); ?>
			<div class="row">
				<div class="col-lg-6">
					<?= $form->field($model, 'kod')->textInput(['maxlength' => true]) ?>
				</div>
				<div class="col-lg-6">
					<?= $form->field($model, 'import')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>
				</div>
			</div>
			<?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>
			<div class="form-group text-right">
				<?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>