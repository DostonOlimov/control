<?php

use yii\db\Migration;

class m201022_174504_product_photos extends Migration
{
	public function up()
	{
		$this->createTable('{{%product_photos}}', [
			'id' => $this->primaryKey(),

			'product_id' => $this->string(),
			'photo' => $this->string(),

			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
		]);
	}

	public function down()
	{
		$this->dropTable('{{%product_photos}}');
	}
}
