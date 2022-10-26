<?php

use yii\db\Migration;

class m200918_215425_add_column_to_product extends Migration
{
	public function up()
	{
		$this->addColumn('product', 'photo', $this->string()->after('packaging_description'));
	}

	public function down()
	{
		$this->dropColumn('product', 'photo');
		return true;
	}
}
