<?php

use yii\db\Migration;

/**
 * Class m221204_152917_delete_product_uz
 */
class m221204_152917_delete_product_uz extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /*$this->dropColumn('product_uz', 'parent_id');
        $this->dropColumn('product_uz', 'lang');
        $this->dropColumn('product_uz', 'codetnved');
        $this->dropColumn('product_uz', 'type_of_alert');
        $this->dropColumn('product_uz', 'type');
        $this->dropColumn('product_uz', 'parent_id');
        $this->dropColumn('product_uz', 'parent_id');
        $this->dropColumn('product_uz', 'parent_id');
        $this->dropColumn('product_uz', 'parent_id');
        $this->dropColumn('product_uz', 'parent_id');
        $this->dropColumn('product_uz', 'parent_id');
        $this->dropColumn('product_uz', 'parent_id');
        $this->dropColumn('product_uz', 'parent_id');*/

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221204_152917_delete_product_uz cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221204_152917_delete_product_uz cannot be reverted.\n";

        return false;
    }
    */
}
