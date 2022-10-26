<?php

use yii\db\Migration;

/**
 * Class m200918_071813_product
 */
class m200918_071813_product extends Migration
{
	public function up()
	{
		$this->createTable('{{%product}}', [
			'id' => $this->primaryKey(),
			'codetnved' => $this->text(),
			'type_of_alert' => $this->text(),
			'type' => $this->text(),
			'alert_number' => $this->text(),
			'alert_submitted_by' => $this->text(),
			'country_of_origin' => $this->text(),
			'counterfeit' => $this->text(),
			'risk_type' => $this->text(),
			'product' => $this->text(),
			'name' => $this->text(),
			'description' => $this->text(),
			'brand' => $this->text(),
			'category' => $this->text(),
			'type_number_of_model' => $this->text(),
			'batch_number_barcode' => $this->text(),
			'oecd_portal_category' => $this->text(),
			'risk' => $this->text(),
			'technical_defect' => $this->text(),
			'measures_adopted_by_notifying_country' => $this->text(),
			'products_were_found_and_measures_were_taken_also_in' => $this->text(),
			'company_recall_page' => $this->text(),
			'url_of_case' => $this->text(),
			'barcode' => $this->text(),
			'batch_number' => $this->text(),
			'company_recall_code' => $this->text(),
			'production_dates' => $this->text(),
			'packaging_description' => $this->text(),

			'status' => $this->smallInteger()->notNull()->defaultValue(1),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
		]);
	}

	public function down()
	{
		$this->dropTable('{{%product}}');
	}
}
