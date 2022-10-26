<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Авторизоваться');
?>

<div class="site-login">

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3" style="background-color: #FFFFFF; padding: 10px 50px; margin-bottom: 20px;">

				<h1 class="text-center" style="margin: 50px 0;">Авторизоваться</h1>

				<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

					<?= $form->field($model, 'username')->textInput(['class' => 'form-control inn']) ?>

					<?= $form->field($model, 'password')->passwordInput() ?>

					<?php //= $form->field($model, 'rememberMe')->checkbox() ?>

					<div class="form-group" style="margin-top: 40px;">
						<?= Html::submitButton(Yii::t('app', 'Вход'), ['class' => 'btn btn-primary btn-block btn-lg', 'natcasesort(array)me' => 'signup-button']) ?>
					</div>

				<?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>
	
</div>
