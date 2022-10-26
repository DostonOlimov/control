<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Регистрация');
?>
<div class="row">
	<div class="col-lg-6 col-lg-offset-3" style="background-color: #FFFFFF; padding: 10px 50px; margin-bottom: 20px;">

		<h1 class="text-center" style="margin: 50px 0;"><?= $this->title ?></h1>

		<?php $form = ActiveForm::begin([
			'id' => 'form-signup',
			'action' => Url::to(['/site/signup'])
		]); ?>

			<div class="row">
				<div class="col-lg-12">
					<?= $form->field($model, 'username')->textInput(['class' => 'form-control inn']) ?>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<?= $form->field($model, 'password')->passwordInput() ?>
				</div>
				<div class="col-lg-12">
					<?= $form->field($model, 'confirmpassword')->passwordInput() ?>
				</div>
			</div>

			

			<div class="form-group">
				<?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary btn-block btn-lg', 'name' => 'signup-button']) ?>
			</div>

		<?php ActiveForm::end(); ?>

	</div>
</div>