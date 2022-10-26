<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
	public function up()
	{
		$this->createTable('{{%user}}', [
			'id' => $this->primaryKey(),

			'username' => $this->string()->notNull()->unique(),
			'password' => $this->string()->notNull(),

			'auth_key' => $this->string(32)->notNull(),
			'password_hash' => $this->string()->notNull(),
			'password_reset_token' => $this->string()->unique(),
			'verification_token' => $this->string()->defaultValue(null),

			'status' => $this->smallInteger()->notNull()->defaultValue(10),
			'type_id' => $this->smallInteger()->notNull()->defaultValue(10),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
		]);
	}

	public function down()
	{
		$this->dropTable('{{%user}}');
	}
}
