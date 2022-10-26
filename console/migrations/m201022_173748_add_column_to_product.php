<?php

use yii\db\Migration;

class m201022_173748_add_column_to_product extends Migration
{
	public function up()
	{
		$this->addColumn('product', 'parent_id', $this->integer()->defaultValue(0)->after('id'));
		$this->addColumn('product', 'lang', $this->string()->defaultValue('cyrl')->after('parent_id'));
	}

	public function down()
	{
		$this->dropColumn('product', 'parent_id');
		$this->dropColumn('product', 'lang');
		return true;
	}
}
