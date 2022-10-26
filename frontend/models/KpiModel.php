<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class KpiModel extends Model
{
	public $sectionId = null;
	public $year = '2020';
	public $month = '10';

	public function rules()
	{
		return [
			[['sectionId'], 'integer'],
			[['year', 'month'], 'string', 'max' => 255],
		];
	}

	public function attributeLabels()
	{
		return [
			'sectionId' => Yii::t('app', 'Отделения'),
			'year' => Yii::t('app', 'Год'),
			'month' => Yii::t('app', 'Месяц'),
		];
	}
}
