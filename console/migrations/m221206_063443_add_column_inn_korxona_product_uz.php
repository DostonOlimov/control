<?php

use yii\db\Migration;

/**
 * Class m221206_063443_add_column_inn_korxona_product_uz
 */
class m221206_063443_add_column_inn_korxona_product_uz extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product_uz','made_company_inn',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221206_063443_add_column_inn_korxona_product_uz cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221206_063443_add_column_inn_korxona_product_uz cannot be reverted.\n";

        return false;
    }
    */
}
