<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = Yii::t('app', 'Ошибка!!!');
?>
<div class="site-error">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3" style="background-color: #FFFFFF; padding: 20px;">
			<div class="alert alert-danger" style="margin: 0px;">
				<?= nl2br(Html::encode($message)) ?>
			</div>
		</div>
	</div>
</div>
