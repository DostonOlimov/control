<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'KPI');
?>

<div class="row">
	<?php include dirname(__DIR__) . '/country/_left_menu.php' ?>
	<div class="col-md-9">
		<div class="kpi-form" style="background-color: #FFFFFF; padding: 20px;">
			<h3>Установите новый пароль для <?= $model->username ?></h3>
			<?php $form = ActiveForm::begin(); ?>
				<div class="row">
					<div class="col-lg-5">
						<?= $form->field($model, 'password')->passwordInput() ?>
					</div>
					<div class="col-lg-2">
						<div class="form-group text-right">
							<label class="control-label" style="color: #FFFFFF">123</label>
							<?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success btn-block']) ?>
						</div>
					</div>
				</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>