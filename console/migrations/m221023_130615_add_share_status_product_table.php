<?php

use yii\db\Migration;

/**
 * Class m221023_130615_add_share_status_product_table
 */
class m221023_130615_add_share_status_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product','share_status',$this->integer()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221023_130615_add_share_status_product_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221023_130615_add_share_status_product_table cannot be reverted.\n";

        return false;
    }
    */
}
