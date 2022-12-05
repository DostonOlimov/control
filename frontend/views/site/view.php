<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Product;
use common\models\RiskType;
use common\models\Country;

$this->title = Yii::$app->name;
$lang = Yii::$app->language;
?>
<style type="text/css">
	h3.text-center
	{
		margin: 0;
	}
	.product-img
	{
		background-repeat: no-repeat;
		background-size: cover;
		/*background-size: 100% 100%;*/
		background-position: center;
		margin: 0 auto;
		width: 100%;
		height: 400px;
	}
	.product-link
	{
		color: #000000;
	}
	.product-link:hover
	{
		text-decoration: none;
	}
</style>
<div class="row">
	<div class="col-lg-9">
		<div class="site-index">
			<div class="row">
				<div class="col-lg-12">
					<div style="background-color: #FFFFFF; padding: 20px; margin-bottom: 30px;">
						<div class="row">
							<div class="col-lg-3">
								<a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/index']) ?>"><?= Yii::t('app', 'Главная') ?></a>
							</div>
							<div class="col-lg-3">
								<a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/about']) ?>"><?= Yii::t('app', 'О портале') ?></a>
							</div>
							<div class="col-lg-3">
								<a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/information']) ?>"><?= Yii::t('app', 'Полезная информация') ?></a>
							</div>
							<div class="col-lg-3">
								<a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/contact']) ?>"><?= Yii::t('app', 'Контакты') ?></a>
							</div>
						</div>
					</div>
					<div style="background-color: #FFFFFF; padding: 10px; padding-bottom: 0px; margin-bottom: 30px;">
                        <div class="row">
                            <div class="col-lg-6">
                                <a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/index','product'=>1]) ?>"><?= Yii::t('app', 'Дополнительная сертификация продуктов') ?></a>
                            </div>
                            <div class="col-lg-6">
                                <a class="btn btn-primary btn-block btn-top" href="<?= Url::to(['/site/indexuz','product'=>2]) ?>"><?= Yii::t('app', 'Продукция, подлежащая сертификации') ?></a>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div style="background-color: #FFFFFF; padding: 20px; margin-bottom: 30px;">
						<div style="width: 45%; float: left; margin-right: 15px; margin-bottom: 15px;">
							<?php if ($model->photo): ?>
								<?php if(isset($model->company_inn)): ?>
									<a href="/productuzPhotos/<?= $model->photo ?>" target="_blank">
									<div class="product-img" style="background-image: url(/productuzPhotos/<?= $model->photo ?>);"></div>
								</a>
									<?php else :?>
									
								<a href="/productPhotos/<?= $model->photo ?>" target="_blank">
									<div class="product-img" style="background-image: url(/productPhotos/<?= $model->photo ?>);"></div>
								</a>
								<?php endif ?>
							<?php else: ?>
									<div class="product-img" style="background-image: url(/images/no-photo.jpg);"></div>
							<?php endif ?>
							<div style="margin-top: 10px; text-align: center;">
								<span class="glyphicon glyphicon-calendar" aria-hidden="true" style="font-size: 80%"></span> <?= date('d.m.Y H:i', $model->created_at)  ?>
								&nbsp;&nbsp;&nbsp;
								<span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="font-size: 80%"></span> <?= $model->views ?>
							</div>
						</div>
						
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('category') ?>:</b> <?= (isset($model->categoryName)) ? $model->categoryName->{'name_' . $lang} : ''; ?>
						</div>
						<?php if(isset($model->company_inn)) :?>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('company_name') ?>:</b> <?= (isset($model->company_name)) ? $model->company_name : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('company_inn') ?>:</b> <?= (isset($model->company_inn)) ? $model->company_inn : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('made_company') ?>:</b> <?= (isset($model->made_company)) ? $model->made_company : ''; ?>
						</div>
						<?php endif; ?>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('codetnved') ?>:</b> <?= (isset($model->codetnved)) ? $model->codetnved : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('product') ?>:</b> <?= (isset($model->product)) ? $model->product : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('description') ?>:</b> <?= (isset($model->description)) ? $model->description : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('type_of_alert') ?>:</b><?php if (isset($model->type_of_alert))
							  {if (is_numeric($model->type_of_alert))  echo Product::getAlert($model->type_of_alert);
							else echo $model->type_of_alert; } ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('type') ?>:</b>
							 <?php if (isset($model->type))
							  {if (is_numeric($model->type))  echo Product::getType($model->type);
							else echo $model->type; } ?>
						</div>
						
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('alert_number') ?>:</b> <?= (isset($model->alert_number)) ? $model->alert_number : ''; ?>
						</div>
						<?php if (isset($model->alert_submitted_by)):?>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('alert_submitted_by') ?>:</b> <?= (isset($model->alert_submitted_by)) ? $model->alert_submitted_by : ''; ?>
						</div>
						<?php endif ?>
						<?php if (isset($model->country_of_origin)):?>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('country_of_origin') ?>:</b> <?= (is_numeric($model->country_of_origin)) ? 
										Country::find()
                                            ->where(['id' => $model->country_of_origin])
                                            ->one()
                                            ->name_country : $model->country_of_origin; ?>
						</div>
						<?php endif ?>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('risk_type') ?>:</b> <?php if (isset($model->risk_type))
							  {if (is_numeric($model->risk_type))  echo RiskType::find()->where(['id' =>$model->risk_type])->one()->name_cyrl;
							else echo $model->risk_type; } ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('name') ?>:</b> <?= (isset($model->name)) ? $model->name : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('brand') ?>:</b> <?= (isset($model->brand)) ? $model->brand : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('type_number_of_model') ?>:</b> <?= (isset($model->type_number_of_model)) ? $model->type_number_of_model : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('batch_number_barcode') ?>:</b> <?= (isset($model->batch_number_barcode)) ? $model->batch_number_barcode : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('oecd_portal_category') ?>:</b> <?= (isset($model->oecd_portal_category)) ? $model->oecd_portal_category : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('risk') ?>:</b> <?= (isset($model->risk)) ? $model->risk : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('technical_defect') ?>:</b> <?= (isset($model->technical_defect)) ? $model->technical_defect : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('measures_adopted_by_notifying_country') ?>:</b> <?= (isset($model->measures_adopted_by_notifying_country)) ? $model->measures_adopted_by_notifying_country : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('products_were_found_and_measures_were_taken_also_in') ?>:</b> <?= (isset($model->products_were_found_and_measures_were_taken_also_in)) ? $model->products_were_found_and_measures_were_taken_also_in : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('company_recall_page') ?>:</b> <?= (isset($model->company_recall_page)) ? $model->company_recall_page : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('url_of_case') ?>:</b> <?= (isset($model->url_of_case)) ? "<a href='$model->url_of_case' target='_blank' class='btn btn-danger btn-xs'>Посмотреть</a>" : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('barcode') ?>:</b> <?= (isset($model->barcode)) ? $model->barcode : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('batch_number') ?>:</b> <?= (isset($model->batch_number)) ? $model->batch_number : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('company_recall_code') ?>:</b> <?= (isset($model->company_recall_code)) ? $model->company_recall_code : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('production_dates') ?>:</b> <?= (isset($model->production_dates)) ? $model->production_dates : ''; ?>
						</div>
						<div style="margin-top: 10px;">
							<b><?= $model->getAttributeLabel('packaging_description') ?>:</b> <?= (isset($model->packaging_description)) ? $model->packaging_description : ''; ?>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include '_left_menu.php'; ?>
</div>