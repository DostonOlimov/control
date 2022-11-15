<?php

use yii\db\Migration;

/**
 * Class m221104_042332_product_uz
 */
class m221104_042332_product_uz extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

       $this->createTable('{{%product_uz}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue(0)->notNull(),
            'lang' => $this->string()->defaultValue('cyrl'),
            'codetnved' => $this->text(),
            'type_of_alert' => $this->integer(),
            'type' => $this->integer(),
            'alert_number' => $this->text(),
            'counterfeit' => $this->text(),
            'risk_type' => $this->text(),
            'product' => $this->text(),
            'name' => $this->text(),
            'description' => $this->text(),
            'brand' => $this->text(),
            'category' => $this->integer(),
            'type_number_of_model' => $this->text(),
            'batch_number_barcode' => $this->text(),
            'technical_defect' => $this->text(),
            'products_were_found_and_measures_were_taken_also_in' => $this->text(),
            'barcode' => $this->text(),
            'batch_number' => $this->text(),
            'company_recall_code' => $this->text(),
            'production_dates' => $this->text(),
            'packaging_description' => $this->text(),
            'photo' => $this->string(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'views' => $this->integer()->defaultValue(0),

            'company_inn' => $this->integer(),
            'company_name' => $this->text(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221104_042332_product_uz cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221104_042332_product_uz cannot be reverted.\n";

        return false;
    }
    */
}
