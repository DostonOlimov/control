<?php

use yii\db\Migration;

class m200920_083550_add_column_to_product extends Migration
{
	public function up()
	{
		$this->addColumn('product', 'views', $this->integer()->defaultValue(0)->after('status'));
	}

	public function down()
	{
		$this->dropColumn('product', 'views');
		return true;
	}
}
