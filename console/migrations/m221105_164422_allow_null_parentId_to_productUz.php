<?php

use yii\db\Migration;

/**
 * Class m221105_164422_allow_null_parentId_to_productUz
 */
class m221105_164422_allow_null_parentId_to_productUz extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('product_uz', 'parent_id',$this->integer()->Null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221105_164422_allow_null_parentId_to_productUz cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221105_164422_allow_null_parentId_to_productUz cannot be reverted.\n";

        return false;
    }
    */
}
