<?php

use yii\db\Migration;

class m200918_071732_category extends Migration
{
	public function up()
	{
		$this->createTable('{{%category}}', [
			'id' => $this->primaryKey(),

			'name_ru' => $this->string(),
			'name_cyrl' => $this->string(),
			'name_uz' => $this->string(),
			'name_en' => $this->string(),

			'status' => $this->smallInteger()->notNull()->defaultValue(1),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
		]);
	}

	public function down()
	{
		$this->dropTable('{{%category}}');
	}
}
