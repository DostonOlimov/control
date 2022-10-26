<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\console\widgets\Table;

//$this->registerJsFile(Yii::getAlias('@web') . '/web/css/import.css');
//var_dump( Yii::getAlias('@web').'/web/css/import.css');
 include dirname(__DIR__) . '/country/_left_menu.php' ;
if (!$arrayCondition[0]) {
   

?>

<style type="text/css">
  @import url(https://fonts.googleapis.com/css?family=Open+Sans:700,300);

.frame {
	position: left;
	top: 50%;
	left: 50%;
	width: 1400px;
	height: 500px;
	margin-top: -200px;
	margin-left: -200px;
	border-radius: 2px;
	box-shadow: 4px 8px 16px 0 rgba(0, 0, 0, 0.1);
	overflow: hidden;
	background: linear-gradient(to top right, darkmagenta 0%, hotpink 100%);
  font-weight: bold;
}

.center {
	position: relative;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	width: 1000px;
	height: 460px;
	border-radius: 3px;
	box-shadow: 8px 10px 15px 0 rgba(0, 0, 0, 0.2);
	background: #fff;
	display: flex;
	align-items: center;
	justify-content: space-evenly;
	flex-direction: column;
  
}

.title {
	width: 100%;
	height: 50px;
	border-bottom: 1px solid #999;
	text-align: center;
  font-weight: bold;
}

h1 {
	font-size: 18px;
	font-weight: 300;
	color: #666;
  font-weight: bold;
}

.dropzone {
	width: 200px;
	height: 80px;
	border: 1px dashed #999;
	border-radius: 3px;
	text-align: center;
  
}

.upload-icon {
	margin: 25px 2px 2px 2px;
}

.upload-input {
	position: relative;
	top: -62px;
	left: 0;
	width: 100%;
	height: 100%;
	opacity: 0;
}

.btn1 {
	display: block;
  margin-top:100px;
	width: 140px;
	height: 40px;
	background: darkmagenta;
	color: #fff;
	border-radius: 3px;
	border: 0;
	box-shadow: 0 3px 0 0 hotpink;
	transition: all 0.3s ease-in-out;
	font-size: 14px;
  font-weight: bold;
}

.btn1:hover {
	background: rebeccapurple;
	box-shadow: 0 3px 0 0 deeppink;
}

  </style>



<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>


<div class="frame">
	<div class="center">
		<div class="title">
			<h1>Excel file download</h1>  
		</div>

		<div class="dropzone">
			<img src="http://100dayscss.com/codepen/upload.svg" class="upload-icon" />
			<?= $form->field($model, 'excelFile')->fileInput(['class'=>'upload-input']) ?>
		</div>

    <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn1']) ?>

	</div>
</div>

   

<?php ActiveForm::end();
 }
 else{
$file_path = '../uploads/error_name.xlsx';
     
     ?>
     
<table border="1" style="font-family: arial, sans-serif;
    width: 1400px;height: 400px; font-size:24px;   ">
  
  <tr>
    <td>Mahsulot,tasnif,kategoriya,kod TN VED, davlat nomlari kiritilmagan malumotlar</td>
    <td><?php if($arrayCondition[1]){echo Html::a('yuklab olish','../../uploads/error_name.xlsx');}
    else{echo 'Aniqlanmadi';}?></td>
  
  </tr>
 
  <tr>
    <td>Kategoriya topilmagan malumotlar</td>
    <td><?php if($arrayCondition[2]){echo Html::a('yuklab olish','../../uploads/error_category.xlsx');}
    else{echo 'Aniqlanmadi';}?></td>  
  </tr>
  <tr>
    <td>Kod TN VED topilmagan malumotlar</td>
    <td><?php if($arrayCondition[3]){echo Html::a('yuklab olish','../../uploads/error_kode.xlsx');}
    else{echo 'Aniqlanmadi';}?></td>  
  </tr>
  <tr>
    <td>Yetkazib beruvchi davlat topilmagan malumotlar</td>
    <td><?php if($arrayCondition[4]){echo Html::a('yuklab olish','../../uploads/error_allert_country.xlsx');}
    else{echo 'Aniqlanmadi';}?></td>  
  </tr>
  <tr>
    <td>Ishlab chiqaruvchi davlat topilmagan malumotlar</td>
    <td><?php if($arrayCondition[5]){echo Html::a('yuklab olish','../../uploads/error_made_country.xlsx');}
    else{echo 'Aniqlanmadi';}?></td>  
  </tr>
  <tr>
    <td>To'g'ri kiritilgan malumotlar</td>
    <td><?php echo Html::a('yuklab olish','../../uploads/succes.xlsx');?></td>  
  </tr>




   
<?php
    
 }
 ?>
</div>