<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\grid\GridView;
use yii\console\widgets\Table;

//$this->registerJsFile(Yii::getAlias('@web') . '/web/css/import.css');

   
$id = $category_id;
?>
<?php include dirname(__DIR__) . '/country/_left_menu.php' ?>
<div class="container" style="padding: 10px;font-size:20px;">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<div class="form-group">
<table class="table table-striped table-bordered">
 <?php foreach ($id as $item){?>
        <tr>
            <td><?= $item ?></td>
            <td ><?= $form->field($model, 'image')->widget(FileInput::classname(), [
                    'language' => 'ru',
                    'options' => ['accept' => 'image/*'],
                ]);
                ?></div></td>
            <td><?php echo Html::submitButton(Yii::t('app', 'Yuklash'), ['class' => 'btn btn-success']); } ?></td>
        </tr>

</table>

</div>
<?php ActiveForm::end();
 
 ?>
</div>