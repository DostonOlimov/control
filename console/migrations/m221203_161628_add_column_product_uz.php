<?php

use yii\db\Migration;

/**
 * Class m221203_161628_add_column_product_uz
 */
class m221203_161628_add_column_product_uz extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product_uz','country_of_origin',$this->integer());
        $this->addColumn('product_uz','comment',$this->text());
        $this->addColumn('product_uz','made_company',$this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221203_161628_add_column_product_uz cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221203_161628_add_column_product_uz cannot be reverted.\n";

        return false;
    }
    */
}
