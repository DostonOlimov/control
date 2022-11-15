<?php

use yii\db\Migration;

/**
 * Class m221104_050258_risk_type
 */
class m221104_050258_risk_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       /* $this->createTable('{{%risk_type}}', [
            'id' => $this->primaryKey(),
            'name_cyrl' => $this->string()->notNull(),
            'name_ru' => $this->string()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);*/
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221104_050258_risk_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221104_050258_risk_type cannot be reverted.\n";

        return false;
    }
    */
}
